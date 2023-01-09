<?php
/***************************************************************************
 *                             admin_ftr.php
 *                            ---------------
 *		Version			: 1.0.3
 *		Email			: austin_inc@hotmail.com
 *		Site			: phpbb-tweaks.com
 *		Copyright		: aUsTiN-Inc 2003/6
 *
 ***************************************************************************/
 
if (!defined('IN_PHPBB')) define('IN_PHPBB', true);
	
if( !empty($setmodules) )
{
	$module['FTR Admin']['FTR: Config']	= append_sid("admin_ftr.$phpEx?mode=config");
	$module['FTR Admin']['FTR: Users']	= append_sid("admin_ftr.$phpEx?mode=users");
	return;
}

$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
require('pagestart.' . $phpEx);
include($phpbb_root_path .'language/lang_'. $board_config['default_lang'] .'/lang_ftr.'. $phpEx);

	$mode 				= ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$update 			= ( isset($HTTP_POST_VARS['update']) ) ? $HTTP_POST_VARS['update'] = $HTTP_POST_VARS['update'] ?? '' : $HTTP_GET_VARS['update'] = $HTTP_GET_VARS['update'] ?? '';
	$start 				= ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
	$user 				= ( isset($HTTP_POST_VARS['user']) ) ? intval($HTTP_POST_VARS['user']) : 0;
	$forum_selected 	= ( isset($HTTP_POST_VARS['forum']) ) ? intval($HTTP_POST_VARS['forum']) : 0;
	$topic_selected 	= ( isset($HTTP_POST_VARS['topic']) ) ? intval($HTTP_POST_VARS['topic']) : 0;				

	if ($mode != 'users')
	{
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" width="100%">';
		echo 			$lang['admin_ftr_config_title'];
		echo '		</th>';
		echo '	</tr>';
		echo '</table>';
		echo '<br><br>';
	}
	else
	{
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" width="100%">';
		echo 			$lang['admin_ftr_users_title'];
		echo '		</th>';
		echo '	</tr>';
		echo '</table>';
		echo '<br><br>';
	}
		
	// No Install Time Set, Set It
	if (!$board_config['ftr_installed'])
	{
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". time() ."'
			  WHERE config_name = 'ftr_installed'";
		$db->sql_query($q);	
	}
	
	// Reset All Viewers
	if ($mode == 'reset')
	{
		$q = "UPDATE ". USERS_TABLE ."
			  SET user_ftr = '', user_ftr_time = ''
			  WHERE user_id > '". ANONYMOUS ."'";
		$db->sql_query($q);
		message_die(GENERAL_MESSAGE, $lang['admin_ftr_config_do_reset']);
	}
	
	// Change Message
	if ($mode == 'change_msg')
	{
		$new_msg = addslashes(stripslashes($HTTP_POST_VARS['message']));
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $new_msg ."'
			  WHERE config_name = 'ftr_msg'";
		$db->sql_query($q);
		message_die(GENERAL_MESSAGE, $lang['admin_ftr_config_save_msg']);		
	}
	
	// Change Active Status
	if ($mode == 'change_active')
	{
		$new_status = ($board_config['ftr_active']) ? 0 : 1;
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $new_status ."'
			  WHERE config_name = 'ftr_active'";
		$db->sql_query($q);
		message_die(GENERAL_MESSAGE, $lang['admin_ftr_config_save_active']);		
	}
	
	// Change Whos Forced Status
	if ($mode == 'change_who')
	{
		$new_status = ($board_config['ftr_who'] == 1) ? 2 : 1;
		
		$q = "UPDATE ". CONFIG_TABLE ."
			  SET config_value = '". $new_status ."'
			  WHERE config_name = 'ftr_who'";
		$db->sql_query($q);
		message_die(GENERAL_MESSAGE, $lang['admin_ftr_config_save_who']);		
	}
		
	// Change Selected Topic
	if ($mode == 'change_post')
	{
		$q = 'SELECT forum_id, forum_name
			  FROM '. FORUMS_TABLE;
		$r 		= $db->sql_query($q);
		$frows 	= $db->sql_fetchrowset($r);
		
		$q = 'SELECT topic_id, topic_title
			  FROM '. TOPICS_TABLE .'
			  WHERE forum_id = "'. $forum_selected .'"';
		$r 		= $db->sql_query($q);
		$trows 	= $db->sql_fetchrowset($r);			
		
		// Process forum listing
		if (!$forum_selected)
		{	
			echo '<form name="post_select" method="post" action="'. append_sid("admin_ftr.$phpEx?mode=change_post") .'">';
			echo '<table align="center" width="100%" class="forumline">';
			echo '	<tr>';
			echo '		<td class="row2" align="left" width="40%">';
			echo '			<span class="genmed">';
			echo 				$lang['admin_ftr_config_select_f'];
			echo '			</span>';
			echo '		</td>';			
			echo '		<td align="center" class="row2" width="60%">';
			
			$dropdown = '';
			$dropdown .= '<select name="forum">';
			for ($x = 0; $x < count($frows); $x++)
				$dropdown .= '<option class="post" value="'. $frows[$x]['forum_id'] .'">'. $frows[$x]['forum_name'] .'</option>';
			$dropdown .= '</select>';
			
			echo 			$dropdown;
			echo '		</td>';
			echo '	</tr>';
			echo '	<tr>';
			echo '		<td class="row2" align="center" width="100%" colspan="2">';
			echo '			<input type="submit" class="mainoption" value="'. $lang['admin_ftr_config_save'] .'">';
			echo '		</td>';
			echo '	</tr>';			
			echo '</table>';
			echo '</form>';			
		}
		elseif (!$topic_selected)
		{
			for ($x = 0; $x < count($frows); $x++)
			{
				if ($frows[$x]['forum_id'] == intval($forum_selected))
				{
					$forum = $frows[$x]['forum_name'];
					break;
				}
			}
			
			echo '<form name="post_select" method="post" action="'. append_sid("admin_ftr.$phpEx?mode=change_post") .'">';
			echo '<table align="center" width="100%" class="forumline">';
			echo '	<tr>';
			echo '		<td class="row2" align="left" width="40%">';
			echo '			<span class="genmed">';			
			echo 				$lang['admin_ftr_config_select_f'];
			echo '			</span>';
			echo '		</td>';			
			echo '		<td align="center" class="row2" width="60%">';
			echo '			<span class="genmed">';
			echo '				'. $forum;
			echo '			</span>';
			echo '		</td>';
			echo '	</tr>';			
			echo '	<tr>';
			echo '		<td class="row2" align="left" width="40%">';
			echo '			<span class="genmed">';
			echo 				$lang['admin_ftr_config_select_t'];
			echo '			</span>';
			echo '		</td>';			
			echo '		<td align="center" class="row2" width="60%">';
								
			$dropdown = '';
			$dropdown .= '<select name="topic">';
			for ($x = 0; $x < count($trows); $x++)
				$dropdown .= '<option class="post" value="'. $trows[$x]['topic_id'] .'">'. $trows[$x]['topic_title'] .'</option>';
			$dropdown .= '</select>';
			
			echo 			$dropdown;
			echo '		</td>';
			echo '	</tr>';
			echo '	<tr>';
			echo '		<td class="row2" align="center" width="100%" colspan="2">';
			echo '			<input type="submit" class="mainoption" value="'. $lang['admin_ftr_config_save'] .'">';
			echo '		</td>';
			echo '	</tr>';			
			echo '</table>';
			echo '<input type="hidden" name="forum" value="'. intval($forum_selected) .'">';
			echo '</form>';				
		}
		else
		{
			$q = "UPDATE ". CONFIG_TABLE ."
				  SET config_value = '". intval($topic_selected) ."'
				  WHERE config_name = 'ftr_topic'";
			$db->sql_query($q);
			message_die(GENERAL_MESSAGE, $lang['admin_ftr_config_save_select']);
		}
	}
	
	if ($mode == 'config')
	{
		// Reset Everyone
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr><th class="thTop" width="100%">&nbsp;</th></tr>';
		echo '	<tr>';
		echo '		<td align="left" width="100%" class="row2">';
		echo '			<span class="genmed">';
		echo '				<a href="'. append_sid("admin_ftr.$phpEx?mode=reset") .'">'. $lang['admin_ftr_config_reset'] .'</a>';
		echo '			</span>';
		echo '		</td>';
		echo '	</tr>';
		echo '	<tr><th class="thTop" width="100%">&nbsp;</th></tr>';
		echo '</table>';		
		echo '<br clear="all">';
		
		// Forum & Topic Setup
		if ($board_config['ftr_topic'])
		{
			$q = 'SELECT forum_id, forum_name
				  FROM '. FORUMS_TABLE;
			$r 		= $db->sql_query($q);
			$frows 	= $db->sql_fetchrowset($r);
			
			$q = 'SELECT topic_id, topic_title, forum_id
				  FROM '. TOPICS_TABLE .'
				  WHERE topic_id = "'. intval($board_config['ftr_topic']) .'"';
			$r 		= $db->sql_query($q);
			$trows 	= $db->sql_fetchrow($r);
			
			if(isset($trows['forum_id'])):
			for ($x = 0; $x < count($frows); $x++)
			{
				if ($frows[$x]['forum_id'] == $trows['forum_id'])
				{
					$forum = $frows[$x]['forum_name'];
					break;
				}
			}
			$topic = $trows['topic_title'];		

			endif;
		}
		
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" align="center" width="100%" colspan="2">';
		echo 			$lang['admin_ftr_config_status3'];
		echo '		</th>';
		echo '	</tr>';
		echo '	<tr>';
		echo '		<td class="row2" align="left" width="80%">';
		echo '			<span class="genmed">';
		echo 				(!$board_config['ftr_topic']) ? sprintf($lang['admin_ftr_config_status3_f'], $lang['admin_ftr_config_none']) : sprintf($lang['admin_ftr_config_status3_f'], $forum = $forum ?? '');
		echo '			</span>';
		echo '		</td>';
		echo '		<td class="row2" align="center" width="20%" rowspan="2">';
		echo '			<span class="genmed">';
		echo '				<a href="'. append_sid("admin_ftr.$phpEx?mode=change_post") .'">'. $lang['admin_ftr_config_change'] .'</a>';
		echo '			</span>';
		echo '		</td>';				
		echo '	</tr>';
		echo '	<tr>';
		echo '		<td class="row2" align="left" width="80%">';
		echo '			<span class="genmed">';
		echo 				(!$board_config['ftr_topic']) ? sprintf($lang['admin_ftr_config_status3_t'], $lang['admin_ftr_config_none']) : sprintf($lang['admin_ftr_config_status3_t'], $topic = $topic ?? '');
		echo '			</span>';
		echo '		</td>';				
		echo '	</tr>';
		echo '	<tr>';
		echo '		<th class="thTop" width="100%" colspan="2">&nbsp;</th>';
		echo '	</tr>';								
		echo '</table>';
		echo '<br clear="all">';
		
		// On & Off Setup
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" align="center" width="100%" colspan="2">';
		echo 			($board_config['ftr_active']) ? sprintf($lang['admin_ftr_config_status'], $lang['admin_ftr_config_status_y']) : sprintf($lang['admin_ftr_config_status'], $lang['admin_ftr_config_status_n']);
		echo '		</th>';
		echo '	</tr>';
		if ($board_config['ftr_active'])
		{
			echo '<tr>';
			echo '	<td align="left" width="100%" class="row2">';
			echo '		<span class="genmed">';
			echo '			<a href="'. append_sid("admin_ftr.$phpEx?mode=change_active") .'">'. $lang['admin_ftr_config_status_n2'] .'</a>';
			echo '		</span>';
			echo '	</td>';
			echo '</tr>';
		}
		else
		{
			echo '<tr>';
			echo '	<td align="left" width="100%" class="row2">';
			echo '		<span class="genmed">';
			echo '			<a href="'. append_sid("admin_ftr.$phpEx?mode=change_active") .'">'. $lang['admin_ftr_config_status_y2'] .'</a>';
			echo '		</span>';
			echo '	</td>';
			echo '</tr>';		
		}
		echo '	<tr>';
		echo '		<th class="thTop" width="100%" colspan="2">&nbsp;</th>';
		echo '	</tr>';								
		echo '</table>';
		echo '<br clear="all">';
		
		// Who To Force; 1 = New Only, 2 = New & Old
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" align="center" width="100%" colspan="2">';
		echo 			($board_config['ftr_who'] == 1) ? sprintf($lang['admin_ftr_config_status2'], $lang['admin_ftr_config_status2_y']) : sprintf($lang['admin_ftr_config_status2'], $lang['admin_ftr_config_status2_n']);
		echo '		</th>';
		echo '	</tr>';
		if ($board_config['ftr_who'] == 1)
		{
			echo '<tr>';
			echo '	<td align="left" width="100%" class="row2">';
			echo '		<span class="genmed">';
			echo '			<a href="'. append_sid("admin_ftr.$phpEx?mode=change_who") .'">'. $lang['admin_ftr_config_status2_n2'] .'</a>';
			echo '		</span>';
			echo '	</td>';
			echo '</tr>';
		}
		else
		{
			echo '<tr>';
			echo '	<td align="left" width="100%" class="row2">';
			echo '		<span class="genmed">';
			echo '			<a href="'. append_sid("admin_ftr.$phpEx?mode=change_who") .'">'. $lang['admin_ftr_config_status2_y2'] .'</a>';
			echo '		</span>';
			echo '	</td>';
			echo '</tr>';		
		}
		echo '	<tr>';
		echo '		<th class="thTop" width="100%" colspan="2">&nbsp;</th>';
		echo '	</tr>';								
		echo '</table>';
		echo '<br clear="all">';
		
		// Display message
		echo '<form name="post_select" method="post" action="'. append_sid("admin_ftr.$phpEx?mode=change_msg") .'">';
		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" align="center" width="100%" colspan="2">';
		echo 			$lang['admin_ftr_config_msg'];
		echo '		</th>';
		echo '	</tr>';
		echo '	<tr>';
		echo '		<td class="row2" align="left" width="40%">';
		echo '			<span class="genmed">';
		echo 				$lang['admin_ftr_config_msg_exp'];
		echo '			</span>';
		echo '		</td>';
		echo '		<td class="row2" valign="top" align="center" width="60%">';
		echo '			<textarea name="message" class="post" style="width:80%; height:150px;">'. $board_config['ftr_msg'] .'</textarea>';
		echo '		</td>';				
		echo '	</tr>';
		echo '	<tr>';
		echo '		<td class="row2" align="center" width="100%" colspan="2">';
		echo '			<input type="submit" class="mainoption" value="'. $lang['admin_ftr_config_save'] .'">';
		echo '		</td>';
		echo '	</tr>';			
		echo '	<tr>';
		echo '		<th class="thTop" width="100%" colspan="2">&nbsp;</th>';
		echo '	</tr>';								
		echo '</table>';
		echo '</form>';		
		echo '<br clear="all">';				
	}
	
	if ($mode == 'users')
	{
		if ($HTTP_GET_VARS['remove'] = $HTTP_GET_VARS['remove'] ?? '')
		{
			$who = intval($HTTP_GET_VARS['remove']);
			
			$q = "UPDATE ". USERS_TABLE ."
				  SET user_ftr = '', user_ftr_time = ''
				  WHERE user_id = '". $who ."'";
			$db->sql_query($q);
		}
		
		$order 		= ($HTTP_GET_VARS['order'] = $HTTP_GET_VARS['order'] ?? '') ? $HTTP_GET_VARS['order'] = $HTTP_GET_VARS['order'] ?? '' : 'username';
		$dir		= ($HTTP_GET_VARS['dir'] = $HTTP_GET_VARS['dir'] ?? '') ? $HTTP_GET_VARS['dir'] = $HTTP_GET_VARS['dir'] ?? '' : 'ASC';
		$start		= intval($HTTP_GET_VARS['start'] = $HTTP_GET_VARS['start'] ?? '');
		
		if ($HTTP_GET_VARS['order'])
		{
			$order_by	= ($order == 'username') ? 'ORDER BY username ' : 'ORDER BY user_ftr_time';
			$order_by 	.= ($dir == 'asc') ? 'ASC ' : 'DESC ';
			$order_by	.= ($start > 0) ? 'LIMIT '. ($start + 100) .', 100' : 'LIMIT 0, 100';
		}
		
        $order_by = $order_by ?? '';
		 
		$q = "SELECT username, user_id, user_ftr, user_ftr_time
			  FROM ". USERS_TABLE ."
			  WHERE user_id <> '". ANONYMOUS ."'
			  AND user_ftr <> ''
			  $order_by";
		if (!$r = $db->sql_query($q))
			message_die(GENERAL_ERROR, 'Error Grabbing FTR User Info.', '', __LINE__, __FILE__, $q);
		$rows = $db->sql_fetchrowset($r);

		echo '<table align="center" width="100%" class="forumline">';
		echo '	<tr>';
		echo '		<th class="thTop" align="center" width="25%">#</th>';
		echo '		<th class="thTop" align="center" width="25%">'. $lang['admin_ftr_users_username'] .'</th>';
		echo '		<th class="thTop" align="center" width="50%">'. $lang['admin_ftr_users_viewed'] .'</th>';				
		echo '	</tr>';
		echo '	<tr>';
		echo '		<td class="row1" align="center" width="25%">'. $lang['admin_ftr_users_order'] .'</td>';
		echo '		<td class="row1" align="center" width="25%">'. sprintf($lang['admin_ftr_users_asc_desc'], '<a href="'. append_sid("admin_ftr.$phpEx?mode=users&order=username&dir=asc") .'">', '</a>', '<a href="'. append_sid("admin_ftr.$phpEx?mode=users&order=username&dir=desc") .'">', '</a>') .'</td>';
		echo '		<td class="row1" align="center" width="50%">'. sprintf($lang['admin_ftr_users_asc_desc'], '<a href="'. append_sid("admin_ftr.$phpEx?mode=users&order=time&dir=asc") .'">', '</a>', '<a href="'. append_sid("admin_ftr.$phpEx?mode=users&order=time&dir=desc") .'">', '</a>') .'</td>';				
		echo '	</tr>';		
			
		// var_dump(count($rows));

		if ( is_array( $rows ) )
		{
			$rows_counted = (int) count($rows);
		}
		else
		{
			$rows_counted = 0;
		}

		for ($x = 0; $x < $rows_counted; $x++)
		{
			echo '	<tr>';
			echo '		<td class="row1" align="center" width="25%">'. ($x + 1) .'</td>';
			echo '		<td class="row1" align="left" width="25%"><a href="'. append_sid("admin_ftr.$phpEx?mode=users&remove=". $rows[$x]['user_id']) .'">'. UsernameColor($rows[$x]['username']) .'</a></td>';
			echo '		<td class="row1" align="left" width="50%">'. create_date($board_config['default_dateformat'], $rows[$x]['user_ftr_time'], $board_config['board_timezone']) .'</td>';
			echo '	</tr>';
		}

		$q = "SELECT username, user_ftr, user_ftr_time
			  FROM ". USERS_TABLE ."
			  WHERE user_id <> '". ANONYMOUS ."'
			  AND user_ftr <> ''";
		if (!$r = $db->sql_query($q))
			message_die(GENERAL_ERROR, 'Error Grabbing FTR User Info For Pagination.', '', __LINE__, __FILE__, $q);
		$rows = $db->sql_fetchrowset($r);

		if ( is_array( $rows ) )
		{
			$rows_counted = (int) count($rows);
		}
		else
		{
			$rows_counted = 0;
		}
		
		$pagination 	= generate_pagination(append_sid("admin_ftr.$phpEx?mode=users&order=$order&dir=$dir"), $rows_counted, 100, $start). '&nbsp;';
		$page_number 	= sprintf($lang['Page_of'], ( floor( $start / 100 ) + 1 ), ceil( $rows_counted / 100 ) );				

		echo '	<tr>';
		echo '		<td class="row1" align="left" width="50%" colspan="2">'. $page_number .'</td>';
		echo '		<td class="row1" align="right" width="50%">'. $pagination .'</td>';
		echo '	</tr>';
		echo '	<tr>';
		echo '		<th class="thTop" width="100%" colspan="3">&nbsp;</th>';
		echo '	</tr>';								
		echo '</table>';		
	}
	
include('page_footer_admin.' . $phpEx);
?>