<?php 
#-----------------------------#
# Inferno Footer Section      #
#-----------------------------#
# Fixed & Full Width Style    #
#-----------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

global $customlang, 
        $ThemeInfo, 
		  $banners, 
	   $theme_name;

//if(blocks_visible('right') && !defined('ADMIN_FILE')):

echo '<!-- FOOTER START -->';
global 
	   $index, 
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
echo "<td style=\"padding-right: 6px;\" valign=\"top\"></td>\n"; # set the space between the right side of the main body table and the blocks
echo "</tr>\n";
echo "</table>\n\n";

echo "<!-- Top Footer START -->\n";
print '<div align="center" style="padding-top:20px;">';
OpenTable();
footmsg();
CloseTable();
echo '</div>';

echo '</td>'.PHP_EOL; # Middle Of The Page TEXT AREA

echo '   <td class="td746RT" ></td>'.PHP_EOL; # RIGHT SIDE

echo '   <td></td>'.PHP_EOL; # if height is changed in this TD it will lock the center tabled height
echo '  </tr>'.PHP_EOL;

echo '  <tr><!-- PHP-Carterfone row 6 -->'.PHP_EOL;
echo '   <td class="td65" colspan="3"></td>'.PHP_EOL; # BOTTOM ELFT CORNER

echo '   <td class="td1725" ></td>'.PHP_EOL;

echo '   <td class="td69" colspan="3"></td>'.PHP_EOL;

echo '   <td><img src="themes/'.$theme_name.'/blackjack/main_background/spacer.gif" width="1" height="83" alt=""></td>'.PHP_EOL;

echo '  </tr>'.PHP_EOL;

echo '<!-- This table was automatically created with PHP-Carterfone -->'.PHP_EOL;
echo '<!-- https://github.com/ernestbuffington/PHP-Carterfone -->'.PHP_EOL;
echo '</table>'.PHP_EOL;


# do not remove anything from here down when making a theme! The theme will not show up correctly

//echo '</tr>';            # opacity overlay table END (start is in theme header) 
//echo '</td>';            # opacity overlay table END (start is in theme header) 
//echo '</table>'.PHP_EOL; # opacity overlay table END (start is in theme header) 

echo '</div>'.PHP_EOL;
echo '</section>'.PHP_EOL;
echo '<!-- FOOTER END -->'.PHP_EOL.PHP_EOL;


?>
