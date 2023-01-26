<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to my website and send to me      */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/

global $admin_file, $sitename, $nukeurl, $admlang;

define_once("_ALL","All");
/**
 * Language Defines: Live Feed
 * @since 2.0.9d
 */
$admlang['livefeed']['anouncement']          = 'Announcement';
$admlang['livefeed']['bugfix']               = 'Bugfix';
$admlang['livefeed']['new_release']          = 'New Release';
$admlang['livefeed']['security']             = 'Security';
$admlang['livefeed']['update']               = 'Update Announcement';
$admlang['livefeed']['header']               = 'Live News Feed';
$admlang['livefeed']['type']                 = 'News type';
$admlang['livefeed']['message']              = 'Message';
$admlang['livefeed']['save']                 = 'Save Live Feed Data';
$admlang['livefeed']['title']				 = 'Title';
$admlang['livefeed']['refresh']				 = 'Refresh feed';

$admlang['modblock']['delete'] = 'Delete category';
$admlang['modblock']['edit'] = 'Edit category';
$admlang['modblock']['is_inactive'] = 'Module is not active<br />(Double click to activate/deactivate)'; 
$admlang['modblock']['is_link'] = 'Is a link';
$admlang['modblock']['link_delete'] = 'Delete a link';
$admlang['modblock']['link_title'] = 'Link Title';
$admlang['modblock']['link_title_error'] = 'You must provide a title and link';
$admlang['modblock']['not_found'] = 'Category not found';
$admlang['modblock']['no_values'] = 'Could Not Get Values';
$admlang['modblock']['order'] = 'Change category order';

$admlang['modblock']['image'] = 'Category Image Filename';
$admlang['modblock']['image_note'] = '<strong>NOTE:</strong> Category Images must be placed in <i>images/blocks/modules/</i> folder.';
$admlang['modblock']['explain1'] = 'Please note that when you activate or deactivate a module here<br />that it will be instant to users but not to you, until you refresh your screen!';
$admlang['modblock']['explain2'] = 'Also you <strong>MUST</strong> hit submit before the category order changes are saved.<br />The changes are not automatically saved!';


$admlang['modblock']['modedit'] = 'Modules Edit';
$admlang['modblock']['sort_up'] = 'Move Category Up';
$admlang['modblock']['sort_down'] = 'Move Category Down';
/*****[END]********************************************
 [ Base:    Modules                            v.1.0.0]
 ******************************************************/

$admlang['logged_out']                  = 'You are now logged out!';
$admlang['admin_id']                    = 'Admin ID';
$admlang['admin_login_header']          = 'Administration System Login';
$admlang['admin_login_persistent']      = 'Log me on automatically each visit';
$admlang['edit_admins']                 = 'Edit Admins';
$admlang['blocks']['link'] 				= 'Blocks';
$admlang['blocks']['header']            = 'Blocks Administration';
$admlang['blocks']['new'] 				= 'Add a New Block';
$admlang['blocks']['visible'] 			= 'Visible Blocks';
$admlang['blocks']['centerup'] 			= 'Center Up';
$admlang['blocks']['centerdown'] 		= 'Center Down';
$admlang['blocks']['left_block'] 		= 'Left Block';
$admlang['blocks']['right_block'] 		= 'Right Block';
$admlang['blocks']['edit'] 				= 'Edit Block';
$admlang['blocks']['include']			= '(Select a custom Block to be included. All other fields will be ignored)';
$admlang['blocks']['headlines'] 		= '(Only for Headlines)';
$admlang['blocks']['rss_warn'] 			= 'If you fill the URL the content you write will not be displayed!';
$admlang['blocks']['refresh'] 			= 'Refresh Time';
$admlang['blocks']['headlines_setup'] 	= '(Select Custom and write the URL or just select a Site from the list to grab news headlines)';
$admlang['blocks']['create'] 			= 'Create Block';
$admlang['blocks']['save'] 				= 'Save Block';

$admlang['headlines']['header'] = 'Headlines Administration';
$admlang['headlines']['add'] = 'Add Headline';
$admlang['headlines']['edit'] = 'Edit Headlines';
$admlang['headlines']['delete_warn'] = 'WARNING: Are you sure you want to delete this Headline?';

$admlang['authors']['header'] 			= 'Admin Author\'s Panel';
$admlang['authors']['author'] 			= 'Author';
$admlang['authors']['add'] 				= 'Add a New Administrator';
$admlang['authors']['delete'] 			= 'Delete Author';
$admlang['authors']['changes'] 			= '(For Changes Only)';
$admlang['authors']['god'] 				= '* (GOD account can\'t be deleted)';
$admlang['authors']['main'] 			= 'God Admin *';
$admlang['authors']['modify']			= 'Modify Info';
$admlang['authors']['can_not'] 			= 'Can not be changed later.';
$admlang['authors']['option1'] 			= 'Option';
$admlang['authors']['required'] 		= 'Required field';
$admlang['authors']['submit'] 			= 'Add new Author';
$admlang['authors']['superadmin']		= 'Super Admin';
$admlang['authors']['superwarn']		= 'WARNING: If Super Admin is checked, the user will get full access! (excludes Edit Admins and Nuke Sentinel)';

// define("_NOFUNCTIONS","---------");
// define("_PASSWDNOMATCH","Sorry, the new passwords doesn't match. Go Back and Try Again");

$admlang['referers']['header']			= 'HTTP Referers Admin Panel';
$admlang['referers']['linking']			= 'Who\'s linking to ';
$admlang['referers']['delete']			= 'Delete Referers';
$admlang['referers']['date']			= 'Visited Date';
$admlang['referers']['link']			= 'URL of Referer';
$admlang['referers']['none']			= 'There are no %s to display';


$admlang['preferences']['link'] 		= 'Preferences';
$admlang['preferences']['header']		= 'PHP-Nuke Titanium Preferences :: Admin Panel';

$admlang['preferences']['plugins'] 		= 'Plugins';
$admlang['plugins']['header'] 			= 'Custom Plugin Administration';

$admlang['pm_alert']['title'] 			= 'Private Message Popup Alert';
$admlang['pm_alert']['status'] 			= 'Do you wish to activate the Private Message Alert?';
$admlang['pm_alert']['cookie'] 			= 'Cookie Name';
$admlang['pm_alert']['refresh'] 		= 'Minutes between alerts';
$admlang['pm_alert']['refresh_explain']	= '0 = No time between alerts on page refresh<br />5 = Default Setting';
$admlang['pm_alert']['alert'] 			= 'Seconds the user has to wait before been alerted';
$admlang['pm_alert']['alert_explain']	= '0 = Instantly';
$admlang['pm_alert']['sound']			= 'Play Sound';
$admlang['pm_alert']['background']		= 'Background Color Overlay';
$admlang['pm_alert']['color']			= 'Button Color';
$admlang['pm_alert']['hover']			= 'Button Hover Color';


$admlang['viewer']['title']				= 'Image Viewing Script';
$admlang['viewer']['select']			= 'Select the Image Viewer';
$admlang['viewer']['colorbox']			= 'Colorbox';
$admlang['viewer']['fancybox']			= 'Fancybox';
$admlang['viewer']['lightbox']			= 'Lightbox';
$admlang['viewer']['lightboxevo']		= 'Lightbox Evolution';
$admlang['viewer']['lightboxlite']		= 'Lightbox Lite';


$admlang['preferences']['config'] 			= 'Web Site Configuration';
$admlang['preferences']['general'] 			= 'General Site Info';
$admlang['preferences']['language_opts']	= 'Language Options';
$admlang['preferences']['site_logo']		= 'Site Logo';
$admlang['preferences']['site_slogon']		= 'Site Slogan';
$admlang['preferences']['admin_email']		= 'Administrator Email';
$admlang['preferences']['items']			= 'Number of Items in Top Page';
$admlang['preferences']['stories']			= 'Stories Number in Home';
$admlang['preferences']['blogs_old']		= 'Stories in Old Articles Box';
$admlang['preferences']['ultra_mode']		= 'Activate Ultramode';
$admlang['preferences']['guests_post'] 		= 'Allow Anonymous to Post';
$admlang['preferences']['locale_format'] 	= 'Locale Time Format';
// define("_LOCALEFORMAT","Locale Time Format");

// define("_DEFAULTTHEME","Default Theme for your site");


// define("_BANNERSOPT","Banners Options");

$admlang['preferences']['start_date']	= 'Site Start Date';
// define("_STARTDATE","Site Start Date");


$admlang['preferences']['footer'] 		= 'Footer Messages';

$admlang['footer']['title'] 			= 'Footer Messages';
$admlang['footer']['line1'] 			= 'Footer Line 1';
$admlang['footer']['line2'] 			= 'Footer Line 2';
$admlang['footer']['line3'] 			= 'Footer Line 3';

$admlang['preferences']['backend'] 		= 'Backend Configuration';
// define("_BACKENDCONF","Backend Configuration");
// define("_BACKENDTITLE","Backend Title");
// define("_BACKENDLANG","Backend Language");
$admlang['backend']['config'] 			= 'Backend Configuration';
$admlang['backend']['title'] 			= 'Backend Title';
$admlang['backend']['language'] 		= 'Backend Language';

$admlang['preferences']['security'] 	= 'Security Options';

$admlang['preferences']['submissions'] 	= 'Submissions';
$admlang['submissions']['notify'] 		= 'Notify new submissions by email?';
$admlang['submissions']['email'] 		= 'Email to send the message';
$admlang['submissions']['subject'] 		= 'Email Subject';
$admlang['submissions']['message'] 		= 'Email Message';
$admlang['submissions']['from'] 		= 'Email Account (From)';

$admlang['preferences']['comment_opts'] = 'Comments Option';
$admlang['comments']['limit'] 			= 'Comments Limit in Bytes';
$admlang['comments']['guest_default'] 	= 'Anonymous Default Name';
$admlang['comments']['no_moderation'] 	= 'No Moderation';
$admlang['comments']['admins'] 			= 'Moderation by Admin';
$admlang['comments']['users'] 			= 'Moderation by Users';

// define("_COMMENTSMOD","Comments Moderation");
// define("_MODTYPE","Type of Moderation");

$admlang['preferences']['graphics'] 	= 'Graphics Options';
$admlang['graphics']['show'] 			= 'Graphics in Administration Menu?';
$admlang['graphics']['position'] 		= 'Admin Position';
$admlang['graphics']['position_opt'] 	= 'Have the admin icons/links';


$admlang['preferences']['misc'] 		= 'Miscellaneous Options';
$admlang['misc']['referers'] 			= 'Activate HTTP Referers?';
$admlang['misc']['referers_max'] 		= 'How Many Referers you want as Maximum?';
$admlang['misc']['poll_comments'] 		= 'Activate Comments in Polls?';
$admlang['misc']['poll_comments_active'] = 'Activate Comments in Articles?';
$admlang['misc']['myheadlines'] 		= 'Activate Headlines Reader?';
$admlang['misc']['ssl_admin'] 			= 'Activate SSL mode for admin?';
$admlang['misc']['ssl_admin_warn'] 		= 'You must have SSL installed on your server';
$admlang['misc']['queries'] 			= 'Count Queries?';
$admlang['misc']['colors'] 				= 'Activate Username and Group Colors';
$admlang['misc']['lock_modules'] 		= 'Force users to login before they can do anything';
$admlang['misc']['banners'] 			= 'Activate Banners in your site?';
$admlang['misc']['textarea'] 			= 'Textarea';
$admlang['misc']['html_bypass'] 		= 'Should God admins be allowed to bypass the HTMLPurifier';
$admlang['misc']['lazy_tap'] 			= 'Lazy Google Tap';
$admlang['misc']['lazy_tap_bots'] 		= 'Bots Only';
$admlang['misc']['lazy_tap_everyone'] 	= 'Everyone';
$admlang['misc']['lazy_tap_admin'] 		= 'Admins and Bots';
// define('_LAZY_TAP_NF','You must have a .htaccess file to use Lazy Google Tap <br />Please see the Lazy Google Tap help file');
// define('_LAZY_TAP_ERROR_OPEN','Could not open .htaccess ');
// define('_LAZY_TAP_ERROR','Your .htaccess is not setup correctly <br />Please see the Lazy Google Tap help file');
$admlang['misc']['image_resize'] 		= 'Image Resize';
$admlang['misc']['image_resize_width'] 	= 'Max Image Width';
$admlang['misc']['image_resize_height'] = 'Max Image Height';
$admlang['misc']['collapse'] 			= 'Collapsible categories?';

$admlang['misc']['cache_time'] 			= 'Minutes or Hours before Blockcontents will be refreshed (cached)';
$admlang['misc']['cache_deactivated']	= 'Block Cache Deactivated';
$admlang['misc']['cache_minutes']		= 'Minutes';
$admlang['misc']['cache_hours']			= 'Hours';

$admlang['misc']['analytics'] 			= 'Google Analytics';

// define("_LOCK_MODULES_TITLE","Force Users to Login");
// define("_SIZE","Size");

$admlang['language']['select'] 			= 'Select the Language for your Site';
$admlang['language']['multi'] 			= 'Activate Multilingual features?';
$admlang['language']['use_flags'] 		= 'Display flags instead of a dropdown box?';

$admlang['preferences']['censor'] 		= 'Censor Options';
$admlang['censor']['title'] 			= 'Censor';
$admlang['censor']['words'] 			= 'Words to censor';
$admlang['censor']['settings'] 			= 'Censor settings?';
$admlang['censor']['off'] 				= 'Off';
$admlang['censor']['whole'] 			= 'Whole words';
$admlang['censor']['partial'] 			= 'Partial words';

$admlang['preferences']['meta'] 		= 'Meta Tags';
$admlang['meta']['title'] 				= 'Meta Tags Administration';

$admlang['messages']['link'] 			= 'Messages';
$admlang['messages']['header'] 			= 'PHP-Nuke Titanium Messages :: Admin Panel';
$admlang['messages']['change_date']		= 'Change start date to today';
$admlang['messages']['active']			= '(If you Active this Message now, the start date will be today)';
$admlang['messages']['edit'] 			= 'Edit message';
$admlang['messages']['add'] 			= 'Add message';
$admlang['messages']['all'] 			= 'Overview messages';
$admlang['messages']['view'] 			= 'Visible to';
$admlang['messages']['remove'] 			= 'Are you sure you want to remove this message?';


$admlang['newsletter']['header'] 		= 'PHP-Nuke Titanium Newsletter :: Admin Panel';
$admlang['newsletter']['regards'] 		= 'Best Regards';
$admlang['newsletter']['subscribed'] 	= 'Subscribed Users';
$admlang['newsletter']['nousers'] 		= 'The group selected to receive this newsletter has zero users<br />Please go back and select a different group';
$admlang['newsletter']['will_recieve'] 	= 'Users will receive this Newsletter.';
$admlang['newsletter']['recieved_by'] 	= 'This newsletter will be sent to ';
$admlang['newsletter']['many_users_warn'] = 'WARNING! There are many users that will receive this text. Please wait until the script finishes the operation. This can take several minutes to complete!';
$admlang['newsletter']['unsubscribe'] 	= '=========================================================<br />You\'re receiving this Newsletter because you selected to receive it from your user page at $sitename.<br />You can unsubscribe from this service by clicking in the following URL:<br /><br /><a href=\"$nukeurl/modules.php?name=Your_Account&op=edituser\">$nukeurl/modules.php?name=Your_Account&op=edituser</a><br /><br />then select \"No\" from the option to Receive Newsletter by Email and save your changes, if you need more assistance please contact $sitename administrator.';
$admlang['newsletter']['sent'] 			= 'The Newsletter has been sent.';


$admlang['modules']['link'] 			= 'Modules';
$admlang['modules']['header'] 			= 'PHP-Nuke Titanium Messages :: Admin Panel';
$admlang['modules']['warn'] 			= 'Bold module\'s title represents the module you have in the Homepage.<br />You can\'t Deactivate or Restrict this module while it\'s the default one!<br />If you delete the module\'s directory you\'ll see an error in the Homepage.<br />Also, this module has been replaced with <i>Home</i> link in the modules block.<br /><br />[ <big><strong>&middot;</strong></big> ] means a module which name and link will not be visible in Modules Block';
$admlang['modules']['block'] 			= 'Modules Block EDIT';
$admlang['modules']['inhome'] 			= 'In Home';
$admlang['modules']['inmenu'] 			= 'Visible in Modules Block?';

$admlang['donations'] 					= 'Donations';

$admlang['logs']['header'] 				= 'Security Tracker';
$admlang['logs']['not_found'] 			= 'The log could not be found';
$admlang['logs']['is_clear'] 			= 'No Error\'s have been found.';
$admlang['logs']['clear'] 				= 'Clear Log';
$admlang['logs']['cleared'] 			= 'Your Security Tracker has been cleared!';

$admlang['logs']['admin_changed'] 		= 'Admin log %sHAS%s changed';
// define('_ADMIN_LOG_CHANGED','Admin log <strong>HAS</strong> changed');
$admlang['logs']['admin_chmod'] 		= 'Your file is not writeable. Did you do the CHMOD?';
// define('_ADMIN_LOG_CHMOD','Your file is not writeable. Did you do the CHMOD?');
// define('_ADMIN_LOG_ERR','There was a problem checking your log');
$admlang['logs']['admin_fine'] 			= 'Admin log has not changed';
// define('_ADMIN_LOG_FINE','Admin log has not changed');

$admlang['logs']['error_chmod'] 		= 'Your file is not writeable. Did you do the CHMOD?';
// define('_ERROR_LOG_CHMOD','Your file is not writeable. Did you do the CHMOD?');
$admlang['logs']['error_changed'] 		= 'Error log %sHAS%s changed';
// define('_ERROR_LOG_CHANGED','Error log <strong>HAS</strong> changed');
$admlang['logs']['error_fine'] 			= 'Error log has not changed';
// define('_ERROR_LOG_FINE','Error log has not changed');

$admlang['logs']['error'] 				= 'here was a problem checking your log';
// define('_ERROR_LOG_ERR','There was a problem checking your log');
$admlang['logs']['view'] 				= 'View Log';
// define('_VIEWLOG','View Log');

$admlang['global']['active']			= 'Active';
$admlang['global']['activate']			= 'Activate';
$admlang['global']['administrators'] 	= 'Administrators';
$admlang['global']['all'] 				= 'All';
$admlang['global']['all_members'] 		= 'All Members';
$admlang['global']['back']				= 'Go back';
$admlang['global']['both']	 			= 'Both';
$admlang['global']['content']			= 'Content';
$admlang['global']['custom']			= 'Custom';
$admlang['global']['day']				= 'Day';
$admlang['global']['days']				= 'Days';
$admlang['global']['deactivate']		= 'Deactivate';
$admlang['global']['delete']			= 'Delete';
$admlang['global']['disabled']			= 'Disabled';
$admlang['global']['discard']			= 'Discard';
$admlang['global']['down'] 				= 'Down';
$admlang['global']['edit']				= 'Edit';
$admlang['global']['email']				= 'Email';
$admlang['global']['enabled']			= 'Enabled';
$admlang['global']['expiration']		= 'Expiration';
$admlang['global']['filename']			= 'Filename';
$admlang['global']['functions']			= 'Functions';
$admlang['global']['go']				= 'Go';
$admlang['global']['goback']			= 'Go Back';
$admlang['global']['header_return']		= 'Return to Main Administration';
$admlang['global']['header_top_return'] = 'PHP-Nuke Evolution Xtreme %s :: Modules Admin Panel';
$admlang['global']['home'] 				= 'Home';
$admlang['global']['hour'] 				= 'Hour';
$admlang['global']['hours'] 			= 'Hours';
$admlang['global']['ID'] 				= 'ID';
$admlang['global']['inactive']			= 'Inactive';
$admlang['global']['language'] 			= 'Language';
$admlang['global']['left'] 				= 'Left';
$admlang['global']['login'] 			= 'Login';
$admlang['global']['name']				= 'Name';
$admlang['global']['nickname']			= 'Nickname';
$admlang['global']['no']				= 'No';
$admlang['global']['none'] 				= 'None';
$admlang['global']['not_set'] 			= '%s was not set';
$admlang['global']['password'] 			= 'Password';
$admlang['global']['password_retype']	= 'Retype Password';
$admlang['global']['permissions'] 		= 'Permissions';
$admlang['global']['position'] 			= 'Position';
$admlang['global']['preview'] 			= 'Preview';
$admlang['global']['recipients']		= 'Recipients';
$admlang['global']['right'] 			= 'Right';
$admlang['global']['rss'] 				= 'RSS/RDF file URL';
$admlang['global']['save_changes'] 		= 'Save Changes';
$admlang['global']['send'] 				= 'Send';
$admlang['global']['show'] 				= 'Show';
$admlang['global']['sitename'] 			= 'Site Name';
$admlang['global']['siteurl'] 			= 'Site Url';
$admlang['global']['staff'] 			= 'Staff';
$admlang['global']['subject'] 			= 'Subject';
$admlang['global']['submit'] 			= 'Submit';
$admlang['global']['title'] 			= 'Title';
$admlang['global']['title_custom'] 		= 'Custom Title';
$admlang['global']['unlimited']			= 'Unlimited';
$admlang['global']['up'] 				= 'Up';
$admlang['global']['url'] 				= 'Url';
$admlang['global']['view'] 				= 'View';
$admlang['global']['warning'] 			= 'Warning';
$admlang['global']['yes'] 				= 'Yes';

$admlang['global']['is_up_to_date'] 	= 'Up to date';
$admlang['global']['is_out_of_date']	= 'Out of date - Update Required';

# Groups selection defines (I grouped these together to make them easier to find in the future)
$admlang['global']['who_view'] 			= 'Who can View This';
$admlang['global']['admins_only']		= 'Administrators Only';
$admlang['global']['users_only'] 		= 'Registered Users Only';
$admlang['global']['guests_only'] 		= 'Personal Users Only';
$admlang['global']['all_visitors'] 		= 'All Visitors';
$admlang['global']['groups_only'] 		= 'Groups Only';

$admlang['admin']['administration_header'] 	= 'Administration Menu';
$admlang['admin']['modules_header'] 	= 'Modules Administration';
$admlang['admin']['themes_header'] 		= 'Theme Administraton';

$admlang['admin']['important'] 			= 'Important Information';
// define('_IMPORTANT_INFO','Important Information');
$admlang['admin']['ip_lock'] 			= 'Admin IP Lock';
// define('_IP_LOCK','Admin IP Lock');
$admlang['admin']['filter'] 			= 'Input Filter';
// define('_INPUT_FILTER','Input Filter');
$admlang['admin']['waiting_users'] 		= 'Waiting Users';
$admlang['admin']['registered_users'] 	= 'Registered Users';

$admlang['admin']['forums_overview'] 	= 'Forums Overview';
$admlang['admin']['total_forums'] 		= 'Forums';
$admlang['admin']['total_forum_topics'] = 'Topics';
$admlang['admin']['total_forum_posts'] 	= 'Posts';

$admlang['admin']['users_overview'] 	= 'Users Overview';
$admlang['admin']['total_users'] 		= 'Registered';
$admlang['admin']['total_waiting'] 		= 'Waiting';
$admlang['admin']['total_deactivated'] 	= 'Deactivated';

$admlang['admin']['downloads_overview'] = 'Downloads Overview';
$admlang['admin']['broken_downloads'] 	= 'Broken';
$admlang['admin']['total_categories'] 	= 'Categories';
$admlang['admin']['total_downloads'] 	= 'Downloads';

$admlang['admin']['admin_intrusion'] 	= 'Admin Intrusion';
$admlang['admin']['admin_error_log'] 	= 'Error Log';
$admlang['admin']['admin_honey_pot'] 	= 'Honey Pot';
$admlang['admin']['honey_pot_bots_stopped'] = 'stopped %s bots!';
$admlang['admin']['version_is_current'] = '(Up To Date)';
$admlang['admin']['version_is_out-of-date'] = 'New Version Available';

# VERSION CHECKER
$admlang['admin']['version_check_run'] 	= 'Run Now';
// define('_RUNNOW','Run Now');
$admlang['admin']['version_check'] 		= 'Version Checker';
// define('_VERSION_CHECK','Evolution Xtreme Version Checker');
$admlang['admin']['no_rights'] 	= 'Sorry %s but you have been given no administration rights. Please contact the site administrator if you feel this is a mistake!';
// define("_NO_ADMIN_RIGHTS","Sorry %s but you have been given no administration rights. Please contact the site administrator if you feel this is a mistake!");


/**
 * Mod: Live feed (Live news directly from Evolution Xtreme project site.)
 * @since 2.0.9e
 */
$admlang['livefeed']['header'] 				= 'PHP-Nuke Titanium Developer Feed';

/**
 * Mod: reCaptcha (Complete replacement for the GD2 captcha system.)
 * @since 2.0.9e
 */
$admlang['reCaptcha']['options'] 				= 'reCaptcha Options';
$admlang['reCaptcha']['check'] 					= 'Use reCaptcha';
$admlang['reCaptcha']['no_checking'] 			= 'No Checking';
$admlang['reCaptcha']['admin_login_only'] 		= 'Administrator login only';
$admlang['reCaptcha']['user_login_only'] 		= 'Users login Only';
$admlang['reCaptcha']['user_reg_only'] 			= 'New Users registration Only';
$admlang['reCaptcha']['both'] 					= 'Both, users login and new users registration only';
$admlang['reCaptcha']['admin_and_user_login'] 	= 'Administrators and users login only';
$admlang['reCaptcha']['admin_and_new_users'] 	= 'Administrators and new users registration only';
$admlang['reCaptcha']['everywhere'] 			= 'Everywhere on all login options (Admins and Users)';
$admlang['reCaptcha']['api_warn'] 				= 'The API must be submitted before you can configure the options for reCaptcha';

$admlang['reCaptcha']['reCaptcha'] 				= 'Recaptcha Security Check';
$admlang['reCaptcha']['whiteskin'] 				= 'White';
$admlang['reCaptcha']['darkskin'] 				= 'Dark';
$admlang['reCaptcha']['language'] 				= 'Recaptcha Language:';
$admlang['reCaptcha']['language_explain'] 		= '<strong>*</strong> <a href=\'https://developers.google.com/recaptcha/docs/language\' target=\'_blank\'>CLICK HERE</a> to find the proper valuse for the language you want to be used.';
$admlang['reCaptcha']['site_key_explain'] 		= '<strong>INFO:</strong> <a href=\'http://www.google.com/recaptcha/admin\' target=\'_blank\'>CLICK HERE</a> to signup and get your key needed for recaptcha.';
$admlang['reCaptcha']['site_key'] 				= 'Recaptcha Site Key:';
$admlang['reCaptcha']['secret_key'] 			= 'Recaptcha Secret Key:';

/**
 * Mod: IPHUB (Allows the blocking of VPN/PROXY Servers.)
 * @since 2.0.9e
 */
$admlang['iphub']['title'] 					= 'IpHub VPN/PROXY/SERVER Block';
$admlang['iphub']['status'] 				= 'User IpHub Blocking:';
$admlang['iphub']['status_explain'] 		= 'This system will block users from coming to your site using a VPN/Proxy/Server. False positives do happen and if your user is blocked, then need to contact IpHub to have them unblocked.';
$admlang['iphub']['key'] 					= 'IpHub API Key';
$admlang['iphub']['key_explain'] 			= '<strong>INFO:</strong> <a href=\'https://iphub.info\' target=\'_blank\'>CLICK HERE</a> to signup and get your key.';
$admlang['iphub']['api_warn'] 				= 'The API must be submitted before you can configure the options for '.$admlang['iphub']['title'].'';

// $lang['Date_format_explain'] = 'The syntax used is identical to the PHP <a href=\'http://www.php.net/date\' target=\'_other\'>date()</a> function.';

// $admlang['iphub']['add_explain'] 			= '<strong>Additional Note:</strong> There are paid and a free plan available.<br />If your site is high traffic, you may need ot look into a paid plan.';
$admlang['iphub']['add_explain'] 			= '<strong>Additional Note:</strong> There are paid and a free plan available.<br />If you use the free API key, You will be restricted to 1000 queries a day.<br />If your site is high traffic, you may need to look into a paid plan.';
$admlang['iphub']['cookie'] 				= 'IpHub Cookie Time: (in min)';
$admlang['iphub']['cookie_explain'] 		= 'This here is how long the cookie will last before the system will recheck their IP. (Designed to reduce calls to IPHUB, especially if your using the free plan.';

/**
 * Mod: Admin failed login checker. (Tracks the amount of times an admin fails to login.)
 * @since 2.0.9e
 */
$admlang['adminfail']['you_have'] 				= 'You have';
$admlang['adminfail']['attempts'] 				= 'attempt(s) left until you will have a cooldown for';
$admlang['adminfail']['less_than'] 				= 'less than 1';
$admlang['adminfail']['min'] 					= 'min(s).';
$admlang['adminfail']['cooldown'] 				= 'You can attempt to login once again in';
$admlang['adminfail']['title'] 					= 'Admin Login Fail Checker';
$admlang['adminfail']['status'] 				= 'Use Admin Login Fail Checker';
$admlang['adminfail']['status_explain'] 		= 'This system will limit how many time they can fail at logging in as admin beofre they need to take a cooldown break';
$admlang['adminfail']['max_attempts'] 			= 'Max Fail Attempts';
$admlang['adminfail']['max_attempts_explain'] 	= 'How many times can they fail before being blocked.';
$admlang['adminfail']['timeout'] 				= 'Cooldown Time, (min)';
$admlang['adminfail']['timeout_explain'] 		= 'How long should they be blocked for.';


$admlang['versions']['title'] 					= "PHP-Nuke Titanium Version Checker";
$admlang['versions']['version'] 				= "The current version is:";
$admlang['versions']['your_version'] 			= "Your version is:";
$admlang['versions']['version_checked']			= "The version was last checked on";
$admlang['versions']['version_current']			= "Your version is current";
$admlang['versions']['curl_connection_error']	= "Connection Error";


?>