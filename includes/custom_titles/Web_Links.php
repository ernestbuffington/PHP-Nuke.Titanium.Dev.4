<?php
/*======================================================================= 
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

    global $l_op, $cid, $lid, $item_delim, $name, $module_title;

    $name = $module_title;

    $newpagetitle = "$sitename &raquo; $name";

    if($l_op == 'viewlink' && is_numeric($cid)) 
	{
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `".$prefix."_links_categories` WHERE `cid`='$cid'", SQL_NUM);
    
	    if ($parent == 0) 
		{
            $newpagetitle = "$sitename &raquo; $name &raquo; $cat";

            $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$cid\" />\n"; 	 	 

            $facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $module_title &raquo; Category &raquo; $cat [-\" />\n";
		} 
		else 
		{
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_links_categories` WHERE `cid`='$parent'", SQL_NUM);

            $newpagetitle = "$sitename &raquo; $name &raquo; $parent &raquo; $cat";

            $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Web_Links&amp;l_op=viewlink&amp;cid=$parent\" />\n"; 	 	 

            $facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $module_title &raquo; Category &raquo; $cat [-\" />\n";
        }
    }

     $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n"; 
?>