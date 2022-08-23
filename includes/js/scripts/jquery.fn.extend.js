nuke_jq(function($) 
{
    /* Check the users IP and return its country of origin. */
    // $.fn.countryFlag = function()
    // {
    //     $('[data-user-country]').each(function(i) 
    //     {
    //         $(this).each(function() 
    //         {
    //             // console.log($(this).data("user-country"));
    //         });
            
    //     });
    // };

    $.fn.selectText = function()
    {
        var doc = document;
        var element = this[0];

        // console.log(this, element);

        if (doc.body.createTextRange) 
        {
            var range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } 
        else if (window.getSelection) 
        {
            var selection = window.getSelection();        
            var range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    };


    $.fn.insertAtCaret = function(myValue) 
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
    };

    // This is for use with [code] & [php] bbcode select all function
    $(".code_selection").click(function(e) 
    {
        e.preventDefault();
        var selection = $( "code" );
        $(this).parent().parent().find(selection).selectText();
    });
});