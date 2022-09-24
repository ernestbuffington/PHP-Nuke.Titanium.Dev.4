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

if (is_admin())
{
    if ($popup != "1"){
        $titanium_module_name = basename(dirname(__FILE__));
        require("modules/".$titanium_module_name."/nukebb.php");
    }
    else
    {
        $phpbb2_root_path = 'modules/Forums/';
    }

    define('IN_PHPBB2', true);
    include($phpbb2_root_path . 'extension.inc');
    include($phpbb2_root_path . 'common.'.$phpEx);
    include('includes/functions_search.'.$phpEx);

    // Start session management
    $userdata = titanium_session_pagestart($titanium_user_ip, TITANIUM_PAGE_SEARCH);
    titanium_init_userprefs($userdata);
    // End session management

    //*****  check users and user groups ****//

    $sql = "SELECT user_id, username
        FROM " . USERS_TABLE ."
        WHERE user_id > 0";
    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not obtain user list', '', __LINE__, __FILE__, $sql);
    }

    $liste ='';
    while ( $row = $titanium_db->sql_fetchrow($result) )
    {
       $titanium_username = $row['username'];
       $titanium_user_id = $row['user_id'];
       $titanium_usergroup = '';
        
       $sql1 = "SELECT ug.group_id
              FROM " . USER_GROUP_TABLE ." ug, ". GROUPS_TABLE. " g
              WHERE ug.user_id = $titanium_user_id
                AND ug.group_id = g.group_id
                AND g.group_single_user  = 1
                ";
                  
       if ( ($result1 = $titanium_db->sql_query($sql1)) )
       {
           $row1 = $titanium_db->sql_fetchrow($result1);
              $titanium_usergroup =( ( $row1['group_id'] != '' ) ? $row1['group_id'] : 'User has no user group'.$row1 );
              
       }

              if (!($row1['group_id'] != ''))
              {
                  
             $sql2 = "SELECT MAX(group_id) AS total
                FROM " . GROUPS_TABLE;
             if ( !($result2 = $titanium_db->sql_query($sql2)) )
             {
                message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sq2l);
             }

             if ( !($row2 = $titanium_db->sql_fetchrow($result2)) )
             {
                message_die(GENERAL_ERROR, 'Could not obtain next group_id information', '', __LINE__, __FILE__, $sql2);
             }
             $group_id = $row2['total'] + 1;
              
              
             $sql3 = "INSERT INTO " . GROUPS_TABLE . " (group_id, group_name, group_description, group_single_user, group_moderator)
                VALUES ($group_id, '', 'Personal User', 1, 0)";
             if ( !($result3 = $titanium_db->sql_query($sql3)) )
             {
                message_die(GENERAL_ERROR, 'Could not insert data into groups table', '', __LINE__, __FILE__, $sql3);
             }

             $sql4 = "INSERT INTO " . USER_GROUP_TABLE . " (user_id, group_id, user_pending)
                VALUES ($titanium_user_id, $group_id, 0)";
             if( !($result4 = $titanium_db->sql_query($sql4)) )
             { 
                message_die(GENERAL_ERROR, 'Could not insert data into user_group table', '', __LINE__, __FILE__, $sql4);
             }

                  
                 $titanium_usergroup = $titanium_usergroup.', adding user group '.$group_id;
              }


       $liste .= ( ( $liste != '' ) ? '<br /> ' : '' ) . $titanium_username.' <b>'.$titanium_usergroup.'</b>';
    }

    message_die(GENERAL_MESSAGE,'Users:<br />'.$liste);
}
else
{
    redirect_titanium('index.php');
}

?>