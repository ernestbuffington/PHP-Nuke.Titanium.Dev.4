<?php
/*======================================================================= 
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $rop, $id;

$newpagetitle = "$sitename $item_delim $name";

if ($rop == "showcontent" && is_numeric($id)) 
{
   list($rev) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_reviews` WHERE `id`='$id'", SQL_NUM);
   $newpagetitle = "$sitename $item_delim $name $item_delim $rev";
}
	
$facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\">\n";
?>