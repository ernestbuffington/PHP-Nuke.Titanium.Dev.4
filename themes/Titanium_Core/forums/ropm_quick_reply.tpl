<!-- BEGIN ROPM_QUICK_REPLY -->
</form>
<script>
var theSelection = false;
function quoteSelection()
{
    if (document.getSelection) 
        txt = document.getSelection();
    else if (document.selection) 
        txt = document.selection.createRange().text;
    else 
        return;

    theSelection = txt.replace(new RegExp('([\\f\\n\\r\\t\\v ])+', 'g')," ");
    if (theSelection) 
    {
        // Add tags around selection
        emoticon( '[quote]\n' + theSelection + '\n[/quote]\n');
        document.post.message.focus();
        theSelection = '';
        return;
    }
    else
    {
        alert('{L_NO_TEXT_SELECTED}');
    }
}
</script>

<form action="{ROPM_QUICK_REPLY.POST_ACTION}" method="post" name="post">
<tr> 
  <td colspan="3" style="height:30px; text-align:center;" class="catHead" colspan="2"><span style="font-weight:bold; text-transform: uppercase;">{L_QUICK_REPLY}</span></th>
</tr>
<tr>
  <td class="row1" style="width: 22%;">{L_SUBJECT}</td>
  <td class="row1" colspan="2" style="width: 78%;"><input type="text" name="subject" maxlength="60" style="width:98.8%;" tabindex="2" class="post" value="{ROPM_QUICK_REPLY.SUBJECT}" /><br /></td>
</tr>
<tr>
  <td class="row1" colspan="3">{ROPM_QUICK_REPLY.BB_BOX}</td>
</tr>
<tr>
  <td align="right" class="row1" valign="top">{L_OPTIONS}</td>
  <td class="row2" colspan="2" valign="top">
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
    <input type="checkbox" name="attach_sig"{ROPM_QUICK_REPLY.S_SIG_CHECKED} />&nbsp;{L_ATTACH_SIGNATURE}<br />
  </td>
</tr>
<tr>
<td class="catBottom" colspan="3" align="center" height="28">
    {ROPM_QUICK_REPLY.S_HIDDEN_FIELDS}
    <input type="submit" tabindex="5" name="preview" id="preview" class="mainoption" value="{L_PREVIEW}" />
    <input type="submit" id="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="{L_SUBMIT}" />
</td>
</tr>
</form>
<!-- END ROPM_QUICK_REPLY -->