<?php 
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
    global $facebook_plugin_width; //used to set the deafult width of iframes and tables
    $get_open_base_dir = ini_get("open_basedir");
	if(empty($get_open_base_dir)):
	print "ini_get 'open_basedir' Failed";
	else:
	echo ini_get("open_basedir");    
	endif;
	
	OpenTable();
    echo '<center>';
    echo $domain;
	echo " this is \$domain";
	echo "<br>";
	echo $nukeurl;
	echo " this is \$nukeurl";
	echo '</center>';
	CloseTable();
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
