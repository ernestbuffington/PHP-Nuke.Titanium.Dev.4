<?php
/***************************************************************************
 *                            def_icons.php
 *                            -------------
 *	begin			: 06/09/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 06/09/2003
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

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

$icones = array(
	array('ind'	=> 1, 'img'	=> 'modules/Forums/images/icon/icon1.png', 'alt' => 'icon_note', 'auth'	=> AUTH_ALL),
	array('ind'	=> 2, 'img'	=> 'modules/Forums/images/icon/icon2.png', 'alt' => 'icon_important', 'auth' => AUTH_ALL),
	array('ind'	=> 3, 'img'	=> 'modules/Forums/images/icon/icon3.png', 'alt' => 'icon_idea', 'auth'	=> AUTH_ALL),
	array('ind'	=> 4, 'img'	=> 'modules/Forums/images/icon/icon4.png', 'alt' => 'icon_warning', 'auth' => AUTH_ALL),
	array('ind'	=> 5, 'img'	=> 'modules/Forums/images/icon/icon5.png', 'alt' => 'icon_question', 'auth'	=> AUTH_ALL),
	array('ind'	=> 6, 'img'	=> 'modules/Forums/images/icon/icon6.png', 'alt' => 'icon_cool', 'auth'	=> AUTH_ALL),
	array('ind'	=> 7, 'img'	=> 'modules/Forums/images/icon/icon7.png', 'alt' => 'icon_funny', 'auth' => AUTH_ALL),
	array('ind'	=> 8, 'img'	=> 'modules/Forums/images/icon/icon8.png', 'alt' => 'icon_angry', 'auth' => AUTH_ALL),
	array('ind'	=> 9, 'img'	=> 'modules/Forums/images/icon/icon9.png', 'alt' => 'icon_sad', 'auth' => AUTH_ALL),
	array('ind'	=> 10, 'img' => 'modules/Forums/images/icon/icon10.png', 'alt'	=> 'icon_mocker', 'auth' => AUTH_ALL),
	array('ind'	=> 11, 'img' => 'modules/Forums/images/icon/icon11.png', 'alt'	=> 'icon_shocked', 'auth' => AUTH_ALL),
	array('ind'	=> 12, 'img' => 'modules/Forums/images/icon/icon12.png', 'alt'	=> 'icon_complicity', 'auth' => AUTH_ALL),
	array('ind'	=> 13, 'img' => 'modules/Forums/images/icon/icon13.png', 'alt'	=> 'icon_bad', 'auth' => AUTH_ALL),
	array('ind'	=> 14, 'img' => 'modules/Forums/images/icon/icon14.png', 'alt'	=> 'icon_great', 'auth'	=> AUTH_ALL),
	array('ind'	=> 15, 'img' => 'modules/Forums/images/icon/icon15.png', 'alt'	=> 'icon_disgusting', 'auth' => AUTH_ALL),
	array('ind'	=> 16, 'img' => 'modules/Forums/images/icon/icon16.png', 'alt'	=> 'icon_winner', 'auth' => AUTH_ALL),
	array('ind'	=> 17, 'img' => 'modules/Forums/images/icon/icon17.png', 'alt'	=> 'icon_impressed', 'auth'	=> AUTH_ALL),
	array('ind'	=> 18, 'img' => 'modules/Forums/images/icon/icon18.png', 'alt'	=> 'icon_roleplay', 'auth' => AUTH_ALL),
	array('ind'	=> 19, 'img' => 'modules/Forums/images/icon/icon19.png', 'alt'	=> 'icon_fight', 'auth'	=> AUTH_ALL),
	array('ind'	=> 20, 'img' => 'modules/Forums/images/icon/icon20.png', 'alt'	=> 'icon_loot', 'auth' => AUTH_ALL),
	array('ind'	=> 21, 'img' => 'modules/Forums/images/icon/icon21.png', 'alt'	=> 'icon_picture', 'auth' => AUTH_MOD),
	array('ind'	=> 22, 'img' => 'modules/Forums/images/icon/icon22.png', 'alt'	=> 'icon_calendar', 'auth' => AUTH_MOD),
	array('ind'	=> 0, 'img'	=> 'modules/Forums/images/icon/icon0.png', 'alt'	=> 'icon_none', 'auth' => AUTH_ALL),
);

// definition of special topic
$icon_defined_special = array(
		'POST_ATTACHMENT' => array(
		'lang_key'	=> 'Sort_Attachments',
		'icon'		=> 0),
		'POST_PICTURE' => array(
		'lang_key'	=> 'Pic_album',
		'icon'		=> 0),
		'POST_CALENDAR' => array(
		'lang_key'	=> 'Calendar',
		'icon'		=> 0),
		'POST_BIRTHDAY' => array(
		'lang_key'	=> 'Birthday',
		'icon'		=> 0),
		'POST_GLOBAL_ANNOUNCE' => array(
		'lang_key'	=> 'Post_Global_Announcement',
		'icon'		=> 0),
		'POST_ANNOUNCE' => array(
		'lang_key'	=> 'Post_Announcement',
		'icon'		=> 0),
		'POST_STICKY' => array(
		'lang_key'	=> 'Post_Sticky',
		'icon'		=> 0),
		'POST_NORMAL' => array(
		'lang_key'	=> 'Post_Normal',
		'icon'		=> 0),
	);

?>