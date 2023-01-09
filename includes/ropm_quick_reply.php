<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                            ropm_quick_reply.php
 *                          ------------------------
 *   begin                : Saturday, March 15, 2003
 *   copyright            : Rondom
 *   original work by     : RustyDragon <dev@RustyDragon.com> http://www.RustyDragon.com
 *                          and Smartor <smartor_xp@hotmail.com> http://smartor.is-root.com
 *   contact              : <rondom@arcor.de>, http://www.rondom.gu2.info
 *   $Id: ropm_quick_reply.php,v 1.3.5 2004/01/06 22:02:20 Rondom Exp $
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// Debug Mode
$debug = False;
//

if ( $debug || $board_config['ropm_quick_reply'])
//if ( $board_config['ropm_quick_reply'])
{
$language = $board_config['default_lang'];
if ( !file_exists($phpbb_root_path . 'language/lang_' . $language . '/lang_main_pmqr.'.$phpEx) )
$language = 'english';
include($phpbb_root_path . 'language/lang_' . $language . '/lang_main_pmqr.' . $phpEx);

$template->set_filenames(array(
   'ropm_quick_reply_output' => 'ropm_quick_reply.tpl')
);

   $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
   $last_poster = $privmsg['username_1'];
   $last_msg = $privmsg['privmsgs_text'];
   $last_msg = str_replace(":1:$bbcode_uid", '', $last_msg);
   $last_msg = str_replace(":$bbcode_uid", '', $last_msg);
   $last_msg = '[quote="' . $last_poster . '"]' . $last_msg . '[/quote]';
   $last_msg = str_replace("\\", "\\\\", $last_msg);$last_msg = str_replace("'", "\'", $last_msg);$last_msg = str_replace(chr(13), '', $last_msg);$last_msg = str_replace("\n", "\\n", $last_msg);

   $s_hidden_fields = '
<input type="hidden" name="folder" value="'.$folder.'" />
<input type="hidden" name="mode" value="post" />
<input type="hidden" name="username" value="' . $privmsg['username_1'] . '" />
<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

   $template->assign_block_vars('ROPM_QUICK_REPLY', array(
      'POST_ACTION' => append_sid("privmsg.$phpEx"),
      'S_HIDDEN_FIELDS' => $s_hidden_fields,
      'SUBJECT' => ( ( !preg_match('/^Re:/', $privmsg['privmsgs_subject']) ) ? 'Re: ' : '' ) . str_replace('"', "&quot;", $privmsg['privmsgs_subject']),
      'BB_BOX' => Make_TextArea_Ret('message', '', 'post', '100%', '200px', true),
      'LAST_MSG' => $last_msg,
      'S_HTML_CHECKED' => ( !$userdata['user_allowhtml'] ) ? ' checked="checked"' : '',
      'S_BBCODE_CHECKED' => ( !$userdata['user_allowbbcode'] ) ? ' checked="checked"' : '',
      'S_SMILIES_CHECKED' => ( !$userdata['user_allowsmile'] ) ? ' checked="checked"' : '',
      'S_SIG_CHECKED' => ( $userdata['user_attachsig'] ) ? ' checked="checked"' : ''
      ));

if ( $board_config['allow_html'] )
   $template->assign_block_vars('ROPM_QUICK_REPLY.HTMLCB', array());
if ( $board_config['allow_bbcode'] )
{
   $template->assign_block_vars('ROPM_QUICK_REPLY.BBCODECB', array());
   if ( $board_config['ropm_quick_reply_bbc'] )
     $template->assign_block_vars('ROPM_QUICK_REPLY.BBCODEBUTT', array());
}
if ( $board_config['allow_smilies'] )
{
   $template->assign_block_vars('ROPM_QUICK_REPLY.SMILIESCB', array());
   generate_smilies_row();
}
   $template->assign_vars(array(
      'U_MORE_SMILIES' => append_sid("posting.$phpEx?mode=smilies"),
      'L_EMPTY_MESSAGE' => $lang['Empty_message'],
      'L_PREVIEW' => $lang['Preview'],
      'L_SUBMIT' => $lang['Submit'],
      'L_CANCEL' => $lang['Cancel'],
      'L_SUBJECT' => $lang['PMQR_Subject'],
      'L_MESSAGE' => $lang['Message'],
      'L_OPTIONS' => $lang['Options'],
      'L_ATTACH_SIGNATURE' => $lang['Attach_signature'],
      'L_DISABLE_HTML' => $lang['Disable_HTML_post'],
      'L_DISABLE_BBCODE' => $lang['Disable_BBCode_post'],
      'L_DISABLE_SMILIES' => $lang['Disable_Smilies_post'],
      'L_ALL_SMILIES' => $lang['PMQR_smilies'],
      'L_QUOTE_SELECTED' => $lang['PMQR_QuoteSelelected'],
      'L_NO_TEXT_SELECTED' => $lang['PMQR_QuoteSelelectedEmpty'],
      'L_EMPTY_MESSAGE' => $lang['Empty_message'],
      'L_EMPTY_SUBJECT' => $lang['Empty_subject'],
      'L_ENTER_URL' => $lang['PMQR_enter_url'],
      'L_ENTER_TITLE' => $lang['PMQR_enter_title'],
      'L_TITLE' => $lang['PMQR_title'],
      'L_EMPTY_URL' => $lang['PMQR_empty_url'],
      'L_EMPTY_TITLE' => $lang['PMQR_empty_title'],
      'L_ENTER_IMG_URL' => $lang['PMQR_enter_img_url'],
      'L_EMPTY_IMG_URL' => $lang['PMQR_empty_img_url'],
      'L_ERROR' => $lang['Error'],
      'L_QUOTE_LAST_MESSAGE' => $lang['PMQR_Quick_quote'],
      'L_QUICK_REPLY' => $lang['PMQR_Quick_Reply'],
      'L_CUT' => $lang['PMQR_cut'],
      'L_COPY' => $lang['PMQR_copy'],
      'L_PASTE' => $lang['PMQR_paste'],
      'L_MARKALL' => $lang['PMQR_markall'],
      'L_BOLD' => $lang['PMQR_bold'],
      'L_ITALIC' => $lang['PMQR_italic'],
      'L_UNDERLINE' => $lang['PMQR_underline'],
      'L_QUOTE' => $lang['PMQR_quote'],
      'L_CODE' => $lang['PMQR_code'],
      'L_IMAGE' => $lang['PMQR_image'],
      'L_URL' => $lang['PMQR_url'],
      'L_B' => $lang['PMQR_b'],
      'L_I' => $lang['PMQR_i'],
      'L_U' => $lang['PMQR_u'],
      'IMG_CUT' => $images['bbc_cut'] = $images['bbc_cut'] ?? '',
      'IMG_COPY' => $images['bbc_copy'] = $images['bbc_copy'] ?? '',
      'IMG_PASTE' => $images['bbc_paste'] = $images['bbc_paste'] ?? '',
      'IMG_MARKALL' => $images['bbc_markall'] = $images['bbc_markall'] ?? '',
      'IMG_BOLD' => $images['bbc_bold'] = $images['bbc_bold'] ?? '',
      'IMG_ITALIC' => $images['bbc_italic'] = $images['bbc_italic'] ?? '',
      'IMG_UNDERLINE' => $images['bbc_underline'] = $images['bbc_underline'] ?? '',
      'IMG_QUOTESELECTED' => $images['bbc_quoteselected'] = $images['bbc_quoteselected'] ?? '',
      'IMG_QUOTE' => $images['bbc_quote'] = $images['bbc_quote'] ?? '',
      'IMG_CODE' => $images['bbc_code'] = $images['bbc_code'] ?? '',
      'IMG_IMAGE' => $images['bbc_image'] = $images['bbc_image'] ?? '',
      'IMG_URL' => $images['bbc_url'] = $images['bbc_url'] ?? ''
));

if(!isset($lang['TRANSLATION_INFO']))
$lang['TRANSLATION_INFO'] = '';

$lang['TRANSLATION_INFO'] .= '<br />PM Quick Reply &copy; by <a href="http://www.rondom.gu2.info" target="rondom">Rondom</a> 2003-2004' . (( $lang['PMQR_TRANSLATION'] )?' :: '.$lang['PMQR_TRANSLATION'] : '') . (($debug)?'&nbsp;&nbsp;<span style="font-weight:bolder;font-size:20px;">Rondom\'s Debug Mode enabled!</span>':'');
$template->assign_var_from_handle('ROPM_QUICKREPLY_OUTPUT', 'ropm_quick_reply_output');
}

function generate_smilies_row()
{
   global $db, $board_config, $template;

   $max_smilies = $board_config['ropm_quick_reply_smilies'];

   switch ( SQL_LAYER )
   {
      // case 'mssql':
      // case 'mysqli':
      //    $sql = 'SELECT TOP ' . $max_smilies . 'min(emoticon) AS emoticon,
      //    min(code) AS code, smile_url
      //    FROM ' . SMILIES_TABLE . '
      //    GROUP BY [smile_url]';
      // break;

      default:
         $sql = 'SELECT emoticon, code, smile_url
         FROM ' . SMILIES_TABLE . '
         GROUP BY smile_url, smilies_id
         ORDER BY smilies_id LIMIT ' . $max_smilies;
      break;
   }
   if (!$result = $db->sql_query($sql))
   {
      message_die(GENERAL_ERROR, "Couldn't retrieve smilies list", '', __LINE__, __FILE__, $sql);
   }
   $smilies_count = $db->sql_numrows($result);
   $smilies_data = $db->sql_fetchrowset($result);
   for ($i = 0; $i < $smilies_count; $i++)
   {
         $template->assign_block_vars('ROPM_QUICK_REPLY.SMILIES', array(
            'CODE' => $smilies_data[$i]['code'],
            'URL' => $board_config['smilies_path'] . '/' . $smilies_data[$i]['smile_url'],
            'DESC' => $smilies_data[$i]['emoticon'])
         );
}
   $sql = 'SELECT COUNT(*) FROM ' . SMILIES_TABLE . '
           GROUP BY smile_url;';

   if (!$result = $db->sql_query($sql))
   {
      message_die(GENERAL_ERROR, "Couldn't count smilies", '', __LINE__, __FILE__, $sql);
   }
   $real_smilies_count = $db->sql_numrows($result);
   if ($real_smilies_count > $max_smilies || !$max_smilies)
   $template->assign_block_vars('ROPM_QUICK_REPLY.MORESMILIES', array());
}

?>