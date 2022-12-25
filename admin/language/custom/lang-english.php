<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Admin Icon/Link Pos                      v1.0.0       06/15/2005
      Theme Management                         v1.0.2       12/16/2005
-=[Module]=-
      Evolution UserInfo Block                 v1.0.0
-=[Mod]=-
      Admin Tracker                            v1.0.1       06/08/2005
      Evolution Version Checker                v1.0.0       06/16/2005
      Who is Online                            v0.9.1       06/24/2005
      Queries Count                            v2.0.1       08/21/2005
      Censor                                   v1.0.0       10/20/2005
      Cache                                    v1.0.2       11/15/2005
      Admin IP Lock                            v2.0.1       11/17/2005
      Advanced Security Code Control           v1.0.0       12/17/2005
      Lazy Google Tap                          v1.0.0       01/27/2006
      Image Resize                             v2.4.5       04/04/2006
-=[Other]=-
      URL Check                                v1.0.0       07/01/2005
      Security Status                          v1.0.0       11/01/2005
      Meta Tags                                v1.0.0       11/20/2005
      Database Manager                         v2.0.0       12/17/2005
	  CalendarMx                               v1.4.0       05/29/2009
************************************************************************/

/*    Please put all your custom language or translations here     */



define('_BOTH', 'Both');
define('_ERROR_DELETE_CONF','Are you sure that you want to delete %s?');
define('_BLOCKTOP','Move block to top');
define('_BLOCKBOTTOM','Move block to bottom');


define('_FROM','From');




define('_REVIEWTEXT','Please look over your message and check for typos');






/*****[BEGIN]******************************************
 [ Mod:  Extended Surveys Admin Interface      v1.0.0 ]
 ******************************************************/
define("_POLLADMIN", "Surveys Administration");
define("_POLLMAIN", "Surveys Admin Index");
define("_SURVEYSADMIN", "Surveys");
define("_POLLCHOOSE", "Welcome to the Surveys Administration<br />What do you want to do?");
define("_ADDPOLL", "Add Survey");
define("_CHANGEPOLL", "Change Survey");
define("_DELETEPOLL", "Delete Survey");
define("_POLL_OPTIONS", "Extra Options");
define("_POLL_INFO", "You can change some options here for the Surveys block");
define("_POLLDAYS", "Number of days between voting");
define("_POLLRANDOM", "Show a random Survey");
/*****[END]********************************************
 [ Mod:  Extended Surveys Admin Interface      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Admin Tracker                      v1.0.1 ]
 ******************************************************/
// define("_ADMIN_LOG","Security Tracker");
// define("_ADMIN_LOG_EXPLAIN1","The Security Tracker logs the following");
// define("_ADMIN_LOG_EXPLAIN2","<ul><li>Admin account creation</li><li>Failed admin logins</li><li>Intruder Alert</li><li>MySQL Errors</li></ul>");
// define("_ADMIN_LOG_CHG","<strong>Your Admin Tracker log <strong>HAS</strong> changed</strong>");
// define("_ADMIN_LOG_FINE","Your Admin Tracker log has not changed");
// define("_ADMIN_LOG_CHECKED","The version was last checked on");
// define("_ADMIN_LOG_VIEW","View Log");
// define("_ADMIN_LOG_ACK","Acknowledge");

// define("_ERROR_LOG_CHG","<strong>Your Error Log <strong>HAS</strong> changed</strong>");
// define("_ERROR_LOG_FINE","Your Error Log has not changed");
// define("_ERROR_LOG_ERR","<strong>There was a problem checking your log.</strong>");
// define("_ERROR_LOG_ERRCHMOD","<strong>Your file is not writeable. Did you do the CHMOD?</strong>");
// define("_ERROR_LOG_ERRFND","The log could not be found");
// define("_ERROR_ERR_OPEN","Failed to open error.log");

// define("_ADMIN_LOG_ERR","<strong>There was a problem checking your log.</strong>");
// define("_ADMIN_LOG_ERRCHMOD","<strong>Your file is not writeable. Did you do the CHMOD?</strong>");
// define("_ADMIN_LOG_ERRFND","The log could not be found");

// define("_TRACKER_HEAD_DATE","Date");
// define("_TRACKER_HEAD_TIME","Time");
// define("_TRACKER_HEAD_IP","IP");
// define("_TRACKER_HEAD_MSG","Message");

// define("_TRACKER_UP","UPDATED");
// define("_TRACKER_BACK","Back");
// define("_TRACKER_CLEAR", "Clear Log");

// define("_TRACKER_ERR_OPEN","Failed to open admin.log");
// define("_TRACKER_ERR_UP","Failed to update");

// define("_TRACKER_CLEARED", "Your Security Tracker has been cleared!");
/*****[END]********************************************
 [ Mod:     Admin Tracker                      v1.0.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Evolution Version Checker          v1.0.0 ]
 ******************************************************/
// define("_ADMIN_VER_TITLE","PHP-Nuke Evolution Xtreme Xtreme Version Checker");
// define("_ADMIN_VER_ERRCON","Could not connect to www.evolution-xtreme.com");
// define("_ADMIN_VER_ERRSQL","Could not retrieve version from Database");
// define("_ADMIN_VER_CHG","There is a new version of Evolution-Xtreme");
// define("_ADMIN_VER_VIEW","View New Version");
// define("_ADMIN_VER_CUR","Your version is current");
// define("_CHECKVER", "Click Here to check version");
// define("_VER_ERR_CON","Could not connect to <a href='http://www.evolution-xtreme.com'>Evolution-Xtreme</a>");
// define("_VER_ERR_CHG","There was a problem with accessing the Changed Log");
// define("_VER_TITLE","PHP-Nuke Evolution Xtreme Xtreme Version");
// define("_VER_VER","The current version is:");
// define("_VER_YOURVER","Your version is:");
// define("_VER_CHGLOG","Evolution-Xtreme Version Changed Log");
// define('_VERSIONUP2DATE', 'Your installation is up to date, no updates are available for your version of Evolution-Xtreme.');
// define('_VERSIONOUTOFDATE', 'Your installation does <strong>not</strong> seem to be up to date. Updates are available for your version of Evolution-Xtreme, please visit <a href="http://www.evolution-xtreme.com/modules.php?name=Downloads" target="_new">http://www.evolution-xtreme.com/modules.php?name=Downloads</a> to obtain the latest version.');
// define('_VERSIONLATESTINFO', 'The latest available version is <strong>Evolution-Xtreme %s</strong>.');
// define('_VERSIONCURRENTINFO', 'You are running <strong>Evolution-Xtreme %s</strong>.');
// define('_VERSIONSOCKETERROR', 'Unable to open connection to Evolution-Xtreme Server, reported error is:<br />%s');
// define('_VERSIONFUNCTIONSDISABLED', 'Unable to use socket functions.');
/*****[END]********************************************
 [ Mod:     Evolution Version Checker          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Who is Online                      v0.9.1 ]
 ******************************************************/
define("_4nwho0a","Who is Online");
define("_4nwho00","<strong>4n Who is Online?</strong><br /><i>Version 0.91</i>");
define("_4nwho01","Back to ");
define("_4nwho02","Server Time: ");
define("_4nwho03"," Users Currently Online");
define("_4nwho04","Username");
define("_4nwho05","IP-Address");
define("_4nwho06","Host Name");
define("_4nwho07","Time Online");
define("_4nwho08","Edit member");
define("_4nwho09","Refresh");
define("_4nwho10","From");
define("_4nwho11","Newest member");
define("_4nwho12","Number of members");
define("_4nwho13","Member-Information");
define("_4nwho14","Guest");
define("_4nwho15","Unknown domain");
define("_4nwho16","Not a domain");
define("_4nwho17","At this time there are");
define("_4nwho18","Guest(s) and");
define("_4nwho19","Member(s) online.");
define("_4nwho20","Delete member");
// START - Please do not edit and/or delete this lines - THANKS!
define("_4nwhocopy","4nWhoIsOnline by <a href=\"http://warpspeed.4thdimension.de\" target=\"_blank\">www.warp-speed.de</a> @ <a href=\"http://www.4thdimension.de\" target=\"_blank\">4thDimension.de</a> Networking.");
// END - Please do not edit and/or delete this lines - THANKS!
/*****[END]********************************************
 [ Mod:     Who is Online                      v0.9.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SERVER_ERROR","The URL you entered (%s) does not match the URL that the server is reporting (%s)");
define("_URL_CONFIRM_ERROR","Do you want to keep this setting?");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Cache                              v1.0.2 ]
 ******************************************************/
define("_CACHE_ENABLED","Enabled");
define("_CACHE_DISABLED", "Disabled");
define("_CACHE_HOWTOENABLE", "How to enable?");
define("_CACHE_CLEARNOW", "Clear Now");
define("_CACHE_NO", "No");
define("_CACHE_YES", "Yes");
define("_CACHE_GOOD", "Good");
define("_CACHE_BAD", "Your cache is NOT chmodded!");
define("_CACHE_HEADER", "Admin Cache Panel");
define("_CACHE_STATUS", "Cache Status:");
define("_CACHE_DIR_STATUS", "Cache Directory Status:");
define("_CACHE_NUM_FILES", "Number of cached items:");
define("_CACHE_LAST_CLEARED", "Cache last cleared:");
define("_CACHE_SIZE", "Cache size:");
define("_CACHE_USER_CAN_CLEAR", "User can clear cache:");
define("_CACHE_CLEAR", "Clear Cache");
define("_CACHE_RETURN", "Return to Main Administration");
define("_CACHE_FILENAME", "Filename");
define("_CACHE_FILESIZE", "File Size");
define("_CACHE_LASTMOD", "Last Modified");
define("_CACHE_OPTIONS", "Options");
define("_CACHE_DELETE", "Delete");
define("_CACHE_VIEW", "View");
define("_CACHE_RETURNCACHE", "Return to Cache Admin");
define("_CACHE_INVALID", "Invalid Operation");
define("_CACHE_FILE_DELETE_SUCC", "File deleted successfully");
define("_CACHE_FILE_DELETE_FAIL", "File deletion failed");
define("_CACHE_CAT_DELETE_SUCC", "Category deleted successfully");
define("_CACHE_CAT_DELETE_FAIL", "Category deletion failed");
define("_CACHE_CLEARED_SUCC", "Cache cleared successfully");
define("_CACHE_CLEARED_FAIL", "Cache failed to clear");
define("_CACHE_PREF_UPDATED_SUCC", "Preferences updated succesfully");
define("_CACHE_ENABLE_HOW", "To enable cache, set \$use_cache to \"1\" or \"2\" in config.php if it isn't already.");
define("_CACHESAFEMODE", "Safe mode is enabled on your server, cache will NOT function!");
define("_CACHENOTALLOWED", "You are not allowed to view this file!");
define("_CACHE_MODE", "Cache Mode");
define("_CACHE_FILEMODE", "File Cache");
define("_CACHE_SQLMODE", "SQL Cache");
define("_CACHE_TYPES", "Cache types available:");
/*****[END]********************************************
 [ Base:    Cache                              v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:  Security Status                     v1.0.0 ]
 ******************************************************/
define("_SEC_STATUS", "Security Status");
define("_INPUT_FILTER", "Input Filter");
define("_SEC_OFF", "Disabled");
define("_SEC_ON", "Enabled");
define("_ADMIN_IP_LOCK", "Admin IP Lock");
/*****[END]********************************************
 [ Other:  Security Status                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
define("_THEMES_HEADER", "Nuke Evolution :: Theme Management");
if (!defined('_THEMES_DEFAULT')) define('_THEMES_DEFAULT', 'Default Theme');
define("_THEMES_DEFAULT_NOT_FOUND", " was NOT found!");
define("_THEMES_DEFAULT_MISSING", "Your default theme is missing! ");
define("_THEMES_ERROR", "Error");
define("_THEMES_ERROR_CRITICAL", "Critical Error");
define("_THEMES_ERROR_MESSAGE", "Could not gather installed themes");
define("_THEMES_PROBLEM", "There seems to be a problem with your theme, please make sure you have a valid theme");
define("_THEMES_NUMTHEMES", "Number of Themes");
define("_THEMES_NUMUNINSTALLED", "Number of Uninstalled Themes");
define("_THEMES_MOSTPOPULAR", "Most Popular Theme");
define("_THEMES_OPTIONS", "Theme Options");
define("_THEMES_RETURNMAIN", "Return to Main Administration");
define("_THEMES_MAKEDEFAULT", "Make Default");

define("_THEMES_ISDEFAULT", "This theme is set as Default");

define("_THEMES_DEACTIVATE", "Deactivate");
define("_THEMES_ACTIVATE", "Activate");
define("_THEMES_UNINSTALL", "Uninstall");
define("_THEMES_EDIT", "Edit");
define("_THEMES_VIEW", "View");
define("_THEMES_NONE", "None");
define("_THEMES_NAME", "Theme Name");
define("_THEMES_CUSTOMN", "Custom Name");
define("_THEMES_NUMUSERS", "# of Users");
define("_THEMES_PREVIEW", "Preview");
define("_THEMES_STATUS", "Status");
define("_THEMES_GROUPS", "Groups");
define("_THEMES_OPTS", "Options");
define("_DOWNLOAD_FILES","Download Theme Backup");
define("_THEME_BACKUP","Backup (ZIP)");
define("_THEMES_INSTALLED", "Installed Themes");
define("_THEMES_ALLUSERS", "All Users");
define("_THEMES_GROUPSONLY", "Groups Only");
define("_THEMES_ADMINS", "Administrators");
define("_THEMES_UNINSTALLED", "Uninstalled Themes");
define("_THEMES_QINSTALL", "Quick Install");
define("_THEMES_INSTALL", "Install");
define("_THEMES_CUSTOMNAME", "Custom Theme Name");
define("_THEMES_ACTIVE", "Active");
define("_THEMES_INACTIVE", "Inactive");
define("_THEMES_RETURN", "Return to Theme Management");
define("_THEMES_UPDATED", "Theme Updated!");
define("_THEMES_UPDATEFAILED", "Failed to Update Theme!");
define("_THEMES_THEME_INSTALLED", "Theme Installed!");
define("_THEMES_THEME_INSTALLED_FAILED", "Failed to Install Theme!");
define("_THEMES_THEME_UNINSTALLED", "Theme uninstalled successfully");
define("_THEMES_THEME_UNINSTALLED_FAILED", "Theme uninstallation failed!");
define("_THEMES_UNINSTALL1", "Are you sure you wish to uninstall this theme?");
define("_THEMES_UNINSTALL2", "You will lose ALL your settings for this theme!");
define("_THEMES_UNINSTALL3", "This will set ALL users using this theme back to the default theme!");
define("_THEMES_THEME_UNINSTALL", "Uninstall Theme");
if (!defined('_THEMES_QUNINSTALLED')) define('_THEMES_QUNINSTALLED', 'Uninstalled');
define("_THEMES_THEME_MISSING", "Theme Missing!");
define("_THEMES_THEME_DEACTIVATED", "Theme deactivated successfully!");
define("_THEMES_THEME_DEACTIVATED_FAILED", "Theme deactivation failed!");
define("_THEMES_DEACTIVATE1", "Are you sure you wish to deactivate this theme?");
define("_THEMES_DEACTIVATE2", "This will set ALL users using this theme back to the default theme!");
define("_THEMES_THEME_DEACTIVATE", "Deactivate Theme");
define("_THEMES_TRANSFER", "Transfer Theme Users");
define("_THEMES_MANG_OPTIONS", "Theme Management Options");
define("_THEMES_ALLOWCHANGE", "Allow User Theme Selection");
define("_THEMES_SUBMIT", "Submit");
define("_THEMES_SETTINGS_UPDATED", "Settings Updated!");
define("_THEMES_THEME_TRANSFER", "Theme Transfer");
define("_THEMES_RETURN_OPTIONS", "Return to Theme Options");
define("_THEMES_VIEW_STATS", "View Statistics");
define("_THEMES_FROM", "From Theme");
define("_THEMES_TO", "To Theme");
define("_THEMES_TRANSFER_UPDATED", "user(s) were updated!");
define("_THEMES_THEMES", "Themes");
define("_THEMES_ADV_OPTS", "Advanced Theme Options");
define("_THEMES_ADV_COMP", "Your theme is compatible with Advanced Features");
define("_THEMES_DEF_LOADED", "Default options are loaded below.");
define("_THEMES_REST_DEF", "Restore Default");
define("_THEMES_NOT_COMPAT", "<font color='red'>Your theme is not compatible with Advanced Features</font><br /><a href='http://evolution-xtremethemes.co.cc' target='_blank'>Evolution Xtreme Themes</a>");
define("_THEMES_PERMISSIONS", "Permissions");
define("_THEMES_LIST", "Return to Theme List");
define('_THEMES_DOWNLOAD_FILES','Download & Back up Theme');
define('_THEMES_USER_OPTIONS', 'User Options');
define('_THEMES_USERID', 'User ID');
define('_THEMES_USERNAME', 'Username');
define('_THEMES_REALNAME', 'Realname');
define('_THEMES_USEREMAIL', 'EMail');
define('_THEMES_USERTHEME', 'Theme');
define('_THEMES_FUNCTIONS', 'Functions');
define('_THEMES_USER_RESET', 'Reset to Default');
define('_THEMES_USER_MODIFY', 'Modify Theme');
if (!defined('_THEMES_SUBMIT')) define('_THEMES_SUBMIT', 'Submit');
define('_NOREALNAME', 'N/A');
define('_THEMES_PAGE_FIRST', 'First');
define('_THEMES_PAGE_PREVIOUS', 'Prev');
define('_THEMES_PAGE_NEXT', 'Next');
define('_THEMES_PAGE_LAST', 'Last');
define('_THEMES_PAGE_OF', 'of');
define('_THEMES_USER_SELECT', 'Select User Theme');

/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/



/*****[BEGIN]******************************************
 [ Other:    Database Manager                  v2.0.0 ]
 ******************************************************/
define("_DATABASE_ADMIN_HEADER", "Database Backup Panel");
define("_DATABASE_RETURNMAIN", "Return to Main Administration");
define("_DATABASE", "Database");
define("_ACTIONRESULTS", "Here are the results of your");
define("_IMPORTSUCCESS","Importation of <em>%s</em> was successful");
define("_CHECKALL","Check All");
define("_UNCHECKALL","Uncheck All");
define("_SAVEDATABASE","Backup DB");
define("_ANALYZEDATABASE","Analyze");
define("_CHECKDATABASE","Check");
define("_OPTIMIZEDATABASE","Optimize");
define("_REPAIRDATABASE","Repair");
define("_STATUSDATABASE","Status");
define("_BACKUPTASKS","Backup Tasks");
define("_SAVEDATA","Save Data");
define("_INCLUDESTATEMENT","Include %s statement");
define("_GZIPCOMPRESS","Use GZIP Compression");
define("_OPTIMIZETEXT",'<strong>OPTIMIZE</strong></div><br /><div align="justify">Should be used if you have deleted a large part of a table or if you have made many changes to a table with variable-length rows (tables that have VARCHAR, BLOB, or TEXT columns). Deleted records are maintained in a linked list and subsequent INSERT operations reuse old record positions. You can use OPTIMIZE to reclaim the unused space and to defragment the datafile.<br />
In most setups you don\'t have to run OPTIMIZE at all. Even if you do a lot of updates to variable length rows it\'s not likely that you need to do this more than once a month/week and only on certain tables.</div><br />
OPTIMIZE works in the following way:<ul>
<li>If the table has deleted or split rows, repair the table.</li>
<li>If the index pages are not sorted, sort them.</li>
<li>If the statistics are not up to date (and the repair couldn\'t be done by sorting the index), update them.</li>
</ul><strong>Note:</strong> the table is locked during the time in which OPTIMIZE is running!<br /><strong>Note:</strong> This admin backup module has been updated for PHP 7.xx');
define("_IMPORTFILE","Import SQL File");
define("_IMPORTSQL", "Import");
define("_DBACTION", "Action");
/*****[END]********************************************
 [ Other:    Database Manager                  v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:    System Info                       v1.0.0 ]
 ******************************************************/
define("_PHP_MODULES", "PHP Modules");
define("_SQL_SRV", "SQL Server");
define("_PHP_QUICKS", "Quick Stats:");
define("_PHP_EXT_STATUS", "Extended Status:");
define("_PHP_SPACER", "&nbsp;");
define("_INFO_GENERAL", "General");
define("_INFO_ADMIN_HEADER", "System Info :: Admin Panel");
define("_INFO_RETURNMAIN", "Return to Main Administration");
define("_INFO_SERVER_V", "Server Version");
define("_INFO_CLIENT_V", "Client Version");
define("_INFO_HOST_CONN", "Host Connection");
define("_GENERAL_INFO", "General Info");
define("_CMS_V", "CMS Version");
define("_CMS_R", "CMS Root");
define("_GD_VER", "GD Version");
define("_NOT_AVAILABLE", "N/A");
define("_SESSIONS_S_P", "Session save_path");
define("_PHP_VER", "PHP Version");
define("_MYSQL_VER", "MySQL Version");
define("_OWNER", "Owner");
define("_GROUP", "Group"); 
/*****[END]********************************************
 [ Other:    System Info                       v1.0.0 ]
 ******************************************************/

/*--FNL--*/

/*****[BEGIN]******************************************
 [ Modules:  CalendarMx                       v1.4.0c ]
 ******************************************************/
define("_CALNAME","Event Calendar");
/*****[END]********************************************
 [ Modules:  CalendarMx                       v1.4.0c ]
 ******************************************************/



/*****[BEGIN]******************************************
 [ Mod:     Evolution UserInfo Block           v1.0.0 ]
 ******************************************************/
define('_EVO_USERINFO','Evo UserInfo Block');
/*****[END]********************************************
 [ Mod:     Evolution UserInfo Block           v1.0.0 ]
 ******************************************************/



/*****[BEGIN]******************************************
 [ Base:    Blocks                             v.1.0.0]
 ******************************************************/
define('_BLOCK_ADMIN_HEADER', 'Admin Blocks Panel');
define('_BLOCK_RETURNMAIN', 'Return to Main Administration');
define('_BLOCK_ADMIN_NOTE', 'Please note that when you activate or deactivate a block here<br />that it will be instant to users but not to you, until you refresh your screen!');
define('_BLOCK_INACTIVE','Block is not active<br />(Double click to activate/deactivate)');
define('_BLOCK_LINK_DELETE','Delete a block');
define('_BLOCK_TITLE','TITLE');
define('_BLOCK_EDIT','Block Edit');
/*****[END]********************************************
 [ Base:    Blocks                             v.1.0.0]
 ******************************************************/


 


?>