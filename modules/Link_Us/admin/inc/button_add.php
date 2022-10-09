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
global $identify;

LinkusAdminMain();

	$config = $db->sql_ufetchrow("SELECT * FROM `".$prefix."_link_us_config` LIMIT 0,1");
	
	$ip = $identify->get_ip();

OpenTable();
echo "<form action='".$admin_file.".php?op=insert_button' method='post' enctype='multipart/form-data' name='button_add'>";
echo "<table width='80%' border='1' style='margin: auto;'><tr><th scope='col'>".$lang_new[$module_name]['ADD_SITE_LINK']."</th></tr></table>";
echo "<table width='80%' border='1' style='margin: auto;' cellspacing='3' cellpadding='3'>";
echo " <tr>";
echo "	<td width='40%'><b>".$lang_new[$module_name]['SITE_NAME'].":</b></td>";
echo "	<td width='40%'><input type='text' name='site_name' size='50'></td>";
echo " </tr>";
echo " <tr>";
echo "	<td width='40%'><b>".$lang_new[$module_name]['SITE_URL'].":</b></td>";
echo "	<td width='40%'><input type='text' name='site_url' size='50'></td>";
echo " </tr>";
echo " <tr>";
echo "	<td width='40%'><b>".$lang_new[$module_name]['SITE_IMAGE'].":</b></td>";
if($config['button_method'] == 1){ $type = "type='input'"; } else { $type = "type='file'"; }
echo "      <td width='40%'><input name='site_image' ".$type." size='50'><br />( ".$lang_new[$module_name]['IMAGE_TYPES'].": JPEG, PJPEG, JPG, GIF & PNG )</td>";
echo " </tr>";
echo " <tr><td colspan='2'>";
echo "  <strong>".$lang_new[$module_name]['SITE_DESCRIPTION'].":</strong><br /><br />";
echo Make_TextArea('site_description','','button_add');
echo "  </td>";
echo " </tr>";
echo " <tr>";
echo "     <td width='40%'><b>".$lang_new[$module_name]['BUTTON_TYPE'].":</b></td>";
echo "     <td width='40%'>
	<input name='button_type' type='radio' value='1' checked> ".$lang_new[$module_name]['STANDARD_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_width'] ." x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_height']." )<br />
	<input name='button_type' type='radio' value='2'> ".$lang_new[$module_name]['BANNER_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_banner_width'] ." x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_banner_height']." )<br />
	<input name='button_type' type='radio' value='3'> ".$lang_new[$module_name]['RESOURCE_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_ressource_width'] ." x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_ressource_height']." )</td>";
echo "   </tr>";

echo "<tr><td><strong>".$lang_new[$module_name]['SUB_YOUR_NAME'].":</strong></td><td><input type='test' name='user_name' size='50'></td></tr>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SUB_YOUR_EMAIL'].":</strong></td><td><input type='text' name='user_email' size='50'></td></tr>\n";
echo "<tr><td><strong>".$lang_new[$module_name]['SUB_YOUR_IP'].":</strong></td><td>".$ip."</td></tr>\n";

echo "</table>";
echo "<table width='80%' border='1' align='center' cellspacing='3' cellpadding='3'>";
echo " <tr>";
echo " 	<td width='80%' align='center'><b>".$lang_new[$module_name]['ADD_BUTTON'].":</b> <input name='another_button' type='checkbox' value='1'></td>";
echo " </tr>";
echo "</table>";
echo "<br />";
echo "<input name='site_hits' type='hidden' value='0'>";
echo "<input name='site_status' type='hidden' value='1'>";
echo "<input name='date_added' type='hidden' value='".time()."'>";
echo "<input type='hidden' name='user_id' value='".$userinfo['user_id']."'>\n";
echo "<input type='hidden' name='user_ip' value='".$ip."'>\n";
echo "<input name='op' type='hidden' value='insert_button'>";
echo "<center><input name='submit' type='submit' value='".$lang_new[$module_name]['ADD_LINK_BUTTON']."'></center>";
echo "</form>";
CloseTable();

?>