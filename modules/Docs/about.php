<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************
  CPG-NUKE: Advanced Content Management System
  ********************************************
  A highly modified version of PHP-Nuke 6.5
  which is Copyright (c) 2002 by Francisco Burzi
  http://phpnuke.org

  Under the GNU General Public License version 2

  Website Document Mod v1.0
  Copyright (c) 2002 by Shawn Archer
  http://www.nukestyles.com

  CPG-Nuke Port
  Copyright (c) 2004 by Trevor E
  from http://www.cpgnuke.com

***********************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       07/17/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include(NUKE_MODULES_DIR.$module_name.'/doc_config.php');

define('INDEX_FILE', true);

function about() {
    global $sitename, $adminmail, $aboutus, $questions, $module_name, $currentlang;
    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._NSABOUTUS);
    if (file_exists(NUKE_MODULES_DIR.$module_name.'/copyright.php')) {
        OpenTable();
        echo "<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" align=\"center\">";
        echo "<tr><td valign=\"top\"><br />";
        echo "<div align=\"justify\"><span class=\"content\">";
        if (file_exists(NUKE_MODULES_DIR.$module_name."/about-".$currentlang.".txt")) {
            include(NUKE_MODULES_DIR.$module_name.'/about-'.$currentlang.'.txt');
        } else {
            include(NUKE_MODULES_DIR.$module_name.'/about-english.txt');
        }
        echo "</span></div>";
        ns_doc_questions();
        echo "<br /></td></tr></table>";
        ns_doc_links();
        CloseTable();
      } else {
        OpenTable();
        echo _NSNOCOPY;
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

switch ($op) {

    default:
    about();
    break;

}

?>