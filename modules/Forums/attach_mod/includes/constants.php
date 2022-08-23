<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
/**
* @package attachment_mod
* @version $Id: constants.php,v 1.2 2005/11/21 17:31:55 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/
if (!defined('IN_PHPBB')) die('Hacking attempt');
// Attachment Debug Mode
define('ATTACH_DEBUG', 0);        // Attachment Mod Debugging off
//define('ATTACH_DEBUG', 1);    // Attachment Mod Debugging on
//define('ATTACH_QUERY_DEBUG', 1);
// Auth
define('AUTH_DOWNLOAD', 20);
// Download Modes
define('INLINE_LINK', 1);
define('PHYSICAL_LINK', 2);
// Categories
define('NONE_CAT', 0);
define('IMAGE_CAT', 1);
define('STREAM_CAT', 2);
define('SWF_CAT', 3);
// Tables
define('ATTACH_CONFIG_TABLE', $prefix . '_bbattachments_config');
define('EXTENSION_GROUPS_TABLE', $prefix . '_bbextension_groups');
define('EXTENSIONS_TABLE', $prefix . '_bbextensions');
define('FORBIDDEN_EXTENSIONS_TABLE', $prefix . '_bbforbidden_extensions');
define('ATTACHMENTS_DESC_TABLE', $prefix . '_bbattachments_desc');
define('ATTACHMENTS_TABLE', $prefix . '_bbattachments');
define('QUOTA_TABLE', $prefix . '_bbattach_quota');
define('QUOTA_LIMITS_TABLE', $prefix . '_bbquota_limits');
// Pages
define('PAGE_UACP', -1210);
define('PAGE_RULES', -1214);
// Misc
define('MEGABYTE', 1024);
define('ADMIN_MAX_ATTACHMENTS', 50); // Maximum Attachments in Posts or PM's for Admin Users
define('THUMB_DIR', 'thumbs');
define('MODE_THUMBNAIL', 1);
// Forum Extension Group Permissions
define('GPERM_ALL', 0); // ALL FORUMS
// Quota Types
define('QUOTA_UPLOAD_LIMIT', 1);
define('QUOTA_PM_LIMIT', 2);
define('ATTACH_VERSION', '2.4.5');
?>
