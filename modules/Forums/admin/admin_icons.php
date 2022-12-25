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

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

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
require(__DIR__ . '/pagestart.' . $phpEx);

//
// constants
//
$auths = [AUTH_ALL	=> $lang['Forum_ALL'], AUTH_REG	=> $lang['Forum_REG'], AUTH_MOD	=> $lang['Forum_MOD'], AUTH_ADMIN	=> $lang['Forum_ADMIN']];

if (!isset($nav_separator)) $nav_separator = '&nbsp;->&nbsp;';

//
// functions
//
function icons_read()
{
	global $phpEx, $phpbb_root_path;
	global $icones, $icon_defined_special, $map_icon;

	// read icons
	include(  __DIR__ . '/../../../includes/posting_icons.' . $phpEx);

	// build a map
	$map_icon = [];
	foreach ($icones as $i => $icone) {
     $map_icon[ $icones[$i]['ind'] ] = $i;
 }
}


function icons_write()
{
	global $phpEx, $phpbb_root_path, $template;
	global $icones, $icon_defined_special, $map_icon;

	// rebuild the map
	$map_icon = [];
	foreach ($icones as $i => $icone) {
     $map_icon[ $icones[$i]['ind'] ] = $i;
 }

	// set the outfile template
	$template->set_filenames(['outfile' => 'admin/icons_def_icons.tpl']
	);

	// process the icones
	foreach ($icones as $i => $icone) {
     $auth = "''";
     $auth = match ($icone['auth']) {
         AUTH_REG => 'AUTH_REG',
         AUTH_MOD => 'AUTH_MOD',
         AUTH_ADMIN => 'AUTH_ADMIN',
         default => 'AUTH_ALL',
     };
     $template->assign_block_vars('_outfile_icon', ['IND'	=> $icone['ind'], 'IMG'	=> str_replace("''", "\'", (string) $icone['img']), 'ALT'	=> str_replace("''", "\'", (string) $icone['alt']), 'AUTH'	=> $auth]
   		);
 }

	// process the default values
	reset($icon_defined_special);
	while ([$key, $data] = each($icon_defined_special))
	{
		$template->assign_block_vars('_outfile_default', ['NAME'		=> str_replace("''", "\'", (string) $key), 'LANG_KEY'	=> str_replace("''", "\'", (string) $data['lang_key']), 'ICON'		=> empty($data['icon']) ? 0 : $data['icon']]
		);
	}

	// generate a var for the content
	$file_data = '_file_data';
	$template->assign_var_from_handle($file_data, 'outfile');
	$res = $template->_tpldata['.'][0][$file_data];

	// output the file
	$filename = './../../../includes/def_icons.' . $phpEx;
	CHMOD($filename, 0666);
	unlink($filename);
	$f = fopen($filename, 'w' );
	$texte  = "<?php\n$res\n?>";
	fwrite( $f, $texte );
	ftruncate( $f );
	fclose( $f );
}


//
// read parameters
//
// read the icons
icons_read();

// mode
$mode = '';
if ( isset($_POST['mode']) || isset($_GET['mode']) )
{
	$mode = $_POST['mode'] ?? $_GET['mode'];
}
if (!in_array($mode, ['edit', 'up', 'dw', 'del'])) $mode = '';

// icon
$icon = -1;
if ( isset($_POST['icon']) || isset($_GET['icon']) )
{
	$icon = isset($_POST['icon']) ? (int) $_POST['icon'] : (int) $_GET['icon'];
}

// buttons
$create = isset($_POST['create']);
$submit = isset($_POST['submit']);
$confirm = isset($_POST['confirm']);
$cancel = isset($_POST['cancel']);
$refreh = isset($_POST['refresh']);

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
	if ($cancel) {
     // back to the main list
     $mode = '';
     $cancel = false;
 } elseif ($confirm) {
     // builded a new icones array
     $tmp = [];
     foreach ($icones as $i => $icone) {
         if ($icone['ind'] != $icon)
      			{
      				$tmp[] = $icone;
      			}
     }
     // move the result in place
     $icones = [];
     $icones = $tmp;
     // handle the replacement icon
     $replace_icon = -1;
     if (isset($_POST['replace_icon']))
   		{
   			$replace_icon = (int) $_POST['replace_icon'];
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
			$template->set_filenames(['body' => 'admin/admin_icons_delete_body.tpl']
			);

			// header
			$template->assign_vars(['L_TITLE'					=> $lang['Icon'], 'L_TITLE_EXPLAIN'			=> $lang['Icons_settings_explain'], 'L_TITLE_DELETE'			=> $lang['Icons_delete'], 'L_CONFIRM'					=> $lang['Confirm'], 'L_CANCEL'					=> $lang['Cancel']]
			);

			// vars
			$template->assign_vars(['MESSAGE'	=> ($used ? $lang['Icons_delete_explain'] : $lang['Icons_confirm_delete']), 'ICON'		=> get_icon_title($icon, 2, -1, true)]
			);

			// icon not used : validate the delete and send message
			if ($used)
			{
				// get the number of icon per row from config
				$icon_per_row = isset($board_config['icon_per_row']) ? (int) $board_config['icon_per_row'] : 10;
				if ($icon_per_row <= 1)
				{
						$icon_per_row = 10;
				}

				// builded a new icones array without the one to replace
				$tmp = [];
				foreach ($icones as $i => $icone) {
        if ($icone['ind'] != $icon)
   					{
   						$tmp[] = $icone;
   					}
    }

				// display the icons
				$template->assign_block_vars('replace',[]);
				$nb_row = (int) ((count($tmp)-1) / $icon_per_row)+1;
				$offset = 0;
				for ($i=0; $i < $nb_row; $i++)
				{
					$template->assign_block_vars('replace.row',[]);
     $tmpCount = count($tmp);
					for ($j=0; ( ($j < $icon_per_row) && ($offset < $tmpCount) ); $j++)
					{
						// send to cell or cell_none
						$template->assign_block_vars('replace.row.cell', ['ICON_ID'		=> $tmp[$offset]['ind'], 'ICON_CHECKED'	=> ($tmp[$offset]['ind'] == 0) ? ' checked="checked"' : '', 'ICON_IMG'		=> get_icon_title($tmp[$offset]['ind'], 2, -1, true)]
						);
						$offset++;
					}
				}
			}

			// system
			$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
			$s_hidden_fields .= '<input type="hidden" name="icon" value="' . $icon . '" />';
			$template->assign_vars(['NAV_SEPARATOR'		=> $nav_separator, 'S_ACTION'			=> append_sid("./admin_icons.$phpEx"), 'S_HIDDEN_FIELDS'	=> $s_hidden_fields]
			);

			// footer
			$template->pparse('body');
			include(__DIR__ . '/page_footer_admin.'.$phpEx);
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
	$icon_ids = [];
	if ($icon >= 0)
	{
		$icon_title		= $icones[ $map_icon[$icon] ]['alt'];
		$icon_url		= $icones[ $map_icon[$icon] ]['img'];
		$icon_auth		= $icones[ $map_icon[$icon] ]['auth'];
		reset($icon_defined_special);
		while ([$key, $data] = each($icon_defined_special))
		{
			if (isset($lang[ $data['lang_key'] ]) && $icon_defined_special[$key]['icon'] == $icon)
			{
				$icon_ids[] = $key;
			}
		}
	}

	// read the formular
	if (isset($_POST['icon_title']))	$icon_title		= trim(str_replace("\'", "''", (string) $_POST['icon_title']));
	if (isset($_POST['icon_url']))		$icon_url		= trim(str_replace("\'", "''", (string) $_POST['icon_url']));
	if (isset($_POST['icon_auth']))	$icon_auth		= trim(str_replace("\'", "''", (string) $_POST['icon_auth']));

	if ($refresh || $submit)
	{
		$icon_ids = [];
		$icon_ids = $_POST['ids'];
	}

	// process the buttons
	if ($cancel) {
     // back to the main list
     $mode = '';
     $cancel = false;
 } elseif ($submit) {
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
   			foreach ($icones as $i => $icone) {
          if ($icone['ind'] > $last)
      				{
      					$last = $icone['ind'];
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
     reset($icon_defined_special);
     while ([$key, $data] = each($icon_defined_special))
   		{
   			if (isset($lang[ $data['lang_key'] ]))
   			{
   				// reset a prec value
   				if ($icon_defined_special[$key]['icon'] == $icon)
   				{
   					$icon_defined_special[$key]['icon'] = '';
   				}
   
   				// set the new values
   				if ( in_array($key, $icon_ids) )
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
		$template->set_filenames(['body' => 'admin/admin_icons_edit_body.tpl']
		);

		// header
		$template->assign_vars(['L_TITLE'			=> $lang['Icon'], 'L_TITLE_KEY'		=> $lang['Icon_key'], 'L_TITLE_EXPLAIN'	=> $lang['Icons_settings_explain'], 'L_LANG'			=> $lang['Icons_lang_key'], 'L_LANG_EXPLAIN'	=> $lang['Icons_lang_key_explain'], 'L_ICON'			=> $lang['Icons_icon_key'], 'L_ICON_EXPLAIN'	=> $lang['Icons_icon_key_explain'], 'L_AUTH'			=> $lang['Icons_auth'], 'L_AUTH_EXPLAIN'	=> $lang['Icons_auth_explain'], 'L_DEFAULT'			=> $lang['Icons_defaults'], 'L_DEFAULT_EXPLAIN'	=> $lang['Icons_defaults_explain'], 'L_SUBMIT'			=> $lang['Submit'], 'L_REFRESH'			=> $lang['Refresh'], 'L_CANCEL'			=> $lang['Cancel']]
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
			$pic = '<img src="../../../' . $url . '" align="middle" alt="' . ($lang[$icon_title] ?? '') . '" border="0" />&nbsp;';
		}

		// prepare auth level list
		$s_auths = '';
		reset($auths);
		while ([$key, $data] = each($auths))
		{
			$selected = ($icon_auth == $key) ? ' selected="selected"' : '';
			$s_auths .= sprintf('<option value="%s"%s>%s</option>', $key, $selected, $data);
		}
		$s_auths = sprintf('<select name="icon_auth">%s</select>', $s_auths);

		// images list
		$s_icons = '<option value="" selected="selected">' . $lang['Image_key_pick_up'] . '</option>';
		ksort($images);
		reset($images);
		while ( [$image_key, $image_url] = each($images) )
		{
			if ( !is_array($image_url) )
			{
				$s_icons .= '<option value="' . $image_key . '">' . $image_key . '</option>';
			}
		}
		$s_icons = '<select name="icon_url_pickup_list" onChange="javascript:icon_url.value=this.options[this.selectedIndex].value; this.selectedIndex=0;">' . $s_icons . '</select>';

		// lang keys list
		$s_langs = '<option value="" selected="selected">' . $lang['Lang_key_pick_up'] . '</option>';
		ksort($lang);
		reset($lang);
		while ( [$lang_key, $lang_data] = each($lang) )
		{
			if ( !is_array($lang_data) )
			{
				$s_langs .= '<option value="' . $lang_key . '">' . $lang_key . '</option>';
			}
		}
		$s_langs = '<select name="lang_key_pickup_list" onChange="javascript:icon_title.value=this.options[this.selectedIndex].value; this.selectedIndex=0;">' . $s_langs . '</select>';

		// vars
		$template->assign_vars(['ICON_TITLE_KEY'	=> $icon_title, 'ICON_TITLE'		=> isset($lang[$icon_title]) ? '<br />' . $lang[$icon_title] : '', 'ICON'				=> $pic, 'ICON_URL'			=> $icon_url, 'S_AUTHS'			=> $s_auths, 'S_ICONS'			=> $s_icons, 'S_LANGS'			=> $s_langs]
		);

		// defaults assignments
		reset($icon_defined_special);
		while ([$key, $data] = each($icon_defined_special))
		{
			if (isset($lang[ $data['lang_key'] ]))
			{
				$template->assign_block_vars('defaults', ['NAME'		=> $lang[ $data['lang_key'] ], 'ID'		=> $key, 'CHECKED'	=> in_array($key, $icon_ids) ? ' checked="checked"' : '']
				);
			}
		}

		// system
		$s_hidden_fields = '<input type="hidden" name="mode" value="' . $mode . '" />';
		if ($icon >= 0)
		{
			$s_hidden_fields .= '<input type="hidden" name="icon" value="' . $icon . '" />';
		}
		$template->assign_vars(['NAV_SEPARATOR'		=> $nav_separator, 'S_ACTION'			=> append_sid("./admin_icons.$phpEx"), 'S_HIDDEN_FIELDS'	=> $s_hidden_fields]
		);

		// footer
		$template->pparse('body');
		include(__DIR__ . '/page_footer_admin.'.$phpEx);
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
		$total_posts += $row['count'];
		$row['post_icon'] = (int) $row['post_icon'];
		
		if (!isset($icones[$map_icon[$row['post_icon']]]['usage']))
		$icones[$map_icon[$row['post_icon']]]['usage'] = 0;
		
		if (isset($map_icon[$row['post_icon']]))
		{
			$icones[$map_icon[$row['post_icon']]]['usage'] += $row['count'];
		}
	}
	if ($total_posts <= 0) $total_posts = 1;

	// template
	$template->set_filenames(['body' => 'admin/admin_icons_body.tpl']
	);

	// header
	$template->assign_vars(['L_TITLE'			=> $lang['Icon'], 'L_TITLE_KEY'		=> $lang['Icon_key'], 'L_TITLE_KEY'		=> $lang['Icon_key'], 'L_TITLE_EXPLAIN'	=> $lang['Icons_settings_explain'], 'L_PERMISSIONS'		=> $lang['Icons_auth'], 'L_DEFAULT'			=> $lang['Icons_defaults'], 'L_USAGE'			=> $lang['Usage'], 'L_ACTION'			=> $lang['Action'], 'L_EDIT'			=> $lang['Edit'], 'L_DELETE'			=> $lang['Delete'], 'L_MOVEUP'			=> $lang['Move_up'], 'L_MOVEDW'			=> $lang['Move_down'], 'L_CREATE'			=> $lang['Create_new']]
	);

	// display icons
	foreach ($icones as $i => $icone) {

	if (!isset($icone['usage']))
	$icone['usage'] = 0;

     $template->assign_block_vars('row', ['ICON' => get_icon_title($icone['ind'], 1, -1, true), 
	                                  'ICON_KEY' => $icone['img'], 
									    'L_LANG' => $lang[ $icone['alt'] ] ?? $icone['alt'], 
									  'LANG_KEY' => isset($lang[ $icone['alt'] ]) ? '&nbsp;&nbsp;(' . $icone['alt'] . ')' : '', 
									    'L_AUTH' => $auths[ $icone['auth'] ], 
										 'USAGE' => ((int) $icone['usage'] > 0) ? $icone['usage'] . '&nbsp;(' . ( round( ($icone['usage'] * 100 )/ $total_posts ) ) . '%)' : '', 
									    'U_EDIT' => append_sid("./admin_icons.$phpEx?mode=edit&icon=" . $icone['ind']), 
									  'U_DELETE' => append_sid("./admin_icons.$phpEx?mode=del&icon=" . $icone['ind']), 
									  'U_MOVEUP' => append_sid("./admin_icons.$phpEx?mode=up&icon=" . $icone['ind']), 
									  'U_MOVEDW' => append_sid("./admin_icons.$phpEx?mode=dw&icon=" . $icone['ind'])]
   		);
     // list of default assignement
     reset($icon_defined_special);
     //while ([$key, $data] = each($icon_defined_special))
	 foreach ($icon_defined_special as $key => $data)
   		{
   			if ( ($data['icon'] == $icone['ind']) && isset($lang[ $data['lang_key'] ]) )
   			{
   				$template->assign_block_vars('row.default', ['L_DEFAULT' => $lang[ $data['lang_key'] ]]
   				);
   			}
   		}
 }

	// system
	$s_hidden_fields = '';
	$template->assign_vars(['NAV_SEPARATOR'		=> $nav_separator, 'S_ACTION'			=> append_sid("./admin_icons.$phpEx"), 'S_HIDDEN_FIELDS'	=> $s_hidden_fields]
	);

	// footer
	$template->pparse('body');
	include(__DIR__ . '/page_footer_admin.'.$phpEx);
}

?>
