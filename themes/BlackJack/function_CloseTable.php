<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;
#--------------------------#
# function CloseTable() 
#--------------------------#
function CloseTable() 
{
  global $theme_name, $title, $bgcolor1, $bgcolor2, $theme_name, $textcolor1, $textcolor2, $pagetitle; 
	
print '</div>';
print '<div align="center" style="padding:10px;"></div>';

}

?>
