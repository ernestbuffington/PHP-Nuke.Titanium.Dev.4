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
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function spsave_config($config_name, $config_value){
  global $prefix, $db, $cache;
  $db->sql_query("UPDATE `".$prefix."_nsnsp_config` SET `config_value`='$config_value' WHERE `config_name`='$config_name'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  $cache->delete('supporters', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
}

function spget_configs(){
  global $prefix, $db, $cache;
  static $config;
  if(isset($config)) return $config;
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  if(($config = $cache->load('supporters', 'config')) === false) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
      $configresult = $db->sql_query("SELECT `config_name`, `config_value` FROM `".$prefix."_nsnsp_config`");
      while(list($config_name, $config_value) = $db->sql_fetchrow($configresult)) {
        $config[$config_name] = $config_value;
      }
      $db->sql_freeresult($configresult);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
      $cache->save('supporters', 'config', $config);
  }
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
  return $config;
}

function spmenu() {
  global $admin_file;
  OpenTable();
  echo "<center>\n<table cellpadding='3' width='70%'>\n";
  echo "<tr>\n";
  echo "<td align='center' valign='top' width='50%'>";
  //echo "<a href='".$admin_file.".php?op=SPMain'>"._SP_ADMINMAIN."</a><br />\n";
  echo "<a href='".$admin_file.".php?op=SPConfig'>"._SP_CONFIGMAIN."</a><br />";
  echo "<a href='".$admin_file.".php?op=SPAdd'>"._SP_ADDSUPPORTER."</a><br />";
  echo "</td>\n";
  echo "<td align='center' valign='top' width='50%'>";
  echo "<a href='".$admin_file.".php?op=SPActive'>"._SP_ACTIVESITES."</a><br />";
  echo "<a href='".$admin_file.".php?op=SPPending'>"._SP_SUBMITTEDSITES."</a><br />";
  echo "<a href='".$admin_file.".php?op=SPInactive'>"._SP_INACTIVESITES."</a><br />";
  echo "</td>\n";
  echo "</tr>\n";
  //echo "<tr><td align='center' colspan='2'><a href='".$admin_file.".php'><i>"._SP_SITEADMIN."</i></a></td></tr>\n";
  echo "</table>\n</center>\n";
  CloseTable();
}

?>