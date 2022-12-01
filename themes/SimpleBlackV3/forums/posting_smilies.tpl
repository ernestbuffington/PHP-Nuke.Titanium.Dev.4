<script>
<!--
function emoticon(text) 
{
    text = ' ' + text + ' ';
    if (opener.document.forms['post'].message.createTextRange && opener.document.forms['post'].message.caretPos) 
    {
        var caretPos = opener.document.forms['post'].message.caretPos;
        caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
        opener.document.forms['post'].message.focus();
    } 
    else 
    {
        opener.document.forms['post'].message.value  += text;
        opener.document.forms['post'].message.focus();
    }
}
//-->
</script>

<table border="0" cellpadding="3" cellspacing="1" style="width: 100%;" class="forumline">
  <tr>
    <td class="catHead" style="height:30px; text-align:center; font-weight:bold; text-transform: uppercase;">{L_EMOTICONS}</td>
  </tr>
  <tr>
    <td class="row1">
      <table border="0" cellpadding="3" cellspacing="1" style="width: 100%;" class="forumline">
        <!-- BEGIN smilies_row -->
        <tr>
          <!-- BEGIN smilies_col -->
          <td class="row1" style="text-align: center;"><a href="javascript:emoticon('{smilies_row.smilies_col.SMILEY_CODE}')"><img src="{smilies_row.smilies_col.SMILEY_IMG}" border="0" alt="{smilies_row.smilies_col.SMILEY_DESC}" title="{smilies_row.smilies_col.SMILEY_DESC}" /></a></td>
          <!-- END smilies_col -->
        </tr>
        <!-- END smilies_row -->
        <!-- BEGIN switch_smilies_extra -->
        <tr> 
          <td class="row1" colspan="{S_SMILIES_COLSPAN}" style="text-align: center;"><span  class="nav"><a href="{U_MORE_SMILIES}" onclick="open_window('{U_MORE_SMILIES}', 700, 300); return false" target="_smilies" class="nav">{L_MORE_SMILIES}</a></td>
        </tr>
        <!-- END switch_smilies_extra -->
      </table>
    </td>
  </tr>
  <tr>
    <td class="catBottom" style="text-align: center;"><a href="javascript:window.close();" class="genmed">{L_CLOSE_WINDOW}</a></td>
  </tr>
</table>