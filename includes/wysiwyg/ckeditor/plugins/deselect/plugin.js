/**
 * @license For licensing, see LICENSE.md.
 */

/**
 * @fileOverview The "deselect" plugin that fixs a issue related to IE 11,
 *               which was reported to CKEditor team
 *               ([Issue #14646](https://dev.ckeditor.com/ticket/14646)),
 *               and it will be used temporarily until the issue is fixed.
 *
 */
CKEDITOR.plugins.add( 'deselect', {
	init: function( editor ) {
		// Function for detecting IE11.
		var isIE11 = function() {
			if ( !( window.ActiveXObject ) && 'ActiveXObject' in window && !!navigator.userAgent.match( /Trident.*rv[ :]*11\./ ) ) {
				return true; // IE 11.
			}
			return false; // Other browsers.
		};

		// Run codes only in case of IE11.
		if ( !isIE11() ) return;

		// Adds command for de-select text selection.
		editor.addCommand( 'deselectRange', {
			exec: function( editor ) {
				var ran = editor.getSelection().getRanges()[0],
					range = editor.createRange();
				// Checks whether selection is exist or not.
				if ( ran.startOffset == ran.endOffset ) return;

				// De-select text selection.
				range.moveToElementEditEnd( editor.editable() );
				range.select();
			}
		} );

		// Set timer for 2 seconds until CKEditor is completely loaded.
		setTimeout( function() {
			// Event handler for mouse click.
			var clickEventHandler = function( editor ) {
				var iframe = document.getElementById( editor.id + '_contents' ).lastChild.contentDocument;
				return function( evt ) {
					var currentHeight = iframe.lastChild.offsetHeight;
					// When mouse is clicked outside of inner document.
					if ( editor.config.height > currentHeight && currentHeight < evt.clientY ) {
						// De-select text selection area.
						editor.execCommand( 'deselectRange' );
					}
				};
			};

			// Adds event handler for click event.
			var iframe = document.getElementById( editor.id + '_contents' ).lastChild.contentDocument;
			iframe.addEventListener( 'click', clickEventHandler( editor ) );
		}, 1000 * 2, editor );
	}
} );
