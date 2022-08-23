<?php

/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2018 by The Nuke-Evolution Team

   Filename      	: online.php
   Author(s)     	: Technocrat (www.Nuke-Evolution.com)
   Modification(s)	: Technocrat (www.Nuke-Evolution.com)
   Version       	: 1.0.0
   Date          	: 11.15.2018 (mm.dd.yyyy)

   Notes         	: Evo User Block Online Administration
************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

get_header();
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
CloseTable();
echo "<br />";
title(_EVO_USERINFO. "&nbsp;-&nbsp;" .$lang_evo_userblock['ONLINE']['RANK']);
OpenTable();

	if(!empty($_POST)) 
	{
		// $values = array('show_members' => Fix_Quotes($_POST['show_members']),'show_hv' => Fix_Quotes($_POST['show_hv']), 'scroll' => Fix_Quotes($_POST['scroll']));
		$values = array('show_title' => Fix_Quotes($_POST['show_title']),'show_2nd' => Fix_Quotes($_POST['show_2nd']),'show_3rd' => Fix_Quotes($_POST['show_3rd']),'show_4th' => Fix_Quotes($_POST['show_4th']),'show_5th' => Fix_Quotes($_POST['show_5th']));
	    evouserinfo_write_addon('rank', $values);
	    echo "<div align=\"center\">\n";
	    echo $lang_evo_userblock['ADMIN']['SAVED'];
	    echo "</div>";
	    global $admin_file;
	    echo "<meta http-equiv=\"refresh\" content=\"3;url=$admin_file.php?op=evo-userinfo\">";
	} 
	else 
	{
		echo "<div align=\"center\">\n";
	    echo "<form name=\"good_afternoon\" method=\"post\" action=\"".$admin_file.".php?op=evo-userinfo&amp;file=rank\">";
	    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_title', 'checked' => ($evouserinfo_addons['rank_show_title'] == 'yes') ? 'CHECKED' : '');
	    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_title', 'checked' => ($evouserinfo_addons['rank_show_title'] == 'yes') ? '' : 'CHECKED');
	    echo $lang_evo_userblock['ONLINE']['SHOW_RANK_TITLE']."<br />";
	    echo evouserinfo_radio($radio);
	    echo "<br />";
	    unset($radio);
	    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_2nd', 'checked' => ($evouserinfo_addons['rank_show_2nd'] == 'yes') ? 'CHECKED' : '');
	    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_2nd', 'checked' => ($evouserinfo_addons['rank_show_2nd'] == 'yes') ? '' : 'CHECKED');
	    echo $lang_evo_userblock['ONLINE']['SHOW_RANK2']."<br />";
	    echo evouserinfo_radio($radio);
	    echo "<br />";
	    unset($radio);
	    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_3rd', 'checked' => ($evouserinfo_addons['rank_show_3rd'] == 'yes') ? 'CHECKED' : '');
	    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_3rd', 'checked' => ($evouserinfo_addons['rank_show_3rd'] == 'yes') ? '' : 'CHECKED');
	    echo $lang_evo_userblock['ONLINE']['SHOW_RANK3']."<br />";
	    echo evouserinfo_radio($radio);
	    echo "<br />";
	    unset($radio);
	    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_4th', 'checked' => ($evouserinfo_addons['rank_show_4th'] == 'yes') ? 'CHECKED' : '');
	    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_4th', 'checked' => ($evouserinfo_addons['rank_show_4th'] == 'yes') ? '' : 'CHECKED');
	    echo $lang_evo_userblock['ONLINE']['SHOW_RANK4']."<br />";
	    echo evouserinfo_radio($radio);
	    echo "<br />";
	    unset($radio);
	    $radio[] = array('value' => 'yes', 'text' => $lang_evo_userblock['YES'], 'name' => 'show_5th', 'checked' => ($evouserinfo_addons['rank_show_5th'] == 'yes') ? 'CHECKED' : '');
	    $radio[] = array('value' => 'no', 'text' => $lang_evo_userblock['NO'], 'name' => 'show_5th', 'checked' => ($evouserinfo_addons['rank_show_5th'] == 'yes') ? '' : 'CHECKED');
	    echo $lang_evo_userblock['ONLINE']['SHOW_RANK5']."<br />";
	    echo evouserinfo_radio($radio);
	    echo "<br />";
	    unset($radio);


	    echo "<br />";
	    echo "<input type=\"submit\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\">";
	    echo "</form>";
	    echo "</div>";
	}

CloseTable();
get_footer();

?>