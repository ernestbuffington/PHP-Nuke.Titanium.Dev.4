<?php

// eXtreme Styles mod cache. Generated on Wed, 14 Apr 2021 11:41:06 +0000 (time=1618400466)

?><table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr> 
    <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="nav"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0" align="center">
  <tr> 
    <th class="thHead" colspan="2" height="25" nowrap="nowrap"><?php echo isset($this->vars['L_VIEWING_PROFILE']) ? $this->vars['L_VIEWING_PROFILE'] : $this->lang('L_VIEWING_PROFILE'); ?></th>
  </tr>
  <tr> 
    <td class="catLeft" width="40%" height="28" align="center"><strong><span class="gen"><?php echo isset($this->vars['L_AVATAR']) ? $this->vars['L_AVATAR'] : $this->lang('L_AVATAR'); ?></span></strong></td>
    <td class="catRight" width="60%"><strong><span class="gen"><?php echo isset($this->vars['L_ABOUT_USER']) ? $this->vars['L_ABOUT_USER'] : $this->lang('L_ABOUT_USER'); ?></span></strong>
    <?php

$switch_user_admin_count = ( isset($this->_tpldata['switch_user_admin.']) ) ?  sizeof($this->_tpldata['switch_user_admin.']) : 0;
for ($switch_user_admin_i = 0; $switch_user_admin_i < $switch_user_admin_count; $switch_user_admin_i++)
{
 $switch_user_admin_item = &$this->_tpldata['switch_user_admin.'][$switch_user_admin_i];
 $switch_user_admin_item['S_ROW_COUNT'] = $switch_user_admin_i;
 $switch_user_admin_item['S_NUM_ROWS'] = $switch_user_admin_count;

?>
    <span class="gen">&nbsp;(<a target="_admin" href="<?php echo isset($this->vars['U_ADMIN_PROFILE']) ? $this->vars['U_ADMIN_PROFILE'] : $this->lang('U_ADMIN_PROFILE'); ?>" class="gen"><?php echo isset($this->vars['L_USER_ADMIN_FOR']) ? $this->vars['L_USER_ADMIN_FOR'] : $this->lang('L_USER_ADMIN_FOR'); ?> <?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?></a>)</span>
    <?php

} // END switch_user_admin

if(isset($switch_user_admin_item)) { unset($switch_user_admin_item); } 

?>
    </td>
  </tr>
  <tr> 
    <td class="row1" height="6" valign="top" align="center"><?php echo isset($this->vars['AVATAR_IMG']) ? $this->vars['AVATAR_IMG'] : $this->lang('AVATAR_IMG'); ?><br /><span class="postdetails"><?php echo isset($this->vars['USER_RANK_01']) ? $this->vars['USER_RANK_01'] : $this->lang('USER_RANK_01'); ?><?php echo isset($this->vars['USER_RANK_01_IMG']) ? $this->vars['USER_RANK_01_IMG'] : $this->lang('USER_RANK_01_IMG'); ?><?php echo isset($this->vars['USER_RANK_02']) ? $this->vars['USER_RANK_02'] : $this->lang('USER_RANK_02'); ?><?php echo isset($this->vars['USER_RANK_02_IMG']) ? $this->vars['USER_RANK_02_IMG'] : $this->lang('USER_RANK_02_IMG'); ?><?php echo isset($this->vars['USER_RANK_03']) ? $this->vars['USER_RANK_03'] : $this->lang('USER_RANK_03'); ?><?php echo isset($this->vars['USER_RANK_03_IMG']) ? $this->vars['USER_RANK_03_IMG'] : $this->lang('USER_RANK_03_IMG'); ?><?php echo isset($this->vars['USER_RANK_04']) ? $this->vars['USER_RANK_04'] : $this->lang('USER_RANK_04'); ?><?php echo isset($this->vars['USER_RANK_04_IMG']) ? $this->vars['USER_RANK_04_IMG'] : $this->lang('USER_RANK_04_IMG'); ?><?php echo isset($this->vars['USER_RANK_05']) ? $this->vars['USER_RANK_05'] : $this->lang('USER_RANK_05'); ?><?php echo isset($this->vars['USER_RANK_05_IMG']) ? $this->vars['USER_RANK_05_IMG'] : $this->lang('USER_RANK_05_IMG'); ?></span></td>
    <td class="row1" rowspan="3" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_JOINED']) ? $this->vars['L_JOINED'] : $this->lang('L_JOINED'); ?>:&nbsp;</span></td>
          <td width="100%"><strong><span class="gen"><?php echo isset($this->vars['JOINED']) ? $this->vars['JOINED'] : $this->lang('JOINED'); ?></span></strong></td>
        </tr>
        <tr> 
          <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_TOTAL_POSTS']) ? $this->vars['L_TOTAL_POSTS'] : $this->lang('L_TOTAL_POSTS'); ?>:&nbsp;</span></td>
          <td valign="top"><strong><span class="gen"><?php echo isset($this->vars['POSTS']) ? $this->vars['POSTS'] : $this->lang('POSTS'); ?></span></strong><br /><span class="genmed">[<?php echo isset($this->vars['POST_PERCENT_STATS']) ? $this->vars['POST_PERCENT_STATS'] : $this->lang('POST_PERCENT_STATS'); ?> / <?php echo isset($this->vars['POST_DAY_STATS']) ? $this->vars['POST_DAY_STATS'] : $this->lang('POST_DAY_STATS'); ?>]</span> <br /><span class="genmed"><a href="<?php echo isset($this->vars['U_SEARCH_USER']) ? $this->vars['U_SEARCH_USER'] : $this->lang('U_SEARCH_USER'); ?>" class="genmed"><?php echo isset($this->vars['L_SEARCH_USER_POSTS']) ? $this->vars['L_SEARCH_USER_POSTS'] : $this->lang('L_SEARCH_USER_POSTS'); ?></a></span></td>
        </tr>
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_LOCATION']) ? $this->vars['L_LOCATION'] : $this->lang('L_LOCATION'); ?>:&nbsp;</span></td>
          <td><strong><span class="gen"><?php echo isset($this->vars['LOCATION']) ? $this->vars['LOCATION'] : $this->lang('LOCATION'); ?></span></strong></td>
        </tr>
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_WEBSITE']) ? $this->vars['L_WEBSITE'] : $this->lang('L_WEBSITE'); ?>:&nbsp;</span></td>
          <td><span class="gen"><strong><?php echo isset($this->vars['WWW']) ? $this->vars['WWW'] : $this->lang('WWW'); ?></strong></span></td>
        </tr>
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_OCCUPATION']) ? $this->vars['L_OCCUPATION'] : $this->lang('L_OCCUPATION'); ?>:&nbsp;</span></td>
          <td><strong><span class="gen"><?php echo isset($this->vars['OCCUPATION']) ? $this->vars['OCCUPATION'] : $this->lang('OCCUPATION'); ?></span></strong></td>
        </tr>
        <tr> 
          <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_INTERESTS']) ? $this->vars['L_INTERESTS'] : $this->lang('L_INTERESTS'); ?>:</span></td>
          <td> <strong><span class="gen"><?php echo isset($this->vars['INTERESTS']) ? $this->vars['INTERESTS'] : $this->lang('INTERESTS'); ?></span></strong></td>
        </tr> 
<!--BEGIN Arcade 3.0.2--> 
        <tr>
          <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_ARCADE']) ? $this->vars['L_ARCADE'] : $this->lang('L_ARCADE'); ?>:</span></td>
          <td><strong><span class="gen"><?php echo isset($this->vars['URL_STATS']) ? $this->vars['URL_STATS'] : $this->lang('URL_STATS'); ?></span></strong></td>
        </tr>
<!-- END Arcade 3.0.2 -->              
        <tr>
          <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_REPUTATION']) ? $this->vars['L_REPUTATION'] : $this->lang('L_REPUTATION'); ?>:</span></td>
          <td> <span class="gen"><?php echo isset($this->vars['REPUTATION']) ? $this->vars['REPUTATION'] : $this->lang('REPUTATION'); ?></span></td>
        </tr>        
        <tr> 
          <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_BIRTHDAY']) ? $this->vars['L_BIRTHDAY'] : $this->lang('L_BIRTHDAY'); ?>:</span></td>
          <td> <b><span class="gen"><?php echo isset($this->vars['BIRTHDAY']) ? $this->vars['BIRTHDAY'] : $this->lang('BIRTHDAY'); ?></span></b></td>
        </tr>
<!-- Start add - Gender MOD --> 
        <tr> 
	      <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_GENDER']) ? $this->vars['L_GENDER'] : $this->lang('L_GENDER'); ?>:</span></td>
	      <td> <b><span class="gen"><?php echo isset($this->vars['GENDER']) ? $this->vars['GENDER'] : $this->lang('GENDER'); ?></span></b></td>
        </tr>
<?php

$switch_admin_notes_count = ( isset($this->_tpldata['switch_admin_notes.']) ) ?  sizeof($this->_tpldata['switch_admin_notes.']) : 0;
for ($switch_admin_notes_i = 0; $switch_admin_notes_i < $switch_admin_notes_count; $switch_admin_notes_i++)
{
 $switch_admin_notes_item = &$this->_tpldata['switch_admin_notes.'][$switch_admin_notes_i];
 $switch_admin_notes_item['S_ROW_COUNT'] = $switch_admin_notes_i;
 $switch_admin_notes_item['S_NUM_ROWS'] = $switch_admin_notes_count;

?>
		<tr>
		  <td valign="top" align="right" nowrap="nowrap"><span class="gen"><b><?php echo isset($this->vars['L_ADMIN_NOTES']) ? $this->vars['L_ADMIN_NOTES'] : $this->lang('L_ADMIN_NOTES'); ?>:</b></span></td>
		  <td> <span class="gen"><?php echo isset($this->vars['ADMIN_NOTES']) ? $this->vars['ADMIN_NOTES'] : $this->lang('ADMIN_NOTES'); ?></span></td>
		</tr>
<?php

} // END switch_admin_notes

if(isset($switch_admin_notes_item)) { unset($switch_admin_notes_item); } 

?>         
<!-- End add - Gender MOD -->
<?php

$xdata_count = ( isset($this->_tpldata['xdata.']) ) ?  sizeof($this->_tpldata['xdata.']) : 0;
for ($xdata_i = 0; $xdata_i < $xdata_count; $xdata_i++)
{
 $xdata_item = &$this->_tpldata['xdata.'][$xdata_i];
 $xdata_item['S_ROW_COUNT'] = $xdata_i;
 $xdata_item['S_NUM_ROWS'] = $xdata_count;

?>
<tr>
  <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($xdata_item['NAME']) ? $xdata_item['NAME'] : ''; ?>:</span></td>
  <td> <strong><span class="gen"><?php echo isset($xdata_item['VALUE']) ? $xdata_item['VALUE'] : ''; ?></span></strong></td>
</tr>
<?php

} // END xdata

if(isset($xdata_item)) { unset($xdata_item); } 

?>        
<?php

$switch_upload_limits_count = ( isset($this->_tpldata['switch_upload_limits.']) ) ?  sizeof($this->_tpldata['switch_upload_limits.']) : 0;
for ($switch_upload_limits_i = 0; $switch_upload_limits_i < $switch_upload_limits_count; $switch_upload_limits_i++)
{
 $switch_upload_limits_item = &$this->_tpldata['switch_upload_limits.'][$switch_upload_limits_i];
 $switch_upload_limits_item['S_ROW_COUNT'] = $switch_upload_limits_i;
 $switch_upload_limits_item['S_NUM_ROWS'] = $switch_upload_limits_count;

?>
        <tr>
            <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_UPLOAD_QUOTA']) ? $this->vars['L_UPLOAD_QUOTA'] : $this->lang('L_UPLOAD_QUOTA'); ?>:</span></td>
            <td>
                <table width="175" cellspacing="1" cellpadding="2" border="0" class="bodyline">
                <tr>
                    <td colspan="3" width="100%" class="row2">
                        <table cellspacing="0" cellpadding="1" border="0">
                        <tr>
                            <td>
                               <img src="<?php echo isset($this->vars['LCAP_IMG']) ? $this->vars['LCAP_IMG'] : $this->lang('LCAP_IMG'); ?>" width="4" height="13" alt="" /><img src="<?php echo isset($this->vars['MAINBAR_IMG']) ? $this->vars['MAINBAR_IMG'] : $this->lang('MAINBAR_IMG'); ?>" width="<?php echo isset($this->vars['UPLOAD_LIMIT_IMG_WIDTH']) ? $this->vars['UPLOAD_LIMIT_IMG_WIDTH'] : $this->lang('UPLOAD_LIMIT_IMG_WIDTH'); ?>" height="13" alt="<?php echo isset($this->vars['UPLOAD_LIMIT_PERCENT']) ? $this->vars['UPLOAD_LIMIT_PERCENT'] : $this->lang('UPLOAD_LIMIT_PERCENT'); ?>" /><img src="<?php echo isset($this->vars['RCAP_IMG']) ? $this->vars['RCAP_IMG'] : $this->lang('RCAP_IMG'); ?>" width="4" height="13" alt="" />
                            </td>    
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="33%" class="row1"><span class="gensmall">0%</span></td>
                    <td width="34%" align="center" class="row1"><span class="gensmall">50%</span></td>
                    <td width="33%" align="right" class="row1"><span class="gensmall">100%</span></td>
                </tr>
                </table>
                <strong><span class="genmed">[<?php echo isset($this->vars['UPLOADED']) ? $this->vars['UPLOADED'] : $this->lang('UPLOADED'); ?> / <?php echo isset($this->vars['QUOTA']) ? $this->vars['QUOTA'] : $this->lang('QUOTA'); ?> / <?php echo isset($this->vars['PERCENT_FULL']) ? $this->vars['PERCENT_FULL'] : $this->lang('PERCENT_FULL'); ?>]</span> </strong><br />
                <span class="genmed"><a href="<?php echo isset($this->vars['U_UACP']) ? $this->vars['U_UACP'] : $this->lang('U_UACP'); ?>" class="genmed"><?php echo isset($this->vars['L_UACP']) ? $this->vars['L_UACP'] : $this->lang('L_UACP'); ?></a></span></td>
            </td>
        </tr>
<?php

} // END switch_upload_limits

if(isset($switch_upload_limits_item)) { unset($switch_upload_limits_item); } 

?>       
<?php

$show_groups_count = ( isset($this->_tpldata['show_groups.']) ) ?  sizeof($this->_tpldata['show_groups.']) : 0;
for ($show_groups_i = 0; $show_groups_i < $show_groups_count; $show_groups_i++)
{
 $show_groups_item = &$this->_tpldata['show_groups.'][$show_groups_i];
 $show_groups_item['S_ROW_COUNT'] = $show_groups_i;
 $show_groups_item['S_NUM_ROWS'] = $show_groups_count;

?>
        <tr>
          <td valign="top" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_GROUPS']) ? $this->vars['L_GROUPS'] : $this->lang('L_GROUPS'); ?>:</span></td>
          <td> <strong><span class="gen"><?php echo isset($this->vars['GROUPS']) ? $this->vars['GROUPS'] : $this->lang('GROUPS'); ?></span></strong></td>
        </tr>
<?php

} // END show_groups

if(isset($show_groups_item)) { unset($show_groups_item); } 

?>        
      </table>
    </td>
  </tr>
  <tr> 
    <td class="catLeft" align="center" height="28"><strong><span class="gen"><?php echo isset($this->vars['L_CONTACT']) ? $this->vars['L_CONTACT'] : $this->lang('L_CONTACT'); ?> <?php echo isset($this->vars['USERNAME']) ? $this->vars['USERNAME'] : $this->lang('USERNAME'); ?> </span></strong></td>
  </tr>
  <tr> 
    <td class="row1" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr> 
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"><?php echo isset($this->vars['L_EMAIL_ADDRESS']) ? $this->vars['L_EMAIL_ADDRESS'] : $this->lang('L_EMAIL_ADDRESS'); ?>:</span></td>
          <td class="row1" valign="middle" width="100%"><strong><span class="gen"><?php echo isset($this->vars['EMAIL_IMG']) ? $this->vars['EMAIL_IMG'] : $this->lang('EMAIL_IMG'); ?></span></strong></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_PM']) ? $this->vars['L_PM'] : $this->lang('L_PM'); ?>:</span></td>
          <td class="row1" valign="middle"><strong><span class="gen"><?php echo isset($this->vars['PM_IMG']) ? $this->vars['PM_IMG'] : $this->lang('PM_IMG'); ?></span></strong></td>
        </tr>
        <tr>
          <td valign="middle" align="right" nowrap="nowrap"><span class="gen"> <?php echo isset($this->vars['L_MESSENGER']) ? $this->vars['L_MESSENGER'] : $this->lang('L_MESSENGER'); ?>:</span></td>
          <td class="row1" valign="middle" width="100%"><span class="gen"><?php echo isset($this->vars['MSN_IMG']) ? $this->vars['MSN_IMG'] : $this->lang('MSN_IMG'); ?></span></td>
        </tr>
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_FACEBOOK_PROFILE']) ? $this->vars['L_FACEBOOK_PROFILE'] : $this->lang('L_FACEBOOK_PROFILE'); ?>:</span></td>
		  <td class="row1" valign="middle"><span class="gen"><?php echo isset($this->vars['FACEBOOK_IMG']) ? $this->vars['FACEBOOK_IMG'] : $this->lang('FACEBOOK_IMG'); ?></span></td>
		</tr>        
		<tr> 
		  <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_MYSPACE']) ? $this->vars['L_MYSPACE'] : $this->lang('L_MYSPACE'); ?>:</span></td>
		  <td class="row1" valign="middle"><span class="gen"><?php echo isset($this->vars['MYSPACE_IMG']) ? $this->vars['MYSPACE_IMG'] : $this->lang('MYSPACE_IMG'); ?></span></td>
		</tr>        
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_YAHOO']) ? $this->vars['L_YAHOO'] : $this->lang('L_YAHOO'); ?>:</span></td>
          <td class="row1" valign="middle"><span class="gen"><?php echo isset($this->vars['YIM_IMG']) ? $this->vars['YIM_IMG'] : $this->lang('YIM_IMG'); ?></span></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_AIM']) ? $this->vars['L_AIM'] : $this->lang('L_AIM'); ?>:</span></td>
          <td class="row1" valign="middle"><span class="gen"><?php echo isset($this->vars['AIM_IMG']) ? $this->vars['AIM_IMG'] : $this->lang('AIM_IMG'); ?></span></td>
        </tr>
        <tr> 
          <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_ICQ_NUMBER']) ? $this->vars['L_ICQ_NUMBER'] : $this->lang('L_ICQ_NUMBER'); ?>:</span></td>
          <td class="row1"><script language="JavaScript" type="text/javascript"><!-- 

        if ( navigator.userAgent.toLowerCase().indexOf('mozilla') != -1 && navigator.userAgent.indexOf('5.') == -1 )
            document.write(' <?php echo isset($this->vars['ICQ_IMG']) ? $this->vars['ICQ_IMG'] : $this->lang('ICQ_IMG'); ?>');
        else
            document.write('<table cellspacing="0" cellpadding="0" border="0"><tr><td nowrap="nowrap"><div style="position:relative;height:18px"><div style="position:absolute"><?php echo isset($this->vars['ICQ_IMG']) ? $this->vars['ICQ_IMG'] : $this->lang('ICQ_IMG'); ?></div><div style="position:absolute;left:3px;top:-1px"><?php echo isset($this->vars['ICQ_STATUS_IMG']) ? $this->vars['ICQ_STATUS_IMG'] : $this->lang('ICQ_STATUS_IMG'); ?></div></div></td></tr></table>');
          
          //--></script><noscript><?php echo isset($this->vars['ICQ_IMG']) ? $this->vars['ICQ_IMG'] : $this->lang('ICQ_IMG'); ?></noscript></td>
        </tr>
<tr> 
            <td valign="middle" nowrap="nowrap" align="right"><span class="gen"><?php echo isset($this->vars['L_ONLINE_STATUS']) ? $this->vars['L_ONLINE_STATUS'] : $this->lang('L_ONLINE_STATUS'); ?>:</span></td>
            <td class="row1" valign="middle"><span class="gen"><?php echo isset($this->vars['ONLINE_STATUS']) ? $this->vars['ONLINE_STATUS'] : $this->lang('ONLINE_STATUS'); ?></span></td>
        </tr>        
      </table>
    </td>
  </tr>
<?php

$user_extra_count = ( isset($this->_tpldata['user_extra.']) ) ?  sizeof($this->_tpldata['user_extra.']) : 0;
for ($user_extra_i = 0; $user_extra_i < $user_extra_count; $user_extra_i++)
{
 $user_extra_item = &$this->_tpldata['user_extra.'][$user_extra_i];
 $user_extra_item['S_ROW_COUNT'] = $user_extra_i;
 $user_extra_item['S_NUM_ROWS'] = $user_extra_count;

?>
<tr>
    <td class="catLeft" align="center" height="28" colspan="2"><strong><span class="gen"><?php echo isset($this->vars['L_EXTRA_INFO']) ? $this->vars['L_EXTRA_INFO'] : $this->lang('L_EXTRA_INFO'); ?></span></strong></td>
</tr>
<tr>
    <td class="row1" colspan="2"><table width="100%" border="0">
        <tr><td><?php echo isset($this->vars['EXTRA_INFO']) ? $this->vars['EXTRA_INFO'] : $this->lang('EXTRA_INFO'); ?></td></tr>
    </table></td>
</tr>
<?php

} // END user_extra

if(isset($user_extra_item)) { unset($user_extra_item); } 

?>  
<?php

$user_sig_count = ( isset($this->_tpldata['user_sig.']) ) ?  sizeof($this->_tpldata['user_sig.']) : 0;
for ($user_sig_i = 0; $user_sig_i < $user_sig_count; $user_sig_i++)
{
 $user_sig_item = &$this->_tpldata['user_sig.'][$user_sig_i];
 $user_sig_item['S_ROW_COUNT'] = $user_sig_i;
 $user_sig_item['S_NUM_ROWS'] = $user_sig_count;

?>
    <tr>
        <td class="catLeft" align="center" height="28" colspan="2"><strong><span class="gen"><?php echo isset($this->vars['L_SIG']) ? $this->vars['L_SIG'] : $this->lang('L_SIG'); ?></span></strong></td>
    </tr>
  <tr>
    <td class="row1" valign="top" colspan="2"><table width="100%" border="0">
        <tr><td><?php echo isset($this->vars['USER_SIG']) ? $this->vars['USER_SIG'] : $this->lang('USER_SIG'); ?></td></tr>
    </table></td>
  </tr>
  <?php

} // END user_sig

if(isset($user_sig_item)) { unset($user_sig_item); } 

?>  
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
  <td align="left"><span class="nav"><br /><?php

$admin_delete_this_user_count = ( isset($this->_tpldata['admin_delete_this_user.']) ) ?  sizeof($this->_tpldata['admin_delete_this_user.']) : 0;
for ($admin_delete_this_user_i = 0; $admin_delete_this_user_i < $admin_delete_this_user_count; $admin_delete_this_user_i++)
{
 $admin_delete_this_user_item = &$this->_tpldata['admin_delete_this_user.'][$admin_delete_this_user_i];
 $admin_delete_this_user_item['S_ROW_COUNT'] = $admin_delete_this_user_i;
 $admin_delete_this_user_item['S_NUM_ROWS'] = $admin_delete_this_user_count;

?>

<?php echo isset($admin_delete_this_user_item['DELETE_USER_FORM']) ? $admin_delete_this_user_item['DELETE_USER_FORM'] : ''; ?>

<?php

} // END admin_delete_this_user

if(isset($admin_delete_this_user_item)) { unset($admin_delete_this_user_item); } 

?></span></td>
    <td align="right"><span class="nav"><br /><?php echo isset($this->vars['JUMPBOX']) ? $this->vars['JUMPBOX'] : $this->lang('JUMPBOX'); ?></span></td>
  </tr>
</table>