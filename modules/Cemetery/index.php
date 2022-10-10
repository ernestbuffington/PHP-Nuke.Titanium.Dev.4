<?php
if (!defined('MODULE_FILE'))die ("You can't access this file directly...");
global $prefix, $db, $cookie, $user, $theme_name;
$index = 1;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "My ". _MARKSTITLE;
include("header.php");
$userinfo = getusrinfo( $user );
$userid = $userinfo["user_id"];
if (!isset($userid) || $userid== "")
$userid=0;
OpenTable();
# space at the top of the page
echo '<div align="center" style="padding-top:6px;">'; 
echo '</div>';
$headstone =  '<img class="tooltip-html copyright absmiddle" alt="" title="" width="40" src="modules/Cemetery/images/icons8-cemetery-30.png" />';
$toes =  '<img class="tooltip-html copyright" alt="" title="" width="30" src="modules/Cemetery/images/icons8-death-96.png" />';
echo "<div align=\"center\"><span class=title><strong><h1>".$headstone." "._CEMETERY." ".$headstone."</h1></strong></span></div>\n";
echo "<center>[ <a href=modules.php?name=".$module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</center>";
echo "";
echo "<hr />";
$cat_query = "select category_id,name,description,mod_date from " . $prefix."_cemetery_cat  where user_id=" . $userid . " order by name";
$categories_res = $db->sql_query ($cat_query, $db);
echo "<table align=center width=98%>
      <tr class=\"boxtitle\">
	  <td width=32%><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"25\" height=\"1\" />
	  <strong>"._CATEGORIES."</strong></td>
	  <td width=40%><strong>Description</strong></td>
	  <td width=15%><div align=\"center\"><strong>Modified</strong></div></td>
	  <td width=5%><strong>Edit</strong></td>
	  <td width=8%><strong>Delete</strong></td></tr>\n";
for ($i=0; $i<$db->sql_numrows  ($categories_res,$db);$i++):
	$cat = $db->sql_fetchrow($categories_res,$db);
	echo "<tr class=boxlist><td><img src=\"themes/".$theme_name."/images/invisible_pixel.gif\" alt=\"\" width=\"15\" height=\"1\" />
	<a href=modules.php?name=".$module_name."&amp;file=marks&amp;category=".$cat['category_id']."&amp;catname=".urlencode($cat['name']).">" . $cat['name'] . "</a></td>
	<td>" . $cat['description'] . "</td>
	<td><div align=\"center\">" . $cat['mod_date'] . "</div></td>
	<td>&nbsp;<a href=modules.php?name=".$module_name."&amp;file=edit_cat&amp;catid=".$cat['category_id']."&amp;catname=".urlencode($cat['name'])."&amp;catcomment=".urlencode($cat['description'])."><img src=modules/".$module_name."/images/pencil.gif width=12 height=12 border=0></a>
	</td>
	<td>&nbsp;&nbsp;&nbsp;<a href=modules.php?name=".$module_name."&amp;file=del_cat&amp;catid=".$cat['category_id']."&amp;catname=".urlencode($cat['name'])."><img src=modules/".$module_name."/admin/trash.png width=12 height=12 border=0></a>
	</td>
	</tr>\n";
endfor;
echo "</table>";
echo "<hr />";
$db->sql_freeresult($categories_res);
echo '<div align="center" style="padding-top:6px;">';
echo '</div>';
CloseTable();
include("footer.php");
?> 
