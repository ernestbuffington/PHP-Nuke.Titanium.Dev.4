<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/



if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Close the open table
CloseTable();
//echo '<br />';
//Start a new table
OpenTable();


/*==============================================================================================
    Function:    view_display()
    In:          $page
                    Passed in page number
    Return:      N/A
    Notes:       Displays the donations
================================================================================================*/
function view_display ($page=0) {
    global $gen_configs, $page_configs, $donations, $lang_donate, $dis, $admin_file;
    $currency_code = get_currency_code();
    OpenTable();
    $page_configs['num_donations'] = 25;
    echo "<table width=\"55%\" border=\"0\" style=\"margin: auto\">\n";
    echo "<tr>\n";
    $width = '70';
    echo "<td width=\"17%\"><div align=\"center\"><strong>".$lang_donate['DATE']."</strong></div></td>\n";
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
            $pop = '';
            if (!empty($donator['msg'])) {
                $pop = make_help_popup($donator['msg'], $lang_donate['MESSAGE']);
            }
            echo "<tr ".$pop.">\n";
            echo "<td><div align=\"center\">".date($gen_configs['date_format'],$donator['dondate'])."</div></td>\n";
                if (empty($donator['uname']) || $donator['donshow'] == 0) {
                    echo "<td><div align=\"center\">".$lang_donate['TYPE_ANON']."</div></td>\n";
                } else {
                    echo "<td><div align=\"center\">".UsernameColor(trim($donator['uname']))."</div></td>\n";
                }
                echo "<td><div align=\"center\">".$currency_code.sprintf('%.2f',$donator['donated'])."</div></td>\n";
                $total += floatval($donator['donated']);
            echo "</tr>\n";
        }
        $date_spacer = '';
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
            $prev = '<strong><a href="'.$admin_file.'.php?op=Donations&amp;file=current&amp;page='.$prev_page.'">'.$lang_donate['PREV_DIRECTION'].$lang_donate['PREV'].'</a></strong>';
        } else {
            $prev = $lang_donate['PREV_DIRECTION'].$lang_donate['PREV'];
        }
        //Setup the next link and text
        if ($stop != sizeof($donations)) {
            $next_page = $page + 1;
            $next = '<strong><a href="'.$admin_file.'.php?op=Donations&amp;file=current&amp;page='.$next_page.'">'.$lang_donate['NEXT'].$lang_donate['NEXT_DIRECTION'].'</a></strong>';
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
    global $lang_donate,$admin_file;
    OpenTable();
    echo "<table width=\"55%\" border=\"1\" align=\"center\">\n";
    echo "<tr>\n<td align=\"center\">\n<a href=\"".$admin_file.".php?op=Donations&amp;file=current&amp;dis=total\">".$lang_donate['TOTAL']."</a>\n</td>\n";
    echo "<td align=\"center\">\n<a href=\"".$admin_file.".php?op=Donations&amp;file=current&amp;dis=goal\">".$lang_donate['GOAL']."</a>\n</td>\n</tr>\n";
    echo "</table>\n";
    CloseTable();
}

/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

view_display_links();
//echo "<br />";

//Get values
global $donations, $gen_configs;

if(!isset($dis))
$dis = 0;

if(!isset($page))
$page = 69;

$gen_configs = get_gen_configs();
$donations = ($dis == 'goal') ? get_donations_goal() : get_donations();
//Display donations
view_display($page);
?>