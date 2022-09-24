<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/**
*
* attachment mod admin [English]
*
* @package attachment_mod
* @version $Id: lang_admin_attach.php,v 1.3 2005/11/20 13:38:55 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!isset($titanium_lang) || !is_array($titanium_lang))
{
    $titanium_lang = array();
}

//
// Attachment Mod Admin Language Variables
//

// Modules, this replaces the keys used
$titanium_lang['Control_Panel'] = 'Control Panel';
$titanium_lang['Shadow_attachments'] = 'Shadow Attachments';
$titanium_lang['Forbidden_extensions'] = 'Forbidden Extensions';
$titanium_lang['Extension_control'] = 'Extension Control';
$titanium_lang['Extension_group_manage'] = 'Extension Groups Control';
$titanium_lang['Special_categories'] = 'Special Categories';
$titanium_lang['Sync_attachments'] = 'Synchronize Attachments';
$titanium_lang['Quota_limits'] = 'Quota Limits';

// Attachments -> Management
$titanium_lang['Attach_settings'] = 'Attachment Settings';
$titanium_lang['Manage_attachments_explain'] = 'Here you can configure the Main Settings for the Attachment Mod. If you press the Test Settings Button, the Attachment Mod does a few System Tests to be sure that the Mod will work properly. If you have problems with uploading Files, please run this Test, to get a detailed error-message.';
$titanium_lang['Attach_filesize_settings'] = 'Attachment Filesize Settings';
$titanium_lang['Attach_number_settings'] = 'Attachment Number Settings';
$titanium_lang['Attach_options_settings'] = 'Attachment Options';

$titanium_lang['Upload_directory'] = 'Upload Directory';
$titanium_lang['Upload_directory_explain'] = 'Enter the relative path from your phpBB2 installation to the Attachments upload directory. For example, enter \'modules/Forums/files\' if your phpBB2 Installation is located at http://www.yourdomain.com/modules/Forums and the Attachment Upload Directory is located at http://www.yourdomain.com/modules/Forums/files.';
$titanium_lang['Attach_img_path'] = 'Attachment Posting Icon';
$titanium_lang['Attach_img_path_explain'] = 'This Image is displayed next to Attachment Links in individual Postings. Leave this field empty if you don\'t want an icon to be displayed. This Setting will be overwritten by the Settings in Extension Groups Management.';
$titanium_lang['Attach_topic_icon'] = 'Attachment Topic Icon';
$titanium_lang['Attach_topic_icon_explain'] = 'This Image is displayed before topics with Attachments. Leave this field empty if you don\'t want an icon to be displayed.';
$titanium_lang['Attach_display_order'] = 'Attachment Display Order';
$titanium_lang['Attach_display_order_explain'] = 'Here you can choose whether to display the Attachments in Posts/PMs in Descending Filetime Order (Newest Attachment First) or Ascending Filetime Order (Oldest Attachment First).';
$titanium_lang['Show_apcp'] = 'Show new Attachment Posting Control Panel';
$titanium_lang['Show_apcp_explain'] = 'Choose whether to display the Attachment Posting Control Panel (yes) or the old method with two Boxes for Attaching Files and editing your posted Attachments (no) within your Posting Screen. The look of it is very hard to explain, therefore it\'s best to try it out.';

$titanium_lang['Max_filesize_attach'] = 'Filesize';
$titanium_lang['Max_filesize_attach_explain'] = 'Maximum filesize for Attachments. A value of 0 means \'unlimited\'. This Setting is restricted by your Server Configuration. For example, if your php Configuration only allows a maximum of 2 MB uploads, this cannot be overwritten by the Mod.';
$titanium_lang['Attach_quota'] = 'Attachment Quota';
$titanium_lang['Attach_quota_explain'] = 'Maximum Disk Space ALL Attachments can hold on your Webspace. A value of 0 means \'unlimited\'.';
$titanium_lang['Max_filesize_pm'] = 'Maximum Filesize in Private Messages Folder';
$titanium_lang['Max_filesize_pm_explain'] = 'Maximum Disk Space Attachments can use up in each User\'s Private Message box. A value of 0 means \'unlimited\'.';
$titanium_lang['Default_quota_limit'] = 'Default Quota Limit';
$titanium_lang['Default_quota_limit_explain'] = 'Here you are able to select the Default Quota Limit automatically assigned to newly registered Users and Users without an defined Quota Limit. The Option \'No Quota Limit\' is for not using any Attachment Quotas, instead using the default Settings you have defined within this Management Panel.';

$titanium_lang['Max_attachments'] = 'Maximum Number of Attachments';
$titanium_lang['Max_attachments_explain'] = 'The maximum number of attachments allowed in one post.';
$titanium_lang['Max_attachments_pm'] = 'Maximum number of Attachments in one Private Message';
$titanium_lang['Max_attachments_pm_explain'] = 'Define the maximum number of attachments the user is allowed to include in a private message.';

$titanium_lang['Disable_mod'] = 'Disable Attachment Mod';
$titanium_lang['Disable_mod_explain'] = 'This option is mainly for testing new templates or themes, it disables all Attachment Functions except the Admin Panel.';
$titanium_lang['PM_Attachments'] = 'Allow Attachments in Private Messages';
$titanium_lang['PM_Attachments_explain'] = 'Allow/Disallow attaching files to Private Messages.';
$titanium_lang['Ftp_upload'] = 'Enable FTP Upload';
$titanium_lang['Ftp_upload_explain'] = 'Enable/Disable the FTP Upload option. If you set it to yes, you have to define the Attachment FTP Settings and the Upload Directory is no longer used.';
$titanium_lang['Attachment_topic_review'] = 'Do you want to display Attachments in the Topic Review Window ?';
$titanium_lang['Attachment_topic_review_explain'] = 'If you choose yes, all attached Files will be displayed in Topic Review when you post a reply.';

$titanium_lang['Ftp_server'] = 'FTP Upload Server';
$titanium_lang['Ftp_server_explain'] = 'Here you can enter the IP-Address or FTP-Hostname of the Server used for your uploaded files. If you leave this field empty, the Server on which your phpBB2 Board is installed will be used. Please note that it is not allowed to add ftp:// or something else to the address, just plain ftp.foo.com or, which is a lot faster, the plain IP Address.';

$titanium_lang['Attach_ftp_path'] = 'FTP Path to your upload directory';
$titanium_lang['Attach_ftp_path_explain'] = 'The Directory where your Attachments will be stored. This Directory doesn\'t have to be chmodded. Please don\'t enter your IP or FTP-Address here, this input field is only for the FTP Path.<br />For example: /home/web/uploads';
$titanium_lang['Ftp_download_path'] = 'Download Link to FTP Path';
$titanium_lang['Ftp_download_path_explain'] = 'Enter the URL to your FTP Path, where your Attachments are stored.<br />If you are using a Remote FTP Server, please enter the complete url, for example http://www.mystorage.com/phpBB2/upload.<br />If you are using your Local Host to store your Files, you are able to enter the url path relative to your phpBB2 Directory, for example \'upload\'.<br />A trailing slash will be removed. Leave this field empty, if the FTP Path is not accessible from the Internet. With this field empty you are unable to use the physical download method.';
$titanium_lang['Ftp_passive_mode'] = 'Enable FTP Passive Mode';
$titanium_lang['Ftp_passive_mode_explain'] = 'The PASV command requests that the remote server open a port for the data connection and return the address of that port. The remote server listens on that port and the client connects to it.';
$titanium_lang['ftp_username'] = 'FTP Username';
$titanium_lang['ftp_password'] = 'FTP Password';

$titanium_lang['No_ftp_extensions_installed'] = 'You are not able to use the FTP Upload Methods, because FTP Extensions are not compiled into your PHP Installation.';

// Attachments -> Shadow Attachments
$titanium_lang['Shadow_attachments_explain'] = 'Here you can delete attachment data from postings when the files are missing from your filesystem, and delete files that are no longer attached to any postings. You can download or view a file if you click on it; if no link is present, the file does not exist.';
$titanium_lang['Shadow_attachments_file_explain'] = 'Delete all attachments files that exist on your filesystem and are not assigned to an existing post.';
$titanium_lang['Shadow_attachments_row_explain'] = 'Delete all posting attachment data for files that don\'t exist on your filesystem.';
$titanium_lang['Empty_file_entry'] = 'Empty File Entry';

// Attachments -> Sync
$titanium_lang['Sync_thumbnail_resetted'] = 'Thumbnail resetted for Attachment: %s'; // replace %s with physical Filename
$titanium_lang['Attach_sync_finished'] = 'Attachment Syncronization Finished.';
$titanium_lang['Sync_topics'] = 'Sync Topics';
$titanium_lang['Sync_posts'] = 'Sync Posts';
$titanium_lang['Sync_thumbnails'] = 'Sync Thumbnails';
// Extensions -> Extension Control
$titanium_lang['Manage_extensions'] = 'Manage Extensions';
$titanium_lang['Manage_extensions_explain'] = 'Here you can manage your File Extensions. If you want to allow/disallow a Extension to be uploaded, please use the Extension Groups Management.';
$titanium_lang['Explanation'] = 'Explanation';
$titanium_lang['Extension_group'] = 'Extension Group';
$titanium_lang['Invalid_extension'] = 'Invalid Extension';
$titanium_lang['Extension_exist'] = 'The Extension %s already exist'; // replace %s with the Extension
$titanium_lang['Unable_add_forbidden_extension'] = 'The Extension %s is forbidden, you are not able to add it to the allowed Extensions'; // replace %s with Extension

// Extensions -> Extension Groups Management
$titanium_lang['Manage_extension_groups'] = 'Manage Extension Groups';
$titanium_lang['Manage_extension_groups_explain'] = 'Here you can add, delete and modify your Extension Groups, you can disable Extension Groups, assign a special Category to them, change the download mechanism and you can define a Upload Icon which will be displayed in front of an Attachment belonging to the Group.';
$titanium_lang['Special_category'] = 'Special Category';
$titanium_lang['Category_images'] = 'Images';
$titanium_lang['Category_stream_files'] = 'Stream Files';
$titanium_lang['Category_swf_files'] = 'Flash Files';
$titanium_lang['Allowed'] = 'Allowed';
$titanium_lang['Allowed_forums'] = 'Allowed Forums';
$titanium_lang['Ext_group_permissions'] = 'Group Permissions';
$titanium_lang['Download_mode'] = 'Download Mode';
$titanium_lang['Upload_icon'] = 'Upload Icon';
$titanium_lang['Max_groups_filesize'] = 'Maximum Filesize';
$titanium_lang['Extension_group_exist'] = 'The Extension Group %s already exist'; // replace %s with the group name
$titanium_lang['Collapse'] = '+';
$titanium_lang['Decollapse'] = '-';

// Extensions -> Special Categories
$titanium_lang['Manage_categories'] = 'Manage Special Categories';
$titanium_lang['Manage_categories_explain'] = 'Here you can configure the Special Categories. You can set up Special Parameters and Conditions for the Special Categorys assigned to an Extension Group.';
$titanium_lang['Settings_cat_images'] = 'Settings for Special Category: Images';
$titanium_lang['Settings_cat_streams'] = 'Settings for Special Category: Stream Files';
$titanium_lang['Settings_cat_flash'] = 'Settings for Special Category: Flash Files';
$titanium_lang['Display_inlined'] = 'Display Images Inlined';
$titanium_lang['Display_inlined_explain'] = 'Choose whether to display images directly within the post (yes) or to display images as a link ?';
$titanium_lang['Max_image_size'] = 'Maximum Image Dimensions';
$titanium_lang['Max_image_size_explain'] = 'Here you can define the maximum allowed Image Dimension to be attached (Width x Height in pixels).<br />If it is set to 0x0, this feature is disabled. With some Images this Feature will not work due to limitations in PHP.';
$titanium_lang['Image_link_size'] = 'Image Link Dimensions';
$titanium_lang['Image_link_size_explain'] = 'If this defined Dimension of an Image is reached, the Image will be displayed as a Link, rather than displaying it inlined,<br />if Inline View is enabled (Width x Height in pixels).<br />If it is set to 0x0, this feature is disabled. With some Images this Feature will not work due to limitations in PHP.';
$titanium_lang['Assigned_group'] = 'Assigned Group';

$titanium_lang['Image_create_thumbnail'] = 'Create Thumbnail';
$titanium_lang['Image_create_thumbnail_explain'] = 'Always create a Thumbnail. This feature overrides nearly all Settings within this Special Category, except of the Maximum Image Dimensions. With this Feature a Thumbnail will be displayed within the post, the User can click it to open the real Image.<br />Please Note that this feature requires Imagick to be installed, if it\'s not installed or if Safe-Mode is enabled the GD-Extension of PHP will be used. If the Image-Type is not supported by PHP, this Feature will be not used.';
$titanium_lang['Image_min_thumb_filesize'] = 'Minimum Thumbnail Filesize';
$titanium_lang['Image_min_thumb_filesize_explain'] = 'If a Image is smaller than this defined Filesize, no Thumbnail will be created, because it\'s small enough.';
$titanium_lang['Image_imagick_path'] = 'Imagick Program (Complete Path)';
$titanium_lang['Image_imagick_path_explain'] = 'Enter the Path to the convert program of imagick, normally /usr/bin/convert (on windows: c:/imagemagick/convert.exe).';
$titanium_lang['Image_search_imagick'] = 'Search Imagick';

$titanium_lang['Use_gd2'] = 'Make use of GD2 Extension';
$titanium_lang['Use_gd2_explain'] = 'PHP is able to be compiled with the GD1 or GD2 Extension for image manipulating. To correctly create Thumbnails without imagemagick the Attachment Mod uses two different methods, based on your selection here. If your thumbnails are in a bad quality or screwed up, try to change this setting.';
$titanium_lang['Attachment_version'] = 'Attachment Mod Version %s'; // %s is the version number

// Extensions -> Forbidden Extensions
$titanium_lang['Manage_forbidden_extensions'] = 'Manage Forbidden Extensions';
$titanium_lang['Manage_forbidden_extensions_explain'] = 'Here you can add or delete the forbidden extensions. The Extensions php, php3 and php4 are forbidden by default for security reasons, you can not delete them.';
$titanium_lang['Forbidden_extension_exist'] = 'The forbidden Extension %s already exist'; // replace %s with the extension
$titanium_lang['Extension_exist_forbidden'] = 'The Extension %s is defined in your allowed Extensions, please delete it their before you add it here.';  // replace %s with the extension

// Extensions -> Extension Groups Control -> Group Permissions
$titanium_lang['Group_permissions_title'] = 'Extension Group Permissions -> \'%s\''; // Replace %s with the Groups Name
$titanium_lang['Group_permissions_explain'] = 'Here you are able to restrict the selected Extension Group to Forums of your choice (defined in the Allowed Forums Box). The Default is to allow Extension Groups to all Forums the User is able to Attach Files into (the normal way the Attachment Mod did it since the beginning). Just add those Forums you want the Extension Group (the Extensions within this Group) to be allowed there, the default ALL FORUMS will disappear when you add Forums to the List. You are able to re-add ALL FORUMS at any given Time. If you add a Forum to your Board and the Permission is set to ALL FORUMS nothing will change. But if you have changed and restricted the access to certain Forums, you have to check back here to add your newly created Forum. It is easy to do this automatically, but this will force you to edit a bunch of Files, therefore i have chosen the way it is now. Please keep in mind, that all of your Forums will be listed here.';
$titanium_lang['Note_admin_empty_group_permissions'] = 'NOTE:<br />Within the below listed Forums your Users are normally allowed to attach files, but since no Extension Group is allowed to be attached there, your Users are unable to attach anything. If they try, they will receive Error Messages. Maybe you want to set the Permission \'Post Files\' to ADMIN at these Forums.<br /><br />';
$titanium_lang['Add_forums'] = 'Add Forums';
$titanium_lang['Add_selected'] = 'Add Selected';
$titanium_lang['Perm_all_forums'] = 'ALL FORUMS';

// Attachments -> Quota Limits
$titanium_lang['Manage_quotas'] = 'Manage Attachment Quota Limits';
$titanium_lang['Manage_quotas_explain'] = 'Here you are able to add/delete/change Quota Limits. You are able to assign these Quota Limits to Users and Groups later. To assign a Quota Limit to a User, you have to go to Users->Management, select the User and you will see the Options at the bottom. To assign a Quota Limit to a Group, go to Groups->Management, select the Group to edit it, and you will see the Configuration Settings. If you want to see, which Users and Groups are assigned to a specific Quota Limit, click on \'View\' at the left of the Quota Description.';
$titanium_lang['Assigned_users'] = 'Assigned Users';
$titanium_lang['Assigned_groups'] = 'Assigned Groups';
$titanium_lang['Quota_limit_exist'] = 'The Quota Limit %s exist already.'; // Replace %s with the Quota Description

// Attachments -> Control Panel
$titanium_lang['Control_panel_title'] = 'File Attachment Control Panel';
$titanium_lang['Control_panel_explain'] = 'Here you can view and manage all attachments based on Users, Attachments, Views etc...';
$titanium_lang['File_comment_cp'] = 'File Comment';

// Control Panel -> Search
$titanium_lang['Search_wildcard_explain'] = 'Use * as a wildcard for partial matches';
$titanium_lang['Size_smaller_than'] = 'Attachment size smaller than (bytes)';
$titanium_lang['Size_greater_than'] = 'Attachment size greater than (bytes)';
$titanium_lang['Count_smaller_than'] = 'Download count is smaller than';
$titanium_lang['Count_greater_than'] = 'Download count is greater than';
$titanium_lang['More_days_old'] = 'More than this many days old';
$titanium_lang['No_attach_search_match'] = 'No Attachments met your search criteria';

// Control Panel -> Statistics
$titanium_lang['Number_of_attachments'] = 'Number of Attachments';
$titanium_lang['Total_filesize'] = 'Total Filesize';
$titanium_lang['Number_posts_attach'] = 'Number of Posts with Attachments';
$titanium_lang['Number_topics_attach'] = 'Number of Topics with Attachments';
$titanium_lang['Number_users_attach'] = 'Independent Users Posted Attachments';
$titanium_lang['Number_pms_attach'] = 'Total Number of Attachments in Private Messages';

// Control Panel -> Attachments
$titanium_lang['Statistics_for_user'] = 'Attachment Statistics for %s'; // replace %s with username
$titanium_lang['Size_in_kb'] = 'Size (KB)';
$titanium_lang['Downloads'] = 'Downloads';
$titanium_lang['Post_time'] = 'Post Time';
$titanium_lang['Posted_in_topic'] = 'Posted in Topic';
$titanium_lang['Submit_changes'] = 'Submit Changes';

// Sort Types
$titanium_lang['Sort_Attachments'] = 'Attachments';
$titanium_lang['Sort_Size'] = 'Size';
$titanium_lang['Sort_Filename'] = 'Filename';
$titanium_lang['Sort_Comment'] = 'Comment';
$titanium_lang['Sort_Extension'] = 'Extension';
$titanium_lang['Sort_Downloads'] = 'Downloads';
$titanium_lang['Sort_Posttime'] = 'Post Time';
$titanium_lang['Sort_Posts'] = 'Posts';

// View Types
$titanium_lang['View_Statistic'] = 'Statistics';
$titanium_lang['View_Search'] = 'Search';
$titanium_lang['View_Username'] = 'Username';
$titanium_lang['View_Attachments'] = 'Attachments';

// Successfully updated
$titanium_lang['Attach_config_updated'] = 'Attachment Configuration updated successfully';
$titanium_lang['Click_return_attach_config'] = 'Click %sHere%s to return to Attachment Configuration';
$titanium_lang['Test_settings_successful'] = 'Settings Test finished, configuration seems to be fine.';

// Some basic definitions
$titanium_lang['Attachments'] = 'Attachments';
$titanium_lang['Attachment'] = 'Attachment';
$titanium_lang['Extensions'] = 'Extensions';
$titanium_lang['Extension'] = 'Extension';

// Auth pages
$titanium_lang['Auth_attach'] = 'Post Files';
$titanium_lang['Auth_download'] = 'Download Files';

?>