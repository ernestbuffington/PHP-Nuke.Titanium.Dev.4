<?php 
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
    global $facebook_plugin_width; //used to set the deafult width of iframes and tables
    echo ini_get("open_basedir");    
	//OpenTable2();
    //echo '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';
	echo '<div align="center">';
	$newswf = new swfheader(false) ;
    $newswf->loadswf("modules/Titanium_SandBox/swf/theghost.swf") ;
    $newswf->display($trans);  
	echo '</div>';
	echo "</fieldset>"; 
	//CloseTable2();

############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
