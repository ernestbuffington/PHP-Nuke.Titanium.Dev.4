<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 (c) 2007 - 2018 by Lonestar Modules - https://lonestar-modules.com
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/
	//include(NUKE_BASE_DIR.'header.php');
	LinkusAdminMain();
	
	OpenTable();
$a = 0;
$result = $pnt_db->sql_query("SELECT * FROM `".$pnt_prefix."_link_us` WHERE `site_status`='3' ORDER BY `site_name`");
$numrows = $pnt_db->sql_numrows($result);
if($numrows > 0) {
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  while($row = $pnt_db->sql_fetchrow($result)) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
	
    OpenTable();
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='3'>";
    echo "<a href='modules.php?name=".$pnt_module."&amp;op=visit&amp;id=".$row['id']."' target='_blank'><img src='".$row['site_image']."' border='0' alt='".$row['site_name']."' title='".$row['site_name']."' height='$height' width='$width'></a><br /><br />";
    echo " <a href='".$admin_file.".php?op=approve_button&amp;id=".$row['id']."'><img src='modules/".$pnt_module."/images/approve.png' border='0' alt='".$lang_new[$pnt_module]['APPROVE']."' title='".$lang_new[$pnt_module]['APPROVE']."'></a>";
    echo " <a href='".$admin_file.".php?op=edit_button&amp;id=".$row['id']."'><img src='modules/".$pnt_module."/images/edit.png' border='0' alt='".$lang_new[$pnt_module]['EDIT']."' title='".$lang_new[$pnt_module]['EDIT']."'></a>";
    echo " <a href='".$admin_file.".php?op=delete_button&amp;id=".$row['id']."'><img src='modules/".$pnt_module."/images/delete.png' border='0' alt='".$lang_new[$pnt_module]['DELETE']."' title='".$lang_new[$pnt_module]['DELETE']."'></a>";
    echo "</td>\n<td width='75%' valign='top'><strong>".$lang_new[$pnt_module]['ADDED'].":</strong> ".formatTimestamp($row['date_added'])."</td></tr>";
	echo "<tr><td valign='top'><strong>".$lang_new[$pnt_module]['SUB_USERNAME']."</strong>: ".UsernameColor($row['user_name'])."</td></tr>";
	echo "<tr><td valign='top'><strong>".$lang_new[$pnt_module]['DESCRIPTION']."</strong>: ".set_smilies(decode_bbcode(stripslashes($row['site_description']), 1, true))."</td></tr>";
    echo "</table>";
    CloseTable();
    echo "</td>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  if($a == 1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
  
} else {

  echo "<center class='title'>".$lang_new[$pnt_module]['SUB_NONE']."</center>\n";
  
}
	CloseTable();

?>