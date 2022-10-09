<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|	VERSION 			:	1.0.0
|----------------------------------------------------------------------
*/

if (!defined('IN_FILE_REPOSITORY'))
	die('Access Denied');

function _file_repository_configuration()
{
	// upload size in bytes (int)(str_replace('M', '', ini_get('post_max_size')) * 1024 * 1024)
	// upload size in mb ini_get('post_max_size')
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	echo '<form action="'.$admin_file.'.php?op='._MODNAME.'&amp;action=settings_save" method="post">'."\n";
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['ADMINISTRATION_MODULE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['VERSION']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'.$settings['version'].'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['GENERAL']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['LEGEND_SHOW']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._yesno('show_legend',$settings['show_legend']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['MOST_HITS']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('pophits',1,5000,1,$settings['pophits']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['LIGHTBOX']).'</td>'."\n";
	$colorbox = ((file_exists('includes/jquery/jquery.colorbox.js') || file_exists('includes/js/colorbox/jquery.colorbox-min.js') || file_exists('includes/js/jquery.colorbox.php')) ? array('colorbox' => $lang_new[$module_name]['CB']) : array());
	$fancybox = ((file_exists('includes/jquery/jquery.fancybox.js') || file_exists('includes/fancybox/jquery.fancybox.js') || file_exists('includes/js/jquery.fancybox.js') || file_exists('includes/js/jquery.fancybox.php')) ? array('fancybox' => $lang_new[$module_name]['FB']) : array());
	$lightbox = ((file_exists('includes/jquery/jquery.lightbox.js')
		|| file_exists('includes/lightbox/lightbox.js')  
		|| file_exists('includes/lightbox/jquery.lightbox.js') 
		|| file_exists('includes/js/jquery.lightbox.js') 
		|| file_exists('includes/js/jquery.lightbox.php')) ? array('lightbox' => $lang_new[$module_name]['LB']) : array());
	$lightboxevo = (file_exists('includes/js/jquery.lightbox.evolution.php')) ? array('lightboxevo' => $lang_new[$module_name]['LE']) : array();

	$viewerArray = array_merge($colorbox,$fancybox,$lightbox,$lightboxevo);
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('viewer',$viewerArray,$settings['viewer']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['DEVELOPER']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._yesno('developer_mode',$settings['developer_mode']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['MOST_POPULAR']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('most_popular',1,50,1,$settings['most_popular']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['OVERVIEW']).'</td>'."\n";
	echo '  </tr>'."\n";	
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['OVERVIEW_DISPLAY']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('overview_display',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['overview_display']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['OVERVIEW_COUNT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('overview_count',1,10,1,$settings['overview_count']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	$whereToDisplay = array(
		'newdownloads' => $lang_new[$module_name]['NEW_DOWNLOADS'],
		'mostpopular' => $lang_new[$module_name]['MOST_POPULAR_OPTION'],
		'statistics' => $lang_new[$module_name]['STATISTICS'],
		'search' => $lang_new[$module_name]['SEARCH'],
		'submitdownload' => $lang_new[$module_name]['USER_UPLOAD_OPTION']
	);
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['OVERVIEW_DISPLAY_WHERE']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>';
	foreach($whereToDisplay as $option => $subaction):
		echo _input_checkbox('where_to_display[]',$option,$subaction,explode(',',$settings['overview_display_areas'])).'<br/>';
	endforeach;
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['SECURITY']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['GFXCHECKING']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('usegfxcheck',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['usegfxcheck']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['ADMIN_BYPASS']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('adminBypass',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['adminBypass']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['EXTENSION_MANAGEMENT']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['EXTENSION_FILES']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','allowed_file_extensions','150px',$settings['allowed_file_extensions']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['EXTENSION_IMAGES']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','allowed_image_extensions','150px',$settings['allowed_image_extensions']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['USER_UPLOAD']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['USER_UPLOAD_ALLOWED']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('users_can_upload',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['users_can_upload']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['GROUPS_ALLOWED_TO_UPLOAD']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._list_available_permission_groups('group_allowed_to_upload',$settings['group_allowed_to_upload']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['USER_UPLOAD_FILE_AMOUNT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('users_file_upload_amount',1,5,1,$settings['users_file_upload_amount']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['USER_UPLOAD_IMAGE_AMOUNT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('users_screens_upload_amount',1,5,1,$settings['users_screens_upload_amount']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0 
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['COSMETIC']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['UHEAD']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('uhead',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['uhead']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['UTEXT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('utext',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['utext']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['DOWNLOAD_LAYOUT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('download_view',array(0 => $lang_new[$module_name]['DOWNLOAD_LAYOUT_SINGLE'], 1 => $lang_new[$module_name]['DOWNLOAD_LAYOUT_SIDEBYSIDE']),$settings['download_view']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['PARSE_SMILIES']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('parse_smilies',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$settings['parse_smilies']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['DATE_FORMAT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','date_format','150px',$settings['date_format']).'</td>'."\n";
	echo '  </tr>'."\n";
//---------------------------------------------------------------------
//	PAYPAL SETTINGS
//---------------------------------------------------------------------
	if(file_exists(_FILE_REPOSITORY_PLUGINS.'shop/functions.php'))
	{
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['PAYMENTS']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['CURRENCY_DEFAULT']).'</td>'."\n";
		echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('currency',array('CAD' => $lang_new[$module_name]['CAD'], 'EUR' => $lang_new[$module_name]['EUR'], 'GBP' => $lang_new[$module_name]['GBP'], 'USD' => $lang_new[$module_name]['USD']),$settings['currency']).'</td>'."\n";
		echo '  </tr>'."\n";
	}
//---------------------------------------------------------------------
//	PAYPAL SETTINGS
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	THEME SETTINGS
//---------------------------------------------------------------------
	if(!defined('NUKE_EVO') && $settings['download_view'] == 1)
	{
		$alternateWidth = '20%';
		$colspan 		= false;
	}
	elseif(!defined('NUKE_EVO') && $settings['download_view'] == 0)
	{
		$alternateWidth = false;
		$colspan 		= 2;
	}
	elseif(defined('NUKE_EVO') && $settings['download_view'] == 1)
	{
		$alternateWidth = '25%';
		$colspan 		= false;
	}
	elseif(defined('NUKE_EVO') && $settings['download_view'] == 0)
	{
		$alternateWidth = false;
		$colspan 		= 2;
	}

	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['THEMES']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss(false,false,_sc(),2).'>'."\n";
	echo '      <table style="width:100%; table-layout: fixed" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '	      <tr'._bgColor(2).'>'."\n";
	echo '          <td'._tdcss($alternateWidth,false,_sh(),$colspan).'>'._suh($lang_new[$module_name]['THEME_NAME']).'</td>'."\n";
//---------------------------------------------------------------------
//	HIDE THIS OPTION IN EVOLUTION NUKE, AS IT CANT BE USED
//---------------------------------------------------------------------
	if(!defined('NUKE_EVO'))
		echo '          <td'._tdcss($alternateWidth,false,_sh()).'>'._suh($lang_new[$module_name]['THEME_BLOCKS_SHOW']).'</td>'."\n";
//---------------------------------------------------------------------
	echo '          <td'._tdcss($alternateWidth,false,_sh($settings['download_view'])).'>'._suh($lang_new[$module_name]['THEME_FILES']).'</td>'."\n";
	echo '          <td'._tdcss($alternateWidth,false,_sh()).'>'._suh($lang_new[$module_name]['THEME_CELL']).'</td>'."\n";
	echo '          <td'._tdcss($alternateWidth,false,_sh()).'>'._suh($lang_new[$module_name]['THEME_HEADER']).'</td>'."\n";
	echo '        </tr>'."\n";

	$total_themes = 0;
	$handle = opendir('themes');
    while ($file = readdir($handle)) 
	{
        if ((!preg_match("/[\.]/",$file) AND file_exists(NUKE_THEMES_DIR.$file.'/theme.php'))) 
		{
            $themelist .= "$file ";
        }
    }
    closedir($handle);
    $themelist = explode(" ", $themelist);
    sort($themelist);

	for ($i = 0; $i < sizeof($themelist); $i++) 
	{
		if(!empty($themelist[$i])) 
		{
			$sql = "SELECT * FROM `"._FILE_REPOSITORY_THEMES."` WHERE `theme_name`='$themelist[$i]'";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			if (empty($row)) 
			{
				$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_THEMES."` (`theme_name`,`cell`,`head`,`per_row`,`show_left`) VALUES ('$themelist[$i]',0,0,2,1)");
			}
			$row['cell'] 		= ($row['cell']) ? $row['cell'] : '0';
			$row['head'] 		= ($row['head']) ? $row['head'] : '0';
			$row['per_row']		= ($row['per_row']) ? $row['per_row'] : '3';
			$row['show_left'] 	= ($row['show_left']) ? $row['show_left'] : '0';

			echo '	<tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss($alternateWidth,false,_sc(),$colspan).'><span style="font-weight:bold;">'.$themelist[$i].'</span></td>'."\n";
//---------------------------------------------------------------------
//	HIDE THIS OPTION IN EVOLUTION NUKE, AS IT CANT BE USED
//---------------------------------------------------------------------
			if(!defined('NUKE_EVO')) 
				echo '    <td'._tdcss($alternateWidth,false,_sc()).'>'._selectbox('show_left'.$i,array('1' => $lang_new[$module_name]['SHOWN'], '0' => $lang_new[$module_name]['HIDDEN']),$row['show_left']).'</td>'."\n";
//---------------------------------------------------------------------
			echo '    <td'._tdcss($alternateWidth,false,_sc($settings['download_view'])).'>'._selectbox('per_row'.$i,array('1' => '1', '2' => '2', '3' => '3'),$row['per_row']).'</td>'."\n";
			echo '    <td'._tdcss($alternateWidth,false,_sc()).'>'._selectbox('cell'.$i,array('0' => 'row1', '1' => 'bgcolor1'),$row['cell']).'</td>'."\n";
			echo '    <td'._tdcss($alternateWidth,false,_sc()).'>'._selectbox('head'.$i,array('0' => 'catHead', '1' => 'bgcolor2'),$row['head']).'</td>'."\n";
			echo '  </tr>'."\n";
			echo _input('hidden','theme_name'.$i,false,$themelist[$i]);
			$total_themes++;
		}
	}

	echo '      </table>'."\n";	
	echo '    </td>'."\n";	
	echo '  </tr>'."\n";
//---------------------------------------------------------------------
//	THEME SETTINGS
//---------------------------------------------------------------------	
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sf(),2).'>'._submit($lang_new[$module_name]['SETTINGS_SAVE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo _input('hidden','total_themes',false,$total_themes);
	echo '</form>'."\n";
}

function _file_repository_configuration_save_variables()
{
	global $db, $admin_file;

	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['pophits']."' WHERE `config_name`='pophits'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['uhead']."' WHERE `config_name`='uhead'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['utext']."' WHERE `config_name`='utext'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['parse_smilies']."' WHERE `config_name`='parse_smilies'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['viewer']."' WHERE `config_name`='viewer'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['date_format']."' WHERE `config_name`='date_format'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['usegfxcheck']."' WHERE `config_name`='usegfxcheck'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['captcha']."' WHERE `config_name`='captcha'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['viewer']."' WHERE `config_name`='viewer'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['developer_mode']."' WHERE `config_name`='developer_mode'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['overview_count']."' WHERE `config_name`='overview_count'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['overview_display']."' WHERE `config_name`='overview_display'");	
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['most_popular']."' WHERE `config_name`='most_popular'"); 
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['download_view']."' WHERE `config_name`='download_view'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['adminBypass']."' WHERE `config_name`='adminBypass'");
	# added in 1.1.0
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['show_legend']."' WHERE `config_name`='show_legend'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['users_can_upload']."' WHERE `config_name`='users_can_upload'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['group_allowed_to_upload']."' WHERE `config_name`='group_allowed_to_upload'");	
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['users_file_upload_amount']."' WHERE `config_name`='users_file_upload_amount'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['users_screens_upload_amount']."' WHERE `config_name`='users_screens_upload_amount'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['allowed_file_extensions']."' WHERE `config_name`='allowed_file_extensions'");
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['allowed_image_extensions']."' WHERE `config_name`='allowed_image_extensions'");
	# added in 1.1.0

	for ($x = 1; $x <= $_POST['total_themes']; $x++) 
	{
		$show_left = '';
		if ( $_POST['show_left'.$x] ):
			$show_left = ", `show_left`='".$_POST['show_left'.$x]."'";
		endif;
		$db->sql_query("UPDATE `"._FILE_REPOSITORY_THEMES."` SET `cell`='".$_POST['cell'.$x]."', `head`='".$_POST['head'.$x]."', `per_row`='".$_POST['per_row'.$x]."'".$show_left." WHERE `theme_name`='".$_POST['theme_name'.$x]."'");
	}

	# added in 1.1.0
	if($_POST['where_to_display']):

		foreach($_POST['where_to_display'] as $areas):
			$area_to_display .= $areas.',';
		endforeach;
		$area_to_display_string = rtrim($area_to_display, ", \t\n");
		$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$area_to_display_string."' WHERE `config_name`='overview_display_areas'");

	else:
		# if there are no values, just empty the value.
		$db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='' WHERE `config_name`='overview_display_areas'");
	endif;
	# added in 1.1.0
	_redirect($admin_file.'.php?op='._MODNAME.'&action=settings');
}

switch($_GET['action'])
{
	case 'settings_save':
		_file_repository_configuration_save_variables();
		break;

	case 'settings':
		_file_repository_configuration();
		break;
}

?>