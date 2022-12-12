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

   Filename      : core.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)

   Notes         : Evo User Block Core File
************************************************************************/

if(!defined('NUKE_EVO')):
  die("Illegal File Access");
endif;

$module_name = basename(dirname(dirname(__FILE__)));

get_lang($module_name);

function evouserinfo_get_addon_all() 
{
    global $prefix, $db, $lang_evo_userblock;

    $sql = 'SELECT value, name from `'.$prefix.'_evo_userinfo_addons`';

    if(!$result = $db->sql_query($sql)): 
        DisplayError($lang_evo_userblock['BLOCK']['ERR_NF']);
    endif;
    
	while($row = $db->sql_fetchrow($result)): 
        $values[$row['name']] = $row['value'];
    endwhile;
    
	$db->sql_freeresult($result);
    
	return $values;
}

function evouserinfo_expand_collapse_start($name) 
{
    global $evouserinfo_ec;

    if(!$evouserinfo_ec): 
	  return "<br />";
	endif;

    return "&nbsp;&nbsp;&nbsp;<img src=\"/images/minus.gif\" class=\"showstate\" name=\"minus\" width=\"9\" height=\"9\" alt=\"\" 
	style=\"cursor: pointer;\" onClick=\"expandcontent(this, '".$name."')\"><div id=\"".$name."\" class=\"switchcontent\">";
}

function evouserinfo_expand_collapse_end() 
{
    global $evouserinfo_ec;

    if(!$evouserinfo_ec): 
	  return '';
	endif;

    return "</div>\n";
}

global $evouserinfo_addons;

$evouserinfo_addons = evouserinfo_get_addon_all();

?>
