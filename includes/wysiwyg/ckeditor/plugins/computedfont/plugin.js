/**
 * Modified version of Font addon to use computed style information
 * to handle inherited text styles better.
 *
 * Now both font family and size combo show actual CSS values applied to
 * the selection, regardless of whether the style was explicitly overriden or not.
 *
 * @license Copyright (c) 2018, Green Cat Software - Xavier Cho. All rights reserved.
 *
 * The original copyright notice and license information can be found here:
 * https://github.com/ckeditor/ckeditor-dev/blob/master/plugins/font/plugin.js
 */
( function() {
	function addCombo( editor, comboName, styleType, lang, names, defaultLabel, styleDefinition, order ) {
		var config = editor.config,
			style = new CKEDITOR.computedStyle( styleDefinition ),
			values = [],
			styles = {};

		// Create style objects for all fonts.
		for ( var i = 0; i < names.length; i++ ) {
			var parts = names[ i ];

			if ( parts ) {
				parts = parts.split( '/' );

				var vars = {},
					name = names[ i ] = parts[ 0 ];

				vars[ styleType ] = values[ i ] = parts[ 1 ] || name;

				styles[ name ] = new CKEDITOR.computedStyle( styleDefinition, vars );
				styles[ name ]._.definition.name = name;
			} else {
				names.splice( i--, 1 );
			}
		}

		editor.ui.addRichCombo( comboName, {
			label: lang.label,
			title: lang.panelTitle,
			toolbar: 'styles,' + order,
			defaultValue: 'cke-default',
			allowedContent: style,
			requiredContent: style,
			contentTransformations: [
				[
					{
						element: 'font',
						check: 'span',
						left: function( element ) {
							return !!element.attributes.size ||
								!!element.attributes.align ||
								!!element.attributes.face;
						},
						right: function( element ) {
							var sizes = [
								'', // Non-existent size "0"
								'x-small',
								'small',
								'medium',
								'large',
								'x-large',
								'xx-large',
								'48px' // Closest value to what size="7" might mean.
							];

							element.name = 'span';

							if ( element.attributes.size ) {
								element.styles[ 'font-size' ] = sizes[ element.attributes.size ];
								delete element.attributes.size;
							}

							if ( element.attributes.align ) {
								element.styles[ 'text-align' ] = element.attributes.align;
								delete element.attributes.align;
							}

							if ( element.attributes.face ) {
								element.styles[ 'font-family' ] = element.attributes.face;
								delete element.attributes.face;
							}
						}
					}
				]
			],
			panel: {
				css: [ CKEDITOR.skin.getPath( 'editor' ) ].concat( config.contentsCss ),
				multiSelect: false,
				attributes: { 'aria-label': lang.panelTitle }
			},

			init: function() {
				var name,
					defaultText = '(' + editor.lang.common.optionDefault + ')';

				this.startGroup( lang.panelTitle );

				// Add `(Default)` item as a first element on the drop-down list.
				this.add( this.defaultValue, defaultText, defaultText );

				for ( var i = 0; i < names.length; i++ ) {
					name = names[ i ];
					// Add the tag entry to the panel list.
					this.add( name, styles[ name ].buildPreview(), name );
				}
			},

			onClick: function( value ) {
				var style = styles[ value ];
				var previousValue = this.getValue();
				var previousStyle = previousValue && value != previousValue ? styles[ previousValue ] : undefined;
				var isDefault = value == this.defaultValue;

				if ( style && comboName == 'Font' && editor.config.font_blockWhileLoadingFont ) {
					// Use an arbitrary font size to check if the font is loaded.
					var font = '12pt ' + style._.definition.name;

					if ( document.fonts.check( font ) ) {
						this.applyStyle( style, previousStyle, isDefault );
					} else {
						var that = this;

						editor.fire( 'fontLoading', { font: style._.definition.name } );

						CKEDITOR.tools.setTimeout( function() {
							editor.setReadOnly( true );

							document.fonts.load( font ).then(
								function() {
									editor.setReadOnly( false );

									that.applyStyle( style, previousStyle, isDefault );

									editor.fire( 'fontLoaded', { font: style._.definition.name } );
								},
								function() {
									editor.setReadOnly( false );

									editor.fire( 'fontLoadingFailed', { font: style._.definition.name } );
								}).finally(
								function() {
									editor.fire( 'fontLoadingComplete', { font: style._.definition.name } );
							});
						}, 0 );
					}
				} else {
					this.applyStyle( style, previousStyle, isDefault );
				}
			},

			applyStyle: function( style, previousStyle, isDefault ) {
				editor.focus();
				editor.fire( 'saveSnapshot' );

				var range,
					path,
					matching,
					startBoundary,
					endBoundary,
					node,
					bm;

				// When applying one style over another, first remove the previous one (https://dev.ckeditor.com/ticket/12403).
				// NOTE: This is only a temporary fix. It will be moved to the styles system (https://dev.ckeditor.com/ticket/12687).
				if ( previousStyle ) {
					range = editor.getSelection().getRanges()[ 0 ];

					// If the range is collapsed we can't simply use the editor.removeStyle method
					// because it will remove the entire element and we want to split it instead.
					if ( range.collapsed ) {
						path = editor.elementPath();
						// Find the style element.
						matching = path.contains( function( el ) {
							return previousStyle.checkElementRemovable( el );
						} );

						if ( matching ) {
							startBoundary = range.checkBoundaryOfElement( matching, CKEDITOR.START );
							endBoundary = range.checkBoundaryOfElement( matching, CKEDITOR.END );

							// If we are at both boundaries it means that the element is empty.
							// Remove it but in a way that we won't lose other empty inline elements inside it.
							// Example: <p>x<span style="font-size:48px"><em>[]</em></span>x</p>
							// Result: <p>x<em>[]</em>x</p>
							if ( startBoundary && endBoundary ) {
								bm = range.createBookmark();
								// Replace the element with its children (TODO element.replaceWithChildren).
								while ( ( node = matching.getFirst() ) ) {
									node.insertBefore( matching );
								}
								matching.remove();
								range.moveToBookmark( bm );

							// If we are at the boundary of the style element, move out and copy nested styles/elements.
							} else if ( startBoundary || endBoundary ) {
								range.moveToPosition( matching, startBoundary ? CKEDITOR.POSITION_BEFORE_START : CKEDITOR.POSITION_AFTER_END );
								cloneSubtreeIntoRange( range, path.elements.slice(), matching );
							} else {
								// Split the element and clone the elements that were in the path
								// (between the startContainer and the matching element)
								// into the new place.
								range.splitElement( matching );
								range.moveToPosition( matching, CKEDITOR.POSITION_AFTER_END );
								cloneSubtreeIntoRange( range, path.elements.slice(), matching );
							}

							editor.getSelection().selectRanges( [ range ] );
						}
					} else {
						editor.removeStyle( previousStyle );
					}
				}

				if ( isDefault ) {
					if ( previousStyle ) {
						editor.removeStyle( previousStyle );
					}
				} else {
					editor.applyStyle( style );
				}

				editor.fire( 'saveSnapshot' );
			},

			onRender: function() {
				editor.on( 'selectionChange', function( ev ) {
					var currentValue = this.getValue();

					var elementPath = ev.data.path,
						elements = elementPath.elements;

					if ( elements.length > 0 ) {
						var element = elements[ 0 ];
						var style = getComputedStyle(element.$);

						// Check if the element is removable by any of
						// the styles.
						for ( var value in styles ) {
							if ( styles[ value ].checkStyleMatch( element, style, true, editor ) ) {
								if ( value != currentValue )
									this.setValue( value );
								return;
							}
						}

						var value = styleDefinition.getStyleValue( style );

						if ( value ) {
							this.setValue( '', value );
							return;
						}
					}

					// If no styles match, just empty it.
					this.setValue( '', defaultLabel );
				}, this );
			},

			refresh: function() {
				if ( !editor.activeFilter.check( style ) )
					this.setState( CKEDITOR.TRISTATE_DISABLED );
			}
		} );
	}

	// Clones the subtree between subtreeStart (exclusive) and the
	// leaf (inclusive) and inserts it into the range.
	//
	// @param range
	// @param {CKEDITOR.dom.element[]} elements Elements path in the standard order: leaf -> root.
	// @param {CKEDITOR.dom.element/null} substreeStart The start of the subtree.
	// If null, then the leaf belongs to the subtree.
	function cloneSubtreeIntoRange( range, elements, subtreeStart ) {
		var current = elements.pop();
		if ( !current ) {
			return;
		}
		// Rewind the elements array up to the subtreeStart and then start the real cloning.
		if ( subtreeStart ) {
			return cloneSubtreeIntoRange( range, elements, current.equals( subtreeStart ) ? null : subtreeStart );
		}

		var clone = current.clone();
		range.insertNode( clone );
		range.moveToPosition( clone, CKEDITOR.POSITION_AFTER_START );

		cloneSubtreeIntoRange( range, elements );
	}

	CKEDITOR.plugins.add( 'computedfont', {
		requires: 'richcombo',
		// jscs:disable maximumLineLength
		lang: 'af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn', // %REMOVE_LINE_CORE%
		// jscs:enable maximumLineLength
		init: function( editor ) {
			var config = editor.config;

			// Gets the list of fonts from the settings.
			var names = config.font_names.split( ';' );
			var sizes = config.fontSize_sizes.split( ';' ).map( function( v ) {
				return [ v, '/', v ].join( '' ) } );

			addCombo( editor, 'Font', 'family', editor.lang.computedfont, names, config.font_defaultLabel, config.font_style, 30 );
			addCombo( editor, 'FontSize', 'size', editor.lang.computedfont.fontSize, sizes, config.fontSize_defaultLabel, config.fontSize_style, 40 );
		}
	} );
} )();

/**
 * The list of fonts names to be displayed in the Font combo in the toolbar.
 * Entries are separated by semi-colons (`';'`), while it's possible to have more
 * than one font for each entry, in the HTML way (separated by comma).
 *
 * A display name may be optionally defined by prefixing the entries with the
 * name and the slash character. For example, `'Arial/Arial, Helvetica, sans-serif'`
 * will be displayed as `'Arial'` in the list, but will be outputted as
 * `'Arial, Helvetica, sans-serif'`.
 *
 *		config.font_names =
 *			'Arial/Arial, Helvetica, sans-serif;' +
 *			'Times New Roman/Times New Roman, Times, serif;' +
 *			'Verdana';
 *
 *		config.font_names = 'Arial;Times New Roman;Verdana';
 *
 * @cfg {String} [font_names=see source]
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_names = 'Arial/Arial, Helvetica, sans-serif;' +
	'Comic Sans MS/Comic Sans MS, cursive;' +
	'Courier New/Courier New, Courier, monospace;' +
	'Georgia/Georgia, serif;' +
	'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
	'Tahoma/Tahoma, Geneva, sans-serif;' +
	'Times New Roman/Times New Roman, Times, serif;' +
	'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
	'Verdana/Verdana, Geneva, sans-serif';

/**
 * The text to be displayed in the Font combo is none of the available values
 * matches the current cursor position or text selection.
 *
 *		// If the default site font is Arial, we may making it more explicit to the end user.
 *		config.font_defaultLabel = 'Arial';
 *
 * @cfg {String} [font_defaultLabel='']
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_defaultLabel = '';

/**
 * Whether or not to block editing while used webfont is being loaded.
 *
 * @cfg {Boolean} [font_blockWhileLoadingFont=false]
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_blockWhileLoadingFont = false;

/**
 * Set true to use font detection to determine actual rendered font used when
 * a font set is specified (i.e. 'Arial, Helvetica, sans-serif').
 *
 * @cfg {Boolean} [font_detect=true]
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_detect = true;

/**
 * Text to use for detecting rendered font family.
 *
 * @cfg {Boolean} [font_detect_pangram=see example]
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_detect_pangram =
	'Nymphsblitzquickvexdwarfjog' +
	'012345!@#$%^&* ' +
	'키스의고유조건은입술끼리만나야하고' +
	'いろはにほへとちりぬるを わかよたれそ' +
	'視野無限廣窗外有藍天微風迎客軟語伴茶';

/**
 * Font size to use for detecting rendered font family.
 *
 * @cfg {Boolean} [font_detect_size=72]
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_detect_size = 72;

/**
 * Fallback font to use for detecting rendered font family.
 *
 * @cfg {Boolean} [font_detect_fallback='monospace']
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_detect_fallback = 'monospace';

/**
 * The style definition to be used to apply the font in the text.
 *
 *		// This is actually the default value for it.
 *		config.font_style = {
 *			element:		'span',
 *			styles:			{ 'font-family': '#(family)' },
 *			overrides:		[ { element: 'font', attributes: { 'face': null } } ]
 *	 };
 *
 * @cfg {Object} [font_style=see example]
 * @member CKEDITOR.config
 */
CKEDITOR.config.font_style = {
	element: 'span',
	styles: { 'font-family': '#(family)' },
	overrides: [ {
		element: 'font', attributes: { 'face': null }
	} ],
	getStyleValue: function( style ) {
   		var fontset = style.fontFamily.split( ',' );

		if ( fontset.length > 1 ) {
			return CKEDITOR.config.font_detect ? this.detectFont( fontset ) : fontset[ 0 ];
		}

		return style.fontFamily.replace(/['"]/g, '');
	},
	detectFont: function( candidates ) {
		// Adapted from https://www.kirupa.com/html5/detect_whether_font_is_installed.htm

		if ( !Array.isArray( candidates ) || candidates.length == 0 ) {
			return undefined;
		}

		var canvas = document.createElement( 'canvas' );
		var context = canvas.getContext( '2d' );

		var text = CKEDITOR.config.font_detect_pangram;
		var size = CKEDITOR.config.font_detect_size;
		var fallback = CKEDITOR.config.font_detect_fallback;

		function matches( font ) {
			font = font.trim().replace( '"', '' ).replace( '\'', '' );

			context.font = [size, 'px ', fallback].join( '' );

			var baseline = context.measureText(text).width;

			context.font = [size, 'px "', font, '", ', fallback].join( '' );

			var actual = context.measureText(text).width;

			return baseline != actual;
		}

		for ( i in candidates ) {
			var font = candidates[ i ];
			if ( matches(font) ) return font;
		}

		return candidates[ candidates.length - 1 ];
	}
};

/**
 * The list of fonts size to be displayed in the Font Size combo in the
 * toolbar. Entries are separated by semi-colons (`';'`).
 *
 * Numeric values are allowed which will be suffixed with the 'px' in runtime.
 *
 * @cfg {String} [fontSize_sizes=see source]
 * @member CKEDITOR.config
 */
CKEDITOR.config.fontSize_sizes = '8;9;10;11;12;14;16;18;20;22;24;26;28;36;48;72';

/**
 * The text to be displayed in the Font Size combo is none of the available
 * values matches the current cursor position or text selection.
 *
 *		// If the default site font size is 12px, we may making it more explicit to the end user.
 *		config.fontSize_defaultLabel = '12px';
 *
 * @cfg {String} [fontSize_defaultLabel='']
 * @member CKEDITOR.config
 */
CKEDITOR.config.fontSize_defaultLabel = '';

/**
 * The style definition to be used to apply the font size in the text.
 *
 *		// This is actually the default value for it.
 *		config.fontSize_style = {
 *			element:		'span',
 *			styles:			{ 'font-size': '#(size)' },
 *			overrides:		[ { element: 'font', attributes: { 'size': null } } ]
 *		};
 *
 * @cfg {Object} [fontSize_style=see example]
 * @member CKEDITOR.config
 */
CKEDITOR.config.fontSize_style = {
	element: 'span',
	styles: { 'font-size': '#(size)px' },
	overrides: [ {
		element: 'font', attributes: { 'size': null }
	} ],
	getStyleValue: function( style ) {
		var size = style.fontSize;

		return CKEDITOR.tools.convertToPx( size );
	}
};

CKEDITOR.computedStyle = CKEDITOR.tools.createClass({
	base: CKEDITOR.style,
	$: function( styleDefinition, variablesValues ) {
		this.base( styleDefinition, variablesValues );
	},
	proto: {
		checkStyleMatch: function( element, style, fullMatch, editor ) {
			if (this.checkElementMatch( element, fullMatch, editor )) {
				return true;
			} else {
				var def = this._.definition;

				return def.name == def.getStyleValue( style );
			}
		}
	}
});
