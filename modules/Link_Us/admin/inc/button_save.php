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

global $pnt_prefix, $config, $admin_file, $directory_mode;

$config = $pnt_db->sql_ufetchrow("SELECT * FROM ".$pnt_prefix."_link_us_config LIMIT 0,1");

if($config['button_method'] == 0){		
    if (!file_exists($config['upload_file'])) {
      if (!@mkdir($config['upload_file'], $directory_mode)) {
          @mkdir($config['upload_file'], $directory_mode);
      }
    }
		
		if (check_image_type($_FILES['site_image']['type']) == false){ echo $lang_new[$pnt_module]['ERROR']; }
		if (move_uploaded_file($_FILES['site_image']['tmp_name'], $config['upload_file'] . $_FILES['site_image']['name'])) {
			$img_upload = $config['upload_file'].$_FILES['site_image']['name'];
		}
		} else {
  			$img_upload = $site_image;
		}
		
		//$result = $pnt_db->sql_query("INSERT INTO `".$pnt_prefix."_link_us`(`id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added`, `button_type`) VALUES (NULL, '".$site_name."', '".$site_url."', '".$img_upload."', '".$site_description."', '0', '1', '".$date_added."', '".$button_type."')");
		$result = $pnt_db->sql_query("INSERT INTO `".$pnt_prefix."_link_us`(`id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added`, `button_type`, `user_id`, `user_name`, `user_email`, `user_ip`) VALUES (NULL, '".$site_name."', '".$site_url."', '".$img_upload."', '".$site_description."', '".$site_hits."', '".$site_status."', '".$date_added."', '".$button_type."', '".$pnt_user_id."', '".$pnt_user_name."', '".$pnt_user_email."', '".$pnt_user_ip."')");
		
		if($another_button == 1){
    		redirect_titanium($admin_file.'.php?op=add_button');
		} else {
    		redirect_titanium($admin_file.'.php?op=link_us');
		}

?>