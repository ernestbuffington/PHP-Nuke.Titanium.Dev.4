/* bender-tags: editor,unit,clipboard */
/* bender-ckeditor-plugins: clipboard,pastefromexcel */

( function() {
	// 'use strict';

	bender.editor = false;

	bender.test( {
		'test converting internal styles to inline style of respective node when table is copied excel': function() {
			if ( CKEDITOR.env.ie )
				assert.ignore();

			bender.editorBot.create( {
				name: 'editor1',
				config: {
					allowedContent: true,
					pasteFilter: null,
					pasteFromWordRemoveFontStyles: false,
					pasteFromWordRemoveStyles: false
				}
			}, function( bot ) {
				var editor = bot.editor,
					dataTransfer;

				editor.once( 'paste', function( evt ) {
					resume( function() {
						assert.areEqual( '<p style="color: red;">text <strong class="MsoNormal">text</strong></p>', evt.data.dataValue, 'inline styles should be converted to style attributes of respective node' );
					} );
				}, null, null, 999 );

				dataTransfer = new CKEDITOR.plugins.clipboard.dataTransfer( null, editor );
				dataTransfer.setData( 'text/html',
					'<html><head><meta name=Generator content="Microsoft Excel 15"><style>p {color: red;}</style></head><body><p>text <strong class="MsoNormal">text</strong></p></body></html>'
				);

				editor.fire( 'paste', {
					'dataTransfer': dataTransfer
				} );

				wait();
			} );
		},

		'test converting internal styles to inline style of respective node when table is copied excel (table copy)': function() {
			if ( CKEDITOR.env.ie )
				assert.ignore();

			bender.editorBot.create( {
				name: 'editor2',
				config: {
					allowedContent: true,
					pasteFilter: null,
					pasteFromWordRemoveFontStyles: false,
					pasteFromWordRemoveStyles: false
				}
			}, function( bot ) {
				var editor = bot.editor,
					dataTransfer;

				editor.once( 'paste', function( evt ) {
					resume( function() {
						// jscs:disable maximumLineLength
						if ( CKEDITOR.env.gecko ) {
							assert.areEqual( '<table style="border-collapse: collapse; width: 162pt;" border="0" cellpadding="0" cellspacing="0" width="216"> <colgroup><col style="width: 54pt;" span="3" width="72"> </colgroup><tbody><tr style="height: 16.5pt;" height="22">  <td class="xl63" style="height: 16.5pt; width: 54pt; padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-weight: 400; font-style: normal; text-decoration: none; vertical-align: middle; white-space: nowrap; color: red; font-family: Arial,sans-serif; text-align: left; border: 0.5pt solid windowtext; background: yellow none repeat scroll 0% 0%;" height="22" width="72">Test</td>  <td class="xl64" style="width: 54pt; padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-weight: 400; font-style: normal; text-decoration: none; vertical-align: middle; white-space: nowrap; color: red; font-family: Arial,sans-serif; text-align: center; border: 0.5pt solid windowtext; background: yellow none repeat scroll 0% 0%;" width="72">Cell</td>  <td class="xl65" style="width: 54pt; padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-weight: 400; font-style: normal; text-decoration: none; vertical-align: middle; white-space: nowrap; color: red; font-family: Arial,sans-serif; text-align: right; border: 0.5pt solid windowtext; background: yellow none repeat scroll 0% 0%;" width="72">Cell2</td> </tr></tbody></table>', evt.data.dataValue, 'inline styles should be converted to style attributes of respective node' );
							return;
						}
						assert.areEqual( '<table border="0" cellpadding="0" cellspacing="0" width="216" style="border-collapse: collapse; width: 162pt;"> <colgroup><col width="72" span="3" style="width: 54pt;"> </colgroup><tbody><tr height="22" style="height: 16.5pt;">  <td height="22" class="xl63" width="72" style="height: 16.5pt; width: 54pt; padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-weight: 400; font-style: normal; text-decoration: none; vertical-align: middle; white-space: nowrap; color: red; font-family: Arial, sans-serif; text-align: left; border: 0.5pt solid windowtext; background: yellow;">Test</td>  <td class="xl64" width="72" style="width: 54pt; padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-weight: 400; font-style: normal; text-decoration: none; vertical-align: middle; white-space: nowrap; color: red; font-family: Arial, sans-serif; text-align: center; border: 0.5pt solid windowtext; background: yellow;">Cell</td>  <td class="xl65" width="72" style="width: 54pt; padding-top: 1px; padding-right: 1px; padding-left: 1px; font-size: 11pt; font-weight: 400; font-style: normal; text-decoration: none; vertical-align: middle; white-space: nowrap; color: red; font-family: Arial, sans-serif; text-align: right; border: 0.5pt solid windowtext; background: yellow;">Cell2</td> </tr></tbody></table>', evt.data.dataValue, 'inline styles should be converted to style attributes of respective node' );
						// jscs:enable maximumLineLength
					} );
				}, null, null, 999 );

				dataTransfer = new CKEDITOR.plugins.clipboard.dataTransfer( null, editor );
				// jscs:disable maximumLineLength
				dataTransfer.setData( 'text/html', '<html xmlns:v="urn:schemas-microsoft-com:vml"xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv=Content-Type content="text/html; charset=utf-8"><meta name=ProgId content=Excel.Sheet><meta name=Generator content="Microsoft Excel 15"><link id=Main-File rel=Main-Filehref="file:///C:\Users\Scott\AppData\Local\Temp\msohtmlclip1\01\clip.htm"><link rel=File-Listhref="file:///C:\Users\Scott\AppData\Local\Temp\msohtmlclip1\01\clip_filelist.xml"><style><!--table	{mso-displayed-decimal-separator:"\.";	mso-displayed-thousand-separator:"\,";}@page	{margin:.75in .7in .75in .7in;	mso-header-margin:.3in;	mso-footer-margin:.3in;}.font5	{color:windowtext;	font-size:8.0pt;	font-weight:400;	font-style:normal;	text-decoration:none;	font-family:"맑은 고딕", monospace;	mso-font-charset:129;}tr	{mso-height-source:auto;	mso-ruby-visibility:none;}col	{mso-width-source:auto;	mso-ruby-visibility:none;}br	{mso-data-placement:same-cell;}td	{padding-top:1px;	padding-right:1px;	padding-left:1px;	mso-ignore:padding;	color:black;	font-size:11.0pt;	font-weight:400;	font-style:normal;	text-decoration:none;	font-family:"맑은 고딕", monospace;	mso-font-charset:129;	mso-number-format:General;	text-align:general;	vertical-align:middle;	border:none;	mso-background-source:auto;	mso-pattern:auto;	mso-protection:locked visible;	white-space:nowrap;	mso-rotate:0;}.xl63	{color:red;	font-family:Arial, sans-serif;	mso-font-charset:0;	text-align:left;	border:.5pt solid windowtext;	background:yellow;	mso-pattern:black none;}.xl64	{color:red;	font-family:Arial, sans-serif;	mso-font-charset:0;	text-align:center;	border:.5pt solid windowtext;	background:yellow;	mso-pattern:black none;}.xl65	{color:red;	font-family:Arial, sans-serif;	mso-font-charset:0;	text-align:right;	border:.5pt solid windowtext;	background:yellow;	mso-pattern:black none;}ruby	{ruby-align:left;}rt	{color:windowtext;	font-size:8.0pt;	font-weight:400;	font-style:normal;	text-decoration:none;	font-family:"맑은 고딕", monospace;	mso-font-charset:129;	mso-char-type:none;	display:none;}--></style></head><body link="#0563C1" vlink="#954F72"><table border=0 cellpadding=0 cellspacing=0 width=216 style=\'border-collapse: collapse;width:162pt\'> <col width=72 span=3 style=\'width:54pt\'> <tr height=22 style=\'height:16.5pt\'><!--StartFragment-->  <td height=22 class=xl63 width=72 style=\'height:16.5pt;width:54pt\'>Test</td>  <td class=xl64 width=72 style=\'border-left:none;width:54pt\'>Cell</td>  <td class=xl65 width=72 style=\'border-left:none;width:54pt\'>Cell2</td><!--EndFragment--> </tr></table></body></html>������' );
				// jscs:enable maximumLineLength

				editor.fire( 'paste', {
					'dataTransfer': dataTransfer
				} );

				wait();
			} );
		}
	} );
} )();
