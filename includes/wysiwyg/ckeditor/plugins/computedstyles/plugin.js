/**
 * Modified version of Basic Styles addon to use computed style information
 * to handle inherited text styles better.
 *
 * Now style buttons like bold/italic/underline correctly reflect actual
 * text formatting applied to an active selection even when it's inherited
 * from a style preset (i.e. 'Heading' or 'Subtitle') and can be used to
 * override its effect.
 *
 * @license Copyright (c) 2018, Green Cat Software - Xavier Cho. All rights reserved.
 *
 * The addon is distributed under the same license terms as the original addon
 * which can be found here: https://ckeditor.com/cke4/addon/basicstyles
 */
CKEDITOR.style.addCustomHandler( {
	type: 'computed',
	setup: function( definition ) {
		this.definition = definition;

		var styleDef = Object.assign( {}, definition );

		delete styleDef.type;

		this.style = new CKEDITOR.style( styleDef );

		if (definition.negation) {
			this.negatedStyle = new CKEDITOR.style( definition.negation );
		}

		this.checkApplicable = this.style.checkApplicable;
		this.checkElementMatch = this.style.checkElementMatch;
		this.checkElementRemovable = this.style.checkElementRemovable;
    },
	apply: function( editor ) {
		if (this.negatedStyle) {
			this.negatedStyle.remove( editor );
		}

		this.style.apply( editor );
    },
    remove: function( editor ) {
		if (this.style.checkActive( editor.elementPath(), editor )) {
			this.style.remove( editor );
		} else if (this.negatedStyle) {
			this.negatedStyle.apply( editor );
		}
    },
	checkActive: function( elementPath, editor ) {
		if (this.style.checkActive( elementPath, editor )) {
			return true;
		}

		if (!elementPath || !elementPath.lastElement) {
			return false;
		}

		var elem = elementPath.lastElement.$;
		var style = window.getComputedStyle( elem );

		return this.definition.checkActive( style );
    },
    toAllowedContentRules: function( editor ) {
		return [this.style, this.negatedStyle];
    }
} );

CKEDITOR.plugins.add( 'computedstyles', {
	// jscs:disable maximumLineLength
	lang: 'af,ar,az,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,es-mx,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,oc,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn', // %REMOVE_LINE_CORE%
	// jscs:enable maximumLineLength
	icons: 'bold,italic,underline,strike', // %REMOVE_LINE_CORE%
	hidpi: true, // %REMOVE_LINE_CORE%
	init: function( editor ) {
		var order = 0;
		// All buttons use the same code to register. So, to avoid
		// duplications, let's use this tool function.
		var addButtonCommand = function( buttonName, buttonLabel, commandName, styleDefiniton ) {
			// Disable the command if no definition is configured.
			if ( !styleDefiniton ) {
				return;
			}

			styleDefiniton.type = 'computed';

			var style = new CKEDITOR.style( styleDefiniton );

			// Listen to contextual style activation.
			editor.attachStyleStateChange( style, function( state ) {
				!editor.readOnly && editor.getCommand( commandName ).setState( state );
			} );

			// Create the command that can be used to apply the style.
			editor.addCommand( commandName, new CKEDITOR.styleCommand( style ) );

			// Register the button, if the button plugin is loaded.
			if ( editor.ui.addButton ) {
				editor.ui.addButton( buttonName, {
					label: buttonLabel,
					command: commandName,
					toolbar: 'basicstyles,' + ( order += 10 )
				} );
			}
		};

		var config = editor.config,
			lang = editor.lang.computedstyles;

		addButtonCommand( 'Bold', lang.bold, 'bold', config.computedStyles_bold );
		addButtonCommand( 'Italic', lang.italic, 'italic', config.computedStyles_italic );
		addButtonCommand( 'Underline', lang.underline, 'underline', config.computedStyles_underline );
		addButtonCommand( 'Strike', lang.strike, 'strike', config.computedStyles_strike );

		editor.setKeystroke( [
			[ CKEDITOR.CTRL + 66 /*B*/, 'bold' ],
			[ CKEDITOR.CTRL + 73 /*I*/, 'italic' ],
			[ CKEDITOR.CTRL + 85 /*U*/, 'underline' ]
		] );
	}
} );

// Basic Inline Styles.
CKEDITOR.config.computedStyles_bold = {
	element: 'strong',
	overrides: 'b',
	negation: {
		element: 'span',
		attributes: {
			style: 'font-weight: normal'
		}
	},
	checkActive: function( style ) {
		var weight = style['font-weight'];

		return weight && weight > 400;
	}
};

CKEDITOR.config.computedStyles_italic = {
	element: 'em',
	overrides: 'i',
	negation: {
		element: 'span',
		attributes: {
			style: 'font-style: normal'
		}
	},
	checkActive: function( style ) {
		var value = style['font-style'];
		return value == 'italic' || value == 'oblique';
	}
};

CKEDITOR.config.computedStyles_underline = {
	element: 'u',
	overrides: 'ins',
	checkActive: function( style ) {
		var value = style['text-decoration'];
		return value && value.indexOf( 'underline' ) != -1;
	}
};

CKEDITOR.config.computedStyles_strike = {
	element: 's',
	overrides: [ 'strike', 'del' ],
	checkActive: function( style ) {
		var value = style['text-decoration'];
		return value && value.indexOf( 'line-through' ) != -1;
	}
};
