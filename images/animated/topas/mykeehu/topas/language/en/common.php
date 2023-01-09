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
		'LOGIN_TOPIC'                       => 'You have to enter the password to access this topic.',

		'FORUM_ALLOW_TOPIC_PASSWORD'        => 'Allow topic passwords',
		'FORUM_ALLOW_TOPIC_PASSWORD_EXPLAIN'=> 'Allow users to use password protection for topics.',
		'FORUM_HAS_TOPIC_PASSWORD_EXPLAIN'  => 'WARNING: this option will disabled while forum has passworded topics!',
));
