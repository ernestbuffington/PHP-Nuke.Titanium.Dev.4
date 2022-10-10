/* bender-tags: editor,unit */
/* bender-ckeditor-plugins: deselect,toolbar,wysiwygarea */

( function() {
	'use strict';

	bender.editor = true;

	bender.test( {
		'test deselect is working on IE 11': function() {
			if ( !( CKEDITOR.env.ie && CKEDITOR.env.version == 11 ) )
				assert.ignore();

			bender.editorBot.create( {
				name: 'editor1',
				config: {
					height: 500
				}
			}, function( bot ) {
				var editor = bot.editor;

				bot.setHtmlWithSelection( '[<p>Test sentence for color change</p>]' );

				setTimeout( function() {
					resume( function() {
						editor.execCommand( 'deselectRange' );

						var actual = editor.getSelection().getRanges()[0].endOffset - editor.getSelection().getRanges()[0].startOffset;
						assert.areEqual( 0, actual, 'size shoud be zero.' );
					} );
				}, 3 * 1000, editor );

				wait();
			} );
		}
	} );
} )();
