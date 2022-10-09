<?php
#########################################################################
# Titanium Network Information v2.0                                     #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
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

function main() {
    global $sitename, $module_name, $questions;
    include_once(NUKE_BASE_DIR.'header.php');
    title($sitename.': '._NSINDEXLEGAL);
    if (file_exists(NUKE_MODULES_DIR.$module_name.'/copyright.php')) {
        OpenTable();
	    # space at the top of header inside graphics area!
        echo '<div align="center" style="padding-top:10px;">';
        echo '</div>';

		echo '<div align="center"><h1>The 86it Developers Network Disclaimer</h1></div>';
        
		
		echo "<br /><br /><div align=\"justify\">";
        echo "<strong>$sitename</strong> "._NSINDEX1." <strong>$sitename</strong> "._NSINDEX2."<br /><br />";
        echo ""._NSINDEX3." <strong>$sitename</strong> "._NSINDEX4."<br /><br />";
        echo ""._NSINDEX5." ";
        ns_doc_questions();
        echo "</div><br /><br />";
        ns_doc_links();
        CloseTable();
        } 
		else 
		{
        OpenTable();
        
		echo ""._NSNOCOPY."";
        
		CloseTable();
    }
  include_once(NUKE_BASE_DIR.'footer.php');
}

switch ($op) {

    default:
        main();
    break;

}

?>