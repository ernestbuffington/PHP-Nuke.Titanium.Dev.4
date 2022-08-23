nuke_jq(function($) 
{
    var bbcode = new Array();

    $('.bbcode').hover(function() 
    {
        var field = $(this).data('field');
        $('input[name=help]').val($(this).data('helpline'));
    }, function() 
    {
        var field = $(this).data('field');
        $('input[name=help]').val(message_help);
    });

    $(document).on('click','.forum-emoticon',function(event)
    {
        var text = $(this).data('id');
        var field = $(this).data('field');
        var message_body_val = $('#'+field).val();
        $('#'+field).focus();
        if(message_body_val) {
            $('#'+field).val(message_body_val+' '+text);                 
        } else {
            $('#'+field).val(text);      
        }
        // console.log(text);
    });

    /* ----- ordered & unordered list ----- */
    //bbc-list
    $('.bbc-list, .bbc-ordered-list').click(function()
    {
        var field       = $(this).data('field');
        var text        = $('textarea#'+field).val();
        var code        = $(this).data('bbcode');
        var codename    = $(this).data('name');
        var selection   = $('textarea#'+field).selection();
        lines           = selection.split(/\n/);
        opttext         = ""; 
        for(var i in lines) 
        {
            if(lines[i])
                opttext += "[*]"+lines[i]+"\n";
        }
        $('textarea#'+field).selection('replace', { text: "["+codename+"]\n"+$.trim(opttext)+"\n[/"+code+"]\n" });
    });

    /* ----- basic bbcode buttons ----- */ 
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

    /* ----- string alignment ----- */ 
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

    /* ----- font changer ----- */ 
    $('.bbcfont').click(function()
    {
        var field       = $(this).data('field');
        var selection   = $('textarea#'+field).selection();

        if(!selection)
            $.MessageBox(must_select); 

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
                message : font_family,
                input   : select,
                buttonFail  : buttonCancel,
            }).done(function(data){
                // console.log(data);
                $('textarea#'+field).selection('replace', { text: '[font='+data+']'+selection+'[/font]' });
            });
        }        
    });


    /* ----- font size changer ----- */ 
    $('.bbcfontsize').click(function()
    {
        var field       = $(this).data('field');
        var selection   = $('textarea#'+field).selection();

        if(!selection)
            $.MessageBox(must_select); 

        if(selection)
        {
            // Custom DOM/jQuery Element
            var select = $("<select>", {
                css : {
                    "width"         : "100%",
                    "margin-top"    : "1rem"
                }
            });

            select.append("<option>medium</option>");
            select.append("<option>xx-small</option>");
            select.append("<option>small</option>");
            select.append("<option>smaller</option>");
            select.append("<option>large</option>");
            select.append("<option>x-large</option>");
            select.append("<option>xx-large</option>");
            select.append("<option>xxx-large</option>");
            $.MessageBox({
                message : font_family,
                input   : select,
                buttonFail  : buttonCancel,
            }).done(function(data){
                // console.log(data);
                $('textarea#'+field).selection('replace', { text: '[size=' + data + ']'+selection+'[/size]' });
            });
        }        
    });

    /* ----- color changer ----- */ 
    $('.bbccolor').ColorPicker(
    {
        // color: $('#colorize').val(),
        onSubmit: function(hsb, hex, rgb, el) 
        {
            var field       = $('.bbccolor').data('field');
            var selection   = $('textarea#'+field).selection();
            if(!selection)
                $.MessageBox(must_select);
            else
            {
                $('textarea#'+field).selection('replace', { text: '[color=#'+hex+']'+selection+'[/color]' });
                $(el).ColorPickerHide();
            }
        }, onShow: function (colpkr) 
        {
            $(colpkr).fadeIn(500);
            return false;
        }, onHide: function (colpkr)
        {
            $(colpkr).fadeOut(500);
            return false;
        }, onChange: function (hsb, hex, rgb) 
        {
            var field       = $('.bbccolor').data('field');
            var selection   = $('textarea#'+field).selection();
        }
    });

    /* ----- highlight string ----- */
    $('.bbchighlight').ColorPicker(
    {
        onSubmit: function(hsb, hex, rgb, el) 
        { 
            var field       = $('.bbchighlight').data('field');
            var selection   = $('textarea#'+field).selection();
            if(!selection)
                $.MessageBox(must_select);
            else
            {
                $('textarea#'+field).selection('replace', { text: '[highlight=#'+hex+']'+$.trim(selection)+'[/highlight]' });
                $(el).ColorPickerHide();
            }
        }, onShow: function (colpkr) 
        {
            $(colpkr).fadeIn(500);
            return false;
        }, onHide: function (colpkr)
        {
            $(colpkr).fadeOut(500);
            return false;
        }, onChange: function (hsb, hex, rgb) 
        {
            var field       = $('.bbchighlight').data('field');
            var selection   = $('textarea#'+field).selection();
        }
    });

    /* ----- Horizontal Rule ----- */
    $('.bcchorizontalrule').click(function()
    {
        var field   = $(this).data('field');
        var text    = $('textarea#'+field).val();
        if(text)
            $('textarea#'+field).val($.trim(text)+"\n[hr]");
        else
            $('textarea#'+field).val('[hr]');
    });

    /* ----- url input ----- */
    /* ----- image input ----- */
    /* ----- email input ----- */
    $('.bbcpopup').click(function()
    {
        var field   = $(this).data('field');
        var text    = $('textarea#'+field).val();
        var code    = $(this).data('name');
        switch(code)
        {
            case 'url':
                $.MessageBox({
                    customClass : "bbc-input",
                    input   : {
                        url    : {
                            type        : "text",
                            label       : urlLabel
                        },
                        description    : {
                            type        : "text",
                            label       : desc_label
                        },
                    }
                    // message  : "URL"
                }).done(function(data)
                {
                    if (data.url)
                    {
                        if (data.description)
                        {
                            content = '['+code+'='+data.url+']'+data.description+'[/'+code+']'
                            if(text)
                                $('textarea#'+field).val(text +"\n"+ content);
                            else
                                $('textarea#'+field).val(content);
                        }
                        else
                        {
                            content = '['+code+'='+data.url+']'+data.url+'[/'+code+']'
                            if(text)
                                $('textarea#'+field).val(text +"\n"+ content);
                            else
                                $('textarea#'+field).val(content);
                        }
                    }
                    else
                    {
                        $.MessageBox(urlError);
                    }
                });
                break;
            case 'email':
                $.MessageBox({
                    customClass : "bbc-input",
                    input    : true,
                    message  : emailLabel
                }).done(function(data)
                {
                    if (data)
                    {
                        content = '['+code+']'+data+'[/'+code+']'
                        $('textarea#'+field).val(text + content);
                    }
                    else
                    {
                        $.MessageBox(emailError);
                    }
                });
                break;                
            default:
                $.MessageBox({
                    customClass : "bbc-input",
                    input   : {
                        text    : {
                            type        : "text",
                            label       : imageLabel
                        },
                        select : {
                            type    : "select",
                            label   : imageLocation,
                            title   : imageTitle,
                            options : [imageNewline, imageInline],
                            default : "Inline"
                        },
                    }
                })
                .done(function(data)
                {
                    if ($.trim(data.text)) 
                    {
                        content = '['+code+']'+data.text+'[/'+code+']'
                        switch (data.select) 
                        { 
                            case 'Add on a New Line':
                                if (text)
                                    $('textarea#'+field).val(text +"\n\n"+content);
                                else
                                    $('textarea#'+field).val(text + content);
                                break;
                            default:
                                $('textarea#'+field).val(text + content);
                        }
                    } 
                    else 
                    {
                        $.MessageBox(imageError);
                    }
                });
        }
    });


    $('.bbcvideo').click(function()
    {
        var field   = $(this).data('field');
        var text    = $('textarea#'+field).val();
        var code    = $(this).data('name');

        $.MessageBox({
            customClass : "bbc-input",
            buttonFail  : buttonCancel,
            input   : {
                select : {
                    type    : "select",
                    label   : videoType,
                    title   : imageTitle,
                    options : [videoFacebook, videoYoutube, videoTwitch],
                    default : "Youtube"
                },
                text    : {
                    type        : "text",
                    label       : videoLabel
                }
            }
        })
        .done(function(data)
        {           

            data.select = data.select.replace(/\s+/g, "-").toLowerCase();
            if(data.text)
            {                
                switch(data.select)
                {
                    case 'facebook':
                        content = '[video='+data.select.toLowerCase()+']'+data.text+'[/video]'
                        $('textarea#'+field).val(text + content);
                        break;
                    case 'youtube':
                        content = '[video='+data.select.toLowerCase()+']'+data.text+'[/video]'
                        $('textarea#'+field).val(text + content);
                        break;

                    case 'twitch':
                        content = '[video='+data.select.toLowerCase()+']'+data.text+'[/video]'
                        $('textarea#'+field).val(text + content);
                        break;
                }

            }
            else
            {
                $.MessageBox(videoError);
            }
        });
    });

    // $(".code_selection").click(function(e) 
    // {
    //     e.preventDefault();
    //     var selection = $( ".codebox code" );
    //     $( '.codebox' ).find(selection).selectText();
    // });

    // $(".php_selection").click(function(e) 
    // {
    //     e.preventDefault();
    //     var selection = $( ".codebox code" );
    //     selection.selectText();
    // });




    $.getScript('includes/js/scripts/bbcode/jquery.selection.js');
});