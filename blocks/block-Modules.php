<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

function moduleblock_get_active() {
    global $titanium_db, $titanium_prefix, $titanium_cache;

    $out = array();
    if(!($result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_modules` WHERE `active`='1' AND `inmenu`='1' AND `cat_id`<>0 ORDER BY `cat_id`, `pos` ASC"))) {
        return '';
    }
    while ($row = $titanium_db->sql_fetchrow($result)) {
        $out[$row['cat_id']][] = $row;
    }
    $titanium_db->sql_freeresult($result);
    return $out;
}

function moduleblock_get_cats() {
    global $titanium_db, $titanium_prefix, $titanium_cache;
    static $cats;
    $use = (isset($_POST['save']) || (isset($_GET['area']) && $_GET['area'] == 'block')) ? 0 : 1;
    if (isset($cats) && is_array($cats) && $use) return $cats;

    if((($cats = $titanium_cache->load('module_cats', 'config')) === false) || !isset($cats) || !$use) {
        $cats = array();
        if(!($result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_modules_cat` ORDER BY `pos` ASC"))) {
            return '';
        }
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $cats[] = $row;
        }
        $titanium_db->sql_freeresult($result);
        $titanium_cache->save('module_cats', 'config', $cats);
    }

    return $cats;
}

function moduleblock_image($name) {
    global $Default_Theme;

    if(empty($name)) return '';

    if (substr($name,0,strlen('http://')) == 'http://') return $name;

    if(file_exists(NUKE_IMAGES_DIR.$name)) {
        return 'images/'.$name;
    }

    if(file_exists(NUKE_IMAGES_DIR.'blocks/modules/'.$name)) {
        return 'images/blocks/modules/'.$name;
    }
    if(!empty($Default_Theme)) {
        if(file_exists(NUKE_THEMES_DIR.$Default_Theme.'/images/'.$name)) {
            return 'themes/'.$Default_Theme.'/images/'.$name;
        }
    }

    return '';
}

function moduleblock_display() {
    global $titanium_moduleblock_active, $titanium_moduleblock_cats, $content, $plus_minus_images, $titanium_module_collapse, $userinfo;

    if(!is_array($titanium_moduleblock_active) || !is_array($titanium_moduleblock_cats)) return;

    // $c_image = ($titanium_module_collapse) ? "&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblock0')\" alt=\"\" style=\"cursor: pointer;\" />" : '';
    //Home
    // $content .= "<img style=\"width: 16px; height: 16px\" src=\"images/home.png\" alt=\""._HOME."\">&nbsp;<span style=\"font-weight: bold;\">"._HOME."</span>".$c_image."<br />\n";
    // $content .= "<img style=\"width: 16px; height: 16px\" src=\"images/about.png\" alt=\""._HOME."\">&nbsp;<span style=\"font-weight: bold;\">"._HOME."</span>".$c_image."<br />\n";
    // $content .= get_evo_icon('evo-sprite home').'&nbsp;<span style="font-weight: bold;">'._HOME.'</span>'.$c_image.'<br />'."\n";



    $content .= get_evo_icon('evo-sprite home').'&nbsp;<span style="font-weight: bold;">'._HOME.'</span><br />'."\n";
    $content .= ($titanium_module_collapse) ? "<div id=\"moduleblock0\" class=\"switchcontent\">\n" : '';
    $content .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\">"._HOME."</a>\n";
    $content .= ($titanium_module_collapse) ? "</div>\n" : '<br />';

    foreach ($titanium_moduleblock_cats as $cat) 
    {
        if(isset($cat['cid']) && is_integer(intval($cat['cid']))) 
        {
            if (!isset($titanium_moduleblock_active[intval($cat['cid'])])) 
            	continue;

            $mod_array = $titanium_moduleblock_active[intval($cat['cid'])];
            if(is_array($mod_array)) 
            {
                $img = moduleblock_image($cat['image']);
                $img = (!empty($img)) ? "<img style=\"width: 16px; height: 16px\" src=\"".$img."\" alt=\"\">&nbsp;" : '';
                // $c_image = ($titanium_module_collapse) ? "&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblock".$cat['cid']."')\" alt=\"\" style=\"cursor: pointer;\" />" : '';
                $content .= $img."<span style=\"font-weight: bold;\">".$cat['name']."</span><br />\n";
                $content .= ($titanium_module_collapse) ? "<div id=\"moduleblock".$cat['cid']."\" class=\"switchcontent\">\n" : '';
                
                foreach ($mod_array as $titanium_module) 
                {

                    // echo '<pre style="color: #fff;">'.var_export($titanium_module, true).'</pre>';

                    if ($titanium_module['view'] >= 2 && !is_mod_admin($titanium_module['title'])) 
                    {
                        if ($titanium_module['view'] == 2 && is_user()) 
                        {
                            continue;
                        } 
                        elseif ($titanium_module['view'] == 3 && !is_user()) 
                        {
                            continue;
                        } 
                        elseif ($titanium_module['view'] == 4) 
                        {
                            continue;
                        } 
                        elseif ($titanium_module['view'] == 6) 
                        {
                            $groups = (!empty($titanium_module['groups'])) ? $groups = explode('-', $titanium_module['groups']) : '';
                            $ingroup = false;
                            if(is_array($groups))
                            {
                                foreach ($groups as $group) 
                                {
                                     if (isset($userinfo['groups'][$group])) 
                                     {
                                         $ingroup = true;
                                     }
                                }
                                if (!$ingroup) 
                                	continue;
                            }
                        }
                    }
                    if(substr($titanium_module['title'],0,3) == '~l~') 
                    {
                        $content .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".$titanium_module['custom_title']."\">".substr($titanium_module['title'],3)."</a><br />\n";
                    } 
                    else 
                    {
                        $content .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=".$titanium_module['title']."\">".$titanium_module['custom_title']."</a><br />\n";
                    }
                }
                $content .= ($titanium_module_collapse) ? "</div>\n" : "";
            }
        }
    }
}

function moduleblock_get_inactive() {
    global $titanium_db, $titanium_prefix, $titanium_cache;

    if(!($result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_modules` WHERE (`active`='0' OR `inmenu`='0' OR `cat_id`='0') AND `title` NOT LIKE '~l~%' ORDER BY `custom_title` ASC"))) {
        return '';
    }
    while ($row = $titanium_db->sql_fetchrow($result)) {
        $out[] = $row;
    }
    $titanium_db->sql_freeresult($result);
    return $out;
}

function moduleblock_get_inactive_links() {
    global $titanium_db, $titanium_prefix, $titanium_cache;
    static $links;
    $use = (isset($_POST['save']) || (isset($_GET['area']) && $_GET['area'] == 'block')) ? 0 : 1;
    if (isset($links) && is_array($links) && $use) return $links;

    if ((($links = $titanium_cache->load('module_links', 'config')) === false) || !isset($links) || !$use) {
        $links = '';
        if(!($result = $titanium_db->sql_query("SELECT * FROM `".$titanium_prefix."_modules` WHERE (`active`=0 OR `cat_id`='0') AND `title` LIKE '~l~%' ORDER BY `title` ASC"))) {
            return '';
        }
        $links = array();
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $links[] = $row;
        }
        $titanium_db->sql_freeresult($result);
        if(!empty($links) && is_array($links)) {
            $titanium_cache->save('module_links', 'config', $links);
        } else {
            $titanium_cache->delete('module_links', 'config');
        }
    }
    return $links;
}

function moduleblock_display_inactive() {
    global $titanium_moduleblock_invisible, $titanium_moduleblock_invisible_links, $content;

    $content .= "<hr />\n";

    $content .= "<div class=\"clear acenter\">\n";

    $content .= "<select class=\"col-12\" name=\"name1\" onchange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
    $content .= "<option value=''>"._MORE."</option>\n";
    $content .= "<optgroup label=\""._INVISIBLEMODULES."\">\n";
    $one = 0;
    if(is_array($titanium_moduleblock_invisible)) {
        foreach ($titanium_moduleblock_invisible as $titanium_module) {
            if ($titanium_module['active']) {
                $one = 1;
                $content .= "<option value=\"modules.php?name=".$titanium_module['title']."\">".trim_words($titanium_module['custom_title'],13)."</option>\n";
            } else {
                $titanium_moduleblock_inactive[] = $titanium_module;
            }
        }
        if(!$one) $content .= "<option value=''>"._NONE."</option>\n";
    } else {
        $content .= "<option value=''>"._NONE."</option>\n";
    }
    $content .= "</optgroup>\n";

    $content .= "<optgroup label=\""._NOACTIVEMODULES."\">\n";
    if(is_array($titanium_moduleblock_inactive)) {
        foreach ($titanium_moduleblock_inactive as $titanium_module) {
            $content .= "<option value=\"modules.php?name=".$titanium_module['title']."\">".trim_words($titanium_module['custom_title'],13)."</option>\n";
        }
    } else {
        $content .= "<option value=''>"._NONE."</option>\n";
    }
    $content .= "</optgroup>\n";

    $content .= "<optgroup label=\""._INACTIVE_LINKS."\">\n";
    if(is_array($titanium_moduleblock_invisible_links)) {
        foreach ($titanium_moduleblock_invisible_links as $link) {
            $content .= "<option value=\"".$link['custom_title']."\" target=\"_blank\">".substr($link['title'],3)."</option>\n";
        }
    } else {
        $content .= "<option value=''>"._NONE."</option>\n";
    }
    $content .= "</optgroup>\n";
    $content .= "</select>\n";
    $content .= "</div>\n";
}

global $titanium_prefix, $titanium_db, $titanium_language, $currentlang, $nukeurl, $content, $titanium_moduleblock_active, $titanium_moduleblock_cats;

$content = '';
$main_module_titanium = main_module_titanium();

$titanium_moduleblock_active = moduleblock_get_active();
$titanium_moduleblock_cats = moduleblock_get_cats();
moduleblock_display();

if(is_admin()) {
    global $titanium_moduleblock_invisible, $titanium_moduleblock_invisible_links;
    $titanium_moduleblock_invisible = moduleblock_get_inactive();
    $titanium_moduleblock_invisible_links = moduleblock_get_inactive_links();
    moduleblock_display_inactive();
}

?>