<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       07/14/2005
      Admin File Check                         v2.0.0       08/27/2005
      Caching System                           v1.0.0       10/29/2005
-=[Mod]=-
      phpBB User Groups Integration            v1.0.0       08/26/2005
      Persistent Admin Login                   v2.0.0       12/10/2005
      Password Strength Meter                  v1.0.0       11/01/2005
      IP Addon                                 v1.0.0       01/17/2006
-=[Block]=-
      Administration                           v1.0.0       07/01/2005
      Awaiting Submissions                     v1.0.0       07/14/2005
-=[Module]=-
      Supporters                               v1.3.0       07/14/2005
      Fancy NewsLetter                         v1.0.0       11/07/2005
-=[Other]=-
      URL Check                                v1.0.0       07/01/2005
      Need To Delete                           v1.0.0       08/01/2005
      Admin Password Confirm                   v1.0.0       08/02/2005
      Surveys Block (fix)                      v1.0.0       10/26/2005
      RSS Feeds (fix)                          v1.0.0       10/27/2005
 ************************************************************************/

global $customlang;
/* Please put all your custom language or translations here */
$customlang['global']['add']                    = 'Add';
$customlang['global']['admin']                  = 'Admin';
$customlang['global']['categories']             = 'Categories';
$customlang['global']['copyrights']             = 'Copyrights';
$customlang['global']['delete']                 = 'Delete';
$customlang['global']['description']            = 'Description';
$customlang['global']['edit']                   = 'Edit';
$customlang['global']['name']                   = 'Name';
$customlang['global']['posted_by']              = 'Posted by %s on %s';
$customlang['global']['reads']                  = 'Reads';
$customlang['global']['title']                  = 'Title';

$customlang['global']['groups_forums']          = 'Forum User Groups';
$customlang['global']['groups_general']         = 'General Groups';
$customlang['global']['all_visitors']           = 'All Visitors';
$customlang['global']['registered_users']       = 'Registered Users';
$customlang['global']['administrators']         = 'Administrators';
$customlang['global']['guests_only']            = 'Guests Only';

$customlang['global']['country_select']         = 'Please Select Country';

$customlang['global']['january'] = 'January';
$customlang['global']['february'] = 'February';
$customlang['global']['march'] = 'March';
$customlang['global']['april'] = 'April';
$customlang['global']['may'] = 'May';
$customlang['global']['june'] = 'June';
$customlang['global']['july'] = 'July';
$customlang['global']['august'] = 'August';
$customlang['global']['september'] = 'September';
$customlang['global']['october'] = 'October';
$customlang['global']['november'] = 'November';
$customlang['global']['december'] = 'December';

/**
 * Language Defines: Private Message Alert
 * @since 2.0.9d
 */
$customlang['private_msg']['message']           = 'You have (%s) New Message<br /><br />Click Here to Read';
$customlang['private_msg']['messages']          = 'You have (%s) New Messages<br /><br />Click Here to Read';
$customlang['private_msg']['cookie_msg']        = 'This Alert will only display once every %s Minute';
$customlang['private_msg']['cookie_msg2']       = 'This Alert will only display once every %s Minutes';

/**
 * Language Defines: Floating Administration Menu
 * @since 2.0.9e
 */
// $customlang['floating_admin']['admin']          = 'ADMINISTRATION';
$customlang['floating_admin']['main_admin']     = 'Main Administration';
$customlang['floating_admin']['forum_admin']    = 'Forum Administration';
$customlang['floating_admin']['blocks']         = 'Blocks';
$customlang['floating_admin']['modules']        = 'Modules';
$customlang['floating_admin']['modblock']       = 'Module Block';
$customlang['floating_admin']['preferences']    = 'Preferences';
$customlang['floating_admin']['themes']         = 'Themes';
$customlang['floating_admin']['blog']           = 'Blog';
$customlang['floating_admin']['users']          = 'Users Configuration';
$customlang['floating_admin']['whois']          = 'Who is Online';
$customlang['floating_admin']['weblinks']       = 'Web Links';
$customlang['floating_admin']['honeypot']       = 'Honey Pot';
$customlang['floating_admin']['roster']         = 'Clan Manager';
$customlang['floating_admin']['downloads']      = 'File Repository';
$customlang['floating_admin']['digital_shop']   = 'Digital Shop';
$customlang['floating_admin']['cache']          = 'Clear Cache';
$customlang['floating_admin']['logout']         = 'Logout';

$customlang['floating_admin']['log_admin']      = 'Admin Log';
$customlang['floating_admin']['log_error']      = 'Error Log';
$customlang['floating_admin']['has_changed']    = 'has changed';

$customlang['back_to_top']['title']             = 'Back to Top';

/*****[BEGIN]******************************************
[ Other:  IPHUB VPN/PROXY/SERVER Blocking      v1.0.0 ]
 ******************************************************/
// define("_IPHUB_M1", "We no longer allow VPN/Proxy/Servers from visiting our site.<br />");
// define("_IPHUB_M2", "If this is a mistake, please go to <a href=\"https://iphub.info/\" target=\"_blank\">https://iphub.info</a> and report to them.");
/*****[END]********************************************
 [ Other:  IPHUB VPN/PROXY/SERVER Blocking      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/
define("_CANNOTCHANGEMODE", "Cannot change the mode of file (%s)");
define("_CANNOTOPENFILE", "Cannot open file (%s)");
define("_CANNOTWRITETOFILE", "Cannot write to file (%s)");
define("_CANNOTCLOSEFILE", "Cannot close file (%s)");
define("_SITECACHED", "This site is cached.");
define("_UPDATECACHE", "CLICK HERE TO UPDATE CACHE");
/*****[END]********************************************
 [ Other:   Caching System                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
define("_ERRORINVEMAIL","ERROR: Invalid Email");
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/
define("_PERSISTENT","Log me on automatically each visit");
/*****[END]********************************************
 [ Mod:     Persistent Admin Login             v2.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/
define("_ADMINGROUPS","Edit Groups");
define("_MVGROUPS","Groups Only");
define("_MVSUBUSERS","Subscribers Only");
define("_WHATGRDESC","View must be SET to Groups Only");
define("_WHATGROUPS","What Groups");
define("_GRMEMBERSHIPS","Group Memberships");
define("_GRNONE","None");
/*****[END]********************************************
 [ Mod:     phpBB User Groups Integration      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/
// define("_ADMIN_BLOCK_TITLE","Quick Navigation");
// define("_ADMIN_BLOCK_NUKE","Admin [Nuke-Evo]");
// define("_ADMIN_BLOCK_FORUMS","Admin [Forums]");
// define("_ADMIN_BLOCK_LOGOUT","Logout");
// define("_ADMIN_BLOCK_SETTINGS","Preferences");
// define("_ADMIN_BLOCK_BLOCKS","Blocks");
// define("_ADMIN_BLOCK_MODULES","Modules");
// define("_ADMIN_BLOCK_CNBYA","Users Configuration");
// define("_ADMIN_BLOCK_MSGS","Messages");
// define("_ADMIN_BLOCK_MODULE_BLOCK","Module Block");
// define("_ADMIN_BLOCK_NEWS","News");
// define("_ADMIN_BLOCK_LOGIN","Admin Login");
// define("_ADMIN_BLOCK_WHO_ONLINE","Who Is Online");
// define("_ADMIN_BLOCK_OPTIMIZE_DB","Database");
// define("_ADMIN_BLOCK_DOWNLOADS", "Downloads");
// define("_ADMIN_BLOCK_EVO_USER", "Evolution UserInfo");
// define("_ADMIN_BLOCK_WEBLINKS","Web Links");
// define("_ADMIN_BLOCK_REVIEWS","Reviews");
// define("_ADMIN_BLOCK_SYSTEMINFO","System Info");
// define("_ADMIN_BLOCK_ERRORLOG","Error Log");
// define("_CACHE_ADMIN", "Cache");
// define("_CACHE_CLEAR", "Clear Cache");
// define("_ADMIN_ID","Admin ID:");
// define("_ADMIN_PASS","Password:");
// define("_ADMIN_NO_MODULE_RIGHTS","You do not have administration permission for module");
/*****[END]********************************************
 [ Block:   Administration                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/
define("_URL_SLASH_ERR","Please remove the / from the end of your ");
define("_URL_HTTP_ERR","Please put http:// at the beginning of your ");
define("_URL_NHTTP_ERR","Please remove the http:// from the beginning of your ");
define("_URL_PHP_ERR","Please remove the file name at the end of your ");
define("_URL_MODULE_FORUM_ERR","Please remove /modules/Forums at the end of your ");
/*****[END]********************************************
 [ Other:   URL Check                          v1.0.0 ]
 ******************************************************/

/*--FNA--*/

/*****[BEGIN]******************************************
 [ Module:  Supporters                         v1.3.0 ]
 ******************************************************/
define("_WSUPPORT", "Waiting Supporters");
define("_DSUPPORT", "Inactive Supporters");
define("_ASUPPORT", "Active Supporters");
/*****[END]********************************************
 [ Module:  Supporters                         v1.3.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/
define("_STORIES", "Stories");
define("_AWL","Web Links");
define("_ASUP","Supporters");
define("_AREV","Reviews");
define("_ABAN", "Banners");
define("_ABANNERS", "Active Banners");
define("_DBANNERS", "Inactive Banners");
/*****[END]********************************************
 [ Block:   Awaiting Submissions               v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
define("_NEED_DELETE","You must delete");
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/
define("_PASS_CONFIRM","Re-type Password");
define("_ERROR","Error");
define("_PASS_NOT_MATCH","The two passwords do not match");
/*****[END]********************************************
 [ Other:   Admin Password Confirm             v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Validation                         v1.0.0 ]
 ******************************************************/
define("VALIDATE_ERROR","The %s you entered in %s was not valid ");
define("VALIDATE_USERNAME","username");
define("VALIDATE_TEXT","text");
define("VALIDATE_FULLNAME","fullname");
define("VALIDATE_NUMBER","number");
define("VALIDATE_EMAIL","email");
define("VALIDATE_URL","URL");
define("VALIDATE_INT","Number");
define("VALIDATE_FLOAT","Number");
define("VALIDATE_SHORT","short");
define("VALIDATE_LONG","long");
define("VALIDATE_SMALL","small");
define("VALIDATE_BIG","big");
define("VALIDATE_TEXT_SIZE","The %s you entered in %s not valid<br />It must be %s characters");
define("VALIDATE_NUMBER_SIZE","The %s you entered in %s not valid<br />It must be %s");
define("VALIDATE_WORD","A word was found in %s which is not allowed");
/*****[END]********************************************
 [ Other:  Validation                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
define("PSM_HELP_TITLE","Password Strenght Help");
define("PSM_NOTRATED","Not Rated");
define("PSM_CURRENTSTRENGTH","Current Strength: ");
define("PSM_WEAK","Weak");
define("PSM_MED","Medium");
define("PSM_STRONG","Strong");
define("PSM_STRONGER","Stronger");
define("PSM_STRONGEST","Strongest");
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Module:  Fancy NewsLetter                   v1.0.0 ]
 ******************************************************/
define("_FNL_BLOCK_MUST_BE_LOGGED_IN","You must be logged in to signup for our newsletter");
define("_FNL_BLOCK_ERR01","Error retreiving newsletter settings");
define("_FNL_BLOCK_OPTIN","Click <a href='modules.php?name=Fancy_NewsLetter&amp;file=optin'>here</a> to receive our newsletters");
define("_FNL_BLOCK_OPTOUT","Click <a href='modules.php?name=Fancy_NewsLetter&amp;file=optout'>here</a> to stop receiving our newsletters");
/*****[END]********************************************
 [ Module:  Fancy NewsLetter                   v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/
define("_NOSURVEYS", "No Surveys!");
/*****[END]********************************************
 [ Other:   Surveys Block                      v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/
define("_NORSS", "The RSS file you are trying to load does not exist!");
/*****[END]********************************************
 [ Other:   RSS Feeds                          v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:    IP Addon                            v1.0.0 ]
 ******************************************************/
define("_CZ_YOURIP","Your IP");
define("_YOURIP","Your IP");
/*****[END]********************************************
 [ Mod:    IP Addon                            v1.0.0 ]
 ******************************************************/

define('_QUERIES','Queries:');
define('_DB_TIME','DB Access Time:');
define('_PAGEFOOTER','[ '._PAGEGENERATION.' %s '._SECONDS.' | '._QUERIES.' %s ]');
define("_THEMES_QUNINSTALLED", "Uninstalled");
define("_THEMES", "Themes");
define("_THEMES_DEFAULT", "Default Theme");
define("_THEMES_BACKUP", "Backup");

/*****[BEGIN]******************************************
 [ Mod:    Blog Topics                         v1.0.0 ]
 ******************************************************/
define('_SAVECHANGES','Save Changes');
/*****[END]********************************************
 [ Mod:    Blog Topics                         v1.0.0 ]
 ******************************************************/
