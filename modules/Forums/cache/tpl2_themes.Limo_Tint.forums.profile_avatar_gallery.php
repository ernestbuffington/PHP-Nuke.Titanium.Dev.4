<?php

// eXtreme Styles mod cache. Generated on Wed, 07 Apr 2021 07:45:54 +0000 (time=1617781554)

?><form action="<?php echo isset($this->vars['S_PROFILE_ACTION']) ? $this->vars['S_PROFILE_ACTION'] : $this->lang('S_PROFILE_ACTION'); ?>" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>

<table border="0" cellpadding="3" cellspacing="1" width="100%" class="forumline">
    <tr> 
      <th class="thHead" colspan="<?php echo isset($this->vars['S_COLSPAN']) ? $this->vars['S_COLSPAN'] : $this->lang('S_COLSPAN'); ?>" height="25" valign="middle"><?php echo isset($this->vars['L_AVATAR_GALLERY']) ? $this->vars['L_AVATAR_GALLERY'] : $this->lang('L_AVATAR_GALLERY'); ?></th>
    </tr>
    <tr> 
      <td class="catBottom" align="center" valign="middle" colspan="6" height="28"><span class="genmed"><?php echo isset($this->vars['L_CATEGORY']) ? $this->vars['L_CATEGORY'] : $this->lang('L_CATEGORY'); ?>:&nbsp;<?php echo isset($this->vars['S_CATEGORY_SELECT']) ? $this->vars['S_CATEGORY_SELECT'] : $this->lang('S_CATEGORY_SELECT'); ?>&nbsp;<input type="submit" class="liteoption" value="<?php echo isset($this->vars['L_GO']) ? $this->vars['L_GO'] : $this->lang('L_GO'); ?>" name="avatargallery" /></span></td>
    </tr>
    <?php

$avatar_row_count = ( isset($this->_tpldata['avatar_row.']) ) ?  sizeof($this->_tpldata['avatar_row.']) : 0;
for ($avatar_row_i = 0; $avatar_row_i < $avatar_row_count; $avatar_row_i++)
{
 $avatar_row_item = &$this->_tpldata['avatar_row.'][$avatar_row_i];
 $avatar_row_item['S_ROW_COUNT'] = $avatar_row_i;
 $avatar_row_item['S_NUM_ROWS'] = $avatar_row_count;

?>
    <tr> 
    <?php

$avatar_column_count = ( isset($avatar_row_item['avatar_column.']) ) ? sizeof($avatar_row_item['avatar_column.']) : 0;
for ($avatar_column_i = 0; $avatar_column_i < $avatar_column_count; $avatar_column_i++)
{
 $avatar_column_item = &$avatar_row_item['avatar_column.'][$avatar_column_i];
 $avatar_column_item['S_ROW_COUNT'] = $avatar_column_i;
 $avatar_column_item['S_NUM_ROWS'] = $avatar_column_count;

?>
        <td class="row1" align="center"><img src="<?php echo isset($avatar_column_item['AVATAR_IMAGE']) ? $avatar_column_item['AVATAR_IMAGE'] : ''; ?>" alt="<?php echo isset($avatar_column_item['AVATAR_NAME']) ? $avatar_column_item['AVATAR_NAME'] : ''; ?>" title="<?php echo isset($avatar_column_item['AVATAR_NAME']) ? $avatar_column_item['AVATAR_NAME'] : ''; ?>" /></td>
    <?php

} // END avatar_column

if(isset($avatar_column_item)) { unset($avatar_column_item); } 

?>
    </tr>
    <tr>
    <?php

$avatar_option_column_count = ( isset($avatar_row_item['avatar_option_column.']) ) ? sizeof($avatar_row_item['avatar_option_column.']) : 0;
for ($avatar_option_column_i = 0; $avatar_option_column_i < $avatar_option_column_count; $avatar_option_column_i++)
{
 $avatar_option_column_item = &$avatar_row_item['avatar_option_column.'][$avatar_option_column_i];
 $avatar_option_column_item['S_ROW_COUNT'] = $avatar_option_column_i;
 $avatar_option_column_item['S_NUM_ROWS'] = $avatar_option_column_count;

?>
        <td class="row2" align="center"><input type="checkbox" name="avatarselect" value="<?php echo isset($avatar_option_column_item['S_OPTIONS_AVATAR']) ? $avatar_option_column_item['S_OPTIONS_AVATAR'] : ''; ?>" /></td>
    <?php

} // END avatar_option_column

if(isset($avatar_option_column_item)) { unset($avatar_option_column_item); } 

?>
    </tr>

    <?php

} // END avatar_row

if(isset($avatar_row_item)) { unset($avatar_row_item); } 

?>
    <tr> 
      <td class="catBottom" colspan="<?php echo isset($this->vars['S_COLSPAN']) ? $this->vars['S_COLSPAN'] : $this->lang('S_COLSPAN'); ?>" align="center" height="28"><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?> 
        <input type="submit" name="submitavatar" value="<?php echo isset($this->vars['L_SELECT_AVATAR']) ? $this->vars['L_SELECT_AVATAR'] : $this->lang('L_SELECT_AVATAR'); ?>" class="mainoption" />
        &nbsp;&nbsp; 
        <input type="submit" name="cancelavatar" value="<?php echo isset($this->vars['L_RETURN_PROFILE']) ? $this->vars['L_RETURN_PROFILE'] : $this->lang('L_RETURN_PROFILE'); ?>" class="liteoption" />
      </td>
    </tr>
  </table>
</form>