<?php 
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################
print "<a href=\"#\" onClick = \"tag=this.nextElementSibling; tag.style.display=tag.style.display == 'none' ? 'block':'none'\"><strong>Click here to show | hide source code</strong></a>";
print "<div id=\"php_source\" style=\"display:none\">";
OpenTableCode();
highlight_file("modules/Titanium_SandBox/x-php5_audiotag_example.php");
CloseTableCode();
print "</div><hr />";
###########################################################################################################################################################################
# TEST CODE GOES HERE - START
############################################################################################################################################################################

OpenTableFancy();
echo "<b><font color=white>Honeymoon Suite -Take My Hand</font></b><br /><br />";
echo "<audio width=\"$facebook_plugin_width\" controls=\"true\" src=\"modules/Titanium_SandBox/songs/take-my-hand.ogg\"><b>Your browser does not support the audio tag.</b></audio>";
echo "<br /><br />";
	
echo "<b><font color=white>Ozzy Osbourne -Tomorrow</font></b><br /><br />";
echo "<audio width=\"$facebook_plugin_width\" controls=\"true\" src=\"modules/Titanium_SandBox/songs/tomorrow.ogg\"><b>Your browser does not support the audio tag.</b></audio>";
echo "<br /><br />";


echo "<b><font color=white>Meat Loaf - Life Is A Lemon And I Want My Money Back (Remix)</font></b><br /><br />";
echo "<audio width=\"$facebook_plugin_width\" controls=\"true\" src=\"modules/Titanium_SandBox/songs/lemon.ogg\"><b>Your browser does not support the audio tag.</b></audio>";
echo "<br /><br /><br /><br />";
CloseTableFancy();
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
echo "<hr /></fieldset>"; # This stays at is part of the SandBox
############################################################################################################################################################################
?> 
