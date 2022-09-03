<?php 
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################
print "<a href=\"#\" onClick = \"tag=this.nextElementSibling; tag.style.display=tag.style.display == 'none' ? 'block':'none'\"><strong>Click here to show | hide source code</strong></a>";
print "<div id=\"php_source\" style=\"display:none\">";
OpenTableCode();
highlight_file("modules/Titanium_SandBox/x-project_template.php");
CloseTableCode();
print "</div><hr />";
###########################################################################################################################################################################
# TEST CODE GOES HERE - START
############################################################################################################################################################################

    # SIMPLE TEST
	# START sample flash instance 9/5/2017
    print ini_get("open_basedir");    
	print '<div align="center">';
	$newswf = new swfheader(false);
    $newswf->loadswf("modules/Titanium_SandBox/swf/theghost.swf");
    $newswf->display($trans);  
	print '</div>';
	# END sample flash instance 9/5/2017


############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
echo "<hr /></fieldset>"; # This stays at is part of the SandBox
############################################################################################################################################################################
?> 
