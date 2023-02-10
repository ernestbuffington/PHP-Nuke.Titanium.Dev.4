<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Theme Management
   ============================================
   Copyright (c) 2023 by The Titanium Group

   Filename      : themes.php
   Author        : Ernest Buffington (TheGhost), JeFFb68CAM
   Version       : 4.0.3
   Date          : 01.05.2023 (mm.dd.yyyy)

   Notes         : Allows admin to easily manage themes.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/
if (!defined('ADMIN_FILE')) 
{
  die ("Illegal File Access");
}

global $prefix, $db;

require_once(NUKE_CLASSES_DIR.'class.paginator.php');

function theme_header()
{
    global $admin_file, $admlang;
	
    OpenTable();
	
	echo "<div align=\"center\">\n"; #OD
    
	echo "<a href=\"$admin_file.php?op=themes\">"._THEMES_HEADER."</a>\n";
    echo "<br /><br />\n";
    
	echo "<table border='0' width='70%'>\n";
    echo "<tr>\n";
   
    echo "<td>".get_evo_icon('evo-sprite ok')."</td>\n";
    echo "<td><i>"._THEMES_DEFAULT."</i></td>\n";
    echo "<td>".get_default()."</td>\n";
   
    echo "</tr>\n";
    echo "<tr>\n";
   
    echo "<td>".get_evo_icon('evo-sprite ok')."</td>\n";
    echo "<td><i>"._THEMES_NUMTHEMES."</i></td><td>".count(get_themes('all'))."</td>\n";
   
    echo "</tr>\n";
    echo "<tr>\n";
   
    echo "<td>".get_evo_icon('evo-sprite ok')."</td>\n";
    echo "<td><i>"._THEMES_NUMUNINSTALLED."</i></td><td>".count(get_themes('uninstalled'))."</td>\n";
   
    echo "</tr>\n";
    echo "<tr>\n";
   
    echo "<td>".get_evo_icon('evo-sprite ok')."</td>\n";
    echo "<td><i>"._THEMES_MOSTPOPULAR."</i></td><td>".ThemeMostPopular()."</td>\n";
	
	echo "</tr>\n";
	echo "</table>\n";
	
	echo "<br />\n";
	
	echo "[ <a href=\"$admin_file.php?op=themes\">Themes Main</a> | <a href=\"$admin_file.php?op=theme_users\">"._THEMES_USER_OPTIONS."</a> | <a 
	href=\"$admin_file.php?op=theme_options\">"._THEMES_OPTIONS."</a> | <a href=\"$admin_file.php\">". $admlang['global']['header_return']."</a> ]\n";
	
	echo "</div>\n"; #CD
		
    CloseTable();
}

function ThemeError($error_message)
{
	DisplayError('<font style="font-size: 13px; font-weight: bold;">ERROR</font><br /><br />'.$error_message.'<br /><br />'._GOBACK,true);
}

function InstallTheme()
{
	
	global $admin_file, $db, $prefix, $module_name, $userinfo;
	
	$filename   = $_FILES['file']['name'];
	$path_parts = pathinfo($filename);
	$extension  = $path_parts['extension'];
	$extension  = strtolower($extension);
	
	$AllowedExtensions = array('zip');
	$valid = false;
	
	if (isset($filename) && !empty($filename))
	{
		if (in_array($extension, $AllowedExtensions))
		{
			$theme_name_check = substr($filename, 0, -4);
			
			if (!file_exists('themes/'. $theme_name_check))
			{
				if (move_uploaded_file($_FILES['file']['tmp_name'], 'themes/'.$_FILES['file']['name']))
				{
					$archive = new PclZip('themes/'.$filename);
					
					if (($list = $archive->listContent()) == 0)
					{
						ThemeError($archive->errorInfo(true));
					}
					
					foreach($list as $id => $file)
					{
						if (strpos($file['filename'], 'forums/user_delete_body.tpl') !== false)
						{
							$valid = true;
						}
					}
					
					if (!$valid)
					{	
						@unlink('themes/'.$_FILES['file']['name']);
						ThemeError('Not a valid theme zip file, make sure your zip file only includes theme folder with forums/user_delete_body.tpl and all other files inside it!');
					}
					
					if ($archive->extract(PCLZIP_OPT_PATH, 'themes/') == 0){
						ThemeError($archive->errorInfo(true));
					}
					
					if ($valid == true)
					{
						@unlink('themes/'.$_FILES['file']['name']);			
						$theme = substr($filename, 0, -4);
						redirect($admin_file.'.php?op=theme_quickinstall&amp;theme='.$theme);
					}		
				}
			} 
			else 
			{
				ThemeError('Theme already exists in databse!');
			}
		} 
		else 
		{
			ThemeError('Invalid extension, please make sure the theme you want to install is in a .zip file!');
		}
	} 
	else 
	{
		ThemeError('No file selected, please select a zip file with the theme you want to upload!');
	}
}

function downloadTheme($theme)
{
	global $admin_file, $aid, $db, $prefix, $module_name, $userinfo, $admin, $directory_mode;
	
	function RandomNumber($length=10)
	{
		$random = "";
		$chars  = "123456789abcdefghijklmnopqrstuvwxyz";
		
      //srand((double)microtime()*1000000); <- this horse shit is dead and gone
        mt_srand((double)microtime()*1_000_000); # <- this is the new horse shit
	
		for ($i = 0; $i<$length; $i++)
		{
			$random = $random.substr($chars, rand()%strlen($chars), 1);
		}
		
		return $random;
	}
	
	$random = RandomNumber();
	
	if (is_god($admin))
	{
		$themezip = NUKE_THEMES_SAVE_DIR.$theme.'-'.$random.'.zip';
		$themedir = NUKE_THEMES_DIR.$theme.'/';
		$downloadarchive = new PclZip($themezip);
		
		// Make sure the themes save directory exists else create it
		if (!is_dir(NUKE_THEMES_SAVE_DIR))
		{
			mkdir(NUKE_THEMES_SAVE_DIR, $directory_mode);
			copy(NUKE_INCLUDE_DIR.'index.html', NUKE_THEMES_SAVE_DIR.'index.html');
		}
		
		$v_list = $downloadarchive->create($themedir, PCLZIP_OPT_REMOVE_PATH, NUKE_THEMES_SAVE_DIR);
		
		if ($v_list == 0)
		{
			ThemeError($downloadarchive->errorInfo(true));
		}
		
		//  This is where the code goes to download the archive.
		redirect('includes/saved_themes/'.$theme.'-'.$random.'.zip');
	} 
	else 
	{
		redirect($admin_file.'.php?op=themes');
	}
}

function theme_footer()
{
    echo "<div align='right'>&copy; <a href='http://php-nuke-titanium.86it.us/modules.php?name=Forums&file=viewforum&f=5' target='_blank'>Theme Management</a>&nbsp;&nbsp;</div>\n"; #OD #CD
}

function display_main()
{
    global $admin_file, $aid, $db, $prefix, $bgcolor2, $bgcolor1, $bgcolor3;
	
    $installed_themes = get_themes('all');
    $uninstalled_themes = get_themes('uninstalled');

    function make_a_row($theme)
	{
        global $admin_file, $bgcolor2, $bgcolor1, $bgcolor3, $db, $prefix, $user_prefix, $admin;

        if (preg_match('/'._THEMES_THEME_MISSING.'/i',  ThemeGetStatus($theme['theme_name'], $theme['active'])))
		{
            if ($db->sql_query("DELETE FROM " . $prefix . "_themes WHERE theme_name = '".$theme['theme_name']."'"))
			{
                $db->sql_query("UPDATE " . $user_prefix . "_users SET theme = '" . get_default() . "' WHERE theme = '".$theme['theme_name']."'");
            }
			
            return;
        }

        $bold = (is_default($theme['theme_name'])) ? " style='font-weight: bold;'" : "";
				
        $default_link  = (is_default($theme['theme_name']) || !theme_exists($theme['theme_name'])) 
		? get_evo_icon('evo-sprite dislike', _THEMES_ISDEFAULT) : "<a href=\"$admin_file.php?op=theme_makedefault&amp;theme=" . $theme['theme_name'] . "\">".get_evo_icon('evo-sprite like', _THEMES_MAKEDEFAULT)."</a>";
        
		$activate_link = (is_default($theme['theme_name'])) ? get_evo_icon('evo-sprite bad', _THEMES_DEACTIVATE) : ((ThemeIsActive($theme['theme_name'], true)) 
		? "<a href=\"$admin_file.php?op=theme_deactivate&amp;theme=" . $theme['theme_name'] . "\">".get_evo_icon('evo-sprite bad', _THEMES_DEACTIVATE)."</a>" : "<a 
		href=\"$admin_file.php?op=theme_activate&amp;theme=" . $theme['theme_name'] . "\">".get_evo_icon('evo-sprite good', _THEMES_ACTIVE)."</a>");
		
        if ($theme['permissions'] == 1)
		{
            $permissions = _THEMES_ALLUSERS;
        } 
		elseif ($theme['permissions'] == 2)
		{
            $permissions = _THEMES_GROUPSONLY;
        } 
		elseif ($theme['permissions'] == 3)
		{
            $permissions = _THEMES_ADMINS;
        }
		
        echo "<tr $bold>\n";
        echo "<td align='center' class='row1'><img height='75' src='themes/".$theme['theme_name']."/images/thumb.png' alt='' /></td>\n";
        echo "<td align='center' class='row1'>" . $theme['theme_name'] . "</td>\n";
        echo "<td align='center' class='row1'>" . $theme['custom_name'] . "</td>\n";
        echo "<td align='center' class='row1'>" . ThemeNumUsers($theme['theme_name']) . "</td>\n";
        echo "<td align='center' class='row1'>" . ThemeGetStatus($theme['theme_name'], $theme['active']) . "</td>\n";
        echo "<td align='center' class='row1'>" . $permissions . "</td>\n";
        echo "<td align='center' class='row1'>\n";
        echo "<a href=\"$admin_file.php?op=theme_edit&amp;theme=" . $theme['theme_name'] . "\">" . get_evo_icon('evo-sprite edit', _THEMES_EDIT) . "</a> \n";
        echo "" . $default_link . " \n";
        echo "" . $activate_link . " \n";
        echo "<a data-colorbox href=\"index.php?tpreview=" . $theme['theme_name'] . "\">".get_evo_icon('evo-sprite search', _THEMES_VIEW)."</a> \n";
        echo "<a href=\"$admin_file.php?op=theme_uninstall&amp;theme=" .$theme['theme_name'] . "\">".get_evo_icon('evo-sprite delete', _THEMES_UNINSTALL)."</a>\n";
        echo "</td>\n";
        echo "</tr>\n";
    }


    function CategoryOpen($text, $data)
	{
        global $bgcolor3;
		
		echo "<div align align=\"center\">"; #OD
        
		echo "<table border='0' align='center' width='99%' class='bodyline'>\n";
        echo "<tr>";
        echo "<th height='20' width='100%' align='center'><span style=\"font-weight: bold\">$text</span></th>\n";
        echo "</tr>\n";
    
	    if (count($data) == 0)
		{
            echo "<tr>\n";
			echo "  <td width='100%' class='row1' align='center'><span style=\"font-weight: bold\">" . _THEMES_NONE . "</span></td>\n";
			echo "</tr>\n";
        }
    }
    
	function CategoryClose()
	{
        echo  "</table>\n";
		
	    echo "</div>"; #CD

    }

    OpenTable();

	echo "<div align align=\"center\">"; #OD

	echo "<table border='0' align='center' width='99%' cellpadding='4' cellspacing='1' class='forumline'>\n";
	echo '<tr>';
	echo '<td class="catHead" style="width: 18%; font-weight: bold; text-align: center">'._THEMES_PREVIEW.'</td>';
	echo '<td class="catHead" style="width: 15%; font-weight: bold; text-align: center">'._THEMES_NAME.'</td>';
	echo '<td class="catHead" style="width: 15%; font-weight: bold; text-align: center">'._THEMES_CUSTOMN.'</td>';
	echo '<td class="catHead" style="width: 10%; font-weight: bold; text-align: center">'._THEMES_NUMUSERS.'</td>';
	echo '<td class="catHead" style="width: 10%; font-weight: bold; text-align: center">'._THEMES_STATUS.'</td>';
	echo '<td class="catHead" style="width: 15%; font-weight: bold; text-align: center">'._THEMES_PERMISSIONS.'</td>';
	echo '<td class="catHead" style="width: 30%; font-weight: bold; text-align: center">'._THEMES_OPTS.'</td>';
	echo '</tr>';
	echo "<tr>\n";
	echo "<th width='100%' align='center' colspan='7'><span class=\"title\" style=\"font-weight: bold\">" . _THEMES_INSTALLED . "</span></th>\n";
	echo "</tr>\n";
	
	if (count($installed_themes) == 0)
	{
		echo "  <tr>\n";
		echo "    <td width='100%' colspan='7' align='center' class='row1'><span style=\"font-weight: bold\">" . _THEMES_NONE . "</span></td>\n";
		echo "  </tr>\n";
	} 
	else 
	{
		if (is_array($installed_themes))
		{
			foreach($installed_themes as $theme)
			{
				make_a_row($theme);
			}
		}
	}
	echo "</table><br />\n";

	echo "</div>"; #CD
	
	echo "<div align align=\"center\">"; #OD
	
	echo "<table border='0' align='center' width='99%' cellpadding='4' cellspacing='1' class='forumline'>\n";
	echo "<tr>\n";
	echo "<th width='100%' align='center' colspan='6'><span class=\"title\" style=\"font-weight: bold\">" . _THEMES_UNINSTALLED . "</span></th>\n";
	echo "</tr>\n";
	
	if (count($uninstalled_themes) == 0)
	{
		echo "<tr>\n";
		echo "<td width='100%' align='center' class='row1'><span style=\"font-weight: bold\">" . _THEMES_NONE . "</span></td>\n";
		echo "</tr>\n";
	}
	
	if (is_array($uninstalled_themes))
	{
		foreach($uninstalled_themes as $theme)
		{
			echo "<tr>\n";
			echo "<td width='40%' align='center' class='row1'>" . $theme . "</td>\n";
			echo "<td width='20%' align='center' class='row1'>" . ThemeGetStatus($theme) . "</td>\n";
			echo "<td width='40%' align='center' class='row1'>\n";
			echo "<a href=\"$admin_file.php?op=theme_quickinstall&amp;theme=" . $theme . "\">" . _THEMES_QINSTALL . "</a> | \n";
			echo "<a href=\"$admin_file.php?op=theme_install&amp;theme=" . $theme . "\">" . _THEMES_INSTALL . "</a> | \n";
			echo "<a href=\"$admin_file.php?op=theme_makedefault&amp;theme=" . $theme . "\">" . _THEMES_MAKEDEFAULT . "</a> | \n";
			echo "<a class=\"theme-preview\" href=\"index.php?tpreview=" . $theme . "\">" . _THEMES_VIEW . "</a> ]\n";
			echo "</td>\n";
			echo "</tr>\n";
		}
	}
	echo "</table><br />\n";

	echo "</div>"; #CD
	
	echo "<form method='post' action='' enctype='multipart/form-data'>\n";
	echo "<input type='hidden' name='op' value='InstallTheme' />\n";
	
	echo "<div align align=\"center\">"; #OD
	
	echo "<table border='0' align='center' width='99%' cellpadding='4' cellspacing='1' class='forumline'>\n";
	echo "<tr>\n";
	echo "<th width='100%' align='center'><span class=\"title\" style=\"font-weight: bold\">Import Theme: <i>Allowed Extensions ( .zip )</i></span></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td width='100%' class='row1' align='center'>\n";
	echo "<input type='file' class='mainoption' name='file' size='50' /> \n";
	echo "<input type='submit' value='Install Theme' class='mainoption' />\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";

	echo "</div>"; #CD

	echo "</form>\n";

    CloseTable();
}

function theme_edit($theme_name)
{

    global $prefix, $db, $admin_file, $admlang, $bgcolor2;
	
    $theme_info = $db->sql_ufetchrow("SELECT * FROM " . $prefix . "_themes WHERE theme_name = '$theme_name'");
	
	$selected1 = ($theme_info['permissions'] == 1) ? ' selected="selected"' : "";
    $selected2 = ($theme_info['permissions'] == 2) ? ' selected="selected"' : "";
    $selected3 = ($theme_info['permissions'] == 3) ? ' selected="selected"' : "";
	
    if (is_default($theme_info['theme_name']))
	{
        $disabled  = ' disabled="disabled"';
        $selected1 = ' selected="selected"';
        $selected2 = "";
		$selected3 = "";
	}
   
	$yes_selected = ($theme_info['active']) ? ' selected="selected"' : "";
    $no_selected = (!$theme_info['active']) ? ' selected="selected"' : "";

    OpenTable();
	
    echo "<form action='".$admin_file.".php' method='post'>\n";
	echo "<input type='hidden' name='theme_name' value='" . $theme_info['theme_name'] . "' />\n";
    echo "<input type='hidden' name='op' value='theme_edit_save' />\n";

	if (is_default($theme_info['theme_name']))
	{
        echo "<input type='hidden' name='active' value='1' />\n";
        echo "<input type='hidden' name='permissions' value='1' />\n";
    }

	echo "<div align align=\"center\">"; #OD

    echo "<table border='0' cellpadding='4' cellspacing='1' class='col-8' style='margin: auto;'>\n";
    echo "<tr>\n";
    echo "<td align='center' colspan='2' class='option'><span style=\"font-weight: bold\">". $theme_info['theme_name'] ."</span></td>\n";
    echo "</tr>\n";
    
	if (is_default($theme_info['theme_name']))
	{
		echo "<tr>\n";
		echo "<td align='center' colspan='2' class='option'><span style=\"font-weight: bold\">( "._THEMES_DEFAULT." )</span></td>\n";
		echo "</tr>\n";
    }
    
	echo   "<tr>\n";
    
	if (is_default($theme_info['theme_name']))
	{
        echo "<td align='center' colspan='2' class='option'>[ <strike>" . _THEMES_MAKEDEFAULT . "</strike> | <strike>" . _THEMES_UNINSTALL . "</strike> ]</td>\n";
    } 
	else 
	{
        echo "<td align='center' colspan='2' class='option'>[ <a 
		href=\"$admin_file.php?op=theme_makedefault&amp;theme=" . $theme_info['theme_name'] . "\">" . _THEMES_MAKEDEFAULT . "</a> | <a 
		href=\"$admin_file.php?op=theme_uninstall&amp;theme=" . $theme_info['theme_name'] . "\">" . _THEMES_UNINSTALL . "</a> ]</td>\n";
    }
    
	echo "</tr>\n";
    echo "<tr>\n";                     # CUSTOM THEME NAME
    echo "<td bgcolor='$bgcolor2'>" . _THEMES_CUSTOMNAME . "</td>\n";
    echo "<td><input type='text' name='custom_name' value='".$theme_info['custom_name']."' size='50' /></td>\n";
    echo "</tr>\n";
	echo "<tr>\n";                     # IS THE THEME ACTIVE
    echo "<td bgcolor='$bgcolor2'>" . _THEMES_ACTIVE . "</td>\n";
    echo "<td>\n";
    echo "<select name='active'$disabled>\n";
    echo "<option value='1'$yes_selected>" . _YES . "</option>\n"; # ACTIVE YES
    echo "<option value='0'$no_selected>" . _NO . "</option>\n";   # ACTIVE NO
    echo "</select>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td>" . $admlang['global']['who_view'] . "</td>\n"; # WHO IS ALLOWED TO VIEW THE CURRENT THEME
    echo "<td>\n";
    echo "<select name=\"permissions\"$disabled>\n";
    echo "<option value=\"1\"$selected1>" . $admlang['global']['all_visitors'] . "</option>\n"; # EVERYONE
    echo "<option value=\"2\"$selected2>".$admlang['global']['groups_only']."</option>\n";      # ONLY PEOPLE IN CERTAIN GROUPS
    echo "<option value=\"3\"$selected3>" . $admlang['global']['admins_only'] . "</option>\n";  # ONLY ADMINS CAN VIEW THIS THEME
    echo "</select>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td valign='top'>"._WHATGROUPS.":</td>\n"; # WHICH GROUP OF PEOPLE CAN USE THIS THEME
    echo "<td>\n";
    echo "<span class='tiny'>"._WHATGRDESC."</span><br />\n"; # View must be SET to Groups Only
    echo "<select name='groups[]' multiple='multiple' size='5'>\n";
    
	$ingroups = explode("-",$theme_info['groups']);
    $groupsResult = $db->sql_query("SELECT group_id, group_name FROM ".$prefix."_bbgroups WHERE group_description <> 'Personal User'");
	
    while(list($gid, $gname) = $db->sql_fetchrow($groupsResult))
	{
        $sel = in_array($gid,$ingroups) ? ' selected="selected"' : "";
        echo "<option value='$gid'$sel>$gname</option>\n";
    }
    echo "</select>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "<tr>\n";
    echo "<td colspan='2'>\n";
    	
	echo "<fieldset>\n";
    echo "<legend>" . _THEMES_ADV_OPTS . "</legend>\n"; # Your theme is compatible with Advanced Features
    
	echo "<div align align=\"center\">"; #OD
	
	echo "<table border='0' width='100%'>\n";
    
	if (is_file(NUKE_THEMES_DIR.$theme_info['theme_name'].'/theme_info.php'))
	{
        echo "<tr>\n";
		echo "<td align='center' colspan='2'><font color='green'>" . _THEMES_ADV_COMP . "</font></td>\n";
		echo "</tr>\n";
		
        include(NUKE_THEMES_DIR.$theme_info['theme_name'].'/theme_info.php');
    
	    $loaded_params = (!empty($theme_info['theme_info'])) ? explode(':::', $theme_info['theme_info']) : $default;
		
        if (empty($theme_info['theme_info']))
		{
            echo "<tr>\n";
			echo "<td align='center' colspan='2'><span style=\"font-weight: bold\">" . _THEMES_DEF_LOADED . "</span></td>\n";
			echo "</tr>\n";
        }
		
        if (is_array($params))
		{
            foreach($params as $key => $param)
			{
                echo "<tr>\n";
				echo "<td style='width:20%' bgcolor='$bgcolor2'>" . $param_names[$key] . "</td>\n";
				echo "<td style='width:80%'><input type='text' name='" . $param . "' value='".stripcslashes($loaded_params[$key])."'style='width: 100%' /></td>\n";
				echo "</tr>\n";
            
			}
        }
		
        echo "<tr>\n";
		echo "<td bgcolor='$bgcolor2'>" . _THEMES_REST_DEF . "</td>\n";
		echo "<td><input type='checkbox' value='1' name='restore_default' /></td>\n";
		echo "</tr>\n";
    } 
	else 
	{
        echo "<tr>\n";
		echo "<td align='center' colspan='2'>" . _THEMES_NOT_COMPAT . "</td>\n";
		echo "</tr>\n";
    }
    echo "</table>\n";

    echo "</div>"; #CD
    
	echo "</fieldset>\n";
    echo "<br />\n";
    echo "<center><input type='submit' class='mainoption' value='".$admlang['global']['save_changes']."' /> <input type='button' class='mainoption' value='Go Back' onclick='javascript:history.go(-1)' /></center>\n";
    echo "</td>\n";
    echo "</tr>";
    
	echo "</table>\n";

	echo "</div>"; #CD

	echo "</form>\n";
	
    CloseTable();
}

function theme_install($theme_name)
{
    global $prefix, $db, $bgcolor2, $admin_file, $admlang;

    OpenTable();
	
    echo "<form action='".$admin_file.".php' method='get'>\n";
	echo "<input type='hidden' name='theme_name' value='" . $theme_name . "' />";
	echo "<input type='hidden' name='op' value='theme_install_save' />";

	echo "<div align align=\"center\">"; #OD

	echo "<table border='0' cellpadding='2' cellspacing='2' style='margin: auto; width: 50%'>\n";
	echo "<tr>\n";
	echo "<td align='center' colspan='2' class='option'><span style=\"font-weight: bold\">". $theme_name ."</span></td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td bgcolor='$bgcolor2'>" . _THEMES_CUSTOMNAME . "</td>\n";
	echo "<td><input type='text' name='custom_name' value='".$theme_name."' size='50' /></td>\n";
	echo "</tr>";
	echo "<tr>\n";
	echo "<td bgcolor='$bgcolor2'>" . _THEMES_ACTIVE . "</td>";
	echo "<td><select name='active'><option value='1' selected='selected'>".$admlang['global']['yes']."</option><option value='0'>".$admlang['global']['no']."</option></select></td>\n";
	echo "</tr>";
	echo "<tr>\n";
	echo "<td>" . $admlang['global']['who_view'] . "</td>\n";
	echo "<td>\n";
	echo "<select name=\"permissions\">\n";
	echo "<option value=\"1\" selected='selected'>".$admlang['global']['all_visitors']."</option>\n";
	echo "<option value=\"2\">".$admlang['global']['groups_only']."</option>\n";
	echo "<option value=\"3\">".$admlang['global']['admins_only']."</option>\n";
	echo "</select>\n";
	echo "</td>\n";
	echo "</tr>";
	echo "<tr>\n";
	echo "<td valign='top'>"._WHATGROUPS.":</td>\n";
	echo "<td>\n";
	echo "<span class='tiny'>"._WHATGRDESC."</span><br />\n";
	echo "<select name='groups[]' multiple='multiple' size='5'>";

	$ingroups = explode("-",$theme_info['groups']);
	$groupsResult = $db->sql_query("select group_id, group_name from ".$prefix."_bbgroups WHERE group_description <> 'Personal User'");
	
	while(list($gid, $gname) = $db->sql_fetchrow($groupsResult))
	{
		$sel = in_array($gid,$ingroups) ? " selected='selected'" : "";
		echo "<option value='$gid'$sel>$gname</option>";
	}
	
	echo "</select>\n";
	echo "</td>\n";
	echo "</tr>";
	echo "<tr>\n";
	echo "<td colspan='2'>\n";
    echo "<fieldset>\n";
    echo "<legend>" . _THEMES_ADV_OPTS . "</legend>\n";
    
	echo "<div align align=\"center\">"; #OD

	echo "<table border='0' width='100%'>\n";
    
	if (is_file(NUKE_THEMES_DIR.$theme_name.'/theme_info.php'))
	{
        echo "<tr>\n";
		echo "<td align='center' colspan='2'><font color='green'>" . _THEMES_ADV_COMP . "</font></td>\n";
		echo "</tr>\n";
		
        include(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');
    
	    $loaded_params = $default;
		
		echo "<tr>\n";
		echo "<td align='center' colspan='2'><span style=\"font-weight: bold\">" . _THEMES_DEF_LOADED . "</span></td>\n";
		echo "</tr>\n";
		
        if (is_array($params))
		{
            foreach($params as $key => $param)
			{
                echo "<tr>\n";
				echo "<td bgcolor='$bgcolor2'>" . $param_names[$key] . "</td>\n";
				echo "<td><input type='text' name='" . $param . "' value='".htmlspecialchars($loaded_params[$key], ENT_QUOTES, 'UTF-8')."' size='50' /></td>\n";
				echo "</tr>\n";
            }
        }
		
        echo "<tr>\n";
		echo "<td bgcolor='$bgcolor2'>" . _THEMES_REST_DEF . "</td>\n";
		echo "<td><input type='checkbox' value='1' name='restore_default' /></td>\n";
		echo "</tr>\n";
    } 
	else 
	{
        echo "<tr>\n";
		echo "<td align='center' colspan='2'>" . _THEMES_NOT_COMPAT . "</td>\n";
		echo "</tr>\n";
    }
    echo "</table>\n"; 
	
	echo "</div>"; #CD
	
    echo "</fieldset>\n";
	echo "</td>\n";
	echo "</tr>";
	echo "<tr>\n";
	echo "<td align='center' colspan='2'><input type='submit' class='mainoption' value='"._THEMES_INSTALL."' /> <input type='button' class='mainoption' value='Go Back' onclick='javascript:history.go(-1)' /></td>\n";
	echo "</tr>";

	echo "</table>";

	echo "</div>"; #CD

	echo "</form>";
	
		
    CloseTable();
}

function update_theme($post)
{
    global $db, $prefix, $user_prefix, $admin_file, $cache;
	
    $error = false;
	
    if (is_array(isset($post['groups'])))
	{
        $post['groups'] = implode('-', $post['groups']);
    }
	
    $theme_info = array();
	
    if (file_exists(NUKE_THEMES_DIR.$post['theme_name'].'/theme_info.php'))
	{
        include(NUKE_THEMES_DIR.$post['theme_name'].'/theme_info.php');
		
        for($i=0, $maxi=count($params); $i<$maxi; $i++)
		{
            $param = $params[$i];
            $theme_info[] = $post[$param];
        }
		
        $theme_info = implode(':::', $theme_info);
		
        if (isset($post['restore_default']))
		{
            $theme_info = implode(':::', $default);
        }
    }

    $sql[] = "UPDATE " . $prefix . "_themes SET custom_name = '" . $post['custom_name'] . "' WHERE theme_name = '" . $post['theme_name'] . "'";
    $sql[] = "UPDATE " . $prefix . "_themes SET active = '" . $post['active'] . "' WHERE theme_name = '" . $post['theme_name'] . "'";
    $sql[] = "UPDATE " . $prefix . "_themes SET permissions = '" . $post['permissions'] . "' WHERE theme_name = '" . $post['theme_name'] . "'";
    $sql[] = "UPDATE " . $prefix . "_themes SET theme_info = '" . $theme_info . "' WHERE theme_name = '" . $post['theme_name'] . "'";
	
    if (($post['permissions'] > 1) || ($post['active'] != 1))
	{
        $sql[] = "UPDATE " . $user_prefix . "_users SET theme = '" . get_default() . "' WHERE theme = '" . $post['theme_name'] . "'";
    }
	
	if(!isset($post['groups']))
	$post['groups'] = '';
	
    $sql[] = "UPDATE " . $prefix . "_themes SET groups = '" . $post['groups'] . "' WHERE theme_name = '" . $post['theme_name'] . "'";
    
	foreach($sql as $query)
	{
        if (!$db->sql_query($query))
		{
            $error = true;
        }
    }
	
    $cache->delete($post['theme_name'], 'themes');
	
    if (!$error)
	{
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\">" . _THEMES_UPDATED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
		
        CloseTable();
    } 
	else 
	{
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\"><font color='red'>" . _THEMES_UPDATEFAILED . "</font></span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
			
        CloseTable();
    }
}

function install_save($post){
    global $db, $prefix, $admin_file;
	
	if(!isset($post['groups']))
	$post['groups'] = '';
	
    $post['groups'] = (is_array($post['groups'])) ? implode('-', $post['groups']) : '';

    $theme_info = array();
	
    if (file_exists(NUKE_THEMES_DIR.$post['theme_name'].'/theme_info.php'))
	{
        include(NUKE_THEMES_DIR.$post['theme_name'].'/theme_info.php');
		
        for($i=0, $maxi=count($params);$i<$maxi;$i++)
		{
            $param = $params[$i];
            $theme_info[] = $post[$param];
        }
		
        $theme_info = implode(':::', $theme_info);
		
        if (isset($post['restore_default']))
		{
            $theme_info = implode(':::', $default);
        }
    }

    $sql = "REPLACE INTO " . $prefix . "_themes VALUES('" . $post['theme_name'] . "', '" . $post['groups'] . "', '" . $post['permissions'] . "', '" . $post['custom_name'] . "', '" . $post['active'] . "', '" . $theme_info . "')";
	
    if ($db->sql_query($sql))
	{
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\">" . _THEMES_THEME_INSTALLED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
		
        CloseTable();
    } 
	else 
	{
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\"><font color='red'>" . _THEMES_THEME_INSTALLED_FAILED . "</font></span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
			
        CloseTable();
    }
}

function uninstall_theme($theme)
{
    global $db, $prefix, $user_prefix, $admin_file, $_POST;

    function uninstall_success()
	{
        global $admin_file;
		
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\">" . _THEMES_THEME_UNINSTALLED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
		
        CloseTable();
    }
	
    function uninstall_failed()
	{
        global $admin_file;
		
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\">" . _THEMES_THEME_UNINSTALLED_FAILED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
			
        CloseTable();
    }
	
    if (!isset($_POST['confirm']))
	{
        OpenTable();
		
		echo "<form name='confirm_uninstall' action='$admin_file.php' method='post'>\n";
		echo "<input type='hidden' name='theme' value='$theme' />";
		echo "<input type='hidden' name='op' value='theme_uninstall' />";
		echo "<input type='hidden' name='confirm' value='1' />";
		
		echo "<div align='center'>\n"; #OD
		
		echo "<span style=\"font-weight: bold\">" . _THEMES_UNINSTALL1 . "</span><br /><br />\n";
		echo _THEMES_UNINSTALL2 . "<br />\n";
		echo _THEMES_UNINSTALL3 . "<br /><br />";
		echo "<a href=\"javascript:document.forms['confirm_uninstall'].submit()\">" . _THEMES_THEME_UNINSTALL . "</a><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		
		echo "</div>\n"; #CD
		
		echo "</form>\n";
			
        CloseTable();
		return false;
    } 
	else 
	{
        if (!is_default($theme))
		{
            if ($db->sql_query("DELETE FROM " . $prefix . "_themes WHERE theme_name = '$theme'"))
			{
                $db->sql_query("UPDATE " . $user_prefix . "_users SET theme = '" . get_default() . "' WHERE theme = '$theme'");
                uninstall_success();
				return true;
            }
        }
		
        uninstall_failed();
		return false;
    }
	
    uninstall_failed();
	return false;
}

function theme_makedefault($theme)
{
    global $db, $prefix, $admin_file, $cache;
	
    if (!theme_installed($theme))
	{
        $sql = "INSERT INTO " . $prefix . "_themes VALUES('$theme', '', '1', '$theme', '1', '')";
        $db->sql_query($sql);
    }
	
    $sql = array();
    $sql[] = "UPDATE " . $prefix . "_themes SET active = '1' WHERE theme_name = '$theme'";
    $sql[] = "UPDATE " . $prefix . "_config SET default_Theme = '$theme'";
    $sql[] = "UPDATE " . $prefix . "_themes SET permissions = '1' WHERE theme_name = '$theme'";
	
    foreach($sql as $query)
	{
        $db->sql_query($query);
    }
	
    $cache->delete('nukeconfig', 'config');
    redirect($admin_file . '.php?op=themes');
}

function theme_deactivate($theme)
{
    global $db, $prefix, $user_prefix, $admin_file;

    function deactivate_success()
	{
        global $admin_file;
		
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\">" . _THEMES_THEME_DEACTIVATED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
			
        CloseTable();
    }
	
    function deactivate_failed()
	{
        global $admin_file;
		
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		echo "<span style=\"font-weight: bold\">" . _THEMES_THEME_DEACTIVATED_FAILED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		echo "</div>\n"; #CD
		
        CloseTable();
    }

    if (!$_POST['confirm'])
	{
        OpenTable();
		
		echo "<form name='confirm_deactivate' action='$admin_file.php' method='post'>\n";
		echo "<input type='hidden' name='theme' value='$theme' />";
		echo "<input type='hidden' name='op' value='theme_deactivate' />";
		echo "<input type='hidden' name='confirm' value='1' />";
		
		echo "<div align='center'>\n"; #OD
		
		echo "<span style=\"font-weight: bold\">" . _THEMES_DEACTIVATE1 . "</span><br /><br />\n";
		echo _THEMES_DEACTIVATE2 . "<br /><br />";
		echo "<a href=\"javascript:document.forms['confirm_deactivate'].submit()\">" . _THEMES_THEME_DEACTIVATE . "</a><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		
		echo "</div>\n"; #CD
		
		echo "</form>\n";
		
        CloseTable();
		return false;
    } 
	else 
	{
        if (!is_default($theme))
		{
            if ($db->sql_query("UPDATE " . $prefix . "_themes SET active='0' WHERE theme_name = '$theme'"))
			{
                if ($db->sql_query("UPDATE " . $user_prefix . "_users SET theme = '" . get_default() . "' WHERE theme = '$theme'"))
				{
					deactivate_success();
					return true;
                }
            }
        }
		
        deactivate_failed();
		return false;
    }
}

function theme_options($mode, $post)
{
    global $prefix, $db, $admin_file, $user_prefix, $admlang;
	
    if (!$mode) 
	$mode = 'main';
	
    switch($mode)
	{
        case 'main':
            list($usrthemeselect) = $db->sql_fetchrow($db->sql_query("SELECT config_value FROM " . $prefix . "_cnbya_config WHERE config_name = 'allowusertheme'"));
            $thmselect_selected_yes = ($usrthemeselect == 0) ? ' selected="selected"' : "";
            $thmselect_selected_no  = ($usrthemeselect == 1) ? ' selected="selected"' : "";
			
            OpenTable();
			
			echo "<form action='$admin_file.php' method='get'>\n";
			echo "<input type='hidden' name='op' value='theme_options' />\n";
			echo "<input type='hidden' name='act' value='save' />\n";
			
			echo "<div align='center'>\n"; #OD
			
			echo "<span style=\"font-weight: bold\">" . _THEMES_MANG_OPTIONS . "</span><br /><br />\n";
			echo "[ <a href='" . $admin_file . ".php?op=theme_transfer'>" . _THEMES_TRANSFER . "</a> ]<br /><br />\n";
			
			echo "<table border='1' class='bodyline' width='30%'>\n";
			echo "<tr>\n";
			echo "<td class='row2'>"._THEMES_ALLOWCHANGE."</td>\n";
			echo "<td class='row3'>\n";
			echo "<select name='allowusertheme'>\n";
			echo "<option value='0'$thmselect_selected_yes>" . _YES . "</option>\n";
			echo "<option value='1'$thmselect_selected_no>" . _NO . "</option>\n";
			echo "</select>\n";
			echo "</td>\n";
			echo "</tr>\n";
			echo "<tr>\n";
			echo "<td class='row2' colspan='2' align='center'><input type='submit' class='mainoption' value='" . $admlang['global']['submit'] . "' /></td>\n";
			echo "</tr>\n";
			echo "</table>\n";
			
			echo "</div>\n"; #CD
			
			echo "</form>\n";
				
            CloseTable();
        break;
        case 'save':
            $db->sql_query("UPDATE " . $prefix . "_cnbya_config SET config_value = '" . $post['allowusertheme'] . "' WHERE config_name = 'allowusertheme'");
			
            OpenTable();
			
			echo "<div align='center'>\n"; #OD
			
			echo "<span style=\"font-weight: bold\">" . _THEMES_SETTINGS_UPDATED . "</span><br /><br />\n";
			echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
			
			echo "</div>\n"; #CD
			
            CloseTable();
        break;
    }
}

function theme_transfer()
{
    global $prefix, $db, $admin_file, $user_prefix, $admlang;
	
    if (!isset($_POST['transfer']))
	{
        $from_themes = get_themes('dir');
        $to_themes   = get_themes('all');
		
        OpenTable();
		
		echo "<form action='$admin_file.php' method='post'>\n";
		echo "<input type='hidden' name='transfer' value='1' />\n";
		echo "<input type='hidden' name='op' value='theme_transfer' />\n";
		
		echo "<div align='center'>\n"; #OD
		
		echo "<span style=\"font-weight: bold\">" . _THEMES_THEME_TRANSFER . "</span><br />\n";
		echo "[ <a href='" . $admin_file . ".php?op=theme_options'>" . _THEMES_RETURN_OPTIONS . "</a> ]<br /><br />\n";
		
		echo "<table border='0' width='30%'>\n";
		echo "<tr>\n";
		echo "<td align='center'>"._THEMES_FROM."</td>\n";
		echo "<td align='center'>"._THEMES_TO."</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td align='center'>\n";
		echo "<select name='from'>\n";
		echo "<option value='all'>" . _THEMES_ALLUSERS . "</option>";
	
		foreach($from_themes as $theme)
		{
			echo "<option value='" . $theme['theme_name'] . "'>" . (($theme['custom_name']) ? $theme['custom_name'] : $theme['theme_name']) . " (" . ThemeCount($theme['theme_name']) . ")</option>";
		}
		
		echo "</select>\n";
		echo "</td>\n";
		echo "<td align='center'>\n";
		echo "<select name='to'>\n";
		echo "<option value='default'>" . _THEMES_DEFAULT . "</option>";
		
		foreach($to_themes as $theme)
		{
			echo "<option value='" . $theme['theme_name'] . "'>" . (($theme['custom_name']) ? $theme['custom_name'] : $theme['theme_name']) . "</option>";
		}
		
		echo "</select>\n";
		echo "</td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td colspan='2' align='center'><input type='submit' class='mainoption' value='" . $admlang['global']['submit'] . "' /></td>\n";
		echo "</tr>\n";
		echo "</table>\n";
		
		echo "</div>\n"; #CD
		
		echo "</form>\n";
			
        CloseTable();
    } 
	else 
	{
        $where  = ($_POST['from'] == 'all') ? "WHERE user_id <> '1'" : "WHERE theme='" . $_POST['from'] . "' AND user_id <> '1'";
        $to     = ($_POST['to'] == 'default') ? "" : $_POST['to'];
        $result = $db->sql_query("UPDATE " . $user_prefix . "_users SET theme = '" . $to . "' $where");
        $count  = intval($db->sql_affectedrows($result));
		
        OpenTable();
		
		echo "<div align='center'>\n"; #OD
		
		echo "<span style=\"font-weight: bold\">$count " . _THEMES_TRANSFER_UPDATED . "</span><br /><br />\n";
		echo "<a href=\"$admin_file.php?op=themes\">" . _THEMES_RETURN . "</a>\n";
		
		echo "</div>\n"; #CD
			
        CloseTable();
    }
}

function users_themes()
{
	global $db, $bgcolor3, $user_prefix, $admin_file, $admlang;

    OpenTable();
	
    echo "<form method='post' action='".$admin_file.".php'>\n";
    
	echo "<div align='center'>\n"; #OD

	echo "<table border='2' align='center' width='100%'>\n";

    echo "<tr>\n";
    echo "<th width='10%' align='center'><span class=\"content\" style=\"font-weight: bold\">" . _THEMES_USERID . "</span></th>\n";
    echo "<th width='30%' align='center'><span class=\"content\" style=\"font-weight: bold\">" . _THEMES_USERNAME . "</span></th>\n";
    echo "<th width='30%' align='center'><span class=\"content\" style=\"font-weight: bold\">" . _THEMES_USERTHEME . "</span></th>\n";
    echo "<th width='30%' align='center'><span class=\"content\" style=\"font-weight: bold\">" . _THEMES_FUNCTIONS. "</span></th>\n";
    echo "</tr>\n";

/*****[BEGIN]******************************************
 [ Base:    Pagination System                  v1.0.0 ]
 ******************************************************/
    $num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$user_prefix."_users"));
    $pagination = new Paginator(isset($_GET['page']),$num_rows);
    $pagination->set_Limit(15);
    $pagination->set_Links(3);
    $limit1 = $pagination->getRange1();
    $limit2 = $pagination->getRange2();
/*****[END]********************************************
 [ Base:    Pagination System                  v1.0.0 ]
 ******************************************************/
    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_id != '1' ORDER BY user_id LIMIT $limit1, $limit2");
	
    while($row = $db->sql_fetchrow($result))
	{
        $user_id   = intval($row['user_id']);
        $username  = Fix_Quotes($row['username']);
        $useremail = Fix_Quotes($row['user_email']);
		
        if (empty($row['name']))
		{
            $realname = _NOREALNAME;
        } 
		else 
		{
            $realname = Fix_Quotes($row['name']);
        }
		
        if (empty($row['theme']))
		{
            $usertheme = get_default();
        } 
		else 
		{
            $usertheme = Fix_Quotes($row['theme']);
        }
		
        echo "<tr valign=\"middle\">\n";
		echo "<td width='10%' align='center' bgcolor='$bgcolor3'>" .$user_id. "</td>\n";
		echo "<td width='30%' bgcolor='$bgcolor3'>" . $username . "</td>\n";
		echo "<td width='30%' bgcolor='$bgcolor3'>" . $usertheme . "</td>\n";
		echo "<td width='30%' align='center' bgcolor='$bgcolor3'>\n";
		echo "<select name='op' style='display: inline-block; width: 60%;'>\n";
		echo "<option value='theme_users_reset'>"._THEMES_USER_RESET."</option>\n";
		echo "<option value='theme_users_modify'>"._THEMES_USER_MODIFY."</option>\n";
		echo "</select>\n";

		echo "<input type=\"hidden\" name=\"theme_userid\" value=\"$user_id\" />\n";
		echo "<input type=\"hidden\" name=\"theme_username\" value=\"$username\" />\n";
		echo "<input type='submit' value='".$admlang['global']['submit']."' />\n";
		echo "</td>\n";
		echo "</tr>\n";
    }
    echo "</table>\n";

	echo "</div>\n"; #CD
    
	echo "</form>\n";

	CloseTable();
/*****[BEGIN]******************************************
 [ Base:    Pagination System                  v1.0.0 ]
 ******************************************************/
	OpenTable();

	echo "<div align='center'>\n"; #OD
	
	if ($pagination->getCurrent() == 1)
	{
        $first = " | "._THEMES_PAGE_FIRST." | ";
	} 
	else 
	{
		$first = " | <a href=\"" .  $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getFirst() . "\">"._THEMES_PAGE_FIRST."</a> |";
	}
    
	// Check to see that getPrevious() is returning a value. If not there will be no link.
    if ($pagination->getPrevious())
	{
        $prev = "<a href=\"" .  $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getPrevious() . "\">"._THEMES_PAGE_PREVIOUS."</a> | ";
    } 
	else 
	{
		$prev = _THEMES_PAGE_PREVIOUS." | ";
	}
    
	// Check to see that getNext() is returning a value. If not there will be no link.
    if ($pagination->getNext())
	{
        $next = "<a href=\"" . $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getNext() . "\">"._THEMES_PAGE_NEXT."</a> | ";
    } 
	else 
	{
		$next = _THEMES_PAGE_NEXT." | ";
	}

    // Check to see that getLast() is returning a value. If not there will be no link.
    if ($pagination->getLast())
	{
		$last = "<a href=\"" . $pagination->getPageName() . "?op=theme_users&amp;page=" . $pagination->getLast() . "\">"._THEMES_PAGE_LAST."</a>";
	} 
	else 
	{
		$last = _THEMES_PAGE_LAST;
	}
	
	// Since these will always exist just print out the values.  Result will be
	// Something like 1 of 4 of 25
	echo $pagination->getFirstOf()." "._THEMES_PAGE_OF." ".$pagination->getSecondOf()." "._THEMES_PAGE_OF." ".$pagination->getTotalItems()." ";
	
	// Print the values determined by the if statements above.
	echo $first . " " . $prev . " " . $next . " " . $last;

	echo "</div>\n"; #CD
	
	CloseTable();
/*****[END]********************************************
 [ Base:    Pagination System                  v1.0.0 ]
 ******************************************************/
}

function theme_users_reset($user_id, $username, $theme)
{
    global $db,$user_prefix, $admin_file;
	
    $user_id = intval($user_id);
    $username = Fix_Quotes($username);
    $result = $db->sql_query("UPDATE " . $user_prefix . "_users SET theme = '" . get_default() . "' WHERE user_id = '$user_id' AND username = '$username'");
    redirect($admin_file . '.php?op=themes');
}

function theme_users_modify($user_id, $username, $theme)
{
    global $bgcolor3, $db, $user_prefix, $admin_file;
	
    if (empty($theme) && !empty($user_id))
	{
        OpenTable();
		
	    echo "<div align='center'>\n"; #OD
		
        echo"<table border='2' align='center' width='100%'>\n";
		echo "<tr>\n";
		echo "<th width='16%' align='center'><span class=\"content\" style=\"font-weight: bold\">" . _THEMES_USERNAME . "</span></th>\n";
		echo "<th width='16%' align='center'><span class=\"content\" style=\"font-weight: bold\">" . _THEMES_USER_SELECT. "</span></th>\n";
		echo "</tr>";
    
	    $result = $db->sql_query("SELECT * FROM ".$user_prefix."_users WHERE user_id =".$user_id);
		
        if ($row = $db->sql_fetchrow($result))
		{
            $user_id = intval($row['user_id']);
            $username = Fix_Quotes($row['username']);
			
            if(empty($row['theme']))
			{
                $usertheme = get_default();
            } 
			else 
			{
                $usertheme = $row['theme'];
            }
			
            echo "<form method='post' action='".$admin_file.".php?op=theme_users_modify'>\n";
			
			echo "<tr valign=\"middle\">\n";
			echo "<td width='50%' align='center' bgcolor='$bgcolor3'>" . $row['username'] . "</td>\n";
			echo "<td width='50%' align='center' bgcolor='$bgcolor3'>\n";
			echo GetThemeSelect('themename')."\n";
			echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_id\" />\n";
			echo "<input type=\"hidden\" name=\"username\" value=\"$username\" />\n";
			echo "<input type=\"hidden\" name=\"theme\" value=\"$usertheme\" />\n";
			echo "<input type='submit' value='"._THEMES_SUBMIT."' />\n";
			echo "</td>\n";
			echo "</tr>\n";
			
			echo "</form>\n";
        }
        echo "</table>";

	    echo "</div>\n"; #CD
		
        CloseTable();
    } 
	elseif (isset($_POST['user_id']) && !empty($_POST['user_id']))
	{
        $db->sql_query("UPDATE " . $user_prefix . "_users SET theme = '" . $theme . "' WHERE user_id = '".$_POST['user_id']."'");
        redirect($admin_file.".php?op=theme_users");
    }
}

if (is_admin())
{
    include_once(NUKE_BASE_DIR.'header.php');
	
	if(!isset($_POST['themename']))
	$_POST['themename'] = '';
    
	switch($op){
        case 'theme_edit':
            theme_header();
            theme_edit($theme);
            theme_footer();
        break;
        case 'theme_install':
            theme_header();
            theme_install($theme);
            theme_footer();
        break;
        case 'theme_makedefault':
            theme_makedefault($theme);
        break;
        case 'theme_deactivate':
            theme_header();
            theme_deactivate($theme);
            theme_footer();
        break;
        case 'theme_activate':
            if (!is_default($theme)) {
                $sql = "UPDATE " . $prefix . "_themes SET active='1' WHERE theme_name = '$theme'";
                $db->sql_query($sql);
            }
            theme_header();
            display_main();
            theme_footer();
        break;
        case 'theme_install_save':
            theme_header();
            install_save($_GET);
            theme_footer();
        break;
        case 'theme_edit_save':
            theme_header();
            update_theme($_POST);
            theme_footer();
        break;
        case 'theme_quickinstall':
            if(!theme_installed($theme)) {
                $sql = "INSERT INTO " . $prefix . "_themes VALUES('$theme', '', '1', '$theme', '1', '')";
                $db->sql_query($sql);
            }
            theme_header();
            display_main();
            theme_footer();
        break;
        case 'theme_uninstall':
            theme_header();
            uninstall_theme($theme);
            theme_footer();
        break;
        case 'theme_options':
            theme_header();
			if(!isset($_GET['act']))
			$_GET['act'] = '';
			theme_options($_GET['act'], $_GET);
            theme_footer();
        break;
        case 'theme_transfer':
            theme_header();
            theme_transfer();
            theme_footer();
        break;
        case "theme_users":
			theme_header();
			users_themes();
			theme_footer();
        break;
        case "theme_users_reset":
			theme_header();
			theme_users_reset(Fix_Quotes($theme_userid),Fix_Quotes($theme_username), Fix_Quotes($_POST['themename']));
			theme_footer();
        break;
        case "theme_users_modify":
			theme_header();
			theme_users_modify(Fix_Quotes($theme_userid), Fix_Quotes($theme_username), Fix_Quotes($_POST['themename']));
			theme_footer();
        break;
		case "InstallTheme":
			theme_header();
			InstallTheme($file);
			theme_footer();
		break;
		// case "downloadTheme": 
		// 	theme_header();
		// 	downloadTheme($theme);
		// 	theme_footer();
  //       break;
        default:
            theme_header();
            display_main();
            theme_footer();
    }
	
    include_once(NUKE_BASE_DIR.'footer.php');
} 
else 
{
    echo "Access Denied";
}
