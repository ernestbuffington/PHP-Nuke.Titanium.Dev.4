<?php

// eXtreme Styles mod cache. Generated on Fri, 28 May 2021 06:17:37 +0000 (time=1622182657)

?><table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
    <tr> 
      <th class="thCornerL" height="25"><?php echo isset($this->vars['L_PM']) ? $this->vars['L_PM'] : $this->lang('L_PM'); ?></th>
      <th class="thTop"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></th>
      <th class="thTop"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?></th>
      <th class="thTop"><?php echo isset($this->vars['L_FROM']) ? $this->vars['L_FROM'] : $this->lang('L_FROM'); ?></th>
      <th class="thTop"><?php echo isset($this->vars['L_EMAIL']) ? $this->vars['L_EMAIL'] : $this->lang('L_EMAIL'); ?></th>
      <th class="thTop"><?php echo isset($this->vars['L_ONLINE_STATUS']) ? $this->vars['L_ONLINE_STATUS'] : $this->lang('L_ONLINE_STATUS'); ?></th>
      <th class="thTop"><?php echo isset($this->vars['L_WEBSITE']) ? $this->vars['L_WEBSITE'] : $this->lang('L_WEBSITE'); ?></th>
      <th class="thCornerR"><?php echo isset($this->vars['L_SELECT']) ? $this->vars['L_SELECT'] : $this->lang('L_SELECT'); ?></th>
    </tr>
    <tr> 
      <td class="catSides" colspan="9" height="28"><span class="cattitle"><?php echo isset($this->vars['L_PENDING_MEMBERS']) ? $this->vars['L_PENDING_MEMBERS'] : $this->lang('L_PENDING_MEMBERS'); ?></span></td>
    </tr>
    <?php

$pending_members_row_count = ( isset($this->_tpldata['pending_members_row.']) ) ?  sizeof($this->_tpldata['pending_members_row.']) : 0;
for ($pending_members_row_i = 0; $pending_members_row_i < $pending_members_row_count; $pending_members_row_i++)
{
 $pending_members_row_item = &$this->_tpldata['pending_members_row.'][$pending_members_row_i];
 $pending_members_row_item['S_ROW_COUNT'] = $pending_members_row_i;
 $pending_members_row_item['S_NUM_ROWS'] = $pending_members_row_count;

?>
    <tr> 
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center"> <?php echo isset($pending_members_row_item['PM_IMG']) ? $pending_members_row_item['PM_IMG'] : ''; ?> 
      </td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="left"><span class="gen"><?php echo isset($pending_members_row_item['CURRENT_AVATAR']) ? $pending_members_row_item['CURRENT_AVATAR'] : ''; ?> <a href="<?php echo isset($pending_members_row_item['U_VIEWPROFILE']) ? $pending_members_row_item['U_VIEWPROFILE'] : ''; ?>" class="gen"><?php echo isset($pending_members_row_item['USERNAME']) ? $pending_members_row_item['USERNAME'] : ''; ?></a></span></td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center"><span class="gen"><?php echo isset($pending_members_row_item['POSTS']) ? $pending_members_row_item['POSTS'] : ''; ?></span></td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center" valign="middle">
        <table border="0">
          <tr>
            <td align="left"><span class="gen"><?php echo isset($pending_members_row_item['FROM']) ? $pending_members_row_item['FROM'] : ''; ?></span></td>
          </tr>
        </table>
      </td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center"><span class="gen"><?php echo isset($pending_members_row_item['EMAIL_IMG']) ? $pending_members_row_item['EMAIL_IMG'] : ''; ?></span></td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center"><span class="gen"><?php echo isset($pending_members_row_item['ONLINE_STATUS']) ? $pending_members_row_item['ONLINE_STATUS'] : ''; ?></span></td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center"><span class="gen"><?php echo isset($pending_members_row_item['WWW_IMG']) ? $pending_members_row_item['WWW_IMG'] : ''; ?></span></td>
      <td class="<?php echo isset($pending_members_row_item['ROW_CLASS']) ? $pending_members_row_item['ROW_CLASS'] : ''; ?>" align="center"><span class="gensmall"> <input type="checkbox" name="pending_members[]" value="<?php echo isset($pending_members_row_item['USER_ID']) ? $pending_members_row_item['USER_ID'] : ''; ?>" /></span></td>
    </tr>
    <?php

} // END pending_members_row

if(isset($pending_members_row_item)) { unset($pending_members_row_item); } 

?>
    <tr> 
      <td class="cat" colspan="9" align="right"><span class="cattitle"> 
        <input type="submit" name="approve" value="<?php echo isset($this->vars['L_APPROVE_SELECTED']) ? $this->vars['L_APPROVE_SELECTED'] : $this->lang('L_APPROVE_SELECTED'); ?>" class="btn-hover-one" />
        &nbsp; 
        <input type="submit" name="deny" value="<?php echo isset($this->vars['L_DENY_SELECTED']) ? $this->vars['L_DENY_SELECTED'] : $this->lang('L_DENY_SELECTED'); ?>" class="btn-hover-one" />
        </span></td>
    </tr>
</table>