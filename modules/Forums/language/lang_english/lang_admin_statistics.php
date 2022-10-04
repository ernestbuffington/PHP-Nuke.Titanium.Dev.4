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

$lang['LEFT_Package_Module'] = 'Package Module';
$lang['Install_module'] = 'Install Module';
$lang['Manage_modules'] = 'Manage Modules';
$lang['Stats_configuration'] = 'Configuration';
$lang['Edit_module'] = 'Edit Module';
$lang['Stats_langcp'] = 'Language CP';

// Package Module
$lang['Package_module'] = 'Package Module';
$lang['Package_module_explain'] = 'Here you are able to package your three module files to one Module Package for delivery.';
$lang['Select_info_file'] = 'Select info file';
$lang['Select_lang_file'] = 'Select language file';
$lang['Select_module_file'] = 'Select module php file';
$lang['Package_name'] = 'Package name';
$lang['Create'] = 'Create';

// Install Module
$lang['Install_module_explain'] = 'Here you are able to install a new Module. You are able to do this with two methods. The first one is uploading your Module Package with the provided form you see below. If uploading does not work for you, you are able to upload the Module Package to your ./modules/pakfiles directory, it will be displayed automatically here then. For further Instructions how to install a Module Package, have a look at the provided Documentation.<br />After you have chosen a Module Package to install, you will be prompted with some Informations about the Module you have chosen. Please make sure the Module Informations are correct and that you meet the minimum requirements (i.e. the correct Statistics Mod Version). You are able to choose the Language you want to install with too. After you have verified everything and you are sure to install, click the Install Button.<br />The default Installation let the Module deactivated, you have to activate it before it shows up within the Statistics Page.';
$lang['Select_module_pak'] = 'Select Module Package';
$lang['Upload_module_pak'] = 'Upload Module Package';
$lang['Inst_module_already_exist'] = 'Module with the name \'%s\' already exist.<br />If you want to update this Module, you have to go to Module Management and Update the Module there.<br />If you want to completely reinstall this Module, you have to uninstall the old Module first.';
$lang['Incorrect_update_module'] = 'The selected Package is not an update to the selected Module. Please be sure you have selected the correct Package.';

$lang['Module_name'] = 'Module Name';
$lang['Module_description'] = 'Module Description';
$lang['Module_version'] = 'Module Version';
$lang['Required_stats_version'] = 'Minimum required Statistics Mod Version';
$lang['Installed_stats_version'] = 'Installed Statistics Mod Version';
$lang['Module_author'] = 'Module Author';
$lang['Author_email'] = 'Author E-Mail Address';
$lang['Module_url'] = 'Module/Author Homepage';
$lang['Update_url'] = 'Module update Homepage (Check for Updates)';
$lang['Provided_language'] = 'Provided Language';
$lang['Install_language'] = 'Install Language';
$lang['Module_installed'] = 'Module successfully installed.';
$lang['Module_updated'] = 'Module successfully updated.';

// Manage Modules
$lang['Manage_modules_explain'] = 'Here you are able to manage your Modules. You can edit them, delete them, change the order, activate and deactivate them. If you want to configure your Module (setting Permissions, editing the Language Variables and much more), you have to edit your Module.<br />If you click at a Module Name, you will see a preview of this Module.';
$lang['Deactivate'] = 'Deactivate';
$lang['Activate'] = 'Activate';

// Delete Module
$lang['Confirm_delete_module'] = 'Are you sure you want to delete this Module';

// Configuration
$lang['Msg_config_updated'] = '- Statistics Mod Configuration successfully updated.';
$lang['Msg_reset_view_count'] = '- View Count successfully resetted.';
$lang['Msg_reset_install_date'] = '- Install Date set to today.';
$lang['Msg_reset_cache'] = '- Successfully cleared all caches.';
$lang['Msg_purge_modules'] = '- Successfully deleted the modules directory content.';
$lang['Config_title'] = 'Statistics Configuration';
$lang['Config_explain'] = 'Here you are able to configure the Statistics Mod.';
$lang['Messages'] = 'Messages';
$lang['Return_limit'] = 'Return Limit';
$lang['Return_limit_explain'] = 'The number of items to include in each ranking.';
$lang['Reset_settings_title'] = 'Reset Settings';
$lang['Reset_view_count'] = 'Reset view count';
$lang['Reset_view_count_explain'] = 'Reset the view count at the bottom of the statistics page to zero.';
$lang['Reset_install_date'] = 'Reset install date';
$lang['Reset_install_date_explain'] = 'Reset the install date. This will set the install date to today.';
$lang['Reset_cache'] = 'Clear Cache';
$lang['Reset_cache_explain'] = 'Clear all the current cached data for all modules and content templates.';
$lang['Purge_module_dir'] = 'Clear Module Directory';
$lang['Purge_module_dir_explain'] = 'Delete the complete Modules Directory, all subdirectories and files will be deleted. Please use this Option with only if you are completely sure what you do and which effect this will have to your Statistics.';

// Edit Module
$lang['Msg_changed_update_time'] = '- Successfully changed update time.';
$lang['Msg_cleared_module_cache'] = '- Successfully cleared Module cache.';
$lang['Msg_module_fields_updated'] = '- Updated Module definable fields successfully.';

$lang['Module_select_title'] = 'Select Module';
$lang['Module_select_explain'] = 'Here you can select the Module you want to edit.';
$lang['Edit_module_explain'] = 'Here you are able to configure the Module. At the Top you see some Module Informations, then the Message Window where all Update Messages are displayed. At the Buttom you will find the Configuration Area and the Update Module Area. Within the Update Module Area, please select an Module Package \'or\' upload a Module Package, not both please.<br />The Configuration Area may differ from Module to Module, because some Modules have special Configuration Options the Author thought would be helpful for you.';
$lang['Module_informations'] = 'Module Informations';
$lang['Module_languages'] = 'Languages linked to this Module';
$lang['Preview_module'] = 'Preview Module';
$lang['Module_configuration'] = 'Module Configuration';
$lang['Update_time'] = 'Update Time in Minutes';
$lang['Update_time_explain'] = 'Time Intervall (in Minutes) of refreshing the cached data with new Data. Every x Minutes the Module get reloaded.<br />Since the Statistics is using an priority system, this could be greater than x minutes, but not more than one day.';
$lang['Module_status'] = 'Module Status';
$lang['Active'] = 'Active';
$lang['Not_active'] = 'Not active';
$lang['Clear_module_cache'] = 'Clear module cache';
$lang['Clear_module_cache_explain'] = 'Clear the module cache and reset the modules priority. The next time the Statistics Page is called, this Module get reloaded.';
$lang['Update_module'] = 'Update Module';
$lang['No_module_packages_found'] = 'No module packages found';

// Permissions
$lang['Msg_permissions_updated'] = '- Permissions updated';
$lang['Permissions'] = 'Permissions';
$lang['Set_permissions_title'] = 'Here you are able to set the Permission to view a Module. Only the Users (Anonymous, Registered, Moderators and Administrators) and Groups allowed/listed here are able to view the Module within the Statistics Page.';
$lang['Perm_all'] = 'Anonymous Users';
$lang['Perm_reg'] = 'Registered Users';
$lang['Perm_mod'] = 'Moderators';
$lang['Perm_admin'] = 'Administrators';
$lang['Perm_group'] = 'Groups';
$lang['Added_groups'] = 'Added Groups';
$lang['Perm_add_group'] = 'Add Group';
$lang['Perm_remove_group'] = 'Remove Group';
$lang['Perm_groups_title'] = 'Groups able to see the Module';
$lang['No_groups_selected'] = 'No groups selected';
$lang['No_groups_to_add'] = 'There are no more groups to add';

// Language CP
$lang['Language_key'] = 'Language Variable -> Key';
$lang['Language_value'] = 'Language Variable -> Value';
$lang['Update_all_lang'] = 'Update All Entries';
$lang['Add_new_key'] = 'Add new key';
$lang['Create_new_lang'] = 'Create new Language';
$lang['Delete_language'] = 'Delete Language';
$lang['Language_cp_title'] = 'Language Control Panel';
$lang['Language_cp_explain'] = 'Here you are able to manage all Language Variables and Language Packs for every Module, seperate, at all... nearly everything. You are able to Import or Export Language Packs here too.';
$lang['Export_lang_module'] = 'Export Language for current module';
$lang['Export_language'] = 'Export complete current language';
$lang['Export_everything'] = 'Export everything';
$lang['Import_new_language'] = 'Import new Language';
$lang['Import_new_language_explain'] = 'Here you are able to upload (or select) the Language Pack you want to install. After you have uploaded (or selected) the Language Pack, you will see some Informations about the Language Pack. Only after viewing this Informations the Pack will be installed.';
$lang['Select_language_pak'] = 'Select Language Package';
$lang['Upload_language_pak'] = 'Upload Language Package';

$lang['Language'] = 'Language';
$lang['Modules'] = 'Modules';
$lang['Language_pak_installed'] = 'Language Pack successfully installed.';

?>