<?php

// eXtreme Styles mod cache. Generated on Wed, 14 Apr 2021 11:43:06 +0000 (time=1618400586)

?><table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>

<table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline">
  <?php

$switch_groups_joined_count = ( isset($this->_tpldata['switch_groups_joined.']) ) ?  sizeof($this->_tpldata['switch_groups_joined.']) : 0;
for ($switch_groups_joined_i = 0; $switch_groups_joined_i < $switch_groups_joined_count; $switch_groups_joined_i++)
{
 $switch_groups_joined_item = &$this->_tpldata['switch_groups_joined.'][$switch_groups_joined_i];
 $switch_groups_joined_item['S_ROW_COUNT'] = $switch_groups_joined_i;
 $switch_groups_joined_item['S_NUM_ROWS'] = $switch_groups_joined_count;

?>
  <tr> 
    <th colspan="2" align="center" class="thHead" height="25"><?php echo isset($this->vars['L_GROUP_MEMBERSHIP_DETAILS']) ? $this->vars['L_GROUP_MEMBERSHIP_DETAILS'] : $this->lang('L_GROUP_MEMBERSHIP_DETAILS'); ?></th>
  </tr>
  <?php

$switch_groups_member_count = ( isset($switch_groups_joined_item['switch_groups_member.']) ) ? sizeof($switch_groups_joined_item['switch_groups_member.']) : 0;
for ($switch_groups_member_i = 0; $switch_groups_member_i < $switch_groups_member_count; $switch_groups_member_i++)
{
 $switch_groups_member_item = &$switch_groups_joined_item['switch_groups_member.'][$switch_groups_member_i];
 $switch_groups_member_item['S_ROW_COUNT'] = $switch_groups_member_i;
 $switch_groups_member_item['S_NUM_ROWS'] = $switch_groups_member_count;

?>
  <tr> 
    <td class="row1"><span class="gen"><?php echo isset($this->vars['L_YOU_BELONG_GROUPS']) ? $this->vars['L_YOU_BELONG_GROUPS'] : $this->lang('L_YOU_BELONG_GROUPS'); ?></span></td>
    <td class="row2" align="right"> 
      <table width="90%" cellspacing="0" cellpadding="0" border="0">
        <tr><form method="post" action="<?php echo isset($this->vars['S_USERGROUP_ACTION']) ? $this->vars['S_USERGROUP_ACTION'] : $this->lang('S_USERGROUP_ACTION'); ?>">
            <td width="40%"><span class="gensmall"><?php echo isset($this->vars['GROUP_MEMBER_SELECT']) ? $this->vars['GROUP_MEMBER_SELECT'] : $this->lang('GROUP_MEMBER_SELECT'); ?></span></td>
            <td align="center" width="30%"> 
              <input type="submit" value="<?php echo isset($this->vars['L_VIEW_INFORMATION']) ? $this->vars['L_VIEW_INFORMATION'] : $this->lang('L_VIEW_INFORMATION'); ?>" class="liteoption" /><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
            </td>
        </form></tr>
      </table>
    </td>
  </tr>
  <?php

} // END switch_groups_member

if(isset($switch_groups_member_item)) { unset($switch_groups_member_item); } 

?>
  <?php

$switch_groups_pending_count = ( isset($switch_groups_joined_item['switch_groups_pending.']) ) ? sizeof($switch_groups_joined_item['switch_groups_pending.']) : 0;
for ($switch_groups_pending_i = 0; $switch_groups_pending_i < $switch_groups_pending_count; $switch_groups_pending_i++)
{
 $switch_groups_pending_item = &$switch_groups_joined_item['switch_groups_pending.'][$switch_groups_pending_i];
 $switch_groups_pending_item['S_ROW_COUNT'] = $switch_groups_pending_i;
 $switch_groups_pending_item['S_NUM_ROWS'] = $switch_groups_pending_count;

?>
  <tr> 
    <td class="row1"><span class="gen"><?php echo isset($this->vars['L_PENDING_GROUPS']) ? $this->vars['L_PENDING_GROUPS'] : $this->lang('L_PENDING_GROUPS'); ?></span></td>
    <td class="row2" align="right"> 
      <table width="90%" cellspacing="0" cellpadding="0" border="0">
        <tr><form method="post" action="<?php echo isset($this->vars['S_USERGROUP_ACTION']) ? $this->vars['S_USERGROUP_ACTION'] : $this->lang('S_USERGROUP_ACTION'); ?>">
            <td width="40%"><span class="gensmall"><?php echo isset($this->vars['GROUP_PENDING_SELECT']) ? $this->vars['GROUP_PENDING_SELECT'] : $this->lang('GROUP_PENDING_SELECT'); ?></span></td>
            <td align="center" width="30%"> 
              <input type="submit" value="<?php echo isset($this->vars['L_VIEW_INFORMATION']) ? $this->vars['L_VIEW_INFORMATION'] : $this->lang('L_VIEW_INFORMATION'); ?>" class="liteoption" /><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
            </td>
        </form></tr>
      </table>
    </td>
  </tr>
  <?php

} // END switch_groups_pending

if(isset($switch_groups_pending_item)) { unset($switch_groups_pending_item); } 

?>
  <?php

} // END switch_groups_joined

if(isset($switch_groups_joined_item)) { unset($switch_groups_joined_item); } 

?>
  <?php

$switch_groups_remaining_count = ( isset($this->_tpldata['switch_groups_remaining.']) ) ?  sizeof($this->_tpldata['switch_groups_remaining.']) : 0;
for ($switch_groups_remaining_i = 0; $switch_groups_remaining_i < $switch_groups_remaining_count; $switch_groups_remaining_i++)
{
 $switch_groups_remaining_item = &$this->_tpldata['switch_groups_remaining.'][$switch_groups_remaining_i];
 $switch_groups_remaining_item['S_ROW_COUNT'] = $switch_groups_remaining_i;
 $switch_groups_remaining_item['S_NUM_ROWS'] = $switch_groups_remaining_count;

?>
  <tr> 
    <th colspan="2" align="center" class="thHead" height="25"><?php echo isset($this->vars['L_JOIN_A_GROUP']) ? $this->vars['L_JOIN_A_GROUP'] : $this->lang('L_JOIN_A_GROUP'); ?></th>
  </tr>
  <tr> 
    <td class="row1"><span class="gen"><?php echo isset($this->vars['L_SELECT_A_GROUP']) ? $this->vars['L_SELECT_A_GROUP'] : $this->lang('L_SELECT_A_GROUP'); ?></span></td>
    <td class="row2" align="right"> 
      <table width="90%" cellspacing="0" cellpadding="0" border="0">
        <tr><form method="post" action="<?php echo isset($this->vars['S_USERGROUP_ACTION']) ? $this->vars['S_USERGROUP_ACTION'] : $this->lang('S_USERGROUP_ACTION'); ?>">
            <td width="40%"><span class="gensmall"><?php echo isset($this->vars['GROUP_LIST_SELECT']) ? $this->vars['GROUP_LIST_SELECT'] : $this->lang('GROUP_LIST_SELECT'); ?></span></td>
            <td align="center" width="30%"> 
              <input type="submit" value="<?php echo isset($this->vars['L_VIEW_INFORMATION']) ? $this->vars['L_VIEW_INFORMATION'] : $this->lang('L_VIEW_INFORMATION'); ?>" class="liteoption" /><?php echo isset($this->vars['S_HIDDEN_FIELDS']) ? $this->vars['S_HIDDEN_FIELDS'] : $this->lang('S_HIDDEN_FIELDS'); ?>
            </td>
        </form></tr>
      </table>
    </td>
  </tr>
  <?php

} // END switch_groups_remaining

if(isset($switch_groups_remaining_item)) { unset($switch_groups_remaining_item); } 

?>
</table>

<table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
  <tr> 
    <td align="right" valign="top"><span class="gensmall"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?></span></td>
  </tr>
</table>

<br clear="all" />

<table width="100%" cellspacing="2" border="0" align="center">
  <tr> 
    <td valign="top" align="right"><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></td>
  </tr>
</table>