/*
 Text2Speech
 Version 0.1

 This plugin allows read the selected text

 Copyright OrionsSoftware.org 2015
 Written by Umberto Boria.
*/

CKEDITOR.plugins.add('Text2Speech',
{
	//icons: "icona-audio",
    init: function (editor) {
    var pluginName = 'Text2Speech';
    var cmd = editor.addCommand('t2s', { exec: Text2Speech });
        editor.ui.addButton('t2s_button',
            {
                label: 'Leggimi',
                icon: this.path + 'icons/icona-audio.png',
                command: 't2s'
            });

    }
});

function Text2Speech(e) {
	//Verifico cosa c'� nella prima text_1
	var text2speech='';
	var url='';
    my_instance();
	text2speech = my_instance().document.getBody().getText();
	url = 'https://translate.google.com/translate_tts?tl=it&q='+text2speech;
	if (text2speech>'') {winopen('https://translate.google.com/translate_tts?tl=it&q='+text2speech,100,100);text2speech='';}

}

function winopen (url,l,h) {
	//Apertura di una finestra per poi toglierle il fuoco
	sleep (50);
	winunder = window.open(url,'height=' + h + ',width=' + l + ',menubar=no,location=no,status=no,toolbar=no,top=10,left=10');
}

function my_instance() {
	for (var ID in CKEDITOR.instances)
	{
		if (CKEDITOR.instances[ID].focusManager.hasFocus) {return CKEDITOR.instances[ID]; }
	}
}

//Function for read automatic from selection
function selected_text(obj) {
//In test
	if (document.selection) { // Internet Explorer
		obj.focus();
 		return document.selection.createRange().text;
 	} else if (obj.selectionStart || obj.selectionStart == '0') { // Others
 		return obj.value.substring(obj.selectionStart, obj.selectionEnd);
 	} else {
 		return obj.value; // Fallback
 	}
}

//Function for pause
function sleep(milliseconds) {
           var currentTime = new Date().getTime();
           while (currentTime + milliseconds >= new Date().getTime()) {
           }
       }
