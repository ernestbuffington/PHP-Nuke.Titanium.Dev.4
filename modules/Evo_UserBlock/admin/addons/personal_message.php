<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Server Info Administration
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : personal_message.php
   Author(s)     : Technocrat (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 05.19.2005 (mm.dd.yyyy)

   Notes         : Evo User Block Personal Message Administration
************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

if(!empty($_POST['message'])) {
    $values = array('message' => Fix_Quotes($_POST['message']));
    evouserinfo_write_addon('personal_message', $values);
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_EVO_USERINFO. "&nbsp;-&nbsp;" .$lang_evo_userblock['PERSONAL_MESSAGE']['PERSONAL_MESSAGE']);
    OpenTable();
    echo "<div align=\"center\">\n";
    echo $lang_evo_userblock['ADMIN']['MSG_SAVED'];
    echo "</div>";
    CloseTable();
    global $admin_file;
    echo "<meta http-equiv=\"refresh\" content=\"3;url=$admin_file.php?op=evo-userinfo\">";
    include_once(NUKE_BASE_DIR.'footer.php');
} else {
    include_once(NUKE_BASE_DIR.'header.php');
	OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=evo-userinfo\">" .$lang_evo_userblock['ADMIN']['ADMIN_HEADER']. "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_evo_userblock['ADMIN']['ADMIN_RETURN']. "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    title(_EVO_USERINFO. "&nbsp;-&nbsp;" .$lang_evo_userblock['PERSONAL_MESSAGE']['PERSONAL_MESSAGE']);
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<span style=\"font-size: large; font-weight: bold;\">".$lang_evo_userblock['ADMIN']['HELP']."</span>\n<br /><br />\n";
    echo $lang_evo_userblock['PERSONAL_MESSAGE']['HELP'];
    echo "</div>";
    CloseTable();
    
    echo "<br />";
    
    OpenTable();
    echo "<div align=\"center\">\n";
    echo "<form name=\"good_afternoon\" method=\"post\" action=\"".$admin_file.".php?op=evo-userinfo&amp;file=personal_message\">";
    echo evouserinfo_text_area('message', $evouserinfo_addons['personal_message_message']);
    echo "<br /><input type=\"submit\" value=\"".$lang_evo_userblock['ADMIN']['SAVE']."\">";
    echo "</form>";
    echo "</div>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

?>
