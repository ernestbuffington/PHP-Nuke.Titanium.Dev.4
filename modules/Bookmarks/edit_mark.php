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

global $titanium_prefix, $titanium_db, $cookie, $titanium_user;

if ((isset($_POST['popup']) && !empty($_POST['popup'])) && (isset($_GET['popup']) && !empty($_GET['popup']))) 
$popup = (isset($_GET['popup']) && !stristr($_GET['popup'],'..') && !stristr($_GET['popup'],'://')) ? addslashes(trim($_GET['popup'])) : false;
else 
$popup = (isset($_REQUEST['popup']) && !stristr($_REQUEST['popup'],'..') && !stristr($_REQUEST['popup'],'://')) ? addslashes(trim($_REQUEST['popup'])) : false;

$userinfo = getusrinfo( $titanium_user );
$titanium_userid = $userinfo["user_id"];
$markurl=@htmlentities($markurl);
$markname=@htmlentities($markname);
$markcomment=@htmlentities($markcomment);

if (!isset($titanium_userid) || $titanium_userid=="")
$titanium_userid=0;

$index = 1;

require_once("mainfile.php");

$pnt_module = basename(dirname(__FILE__));

get_lang($pnt_module);


if ((isset($_POST['markid']) && !empty($_POST['markid'])) && (isset($_GET['markid']) && !empty($_GET['markid']))) 
$markid = (isset($_GET['markid']) && !stristr($_GET['markid'],'..') && !stristr($_GET['markid'],'://')) ? addslashes(trim($_GET['markid'])) : false;
else 
$markid = (isset($_REQUEST['markid']) && !stristr($_REQUEST['markid'],'..') && !stristr($_REQUEST['markid'],'://')) ? addslashes(trim($_REQUEST['markid'])) : false;


if ($form_done=="yes" && (isset($catid) && $catid!=""))
{
	if (!isset($popup))
	{
		$popup=1;
	}
	
	if (isset($markid) && $markid!="")
	{
		$query = "update ".$titanium_prefix."_bookmarks set name='$markname',url='$markurl',category_id=$catid,description='$markcomment',mod_date=now(),popup=$popup where id=$markid";
	}
	else
	{
		$query = "insert into ".$titanium_prefix."_bookmarks (user_id,category_id,name,url,description,mod_date,popup) values ($titanium_userid,$catid,'$markname','$markurl','$markcomment',now(),$popup)";
	}

	$titanium_db->sql_query ($query,$titanium_db);
	
	$catquery = "update " . $titanium_prefix . "_bookmarks_cat set mod_date=now() where category_id=$catid";
	$titanium_db->sql_query ($catquery,$titanium_db);

	header("Location: modules.php?name=$pnt_module&file=marks&category=$catid");
}
else if ($form_done=="yes" && (!isset($catid) || $catid==""))
{
	$pagetitle = "My Personal Bookmarks - " . _ADDOREDITBOOKMARK;
	include("header.php");
	OpenTable();
	echo "<span class=\"boxtitle\"><center><strong>" .  _ADDOREDITBOOKMARK . "</strong></center></span><p>";
	echo "<font color=red>"._ERROR.": "._NEEDGROUP."</font>";
	CloseTable();
	exit();
} 

$pagetitle = "My Personal Bookmarks - " . _ADDOREDITBOOKMARK;
include("header.php");
OpenTable();
echo "<span class=\"boxtitle\"><center><strong>" .  _ADDOREDITBOOKMARK . "</strong></center></span><p>";
echo "<center>[ <a href=modules.php?name=".$pnt_module.">"._CATEGORIES."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_cat>"._NEWCATEGORY."</a> ]</center>";
CloseTable();
echo "<br>";
OpenTable();
?>


<form method=post action=modules.php>
<input type=hidden name=name value='<?=$pnt_module?>'>
<input type=hidden name=file value='edit_mark'>
<input type=hidden name=form_done value='yes'>
<input type=hidden name=markid value='<?=$markid?>'>
<table align=center>
<tr><td><? echo _CATEGORY ?></td><td><select name=catid>
<?
$getcatquery = "select * from " . $titanium_prefix . "_bookmarks_cat where user_id=$titanium_userid order by name";
$cat_ret = $titanium_db->sql_query  ($getcatquery,$titanium_db);

for ($i=0;$i<$titanium_db->sql_numrows  ($cat_ret,$titanium_db);$i++)
{
	$catrow = $titanium_db->sql_fetchrow($cat_ret);
	echo "<option value='".$catrow['category_id']."' ";
	if ($catid == $catrow['category_id'])
	{
		echo "SELECTED";
	}
	echo ">".$catrow['name']."\n";
}
$titanium_db->sql_freeresult($cat_ret);

?>
</select> &nbsp; 
<?
if ($i==0)
{
	echo "<a href=modules.php?name=".$pnt_module."&amp;file=edit_cat>"._NEEDGROUP."</a>";
}


?>
</td></tr>
<tr><td><? echo _NAME ?></td><td><input class=inset size=48 type=text name=markname value="<?=$markname?>"></td></tr>
<?
	if (!isset($markurl) || $markurl=="")
	{
       global $titanium_db;
       list($markurl) = $titanium_db->sql_ufetchrow("SELECT `url` FROM `".$titanium_prefix."_bookmarks` WHERE `id`='$markid'", SQL_NUM);
       $markurl=@htmlentities($markurl);
	   $popup=1;
	}
	
	
?>
<tr><td><? echo _URL ?></td><td><input class=inset type=text name=markurl value="<?=$markurl?>" size=48></td></tr>
<tr><td><? echo _COMMENT ?></td><td><input class=inset type=text name=markcomment size=48 maxlength=254 value="<?=$markcomment?>"></td></tr>
<tr><td>&nbsp;</td><td><input type=hidden name=popup value="1" <?if ($popup==1 || !isset($popup)){echo "CHECKED";}?>></td></tr>
<tr><td>&nbsp;</td><td><input type=submit value="<? echo _SAVE ?>"></td></tr>
</table>
</form>

<?php
CloseTable();
include("footer.php");
?> 

