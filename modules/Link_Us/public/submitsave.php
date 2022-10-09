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
 
	$site_name = strip_tags($site_name);
  	$site_name = htmlspecialchars($site_name);
  	$site_description = strip_tags($site_description);
  	$site_description = htmlspecialchars($site_description);
	
	if ((empty($site_name)) OR (empty($site_url)) OR (empty($site_description))) {
	
    include_once(NUKE_BASE_DIR.'header.php');
		OpenTable();
    		echo "<center><strong>" . $lang_new[$module_name]['SUB_MISSINGDATA'] . "</strong></center><br />\n";
    		echo "<center>" . _GOBACK . "</center>\n";
    	CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
	
	}
	
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
		
		$result = $db->sql_query("INSERT INTO `".$prefix."_link_us`(`id`, `site_name`, `site_url`, `site_image`, `site_description`, `site_hits`, `site_status`, `date_added`, `button_type`, `user_id`, `user_name`, `user_email`, `user_ip`) VALUES (NULL, '".$site_name."', '".$site_url."', '".$img_upload."', '".$site_description."', '".$site_hits."', '".$site_status."', '".$date_added."', '".$button_type."', '".$user_id."', '".$user_name."', '".$user_email."', '".$user_ip."')");
		
		if(!$result) {
    		include_once(NUKE_BASE_DIR.'header.php');
				OpenTable();
    				echo "<center><strong>" . $lang_new[$module_name]['SUB_ERROR'] . "</strong></center><br />\n";
    				echo "<center>" . _GOBACK . "</center>\n";
    			CloseTable();
    		include_once(NUKE_BASE_DIR.'footer.php');
   			exit;
  		} else {
    		$msg = $sitename.$lang_new[$module_name]['SUB_ADDED']."\n\n";
    		$msg .= $lang_new[$module_name]['SITE_NAME'].": ".Remove_Slashes($site_name)."\n";
    		$msg .= $lang_new[$module_name]['SITE_URL'].": ".Remove_Slashes($site_url)."\n";
    		$msg .= $lang_new[$module_name]['SITE_IMAGE'].": ".Remove_Slashes($imgurl)."\n";
    		$msg .= $lang_new[$module_name]['SITE_DESCRIPTION'].": ".Remove_Slashes($site_description)."\n";
    		$msg .= $lang_new[$module_name]['SUB_YOUR_ID'].": ".$user_id."\n";
    		$msg .= $lang_new[$module_name]['SUB_USERNAME'].": ".Remove_Slashes($user_name)."\n";
    		$msg .= $lang_new[$module_name]['SUB_EMAIL'].": ".Remove_Slashes($user_email)."\n";
    		$msg .= $lang_new[$module_name]['SUB_IP'].": ".$user_ip."\n";
    		$to = $adminmail;
    		$subject = $sitename.$lang_new[$module_name]['SUB_ADDED'];
    		$mailheaders = "From: ".$adminmail."\r\n";
    		$mailheaders .= "Reply-To: ".$adminmail."\r\n";
    		$mailheaders .= "Return-Path: ".$adminmail."\r\n";
    		evo_mail($to, $subject, $msg, $mailheaders);
			
			OpenTable();			
				header("Refresh: 4; url=modules.php?name=".$module_name."");
        		echo "<div align='center'>Site Button Submitted Successfully</div>";			
				echo "<br /><br />";			
				echo "<div align='center'>Please Wait...  Redirecting...</div>";
			CloseTable();
  }	

?>