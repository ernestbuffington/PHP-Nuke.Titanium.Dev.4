<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Evolution Log Functions                  v1.5.0       12/16/2005
-=[Other]=-
      Referers Fix                             v1.0.0       06/07/2005
-=[Mod]=-
	  Arcade                                   v3.0.2       05/29/2009
      Lock Modules                             v1.0.0       08/04/2005
      Portal Banner Ads                        v3.0.0       04/15/2021
      Network Banner Ads                       v3.0.0       04/15/2021
 ************************************************************************/

define('HOME_FILE', true);
define('MODULE_FILE', true);
$_SERVER['PHP_SELF'] = 'modules.php';

require_once(dirname(__FILE__).'/mainfile.php');

/*****[BEGIN]******************************************
 [ Mod:    Banner Ads                          v1.0.0 ]
 ******************************************************/
global $titanium_prefix, $titanium_db, $admin_file, $httpref, $httprefmax;
if (isset($_GET['op'])):
	if($_GET['op'] == 'ad_click' && isset($_GET['bid'])):
        $bid = intval($_GET['bid']);
        list($clickurl) = $titanium_db->sql_ufetchrow("SELECT `clickurl` FROM `".$titanium_prefix."_banner` WHERE `bid`='$bid'", SQL_NUM);
        if(!is_admin())
        $titanium_db->sql_query("UPDATE `".$titanium_prefix."_banner` SET `clicks`=clicks+1 WHERE `bid`='$bid'");
        redirect_titanium($clickurl);
	else: 
        exit('Illegal Operation');
    endif;
endif;
/*****[END]********************************************
 [ Mod:    Banner Ads                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]**************************************************
 [ Mod:    Network Banner Ads                          v1.0.0 ]#### 3/19/2021
 **************************************************************/
global $network_prefix, $titanium_db2;
if (isset($_GET['op'])):
    if($_GET['op'] == 'ad_network_click' && isset($_GET['bid'])):
        $bid = intval($_GET['bid']);
        list($clickurl) = $titanium_db2->sql_ufetchrow("SELECT `clickurl` FROM `".$network_prefix."_banner` WHERE `bid`='$bid'", SQL_NUM);
        if(!is_admin())
        $titanium_db2->sql_query("UPDATE `".$network_prefix."_banner` SET `clicks`=clicks+1 WHERE `bid`='$bid'");
        redirect_titanium($clickurl);
	else: 
        exit('Illegal Operation');
    endif;
endif;
/*****[END]****************************************************
 [ Mod:    Network Banner Ads                          v1.0.0 ]#### 3/19/2021
 **************************************************************/
  
/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
// Arcade MOD - IBProSupport
$arcade = get_query_var('act', 'get');
$newscore = get_query_var('do', 'get');

if($arcade == 'Arcade' && $newscore='newscore'):
     $gamename = str_replace("\'","''",$HTTP_POST_VARS['gname']);
     $gamename = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'),$gamename);
     $gamescore = intval($HTTP_POST_VARS['gscore']);

      //Get Game ID
      $row = $titanium_db->sql_ufetchrow("SELECT game_id FROM ".$titanium_prefix."_bbgames WHERE game_scorevar='$gamename'");
      $gid = intval($row['game_id']);

      $ThemeSel = get_theme();

      print '<link rel="StyleSheet" href="themes/"'.$ThemeSel.'"/style/style.css" type="text/css">'."\n";
      print '<form method="post" name="ibpro_score" action="modules.php?name=Forums&amp;file=proarcade&amp;valid=X&amp;gpaver=GFARV2">'."\n";
      print '<input type=hidden name="vscore" value="'.$gamescore.'">'."\n";
      print '<input type=hidden name="gid" value="'.$gid.'">'."\n";
      print '</form>'."\n";

      print '<script type="text/javascript">'."\n";
      print 'window.onload = function(){document.forms["ibpro_score"].submit()}'."\n";
      print '</script>'."\n";
exit;

endif;
/*****[END]********************************************
 [ Mod:     Arcade                             v3.0.2 ]
 ******************************************************/
 
if (isset($_GET['url']) && is_admin())
redirect_titanium($_GET['url']);

$titanium_module_name = main_module_titanium();

/*****[BEGIN]******************************************
 [ Mod:     Lock Modules                       v1.0.0 ]
 ******************************************************/
global $lock_titanium_modules;
if(($lock_titanium_modules && $titanium_module_name != 'Your_Account') && !is_admin() && !is_user()) 
include(NUKE_MODULES_DIR.'Your_Account/index.php');
/*****[END]********************************************
 [ Mod:     Lock Modules                       v1.0.0 ]
 ******************************************************/

$mop = (!isset($mop)) ? 'modload' : trim($mop);
$mod_file = (!isset($mod_file)) ? 'index' : trim($mod_file);
$file = (isset($_REQUEST['file'])) ? trim($_REQUEST['file']) : 'index';

if (!isset($modpath)) 
$modpath = ''; 

if (stristr($file,"..") || stristr($mod_file,"..") || stristr($mop,"..")):
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
    log_write('error', 'Inappropriate module path was used', 'Hack Attempt');
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
    die("You are so cool...");
else:
    $titanium_module = $titanium_db->sql_ufetchrow('SELECT `blocks` FROM `'.$titanium_prefix.'_modules` WHERE `title`="'.$titanium_module_name.'"');
	$modpath = NUKE_MODULES_DIR.$titanium_module_name."/$file.php";
	if (file_exists($modpath)):
		$showblocks = $titanium_module['blocks'];
		unset($titanium_module, $error);
		require($modpath);
    else:
        DisplayError((is_admin()) ? "<strong>"._HOMEPROBLEM."</strong><br /><br />[ <a href=\"".$admin_file.".php?op=modules\">"._ADDAHOME."</a> ]" : _HOMEPROBLEMUSER);
    endif;
endif;

