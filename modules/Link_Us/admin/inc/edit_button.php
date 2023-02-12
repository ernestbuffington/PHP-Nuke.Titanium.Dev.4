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
 
LinkusAdminMain();

$row = $db->sql_ufetchrow("SELECT * FROM ".$prefix."_link_us where id='$id' LIMIT 0,1 ");

$id = $row['id'];
$site_name = $row['site_name'];
$site_url = $row['site_url'];
$site_image = $row['site_image'];
$site_description = $row['site_description'];
$site_status = $row['site_status'];

if($row['site_status'] == 0)
  $inactive = "checked"; 

if($row['site_status'] == 1)
  $active = "checked"; 
		
echo "<br />\n";
OpenTable();
echo "<table border='0' width='70%' cellpadding='5' cellspacing='5' style='margin: auto;'>";

echo "<form action='".$admin_file.".php?op=edit_button_save' name='edit_button' method='post'>";

echo "<tr><td><strong>".$lang_new[$module_name]['SITE_ID'].":</strong></td><td><strong>".$row['id']."</strong></tr></td>";

echo "<tr><td><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td><input type='hidden' name='site_name' size='60' value='".$row['site_name']."' />".$row['site_name']."</tr></td>";

echo "<tr><td><strong>".$lang_new[$module_name]['SITE_URL'].":</strong></td><td><input type='text' name='site_url' size='60' value='".$row['site_url']."' /></tr></td>";

echo "<tr><td><strong>".$lang_new[$module_name]['SITE_IMAGE'].":</strong></td><td><input type='text' name='site_image' size='30' value='".$row['site_image']."' /></tr></td>";

echo "<tr><td><strong>".$lang_new[$module_name]['DATE_ADDED'].":</strong></td><td>".formatTimestamp($row['date_added'])."</tr></td>";

echo "<tr><td valign='top'><strong>".$lang_new[$module_name]['SITE_DESCRIPTION'].":</strong></td></tr><tr><td colspan='2'>";

echo Make_TextArea('site_description', $row['site_description'],'edit_button', '100%', '300px');
echo "</tr></td>";
	
if($row['site_status'] == 1)
{
    echo "<tr><td><strong>".$lang_new[$module_name]['SITE_STATUS'].":</strong></td><td><input name='site_status' type='radio' 
	value='1' checked='checked'>".$lang_new[$module_name]['ACTIVE']."&nbsp;<input name='site_status' type='radio' value='0'>".$lang_new[$module_name]['DEACTIVATED']."</td></tr>";
} 
else 
{
    echo "<tr><td><strong>".$lang_new[$module_name]['SITE_STATUS'].":</strong></td><td>".$lang_new[$module_name]['ACTIVE'].":<input name='site_status' type='radio' 
	value='1' checked='checked'>&nbsp;".$lang_new[$module_name]['DEACTIVATED'].":<input name='site_status' type='radio' value='0'></td></tr>";
}

echo "</table></center>";
echo "<center><input type='submit' value='".$lang_new[$module_name]['SAVE_EDIT_LINK_BUTTON']."' />";
echo "</form>";
CloseTable();

?>