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
    global $db, $prefix, $cache;

    $out = array();
    if(!($result = $db->sql_query("SELECT * FROM `".$prefix."_modules` WHERE `active`='1' AND `inmenu`='1' AND `cat_id`<>0 ORDER BY `cat_id`, `pos` ASC"))) {
        return '';
    }
    while ($row = $db->sql_fetchrow($result)) {
        $out[$row['cat_id']][] = $row;
    }
    $db->sql_freeresult($result);
    return $out;
}

function moduleblock_get_cats() {
    global $db, $prefix, $cache;
    static $cats;
    $use = (isset($_POST['save']) || (isset($_GET['area']) && $_GET['area'] == 'block')) ? 0 : 1;
    if (isset($cats) && is_array($cats) && $use) return $cats;

    if((($cats = $cache->load('module_cats', 'config')) === false) || !isset($cats) || !$use) {
        $cats = array();
        if(!($result = $db->sql_query("SELECT * FROM `".$prefix."_modules_cat` ORDER BY `pos` ASC"))) {
            return '';
        }
        while ($row = $db->sql_fetchrow($result)) {
            $cats[] = $row;
        }
        $db->sql_freeresult($result);
        $cache->save('module_cats', 'config', $cats);
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
    global $moduleblock_active, $moduleblock_cats, $content, $plus_minus_images, $module_collapse, $userinfo;

    if(!is_array($moduleblock_active) || !is_array($moduleblock_cats)) return;

    // $c_image = ($module_collapse) ? "&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblock0')\" alt=\"\" style=\"cursor: pointer;\" />" : '';
    //Home
    // $content .= "<img style=\"width: 16px; height: 16px\" src=\"images/home.png\" alt=\""._HOME."\">&nbsp;<span style=\"font-weight: bold;\">"._HOME."</span>".$c_image."<br />\n";
    // $content .= "<img style=\"width: 16px; height: 16px\" src=\"images/about.png\" alt=\""._HOME."\">&nbsp;<span style=\"font-weight: bold;\">"._HOME."</span>".$c_image."<br />\n";
    // $content .= get_evo_icon('evo-sprite home').'&nbsp;<span style="font-weight: bold;">'._HOME.'</span>'.$c_image.'<br />'."\n";



    $content .= get_evo_icon('evo-sprite home').'&nbsp;<span style="font-weight: bold;">'._HOME.'</span><br />'."\n";
    $content .= ($module_collapse) ? "<div id=\"moduleblock0\" class=\"switchcontent\">\n" : '';
    $content .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"index.php\">"._HOME."</a>\n";
    $content .= ($module_collapse) ? "</div>\n" : '<br />';

    foreach ($moduleblock_cats as $cat) 
    {
        if(isset($cat['cid']) && is_integer(intval($cat['cid']))) 
        {
            if (!isset($moduleblock_active[intval($cat['cid'])])) 
            	continue;

            $mod_array = $moduleblock_active[intval($cat['cid'])];
            if(is_array($mod_array)) 
            {
                $img = moduleblock_image($cat['image']);
                $img = (!empty($img)) ? "<img style=\"width: 16px; height: 16px\" src=\"".$img."\" alt=\"\">&nbsp;" : '';
                // $c_image = ($module_collapse) ? "&nbsp;&nbsp;<img src=\"".$plus_minus_images['minus']."\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" border=\"0\" onclick=\"expandcontent(this, 'moduleblock".$cat['cid']."')\" alt=\"\" style=\"cursor: pointer;\" />" : '';
                $content .= $img."<span style=\"font-weight: bold;\">".$cat['name']."</span><br />\n";
                $content .= ($module_collapse) ? "<div id=\"moduleblock".$cat['cid']."\" class=\"switchcontent\">\n" : '';
                
                foreach ($mod_array as $module) 
                {

                    // echo '<pre style="color: #fff;">'.var_export($module, true).'</pre>';

                    if ($module['view'] >= 2 && !is_mod_admin($module['title'])) 
                    {
                        if ($module['view'] == 2 && is_user()) 
                        {
                            continue;
                        } 
                        elseif ($module['view'] == 3 && !is_user()) 
                        {
                            continue;
                        } 
                        elseif ($module['view'] == 4) 
                        {
                            continue;
                        } 
                        elseif ($module['view'] == 6) 
                        {
                            $groups = (!empty($module['groups'])) ? $groups = explode('-', $module['groups']) : '';
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
                    if(substr($module['title'],0,3) == '~l~') 
                    {
                        $content .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"".$module['custom_title']."\">".substr($module['title'],3)."</a><br />\n";
                    } 
                    else 
                    {
                        $content .= "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"modules.php?name=".$module['title']."\">".$module['custom_title']."</a><br />\n";
                    }
                }
                $content .= ($module_collapse) ? "</div>\n" : "";
            }
        }
    }
}

function moduleblock_get_inactive() {
    global $db, $prefix, $cache;

    if(!($result = $db->sql_query("SELECT * FROM `".$prefix."_modules` WHERE (`active`='0' OR `inmenu`='0' OR `cat_id`='0') AND `title` NOT LIKE '~l~%' ORDER BY `custom_title` ASC"))) {
        return '';
    }
    while ($row = $db->sql_fetchrow($result)) {
        $out[] = $row;
    }
    $db->sql_freeresult($result);
    return $out;
}

function moduleblock_get_inactive_links() {
    global $db, $prefix, $cache;
    static $links;
    $use = (isset($_POST['save']) || (isset($_GET['area']) && $_GET['area'] == 'block')) ? 0 : 1;
    if (isset($links) && is_array($links) && $use) return $links;

    if ((($links = $cache->load('module_links', 'config')) === false) || !isset($links) || !$use) {
        $links = '';
        if(!($result = $db->sql_query("SELECT * FROM `".$prefix."_modules` WHERE (`active`=0 OR `cat_id`='0') AND `title` LIKE '~l~%' ORDER BY `title` ASC"))) {
            return '';
        }
        $links = array();
        while ($row = $db->sql_fetchrow($result)) {
            $links[] = $row;
        }
        $db->sql_freeresult($result);
        if(!empty($links) && is_array($links)) {
            $cache->save('module_links', 'config', $links);
        } else {
            $cache->delete('module_links', 'config');
        }
    }
    return $links;
}

function moduleblock_display_inactive() {
    global $moduleblock_invisible, $moduleblock_invisible_links, $content;

    $content .= "<hr />\n";

    $content .= "<div class=\"clear acenter\">\n";

    $content .= "<select class=\"col-12\" name=\"name1\" onchange=\"top.location.href=this.options[this.selectedIndex].value\">\n";
    $content .= "<option value=''>"._MORE."</option>\n";
    $content .= "<optgroup label=\""._INVISIBLEMODULES."\">\n";
    $one = 0;
    if(is_array($moduleblock_invisible)) {
        foreach ($moduleblock_invisible as $module) {
            if ($module['active']) {
                $one = 1;
                $content .= "<option value=\"modules.php?name=".$module['title']."\">".trim_words($module['custom_title'],13)."</option>\n";
            } else {
                $moduleblock_inactive[] = $module;
            }
        }
        if(!$one) $content .= "<option value=''>"._NONE."</option>\n";
    } else {
        $content .= "<option value=''>"._NONE."</option>\n";
    }
    $content .= "</optgroup>\n";

    $content .= "<optgroup label=\""._NOACTIVEMODULES."\">\n";
    if(is_array($moduleblock_inactive)) {
        foreach ($moduleblock_inactive as $module) {
            $content .= "<option value=\"modules.php?name=".$module['title']."\">".trim_words($module['custom_title'],13)."</option>\n";
        }
    } else {
        $content .= "<option value=''>"._NONE."</option>\n";
    }
    $content .= "</optgroup>\n";

    $content .= "<optgroup label=\""._INACTIVE_LINKS."\">\n";
    if(is_array($moduleblock_invisible_links)) {
        foreach ($moduleblock_invisible_links as $link) {
            $content .= "<option value=\"".$link['custom_title']."\" target=\"_blank\">".substr($link['title'],3)."</option>\n";
        }
    } else {
        $content .= "<option value=''>"._NONE."</option>\n";
    }
    $content .= "</optgroup>\n";
    $content .= "</select>\n";
    $content .= "</div>\n";
}

global $prefix, $db, $language, $currentlang, $nukeurl, $content, $moduleblock_active, $moduleblock_cats;

$content = '';
$main_module = main_module();

$moduleblock_active = moduleblock_get_active();
$moduleblock_cats = moduleblock_get_cats();
moduleblock_display();

if(is_admin()) {
    global $moduleblock_invisible, $moduleblock_invisible_links;
    $moduleblock_invisible = moduleblock_get_inactive();
    $moduleblock_invisible_links = moduleblock_get_inactive_links();
    moduleblock_display_inactive();
}

?>