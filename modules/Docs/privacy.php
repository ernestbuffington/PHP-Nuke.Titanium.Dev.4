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

function privacy() {
    global $sitename, $adminmail, $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    title("$sitename: "._NSPRIVACY."");
    if (file_exists(NUKE_MODULES_DIR.$module_name.'/copyright.php')) {
        OpenTable();
        echo "<br /><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\" align=\"center\">";
        echo "<tr><td valign=\"top\">";
        echo "<div align=\"justify\">"._NSPRIVACY1." <strong>$sitename</strong>. "._NSPRIVACY2."</div>";
        echo "<br /><br /><div align=\"justify\"><span class=\"content\">";
        echo "<strong><u>"._NSPRIVACY3."</u></strong><br />";
        echo "<strong>$sitename</strong> "._NSPRIVACY4."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY5."</u></strong><br />";
        echo ""._NSPRIVACY6." <strong>$sitename</strong> "._NSPRIVACY7.", <strong>$sitename</strong> "._NSPRIVACY8."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY9."</u></strong><br />";
        echo "<strong>$sitename</strong> "._NSPRIVACY10."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY11."</u></strong><br />";
        echo ""._NSPRIVACY12." <strong>$sitename</strong> "._NSPRIVACY13."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY14."</u></strong><br />";
        echo ""._NSPRIVACY15." <strong>$sitename</strong> "._NSPRIVACY16." <strong>$sitename</strong>. "._NSPRIVACY17." ";
        echo "<strong>$sitename</strong> "._NSPRIVACY18." <strong>$sitename</strong>.";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY19."</u></strong><br />";
        echo ""._NSPRIVACY20." <strong>$sitename</strong> "._NSPRIVACY21."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY22."</u></strong><br />";
        echo ""._NSPRIVACY23."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY24."</u></strong><br />";
        echo ""._NSPRIVACY25." <strong>$sitename</strong> "._NSPRIVACY26." <strong>$sitename</strong> "._NSPRIVACY27."";
        echo "<br /><br />";
        echo "<strong><u>"._NSPRIVACY28."</u></strong><br />";
        echo ""._NSPRIVACY29."";
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
        privacy();
    break;

}

?>