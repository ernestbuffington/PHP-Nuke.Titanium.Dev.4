<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            lang_admin_statistics.php [English]
 *                              -------------------
 *     begin                : Fri Jan 24 2003
 *     copyright            : (C) 2003 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *
 *     $Id: lang_admin_statistics.php,v 1.21 2003/03/16 18:38:29 acydburn Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

$titanium_lang['LEFT_Package_Module'] = 'Package Module';
$titanium_lang['Install_module'] = 'Install Module';
$titanium_lang['Manage_modules'] = 'Manage Modules';
$titanium_lang['Stats_configuration'] = 'Configuration';
$titanium_lang['Edit_module'] = 'Edit Module';
$titanium_lang['Stats_langcp'] = 'Language CP';

// Package Module
$titanium_lang['Package_module'] = 'Package Module';
$titanium_lang['Package_module_explain'] = 'Here you are able to package your three module files to one Module Package for delivery.';
$titanium_lang['Select_info_file'] = 'Select info file';
$titanium_lang['Select_lang_file'] = 'Select language file';
$titanium_lang['Select_module_file'] = 'Select module php file';
$titanium_lang['Package_name'] = 'Package name';
$titanium_lang['Create'] = 'Create';

// Install Module
$titanium_lang['Install_module_explain'] = 'Here you are able to install a new Module. You are able to do this with two methods. The first one is uploading your Module Package with the provided form you see below. If uploading does not work for you, you are able to upload the Module Package to your ./modules/pakfiles directory, it will be displayed automatically here then. For further Instructions how to install a Module Package, have a look at the provided Documentation.<br />After you have chosen a Module Package to install, you will be prompted with some Informations about the Module you have chosen. Please make sure the Module Informations are correct and that you meet the minimum requirements (i.e. the correct Statistics Mod Version). You are able to choose the Language you want to install with too. After you have verified everything and you are sure to install, click the Install Button.<br />The default Installation let the Module deactivated, you have to activate it before it shows up within the Statistics Page.';
$titanium_lang['Select_module_pak'] = 'Select Module Package';
$titanium_lang['Upload_module_pak'] = 'Upload Module Package';
$titanium_lang['Inst_module_already_exist'] = 'Module with the name \'%s\' already exist.<br />If you want to update this Module, you have to go to Module Management and Update the Module there.<br />If you want to completely reinstall this Module, you have to uninstall the old Module first.';
$titanium_lang['Incorrect_update_module'] = 'The selected Package is not an update to the selected Module. Please be sure you have selected the correct Package.';

$titanium_lang['Module_name'] = 'Module Name';
$titanium_lang['Module_description'] = 'Module Description';
$titanium_lang['Module_version'] = 'Module Version';
$titanium_lang['Required_stats_version'] = 'Minimum required Statistics Mod Version';
$titanium_lang['Installed_stats_version'] = 'Installed Statistics Mod Version';
$titanium_lang['Module_author'] = 'Module Author';
$titanium_lang['Author_email'] = 'Author E-Mail Address';
$titanium_lang['Module_url'] = 'Module/Author Homepage';
$titanium_lang['Update_url'] = 'Module update Homepage (Check for Updates)';
$titanium_lang['Provided_language'] = 'Provided Language';
$titanium_lang['Install_language'] = 'Install Language';
$titanium_lang['Module_installed'] = 'Module successfully installed.';
$titanium_lang['Module_updated'] = 'Module successfully updated.';

// Manage Modules
$titanium_lang['Manage_modules_explain'] = 'Here you are able to manage your Modules. You can edit them, delete them, change the order, activate and deactivate them. If you want to configure your Module (setting Permissions, editing the Language Variables and much more), you have to edit your Module.<br />If you click at a Module Name, you will see a preview of this Module.';
$titanium_lang['Deactivate'] = 'Deactivate';
$titanium_lang['Activate'] = 'Activate';

// Delete Module
$titanium_lang['Confirm_delete_module'] = 'Are you sure you want to delete this Module';

// Configuration
$titanium_lang['Msg_config_updated'] = '- Statistics Mod Configuration successfully updated.';
$titanium_lang['Msg_reset_view_count'] = '- View Count successfully resetted.';
$titanium_lang['Msg_reset_install_date'] = '- Install Date set to today.';
$titanium_lang['Msg_reset_cache'] = '- Successfully cleared all caches.';
$titanium_lang['Msg_purge_modules'] = '- Successfully deleted the modules directory content.';
$titanium_lang['Config_title'] = 'Statistics Configuration';
$titanium_lang['Config_explain'] = 'Here you are able to configure the Statistics Mod.';
$titanium_lang['Messages'] = 'Messages';
$titanium_lang['Return_limit'] = 'Return Limit';
$titanium_lang['Return_limit_explain'] = 'The number of items to include in each ranking.';
$titanium_lang['Reset_settings_title'] = 'Reset Settings';
$titanium_lang['Reset_view_count'] = 'Reset view count';
$titanium_lang['Reset_view_count_explain'] = 'Reset the view count at the bottom of the statistics page to zero.';
$titanium_lang['Reset_install_date'] = 'Reset install date';
$titanium_lang['Reset_install_date_explain'] = 'Reset the install date. This will set the install date to today.';
$titanium_lang['Reset_cache'] = 'Clear Cache';
$titanium_lang['Reset_cache_explain'] = 'Clear all the current cached data for all modules and content templates.';
$titanium_lang['Purge_module_dir'] = 'Clear Module Directory';
$titanium_lang['Purge_module_dir_explain'] = 'Delete the complete Modules Directory, all subdirectories and files will be deleted. Please use this Option with only if you are completely sure what you do and which effect this will have to your Statistics.';

// Edit Module
$titanium_lang['Msg_changed_update_time'] = '- Successfully changed update time.';
$titanium_lang['Msg_cleared_module_cache'] = '- Successfully cleared Module cache.';
$titanium_lang['Msg_module_fields_updated'] = '- Updated Module definable fields successfully.';

$titanium_lang['Module_select_title'] = 'Select Module';
$titanium_lang['Module_select_explain'] = 'Here you can select the Module you want to edit.';
$titanium_lang['Edit_module_explain'] = 'Here you are able to configure the Module. At the Top you see some Module Informations, then the Message Window where all Update Messages are displayed. At the Buttom you will find the Configuration Area and the Update Module Area. Within the Update Module Area, please select an Module Package \'or\' upload a Module Package, not both please.<br />The Configuration Area may differ from Module to Module, because some Modules have special Configuration Options the Author thought would be helpful for you.';
$titanium_lang['Module_informations'] = 'Module Informations';
$titanium_lang['Module_languages'] = 'Languages linked to this Module';
$titanium_lang['Preview_module'] = 'Preview Module';
$titanium_lang['Module_configuration'] = 'Module Configuration';
$titanium_lang['Update_time'] = 'Update Time in Minutes';
$titanium_lang['Update_time_explain'] = 'Time Intervall (in Minutes) of refreshing the cached data with new Data. Every x Minutes the Module get reloaded.<br />Since the Statistics is using an priority system, this could be greater than x minutes, but not more than one day.';
$titanium_lang['Module_status'] = 'Module Status';
$titanium_lang['Active'] = 'Active';
$titanium_lang['Not_active'] = 'Not active';
$titanium_lang['Clear_module_cache'] = 'Clear module cache';
$titanium_lang['Clear_module_cache_explain'] = 'Clear the module cache and reset the modules priority. The next time the Statistics Page is called, this Module get reloaded.';
$titanium_lang['Update_module'] = 'Update Module';
$titanium_lang['No_module_packages_found'] = 'No module packages found';

// Permissions
$titanium_lang['Msg_permissions_updated'] = '- Permissions updated';
$titanium_lang['Permissions'] = 'Permissions';
$titanium_lang['Set_permissions_title'] = 'Here you are able to set the Permission to view a Module. Only the Users (Anonymous, Registered, Moderators and Administrators) and Groups allowed/listed here are able to view the Module within the Statistics Page.';
$titanium_lang['Perm_all'] = 'Anonymous Users';
$titanium_lang['Perm_reg'] = 'Registered Users';
$titanium_lang['Perm_mod'] = 'Moderators';
$titanium_lang['Perm_admin'] = 'Administrators';
$titanium_lang['Perm_group'] = 'Groups';
$titanium_lang['Added_groups'] = 'Added Groups';
$titanium_lang['Perm_add_group'] = 'Add Group';
$titanium_lang['Perm_remove_group'] = 'Remove Group';
$titanium_lang['Perm_groups_title'] = 'Groups able to see the Module';
$titanium_lang['No_groups_selected'] = 'No groups selected';
$titanium_lang['No_groups_to_add'] = 'There are no more groups to add';

// Language CP
$titanium_lang['Language_key'] = 'Language Variable -> Key';
$titanium_lang['Language_value'] = 'Language Variable -> Value';
$titanium_lang['Update_all_lang'] = 'Update All Entries';
$titanium_lang['Add_new_key'] = 'Add new key';
$titanium_lang['Create_new_lang'] = 'Create new Language';
$titanium_lang['Delete_language'] = 'Delete Language';
$titanium_lang['Language_cp_title'] = 'Language Control Panel';
$titanium_lang['Language_cp_explain'] = 'Here you are able to manage all Language Variables and Language Packs for every Module, seperate, at all... nearly everything. You are able to Import or Export Language Packs here too.';
$titanium_lang['Export_lang_module'] = 'Export Language for current module';
$titanium_lang['Export_language'] = 'Export complete current language';
$titanium_lang['Export_everything'] = 'Export everything';
$titanium_lang['Import_new_language'] = 'Import new Language';
$titanium_lang['Import_new_language_explain'] = 'Here you are able to upload (or select) the Language Pack you want to install. After you have uploaded (or selected) the Language Pack, you will see some Informations about the Language Pack. Only after viewing this Informations the Pack will be installed.';
$titanium_lang['Select_language_pak'] = 'Select Language Package';
$titanium_lang['Upload_language_pak'] = 'Upload Language Package';

$titanium_lang['Language'] = 'Language';
$titanium_lang['Modules'] = 'Modules';
$titanium_lang['Language_pak_installed'] = 'Language Pack successfully installed.';

?>