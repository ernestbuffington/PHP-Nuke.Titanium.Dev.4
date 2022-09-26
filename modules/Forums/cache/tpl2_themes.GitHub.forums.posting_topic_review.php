<?php

// eXtreme Styles mod cache. Generated on Mon, 26 Sep 2022 04:41:14 +0000 (time=1664167274)

?><script language="JavaScript" type="text/javascript">
<!--
message = new Array();
<?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>
message[<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>] = "[quote=\"<?php echo isset($postrow_item['EXT_POSTER_NAME']) ? $postrow_item['EXT_POSTER_NAME'] : ''; ?>\";p=\"<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>\"]\n<?php echo isset($postrow_item['PLAIN_MESSAGE']) ? $postrow_item['PLAIN_MESSAGE'] : ''; ?>\n[/quote]";
<?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>

function addquote(post_id)
{
    window.parent.document.post.message.value += message[post_id];
    window.parent.document.post.message.focus();
    return;
}

//-->
</script>
<?php

$switch_inline_mode_count = ( isset($this->_tpldata['switch_inline_mode.']) ) ?  sizeof($this->_tpldata['switch_inline_mode.']) : 0;
for ($switch_inline_mode_i = 0; $switch_inline_mode_i < $switch_inline_mode_count; $switch_inline_mode_i++)
{
 $switch_inline_mode_item = &$this->_tpldata['switch_inline_mode.'][$switch_inline_mode_i];
 $switch_inline_mode_item['S_ROW_COUNT'] = $switch_inline_mode_i;
 $switch_inline_mode_item['S_NUM_ROWS'] = $switch_inline_mode_count;

?>
<table style="width: 100%; table-layout: fixed" align="center" border="0" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
    <td class="catHead" style="font-weight: bold; height: 30px; text-align: center;"><?php echo isset($this->vars['L_TOPIC_REVIEW']) ? $this->vars['L_TOPIC_REVIEW'] : $this->lang('L_TOPIC_REVIEW'); ?></td>
  </tr>
  <tr>
    <td class="row1">
      <div style="min-height: 400px; height: 400px !important; overflow: auto; line-height: 1.5em; resize: none;">
    <!-- <iframe width="100%" height="300" src="<?php echo isset($this->vars['U_REVIEW_TOPIC']) ? $this->vars['U_REVIEW_TOPIC'] : $this->lang('U_REVIEW_TOPIC'); ?>" > -->
<?php

} // END switch_inline_mode

if(isset($switch_inline_mode_item)) { unset($switch_inline_mode_item); } 

?>
      <table style="width: 100%; table-layout: fixed" border="0" cellpadding="3" cellspacing="1" class="forumline">
        <tr>
          <td class="catHead" style="height: 30px; width: 22%;"><?php echo isset($this->vars['L_AUTHOR']) ? $this->vars['L_AUTHOR'] : $this->lang('L_AUTHOR'); ?></td>
          <td class="catHead" style="height: 30px; width: 78%;"><?php echo isset($this->vars['L_MESSAGE']) ? $this->vars['L_MESSAGE'] : $this->lang('L_MESSAGE'); ?></td>
        </tr>
        <?php

$postrow_count = ( isset($this->_tpldata['postrow.']) ) ?  sizeof($this->_tpldata['postrow.']) : 0;
for ($postrow_i = 0; $postrow_i < $postrow_count; $postrow_i++)
{
 $postrow_item = &$this->_tpldata['postrow.'][$postrow_i];
 $postrow_item['S_ROW_COUNT'] = $postrow_i;
 $postrow_item['S_NUM_ROWS'] = $postrow_count;

?>
        <tr>
          <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" style="height: 30px; width: 22%; vertical-align: top;"><a name="<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>"></a><?php echo isset($postrow_item['POSTER_NAME']) ? $postrow_item['POSTER_NAME'] : ''; ?></td>
          <td class="<?php echo isset($postrow_item['ROW_CLASS']) ? $postrow_item['ROW_CLASS'] : ''; ?>" style="height: 30px; width: 78%;" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed">
              <tr> 
                <td width="80%"><img src="<?php echo isset($postrow_item['MINI_POST_IMG']) ? $postrow_item['MINI_POST_IMG'] : ''; ?>" width="12" height="9" alt="<?php echo isset($postrow_item['L_MINI_POST_ALT']) ? $postrow_item['L_MINI_POST_ALT'] : ''; ?>" title="<?php echo isset($postrow_item['L_MINI_POST_ALT']) ? $postrow_item['L_MINI_POST_ALT'] : ''; ?>" border="0" /><?php echo isset($this->vars['L_POSTED']) ? $this->vars['L_POSTED'] : $this->lang('L_POSTED'); ?>:&nbsp;<?php echo isset($postrow_item['POST_DATE']) ? $postrow_item['POST_DATE'] : ''; ?>&nbsp;&nbsp;&nbsp;<?php echo isset($this->vars['L_POST_SUBJECT']) ? $this->vars['L_POST_SUBJECT'] : $this->lang('L_POST_SUBJECT'); ?>:&nbsp;<?php echo isset($postrow_item['POST_SUBJECT']) ? $postrow_item['POST_SUBJECT'] : ''; ?></td>
                <td width="20%" valign="top" align="right" nowrap="nowrap"><input style="cursor: pointer;" type="button" class="button" name="addquote" value="Quote" style="width: 50px" onclick="addquote(<?php echo isset($postrow_item['U_POST_ID']) ? $postrow_item['U_POST_ID'] : ''; ?>);" /></td>
              </tr>
              <tr> 
                <td colspan="2"><hr /></td>
              </tr>
              <tr> 
                <td colspan="2"><span class="postbody"><?php echo isset($postrow_item['MESSAGE']) ? $postrow_item['MESSAGE'] : ''; ?></span><?php echo isset($postrow_item['ATTACHMENTS']) ? $postrow_item['ATTACHMENTS'] : ''; ?></td>
              </tr>
              
            </table>
          </td>
        </tr>
        <tr> 
                <td colspan="2" class="row1" style="height:10px">&nbsp;</td>
              </tr>
        <?php

} // END postrow

if(isset($postrow_item)) { unset($postrow_item); } 

?>
      </table>

      <?php

$switch_inline_mode_count = ( isset($this->_tpldata['switch_inline_mode.']) ) ?  sizeof($this->_tpldata['switch_inline_mode.']) : 0;
for ($switch_inline_mode_i = 0; $switch_inline_mode_i < $switch_inline_mode_count; $switch_inline_mode_i++)
{
 $switch_inline_mode_item = &$this->_tpldata['switch_inline_mode.'][$switch_inline_mode_i];
 $switch_inline_mode_item['S_ROW_COUNT'] = $switch_inline_mode_i;
 $switch_inline_mode_item['S_NUM_ROWS'] = $switch_inline_mode_count;

?>
    <!-- </iframe> -->
      </div>
    </td>
  </tr>
  <tr> 
    <td class="catBottom"></td>
  </tr>
</table>

<?php

} // END switch_inline_mode

if(isset($switch_inline_mode_item)) { unset($switch_inline_mode_item); } 

?>