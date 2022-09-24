<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                admin_logs.php
 *                              -------------------
 *     begin                : Jan 24 2003
 *     copyright            : Morpheus
 *     email                : morpheus@2037.biz
 *
 *     $Id: admin_logs.php,v 1.85.2.9 2003/01/24 18:31:54 Moprheus Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
    $file = basename(__FILE__);
    $titanium_module['Logs']['Logs Actions'] = "$file";
    return;
}

//
// Load default header
//
$titanium_module_name = basename(dirname(dirname(__FILE__)));
$phpbb2_root_path = './../';
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
$phpbb2_template->set_filenames(array(
    "body" => "admin/logs_body.tpl")
);

$phpbb2_start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;

if ( isset($HTTP_POST_VARS['order']) )
    {
        $sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
    }
else if ( isset($HTTP_GET_VARS['order']) )
    {
        $sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
    }
else
    {
        $sort_order = 'ASC';
    }

if ( file_exists($phpbb2_root_path . 'log_actions_db_update.' . $phpEx) )
{
    message_die(GENERAL_MESSAGE, $titanium_lang['File_not_deleted']);
}

$sql = "SELECT config_value AS all_admin
FROM " . LOGS_CONFIG_TABLE . "
WHERE config_name = 'all_admin' ";

if(!$result = $titanium_db->sql_query($sql)) 
{ 
   message_die(CRITICAL_ERROR, "Could not query log config informations", "", __LINE__, __FILE__, $sql); 
}
$row = $titanium_db->sql_fetchrow($result);
$all_admin_authorized = $row['all_admin'];
if ( $all_admin_authorized == '0' && $userdata['user_id'] <> '2' && !is_mod_admin($titanium_module_name) && $userdata['user_view_log'] <> '1' )
{
    message_die(GENERAL_MESSAGE, $titanium_lang['Admin_not_authorized']);
}

//
// Logs sorting
//

$mode_types_text = array($titanium_lang['Time'], $titanium_lang['Member'], $titanium_lang['Action'], $titanium_lang['Id_log']);
$mode_types = array('time', 'username', 'mode', 'id');
    
$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
    {
        $selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
        $select_sort_mode .= "<option value=\"" . $mode_types[$i] . "\"$selected>" . $mode_types_text[$i] . "</option>";
    }
$select_sort_mode .= '</select>';
    
$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
    {
        $select_sort_order .= '<option value="ASC" selected="selected">' . $titanium_lang['Sort_Ascending'] . '</option><option value="DESC">' . $titanium_lang['Sort_Descending'] . '</option>';
    }
else
    {
        $select_sort_order .= '<option value="ASC">' . $titanium_lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $titanium_lang['Sort_Descending'] . '</option>';
    }
$select_sort_order .= '</select>';
    

$phpbb2_template->assign_vars(array(
    'L_LOG_ACTIONS_TITLE' => $titanium_lang['Log_action_title'],
    'L_LOG_ACTION_EXPLAIN' => $titanium_lang['Log_action_explain'],
    'L_CHOOSE_SORT' => $titanium_lang['Choose_sort_method'],
    'L_ORDER' => $titanium_lang['Order'],
    'L_GO' => $titanium_lang['Go'],
    'L_CANCEL' => $titanium_lang['Cancel'],
    'L_DELETE' => $titanium_lang['Delete'], 
    'L_DELETE_LOG' => $titanium_lang['Choose_log'],
    'L_ID_LOG' => $titanium_lang['Id_log'],
    'L_ACTION' => $titanium_lang['Action'],
    'L_TOPIC' => $titanium_lang['Topic'],
    'L_DONE_BY' => $titanium_lang['Done_by'],
    'L_USER_IP' => $titanium_lang['User_ip'],
    'L_DATE' => $titanium_lang['Date'],
    'L_MARK_ALL' => $titanium_lang['Select_all'],
    'L_UNMARK_ALL' => $titanium_lang['Unselect_all'],

    'S_MODE_SELECT' => $select_sort_mode,
    'S_ORDER_SELECT' => $select_sort_order,
    'S_MODE_ACTION' => append_titanium_sid("admin_logs.$phpEx"),
    'S_CANCEL_ACTION' => append_titanium_sid("admin_logs.$phpEx"))
);
if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
    $mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];

    switch( $mode )
    {
        case 'mode' :
            $order_by = "mode $sort_order LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
            break;
        case 'username' :
            $order_by = "username $sort_order LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
            break;
        case 'time' :
            $order_by = "time $sort_order LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
            break;
        case 'id' :
            $order_by = "log_id $sort_order LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
            break;
        default:
            $order_by = "time DESC LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
            break;
    }
}
else
{
    $order_by = "time DESC LIMIT $phpbb2_start, " . $phpbb2_board_config['topics_per_page'];
}

$sql = "SELECT * 
    FROM " . LOGS_TABLE . "
    ORDER BY $order_by "; 
    if(!$result = $titanium_db->sql_query($sql)) 
    { 
       message_die(CRITICAL_ERROR, "Could not query log informations", "", __LINE__, __FILE__, $sql); 
    } 
    $rows = $titanium_db->sql_fetchrowset($result); 
    $numrows = $titanium_db->sql_numrows($result); 
    for ($i = 0; $i < $numrows; $i++) 
    {
        $id_log = $rows[$i]['log_id'];
        $action = ucfirst($rows[$i]['mode']); 
        $topic = $rows[$i]['topic_id']; 
        $titanium_user_id = $rows[$i]['user_id']; 
        $titanium_username = $rows[$i]['username'];
        $titanium_user_ip = decode_ip($rows[$i]['user_ip']);
        $date = $rows[$i]['time']; 

        $sql = "SELECT topic_title 
            FROM " . TOPICS_TABLE . "
            WHERE topic_id = '$topic'";
        if(!$result = $titanium_db->sql_query($sql)) 
        { 
           message_die(CRITICAL_ERROR, "Could not query topic_title informations", "", __LINE__, __FILE__, $sql); 
        }
        $topic_title = $titanium_db->sql_fetchrow($result);
        $temp_url = append_titanium_sid('admin_users.'.$phpEx.'?mode=edit&u=' . $titanium_user_id); 
        $temp2_url = ('./../../../modules.php?name=Forums&file=viewtopic&t=' . $topic);

        if ($topic_title['topic_title']) {
        $topic_title = (strlen($topic_title['topic_title']) >= 15) ? substr($topic_title['topic_title'], 0, 15)."..." : $topic_title['topic_title'];
        $topic_title = '<a href="' . $temp2_url . '" target="_blank">' . $topic_title . '</a>';
        } else {
        $topic_title = '<small>Deleted (ID: ' . $topic . ')</small>';
        }        
        
        $sql = "SELECT user_level
            FROM " . USERS_TABLE . "
            WHERE user_id = $titanium_user_id";
        
        if(!$result = $titanium_db->sql_query($sql)) 
        { 
           message_die(CRITICAL_ERROR, "Could not query user_level informations", "", __LINE__, __FILE__, $sql); 
        } 
        $row = $titanium_db->sql_fetchrow($result);
        $level = $row['user_level'];

         $phpbb2_template->assign_block_vars('record_row', array( 
            'ID_LOG' => $id_log,
            'ACTION' => $action,
            'TOPIC' => $topic_title,
            'USER_ID' => $titanium_user_id,
            'USERNAME' => '<a href="' . $temp_url . '" target=_new>' . UsernameColor($titanium_username) . '</a>', 
            'USER_IP' => $titanium_user_ip,
            'U_WHOIS_IP' => 'http://network-tools.com/default.asp?prog=express&Netnic=whois.arin.net&host=' . $titanium_user_ip, 
            'DATE' => create_date($phpbb2_board_config['default_dateformat'], $date, $phpbb2_board_config['board_timezone'])) 
         );
    }
$titanium_db->sql_freeresult($result);
$log_list = ( isset($HTTP_POST_VARS['log_list']) ) ?  $HTTP_POST_VARS['log_list'] : array();
$delete = ( isset($HTTP_POST_VARS['delete']) ) ?  TRUE : FALSE ;

$log_list_sql = implode(', ', $log_list);

if ( $log_list_sql != '' )
{
    if ( $delete )
    {
        $sql = "DELETE 
        FROM " . LOGS_TABLE . " 
        WHERE log_id IN (" . $log_list_sql . ")";

        if( !$result = $titanium_db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not delete Logs', '', __LINE__, __FILE__, $sql);
        }
        else
        {
            $redirect_page = append_titanium_sid("admin_logs.$phpEx");
            $l_redirect = sprintf($titanium_lang['Click_return_admin_log'], '<a href="' . $redirect_page . '">', '</a>');

            message_die(GENERAL_MESSAGE, $titanium_lang['Log_delete'] . '<br /><br />' . $l_redirect);
        }
    }
}
if ( $phpbb2_board_config['topics_per_page'] > 10 )
{
    $sql = "SELECT count(*) AS total
        FROM " . LOGS_TABLE;
        if ( !($result = $titanium_db->sql_query($sql)) ) 
       { 
          message_die(GENERAL_ERROR, 'Error getting total informations for logs', '', __LINE__, __FILE__, $sql); 
       }

       if ( $total = $titanium_db->sql_fetchrow($result) ) 
       { 
          $total_phpbb2_records = $total['total']; 
    
          $pagination = generate_pagination("admin_logs.$phpEx?mode=$mode&amp;order=$sort_order", $total_phpbb2_records, $phpbb2_board_config['topics_per_page'], $phpbb2_start). '&nbsp;'; 
       } 
} 
else
    {
        $pagination = '&nbsp;';
        $total_phpbb2_records = 10;
    }
    
    $phpbb2_template->assign_vars(array(
        'PAGINATION' => $pagination,
        'PAGE_NUMBER' => ( $total_phpbb2_records == '0' ) ? '&nbsp;' : sprintf($titanium_lang['Page_of'], ( floor( $phpbb2_start / $phpbb2_board_config['topics_per_page'] ) + 1 ), ceil( $total_phpbb2_records / $phpbb2_board_config['topics_per_page'] )),     
        'L_GOTO_PAGE' => $titanium_lang['Goto_page'],
        'GROUPS' => GetColorGroups(1))
    );

$phpbb2_template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>