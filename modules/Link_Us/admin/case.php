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
 
$pnt_module = basename(dirname(dirname(__FILE__)));

$lang_path = NUKE_MODULES_DIR . $pnt_module . '/language/';
if (@file_exists($lang_path . 'lang-' . $currentlang . '.php'))
{
    @include_once($lang_path . 'lang-' . $currentlang . '.php');
}
elseif (@file_exists($lang_path . 'lang-' . $phpbb2_board_config['default_lang'] . '.php'))
{
    @include_once($lang_path . 'lang-' . $phpbb2_board_config['default_lang'] . '.php');
}
else
{
    DisplayError(_NO_ADMIN_MODULE_LANGUAGE_FOUND . $pnt_module);
}

switch($op) {

    case 'link_us':
	case 'add_button':
	case 'insert_button':
	case 'edit_button':
	case 'delete_button':
	case 'approve_button':
	case 'edit_button_save':
	case 'active_sites':
	case 'inactive_sites':
	case 'admin_config':
	case 'update_main':
	case 'lu_block_config':
	case 'lu_update_block_settings':
	case 'module_config':
	case 'update_module_settings':
	case 'button_pending':
    include(NUKE_MODULES_DIR.$pnt_module.'/admin/index.php');
    break;

}

?>