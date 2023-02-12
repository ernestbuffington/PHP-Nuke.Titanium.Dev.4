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

global $prefix, $config, $admin_file, $directory_mode;

$config = $db->sql_ufetchrow("SELECT * FROM ".$prefix."_link_us_config LIMIT 0,1 ");

if($config['button_method'] == 0){		
    if (!file_exists($config['upload_file'])) {
      if (!@mkdir($config['upload_file'], $directory_mode)) {
          @mkdir($config['upload_file'], $directory_mode);
      }
    }
		
		if (check_image_type($_FILES['site_image']['type']) == false){ echo $lang_new[$module_name]['ERROR']; }
		if (move_uploaded_file($_FILES['site_image']['tmp_name'], $config['upload_file'] . $_FILES['site_image']['name'])) {
			$img_upload = $config['upload_file'].$_FILES['site_image']['name'];
		}
		} else {
  			$img_upload = $site_image;
		}
		
		$result = $db->sql_query("INSERT INTO ".$prefix."_link_us(`id`, 
		                                                   `site_name`, 
														    `site_url`, 
														  `site_image`, 
													`site_description`, 
													       `site_hits`, 
														 `site_status`, 
														  `date_added`, 
														 `button_type`, 
														     `user_id`, 
														   `user_name`, 
														  `user_email`, 
														     `user_ip`) 
		
		    VALUES (NULL, 
		'".$site_name."', 
		'".$site_url."', 
		'".$img_upload."', 
		'".$site_description."', 
		'".$site_hits."', 
		'".$site_status."', 
		'".$date_added."', 
		'".$button_type."', 
		'".$user_id."', 
		'".$user_name."', 
		'".$user_email."', 
		'".$user_ip."')");
		
		if($another_button == 1){
    		redirect($admin_file.'.php?op=add_button');
		} else {
    		redirect($admin_file.'.php?op=link_us');
		}
