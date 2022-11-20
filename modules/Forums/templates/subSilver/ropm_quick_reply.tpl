<!-- BEGIN ROPM_QUICK_REPLY -->
</form>
<script>
var theSelection = false;
    function openAllSmiles(){
        smiles = window.open('modules.php?name=Forums&file=posting&mode=smilies&popup=1', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=500');
        smiles.focus();
        return false;
    }
function quoteSelection()
{
        if (document.getSelection) txt = document.getSelection();
    else if (document.selection) txt = document.selection.createRange().text;
    else return;

    theSelection = txt.replace(new RegExp('([\\f\\n\\r\\t\\v ])+', 'g')," ");
        if (theSelection) {
            // Add tags around selection
            emoticon( '[quote]\n' + theSelection + '\n[/quote]\n');
            document.post.message.focus();
            theSelection = '';
            return;
        }else{
            alert('{L_NO_TEXT_SELECTED}');
        }
}

    function storeCaret(textEl) {
        if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
    }

    function emoticon(text) {
        text = ' ' + text + ' ';
        if (document.post.message.createTextRange && document.post.message.caretPos) {
            var caretPos = document.post.message.caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
            document.post.message.focus();
        } else {
            document.post.message.value  += text;
            document.post.message.focus();
        }
    }

    function checkForm() {
        formErrors = false;
        if (document.post.message.value.length < 2) {
            formErrors = '{L_EMPTY_MESSAGE}';
        }
        if (!document.post.subject.value) {
                   formErrors += '{L_EMPTY_SUBJECT}';
                }
                if (formErrors) {
            alert(formErrors);
            return false;
        } else {
            if (document.post.quick_quote.checked) {
                document.post.message.value = document.post.last_msg.value + document.post.message.value;
            } 
            document.post.quick_quote.checked = false;
            return true;
        }
    }
</script>
<tr>
<th colspan="3" height="25" style="padding: 0px"><strong>{L_QUICK_REPLY}</strong></th>
</tr>
<tr>
<td align="right" class="row1" valign="top"><span class="gen"><strong>{L_SUBJECT}:</strong></span></td>
<td class="row2" colspan="2" valign="top">
<form action="{ROPM_QUICK_REPLY.POST_ACTION}" method="post" name="post" onsubmit="return checkForm(this)">
<input type="text" name="subject" size="45" maxlength="60" style="width:450px" tabindex="2" class="post" value="{ROPM_QUICK_REPLY.SUBJECT}" /><br /></td></tr>
<tr><td align="right" class="row1" valign="top"><span class="gen"><strong>{L_MESSAGE}:</strong></span></td>
<td class="row1" colspan="2" valign="top" style="padding-top: 0px; padding-bottom: 0px">
<textarea name="message" style="width:450px; height: 140px;" wrap="virtual" tabindex="3" class="post" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);"></textarea><br />
<!-- BEGIN SMILIES -->
<img src="{ROPM_QUICK_REPLY.SMILIES.URL}" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('{ROPM_QUICK_REPLY.SMILIES.CODE}');" alt="{ROPM_QUICK_REPLY.SMILIES.DESC}" title="{ROPM_QUICK_REPLY.SMILIES.DESC}" />
<!-- END SMILIES -->
<INPUT TYPE=button CLASS=BUTTON NAME="SmilesButt" VALUE="{L_ALL_SMILIES}" ONCLICK="openAllSmiles();">
                <br />
                <input type='button' name='quoteselected' class='liteoption' value='{L_QUOTE_SELECTED}' onclick='javascript:quoteSelection()'></td>
</td></tr>
<tr><td align="right" class="row1" valign="top"><span class="gen"><strong>{L_OPTIONS}:</strong></span></td>
<td class="row2" colspan="2" valign="top"><span class="gensmall">
<input type="checkbox" name="quick_quote" />&nbsp;{L_QUOTE_LAST_MESSAGE}<br />
<!-- BEGIN HTMLCB -->
<input type="checkbox" name="disable_html"{ROPM_QUICK_REPLY.S_HTML_CHECKED} />&nbsp;{L_DISABLE_HTML}<br />
<!-- END HTMLCB -->
<!-- BEGIN BBCODECB -->
<input type="checkbox" name="disable_bbcode"{ROPM_QUICK_REPLY.S_BBCODE_CHECKED} />&nbsp;{L_DISABLE_BBCODE}<br />
<!-- END BBCODECB -->
<!-- BEGIN SMILIESCB -->
<input type="checkbox" name="disable_smilies"{ROPM_QUICK_REPLY.S_SMILIES_CHECKED} />&nbsp;{L_DISABLE_SMILIES}<br />
<!-- END SMILIESCB -->
<input type="checkbox" name="attach_sig"{ROPM_QUICK_REPLY.S_SIG_CHECKED} />&nbsp;{L_ATTACH_SIGNATURE}<br /></span></td>
</tr>
<tr>
<td class="catBottom" colspan="3" align="center" height="28">{ROPM_QUICK_REPLY.S_HIDDEN_FIELDS}<input type="submit" tabindex="5" name="preview" class="mainoption" value="{L_PREVIEW}" />&nbsp;<input type="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" /></td>
</tr>
</form>
<!-- END ROPM_QUICK_REPLY -->