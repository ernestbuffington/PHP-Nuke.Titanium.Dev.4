<?php 
if (!defined('MODULE_FILE')) { 
    Header("Location: /index.php");
	exit();
}           
#################################################[ SandBox Example Source Code ]###########################################################################################

                                                                 ######################################################################################################
                                                                 # $module_name is defined in the module index.php file and can be found in modules/SandBox/index.php #
# set the current file name!                                     ########################################################## ###########################################
$current_file_name = basename(__FILE__, '.php');                                                                          # #
                                                                                                                          # #
print '<div align="center"><h2>Loading JQuery and Bootstrap into the current module for editing and testing...</h2></div>';# #
print '<div align="center"><h1>If you are logged in via FTP the current file location is: /public_html/modules/'.$module_name.'/'.$current_file_name.'.php<h1></div>';
print '<div align="center">It is always a great idea to leave yourself notes like this, it will help you find the file you need!</div>';

print "<a class=\"sourceview\" href=\"#\" onClick = \"tag=this.nextElementSibling; tag.style.display=tag.style.display == 'none' ? 'block':'none'\"><strong>Click here to show | hide source code</strong></a>";
print "<div id=\"php_source\" style=\"display:none\">";
OpenTableCode();
highlight_file("modules/Titanium_SandBox/x-bootstrap_4_modal.php");
CloseTableCode();
print "</div><hr />";
#################################################[ SandBox Example Source Code ]###########################################################################################
# TEST CODE GOES HERE - START
###########################################################################################################################################################################

# Load the header tags so the browser stays out of quirk mode OPEN TAG
print "<head>";

# load the style sheet for this template
print "<link rel=\"StyleSheet\" href=\"modules/Titanium_SandBox/css/x-bootstrap_4_modal.css\" type=\"text/css\">\n\n\n";

# Using jQuery 3.6.1 installed locally on your server:
# This config assumes you have jquery installed to your dev_includes folder which resides off of the root of your portal
# /public_html/dev_includes/dev_includes/jquery/jquery.js
print "<script type=\"text/javascript\" language=\"javascript\" src=\"".HTTPS."dev_includes/jquery/jquery.js\"></script>\n";

# Using Bootstrap 5.2 installed locally on your server:
# This config assumes you have bootstrap installed to your dev_includes folder which resides off of the root of your portal
# /public_html/dev_includes/bootstrap/js/bootstrap.min.js
print "<script type=\"text/javascript\" language=\"javascript\" src=\"".HTTPS."dev_includes/bootstrap/js/bootstrap.min.js\"></script>\n";

# Load the header tags so the browser stays out of quirk mode CLOSE TAG
print "</head>";

# Check to see if Jquery is working START
print "<script type=\"text/javascript\" language=\"javascript\">$(function() { alert('JQuery is loaded and working fine!') })</script>\n";
# Check to see if Jquery is working END


print "<li>Using jQuery 3.6.1 installed locally on your server:<br />";
print "<li>This config assumes you have jquery installed to your dev_includes folder which resides off of the root of your portal<br />";
print "<li>/public_html/dev_includes/jquery/jquery.js<br />";
print "<hr />";

print "<li>Using Bootstrap 5.2 installed locally on your server:<br />";
print "<li>This config assumes you have bootstrap installed to your dev_includes folder which resides off of the root of your portal<br />";
print "<li>/public_html/dev_includes/bootstrap/js/bootstrap.min.js<br />";
print "<br />";

?>


<?

###########################################################################################################################################################################			
# TEST CODE GOES HERE - END
#################################################[ SandBox Example Source Code ]###########################################################################################
print "<hr /></fieldset>"; 
#################################################[ SandBox Example Source Code ]###########################################################################################
?> 
