<?php
/*=======================================================================
 PHP-Nuke Titanium : Nuke-Evolution | Enhanced and Advnanced
 =======================================================================*/

/************************************************************************
   Nuke-Evolution    : Server Info Administration
   PHP-Nuke Titanium : Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
   Copyright (c) 2022 by The PHP-Nuke Titanium Group

   Filename      : case.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)

   Notes         : Evo User Block Administration
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

define('USE_DRAG_DROP', true);

define('NUKE_EVO_USERBLOCK', dirname(dirname(__FILE__)) . '/');
define('NUKE_EVO_USERBLOCK_ADDONS', NUKE_EVO_USERBLOCK . '/addons/');
define('NUKE_EVO_USERBLOCK_ADMIN', dirname(__FILE__) . '/');
define('NUKE_EVO_USERBLOCK_ADMIN_INCLUDES', NUKE_EVO_USERBLOCK_ADMIN . 'includes/');
define('NUKE_EVO_USERBLOCK_ADMIN_ADDONS', NUKE_EVO_USERBLOCK_ADMIN . 'addons/');

global $prefix, $db, $admin_file, $admdata, $lang_evo_userblock;

$module_name = basename(dirname(dirname(__FILE__)));

if(!is_mod_admin($module_name)): 
 echo "Access Denied";
 die();
endif;

include_once(NUKE_EVO_USERBLOCK_ADMIN_INCLUDES . 'functions.php');

include_once(NUKE_EVO_USERBLOCK_ADDONS.'core.php');

require_once(NUKE_INCLUDE_DIR.'ajax/Sajax.php');

global $Sajax;
$Sajax = new Sajax();

evouserinfo_addscripts();

$Sajax->sajax_export("sajax_update");
$Sajax->sajax_handle_client_request();

function evouserinfo_drawlists() 
{
    global $lang_evo_userblock, $admin_file, $Default_Theme, $module_name, $board_config, $userinfo, $evouserinfo_ec, $admlang;

    $active = evouserinfo_getactive();
    $inactive = evouserinfo_getinactive();
    
    $blocks = NUKE_THEMES_DIR.$Default_Theme."/blocks.html";
    
    OpenTable();
    
    # Config
	echo "<div align=\"center\">\n";
    echo "<form action=\"".$admin_file.".php?op=evo-userinfo\" method=\"post\">\n";
    
	echo "<table border=\"0\" align=\"center\" cellspacing=\"1\" cellpadding=\"4\">\n";
    echo "<tr><td align=\"right\">\n";
    echo $lang_evo_userblock['ADMIN']['COLLAPSE'];
    echo "</td><td align=\"left\">\n";
    echo yesno_option('evouserinfo_ec', $evouserinfo_ec);
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    
	echo "<br />";
    
	echo "<input type=\"submit\" value=\"".$admlang['global']['submit']."\" />";
    echo "</form>\n";
    echo "</div>\n";
    CloseTable();
	
	OpenTable();

	echo "<br />";
    echo "<div align=\"center\">";
    echo "<table width=\"460\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\ align=\"center\">\n";
    
	# Inactive
    echo "<tr><td>\n";
    echo "<ul id=\"left_col\" class=\"sortable boxy\">\n";
    
	if(is_array($inactive)) 
	{
        global $board_config;
    
	    foreach ($inactive as $element) 
		{
            if(!empty($element['image'])) 
			{
                echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><center><img 
				src=\"images/".$element['image']."\"></center></li>\n";
            } 
			else 
			{
                $addon = evouserinfo_load_addon($element['filename']);
            
			    if(!empty($addon)) 
				{
                    echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$addon."</li>\n";
                } 
				else 
				{
                    echo "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$element['name']."</li>\n";
                }
            }
        }
    }
    
	# Breaks
    $end = count($active);
    for ($i = 0; $i < 5; $i++) 
	{
        echo "<li id=\"".$lang_evo_userblock['ADMIN']['BREAK'].$i."\"><hr /></li>\n";
    }
    echo "</ul>\n";
    
    echo "</td>\n";
    echo "<td>\n";
    
    # Active
    $title = "Output";
    $content = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\ align=\"center\">\n";
    $content .= "<tr><td>\n";
    $content .= "<ul id=\"center\" class=\"sortable boxy\">\n";
    
	if(is_array($active)) 
	{
        foreach ($active as $element) 
		{
            if(!empty($element['image'])) 
			{
                $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><div align=\"center\"><img 
				src=\"".$board_config['avatar_gallery_path']."/".$userinfo['user_avatar']."\"></div></li>\n";
            } 
			else 
			{
                if($element['filename'] != 'Break') 
				{
                    $addon = evouserinfo_load_addon($element['filename']);
                    
					if(!empty($addon)) 
					{
                        $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$addon."</li>\n";
                    } 
					else 
					{
                        $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\">".$element['name']."</li>\n";
                    }
                } 
				else 
				{
                    $content .= "<li id=\"".$element['filename']."\" ondblclick=\"window.location.href='".$admin_file.".php?op=evo-userinfo&amp;file=".$element['filename']."'\"><hr /></li>\n";
                }
            }
        }
    }
    $content .= "</ul>\n";
    $content .= "</td></tr>\n";
    $content .= "</table>";
    
	if(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks.html")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks.html";
    } 
	elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockR.html")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockR.html";
    }
	elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockr.html")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockr.html";
    }
	elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockL.html")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockL.html";
    }
	elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blockl.html")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blockl.html";
    }elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/block.html")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/block.html";
    }elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks.htm")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks.htm";
    } 
	elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocksR.htm")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocksR.htm";
    }elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocksL.htm")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocksL.htm";
    }elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks-right.htm")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks-right.htm";
    }
	elseif(file_exists(NUKE_THEMES_DIR.$Default_Theme."/blocks-left.htm")) 
	{
        $tmpl_file = NUKE_THEMES_DIR.$Default_Theme."/blocks-left.htm";
    }
    
	if(file_exists(isset($tmpl_file))) 
	{
      $thefile = implode("", file($tmpl_file));
      $thefile = addslashes($thefile);
      $thefile = "\$r_file=\"".$thefile."\";";
      $thefile = str_replace('168', '230', $thefile);
      eval($thefile);
      echo $r_file;
	} 
	else 
	{
	echo $content;
	}
    
    echo "</td></tr>";
    
    echo "<tr>\n";
    echo "<td colspan=\"2\" align=\"center\">";
    echo "<form action=\"\" method=\"post\">
              <br />
              <input type=\"hidden\" name=\"order\" id=\"order\" value=\"\" />
              <input type=\"submit\" onclick=\"getSort()\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\" />
          </form>";
    echo "</td></tr>\n";
    echo "</table>\n";
    echo "</div>";
    CloseTable();
}

function evouserinfo_write ($data){
    global $prefix, $db, $lang_evo_userblock, $cache;
    
    //Clear All Previous Breaks
    $db->sql_query('DELETE FROM `'.$prefix.'_evo_userinfo` WHERE `name`="Break"');
    //Write Data
    if(is_array($data)) {
        foreach ($data as $type => $sub) {
            if ($type == 'left_col') {
                $i = 1;
                foreach ($sub as $element) {
                    if (!preg_match('#'.$lang_evo_userblock['ADMIN']['BREAK'].'#',$element)) {
                        $sql = 'UPDATE `'.$prefix.'_evo_userinfo` SET `position`='.$i.', `active`=0 WHERE `filename`="'.$element.'";';
                        $db->sql_query($sql);
                        $i++;
                    } else {
                        $i++;
                    }
                }
            } else {
                $i = 1;
                foreach ($sub as $element) {
                    if (!preg_match('#'.$lang_evo_userblock['ADMIN']['BREAK'].'#',$element)) {
                        $sql = 'UPDATE `'.$prefix.'_evo_userinfo` SET `position`='.$i.', `active`=1 WHERE `filename`="'.$element.'"';
                        $db->sql_query($sql);
                        $i++;
                    } else {
                        $sql = 'INSERT INTO `'.$prefix.'_evo_userinfo` values ("Break", "Break", 1, '.$i.', "")';
                        $db->sql_query($sql);
                        $i++;
                    }
                }
            }
        }
        $cache->delete('inactive', 'evouserinfo');
        $cache->delete('active', 'evouserinfo');
        $cache->resync();
    }
}

function evouserinfo_addscripts() {
    global $Sajax;
    
	if(!isset($script))
	$script = '';
	
	$script .= "    function onDrop() {
                var data = DragDrop.serData('g2'); 
                x_sajax_update(data, confirm);
            }\n";
    $script .= "function getSort()
            {
              order = document.getElementById(\"order\");
              order.value = DragDrop.serData('g1', null);
            }\n";
    $script .= "function showValue()
                {
                  order = document.getElementById(\"order\");
                  alert(order.value);
                }\n";
    $Sajax->sajax_add_script($script);
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/


if (!empty($file)){
    //Look for . / \ and kick it out
    if (preg_match('/[^\w_]/i',$file)) {
        global $lang_evo_userblock;
        DisplayError($lang_evo_userblock['ACCESS_DENIED']);
    }
}

if (isset($_POST['order']))
{
  $data = evouserinfo_parse_data($_POST['order']);
  evouserinfo_write($data);
  // redirect so refresh doesnt reset order to last save
  redirect($admin_file.".php?op=evo-userinfo");
}
if (isset($_POST['evouserinfo_ec']) && is_int(intval($_POST['evouserinfo_ec']))) {
    global $db, $prefix, $cache, $evouserinfo_ec;
    $db->sql_query("UPDATE ".$prefix."_evolution SET evo_value='".$_POST['evouserinfo_ec']."' WHERE evo_field='evouserinfo_ec'");
    $cache->delete('titanium_evoconfig', 'config');
    $cache->resync();
    $evouserinfo_ec = intval($_POST['evouserinfo_ec']);
}

if (!empty($file)){
    if(file_exists(NUKE_EVO_USERBLOCK_ADMIN_ADDONS . $file . '.php')) {
        include_once(NUKE_EVO_USERBLOCK_ADMIN_ADDONS . $file . '.php');
    } else {
        redirect($admin_file.".php?op=evo-userinfo");
    }
} else {
    global $element_ids;
    $element_ids[] = 'left_col';
    $element_ids[] = 'center';
    $element_ids[] = 'right_col';
    include_once(NUKE_BASE_DIR.'header.php');
	    OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
        //echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
        CloseTable();
        //echo "<br />";
        //title(_EVO_USERINFO);
        OpenTable();
        echo "<div align=\"center\">\n";
        echo "<span style=\"font-size: large; font-weight: bold;\">".$lang_evo_userblock['ADMIN']['HELP']."</span>\n<br />\n";
        echo $lang_evo_userblock['ADMIN']['ADMIN_HELP'];
        echo "</div>";
        CloseTable();
        //echo "<br />\n";
        evouserinfo_drawlists();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>