<?php 
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}
#################################################[ SandBox Example Source Code ]###########################################################################################
print "<a href=\"#\" onClick = \"tag=this.nextElementSibling; tag.style.display=tag.style.display == 'none' ? 'block':'none'\"><strong>Click here to show | hide source code</strong></a>";
print "<div id=\"php_source\" style=\"display:none\">";
OpenTableCode();
highlight_file("modules/Titanium_SandBox/x-clean_slate_template.php");
CloseTableCode();
print "</div><hr />";
#################################################[ SandBox Example Source Code ]###########################################################################################
# TEST CODE GOES HERE - START
###########################################################################################################################################################################
    global $nukeurl;
    
	# start SIMPLE CODE TEST
	print '<div align="center"><h1>Hello World</h1></div>';
	
	# load the mobile detect system
	$detect = new Mobile_Detect;
    
	if ($detect->isMobile()) {
    $mobile_visitor_status = 'Mobile_Status';
	$mobile_visitor = 'true';

    }
	else
	{
        $mobile_visitor_status = 'Mobile_Status';
		$mobile_visitor = 'false';
	}
	
	//echo $mobile_visitor_status.': '.$mobile_visitor.'</br>';

    $cookie_name = $mobile_visitor_status;
    $cookie_value = $mobile_visitor;
    
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    if(count($_COOKIE) > 0) {
      echo "Cookies are enabled.<br>";
    } else {
      echo "Cookies are disabled.<br>";
    }
	
    if(!isset($_COOKIE[$cookie_name])) 
	{
      echo "Cookie named '" . $cookie_name . "' is not set!<br>";
    } 
	else 
	{
      echo "Cookie '" . $cookie_name . "' is set!<br>";
      echo "Value is: " . $_COOKIE[$cookie_name];
    }
	
	// Keep the value in $_SESSION for later use
    // and for optimizing the speed of the code.
    if(!$_SESSION['isMobile'])
	{
      $_SESSION['isMobile'] = $detect->isMobile();
    }
    # end SIMPLE CODE TEST
###########################################################################################################################################################################			
# TEST CODE GOES HERE - END
#################################################[ SandBox Example Source Code ]###########################################################################################
echo "<hr /></fieldset>"; 
#################################################[ SandBox Example Source Code ]###########################################################################################
?> 
