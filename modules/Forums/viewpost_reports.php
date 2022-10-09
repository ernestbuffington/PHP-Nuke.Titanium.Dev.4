<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            viewpost_reports.php
 *                            --------------------
 *   begin                : Sunday, Jun 19, 2005
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: viewpost_reports.php,v 1.2.3.1 2005/08/18 14:18:00 chatasos Exp $
 *
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
      Nuke Patched                             v3.1.0       08/30/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1")
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
include_once("includes/functions_report.php");

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
//
// End session management
//

if( !$userdata['session_logged_in'] )
{
    redirect('login.'.$phpEx.'?redirect=viewpost_reports.'.$phpEx);
}

if ( $userdata['user_level'] < ADMIN )
{
    message_die(GENERAL_MESSAGE, $lang['Not_Moderator'], $lang['Not_Authorised']);
}

if ( isset($HTTP_POST_VARS['status']) || isset($HTTP_GET_VARS['status']) )
{
    $status = ( !empty($HTTP_POST_VARS['status']) ) ? $HTTP_POST_VARS['status'] : $HTTP_GET_VARS['status'];
}
else
{
    $status = REPORT_POST_NEW;
}

if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
    $mode = ( !empty($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
    $mode = '';
}
// get the report_id
if ( isset($HTTP_POST_VARS['report']) || isset($HTTP_GET_VARS['report']) )
{
    $report_id = ( !empty($HTTP_POST_VARS['report']) ) ? intval($HTTP_POST_VARS['report']) : intval($HTTP_GET_VARS['report']);
}
else
{
    $report_id = '';
}

// check for single open/close report
if ( ($mode == 'closereport' || $mode == 'openreport') && $report_id != '' )
{
    // maybe we have to add a check here if the report is already closed/opened
    $last_action_comments = ( !empty($HTTP_POST_VARS['last_action_comments']) ) ? htmlspecialchars(trim($HTTP_POST_VARS['last_action_comments'])) : '';

    //replace single quotes
    $last_action_comments = str_replace("'", "&#039;", $last_action_comments);

    if ( empty($last_action_comments) )
    {
        $report_comments = str_replace("\n", "\n<br />\n", get_report_comments($report_id));

        // show form to add comments about report
        $page_title = $lang['Report_post'] . ' - ' . $topic_title;
        include('includes/page_header.'.$phpEx);

        $template->set_filenames(array(
            'report_comment' => 'report_comment.tpl')
        );

        $template->assign_vars(array(
            'TOPIC_TITLE' => $topic_title,
            'POST_ID' => $post_id,
            'REPORT_COMMENTS' => $report_comments,
            'U_VIEW_TOPIC' => append_sid('viewtopic.'.$phpEx.'?' . POST_POST_URL . '=' . $post_id . '#' . $post_id),
            'L_REPORT_COMMENT' => $lang['Report_comment'],
            'L_ACTION' => $lang['Action'],
            'L_COMMENTS' => $lang['Comments'],
            'L_LAST_ACTION_COMMENTS' => $lang['Last_action_comments'],
            'L_LAST_ACTION_COMMENTS_EXPLAIN' => $lang['Last_action_comments_explain'],
            'L_SUBMIT' => $lang['Submit'],
            'L_PREVIOUS_COMMENTS' => $lang['Previous_comments'],
            'S_ACTION' => append_sid('viewpost_reports.'.$phpEx.'?mode='.$mode.'&amp;report='.$report_id))
        );

        $template->pparse('report_comment');

        include('includes/page_tail.'.$phpEx);
        exit;
    }
    else
    {
        // get the previous comments
        $previous_comments = get_report_comments($report_id);

        // create the time var here so we can use the same time values afterwards
        $time_var = time();

        // create the new comments
        $last_action_user = '<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;' . POST_USERS_URL . '=' . $userdata['user_id'] . '">' . $userdata['username'] . '</a>' ;
        $last_action_date = create_date($board_config['default_dateformat'], $time_var, $board_config['board_timezone']);

        if ( $mode == 'closereport' )
        {
            $last_action = sprintf($lang['Closed_by_user_on_date'], $last_action_user, $last_action_date);
        }
        else
        {
            $last_action = sprintf($lang['Opened_by_user_on_date'], $last_action_user, $last_action_date);
        }

        $last_action_comments = '<strong>' . $last_action . '</strong>' . "\n" . $last_action_comments;

        if ( $previous_comments != '' )
        {
            $last_action_comments .= '<hr />' . $previous_comments;
        }

        // update report status
          $sql = "UPDATE " . POST_REPORTS_TABLE . " SET
            report_status = " . ( ( $mode == 'closereport' ) ? REPORT_POST_CLOSED : REPORT_POST_NEW ) . ",
            last_action_user_id = " . $userdata['user_id'] . ",
            last_action_time = " . $time_var . ",
            last_action_comments = '" . str_replace("\'", "''", $last_action_comments) . "'
            WHERE report_id = " . $report_id;

        if ( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not update status', '', __LINE__, __FILE__, $sql);
        }

        $message =  $lang['Close_success'] . '<br /><br />' . sprintf($lang['Click_return_reports'], '<a href="' . append_sid('viewpost_reports.'.$phpEx) . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }
}
else if ( $mode == 'close' || $mode == 'open' )
{
    // create the time var here so we can use the same time values afterwards
    $time_var = time();

    // comment to use when doing mass (checkbox & drop down menu) updating
    // here we have to add the previous comments for each report too
    $last_action_user = '<a href="modules.php?name=Profile&amp;mode=viewprofile&amp;' . POST_USERS_URL . '=' . $userdata['user_id'] . '">' . $userdata['username'] . '</a>' ;
    $last_action_date = create_date($board_config['default_dateformat'], $time_var, $board_config['board_timezone']);

    if ( $mode == 'close' )
    {
        $last_action = sprintf($lang['Closed_by_user_on_date'], $last_action_user, $last_action_date);
    }
    else
    {
        $last_action = sprintf($lang['Opened_by_user_on_date'], $last_action_user, $last_action_date);
    }

    $mass_action_comments = '<strong>' . $last_action . '</strong>' . "\n" . $lang['Last_action_checkbox'];

      //replace single quotes
    $mass_action_comments = str_replace("'", "&#039;", $mass_action_comments);

    // get the selected reports
    $reports = $HTTP_POST_VARS[POST_POST_URL];

    if ( empty($reports) )
    {
        $message =  $lang['Report_not_selected'] . '<br /><br />' . sprintf($lang['Click_return_reports'], '<a href="' . append_sid('viewpost_reports.'.$phpEx) . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }

    $report_ids = array();
    foreach($reports as $row)
    {
        $report_ids[] = intval($row);
    }

    // get the stored comments for the specific reports
    $sql = "SELECT report_id, last_action_comments FROM " . POST_REPORTS_TABLE . "
        WHERE report_id IN (" . implode(',', $report_ids) . ")";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not get report comments', '', __LINE__, __FILE__, $sql);
    }

    // store results into a special array
    // using report_id as a key pointing to the right last_action_comments
    $reports_comments = array();
    while( $row = $db->sql_fetchrow($result) )
    {
        $reports_comments[$row['report_id']] = $row['last_action_comments'];
    }

    if ( !empty($reports_comments) )
    {
        foreach($reports_comments as $key => $value)
        {
            $previous_comments = $value;

            if ( $previous_comments != '' )
            {
                $last_action_comments = $mass_action_comments . '<hr />' . $previous_comments;
            }
            else
            {
                $last_action_comments = $mass_action_comments;
            }

            $sql = "UPDATE " . POST_REPORTS_TABLE . " SET
                report_status = " . ( ( $mode == 'close' ) ? REPORT_POST_CLOSED : REPORT_POST_NEW ) . ",
                last_action_user_id = " . $userdata['user_id'] . ",
                last_action_time = " . $time_var . ",
                last_action_comments = '" . str_replace("\'", "''", $last_action_comments) . "'
                WHERE report_id = " . $key;

            if ( !$db->sql_query($sql) )
            {
                message_die(GENERAL_ERROR, 'Could not update status', '', __LINE__, __FILE__, $sql);
            }
        }
    }
    else
    {
        message_die(GENERAL_ERROR, 'Could not find any reports','');
    }

    $message =  $lang['Close_success'] . '<br /><br />' . sprintf($lang['Click_return_reports'], '<a href="' . append_sid('viewpost_reports.'.$phpEx) . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
}
else if ( $mode == 'optout' || $mode == 'optin' )
{
    $sql = "UPDATE " . USERS_TABLE . " SET
        user_report_optout = " . (( $mode == 'optout' ) ? 1 : 0) . "
        WHERE user_id = " . $userdata['user_id'];

    if ( !$db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, 'Could not opt status', '', __LINE__, __FILE__, $sql);
    }

    $message = $lang['Opt_success'] . '<br /><br />' . sprintf($lang['Click_return_reports'], '<a href="' . append_sid('viewpost_reports.'.$phpEx) . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
}
else if ( $mode == 'delete' )
{
    // check if the user is an admin
    if ( $userdata['user_level'] != ADMIN )
    {
        message_die(GENERAL_MESSAGE, $lang['Not_Authorised']);
    }

    // get the selected reports
    $reports = $HTTP_POST_VARS[POST_POST_URL];

    if ( empty($reports) )
    {
        $message =  $lang['Report_not_selected'] . '<br /><br />' . sprintf($lang['Click_return_reports'], '<a href="' . append_sid('viewpost_reports.'.$phpEx) . '">', '</a>');
        message_die(GENERAL_MESSAGE, $message);
    }

    $report_ids = array();
    foreach($reports as $row)
    {
        $report_ids[] = intval($row);
    }

    // delete the selected reports
    $sql = "DELETE FROM " . POST_REPORTS_TABLE . "
        WHERE report_id IN (" . implode(',', $report_ids) . ")";

    if ( !$db->sql_query($sql) )
    {
        message_die(GENERAL_ERROR, 'Could not delete reports', '', __LINE__, __FILE__, $sql);
    }

    $message =  $lang['Delete_success'] . '<br /><br />' . sprintf($lang['Click_return_reports'], '<a href="' . append_sid('viewpost_reports.'.$phpEx) . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
}
$page_title = $lang['View_post_reports'];
include('includes/page_header.'.$phpEx);

$template->set_filenames(array(
    'body' => 'reports_view.tpl')
);

$template->assign_vars(array(
    'L_DISPLAY'        => $lang['Display'],
    'L_OPEN'            => $lang['Open'],
    'L_CLOSE'        => $lang['Close'],
    'L_DELETE'        => $lang['Delete'],
    'L_CLOSED'        => $lang['Closed'],
    'L_OPENED'        => $lang['Opened'],
    'L_ALL'            => $lang['All'],
    'L_POST'            => $lang['Post'],
    'L_REPORTER'    => $lang['Reporter'],
    'L_COMMENTS'    => $lang['Comments'],
    'L_STATUS'        => $lang['Status'],

    'L_ACTION'     => $lang['Action'],
    'L_LAST_ACTION_COMMENTS' => $lang['Last_action_comments'],

    'L_SELECT_ONE'    => $lang['Select_one'],
    'L_SUBMIT'        => $lang['Submit'],
    'L_OPT_OUT'        => ( $userdata['user_report_optout'] ) ? $lang['Opt_in'] : $lang['Opt_out'],

    'U_OPT_OUT'        => ( $userdata['user_report_optout'] ) ? append_sid('viewpost_reports.' . $phpEx . '?mode=optin') : append_sid('viewpost_reports.' . $phpEx . '?mode=optout'),

    'S_OPEN'            => ( $status == REPORT_POST_NEW ) ? ' selected="selected"' : '',
    'S_CLOSED'        => ( $status == REPORT_POST_CLOSED ) ? ' selected="selected"' : '',
    'S_ALL'            => ( $status == 'all' ) ? ' selected="selected"' : '',

    'S_ACTION'        => append_sid('viewpost_reports.'.$phpEx))
);

show_reports($status);

$template->pparse('body');

include('includes/page_tail.'.$phpEx);

?>