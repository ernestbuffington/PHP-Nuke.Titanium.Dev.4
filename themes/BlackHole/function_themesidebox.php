<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* Theme SideBox
/*--------------------------*/
function themesidebox($title, $content, $bid = 0) 
{
echo "<!-- START function themesidebox -->\n\n";	
# This stays no matter what START
# check for invisible facebook blocks START
# we do not draw tables fo invisible facebook blocks!
global $invisble_facebook_block;
if ($invisble_facebook_block == true):
 echo $content;
 $invisble_facebook_block =  false;
else:
# check for invisible facebook blocks END
# This stays no matter what END
#
#
#
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################

# Top of center table START (this is where you edit for each theme design)
global $theme_name, $side_block_width, $bgcolor4;	
# top half of center table START
print '<table class="tableSB_width_defined" width="'.$side_block_width.'">'."\n";
# invisble image spacer for top right table image!
print '<tr><td class="tableSB_width_definedLT">'."\n";
# top left corner of center table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/SIDEBLOCKS/top_left_corner.png" width="39px" height="50px"></td>'."\n";
# top middle piece for center table
print '<td class="tableSB_width_definedTM"><br><strong>'.$title.'</strong></td>'."\n";

print '<td align="right" width="39">'."\n";
# top right corner of center table
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/SIDEBLOCKS/top_right_corner_10.png" width="39px" height="50px"></td>'."\n";
print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table class="table100">'."\n";
print '<tr>'."\n";
# table left middle side
print '<td class="tableSB_width_definedLSM">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/left_side_middle_151515.png" width="39px" height="3px"></td>'."\n";
print '<td width="100%">'."\n";
# Top of center table END  (this is where you edit for each theme design)

#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#
#
#
#
# This stays no matter what START ---------------------------------------------------------------------------------------------------------------------------------

echo "\n<!-- SIDEBOX CONTENT START -->\n";
print '<table class="table100">'."\n";
print '<tr>'."\n";
print '<td width="100%" style="background-color:'.$bgcolor4.'">'."\n";

echo '<div align="left" id="text" style="padding-top:6px;">';
echo ''.$content.'</div>';
echo '<div align="left" id="text" style="padding-top:6px;">';
echo '</td>';

print '</td>';
print '</tr>';
print '</table>';
echo "\n\n<!-- SIDEBOX CONTENT END -->\n\n";

# This stays no matter what END	---------------------------------------------------------------------------------------------------------------------------------
#
#
#
#
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################

# bottome of center table START (this is where you edit for each theme design)
print '</td>';
print '<td class="tableSB_width_definedRSM">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/SIDEBLOCKS/right_side_middle_151515.png" width="39px" height="3px"></td>'."\n";
print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td class="tableSB_width_definedRT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/SIDEBLOCKS/bottom_left_corner.png" width="39px" height="50px"></td>'."\n";

print '<td class="tableSB_width_definedBM"></td>'."\n";

print '<td class="tableSB_width_definedRT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/SIDEBLOCKS/bottom_right_corner.png" width="39px" height="50px"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
# bottome of center table END (this is where you edit for each theme design)

#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#################################################################################################################################################################
#
#
#
#
#
#
# This stays no matter what START ---------------------------------------------------------------------------------------------------------------------------------	
# check for invisible facebook blocks START
endif;
# check for invisible facebook blocks END

# This sets the space between center tables listed START
print '<div align="center" style="padding-top:6px;">';
print '</div>';
# This sets the space between center tables listed END -------------------------------------------------------------------------------------------------------------
# This stays no matter what END	
echo "<!-- END function themesidebox -->\n\n";	
}

?>
