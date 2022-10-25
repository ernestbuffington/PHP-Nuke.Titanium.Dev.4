<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Theme Management
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : themes.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 11.27.2005 (mm.dd.yyyy)

   Notes         : Allows admin to easily manage themes.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function theme_exists($theme_name) {
    if (is_file(NUKE_THEMES_DIR . $theme_name . '/theme.php')) {
        return true;
    }
    return false;
}

function ThemeAllowed($theme) {
    global $Default_Theme;
    static $themesA;
    if (isset($themesA[$theme])) {
        return $themesA[$theme];
    }
    if(!$theme || !theme_exists($theme)) {
        $themesA[$theme] = 0;
        return false;
    }
    if((is_admin() && theme_exists($theme)) || ($theme == $Default_Theme)) {
        $themesA[$theme] = 1;
        return true;
    }
    $themes = get_themes();
    foreach($themes as $allowed_themes) {
        $allowed[] = $allowed_themes['theme_name'];
    }
    if(@in_array($theme, $allowed) && AllowThemeChange()) {
        $themesA[$theme] = 1;
        return true;
    }
    $themesA[$theme] = 0;
    return false;
}

function theme_installed($theme_name) {
    global $db, $prefix;
    $sql = "SELECT theme_name FROM " . $prefix . "_themes WHERE theme_name = '$theme_name'";
    $theme_installed = $db->sql_numrows($db->sql_query($sql));
    if ($theme_installed > 0) {
        return true;
    }
    return false;
}

function ThemeSort()
{
   //www.php.net
   $arguments = func_get_args();
   $arrays    = $arguments[0];
   for ($c = (count($arguments)-1); $c > 0; $c--)
   {
       if (in_array($arguments[$c], array(SORT_ASC , SORT_DESC)))
       {
           continue;
       }
       $compare = create_function('$a,$b','return strcasecmp($a["'.$arguments[$c].'"], $b["'.$arguments[$c].'"]);');
       usort($arrays, $compare);
       if ($arguments[$c+1] == SORT_DESC)
       {
           $arrays = array_reverse($arrays);
       }
   }
   return $arrays ;
}

function ThemeGetStatus($theme_name, $active=0) {
    global $prefix, $db;
    if (is_default($theme_name)) {
        return "<strong>"._THEMES_DEFAULT."</strong>";
    }
    if(!theme_installed($theme_name)) {
        return _THEMES_QUNINSTALLED;
    }
    if(!theme_exists($theme_name)) {
        return "<font color='red'><strong>"._THEMES_THEME_MISSING."</strong></font>";
    }
    return (($active==1) ? "<i>"._THEMES_ACTIVE."</i>" : "<i>"._THEMES_INACTIVE."</i>");
}

function ThemeNumUsers($theme_name) {
    global $db, $user_prefix;
    $where = (is_default($theme_name)) ? "theme = '' OR theme = '" . $theme_name . "'" : "theme = '$theme_name'";
    $sql = "SELECT COUNT(*) AS count FROM " . $user_prefix . "_users WHERE user_id != '1' AND $where";
    $num = $db->sql_fetchrow($db->sql_query($sql));
    return $num['count'];
}

function ThemeIsActive($theme, $admin_file=false) {
    global $db, $prefix;
    static $activeT;
    if(isset($activeT[$theme])) { return $activeT[$theme]; }
    $sql = "SELECT active FROM " . $prefix . "_themes WHERE theme_name = '$theme'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    // return $activeT[$theme] = ((is_admin() && !$admin_file) ? 1 : $row['active']);
    return $row['active'];
}

function ThemeGetGroups($groups) {
    global $prefix, $db;
    $return_groups = "";
    if(!is_array($groups)) { $groups = explode("-",$groups); }
    for($i=0, $maxi=count($groups); $i<$maxi; $i++) {
        $comma = (empty($groups[$i+1])) ? "" : ", ";
        $sql = "SELECT group_name FROM " . $prefix . "_bbgroups WHERE group_id = '" . $groups[$i] . "'";
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $return_groups .= $row['group_name'] . $comma;
    }
    if (empty($return_groups)) { $return_groups = _THEMES_NONE; }
    return $return_groups;
}

function is_default($theme_name) {
    return (get_default() == $theme_name);
}

function get_default() {
    global $db, $prefix;
    static $default;
    if(isset($default)) return $default;
    $result = $db->sql_query("SELECT default_Theme FROM " . $prefix . "_config");
    $default = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    return $default = $default[0];
}

function add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active) {
    $themes[$theme_name] = array();
    $themes[$theme_name]['theme_name'] = $theme_name;
    $themes[$theme_name]['custom_name'] = $custom_name;
    $themes[$theme_name]['groups'] = $groups;
    $themes[$theme_name]['permissions'] = $perms;
    $themes[$theme_name]['active'] = $active;
    return $themes;
}

function ThemeMostPopular() {
    global $db, $user_prefix;
    static $theme;
    if(isset($theme)) return $theme;
    $sql = "SELECT COUNT(*) AS theme_count, theme FROM " . $user_prefix . "_users WHERE user_id > 1 GROUP BY theme ORDER BY theme_count DESC";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $theme = ($row['theme'] && theme_exists($row['theme']) ) ? $row['theme'] : get_default();
    return $theme;
}

function get_themes($mode='user_themes') 
{
    //Returns all themes the user is allowed to use
    global $db, $prefix, $debugger;

    switch($mode) 
    {
        case 'user_themes':
            $sql = "SELECT * FROM " . $prefix . "_themes WHERE active='1' ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) 
            {
                $active = $row['active'];
                $theme_name = $row['theme_name'];
                $groups = $row['groups'];
                $perms = $row['permissions'];
                $custom_name = $row['custom_name'];
                if ($perms == 1) {
                    if (theme_exists($theme_name) && ThemeIsActive($theme_name)) {
                            $themes = add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active);
                    }
                }elseif ($perms == 2) {
                    if (ThemeGetGroups($groups) && theme_exists($theme_name) && ThemeIsActive($theme_name)) {
                            $themes = add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active);
                    }
                }elseif ($perms == 3) {
                    if (is_admin() && theme_exists($theme_name) && ThemeIsActive($theme_name)) {
                            $themes = add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active);
                    }
                }
            }
            $db->sql_freeresult($result);
        break;

        case 'all':
            $sql = "SELECT * FROM " . $prefix . "_themes ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $active = $row['active'];
                $theme_name = $row['theme_name'];
                $groups = $row['groups'];
                $perms = $row['permissions'];
                $custom_name = $row['custom_name'];
                $themes = add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active);
            }
            $db->sql_freeresult($result);
        break;

        case 'active':
            $sql = "SELECT * FROM " . $prefix . "_themes WHERE active='1' ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $active = $row['active'];
                $theme_name = $row['theme_name'];
                $groups = $row['groups'];
                $perms = $row['permissions'];
                $custom_name = $row['custom_name'];
                if(theme_exists($theme_name)) {
                    $themes = add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active);
                }
            }
            $db->sql_freeresult($result);
        break;

        case 'uninstalled':
            $uninstalled_themes = array();
            $themes = opendir(NUKE_THEMES_DIR);
            while(false !== ($theme_name = readdir($themes))) {
                if(is_dir(NUKE_THEMES_DIR . $theme_name) && $theme_name != "." && $theme_name != ".." && $theme_name != ".svn") {
                    $sql = "SELECT theme_name FROM " . $prefix . "_themes WHERE theme_name = '$theme_name'";
                    $theme_installed = $db->sql_numrows($db->sql_query($sql));
                    
					
					
					if ($theme_installed == 0) {
                        $uninstalled_themes[] = $theme_name;
                    }
                }
            }
			
			# Someone did not think this through
			# So I sorted the array before the return
			#                                                 Ernest Allen Buffington 10/24/2022 7:16 pm    
			# asort() - Maintains key association: yes.
            # sort() - Maintains key association: no.
			sort($uninstalled_themes);
			
            return $uninstalled_themes;
        break;

        case 'dir':
          $sql = "SELECT * FROM " . $prefix . "_themes ORDER BY theme_name ASC";
            if (!$result = $db->sql_query($sql)) {
                $debugger->handle_error(_THEMES_ERROR_MESSAGE, _THEMES_ERROR);
            }
            $themes = array();
            while ($row=$db->sql_fetchrow($result)) {
                $active = $row['active'];
                $theme_name = $row['theme_name'];
                $groups = $row['groups'];
                $perms = $row['permissions'];
                $custom_name = $row['custom_name'];
                $themes = add_theme($themes, $theme_name, $custom_name, $groups, $perms, $active);
            }
            $db->sql_freeresult($result);
            $dir = opendir(NUKE_THEMES_DIR);
            while(false !== ($theme_name = readdir($dir))) {
                if(is_dir(NUKE_THEMES_DIR . $theme_name) && $theme_name != "." && $theme_name != ".." && $theme_name != ".svn") {
                    $sql = "SELECT * FROM " . $prefix . "_themes WHERE theme_name = '$theme_name'";
                    $theme_installed = $db->sql_numrows($db->sql_query($sql));
                    if ($theme_installed == 0) {
                        $themes = add_theme($themes, $theme_name, '', '', '', '');
                    }
                }
            }
        break;
    }
    return $themes;
}

function GetThemeSelect($name, $mode='user_themes', $other_user=false, $extra='', $current='', $show_default=1) {
    global $userinfo;
    if($other_user) $userinfo = $other_user;

    $themes = get_themes($mode);
    $select = "<select name=\"" . $name . "\" $extra>";
    if($show_default) {
        $dSelect = (is_default($userinfo['theme'])) ? "selected" : "";
        $select .= "<option value=\"\" $dSelect>"._THEMES_DEFAULT."</option>";
    }
    foreach($themes as $theme) {
        $name = (!empty($theme['custom_name'])) ? $theme['custom_name'] : $theme['theme_name'];
        $selected = (($userinfo['theme'] == $theme['theme_name']) || ($current == $theme['theme_name'])) ? "selected" : "";
        $select .= "<option value=\"" . $theme['theme_name'] . "\" $selected>" . $name . "</option>";
    }
    $select .= "</select>";

    return $select;
}

function ThemeBackup($theme) {
    global $db, $prefix, $Default_Theme, $cache;
        if(!is_default($theme) && theme_exists($Default_Theme)) { return $Default_Theme; }
        $cache->delete('nukeconfig', 'config');
        log_write('error', 'Your default theme is missing! ' . $Default_Theme . ' was NOT found!', 'Criticial Error');
        $themes = opendir(NUKE_THEMES_DIR);
        while(false !== ($theme_name = readdir($themes))) {
            if(is_dir(NUKE_THEMES_DIR . $theme_name) && $theme_name != "." && $theme_name != "..") {
                return $theme_name;
            }
        }
    die(_THEMES_PROBLEM);
}

function ThemeCount($theme) {
    global $db, $prefix, $user_prefix;
    list($count) = $db->sql_ufetchrow("SELECT COUNT(*) AS count FROM " . $user_prefix . "_users WHERE theme='" . $theme . "' AND user_id <> '1'");
    return $count;
}

function ChangeTheme($theme, $who) {
    global $db, $user_prefix, $userinfo;
	if(!$who) { $who = $userinfo['user_id']; }
    $db->sql_query('UPDATE ' . $user_prefix . '_users SET theme="' . $theme . '" WHERE user_id = "' . $who . '"');
	$userinfo['theme'] = $theme;
    UpdateCookie();
    redirect($_SERVER['REQUEST_URI']);
    return true;
}

function AllowThemeChange() {
    global $db, $prefix;
    static $usrthemeselect;
    list($usrthemeselect) = $db->sql_ufetchrow("SELECT config_value FROM " . $prefix . "_cnbya_config WHERE config_name = 'allowusertheme'");
    return(($usrthemeselect == 0) ? 1 : 0);
}

function LoadThemeInfo($theme) 
{
    global $db, $prefix, $params, $default, $cache;
    static $theme_info;
    if(isset($theme_info)) 
        return $theme_info; 

    if(!$theme_info = $cache->load($theme, 'themes')) 
    {
        $result = $db->sql_query("SELECT theme_info FROM " . $prefix . "_themes WHERE theme_name = '" . $theme . "'");
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $loaded_info = (!empty($row['theme_info'])) ? explode(':::', $row['theme_info']) : $default;
        $theme_info = array_combine($params, $loaded_info);
        $cache->save($theme, 'themes', $theme_info);
    }
    return $theme_info;
}
?>
