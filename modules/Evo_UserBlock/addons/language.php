<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : language.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Language Module
************************************************************************/

if(!defined('NUKE_EVO')) {
   die ("Illegal File Access");
}

global $useflags, $currentlang, $admin_file, $multilingual, $evouserinfo_addons, $evouserinfo_language;

$evouserinfo_language = '';

if ($multilingual) {
    $titanium_langlist = lang_list();
    
    $menulist = '';
    $evouserinfo_language = '<div align="center">'.$titanium_lang_evo_userblock['BLOCK']['LANG']['SELECT'].'<br /><br />';
    if ($useflags) {
        for ($i = 0, $maxi = count($titanium_langlist); $i < $maxi; $i++) {
            if ($titanium_langlist[$i]!='') {
                $imge = 'images/language/flag-'.$titanium_langlist[$i].'.png';
                $altlang = ucwords($titanium_langlist[$i]);
                if (defined('ADMIN_FILE')) {
                    $evouserinfo_language .= '<a href="'.$qs.$titanium_langlist[$i].'">';
                } elseif (!$name) {
                    $evouserinfo_language .= '<a href="index.php?newlang='.$titanium_langlist[$i]."\">";
                } else {
                    $evouserinfo_language .= '<a href="modules.php?name='.$qs.$titanium_langlist[$i].'">';
                }
                $evouserinfo_language .= (file_exists($imge)) ? "<img src=\"$imge\" align=\"middle\" border=\"0\" alt=\"$altlang\" title=\"$altlang\" hspace=\"3\" vspace=\"3\" />" : $altlang;
                $evouserinfo_language .= '</a> ';
            }
        }
    } else {
        $evouserinfo_language .= '<form action="" method="get">
        <select name="newlanguage" onchange="top.location.href=this.options[this.selectedIndex].value">';
        for ($i=0, $maxi=count($titanium_langlist); $i < $maxi; $i++) {
            if ($titanium_langlist[$i]!='') {
                if (defined('ADMIN_FILE')) {
                    $evouserinfo_language .= '<option value="'.$qs.$titanium_langlist[$i].'"';
                } elseif (!$name) {
                    $evouserinfo_language .= '<option value="index.php?newlang='.$titanium_langlist[$i]."\"";
                } else {
                    $evouserinfo_language .= '<option value="modules.php?name='.$qs.$titanium_langlist[$i].'"';
                }
                if ($titanium_langlist[$i]==$currentlang) $evouserinfo_language .= ' selected="selected"';
                $evouserinfo_language .= '>'.ucwords($titanium_langlist[$i])."</option>\n";
            }
        }
        $evouserinfo_language .= '</select></form>';
    }
    $evouserinfo_language .= '</div>';
}
?>