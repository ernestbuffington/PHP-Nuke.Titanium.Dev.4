<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

    function DateFixMonth($regdate)
    {
    $dates     = $month = '';
    $dates     = explode(' ', $regdate);
    $month     = $dates[0];
    
    switch($month) {
        case 'Jan':
        case 'January':
            $month = '01';
        break;
        case 'Feb':
        case 'February':
            $month = '02';
        break;
        case 'Mar':
        case 'March':
            $month = '03';
        break;
        case 'Apr':
        case 'April':
            $month = '04';
        break;
        case 'May':
            $month = '05';
        break;
        case 'Jun':
        case 'June':
            $month = '06';
        break;
        case 'Jul':
        case 'July':
            $month = '07';
        break;
        case 'Aug':
        case 'August':
            $month = '08';
        break;
        case 'Sep':
        case 'September':
            $month = '09';
        break;
        case 'Oct':
        case 'October':
            $month = '10';
        break;
        case 'Nov':
        case 'November':
            $month = '11';
        break;
        case 'Dec':
        case 'December':
            $month = '12';
        break;    
        default:
            message_die(GENERAL_ERROR, 'Cound Not Convert '. $month .' To A Numeric Conversion.', 'Error');
        break;
    }
    
    $new_regdate = $month;
    return $new_regdate;
    }

//
// New Users by Month
//
$core->start_module(true);

$core->set_content('values');

$sql = "SELECT SUBSTRING_INDEX(user_regdate,' ',-1) as year_regdate, SUBSTRING_INDEX(user_regdate,' ',1) as month_regdate, COUNT(*) AS num_user
FROM " . USERS_TABLE . "
WHERE (user_id <> " . ANONYMOUS . " )
AND SUBSTRING_INDEX(user_regdate, ' ',1) <> 'Non'
GROUP BY SUBSTRING_INDEX(user_regdate,' ',-1), SUBSTRING_INDEX(user_regdate,' ',1)";

$result = $core->sql_query($sql, 'Couldn\'t retrieve users data');

$user_count = $core->sql_numrows($result);
$user_data = $core->sql_fetchrowset($result);

$month_array = array();

for ($i = 0; $i < $user_count; $i++)
{
        $user_data[$i]['month_regdate'] = DateFixMonth($user_data[$i]['month_regdate']);
    $month_array[$user_data[$i]['year_regdate']][($user_data[$i]['month_regdate']-1)]['num_user'] = $user_data[$i]['num_user'];
}

@reset($month_array);

while (list($year, $data) = each($month_array))
{
    for ($i = 0; $i < 12; $i++)
    {
        if (!isset($month_array[$year][$i]))
        {
            $month_array[$year][$i]['num_user'] = 0;
        }
    }
}
@reset($month_array);

$year_ar = array();
$month_1 = array();
$month_2 = array();
$month_3 = array();
$month_4 = array();
$month_5 = array();
$month_6 = array();
$month_7 = array();
$month_8 = array();
$month_9 = array();
$month_10 = array();
$month_11 = array();
$month_12 = array();

while (list($year, $data) = each($month_array))
{
    $year_ar[] = $year;
    for ($i = 0; $i < 12; $i++)
    {
        eval("\$month_" . ($i+1) . "[] = \$month_array[\$year][\$i]['num_user'];");
    }
}

$core->set_view('columns', 13);
$core->set_view('num_blocks', 1);
$core->set_view('value_order', 'left_right');

$core->define_view('set_columns', array(
    'year' => $lang['Year'],
    '1' => $lang['Month_jan'],
    '2' => $lang['Month_feb'],
    '3' => $lang['Month_mar'],
    '4' => $lang['Month_apr'],
    '5' => $lang['Month_may'],
    '6' => $lang['Month_jun'],
    '7' => $lang['Month_jul'],
    '8' => $lang['Month_aug'],
    '9' => $lang['Month_sep'],
    '10' => $lang['Month_oct'],
    '11' => $lang['Month_nov'],
    '12' => $lang['Month_dec'])
);

$core->set_header($lang['module_name']);

$data = $core->assign_defined_view('value_array', array(
    $year_ar, 
    $month_1,
    $month_2,
    $month_3,
    $month_4,
    $month_5,
    $month_6,
    $month_7,
    $month_8,
    $month_9,
    $month_10,
    $month_11,
    $month_12)
);

$core->set_data($data);

$core->define_view('iterate_values', array());

$core->run_module();

?>