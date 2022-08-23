<?php

// eXtreme Styles mod cache. Generated on Wed, 28 Apr 2021 05:52:15 +0000 (time=1619589135)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></td>
  </tr>
</table>

<table width="100%" cellpadding="3" cellspacing="1" border="0" class="forumline">
  <tr>
        <th class="thTop"><?php echo isset($this->vars['L_USERNAME']) ? $this->vars['L_USERNAME'] : $this->lang('L_USERNAME'); ?></th>
        <th class="thTop"><?php echo isset($this->vars['L_FORUMS']) ? $this->vars['L_FORUMS'] : $this->lang('L_FORUMS'); ?></th>
        <th class="thTop"><?php echo isset($this->vars['L_POSTS']) ? $this->vars['L_POSTS'] : $this->lang('L_POSTS'); ?></th>
        <th class="thTop"><?php echo isset($this->vars['L_JOINED']) ? $this->vars['L_JOINED'] : $this->lang('L_JOINED'); ?></th>
        <th class="thTop"><?php echo isset($this->vars['L_EMAIL']) ? $this->vars['L_EMAIL'] : $this->lang('L_EMAIL'); ?></th>
        <th class="thTop"><?php echo isset($this->vars['L_PM']) ? $this->vars['L_PM'] : $this->lang('L_PM'); ?></th>
        <th class="thTop"><?php echo isset($this->vars['L_MESSENGER']) ? $this->vars['L_MESSENGER'] : $this->lang('L_MESSENGER'); ?></th>
        <th class="thCornerR"><?php echo isset($this->vars['L_WWW']) ? $this->vars['L_WWW'] : $this->lang('L_WWW'); ?></th>
  </tr>
<?php

$staff_count = ( isset($this->_tpldata['staff.']) ) ?  sizeof($this->_tpldata['staff.']) : 0;
for ($staff_i = 0; $staff_i < $staff_count; $staff_i++)
{
 $staff_item = &$this->_tpldata['staff.'][$staff_i];
 $staff_item['S_ROW_COUNT'] = $staff_i;
 $staff_item['S_NUM_ROWS'] = $staff_count;

?>
  <tr> 
        <td valign="top" class="row1" nowrap="nowrap"><a href="<?php echo isset($staff_item['U_NAME']) ? $staff_item['U_NAME'] : ''; ?>" class="genmed"><?php echo isset($staff_item['NAME']) ? $staff_item['NAME'] : ''; ?></a><br /><?php echo isset($staff_item['LEVEL']) ? $staff_item['LEVEL'] : ''; ?><span class="postdetails"><br /><?php echo isset($staff_item['RANK']) ? $staff_item['RANK'] : ''; ?><br /><?php echo isset($staff_item['RANK_IMAGE']) ? $staff_item['RANK_IMAGE'] : ''; ?><br /><?php echo isset($staff_item['AVATAR']) ? $staff_item['AVATAR'] : ''; ?></span></td>
        <td valign="top" class="row2" nowrap="nowrap"><span class="genmed"><?php echo isset($staff_item['FORUMS']) ? $staff_item['FORUMS'] : ''; ?></span>&nbsp;</td>
        <td valign="top" align="right" class="row1" nowrap="nowrap"><span class="gensmall"><?php echo isset($staff_item['POSTS']) ? $staff_item['POSTS'] : ''; ?>&nbsp;&nbsp;<br />
                                                                                                   <?php echo isset($staff_item['POST_PERCENT']) ? $staff_item['POST_PERCENT'] : ''; ?>&nbsp;&nbsp;<br /><?php echo isset($staff_item['POST_DAY']) ? $staff_item['POST_DAY'] : ''; ?>&nbsp;
                                                                                                   <br />[<?php echo isset($staff_item['LAST_POST']) ? $staff_item['LAST_POST'] : ''; ?>]</span>&nbsp;</td>
        <td valign="top" class="row2" align="right" nowrap="nowrap"><span class="gensmall"><?php echo isset($staff_item['JOINED']) ? $staff_item['JOINED'] : ''; ?><br />[<?php echo isset($staff_item['PERIOD']) ? $staff_item['PERIOD'] : ''; ?>]</span></td>
        <td align="center" class="row1"><?php echo isset($staff_item['MAIL']) ? $staff_item['MAIL'] : ''; ?></td>
        <td align="center" class="row2"><?php echo isset($staff_item['PM']) ? $staff_item['PM'] : ''; ?></td>
        <td align="center" class="row1"><?php echo isset($staff_item['MSN']) ? $staff_item['MSN'] : ''; ?> <?php echo isset($staff_item['YIM']) ? $staff_item['YIM'] : ''; ?><br /><?php echo isset($staff_item['AIM']) ? $staff_item['AIM'] : ''; ?> <?php echo isset($staff_item['ICQ']) ? $staff_item['ICQ'] : ''; ?></td>
        <td align="center" class="row2"><?php echo isset($staff_item['WWW']) ? $staff_item['WWW'] : ''; ?></td>
  </tr>
<?php

} // END staff

if(isset($staff_item)) { unset($staff_item); } 

?>
</table>

</tr>
</tbody>
</table>
</div>
