<?php  
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
    global $facebook_plugin_width; //used to set the deafult width of iframes and tables
	OpenFancyTable();
	echo "<b>Parse the Mobile ID's at http://www.zytrax.com/tech/web/mobile_ids.html</b><br><br>";
    $page = file_get_contents('http://www.zytrax.com/tech/web/mobile_ids.html');
    preg_match_all('/<(p) class="g-c-[ns]"[^>]*>(.*?)<\/p>/s', $page, $m); 

    $agents = array();
    foreach($m[2] as $agent) 
	{
      $split = explode("<br>\n", trim($agent));
    
	   foreach($split as $item) 
	   {
         $agents[] = trim($item);
       }
    }
    // $agents now holds every user agent string, one per array index, trimmed
    foreach($agents as $agent) 
	{
      echo($agent."<br>\n");
    }
	CloseTable3();
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
