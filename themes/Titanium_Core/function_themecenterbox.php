<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;

/*--------------------------*/
/* Theme CenterBox 
/*--------------------------*/
function themecenterbox($title, $content) 
{
# This stays no matter what START --------------------------------------------------------------------------------------------------------------------------
# check for invisible facebook blocks START
# we do not draw tables fo invisible facebook blocks!
global $invisble_facebook_block;
if ($invisble_facebook_block == true):
echo $content;
$invisble_facebook_block =  false;
else:
# check for invisible facebook blocks END
# This stays no matter what END -----------------------------------------------------------------------------------------------------------------------------
#
#
#
######################################################################################
# Top of center table START (this is where you edit for each theme design)           # CUT START
######################################################################################

global $theme_name;	
global $bgcolor4;
# top half of center table START
print '<table class="table100">'."\n";

# top left corner of center table
print '<tr><td class="tableSB_width_definedLT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/top_left_corner.png" width="39px" height="50px"></td>'."\n";

# top middle piece for center table
print '<td class="tableCB_width_definedTM"><br><strong>'.$title.'</strong></td>'."\n";

# top right corner of center table
print '<td class="tableCB_width_definedRT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/top_right_corner_10.png" width="39px" height="50px"></td>'."\n";

print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";

print '<table class="table100">'."\n";
print '<tr>'."\n";

# table left middle side
print '<td class="tableCB_width_definedLSM">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/left_side_middle_151515.png" width="39px" height="3px"></td>'."\n";
print '<td width="100%">'."\n";
######################################################################################
# bottom half of center table END (this is where you edit for each theme design)     # CUT END
######################################################################################
#
#
#
# This stays no matter what START ------------------------------------------------------------------------------------------------------------------------------
echo "<!-- CONTENT START -->\n\n\n\n\n";
print '<table class="table100bg">'."\n";
print '<tr>'."\n";

print '<td width="100%">'."\n";
print '<div align="center">';

print '<table class="table100bg">';
print '<tbody>';
print '<tr>';
print '<td>';

echo '<div align="left" id="text">';
echo ''.$content.'';
print '</div>';

print '</td>';
print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';
echo "\n\n<!-- CONTENT END -->\n";
# This stays no matter what END	---------------------------------------------------------------------------------------------------------------------------------
#
#
#
######################################################################################
# bottome half of center table START (this is where you edit for each theme design)  # CUT START
######################################################################################
print '</td>';
print '</tr>';
print '</table>';

print '</td>';
print '<td class="tableCB_width_definedRSM">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/right_side_middle_151515.png" width="39px" height="3px"></td>'."\n";
print '</tr>'."\n";
print '</table>'."\n";

print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td class="tableCB_width_definedLT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/bottom_left_corner.png" width="39px" height="50px"></td>'."\n";

print '<td class="tableCB_width_definedBM"></td>'."\n";

print '<td class="tableCB_width_definedRT">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/CENTERBLOCKS/bottom_right_corner.png" width="39px" height="50px"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
######################################################################################
# bottome half of center table END (this is where you edit for each theme design)    # CUT END
######################################################################################
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
# This sets the space between center tables listed END 
 # This stays no matter what END ------------------------------------------------------------------------------------------------------------------------------------	
}

?>
