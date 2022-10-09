<?php
/*======================================================================= 
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $l_op, $cid, $lid, $module_title;

$name = $module_title;

$newpagetitle = "$sitename &raquo; $name";

if(isset($cid) && is_numeric($cid)) 
{
        list($cat, $parent) = $db->sql_ufetchrow("SELECT `title`, `parentid` FROM `".$prefix."_downloads_categories` WHERE `cid`='$cid'", SQL_NUM);

        if ($parent == 0) 
		{
			if(empty($cat))
            $newpagetitle = "$sitename &raquo; $name";
			else
			$newpagetitle = "$sitename &raquo; $name &raquo; $cat";
        } 
		else 
		{
            list($parent) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_downloads_categories` WHERE `cid`='$parent'", SQL_NUM);
        
		    $newpagetitle = "$sitename &raquo; $name &raquo; $parent &raquo; $cat";
        }
    }
       $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
?>