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

function terms() {
    global $sitename, $module_name, $adminmail;
    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._NSTERMS);
    if (file_exists(NUKE_MODULES_DIR.$module_name.'/copyright.php')) {
        OpenTable();
        echo "<br /><table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" align=\"center\">";
        echo "<tr><td valign=\"top\">";
        echo "<div align=\"justify\"><span class=\"content\">";
        echo "<strong>"._NSTERMSUSE1."</strong><br />";
        echo ""._NSTERMSUSE1a." ";
        echo "<a href=\"modules.php?name=$module_name&amp;file=privacy\" target=\"_blank\">";
        echo ""._NSPRIVACY."</a>, "._NSTERMSUSE1b."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE2."</strong><br />";
        echo ""._NSTERMSUSE2a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE3."</strong><br />";
        echo ""._NSTERMSUSE3a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE4."</strong><br />";
        echo ""._NSTERMSUSE4a." ";
        echo "<a href=\"modules.php?name=$module_name&amp;file=privacy\" target=\"_blank\">";
        echo ""._NSPRIVACY."</a>.";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE5."</strong><br />";
        echo ""._NSTERMSUSE5a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE6."</strong><br />";
        echo ""._NSTERMSUSE6a."";
        echo "<br /><br />";
        echo ""._NSTERMSUSE6b."";
        echo "<br /><br />";
        echo ""._NSTERMSUSE6c."";
        echo "<br />";
        echo ""._NSTERMSUSE6d."";
        echo "<br />";
        echo ""._NSTERMSUSE6e."";
        echo "<br />";
        echo ""._NSTERMSUSE6f."";
        echo "<br />";
        echo ""._NSTERMSUSE6g."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE7."</strong><br />";
        echo ""._NSTERMSUSE7a."<br />";
        echo ""._NSTERMSUSE7b."";
        echo "<br />";
        echo ""._NSTERMSUSE7c."";
        echo "<br />";
        echo ""._NSTERMSUSE7d."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE8."</strong><br />";
        echo ""._NSTERMSUSE8a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE9."</strong><br />";
        echo ""._NSTERMSUSE9a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE10."</strong><br />";
        echo ""._NSTERMSUSE10a."";
        echo "<br /><br />";
        echo ""._NSTERMSUSE10b."";
        echo "<br /><br />";
        echo ""._NSTERMSUSE10c."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE11."</strong><br />";
        echo ""._NSTERMSUSE11a."";
        echo "<br /><br />";
        echo ""._NSTERMSUSE11b."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE12."</strong><br />";
        echo ""._NSTERMSUSE12a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE13."</strong><br />";
        echo ""._NSTERMSUSE13a."";
        echo "<br /><br />";
        echo "<strong>"._NSTERMSUSE14."</strong><br />";
        echo ""._NSTERMSUSE14a."";
        echo "<br />";
        echo ""._NSTERMSUSE14b."";
        echo "<br />";
        echo ""._NSTERMSUSE14c."";
        echo "<br />";
        echo ""._NSTERMSUSE14d."";
        echo "<br /><br />";
        echo "</span></div>";
        ns_doc_questions();
        echo "<br /></td></tr></table>";
        ns_doc_links();
        CloseTable();
        } else {
        OpenTable();
        echo ""._NSNOCOPY."";
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

switch ($op) {

    default:
        terms();
    break;

}

?>