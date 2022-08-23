nuke_jq(function($) 
{
    $.fn.extend(
    {
        insertAtCaret: function(myValue) 
        {
            return this.each(function(i) 
            {
                if (document.selection) 
                {
                    //For browsers like Internet Explorer
                    this.focus();
                    sel = document.selection.createRange();
                    sel.text = myValue;
                    this.focus();
                }
                else if (this.selectionStart || this.selectionStart == '0') 
                {
                    //For browsers like Firefox and Webkit based
                    var startPos = this.selectionStart;
                    var endPos = this.selectionEnd;
                    var scrollTop = this.scrollTop;
                    this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
                    this.focus();
                    this.selectionStart = startPos + myValue.length;
                    this.selectionEnd = startPos + myValue.length;
                    this.scrollTop = scrollTop;
                } 
                else 
                {
                    this.value += myValue;
                    this.focus();
                }
            })
        }
    });

    var bbcode = new Array();

    $('.bbchelpline').hover(function() 
    {
        var field = $(this).data('field');
        $('input[name=help'+field+']').val($(this).data('helpline'));
    }, function() 
    {
        var field = $(this).data('field');
        $('input[name=help'+field+']').val(message_help);
    });

    $('.bbcbutton').click(function()
    {
        var field       = $(this).data('field');
        var text        = $('textarea#'+field).val();
        var code        = $(this).data('bbcode');
        var codename    = $(this).data('name');
        var selection   = $('textarea#'+field).selection();
        if (selection) 
        {
            $('textarea#'+field).selection('replace', { text: '['+code+']'+$.trim(selection)+'[/'+code+']' });
        } 
        else
        {
            if (bbcode[code] == null) 
            {
                content = '['+code+']'
                $('textarea#'+field).val(text + content);
                bbcode[code] = 1;
                $(this).removeClass('bbc-'+codename).addClass('bbc-'+codename+'-down');
            } else {
                content = '[/'+code+']'
                $('textarea#'+field).val(text + content);
                bbcode[code] = null;
                $(this).removeClass('bbc-'+codename+'-down').addClass('bbc-'+codename);
            }
        }
    });

    $('.bbcalignment').click(function()
    {
        var field       = $(this).data('field');
        var text        = $('textarea#'+field).val();
        var code        = $(this).data('bbcode');
        var selection   = $('textarea#'+field).selection(); 
        var type        = $(this).data('type');
        if (selection) 
        {
            $('textarea#'+field).selection('replace', { text: '['+type+'='+code+']'+selection+'[/'+type+']' });
        }
        else
        {
            if (bbcode[code] == null) 
            {
                content = '['+type+'='+code+']'
                $('textarea#'+field).val(text + content);
                bbcode[code] = 1;
                $(this).removeClass('bbc-'+code).addClass('bbc-'+code+'-down');
            } else {
                content = '[/'+type+']'
                $('textarea#'+field).val(text + content);
                bbcode[code] = null;
                $(this).removeClass('bbc-'+code+'-down').addClass('bbc-'+code);
            }
        }
        // console.log(code);
    });

    $('.bbcfont').click(function()
    {
        var field       = $(this).data('field');
        var selection   = $('textarea#'+field).selection();

        if(!selection)
            $.MessageBox("Must select some text first."); 

        if(selection)
        {
            // Custom DOM/jQuery Element
            var select = $("<select>", {
                css : {
                    "width"         : "100%",
                    "margin-top"    : "1rem"
                }
            });
            select.append("<option>Arial</option>");
            select.append("<option>Arial Black</option>");
            select.append("<option>Comic Sans MS</option>");
            select.append("<option>Courier New</option>");
            select.append("<option>Georgia</option>");
            select.append("<option>Impact</option>");
            select.append("<option>Sans-serif</option>");
            select.append("<option>Serif</option>");
            select.append("<option>Times New Roman</option>");
            select.append("<option>Trebuchet MS</option>");
            select.append("<option>Verdana</option>");
            $.MessageBox({
                message : "Choose a Font Family:",
                input   : select,
                buttonFail  : "Cancel",
            }).done(function(data){
                // console.log(data);
                $('textarea#'+field).selection('replace', { text: '[font='+data+']'+selection+'[/font]' });
            });
        }        
    });

    $('.bbccolor').click(function()
    {
        // A "wrapper" element will contain the inputs
        var wrapper  = $('<div>');

        var column1  = '<div class="sceditor-color-column" unselectable="on">'
            // column1 += '<a href="#" class="sceditor-color-option" style="background-color: #000000" data-color="#000000" unselectable="on"></a>'
            column1 += '<span class="sceditor-color-option" style="background-color: #000000" data-color="#000000" unselectable="on"></span>'
            column1 += '<a href="#" class="sceditor-color-option" style="background-color: #44B8FF" data-color="#44B8FF" unselectable="on"></a>'
            column1 += '<a href="#" class="sceditor-color-option" style="background-color: #1E92F7" data-color="#1E92F7" unselectable="on"></a>'
            column1 += '<a href="#" class="sceditor-color-option" style="background-color: #0074D9" data-color="#0074D9" unselectable="on"></a>'
            column1 += '<a href="#" class="sceditor-color-option" style="background-color: #005DC2" data-color="#005DC2" unselectable="on"></a>'
            column1 += '<a href="#" class="sceditor-color-option" style="background-color: #00369B" data-color="#00369B" unselectable="on"></a>'
            column1 += '<a href="#" class="sceditor-color-option" style="background-color: #b3d5f4" data-color="#b3d5f4" unselectable="on"></a>'
            column1 += '</div>'
        wrapper.append(column1);

        var column2  = '<div class="sceditor-color-column" unselectable="on">'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #444444" data-color="#444444" unselectable="on"></a>'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #C3FFFF" data-color="#C3FFFF" unselectable="on"></a>'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #9DF9FF" data-color="#9DF9FF" unselectable="on"></a>'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #7FDBFF" data-color="#7FDBFF" unselectable="on"></a>'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #68C4E8" data-color="#68C4E8" unselectable="on"></a>'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #419DC1" data-color="#419DC1" unselectable="on"></a>'
            column2 += '<a href="#" class="sceditor-color-option" style="background-color: #d9f4ff" data-color="#d9f4ff" unselectable="on"></a>'
            column2 += '</div>'
        wrapper.append(column2);
        
        var column3  = '<div class="sceditor-color-column" unselectable="on">'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #666666" data-color="#666666" unselectable="on"></a>'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #72FF84" data-color="#72FF84" unselectable="on"></a>'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #4CEA5E" data-color="#4CEA5E" unselectable="on"></a>'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #2ECC40" data-color="#2ECC40" unselectable="on"></a>'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #17B529" data-color="#17B529" unselectable="on"></a>'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #008E02" data-color="#008E02" unselectable="on"></a>'
            column3 += '<a href="#" class="sceditor-color-option" style="background-color: #c0f0c6" data-color="#c0f0c6" unselectable="on"></a>'
            column3 += '</div>'
        wrapper.append(column3);
        
        var column4  = '<div class="sceditor-color-column" unselectable="on">'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #888888" data-color="#888888" unselectable="on"></a>'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #FFFF44" data-color="#FFFF44" unselectable="on"></a>'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #FFFA1E" data-color="#FFFA1E" unselectable="on"></a>'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #FFDC00" data-color="#FFDC00" unselectable="on"></a>'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #E8C500" data-color="#E8C500" unselectable="on"></a>'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #C19E00" data-color="#C19E00" unselectable="on"></a>'
            column4 += '<a href="#" class="sceditor-color-option" style="background-color: #fff5b3" data-color="#fff5b3" unselectable="on"></a>'
            column4 += '</div>'
        wrapper.append(column4);

        var column5  = '<div class="sceditor-color-column" unselectable="on">'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #aaaaaa" data-color="#aaaaaa" unselectable="on"></a>'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #FFC95F" data-color="#FFC95F" unselectable="on"></a>'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #FFA339" data-color="#FFA339" unselectable="on"></a>'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #FF851B" data-color="#FF851B" unselectable="on"></a>'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #E86E04" data-color="#E86E04" unselectable="on"></a>'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #C14700" data-color="#C14700" unselectable="on"></a>'
            column5 += '<a href="#" class="sceditor-color-option" style="background-color: #ffdbbb" data-color="#ffdbbb" unselectable="on"></a>'
            column5 += '</div>'
        wrapper.append(column5);

        var column6  = '<div class="sceditor-color-column" unselectable="on">'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #cccccc" data-color="#cccccc" unselectable="on"></a>'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #FF857A" data-color="#FF857A" unselectable="on"></a>'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #FF5F54" data-color="#FF5F54" unselectable="on"></a>'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #FF4136" data-color="#FF4136" unselectable="on"></a>'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #E82A1F" data-color="#E82A1F" unselectable="on"></a>'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #C10300" data-color="#C10300" unselectable="on"></a>'
            column6 += '<a href="#" class="sceditor-color-option" style="background-color: #ffc6c3" data-color="#ffc6c3" unselectable="on"></a>'
            column6 += '</div>'
        wrapper.append(column6);

        var column7  = '<div class="sceditor-color-column" unselectable="on">'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #eeeeee" data-color="#eeeeee" unselectable="on"></a>'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #FF56FF" data-color="#FF56FF" unselectable="on"></a>'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #FF30DC" data-color="#FF30DC" unselectable="on"></a>'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #F012BE" data-color="#F012BE" unselectable="on"></a>'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #D900A7" data-color="#D900A7" unselectable="on"></a>'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #B20080" data-color="#B20080" unselectable="on"></a>'
            column7 += '<a href="#" class="sceditor-color-option" style="background-color: #fbb8ec" data-color="#fbb8ec" unselectable="on"></a>'
            column7 += '</div>'
        wrapper.append(column7);

        var column8  = '<div class="sceditor-color-column" unselectable="on">'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #ffffff" data-color="#ffffff" unselectable="on"></a>'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #F551FF" data-color="#F551FF" unselectable="on"></a>'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #CF2BE7" data-color="#CF2BE7" unselectable="on"></a>'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #B10DC9" data-color="#B10DC9" unselectable="on"></a>'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #9A00B2" data-color="#9A00B2" unselectable="on"></a>'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #9A00B2" data-color="#9A00B2" unselectable="on"></a>'
            column8 += '<a href="#" class="sceditor-color-option" style="background-color: #e8b6ef" data-color="#e8b6ef" unselectable="on"></a>'
            column8 += '</div>'
        wrapper.append(column8);

        $.MessageBox({
            input : wrapper,
            buttonDone   : 'Ok'
        }).done(function(data){
            console.log(data);
        });     
    });



    $.getScript('includes/js/scripts/bbcode/jquery.selection.js');
});