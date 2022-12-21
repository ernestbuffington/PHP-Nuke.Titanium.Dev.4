<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            viewtopic_quickreply.php
 *                            -------------------
 *   begin                : Tuesday, Apr 5, 2004
 *   copyright            : (C) 2004 Hayk Chamyan
 *   email                : hayk@mail.ru
 *
 *   $Header: viewtopic_quickreply.php, 6, 14.03.2005 18:24:35, Hayk Chamyan$
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Lock/Unlock in Quick Reply               v1.0.0       09/03/2005
      Automatic Subject on Reply               v1.0.0       09/03/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

$submit = $refresh = FALSE;
$hidden_form_fields = '<input type="hidden" name="mode" value="reply" />';
$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
//
// Set toggles for various options
//
if ( !$board_config['allow_html'] )
{
    $html_on = 0;
}
else
{
    $html_on = ( $submit || $refresh ) ? ( ( empty($_POST['disable_html']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_html'] : $userdata['user_allowhtml'] );
}

if ( !$board_config['allow_bbcode'] )
{
    $bbcode_on = 0;
}
else
{
    $bbcode_on = ( $submit || $refresh ) ? ( ( empty($_POST['disable_bbcode']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}

if ( !$board_config['allow_smilies'] )
{
    $smilies_on = 0;
}
else
{
    $smilies_on = ( $submit || $refresh ) ? ( ( empty($_POST['disable_smilies']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}

if (($submit || $refresh) && $is_auth['auth_read']) {
    $notify_user = ( empty($_POST['notify']) ) ? 0 : TRUE;
} elseif ($userdata['session_logged_in'] && $is_auth['auth_read']) {
    $sql = "SELECT topic_id
            FROM " . TOPICS_WATCH_TABLE . "
            WHERE topic_id = $topic_id
                AND user_id = " . $userdata['user_id'];
    if ( !($result = $db->sql_query($sql)) )
    {
        message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
    }
    $notify_user = ( $db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];
    $db->sql_freeresult($result);
} else
{
    $notify_user = ( $userdata['session_logged_in'] && $is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
}

$attach_sig = ( $submit || $refresh ) ? ( ( empty($_POST['attach_sig']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );

$user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

if ( (($userdata['user_quickreply_mode']==1) && ($userdata['user_id'] != ANONYMOUS)) || (($board_config['anonymous_sqr_mode']==1) && ($userdata['user_id'] == ANONYMOUS)) )
{
    $template->assign_block_vars('switch_advanced_qr', []);
    //
    // Signature toggle selection
    //
    if( $user_sig != '' )
    {
        $template->assign_block_vars('switch_advanced_qr.switch_signature_checkbox', []);
    }

    //
    // HTML toggle selection
    //
    if ( $board_config['allow_html'] )
    {
        $html_status = $lang['HTML_is_ON'];
        $template->assign_block_vars('switch_advanced_qr.switch_html_checkbox', []);
    }
    else
    {
        $html_status = $lang['HTML_is_OFF'];
    }

    //
    // BBCode toggle selection
    //
    if ( $board_config['allow_bbcode'] )
    {
        $bbcode_status = $lang['BBCode_is_ON'];
        $template->assign_block_vars('switch_advanced_qr.switch_bbcode_checkbox', []);
    }
    else
    {
        $bbcode_status = $lang['BBCode_is_OFF'];
    }

    //
    // Smilies toggle selection
    //
    if ( $board_config['allow_smilies'] )
    {
        $smilies_status = $lang['Smilies_are_ON'];
        $template->assign_block_vars('switch_advanced_qr.switch_smilies_checkbox', []);
    }
    else
    {
        $smilies_status = $lang['Smilies_are_OFF'];
    }

    //
    // Notify checkbox - only show if user is logged in
    //
    if ( $userdata['session_logged_in'] && $is_auth['auth_read'] )
    {
        if(!isset($mode))
        $mode = '';
	    
		if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
        {
            $template->assign_block_vars('switch_advanced_qr.switch_notify_checkbox', []);
        }
    }
/*****[BEGIN]******************************************
 [ Mod:     Lock/Unlock in quick reply         v1.0.0 ]
 ******************************************************/
if (  $is_auth['auth_mod'] )
{
/*****[BEGIN]******************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/
		$lock = ( isset($HTTP_POST_VARS['lock']) ) ? TRUE : FALSE;
		$unlock = ( isset($HTTP_POST_VARS['unlock']) ) ? TRUE : FALSE;

        if(!isset($submit))
        $submit = '';

        if(!isset($confirm))
        $confirm = '';

		if ( ($submit || $confirm) && ($lock || $unlock) && ($is_auth['auth_mod']) && ($mode != 'newtopic') && (!$refresh) )
		{
			$t_id = ( !isset($post_info['topic_id']) ) ? $topic_id : $post_info['topic_id'];

			if ( $unlock )
			{
/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
				log_action($lang['Unlock'], '', $t_id, $userdata['user_id'], '', '');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
				$sql = "UPDATE " . TOPICS_TABLE . "

				SET topic_status = " . TOPIC_UNLOCKED . "

				WHERE topic_id = " . $t_id . "

				AND topic_moved_id = 0";
			}
			else if ($lock)
			{
/*****[BEGIN]******************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
				log_action($lang['Lock'], '', $t_id, $userdata['user_id'], '', '');
/*****[END]********************************************
 [ Mod:     Log Moderator Actions              v1.1.6 ]
 ******************************************************/
				$sql = "UPDATE " . TOPICS_TABLE . "

				SET topic_status = " . TOPIC_LOCKED . "

				WHERE topic_id = " . $t_id . "

				AND topic_moved_id = 0";

			}

			if ($lock || $unlock)
			{
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
				}
			}
		}
/*****[END]********************************************
 [ Base:    Lock/Unlock in Posting Body        v1.0.1 ]
 ******************************************************/
        $sql = "SELECT topic_status FROM " . TOPICS_TABLE . " WHERE topic_id = '$reply_topic_id'";
            if (!$result = $db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not obtain topic status information', '', __LINE__, __FILE__, $sql);
            }
        $topic_status = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $topic_status = $topic_status['topic_status'];

    if ($topic_status == TOPIC_LOCKED) {
        $template->assign_block_vars('switch_advanced_qr.switch_unlock_topic', []);
        $template->assign_vars(['L_UNLOCK_TOPIC' => $lang['Unlock_topic'], 
		                        'S_UNLOCK_CHECKED' => ( $unlock ) ? 'checked="checked"' : '']
        );
    } elseif ($topic_status == TOPIC_UNLOCKED) {
        $template->assign_block_vars('switch_advanced_qr.switch_lock_topic', []);
		$template->assign_vars(['L_LOCK_TOPIC' => $lang['Lock_topic'], 
		                        'S_LOCK_CHECKED' => ( $lock ) ? 'checked="checked"' : '']
        );
    }
}
/*****[END]*********************************************
 [ Mod:     Lock/Unlock in quick reply          v1.0.0 ]
 ******************************************************/

    // Generate smilies listing for page output
    generate_smilies('inline', PAGE_POSTING);

    $template->assign_vars(['HTML_STATUS' => $html_status, 'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'), 'SMILIES_STATUS' => $smilies_status, 'BB_BOX' => Make_TextArea_Ret('message', '', 'post', '99.4%', '200px', true), 'L_OPTIONS' => $lang['Options'], 'L_DISABLE_HTML' => $lang['Disable_HTML_post'], 'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'], 'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'], 'L_ATTACH_SIGNATURE' => $lang['Attach_signature'], 'L_NOTIFY_ON_REPLY' => $lang['Notify'], 'S_HTML_CHECKED' => ( $html_on ) ? '' : 'checked="checked"', 'S_BBCODE_CHECKED' => ( $bbcode_on ) ? '' : 'checked="checked"', 'S_SMILIES_CHECKED' => ( $smilies_on ) ? '' : 'checked="checked"', 'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '', 'S_NOTIFY_CHECKED' => ( $notify_user ) ? 'checked="checked"' : '']
    );

}
else
{
    if ( !$html_on )
    {
        $hidden_form_fields .= '<input type="hidden" name="disable_html" value="on" />';
    }
    if ( !$bbcode_on )
    {
        $hidden_form_fields .= '<input type="hidden" name="disable_bbcode" value="on" />';
    }
    if ( !$smilies_on )
    {
        $hidden_form_fields .= '<input type="hidden" name="disable_smilies" value="on" />';
    }
    if ( $attach_sig )
    {
        $hidden_form_fields .= '<input type="hidden" name="attach_sig" value="on" />';
    }
    if ( $notify_user )
    {
        $hidden_form_fields .= '<input type="hidden" name="notify" value="on" />';
    }
}

if( !$userdata['session_logged_in'] || ( $mode == 'editpost' && $post_info['poster_id'] == ANONYMOUS ) )
{
    $template->assign_block_vars('switch_username_select', []);
}

//
// Output the data to the template
//
if ( (($userdata['user_open_quickreply']==1) && ($userdata['user_id'] != ANONYMOUS)) || (($board_config['anonymous_open_sqr']==1) && ($userdata['user_id'] == ANONYMOUS)) )
{
    $template->assign_block_vars('switch_open_qr_yes', []);
}
else
{
    $template->assign_block_vars('switch_open_qr_no', []);
}

$template->assign_vars([
    'U_POST_SQR_TOPIC' => 'javascript:sqr_show_hide();',
    'SQR_IMG' => $images['quickreply'],
    'L_POST_SQR_TOPIC' => $lang['Show_hide_quick_reply_form'],
    'BB_BOX' => ( $userdata['user_quickreply_mode'] == 1 ) ? Make_TextArea_Ret('message', '', 'post', '99.4%', '200px', true) : '<textarea data-autoresize id="message" name="message" style="resize: none; width: 100% !important; height: 200px; min-height: 200px;"></textarea>',
    'L_EMPTY_MESSAGE' => $lang['Empty_message'],
    'L_QUICK_REPLY' => $lang['Quick_Reply'],
    'L_USERNAME' => $lang['Username'],
    'L_SUBJECT' => $lang['Subject'],
    /*****[BEGIN]******************************************
     [ Mod:     Automatic Subject on Reply         v1.0.0 ]
     ******************************************************/
    'SUBJECT' => "Re: " . $forum_topic_data['topic_title'],
    /*****[END]********************************************
     [ Mod:     Automatic Subject on Reply         v1.0.0 ]
     ******************************************************/
    'L_MESSAGE_BODY' => $lang['Message_body'],
    'L_PREVIEW' => $lang['Preview'],
    'L_SUBMIT' => $lang['Submit'],
    'S_POST_ACTION' => append_sid("posting.$phpEx"),
    'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields,
]
);

$template->assign_var_from_handle('QRBODY', 'qrbody');

?>
