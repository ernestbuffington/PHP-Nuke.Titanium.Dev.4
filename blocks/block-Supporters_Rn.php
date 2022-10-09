<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NSN Supporters                                       */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       07/14/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

include_once(NUKE_INCLUDE_DIR.'nsnsp_func.php');

$sp_config = spget_configs();
get_lang('Supporters');

global $prefix, $db, $user, $admin, $admin_file;

if(!isset($admin_file)) { $admin_file = "admin"; }
$content = "<center>"._SP_SUPPORTEDBY."<br /><br />";
$j = 1;
while($j <= 5) {
  $sresult = $db->sql_query("SELECT `site_id` FROM `".$prefix."_nsnsp_sites` WHERE `site_status`='1'");
  $numrows = $db->sql_numrows($sresult);
  if($numrows==1) {
    list ($siteid) = $db->sql_fetchrow($sresult);
  } else if($numrows > 1) {
    $i = 1;
    while(list ($stid) = $db->sql_fetchrow($sresult)) {
      $abid[$i] = $stid;
      $i++;
    }
    $siteid = $abid[rand(1, $numrows)];
  } else {
    $siteid = 0;
  }
  if($j == 1) {
    $sitelist = "WHERE `site_id`='$siteid'";
  } else {
    $sitelist = $sitelist." OR `site_id`='$siteid'";
  }
  $j++;
}
$db->sql_freeresult($sresult);
$result = $db->sql_query("SELECT `site_id`, `site_name`, `site_image` FROM `".$prefix."_nsnsp_sites` $sitelist");
while(list($site_id, $site_name, $site_image) = $db->sql_fetchrow($result)) {
  list($width, $height, $type, $attr) = @getimagesize($site_image);
  if($width > $sp_config['max_width']) { $width = $sp_config['max_width']; }
  if($height > $sp_config['max_height']) { $height = $sp_config['max_height']; }
  //echo "<a href='modules.php?name=Supporters&amp;op=SPGo&amp;site_id=$site_id' target='_blank'><img src='$site_image' height='$height' width='$width' title='$site_name' alt='$site_name' border='0' /></a><br /><br />\n";
  $content .= "<a href='modules.php?name=Supporters&amp;op=SPGo&amp;site_id=$site_id' target='_blank'><img src='$site_image' height='$height' width='$width' title='$site_name' alt='$site_name' border='0' /></a><br /><br />\n";
}
$db->sql_freeresult($result);
$content .="</center>\n";
if($sp_config['require_user'] == 0 || is_user()) { $content .= "[ <a href='modules.php?name=Supporters&amp;op=SPSubmit'>"._SP_BESUPPORTER."</a> ]<br />\n"; }
if(is_admin()) { $content .= "[ <a href='".$admin_file.".php?op=SPMain'>"._SP_GOTOADMIN."</a> ]<br />\n"; }
$content .= "[ <a href='modules.php?name=Supporters'>"._SP_SUPPORTERS."</a> ]</center>\n";

?>