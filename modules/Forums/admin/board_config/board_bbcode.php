<?php

if (!defined('BOARD_CONFIG')) {
    die('Access Denied');
}

$template->set_filenames(array(
    "bbcode_options" => "admin/board_config/board_bbcode.tpl")
);

//General Template variables
$template->assign_vars(array(
    "DHTML_ID" => "c" . $dhtml_id)
);

//Language Template variables
$template->assign_vars(array(

	"L_YOUTUBE_DIMENSIONS" => $lang['youtube_dimensions'],
	"L_TWITCH_DIMENSIONS" => $lang['twitch_dimensions'],
	"L_FACEBOOK_DIMENSIONS" => $lang['facebook_dimensions'],

	"YOUTUBE_WIDTH" => $new['youtube_width'],
	"YOUTUBE_HEIGHT" => $new['youtube_height'],
	"TWITCH_WIDTH" => $new['twitch_width'],
	"TWITCH_HEIGHT" => $new['twitch_height'],
	"FACEBOOK_WIDTH" => $new['facebook_width'],
	"FACEBOOK_HEIGHT" => $new['facebook_height'],

));

$template->pparse("bbcode_options");

?>