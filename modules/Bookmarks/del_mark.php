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
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
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

$userid = $userinfo["user_id"];
$markname=@htmlentities($markname);

if (!isset($userid) || $userid=="")
        $userid=0;

//If no was pressed
if (isset($action) && $action==_NO)
{
	Header("Location: modules.php?name=".$module_name."&file=marks&category=".$catid."&catname=".$catname);
}

//If yes was pressed
if (isset($action)  && $action==_YES && isset($catid) && $catid!="")
{
	$delmarksquery = "delete from ".$prefix."_bookmarks where id=$markid AND user_id=$userid";	
	$db->sql_query ($delmarksquery,$db);
	$updatecatquery = "update ".$prefix."_bookmarks_cat set mod_date=now() where category_id=$catid";
	$db->sql_query ($updatecatquery,$db);
	
	Header("Location: modules.php?name=".$module_name."&file=marks&category=".$catid."&catname=".$catname);
}

$pagetitle = _DELETEBOOKMARK;
include("header.php");

OpenTable();
echo "<center><span class=storytitle>"._DELETEBOOKMARK."</span></center><P>\n";
echo "<center><a href=modules.php?name=".$module_name.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a></center>";
CloseTable();
echo "<br>";
OpenTable();
?>
<center><? echo _DELETEBOOKMARKCONFIRM ?> '<?=$markname?>'?<p>
<p>
<form action=modules.php>
<input type=hidden name=name value="<?=$module_name?>">
<input type=hidden name=file value="del_mark">
<input type=hidden name=catid value="<?=$catid?>">
<input type=hidden name=catname value="<?=$catname?>">
<input type=hidden name=markid value="<?=$markid?>">
<input type=submit name=action value="<? echo _YES ?>">&nbsp;&nbsp;&nbsp;<input type=submit name=action value="<? echo _NO ?>">
</form>
</center>
<?
CloseTable();
echo "<br>";

include("footer.php");
?> 
