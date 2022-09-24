<?php
/***************************************************************************
 *						lang_extend_post_icons.php [English]
 *						--------------------------
 *	begin				: 28/09/2003
 *	copyright			: Ptirhiik
 *	email				: ptirhiik@clanmckeen.com
 *
 *	version				: 1.0.1 - 28/10/2003
 *
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

if ( !defined('IN_PHPBB2') )
{
	die("ACCESS DENIED");
}

// admin part
if ( $titanium_lang_extend_admin )
{
	$titanium_lang['Lang_extend_post_icons']		= 'Post Icons';

	$titanium_lang['Icons_settings_explain']		= 'Here you can add, edit or delete posts icons';
	$titanium_lang['Icons_auth']					= 'Auth level';
	$titanium_lang['Icons_auth_explain']			= 'The icon will be available only to the users suiting this requirement';
	$titanium_lang['Icons_defaults']				= 'Default assignement';
	$titanium_lang['Icons_defaults_explain']		= 'Those assignments will be used on the topics lists when no icon is defined for a topic';
	$titanium_lang['Icons_delete']				= 'Delete an icon';
	$titanium_lang['Icons_delete_explain']		= 'Please choose an icon in order to replace this one :';
	$titanium_lang['Icons_confirm_delete']		= 'Are you sure you want to delete this one ?';

	$titanium_lang['Icons_lang_key']				= 'Icon title';
	$titanium_lang['Icons_lang_key_explain']		= 'The icon title will be displayed when the user set his mouse on the icon (title or alt HTML statement). You can use text, or a key of the language array. <br />(check language/lang_<i>your_language</i>/lang_main.php).';
	$titanium_lang['Icons_icon_key']				= 'Icon';
	$titanium_lang['Icons_icon_key_explain']		= 'Icon url or key to the images array. <br />(check templates/<i>your_template</i>/<i>your_template</i>.cfg)';

	$titanium_lang['Icons_error_title']			= 'The icon title is empty';
	$titanium_lang['Icons_error_del_0']			= 'You can\'t remove the default empty icon';

	$titanium_lang['Refresh']					= 'Refresh';
	$titanium_lang['Usage']						= 'Usage';

	$titanium_lang['Image_key_pick_up']			= 'Pick up an image key';
	$titanium_lang['Lang_key_pick_up']			= 'Pick up a lang key';
}

$titanium_lang['Icon']					= 'Icon';
$titanium_lang['Icon_key']				= 'Key';
$titanium_lang['Icons_per_row']			= 'Icons per row';
$titanium_lang['Icons_per_row_explain']	= 'Set here the number of icons displayed per row in the posting display';
$titanium_lang['post_icon_title']		= 'Message Icon';
// icons
$titanium_lang['icon_none']				= 'No icon';
$titanium_lang['icon_note']				= 'Note';
$titanium_lang['icon_important']			= 'Important';
$titanium_lang['icon_idea']				= 'Idea';
$titanium_lang['icon_warning']			= 'Warning !';
$titanium_lang['icon_question']			= 'Question';
$titanium_lang['icon_cool']				= 'Cool';
$titanium_lang['icon_funny']				= 'Funny';
$titanium_lang['icon_angry']				= 'Grrrr !';
$titanium_lang['icon_sad']				= 'Snif !';
$titanium_lang['icon_mocker']			= 'Hehehe !';
$titanium_lang['icon_shocked']			= 'Oooh !';
$titanium_lang['icon_complicity']		= 'Complicity';
$titanium_lang['icon_bad']				= 'Bad !';
$titanium_lang['icon_great']				= 'Great !';
$titanium_lang['icon_disgusting']		= 'Beark !';
$titanium_lang['icon_winner']			= 'Gniark !';
$titanium_lang['icon_impressed']			= 'Oh yes !';
$titanium_lang['icon_roleplay']			= 'Roleplay';
$titanium_lang['icon_fight']				= 'Fight';
$titanium_lang['icon_loot']				= 'Loot';
$titanium_lang['icon_picture']			= 'Picture';
$titanium_lang['icon_calendar']			= 'Calendar event';

?>