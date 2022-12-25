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

global $prefix, $db, $cookie, $user, $theme_name;

$index = 1;

require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

include("header.php");

$userinfo = getusrinfo( $user );
$userid = $userinfo["user_id"];

if (!isset($userid) || $userid=="")
{
  $userid=0;
}

OpenTable();
echo "<div align=\"center\"><span class=title><strong>My Bookmark Vault</strong></span></div><br />\n";
echo "<div align=\"center\">[ <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</div>";

echo "<br>";

//OpenTable();
//echo "<hr />";
$cat_query = "select category_id,name,description,mod_date from " . $prefix."_bookmarks_cat  where user_id=" . $userid . " order by name";
$categories_res = $db->sql_query ($cat_query, $db);

echo "<div align=\"center\">";
echo "<table width=100%>
      <tr class=boxtitle>
	  <td width=32%><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"25\" height=\"1\" />&nbsp;&nbsp;
	  <strong>Categories</strong></td>
	  <td width=40%><strong>Description</strong></td>
	  <td width=15%><div align=\"center\"><strong>Modified</strong></div></td>
	  <td width=5%><strong>Edit</strong></td>
	  <td width=8%><strong>Delete</strong></td></tr>\n";

for ($i=0; $i<$db->sql_numrows  ($categories_res,$db);$i++)
{
	$cat = $db->sql_fetchrow($categories_res,$db);

	echo "<tr class=boxlist><td><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"17\" height=\"1\" />&nbsp;&nbsp;&nbsp;&nbsp;
	<a href=modules.php?name=".$module_name."&amp;file=marks&amp;category=".$cat['category_id']."&amp;catname=".urlencode($cat['name']).">" . $cat['name'] . "</a></td>
	<td>" . $cat['description'] . "</td>
	<td><div align=\"center\">&nbsp;&nbsp;&nbsp;&nbsp;" . $cat['mod_date'] . "</div></td>
	<td>&nbsp;<a href=modules.php?name=".$module_name."&amp;file=edit_cat&amp;catid=".$cat['category_id']."&amp;catname=".urlencode($cat['name'])."&amp;catcomment=".urlencode($cat['description'])."><img src=modules/".$module_name."/images/pencil.gif width=12 height=12 border=0></a>
	</td>
	<td>&nbsp;&nbsp;&nbsp;<a href=modules.php?name=".$module_name."&amp;file=del_cat&amp;catid=".$cat['category_id']."&amp;catname=".urlencode($cat['name'])."><img src=modules/".$module_name."/admin/trash.png width=12 height=12 border=0></a>
	</td>
	</tr>\n";
}
echo "</table>";
echo "</div>";

$db->sql_freeresult($categories_res);

echo "<br>";

echo "<div align=\"center\">[ <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</div>";
echo "<br /><div align=\"center\"><span class=storytitle><strong>My Bookmark Vault</strong></span></div>\n";
CloseTable();

include("footer.php");
?> 