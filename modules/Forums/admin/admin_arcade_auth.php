<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                           admin_arcade_auth.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/
 
 /*****[CHANGES]**********************************************************
-=[Mod]=-
      Advanced Username Color                  v1.0.5       06/13/2005
      Group Colors                             v1.0.0       10/20/2005
 ************************************************************************/  

define('IN_PHPBB2', 1);

if( !empty($setmodules) )
{
    $filename = basename(__FILE__);
    $titanium_module['Users']['Permissions_arcade'] = $filename . '?mode=user';
    $titanium_module['Groups']['Permissions_arcade'] = $filename . '?mode=group';

    return;
}

//
// Load default header
//
$no_page_header = TRUE;

$phpbb2_root_path = "./../";
require($phpbb2_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
require($phpbb2_root_path . 'gf_funcs/gen_funcs.' . $phpEx);
require($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_main_arcade.' . $phpEx);
require($phpbb2_root_path . 'language/lang_' . $phpbb2_board_config['default_lang'] . '/lang_admin_arcade.' . $phpEx);

$mode = get_var_gf(array('name' => 'mode','intval' => false,'okvar' => array('user','group'),'default' => ''));
$titanium_user_id = get_var_gf(array('name' => POST_USERS_URL, 'intval' => true, 'default' => 0 ));
$group_id = get_var_gf(array('name' => POST_GROUPS_URL, 'intval' => true, 'default' => 0 ));

// ---------------
// Start Functions
//

$arcade_auth_fields = array('auth_view', 'auth_play');

if (!function_exists(check_auth)) 
{
  function check_auth($type, $key, $u_access, $is_admin)
  {
    $auth_user = 0;

    if( count($u_access) )
    {
        for($j = 0; $j < count($u_access); $j++)
        {
            $result = 0;
            switch($type)
            {
                case AUTH_ACL:
                    $result = $u_access[$j][$key];

                case AUTH_MOD:
                    $result = $result || $u_access[$j]['auth_mod'];

                case AUTH_ADMIN:
                    $result = $result || $is_admin;
                    break;
            }

            $auth_user = $auth_user || $result;
        }
    }
    else
    {
        $auth_user = $is_admin;
    }

    return $auth_user;
 }
}
//
// End Functions
// -------------

if ( isset($HTTP_POST_VARS['submit']) && ( ( $mode == 'user' && $titanium_user_id ) || ( $mode == 'group' && $group_id ) ) )
{
    $titanium_user_level = '';
    if ( $mode == 'user' )
    {
        //
        // Get group_id for this user_id
        //
        $sql = "SELECT g.group_id, u.user_level
                FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u, " . GROUPS_TABLE . " g
                WHERE u.user_id = $titanium_user_id 
                AND ug.user_id = u.user_id 
                AND g.group_id = ug.group_id 
                AND g.group_single_user = " . TRUE;
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
        }

        $row = $titanium_db->sql_fetchrow($result);

        $group_id = $row['group_id'];
        $titanium_db->sql_freeresult($result);
    }
    
    $sql = "SELECT arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " WHERE group_id = $group_id";
    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
    }
    
    //List categories where the user has already access
    $cat_list = array();
    while ($row = $titanium_db->sql_fetchrow($result))
    {
        $cat_list[$row['arcade_catid']] = 1;
    }
    
    $private = get_var_gf(array('name' => 'private', 'intval' => false, 'method' => 'POST'));
    
    //List authorization to be added and remove
    $liste_a_creer = '';
    $liste_a_supprimer = '';
    foreach( $private AS $key => $val )
    {
       if ( ( $val == 1 ) and ( !isset($cat_list[$key])) )
       {
         $new_insert = "($group_id,$key)";
         $liste_a_creer .= ( empty($liste_a_creer) ) ? $new_insert : ', ' . $new_insert;
       }
       else if( $val == 0 )
       {
         $liste_a_supprimer .= ( empty($liste_a_supprimer) ) ? $key : ', ' . $key;
       }
    }
    
    if (!empty($liste_a_creer))
    {
        $sql = "INSERT INTO " . AUTH_ARCADE_ACCESS_TABLE . " ( group_id, arcade_catid) VALUES " . $liste_a_creer;
        if ( !$titanium_db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not update arcade auth table', '', __LINE__, __FILE__, $sql);
        }
    }
    
    if (!empty($liste_a_supprimer))
    {
        $sql = "DELETE FROM " . AUTH_ARCADE_ACCESS_TABLE . " WHERE arcade_catid IN ( $liste_a_supprimer )";
        if ( !$titanium_db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not update arcade auth table', '', __LINE__, __FILE__, $sql);
        }
    }
    $message = $titanium_lang['Arcade_auth_updated'] . '<br /><br />' . sprintf($titanium_lang['Click_return_arcadeauth'], '<a href="' . append_titanium_sid("admin_arcade_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($titanium_lang['Click_return_admin_index'], '<a href="' . append_titanium_sid("index.$phpEx?pane=right") . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
}
else if ( ( $mode == 'user' && ( isset($HTTP_POST_VARS['username']) || $titanium_user_id ) ) || ( $mode == 'group' && $group_id ) )
{
        // MANAGEMENT OF THE RIGHTS FOR A USER
    if ( isset($HTTP_POST_VARS['username']) )
    {
        $this_userdata = get_userdata($HTTP_POST_VARS['username'], true);
        if ( !is_array($this_userdata) )
        {
            message_die(GENERAL_MESSAGE, $titanium_lang['No_such_user']);
        }
        $titanium_user_id = $this_userdata['user_id'];
    }

    $sql = "SELECT * 
        FROM " . ARCADE_CATEGORIES_TABLE . "
        ORDER BY arcade_catorder";
    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't obtain arcade categories information", "", __LINE__, __FILE__, $sql);
    }

    $arcade_access = array();
    while( $row = $titanium_db->sql_fetchrow($result) )
    {
        $arcade_access[] = $row;
    }
    $titanium_db->sql_freeresult($result);


    $sql = "SELECT u.user_id, u.username, u.user_level, g.group_id, g.group_name, g.group_single_user FROM " . USERS_TABLE . " u, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug WHERE ";
    $sql .= ( $mode == 'user' ) ? "u.user_id = $titanium_user_id AND ug.user_id = u.user_id AND g.group_id = ug.group_id" : "g.group_id = $group_id AND ug.group_id = g.group_id AND u.user_id = ug.user_id";
    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't obtain user/group information", "", __LINE__, __FILE__, $sql);
    }
    $ug_info = array();
    while( $row = $titanium_db->sql_fetchrow($result) )
    {
        $ug_info[] = $row;
    }
    $titanium_db->sql_freeresult($result);

    
    $sql = ( $mode == 'user' ) ? "SELECT aa.arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $titanium_user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = 1" : "SELECT arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " WHERE group_id = $group_id";
    if ( !($result = $titanium_db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
    }

    $auth_access = array();
    while($row=$titanium_db->sql_fetchrow($result))
    {
        $auth_access[$row['arcade_catid']]=1;
    }    

    $nbcat = count($arcade_access);
    
    for ($i=0;$i<$nbcat;$i++)
    {
        $row_class = ( !( $i % 2 ) ) ? 'row2' : 'row1';
        $row_color = ( !( $i % 2 ) ) ? $theme['td_color1'] : $theme['td_color2'];
        if(($arcade_access[$i]['arcade_catauth']==1)||($arcade_access[$i]['arcade_catauth']==2))
        {
            $selected1 = ( isset($auth_access[$arcade_access[$i]['arcade_catid']]) ) ? 'selected="selected"' : '';
            $selected0 = ( !isset($auth_access[$arcade_access[$i]['arcade_catid']]) ) ? 'selected="selected"' : '';
            $optionlist_acl =  '<select name="private[' . $arcade_access[$i]['arcade_catid'] . ']">';
            if ( $mode=='user' && $ug_info[0]['user_level'] == ADMIN )
            {
                $optionlist_acl .= '<option value="1" selected="selected" >' . $titanium_lang['Allowed_Access'] . '</option>';
            }
            else
            {
                $optionlist_acl .= '<option value="1" ' . $selected1 . '>' . $titanium_lang['Allowed_Access'] . '</option><option value="0" ' . $selected0 . '>' . $titanium_lang['Disallowed_Access'] . '</option>';
            }
            $optionlist_acl .= '</select>';
        }
        else
        {
            $optionlist_acl = '&nbsp;';
        }
        
        $phpbb2_template->assign_block_vars('categorie', array(
            'ROW_COLOR' => '#' . $row_color,
            'ROW_CLASS' => $row_class,
            'CATTITLE' => $arcade_access[$i]['arcade_cattitle'],
            'S_AUTH' => $optionlist_acl)
        );
    }

    if ( $mode == 'user' )
    {
        $t_username = $ug_info[0]['username'];
    }
    else
    {
        $t_groupname = $ug_info[0]['group_name'];
    }

    $name = array();
    $id = array();
    for($i = 0; $i < count($ug_info); $i++)
    {
        if( ( $mode == 'user' && !$ug_info[$i]['group_single_user'] ) || $mode == 'group' )
        {
/*****[BEGIN]******************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/
            $name[] = ( $mode == 'user' ) ? $ug_info[$i]['group_name'] :  UsernameColor($ug_info[$i]['username']);
/*****[END]********************************************
 [ Mod:    Advanced Username Color             v1.0.5 ]
 ******************************************************/  
             $id[] = ( $mode == 'user' ) ? intval($ug_info[$i]['group_id']) : intval($ug_info[$i]['user_id']);
        }
    }

    if( count($name) )
    {
        $t_usergroup_list = '';
        for($i = 0; $i < count($ug_info); $i++)
        {
            $ug = ( $mode == 'user' ) ? 'group&amp;' . POST_GROUPS_URL : 'user&amp;' . POST_USERS_URL;

            $t_usergroup_list .= ( ( !empty($t_usergroup_list) ) ? ', ' : '' ) . '<a href="' . append_titanium_sid("admin_ug_auth.$phpEx?mode=$ug=" . $id[$i]) . '">' . $name[$i] . '</a>';
        }
    }
    else
    {
        $t_usergroup_list = $titanium_lang['None'];
    }

    //
    // Dump in the page header ...
    //
    include('./page_header_admin.'.$phpEx);

    $phpbb2_template->set_filenames(array(
        "body" => 'admin/auth_arcade_body.tpl')
    );

    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="adv" value="' . $adv . '" />';
    $s_hidden_fields .= ( $mode == 'user' ) ? '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $titanium_user_id . '" />' : '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';

    if ( $mode == 'user' )
    {
        $phpbb2_template->assign_block_vars('switch_user_auth', array());

        $phpbb2_template->assign_vars(array(
            'USERNAME' => $t_username, //$this_userdata['username'],
            'USER_LEVEL' => $titanium_lang['User_Level'] . " : " . $s_user_type,
            'USER_GROUP_MEMBERSHIPS' => $titanium_lang['Group_memberships'] . ' : ' . $t_usergroup_list)
        );
    }
    else
    {
        $phpbb2_template->assign_block_vars("switch_group_auth", array());

        $phpbb2_template->assign_vars(array(
/*****[BEGIN]******************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/
            'USERNAME' => GroupColor($t_groupname),
/*****[END]********************************************
 [ Mod:    Group Colors                        v1.0.0 ]
 ******************************************************/  
             'GROUP_MEMBERSHIP' => $titanium_lang['Usergroup_members'] . ' : ' . $t_usergroup_list)
        );
    }

    $phpbb2_template->assign_vars(array(
        'L_USER_OR_GROUPNAME' => ( $mode == 'user' ) ? $titanium_lang['Username'] : $titanium_lang['Group_name'],

        'L_AUTH_TITLE' => ( $mode == 'user' ) ? $titanium_lang['Auth_Arcade_Control_User'] : $titanium_lang['Auth_Arcade_Control_Group'],
        'L_AUTH_EXPLAIN' => ( $mode == 'user' ) ? $titanium_lang['User_arcade_auth_explain'] : $titanium_lang['Group_arcade_auth_explain'],
        'L_MODERATOR_STATUS' => $titanium_lang['Moderator_status'],
        'L_PERMISSIONS' => $titanium_lang['arcade_cat_auth'],
        'L_SUBMIT' => $titanium_lang['Submit'],
        'L_RESET' => $titanium_lang['Reset'], 
        'L_CATEGORIES' => $titanium_lang['Arcade_categories'], 

        'U_USER_OR_GROUP' => append_titanium_sid("admin_arcade_auth.$phpEx"),
        'U_SWITCH_MODE' => $u_switch_mode,

        'S_COLUMN_SPAN' => $s_column_span,
        'S_AUTH_ACTION' => append_titanium_sid("admin_arcade_auth.$phpEx"), 
        'S_HIDDEN_FIELDS' => $s_hidden_fields)
    );

}
else
{
    //
    // Select a user/group
    //
    include('./page_header_admin.'.$phpEx);

    $phpbb2_template->set_filenames(array(
        'body' => ( $mode == 'user' ) ? 'admin/user_select_body.tpl' : 'admin/auth_select_body.tpl')
    );

    if ( $mode == 'user' )
    {
        $phpbb2_template->assign_vars(array(
            'L_FIND_USERNAME' => $titanium_lang['Find_username'],
            'U_SEARCH_USER' => append_titanium_sid("search.$phpEx?mode=searchuser&amp;popup=1&amp;menu=1"))
        );
    }
    else
    {
        $sql = "SELECT group_id, group_name
            FROM " . GROUPS_TABLE . "
            WHERE group_single_user <> " . TRUE;
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Couldn't get group list", "", __LINE__, __FILE__, $sql);
        }

        if ( $row = $titanium_db->sql_fetchrow($result) )
        {
            $select_list = '<select name="' . POST_GROUPS_URL . '">';
            do
            {
                $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
            }
            while ( $row = $titanium_db->sql_fetchrow($result) );
            $select_list .= '</select>';
        }

        $phpbb2_template->assign_vars(array(
            'S_AUTH_SELECT' => $select_list)
        );
    }

    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';

    $l_type = ( $mode == 'user' ) ? 'USER' : 'AUTH';

    $phpbb2_template->assign_vars(array(
        'L_' . $l_type . '_TITLE' => ( $mode == 'user' ) ? $titanium_lang['Auth_Arcade_Control_User'] : $titanium_lang['Auth_Arcade_Control_Group'],
        'L_' . $l_type . '_EXPLAIN' => ( $mode == 'user' ) ? $titanium_lang['User_arcade_auth_explain'] : $titanium_lang['Group_arcade_auth_explain'],
        'L_' . $l_type . '_SELECT' => ( $mode == 'user' ) ? $titanium_lang['Select_a_User'] : $titanium_lang['Select_a_Group'],
        'L_LOOK_UP' => ( $mode == 'user' ) ? $titanium_lang['Look_up_User'] : $titanium_lang['Look_up_Group'],

        'S_HIDDEN_FIELDS' => $s_hidden_fields, 
        'S_' . $l_type . '_ACTION' => append_titanium_sid("admin_arcade_auth.$phpEx"))
    );

}

$phpbb2_template->pparse('body');

include('./page_footer_admin.'.$phpEx);

?>