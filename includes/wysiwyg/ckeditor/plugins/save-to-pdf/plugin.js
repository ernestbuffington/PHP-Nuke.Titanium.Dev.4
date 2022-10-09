CKEDITOR.plugins.add( 'save-to-pdf', {
    icons: 'save-to-pdf',
    init: function( editor ) {
        editor.addCommand( 'save-to-pdf', {
            exec: function( editor ) {
                //Do POST without JQUERY
                var xhr = new XMLHttpRequest();
                xhr.open('POST', editor.config.pdfHandler);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function()
                {
                    if (xhr.status === 200) {
                    var result = JSON.parse(xhr.responseText);

                    if(result && result.pdfUrl)
                        window.location.href = result.pdfUrl;
                    else
                        console.log(xhr.responseText);

                    document.body.style.cursor='default';
                    }
                    else
                    {
                    document.body.style.cursor='default';
                    console.log("Error generating pdf");
                    }
                };

                xhr.send(JSON.stringify({content: editor.getData()}));
                document.body.style.cursor='wait';
            }
        } );
        editor.ui.addButton( 'save-to-pdf', {
            label: 'Save as PDF',
            command: 'save-to-pdf',
            toolbar: 'tools'
        });
    }
});
