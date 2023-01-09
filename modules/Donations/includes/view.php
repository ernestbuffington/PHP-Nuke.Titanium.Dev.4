<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $_GETVAR;
$_GETVAR->unsetVariables();

//Display the page title
donation_title();

/*==============================================================================================
    Function:    view_display()
    In:          $page
                    Passed in page number
    Return:      N/A
    Notes:       Displays the donations
================================================================================================*/
function view_display ($page=0) {
    global $gen_configs, $page_configs, $donations, $lang_donate, $dis;

    $currency_code = get_currency_code();
    OpenTable();
    if (!empty($page_configs['header_image'])) {
        echo "<div class=\"acenter\">\n";
        echo "<img src=\"".$page_configs['header_image']."\" alt=\"\" border=\"0\">\n";
        echo "</div>\n";
    }
    //Set table size depending on if we are showing the date or not
    if ($page_configs['show_dates'] == 'yes') {
        echo "<table width=\"55%\" border=\"0\" style=\"margin: auto;\">\n";
    } else {
        echo "<table width=\"35%\" border=\"0\" style=\"margin: auto;\">\n";
    }
    echo "<tr>\n";
    //Show date title if dates are on or off
    if ($page_configs['show_dates'] == 'yes') {
        $width = '70';
        echo "<td width=\"17%\"><div align=\"center\"><strong>".$lang_donate['DATE']."</strong></div></td>\n";
    } else {
        $width = '87';
    }
    //Display username and amount title
    echo "<td width=\"".$width."%\"><div align=\"center\"><strong>".$lang_donate['USERNAME']."</strong></div></td>";
    echo "<td width=\"13%\"><div align=\"center\"><strong>".$lang_donate['AMOUNT']."</strong></div></td>";
    echo "</tr>\n";
    $total = 0;
    //Setup the for start and stop points
    $start = $page * $page_configs['num_donations'];
    $stop = ($page+1) * $page_configs['num_donations'];

    if (is_array($donations)):

	    if ($stop > sizeof($donations)) 
	    {
	        $stop = sizeof($donations);
	        if ($page == 0) 
	        {
	            //If there is only one page make the next and previous disappear
	            $no_next_prev = 1;
	        }
	    }
	    //Loop through the donation array
	    for ($i=$start; $i < $stop; $i++) {
	        //Set donator = to the current donation in the array
	        $donator = $donations[$i];
	        echo "<tr>\n";
	            if ($page_configs['show_dates'] == 'yes') {
	                if (empty($donator['dondate'])) {
	                    $date = '??/??/????';
	                } else if (!strpos($donator['dondate'], '/')){
	                    $date = date($gen_configs['date_format'],$donator['dondate']);
	                } else {
	                    $date = $donator['dondate'];
	                }
	                $date = ($date == '12/31/1969') ? $donator['dondate'] : $date;
	                echo "<td><div align=\"center\">".$date."</div></td>\n";
	            }
	            if (empty($donator['uname']) || $donator['donshow'] == 0) {
	                echo "<td><div align=\"center\">".$lang_donate['TYPE_ANON']."</div></td>\n";
	            } else {
	                echo "<td><div align=\"center\">".UsernameColor(trim($donator['uname']))."</div></td>\n";
	            }
	            if ($page_configs['show_amount'] == 'yes') {
	                echo "<td><div align=\"center\">".$currency_code.sprintf('%.2f',$donator['donated'])."</div></td>\n";
	            } else {
	                echo "<td><div align=\"center\">".$lang_donate['N/A']."</div></td>\n";
	            }
	            $total += floatval($donator['donated']);
	        echo "</tr>\n";
	    }

	    if ($page_configs['show_dates'] != 'yes') {
	        $date_spacer = '';
	    } else {
	        $date_spacer = "<td width=\"17%\">&nbsp;</td>\n";
	    }
	    echo "<tr>\n<td colspan=\"2\">\n<hr />\n</td>\n</tr>\n";
	    if ($stop == sizeof($donations)) {
	        echo "<tr>\n";
	             echo $date_spacer;
	             echo "<td><div align=\"right\"><strong>".$lang_donate['TOTAL'].$lang_donate['BREAK']."</strong></div></td>";
	             echo "<td><div align=\"center\">".$currency_code.sprintf('%.2f',$total)."</div></td>";
	        echo "</tr>\n";
	        if ($dis == 'goal') {
	            echo "<tr>\n";
	                 echo $date_spacer;
	                 echo "<td><div align=\"right\"><strong>".$lang_donate['GOAL'].$lang_donate['BREAK']."</strong></div></td>";
	                 echo "<td><div align=\"center\">".$currency_code.sprintf('%.2f',$gen_configs['monthly_goal'])."</div></td>";
	            echo "</tr>\n";
	            $diff = floatval($gen_configs['monthly_goal']) - $total;
	            $diff = sprintf('%.2f',$diff);
	            echo "<tr>\n";
	                 echo $date_spacer;
	                 echo "<td><div align=\"right\"><strong>".$lang_donate['DIFF'].$lang_donate['BREAK']."</strong></div></td>";
	                 echo "<td><div align=\"center\">".$currency_code.$diff."</div></td>";
	            echo "</tr>\n";
	        }
	    }
	    //Setup previous link and text
	    if ($page != '0') {
	        $prev_page = $page - 1;
	        $prev = '<strong><a href="modules.php?name=Donations&op=view&page='.$prev_page.'">'.$lang_donate['PREV_DIRECTION'].$lang_donate['PREV'].'</a></strong>';
	    } else {
	        $prev = $lang_donate['PREV_DIRECTION'].$lang_donate['PREV'];
	    }
	    //Setup the next link and text
	    if ($stop != sizeof($donations)) {
	        $next_page = $page + 1;
	        $next = '<strong><a href="modules.php?name=Donations&op=view&page='.$next_page.'">'.$lang_donate['NEXT'].$lang_donate['NEXT_DIRECTION'].'</a></strong>';
	    } else {
	        $next = $lang_donate['NEXT'].$lang_donate['NEXT_DIRECTION'];
	    }
	    //Show the next and previous if needed
	    if (!isset($no_next_prev)) {
	        echo "<tr><td colspan=\"3\">\n<div align=\"center\">\n";
	        echo $prev.'&nbsp;'.$lang_donate['BREAK'].'&nbsp;'.$next;
	        echo "</div>\n</td></tr>\n";
	    }

	endif;
    echo "</table>";
    CloseTable();
}

/*==============================================================================================
    Function:    display()
    In:          $page
                    Passed in page number
    Return:      N/A
    Notes:       Displays the donations
================================================================================================*/

function view_display_links () {
    global $lang_donate, $gen_configs;

    OpenTable();
    echo '<table width="35%" border="1" style="margin: auto">';
    echo '  <tr>';
    echo '    <td style="width: 50%"><span class="tooltip-html" title="'.$lang_donate['HELP_TOTAL'].'"><a href="modules.php?name=Donations&amp;op=view&amp;dis=total">'.$lang_donate['TOTAL'].'</a></span></td>';
    echo '    <td style="width: 50%"><span class="tooltip-html" title="'.$lang_donate['HELP_GOAL'].'"><a href="modules.php?name=Donations&amp;op=view&amp;dis=goal">'.$lang_donate['GOAL'].'</a></span></td>';
    echo '  </tr>';
    echo '</table>';

    if (!empty($gen_configs['codes'])) {
        echo "<br /><br />";

        $codes = $gen_configs['codes'];
        $codes = str_replace("\r\n", "\n", $codes);
        $codes = explode("\n", $codes);
        echo "<table width=\"55%\" border=\"1\" align=\"center\">\n";
        echo "<tr>";
        for ($i=1, $maxi=count($codes); $i < $maxi; $i=$i+2) {
            $j = $i - 1;
            echo "<td align=\"center\">\n<a href=\"modules.php?name=Donations&amp;op=view&amp;dis=".$codes[$i]."\"> ".$codes[$j]."</a>\n</td>\n";
        }
        echo "</tr>\n";
        echo "</table>\n";
    }
    CloseTable();
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//Get values
global $gen_configs, $page_configs, $donations;
$page_configs = get_page_configs();
$gen_configs = get_gen_configs();
view_display_links();

$page = $_GETVAR->get('page', 'GET', 'int');
$dis = $_GETVAR->get('dis', 'GET');

//echo "<br />";
if ($dis == 'goal') {
    $donations = ($page_configs['show_anon_amount'] == 'yes') ? get_donations_goal() : get_donations_goal_no_anon();
} else if (empty($dis) || $dis == 'total') {
    $donations = ($page_configs['show_anon_amount'] == 'yes') ? get_donations() : get_donations_no_anon();
} else {
   //Look for . / \ and kick it out
    if (preg_match('/.*?(\/|\.|\\\)/i',$dis)) {
        DisplayError($lang_donate['ACCESS_DENIED']);
    }
    $dis = Fix_Quotes($dis);
    $donations = ($page_configs['show_anon_amount'] == 'yes') ? get_donations($dis) : get_donations_no_anon($dis);
}
//Display donations
view_display($page);
?>