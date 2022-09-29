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
   exit("You can't access this file directly...");
}

global $titanium_prefix, $titanium_db, $cookie, $titanium_user, $theme_name;

$index = 1;

require_once("mainfile.php");

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

$pagetitle = "86it Developers Network - My ". _MARKSTITLE;

include("header.php");

$userinfo = getusrinfo( $titanium_user );
$titanium_userid = $userinfo["user_id"];

if (!isset($titanium_userid) || $titanium_userid=="")
{
  $titanium_userid=0;
}


OpenTable();
echo "<center><span class=title><strong>My Bookmark Vault</strong></span></center><br />\n";
echo "<center>[ <a href=modules.php?name=".$titanium_module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$titanium_module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</center>";

echo "<br>";

//OpenTable();
echo "<hr />";
$cat_query = "select category_id,name,description,mod_date from " . $titanium_prefix."_bookmarks_cat  where user_id=" . $titanium_userid . " order by name";
$categories_res = $titanium_db->sql_query ($cat_query, $titanium_db);

echo "<table align=center width=98%>
      <tr class=boxtitle>
	  <td width=32%><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"25\" height=\"1\" />
	  <strong>Categories</strong></td>
	  <td width=40%><strong>Description</strong></td>
	  <td width=15%><div align=\"center\"><strong>Modified</strong></div></td>
	  <td width=5%><strong>Edit</strong></td>
	  <td width=8%><strong>Delete</strong></td></tr>\n";

for ($i=0; $i<$titanium_db->sql_numrows  ($categories_res,$titanium_db);$i++)
{
	$cat = $titanium_db->sql_fetchrow($categories_res,$titanium_db);

	echo "<tr class=boxlist><td><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"15\" height=\"1\" />
	<a href=modules.php?name=".$titanium_module_name."&amp;file=marks&amp;category=".$cat['category_id']."&amp;catname=".urlencode($cat['name']).">" . $cat['name'] . "</a></td>
	<td>" . $cat['description'] . "</td>
	<td><div align=\"center\">" . $cat['mod_date'] . "</div></td>
	<td>&nbsp;<a href=modules.php?name=".$titanium_module_name."&amp;file=edit_cat&amp;catid=".$cat['category_id']."&amp;catname=".urlencode($cat['name'])."&amp;catcomment=".urlencode($cat['description'])."><img src=modules/".$titanium_module_name."/images/pencil.gif width=12 height=12 border=0></a>
	</td>
	<td>&nbsp;&nbsp;&nbsp;<a href=modules.php?name=".$titanium_module_name."&amp;file=del_cat&amp;catid=".$cat['category_id']."&amp;catname=".urlencode($cat['name'])."><img src=modules/".$titanium_module_name."/admin/trash.png width=12 height=12 border=0></a>
	</td>
	</tr>\n";
}
echo "</table>";
echo "<hr />";

$titanium_db->sql_freeresult($categories_res);

//CloseTable();
echo "<br>";

echo "<center>[ <a href=modules.php?name=".$titanium_module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$titanium_module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</center>";
echo "<br /><center><span class=storytitle><strong>My Bookmark Vault</strong></span></center>\n";
CloseTable();

include("footer.php");
?> 