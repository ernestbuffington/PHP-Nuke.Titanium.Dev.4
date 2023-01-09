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

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
    $filename = basename(__FILE__);
    $module['Users']['Permissions_arcade'] = $filename . '?mode=user';
    $module['Groups']['Permissions_arcade'] = $filename . '?mode=group';

    return;
}

//
// Load default header
//
$no_page_header = TRUE;

$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require(__DIR__ . '/pagestart.' . $phpEx);
require($phpbb_root_path . 'gf_funcs/gen_funcs.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main_arcade.' . $phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_arcade.' . $phpEx);

$mode = get_var_gf(['name' => 'mode', 'intval' => false, 'okvar' => ['user', 'group'], 'default' => '']);
$user_id = get_var_gf(['name' => POST_USERS_URL, 'intval' => true, 'default' => 0]);
$group_id = get_var_gf(['name' => POST_GROUPS_URL, 'intval' => true, 'default' => 0]);

// ---------------
// Start Functions
//

$arcade_auth_fields = ['auth_view', 'auth_play'];

if (!function_exists('check_auth')) 
{
  function check_auth($type, $key, $u_access, $is_admin)
  {
    $auth_user = 0;

    if( count($u_access) > 0 )
    {
        foreach ($u_access as $j => $singleU_access) {
            $result = 0;
            switch($type)
            {
                case AUTH_ACL:
                    $result = $singleU_access[$key];

                case AUTH_MOD:
                    $result = $result || $singleU_access['auth_mod'];

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

if (isset($_POST['submit']) && ( ( $mode == 'user' && $user_id ) || ( $mode == 'group' && $group_id ) )) {
    $user_level = '';
    if ( $mode == 'user' )
    {
        //
        // Get group_id for this user_id
        //
        $sql = "SELECT g.group_id, u.user_level
                FROM " . USER_GROUP_TABLE . " ug, " . USERS_TABLE . " u, " . GROUPS_TABLE . " g
                WHERE u.user_id = $user_id 
                AND ug.user_id = u.user_id 
                AND g.group_id = ug.group_id 
                AND g.group_single_user = " . TRUE;
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
        }

        $row = $db->sql_fetchrow($result);

        $group_id = $row['group_id'];
        $db->sql_freeresult($result);
    }
    $sql = "SELECT arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " WHERE group_id = $group_id";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not select info from user/user_group table', '', __LINE__, __FILE__, $sql);
    }
    //List categories where the user has already access
    $cat_list = [];
    while ($row = $db->sql_fetchrow($result))
    {
        $cat_list[$row['arcade_catid']] = 1;
    }
    $private = get_var_gf(['name' => 'private', 'intval' => false, 'method' => 'POST']);
    //List authorization to be added and remove
    $liste_a_creer = '';
    $liste_a_supprimer = '';
    foreach( $private AS $key => $val )
    {
       if ($val == 1 && !isset($cat_list[$key])) {
           $new_insert = "($group_id,$key)";
           $liste_a_creer .= ( empty($liste_a_creer) ) ? $new_insert : ', ' . $new_insert;
       } elseif ($val == 0) {
           $liste_a_supprimer .= ( empty($liste_a_supprimer) ) ? $key : ', ' . $key;
       }
    }
    if (!empty($liste_a_creer))
    {
        $sql = "INSERT INTO " . AUTH_ARCADE_ACCESS_TABLE . " ( group_id, arcade_catid) VALUES " . $liste_a_creer;
        if ( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not update arcade auth table', '', __LINE__, __FILE__, $sql);
        }
    }
    if (!empty($liste_a_supprimer))
    {
        $sql = "DELETE FROM " . AUTH_ARCADE_ACCESS_TABLE . " WHERE arcade_catid IN ( $liste_a_supprimer )";
        if ( !$db->sql_query($sql) )
        {
            message_die(GENERAL_ERROR, 'Could not update arcade auth table', '', __LINE__, __FILE__, $sql);
        }
    }
    $message = $lang['Arcade_auth_updated'] . '<br /><br />' . sprintf($lang['Click_return_arcadeauth'], '<a href="' . append_sid("admin_arcade_auth.$phpEx?mode=$mode") . '">', '</a>') . '<br /><br />' . sprintf($lang['Click_return_admin_index'], '<a href="' . append_sid("index.$phpEx?pane=right") . '">', '</a>');
    message_die(GENERAL_MESSAGE, $message);
} elseif (( $mode == 'user' && ( isset($_POST['username']) || $user_id ) ) || ( $mode == 'group' && $group_id )) {
    // MANAGEMENT OF THE RIGHTS FOR A USER
    if ( isset($_POST['username']) )
    {
        $this_userdata = get_userdata($_POST['username'], true);
        if ( !is_array($this_userdata) )
        {
            message_die(GENERAL_MESSAGE, $lang['No_such_user']);
        }
        $user_id = $this_userdata['user_id'];
    }
    $sql = "SELECT * 
        FROM " . ARCADE_CATEGORIES_TABLE . "
        ORDER BY arcade_catorder";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't obtain arcade categories information", "", __LINE__, __FILE__, $sql);
    }
    $arcade_access = [];
    while( $row = $db->sql_fetchrow($result) )
    {
        $arcade_access[] = $row;
    }
    $db->sql_freeresult($result);
    $sql = "SELECT u.user_id, u.username, u.user_level, g.group_id, g.group_name, g.group_single_user FROM " . USERS_TABLE . " u, " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug WHERE ";
    $sql .= ( $mode == 'user' ) ? "u.user_id = $user_id AND ug.user_id = u.user_id AND g.group_id = ug.group_id" : "g.group_id = $group_id AND ug.group_id = g.group_id AND u.user_id = ug.user_id";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't obtain user/group information", "", __LINE__, __FILE__, $sql);
    }
    $ug_info = [];
    while( $row = $db->sql_fetchrow($result) )
    {
        $ug_info[] = $row;
    }
    $db->sql_freeresult($result);
    $sql = ( $mode == 'user' ) ? "SELECT aa.arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE. " g WHERE ug.user_id = $user_id AND g.group_id = ug.group_id AND aa.group_id = ug.group_id AND g.group_single_user = 1" : "SELECT arcade_catid FROM " . AUTH_ARCADE_ACCESS_TABLE . " WHERE group_id = $group_id";
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, "Couldn't obtain user/group permissions", "", __LINE__, __FILE__, $sql);
    }
    $auth_access = [];
    while($row=$db->sql_fetchrow($result))
    {
        $auth_access[$row['arcade_catid']]=1;
    }
    $nbcat = count($arcade_access);
    for ($i=0;$i<$nbcat;$i++)
    {
        $row_class = ( $i % 2 === 0 ) ? 'row2' : 'row1';
        $row_color = ( $i % 2 ) ? $theme['td_color2'] : $theme['td_color1'];
        if(($arcade_access[$i]['arcade_catauth']==1)||($arcade_access[$i]['arcade_catauth']==2))
        {
            $selected1 = ( isset($auth_access[$arcade_access[$i]['arcade_catid']]) ) ? 'selected="selected"' : '';
            $selected0 = ( isset($auth_access[$arcade_access[$i]['arcade_catid']]) ) ? '' : 'selected="selected"';
            $optionlist_acl =  '<select name="private[' . $arcade_access[$i]['arcade_catid'] . ']">';
            if ( $mode=='user' && $ug_info[0]['user_level'] == ADMIN )
            {
                $optionlist_acl .= '<option value="1" selected="selected" >' . $lang['Allowed_Access'] . '</option>';
            }
            else
            {
                $optionlist_acl .= '<option value="1" ' . $selected1 . '>' . $lang['Allowed_Access'] . '</option><option value="0" ' . $selected0 . '>' . $lang['Disallowed_Access'] . '</option>';
            }
            $optionlist_acl .= '</select>';
        }
        else
        {
            $optionlist_acl = '&nbsp;';
        }
        
        $template->assign_block_vars('categorie', ['ROW_COLOR' => '#' . $row_color, 'ROW_CLASS' => $row_class, 'CATTITLE' => $arcade_access[$i]['arcade_cattitle'], 'S_AUTH' => $optionlist_acl]
        );
    }
    if ( $mode == 'user' )
    {
        $t_username = $ug_info[0]['username'] = $ug_info[0]['username'] ?? '';
    }
    else
    {
        $t_groupname = $ug_info[0]['group_name'] = $ug_info[0]['group_name'] ?? '';
    }
    
	$name = [];
    $id = [];
    
	foreach ($ug_info as $i => $singleUg_info) 
	{
		$singleUg_info['group_name'] = $singleUg_info['group_name'] ?? '';
		$singleUg_info['username'] = $singleUg_info['username'] ?? '';
		
		$singleUg_info['group_id'] = $singleUg_info['group_id'] ?? '';
		$singleUg_info['user_id'] = $singleUg_info['user_id'] ?? '';
		
        if( ( $mode == 'user' && !$singleUg_info['group_single_user'] ) || $mode == 'group' )
        {
           /*****[BEGIN]******************************************
            [ Mod:    Advanced Username Color             v1.0.5 ]
            ******************************************************/
            $name[] = ( $mode == 'user' ) ? $singleUg_info['group_name'] :  UsernameColor($singleUg_info['username']);
           /*****[END]********************************************
            [ Mod:    Advanced Username Color             v1.0.5 ]
            ******************************************************/  
             $id[] = ( $mode == 'user' ) ? (int) $singleUg_info['group_id'] : (int) $singleUg_info['user_id'];
        }
    }
	
    if( $name !== [] )
    {
        $t_usergroup_list = '';
        foreach (array_keys($ug_info) as $i) {
            $ug = ( $mode == 'user' ) ? 'group&amp;' . POST_GROUPS_URL : 'user&amp;' . POST_USERS_URL;
            $t_usergroup_list .= ( ( empty($t_usergroup_list) ) ? '' : ', ' ) . '<a href="' . append_sid("admin_ug_auth.$phpEx?mode=$ug=" . $id[$i]) . '">' . $name[$i] . '</a>';
        }
    }
    else
    {
        $t_usergroup_list = $lang['None'];
    }
    //
    // Dump in the page header ...
    //
    include(__DIR__ . '/page_header_admin.'.$phpEx);
    $template->set_filenames(["body" => 'admin/auth_arcade_body.tpl']
    );
    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="adv" value="' . $adv = $adv ?? '' . '" />';
    $s_hidden_fields .= ( $mode == 'user' ) ? '<input type="hidden" name="' . POST_USERS_URL . '" value="' . $user_id . '" />' : '<input type="hidden" name="' . POST_GROUPS_URL . '" value="' . $group_id . '" />';
    if ( $mode == 'user' )
    {
        $template->assign_block_vars('switch_user_auth', []);

        $template->assign_vars([
            'USERNAME' => $t_username,
            //$this_userdata['username'],
            'USER_LEVEL' => $lang['User_Level'] . " : " . $s_user_type,
            'USER_GROUP_MEMBERSHIPS' => $lang['Group_memberships'] . ' : ' . $t_usergroup_list,
        ]
        );
    }
    else
    {
        $template->assign_block_vars("switch_group_auth", []);

        $template->assign_vars([
            /*****[BEGIN]******************************************
             [ Mod:    Group Colors                        v1.0.0 ]
             ******************************************************/
            'USERNAME' => GroupColor($t_groupname),
            /*****[END]********************************************
             [ Mod:    Group Colors                        v1.0.0 ]
             ******************************************************/
            'GROUP_MEMBERSHIP' => $lang['Usergroup_members'] . ' : ' . $t_usergroup_list,
        ]
        );
    }
    
	if(!isset($u_switch_mode))
	$u_switch_mode = '';

	if(!isset($s_column_span))
	$s_column_span = '';
	
	$template->assign_vars(['L_USER_OR_GROUPNAME' => ( $mode == 'user' ) ? $lang['Username'] : $lang['Group_name'], 
	                        'L_AUTH_TITLE' => ( $mode == 'user' ) ? $lang['Auth_Arcade_Control_User'] : $lang['Auth_Arcade_Control_Group'], 
							'L_AUTH_EXPLAIN' => ( $mode == 'user' ) ? $lang['User_arcade_auth_explain'] : $lang['Group_arcade_auth_explain'], 
							'L_MODERATOR_STATUS' => $lang['Moderator_status'], 
							'L_PERMISSIONS' => $lang['arcade_cat_auth'], 
							'L_SUBMIT' => $lang['Submit'], 
							'L_RESET' => $lang['Reset'], 
							'L_CATEGORIES' => $lang['Arcade_categories'], 
							'U_USER_OR_GROUP' => append_sid("admin_arcade_auth.$phpEx"), 
							'U_SWITCH_MODE' => $u_switch_mode, 
							'S_COLUMN_SPAN' => $s_column_span, 
							'S_AUTH_ACTION' => append_sid("admin_arcade_auth.$phpEx"), 
							'S_HIDDEN_FIELDS' => $s_hidden_fields]
    );
} 
else
{
    //
    // Select a user/group
    //
    include(__DIR__ . '/page_header_admin.'.$phpEx);

    $template->set_filenames(['body' => ( $mode == 'user' ) ? 'admin/user_select_body.tpl' : 'admin/auth_select_body.tpl']
    );

    if ( $mode == 'user' )
    {
        $template->assign_vars(['L_FIND_USERNAME' => $lang['Find_username'], 'U_SEARCH_USER' => append_sid("search.$phpEx?mode=searchuser&amp;popup=1&amp;menu=1")]
        );
    }
    else
    {
        $sql = "SELECT group_id, group_name
            FROM " . GROUPS_TABLE . "
            WHERE group_single_user <> " . TRUE;
        if ( !($result = $db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, "Couldn't get group list", "", __LINE__, __FILE__, $sql);
        }

        if ( $row = $db->sql_fetchrow($result) )
        {
            $select_list = '<select name="' . POST_GROUPS_URL . '">';
            do
            {
                $select_list .= '<option value="' . $row['group_id'] . '">' . $row['group_name'] . '</option>';
            }
            while ( $row = $db->sql_fetchrow($result) );
            $select_list .= '</select>';
        }

        $template->assign_vars(['S_AUTH_SELECT' => $select_list]
        );
    }

    $s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';

    $l_type = ( $mode == 'user' ) ? 'USER' : 'AUTH';

    $template->assign_vars(['L_' . $l_type . '_TITLE' => ( $mode == 'user' ) ? $lang['Auth_Arcade_Control_User'] : $lang['Auth_Arcade_Control_Group'], 'L_' . $l_type . '_EXPLAIN' => ( $mode == 'user' ) ? $lang['User_arcade_auth_explain'] : $lang['Group_arcade_auth_explain'], 'L_' . $l_type . '_SELECT' => ( $mode == 'user' ) ? $lang['Select_a_User'] : $lang['Select_a_Group'], 'L_LOOK_UP' => ( $mode == 'user' ) ? $lang['Look_up_User'] : $lang['Look_up_Group'], 'S_HIDDEN_FIELDS' => $s_hidden_fields, 'S_' . $l_type . '_ACTION' => append_sid("admin_arcade_auth.$phpEx")]
    );

}

$template->pparse('body');

include(__DIR__ . '/page_footer_admin.'.$phpEx);

?>
