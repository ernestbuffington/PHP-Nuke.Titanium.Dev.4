/***************************************************************************
					enabler.js
					------------
	product			: htmlEditbox enabler
	version			: 1.0
	released		: Sat Sep 28 2003
	copyright		: Copyright © 2001-2003 Labs4.com
	email			: support@labs4.com
	website			: http://www.labs4.com

***************************************************************************/


if (navigator.appName == "Microsoft Internet Explorer") {
   if (document.layers) {
      document.captureEvents(Event.ONCONTEXTMENU);
   }
   document.oncontextmenu=confirmEdit;
}


	function enabler() {
		
		var textareaCount = document.getElementsByTagName("textarea").length;
		var textareaCollection = document.getElementsByTagName("textarea");
		
		for (var i = 0; i < textareaCollection.length; i++) {
			var thisTextarea = textareaCollection.item(i);
			thisTextarea.title = "htmlEditbox enabled textarea no. " + (i+1) + " - right click to open its content in htmlEditbox";
			thisTextarea.id = "textarea" + (i+1);
		}

		window.status = '[htmlEditbox enabler 1.0] initialised in ' + textareaCount + ' textarea elements';
	}

	function confirmEdit() {
		if(event.srcElement.id.indexOf("textarea") != -1) {
			if(window.confirm('Do you really wanna edit content of '+ event.srcElement.id +' in htmlEditbox?')) {
				openEditor();
			}
		return false;
		}
	}

	function openEditor() {
		window.open('_editor.php?id='+ event.srcElement.id,'editor_popup','width=760,height=570,scrollbars=no,resizable=yes,status=yes'); 
	}

window.onload = enabler