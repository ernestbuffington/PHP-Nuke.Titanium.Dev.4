<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/**
*
* attachment mod main [English]
*
* @package attachment_mod
* @version $Id: lang_main_attach.php,v 1.1 2005/11/05 10:25:02 acydburn Exp $
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
// Attachment Mod Main Language Variables
//

// Auth Related Entries
$titanium_lang['Rules_attach_can'] = 'You <strong>can</strong> attach files in this forum';
$titanium_lang['Rules_attach_cannot'] = 'You <strong>cannot</strong> attach files in this forum';
$titanium_lang['Rules_download_can'] = 'You <strong>can</strong> download files in this forum';
$titanium_lang['Rules_download_cannot'] = 'You <strong>cannot</strong> download files in this forum';
$titanium_lang['Sorry_auth_view_attach'] = 'Sorry but you are not authorized to view or download this Attachment';

// Viewtopic -> Display of Attachments
$titanium_lang['Description'] = 'Description'; // used in Administration Panel too...
$titanium_lang['Downloaded'] = 'Downloaded';
$titanium_lang['Download'] = 'Download'; // this Language Variable is defined in lang_admin.php too, but we are unable to access it from the main Language File
$titanium_lang['Filesize'] = 'Filesize';
$titanium_lang['Viewed'] = 'Viewed';
$titanium_lang['Download_number'] = '%d Time(s)'; // replace %d with count
$titanium_lang['Extension_disabled_after_posting'] = 'The Extension \'%s\' was deactivated by an board admin, therefore this Attachment is not displayed.'; // used in Posts and PM's, replace %s with mime type

// Posting/PM -> Initial Display
$titanium_lang['Attach_posting_cp'] = 'Attachment Posting Control Panel';
$titanium_lang['Attach_posting_cp_explain'] = 'If you click on Add an Attachment, you will see the box for adding Attachments.<br />If you click on Posted Attachments, you will see a list of already attached Files and you are able to edit them.<br />If you want to Replace (Upload new Version) an Attachment, you have to click both links. Add the Attachment as you normally would do, thereafter don\'t click on Add Attachment, rather click on Upload New Version at the Attachment Entry you intend to update.';

// Posting/PM -> Posting Attachments
$titanium_lang['Add_attachment'] = 'Add Attachment';
$titanium_lang['Add_attachment_title'] = 'Add an Attachment';
$titanium_lang['Add_attachment_explain'] = 'If you do not want to add an Attachment to your Post, please leave the Fields blank';
$titanium_lang['File_name'] = 'Filename';
$titanium_lang['File_comment'] = 'File Comment';

// Posting/PM -> Posted Attachments
$titanium_lang['Posted_attachments'] = 'Posted Attachments';
$titanium_lang['Options'] = 'Options';
$titanium_lang['Update_comment'] = 'Update Comment';
$titanium_lang['Delete_attachments'] = 'Delete Attachments';
$titanium_lang['Delete_attachment'] = 'Delete Attachment';
$titanium_lang['Delete_thumbnail'] = 'Delete Thumbnail';
$titanium_lang['Upload_new_version'] = 'Upload New Version';

// Errors -> Posting Attachments
$titanium_lang['Invalid_filename'] = '%s is an invalid filename'; // replace %s with given filename
$titanium_lang['Attachment_php_size_na'] = 'The Attachment is too big.<br />Couldn\'t get the maximum Size defined in PHP.<br />The Attachment Mod is unable to determine the maximum Upload Size defined in the php.ini.';
$titanium_lang['Attachment_php_size_overrun'] = 'The Attachment is too big.<br />Maximum Upload Size: %d MB.<br />Please note that this Size is defined in php.ini, this means it\'s set by PHP and the Attachment Mod can not override this value.'; // replace %d with ini_get('upload_max_filesize')
$titanium_lang['Disallowed_extension'] = 'The Extension %s is not allowed'; // replace %s with extension (e.g. .php) 
$titanium_lang['Disallowed_extension_within_forum'] = 'You are not allowed to post Files with the Extension %s within this Forum'; // replace %s with the Extension
$titanium_lang['Attachment_too_big'] = 'The Attachment is too big.<br />Max Size: %d %s'; // replace %d with maximum file size, %s with size var
$titanium_lang['Attach_quota_reached'] = 'Sorry, but the maximum filesize for all Attachments is reached. Please contact the Board Administrator if you have questions.';
$titanium_lang['Too_many_attachments'] = 'Attachment cannot be added, since the max. number of %d Attachments in this post was achieved'; // replace %d with maximum number of attachments
$titanium_lang['Error_imagesize'] = 'The Attachment/Image must be less than %d pixels wide and %d pixels high'; 
$titanium_lang['General_upload_error'] = 'Upload Error: Could not upload Attachment to %s.'; // replace %s with local path

$titanium_lang['Error_empty_add_attachbox'] = 'You have to enter values in the \'Add an Attachment\' Box';
$titanium_lang['Error_missing_old_entry'] = 'Unable to Update Attachment, could not find old Attachment Entry';

// Errors -> PM Related
$titanium_lang['Attach_quota_sender_pm_reached'] = 'Sorry, but the maximum filesize for all Attachments in your Private Message Folder has been reached. Please delete some of your received/sent Attachments.';
$titanium_lang['Attach_quota_receiver_pm_reached'] = 'Sorry, but the maximum filesize for all Attachments in the Private Message Folder of \'%s\' has been reached. Please let him know, or wait until he/she has deleted some of his/her Attachments.';

// Errors -> Download
$titanium_lang['No_attachment_selected'] = 'You haven\'t selected an attachment to download or view.';
$titanium_lang['Error_no_attachment'] = 'The selected Attachment does not exist anymore';

// Delete Attachments
$titanium_lang['Confirm_delete_attachments'] = 'Are you sure you want to delete the selected Attachments?';
$titanium_lang['Deleted_attachments'] = 'The selected Attachments have been deleted.';
$titanium_lang['Error_deleted_attachments'] = 'Could not delete Attachments.';
$titanium_lang['Confirm_delete_pm_attachments'] = 'Are you sure you want to delete all Attachments posted in this PM?';

// General Error Messages
$titanium_lang['Attachment_feature_disabled'] = 'The Attachment Feature is disabled.';

$titanium_lang['Directory_does_not_exist'] = 'The Directory \'%s\' does not exist or couldn\'t be found.'; // replace %s with directory
$titanium_lang['Directory_is_not_a_dir'] = 'Please check if \'%s\' is a directory.'; // replace %s with directory
$titanium_lang['Directory_not_writeable'] = 'Directory \'%s\' is not writeable. You\'ll have to create the upload path and chmod it to 777 (or change the owner to you httpd-servers owner) to upload files.<br />If you have only plain ftp-access change the \'Attribute\' of the directory to rwxrwxrwx.'; // replace %s with directory

$titanium_lang['Ftp_error_connect'] = 'Could not connect to FTP Server: \'%s\'. Please check your FTP-Settings.';
$titanium_lang['Ftp_error_login'] = 'Could not login to FTP Server. The Username \'%s\' or the Password is wrong. Please check your FTP-Settings.';
$titanium_lang['Ftp_error_path'] = 'Could not access ftp directory: \'%s\'. Please check your FTP Settings.';
$titanium_lang['Ftp_error_upload'] = 'Could not upload files to ftp directory: \'%s\'. Please check your FTP Settings.';
$titanium_lang['Ftp_error_delete'] = 'Could not delete files in ftp directory: \'%s\'. Please check your FTP Settings.<br />Another reason for this error could be the non-existence of the Attachment, please check this first in Shadow Attachments.';
$titanium_lang['Ftp_error_pasv_mode'] = 'Unable to enable/disable FTP Passive Mode';

// Attach Rules Window
$titanium_lang['Rules_page'] = 'Attachment Rules';
$titanium_lang['Attach_rules_title'] = 'Allowed Extension Groups and their Sizes';
$titanium_lang['Group_rule_header'] = '%s -> Maximum Upload Size: %s'; // Replace first %s with Extension Group, second one with the Size STRING
$titanium_lang['Allowed_extensions_and_sizes'] = 'Allowed Extensions and Sizes';
$titanium_lang['Note_user_empty_group_permissions'] = 'NOTE:<br />You are normally allowed to attach files within this Forum, <br />but since no Extension Group is allowed to be attached here, <br />you are unable to attach anything. If you try, <br />you will receive an Error Message.<br />';

// Quota Variables
$titanium_lang['Upload_quota'] = 'Upload Quota';
$titanium_lang['Pm_quota'] = 'PM Quota';
$titanium_lang['User_upload_quota_reached'] = 'Sorry, you have reached your maximum Upload Quota Limit of %d %s'; // replace %d with Size, %s with Size Lang (MB for example)

// User Attachment Control Panel
$titanium_lang['User_acp_title'] = 'User ACP';
$titanium_lang['UACP'] = 'User Attachment Control Panel';
$titanium_lang['User_uploaded_profile'] = 'Uploaded: %s';
$titanium_lang['User_quota_profile'] = 'Quota: %s';
$titanium_lang['Upload_percent_profile'] = '%d%% of total';

// Common Variables
$titanium_lang['Bytes'] = 'Bytes';
$titanium_lang['KB'] = 'KB';
$titanium_lang['MB'] = 'MB';
$titanium_lang['Attach_search_query'] = 'Search Attachments';
$titanium_lang['Test_settings'] = 'Test Settings';
$titanium_lang['Not_assigned'] = 'Not Assigned';
$titanium_lang['No_file_comment_available'] = 'No File Comment available';
$titanium_lang['Attachbox_limit'] = 'Your Attachbox is %d%% full';
$titanium_lang['No_quota_limit'] = 'No Quota Limit';
$titanium_lang['Unlimited'] = 'Unlimited';

?>