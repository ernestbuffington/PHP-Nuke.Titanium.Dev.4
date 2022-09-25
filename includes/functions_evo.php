<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
Nuke-Evolution: Evolution Functions
============================================
Copyright (c) 2005 by The Nuke-Evolution Team

Filename      : functions_evo.php
Author        : The Nuke-Evolution Team
Version       : 1.5.0
Date          : 12.14.2005 (mm.dd.yyyy)

Notes         : Miscellaneous functions
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/**
 * Get a user's field from the DB
 *
 * @author JeFFb68CAM
 *
 * @param string $field_name The field to retrieve
 * @param string $titanium_user Username or User_id
 * @param bool $is_name Is the $titanium_user a username
 * @return string
 */
// recoded by ReOrGaNiSaTiOn
// This function is called by mainfile.php to fill $userinfo
// and from other files to get specific informations about an user
// it makes no sense to cache all users (maybe this can be thousands)
// but for actual page we can make the informations static
function get_user_field($field_name, $titanium_user, $is_name = false) 
{
    global $titanium_db, $identify;
    static $actual_user;
    if (!$titanium_user) return NULL;

    if ($is_name || !is_numeric($titanium_user))  
	{
        $where  = "`username` = '". str_replace("\'", "''", $titanium_user)."'";
        $search = 'username';
    } 
	else 
	{
        $where  = "`user_id` = '".$titanium_user."'";
        $search = 'user_id';
    }
    
	if (!isset($actual_user[$titanium_user])) 
	{
        $sql = "SELECT * FROM ".USERS_TABLE." WHERE $where";
        $actual_user[$titanium_user] = $titanium_db->sql_ufetchrow($sql);
        // We also put the groups data in the array.
        $result = $titanium_db->sql_query('SELECT g.group_id, 
		                               g.group_name, 
								g.group_single_user 
								  
								  FROM ('.GROUPS_TABLE.' AS g 
								  INNER JOIN '.USER_GROUP_TABLE.' 
								  AS ug ON (ug.group_id=g.group_id AND ug.user_id="'.$actual_user[$titanium_user]['user_id'].'" 
								  AND ug.user_pending=0))', true);
								  
        while(list($g_id, $g_name, $single) = $titanium_db->sql_fetchrow($result)) 
		{
            $actual_user[$titanium_user]['groups'][$g_id] = ($single) ? '' : $g_name;
        }
        $titanium_db->sql_freeresult($result);
    }
    if($field_name == '*') 
	{
        $actual_user[$titanium_user]['user_ip'] = $identify->get_ip();
        return $actual_user[$titanium_user];
    }
    if(is_array($field_name)) 
	{
        $data = array();
        foreach($field_name as $fld) 
		{
            $data[$fld] = $actual_user[$titanium_user][$fld];
        }
        return $data;
    }
    return $actual_user[$titanium_user][$field_name];
}

/**
 * Gets a admin field from the DB
 *
 * @author JeFFb68CAM
 *
 * @param string $field_name The field to get
 * @param string $admin The admin name/aid
 * @return string
 */
function get_admin_field($field_name, $admin) 
{
    global $titanium_db, $debugger;
    static $fields = array();
    if (!$admin) {
        return array();
    }

    if(!isset($fields[$admin]) || !is_array($fields[$admin])) {
        $fields[$admin] = $titanium_db->sql_ufetchrow("SELECT * FROM "._AUTHOR_TABLE." WHERE `aid` = '" .  str_replace("\'", "''", $admin) . "'");
    }

    if($field_name == '*') {
        return $fields[$admin];
    }
    if(is_array($field_name)) {
        $data = array();
        foreach($field_name as $fld) {
            $data[$fld] = $fields[$admin][$fld];
        }
        return $data;
    }

    return $fields[$admin][$field_name];
}

/**
 * Checks to see if a user is a module admin
 *
 * @author Quake
 *
 * @param string $titanium_module_name Module name
 * @return bool
 */
function is_mod_admin($titanium_module_name='super') 
{

    global $titanium_db, $aid, $admin;
    static $auth = array();

    if(!is_admin()) return 0;
    if(isset($auth[$titanium_module_name])) return $auth[$titanium_module_name];

    if(!isset($aid)) {
        if(!is_array($admin)) {
            $aid = base64_decode($admin);
            $aid = explode(":", $aid);
            $aid = $aid[0];
        } else {
            $aid = $admin[0];
        }
    }
    $admdata = get_admin_field('*', $aid);
    $auth_user = 0;
    if($titanium_module_name != 'super') {
        list($admins) = $titanium_db->sql_ufetchrow("SELECT `admins` FROM "._MODULES_TABLE." WHERE `title`='$titanium_module_name'");
        $adminarray = explode(",", $admins);
        for ($i=0, $maxi=count($adminarray); $i < $maxi; $i++) {
            if ($admdata['aid'] == $adminarray[$i] && !empty($admins)) {
                $auth_user = 1;
            }
        }
    }
    $auth[$titanium_module_name] = ($admdata['radminsuper'] == 1 || $auth_user == 1);
    return $auth[$titanium_module_name];

}

/**
 * Get all admins for a module
 *
 * @author ReOrGaNiSaTiOn (based on is_mod_admin from Quake)
 *
 * @param string $titanium_module_name Module name
 * super = only Superuser
 * module_name = only Admins with privileges for this module
 * all with module_name = Superuser + Module-Admins
 * @return array of admin-names with email-address by default only Superuser
 */
function get_mod_admins($titanium_module_name='super', $all='') 
{

    global $titanium_db;
    static $admins = array();

    if ( $all =='') {
        if(isset($admins[$titanium_module_name])) {return $admins[$titanium_module_name];}
    }

    if($titanium_module_name == 'super' || $all != '') {
        $result1 = $titanium_db->sql_query("SELECT `aid`, `email` FROM `"._AUTHOR_TABLE."` WHERE `radminsuper`='1'");
        $num = 0;
        while (list($admin, $email) = $titanium_db->sql_fetchrow($result1)) {
            $admins[$titanium_module_name][$num]['aid'] = $admin;
            $admins[$titanium_module_name][$num]['email'] = $email;
            $num++;
        }
        $titanium_db->sql_freeresult($result1);
    }

    if($titanium_module_name != 'super') {
        list($admin) = $titanium_db->sql_ufetchrow("SELECT `admins` FROM `"._MODULES_TABLE."` WHERE `title`='".$titanium_module_name."'");
        $adminarray = explode(",", $admin);
        $num = ($all !='') ? $num : 0;
        for ($i=0, $maxi=count($adminarray); $i < $maxi; $i++) {
            $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `aid`, `email` FROM `"._AUTHOR_TABLE."` WHERE `aid`='".$adminarray[$i]."'"));
            if (!empty($row['aid'])) {
                $admins[$titanium_module_name][$num]['aid'] = $row['aid'];
                $admins[$titanium_module_name][$num]['email'] = $row['email'];
            }
            $num++;
        }
    }
    return $admins[$titanium_module_name];
}

/**
 * Loads all the nuke config options
 *
 * @author JeFFb68CAM
 *
 * @return array
 */
function load_nuke_titanium_config() 
{
    global $titanium_db, $cache, $debugger;
    // $nuke_titanium_config is only called once -> mainfile.php
    // mainfile.php is only loaded once. So static makes no sense
    // static $nuke_titanium_config;
    // if(isset($nuke_titanium_config) && is_array($nuke_titanium_config)) { return $nuke_titanium_config; }
    if ((($nuke_titanium_config = $cache->load('php_nuke_titanium_config', 'config')) === false) || empty($nuke_titanium_config)) {
        $nuke_titanium_config = $titanium_db->sql_ufetchrow('SELECT * FROM '._NUKE_CONFIG_TABLE, SQL_ASSOC);
        if (!$nuke_titanium_config) {
            if ($titanium_prefix != 'nuke') {
                $nuke_titanium_config = $titanium_db->sql_ufetchrow('SELECT * FROM '._NUKE_CONFIG_TABLE, SQL_ASSOC);
                if(is_array($nuke_titanium_config)) {
                    die('Please change your $titanium_prefix in config.php to \'nuke\'.  You might have to do the same for the $titanium_user_prefix');
                }
            }
        }
        $nuke_titanium_config = str_replace('\\"', '"', $nuke_titanium_config);
        $cache->save('php_nuke_titanium_config', 'config', $nuke_titanium_config);
        $titanium_db->sql_freeresult($nuke_titanium_config);
    }
    if(is_array($nuke_titanium_config)) {
        return $nuke_titanium_config;
    } else {
        $cache->delete('php_nuke_titanium_config', 'config');
        $debugger->handle_error('There is an error in your  nuke_config data', 'Error');
        return array();
    }
}

/**
 * Loads the phpbb board config
 *
 * @author JeFFb68CAM
 *
 * @return array
 */
function load_phpbb2_board_config() 
{
    global $titanium_db, $debugger, $currentlang, $cache;
    // load_phpbb2_board_config is only called once -> mainfile.php
    // mainfile.php is only loaded once. So static makes no sense
    //static $phpbb2_board_config;
    //if(isset($phpbb2_board_config) && is_array($phpbb2_board_config)) { return $phpbb2_board_config; }
    if ((($phpbb2_board_config = $cache->load('board_config', 'config')) === false) || empty($phpbb2_board_config)) {
        $phpbb2_board_config = array();

        $sql = "SELECT * FROM " . CONFIG_TABLE;
        if( !($result = $titanium_db->sql_query($sql, true)) ) {
            $debugger->handle_error("Could not query phpbb config information", 'Error');
        }
        while ( $row = $titanium_db->sql_fetchrow($result) ) {
            $phpbb2_board_config[$row['config_name']] = $row['config_value'];
        }
        $titanium_db->sql_freeresult($result);
        $cache->save('board_config', 'config', $phpbb2_board_config);
    }
    if(is_array($phpbb2_board_config)) {
        return $phpbb2_board_config;
    } else {
        $cache->delete('board_config', 'config');
        $debugger->handle_error('There is an error in your board_config data', 'Error');
        return array();
    }
}

/**
 * Loads the entire evo config
 *
 * @author JeFFb68CAM
 *
 * @return array
 */
function load_titanium_config() 
{
    global $titanium_db, $cache, $debugger;
    // load_titanium_config is only called once -> mainfile.php
    // mainfile.php is only loaded once. So static makes no sense
    //static $titanium_config;
    //if(isset($titanium_config) && is_array($titanium_config)) { return $titanium_config; }
    if ((($titanium_config = $cache->load('titanum_config', 'config')) === false) || empty($titanium_config)) {
        $titanium_config = array();
        $result = $titanium_db->sql_query('SELECT `evo_field`, `evo_value` FROM '._EVOCONFIG_TABLE.' WHERE `evo_field` != "cache_data"');
        while(list($evo_field, $evo_value) = $titanium_db->sql_fetchrow($result)) {
            if($evo_field != 'cache_data') {
                $titanium_config[$evo_field] = $evo_value;
            }
        }
        $sql = "SELECT `config_value` FROM " . _CNBYA_CONFIG_TABLE . " WHERE `config_name` = 'allowusertheme'";
        if( !($resultcnbya = $titanium_db->sql_query($sql))) {
            $debugger->handle_error("Could not query cnbya config information", 'Error');
        }
        $row = $titanium_db->sql_fetchrow($resultcnbya, SQL_NUM);
        $titanium_config['allowusertheme'] = $row['config_value'];
        $sql = 'SELECT `word`, `replacement` FROM `'.WORDS_TABLE.'`';
        if( !($resultwords = $titanium_db->sql_query($sql))) {
            $debugger->handle_error("Could not query bad words information", 'Error');
        }
        while(list($word, $replacement) = $titanium_db->sql_fetchrow($resultwords)) {
            $wordrow[$word] = $replacement;
        }
        $titanium_config['censor_words'] = $wordrow;

        $cache->save('titanium_config', 'config', $titanium_config);
        $titanium_db->sql_freeresult($result);
    }
    if(is_array($titanium_config)) {
        return $titanium_config;
    } else {
        $cache->delete('titanium_config', 'config');
        $debugger->handle_error('There is an error in your titanium_config data', 'Error');
        return array();
    }
}

// main_module function by Quake
function main_module_titanium() 
{
  global $titanium_db, $cache;
  static $main_module_titanium;
  if (isset($main_module_titanium)) { return $main_module_titanium; }
    if((($main_module_titanium = $cache->load('main_module', 'config')) === false) || empty($main_module_titanium)) {
        list($main_module_titanium) = $titanium_db->sql_ufetchrow('SELECT main_module FROM '._MAIN_TABLE, SQL_NUM);
      $cache->save('main_module', 'config', $main_module_titanium);
  }
  return $main_module_titanium;
}

// update_modules function by JeFFb68CAM
function update_modules() 
{
    // New function to add new modules and delete old ones
    global $titanium_db, $cache;
    static $updated;
    if(isset($updated)) { return $updated; }
    //Here we will pull all currently installed modules from the database
    $result = $titanium_db->sql_query("SELECT title FROM "._MODULES_TABLE, true);
    while(list($mtitle) = $titanium_db->sql_fetchrow($result, SQL_NUM)) {
        if(substr($mtitle,0,3) != '~l~') {
            $titanium_modules[] = $mtitle;
        }
    }
	
    $titanium_db->sql_freeresult($result);
    sort($titanium_modules);

    //Here we will get all current modules uploaded
    $handle=opendir(NUKE_MODULES_DIR);
    $modlist = array();
    while (false !== ($file = readdir($handle))) {
        if ( @is_dir(NUKE_MODULES_DIR . $file) && ($file != '.') && ($file != '..') ) {
            $modlist[] = $file;
        }
    }
    closedir($handle);
    sort($modlist);

    //Now we will run a check to make sure that all uploaded modules are installed
    for($i=0, $maxi=count($modlist);$i<$maxi;$i++) {
        $titanium_module = $modlist[$i];
        if (!in_array($titanium_module, $titanium_modules))
        {
            $titanium_db->sql_uquery("INSERT INTO `"._MODULES_TABLE."` (`mid`, 
			                                                 `title`, 
													  `custom_title`, 
													        `active`, 
															  `view`, 
															`inmenu`, 
															   `pos`, 
															`cat_id`, 
															`blocks`, 
															`admins`, 
															`groups`) VALUES (NULL, '$titanium_module', '".str_replace("_", " ", $titanium_module)."', 0, 0, 1, 0, 7, 1, '', '')");
        }
    }

    //Now we will run a check to make sure all installed modules still exist
    for($i=0, $maxi=count($titanium_modules);$i<$maxi;$i++){
        $titanium_module = $titanium_modules[$i];
        if (!in_array($titanium_module, $modlist))
        {
            $titanium_db->sql_uquery("DELETE FROM `"._MODULES_TABLE."` WHERE `title`= '$titanium_module'");
            $result = $titanium_db->sql_uquery("OPTIMIZE TABLE `"._MODULES_TABLE."`");
            $titanium_db->sql_freeresult($result);
            $cache->delete('active_modules');
        }
    }

    $titanium_db->sql_freeresult($result);
    return $updated = true;
}

function UpdateCookie() 
{
    global $titanium_db, $titanium_prefix, $userinfo, $cache, $cookie, $identify;

    $ip = $identify->get_ip();
    $uid = $userinfo['user_id'];
    $titanium_username = $userinfo['username'];
    $pass = $userinfo['user_password'];
    $blognum = $userinfo['storynum'];
    $umode = $userinfo['umode'];
    $uorder = $userinfo['uorder'];
    $thold = $userinfo['thold'];
    $noscore = $userinfo['noscore'];
    $ublockon = $userinfo['ublockon'];
    $theme = $userinfo['theme'];
    $commentmax = $userinfo['commentmax'];

    # added in 3.0.0
    $guest = ( $userinfo['username'] ) ? 0 : 1;
    # added in 3.0.0

    /*****[BEGIN]******************************************
    [ Base:    Caching System                     v3.0.0 ]
    ******************************************************/
    if(($ya_config = $cache->load('ya_config', 'config')) === false) 
    {
        /*****[END]********************************************
        [ Base:    Caching System                     v3.0.0 ]
        ******************************************************/
        $configresult = $titanium_db->sql_query("SELECT config_name, config_value FROM ".$titanium_prefix."_cnbya_config", true);
        while (list($config_name, $config_value) = $titanium_db->sql_fetchrow($configresult, SQL_NUM)) 
        {
            // if (!get_magic_quotes_gpc()) { $config_value = stripslashes($config_value); }
            $ya_config[$config_name] = $config_value;
        }
        $titanium_db->sql_freeresult($configresult);
        /*****[BEGIN]******************************************
        [ Base:    Caching System                     v3.0.0 ]
        ******************************************************/
        $cache->save('ya_config', 'config', $ya_config);
        /*****[END]********************************************
        [ Base:    Caching System                     v3.0.0 ]
        ******************************************************/
    }

    $result = $titanium_db->sql_query("SELECT time FROM ".$titanium_prefix."_session WHERE uname='$titanium_username'", true);
    $ctime = time();
    if (!empty($titanium_username)) {
        $uname = substr($titanium_username, 0,25);
        if ($row = $titanium_db->sql_fetchrow($result)) {
            $titanium_db->sql_query("UPDATE ".$titanium_prefix."_session SET uname='$titanium_username', time='$ctime', host_addr='$ip', guest='$guest' WHERE uname='$uname'");
        } else {
            $titanium_db->sql_query("INSERT INTO ".$titanium_prefix."_session (uname, time, starttime, host_addr, guest) VALUES ('$uname', '$ctime', '$ctime', '$ip', '$guest')");
        }
    }
    $titanium_db->sql_freeresult($result);

    $cookiedata = base64_encode("$uid:$titanium_username:$pass:$blognum:$umode:$uorder:$thold:$noscore:$ublockon:$theme:$commentmax");
    if ($ya_config['cookietimelife'] != '-') {
        if (trim($ya_config['cookiepath']) != '') {
            @setcookie('user',$cookiedata,time()+$ya_config['cookietimelife'],$ya_config['cookiepath']);
        } else {
            @setcookie('user',$cookiedata,time()+$ya_config['cookietimelife']);
        }
    } else {
        @setcookie('user',$cookiedata);
    };
}

// GetColorGroups function by JeFFb68CAM
// called by several files - so it makes sense to cache it (ReOrGaNiSaTiOn)
function GetColorGroups($in_admin = false) 
{
    global $titanium_db, $cache;
    static $ColorGroupsCache;

    if((($ColorGroupsCache = $cache->load('ColorGroups', 'config')) === false) || empty($ColorGroupsCache)) 
	{
        $ColorGroupsCache = '';
        $result = $titanium_db->sql_query("SELECT `group_id`, `group_name`, `group_color`, `group_weight` FROM `".AUC_TABLE."` WHERE `group_id`>'0' ORDER BY `group_weight` ASC");
        $back = ($in_admin) ? '&amp;menu=1' : '';
    
	    while (list($group_id, $group_name, $group_color, $group_weight) = $titanium_db->sql_fetchrow($result)) 
		{
            $ColorGroupsCache .= '&nbsp;[&nbsp;<strong><a href="'. append_titanium_sid('auc_listing.php?id='. $group_id.$back) .'"><span class="genmed" style="color:#'. $group_color .';">'. $group_name .'</span></a></strong>&nbsp;]&nbsp;';
        }
        $titanium_db->sql_freeresult($result);
        $cache->save('ColorGroups', 'config', $ColorGroupsCache);
    }
    return $ColorGroupsCache;
}

// avatar_resize function by JeFFb68CAM (based off phpBB mod)
// recoded & removed cache-function and added static variable (ReOrGaNiSaTiOn)
function avatar_resize($avatar_url) 
{
    global $phpbb2_board_config;
    static $loaded_avatars;
    if(!isset($loaded_avatars[$avatar_url])) {
        $loaded_avatars[$avatar_url] = array();
        list($avatar_width, $avatar_height) = @getimagesize($avatar_url);
        if ($avatar_width > $phpbb2_board_config['avatar_max_width'] && $avatar_height <= $phpbb2_board_config['avatar_max_height']) {
            $cons_width  = $phpbb2_board_config['avatar_max_width'];
            $cons_height = round((($phpbb2_board_config['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
        }
        elseif($avatar_width <= $phpbb2_board_config['avatar_max_width'] && $avatar_height > $phpbb2_board_config['avatar_max_height']) {
            $cons_width  = round((($phpbb2_board_config['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
            $cons_height = $phpbb2_board_config['avatar_max_height'];
        }
        elseif($avatar_width > $phpbb2_board_config['avatar_max_width'] && $avatar_height > $phpbb2_board_config['avatar_max_height']) {
            if($avatar_width >= $avatar_height) {
                $cons_width = $phpbb2_board_config['avatar_max_width'];
                $cons_height = round((($phpbb2_board_config['avatar_max_width'] * $avatar_height) / $avatar_width), 0);
            }
            elseif($avatar_width < $avatar_height) {
                $cons_width = round((($phpbb2_board_config['avatar_max_height'] * $avatar_width) / $avatar_height), 0);
                $cons_height = $phpbb2_board_config['avatar_max_height'];
            }
        }
        // $loaded_avatars[$avatar_url] = '<img src="' . $avatar_url . '" width="' . $cons_width . '" height="' . $cons_height . '" alt="" border="0" />';
        $loaded_avatars[$avatar_url] = $avatar_url;
    }
    return $loaded_avatars[$avatar_url];
}

// EvoCrypt function by JeFFb68CAM
function EvoCrypt($pass) 
{
    return md5(md5(md5(md5(md5($pass)))));
}

// http://www.php.net/array_combine
if (!function_exists('array_combine')) 
{
    function array_combine($keys, $values) {
        $result = array();
        if (is_array($keys) && is_array($values)) {
            while (list(, $key) = each($keys)) {
                if (list(, $value) = each($values)) {
                    $result[$key] = $value;
                } else {
                    break 1;
                }
            }
        }
        return $result;
    }
}

// http://www.php.net/file_get_contents
if(!function_exists('file_get_contents')) 
{
    function file_get_contents($filename, $use_include_path = 0) {
        $file = @fopen($filename, 'rb', $use_include_path);
        $data = '';
        if ($file) {
            while (!feof($file)) $data .= fread($file, 1024);
            @fclose($file);
        }
        return $data;
    }
}

// http://www.php.net/html_entity_decode
if(!function_exists('html_entity_decode')) 
{
    function html_entity_decode($given_html, $quote_style = ENT_QUOTES) {
        $trans_table = array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style));
        $trans_table['&#39;'] = "'";
        return (strtr($given_html, $trans_table));
    }
}

// EvoDate function by JeFFb68CAM (based off phpBB mod)
// Changed for internatinal users by ReOrGaNiSaTiOn
function EvoDate($format, $gmepoch, $tz)
{
/*****[BEGIN]******************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
    global $phpbb2_board_config, $titanium_lang, $userdata, $titanium_pc_dateTime, $userinfo;
	getusrinfo();
	static $translate;
	    if ( empty($translate) && $phpbb2_board_config['default_lang'] != 'english' )
    {
    		@include(NUKE_FORUMS_DIR.'language/lang_'.$titanium_lang.'/lang_time.php');
    		if (!(empty($titanium_langtime['datetime'])))
    		{
        	while ( list($match, $replace) = @each($titanium_langtime['datetime']) )
        	{
            $translate[$match] = $replace;
        	}
        }
    }
	if ( $userinfo['user_id'] != 1 )
	{
		switch ( $userinfo['user_time_mode'] )
		{
			case 1:
				$dst_sec = $userinfo['user_dst_time_lag'] * 60;
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
				break;
			case 2:
				$dst_sec = date('I', $gmepoch) * $userdata['user_dst_time_lag'] * 60;
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
				break;
			case 3:
				return ( !empty($translate) ) ? strtr(@date($format, $gmepoch), $translate) : @date($format, $gmepoch);
				break;
			case 4:
				if ( isset($titanium_pc_dateTime['pc_timezoneOffset']) )
				{
					$tzo_sec = $titanium_pc_dateTime['pc_timezoneOffset'];
				} else
				{
					$titanium_user_pc_timeOffsets = explode("/", $userinfo['user_pc_timeOffsets']);
					$tzo_sec = $titanium_user_pc_timeOffsets[0];
				}
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
				break;
			case 6:
				if ( isset($titanium_pc_dateTime['pc_timeOffset']) )
				{
					$tzo_sec = $titanium_pc_dateTime['pc_timeOffset'];
				} else
				{
					$titanium_user_pc_timeOffsets = explode("/", $userinfo['user_pc_timeOffsets']);
					$tzo_sec = $titanium_user_pc_timeOffsets[1];
				}
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
				break;
			default:
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
				break;
		}
	} else
	{
		switch ( $phpbb2_board_config['default_time_mode'] )
		{
			case 1:
				$dst_sec = $phpbb2_board_config['default_dst_time_lag'] * 60;
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
				break;
			case 2:
				$dst_sec = date('I', $gmepoch) * $phpbb2_board_config['default_dst_time_lag'] * 60;
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec), $translate) : @gmdate($format, $gmepoch + (3600 * $tz) + $dst_sec);
				break;
			case 3:
				return ( !empty($translate) ) ? strtr(@date($format, $gmepoch), $translate) : @date($format, $gmepoch);
				break;
			case 4:
				if ( isset($titanium_pc_dateTime['pc_timezoneOffset']) )
				{
					$tzo_sec = $titanium_pc_dateTime['pc_timezoneOffset'];
				} else
				{
					$tzo_sec = 0;
				}
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
				break;
			case 6:
				if ( isset($titanium_pc_dateTime['pc_timeOffset']) )
				{
					$tzo_sec = $titanium_pc_dateTime['pc_timeOffset'];
				} else
				{
					$tzo_sec = 0;
				}
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + $tzo_sec), $translate) : @gmdate($format, $gmepoch + $tzo_sec);
				break;
			default:
				return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
				break;
		}
	}
/*****[END]********************************************
 [ Mod:    Advanced Time Management            v2.2.0 ]
 ******************************************************/
}

// evo_timetohours function by ReOrGaNiSaTiOn
function evo_timetohours($time) {
    $change_time = intval($time);
    $changed_time = array();
    $seconds    = $changed_time['seconds']  = 0;
    $minutes    = $changed_time['minutes']  = 0;
    $hours      = $changed_time['hours']    = 0;
    $days       = $changed_time['days']     = 0;
    $months     = $changed_time['months']   = 0; // we calculate 30 days a month in average
    $years      = $changed_time['years']    = 0; // we calculate 365 days a year
    if ($change_time > 60) {
        switch(TRUE) {
            case ($change_time < 3600): // below 1 hour
                $minutes    = floor($change_time / 60);
                $seconds    = floor($change_time - ($minutes * 60));
                break;
            case ($change_time < 86400): // below 1 day
                $hours      = floor($change_time / 3600);
                $minutes    = floor(($change_time - ($hours * 3600))/60);
                $seconds    = floor($change_time - (($hours * 3600) + ($minutes * 60)));
                break;
            case ($change_time < 2592000): //below 1 month (30 days)
                $days       = floor($change_time / 86400);
                $hours      = floor(($change_time - ($days * 86400))/3600);
                $minutes    = floor(($change_time - (($days * 86400) + ($hours * 3600)))/60);
                $seconds    = floor($change_time - (($days * 86400) + ($hours * 3600) + ($minutes * 60)));
                break;
            case ($change_time < 31536000): // below 1 year (365 days)
                $total_phpbb2_days = floor($change_time / 86400);
                $months     = floor($total_phpbb2_days / 30);
                $hours      = floor(($change_time - ($total_phpbb2_days * 86400))/3600);
                $minutes    = floor(($change_time - (($total_phpbb2_days * 86400) + ($hours * 3600)))/60);
                $seconds    = floor($change_time - (($total_phpbb2_days * 86400) + ($hours * 3600) + ($minutes * 60)));
                $days       = floor(365 - ($months * 30)); //is not exact, but I know no better method
               break;
            case ($change_time >= 31536000): // more than 1 year
                $years      = floor($change_time / 31536000);
                $total_phpbb2_days = floor(($change_time - ($years * 31536000))/86400);
                $months     = floor($total_phpbb2_days / 30);
                $days       = floor($months * 30); //is not exact, but I know no better method
                $hours      = floor(($change_time - (($years * 31536000) + ($total_phpbb2_days * 86400)))/3600);
                $minutes    = floor(($change_time - (($years * 31536000) + ($total_phpbb2_days * 86400) + ($hours * 3600)))/60);
                $seconds    = floor($change_time - (($years * 31536000) + ($total_phpbb2_days * 86400) + ($hours * 3600) + ($minutes * 60)));
                break;
        }
        $changed_time['seconds']  = $seconds;
        $changed_time['minutes']  = $minutes;
        $changed_time['hours']    = $hours;
        $changed_time['days']     = $days;
        $changed_time['months']   = $months;
        $changed_time['years']    = $years;
        return $changed_time;
    } else {
        return $changed_time;
    }
}

function group_selectbox($fieldname, $current=0, $mvanon=false, $all=true) 
{
    static $groups;
    if (!isset($groups)):

        global $titanium_db, $titanium_prefix, $customlang;
        
        $result = $titanium_db->sql_query('SELECT `group_id`, `group_name` FROM `'.GROUPS_TABLE.'` WHERE `group_single_user` = 0', true);
        while (list($group_ID, $group_name) = $titanium_db->sql_fetchrow($result)):
            $forum_groups[($group_ID+3)] = $group_name;
        endwhile;

        $groups = array(
            $customlang['global']['groups_general'] => array(
                0 => $customlang['global']['all_visitors'], 
                1 => $customlang['global']['registered_users'], 
                2 => $customlang['global']['administrators'], 
                3 => $customlang['global']['guests_only']), 
            $customlang['global']['groups_forums'] => $forum_groups);
        // $tmpgroups = arra_merge($forum_groups);

    endif;  
    $tmpgroups = $groups;
    if (!$all) { unset($tmpgroups[0]); }
    if (!$mvanon) { unset($tmpgroups[3]); }
    return select_box($fieldname, $current, $tmpgroups);
}

// function select_box($name, $default, $options, $multiple=false, $conditions=array()) 
// {
//     $select = '<select class="set" name="'.$name.'" id="'.$name.'"'.(($multiple == true) ? ' multiple="multiple" size="5"' : '').'>';
//     foreach($options as $value => $title):
//         $select .= '<option value="'.$value.'"'.(($value == $default) ? ' selected="selected"':'').(($conditions['disabled'] == $title) ? ' disabled' : '').'>'.$title.'</option>'."\n";
//     endforeach;
//     return $select.'</select>';
//     // return var_dump($conditions['disabled']);
// }

function select_box_forum($name, $default, $options, $multiple=false, $conditions=array()) 
{
    $selectboxforum  = '<select name="'.$name.'" id="'.$name.'"'.(($multiple <> false) ? ' multiple="multiple" size="'.$multiple.'"' : '').'>';
    foreach($options as $key => $value):

            if (is_array($value))
                $selectboxforum .= '<optgroup label="'.$key.'">';

            if (!is_array($value))
                $selectboxforum .= '<option value="'.$key.'"'.(($key == $default) ? ' selected="selected"' : '').'>'.$value.'</option>';

            if (is_array($value)):
            
                foreach( $value as $key2 => $value2):
                    $selectboxforum .= '<option value="'.$key2.'"'.(($key2 == $default) ? ' selected="selected"' : '').'>'.$value2.'</option>';
                endforeach;
            
            endif;

            if (is_array($value))
                $selectbox .= '</optgroup>';

        // endif;

    endforeach;
    return $selectboxforum.'</select>'; # <pre>' . var_export($options, true) . '</pre>
}

function select_box($name, $default, $options, $multiple=false, $conditions=array()) 
{
    $selectbox  = '<select name="'.$name.'" id="'.$name.'"'.(($multiple <> false) ? ' multiple="multiple" size="'.$multiple.'"' : '').'>';
    foreach($options as $key => $value):

        // if (!is_array($value)):

            if (is_array($value))
                $selectbox .= '<optgroup label="'.$key.'">';

            if (!is_array($value))
                $selectbox .= '<option value="'.$key.'"'.(($key == $default) ? ' selected="selected"' : '').'>'.$value.'</option>';

            if (is_array($value)):
            
                foreach( $value as $key2 => $value2):
                    $selectbox .= '<option value="'.$key2.'"'.(($key2 == $default) ? ' selected="selected"' : '').'>'.$value2.'</option>';
                endforeach;
            
            endif;

            if (is_array($value))
                $selectbox .= '</optgroup>';

        // endif;

    endforeach;
    return $selectbox.'</select>'; # <pre>' . var_export($options, true) . '</pre>
}

function yesno_option($name, $value=0, $dropdown=false) 
{
    $value = ($value>0) ? 1 : 0;
    if($dropdown == false):
        $sel[$value] = ' checked="checked"';
        $return  = '<input type="radio" name="'.$name.'" id="'.$name.'_yes" value="1"'.$sel[1].' />&nbsp;<label for="'.$name.'_yes">'._YES.'</label>&nbsp;&nbsp;';
        $return .= '<input type="radio" name="'.$name.'" id="'.$name.'_no" value="0" '.$sel[0].' />&nbsp;<label for="'.$name.'_no">'._NO.'</label>';
    else:
        $sel[$value] = ' selected="selected"';
        $return  = '<select class="set" name="'.$name.'" id="'.$name.'">';
        $return .= '  <option value="1"'.$sel[1].'>'._YES.'</option>';
        $return .= '  <option value="0"'.$sel[0].'>'._NO.'</option>';
        $return .= '</select>';
    endif;
    return $return;
}

function select_option($name, $default, $options) 
{
    $select = '<select class="set" name="'.$name.'" id="'.$name.'">'."\n";
    foreach($options as $var):
        $select .= '<option'.(($var == $default)?' selected="selected"':'').'>'.$var.'</option>'."\n";
    endforeach;
    return $select.'</select>';
}

function confirm_msg($link, $msg) {
    $content = '
    <table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
        <tr>
            <th class="thHead" height="25" valign="middle"><span class="tableTitle">Confirm</span></th>
        </tr>
        <tr>
            <td class="row1" align="center"><form action="'.$link.'" method="post"><span class="gen">
                <br />'.$msg.'<br /><br /><input type="submit" name="confirm" value="'._YES.'" class="mainoption" />
                &nbsp;&nbsp;<input type="submit" name="cancel" value="'._NO.'" class="liteoption" /></span></form>
            </td>
        </tr>
    </table>
    <br clear="all" />';
    DisplayError($content);
}

// DisplayError function by Technocrat
function DisplayError($msg, $special=0) 
{
    if (defined('FORUM_ADMIN') || defined('IN_PHPBB2') && function_exists('message_die') && !$special) {
        message_die(GENERAL_ERROR, $msg);
    } else {
        include_once(NUKE_BASE_DIR.'header.php');
        if(defined('ADMIN_FILE') && is_admin() && !$special) {
            // GraphicAdmin();
        }
        OpenTable();
        echo '<div align="center">'.$msg.'</div>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
}

// ValidateURL function by Technocrat
function ValidateURL($url, $type, $where) 
{
    global $currentlang;

    if (file_exists(NUKE_BASE_DIR.'language/custom/lang-'.$currentlang.'.php')) {
        include_once(NUKE_BASE_DIR.'language/custom/lang-'.$currentlang.'.php');
    } else {
        include_once(NUKE_BASE_DIR.'language/custom/lang-english.php');
    }
    //if(substr($url, strlen($url)-1,1) == '/') {
     //   DisplayError(_URL_SLASH_ERR . $where);
    //}
    //if($type == 0) {
    //    if(!substr($url, 0,7) == 'http://') {
    //        DisplayError(_URL_HTTP_ERR . $where);
    //    }
    //} else if($type == 1) {
    //    if(substr($url, 0,7) == 'http://') {
    //        DisplayError(_URL_NHTTP_ERR . $where);
     //   }
    //}
    if(substr($url, strlen($url)-4,4) == '.php') {
        DisplayError(_URL_PHP_ERR . $where);
    }
    if(substr($url, strlen($url)-15,15) == NUKE_FORUMS_DIR) {
        DisplayError(_URL_MODULE_FORUM_ERR . $where);
    }
    return $url;
}

/*****[BEGIN]******************************************
[ Mod:    Advanced Security Code Control      v1.0.0 ]
******************************************************/
function security_code($gfxchk, $size='normal', $rescale='1', $force=0) 
{
    global $ThemeInfo;

	if ( get_evo_option('recap_site_key') && get_evo_option('recap_priv_key') ):
	    echo "<script src='https://www.google.com/recaptcha/api.js".(!empty(get_evo_option('recap_lang')) ? "?hl=".get_evo_option('recap_lang') : "")."' defer></script>";
	endif;

	if(intval($gfxchk) == 0):
        return '';
    endif;
	
	if (!$force):

        if (!in_array(get_evo_option('usegfxcheck'),$gfxchk)):
            return '';
        endif;

    endif;

    return '<div class="g-recaptcha" style="'.($rescale < "1" ? ' transform:scale('.$rescale.'); -webkit-transform:scale('.$rescale.'); transform-origin:0 0; -webkit-transform-origin:0 0;' : '').'" data-sitekey="'.get_evo_option('recap_site_key').'" data-theme="'.$ThemeInfo['recaptcha_skin'].'" data-size="'.$size.'"></div>'."\n";
}

function post_captcha($response) 
{ 
    $fields_string = '';
    $fields = array(
        'secret' => get_evo_option('recap_priv_key'),
        'response' => $response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}
	
	
function security_code_check($titanium_user_response, $gfxchk) 
{
    global $titanium_config;

    if ( !get_evo_option('recap_site_key') && !get_evo_option('recap_priv_key') ):
        return true;
    endif;

    if(intval($gfxchk) == 0):
        return '';
    endif;

    if ($gfxchk != 'force'):

        if (!in_array(get_evo_option('usegfxcheck'),$gfxchk)):
            return true;
        endif;

    endif;

    /**
     *  Call the function post_captcha
     *
     * @return array
     */ 
    $recappassfail = post_captcha($titanium_user_response);

    if (!$recappassfail['success']):

        /**
         *  If the reCaptcha is fails return (bool) false
         *
         * @return (bool)
         */        
        return false;

    else:

        /**
         *  If the reCaptcha is successfully completed return (bool) true
         *
         * @return (bool)
         */
		return true;

    endif;
}
/*****[END]********************************************
[ Mod:    Advanced Security Code Control      v1.0.0 ]
******************************************************/

/*****[BEGIN]******************************************
[ Mod:     Custom Text Area                   v1.0.0 ]
******************************************************/
// Make_TextArea function by Technocrat
function Make_TextArea($name, $text='', $post='', $width='100%', $height='300px', $smilies=true) 
{
    $c_wysiwyg = new Wysiwyg($post, $name, $width, $height, $text, $smilies);
    $c_wysiwyg->Show();
}

function Make_TextArea_Ret($name, $text='', $post='', $width='100%', $height='300px', $smilies=true) 
{
    $c_wysiwyg = new Wysiwyg($post, $name, $width, $height, $text, $smilies);
    return $c_wysiwyg->Ret();
}
/*****[END]********************************************
[ Mod:     Custom Text Area                   v1.0.0 ]
******************************************************/

/*****[BEGIN]******************************************
[ Mod:     User IP Lock                       v1.0.0 ]
******************************************************/
// user_ips function by Technocrat
function user_ips() 
{
    include_once(NUKE_BASE_DIR.'ips.php');
    global $titanium_users_ips;
    if(isset($titanium_users_ips)){
        if(is_array($titanium_users_ips)){
            for($i=0, $maxi=count($titanium_users_ips); $i < $maxi; $i += 2) {
                $i2 = $i + 1;
                $titanium_userips[strtolower($titanium_users_ips[$i])] = explode(',',$titanium_users_ips[$i2]);
            }
            return $titanium_userips;
        }
    }
    return null;
}

// compare_ips function by Technocrat
function compare_ips($titanium_username) 
{
	global $identify;
    $titanium_userips = user_ips();
    if(!is_array($titanium_userips)) {
        return true;
    }
    if(isset($titanium_userips[strtolower($titanium_username)])) {
        $ip_check = implode('|^',$titanium_userips[strtolower($titanium_username)]);
        if (!preg_match("/^".$ip_check."/",$identify->get_ip())) {
            return false;
        }
    }
    return true;
}
/*****[END]********************************************
[ Mod:     User IP Lock                       v1.0.0 ]
******************************************************/

function GetRank($titanium_user_id) 
{
    global $titanium_db, $titanium_prefix, $titanium_user_prefix;
    static $rankData = array();
    if(is_array($rankData[$titanium_user_id])) { return $rankData[$titanium_user_id]; }

    list($titanium_user_rank, $titanium_user_posts) = $titanium_db->sql_ufetchrow("SELECT user_rank, user_posts FROM " . $titanium_user_prefix . "_users WHERE user_id = '" . $titanium_user_id . "'", SQL_NUM);
    $ranks = $titanium_db->sql_ufetchrowset("SELECT * FROM " . $titanium_prefix . "_bbranks ORDER BY rank_special, rank_min", SQL_ASSOC);

    $rankData[$titanium_user_id] = array();
    for($i=0, $maxi=count($ranks);$i<$maxi;$i++) {
        if ($titanium_user_rank == $ranks[$i]['rank_id'] && $ranks[$i]['rank_special']) {
            echo $ranks[$i]['rank_title'];
            $rankData[$titanium_user_id]['image'] = ($ranks[$i]['rank_image']) ? '<img src="'.$ranks[$i]['rank_image'].'" alt="'.$ranks[$i]['rank_title'].'" title="'.$ranks[$i]['rank_title'].'" border="0" />' : '';
            $rankData[$titanium_user_id]['title'] = $ranks[$i]['rank_title'];
            $rankData[$titanium_user_id]['id'] = $ranks[$i]['rank_id'];
            return $rankData[$titanium_user_id];
        } elseif ($titanium_user_posts >= $ranks[$i]['rank_min'] && !$ranks[$i]['rank_special']) {
            $rankData[$titanium_user_id]['image'] = ($ranks[$i]['rank_image']) ? '<img src="'.$ranks[$i]['rank_image'].'" alt="'.$ranks[$i]['rank_title'].'" title="'.$ranks[$i]['rank_title'].'" border="0" />' : '';
            $rankData[$titanium_user_id]['title'] = $ranks[$i]['rank_title'];
            $rankData[$titanium_user_id]['id'] = $ranks[$i]['rank_id'];
            return $rankData[$titanium_user_id];
        }
    }
    return array();
}

// redirect function by Quake
function redirect_titanium($url, $refresh = 0) 
{
    global $titanium_db, $cache;
    if(is_object($cache)) $cache->resync();
    if(is_object($titanium_db)) $titanium_db->sql_close();
    $type = preg_match('/IIS|Microsoft|WebSTAR|Xitami/', $_SERVER['SERVER_SOFTWARE']) ? 'Refresh: '.$refresh.'; URL=' : 'Location: ';
	$url = str_replace('&amp;', "&", $url);
    header($type . $url);
    exit;
}

include_once(NUKE_INCLUDE_DIR.'functions_deprecated.php');

function evo_img_tag_to_resize($text) 
{
    global $img_resize;
    if(!$img_resize) return $text;
    if(empty($text)) return $text;
    if(preg_match('/<NO RESIZE>/',$text)) {
        $text = str_replace('<NO RESIZE>', '', $text);
        return $text;
    }
    // $text = preg_replace('/<\s*?img/',"<img resizemod=\"on\" ",$text);
    # <div class="reimg-loading"></div><img class="reimg" onload="reimg(this);" onerror="reimg(this);"
    $text = preg_replace('/<\s*?img/',"<div class=\"reimg-loading\"></div><img class=\"reimg\" onload=\"reimg(this);\" onerror=\"reimg(this);\" ",$text);
    return $text;
}

function referer() 
{
    global $titanium_db, $titanium_prefix,  $nukeurl, $httpref, $httprefmax, $_GETVAR;

    if ($httpref == 1 && isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) 
	{
        $referer = check_html($_SERVER['HTTP_REFERER'], 'nohtml');
        $referer = $_GETVAR->fixQuotes($referer);
        
		if(substr($_SERVER['HTTP_HOST'],0,4) == 'www.') 
		{
            $no_www = substr($_SERVER['HTTP_HOST'],5);
        } 
		else 
		{
            $no_www = $_SERVER['HTTP_HOST'];
        }
        
		$referer_request = '/'.$_SERVER['REQUEST_METHOD'].$_SERVER['REQUEST_URI'];
        if($referer_request == '/GET/') $referer_request = '/';
        $referer_request = $_GETVAR->fixQuotes($referer_request);
        
		
		if (stristr('$referer', '://') && !stristr('$referer', $nukeurl) && !stristr('$referer', '$no_www')) 
		{

            if (!$titanium_db->sql_query('UPDATE IGNORE '.$titanium_prefix."_referer SET lasttime=".time().", link='".$referer_request."' WHERE url='".$referer."'") || !$titanium_db->sql_affectedrows()) 
			{
                $titanium_db->sql_query('INSERT IGNORE INTO '.$titanium_prefix."_referer VALUES ('".$referer."', ".time().",'".$referer_request."')");
            }
            
			list($numrows) = $titanium_db->sql_ufetchrow('SELECT COUNT(*) FROM '.$titanium_prefix.'_referer');
            
			if ($numrows >= $httprefmax) 
			{
                $titanium_db->sql_query('DELETE FROM '.$titanium_prefix.'_referer ORDER BY lasttime LIMIT '.($numrows-($httprefmax/2)));
            }
        }
    }
}

function ord_crypt_decode($data) 
{
    $result = '';
    $data =  @pack("H" . strlen($data), $data);

    for($i=0; $i<strlen($data); $i++) {
        $char = substr($data, $i, 1);
        $keychar = substr(OrdKey, ($i % strlen(OrdKey))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
    }
    return $result;
}

function add_group_attributes($titanium_user_id, $group_id) 
{
    global $titanium_prefix, $titanium_db, $phpbb2_board_config, $cache;

    if ($titanium_user_id <= 2) return true;

    $sql_color = "SELECT `group_color` FROM `" . $titanium_prefix . "_bbgroups` WHERE `group_id` = '$group_id'";
    $result_color = $titanium_db->sql_query($sql_color);
    $row_color = $titanium_db->sql_fetchrow($result_color);
    $titanium_db->sql_freeresult($result_color);
    $phpbb2_color = $row_color['group_color'];
    if (!empty($phpbb2_color)) {
        $sql_color = "SELECT `group_color`, `group_id` FROM `" . $titanium_prefix . "_bbadvanced_username_color` WHERE `group_id` = '$phpbb2_color'";
        $result_color = $titanium_db->sql_query($sql_color);
        $row_color = $titanium_db->sql_fetchrow($result_color);
        $titanium_db->sql_freeresult($result_color);
    }
    $sql_rank = "SELECT `group_rank` FROM `" . $titanium_prefix . "_bbgroups` WHERE `group_id` = '$group_id'";
    $result_rank = $titanium_db->sql_query($sql_rank);
    $row_rank = $titanium_db->sql_fetchrow($result_rank);
    $titanium_db->sql_freeresult($result_rank);
    if(isset($row_rank['group_rank']) && !isset($row_color['group_color'])) {
        $sql = "`user_rank` = '".$row_rank['group_rank']."'";
    }elseif(isset($row_color['group_color']) && !isset($row_rank['group_rank'])) {
        $sql = "`user_color_gc` = '".$row_color['group_color']."',
              `user_color_gi`  = '--".$row_color['group_id']."--'";
    } elseif (isset($row_color['group_color']) && isset($row_rank['group_rank'])) {
        $sql = "`user_rank` = '".$row_rank['group_rank']."',
            `user_color_gc` = '".$row_color['group_color']."',
            `user_color_gi`  = '--".$row_color['group_id']."--'";
    } else {
        $sql = "";
    }

    if (!empty($sql)) {
        $sql = "UPDATE `" . $titanium_prefix . "_users`
            SET " . $sql . "
            WHERE user_id = " . $titanium_user_id;
        if ( !$titanium_db->sql_query($sql) )
        {
            return false;
        }
/*****[BEGIN]******************************************
[ Base:    Caching System                     v3.0.0 ]
******************************************************/
         $cache->delete('UserColors', 'config');
/*****[END]********************************************
[ Base:    Caching System                     v3.0.0 ]
******************************************************/
    }
    return true;
}

function remove_group_attributes($titanium_user_id, $group_id) 
{
    global $titanium_prefix, $titanium_db, $phpbb2_board_config, $cache;
    if (empty($titanium_user_id) && !empty($group_id) && $group_id != 0) {
        $sql = "SELECT `user_id` FROM `".$titanium_prefix."_bbuser_group` WHERE `group_id`=".$group_id;
        $result = $titanium_db->sql_query($sql);
        while ($row = $titanium_db->sql_fetchrow($result)) {
            remove_group_attributes($row['user_id'], '');
        }
        $cache->delete('UserColors', 'config');
    } else if (!empty($titanium_user_id) && $titanium_user_id >= 3) {
        $sql = "UPDATE `" . $titanium_prefix . "_users`
                SET `user_color_gc` = '',
                `user_color_gi`  = '',
                `user_rank` = 0
                WHERE `user_id` = ".$titanium_user_id;
        $titanium_db->sql_query($sql);
    }

}

function amp_replace($string) 
{
    $string = str_replace('&amp;', '&', $string);
    $string = str_replace('&', '&amp;', $string);
    return $string;
}

function titanium_site_up_evo($url) 
{
    //Set the address
    $address = parse_url($url);
    $host = $address['host'];
    if (!($ip = @gethostbyname($host))) return false;
    if (@fsockopen($host, 80, $errno, $errdesc, 10) === false) return false;
    return true;
}

function evo_mail($to, $subject, $content, $header='', $params='', $batch=false) 
{
    global $phpbb2_board_config, $nuke_titanium_config, $cache;
	
	// Include the swift class
    require_once(NUKE_INCLUDE_DIR.'mail/swift_required.php');

    if (empty($to)) return false;
	
	// Set the from email
	if (!isset($nuke_titanium_config['adminmail']) || empty($nuke_titanium_config['adminmail']) || $nuke_titanium_config['adminmail'] == 'webmaster@------.---'){
        if (!isset($phpbb2_board_config['board_email']) || empty($phpbb2_board_config['board_email']) || $phpbb2_board_config['board_email'] == 'Webmaster@MySite.com'){
            $from = '';
        } else {
            $from = $phpbb2_board_config['board_email'];
        }
    } else {
        $from = $nuke_titanium_config['adminmail'];
    }
	
	// Parse the message before sending
    $content = str_replace("\r\n", "<br />", $content);
    $content = str_replace("\n", "<br />", $content);
	
	// Set the message vars
	$message = Swift_Message::newInstance()
		->setSubject($subject)
		->setFrom($from)
		->setTo($to)
		->setBody($content, 'text/html');
	
	// SMTP mail
	if (isset($phpbb2_board_config['smtp_delivery']) && $phpbb2_board_config['smtp_delivery'] == '1'){
		if (!empty($phpbb2_board_config['smtp_username']) && !empty($phpbb2_board_config['smtp_password'])){
			// Try to explode the string and see if a port is attached
			$settings = explode(':', $phpbb2_board_config['smtp_host']);
			
			if (is_array($settings) && strlen($settings[1]) > 0){
				$smtp['host'] = $settings[0];
				$smtp['port'] = $settings[1];
			} else {
				$smtp['host'] = $settings[0];
				$smtp['port'] = 25;
			}
			
			$smtp = Swift_SmtpTransport::newInstance($smtp['host'], $smtp['port']);
			
			// Set the username and password
			$smtp->setUsername($phpbb2_board_config['smtp_username']);
            $smtp->setpassword($phpbb2_board_config['smtp_password']);
			
			// Set a new mailer class to send the message
			$mailer = Swift_Mailer::newInstance($smtp);
			
			// Now send the message
			$sent = $mailer->send($message);
		}
	} else { 
		// Create a new mail transport
		$transport = Swift_MailTransport::newInstance();
		
		// Create the mailer gateway
		$mailer = Swift_Mailer::newInstance($transport);
		
		// Standard method for sending mail
		if ($batch && is_object($to)){
			$sent = $mailer->batchSend($message);
		} else {
			$sent = $mailer->send($message);
		}
	}

    return $sent;
}

function evo_mail_batch($array_recipients)
{
	// Include the swift class
    require_once(NUKE_INCLUDE_DIR.'mail/swift_required.php');

    if (!is_array($array_recipients)) return '';

    $recipients = Swift_Message::newInstance();
    foreach ($array_recipients as $titanium_username => $email){
        $recipients->addTo($email, $titanium_username);
    }
    return $recipients;
}

// evo_image function by ReOrGaNiSaTiOn
function evo_image($imgfile='', $mymodule='') 
{
    global $currentlang, $ThemeSel, $Default_Theme, $cache;
    $tmp_imgfile = explode('.', $imgfile);
    $cache_imgfile = $tmp_imgfile[0];
    $evoimage = $cache->load($mymodule, 'EvoImage');
    if(!empty($evoimage[$ThemeSel][$currentlang][$cache_imgfile])) {
        return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);
    }

    if (@file_exists('themes/'. $ThemeSel . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$ThemeSel."/images/$mymodule/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists('themes/'. $ThemeSel . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$ThemeSel."/images/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists('themes/'. $ThemeSel . '/images/' . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$ThemeSel."/images/$mymodule/$imgfile";
    } elseif (@file_exists('themes/'. $ThemeSel . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$ThemeSel."/images/$imgfile";
    } elseif (@file_exists('themes/'. $Default_Theme . '/images/' . $mymodule . '/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$Default_Theme."/images/$mymodule/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists('themes/'. $Default_Theme . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$Default_Theme."/images/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists('themes/'. $Default_Theme . '/images/' . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$Default_Theme."/images/$mymodule/$imgfile";
    } elseif (@file_exists('themes/'. $Default_Theme . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'themes/'.$Default_Theme."/images/$imgfile";
    } elseif (@file_exists('modules/'.  $mymodule . '/images/lang_' . $currentlang . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = 'modules/'.  $mymodule ."/images/lang_".$currentlang."/$imgfile";
    } elseif (@file_exists('modules/'.  $mymodule . '/images/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] =  'modules/'. $mymodule ."/images/$imgfile";
    } elseif (@file_exists(NUKE_IMAGES_DIR . $mymodule . '/' . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_IMAGES_BASE_DIR . $mymodule ."/$imgfile";
    } elseif (@file_exists(NUKE_IMAGES_DIR . $imgfile)) {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = NUKE_IMAGES_BASE_DIR . $imgfile;
    } else {
        $evoimage[$ThemeSel][$currentlang][$cache_imgfile] = '';
    }
    $cache->save($mymodule, 'EvoImage', $evoimage);
    return($evoimage[$ThemeSel][$currentlang][$cache_imgfile]);

}

// evo_image_make_tag function by ReOrGaNiSaTiOn
function evo_image_make_tag($imgname, $mymodule_name, $mytitle='', $myborder=0, $myname='', $resize=FALSE , $mywidth='100%', $myheight='100%') 
{
    $temp_alttext = explode('.', $imgname);
    $temp_image = evo_image($imgname, $mymodule_name);
    if (!empty($temp_image)) {
        $imgfile = '<img src="'.$temp_image.'" width="'.$mywidth.'" height="'.$myheight.'" border="'.$myborder.'" title="'.$mytitle.'" name="'.$myname.'" alt="" />';
        if ( $resize ) 
		{
            $imgfile = evo_img_tag_to_resize($imgfile);
        }
        return $imgfile;
    }
    return '';
}

// evo_help_img function by ReOrGaNiSaTiOn
// based on various codefragments from Internet
function evo_help_img($helptext) 
{
    global $bgcolor1, $bgcolor2, $textcolor1, $textcolor2;
    return "<a href=\"javascript:void(0);\" onclick=\"return overlib('".addslashes($helptext)."', STICKY, CAPTION, 'Help System', STATUS, 'Help System', WIDTH, 400, FGCOLOR, '".$bgcolor1."', BGCOLOR, '".$bgcolor2."', TEXTCOLOR, '".$textcolor1."', CAPCOLOR, '".$textcolor2."', CLOSECOLOR, '".$textcolor2."', CAPICON, 'images/evo/helpicon.png', BORDER, '2');\"><img src='images/evo/helpicon.png' border='0' height='12' width='12' alt='' title='' /></a>";
}

// select_gallery function by ReOrGaNiSaTiOn
function select_gallery($name='default', $gallery='', $img_show = FALSE, $selected='') 
{
    if (empty($gallery)) {
        $select = '<select class="set" name="'.$name.'" id="'.$name."\">\n";
        $select .= "<option value=\"".FALSE."\" >"._NONE."</option>\n";
        return $select.'</select>';
    }
    if ( substr($gallery, 0, 1) == '/' ) {
        $gallery = substr($gallery, 1);
    }
    if ( substr($gallery, -1) == '/' ) {
        $gallery = substr($gallery, 0, strlen($gallery) -1);
    }
    $dir = NUKE_BASE_DIR . $gallery;
    $href_dir = NUKE_HREF_BASE_DIR . $gallery;
    if (is_dir($dir)) {
        if (!defined('GALLERY_JAVASCRIPT') && ($img_show == TRUE)) {
            $select = '<script language="javascript" type="text/javascript">
                        <!--
                        function update_gallery(newimage)
                        {
                            document.gallery_image.src = newimage;
                        }
                        //-->
                        </script>';
            define('GALLERY_JAVASCRIPT', TRUE);
        }
        $opendir = @opendir($gallery);
        if ( $img_show == TRUE ) {
            $select .= '<select class="set" name="'.$name.'" id="'.$name."\" onchange=\"update_gallery(this.options[selectedIndex].value);\">\n";
        } else {
            $select .= '<select class="set" name="'.$name.'" id="'.$name."\">\n";
        }
        if ( empty($selected)) {
            $select .= "<option value=\"". NUKE_IMAGES_BASE_DIR . "evo/spacer.gif\" selected=\"selected\">"._NONE."</option>\n";
        } else {
            $select .= "<option value=\"". NUKE_IMAGES_BASE_DIR . "evo/spacer.gif\" >"._NONE."</option>\n";
        }
        while (false !== ($entry = @readdir($opendir))) {
            if( preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $entry)) {
                if( $entry != '.' && $entry != '..' && is_file($dir . '/' . $entry) && !is_link($dir . '/' . $entry) ) {
                    $extension = substr($entry, strrpos($entry, '.'));
                    if ($selected == "$href_dir/$entry") {
                        $select .= "<option value=\"" . $href_dir . "/" .$entry."\" selected=\"selected\">".str_replace($extension, '', $entry)."</option>\n";
                    } else {
                        $select .= "<option value=\"" . $href_dir . "/" .$entry."\" >".str_replace($extension, '', $entry)."</option>\n";
                    }
                }
            }
        }
        @closedir($dir);
    } else {
        $select = '<select class="set" name="'.$name.'" id="'.$name."\">\n";
        $select .= "<option value=\"".FALSE."\" >"._NONE."</option>\n";
    }
    if ( $img_show == TRUE ) {
        return $select.'</select>&nbsp;<img name="gallery_image" src="'.NUKE_IMAGES_BASE_DIR . 'evo/spacer.gif" border="0" alt="" />';
    } else {
        return $select.'</select>';
    }
}
?>
