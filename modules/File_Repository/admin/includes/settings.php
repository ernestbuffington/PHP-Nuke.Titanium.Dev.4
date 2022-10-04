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
	global $titanium_db, $admin_file, $lang_new, $pnt_module, $settings;
	_admin_navigation_menu();
	echo '<form action="'.$admin_file.'.php?op='._MODNAME.'&amp;action=settings_save" method="post">'."\n";
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$pnt_module]['ADMINISTRATION_MODULE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['VERSION']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'.$settings['version'].'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['GENERAL']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['LEGEND_SHOW']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._yesno('show_legend',$settings['show_legend']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['MOST_HITS']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('pophits',1,5000,1,$settings['pophits']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['LIGHTBOX']).'</td>'."\n";
	$phpbb2_colorbox = ((file_exists('includes/jquery/jquery.colorbox.js') || file_exists('includes/js/colorbox/jquery.colorbox-min.js') || file_exists('includes/js/jquery.colorbox.php')) ? array('colorbox' => $lang_new[$pnt_module]['CB']) : array());
	$fancybox = ((file_exists('includes/jquery/jquery.fancybox.js') || file_exists('includes/fancybox/jquery.fancybox.js') || file_exists('includes/js/jquery.fancybox.js') || file_exists('includes/js/jquery.fancybox.php')) ? array('fancybox' => $lang_new[$pnt_module]['FB']) : array());
	$lightbox = ((file_exists('includes/jquery/jquery.lightbox.js')
		|| file_exists('includes/lightbox/lightbox.js')  
		|| file_exists('includes/lightbox/jquery.lightbox.js') 
		|| file_exists('includes/js/jquery.lightbox.js') 
		|| file_exists('includes/js/jquery.lightbox.php')) ? array('lightbox' => $lang_new[$pnt_module]['LB']) : array());
	$lightboxevo = (file_exists('includes/js/jquery.lightbox.evolution.php')) ? array('lightboxevo' => $lang_new[$pnt_module]['LE']) : array();

	$viewerArray = array_merge($phpbb2_colorbox,$fancybox,$lightbox,$lightboxevo);
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('viewer',$viewerArray,$settings['viewer']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['DEVELOPER']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._yesno('developer_mode',$settings['developer_mode']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['MOST_POPULAR']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('most_popular',1,50,1,$settings['most_popular']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['OVERVIEW']).'</td>'."\n";
	echo '  </tr>'."\n";	
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['OVERVIEW_DISPLAY']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('overview_display',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['overview_display']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['OVERVIEW_COUNT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('overview_count',1,10,1,$settings['overview_count']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	$whereToDisplay = array(
		'newdownloads' => $lang_new[$pnt_module]['NEW_DOWNLOADS'],
		'mostpopular' => $lang_new[$pnt_module]['MOST_POPULAR_OPTION'],
		'statistics' => $lang_new[$pnt_module]['STATISTICS'],
		'search' => $lang_new[$pnt_module]['SEARCH'],
		'submitdownload' => $lang_new[$pnt_module]['USER_UPLOAD_OPTION']
	);
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['OVERVIEW_DISPLAY_WHERE']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>';
	foreach($whereToDisplay as $option => $subaction):
		echo _input_checkbox('where_to_display[]',$option,$subaction,explode(',',$settings['overview_display_areas'])).'<br/>';
	endforeach;
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['SECURITY']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['GFXCHECKING']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('usegfxcheck',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['usegfxcheck']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['ADMIN_BYPASS']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('adminBypass',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['adminBypass']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['EXTENSION_MANAGEMENT']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['EXTENSION_FILES']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','allowed_file_extensions','150px',$settings['allowed_file_extensions']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['EXTENSION_IMAGES']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','allowed_image_extensions','150px',$settings['allowed_image_extensions']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['USER_UPLOAD']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['USER_UPLOAD_ALLOWED']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('users_can_upload',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['users_can_upload']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['GROUPS_ALLOWED_TO_UPLOAD']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._list_available_permission_groups('group_allowed_to_upload',$settings['group_allowed_to_upload']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['USER_UPLOAD_FILE_AMOUNT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('users_file_upload_amount',1,5,1,$settings['users_file_upload_amount']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['USER_UPLOAD_IMAGE_AMOUNT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input_numbers('users_screens_upload_amount',1,5,1,$settings['users_screens_upload_amount']).'</td>'."\n";
	echo '  </tr>'."\n";
	# added in 1.1.0 
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['COSMETIC']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['UHEAD']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('uhead',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['uhead']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['UTEXT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('utext',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['utext']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['DOWNLOAD_LAYOUT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('download_view',array(0 => $lang_new[$pnt_module]['DOWNLOAD_LAYOUT_SINGLE'], 1 => $lang_new[$pnt_module]['DOWNLOAD_LAYOUT_SIDEBYSIDE']),$settings['download_view']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['PARSE_SMILIES']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('parse_smilies',array(0 => $lang_new[$pnt_module]['N'], 1 => $lang_new[$pnt_module]['Y']),$settings['parse_smilies']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['DATE_FORMAT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','date_format','150px',$settings['date_format']).'</td>'."\n";
	echo '  </tr>'."\n";
//---------------------------------------------------------------------
//	PAYPAL SETTINGS
//---------------------------------------------------------------------
	if(file_exists(_FILE_REPOSITORY_PLUGINS.'shop/functions.php'))
	{
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['PAYMENTS']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$pnt_module]['CURRENCY_DEFAULT']).'</td>'."\n";
		echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('currency',array('CAD' => $lang_new[$pnt_module]['CAD'], 'EUR' => $lang_new[$pnt_module]['EUR'], 'GBP' => $lang_new[$pnt_module]['GBP'], 'USD' => $lang_new[$pnt_module]['USD']),$settings['currency']).'</td>'."\n";
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
	echo '    <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['THEMES']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss(false,false,_sc(),2).'>'."\n";
	echo '      <table style="width:100%; table-layout: fixed" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '	      <tr'._bgColor(2).'>'."\n";
	echo '          <td'._tdcss($alternateWidth,false,_sh(),$colspan).'>'._suh($lang_new[$pnt_module]['THEME_NAME']).'</td>'."\n";
//---------------------------------------------------------------------
//	HIDE THIS OPTION IN EVOLUTION NUKE, AS IT CANT BE USED
//---------------------------------------------------------------------
	if(!defined('NUKE_EVO'))
		echo '          <td'._tdcss($alternateWidth,false,_sh()).'>'._suh($lang_new[$pnt_module]['THEME_BLOCKS_SHOW']).'</td>'."\n";
//---------------------------------------------------------------------
	echo '          <td'._tdcss($alternateWidth,false,_sh($settings['download_view'])).'>'._suh($lang_new[$pnt_module]['THEME_FILES']).'</td>'."\n";
	echo '          <td'._tdcss($alternateWidth,false,_sh()).'>'._suh($lang_new[$pnt_module]['THEME_CELL']).'</td>'."\n";
	echo '          <td'._tdcss($alternateWidth,false,_sh()).'>'._suh($lang_new[$pnt_module]['THEME_HEADER']).'</td>'."\n";
	echo '        </tr>'."\n";

	$total_phpbb2_themes = 0;
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
			$result = $titanium_db->sql_query($sql);
			$row = $titanium_db->sql_fetchrow($result);
			$titanium_db->sql_freeresult($result);
			if (empty($row)) 
			{
				$titanium_db->sql_query("INSERT INTO `"._FILE_REPOSITORY_THEMES."` (`theme_name`,`cell`,`head`,`per_row`,`show_left`) VALUES ('$themelist[$i]',0,0,2,1)");
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
				echo '    <td'._tdcss($alternateWidth,false,_sc()).'>'._selectbox('show_left'.$i,array('1' => $lang_new[$pnt_module]['SHOWN'], '0' => $lang_new[$pnt_module]['HIDDEN']),$row['show_left']).'</td>'."\n";
//---------------------------------------------------------------------
			echo '    <td'._tdcss($alternateWidth,false,_sc($settings['download_view'])).'>'._selectbox('per_row'.$i,array('1' => '1', '2' => '2', '3' => '3'),$row['per_row']).'</td>'."\n";
			echo '    <td'._tdcss($alternateWidth,false,_sc()).'>'._selectbox('cell'.$i,array('0' => 'row1', '1' => 'bgcolor1'),$row['cell']).'</td>'."\n";
			echo '    <td'._tdcss($alternateWidth,false,_sc()).'>'._selectbox('head'.$i,array('0' => 'catHead', '1' => 'bgcolor2'),$row['head']).'</td>'."\n";
			echo '  </tr>'."\n";
			echo _input('hidden','theme_name'.$i,false,$themelist[$i]);
			$total_phpbb2_themes++;
		}
	}

	echo '      </table>'."\n";	
	echo '    </td>'."\n";	
	echo '  </tr>'."\n";
//---------------------------------------------------------------------
//	THEME SETTINGS
//---------------------------------------------------------------------	
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sf(),2).'>'._submit($lang_new[$pnt_module]['SETTINGS_SAVE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo _input('hidden','total_themes',false,$total_phpbb2_themes);
	echo '</form>'."\n";
}

function _file_repository_configuration_save_variables()
{
	global $titanium_db, $admin_file;

	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['pophits']."' WHERE `config_name`='pophits'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['uhead']."' WHERE `config_name`='uhead'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['utext']."' WHERE `config_name`='utext'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['parse_smilies']."' WHERE `config_name`='parse_smilies'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['viewer']."' WHERE `config_name`='viewer'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['date_format']."' WHERE `config_name`='date_format'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['usegfxcheck']."' WHERE `config_name`='usegfxcheck'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['captcha']."' WHERE `config_name`='captcha'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['viewer']."' WHERE `config_name`='viewer'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['developer_mode']."' WHERE `config_name`='developer_mode'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['overview_count']."' WHERE `config_name`='overview_count'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['overview_display']."' WHERE `config_name`='overview_display'");	
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['most_popular']."' WHERE `config_name`='most_popular'"); 
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['download_view']."' WHERE `config_name`='download_view'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['adminBypass']."' WHERE `config_name`='adminBypass'");
	# added in 1.1.0
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['show_legend']."' WHERE `config_name`='show_legend'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['users_can_upload']."' WHERE `config_name`='users_can_upload'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['group_allowed_to_upload']."' WHERE `config_name`='group_allowed_to_upload'");	
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['users_file_upload_amount']."' WHERE `config_name`='users_file_upload_amount'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['users_screens_upload_amount']."' WHERE `config_name`='users_screens_upload_amount'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['allowed_file_extensions']."' WHERE `config_name`='allowed_file_extensions'");
	$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['allowed_image_extensions']."' WHERE `config_name`='allowed_image_extensions'");
	# added in 1.1.0

	for ($x = 1; $x <= $_POST['total_themes']; $x++) 
	{
		$show_left = '';
		if ( $_POST['show_left'.$x] ):
			$show_left = ", `show_left`='".$_POST['show_left'.$x]."'";
		endif;
		$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_THEMES."` SET `cell`='".$_POST['cell'.$x]."', `head`='".$_POST['head'.$x]."', `per_row`='".$_POST['per_row'.$x]."'".$show_left." WHERE `theme_name`='".$_POST['theme_name'.$x]."'");
	}

	# added in 1.1.0
	if($_POST['where_to_display']):

		foreach($_POST['where_to_display'] as $areas):
			$area_to_display .= $areas.',';
		endforeach;
		$area_to_display_string = rtrim($area_to_display, ", \t\n");
		$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='".$area_to_display_string."' WHERE `config_name`='overview_display_areas'");

	else:
		# if there are no values, just empty the value.
		$titanium_db->sql_query("UPDATE `"._FILE_REPOSITORY_SETTINGS."` SET `config_value`='' WHERE `config_name`='overview_display_areas'");
	endif;
	# added in 1.1.0
	_redirect_titanium($admin_file.'.php?op='._MODNAME.'&action=settings');
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