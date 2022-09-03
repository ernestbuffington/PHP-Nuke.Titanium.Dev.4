<?php  
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################
print "<a href=\"#\" onClick = \"tag=this.nextElementSibling; tag.style.display=tag.style.display == 'none' ? 'block':'none'\"><strong>Click here to show | hide source code</strong></a>";
print "<div id=\"php_source\" style=\"display:none\">";
OpenTableCode();
highlight_file("modules/Titanium_SandBox/x-file_get_contents_example.php");
CloseTableCode();
print "</div><hr />";
###########################################################################################################################################################################
# TEST CODE GOES HERE - START
############################################################################################################################################################################


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

############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
echo "</fieldset>"; # This stays at is part of the SandBox
############################################################################################################################################################################
?> 
