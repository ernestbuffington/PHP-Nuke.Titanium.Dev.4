<?php
/**
*
* Topic Password. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017, Mykee
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

if(!defined('IN_PHPBB')){
	exit;
}

if(empty($lang) || !is_array($lang)){
	$lang = array();
}

$lang = array_merge($lang, array(
		'LOGIN_TOPIC'                       => 'Írd be a topik megnyitásához szükséges jelszót!',

		'FORUM_ALLOW_TOPIC_PASSWORD'        => 'Topikjelszó engedélyezése',
		'FORUM_ALLOW_TOPIC_PASSWORD_EXPLAIN'=> 'Engedélyezed, hogy a felhasználók jelszóval védjék a topikjaikat ebben a fórumban',
		'FORUM_HAS_TOPIC_PASSWORD_EXPLAIN'  => 'FIGYELEM: a kapcsoló addig nem használható, amíg a fórumban jelszavas topikok vannak!',
));
