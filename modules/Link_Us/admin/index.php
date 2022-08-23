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

	$module_name = basename(dirname(dirname(__FILE__)));

	if(!is_mod_admin($module_name)) 
	{
    	DisplayError('<strong>'._ERROR.'</strong><br /><br />'._ADMIN_NO_MODULE_RIGHTS.$module_name);	
	} 
	else 
	{
		global $db, $admin_file, $currentlang, $userinfo;
	
		get_lang($module_name);
		include(NUKE_BASE_DIR.'header.php');
		include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/functions.php');
	
		switch($op)
		{
		//case 'approve_button':
			//	$db->sql_query("UPDATE `". $prefix ."_link_us` SET `site_status` = '1' WHERE `id` = '".$id."'");
			//	redirect($admin_file .'.php?op=active_sites');
			//break;
			case 'add_button':                include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_add.php'); break;		
			case 'insert_button':             include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_save.php'); break;	
			case 'edit_button':               include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/edit_button.php'); break;		
			case 'delete_button':             include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_delete.php'); break;	
			case 'approve_button':            include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_approve.php'); break;
			case 'edit_button_save':          include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/edit_button_save.php'); break;	
			case 'active_sites':              include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/active_sites.php'); break;	
			case 'inactive_sites':            include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/inactive_sites.php'); break;	
			case 'lu_block_config': 	      include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/block_config.php'); break;	
			case 'lu_update_block_settings':  include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/block_config_save.php'); break;	
			case 'module_config':             include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/module_config.php'); break;	
			case 'update_module_settings':    include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/module_config_save.php'); break;	
			case 'admin_config':              include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/admin_config.php'); break;	
			case 'update_main':               include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/update_main_save.php'); break;
			case 'button_pending':            include_once(NUKE_MODULES_DIR.$module_name.'/admin/inc/button_pending.php'); break;	
			default: LinkusAdminMain(); break;	
	}

	include(NUKE_BASE_DIR.'footer.php');

}

?>