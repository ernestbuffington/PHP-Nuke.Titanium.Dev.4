<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/**
*
* @package attachment_mod
* @version $Id: attach_rules.php,v 1.2 2005/11/05 12:23:33 acydburn Exp $
* @copyright (c) 2002 Meik Sievertsen
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

if ($popup != "1")
{
    $titanium_module_name = basename(dirname(__FILE__));
    require("modules/".$titanium_module_name."/nukebb.php");
}
else
{
    $phpbb2_root_path = NUKE_FORUMS_DIR;
}

define('IN_PHPBB2', TRUE);

include($phpbb2_root_path . 'extension.inc');
include($phpbb2_root_path . 'common.'.$phpEx);

$phpbb2_forum_id = get_var('f', 0);
$privmsg = (!$phpbb2_forum_id) ? true : false;

// Start Session Management
$userdata = titanium_session_pagestart($titanium_user_ip, PAGE_INDEX);
titanium_init_userprefs($userdata);

// Display the allowed Extension Groups and Upload Size
if ($privmsg)
{
    $auth['auth_attachments'] = ($userdata['user_level'] != ADMIN) ? intval($attach_config['allow_pm_attach']) : true;
    $auth['auth_view'] = true;
    $_max_filesize = $attach_config['max_filesize_pm'];
}
else
{
    $auth = auth(AUTH_ALL, $phpbb2_forum_id, $userdata);
    $_max_filesize = $attach_config['max_filesize'];
}

if (!($auth['auth_attachments'] && $auth['auth_view']))
{
    message_die(GENERAL_ERROR, 'You are not allowed to call this file (ID:2)');
}

$phpbb2_template->set_filenames(array(
    'body' => 'posting_attach_rules.tpl')
);

$sql = 'SELECT group_id, group_name, max_filesize, forum_permissions
    FROM ' . EXTENSION_GROUPS_TABLE . '
    WHERE allow_group = 1
    ORDER BY group_name ASC';

if (!($result = $titanium_db->sql_query($sql)))
{
    message_die(GENERAL_ERROR, 'Could not query Extension Groups.', '', __LINE__, __FILE__, $sql);
}

$allowed_filesize = array();
$rows = $titanium_db->sql_fetchrowset($result);
$num_rows = $titanium_db->sql_numrows($result);
$titanium_db->sql_freeresult($result);

// Ok, only process those Groups allowed within this forum
$nothing = true;
for ($i = 0; $i < $num_rows; $i++)
{
    $auth_cache = trim($rows[$i]['forum_permissions']);

    $permit = ($privmsg) ? true : ((is_forum_authed($auth_cache, $phpbb2_forum_id)) || trim($rows[$i]['forum_permissions']) == '');

    if ($permit)
    {
        $nothing = false;
        $group_name = $rows[$i]['group_name'];
        $f_size = intval(trim($rows[$i]['max_filesize']));
        $det_filesize = (!$f_size) ? $_max_filesize : $f_size;
        $size_lang = ($det_filesize >= 1048576) ? $titanium_lang['MB'] : (($det_filesize >= 1024) ? $titanium_lang['KB'] : $titanium_lang['Bytes']);

        if ($det_filesize >= 1048576)
        {
            $det_filesize = round($det_filesize / 1048576 * 100) / 100;
        }
        else if ($det_filesize >= 1024)
        {
            $det_filesize = round($det_filesize / 1024 * 100) / 100;
        }

        $max_filesize = ($det_filesize == 0) ? $titanium_lang['Unlimited'] : $det_filesize . ' ' . $size_lang;

        $phpbb2_template->assign_block_vars('group_row', array(
            'GROUP_RULE_HEADER' => sprintf($titanium_lang['Group_rule_header'], $group_name, $max_filesize))
        );

        $sql = 'SELECT extension
            FROM ' . EXTENSIONS_TABLE . "
            WHERE group_id = " . (int) $rows[$i]['group_id'] . "
            ORDER BY extension ASC";

        if (!($result = $titanium_db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Could not query Extensions.', '', __LINE__, __FILE__, $sql);
        }

        $e_rows = $titanium_db->sql_fetchrowset($result);
        $e_num_rows = $titanium_db->sql_numrows($result);
        $titanium_db->sql_freeresult($result);

        for ($j = 0; $j < $e_num_rows; $j++)
        {
            $phpbb2_template->assign_block_vars('group_row.extension_row', array(
                'EXTENSION' => $e_rows[$j]['extension'])
            );
        }
    }
}

$gen_simple_header = TRUE;
$phpbb2_page_title = $titanium_lang['Attach_rules_title'];
include('includes/page_header.' . $phpEx);

$phpbb2_template->assign_vars(array(
    'L_RULES_TITLE'            => $titanium_lang['Attach_rules_title'],
    'L_CLOSE_WINDOW'        => $titanium_lang['Close_window'],
    'L_EMPTY_GROUP_PERMS'    => $titanium_lang['Note_user_empty_group_permissions'])
);

if ($nothing)
{
    $phpbb2_template->assign_block_vars('switch_nothing', array());
}

$phpbb2_template->pparse('body');

include('includes/page_tail.' . $phpEx);

?>