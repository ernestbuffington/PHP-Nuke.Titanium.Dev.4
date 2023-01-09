<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if(!defined('NUKE_EVO')) exit;

/*==============================================================================================
    Function:    donation_block_get_values()
    In:          N/A
    Return:      Array of the values from the DB.
    Notes:       Will toss a DonateError if the values are not found
================================================================================================*/
function donation_block_get_values() {
    global $db, $prefix, $lang_donate, $cache;
    static $block;
    if(isset($block) && is_array($block)) { return $block; }
    if (!($block = $cache->load('block', 'titanium_donations'))) {
        $sql = 'SELECT config_value, config_name from `'.$prefix.'_donators_config` WHERE config_name LIKE "block_%"';
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $block[str_replace('block_', '', $row['config_name'])] = $row['config_value'];
        }
        $cache->save('block', 'titanium_donations', $block);
        $db->sql_freeresult($result);
    }
    return $block;
}

/*==============================================================================================
    Function:    donation_block_gen_configs()
    In:          N/A
    Return:      An array of the current general settings
    Notes:       N/A
================================================================================================*/
function donation_block_gen_configs () {
    global $db, $prefix, $lang_donate, $cache;
    static $gen;
    if(isset($gen) && is_array($gen)) { return $gen; }
    if (!$gen = $cache->load('general', 'titanium_donations')) {
        $sql = 'SELECT config_value, config_name from `'.$prefix.'_donators_config` WHERE config_name LIKE "gen_%"';
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result)) {
            $gen[str_replace('gen_', '', $row['config_name'])] = $row['config_value'];
        }
        $db->sql_freeresult($result);
        $cache->save('general', 'titanium_donations', $gen);
    }
    return $gen;
}

/*==============================================================================================
    Function:    donation_block_get_currency_code()
    In:          N/A
    Return:      Returns the selected currency code
    Notes:       N/A
================================================================================================*/
function donation_block_get_currency_code () {
    global $block_gen_configs;
    switch ($block_gen_configs['currency']) {
        case 'USD':
            return "&#36;";
        break;
        case 'AUD':
            return "&#36;";
        break;
        case 'CAD':
            return "&#36;";
        break;
        case 'EUR':
            return "&euro;";
        break;
        case 'GBP':
            return "&pound;";
        break;
        case 'JPY':
            return "&yen;";
        break;
        default:
            return '';
        break;
    }
}

/*==============================================================================================
    Function:    donation_block_make_image_button()
    In:          N/A
    Return:      Either a submit button or an image button
    Notes:       N/A
================================================================================================*/
function donation_block_make_image_button () {
    global $block_block_configs;
    if (empty($block_block_configs['button_image'])) {
        return '<form action="modules.php?name=Donations&amp;op=make" method="post"><input type="submit" value="'._DONATE.'"></form>';
    } else {
        return '<form action="modules.php?name=Donations&amp;op=make" method="post"><input type="image" src="'.$block_block_configs['button_image'].'" name="submit"></form>';
    }
}

/*==============================================================================================
    Function:    donation_block_get_donations()
    In:          N/A
    Return:      An array of the current donations
    Notes:       N/A
================================================================================================*/
function donation_block_get_donations () {
    global $db, $prefix, $cache;
    $clear = $cache->load('donations_clear', 'titanium_donations');
    if(!isset($clear) || $clear <= time()) {
        $cache->delete('donations', 'titanium_donations');
        $cache->save('donations_clear', 'titanium_donations', strtotime("+1 Week"));
    }
    static $don;
    if (isset($don) && is_array($don)) { return $don; }

    if (!$don = $cache->load('donations', 'titanium_donations')) {
        $sql = 'SELECT * FROM `'.$prefix.'_donators` ORDER BY `id` DESC';
        $result = $db->sql_query($sql);
        $don = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
        $cache->save('donations', 'titanium_donations', $don);
    }
    return $don;
}

/*==============================================================================================
    Function:    donation_block_get_donations_goal()
    In:          N/A
    Return:      An array of the current donations
    Notes:       N/A
================================================================================================*/
function donation_block_get_donations_goal () {
    global $db, $prefix, $cache;
    static $don_goal;
    if (isset($don_goal) && is_array($don_goal)) { return $don_goal; }

    if (!$don_goal = $cache->load('donations_goal', 'titanium_donations')) {
        $sql = 'SELECT * FROM `'.$prefix.'_donators` WHERE MONTH(FROM_UNIXTIME(`dondate`)) = "'.date('n').'" AND YEAR(FROM_UNIXTIME(`dondate`)) = "'.date('Y').'"  ORDER BY `id` DESC';
        $result = $db->sql_query($sql);
        $don_goal = $db->sql_fetchrowset($result);
        $db->sql_freeresult($result);
        $cache->save('donations_goal', 'titanium_donations', $don_goal);
    }
    return $don_goal;
}


/*~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-~-*/

//Get globals
global $block_block_configs;
$block_block_configs = donation_block_get_values();
global $block_gen_configs;
$block_gen_configs = donation_block_gen_configs();
$currency_code = donation_block_get_currency_code();
$block_donations = ($block_block_configs['show_goal'] == 'yes') ? donation_block_get_donations_goal() : donation_block_get_donations();

$content = '';

//Start the table or scroll
if($block_block_configs['scroll'] == 'yes') {
    $content .= "<div style=\"overflow:auto; height:110px; width:100%\" align=\"center\">\n";
} else {
    $content = "<table width=\"100%\" border=\"0\" align=\"center\">\n";
}

//Get donations
$i = 1;
$total = 0;
if (is_array($block_donations))
{
    if (count($block_donations) >= 1) {
        foreach ($block_donations as $donator) {
            if ((empty($donator['uname']) || $donator['donshow'] == 0) && $block_block_configs['show_anon_amount'] == 'no') {
                continue;
            }
            if($block_block_configs['scroll'] == 'no') {
                $content .= "<tr><td align=\"center\">\n";
            }
            if ($block_block_configs['numbers'] == 'yes') {
                $content .= "<span style=\"font-weight: bold;\">";
                $content .= ($i < 10) ? '0'.$i : $i;
                $content .= "</span>-&nbsp;";
            }
            if (empty($donator['uname']) || $donator['donshow'] == 0) {
                $content .= _DONATE_ANON;
            } else {
                $content .= UsernameColor(trim($donator['uname']));
            }
            if ($block_block_configs['numbers'] == 'yes') {
                $content .= "<br />";
            } else {
                $content .= "&nbsp;-&nbsp;";
            }
            if ($block_block_configs['show_amount'] == 'yes') {
                $content .= $currency_code.sprintf('%.2f',$donator['donated']);
            }
            if ($block_block_configs['show_dates'] == 'yes') {
                if (!strpos($donator['dondate'], '/')){
                    if (is_numeric($donator['dondate'])) {
                        $date = date($block_gen_configs['date_format'],$donator['dondate']);
                    } else {
                        $date = $donator['dondate'];
                    }
                } else {
                    $date = $donator['dondate'];
                }
                $date = ($date == '12/31/1969') ? $donator['dondate'] : $date;
                $content .= "<br />".$date;
            }
            if($block_block_configs['scroll'] == 'no') {
                $content .= "</td></tr>\n";
            }
            $i++;
            if ($i > $block_block_configs['num_donations'] && $block_block_configs['show_goal'] == 'no') {
                break;
            } else {
                $total += floatval($donator['donated']);
            }
            if($block_block_configs['scroll'] == 'yes') {
                $content .= "<br /><br />";
            }
        }
    }
}

if($block_block_configs['scroll'] == 'yes') {
    $content .= "</div>\n<hr />\n";
} else {
    $content .= "</table>\n<hr />\n";
}

if($block_block_configs['show_goal'] == 'yes') {
    $content .= "<table width=\"100%\" border=\"0\" align=\"center\">\n";
    $content .= "<tr>\n<td align=\"center\">\n";
    $content .= _DONATE_TOTAL ."&nbsp;";
    $content .= $currency_code.sprintf('%.2f',$total).'<br />';
    $content .= _DONATE_GOAL . "&nbsp;";
    $content .= $currency_code.sprintf('%.2f',$block_gen_configs['monthly_goal']) .'<br />';
    $content .= _DONATE_DIF . "&nbsp;";
    $content .= $currency_code.sprintf('%.2f',floatval($block_gen_configs['monthly_goal'] - $total));
    $content .= "</td>\n</tr>\n";
    $content .= "</table>\n<hr />\n";
}

$content .= "<div align=\"center\">";
//Message
$content .= (!empty($block_block_configs['message'])) ? $block_block_configs['message'].'<br /><br />' : '';

//Button
$content .= donation_block_make_image_button();
$content .= "</div>";

?>