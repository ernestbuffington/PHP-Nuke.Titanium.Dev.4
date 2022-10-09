<?php

/***************************************************************************
 *                              admin_icons.php
 *                            -------------------
 *   begin                : 07/09/2003
 *   copyright            : Ptirhiik
 *   email                : ptirhiik@wanadoo.fr
 *   version              : 1.0.2 - 28/10/2003
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

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['Icons_settings'] = $file;
	return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

//
// constants
//
$auths = array(
	AUTH_ALL	=> $lang['Forum_ALL'],
	AUTH_REG	=> $lang['Forum_REG'],
	AUTH_MOD	=> $lang['Forum_MOD'],
	AUTH_ADMIN	=> $lang['Forum_ADMIN'],
);

if (!isset($nav_separator)) $nav_separator = '&nbsp;->&nbsp;';

//
// functions
//
function icons_read()
{
	global $phpEx, $phpbb_root_path;
	global $icones, $icon_defined_special, $map_icon;

	// read icons
	include(  './../../../includes/posting_icons.' . $phpEx);

	// build a map
	$map_icon = array();
	for ($i=0; $i < count($icones); $i++)
	{
		$map_icon[ $icones[$i]['ind'] ] = $i;
	}
}


function icons_write()
{
	global $phpEx, $phpbb_root_path, $template;
	global $icones, $icon_defined_special, $map_icon;

	// rebuild the map
	$map_icon = array();
	for ($i=0; $i < count($icones); $i++)
	{
		$map_icon[ $icones[$i]['ind'] ] = $i;
	}

	// set the outfile template
	$template->set_filenames(array(
		'outfile' => 'admin/icons_def_icons.tpl')
	);

	// process the icones
	for ($i=0; $i < count($icones); $i++)
	{
		$auth = "''";
		switch ($icones[$i]['auth'])
		{
			case AUTH_REG:
				$auth = 'AUTH_REG';
				break;
			case AUTH_MOD:
				$auth = 'AUTH_MOD';
				break;
			case AUTH_ADMIN:
				$auth = 'AUTH_ADMIN';
				break;
			default:
				$auth = 'AUTH_ALL';
				break;
		}
		$template->assign_block_vars('_outfile_icon', array(
			'IND'	=> $icones[$i]['ind'],
			'IMG'	=> str_replace("''", "\'", $icones[$i]['img']),
			'ALT'	=> str_replace("''", "\'", $icones[$i]['alt']),
			'AUTH'	=> $auth,
			)
		);
	}

	// process the default values
	@reset($icon_defined_special);
	while (list($key, $data) = @each($icon_defined_special))
	{
		$template->assign_block_vars('_outfile_default', array(
			'NAME'		=> str_replace("''", "\'", $key),
			'LANG_KEY'	=> str_replace("''", "\'", $data['lang_key']),
			'ICON'		=> empty($data['icon']) ? 0 : $data['icon'],
			)
		);
	}

	// generate a var for the content
	$file_data = '_file_data';
	$template->assign_var_from_handle($file_data, 'outfile');
	$res = $template->_tpldata['.'][0][$file_data];

	// output the file
	$filename = './../../../includes/def_icons.' . $phpEx;
	@CHMOD($filename, 0666);
	@unlink($filename);
	$f = @fopen($filename, 'w' );
	$texte  = "<?php\n$res\n?>";
	@fputs( $f, $texte );
	@ftruncate( $f );
	@fclose( $f );
}


//
// read parameters
//
// read the icons
icons_read();

// mode
$mode = '';
if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = isset($HTTP_POST_VARS['mode']) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
}
if (!in_array($mode, array('edit', 'up', 'dw', 'del'))) $mode = '';

// icon
$icon = -1;
if ( isset($HTTP_POST_VARS['icon']) || isset($HTTP_GET_VARS['icon']) )
{
	$icon = isset($HTTP_POST_VARS['icon']) ? intval($HTTP_POST_VARS['icon']) : intval($HTTP_GET_VARS['icon']);
}

// buttons
$create = isset($HTTP_POST_VARS['create']);
$submit = isset($HTTP_POST_VARS['submit']);
$confirm = isset($HTTP_POST_VARS['confirm']);
$cancel = isset($HTTP_POST_VARS['cancel']);
$refreh = isset($HTTP_POST_VARS['refresh']);

// creation
if ($create)
{
	$icon = -1;
	$mode = 'edit';
}

// handle the mode
if ( !isset($map_icon[$icon]) && ($mode != 'edit') )
{
	$mode = '';
}
if ( !isset($map_icon[$icon]) )
{
	$icon = -1;
}

// adjust mode with buttons
if ($create)
{
	$mode = 'edit';
	$create = false;
}

//
// delete an icon
//
if ($mode == 'del')
{
	if ($cancel)
	{
		// back to the main list
		$mode = '';
		$cancel = false;
	}
	else if ($confirm)
	{
		// builded a new icones array
		$tmp = array();
		for ($i=0; $i < count($icones); $i++)
		{
			if ($icones[$i]['ind'] != $icon)
			{
				$tmp[] = $icones[$i];
			}
		}

		// move the result in place
		$icones = array();
		$icones = $tmp;

		// handle the replacement icon
		$replace_icon = -1;
		if (isset($HTTP_POST_VARS['replace_icon']))
		{
			$replace_icon = intval($HTTP_POST_VARS['replace_icon']);
			if (isset($map_icon[$replace_icon]))
			{
				// replace post icons
				$sql = "UPDATE " . POSTS_TABLE . " SET post_icon=$replace_icon WHERE post_icon=$icon";
				if (!$db->sql_query($sql)) message_die(GENERAL_ERROR, 'unable to update icon on posts', '', __LINE__, __FILE__, $sql);

				// replace topic icons
				$sql = "UPDATE " . TOPICS_TABLE . " SET topic_icon=$replace_icon WHERE topic_icon=$icon";
				if (!$db->sql_query($sql)) message_die(GENERAL_ERROR, 'unable to update icon on topics', '', __LINE__, __FILE__, $sql);
			}
		}

		// update the table
		icons_write();
		icons_read();

		// back to the main list
		$mode = '';
		$cancel = false;
	}

	if ($mode == 'del')
	{
		if (isset($map_icon[$icon]))
		{
			$used = ($icon == 0);

			// check if posts are using this icon
			if (!$used)
			{
				$sql = "SELECT * FROM " . POSTS_TABLE . " WHERE post_icon=$icon LIMIT 0, 1";
				if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, 'unable to access posts', '', __LINE__, __FILE__, $sql);
				$used = ($row = $db->sql_fetchrow($result));
			}

			// check if topics are using this icon
			if (!$used)
			{
				$sql = "SELECT * FROM " . TOPICS_TABLE . " WHERE topic_icon=$icon LIMIT 0, 1";
				if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, 'unable to access topics', '', __LINE__, __FILE__, $sql);
				$used = ($row = $db->sql_fetchrow($result));
			}

			// some prevent check
			$error = false;
			$error_msg = '';

			// can't remove icon 0
			if ($icon == 0)
			{
				$error = true;
				$error_msg = (empty($error_msg) ? '' : '<br />') . $lang['Icons_error_del_0'];
			}

			// send error messages
			if ($error)
			{
				message_die(GENERAL_MESSAGE, '<br /><br />' . $error_msg . '<br /><br /><br />');
			}

			// send the confirm or replace template
			$template->set_filenames(array(
				'body' => 'admin/admin_icons_delete_body.tpl')
			);

			// header
			$template->assign_vars(array(
				'L_TITLE'					=> $lang['Icon'],
				'L_TITLE_EXPLAIN'			=> $lang['Icons_settings_explain'],
				'L_TITLE_DELETE'			=> $lang['Icons_delete'],

				'L_CONFIRM'					=> $lang['Confirm'],
				'L_CANCEL'					=> $lang['Cancel'],
				)
			);

			// vars
			$template->assign_vars(array(
				'MESSAGE'	=> ($used ? $lang['Icons_delete_explain'] : $lang['Icons_confirm_delete']),
				'ICON'		=> get_icon_title($icon, 2, -1, true),
				)
			);

			// icon not used : validate the delete and send message
			if ($used)
			{
				// get the number of icon per row from config
				$icon_per_row = isset($board_config['icon_per_row']) ? intval($board_config['icon_per_row']) : 10;
				if ($icon_per_row <= 1)
				{
						$icon_per_row = 10;
				}

				// builded a new icones array without the one to replace
				$tmp = array();
				for ($i=0; $i < count($icones); $i++)
				{
					if ($icones[$i]['ind'] != $icon)
					{
						$tmp[] = $icones[$i];
					}
				}

				// display the icons
				$template->assign_block_vars('replace',array());
				$nb_row = intval( (count($tmp)-1) / $icon_per_row )+1;
				$offset = 0;
				for ($i=0; $i < $nb_row; $i++)
				{
					$template->assign_block_vars('replace.row',array());
					for ($j=0; ( ($j < $icon_per_row) && ($offset < count($tmp)) ); $j++)
					{
						// send to cell or cell_none
						$template->assign_block_vars('replace.row.cell', array(
							'ICON_ID'		=> $tmp[$offset]['ind'],
							'ICON_CHECKED'	=> ($tmp[$offset]['ind'] == 0) ? ' checked="checked"' : '',
							'ICON_IMG'		=> get_icon_title($tmp[$offset]['ind'], 2, -1, true),
							)
						);
						$offset++;
					}
				}
			}

			// system
			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="icon" value="' . $icon . '" />';
			$template->assign_vars(array(
				'NAV_SEPARATOR'		=> $nav_separator,
				'S_ACTION'			=> append_sid("./admin_icons.$phpEx"),
				'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
				)
			);

			// footer
			$template->pparse('body');
			include('./page_footer_admin.'.$phpEx);
		}
		else
		{
			// back to the main list
			$mode = '';
			$cancel = false;
		}
	}
}

//
// move an icon up and down
//
if ( ($mode == 'up') || ($mode == 'dw') )
{
	$inc = -1;
	if ($mode == 'dw') $inc = 1;

	// get the map value of the icon to moved and the dest one
	$map = $map_icon[$icon];
	$moveto = $map + $inc;

	// in the limits
	if ( ($moveto >= 0) && ($moveto < count($icones)) )
	{
		// swap
		$dst = $icones[$moveto];
		$icones[$moveto] = $icones[$map];
		$icones[$map] = $dst;
	}

	// back to the main list
	icons_write();
	icons_read();
	$mode = '';
}

//
// edit an icon
//
if ($mode == 'edit')
{
	// get the values from the existing state
	$icon_ids = array();
	if ($icon >= 0)
	{
		$icon_title		= $icones[ $map_icon[$icon] ]['alt'];
		$icon_url		= $icones[ $map_icon[$icon] ]['img'];
		$icon_auth		= $icones[ $map_icon[$icon] ]['auth'];
		@reset($icon_defined_special);
		while (list($key, $data) = @each($icon_defined_special))
		{
			if (isset($lang[ $data['lang_key'] ]))
			{
				if ($icon_defined_special[$key]['icon'] == $icon)
				{
					$icon_ids[] = $key;
				}
			}
		}
	}

	// read the formular
	if (isset($HTTP_POST_VARS['icon_title']))	$icon_title		= trim(str_replace("\'", "''", $HTTP_POST_VARS['icon_title']));
	if (isset($HTTP_POST_VARS['icon_url']))		$icon_url		= trim(str_replace("\'", "''", $HTTP_POST_VARS['icon_url']));
	if (isset($HTTP_POST_VARS['icon_auth']))	$icon_auth		= trim(str_replace("\'", "''", $HTTP_POST_VARS['icon_auth']));

	if ($refresh || $submit)
	{
		$icon_ids = array();
		$icon_ids = $HTTP_POST_VARS['ids'];
	}

	// process the buttons
	if ($cancel)
	{
		// back to the main list
		$mode = '';
		$cancel = false;
	}
	else if ($submit)
	{
		$error = false;
		$error_msg = '';

		// check if the lang_key is fitted
		if (empty($icon_title))
		{
			$error = true;
			$error_msg = (empty($error_msg) ? '' : '<br />') . $lang['Icons_error_title'];
		}

		// error found, send message
		if ($error)
		{
			message_die(GENERAL_MESSAGE, '<br /><br />' . $error_msg . '<br /><br /><br />');
		}

		// creation : get a new indice
		if ($icon < 0)
		{
			// find the last ind
			$last = -1;
			for ($i=0; $i < count($icones); $i++)
			{
				if ($icones[$i]['ind'] > $last)
				{
					$last = $icones[$i]['ind'];
				}
			}
			$icon = $last + 1;
			$map = count($icones);
		}
		else
		{
			// find the existing map entry
			$map = $map_icon[$icon];
		}

		// add or update the row
		$icones[$map]['ind'] = $icon;
		$icones[$map]['alt'] = $icon_title;
		$icones[$map]['img'] = $icon_url;
		$icones[$map]['auth'] = $icon_auth;

		// consider the default sets
		@reset($icon_defined_special);
		while (list($key, $data) = @each($icon_defined_special))
		{
			if (isset($lang[ $data['lang_key'] ]))
			{
				// reset a prec value
				if ($icon_defined_special[$key]['icon'] == $icon)
				{
					$icon_defined_special[$key]['icon'] = '';
				}

				// set the new values
				if ( @in_array($key, $icon_ids) )
				{
					$icon_defined_special[$key]['icon'] = $icon;
				}
			}
		}

		// generate the file
		icons_write();
		icons_read();

		// back to the main list
		$mode = '';
		$submit = false;
	}

	// detail
	if ($mode == 'edit')
	{
		// template
		$template->set_filenames(array(
			'body' => 'admin/admin_icons_edit_body.tpl')
		);

		// header
		$template->assign_vars(array(
			'L_TITLE'			=> $lang['Icon'],
			'L_TITLE_KEY'		=> $lang['Icon_key'],
			'L_TITLE_EXPLAIN'	=> $lang['Icons_settings_explain'],

			'L_LANG'			=> $lang['Icons_lang_key'],
			'L_LANG_EXPLAIN'	=> $lang['Icons_lang_key_explain'],
			'L_ICON'			=> $lang['Icons_icon_key'],
			'L_ICON_EXPLAIN'	=> $lang['Icons_icon_key_explain'],
			'L_AUTH'			=> $lang['Icons_auth'],
			'L_AUTH_EXPLAIN'	=> $lang['Icons_auth_explain'],
			'L_DEFAULT'			=> $lang['Icons_defaults'],
			'L_DEFAULT_EXPLAIN'	=> $lang['Icons_defaults_explain'],

			'L_SUBMIT'			=> $lang['Submit'],
			'L_REFRESH'			=> $lang['Refresh'],
			'L_CANCEL'			=> $lang['Cancel'],
			)
		);

		// get the icon url
		$url = $icon_url;
		if (isset($images[$icon_url]))
		{
			$url = $images[$icon_url];
		}
		$pic = '';
		if (!empty($url))
		{
			$pic = '<img src="../../../' . $url . '" align="middle" alt="' . (isset($lang[$icon_title]) ? $lang[$icon_title] : '') . '" border="0" />&nbsp;';
		}

		// prepare auth level list
		$s_auths = '';
		@reset($auths);
		while (list($key, $data) = @each($auths))
		{
			$selected = ($icon_auth == $key) ? ' selected="selected"' : '';
			$s_auths .= sprintf('<option value="%s"%s>%s</option>', $key, $selected, $data);
		}
		$s_auths = sprintf('<select name="icon_auth">%s</select>', $s_auths);

		// images list
		$s_icons = '<option value="" selected="selected">' . $lang['Image_key_pick_up'] . '</option>';
		@ksort($images);
		@reset($images);
		while ( list($image_key, $image_url) = @each($images) )
		{
			if ( !is_array($image_url) )
			{
				$s_icons .= '<option value="' . $image_key . '">' . $image_key . '</option>';
			}
		}
		$s_icons = '<select name="icon_url_pickup_list" onChange="javascript:icon_url.value=this.options[this.selectedIndex].value; this.selectedIndex=0;">' . $s_icons . '</select>';

		// lang keys list
		$s_langs = '<option value="" selected="selected">' . $lang['Lang_key_pick_up'] . '</option>';
		@ksort($lang);
		@reset($lang);
		while ( list($lang_key, $lang_data) = @each($lang) )
		{
			if ( !is_array($lang_data) )
			{
				$s_langs .= '<option value="' . $lang_key . '">' . $lang_key . '</option>';
			}
		}
		$s_langs = '<select name="lang_key_pickup_list" onChange="javascript:icon_title.value=this.options[this.selectedIndex].value; this.selectedIndex=0;">' . $s_langs . '</select>';

		// vars
		$template->assign_vars(array(
			'ICON_TITLE_KEY'	=> $icon_title,
			'ICON_TITLE'		=> isset($lang[$icon_title]) ? '<br />' . $lang[$icon_title] : '',
			'ICON'				=> $pic,
			'ICON_URL'			=> $icon_url,
			'S_AUTHS'			=> $s_auths,
			'S_ICONS'			=> $s_icons,
			'S_LANGS'			=> $s_langs,
			)
		);

		// defaults assignments
		@reset($icon_defined_special);
		while (list($key, $data) = @each($icon_defined_special))
		{
			if (isset($lang[ $data['lang_key'] ]))
			{
				$template->assign_block_vars('defaults', array(
					'NAME'		=> $lang[ $data['lang_key'] ],
					'ID'		=> $key,
					'CHECKED'	=> @in_array($key, $icon_ids) ? ' checked="checked"' : '',
					)
				);
			}
		}

		// system
		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
		if ($icon >= 0)
		{
			$s_hidden_fields .= '<input type="hidden" name="icon" value="' . $icon . '" />';
		}
		$template->assign_vars(array(
			'NAV_SEPARATOR'		=> $nav_separator,
			'S_ACTION'			=> append_sid("./admin_icons.$phpEx"),
			'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
			)
		);

		// footer
		$template->pparse('body');
		include('./page_footer_admin.'.$phpEx);
	}
}

if ($mode == '')
{
	// get the icons usage
	$sql = "SELECT post_icon, count(*) as count FROM " . POSTS_TABLE . " 
			GROUP BY post_icon 
			ORDER BY post_icon";
	if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, 'unable to count icons on posts', '', __LINE__, __FILE__, $sql);
	$total_posts = 0;
	while ($row = $db->sql_fetchrow($result))
	{
		$total_posts = $total_posts + $row['count'];
		$row['post_icon'] = intval($row['post_icon']);
		if (isset($map_icon[ $row['post_icon'] ]))
		{
			$icones[ $map_icon[ $row['post_icon'] ] ]['usage'] = $icones[ $map_icon[ $row['post_icon'] ] ]['usage'] + $row['count'];
		}
	}
	if ($total_posts <= 0) $total_posts = 1;

	// template
	$template->set_filenames(array(
		'body' => 'admin/admin_icons_body.tpl')
	);

	// header
	$template->assign_vars(array(
		'L_TITLE'			=> $lang['Icon'],
		'L_TITLE_KEY'		=> $lang['Icon_key'],
		'L_TITLE_KEY'		=> $lang['Icon_key'],
		'L_TITLE_EXPLAIN'	=> $lang['Icons_settings_explain'],

		'L_PERMISSIONS'		=> $lang['Icons_auth'],
		'L_DEFAULT'			=> $lang['Icons_defaults'],
		'L_USAGE'			=> $lang['Usage'],
		'L_ACTION'			=> $lang['Action'],

		'L_EDIT'			=> $lang['Edit'],
		'L_DELETE'			=> $lang['Delete'],
		'L_MOVEUP'			=> $lang['Move_up'],
		'L_MOVEDW'			=> $lang['Move_down'],

		'L_CREATE'			=> $lang['Create_new'],
		)
	);

	// display icons
	for ($i=0; $i < count($icones); $i++)
	{
		$template->assign_block_vars('row', array(
			'ICON'		=> get_icon_title($icones[$i]['ind'], 1, -1, true),
			'ICON_KEY'	=> $icones[$i]['img'],
			'L_LANG'	=> isset($lang[ $icones[$i]['alt'] ]) ? $lang[ $icones[$i]['alt'] ] : $icones[$i]['alt'],
			'LANG_KEY'	=> isset($lang[ $icones[$i]['alt'] ]) ? '&nbsp;&nbsp;(' . $icones[$i]['alt'] . ')' : '',
			'L_AUTH'	=> $auths[ $icones[$i]['auth'] ],
			'USAGE'		=> (intval($icones[$i]['usage']) > 0) ? $icones[$i]['usage'] . '&nbsp;(' . ( round( ($icones[$i]['usage'] * 100 )/ $total_posts ) ) . '%)' : '',
			'U_EDIT'	=> append_sid("./admin_icons.$phpEx?mode=edit&icon=" . $icones[$i]['ind']),
			'U_DELETE'	=> append_sid("./admin_icons.$phpEx?mode=del&icon=" . $icones[$i]['ind']),
			'U_MOVEUP'	=> append_sid("./admin_icons.$phpEx?mode=up&icon=" . $icones[$i]['ind']),
			'U_MOVEDW'	=> append_sid("./admin_icons.$phpEx?mode=dw&icon=" . $icones[$i]['ind']),
			)
		);

		// list of default assignement
		@reset($icon_defined_special);
		while (list($key, $data) = @each($icon_defined_special))
		{
			if ( ($data['icon'] == $icones[$i]['ind']) && isset($lang[ $data['lang_key'] ]) )
			{
				$template->assign_block_vars('row.default', array(
					'L_DEFAULT' => $lang[ $data['lang_key'] ],
					)
				);
			}
		}
	}

	// system
	$s_hidden_fields = '';
	$template->assign_vars(array(
		'NAV_SEPARATOR'		=> $nav_separator,
		'S_ACTION'			=> append_sid("./admin_icons.$phpEx"),
		'S_HIDDEN_FIELDS'	=> $s_hidden_fields,
		)
	);

	// footer
	$template->pparse('body');
	include('./page_footer_admin.'.$phpEx);
}

?>