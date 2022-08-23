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

// useflags is set in configuration
global $useflags, $currentlang, $admin_file, $multilingual;

if (!$multilingual) {
    return $content = '<br /><center>Multilingual is not enabled</center><br />';
}

$qs = defined('ADMIN_FILE') ? $admin_file.'.php?' : '&amp;';
foreach($_GET as $var => $value) {
    if ($var != 'newlang' && $var != 'name') {
        $qs .= htmlspecialchars($var).'='.htmlspecialchars($value).'&amp;';
    }
}
$qs .= 'newlang=';

$langlist = lang_list();

$menulist = '';
$content = '<div align="center">'._SELECTGUILANG.'<br /><br />';
if ($useflags) {
    for ($i = 0, $maxi = count($langlist); $i < $maxi; $i++) {
        if ($langlist[$i]!='') {
            $imge = 'images/language/flag-'.$langlist[$i].'.png';
            $altlang = ucwords($langlist[$i]);
            if (defined('ADMIN_FILE')) {
                $content .= '<a href="'.$qs.$langlist[$i].'">';
            } elseif (!$name) {
                $content .= '<a href="index.php?newlang='.$langlist[$i]."\">";
            } else {
                $content .= '<a href="modules.php?name='.$qs.$langlist[$i].'">';
            }
            $content .= (file_exists($imge)) ? "<img src=\"$imge\" align=\"middle\" border=\"0\" alt=\"$altlang\" title=\"$altlang\" hspace=\"3\" vspace=\"3\" />" : $altlang;
            $content .= '</a> ';
        }
    }
} else {
    $content .= '<form action="" method="get">
    <select name="newlanguage" onchange="top.location.href=this.options[this.selectedIndex].value">';
    for ($i=0, $maxi=count($langlist); $i < $maxi; $i++) {
        if ($langlist[$i]!='') {
            if (defined('ADMIN_FILE')) {
                $content .= '<option value="'.$qs.$langlist[$i].'"';
            } elseif (!$name) {
                $content .= '<option value="index.php?newlang='.$langlist[$i]."\"";
            } else {
                $content .= '<option value="modules.php?name='.$qs.$langlist[$i].'"';
            }
            if ($langlist[$i]==$currentlang) $content .= ' selected="selected"';
            $content .= '>'.ucwords($langlist[$i])."</option>\n";
        }
    }
    $content .= '</select></form>';
}
$content .= '</div>';

?>