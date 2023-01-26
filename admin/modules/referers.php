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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
if(!defined('ADMIN_FILE')) die ("Illegal File Access");
global $prefix, $db;
if (is_mod_admin()): 
    if (isset($_GET['del']) && $_GET['del'] == 'all'): 
        $db->sql_query('DELETE FROM `'.$prefix.'_referer`');
        $db->sql_query('OPTIMIZE TABLE `'.$prefix.'_referer`');
        redirect($admin_file.'.php?op=hreferer');
	else: 
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo '<div align="center">' , PHP_EOL;
		echo '[ <a href="'.$admin_file.'.php?op=hreferer">'.$admlang['referers']['header'].'</a> ]</div>' , PHP_EOL;
        echo '<div align="center">' , PHP_EOL;
		echo '[ <a href="'.$admin_file.'.php">' . $admlang['global']['header_return'] . '</a> ]</div>' , PHP_EOL;
        CloseTable();
        OpenTable();
        echo '<div align="center" style="padding-top:6px;">';
        echo '</div>';
		global $domain;
		echo '<div style="text-align:center"><h1>'.$admlang['referers']['linking'].'',$domain.'?</h1></div>' , PHP_EOL;
        $result = $db->sql_query("SELECT `url`, `link`, `lasttime` FROM ".$prefix."_referer ORDER by `lasttime` DESC");
		echo '<table style="width:100%;" border="0" cellpadding="0" cellspacing="1" class="forumline" align="center">' , PHP_EOL;
		echo '<tr><td class="catHead" style="width: 80%; text-align: center; font-weight: bold;">'.$admlang['referers']['link'].'</td>' , PHP_EOL;
		echo '<td class="catHead" style="width: 20%; text-align: center; font-weight: bold;">'.$admlang['referers']['date'].'</td></tr>' , PHP_EOL;
		if($db->sql_numrows($result) > 0): 
            while (list($url, $link, $time) = $db->sql_fetchrow($result)): 
				if(!isset($x))
				$x = 0;
				$x++;
                $bgcolor = ($x%2 == 0) ? 'row2' : 'row3';
				$date = date("F d, Y - h:ia", $time);
                $link = (!empty($link) && $link != '/' && $link != '/GET/') ? "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&gt;&nbsp;".$link : '';
                echo '<tr>' , PHP_EOL;
				echo '<td class="'.$bgcolor.'" style="width: 80%; height: 30px; text-align: left; font-weight: bold;">' , PHP_EOL;
				echo '<a href="'.$url.'" target="_blank">&nbsp;&nbsp;'.$url.'</a>'.$link.'</td>' , PHP_EOL;
				echo '<td class="'.$bgcolor.'" style="width: 20%; height: 30px; text-align: center; font-weight: bold;">'.$date.'</td>' , PHP_EOL;
				echo '</tr>' , PHP_EOL;				
            endwhile;
			echo '</table>' , PHP_EOL;
            echo '<div align="center" style="padding-top:10px;">';
            echo '</div>';
			echo '<div style="text-align:center; display: block; border:0.1px solid; width: 200px; height:30px; line-height:30px; font-weight: 900; margin: auto auto;">' , PHP_EOL;
			echo '<a class="genmed" href="'.$admin_file.'.php?op=hreferer&amp;del=all">'.$admlang['referers']['delete'].'</a>' , PHP_EOL;
			echo '</div>' , PHP_EOL;
            echo '<div align="center" style="padding-top:10px;">';
            echo '</div>';
		else: 
			echo '<tr>' , PHP_EOL;
			echo '<td class="row2" colspan="2" style="text-align: center; font-weight: bold;">' , PHP_EOL;
			echo '-- '.sprintf($admlang['referers']['none'], strtolower(_HTTPREFERERS)).' --' , PHP_EOL;
			echo '</td>' , PHP_EOL;
			// echo '<td class="row2" style="width: 20%; text-align: center; font-weight: bold;">&nbsp;</td>' , PHP_EOL;
			echo '</tr>' , PHP_EOL;
			echo '</table>' , PHP_EOL;
        endif;
		$db->sql_freeresult($result);
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    endif;
else: 
    echo 'Access Denied';
endif;
?>
