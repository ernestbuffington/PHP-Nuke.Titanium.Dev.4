<?php

/************************************************************************
    Nuke-Evolution: Image Repository
    ======================================================
    Copyright (c) 2015 by lonestar-modules.com
    Author        : Lonestar
    Version       : 1.1.0
    Developer     : Lonestar - www.lonestar-modules.com				
    Notes         : N/A
************************************************************************/

define('_USERS_TABLE', $titanium_user_prefix.'_users');
define('_IMAGE_REPOSITORY_SETTINGS', $titanium_prefix.'_image_repository_settings');
define('_IMAGE_REPOSITORY_UPLOADS', $titanium_prefix.'_image_repository_uploads');
define('_IMAGE_REPOSITORY_USERS', $titanium_prefix.'_image_repository_users');

define('_IREPOSITORY_VERSION', '1.1.0');
define('_IREPOSITORY_CSS', 'modules/'.$titanium_module_name.'/includes/css/');
define('_IREPOSITORY_DIR', 'modules/'.$titanium_module_name.'/files/');
define('_IREPOSITORY_IMGS', 'modules/'.$titanium_module_name.'/images/');
define('_IREPOSITORY_INCLUDES', 'modules/'.$titanium_module_name.'/admin/inc/');
define('_IREPOSITORY_JS', 'modules/'.$titanium_module_name.'/includes/js/');
//define('_IREPOSITORY_USER_FOLDER', ($userinfo['user_id']+10000));
define('_IREPOSITORY_USER_FOLDER', ((($_POST['user']) ? $_POST['user'] : $userinfo['user_id'])+10000));
define('_IREPOSITORY_USER_FOLDER_THUMBS', ($userinfo['user_id']+10000).'/thumbs');
define('_IREPOSITORY_VERSION', '1.1.0');

define('_IREPOSITORY_THUMBHEIGHT','125');
define('_IREPOSITORY_THUMBWIDTH','240');

// define('_ENABLE_LIGHTBOX', true);
// define('_ENABLE_FANCYBOX', true);
// define('_ENABLE_FANCYBOX_BUTTONS', true);
// define('_ENABLE_FANCYBOX_THUMBS', true);
// define('_ENABLE_LIGHTBOX_EVOLUTION', true);
// define('_ENABLE_LIGHTBOX_EVOLUTION_FACEBOOK_THEME', true);
// define('_ENABLE_LYTEBOX', true);
// define('_ENABLE_HIGHSLIDE', true);

$imagecount = $titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$userinfo['user_id']."'"));
$mysettings	= $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_USERS."` WHERE `uid`='".$userinfo['user_id']."'"));
$myimages	= $titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$userinfo['user_id']."'"));
$quotainfo 	= _quota_percentages($userinfo['user_id']);


$JStoHead  = '<script type="text/javascript">';
$JStoHead .= '	var jquery_prefix				= '.((defined('NUKE_EVO')) ? 'nuke_jq' : '$').';'."\n";
$JStoHead .= '	var module_name 				= "'.$titanium_module_name.'";'."\n";
$JStoHead .= '	var version_installed			= "'._IREPOSITORY_VERSION.'";'."\n";
$JStoHead .= '	var upload_dir					= "'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'"'."\n";
$JStoHead .= '	var nukeurl						= "'.$nukeurl.'";'."\n";
$JStoHead .= '	var imagecount					= "'.$imagecount.'";'."\n";
$JStoHead .= '	var quota_limit					= "'.$quotainfo['quota'].'";'."\n";
$JStoHead .= '	var quota_user					= "'.(($quotainfo['total_size']) ? $quotainfo['total_size'] : 0).'";'."\n";
$JStoHead .= '	var background_color_default	= "'.$mysettings['background_color'].'";'."\n";
$JStoHead .= '	var border_color_default		= "'.$mysettings['border_color'].'";'."\n";
$JStoHead .= '	var custom_color_default		= "'.$mysettings['custom_color'].'";'."\n";
$JStoHead .= '	var percent_color_default		= "'.$mysettings['percent_color'].'";'."\n";
$JStoHead .= '	var lang_not_supported			= "'.$titanium_lang_new[$titanium_module_name]['NOTSUPPORTED'].'";'."\n";
$JStoHead .= '	var lang_attention 				= "'._string_to_upper(addslashes($titanium_lang_new[$titanium_module_name]['ATTENTION'])).'";'."\n";
$JStoHead .= '	var lang_imagelist				= "'._string_to_upper(addslashes($titanium_lang_new[$titanium_module_name]['MYIMAGES'])).'";'."\n";
$JStoHead .= '	var lang_directlink				= "'.$titanium_lang_new[$titanium_module_name]['DIRECT'].'";'."\n";
$JStoHead .= '	var lang_bbcode					= "'.$titanium_lang_new[$titanium_module_name]['BBCODE'].'";'."\n";
$JStoHead .= '	var lang_full					= "'.$titanium_lang_new[$titanium_module_name]['FULL'].'";'."\n";
$JStoHead .= '	var lang_html					= "'.$titanium_lang_new[$titanium_module_name]['HTML'].'";'."\n";
$JStoHead .= '	var lang_options				= "'.$titanium_lang_new[$titanium_module_name]['OPTIONS'].'";'."\n";
$JStoHead .= '	var lang_view					= "'.$titanium_lang_new[$titanium_module_name]['VIEW'].'";'."\n";
$JStoHead .= '	var lang_delete					= "'.$titanium_lang_new[$titanium_module_name]['DELETE'].'";'."\n";
$JStoHead .= '	var lang_more_codes				= "'.$titanium_lang_new[$titanium_module_name]['CODES_PLUS'].'";'."\n";
$JStoHead .= '	var module_page					= "'.$_GET['op'].'";'."\n";
$JStoHead .= '	var image_viewer 				= "'.addslashes(get_image_viewer('screens')).'";'."\n";
$JStoHead .= '</script>'."\n";
addJSToBody($JStoHead,'inline');

addCSSToHead(_IREPOSITORY_CSS.'jquery-confirm.css','file');
addCSSToHead(_IREPOSITORY_CSS.'mycss.css','file');
addCSSToHead(_IREPOSITORY_CSS.'jquery.modal.css','file');

addJSToBody(_IREPOSITORY_JS.'jquery-confirm.js','file');
addJSToBody(_IREPOSITORY_JS.'jquery.image-repository.js','file');
addJSToBody(_IREPOSITORY_JS.'jquery.modal.js','file');


//-------------------------------------------------------------------------
//	INCLUDES ALL THE JQUERY AND STYLE SHEETS.
//-------------------------------------------------------------------------
function color_selection($name,$default,$allow_custom=FALSE,$allow_transparent=FALSE,$width=FALSE)
{
	global $titanium_lang_new, $titanium_module_name, $settings;	
	$custom 		= array('custom' 			=> $titanium_lang_new[$titanium_module_name]['CUSTOM_COLOR']);
	$transparent 	= array('nocolor' 			=> 'Transparent');
	$phpbb2_colorOptions 	= array('aqua' 				=> $titanium_lang_new[$titanium_module_name]['AQUA'], 
							'aquamarine' 		=> $titanium_lang_new[$titanium_module_name]['AQUAMARINE'], 
							'black' 			=> (($name == 'border_color') ? $titanium_lang_new[$titanium_module_name]['BLACK_DEFAULT'] : $titanium_lang_new[$titanium_module_name]['BLACK']), 
							'blue' 				=> $titanium_lang_new[$titanium_module_name]['BLUE'], 
							'brown' 			=> $titanium_lang_new[$titanium_module_name]['BROWN'], 
							'cadetblue' 		=> $titanium_lang_new[$titanium_module_name]['CADETBLUE'], 
							'chocolate' 		=> $titanium_lang_new[$titanium_module_name]['CHOCOLATE'], 
							'chartreuse' 		=> $titanium_lang_new[$titanium_module_name]['CHARTREUSE'], 
							'crimson' 			=> $titanium_lang_new[$titanium_module_name]['CRIMSON'], 
							'cyan' 				=> $titanium_lang_new[$titanium_module_name]['CYAN'], 
							'darkblue' 			=> $titanium_lang_new[$titanium_module_name]['DARKBLUE'], 
							'darkgoldenrod' 	=> $titanium_lang_new[$titanium_module_name]['DARKGOLDEN'], 
							'darkgreen' 		=> $titanium_lang_new[$titanium_module_name]['DARKGREEN'], 
							'darkmagenta' 		=> $titanium_lang_new[$titanium_module_name]['DARKMAGENTA'], 
							'darkorchid' 		=> $titanium_lang_new[$titanium_module_name]['DARKORCHID'], 
							'darkred' 			=> $titanium_lang_new[$titanium_module_name]['DARKRED'], 
							'deepskyblue' 		=> $titanium_lang_new[$titanium_module_name]['DARKSKY'], 
							'dodgerblue' 		=> $titanium_lang_new[$titanium_module_name]['DODGERBLUE'], 
							'firebrick' 		=> $titanium_lang_new[$titanium_module_name]['FIREBRICK'], 
							'fuchsia' 			=> $titanium_lang_new[$titanium_module_name]['FUCHSIA'], 
							'gold' 				=> $titanium_lang_new[$titanium_module_name]['GOLD'], 
							'goldenrod' 		=> $titanium_lang_new[$titanium_module_name]['GOLDROD'], 
							'grey' 				=> $titanium_lang_new[$titanium_module_name]['GREY'], 
							'green' 			=> (($name == 'percent_color') ? $titanium_lang_new[$titanium_module_name]['GREEN_DEFAULT'] : $titanium_lang_new[$titanium_module_name]['GREEN']), 
							'indigo' 			=> $titanium_lang_new[$titanium_module_name]['INDIGO'], 
							'lawngreen' 		=> $titanium_lang_new[$titanium_module_name]['LAWNGREEN'], 
//-------------------------------------------------------------------------
//	JUST FOR YOU coRpSE :) - http://headshotdomain.net
//-------------------------------------------------------------------------
							'lime' 				=> $titanium_lang_new[$titanium_module_name]['LIME'], 
							'limegreen' 		=> $titanium_lang_new[$titanium_module_name]['LIMEGREEN'], 
//-------------------------------------------------------------------------
//	JUST FOR YOU coRpSE :) - http://headshotdomain.net
//-------------------------------------------------------------------------
							'magenta' 			=> $titanium_lang_new[$titanium_module_name]['MAGENTA'], 
							'midnightblue' 		=> $titanium_lang_new[$titanium_module_name]['MIDNIGHTBLUE'], 
							'olive' 			=> $titanium_lang_new[$titanium_module_name]['OLIVE'], 
							'orange' 			=> $titanium_lang_new[$titanium_module_name]['ORANGE'], 
							'orangered' 		=> $titanium_lang_new[$titanium_module_name]['ORANGERED'], 
							'plum' 				=> $titanium_lang_new[$titanium_module_name]['PLUM'], 
							'purple' 			=> $titanium_lang_new[$titanium_module_name]['PURPLE'], 
							'red' 				=> $titanium_lang_new[$titanium_module_name]['RED'], 
							'saddlebrown' 		=> $titanium_lang_new[$titanium_module_name]['SADDLE'], 
							'salmon' 			=> $titanium_lang_new[$titanium_module_name]['SALMON'], 
							'seagreen' 			=> $titanium_lang_new[$titanium_module_name]['SEAGREEN'], 
							'slateblue' 		=> $titanium_lang_new[$titanium_module_name]['BLUESLATE'], 
							'teal' 				=> $titanium_lang_new[$titanium_module_name]['TEAL'], 
							'tomato' 			=> $titanium_lang_new[$titanium_module_name]['TOMATO'], 
							'violet' 			=> $titanium_lang_new[$titanium_module_name]['VIOLET'], 
							'white' 			=> (($name == 'background_color') ? $titanium_lang_new[$titanium_module_name]['WHITE_DEFAULT'] : $titanium_lang_new[$titanium_module_name]['WHITE']), 
							'yellow' 			=> $titanium_lang_new[$titanium_module_name]['YELLOW']);
	return selectbox($name,$default,(($allow_custom == TRUE) ? (($allow_transparent == TRUE) ? array_merge($phpbb2_colorOptions,$transparent) : array_merge($phpbb2_colorOptions,$custom)) : $phpbb2_colorOptions),FALSE,$width);
}

function formatTimestamp_to_date($format, $gmepoch, $tz)
{
  global $phpbb2_board_config, $titanium_lang;
  return @gmdate($format, $gmepoch + (3600 * $tz));
}

function image_repo_settings_variables()
{
	global $titanium_db, $titanium_module_name, $cache;
	static $settings;
	
   	if(isset($settings) && is_array($settings)) 
	{ 
		return $settings; 
	}
	$result = $titanium_db->sql_query('SELECT `config_value`, `config_name` FROM `'._IMAGE_REPOSITORY_SETTINGS.'`');
	while ($row = $titanium_db->sql_fetchrow($result)) 
	{
		$settings[$row['config_name']] = $row['config_value'];
	}
	$titanium_db->sql_freeresult($result);
   	return $settings;
}

function image_repo_users_preferences()
{
	global $titanium_db, $titanium_module_name, $userinfo, $settings;
	$create_directories[] = _IREPOSITORY_DIR;
	$create_directories[] = _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER;
	$create_directories[] = _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS;
	foreach($create_directories as $directory)
	{
		@mkdir($directory,0755);
		@copy('images/index.html', $directory.'/index.html');
	}
	$checktable = $titanium_db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_USERS."` WHERE `uid`='".$userinfo['user_id']."'");
	$titanium_user_exists = $titanium_db->sql_numrows($checktable);
	if($titanium_user_exists == 0)
	{
		if($userinfo['user_id'] > 1)
		{
			$titanium_db->sql_query("INSERT INTO `"._IMAGE_REPOSITORY_USERS."` (`uid`, `background_color`, `border_color`, `folder`, `percent_color`, `quota`, `quota_request`) VALUES (".$userinfo['user_id'].", 'white', 'black', '"._IREPOSITORY_USER_FOLDER."', 'darkorchid', '".$settings['quota']."', 0)");
		}
	}
}

function index_navigation_header()
{
	global $titanium_lang_new, $titanium_module_name;
	echo '<table style="width:100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catHead',4).'>'._string_to_upper($titanium_lang_new[$titanium_module_name]['MODULE_NAME']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss('33.333%',FALSE,'row1').'>'."\n";	
	echo '      <table style="width:100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '        <tr>'."\n";
	echo '          <td'.tablecss('25%','center','row1').'><a'.linkcss().' href="modules.php?name='.$titanium_module_name.'">'.$titanium_lang_new[$titanium_module_name]['MAIN'].'</a></td>'."\n";
	echo '        </tr>'."\n";
	echo '        <tr>'."\n";
	echo '          <td'.tablecss('25%','center','row1').'><span style="text-decoration: line-through;">FAQ</span></td>'."\n";
	echo '        </tr>'."\n";
	echo '      </table>'."\n";	
	echo '    </td>'."\n";	
	echo '    <td'.tablecss('33.333%','center','row1').'><img src="'._IREPOSITORY_IMGS.'logo.png" border="0" /></td>'."\n";	
	echo '    <td'.tablecss('33.333%',FALSE,'row1').'>'."\n";	
	echo '      <table style="width:100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '        <tr>'."\n";
	echo '          <td'.tablecss('25%','center','row1').'><a'.linkcss().' href="modules.php?name='.$titanium_module_name.'&amp;op=quota">'.$titanium_lang_new[$titanium_module_name]['QUOTA'].'</a></td>'."\n";
	echo '        </tr>'."\n";
	echo '        <tr>'."\n";
	echo '          <td'.tablecss('25%','center','row1').'><a'.linkcss().' href="modules.php?name='.$titanium_module_name.'&amp;op=settings">'.$titanium_lang_new[$titanium_module_name]['SETTINGS'].'</a></td>'."\n";
	echo '        </tr>'."\n";
	echo '      </table>'."\n";	
	echo '    </td>'."\n";		
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',4).'>'.((is_admin()) ? '[ <a'.linkcss().' href="modules.php?name='.$titanium_module_name.'&amp;op=users">'._string_to_upper($titanium_lang_new[$titanium_module_name]['USER_ADMINISTRATION']).'</a> ]' : '').'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo '<br'.(($_GET['page']) ? (($_GET['page'] == 1 || $_GET['op'] == 'users') ? '' : ' style="display:none;"') : '').' />';
}

function inputfield($name='',$type='text',$size=FALSE,$styleSize=FALSE,$max=FALSE,$value='',$autocomplete=FALSE,$disable=FALSE,$disable_height=FALSE,$required=FALSE,$mouseover=FALSE,$display=FALSE,$placeholder=FALSE)
{
	global $settings;
	$input_field  = '<input'.(($type == 'checkbox') ? '' : ' class="glowing-border select-style"').' name="'.$name.'" ';
	$input_field .= ($mouseover == TRUE) ? 'onclick="this.select();" onmouseover="this.select();" ' : '';
//----------------------------------------------------------------------------------
//	If the $name variable == icon, Only accept images.
//----------------------------------------------------------------------------------
	if($name == 'myimage')
		$input_field .= 'accept="image/*" ';
//----------------------------------------------------------------------------------
//	If the $name variable == icon, Only accept images.
//----------------------------------------------------------------------------------	
	$input_field .= 'style="';
	$input_field .= ($mouseover == TRUE) ? 'cursor:copy;' : '';
//----------------------------------------------------------------------------------
//	FIX: This is added for that stupid browser we call Internet Explorer
//----------------------------------------------------------------------------------
	$input_field .= ($type == 'checkbox') ? 'background:transparent;border:0;' : '';
//----------------------------------------------------------------------------------
//	FIX: This is added for that stupid browser we call Internet Explorer
//----------------------------------------------------------------------------------
	$input_field .= ($type != 'file') ? 'padding-left:4px;padding-right:4px;' : 'cursor:pointer;font-size:13px;';
	//$input_field .= ($disable_height == TRUE) ? '' : 'height:20px;';
	$input_field .= ($settings['spacing'] <> 0) ? 'letter-spacing:'.$settings['spacing'].'px;' : '';
	$input_field .= ($settings['font_family'] <> '') ? 'font-family:'.$settings['font_family'].';' : '';
	$input_field .= ($styleSize != FALSE) ? 'width:'.$styleSize.';' : '';
	$input_field .= ($display <> FALSE) ? ' display:'.$display.';' : '';
//----------------------------------------------------------------------------------
//	If variable $type == file, Modify the style a little more
//----------------------------------------------------------------------------------
	//if($type == 'file')
	//	$input_field .= 'padding:2.5px;cursor:pointer;';
//----------------------------------------------------------------------------------
//	If variable $type == file, Modify the style a little more
//----------------------------------------------------------------------------------
	$input_field .= '" ';	
	$input_field .= 'type="'.$type.'" ';
	$input_field .= ($size <> FALSE) ? 'size="'.$size.'" ' : '';
	$input_field .= ($max <> FALSE) ? 'maxlength="'.$max.'" ' : '';
	$input_field .= ($value <> '') ? 'value="'.$value.'" ' : '';
	$input_field .= ($autocomplete == TRUE) ? 'autocomplete="off"' : '';
	$input_field .= ($disable <> FALSE) ? 'readonly' : '';
//----------------------------------------------------------------------------------
//	HTML5: Here you specify, Wether the input field selected is a required field
//----------------------------------------------------------------------------------
	$input_field .= ($required <> FALSE) ? ' required' : '';
//----------------------------------------------------------------------------------
//	HTML5: Here you specify, Wether the input field selected is a required field
//----------------------------------------------------------------------------------
	$input_field .= ($placeholder <> FALSE) ? ' placeholder="'.$placeholder.'"' : '';
	$input_field .= ' />';
	return $input_field;
}

function linkcss($help=FALSE,$fontsize=FALSE)
{
	global $settings;
	$style  = ' style="text-decoration:none; letter-spacing:'.$settings['spacing'].'px;"';
	return $style;
}

function selectbox($name,$default,$options,$background_color=FALSE,$width=FALSE) 
{
	global $titanium_lang_new, $titanium_module_name, $settings;	
	$select = '<select class="glowing-border select-style" align="absmiddle" style="'.(($width<>FALSE) ? 'width:'.$width.'; ' : '').'letter-spacing:'.$settings['spacing'].'px; padding:.3em;/.4em; vertical-align:middle;" name="'.$name.'" id="'.$name.'">'."\n";
	foreach($options as $value => $title) 
	{
		if($value === 'custom' || $value === 'nocolor')
			$select .= '<optgroup style="letter-spacing:'.$settings['spacing'].'px;" label="'.$titanium_lang_new[$titanium_module_name]['CUSTOM'].'">';			
		$select .= '<option'.(($background_color == TRUE) ? ' style="background-color:'.$value.';"' : '').' value="'.$value.'" '.(($value == $default) ? 'selected="selected"' : '').'>'.$title.'</option>'."\n";		
		if($value === 'custom' || $value === 'nocolor')
			$select .= '</optgroup>';
	}
	return $select.'</select>'."\n";
}

function selectbox_range($name, $default, $phpbb2_start, $limit, $step) 
{
	global $settings, $detect_device;		
	$select = '<select class="glowing-border font-family" style="'.(($detect_device == 'computer') ? 'font-family:'.$settings['font_family'].'; ' : '').'cursor:pointer; letter-spacing:'.$settings['spacing'].'px; padding:.3em;/.4em; vertical-align:middle;" name="'.$name.'" id="'.$name.'">'."\n";
	for($i = $phpbb2_start; $i < $limit; $i+=$step) 
	{
		$select .= '<option value="'.$i.'" '.(($i == $default) ? 'selected="selected"' : '').'>'.$i.'</option>'."\n"; // (($i < 10) ? '0'.$i : $i)
	}
	return $select.'</select>'."\n";
}

function submitbuttoncss($disabled=FALSE,$value=FALSE)
{
	global $titanium_module_name, $titanium_lang_new, $settings; // class="btn btn-primary" 
	return '<input type="submit" id="submit" name="submit" value="'.(($value == FALSE) ? $titanium_lang_new[$titanium_module_name]['SAVE'] : $value).'" '. (($disabled == true) ? 'disabled' : '') .'>';
}

function tablecss($width=FALSE,$align=FALSE,$class=FALSE,$colspan=FALSE,$text_align=FALSE,$disable=FALSE)
{
	global $settings;	
	$style = ' style="';
	$style .= ($width <> FALSE) ? 'width:'.$width.';' : '';
	$style .= ($disable == FALSE) ? 'height:30px;' : 'height:3px;';
	$style .= ($align <> FALSE) ? 'text-align:'.$align.';' : '';
	$style .= ($text_align <> FALSE) ? 'vertical-align:'.$text_align.';' : '';
	$style .= 'letter-spacing:'.$settings['spacing'].'px;';
	$style .= '"';
	$style .= ($class <> FALSE) ? ' class="'.$class.'"' : '';
	$style .= ($colspan <> FALSE) ? ' colspan="'.$colspan.'"' : '';
	return $style;
}

function _alphabetlist()
{
	global $titanium_db, $admin_file, $titanium_module_name;	
	$alpha_range = array();
	$alpha_letters = array();
	$alpha_letters = range('A','Z');
	$alpha_start = array('All','#');
	$alpha_range = array_merge($alpha_start, $alpha_letters);	
	$alphalist_table .= '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	$alphalist_table .= '  <tr>'."\n";
	$i = 0;
	while($i < count($alpha_range))
	{
		if($alpha_range[$i] <> 'All') {
			$alpha_where = ( $alpha_range[$i] == '#' ) ? " WHERE u.user_id = s.uid AND u.`username` NOT RLIKE '^[A-Z]' AND u.`user_id` > 1" : " WHERE u.user_id = s.uid AND u.`username` LIKE '".$alpha_range[$i]."%' AND u.`user_id` > 1";
		}
		$result1     = $titanium_db->sql_query("SELECT * FROM ("._IMAGE_REPOSITORY_USERS." s, "._USERS_TABLE." u)".$alpha_where." ORDER BY u.`username` ASC");
		$total       = $titanium_db->sql_numrows($resultl);
		
		if ($alpha_range[$i] != 'All') {
			$temp = ($alpha_range[$i] != '#') ? strtolower($alpha_range[$i]) : 'num';
			$alphanum_search_url = 'modules.php?name='.$titanium_module_name.'&amp;op=users&amp;alphanum='.$temp;
		} else {
			$alphanum_search_url = 'modules.php?name='.$titanium_module_name.'&amp;op=users';
		}
		
		$alphalist_table .= '    <td'.tablecss('3%','center','row1').'>'.(($total > 0) ? '<a style="color: red; font-size: 14px; font-weight: bold;" href="'.$alphanum_search_url.'">'.$alpha_range[$i].'</a>' : (($alpha_range[$i] == 'All') ? '<a style="font-size: 14px;" href="'.$alphanum_search_url.'">'.$alpha_range[$i].'</a>' : '<span style="font-size:14px;">'.$alpha_range[$i].'</span>')).'</td>'."\n";
		$i++;
	}
	$alphalist_table .= '  </tr>'."\n";
	$alphalist_table .= '</table>'."\n";
	return $alphalist_table;
}

function _calculate_bytesize($p_sFormatted) 
{
    $aUnits = array('B'=>0, 'KB'=>1, 'MB'=>2, 'GB'=>3);
    $sUnit = strtoupper(trim(substr($p_sFormatted, -2)));
    if (intval($sUnit) !== 0) {
        $sUnit = 'B';
    }
    if (!in_array($sUnit, array_keys($aUnits))) {
        return false;
    }
    $iUnits = trim(substr($p_sFormatted, 0, strlen($p_sFormatted) - 2));
    if (!intval($iUnits) == $iUnits) {
        return false;
    }
    return $iUnits * pow(1024, $aUnits[$sUnit]);
} 

function _calculate_size($size)  
{
    $mb = 1024*1024;
    $gb = $mb*1024;
    if ( $size > $gb ) 
        $mysize = round(sprintf ("%01.2f",$size/$gb), 2)." GB";
    elseif ( $size > $mb )
        $mysize = round(sprintf ("%01.2f",$size/$mb), 2)." MB";
    elseif ( $size >= 1024 )
        $mysize = round(sprintf ("%01.2f",$size/1024), 2)." KB";
    else
		$mysize = round($size)." Bytes";
    return $mysize;
}

function _copyright_modal()
{
	global $titanium_lang_new, $titanium_module_name;
	// echo '<div id="copyright-popup" style="display:none;">';
	// echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	// echo '	<tr>'."\n";
	// echo '    <td'.tablecss(FALSE,'center','catBottom font-family',2).'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_INFORMATION'].'</td>'."\n";
	// echo '  </tr>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '	  <td'.tablecss(FALSE,'center','row1 font-family',2).'>'.$titanium_lang_new[$titanium_module_name]['MODULE_NAME'].' '.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_FOR'].' '.((function_exists('redirect')) ? $titanium_lang_new[$titanium_module_name]['COPYRIGHT_EVOLUTION_XTREME'] : $titanium_lang_new[$titanium_module_name]['COPYRIGHT_RAVEN_CMS']).'</td>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '    <td'.tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE'].'</td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'>'.$titanium_lang_new[$titanium_module_name]['MOUDLE_NAME_COPYRIGHT'].'</td>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_VERSION'].'</td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'>'._IREPOSITORY_VERSION.'</td>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_DESCRIPTION'].'</td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_TEXT'].'</td>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_LICENSE'].'</td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'>GNU/GPL</td>'."\n";
	// echo '  </tr>'."\n".'<tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_AUTHOR'].'</td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'>Lonestar</td>'."\n";
	// echo '  </tr>'."\n";
	// echo '  <tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'><strong>'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_EMAIL'].'</strong></td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'>crazycoder@live.co.uk</td>'."\n";
	// echo '  </tr>'."\n";
	// echo '  <tr>'."\n";
	// echo '    <td'.tablecss('30%','right','row1 font-family').'><strong>Author Homepage</strong></td>'."\n";
	// echo '    <td'.tablecss('70%',FALSE,'row1').'><a'.linkcss().' href="http://lonestar-modules.com">lonestar-modules</a></td>'."\n";
	// echo '  </tr>'."\n";
	// echo '  <tr>'."\n";
	// echo '	  <td'.tablecss(FALSE,'center','catBottom',2).'>[ <a'.linkcss().' class="font-family" href="http://lonestar-modules.com" target="_blank">'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_HOME'].'</a> | <a'.linkcss().' class="font-family" href="http://lonestar-modules.com/modules.php?name=Download_Repository&amp;op=view&amp;did=1" target="_blank">'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_MODULE_DOWNLOAD'].'</a> | <a'.linkcss().' class="font-family" href="javascript:void(0);" rel="modal:close">'.$titanium_lang_new[$titanium_module_name]['COPYRIGHT_CLOSE'].'</a> ]</td>'."\n";
	// echo '  </tr>'."\n";
	// echo '</table>'."\n";
	// echo '</div>';
	echo '<span style="float:right; padding-right:5px;"><a'.linkcss().' class="font-family" href="#module-copyright-popup" rel="modal:open">'.$titanium_lang_new[$titanium_module_name]['MOUDLE_NAME_COPYRIGHT'].'</a></span>';	
}

function _createthumb($ini_path,$dest_path,$params=array())
{
	@ini_set('memory_limit', '100M');
    $width        = !empty($params['width'])? $params ['width']: NULL;
    $height       = !empty($params['height']) ? $params['height'] : NULL;
    $constraint   = !empty($params['constraint']) ? $params['constraint'] : FALSE;
    $rgb          = !empty($params['rgb'])? $params['rgb']: 0xFFFFFF;
    $quality      = !empty($params['quality']) ? $params['quality'] : 100;
    $aspect_ratio = isset($params['aspect_ratio']) ? $params['aspect_ratio'] : TRUE;
    $crop         = isset($params['crop']) ? $params['crop'] : TRUE;
 
    if (!file_exists($ini_path)) return false; 
    if  (! is_dir ( $dir = dirname ( $dest_path ))) mkdir ( $dir );
 
    $img_info = getimagesize($ini_path);
    if ($img_info === false) return false;
 
    $ini_p = $img_info[0]/$img_info[1];
    if ( $constraint ) {
        $con_p = $constraint['width']/$constraint['height'];
        $calc_p = $constraint['width']/$img_info[0];
 
        if ( $ini_p < $con_p ) {
            $height = $constraint['height'];
            $width = $height*$ini_p;
        } else {
            $width = $constraint['width'];
            $height = $img_info[1]*$calc_p;
        }
    } else {
        if ( !$width && $height ) {
            $width = ($height*$img_info[0])/$img_info[1];
        } else if ( !$height && $width ) {
            $height = ($width*$img_info[1])/$img_info[0];
        } else if ( !$height && !$width ) {
            $width = $img_info[0];
            $height = $img_info[1];
        }
    }
 
    preg_match('/\.([^\.]+)$/i',basename($dest_path), $match);
    $ext = $match[1];
    $output_format = (strtolower($ext) == 'jpg') ? 'jpeg' : $ext;
 
    $format = strtolower(substr($img_info['mime'], strpos($img_info['mime'], '/')+1));
    $icfunc = "imagecreatefrom" . $format;
 
    $iresfunc = "image" . $output_format;
 
    if (!function_exists($icfunc)) return false;
 
    $dst_x = $dst_y = 0;
    $src_x = $src_y = 0;
    $res_p = $width/$height;
    if ( $crop && !$constraint ) {
        $dst_w  = $width;
        $dst_h = $height;
        if ( $ini_p > $res_p ) {
            $src_h = $img_info[1];
            $src_w = $img_info[1]*$res_p;
            $src_x = ($img_info[0] >= $src_w) ? floor(($img_info[0] - $src_w) / 2) : $src_w;
        } else {
            $src_w = $img_info[0];
            $src_h = $img_info[0]/$res_p;
            $src_y    = ($img_info[1] >= $src_h) ? floor(($img_info[1] - $src_h) / 2) : $src_h;
        }
    } else {
        if ( $ini_p > $res_p ) {
            $dst_w = $width;
            $dst_h = $aspect_ratio ? floor($dst_w/$img_info[0]*$img_info[1]) : $height;
            $dst_y = $aspect_ratio ? floor(($height-$dst_h)/2) : 0;
        } else {
            $dst_h = $height;
            $dst_w = $aspect_ratio ? floor($dst_h/$img_info[1]*$img_info[0]) : $width;
            $dst_x = $aspect_ratio ? floor(($width-$dst_w)/2) : 0;
        }
        $src_w = $img_info[0];
        $src_h = $img_info[1];
    }
 
    $isrc = $icfunc($ini_path);
    $idest = imagecreatetruecolor($width, $height);
    if ( ($format == 'png' || $format == 'gif') && $output_format == $format ) {
        imagealphablending($idest, false);
        imagesavealpha($idest,true);
        imagefill($idest, 0, 0, IMG_COLOR_TRANSPARENT);
        imagealphablending($isrc, true);
        $quality = 0;
    } else {
        imagefill($idest, 0, 0, $rgb);
    }
    imagecopyresampled($idest, $isrc, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
	if($output_format == 'png')
    	$res = imagepng($idest, $dest_path);
	else
		$res = $iresfunc($idest, $dest_path, $quality);
 
    imagedestroy($isrc);
    imagedestroy($idest); 
    return $res;
}

function _kill_function()
{
	CloseTable();
	if(!$_SERVER['HTTP_X_REQUESTED_WITH'])
		_copyright_modal();
	include_once(NUKE_BASE_DIR.'footer.php');
	die();
}

function _quota_percentages($titanium_user=FALSE)
{
	global $titanium_db, $userinfo;		
	list ($quota)      = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `quota` FROM `"._IMAGE_REPOSITORY_USERS."` WHERE `uid`='".$titanium_user."'"));
	list ($total_phpbb2_size) = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT SUM(size) as total_size FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$titanium_user."'"));	
	if($total_phpbb2_size > 0) {
		$PercentageResult = ($total_phpbb2_size*100)/$quota;
		$PercentageResult = round($PercentageResult,1);
	} else {
		$PercentageResult = 0;
	}	
	$return_quota_info_array = array(
		'total_size'    => $total_phpbb2_size,
		'quota'         => $quota,
		'percentage'    => $PercentageResult
	);
	return $return_quota_info_array;
}

function _random_string($length=10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) 
	{
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function _redirect_titanium($redirect)
{
	if(function_exists('redirect'))
		redirect_titanium($redirect);
	else
		Header('Location:'.$redirect);
}

function _string_to_upper($string)
{
	$strtoupper = 1;
	return ($strtoupper == TRUE) ? strtoupper($string) : $string;
}

function _submitter($uid)
{
	global $titanium_db;
	list($titanium_username) = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `username` FROM `"._USERS_TABLE."` WHERE `user_id`='".$uid."'"));
	return (function_exists('UsernameColor')) ? UsernameColor($titanium_username) : $titanium_username;
}

function _timestamp($format, $gmepoch, $tz)
{
  global $phpbb2_board_config, $titanium_lang;
  return @gmdate($format, $gmepoch + (3600 * $tz));
}

?>