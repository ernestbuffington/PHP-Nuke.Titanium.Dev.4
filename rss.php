<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : rss.php
   Author        : Quake (www.nuke-evolution.com)
   Version       : 2.5.0
   Date          : 02/05/2006 (dd-mm-yyyy)

   Notes         : This file loads the RSS files and prints them to screen
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mods]=-
      RSS Improvements                         v3.0.0       12/07/2006
 ************************************************************************/

define('RSS_FEED', true);
define('NO_SENTINEL', true);
define('NO_SECURITY', true);

require_once(dirname(__FILE__) . '/mainfile.php');
include_once(NUKE_INCLUDE_DIR.'counter.php');
include_once(NUKE_RSS_DIR.'functions.php');

if(isset($feed) && !preg_match("/[\W]/i", $feed)) {
  $feed = htmlentities(addslashes($feed));
  if(file_exists(NUKE_RSS_DIR.$feed.'.php')) {
    include_once(NUKE_RSS_DIR.$feed.'.php');
  } else {
    exit(_NORSS);
  }
} else {
  include_once(NUKE_RSS_DIR.'news.php');
}

?>