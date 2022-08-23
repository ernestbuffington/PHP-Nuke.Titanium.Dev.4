<?php

// eXtreme Styles mod cache. Generated on Wed, 28 Apr 2021 05:51:20 +0000 (time=1619589080)

?><div align="center">
<table width="98%" style="background-color:none; height:100%;" class="viewforum" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="viewforum">
<tbody>
<tr>
<td align="center">


<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr> 
    <td style="width: 100%"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a> -> <?php echo isset($this->vars['L_RANKS']) ? $this->vars['L_RANKS'] : $this->lang('L_RANKS'); ?></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="5">
  <tr>
    <td valign="top" width="50%">
      <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%">
        <tr>
            <td class="catHead" style="text-align: center" colspan="<?php if ($this->vars['RANK_TOTAL']) {  ?>3<?php } else { ?>2<?php } ?>"><?php echo isset($this->vars['L_RANKS']) ? $this->vars['L_RANKS'] : $this->lang('L_RANKS'); ?></td>
        </tr>
        <tr>
            <td class="catLeft" nowrap="nowrap" align="center"><?php echo isset($this->vars['L_RANKS']) ? $this->vars['L_RANKS'] : $this->lang('L_RANKS'); ?></td>
            <td class="cat" nowrap="nowrap" align="center"><?php echo isset($this->vars['L_MINI']) ? $this->vars['L_MINI'] : $this->lang('L_MINI'); ?></td>
            <?php

$no_std_userlist_count = ( isset($this->_tpldata['no_std_userlist.']) ) ?  sizeof($this->_tpldata['no_std_userlist.']) : 0;
for ($no_std_userlist_i = 0; $no_std_userlist_i < $no_std_userlist_count; $no_std_userlist_i++)
{
 $no_std_userlist_item = &$this->_tpldata['no_std_userlist.'][$no_std_userlist_i];
 $no_std_userlist_item['S_ROW_COUNT'] = $no_std_userlist_i;
 $no_std_userlist_item['S_NUM_ROWS'] = $no_std_userlist_count;

?>
            <td class="cat" nowrap="nowrap" align="center"><?php echo isset($this->vars['L_TOTAL_USERS']) ? $this->vars['L_TOTAL_USERS'] : $this->lang('L_TOTAL_USERS'); ?></td>
            <?php

} // END no_std_userlist

if(isset($no_std_userlist_item)) { unset($no_std_userlist_item); } 

?>
        </tr>

        <?php

$ranks_count = ( isset($this->_tpldata['ranks.']) ) ?  sizeof($this->_tpldata['ranks.']) : 0;
for ($ranks_i = 0; $ranks_i < $ranks_count; $ranks_i++)
{
 $ranks_item = &$this->_tpldata['ranks.'][$ranks_i];
 $ranks_item['S_ROW_COUNT'] = $ranks_i;
 $ranks_item['S_NUM_ROWS'] = $ranks_count;

?>
        <tr>
            <td class="row1" align="center" nowrap="nowrap"><?php echo isset($ranks_item['RANK_TITLE']) ? $ranks_item['RANK_TITLE'] : ''; ?><br /><?php echo isset($ranks_item['RANK_IMAGE']) ? $ranks_item['RANK_IMAGE'] : ''; ?></td>
            <td class="row2" align="center" valign="top"><?php echo isset($ranks_item['RANK_MINI']) ? $ranks_item['RANK_MINI'] : ''; ?></td>
            <?php

$no_userlist_count = ( isset($ranks_item['no_userlist.']) ) ? sizeof($ranks_item['no_userlist.']) : 0;
for ($no_userlist_i = 0; $no_userlist_i < $no_userlist_count; $no_userlist_i++)
{
 $no_userlist_item = &$ranks_item['no_userlist.'][$no_userlist_i];
 $no_userlist_item['S_ROW_COUNT'] = $no_userlist_i;
 $no_userlist_item['S_NUM_ROWS'] = $no_userlist_count;

?>
            <td class="row2" align="center" valign="top"><?php echo isset($ranks_item['RANK_TOTAL']) ? $ranks_item['RANK_TOTAL'] : ''; ?></td>
            <?php

} // END no_userlist

if(isset($no_userlist_item)) { unset($no_userlist_item); } 

?>
        </tr>
        <?php

$userlist_count = ( isset($ranks_item['userlist.']) ) ? sizeof($ranks_item['userlist.']) : 0;
for ($userlist_i = 0; $userlist_i < $userlist_count; $userlist_i++)
{
 $userlist_item = &$ranks_item['userlist.'][$userlist_i];
 $userlist_item['S_ROW_COUNT'] = $userlist_i;
 $userlist_item['S_NUM_ROWS'] = $userlist_count;

?>
        <tr>
            <td class="row1" colspan="2" valign="top"><?php echo isset($userlist_item['USERS_LIST']) ? $userlist_item['USERS_LIST'] : ''; ?></td>
        </tr>
        <?php

} // END userlist

if(isset($userlist_item)) { unset($userlist_item); } 

?>
        <?php

} // END ranks

if(isset($ranks_item)) { unset($ranks_item); } 

?>

        </table>
    </td>

    <td valign="top" width="50%">
        <table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%">
        <tr>
            <td class="catHead" style="text-align: center" height="25" valign="middle" colspan="2"><?php echo isset($this->vars['L_SPECIAL_RANKS']) ? $this->vars['L_SPECIAL_RANKS'] : $this->lang('L_SPECIAL_RANKS'); ?></td>
        </tr>
        <tr>
            <td class="catLeft" nowrap="nowrap" align="center"><span class="cattitle">&nbsp;<?php echo isset($this->vars['L_SPECIAL_RANKS']) ? $this->vars['L_SPECIAL_RANKS'] : $this->lang('L_SPECIAL_RANKS'); ?>&nbsp;</span></td>
            <td class="cat" nowrap="nowrap" align="center">
                <?php

$no_spe_userlist_count = ( isset($this->_tpldata['no_spe_userlist.']) ) ?  sizeof($this->_tpldata['no_spe_userlist.']) : 0;
for ($no_spe_userlist_i = 0; $no_spe_userlist_i < $no_spe_userlist_count; $no_spe_userlist_i++)
{
 $no_spe_userlist_item = &$this->_tpldata['no_spe_userlist.'][$no_spe_userlist_i];
 $no_spe_userlist_item['S_ROW_COUNT'] = $no_spe_userlist_i;
 $no_spe_userlist_item['S_NUM_ROWS'] = $no_spe_userlist_count;

?>
                <span class="cattitle">&nbsp;<?php echo isset($this->vars['L_TOTAL_USERS']) ? $this->vars['L_TOTAL_USERS'] : $this->lang('L_TOTAL_USERS'); ?>&nbsp;</span>
                <?php

} // END no_spe_userlist

if(isset($no_spe_userlist_item)) { unset($no_spe_userlist_item); } 

?>
                <?php

$spe_userlist_count = ( isset($this->_tpldata['spe_userlist.']) ) ?  sizeof($this->_tpldata['spe_userlist.']) : 0;
for ($spe_userlist_i = 0; $spe_userlist_i < $spe_userlist_count; $spe_userlist_i++)
{
 $spe_userlist_item = &$this->_tpldata['spe_userlist.'][$spe_userlist_i];
 $spe_userlist_item['S_ROW_COUNT'] = $spe_userlist_i;
 $spe_userlist_item['S_NUM_ROWS'] = $spe_userlist_count;

?>
                <span class="cattitle">&nbsp;<?php echo isset($this->vars['L_USERS_LIST']) ? $this->vars['L_USERS_LIST'] : $this->lang('L_USERS_LIST'); ?>&nbsp;</span>
                <?php

} // END spe_userlist

if(isset($spe_userlist_item)) { unset($spe_userlist_item); } 

?>
            </td>
        </tr>
        <?php

$spe_ranks_count = ( isset($this->_tpldata['spe_ranks.']) ) ?  sizeof($this->_tpldata['spe_ranks.']) : 0;
for ($spe_ranks_i = 0; $spe_ranks_i < $spe_ranks_count; $spe_ranks_i++)
{
 $spe_ranks_item = &$this->_tpldata['spe_ranks.'][$spe_ranks_i];
 $spe_ranks_item['S_ROW_COUNT'] = $spe_ranks_i;
 $spe_ranks_item['S_NUM_ROWS'] = $spe_ranks_count;

?>
        <tr>
            <td class="row1" align="center" nowrap="nowrap"><?php echo isset($spe_ranks_item['RANK_TITLE']) ? $spe_ranks_item['RANK_TITLE'] : ''; ?><br /><?php echo isset($spe_ranks_item['RANK_IMAGE']) ? $spe_ranks_item['RANK_IMAGE'] : ''; ?></td>
            <?php

$userlist_count = ( isset($spe_ranks_item['userlist.']) ) ? sizeof($spe_ranks_item['userlist.']) : 0;
for ($userlist_i = 0; $userlist_i < $userlist_count; $userlist_i++)
{
 $userlist_item = &$spe_ranks_item['userlist.'][$userlist_i];
 $userlist_item['S_ROW_COUNT'] = $userlist_i;
 $userlist_item['S_NUM_ROWS'] = $userlist_count;

?>
            <td class="row2" valign="top"><?php echo isset($userlist_item['USERS_LIST']) ? $userlist_item['USERS_LIST'] : ''; ?></td>
            <?php

} // END userlist

if(isset($userlist_item)) { unset($userlist_item); } 

?>
            <?php

$no_userlist_count = ( isset($spe_ranks_item['no_userlist.']) ) ? sizeof($spe_ranks_item['no_userlist.']) : 0;
for ($no_userlist_i = 0; $no_userlist_i < $no_userlist_count; $no_userlist_i++)
{
 $no_userlist_item = &$spe_ranks_item['no_userlist.'][$no_userlist_i];
 $no_userlist_item['S_ROW_COUNT'] = $no_userlist_i;
 $no_userlist_item['S_NUM_ROWS'] = $no_userlist_count;

?>
            <td class="row2" align="center" valign="top"><?php echo isset($no_userlist_item['RANK_TOTAL']) ? $no_userlist_item['RANK_TOTAL'] : ''; ?></td>
            <?php

} // END no_userlist

if(isset($no_userlist_item)) { unset($no_userlist_item); } 

?>
        </tr>
        <?php

} // END spe_ranks

if(isset($spe_ranks_item)) { unset($spe_ranks_item); } 

?>
        </table>
    </td>
</tr>
</table>

</tr>
</tbody>
</table>
</div>
