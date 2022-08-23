/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'en';
	 //config.uiColor = '#AADC6E';
	 //config.extraPlugins = 'codesnippetgeshi';
	 //%REMOVE_START%
	 // added this line to get rid of the auto paragraph hints the <p> and </p>
	config.autoParagraph = false;
	config.plugins =
		'api,' + /* Add No Crash */
		'ajax,' + /* Add No Crash */

		'about,' +
		'a11yhelp,' +
		
		'autocomplete,' + /* Add No Crash */  
		
		'autogrow,' + /* Add No Crash */
		
		'basicstyles,' +
		
		'bgimage,' + /* Add No Crash - Working Perfect */
		
		'bidi,' +
		'blockquote,' +
		
		'balloontoolbar,' + /* Add No Crash - appears to not do jack shit */ 
		
		'balloonpanel,' + /* Add No Crash - appears to not do jack shit */ 
		
		
		'button,' + /* Add No Crash */
		
		'ccmsconfighelper,' + /* Add No Crash - doesnot apperar to do shit in this dev */
		
		'chart,' + /* Tested and working kinda kewl needs work */
		
		'clipboard,' +

		'codesnippet,' +  /* Tested and working fucking awesome */
		
		/* 'codesnippetgeshi,' +   Tested and broken as a mother fucker - piece of shit s far */
		
		'colorbutton,' +
		'colordialog,' +
		
		'computedstyles,' + /* Add No Crash - doesnot apperar to do shit can't tell */
		
		'copyformatting,' +
		'contextmenu,' +
		
		'deselect,' + /* Add No Crash - appears to not do jack shit */
		
		'detail,' + /* Add No Crash - Fucking Awesome */
		
		/* 'cssanim,' + works but can't find the .CSS file */
		
		'dialogadvtab,' +

	    'dialogui,' + /* Add No Crash */
	    'dialog,' +   /* Add No Crash */

		'div,' +
		
		'docprops,' + /* Add No Crash */
		
	    'docfont,' + /* Add No Crash - not sure could not tell if it did anything I DO SEE A FONT DROP DOWN BUT I THINK IT WAS THERE ALREADY */
		
		'eqneditor,' + /* Add No Crash WORKING - codecogs equation symbols */
		
		'elementspath,' +
		
		'embedbase,' + /* Add No Crash - appears to not do shit in this dev */
		
		'emoji,' + /* Add No Crash WORKS AWESOME */
		
		'enterkey,' +
		'entities,' +
		
		'fakeobjects,' + /* Add No Crash */ 
		
		'filebrowser,' +
		
		'filetools,' + /* Add No Crash */
		
		'find,' +
		'flash,' +
		'floatingspace,' +
		
		'floatpanel,' + /* Add No Crash */
		
		'font,' +
		'format,' +
		'forms,' +
		'horizontalrule,' +
		
		'htmlbuttons,' + /* Add No Crash */
		
		'htmlwriter,' +
		
		'html5video,' +  /* Add No Crash WORKS PERFECT */
		
        'imagebase,' + /* Add No Crash */

		'image,' +
		
	    /* 'imageuploader,' + - re write it ghost ts broken */

		/* 'imgupload,' +    brk piece of shit does not  work with curret dev */ 
		
		/* 'image2,' +  Add No Crash WORKING - Seems like a shitty version of image GARBAGE IN my eyes! */
		
		'iframe,' +
		
		'iframedialog,' + /* Add No Crash */
		
		'indent,' + /* Add No Crash */
		
		'indentlist,' +
		'indentblock,' +
		'justify,' +
		'language,' +
		
		'listblock,' + /* Add No Crash */
		
		'lineutils,' + /* Add No Crash */

        'lightbox,' + /* Add No Crash - Works great no problems */
		
		'link,' +
		
		/* 'SimpleLink,' +   SHITTY VERSION of 'link,' + */ 
		
		'list,' +
		'liststyle,' +
		'magicline,' +
		'maximize,' +
		
		'menu,' + /* Add No Crash */
		'menubutton,' +  
		
		'mediaembed,' + /* Add No Crash */
		
		'newpage,' +
		
		'notification,' + /* Add No Crash */
		'notificationaggregator,' + /* Add No Crash */
		
		/* 'niftytimers,' + No crash but is missing files */ 
		
		'panelbutton,' +  /* Add No Crash */
		'panel,' + /* Add No Crash */
		
		'pagebreak,' +
		
		'pastefromexcel,' + /* Add No Crash - appears to not work */
		
		'pastefromword,' +
		'pastetext,' +
		
		'popup,' + /* Add No Crash */
		
		'preview,' +
		'print,' +
		'removeformat,' +
		'resize,' +
		
		'richcombo,' + /* Add No Crash */
		
		'save,' +
		
		'scayt,' +  /* Add No Crash WORKING */
		
		'selectallcontextmenu,' +  /* Add No Crash  must be sae as 'selectall,' + */
		
		'selectall,' +
		
		
		'showblocks,' +
		'showborders,' +                        
		
		'slideshow,' + /* Add No Crash WORKING - Slide Show Works but where do you put the fucking images? */
		
		'smiley,' +
		'sourcearea,' +
		'specialchar,' +
		
		'spoiler,' + /* Add No Crash WORKING - fucking works awesome */
		
		'symbol,' + /* Add No Crash WORKING - A more extnded version of 'specialchar,' + */
		
		'stylescombo,' +
		'tab,' +
		'table,' +
		'tableselection,' +
		'tabletools,' +

		'tableresize,' + /* Add No Crash WORKING */

        'tabletoolstoolbar,' + /* Add No Crash - Working Perfect */ 
		
		'templates,' +
		
		'textmatch,' + /* Add No Crash */
		
		'textwatcher,' + /* Add No Crash */
		
		/* 'Text2Speech,' + broke dick piece of shit */ 
		
		'toolbar,' +
		'undo,' +
		
		'uploadcare,' + /* Add No Crash WORKING */
		
		'uploadwidget,' + /* Add No Crash */
		
		'uploadimage,' +  /* already here but does it worl I can't tell? */
		
		'uploadfile,' + /* Added - looks like some broken ass shit to me */
		
		'videodetector,' + /* Add No Crash WORKING - needs to be fixed to have a default video size */
		
		
		
		'widgetselection,' + /* Add No Crash */
		'widget,' + /* Add No Crash */
		
		'wsc,' + /* Add No Crash */
		
		'xml,' + /* Add No Crash */
		
		'zoom,' + /* Add No Crash WORKING */

		/* 'Audio,' +  Added and it breaks the editor in 4 dev GARBAGE */ 
		
		'wysiwygarea';
	// %REMOVE_END%
};

// %LEAVE_UNMINIFIED% %REMOVE_LINE%
