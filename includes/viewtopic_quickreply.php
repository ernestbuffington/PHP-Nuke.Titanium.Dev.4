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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

$submit = $refresh = FALSE;
$hidden_form_fields = '<input type="hidden" name="mode" value="reply" />';
$hidden_form_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
$hidden_form_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
//
// Set toggles for various options
//
if ( !$phpbb2_board_config['allow_html'] )
{
    $html_on = 0;
}
else
{
    $html_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_html']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $phpbb2_board_config['allow_html'] : $userdata['user_allowhtml'] );
}

if ( !$phpbb2_board_config['allow_bbcode'] )
{
    $bbcode_on = 0;
}
else
{
    $bbcode_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_bbcode']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $phpbb2_board_config['allow_bbcode'] : $userdata['user_allowbbcode'] );
}

if ( !$phpbb2_board_config['allow_smilies'] )
{
    $smilies_on = 0;
}
else
{
    $smilies_on = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['disable_smilies']) ) ? 0 : TRUE ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? $phpbb2_board_config['allow_smilies'] : $userdata['user_allowsmile'] );
}

if ( ($submit || $refresh) && $phpbb2_is_auth['auth_read'])
{
    $notify_user = ( !empty($HTTP_POST_VARS['notify']) ) ? TRUE : 0;
}
else
{
    if ( $userdata['session_logged_in'] && $phpbb2_is_auth['auth_read'] )
    {
        $sql = "SELECT topic_id
            FROM " . TOPICS_WATCH_TABLE . "
            WHERE topic_id = $topic_id
                AND user_id = " . $userdata['user_id'];
        if ( !($result = $titanium_db->sql_query($sql)) )
        {
            message_die(GENERAL_ERROR, 'Could not obtain topic watch information', '', __LINE__, __FILE__, $sql);
        }

        $notify_user = ( $titanium_db->sql_fetchrow($result) ) ? TRUE : $userdata['user_notify'];
        $titanium_db->sql_freeresult($result);
    }
    else
    {
        $notify_user = ( $userdata['session_logged_in'] && $phpbb2_is_auth['auth_read'] ) ? $userdata['user_notify'] : 0;
    }
}

$attach_sig = ( $submit || $refresh ) ? ( ( !empty($HTTP_POST_VARS['attach_sig']) ) ? TRUE : 0 ) : ( ( $userdata['user_id'] == ANONYMOUS ) ? 0 : $userdata['user_attachsig'] );

$titanium_user_sig = ( $userdata['user_sig'] != '' ) ? $userdata['user_sig'] : '';

if ( (($userdata['user_quickreply_mode']==1) && ($userdata['user_id'] != ANONYMOUS)) || (($phpbb2_board_config['anonymous_sqr_mode']==1) && ($userdata['user_id'] == ANONYMOUS)) )
{
    $phpbb2_template->assign_block_vars('switch_advanced_qr', array());
    //
    // Signature toggle selection
    //
    if( $titanium_user_sig != '' )
    {
        $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_signature_checkbox', array());
    }

    //
    // HTML toggle selection
    //
    if ( $phpbb2_board_config['allow_html'] )
    {
        $html_status = $lang['HTML_is_ON'];
        $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_html_checkbox', array());
    }
    else
    {
        $html_status = $lang['HTML_is_OFF'];
    }

    //
    // BBCode toggle selection
    //
    if ( $phpbb2_board_config['allow_bbcode'] )
    {
        $bbcode_status = $lang['BBCode_is_ON'];
        $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_bbcode_checkbox', array());
    }
    else
    {
        $bbcode_status = $lang['BBCode_is_OFF'];
    }

    //
    // Smilies toggle selection
    //
    if ( $phpbb2_board_config['allow_smilies'] )
    {
        $smilies_status = $lang['Smilies_are_ON'];
        $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_smilies_checkbox', array());
    }
    else
    {
        $smilies_status = $lang['Smilies_are_OFF'];
    }

    //
    // Notify checkbox - only show if user is logged in
    //
    if ( $userdata['session_logged_in'] && $phpbb2_is_auth['auth_read'] )
    {
        if ( $mode != 'editpost' || ( $mode == 'editpost' && $post_info['poster_id'] != ANONYMOUS ) )
        {
            $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_notify_checkbox', array());
        }
    }
/*****[BEGIN]******************************************
 [ Mod:     Lock/Unlock in quick reply         v1.0.0 ]
 ******************************************************/
if (  $phpbb2_is_auth['auth_mod'] )
{
        $sql = "SELECT topic_status FROM " . TOPICS_TABLE . " WHERE topic_id = '$reply_topic_id'";
            if (!$result = $titanium_db->sql_query($sql)) {
            message_die(GENERAL_ERROR, 'Could not obtain topic status information', '', __LINE__, __FILE__, $sql);
            }
        $topic_status = $titanium_db->sql_fetchrow($result);
        $titanium_db->sql_freeresult($result);
        $topic_status = $topic_status['topic_status'];

    if ( $topic_status == TOPIC_LOCKED )
    {
        $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_unlock_topic', array());

        $phpbb2_template->assign_vars(array(
            'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
            'S_UNLOCK_CHECKED' => ( $unlock ) ? 'checked="checked"' : '')
        );
    }
    else if ( $topic_status == TOPIC_UNLOCKED )
    {
        $phpbb2_template->assign_block_vars('switch_advanced_qr.switch_lock_topic', array());

        $phpbb2_template->assign_vars(array(
            'L_LOCK_TOPIC' => $lang['Lock_topic'],
            'S_LOCK_CHECKED' => ( $lock ) ? 'checked="checked"' : '')
        );
    }
}
/*****[END]*********************************************
 [ Mod:     Lock/Unlock in quick reply          v1.0.0 ]
 ******************************************************/

    // Generate smilies listing for page output
    generate_smilies('inline', PAGE_POSTING);

    $phpbb2_template->assign_vars(array(

        'HTML_STATUS' => $html_status,
        'BBCODE_STATUS' => sprintf($bbcode_status, '<a href="' . append_titanium_sid("faq.$phpEx?mode=bbcode") . '" target="_phpbbcode">', '</a>'),
        'SMILIES_STATUS' => $smilies_status,
        'BB_BOX' => Make_TextArea_Ret('message', '', 'post', '99.4%', '200px', true),
        'L_OPTIONS' => $lang['Options'],
        'L_DISABLE_HTML' => $lang['Disable_HTML_post'],
        'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'],
        'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
        'L_ATTACH_SIGNATURE' => $lang['Attach_signature'],
        'L_NOTIFY_ON_REPLY' => $lang['Notify'],
        'S_HTML_CHECKED' => ( !$html_on ) ? 'checked="checked"' : '',
        'S_BBCODE_CHECKED' => ( !$bbcode_on ) ? 'checked="checked"' : '',
        'S_SMILIES_CHECKED' => ( !$smilies_on ) ? 'checked="checked"' : '',
        'S_SIGNATURE_CHECKED' => ( $attach_sig ) ? 'checked="checked"' : '',
        'S_NOTIFY_CHECKED' => ( $notify_user ) ? 'checked="checked"' : '')
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
    $phpbb2_template->assign_block_vars('switch_username_select', array());
}

//
// Output the data to the template
//
if ( (($userdata['user_open_quickreply']==1) && ($userdata['user_id'] != ANONYMOUS)) || (($phpbb2_board_config['anonymous_open_sqr']==1) && ($userdata['user_id'] == ANONYMOUS)) )
{
    $phpbb2_template->assign_block_vars('switch_open_qr_yes', array());
}
else
{
    $phpbb2_template->assign_block_vars('switch_open_qr_no', array());
}

$phpbb2_template->assign_vars(array(
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
    'S_POST_ACTION' => append_titanium_sid("posting.$phpEx"),
    'S_HIDDEN_FORM_FIELDS' => $hidden_form_fields)
);

$phpbb2_template->assign_var_from_handle('QRBODY', 'qrbody');

?>