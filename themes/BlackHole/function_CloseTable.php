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
  print '</td>';
  print '</tr>';
  print '</table>';
  print '</td>';

  print '<td class="table1_width_definedRSM">'."\n";
  print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/right_side_middle_151515.png" width="39px" height="3px"></td>'."\n";

  print '</tr>'."\n";
  print '</table>'."\n";
  print '</td>'."\n";
  print '</tr>'."\n";
  print '<tr>'."\n";

  print '<td class="tableSB_width_definedLT">'."\n";
  print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/bottom_left_corner.png" width="39px" height="50px"></td>'."\n";

  print '<td class="table1_width_definedBM"></td>'."\n";

  print '<td class="tableSB_width_definedRT">'."\n";
  print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/bottom_right_corner.png" width="39px" height="50px"></td>'."\n";

  print '</tr>'."\n";
  print '</table>'."\n";
	
  print '<div align="center" style="padding-top:6px;">'."\n";
  print '</div>'."\n";
  echo "<!-- function_CloseTable END -->\n\n\n";
}

?>
