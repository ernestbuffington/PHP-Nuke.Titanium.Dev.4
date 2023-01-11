<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 14:44:57 +0000 (time=1672325097)

?><script>
function emoticon(text) {
        text = ' ' + text + ' ';
        PostWrite(text);
}
function storeCaret(textEl) {
        if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

function PostWrite(text) {
        if (document.post.message.createTextRange && document.post.message.caretPos) {
                var caretPos = document.post.message.caretPos;
                caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?        text + ' ' : text;
        }
        else document.post.message.value += text;
        document.post.message.focus(caretPos)
}
</script>
<table border="0" cellpadding="3" cellspacing="4" width="100%">
<td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span>
<span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['NAV_DESC']) ? $this->vars['NAV_DESC'] : $this->lang('NAV_DESC'); ?></span>
<span class="nav">&nbsp;->&nbsp;<?php echo isset($this->vars['L_ARCADE_COMMENTS']) ? $this->vars['L_ARCADE_COMMENTS'] : $this->lang('L_ARCADE_COMMENTS'); ?></span>
</td>
</table>

<table width="100%" cellpadding="5" cellspacing="1" border="0" class="forumline" align="center">
  <tr> 
          <th colspan='2' class="row4"><span class="cattitle"><?php echo isset($this->vars['L_CONGRATS']) ? $this->vars['L_CONGRATS'] : $this->lang('L_CONGRATS'); ?></span></th>
  </tr>
        <tr>
                <td colspan='2'align='center' class='row2'><?php echo isset($this->vars['L_COMMENTS_CHAMPION']) ? $this->vars['L_COMMENTS_CHAMPION'] : $this->lang('L_COMMENTS_CHAMPION'); ?></td>
        </tr>

<form action="<?php echo isset($this->vars['S_ACTION']) ? $this->vars['S_ACTION'] : $this->lang('S_ACTION'); ?>" method="post" name="post" >
        <tr>
                <td ROWSPAN=2 class='row2' valign="middle" align="center"> <br />
                          <table width="100" border="0" cellspacing="0" cellpadding="5">
                                <tr align="center">
                                  <td colspan="<?php echo isset($this->vars['S_SMILIES_COLSPAN']) ? $this->vars['S_SMILIES_COLSPAN'] : $this->lang('S_SMILIES_COLSPAN'); ?>" class="gensmall"><strong><?php echo isset($this->vars['L_EMOTICONS']) ? $this->vars['L_EMOTICONS'] : $this->lang('L_EMOTICONS'); ?></strong></td>
                                </tr>
                                <?php

$smilies_row_count = ( isset($this->_tpldata['smilies_row.']) ) ?  sizeof($this->_tpldata['smilies_row.']) : 0;
for ($smilies_row_i = 0; $smilies_row_i < $smilies_row_count; $smilies_row_i++)
{
 $smilies_row_item = &$this->_tpldata['smilies_row.'][$smilies_row_i];
 $smilies_row_item['S_ROW_COUNT'] = $smilies_row_i;
 $smilies_row_item['S_NUM_ROWS'] = $smilies_row_count;

?>
                                <tr align="center" valign="middle">
                                  <?php

$smilies_col_count = ( isset($smilies_row_item['smilies_col.']) ) ? sizeof($smilies_row_item['smilies_col.']) : 0;
for ($smilies_col_i = 0; $smilies_col_i < $smilies_col_count; $smilies_col_i++)
{
 $smilies_col_item = &$smilies_row_item['smilies_col.'][$smilies_col_i];
 $smilies_col_item['S_ROW_COUNT'] = $smilies_col_i;
 $smilies_col_item['S_NUM_ROWS'] = $smilies_col_count;

?>
                                  <td><img src="<?php echo isset($smilies_col_item['SMILEY_IMG']) ? $smilies_col_item['SMILEY_IMG'] : ''; ?>" border="0" onmouseover="this.style.cursor='hand';" onclick="emoticon('<?php echo isset($smilies_col_item['SMILEY_CODE']) ? $smilies_col_item['SMILEY_CODE'] : ''; ?>');" alt="<?php echo isset($smilies_col_item['SMILEY_DESC']) ? $smilies_col_item['SMILEY_DESC'] : ''; ?>" title="<?php echo isset($smilies_col_item['SMILEY_DESC']) ? $smilies_col_item['SMILEY_DESC'] : ''; ?>" /></a></td>
                                  <?php

} // END smilies_col

if(isset($smilies_col_item)) { unset($smilies_col_item); } 

?>
                                </tr>
                                <?php

} // END smilies_row

if(isset($smilies_row_item)) { unset($smilies_row_item); } 

?>
                                <?php

$switch_smilies_extra_count = ( isset($this->_tpldata['switch_smilies_extra.']) ) ?  sizeof($this->_tpldata['switch_smilies_extra.']) : 0;
for ($switch_smilies_extra_i = 0; $switch_smilies_extra_i < $switch_smilies_extra_count; $switch_smilies_extra_i++)
{
 $switch_smilies_extra_item = &$this->_tpldata['switch_smilies_extra.'][$switch_smilies_extra_i];
 $switch_smilies_extra_item['S_ROW_COUNT'] = $switch_smilies_extra_i;
 $switch_smilies_extra_item['S_NUM_ROWS'] = $switch_smilies_extra_count;

?>
                                <tr align="center">
                                  <td colspan="<?php echo isset($this->vars['S_SMILIES_COLSPAN']) ? $this->vars['S_SMILIES_COLSPAN'] : $this->lang('S_SMILIES_COLSPAN'); ?>"><span  class="nav"><a href="<?php echo isset($this->vars['U_MORE_SMILIES']) ? $this->vars['U_MORE_SMILIES'] : $this->lang('U_MORE_SMILIES'); ?>" onclick="window.open('<?php echo isset($this->vars['U_MORE_SMILIES']) ? $this->vars['U_MORE_SMILIES'] : $this->lang('U_MORE_SMILIES'); ?>', '_phpbbsmilies', 'HEIGHT=300,resizable=yes,scrollbars=yes,WIDTH=250');return false;" target="_phpbbsmilies" class="nav"><?php echo isset($this->vars['L_MORE_SMILIES']) ? $this->vars['L_MORE_SMILIES'] : $this->lang('L_MORE_SMILIES'); ?></a></span></td>
                                </tr>
                                <?php

} // END switch_smilies_extra

if(isset($switch_smilies_extra_item)) { unset($switch_smilies_extra_item); } 

?>
                          </table>
                        </td>
                <td align='center' class='row2'><textarea NAME='message' ROWS='5' COLS='60' wrap='virtual'><?php echo isset($this->vars['COMMENTS']) ? $this->vars['COMMENTS'] : $this->lang('COMMENTS'); ?></textarea></td>
        </tr>
                <input type=hidden name='comment_id' value='<?php echo isset($this->vars['GAME_ID']) ? $this->vars['GAME_ID'] : $this->lang('GAME_ID'); ?>'>
        <tr>
                <td align='center' class='row2'><input type='submit' name='submit' value='Submit' class='mainoption' /></td>
        </tr>
</form>
        <tr>
                <td colspan='2'align='center' class='row2'><?php echo isset($this->vars['L_NO_COMMENT']) ? $this->vars['L_NO_COMMENT'] : $this->lang('L_NO_COMMENT'); ?></td>
        </tr>
<tr> 
          <th class="row4" colspan='2' ><span class="cattitle"><?php echo isset($this->vars['L_QUICK_STATS']) ? $this->vars['L_QUICK_STATS'] : $this->lang('L_QUICK_STATS'); ?></span></th>
  </tr>
        <tr>
                <td colspan='2' class='row2' align="center"> <?php echo isset($this->vars['USER_AVATAR']) ? $this->vars['USER_AVATAR'] : $this->lang('USER_AVATAR'); ?><br />
                        <?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?><br />
                        <?php echo isset($this->vars['L_QUICK_STATS_MESSAGE']) ? $this->vars['L_QUICK_STATS_MESSAGE'] : $this->lang('L_QUICK_STATS_MESSAGE'); ?></td>
        </tr>
</table>
<br />