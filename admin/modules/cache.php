<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Cache Admin Panel
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : cache.php
   Author        : JeFFb68CAM (www.Evo-Mods.com)
   Version       : 1.0.2
   Date          : 11/11/2005 (mm-dd-yyyy)

   Notes         : Allows admin to easily manage the built-in cache.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/
if (!defined('ADMIN_FILE')) 
die ("Illegal File Access");

define('CACHE_ADMIN', true);
global $prefix, $db, $evoconfig;

function cache_header() 
{
    global $admin_file, $evoconfig, $usrclearcache, $cache;

    $enabled = ($cache->valid) ? "<font color=\"green\">" . _CACHE_ENABLED . "</font>" : "<font color=\"red\">" . _CACHE_DISABLED . "</font> (<a href=\"$admin_file.php?op=howto_enable_cache\">" . _CACHE_HOWTOENABLE . "</a>)";
    $enabled_img = ($cache->valid) ? get_evo_icon('evo-sprite good') : get_evo_icon('evo-sprite bad');
    $cache_num_files = $cache->count_rows();

	if(isset($evoconfig['cache_last_cleared'])):
    $last_cleared_img = ((time() - $evoconfig['cache_last_cleared']) >= 604800) ? get_evo_icon('evo-sprite bad') : get_evo_icon('evo-sprite good');
	$clear_needed = ((time() - $evoconfig['cache_last_cleared']) >= 604800) ? "(<a href=\"$admin_file.php?op=cache_clear\"><font color=\"red\">" . _CACHE_CLEARNOW . "</font></a>)" : "";
	$last_cleared = date('F j, Y, g:i a', $evoconfig['cache_last_cleared']);
    endif;
	
	$user_can_clear = ($usrclearcache) ? "[ <strong>" . _CACHE_YES . "</strong> | <a href=\"$admin_file.php?op=usrclearcache&amp;opt=0\">" . _CACHE_NO . "</a> ]" : "[ <a href=\"$admin_file.php?op=usrclearcache&amp;opt=1\">" . _CACHE_YES . "</a> | <strong>" . _CACHE_NO . "</strong> ]";
    $cache_good = (is_writable(NUKE_CACHE_DIR) && !ini_get('safe_mode')) ? "<font color=\"green\">" . _CACHE_GOOD . "</font>" : "<font color=\"red\">" . _CACHE_BAD . "</font>";
    $cache_good_img = (is_writable(NUKE_CACHE_DIR) && !ini_get('safe_mode')) ? get_evo_icon('evo-sprite good') : get_evo_icon('evo-sprite bad');
    $cache_good = (ini_get('safe_mode')) ? "<font color=red>" . _CACHESAFEMODE . "</font>" : $cache_good;
    switch ($cache->type) {
        case FILE_CACHE:
            $cache_type = _CACHE_FILEMODE;
        break;
        case SQL_CACHE:
            $cache_type = _CACHE_SQLMODE;
        break;
        case XCACHE:
            $cache_type = 'XCache';
        break;
        case APC_CACHE:
            $cache_type = 'APC';
        break;
        case MEMCACHED:
            $cache_type = 'Memcached';
        break;
        default:
            $cache_type =  _CACHE_DISABLED;
        break;
    }
    OpenTable();
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php?op=cache\">" . _CACHE_HEADER . "</a> ]</div>\n";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _CACHE_RETURN . "</a> ]</div>\n";
    CloseTable();

    OpenTable();
	    
		if(!isset($last_cleared_img))
	    $last_cleared_img = get_evo_icon('evo-sprite bad');
	    if(!isset($last_cleared))
	    $last_cleared = '';
	    if(!isset($clear_needed))
		$clear_needed = '';
		
        echo "<div align=\"center\">\n"
        ."<table border='0' width='70%'><tr><td>"
        ."$enabled_img</td><td>"
        ."<i>" . _CACHE_STATUS . "</i></td><td>" . $enabled . "</td>"
        ."</tr><tr><td>"
        ."$enabled_img</td><td>"
        ."<i>" . _CACHE_MODE . "</i></td><td>" . $cache_type . "</td>"
        ."</tr><tr><td>"
        ."$cache_good_img</td><td>"
        ."<i>" . _CACHE_DIR_STATUS . "</i></td><td>" . $cache_good . "</td>"
        ."</tr>"
        // ."<tr><td>"
        // ."<img src='images/thumb_up.png' alt='' width='10' height='10' /></td><td>"
        // ."<i>" . _CACHE_NUM_FILES . "</i></td><td>" . $cache_num_files . "</td>"
        // ."</tr>"
        ."<tr><td>"
        ."".$last_cleared_img."</td><td>"
        ."<i>" . _CACHE_LAST_CLEARED . "</i></td><td>" . $last_cleared . "  ".$clear_needed."</td>"
        ."</tr>"
        ."<tr><td>"
        .(($usrclearcache == 1) ? get_evo_icon('evo-sprite good') : get_evo_icon('evo-sprite bad'))."</td><td>"
        ."<i>" . _CACHE_USER_CAN_CLEAR . "</i></td><td>" . $user_can_clear . "</td>"
        ."</tr>"
        ."<tr><td>"
        .get_evo_icon('evo-sprite good')."</td><td>"
        ."<i>" . _CACHE_TYPES . "</i></td><td>" . get_cache_types() . "</td>"
        ."</tr>"
        ."</table>"
        .'<br />'
        ."[ <a href=\"$admin_file.php?op=cache_clear\">" . _CACHE_CLEAR . "</a> ]"
        ."</div>";
    CloseTable();
}

function get_cache_types() {
    $out = '';

    if (is_writable(NUKE_CACHE_DIR)) {
        $out .= 'File <br />';
    }
    if (extension_loaded('apc')) {
        $out .= 'APC <br />';
    }
    if (extension_loaded('memcache')) {
        $out .= 'Memcached <br />';
    }
    if (extension_loaded('XCache')) {
        $out .= 'XCache <br />';
    }

    return $out;
}

function display_main() {
   
   global $admin_file, $cache;

   $open = get_evo_icon('evo-sprite folder-live');
   //$closed = get_evo_icon('evo-sprite folder');

    OpenTable();
    echo '<div align="center">Compare Cache Dates With Current Time When You Refresh</div>';
	$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(NUKE_CACHE_DELETE_DIR));

    $file_htaccess = (NUKE_CACHE_DELETE_DIR.'/.htaccess');
	$file_infotxt = (NUKE_CACHE_DELETE_DIR.'/info.txt');
	$file_index = (NUKE_CACHE_DELETE_DIR.'/index.html');
	$i = 0;
	$files = array(); 

    foreach ($rii as $file) 
	{
      if ($file->isDir())
	  { 
        continue;
      }
      
	  $files[] = $file->getPathname(); 
	  if($file == $file_index)
	  continue;
	  if($file == $file_htaccess)
	  continue;
	  if($file == $file_infotxt)
	  continue;
      
	  $z= $i++;
      $filedate = formatTimestamp(filemtime($file));
	  
	  echo $open.' <span style="color: red;">'.$filedate.'</span>&nbsp;&nbsp;'.$file.'</br>';
    }
	
	echo $z.' Cache Files';
	
    CloseTable();
}

function delete_cache($file, $name) {
    global $admin_file, $cache;
    OpenTable();
    if (!empty($file) && !empty($name)) {
            if ($cache->delete($file, $name)) {
                echo "<div align=\"center\">\n";
                echo "<strong>" . _CACHE_FILE_DELETE_SUCC . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</div>\n";
            } else {
                echo "<div align=\"center\">\n";
                echo "<strong>" . _CACHE_FILE_DELETE_FAIL . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</div>\n";
            }
    } elseif (empty($file) && (!empty($name))) {
            if ($cache->delete('', $name)) {
                echo "<div align=\"center\">\n";
                echo "<strong>" . _CACHE_CAT_DELETE_SUCC . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</div>\n";
            } else {
                echo "<div align=\"center\">\n";
                echo "<strong>" . _CACHE_CAT_DELETE_FAIL . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</div>\n";
            }
    } else {
            echo "<div align=\"center\">\n";
            echo "<strong>" . _CACHE_INVALID . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</div>\n";
    }
    CloseTable();
}

function cache_view($file, $name) {
    global $admin_file, $cache;
    OpenTable();

    CloseTable();
}

function clear_cache() {
    global $db, $prefix, $admin_file, $cache;
    
    OpenTable();
    
    if ($cache->clear()) {
        // Update the last cleared time stamp
        $db->sql_query("UPDATE `" . $prefix . "_evolution` SET evo_value='" . time() . "' WHERE evo_field='cache_last_cleared'");
        
        echo "<div align=\"center\">\n";
        echo "<strong>" . _CACHE_CLEARED_SUCC . "</strong><br /><br />\n";
        redirect("$admin_file.php?op=cache");
        echo "</div>\n";
    } else {
        echo "<div align=\"center\">\n";
        echo "<strong>" . _CACHE_CLEARED_FAIL . "</strong><br /><br />\n";
        redirect("$admin_file.php?op=cache");
        echo "</div>\n";
    }
    
    CloseTable();
}

function usrclearcache($opt) {
    global $prefix, $db, $admin_file, $cache;
    $opt = intval($opt);
    if($opt == 1 || $opt == 0) {
        $db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='" . $opt . "' WHERE evo_field='usrclearcache'");
        $cache->delete('titanium_evoconfig');
        OpenTable();
            echo "<div align=\"center\">\n";
            echo "<strong>" . _CACHE_PREF_UPDATED_SUCC . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</div>\n";
        CloseTable();
    } else {
        OpenTable();
            echo "<div align=\"center\">\n";
            echo "<strong>" . _CACHE_INVALID . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</div>\n";
        CloseTable();
    }
}

function howto_enable_cache() {
    global $admin_file;
    OpenTable();
        echo "<div align=\"center\">\n";
        echo "<strong>" . _CACHE_ENABLE_HOW . "</strong><br />";
        echo "<br />\n";
        redirect("$admin_file.php?op=cache");
        echo "</div>\n";
    CloseTable();
}

global $userinfo;
if (is_admin()) {
    include_once(NUKE_BASE_DIR.'header.php');
    cache_header();
    switch ($op) {
        case 'cache_delete':
            delete_cache($_GET['file'], $_GET['name']);
        break;
        case 'cache_view':
            cache_view($_GET['file'], $_GET['name']);
        break;
        case 'cache_clear':
            clear_cache();
        break;
        case 'usrclearcache':
            usrclearcache($_GET['opt']);
        break;
        case 'howto_enable_cache':
            howto_enable_cache();
        break;
        default:
            display_main();
        break;
    }
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    echo "Access Denied";
}
