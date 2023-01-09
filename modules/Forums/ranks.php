<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            ranks.php
 *                            ---------
 *    begin                : 08/05/2003
 *    copyright            : Ptirhiik
 *    email                : admin@rpgnet-fr.com
 *
 *    version                : 1.0.3 - 26/07/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/25/2005
	  Multiple Ranks And Staff View            v2.0.3 
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if (!isset($popup))
    {
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
    }
    else
    {
    $phpbb_root_path = NUKE_FORUMS_DIR;
    }
define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

// global pgm options
$auth_rank_only_logged = true; // true will required to be logged to have access, false guest are welcome
$spe_rank_max_users = -1; // number of displayed members in the memberlist : -1=all, 0=none, value=number
$std_rank_max_users = 10; // number of displayed members in the memberlist : -1=all, 0=none, value=number

// check for inclusion
if ( isset($check_access) ) return;

$rank_extended = function_exists('extended_rank');
$profilcp = file_exists($phpbb_root_path . 'profilcp/functions_profile.' . $phpEx);
if ($profilcp)
{
    $rank_extended = false;
    include($phpbb_root_path . 'profilcp/functions_profile.' . $phpEx);
}

function get_rank_title($rank_title)
{
    global $rank_extended, $profilcp, $lang;

    $res = $rank_title;
    if ($rank_extended || $profilcp)
    {
        $ranks = explode( "|", $rank_title);
        $res = '';
        $res .= (isset($ranks[1]) && !empty($ranks[1])) ? '<strong>' . $lang['Male'] . ': </strong>' . $ranks[1] . '<br />': '';
        $res .= (isset($ranks[1]) && !empty($ranks[2])) ? '<strong>' . $lang['Female'] . ': </strong>' . $ranks[2] . '<br />' : '';
        $res .= '<strong>' . $lang['No_gender_specify'] . ': </strong>' . $ranks[0];
    }
    return $res;
}

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

// only registered members have access if desired
if ( $auth_rank_only_logged && !$userdata['session_logged_in'] )
{
    redirect(append_sid('login.' . $phpEx . '?redirect=ranks.' . $phpEx, true));
    exit;
}

//
// special ranks
$spe_ranks = array();
$sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special = 1 ORDER BY rank_title";
if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read special ranks', '', __LINE__, __FILE__, $sql);
while ($row = $db->sql_fetchrow($result) ) $spe_ranks[] = $row;
for ($i=0; $i < count($spe_ranks); $i++ )
{
    $rank = $spe_ranks[$i]['rank_id'];
    $rank_title = $spe_ranks[$i]['rank_title'];
    $spe_ranks[$i]['user_number'] = 0;
    $spe_ranks[$i]['users_list'] = '';

    // base sql request
    // $sql_base = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND user_rank = $rank ORDER BY username";
    $sql_base = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND user_rank = $rank OR user_rank2 = $rank OR user_rank3 = $rank OR user_rank4 = $rank OR user_rank5 = $rank ORDER BY username";

    // get the number of users having this rank
    $sql = $sql_base;
    if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
    $spe_ranks[$i]['user_number'] = $db->sql_numrows($result);

    // get the user list
    if ( $spe_rank_max_users != 0 )
    {
        $sql = $sql_base;
        if ( $spe_rank_max_users > 0 ) $sql .= " LIMIT 0, " . ($spe_rank_max_users + 1);
        if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
        $j = 0;
        while ( $row = $db->sql_fetchrow($result) )
        {
            $j++;
            if ( ($spe_rank_max_users <= 0) || ( $j <= $spe_rank_max_users ) )
            {
                $spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $spe_ranks[$i]['users_list'] .= '<a href="' . "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']  . '">' . UsernameColor($row['username']) . '</a>';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            }
            else
            {
                $spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
                $spe_ranks[$i]['users_list'] .= ( !$profilcp ) ? '...' : '<a href="' . "modules.php?name=Profile&amp;mode=buddy&amp;sub=memberlist&amp;filter=user_rank_title&amp;comp=eq&amp;fvalue=$rank_title" . '">...</a>';
            }
        }
    }
    if ($spe_ranks[$i]['user_number'] > 0) $spe_ranks[$i]['users_list'] = '(' . $spe_ranks[$i]['user_number'] . ') ' . $spe_ranks[$i]['users_list'];
}

//
// standard ranks
$ranks = array();
$sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special <> 1 ORDER BY rank_min";
if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read standard ranks', '', __LINE__, __FILE__, $sql);
while ($row = $db->sql_fetchrow($result) ) $ranks[] = $row;

$rank_max = 99999999;
for ($i=count($ranks)-1; $i >=0; $i--)
{
    $ranks[$i]['rank_max'] = $rank_max;
    $rank_title = $ranks[$i]['rank_title'];
    $rank_min = $ranks[$i]['rank_min'];

    // count users
    // $sql_base = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND (user_rank = 0 OR user_rank IS NULL) AND user_posts >= $rank_min" . (($rank_max < 99999999)  ? " AND user_posts < $rank_max" : "" );
    $sql_base = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND (user_rank = 0 OR user_rank IS NULL OR user_rank2 = 0 OR user_rank2 IS NULL OR user_rank3 = 0 OR user_rank3 IS NULL OR user_rank4 = 0 OR user_rank4 IS NULL OR user_rank5 = 0 OR user_rank5 IS NULL) AND user_posts >= $rank_min" . (($rank_max < 99999999)  ? " AND user_posts < $rank_max" : "" );

    // get the number of users having this rank
    $sql = $sql_base;
    if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
    $ranks[$i]['user_number'] = $db->sql_numrows($result);

    // get the user list
    if ( $std_rank_max_users != 0 )
    {
        $sql = $sql_base;
        if ( $std_rank_max_users > 0 ) $sql .= " LIMIT 0, " . ($std_rank_max_users + 1);
        if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
        $j = 0;
        while ( $row = $db->sql_fetchrow($result) )
        {
            $j++;
            if ( ($std_rank_max_users <= 0) || ( $j <= $std_rank_max_users ) )
            {
                $ranks[$i]['users_list'] .= ($ranks[$i]['users_list'] == '') ? '' : ', ';
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
                $ranks[$i]['users_list'] .= '<a href="' . "modules.php?name=Profile&amp;mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id'] . '">' . UsernameColor($row['username']) . '</a>';
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            }
            else
            {
                $ranks[$i]['users_list'] .= ($ranks[$i]['users_list'] == '') ? '' : ', ';
                $ranks[$i]['users_list'] .= ( !$profilcp ) ? '...' : '<a href="' . "modules.php?name=Profile&amp;mode=buddy&amp;sub=memberlist&amp;filter=user_rank_title&amp;comp=eq&amp;fvalue=$rank_title" . '">...</a>';
            }
        }
    }

    // store the next limit
    $rank_max = $ranks[$i]['rank_min'];

    // number of user beyond userlist
    if ($ranks[$i]['user_number'] > 0) $ranks[$i]['users_list'] = '(' . $ranks[$i]['user_number'] . ') ' . $ranks[$i]['users_list'];
}

//
// set the page title and include the page header
//
$page_title = $lang['Ranks'];
include ('includes/page_header.'.$phpEx);
//
// template setting
//
$template->set_filenames(array(
    'body' => 'ranks_body.tpl')
);

// constants
$template->assign_vars(array(
    'L_SPECIAL_RANKS' => $lang['Special_ranks'],
    'L_USERS_LIST' => $lang['Memberlist'],
    'L_RANKS' => $lang['Ranks'],
    'L_MINI' => $lang['Rank_minimum'],
    'L_TOTAL_USERS' => $lang['Total_users'],
    'SPAN_USERLIST_STD' => ($std_rank_max_users != 0) ? 2 : 1,
    'S_HIDDEN_FIELDS' => '',
    )
);

// standard ranks
if ($std_rank_max_users != 0)
{
    $template->assign_block_vars('std_userlist', array());
}
else $template->assign_block_vars('no_std_userlist', array());

for ($i=0; $i < count($ranks); $i++)
{
    $template->assign_block_vars('ranks', array(
        'RANK_TITLE' => get_rank_title($ranks[$i]['rank_title']),
        'RANK_IMAGE' => ($ranks[$i]['rank_image'] == '') ? '' : '<img src="modules/Forums/' . $ranks[$i]['rank_image'] . '" border=0 align="center" alt="' . $ranks[$i]['rank_title'] . '">',
        'RANK_MINI'  => $ranks[$i]['rank_min'],
        'RANK_TOTAL' => $ranks[$i]['user_number'],
        )
    );
    if ($std_rank_max_users != 0)
    {
        $template->assign_block_vars('ranks.userlist', array(
            'USERS_LIST' => $ranks[$i]['users_list'],
            )
        );
    }
    else $template->assign_block_vars('ranks.no_userlist', array());
}

// special ranks
if ($spe_rank_max_users != 0)
{
    $template->assign_block_vars('spe_userlist', array());
}
else $template->assign_block_vars('no_spe_userlist', array());

for ($i=0; $i < count($spe_ranks); $i++)
{
    $template->assign_block_vars('spe_ranks', array(
        'RANK_TITLE' => get_rank_title($spe_ranks[$i]['rank_title']),
        'RANK_IMAGE' => ($spe_ranks[$i]['rank_image'] == '') ? '' : '<img src="modules/Forums/' . $spe_ranks[$i]['rank_image'] . '" border=0 align="center" alt="' . $spe_ranks[$i]['rank_title'] . '">',
        )
    );
    if ($spe_rank_max_users != 0)
    {
        $template->assign_block_vars('spe_ranks.userlist', array(
            'USERS_LIST' => $spe_ranks[$i]['users_list'],
            )
        );
    }
    else
    {
        $template->assign_block_vars('spe_ranks.no_userlist', array(
            'RANK_TOTAL' => $spe_ranks[$i]['user_number'],
            )
        );
    }
}

//
// page footer
//
$template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>