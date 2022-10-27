<?php 
#-----------------------------#
# Fixed & Full Width Style    #
#-----------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

global $customlang, 
        $ThemeInfo, 
		  $banners, 
	   $theme_name;
// uncomment to add right blocks when in admin panel
//if(blocks_visible('right') && !defined('ADMIN_FILE')):
global 
	   $index,
	 $opacity, 
	    $user, 
	 $banners, 
	  $cookie, 
         $dbi, 
		  $db, 
	   $admin, 
   $adminmail, 
  $total_time, 
  $start_time, 
       $foot1, 
	   $foot2, 
	   $foot3, 
	   $foot4,
	   $foot5, 
	 $nukeurl, 
	      $ip, 
  $theme_name, 
   $ThemeInfo,
    $bgcolor4,
      $prefix;
if(blocks_visible('right')) 
{
  echo "</td>\n";
  echo "<td style=\"width: 5px;\" valign=\"top\"><img src=\"themes/".$theme_name."/images/FOOTER/invisible_pixel.gif\" alt=\"\" width=\"5\" height=\"1\" /></td>\n";
  echo "<td style=\"width: 170px;\" valign=\"top\">\n";
  blocks('right');
}
echo "</td>\n";
echo "<td valign=\"top\"></td>\n";
echo "</tr>\n";
echo "</table>\n\n\n";
print '<table style="opacity: '.$opacity.';" cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";
print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";
print '<td align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/top_middle_piece.png);"></td>'."\n";
print '<td align="right" width="39">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";
print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";
print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/left_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";
print '<td width="100%">'."\n";
print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";
echo "<!-- Top Footer END -->\n\n\n\n\n";
echo '<div align="center">';
footmsg();
echo '</div>'; 
echo '<div align="center" style="padding-top:5px;">';
echo '</div>';
print '</td>';
print '</tr>';
print '</table>';
print '</td>';
print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";
print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";
print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";
print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/bottom_middle_piece.png"></td>'."\n";
print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/FOOTER/invisible_pixel.gif);">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/FOOTER/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";
print '</tr>'."\n";
print '</table>'."\n";
echo '</td>';
echo '</tr>';
echo '</table>';
echo '</td>';
echo '</tr>';
echo '</table>';
?>
