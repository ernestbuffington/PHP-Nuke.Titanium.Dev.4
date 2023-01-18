<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
	  Nuke Patched                             v3.1.0       06/26/2005
	  NukeSentinel                             v2.5.00      07/11/2006
	  Caching System                           v1.0.0       10/31/2005
	  Module Simplifications                   v1.0.0       11/17/2005
	  Evolution Functions                      v1.5.0       12/14/2005
-=[Other]=-
	  Admin Field Size                         v1.0.0       06/02/2005
	  Need To Delete                           v1.0.0       06/03/2005
	  Date Fix                                 v1.0.0       06/20/2005
-=[Mod]=-
	  Admin Icon/Link Pos                      v1.0.0       06/02/2005
	  Admin Tracker                            v1.0.1       06/08/2005
	  Advanced Username Color                  v1.0.6       06/13/2005
	  Advanced Security Code Control           v1.0.0       12/17/2005
	  Password Strength Meter                  v1.0.0       07/12/2005
	  Auto Admin Protector                     v2.0.0       08/18/2005
	  Evolution Version Checker                v1.1.0       08/21/2005
	  Auto Admin Login                         v2.0.1       08/27/2005
	  Auto First User Login                    v1.0.0       08/27/2005
	  Persistent Admin Login                   v2.0.0       12/10/2005
 ************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

/*****[BEGIN]******************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/
function need_delete($file, $dir=false) 
{
# will be uncommented for release
#  if (!$dir): 
#	if(!is_file($file)) 
#	return;
#	DisplayError("<span style='color: red; font-size: 24pt'>"._NEED_DELETE." ".$file."</span>");
#  else: 
#	if(!is_dir($file)) 
#	return;
#	DisplayError("<span style='color: red; font-size: 24pt'>"._NEED_DELETE." the folder \"".$file."\"</span>");
#  endif;
}
/*****[END]********************************************
 [ Other:   Need To Delete                     v1.0.0 ]
 ******************************************************/

function login() 
{
	global $admin_file, $db, $prefix, $admlang;

	title_and_meta_tags();
	get_header();
	title( $admlang['admin_login_header'] );

	if(get_evo_option('admin_fc_status') == "1"):
		$ip     = get_user_IP();
		$fcdate = date("mdYHi");
		$fc     = dburow("SELECT * FROM `"._FAILED_LOGIN_INFO_TABLE."` WHERE fc_ip = '$ip'");
		
		if(!isset($fc['fc_datetime']))
		$fc['fc_datetime'] = 0;

		if(!isset($fc['fc_attempts']))
		$fc['fc_attempts'] = 0;
		
		$fc_datetime = $fcdate - $fc['fc_datetime'];
		$fc_lefttime = get_evo_option( 'admin_fc_timeout' ) - $fc_datetime; 

		if ( $fc['fc_attempts'] <= get_evo_option( 'admin_fc_attempts' )  && $fc['fc_attempts'] != "0" && $fc_datetime <= get_evo_option( 'admin_fc_timeout' )): 
		$fctotal = get_evo_option( 'admin_fc_attempts' ) - $fc['fc_attempts'];
		title($admlang['adminfail']['you_have'].'&nbsp;'.$fctotal.'&nbsp;'.$admlang['adminfail']['attempts'].'&nbsp;'.get_evo_option('admin_fc_timeout').'&nbsp;'.$admlang['adminfail']['min']);
		endif;
	endif;

	opentable();

	/**
	 * Delete the old attempt when the timeout hits 0.
	 */
	$fc = [];
	
	if(!isset($fc['fc_attempts']))
	$fc['fc_attempts'] = 0;
	
	if ($fc['fc_attempts'] >= "1" && $fc_datetime >= get_evo_option( 'admin_fc_timeout' )):
		dbquery("DELETE FROM `"._FAILED_LOGIN_INFO_TABLE."` WHERE fc_ip = '$ip'");
		dbquery("OPTIMIZE TABLE "._FAILED_LOGIN_INFO_TABLE);
	endif;

	?>

	<style>
		.form-control {
			display: block;
			width: 100%;
			height: calc(1.5em + .75rem + 2px);
			padding: .375rem .75rem;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: .25rem;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}

		.justify-content-center {
			-ms-flex-pack: center!important;
			justify-content: center!important;
		}

		.al-block {
			display: block;
			width: 100%;
		}

		.al-width {
			width: 50%;
		}

		.m-auto {
			margin: auto!important;
		}

		.table-flex div {
			padding: 4px;
		}

		.form-group {
			margin-bottom: 1rem;
		}

		.alert {
			position: relative;
			padding: .75rem 1.25rem;
			margin-bottom: 1rem;
			border: 1px solid transparent;
			border-radius: .25rem;
		}

		.alert-warning {
			color: #856404;
			background-color: #fff3cd;
			border-color: #ffeeba;
		}

		@media (max-width: 768px) 
		{
			.al-width {
				width: 100%;
			}

			.btn-responsive {
				width: 100% !important;
			}
		}

	</style>

	<form method="post" action="<?php echo get_admin_filename() ?>.php">

	<div class="al-width m-auto">

		<?php if ( get_evo_option( 'admin_fc_status' ) == "1" && ($fc['fc_attempts'] >= get_evo_option( 'admin_fc_attempts' )) && ($fc_datetime <= get_evo_option( 'admin_fc_timeout' ) ) ): ?>
		<div class="alert alert-warning" role="alert">
			<?php echo $admlang['adminfail']['cooldown'].'&nbsp;'.($fc_lefttime == "0" ? $admlang['adminfail']['less_than'] : $fc_lefttime).'&nbsp;'.$admlang['adminfail']['min'] ?>
		</div>
		<?php endif; ?>

		<!-- administration login username -->
		<div class="col-12 form-group justify-content-center">
			<label for="aid"><?php echo $admlang['admin_id'] ?></label>
			<input type="text" name="aid" class="<?php echo ((defined('BOOTSTRAP')) ? 'form-control' : 'al-block') ?>" id="aid" placeholder="Enter username">
		</div>

		<!-- administration login password -->
		<div class="col-12 form-group justify-content-center">
			<label for="password"><?php echo $admlang['global']['password'] ?></label>
			<input type="password" name="pwd" class="<?php echo ((defined('BOOTSTRAP')) ? 'form-control' : 'al-block') ?>" id="password" placeholder="Enter password">
		</div>

		<div class="col-12 form-group justify-content-center m-3">
			<input type="checkbox" name="persistent" value="1" class="form-check-input" id="persistentLogin">
			<label class="form-check-label" for="persistentLogin"><?php echo $admlang['admin_login_persistent'] ?></label>
		</div>

		<?php if ( in_array( get_evo_option('usegfxcheck'), array(1,5,6,7) ) ): ?>
		<div class="divider"></div>     

		<div style="text-align: -webkit-center; text-align: -moz-center;">
		<?php echo security_code(array(1,5,6,7), 'normal'); ?>
		</div>

		<div class="divider"></div>
		<?php endif; ?>

		<div class="col-12 form-group text-center">
			<input class="btn btn-primary btn-responsive" type="submit" name="submit" value="<?php echo $admlang['global']['login'] ?>">
		</div>

	</div>
	<input type="hidden" name="op" value="login">
	</form>

	<?php   
	closetable();
	get_footer();
}

function deleteNotice($id) 
{
	global $prefix, $db, $admin_file, $cache;
	$id = intval($id);
	$db->sql_query("DELETE FROM `".$prefix."_reviews_add` WHERE `id` = '$id'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
	$cache->delete('numwaitreviews', 'submissions');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
	redirect($admin_file.".php?op=reviews");
}

function adminmenu($url, $title, $image) 
{
	global $counter, $admingraphic, $admin, $module_folder_name;

	if(file_exists('modules/'.$module_folder_name.'/images/admin/'.$image)):
		$image = 'modules/'.$module_folder_name.'/images/admin/'.$image;
	elseif(file_exists('modules/'.$module_folder_name.'/images/'.$image)):
		$image = 'modules/'.$module_folder_name.'/images/'.$image;
	else:
		$image = 'images/admin/'.$image;
	endif;

	if ($admingraphic):
		// $image = '<img src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" width="32" height="32" />';
		$image_file = '<img src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" width="40" height="40" />';
	else:
		$image_file = '';
	endif;

	if (!is_god($admin) && ($title == 'Edit Admins' 
	|| $title == 'Nuke Sentinel(tm)' 
	|| $title == 'Nuke Honeypot' 
	|| $title == 'Database' 
	|| $title == 'Newsletter' 
	|| $title == 'Messages'))
	{
		if(defined('BOOTSTRAP')):
		?>
			<a style="pointer-events: none" href="<?php echo $url ?>">
				<h3 style="font-size: 17px; margin: 0; text-decoration: line-through"><?php echo $title ?></h3>
			</a>
		<?php
		else:
			echo '    <td style="width: 16.6%;">';
			echo '      <a href="'.$url.'">';
			echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">';           
			echo '        <tr>';
			echo '          <td class="row1">'.(($admingraphic) ? $image_file.'<br />' : '').'<em style="text-decoration: line-through; letter-spacing:1px;">'.$title.'</span></td>';
			echo '        </tr>';
			echo '      </table>';
			echo '      </a>';
			echo '    </td>';

		endif;
	}
	else
	{
			echo '    <td style="width: 16.6%;">';
			echo '      <a href="'.$url.'">';
			echo '      <table style="height: 75px; text-align: center; width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">';           
			echo '        <tr>';
			echo '          <td class="row1">'.(($admingraphic) ? $image_file.'<br />' : '').$title.'</td>';
			echo '        </tr>';
			echo '      </table>';
			echo '      </a>';
			echo '    </td>';
	}

	if ($counter == 5) 
	{
		//if($end == FALSE)
		if(!isset($end))
		{
			echo '</tr>'."\n".'<tr>'."\n";
		}
	}
	$counter = ($counter == 5) ? 0 : (int) $counter+1;
}

function track_admin_intrusion()
{
	global $admin_file, $admlang; 
	$ret_log = log_size('admin');
	if($ret_log == -1)
		$admin_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['error'].'</span>';
	elseif($ret_log == -2)
		$admin_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['admin_chmod'].'</span>';
	elseif($ret_log)
		$admin_msg = '<span style="color:red; font-weight: bold;">'.sprintf($admlang['logs']['admin_changed'],'<span style="color: red">','</span>').'</span>';
	else
		$admin_msg = '<span style="color:green; font-weight: bold;">'.$admlang['logs']['admin_fine'].'</span>';

	if(!isset($return))
	$return = '';
	
	$return .= '  <tr>'."\n";
	$return .= '    <td style="height:15px; font-size: 13px; width:65%;">'.$admin_msg.'</td>'."\n";
	$return .= '    <td style="height:15px; font-size: 13px; width:25%; text-align:center;"><a href="'.$admin_file.'.php?op=viewadminlog&amp;log=admin">'.$admlang['logs']['view'].'</a></td>'."\n";
	$return .= '  </tr>'."\n";
	return $return;
}

function track_sql_errors()
{
	global $admin_file, $admlang;
	$ret_log = log_size('error');
	if($ret_log == -1)
		$error_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['error'].'</span>';
	elseif($ret_log == -2)
		$error_msg = '<span style="color:red; font-weight: bold;">'.$admlang['logs']['eerror_chmod'].'</span>';
	elseif($ret_log)
		$error_msg = '<span style="color:red; font-weight: bold;">'.sprintf($admlang['logs']['error_changed'],'<span style="color: red">','</span>').'</span>';
	else
		$error_msg = '<span style="color:green; font-weight: bold;">'.$admlang['logs']['error_fine'].'</span>';

	if(!isset($return))
	$return = '';

	$return .= '  <tr>'."\n";
	$return .= '    <td style="height:15px; font-size: 13px; width:65%;">'.$error_msg.'</td>'."\n";
	$return .= '    <td style="height:15px; font-size: 13px; width:25%; text-align:center;"><a href="'.$admin_file.'.php?op=viewadminlog&amp;log=error">'.$admlang['logs']['view'].'</a></td>'."\n";
	$return .= '  </tr>'."\n";
	return $return;
}

function track_titanium_current_version() 
{
	global $admin_file, $admlang;
	/**
	 * Version checker json
	 */
	$version_refresh = get_query_var( 'check-version', 'get', 'string', false );
	$version_check_cache = cache_json_data('https://php-nuke-titanium.86it.us/versions/titanium-version.json', dirname(__FILE__).'/version.cache', $version_refresh); 

	if($version_check_cache['version'] == NUKE_TITANIUM):

		$version_desc = $admlang['admin']['version_is_current'];
		$new_version_number = NUKE_TITANIUM;
		$update_url = $admin_file.'.php?check-version=true';

	else:

		$version_desc = $admlang['admin']['version_is_out-of-date'];
		$new_version_number = $version_check_cache['version'];
		$update_url = $version_check_cache['download'];

	endif;

	if(!isset($return))
	$return = '';

	$return .= '  <tr>'."\n";
	$return .= '    <td style="height:15px; font-size: 13px; width:65%;">PHP-Nuke Titanium '.$new_version_number.'&nbsp;&nbsp;<font size="1">'.$version_desc.'</font></td>'."\n";
	$return .= '    <td style="height:15px; font-size: 13px; width:25%; text-align:center;"><a href="'.$update_url.'">Check Version</a></td>'."\n";
	$return .= '  </tr>'."\n";

	return $return;
}
 
/*****[BEGIN]******************************************
 [ Mod:    Admin Icon/Link Pos                 v1.0.0 ]
 ******************************************************/
function GraphicAdmin($pos=1)
{
	global $aid, $admingraphic, $cache, $language, $admin, $prefix, $user_prefix, $db, $counter, $admin_file, $admin_pos, $radminsuper, $admlang;   
	
	if ($pos != $admin_pos)
	return;

	$radminsuper = is_mod_admin();

	list($waiting_users) = $db->sql_ufetchrow("select count(user_id) from `".USERS_TEMP_TABLE."`");

	OpenTable();
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1">';
	echo '  <tr>';

	/*
    | START | LIVE NEWS FEED DIRECTLY FROM https://php-nuke-titanium.86it.us
    */
	global $domain;

    echo '<td style="vertical-align: top; width: 64%;">';
    echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">';
    echo '<tr>';
    echo '<td class="catHead" style="height:30px; letter-spacing: 1px;" class="catHead">'.$admlang['livefeed']['header'].'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="row1">';
    echo '<div style="height: 15.0em; overflow: auto;">';
    
	echo '<table style="font-family: monospace !important; width: 100%;" border="0" cellpadding="3" cellspacing="1" class="livefeed">';
    
	$agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36';
    $curl = curl_init('https://php-nuke-titanium.86it.us/versions/feed.php');
    curl_setopt($curl, CURLOPT_USERAGENT, $agent);
    curl_setopt($curl, CURLOPT_USERAGENT, $agent);
    curl_setopt($curl, CURLOPT_REFERER, 'https://'.$domain.'/');
    $dir = NUKE_BASE_DIR.'includes/log';
    $config['cookie_file'] = $dir.'/'.$_SERVER['REMOTE_ADDR'].'.txt';
    curl_setopt($curl, CURLOPT_COOKIEFILE, $config['cookie_file']);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $config['cookie_file']);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $page = curl_exec($curl);	
	echo $page;
	
	echo '</table>';
	
	echo '</div>';
    echo '</td>';
    echo '</tr>';
    
	echo '</table>';
    
	echo '</td>';
    /*
    | END | LIVE NEWS FEED DIRECTLY FROM https://php-nuke-titanium.86it.us
    */
	
	/**
	 * Retrieve the live news json feed
	 */
	$version_refresh = get_query_var( 'check-version', 'get', 'string', false );
	$live_news_feed_cache = cache_json_data('https://php-nuke-titanium.86it.us/versions/titanium-live-feed.json', dirname(__FILE__).'/live-feed.cache', $version_refresh);

	echo '<td style="vertical-align: top; width: 36%;">';
	echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">';

    # table header message
	echo '<tr>';
	echo '<td class="catHead" style="height:30px; letter-spacing: 1px;" class="catHead">'.$admlang['admin']['important'].'</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td class="row1">';
	echo '<div>';
    echo '<div style="height: 15.0em; overflow: auto;">';
	
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1">';
	
	# admin log
	echo track_admin_intrusion();
	
	# error log
	echo track_sql_errors();
	
	# check evo version
	echo track_titanium_current_version();

    # admin ip lock enabled/disabled
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">'.$admlang['admin']['ip_lock'].'</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;">'.((defined('ADMIN_IP_LOCK')) ? $admlang['global']['enabled'] : $admlang['global']['disabled']).'</a></td>';
	echo '</tr>';

    # Input Filter enabled/disabled
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">'.$admlang['admin']['filter'].'</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;">'.$admlang['global']['enabled'].'</td>';
	echo '</tr>';

    # NukeSentinel enabled/disabled
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">'._AB_NUKESENTINEL.'</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;">'.((defined('NUKESENTINEL_IS_LOADED')) ? $admlang['global']['enabled'] : $admlang['global']['disabled']).'</td>';
	echo '</tr>';

    # waiting users - shows number of users waiting!
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">'.$admlang['admin']['waiting_users'].'</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;"><a href="modules.php?name=Your_Account&file=admin&op=listpending">'.$waiting_users.'</a></td>';
	echo '</tr>';

    # waiting users - shows number of users waiting!
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">Waitng Links</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;"><a href="modules.php?name=Your_Account&file=admin&op=listpending">0</a></td>';
	echo '</tr>';

    # waiting users - shows number of users waiting!
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">Starlink Passthru</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;"><a href="modules.php?name=Your_Account&file=admin&op=listpending">on</a></td>';
	echo '</tr>';

    # waiting users - shows number of users waiting!
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">Tor Network Decryption</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;"><a href="modules.php?name=Your_Account&file=admin&op=listpending">on</a></td>';
	echo '</tr>';

    # waiting users - shows number of users waiting!
	echo '<tr>';
	echo '<td style="height: 15px; font-size: 13px;">Pionen Data Access Blocker</td>';
	echo '<td style="height: 15px; font-size: 13px; text-align: center;"><a href="modules.php?name=Your_Account&file=admin&op=listpending">on</a></td>';
	echo '</tr>';


	echo '</table>';

	echo '</div>';
	echo '</div>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';

	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1">'; // remove this to go back to normal
	if(is_mod_admin('super'))
	{
		echo '  <tr>';
		echo '    <td colspan="6">';
		echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
		echo '        <tr>';
		echo '          <td class="catHead">'.$admlang['admin']['administration_header'].'</td>';
		echo '        </tr>';
		echo '      </table>';
		echo '    </td>';
		echo '  </tr>';
		echo '  <tr>'."\n";
		$linksdir = opendir(NUKE_ADMIN_DIR.'links');
		$menulist = '';
		while(false !== ($func = readdir($linksdir))) 
		{
			if(substr($func, 0, 6) == 'links.')
				$menulist .= $func.' ';
		}
		closedir($linksdir);
		$menulist = explode(' ', $menulist);
		sort($menulist);
		for ($i=0, $maxi = count($menulist); $i < $maxi; $i++)  
		{
			if(!empty($menulist[$i]))
				include(NUKE_ADMIN_DIR.'links/'.$menulist[$i]);
		}
		$counter = "";
		echo '        </tr>'."\n";
	}
	echo '  <tr>';
	echo '    <td colspan="6">';
	echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
	echo '        <tr>';
	echo '          <td class="catHead">'.$admlang['admin']['modules_header'].'</td>';
	echo '        </tr>';
	echo '      </table>';
	echo '    </td>';
	echo '  </tr>';
	echo '  <tr>'."\n";
	update_modules();
	$result = $db->sql_query("SELECT `title` FROM `".$prefix."_modules` ORDER BY `title` ASC");
	$count = 0;
	while($row = $db->sql_fetchrow($result)) 
	{
		if (is_mod_admin($row['title'])) 
		{
			if (file_exists(NUKE_MODULES_DIR.$row['title']."/admin/index.php") AND file_exists(NUKE_MODULES_DIR.$row['title']."/admin/links.php") AND file_exists(NUKE_MODULES_DIR.$row['title']."/admin/case.php")) 
			{
				global $module_folder_name;
				$module_folder_name = $row['title'];
				include(NUKE_MODULES_DIR.$row['title'].'/admin/links.php');
			}
			$count++;
		}
	}
	$db->sql_freeresult($result);
	if ($count == 0)
	{
		echo '    <td class="row1" style="text-align:center;">';
		echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
		echo '        <tr>';
		echo '          <td class="row1">'.sprintf($admlang['admin']['no_rights'], UsernameColor($userinfo['username'])).'</td>';
		echo '        </tr>';
		echo '      </table>';
		echo '    </td>'."\n";
	}
	echo '  </tr>'."\n"; 

	/**
	 * Load up the new theme admin panels
	 */
	$result2 = $db->sql_query("SELECT `theme_name` FROM `".$prefix."_themes` ORDER BY `theme_name` ASC");
	$themes_row = $db->sql_fetchrowset( $result2 );
	$db->sql_freeresult($result2);

	if (count($themes_row) > 0 ):

		echo '  <tr>';
		echo '    <td colspan="6">';
		echo '      <table style="text-align: center; width: 100%;" border="0" cellpadding="0" cellspacing="1" class="forumline">';
		echo '        <tr>';
		if (!isset($theme['theme_name']))
		$theme['theme_name'] = 'Titanium_Core';
		
		if (file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/index.php") 
		AND file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/links.php") 
		AND file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/case.php")):
		echo '          <td class="catHead">Theme Administration</td>';
        else:
		echo '          <td class="catHead"></td>';
		endif;
		echo '        </tr>';
		echo '      </table>';
		echo '    </td>';
		echo '  </tr>';
		echo '  <tr>'."\n";
		
		foreach( $themes_row as $theme ):

			if (file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/index.php") 
			AND file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/links.php") 
			AND file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/case.php")):
			include(NUKE_THEMES_DIR.$theme['theme_name'].'/admin/links.php');
			endif;

		endforeach;
		
		echo '  </tr>'."\n";

	endif;
	echo '</table>';
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
	global $admin_fc_status, $admin_fc_attempts, $admin_fc_timeout;
	$ip = $_SERVER['REMOTE_ADDR'];
	$fc = $db->sql_ufetchrow("SELECT * FROM `". $prefix ."_admin_fc` WHERE fc_ip = '$ip'");
	if (!empty($fc['fc_ip']))
	{
		$db->sql_query("DELETE FROM ".$prefix."_admin_fc WHERE fc_ip = '$ip'");
		$db->sql_query("OPTIMIZE TABLE ".$prefix."_admin_fc");
	}
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
	CloseTable();
}

/**
 * Created this function for tracking admin intrusions, and to be useable in responsive themes, as we no longer require table elements.
 */
function track_admin_intrusions_bs()
{
	global $admin_file, $admlang;
	$ret_log = log_size('admin');
	if($ret_log == -1):
		$admin_msg = $admlang['logs']['error'];
		$class = 'bg-danger';
	elseif($ret_log == -2):
		$admin_msg = $admlang['logs']['admin_chmod'];
		$class = 'bg-warning';
	elseif($ret_log):
		$admin_msg = str_replace('%s', '', $admlang['logs']['admin_changed']);
		$class = 'bg-danger';
	else:
		$admin_msg = $admlang['logs']['admin_fine'];
		$class = 'bg-dark';
	endif;

	$adminlog['number'] = $ret_log;
	$adminlog['message'] = $admin_msg;
	$adminlog['class'] = $class;
	return $adminlog;
}

function track_sql_errors_bs()
{
	global $admin_file, $admlang;
	$ret_log = log_size('error');
	if($ret_log == -1):
		$error_msg = $admlang['logs']['error'];
		$class = 'bg-danger';
	elseif($ret_log == -2):
		$error_msg = $admlang['logs']['eerror_chmod'];
		$class = 'bg-warning';
	elseif($ret_log):
		$error_msg = str_replace('%s', '', $admlang['logs']['error_changed']);
		$class = 'bg-danger';
	else:
		$error_msg = $admlang['logs']['error_fine'];
		$class = 'bg-dark';
	endif;
	$errorlog['number'] = $ret_log;
	$errorlog['message'] = $error_msg;
	$errorlog['class'] = $class;
	return $errorlog;
}

function track_titanium_current_version_bs() 
{
	global $admin_file, $admlang;
	/**
	 * Version checker json
	 */
	$version_refresh = get_query_var( 'check-version', 'get', 'string', false );
	$version_check_cache = cache_json_data('https://php-nuke-titanium.86it.us/versions/titanium-version.json', dirname(__FILE__).'/version.cache', $version_refresh); 

	if ( $version_check_cache['version'] == NUKE_TITANIUM):

		$version_desc = $admlang['admin']['version_is_current'];
		$class = 'bg-dark';
		$update_available = false;
		$new_version_number = NUKE_TITANIUM;
		$update_url = $admin_file.'.php?check-version=true';

	else:

		$version_desc = $admlang['admin']['version_is_out-of-date'];
		$class = 'bg-warning';
		$update_available = true;
		$new_version_number = NUKE_TITANIUM;
		$update_url = $version_check_cache['download'];

	endif;
	$versioncheck['new_version_number'] = $version_check_cache['version'];
	$versioncheck['update_available'] = $update_available;
	$versioncheck['message'] = $version_desc;
	$versioncheck['class'] = $class;
	$versioncheck['update_url'] = $update_url;
	return $versioncheck;
}

function administration_panel( $pos = 1 )
{
	global $aid, $admingraphic, $cache, $language, $admin, $prefix, $user_prefix, $db, $counter, $admin_file, $admin_pos, $radminsuper, $admlang;   

	$radminsuper = is_mod_admin();

	$queries = dburow("SELECT
		(SELECT COUNT(user_id) FROM `".USERS_TABLE."` WHERE user_id > 1) AS registered_users,
		(SELECT COUNT(user_id) FROM `".USERS_TEMP_TABLE."`) AS waiting_users,
		(SELECT COUNT(user_id) FROM `".USERS_TABLE."` WHERE user_level = '-1' AND user_id > '1') AS deactivated_users,
		(SELECT COUNT(id) FROM `"._HONEYPOT_TABLE."`) AS bots_stopped,
		(SELECT COUNT(cid) FROM `"._FILE_REPOSITORY_CATEGORIES."`) AS total_categories,
		(SELECT COUNT(did) FROM `"._FILE_REPOSITORY_ITEMS."`) AS total_downloads,
		(SELECT COUNT(cid) FROM `"._FILE_REPOSITORY_ITEMS."` WHERE isbroken=1) AS broken_downloads,
		(SELECT COUNT(forum_id) FROM `".FORUMS_TABLE."`) AS total_forums,
		(SELECT COUNT(topic_id) FROM `".TOPICS_TABLE."`) AS total_topics,
		(SELECT COUNT(post_id) FROM `".POSTS_TABLE."`) AS total_posts
	");

	$adminlog = track_admin_intrusions_bs();
	$errorlog = track_sql_errors_bs();
	$versioncheck = track_titanium_current_version_bs();

	$refresh_feed = get_query_var('refresh-feed', 'get', 'bool');

?>

	<div class="container-fluid">

		<div class="row">
					
			<div class="col-12 live-feed-panel">
				<h3 class="live-feed widget-title">
					<?php echo $admlang['livefeed']['header'] ?>
					<a href="<?php echo get_admin_filename(); ?>.php?refresh-feed=true"><span class="sr-only"><?php echo $admlang['livefeed']['refresh'] ?></span></a>
				</h3>
				<div class="feed-Bx">
						
					<?php $live_news_feed_cache = cache_json_data('https://php-nuke-titanium.86it.us//versions/titanium-live-feed.json', dirname(__FILE__).'/live-feed.cache', $refresh_feed); ?>
					<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1">                                             
						<?php foreach( array_reverse($live_news_feed_cache) as $key => $value ): $color_title = ($value['color']) ? ' style="color:'.$value['color'].'"' : ''; ?>

						<tr>
							<dt class="news-feed-title">
								<span<?php echo $color_title; ?>><?php echo $value['title']; ?></span>
								<span class="news-feed-time"><?php echo $value['timestamp']; ?></span>
							</dt>
							<dd class="news-feed-message"><?php echo $value['message']; ?></dd>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 admin-info-cubes">
				<a href="<?php echo $admin_file; ?>.php?op=viewadminlog&log=admin">
					<div class="small-box <?php echo $adminlog['class'] ?>">
						<h2 class="title"><?php echo $admlang['admin']['admin_intrusion']; ?></h2>
						<span class="desc"><?php echo $adminlog['message'] ?></span>
						<div class="icon">
							<i class="fas fa-exclamation-triangle"></i>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 admin-info-cubes">
				<a href="<?php echo $admin_file; ?>.php?op=viewadminlog&log=error">
					<div class="small-box <?php echo $errorlog['class'] ?>">
						<h2 class="title"><?php echo $admlang['admin']['admin_error_log']; ?></h2>
						<span class="desc"><?php echo $errorlog['message'] ?></span>
						<div class="icon">
							<i class="fas fa-bug"></i>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 admin-info-cubes">
				<a href="<?php echo $admin_file; ?>.php?op=honeypot">
					<div class="small-box bg-dark">
						<h2 class="title"><?php echo $admlang['admin']['admin_honey_pot']; ?></h2>
						<span class="desc"><?php echo sprintf($admlang['admin']['honey_pot_bots_stopped'], $queries['bots_stopped']); ?></span>
						<div class="icon">
							<i class="fab fa-forumbee"></i>
						</div>
					</div>
				</a>
			</div>

			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 admin-info-cubes">
				<a href="<?php echo $versioncheck['update_url']; ?>">
					<div class="small-box <?php echo $versioncheck['class'] ?>">
						<h2 class="title"><?php echo $versioncheck['new_version_number'].' '.EVO_EDITION ?></h2>
						<span class="desc"><?php echo $versioncheck['message']; ?></span>
						<div class="icon">
							<i class="fas fa-code-branch"></i>
						</div>
					</div>
				</a>
			</div>

		</div>

		<div class="row">

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 admin-info-cubes">
                <a href="<?php echo get_admin_filename(); ?>.php?op=forums">
                    <div class="small-box <?php echo $adminlog['class'] ?>">
                        <h2 class="title"><?php echo $admlang['admin']['forums_overview']; ?></h2>
                        <span class="desc">
                        	<div class="row">
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_forums']; ?></div>
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_forum_topics']; ?></div>
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_forum_posts']; ?></div>
                        	</div>
                        	<div class="row">
                        		<div class="col-4"><?php echo $queries['total_forums']; ?></div>
                        		<div class="col-4"><?php echo $queries['total_topics']; ?></div>
                        		<div class="col-4"><?php echo $queries['total_posts']; ?></div>
                        	</div>
                        </span>
                        <div class="icon">
                            <i class="far fa-comment"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 admin-info-cubes">
                <a href="<?php echo get_admin_filename(); ?>.php?op=file_repository">
                    <div class="small-box <?php echo $errorlog['class'] ?>">
                        <h2 class="title"><?php echo $admlang['admin']['downloads_overview']; ?></h2>
                        <span class="desc">
                        	<div class="row">
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_categories']; ?></div>
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_downloads']; ?></div>
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['broken_downloads']; ?></div>
                        	</div>
                        	<div class="row">
                        		<div class="col-4"><?php echo $queries['total_categories']; ?></div>
                        		<div class="col-4"><?php echo $queries['total_downloads']; ?></div>
                        		<div class="col-4"><?php echo $queries['broken_downloads']; ?></div>
                        	</div>
                        </span>
                        <div class="icon">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 admin-info-cubes">
                <a href="modules.php?name=Your_Account&file=admin">
                    <div class="small-box bg-dark">
                        <h2 class="title"><?php echo $admlang['admin']['users_overview']; ?></h2>
                        <span class="desc">
                        	<div class="row">
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_users']; ?></div>
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_waiting']; ?></div>
                        		<div class="col-4 font-weight-bold"><?php echo $admlang['admin']['total_deactivated']; ?></div>
                        	</div>
                        	<div class="row">
                        		<div class="col-4"><?php echo $queries['registered_users'] ?></div>
                        		<div class="col-4"><?php echo $queries['waiting_users'] ?></div>
                        		<div class="col-4"><?php echo $queries['deactivated_users'] ?></div>
                        	</div>
                        </span>
                        <div class="icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                    </div>
                </a>
            </div>

            <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3 admin-info-cubes">
                <a href="<?php echo $versioncheck['update_url']; ?>">
                    <div class="small-box <?php echo $versioncheck['class'] ?>">
                        <h2 class="title"><?php echo $versioncheck['new_version_number'].' '.EVO_EDITION ?></h2>
                        <span class="desc"><?php echo $versioncheck['message']; ?></span>
                        <div class="icon">
                            <i class="fas fa-code-branch"></i>
                        </div>
                    </div>
                </a>
            </div> -->

        </div>

		<?php if ( is_mod_admin('super') ): ?>

		<div class="row">
			<h3 class="col-12 important-info widget-title mb-2 mt-4"><?php echo $admlang['admin']['administration_header'] ?></h3> 
		</div>

		<div class="row">

			<?php
			$linksdir = opendir(NUKE_ADMIN_DIR.'links');
			$menulist = '';
			while(false !== ($func = readdir($linksdir))) 
			{
				if(substr($func, 0, 6) == 'links.')
					$menulist .= $func.' ';
			}
			closedir($linksdir);
			$menulist = explode(' ', $menulist);
			sort($menulist);
			for ($i=0, $maxi = count($menulist); $i < $maxi; $i++) 
			{
				if( !empty( $menulist[$i] ) ):
			?>
				<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2 pl-0 admin-buttons-container">

					<div class="admin-buttons">

						<?php include(NUKE_ADMIN_DIR.'links/'.$menulist[$i]); ?>

					</div>

				</div>
			<?php
				endif; 
			}
			$counter = "";
			?>

		</div>
		<?php endif; ?>

		<?php if ( is_mod_admin('super') ): ?>

		<div class="row">
			<h3 class="col-12 important-info widget-title mb-2 mt-4"><?php echo $admlang['admin']['modules_header'] ?></h3> 
		</div>

		<div class="row">

			<?php

			update_modules();
			$result = $db->sql_query("SELECT `title` FROM `".$prefix."_modules` ORDER BY `title` ASC");
			$count = 0;
			while($row = $db->sql_fetchrow($result)) 
			{
				if (is_mod_admin($row['title'])) 
				{
					if (file_exists(NUKE_MODULES_DIR.$row['title']."/admin/index.php") AND file_exists(NUKE_MODULES_DIR.$row['title']."/admin/links.php") AND file_exists(NUKE_MODULES_DIR.$row['title']."/admin/case.php")) 
					{
						// global $module_folder_name;
						// $module_folder_name = $row['title'];
						?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2 pl-0 admin-buttons-container">
							<div class="admin-buttons"><?php include(NUKE_MODULES_DIR.$row['title'].'/admin/links.php'); ?></div>
						</div>
						<?php
					}
					$count++;
				}
			}
			$db->sql_freeresult($result);

			?>

		</div>

		<?php endif; ?>

		<?php 

		/**
		 * Theme Administration
		 */
		if ( is_mod_admin('super') ): 

			$result2 = $db->sql_query("SELECT `theme_name` FROM `".$prefix."_themes` ORDER BY `theme_name` ASC");
			$themes_row = $db->sql_fetchrowset( $result2 );
			$db->sql_freeresult($result2);

			if ( count( $themes_row ) > 0 ): ?>

				<div class="row">
					<h3 class="col-12 important-info widget-title mb-2 mt-4"><?php echo $admlang['admin']['themes_header'] ?></h3> 
				</div>

				<div class="row">
				<?php foreach( $themes_row as $theme ): ?>

					<?php if (file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/index.php") AND file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/links.php") AND file_exists(NUKE_THEMES_DIR.$theme['theme_name']."/admin/case.php")): ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2 pl-0 admin-buttons-container">
							<div class="admin-buttons">
							<?php include(NUKE_THEMES_DIR.$theme['theme_name'].'/admin/links.php'); ?>
							</div>
						</div>
					<?php endif; ?> 

				<?php endforeach; ?>
				</div>

			<?php endif; ?>  

		<?php endif; ?>  


	</div>

<?php
/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
	$ip = $_SERVER['REMOTE_ADDR'];
	$fc = $db->sql_ufetchrow("SELECT * FROM `"._FAILED_LOGIN_INFO_TABLE."` WHERE fc_ip = '$ip'");
	if (!empty($fc['fc_ip']))
	{
		$db->sql_query("DELETE FROM "._FAILED_LOGIN_INFO_TABLE." WHERE fc_ip = '$ip'");
		$db->sql_query("OPTIMIZE TABLE "._FAILED_LOGIN_INFO_TABLE);
	}
/*****[END]********************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/    
}

?>
