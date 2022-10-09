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

global $prefix, $db, $cookie, $user, $theme_name;
$index = 1;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "My " . _MARKSTITLE;
include("header.php");

$userinfo = getusrinfo( $user );
$userid = $userinfo["user_id"];
$catname=@htmlentities($catname);

if (!isset($userid) || $userid=="")
        $userid=0;

//Sometimes we don't know the category name
if ((!isset($catname) || $catname=="") && (isset($category) && $category!=""))
{
	$getname="select name from ".$prefix."_bookmarks_cat where category_id='$category'";
	$getnameres=$db->sql_query ($getname,$db);
	$namerow=@$db->sql_fetchrow($getnameres,$db);
	$catname=$namerow['name'];
}
OpenTable();
echo "<center><span class=title><strong>$catname</strong></span></center><P>\n";
echo "<center>[ <a href=modules.php?name=".$module_name.">"._CATEGORIES."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark&amp;catid=$category>"._NEWBOOKMARK."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> ]</center>";
//CloseTable();
echo "<hr />";

//OpenTable();

$marks_query = "select id,name,url,description,mod_date,popup from " . $prefix . "_bookmarks where user_id=" . $userid . " and category_id='" . $category . "' order by name";

$marks_res = $db->sql_query ($marks_query,$db);

echo "<table width=98%>\n<tr class=boxtitle>
      <td width=37%>
	  <img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"25\" height=\"1\" />
	  <strong>Website</strong>
	  </td>
	  <td width=35%><div align=\"center\"><strong>Information</strong></div></td>
	  <td width=15%><div align=\"center\"><strong>Modified</strong></div>
	  </td><td width=5%><strong>Edit</strong>
	  </td><td width=8%><strong>Delete</strong>
	  </td></tr>\n";




for ($i=0;$i<@$db->sql_numrows  ($marks_res,$db);$i++)
{
	$marks_row = @$db->sql_fetchrow($marks_res,$db);

    global $db;
    list($fixed_markurl) = $db->sql_ufetchrow("SELECT `url` FROM `".$prefix."_bookmarks` WHERE `id`='".$marks_row['id']."'", SQL_NUM);

	if ($marks_row['popup']==1)
	{
		echo "<tr class=boxlist>
		<td><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"15\" height=\"1\" />
		<a href=".$fixed_markurl." target=_tab>".$marks_row['name']."</a>
		</td>
		<td>".$marks_row['description']."</td>
		<td><div align=\"center\">".$marks_row['mod_date']."<div></td>
		<td>&nbsp;<a href=modules.php?name=".$module_name."&amp;file=edit_mark&amp;catid=$category&amp;markname=".urlencode($marks_row['name'])."&amp;markcomment=".urlencode($marks_row['description'])."&amp;markid=".$marks_row['id']."&amp;popup=".$marks_row['popup']."><img src='modules/".$module_name."/images/pencil.gif' width=12 height=12 border=0></a>
		</td>
		<td>&nbsp;&nbsp;&nbsp;<a href=modules.php?name=".$module_name."&amp;file=del_mark&amp;catid=".$category."&amp;markname=".urlencode($marks_row['name'])."&amp;markid=".$marks_row['id']."&amp;catname=".$catname."><img src=modules/".$module_name."/admin/trash.png width=12 height=12 border=0></a>
		</td>
		</tr>\n";
	}
	else
	{
		echo "<tr class=boxlist>
		<td><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"15\" height=\"1\" />
		<a href=".$fixed_markurl.">".$marks_row['name']."</a>
		</td><td>".$marks_row['description']."</td>
		<td><div align=\"center\">".$marks_row['mod_date']."<div></td>
		<td>&nbsp;
		<a href=modules.php?name=".$module_name."&amp;file=edit_mark&amp;catid=$category&amp;markname=".urlencode($marks_row['name'])."&amp;markcomment=".urlencode($marks_row['description'])."&amp;markid=".$marks_row['id']."&amp;popup=".$marks_row['popup']."><img src='modules/".$module_name."/images/pencil.gif' width=12 height=12 border=0></a>
		</td>
		<td>&nbsp;&nbsp;&nbsp;
		<a href=modules.php?name=".$module_name."&amp;file=del_mark&amp;catid=".$category."&amp;markname=".urlencode($marks_row['name'])."&amp;markid=".$marks_row['id']."&amp;catname=".$catname."><img src=modules/".$module_name."/admin/trash.png width=12 height=12 border=0></a>
		</td>
		</tr>\n";
	}

	
}
echo "</table>";
@$db->sql_freeresult($marks_res);

//CloseTable();

echo "<hr />";

//OpenTable();
echo "<center>[ <a href=modules.php?name=".$module_name.">"._CATEGORIES."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark&amp;catid=$category>"._NEWBOOKMARK."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> ]</center>";
CloseTable();
include("footer.php");
?> 

