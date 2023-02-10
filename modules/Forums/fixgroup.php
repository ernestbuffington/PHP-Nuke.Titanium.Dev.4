<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

/*****[BEGIN]******************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}
/*****[END]********************************************
 [ Base:    Nuke Patched                       v3.1.0 ]
 ******************************************************/
global $prefix, $user_prefix;

if (is_admin())
{
    if (!isset($popup)){
        $module_name = basename(dirname(__FILE__));
        require("modules/".$module_name."/nukebb.php");
    }
    else
    {
        $phpbb_root_path = 'modules/Forums/';
    }

    define('IN_PHPBB', true);
    include($phpbb_root_path . 'extension.inc');
    include($phpbb_root_path . 'common.'.$phpEx);
    include('includes/functions_search.'.$phpEx);

    // Start session management
    $userdata = session_pagestart($user_ip, PAGE_SEARCH);
    init_userprefs($userdata);
    // End session management

    define_once('USER_GROUP_TABLE', $prefix.'_bbuser_group');
	define_once('GROUPS_TABLE', $prefix.'_bbgroups');
    define_once('USERS_TABLE', $user_prefix.'_users');

    //*****  check users and user groups ****//

    $sql = "SELECT user_id, username
        FROM " . USERS_TABLE ."
        WHERE user_id > 0";
    
	if (!($result = $db->sql_query($sql)))
    {
        message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
    }

    $liste ='';

    $usergroup = [];
    $row1 = [];
    $sql1 = [];
	$sql2 = [];
	$sql3 = [];
	$sql4 = [];
    $row = [];
	$row2 = [];
	$liste = '';
    $current_group_id = [];
	
	while ( $row = $db->sql_fetchrow($result) )
    {
       $username = $row['username'];
       $user_id = $row['user_id'];
       
	   $sql1 = "SELECT ug.group_id
                  FROM ".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g
                  WHERE ug.user_id = $user_id
                  AND ug.group_id = g.group_id
                  AND g.group_single_user = 1 ";
       
	   $result1 = $db->sql_query($sql1);

	   $usergroup_listing = "SELECT ug.group_id
                             FROM ".USER_GROUP_TABLE." ug, ".GROUPS_TABLE." g
                             WHERE ug.user_id = $user_id
                             AND ug.group_id = g.group_id
                             AND g.group_single_user = 0 ";
       
	   $in_this_group = $db->sql_query($usergroup_listing);
	   $current_group_id = $db->sql_fetchrow($in_this_group);
	   
	   if(!isset($current_group_id['group_id']))
	   $current_group_id['group_id'] = 'No Associated Group';
	   
       if(isset($row1['group_id']))
       $row1 = $db->sql_fetchrow($result1);
 	   
	   $usergroup = $row1['group_id'] ?? $current_group_id['group_id'];

       if (isset($row1['group_id']) && $row1['group_id'] != '')
       {
                  
             $sql2 = "SELECT MAX(group_id) AS total
                FROM " . GROUPS_TABLE;
           
		     if ( !($result2 = $db->sql_query($sql2)) )
             {
                message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sq2l);
             }

             if ( !($row2 = $db->sql_fetchrow($result2)) )
             {
                message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sql2);
             }
             $group_id = $row2['total'] + 1;
              
              
             $sql3 = "INSERT INTO " . GROUPS_TABLE . " (group_id, group_name, group_description, group_single_user, group_moderator)
                VALUES ($group_id, '', 'Personal User', 1, 0)";
           
		     if ( !($result3 = $db->sql_query($sql3)) )
             {
                message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql3);
             }

             $sql4 = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
                VALUES ($user_id, $group_id, 0)";
           
		     if( !($result4 = $db->sql_query($sql4)) )
             { 
                message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql4);
             }
                 $usergroup = $usergroup.', adding user group '.$group_id;
              }


          $liste .= ( ( $liste != '' ) ? '<br /> ' : '' ) . $username.': Group ID: <b>'.$usergroup.'</b>';
    }

    message_die(GENERAL_MESSAGE,'Users:<br />'.$liste);
}
else
{
    redirect('index.php');
}

?>