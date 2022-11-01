<?php

// eXtreme Styles mod cache. Generated on Tue, 01 Nov 2022 04:58:36 +0000 (time=1667278716)

?><?php

$ROPM_QUICK_REPLY_count = ( isset($this->_tpldata['ROPM_QUICK_REPLY.']) ) ?  sizeof($this->_tpldata['ROPM_QUICK_REPLY.']) : 0;
for ($ROPM_QUICK_REPLY_i = 0; $ROPM_QUICK_REPLY_i < $ROPM_QUICK_REPLY_count; $ROPM_QUICK_REPLY_i++)
{
 $ROPM_QUICK_REPLY_item = &$this->_tpldata['ROPM_QUICK_REPLY.'][$ROPM_QUICK_REPLY_i];
 $ROPM_QUICK_REPLY_item['S_ROW_COUNT'] = $ROPM_QUICK_REPLY_i;
 $ROPM_QUICK_REPLY_item['S_NUM_ROWS'] = $ROPM_QUICK_REPLY_count;

?>
</form>
<script language="JavaScript" type="text/javascript">
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
        alert('<?php echo isset($this->vars['L_NO_TEXT_SELECTED']) ? $this->vars['L_NO_TEXT_SELECTED'] : $this->lang('L_NO_TEXT_SELECTED'); ?>');
    }
}
</script>

<form action="<?php echo isset($ROPM_QUICK_REPLY_item['POST_ACTION']) ? $ROPM_QUICK_REPLY_item['POST_ACTION'] : ''; ?>" method="post" name="post">
<tr> 
  <td colspan="3" style="height:30px; text-align:center;" class="catHead" colspan="2"><span style="font-weight:bold; text-transform: uppercase;"><?php echo isset($this->vars['L_QUICK_REPLY']) ? $this->vars['L_QUICK_REPLY'] : $this->lang('L_QUICK_REPLY'); ?></span></th>
</tr>
<tr>
  <td class="row1" style="width: 22%;"><?php echo isset($this->vars['L_SUBJECT']) ? $this->vars['L_SUBJECT'] : $this->lang('L_SUBJECT'); ?></td>
  <td class="row1" colspan="2" style="width: 78%;"><input type="text" name="subject" maxlength="60" style="width:98.8%;" tabindex="2" class="post" value="<?php echo isset($ROPM_QUICK_REPLY_item['SUBJECT']) ? $ROPM_QUICK_REPLY_item['SUBJECT'] : ''; ?>" /><br /></td>
</tr>
<tr>
  <td class="row1" colspan="3"><?php echo isset($ROPM_QUICK_REPLY_item['BB_BOX']) ? $ROPM_QUICK_REPLY_item['BB_BOX'] : ''; ?></td>
</tr>
<tr>
  <td align="right" class="row1" valign="top"><?php echo isset($this->vars['L_OPTIONS']) ? $this->vars['L_OPTIONS'] : $this->lang('L_OPTIONS'); ?></td>
  <td class="row2" colspan="2" valign="top">
    <input type="checkbox" name="quick_quote" />&nbsp;<?php echo isset($this->vars['L_QUOTE_LAST_MESSAGE']) ? $this->vars['L_QUOTE_LAST_MESSAGE'] : $this->lang('L_QUOTE_LAST_MESSAGE'); ?><br />
    <?php

$HTMLCB_count = ( isset($ROPM_QUICK_REPLY_item['HTMLCB.']) ) ? sizeof($ROPM_QUICK_REPLY_item['HTMLCB.']) : 0;
for ($HTMLCB_i = 0; $HTMLCB_i < $HTMLCB_count; $HTMLCB_i++)
{
 $HTMLCB_item = &$ROPM_QUICK_REPLY_item['HTMLCB.'][$HTMLCB_i];
 $HTMLCB_item['S_ROW_COUNT'] = $HTMLCB_i;
 $HTMLCB_item['S_NUM_ROWS'] = $HTMLCB_count;

?>
    <input type="checkbox" name="disable_html"<?php echo isset($ROPM_QUICK_REPLY_item['S_HTML_CHECKED']) ? $ROPM_QUICK_REPLY_item['S_HTML_CHECKED'] : ''; ?> />&nbsp;<?php echo isset($this->vars['L_DISABLE_HTML']) ? $this->vars['L_DISABLE_HTML'] : $this->lang('L_DISABLE_HTML'); ?><br />
    <?php

} // END HTMLCB

if(isset($HTMLCB_item)) { unset($HTMLCB_item); } 

?>
    <?php

$BBCODECB_count = ( isset($ROPM_QUICK_REPLY_item['BBCODECB.']) ) ? sizeof($ROPM_QUICK_REPLY_item['BBCODECB.']) : 0;
for ($BBCODECB_i = 0; $BBCODECB_i < $BBCODECB_count; $BBCODECB_i++)
{
 $BBCODECB_item = &$ROPM_QUICK_REPLY_item['BBCODECB.'][$BBCODECB_i];
 $BBCODECB_item['S_ROW_COUNT'] = $BBCODECB_i;
 $BBCODECB_item['S_NUM_ROWS'] = $BBCODECB_count;

?>
    <input type="checkbox" name="disable_bbcode"<?php echo isset($ROPM_QUICK_REPLY_item['S_BBCODE_CHECKED']) ? $ROPM_QUICK_REPLY_item['S_BBCODE_CHECKED'] : ''; ?> />&nbsp;<?php echo isset($this->vars['L_DISABLE_BBCODE']) ? $this->vars['L_DISABLE_BBCODE'] : $this->lang('L_DISABLE_BBCODE'); ?><br />
    <?php

} // END BBCODECB

if(isset($BBCODECB_item)) { unset($BBCODECB_item); } 

?>
    <?php

$SMILIESCB_count = ( isset($ROPM_QUICK_REPLY_item['SMILIESCB.']) ) ? sizeof($ROPM_QUICK_REPLY_item['SMILIESCB.']) : 0;
for ($SMILIESCB_i = 0; $SMILIESCB_i < $SMILIESCB_count; $SMILIESCB_i++)
{
 $SMILIESCB_item = &$ROPM_QUICK_REPLY_item['SMILIESCB.'][$SMILIESCB_i];
 $SMILIESCB_item['S_ROW_COUNT'] = $SMILIESCB_i;
 $SMILIESCB_item['S_NUM_ROWS'] = $SMILIESCB_count;

?>
    <input type="checkbox" name="disable_smilies"<?php echo isset($ROPM_QUICK_REPLY_item['S_SMILIES_CHECKED']) ? $ROPM_QUICK_REPLY_item['S_SMILIES_CHECKED'] : ''; ?> />&nbsp;<?php echo isset($this->vars['L_DISABLE_SMILIES']) ? $this->vars['L_DISABLE_SMILIES'] : $this->lang('L_DISABLE_SMILIES'); ?><br />
    <?php

} // END SMILIESCB

if(isset($SMILIESCB_item)) { unset($SMILIESCB_item); } 

?>
    <input type="checkbox" name="attach_sig"<?php echo isset($ROPM_QUICK_REPLY_item['S_SIG_CHECKED']) ? $ROPM_QUICK_REPLY_item['S_SIG_CHECKED'] : ''; ?> />&nbsp;<?php echo isset($this->vars['L_ATTACH_SIGNATURE']) ? $this->vars['L_ATTACH_SIGNATURE'] : $this->lang('L_ATTACH_SIGNATURE'); ?><br />
  </td>
</tr>
<tr>
<td class="catBottom" colspan="3" align="center" height="28">
    <?php echo isset($ROPM_QUICK_REPLY_item['S_HIDDEN_FIELDS']) ? $ROPM_QUICK_REPLY_item['S_HIDDEN_FIELDS'] : ''; ?>
    <input type="submit" tabindex="5" name="preview" id="preview" class="mainoption" value="<?php echo isset($this->vars['L_PREVIEW']) ? $this->vars['L_PREVIEW'] : $this->lang('L_PREVIEW'); ?>" />
    <input type="submit" id="submit" accesskey="s" tabindex="6" name="post" class="mainoption" value="<?php echo isset($this->vars['L_SUBMIT']) ? $this->vars['L_SUBMIT'] : $this->lang('L_SUBMIT'); ?>" />
</td>
</tr>
</form>
<?php

} // END ROPM_QUICK_REPLY

if(isset($ROPM_QUICK_REPLY_item)) { unset($ROPM_QUICK_REPLY_item); } 

?>