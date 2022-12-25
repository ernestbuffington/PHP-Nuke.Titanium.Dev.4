<?php
#########################################################################
# Network Bookmarks                                                     #
# Copyright (c) 2003 by David Moulton dave@themoultons.net              #
# http://www.themoultons.net                                            #
#                                                                       #
# This program is free software. You can redistribute it and/or modify  #
# it under the terms of the GNU General Public License as published by  #
# the Free Software Foundation; either version 2 of the License.        #
#########################################################################

if (!defined('MODULE_FILE')) 
{
   die ("You can't access this file directly...");
}

global $prefix, $db, $cookie, $user;

$index = 1;

require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

$userinfo = getusrinfo( $user );
$userid   = $userinfo["user_id"];
$catname  = htmlentities($catname);

if(!isset($userid) || $userid=="")
$userid=0;

//If no was pressed
if (isset($action) && $action==_NO)
{
	Header("Location: modules.php?name=".$module_name);
}

//If yes was pressed
if (isset($action)  && $action==_YES && isset($catid) && $catid!="")
{
	$delmarksquery = "delete from ".$prefix."_bookmarks where category_id=$catid AND user_id=$userid";
	$delcatquery   = "delete from ".$prefix."_bookmarks_cat where category_id=$catid AND user_id=$userid";
	
	$db->sql_query ($delmarksquery,$db);
	$db->sql_query ($delcatquery,$db);
	
	Header("Location: modules.php?name=".$module_name);
}

include("header.php");

OpenTable();
echo "<div align=\"center\"><span class=storytitle>"._DELETECATEGORY."</span></div>\n";
echo "<div align=\"center\"><a href=modules.php?name=".$module_name.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a></div>";
CloseTable();

OpenTable();
?>
<div align="center"><? echo _DELETECATEGORYCONFIRM ?> '<?=$catname?>'?<p> <strong><? echo _BOOKMARKSDELETED ?></strong>
<p>
<form action="modules.php">
<input type="hidden" name="name" value="<?=$module_name?>">
<input type="hidden" name="file" value="del_cat">
<input type="hidden" name="catid" value="<?=$catid?>">
<input type="submit" name="action" value="<? echo _YES?>">&nbsp;<input type="submit" name="action" value="<? echo _NO ?>">
</form>
</div>
<?
CloseTable();
echo "<br>";

include("footer.php");
?> 
