<?php
/**
 * Floating Administration Menu
 *
 * A floating menu designed for Administration quick links.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @version 2.0
 * @license GPL-3.0
 */

defined('NUKE_BASE_DIR') or die('Stop, What do you think you are doing!?!');

if ( is_admin() && !defined('_disable_floating_admin') )
{
	global $customlang;

	define('FLOATING_ADMIN_CSS', NUKE_CSS_DIR.'jquery.floating.admin.css');
	define('FLOATING_ADMIN_JS', NUKE_JQUERY_SCRIPTS_DIR.'jquery.floating.admin.js');

	$admin_log = log_size('admin');
	$error_log = log_size('error');

	/**
	 * Check to see there has been any attempted admin logins that have failed.
	 */
    if($admin_log == -1 || $admin_log == -2 || $admin_log):  
    	$customlang['floating_admin']['log_admin'] = '<span style="color: red; !important">'.$customlang['floating_admin']['log_admin'].' '.$customlang['floating_admin']['has_changed'].'</span>'; 
    endif;

    /**
	 * Check to see there are any SQL errors anywhere on the site.
	 */
    if($error_log == -1 || $error_log == -2 || $error_log):
    	$customlang['floating_admin']['log_error'] = '<span style="color: red; !important">'.$customlang['floating_admin']['log_error'].' '.$customlang['floating_admin']['has_changed'].'</span>'; 
    endif;

    /**
	 * Here we have the array with all the most commonly used administration areas.
	 */
    $administration_links = array(
		array(
			'title' 		=> $customlang['floating_admin']['main_admin'],
			'url' 			=> $admin_file.'.php',
			'fa_icon' 		=> 'fa-home',
			'access_level' 	=> true,
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['forum_admin'],
			'url' 			=> $admin_file.'.php?op=forums',
			'fa_icon' 		=> 'fa-comments',
			'access_level' 	=> is_mod_admin('Forums'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> '',
			'url' 			=> '',
			'fa_icon' 		=> '',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> true
		),
		array(
			'title' 		=> $customlang['floating_admin']['log_admin'],
			'url' 			=> $admin_file.'.php?op=viewadminlog&amp;log=admin',
			'fa_icon' 		=> 'fa-user-shield',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['log_error'],
			'url' 			=> $admin_file.'.php?op=viewadminlog&amp;log=error',
			'fa_icon' 		=> 'fa-user-shield',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> '',
			'url' 			=> '',
			'fa_icon' 		=> '',
			'access_level' 	=> true,
			'file_exists' 	=> true,
			'divider'		=> true
		),
		array(
			'title' 		=> $customlang['floating_admin']['blocks'],
			'url' 			=> $admin_file.'.php?op=blocks',
			'fa_icon' 		=> 'fa-cubes',
			'access_level' 	=> true,
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['modules'],
			'url' 			=> $admin_file.'.php?op=modules',
			'fa_icon' 		=> 'fa-boxes',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['modblock'],
			'url' 			=> $admin_file.'.php?op=modules&area=block',
			'fa_icon' 		=> 'fa-stream',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['preferences'],
			'url' 			=> $admin_file.'.php?op=Configure',
			'fa_icon' 		=> 'fa-cogs',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['themes'],
			'url' 			=> $admin_file.'.php?op=themes',
			'fa_icon' 		=> 'fa-object-group',
			'access_level' 	=> true,
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['blog'],
			'url' 			=> $admin_file.'.php?op=adminBlog',
			'fa_icon' 		=> 'fa-rss',
			'access_level' 	=> is_mod_admin('Blog'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['users'],
			'url' 			=> 'modules.php?name=Your_Account&file=admin',
			'fa_icon' 		=> 'fa-users-cog',
			'access_level' 	=> is_mod_admin('Your_Account'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['whois'],
			'url' 			=> $admin_file.'.php?op=who',
			'fa_icon' 		=> 'fa-globe',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['weblinks'],
			'url' 			=> $admin_file.'.php?op=Links',
			'fa_icon' 		=> 'fa-link',
			'access_level' 	=> is_mod_admin('Web_Links'),
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['honeypot'],
			'url' 			=> $admin_file.'.php?op=honeypot',
			'fa_icon' 		=> 'fa-stop',
			'access_level' 	=> is_mod_admin('super'),
			'file_exists' 	=> file_exists('admin/modules/honeypot.php'),
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['roster'],
			'url' 			=> $admin_file.'.php?op=clanmanager',
			'fa_icon' 		=> 'fa-users',
			'access_level' 	=> is_mod_admin('Clan_Manager'),
			'file_exists' 	=> file_exists('modules/Clan_Manager/admin/index.php'),
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['downloads'],
			'url' 			=> $admin_file.'.php?op=file_repository',
			'fa_icon' 		=> 'fa-download',
			'access_level' 	=> is_mod_admin('File_Repository'),
			'file_exists' 	=> file_exists('modules/File_Repository/admin/index.php'),
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['digital_shop'],
			'url' 			=> $admin_file.'.php?op=digital-shop',
			'fa_icon' 		=> 'fa-shopping-cart',
			'access_level' 	=> is_mod_admin('Digital_Shop'),
			'file_exists' 	=> file_exists('modules/Digital_Shop/admin/index.php'),
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['cache'],
			'url' 			=> $admin_file.'.php?op=cache_clear',
			'fa_icon' 		=> 'fa-archive',
			'access_level' 	=> true,
			'file_exists' 	=> true,
			'divider'		=> false
		),
		array(
			'title' 		=> $customlang['floating_admin']['logout'],
			'url' 			=> $admin_file.'.php?op=logout',
			'fa_icon' 		=> 'fa-sign-out-alt',
			'access_level' 	=> true,
			'file_exists' 	=> true,
			'divider'		=> false
		)
    );

	/**
	 * OK, Let's add some inline CSS for the admin menu button.
	 */
	$fa_inline__css  = '<!-- Inline CSS for scroll to top v1.0 -->'.PHP_EOL;
	$fa_inline__css .= '<style>'.PHP_EOL;
	$fa_inline__css .= '.toggle-menu{-webkit-box-shadow: 0px 0px 3px 2px '.$ThemeInfo['uitotophover'].';-moz-box-shadow: 0px 0px 3px 2px '.$ThemeInfo['uitotophover'].';box-shadow: 0px 0px 3px 2px '.$ThemeInfo['uitotophover'].';}';
	$fa_inline__css .= '.navigation-item a:before {background-color: '.$ThemeInfo['uitotophover'].'}';
	$fa_inline__css .= '</style>'.PHP_EOL;
	addCSSToHead($fa_inline__css,'inline');

	/**
	 * Add the CSS for the popout admin menu into the header.
	 *
	 * The function "filemtime()" merely gets the file modification time,
	 * So if the author makes changes, the user does not have to clear browser cache in order for new changes to take effect.
	 *
	 * @link http://php.net/manual/en/function.filemtime.php
	 */
	addCSSToHead(FLOATING_ADMIN_CSS.'?v='.filemtime(FLOATING_ADMIN_CSS),'file');

	/**
	 * Add the jQuery for the popout admin menu into the footer.
	 *
	 * @see above for function "filemtime()".
	 */
    addJSToBody(FLOATING_ADMIN_JS.'?v='.filemtime(FLOATING_ADMIN_JS),'file');  

    /**
	 * Add some inline jQuery variables for getting text hover color and links.
	 */
	$fa_inline__js  = "<!-- Inline jQuery for floating admin menu v2.0 -->".PHP_EOL;
	$fa_inline__js .= "<script>".PHP_EOL;
	$fa_inline__js .= '	var uitotophover = "'.$ThemeInfo['uitotophover'].'";'.PHP_EOL;
	$fa_inline__js .= ' var links_json = "'.addslashes(json_encode($administration_links)).'";';
    $fa_inline__js .= "</script>".PHP_EOL;
    addJSToBody($fa_inline__js,'inline');  
}

?>