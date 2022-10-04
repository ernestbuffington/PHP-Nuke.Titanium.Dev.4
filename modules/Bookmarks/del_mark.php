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

global $pnt_prefix, $pnt_db, $cookie, $pnt_user;
$index = 1;
require_once("mainfile.php");
$pnt_module = basename(dirname(__FILE__));
get_lang($pnt_module);

$userinfo = getusrinfo( $pnt_user );

$pnt_userid = $userinfo["user_id"];
$markname=@htmlentities($markname);

if (!isset($pnt_userid) || $pnt_userid=="")
        $pnt_userid=0;

//If no was pressed
if (isset($action) && $action==_NO)
{
	Header("Location: modules.php?name=".$pnt_module."&file=marks&category=".$catid."&catname=".$catname);
}

//If yes was pressed
if (isset($action)  && $action==_YES && isset($catid) && $catid!="")
{
	$delmarksquery = "delete from ".$pnt_prefix."_bookmarks where id=$markid AND user_id=$pnt_userid";	
	$pnt_db->sql_query ($delmarksquery,$pnt_db);
	$updatecatquery = "update ".$pnt_prefix."_bookmarks_cat set mod_date=now() where category_id=$catid";
	$pnt_db->sql_query ($updatecatquery,$pnt_db);
	
	Header("Location: modules.php?name=".$pnt_module."&file=marks&category=".$catid."&catname=".$catname);
}

$pagetitle = _DELETEBOOKMARK;
include("header.php");

OpenTable();
echo "<center><span class=storytitle>"._DELETEBOOKMARK."</span></center><P>\n";
echo "<center><a href=modules.php?name=".$pnt_module.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_mark>"._NEWBOOKMARK."</a></center>";
CloseTable();
echo "<br>";
OpenTable();
?>
<center><? echo _DELETEBOOKMARKCONFIRM ?> '<?=$markname?>'?<p>
<p>
<form action=modules.php>
<input type=hidden name=name value="<?=$pnt_module?>">
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
