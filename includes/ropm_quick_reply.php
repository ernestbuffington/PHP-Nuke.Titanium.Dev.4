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

if (!defined('IN_PHPBB2'))
{
    die('ACCESS DENIED');
}

//
// Debug Mode
$debug = False;
//

if ( $debug || $phpbb2_board_config['ropm_quick_reply'])
//if ( $phpbb2_board_config['ropm_quick_reply'])
{
$titanium_language = $phpbb2_board_config['default_lang'];
if ( !file_exists($phpbb2_root_path . 'language/lang_' . $titanium_language . '/lang_main_pmqr.'.$phpEx) )
$titanium_language = 'english';
include($phpbb2_root_path . 'language/lang_' . $titanium_language . '/lang_main_pmqr.' . $phpEx);

$phpbb2_template->set_filenames(array(
   'ropm_quick_reply_output' => 'ropm_quick_reply.tpl')
);

   $bbcode_uid = $privmsg['privmsgs_bbcode_uid'];
   $phpbb2_last_poster = $privmsg['username_1'];
   $last_msg = $privmsg['privmsgs_text'];
   $last_msg = str_replace(":1:$bbcode_uid", '', $last_msg);
   $last_msg = str_replace(":$bbcode_uid", '', $last_msg);
   $last_msg = '[quote="' . $phpbb2_last_poster . '"]' . $last_msg . '[/quote]';
   $last_msg = str_replace("\\", "\\\\", $last_msg);$last_msg = str_replace("'", "\'", $last_msg);$last_msg = str_replace(chr(13), '', $last_msg);$last_msg = str_replace("\n", "\\n", $last_msg);

   $s_hidden_fields = '
<input type="hidden" name="folder" value="'.$folder.'" />
<input type="hidden" name="mode" value="post" />
<input type="hidden" name="username" value="' . $privmsg['username_1'] . '" />
<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

   $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY', array(
      'POST_ACTION' => append_titanium_sid("privmsg.$phpEx"),
      'S_HIDDEN_FIELDS' => $s_hidden_fields,
      'SUBJECT' => ( ( !preg_match('/^Re:/', $privmsg['privmsgs_subject']) ) ? 'Re: ' : '' ) . str_replace('"', "&quot;", $privmsg['privmsgs_subject']),
      'BB_BOX' => Make_TextArea_Ret('message', '', 'post', '100%', '200px', true),
      'LAST_MSG' => $last_msg,
      'S_HTML_CHECKED' => ( !$userdata['user_allowhtml'] ) ? ' checked="checked"' : '',
      'S_BBCODE_CHECKED' => ( !$userdata['user_allowbbcode'] ) ? ' checked="checked"' : '',
      'S_SMILIES_CHECKED' => ( !$userdata['user_allowsmile'] ) ? ' checked="checked"' : '',
      'S_SIG_CHECKED' => ( $userdata['user_attachsig'] ) ? ' checked="checked"' : ''
      ));

if ( $phpbb2_board_config['allow_html'] )
   $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY.HTMLCB', array());
if ( $phpbb2_board_config['allow_bbcode'] )
{
   $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY.BBCODECB', array());
   if ( $phpbb2_board_config['ropm_quick_reply_bbc'] )
     $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY.BBCODEBUTT', array());
}
if ( $phpbb2_board_config['allow_smilies'] )
{
   $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY.SMILIESCB', array());
   generate_smilies_row();
}
   $phpbb2_template->assign_vars(array(
      'U_MORE_SMILIES' => append_titanium_sid("posting.$phpEx?mode=smilies"),
      'L_EMPTY_MESSAGE' => $titanium_lang['Empty_message'],
      'L_PREVIEW' => $titanium_lang['Preview'],
      'L_SUBMIT' => $titanium_lang['Submit'],
      'L_CANCEL' => $titanium_lang['Cancel'],
      'L_SUBJECT' => $titanium_lang['PMQR_Subject'],
      'L_MESSAGE' => $titanium_lang['Message'],
      'L_OPTIONS' => $titanium_lang['Options'],
      'L_ATTACH_SIGNATURE' => $titanium_lang['Attach_signature'],
      'L_DISABLE_HTML' => $titanium_lang['Disable_HTML_post'],
      'L_DISABLE_BBCODE' => $titanium_lang['Disable_BBCode_post'],
      'L_DISABLE_SMILIES' => $titanium_lang['Disable_Smilies_post'],
      'L_ALL_SMILIES' => $titanium_lang['PMQR_smilies'],
      'L_QUOTE_SELECTED' => $titanium_lang['PMQR_QuoteSelelected'],
      'L_NO_TEXT_SELECTED' => $titanium_lang['PMQR_QuoteSelelectedEmpty'],
      'L_EMPTY_MESSAGE' => $titanium_lang['Empty_message'],
      'L_EMPTY_SUBJECT' => $titanium_lang['Empty_subject'],
      'L_ENTER_URL' => $titanium_lang['PMQR_enter_url'],
      'L_ENTER_TITLE' => $titanium_lang['PMQR_enter_title'],
      'L_TITLE' => $titanium_lang['PMQR_title'],
      'L_EMPTY_URL' => $titanium_lang['PMQR_empty_url'],
      'L_EMPTY_TITLE' => $titanium_lang['PMQR_empty_title'],
      'L_ENTER_IMG_URL' => $titanium_lang['PMQR_enter_img_url'],
      'L_EMPTY_IMG_URL' => $titanium_lang['PMQR_empty_img_url'],
      'L_ERROR' => $titanium_lang['Error'],
      'L_QUOTE_LAST_MESSAGE' => $titanium_lang['PMQR_Quick_quote'],
      'L_QUICK_REPLY' => $titanium_lang['PMQR_Quick_Reply'],
      'L_CUT' => $titanium_lang['PMQR_cut'],
      'L_COPY' => $titanium_lang['PMQR_copy'],
      'L_PASTE' => $titanium_lang['PMQR_paste'],
      'L_MARKALL' => $titanium_lang['PMQR_markall'],
      'L_BOLD' => $titanium_lang['PMQR_bold'],
      'L_ITALIC' => $titanium_lang['PMQR_italic'],
      'L_UNDERLINE' => $titanium_lang['PMQR_underline'],
      'L_QUOTE' => $titanium_lang['PMQR_quote'],
      'L_CODE' => $titanium_lang['PMQR_code'],
      'L_IMAGE' => $titanium_lang['PMQR_image'],
      'L_URL' => $titanium_lang['PMQR_url'],
      'L_B' => $titanium_lang['PMQR_b'],
      'L_I' => $titanium_lang['PMQR_i'],
      'L_U' => $titanium_lang['PMQR_u'],
      'IMG_CUT' => $images['bbc_cut'],
      'IMG_COPY' => $images['bbc_copy'],
      'IMG_PASTE' => $images['bbc_paste'],
      'IMG_MARKALL' => $images['bbc_markall'],
      'IMG_BOLD' => $images['bbc_bold'],
      'IMG_ITALIC' => $images['bbc_italic'],
      'IMG_UNDERLINE' => $images['bbc_underline'],
      'IMG_QUOTESELECTED' => $images['bbc_quoteselected'],
      'IMG_QUOTE' => $images['bbc_quote'],
      'IMG_CODE' => $images['bbc_code'],
      'IMG_IMAGE' => $images['bbc_image'],
      'IMG_URL' => $images['bbc_url']
));
$titanium_lang['TRANSLATION_INFO'] .= '<br />PM Quick Reply &copy; by <a href="http://www.rondom.gu2.info" target="rondom">Rondom</a> 2003-2004' . (( $titanium_lang['PMQR_TRANSLATION'] )?' :: '.$titanium_lang['PMQR_TRANSLATION'] : '') . (($debug)?'&nbsp;&nbsp;<span style="font-weight:bolder;font-size:20px;">Rondom\'s Debug Mode enabled!</span>':'');
$phpbb2_template->assign_var_from_handle('ROPM_QUICKREPLY_OUTPUT', 'ropm_quick_reply_output');
}

function generate_smilies_row()
{
   global $titanium_db, $phpbb2_board_config, $phpbb2_template;

   $max_smilies = $phpbb2_board_config['ropm_quick_reply_smilies'];

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
   if (!$result = $titanium_db->sql_query($sql))
   {
      message_die(GENERAL_ERROR, "Couldn't retrieve smilies list", '', __LINE__, __FILE__, $sql);
   }
   $smilies_count = $titanium_db->sql_numrows($result);
   $smilies_data = $titanium_db->sql_fetchrowset($result);
   for ($i = 0; $i < $smilies_count; $i++)
   {
         $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY.SMILIES', array(
            'CODE' => $smilies_data[$i]['code'],
            'URL' => $phpbb2_board_config['smilies_path'] . '/' . $smilies_data[$i]['smile_url'],
            'DESC' => $smilies_data[$i]['emoticon'])
         );
}
   $sql = 'SELECT COUNT(*) FROM ' . SMILIES_TABLE . '
           GROUP BY smile_url;';

   if (!$result = $titanium_db->sql_query($sql))
   {
      message_die(GENERAL_ERROR, "Couldn't count smilies", '', __LINE__, __FILE__, $sql);
   }
   $real_smilies_count = $titanium_db->sql_numrows($result);
   if ($real_smilies_count > $max_smilies || !$max_smilies)
   $phpbb2_template->assign_block_vars('ROPM_QUICK_REPLY.MORESMILIES', array());
}

?>