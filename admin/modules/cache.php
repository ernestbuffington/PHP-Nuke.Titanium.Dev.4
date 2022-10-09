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
    $last_cleared_img = ((time() - $evoconfig['cache_last_cleared']) >= 604800) ? get_evo_icon('evo-sprite bad') : get_evo_icon('evo-sprite good');
    $clear_needed = ((time() - $evoconfig['cache_last_cleared']) >= 604800) ? "(<a href=\"$admin_file.php?op=cache_clear\"><font color=\"red\">" . _CACHE_CLEARNOW . "</font></a>)" : "";
    $last_cleared = date('F j, Y, g:i a', $evoconfig['cache_last_cleared']);
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
        echo "<center>"
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
        ."$last_cleared_img</td><td>"
        ."<i>" . _CACHE_LAST_CLEARED . "</i></td><td>" . $last_cleared . "  $clear_needed</td>"
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
        ."</center>";
    CloseTable();
    echo "<br />";
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
   $closed = get_evo_icon('evo-sprite folder');

   // echo "<script type=\"text/javascript\">
   //      <!--

   //      var folder_closed = new Image();
   //      folder_closed.src = \"images/folder_closed.png\";
   //      var folder_open = new Image();
   //      folder_open.src = \"images/folder_open.png\";

   //      function show(name, count)
   //      {
   //          i=1;
   //          while(i<=count){
   //              if(document.getElementById(name + i).style.display == \"none\") {
   //                  document.getElementById(name + i).style.display = \"\";
   //              } else {
   //                  document.getElementById(name + i).style.display = \"none\";
   //              }
   //          i++;
   //          }

   //          var img = document['folder-' + name].src;
   //          if (img == folder_open.src) {
   //              document['folder-' + name].src = folder_closed.src;
   //          } else {
   //              document['folder-' + name].src = folder_open.src;
   //          }
   //      }
   //      -->
   //      </script>";

   /* OpenTable();
    echo  "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" class=\"forumline\">\n";
    echo  "\n"
         ."<tr><th width='40%' align='center'><span class=\"content\"><strong>" . _CACHE_FILENAME . "</strong></span></th>\n"
         ."<th width='15%' align='center'><span class=\"content\"><strong>" . _CACHE_OPTIONS . "</strong></span></th></tr>\n"
         ."\n";

    $all_cache = $cache->saved;
    $total = count($all_cache);
    $cat_names = array_keys($all_cache);
    if(is_array($cat_names)) {
        foreach($cat_names as $file) {
            $img = "open";
            $num_files = $cache->count_rows($file);
            echo  "<tr valign=\"middle\">"
            ."<td width='40%' align='left' colspan=\"1\" class=\"row1\"><a id=\"$file\" href=\"javascript:show('$file', '$num_files');\">&nbsp;<img name='folder-$file' src='images/evo/folder_$img.gif' alt='' border='0' style='vertical-align: middle;' /></a> <strong>" . $file . " ($num_files)</strong></td>\n"
            ."<td width='15%' align='center' colspan=\"1\" class=\"row1\"><strong><a href=\"$admin_file.php?op=cache_delete&amp;name=$file\">" . _CACHE_DELETE . "</a></strong></td>\n"
            ."</tr>\n";
            $subNames = array_keys($all_cache[$file]);
            $id = 1;
            foreach($subNames as $subFile) {
                echo  "<tr valign='middle' id='$file$id'>\n"
                ."<td class=\"row3\" width='40%' align='left' style='text-indent: 15pt;'>$subFile</td>\n"
                ."<td class=\"row3\" width='15%' align='center'><span class=\"content\">[ <a href=\"$admin_file.php?op=cache_delete&amp;file=$subFile&amp;name=$file\">" . _CACHE_DELETE . "</a> | <a href=\"$admin_file.php?op=cache_view&amp;file=$subFile&amp;name=$file\">" . _CACHE_VIEW . "</a> ]</span></td>\n"
                ."</tr>\n";
                $id++;
            }
        }
    }
    echo  "</table>\n";
    CloseTable();*/
}

function delete_cache($file, $name) {
    global $admin_file, $cache;
    OpenTable();
    if (!empty($file) && !empty($name)) {
            if ($cache->delete($file, $name)) {
                echo "<center>\n";
                echo "<strong>" . _CACHE_FILE_DELETE_SUCC . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
            } else {
                echo "<center>\n";
                echo "<strong>" . _CACHE_FILE_DELETE_FAIL . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
            }
    } elseif (empty($file) && (!empty($name))) {
            if ($cache->delete('', $name)) {
                echo "<center>\n";
                echo "<strong>" . _CACHE_CAT_DELETE_SUCC . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
            } else {
                echo "<center>\n";
                echo "<strong>" . _CACHE_CAT_DELETE_FAIL . "</strong><br /><br />\n";
                redirect("$admin_file.php?op=cache");
                echo "</center>\n";
            }
    } else {
            echo "<center>\n";
            echo "<strong>" . _CACHE_INVALID . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</center>\n";
    }
    CloseTable();
}

function cache_view($file, $name) {
    global $admin_file, $cache;
    OpenTable();
        echo  "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" align=\"center\" class=\"forumline\">\n";
        echo  "<tr>\n"
             ."<td class=\"row1\" width='33%' align='center'><span class=\"content\"><a href=\"$admin_file.php?op=cache_delete&amp;file=$file&amp;name=$name\">" . _CACHE_DELETE . "</a></span></td>\n"
             ."<td class=\"row1\" width='33%' align='center'><span class=\"content\"><a href=\"$admin_file.php?op=cache\">" . _CACHE_RETURNCACHE . "</a></span></td>\n"
             ."</tr>\n"
             ."</table>\n";
        echo "<br />\n";
        echo  "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"1\" align=\"left\" class=\"forumline\">\n";
        echo  "<tr>\n"
             ."<td class=\"row1\" width='100%' align='left'>\n";
        if(is_array($cache->saved[$name][$file])) {
            $file = "<?php\n\n\$$file = array(\n".$cache->array_parse($cache->saved[$name][$file]).");\n\n?>";
        } else {
            $file = "<?php\n\n\$$file = \"" . $cache->saved[$name][$file] . "\";\n\n?>";
        }
        @highlight_string($file);
        echo  "</td>\n";
        echo  "</tr>\n";
        echo "</table>\n";
    CloseTable();
}

function clear_cache() {
    global $db, $prefix, $admin_file, $cache;
    
    OpenTable();
    
    if ($cache->clear()) {
        // Update the last cleared time stamp
        $db->sql_query("UPDATE `" . $prefix . "_evolution` SET evo_value='" . time() . "' WHERE evo_field='cache_last_cleared'");
        
        echo "<center>\n";
        echo "<strong>" . _CACHE_CLEARED_SUCC . "</strong><br /><br />\n";
        redirect("$admin_file.php?op=cache");
        echo "</center>\n";
    } else {
        echo "<center>\n";
        echo "<strong>" . _CACHE_CLEARED_FAIL . "</strong><br /><br />\n";
        redirect("$admin_file.php?op=cache");
        echo "</center>\n";
    }
    
    CloseTable();
}

function usrclearcache($opt) {
    global $prefix, $db, $admin_file, $cache;
    $opt = intval($opt);
    if($opt == 1 || $opt == 0) {
        $db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='" . $opt . "' WHERE evo_field='usrclearcache'");
        $cache->delete('evoconfig');
        OpenTable();
            echo "<center>\n";
            echo "<strong>" . _CACHE_PREF_UPDATED_SUCC . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</center>\n";
        CloseTable();
    } else {
        OpenTable();
            echo "<center>\n";
            echo "<strong>" . _CACHE_INVALID . "</strong><br /><br />\n";
            redirect("$admin_file.php?op=cache");
            echo "</center>\n";
        CloseTable();
    }
}

function howto_enable_cache() {
    global $admin_file;
    OpenTable();
        echo "<center>\n";
        echo "<strong>" . _CACHE_ENABLE_HOW . "</strong><br />";
        echo "<br />\n";
        redirect("$admin_file.php?op=cache");
        echo "</center>\n";
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

?>