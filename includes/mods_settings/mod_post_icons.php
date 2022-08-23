<?php
/***************************************************************************
 *                            mod_post_icons.php
 *                            ------------------
 *	begin			: 07/09/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 07/09/2003
 *
 *	mod version		: Post Icons v 0.0.3
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/
if(!defined('IN_PHPBB'))
exit("Hacking attempt");
# service functions
include_once( NUKE_INCLUDE_DIR.'functions_mods_settings.'.$phpEx);
# mod definition
$mod_name = 'Icons_settings';
$config_fields = array(
	'icon_per_row' => array(
		'lang_key'	=> 'Icons_per_row',
		'explain'	=> 'Icons_per_row_explain',
		'type'		=> 'TINYINT',
		'default'	=> '10',
		),
);
# init config table
init_board_config($mod_name, $config_fields);
?>
