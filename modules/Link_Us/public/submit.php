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

	global $userinfo, $identify;

	list($uid, $name, $email) = $db->sql_fetchrow($db->sql_query("SELECT `user_id`, `username`, `user_email`, `user_website` FROM `".$prefix."_users` WHERE `username`='".$userinfo['username']."'"));
	$ip = $identify->get_ip();

	OpenTable();
	
		echo "<div align='center'><strong>" . $lang_new[$module_name]['SUB_ADD_BUTTON'] . "</strong></div>";
		echo "<div align='center'>" . $lang_new[$module_name]['SUB_ALL_FIELDS'] . "</div>";
		
		echo "<br /><br />";
		
		echo "<table width='80%' border='1' cellpadding='5' cellspacing='5' align='center'>\n";
  		if($config['button_method'] == 1){ $enctype = ""; } else { $enctype = "enctype='multipart/form-data'"; }
		echo "<form name='button_submit' action='modules.php?name=".$module_name."' method='post' ".$enctype.">\n";
		
		echo "<input name='site_hits' type='hidden' value='0'>";
		echo "<input name='site_status' type='hidden' value='3'>";
		echo "<input type='hidden' name='date_added' value='".time()."'>\n";
		echo "<input type='hidden' name='user_id' value='".$uid."'>\n";
		echo "<input type='hidden' name='user_ip' value='".$ip."'>\n";
		echo "<input type='hidden' name='op' value='submit_save'>\n";
		
		echo "<tr><td width='40%'><strong>".$lang_new[$module_name]['SITE_NAME'].":</strong></td><td width='40%'><input type='text' name='site_name' size='50'></td></tr>\n";
		echo "<tr><td width='40%'><strong>".$lang_new[$module_name]['SITE_URL'].":</strong></td><td width='40%'><input type='text' name='site_url' size='50'></td></tr>\n";
		if($config['button_method'] == 1){ $type = "type='input'"; } else { $type = "type='file'"; }
  		echo "<tr><td valign='top' width='40%'><strong>".$lang_new[$module_name]['SITE_IMAGE'].":</strong></td><td width='40%'><input ".$type." name='site_image' size='50'>";
		echo "<tr><td colspan='2' valign='top' width='40%'><strong>".$lang_new[$module_name]['SITE_DESCRIPTION'].":</strong><br /><br />";
		echo Make_TextArea('site_description','','button_submit');
		echo "</td></tr>\n";
		echo " <tr>";
		echo "     <td width='40%'><b>".$lang_new[$module_name]['BUTTON_TYPE'].":</b></td>";
		echo "     <td width='40%'>
	<input name='button_type' type='radio' value='1' checked> ".$lang_new[$module_name]['STANDARD_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_width'] ." x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_height']." )<br />
	<input name='button_type' type='radio' value='2'> ".$lang_new[$module_name]['BANNER_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_banner_width'] ." x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_banner_height']." )<br />
	<input name='button_type' type='radio' value='3'> ".$lang_new[$module_name]['RESOURCE_BUTTONS']." ( ".$lang_new[$module_name]['WIDTH']." = " .$config['button_ressource_width'] ." x ".$lang_new[$module_name]['HEIGHT']." = ".$config['button_ressource_height']." )</td>";
		echo "   </tr>";		
  		echo "<tr><td width='40%'><strong>".$lang_new[$module_name]['SUB_YOUR_NAME'].":</strong></td><td width='40%'><input type='test' name='user_name' value='" . $name . "' size='40'></td></tr>\n";
  		echo "<tr><td width='40%'><strong>".$lang_new[$module_name]['SUB_YOUR_EMAIL'].":</strong></td><td width='40%'><input type='text' name='user_email' value='" . $email . "' size='40'></td></tr>\n";
  		echo "<tr><td width='40%'><strong>".$lang_new[$module_name]['SUB_YOUR_IP'].":</strong></td><td width='40%'>" . $ip . "</td></tr>\n";
		
		echo "<tr><td align='center' colspan='2'><input type='submit' value='".$lang_new[$module_name]['SUB_YOUR_SITE']."'></td></tr>\n";
		echo "</form></table>\n";
			
		
		//echo $sname;
	
	CloseTable();
	
?>