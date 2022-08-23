<?php

/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 (c) 2007 - 2018 by Lonestar Modules - https://lonestar-modules.com
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

function LinkusTableOpen() {

    	echo "<table width='100%' border='0' cellspacing='1' cellpadding='0' align='center'><tr><td class='extras'>\n";
    	echo "<table width='100%' border='0' cellspacing='1' cellpadding='8'><tr><td>\n";
		
}

function LinkusTableClose() {
	
    	echo "</td></tr></table></td></tr></table>\n";
		
}

function check_image_type($type) {
  switch($type) {
    case 'image/jpeg':
    case 'image/pjpeg':
    case 'image/jpg':
      return '.jpg';
      break;
    case 'image/gif':
      return '.gif';
      break;
    case 'image/png':
      return '.png';
      break;
    default:
      return false;
      break;
  }
  return false;
}

function LinkusAdminMain(){
	
		global $prefix, $db, $lang_new, $module_name, $admin_file;	
		$config = $db->sql_ufetchrow("SELECT * FROM `".$prefix."_link_us_config` LIMIT 0,1");
		list($pending) = $db->sql_fetchrow($db->sql_query("SELECT COUNT(*) FROM `".$prefix."_link_us` WHERE `site_status` = '3'"));
		
		if (!empty($config) || is_array($config)) {
		
		$uploaddir = $config['upload_file'];

	OpenTable();

		echo "<div align='center'><a href='".$admin_file.".php?op=link_us'>" .$lang_new[$module_name]['ADMINISTRATION']. "</a></div>";
		echo "<br /><br />";
        echo "<div align='center'>[ <a href='".$admin_file.".php'>" .$lang_new[$module_name]['MAIN_ADMINISTRATION']. "</a> ]</div>\n";
	
	CloseTable();
	OpenTable();

		echo "<br />";
		
		echo "<div align=\"center\"><img src=\"modules/".$module_name."/images/linkus-logo.png\"></div>";
		
		echo "<br />";
		
		echo "<div align='center'>You Have ( <a href='".$admin_file.".php?op=button_pending'>".$pending."</a> ) Site Buttons Pending</div>";
		
		echo "<br /><br />";
		
		echo "<table width='60%' border='1' cellpadding='4' cellspacing='4' style='margin: auto;'>
		  <tr align='center'>
			<td width='30%' align='center'><a href='".$admin_file.".php?op=add_button'><img src='modules/".$module_name."/images/button-add.png' border='0'><br />".$lang_new[$module_name]['ADD_LINK_BUTTON']."</a></td>
			<td width='30%'><a href='".$admin_file.".php?op=lu_block_config'><img src='modules/".$module_name."/images/block-config.png' border='0'><br />".$lang_new[$module_name]['BLOCK_CONFIG']."</a></td>
		    <td width='30%'><a href='".$admin_file.".php?op=module_config'><img src='modules/".$module_name."/images/module-config.png' border='0'><br />".$lang_new[$module_name]['MODULE_CONFIG']."</a></td>
		  </tr>
		  <tr align='center'>
		    <td width='30%'><a href='".$admin_file.".php?op=admin_config'><img src='modules/".$module_name."/images/admin-config.png' border='0'><br />".$lang_new[$module_name]['ADMIN_CONFIG']."</a></td>
		    <td width='30%'><a href='".$admin_file.".php?op=active_sites'><img src='modules/".$module_name."/images/active-sites.png' border='0'><br />".$lang_new[$module_name]['VIEW_ACTIVE_SITES']."</a></td>
		    <td width='30%'><a href='".$admin_file.".php?op=inactive_sites'><img src='modules/".$module_name."/images/inactive-sites.png' border='0'><br />".$lang_new[$module_name]['VIEW_INACTIVE_SITES']."</a></td>
		  </tr>
		</table>";

	CloseTable();
	
	} else {
	
        DisplayError('<strong>'._ERROR.'</strong><br /><br />' . $lang_new[$module_name]['CONFIG_ERROR'] . $module_name);
		
    }
	
} // Function LinkusAdminMain() End
	
?>