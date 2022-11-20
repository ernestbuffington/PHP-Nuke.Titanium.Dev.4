<?php 
if (!defined('MODULE_FILE')) { 
$back = "<script>history.go(-1);</script>";
print_r($back);	
}           
#################################################[ SandBox Example Source Code ]###########################################################################################

                                                                            ######################################################################################################
                                                                            # $module is defined in the module index.php file and can be found in modules/SandBox/index.php #
# set the current file name!                                                ########################################################## ###########################################
$current_file_name = basename(__FILE__, '.php');                                                                                     # #
                                                                                                                                     # #
$page_header  = '<div align="center"><h2>Loading JQuery and Bootstrap into the current module for editing and testing...</h2></div>';# #
$page_header .= '<div align="center"><h1>If you are logged in via FTP the current file location is: /public_html/modules/'.$module.'/'.$current_file_name.'.php<h1></div>';
$page_header .= '<div align="center">It is always a great idea to leave yourself notes like this, it will help you find the file you need!</div>';

$page_header .= "<a class=\"sourceview\" href=\"#\" onClick = \"tag=this.nextElementSibling; tag.style.display=tag.style.display == 'none' ? 'block':'none'\"><strong>Click here to show | hide source code</strong></a>";
$page_header .= "<div id=\"php_source\" style=\"display:none\">";

print_r($page_header);

OpenTableCode();
highlight_file("modules/Titanium_SandBox/x-bootstrap_4_modal.php");
CloseTableCode();

$page_header2 = "</div><hr />";
#################################################[ SandBox Example Source Code ]###########################################################################################
# TEST CODE GOES HERE - START
###########################################################################################################################################################################

# Load the header tags so the browser stays out of quirk mode OPEN TAG
$page_header2 .= "<head>";

# load the style sheet for this template
$page_header2 .= "<link rel=\"StyleSheet\" href=\"modules/Titanium_SandBox/css/x-bootstrap_4_modal.css\" type=\"text/css\">\n\n\n";

# Using jQuery 3.6.1 installed locally on your server:
# This config assumes you have jquery installed to your dev_includes folder which resides off of the root of your portal
# /public_html/dev_includes/dev_includes/jquery/jquery.js
$page_header2 .= "<script src=\"".HTTPS."assets/jquery/jquery.js\"></script>\n";

# Using Bootstrap 5.2 installed locally on your server:
# This config assumes you have bootstrap installed to your dev_includes folder which resides off of the root of your portal
# /public_html/dev_includes/bootstrap/js/bootstrap.min.js
$page_header2 .= "<script src=\"".HTTPS."assets/bootstrap/js/bootstrap.min.js\"></script>\n";

# Load the header tags so the browser stays out of quirk mode CLOSE TAG
$page_header2 .= "</head>";

# Check to see if Jquery is working START
$page_header2 .= "<script>$(function() { alert('JQuery is loaded and working fine!') })</script>\n";
# Check to see if Jquery is working END

print_r($page_header2);

$page_body = "<li>Using jQuery 3.6.1 installed locally on your server:<br />";
$page_body .= "<li>This config assumes you have jquery installed to your dev_includes folder which resides off of the root of your portal<br />";
$page_body .= "<li>/public_html/dev_includes/jquery/jquery.js<br />";
$page_body .= "<hr />";

$page_body .= "<li>Using Bootstrap 5.2 installed locally on your server:<br />";
$page_body .= "<li>This config assumes you have bootstrap installed to your dev_includes folder which resides off of the root of your portal<br />";
$page_body .= "<li>/public_html/dev_includes/bootstrap/js/bootstrap.min.js<br />";
$page_body .= "<br />";

?>


<?
print_r($page_body);
###########################################################################################################################################################################			
# TEST CODE GOES HERE - END
#################################################[ SandBox Example Source Code ]###########################################################################################
$phpbb2_end_of_page = "<hr /></fieldset>";
print_r($phpbb2_end_of_page); 
#################################################[ SandBox Example Source Code ]###########################################################################################
?> 
