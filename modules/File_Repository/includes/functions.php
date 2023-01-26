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
//---------------------------------------------------------------------
//	DEFINE THE STANDARD SQL TABLES
//---------------------------------------------------------------------
define_once('_GROUPS_TABLE', 				$prefix.'_bbgroups');
define_once('_USER_TABLE', 					$user_prefix.'_users');
define_once('_USER_GROUP_TABLE', 			$prefix.'_bbuser_group');
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	DEFINE THE SQL TABLES, MAKES THINGS EASIER IN THE FUTURE IF TABLES,
//	NEED TO BE RENAMED :)
//---------------------------------------------------------------------
define_once('_FILE_REPOSITORY_CATEGORIES',	$prefix.'_file_repository_categories');
define_once('_FILE_REPOSITORY_COMMENTS',		$prefix.'_file_repository_comments');
define_once('_FILE_REPOSITORY_EXTENSIONS',	$prefix.'_file_repository_extensions');
define_once('_FILE_REPOSITORY_FILES',		$prefix.'_file_repository_files');
define_once('_FILE_REPOSITORY_ITEMS',		$prefix.'_file_repository_items');
define_once('_FILE_REPOSITORY_SCREENSHOTS',	$prefix.'_file_repository_screenshots');
define_once('_FILE_REPOSITORY_SETTINGS',		$prefix.'_file_repository_settings');
define_once('_FILE_REPOSITORY_THEMES',		$prefix.'_file_repository_themes');
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	DEFINE THE FOLDER PATHS, AGAIN MAKES THINGS ALOT EASIER.
//---------------------------------------------------------------------
define_once('_FILE_REPOSITORY_ADMIN', 		'modules/'.$module_name.'/admin/includes/');
define_once('_FILE_REPOSITORY_CSS', 			'modules/'.$module_name.'/includes/css/');
define_once('_FILE_REPOSITORY_DIR', 			'modules/'.$module_name.'/files/');
define_once('_FILE_REPOSITORY_JS',			'modules/'.$module_name.'/includes/js/');
define_once('_FILE_REPOSITORY_PLUGINS', 		'modules/'.$module_name.'/includes/plugins/');
define_once('_FILE_REPOSITORY_PUBLIC',		'modules/'.$module_name.'/public/');
define_once('_FILE_REPOSITORY_SCREENS', 		'modules/'.$module_name.'/files/screenshots/');
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	I MAY CHANGE THE NAME OF THIS MODULE IN THE FUTURE,
//	SO WE DEFINE THE MODNAME HERE JUST INCASE.
//---------------------------------------------------------------------
define_once('_MODNAME', 						'file_repository');

// define_once('_force_colorbox_load',false);
// define_once('_force_fancybox_load',false);
// define_once('_force_lightbox_load',false);
// define_once('_force_lightboxevo_load',false);
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	GLOBALIZE SETTINGS THROUGHOUT THE MODULE
//---------------------------------------------------------------------
$settings 	= _settings_variables();
$themes     = _module_themes();
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	HERE WE HAVE THE VARIABLES USED FOR THE JQUERY SIDE OF THINGS
//---------------------------------------------------------------------
if(!isset($_GET['mid']))
$_GET['mid'] = '';

if(!isset($_GET['action']))
$_GET['action'] = '';

$more_js .= '<script>'."\n";
$more_js .= '	var admin_file				= "'.$admin_file.'"'."\n";
$more_js .= '	var css_folder				= "'._FILE_REPOSITORY_CSS.'";'."\n";
$more_js .= '	var img_folder				= "'._FILE_REPOSITORY_SCREENS.'";'."\n";
$more_js .= '	var js_folder				= "'._FILE_REPOSITORY_JS.'";'."\n";
$more_js .= '	var lang_no					= "'.$lang_new[$module_name]['NGO'].'";'."\n";
$more_js .= '	var lang_yes				= "'.$lang_new[$module_name]['YGO'].'";'."\n";

$more_js .= '	var post_max_size			= "'._convert2bytes(ini_get('post_max_size')).'";'."\n";

$more_js .= '	var mid						= "'.$_GET['mid'].'";'."\n";
$more_js .= '	var modname					= "'._MODNAME.'";'."\n";
$more_js .= '	var module_name				= "'.$module_name.'";'."\n";
$more_js .= '	var module_page				= "'.$_GET['action'].'";'."\n";
$more_js .= '	var lang_confirmation       = "'.$lang_new[$module_name]['CONFIRMATION'].'";'."\n";
$more_js .= '	var lang_delete_file      	= "'.$lang_new[$module_name]['DELETE_FILE'].'";'."\n";
$more_js .= '	var lang_version_new		= "'.$lang_new[$module_name]['VERSION_NEW'].'";'."\n";
$more_js .= '	var lang_version_upto_date	= "'.$lang_new[$module_name]['VERSION_UPTO_DATE'].'";'."\n";
$more_js .= '	var lang_xml_process		= "'.$lang_new[$module_name]['XML_NOT_PROCESSED'].'";'."\n";

$more_js .= '	var lang_hide_local			= "'.$lang_new[$module_name]['SHOW_HIDE'].'";'."\n";
$more_js .= '	var lang_show_local			= "'.$lang_new[$module_name]['SHOW_LOCAL'].'";'."\n";

$more_js .= '	var uppercase_text			= "'.$settings['utext'].'";'."\n";
$more_js .= '	var uploaddir				= "'._FILE_REPOSITORY_DIR.'";'."\n";
$more_js .= '	var version_installed		= "'.$settings['version'].'";'."\n";
$more_js .= '	var which_cms				= "'.((!defined('NUKE_EVO')) ? 'ravennuke' : 'evolution').'";'."\n";

$more_js .= '	var image_viewer 			= "'.addslashes(get_image_viewer('screens')).'";'."\n";

# added in 1.0.1
$more_js .= '	var file_upload_amount		= "'.$settings['users_file_upload_amount'].'";'."\n";
$more_js .= '	var screens_upload_amount	= "'.$settings['users_screens_upload_amount'].'";'."\n";
$more_js .= '	var confirm_leave_page		= "'.$lang_new[$module_name]['CONFIRM_LEAVE_PAGE'].'";';

$more_js .= '	var allowed_file_extensions = "'.$settings['allowed_file_extensions'].'";';
$more_js .= '	var allowed_image_extensions = "'.$settings['allowed_image_extensions'].'";';

// $more_js .= '	var copyright_popup_message  = "'.addslashes(_copyright_new_message()).'";';
# added in 1.0.1

$more_js .= '</script>'."\n";

if(function_exists('addJSToBody')):

	# The Following function are used in Raven Nuke & Nuke Evolution 3.0.0
	addJSToBody(isset($JSToBody),'inline');

	addCSSToHead(_FILE_REPOSITORY_CSS.'sceditor/square.css','file');
	addCSSToHead(_FILE_REPOSITORY_CSS.'jquery.colorpicker.css','file');
	addCSSToHead(_FILE_REPOSITORY_CSS.'style.css?v='.$settings['version'],'file');

	addJSToBody(_FILE_REPOSITORY_JS.'jquery.jcarousel.min.js','file');
	addJSToBody(_FILE_REPOSITORY_JS.'jcarousel.responsive.js','file');
	addJSToBody(_FILE_REPOSITORY_JS.'sceditor/jquery.sceditor.bbcode.js','file');
	addJSToBody(_FILE_REPOSITORY_JS.'jquery.colorpicker.js','file');
	addJSToBody(_FILE_REPOSITORY_JS.'jquery.file-repository.js?v='.$settings['version'],'file');

	# added in 1.1.0
	addCSSToHead(_FILE_REPOSITORY_CSS.'jquery.tagit.css','file');
	addCSSToHead(_FILE_REPOSITORY_CSS.'tagit.ui-zendesk.css','file');
	addJSToBody(_FILE_REPOSITORY_JS.'tag-it.min.js','file');
	addJSToBody(_FILE_REPOSITORY_JS.'jquery.cookie.js','file');

	// addJSToBody('//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js','file');
	// addCSSToHead('//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css','file');
	# added in 1.1.0

else:

	// This is for evo 2.0.9d, Will be remove in the next release of the File Repository.
	$more_js .= '<link rel="stylesheet" href="'._FILE_REPOSITORY_CSS.'jquery.ui.css" type="text/css" />';
	$more_js .= '<script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>'."\n";

	$more_js .= '<link rel="stylesheet" href="'._FILE_REPOSITORY_CSS.'sceditor/square.css" type="text/css"/>';
	$more_js .= '<link rel="stylesheet" href="'._FILE_REPOSITORY_CSS.'jquery.colorpicker.css" type="text/css" />';
	$more_js .= '<link rel="stylesheet" href="'._FILE_REPOSITORY_CSS.'style.css?v='.$settings['version'].'" type="text/css" />';

	$more_js .= '<script src="'._FILE_REPOSITORY_JS.'jquery.jcarousel.min.js"></script>'; 
	$more_js .= '<script src="'._FILE_REPOSITORY_JS.'jcarousel.responsive.js"></script>'; 
	$more_js .= '<script src="'._FILE_REPOSITORY_JS.'sceditor/jquery.sceditor.bbcode.js"></script>';
	$more_js .= '<script src="'._FILE_REPOSITORY_JS.'jquery.colorpicker.js"></script>'."\n";
	$more_js .= '<script src="'._FILE_REPOSITORY_JS.'jquery.file-repository.js?v='.$settings['version'].'"></script>'."\n";

	$more_js .= '<link rel="stylesheet" href="'._FILE_REPOSITORY_CSS.'jquery.tagit.css" type="text/css" />';
	$more_js .= '<link rel="stylesheet" href="'._FILE_REPOSITORY_CSS.'tagit.ui-zendesk.css" type="text/css" />';
	$more_js .= '<script src="'._FILE_REPOSITORY_JS.'tag-it.min.js"></script>'."\n";

	/* $more_js .= '<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>'."\n"; */
	/* $more_js .= '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" type="text/css" />'; */

endif;

if(!file_exists('includes/classes/class.paginator.php'))
	require_once('modules/'.$module_name.'/includes/classes/class.paginator.php');

//---------------------------------------------------------------------
//	OK, LETS ADD ALL THE ABOVE FILE AND VARIABLES - RAVEN ONLY
//---------------------------------------------------------------------
// if(!defined('NUKE_EVO')) 
// {
// 	addJSToBody($more_js,'inline');
// }
//---------------------------------------------------------------------
//	OK, LETS ADD ALL THE ABOVE FILE AND VARIABLES - RAVEN ONLY
//---------------------------------------------------------------------
if(!isset($themes[get_theme()]['show_left']))
$themes[get_theme()]['show_left'] = '';

if($themes[get_theme()]['show_left'] == false) 
{
    //$hide_blocks_left = array($module_name);
	$hide_blocks_left = [$module_name];
}

function _average_rating($did,$decimal=FALSE)
{
	global $db, $lang_new, $module_name;
	
	$ratingSum   = 0;
	$ratingCount = 0;
	
	$result = $db->sql_query("SELECT `rating` FROM `"._FILE_REPOSITORY_COMMENTS."` WHERE `did`='$did'");
	if($db->sql_numrows($result) > 0)
	{
		while(list($rating) = $db->sql_fetchrow($result))
		{
			if($rating <> 0)
			{
				$ratingSum += $rating;
				$ratingCount++;
			}
		}
		if($decimal == TRUE)	
			$average_rating_round = round($ratingSum / $ratingCount,2);
		else
			$average_rating_round = round($ratingSum / $ratingCount);
		// Round the number to the nearest half
		$average_rating = floor($average_rating_round * 2) / 2;
	}
	else
	{
		$average_rating = 0;
	}
	return $average_rating.' / 10';
}

function _float_left_right($leftFloatLink=false, $leftFloat = null, $rightFloatLink=false, $rightFloat= null)
 {
 	$float  = '<span style="float: left;">';
//	if($leftFloatLink <> false):
	if($leftFloatLink != false):
 		$float .= '  <a'._ls().' href="'.$leftFloatLink.'">'._sut($leftFloat).'</a>';
 	else:
 		$float .= _sut($leftFloat);
//@@ -9,11 +9,10 @@
 	endif;
 	$float .= '</span>';
 	$float .= '<span style="float: right">';
//	if($rightFloatLink <> false):
	if($rightFloatLink != false):
 		$float .= '  <a'._ls().' href="'.$rightFloatLink.'">'._sut($rightFloat).'</a>';
 	else:
 		$float .= _sut($rightFloat);
 	endif;
//	$float .= '</span>';
//	return $float;
	return $float . '</span>';
 }


//---------------------------------------------------------------------
//	THIS FUNCTION IS ONLY DISPLAYED IN THE ADMIN AREA
//---------------------------------------------------------------------
function _admin_navigation_menu()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	// $row = $db->sql_ufetchrow("SELECT count(isbroken) as isbroken FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isbroken`=1");

	// count the broken downloads in the database.
	$sql = "SELECT count(isbroken) as isbroken FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isbroken` = 1";
	$result = $db->sql_query($sql);
	list($isbroken) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	// count the client uploaded files in the database.
	$sql = "SELECT count(isapproved) as isapproved FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isapproved` = 0";
	$result = $db->sql_query($sql);
	list($isapproved) = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sh(),4).'>'._suh($lang_new[$module_name]['ADMINISTRATION_MODULE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=settings">'._sut($lang_new[$module_name]['MODULE_SETTINGS']).'</a></td>'."\n";
	echo '    <td'._tdcss('50%','center',_sc(),2).'><span id="versionchecker"></span></td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php">'._sut($lang_new[$module_name]['ADMINISTRATION']).'</a></td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=addfile">'._sut($lang_new[$module_name]['FILE_ADD']).'</a></td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=newcat">'._sut($lang_new[$module_name]['CATEGORY_ADD']).'</a></td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'>&nbsp;</td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'>'._float_left_right($admin_file.'.php?op='._MODNAME.'&amp;action=clientuploads',$lang_new[$module_name]['CLIENT_UPLOADED_FILES'],false,'('.$isapproved.')').'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=files">'._sut($lang_new[$module_name]['FILE_LIST']).'</a.</td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=categories">'._sut($lang_new[$module_name]['CATEGORY_LIST']).'</a></td>'."\n";
	// echo '    <td'._tdcss('25%',false,_sc()).'><a'._ls().' href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=cleanfiles">'._sut('Clean Downloads').'</a></td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'><span style="text-decoration: line-through">'._sut('Clean Downloads').'</span></td>'."\n";
	echo '    <td'._tdcss('25%',false,_sc()).'>'._float_left_right($admin_file.'.php?op='._MODNAME.'&amp;action=brokenfiles',$lang_new[$module_name]['BROKEN_ITEMS'],false,'('.$isbroken.')').'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sf(),4).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo ($_GET['action']) ? '<br />' : '';
}
//---------------------------------------------------------------------
//	THIS FUNCTION IS ONLY DISPLAYED IN THE ADMIN AREA
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	FUNCTION IN BETWEEN THESE TWO COMMENT AREAS ARE FOR RAVEN NUKE
//---------------------------------------------------------------------
function _bgColor($bgColor)
{
	global $bgcolor1, $bgcolor2;
	return ($bgColor == 1) ? ' bgcolor="'.$bgcolor1.'"' : ' bgcolor="'.$bgcolor2.'"';
}

// function _captcha_images($n,$v)
// {
// 	global $settings;
// 	$directory = 'images/captcha/';
// 	$images = glob($directory.'*.jpg');
// 	$imgs = array();
// 	foreach($images as $image)
// 		$imgs[] = "$image";

// 	$captcha = '<select name="'.$n.'"';
// 	$captcha .= ' style="';
// 	$captcha .= 'border: 1px solid; ';
// 	$captcha .= 'cursor: pointer; ';
// 	$captcha .= 'font-size: 11px !important; ';
// 	$captcha .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
// 	$captcha .= 'letter-spacing: 1px; ';
// 	$captcha .= 'margin: 0px 1px 1px; ';
// 	$captcha .= ((!defined('NUKE_EVO')) ? 'padding: 4px; ' : 'padding: 5px; ');
// 	$captcha .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';">';
// 	foreach ($imgs as $img) 
// 	{
// 		$value = str_replace('.jpg','',basename($img));
// 		$option = str_replace(array('_','-','.jpg'),array(' ',' ',''),basename($img));
// 		$captcha .= '  <option value="'.$value.'"'.(($value == $settings['captcha']) ? ' selected="selected"' : '').'>'.$option.'</option>';
// 	}
// 	$captcha .= '</select>'."\n";		
// 	return $captcha;
// }

function _category_deletion($cid)
{
	global $db;	
	$catarray  = array();
	$sql_ary   = '';
	$physical  = array();
	$childcats = array();
	$childcats = _category_deletion_scan($cid, $catarray);
	$childcats[0] = $cid;	
	# OK NOW WE HAVE ALL THE CATEGORIES. WE NEED ALL DOWNLOAD INSIDE THOSE CATEGORIES
	foreach ( $childcats as $number => $cat ) 
	{
		$sql_ary .= $cat . ',';
	}
	$sql_ary .= '-1';
	$result = $db->sql_query("SELECT `did` FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `cid` IN ($sql_ary)");
	while(list($did) = $db->sql_fetchrow($result)) 
	{
		$physical[$did]['did'] = $did;
	}
	$db->sql_freeresult($result);
	
	# FIRST DELETE THE LINKS
	if ( count($physical) > 0 ) 
	{
		foreach ( $physical as $delete_no => $delete_did) 
		{
//---------------------------------------------------------------------
//	HERE WE CHECK THE DATABASE FOR THE FILES ATTACHED
//---------------------------------------------------------------------
			$result = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$delete_did['did']."'");
			if( $db->sql_numrows($result) > 0 )
			{
				while($row = $db->sql_fetchrow($result))
				{
					@unlink(_FILE_REPOSITORY_DIR.$row['filename']);
					$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$delete_did['did']."'");
				}
			}
			$db->sql_freeresult($result);
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	HERE WE CHECK THE DATABASE FOR THE SCREENSHOTS ATTACHED
//---------------------------------------------------------------------
			$result = $db->sql_query('SELECT * FROM `'._FILE_REPOSITORY_SCREENSHOTS.'` WHERE `did`="'.$delete_did['did'].'"');
			if( $db->sql_numrows($result) > 0 )
			{
				while($row = $db->sql_fetchrow($result))
				{
					@unlink(_FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$row['filename']);
					@unlink(_FILE_REPOSITORY_SCREENS.'thumbs/thumb_190x120_'.$row['filename']);
					@unlink(_FILE_REPOSITORY_SCREENS.$row['filename']);
					$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$delete_did['did']."'");
				}
			}
			$db->sql_freeresult($result);
//---------------------------------------------------------------------
			$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `did`='".$delete_did['did']."'");
		}
	}
	@arsort($childcats);	
	foreach ( $childcats as $number => $cat ) 
	{		
		$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `cid`='".$cat."'");
	}
	$db->sql_optimize(_FILE_REPOSITORY_CATEGORIES);
	$db->sql_optimize(_FILE_REPOSITORY_FILES);
	$db->sql_optimize(_FILE_REPOSITORY_ITEMS);
	$db->sql_optimize(_FILE_REPOSITORY_SCREENSHOTS);
}

function _category_deletion_scan($catid, $catary) 
{
	global $db;
	static $catary, $counter;
	$allcats = $db->sql_query("SELECT `cid`, `parentid` FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid` =".$catid);
	while ( list($catid, $parentid) = $db->sql_fetchrow($allcats) ) 
	{
		$counter++;
		$catary[$counter] = $catid;
		_category_deletion_scan($catid, $catary);
	}
	$db->sql_freeresult($allcats);
	return $catary;
}

function _categories_from_database($cpID) 
{
	global $db, $admin_file, $lang_new, $module_name;
    $res = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='".$cpID."' ORDER BY `parentid`, `cname` ASC");
    if (!$db->sql_numrows($res)) 
    	return false;
    
    while($r = $db->sql_fetchrow($res)) 
    {
        $sub_category 			= _categories_from_database($r['cid']);
        list($totalSubs) 		= $db->sql_fetchrow($db->sql_query("SELECT COUNT(cid) FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='".$r['cid']."'"));
		list($totalDownloads) 	= $db->sql_fetchrow($db->sql_query("SELECT COUNT(did) FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `cid`='".$r['cid']."'"));
        if($r['parentid'] == 0)
        {
        	$return .= '  <tr'._bgColor(1).'>';
			$return .= '    <td'._tdcss(false,false,_sc(),2).'>'."\n";
			$return .= '      <table width="100%" border="0" cellpadding="0" cellspacing="0">'."\n";
			$return .= '        <tr>'."\n";
			$return .= '          <td'._tdcss('80%',false).'>'._colorization($r['cname'],$r['color']).(($totalSubs > 0) ? '&nbsp;&#8628;' : '').'</td>'."\n"; // (($totalSubs > 0) ? '&nbsp;&#8628;' : '').
			$return .= '          <td'._tdcss('20%','right').'>';
			$return .= '            <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=editcat&amp;cid='.$r['cid'].'"><i class="fa fa-pen"></i></a>';
			$return .= '            <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=deletecat&cid='.$r['cid'].'"><i class="fa fa-times-circle"></i></a>';
			$return .= '          </td>'."\n";
			$return .= '        </tr>'."\n";
			$return .= '      </table>'."\n";
			$return .= '	</td>'."\n";
			$return .= '    <td'._tdcss('10%','center',_sc()).'>'.$totalDownloads.'</td>';
			$return .= '    <td'._tdcss('10%','center',_sc()).'>'._sut((($r['isallowed'] == 1) ? $lang_new[$module_name]['Y'] : $lang_new[$module_name]['N'])).'</td>';
			$return .= '    <td'._tdcss('20%','center',_sc()).'>'._user_is_within_group_name($r['permissions'],$r['isallowed']).'</td>';
			$return .= '  </tr>';
			$return .= $sub_category;			
    	}
        else 
        {
			$return .= '  <tr'._bgColor(1).'>';
			$return .= '    <td'._tdcss(false,'center',_sc()).'>&#8618;</td>';
			$return .= '    <td'._tdcss(false,false,_sc(),1).'>'."\n";
			$return .= '      <table width="100%" border="0" cellpadding="0" cellspacing="0">'."\n";
			$return .= '        <tr>'."\n";
			$return .= '          <td'._tdcss('80%',false).'>'._colorization($r['cname'],$r['color']).'</td>'."\n";
			$return .= '          <td'._tdcss('20%','right').'>';
			$return .= '            <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=editcat&amp;cid='.$r['cid'].'"><i class="fa fa-pen"></i></a>';
			$return .= '            <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=deletecat&cid='.$r['cid'].'"><i class="fa fa-times-circle"></i></a>';
			$return .= '          </td>'."\n";
			$return .= '        </tr>'."\n";
			$return .= '      </table>'."\n";
			$return .= '	</td>'."\n";
			$return .= '    <td'._tdcss('10%','center',_sc()).'>'.$totalDownloads.'</td>';
			$return .= '    <td'._tdcss('10%','center',_sc()).'>'._sut((($r['isallowed'] == 1) ? $lang_new[$module_name]['Y'] : $lang_new[$module_name]['N'])).'</td>';
			$return .= '    <td'._tdcss('20%','center',_sc()).'>'._user_is_within_group_name($r['permissions'],$r['isallowed']).'</td>';
			$return .= '  </tr>';      	
        }
    }
    return $return;
}

function _category_parents($name,$value=0)
{
	global $db, $lang_new, $module_name, $settings;		
	$result = $db->sql_query("SELECT `cid`, `cname`, `parentid`, `color` FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='0' ORDER BY `cname`");
	$category_list = '<select class="glowing-border"';
	$category_list .= ' style="';
	$category_list .= 'border: 1px solid; ';
	$category_list .= 'cursor: pointer; ';
	$category_list .= 'font-size: 11px !important; ';
	$category_list .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
	$category_list .= 'letter-spacing: 1px; ';
	$category_list .= 'margin: 0px 1px 1px; ';
	$category_list .= ((!defined('NUKE_EVO')) ? 'padding: 4px; ' : 'padding: 5px; ');
	$category_list .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';" name="'.$name.'">';
	$category_list .= '  <option value="'.intval($row['cid'] ?? '').'">'.$lang_new[$module_name]['CATEGORY_PARENT_NEW'].'</option>';
	if($db->sql_numrows($result))
	{
		while($row = $db->sql_fetchrow($result))
		{
			$category_list .= '  <option'.(($row['color']) ? ' style="color:'.$row['color'].';"' : '').' value="'.intval($row['cid']).'" '.(($value == $row['cid']) ? 'selected="selected"' : '').'>'.stripslashes($row['cname']).'</option>';
		}
		$db->sql_freeresult($result);
	}
	$category_list .= '</select>';		
	return $category_list;
}

function _category_parents_and_children($name,$value,$search=false,$onlyShowAllowed=false)
{
	global $db, $module_name, $settings;
	$result = $db->sql_query("SELECT `cid`, `cname`, `color`, `isallowed`, `permissions` FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='0' ORDER BY `cname`");
	$category_list = '<select class="glowing-border"';
	$category_list .= ' style="';
	$category_list .= 'border: 1px solid; ';
	$category_list .= 'cursor: pointer; ';
	$category_list .= 'font-size: 11px !important; ';
	$category_list .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
	$category_list .= 'letter-spacing: 1px; ';
	$category_list .= 'margin: 0px 1px 1px; ';
	$category_list .= ((!defined('NUKE_EVO')) ? 'padding: 4px; ' : 'padding: 5px; ');
	$category_list .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';" name="'.$name.'">';
	if($search == true)
		$category_list .= '  <option value="0">'.isset($lang_new[$module_name]['CATEGORY_ALL']).'</option>'."\n";
	while( $row = $db->sql_fetchrow($result) ) 
	{
		// _check_users_permissions($row['permissions']) == true

		// $category_list .= '  <option style="color:'.$row['color'].';" value="'.$row['cid'].'" '.(($row['cid'] == $value) ? 'selected="selected"' : '').'>'.$row['cname'].'</option>'."\n";
		$category_list .= '  <option style="color:'.$row['color'].';" value="'.$row['cid'].'" '.(($row['cid'] == $value) ? 'selected="selected"' : '').(($onlyShowAllowed == true) ? (($row['isallowed'] == 1 && _check_users_permissions($row['permissions']) == true) ? '' : 'disabled') : '').'>'.$row['cname'].'</option>'."\n";

		$result2 = $db->sql_query("SELECT `cid`, `cname`, `color`, `parentid`, `permissions`, `isallowed` FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='".$row['cid']."' ORDER BY `cname`");
		while( $row2 = $db->sql_fetchrow($result2) ) 
		{
			if($search == true):
				$category_list .= '<option style="color:'.$row2['color'].';" value="'.$row2['cid'].'" '.(($row2['cid'] == $value) ? 'selected="selected"' : '').'>&nbsp;&nbsp;'._category_parents_name($row2['parentid'], $row2['cname']).'</option>'."\n";
			else:
				if($onlyShowAllowed == false):
					$category_list .= '<option style="color:'.$row2['color'].';" value="'.$row2['cid'].'" '.(($row2['cid'] == $value) ? 'selected="selected"' : '').'>&#8618;&nbsp;'.$row2['cname'].'</option>'."\n";
				else:
					$category_list .= '<option style="color:'.$row2['color'].';" value="'.$row2['cid'].'" '.(($row2['isallowed'] == 1 && $row['isallowed'] == 1 && _check_users_permissions($row2['permissions']) == true) ? '' : 'disabled').'>&#8618;&nbsp;'.$row2['cname'].'</option>'."\n";
				endif;

			endif;
		}
		$db->sql_freeresult($result2);
	}
	$db->sql_freeresult($result);
	$category_list .= '</select>'."\n";		
	return $category_list;
}

function _category_parents_name($parentid,$title='',$did='',$version='',$color=false) 
{
	global $db, $lang_new, $module_name;		
	$parentid  = intval($parentid);
	$row       = $db->sql_fetchrow($db->sql_query("SELECT `cid`, `color`, `cname`, `parentid` FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `cid`=".$parentid));
	$ptitle    = $row['cname'];
	$pparentid = intval($row['parentid']);
	
	if (!empty($ptitle))
		$title = '<a'._ls().' href="modules.php?name='.$module_name.'&amp;cid='.$row['cid'].'">'._colorization($ptitle,$row['color'],true).'</a> '.(($title != '') ? ' &#10152; '._colorization($title,$color,true) : '');
		
	if ($pparentid != 0)
		$title = _category_parents_name($pparentid,$title);
		
	if($version <> '')
		$title = $title.'&nbsp;v'.$version;
		
	return _suh($title);
}

function _check_users_permissions($section)
{
	global $settings, $admin, $user;
	$priv = $section - 2;
	if (($section == 0) || ($section == 1 AND is_user($user)) || ($section == 2 && is_admin($admin)) || ($section > 2 && _check_users_group($priv)) || is_admin($admin)):
		$permission = true;
	else:
		$permission = false;
	endif;
	return $permission;
}

function _check_users_group($gid) 
{
	global $prefix, $db, $userinfo, $module_name, $user;
	if (is_mod_admin($module_name)) 
		return true;
	elseif (is_user($user)) 
	{
		$guid = $userinfo['user_id'];
		$result = $db->sql_query("SELECT COUNT(*) FROM `"._USER_GROUP_TABLE."` WHERE group_id='".$gid."' AND user_id='".$guid."' AND user_pending != '1'");
		list($ingroup) = $db->sql_fetchrow($result);
		if ($ingroup > 0) 
			return true; 
	}
    return false;
}

// function _copyright_popup()
// {
// 	global $lang_new, $module_name, $settings;
// 	echo '<a class="copyright-popup" style="cursor: pointer; float: right; font-size: 12px; letter-spacing: 1px;">'.$lang_new[$module_name]['MODULE'].'&nbsp;'.$settings['version'].' &copy;</a>';
// }

function _grab_copyright_data()
{
	// $data = get_file_data( './modules/File_Repository/index.php', $file_headers);
	// $copyright_array_data = array();
	// foreach($data as $key => $val){
 //    	$copyright_array_data[] = $val;
	// }
	$data = get_copyright_comments('modules/File_Repository/index.php');
	// $data = (function_exists('get_file_data')) ? 'true' : 'false';
	die(json_encode($data));
}

function _copyright_popup_display()
{
	global $lang_new, $module_name, $settings;
	// echo '<div id="copyright_popup" class="modal" style="display: none">';
	// echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	// echo '	<tr'._bgColor(2).'>'."\n";
	// echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['COPYRIGHT_INFORMATION']).'</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '	  <td'._tdcss(false,'center',_sc(),2).'>'.$lang_new[$module_name]['MODULE'].' '.$lang_new[$module_name]['COPYRIGHT_FOR'].' '.((function_exists('redirect')) ? $lang_new[$module_name]['COPYRIGHT_EVOLUTION_XTREME'] : $lang_new[$module_name]['COPYRIGHT_RAVEN_CMS']).'</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(2).'>'."\n";
	// echo '    <td'._tdcss(false,'center',_sh(),2).'>&nbsp;</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'>'.$lang_new[$module_name]['COPYRIGHT_MODULE'].'</td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'>'.$lang_new[$module_name]['MODULE'].'</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'>'.$lang_new[$module_name]['COPYRIGHT_MODULE_VERSION'].'</td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'>'.$settings['version'].'</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'>'.$lang_new[$module_name]['COPYRIGHT_MODULE_DESCRIPTION'].'</td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'>'.$lang_new[$module_name]['COPYRIGHT_MODULE_TEXT'].'</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'>'.$lang_new[$module_name]['COPYRIGHT_LICENSE'].'</td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'>GNU/GPL</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'>'.$lang_new[$module_name]['COPYRIGHT_MODULE_AUTHOR'].'</td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'>Lonestar</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'><strong>'.$lang_new[$module_name]['COPYRIGHT_MODULE_EMAIL'].'</strong></td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'>crazycoder@live.co.uk</td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";
	// echo '    <td'._tdcss('30%','right',_sc()).'><strong>Author Homepage</strong></td>'."\n";
	// echo '    <td'._tdcss('70%',false,_sc()).'><a'._ls().' href="http://lonestar-modules.com">lonestar-modules</a></td>'."\n";
	// echo '  </tr>'."\n".'<tr'._bgColor(2).'>'."\n";
	// echo '	  <td'._tdcss(false,'center',_sf(),2).'>[ <a'._ls().' href="http://lonestar-modules.com" target="_blank">'.$lang_new[$module_name]['COPYRIGHT_MODULE_HOME'].'</a> | <a'._ls().' href="http://lonestar-modules.com/modules.php?name=File_Repository&action=view&did=33" target="_blank">'.$lang_new[$module_name]['COPYRIGHT_MODULE_DOWNLOAD'].'</a> ]</td>'."\n";
	// echo '  </tr>'."\n";
	// echo '</table>'."\n";
	// echo '</div>';
	echo '<a data-modal href="#ex1" style="cursor: pointer; float: right; letter-spacing: 1px;">'.$lang_new[$module_name]['MODULE'].'&nbsp;'.$settings['version'].' &copy;</a>';
}
//---------------------------------------------------------------------

function _collect_iteminfo($id,$isfile=false)
{
	global $db, $lang_new, $module_name, $settings;
	$where = ($isfile == false) ? ' WHERE dn.`did`="'.$id.'"' : 'WHERE fl.`fid`="'.$id.'"';
	$result = $db->sql_query("
			SELECT dn.*, fl.*, COUNT(cm.cid) as comments, SUM(filesize) as filesize, COUNT(fl.did) as filecount
				FROM (`"._FILE_REPOSITORY_ITEMS."` AS dn)
					LEFT JOIN `"._FILE_REPOSITORY_COMMENTS."` as cm ON (cm.did = dn.did)
					LEFT JOIN `"._FILE_REPOSITORY_FILES."` as fl ON (fl.did = dn.did)".$where.' GROUP BY dn.cid, dn.did, fl.fid');
	$row = $db->sql_fetchrow($result);

	list( $total_attach_files ) = $db->sql_ufetchrow( "select count(*) from `"._FILE_REPOSITORY_FILES."` where `did`='".$id."'" );

	if($row['author'])
		$iteminfo['author']			= (!defined('NUKE_EVO')) ? $row['author'] : UsernameColor($row['author']);
	else
		$iteminfo['author']			= $lang_new[$module_name]['NA'];
	$iteminfo['author_email'] 	= $row['author_email'];
	$iteminfo['author_www'] 	= ($row['author_website']) ? '<a href="http://'.str_replace('http://','',$row['author_website']).'" target="_blank" alt="'.$lang_new[$module_name]['AUTHOR_WEBSITE'].'" title="'.$lang_new[$module_name]['AUTHOR_WEBSITE'].'"><span class="dm-sprite www"></span></a><span style="margin-left: 5px;">'.$iteminfo['author'].'</span>' : $iteminfo['author'];	
	$iteminfo['cid'] 			= $row['cid'];
	$iteminfo['color'] 			= $row['color'];
	$iteminfo['comments']		= $row['comments'];
	$iteminfo['date'] 			= _timestamp($row['date'],$settings['date_format']);
	$iteminfo['description'] 	= stripslashes($row['description']);
	$iteminfo['did'] 			= $row['did'];
	$iteminfo['filecount']		= $total_attach_files;
	$iteminfo['fid']			= $row['fid'];
	$iteminfo['filename']		= $row['filename'];
	$iteminfo['fixes']			= $row['fixes'];
	$iteminfo['groups']			= $row['groups'];
	$iteminfo['hits'] 			= $row['hits'];
	$iteminfo['filesize'] 		= _convertsize($row['filesize']);
	$iteminfo['updated'] 		= $row['isupdated'];
	$iteminfo['isactive']		= $row['isactive'];
	$iteminfo['isbroken']		= $row['isbroken'];
	$iteminfo['isnew']			= (($row['isupdated'] == '0000-00-00 00:00:00') ? $row['date'] : $row['isupdated']);
	$iteminfo['isupdated']		= (($row['isupdated'] == '0000-00-00 00:00:00') ? _timestamp($row['date'],$settings['date_format']) : _timestamp($row['isupdated'],$settings['date_format']));
	$iteminfo['posts'] 			= $row['posts'];
	$iteminfo['preview'] 		= $row['preview'];
	$iteminfo['size'] 			= $row['filesize'];
	$iteminfo['title'] 			= stripslashes($row['title']);
	$iteminfo['title_colored'] 	= _colorization($iteminfo['title'],$iteminfo['color']);
	$iteminfo['version']		= ($row['version']) ? $row['version'] : '';
	$iteminfo['views'] 			= $row['views'];
	$iteminfo['whocan'] 		= _user_is_within_group_name($iteminfo['groups']);
	return $iteminfo;
}

function _colorization($title,$color,$bold=false)
{
	global $settings;
	return '<span class="color_title" style="'.(($bold == true) ? 'font-weight:bold;' : '').'color:'.$color.';">'._sut($title).'</span>';
}

//----------------------------------------------------------------------------------
//	Make thumbnail from uploaded image...
//----------------------------------------------------------------------------------
function _create_thumb_from_image($ini_path,$dest_path,$params=array()) 
{
	@ini_set('memory_limit', '100M');
    $width        = !empty($params['width'])? $params ['width'] : NULL;
    $height       = !empty($params['height']) ? $params['height'] : NULL;
    $constraint   = !empty($params['constraint']) ? $params['constraint'] : false;
    $rgb          = !empty($params['rgb'])? $params['rgb'] : 0xFFFFFF;
    $quality      = !empty($params['quality']) ? $params['quality'] : 100;
    $aspect_ratio = isset($params['aspect_ratio']) ? $params['aspect_ratio'] : true;
    $crop         = isset($params['crop']) ? $params['crop'] : true;
 
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
    $output_format = ($ext == 'jpg') ? 'jpeg' : $ext;
 
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
//----------------------------------------------------------------------------------

//---------------------------------------------------------------------
//	CONVERT THE FILESIZE 
//---------------------------------------------------------------------
function _convertsize($size)  
{
    $mb = 1024*1024;
    $gb = $mb*1024;
    if ($size > $gb)
        $mysize = round (sprintf ('%01.2f',$size/$gb)).' GB';
    elseif ($size > $mb)
        $mysize = round (sprintf ('%01.2f',$size/$mb)).' MB';
    elseif ($size >= 1024)
        $mysize = round (sprintf ('%01.2f',$size/1024)).' KB';
    else
        $mysize = $size.' Bytes';
    return $mysize;
}

function _convert2bytes($value) 
{
  return preg_replace_callback('/^\s*(\d+)\s*(?:([kmgt]?)b?)?\s*$/i', function ($m) 
  {
    switch (strtolower($m[2])) 
    {
      case 't': $m[1] *= 1024;
      case 'g': $m[1] *= 1024;
      case 'm': $m[1] *= 1024;
      case 'k': $m[1] *= 1024;
    }
    return $m[1];
  }, $value);
}

//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	DECODE ANY BBCODE THAT MAY BE IN THE DESCRIPTION
//---------------------------------------------------------------------
function _decode_bbcode_text($text,$parse_smilies=false)
{
	global $lang_new, $module_name;
	$text = trim($text);
	# [ul] and [/ul]
	$text = preg_replace_callback("(\[ul\](.*?)\[/ul\])is", function($m) { return '<ul style="display: block; list-style-type: disc;">'.$m[1].'</ul>'; }, $text);
	# [ol] and [/ol]
	$text = preg_replace_callback("(\[ol\](.*?)\[/ol\])is", function($m) { return '<ol style="display: block; list-style-type: disc;">'.$m[1].'</ol>'; }, $text);
	# [li] and [/li]
	$text = preg_replace_callback("(\[li\](.*?)\[/li\])is", function($m) { return '<li style="display: list-item; text-align: -webkit-match-parent;">'.$m[1].'</li>'; }, $text);
	# Color
	$text = preg_replace_callback("(\[color=(\#[0-9A-F]{6}|[a-z]+)\](.*?)\[/color\])is", function($m) { return '<span style="color:'.$m[1].'">'.$m[2].'</span>'; }, $text);
	# Font
	$text = preg_replace_callback("(\[font=(.*?)\](.*?)\[/font\])is", function($m) { return '<span style="font-family: '.$m[1].'">'.$m[2].'</span>'; }, $text);
	# [b] and [/b] for bolding text.
	$text = preg_replace_callback("(\[b\](.*?)\[/b\])is", function($m) { return '<span style="font-weight: bold">'.$m[1].'</span>'; }, $text);
	# [u] and [/u] for underlining text.
	$text = preg_replace_callback("(\[u\](.*?)\[/u\])is", function($m) { return '<span style="text-decoration: underline">'.$m[1].'</span>'; }, $text);
	# [i] and [/i] for italicizing text.
	$text = preg_replace_callback("(\[i\](.*?)\[/i\])is", function($m) { return '<span style="font-style: italic;">'.$m[1].'</span>'; }, $text);
	# [s] and [/s] for italicizing text.
	$text = preg_replace_callback("(\[s\](.*?)\[/s\])is", function($m) { return '<span style="text-decoration: line-through;">'.$m[1].'</span>'; }, $text);
	# align
	$text = preg_replace_callback("(\[align=(left|right|center|justify)\](.*?)\[/align\])is", function($m) { return '<div style="text-align:'.$m[1].';">'.$m[2].'</div>'; }, $text);
	# SCeditor Center Alignment
	$text = preg_replace_callback("(\[center\](.*?)\[/center\])is", function($m) { return '<div style="text-align:center;">'.$m[1].'</div>'; }, $text);
	# SCeditor Left Alignment	
	$text = preg_replace_callback("(\[left\](.*?)\[/left\])is", function($m) { return '<div style="text-align:left;">'.$m[1].'</div>'; }, $text);
	# SCeditor Right Alignment	
	$text = preg_replace_callback("(\[right\](.*?)\[/right\])is", function($m) { return '<div style="text-align:right;">'.$m[1].'</div>'; }, $text);
	# SCeditor Justify Alignment
	$text = preg_replace_callback("(\[justify\](.*?)\[/justify\])is", function($m) { return '<div style="text-align:justify;">'.$m[1].'</div>'; }, $text);

	# [url] local
	$text = preg_replace_callback("(\[url\]([\w]+(\.html|\.php|/)[^ \[\"\n\r\t<]*?)\[/url\])is", function($m) { return '<a'._ls().' href="'.$m[1].'" title="'.$m[1].'" class="postlink">'.$m[1].'</a>'; }, $text);
	$text = preg_replace_callback("(\[url=([\w]+(\.html|\.php|/)[^ \[\"\n\r\t<]*?)\](.*?)\[/url\])is", function($m) { return '<a'._ls().' href="'.$m[1].'" title="'.$m[1].'" class="postlink">'.$m[3].'</a>'; }, $text);

    # [url]xxxx://www.cpgnuke.com[/url]
	$text = preg_replace_callback("(\[url\]([\w]+?://[^ \[\"\n\r\t<]*?)\[/url\])is", function($m) { return '<a'._ls().' href="'.$m[1].'" target="_blank" title="'.$m[1].'" class="postlink" rel="nofollow">'.$m[1].'</a>'; }, $text);

    # [url]www.cpgnuke.com[/url] (no xxxx:// prefix).
	$text = preg_replace_callback("(\[url\]((www|ftp)\.[^ \[\"\n\r\t<]*?)\[/url\])is", function($m) { return '<a'._ls().' href="http://'.$m[1].'" target="_blank" title="'.$m[1].'" class="postlink" rel="nofollow">'.$m[1].'</a>'; }, $text);

    # [url=www.cpgnuke.com]cpgnuke[/url] (no xxxx:// prefix).
	$text = preg_replace_callback("(\[url=((www|ftp)\.[^ \"\n\r\t<]*?)\](.*?)\[/url\])is", function($m) { return '<a'._ls().' href="http://'.$m[1].'" target="_blank" title="'.$m[1].'" class="postlink" rel="nofollow">'.$m[3].'</a>'; }, $text);

    # [url=xxxx://www.cpgnuke.com]cpgnuke[/url]	
	$text = preg_replace_callback("(\[url=(.*?)\](.*?)\[/url\])is", function($m) { return '<a'._ls().' href="'.$m[1].'" target="_blank" class="postlink" rel="nofollow">'.$m[2].'</a>'; }, $text);

	#  [hr] Horizontal Rule.
	$text = preg_replace_callback("(\[hr\])is", function($m) { return '<hr>'; }, $text);

	# [img]image_url_here[/img] code..	
	$text = preg_replace_callback("(\[img\](.*?)\[/img\])is", function($m) { return '<a class="fancybox" href="'.$m[1].'"><img src="'.$m[1].'" border="0" alt="" /></a>'; }, $text);

	# [img=width x height]image_url_here[/img] code..
	# SCEditor addition
	$text = preg_replace_callback("(\[img=([0-6]?[0-9]?[0-9])x([0-4]?[0-9]?[0-9])\](.*?)\[/img\])is", function($m) { return '<a class="fancybox" href="'.$m[3].'"><img src="'.$m[3].'" width="'.$m[1].'" height="'.$m[2].'" border="0" alt="" /></a>'; }, $text);

	# youTube
	$text = preg_replace_callback("(\[youtube\]([0-9A-Za-z-_]{11})[^[]*\[/youtube\])is", function($m) { return '<iframe height="360" width="640" src="https://www.youtube.com/embed/'.$m[1].'?rel=0&vq=hd1080" frameborder="0" allowfullscreen></iframe>'; }, $text);

	# [code]$string[/code]
	$text = preg_replace_callback("(\[code\](.*?)\[/code\])is", function($m) { return '<div style="margin: auto; width: 85%;">Code:<br /><div class="code_function">'.$m[1].'</div></div>'; }, $text);

	# [quote]$string[/quote]
	$text = preg_replace_callback("(\[quote\](.*?)\[/quote\])is", function($m) { return '<div style="margin: auto; width: 85%;">Quote:<br /><div class="code_function">'.$m[1].'</div></div>'; }, $text);

	if(!function_exists('_decode_fontsize'))
	{
		function _decode_fontsize($matches)
		{
			$sizeArray = array('1'=>'x-small','2'=>'small','3'=>'medium','4'=>'large','5'=>'x-large','6'=>'xx-large','7'=>'-webkit-xxx-large');
			foreach ($sizeArray as $size => $value)
			{
				if($matches[1] == $size)
					return '<span style="font-size: '.$value.';">'.$matches[2].'</span>';
			}
		}
	}
	$text = preg_replace_callback("(\[size=(.*?)\](.*?)\[/size\])is", '_decode_fontsize', $text);
	// $text = preg_replace_callback("(\[size=(.*?)\](.*?)\[/size\])is", create_function('$m','return"<span style=\"font-size: ".$m[1]."px; line-height: normal\">".$m[2]."</span>";'), $text);
//---------------------------------------------------------------------
//	EMOTICONS
//---------------------------------------------------------------------
	if($parse_smilies == 1)
	{
		$text = str_replace(':)',			'<img src="modules/'.$module_name.'/images/emoticons/smile.png" border="0" />',$text);
		$text = str_replace(':angel:',		'<img src="modules/'.$module_name.'/images/emoticons/angel.png" border="0" />',$text);
		$text = str_replace(':angry:',		'<img src="modules/'.$module_name.'/images/emoticons/angry.png" border="0" />',$text);
		$text = str_replace('8-)',			'<img src="modules/'.$module_name.'/images/emoticons/cool.png" border="0" />',$text);
		$text = str_replace(':\'(',			'<img src="modules/'.$module_name.'/images/emoticons/cwy.png" border="0" />',$text);
		$text = str_replace(':ermm:',		'<img src="modules/'.$module_name.'/images/emoticons/ermm.png" border="0" />',$text);
		$text = str_replace(':D',			'<img src="modules/'.$module_name.'/images/emoticons/grin.png" border="0" />',$text);
		$text = str_replace('<3',			'<img src="modules/'.$module_name.'/images/emoticons/heart.png" border="0" />',$text);
		$text = str_replace(':(',			'<img src="modules/'.$module_name.'/images/emoticons/sad.png" border="0" />',$text);
		$text = str_replace(':O',			'<img src="modules/'.$module_name.'/images/emoticons/shocked.png" border="0" />',$text);
		$text = str_replace(':P',			'<img src="modules/'.$module_name.'/images/emoticons/tongue.png" border="0" />',$text);
		$text = str_replace(';)',			'<img src="modules/'.$module_name.'/images/emoticons/wink.png" border="0" />',$text);
		$text = str_replace(':alien:',		'<img src="modules/'.$module_name.'/images/emoticons/alien.png" border="0" />',$text);
		$text = str_replace(':blink:',		'<img src="modules/'.$module_name.'/images/emoticons/blink.png" border="0" />',$text);
		$text = str_replace(':blush:',		'<img src="modules/'.$module_name.'/images/emoticons/blush.png" border="0" />',$text);
		$text = str_replace(':cheerful:',	'<img src="modules/'.$module_name.'/images/emoticons/cheerful.png" border="0" />',$text);
		$text = str_replace(':devil:',		'<img src="modules/'.$module_name.'/images/emoticons/devil.png" border="0" />',$text);
		$text = str_replace(':dizzy:',		'<img src="modules/'.$module_name.'/images/emoticons/dizzy.png" border="0" />',$text);
		$text = str_replace(':getlost:',	'<img src="modules/'.$module_name.'/images/emoticons/getlost.png" border="0" />',$text);
		$text = str_replace(':happy:',		'<img src="modules/'.$module_name.'/images/emoticons/happy.png" border="0" />',$text);
		$text = str_replace(':kissing:',	'<img src="modules/'.$module_name.'/images/emoticons/kissing.png" border="0" />',$text);
		$text = str_replace(':ninja:',		'<img src="modules/'.$module_name.'/images/emoticons/ninja.png" border="0" />',$text);
		$text = str_replace(':pinch:',		'<img src="modules/'.$module_name.'/images/emoticons/pinch.png" border="0" />',$text);
		$text = str_replace(':pouty:',		'<img src="modules/'.$module_name.'/images/emoticons/pouty.png" border="0" />',$text);
		$text = str_replace(':sick:',		'<img src="modules/'.$module_name.'/images/emoticons/sick.png" border="0" />',$text);
		$text = str_replace(':sideways:',	'<img src="modules/'.$module_name.'/images/emoticons/sideways.png" border="0" />',$text);
		$text = str_replace(':silly:',		'<img src="modules/'.$module_name.'/images/emoticons/silly.png" border="0" />',$text);
		$text = str_replace(':sleeping:',	'<img src="modules/'.$module_name.'/images/emoticons/sleeping.png" border="0" />',$text);
		$text = str_replace(':unsure:',		'<img src="modules/'.$module_name.'/images/emoticons/unsure.png" border="0" />',$text);
		$text = str_replace(':woot:',		'<img src="modules/'.$module_name.'/images/emoticons/w00t.png" border="0" />',$text);
		$text = str_replace(':wassat:',		'<img src="modules/'.$module_name.'/images/emoticons/wassat.png" border="0" />',$text);
		$text = str_replace(':whistling:',	'<img src="modules/'.$module_name.'/images/emoticons/whistling.png" border="0" />',$text);
		$text = str_replace(':love:',		'<img src="modules/'.$module_name.'/images/emoticons/wub.png" border="0" />',$text);
	}
//---------------------------------------------------------------------
	$text = nl2br($text);
	return $text;
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	ESCAPE A QUERY
//---------------------------------------------------------------------
function _escape_string($query)
{
	global $db;
	return (!defined('NUKE_EVO')) ? FixQuotes($query) : Fix_Quotes($query);
}
//---------------------------------------------------------------------

function _grab_the_items_screenshots($did)
{
	global $db, $module_name, $settings;
	$sql 	= "SELECT * FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$did."'";
	$result = $db->sql_query($sql);
	$count 	= $db->sql_numrows($result);
	
	if(!isset($jcarousel))
	$jcarousel = '';
	
	$jcarousel .= '  <div class="jcarousel-wrapper">'."\n";
	$jcarousel .= '    <div class="jcarousel thumbnail_border">'."\n";
	$jcarousel .= '      <ul>'."\n";
	while($screen = $db->sql_fetchrow($result))
	{
		if(file_exists(_FILE_REPOSITORY_SCREENS.$screen['filename']))
		{
			$jcarousel .= '<li>';
			$jcarousel .= '    <a'.get_image_viewer('item-'.$did).' href="'._FILE_REPOSITORY_SCREENS.$screen['filename'].'" title="'.$screen['title'].'">';
			$jcarousel .= '      <img src="'._FILE_REPOSITORY_SCREENS.'thumbs/thumb_190x120_'.$screen['filename'].'" border="0" />';
			$jcarousel .= '    </a>';
			$jcarousel .= '</li>'."\n";
		}
	}
	$db->sql_freeresult($result);
	$jcarousel .= '      </ul>'."\n";
	$jcarousel .= '    </div>'."\n";
	if($count > 1)
	{
		$jcarousel .= '  <span class="jcarousel-pagination"></span>';
		$jcarousel .= '  <span class="dm-sprite sprite-nav-left jcarousel-control-prev"></span>';
		$jcarousel .= '  <span class="dm-sprite sprite-nav-right jcarousel-control-next"></span>';
	}
	$jcarousel .= '  </div>'."\n";

	$return['carousel'] = $jcarousel;
	$return['count'] 	= $count;
	return $return;
}

function _image_viewer($slideshow)
{
	global $settings;
	switch($settings['viewer']):

		case 'colorbox':
			if(file_exists('includes/jquery/jquery.colorbox.js') || file_exists('includes/js/colorbox/jquery.colorbox-min.js') || file_exists('includes/js/jquery.colorbox.php')):
				$viewer = ' class="colorbox" rel="'.$slideshow.'"';
			endif;
			break;

		case 'fancybox':
			if(file_exists('includes/jquery/jquery.fancybox.js') || file_exists('includes/fancybox/jquery.fancybox.js') || file_exists('includes/js/jquery.fancybox.js')):
				$viewer = ' class="fancybox" data-fancybox-group="'.$slideshow.'"';
			# This is for future support for 3.0.0
			elseif(file_exists('includes/js/jquery.fancybox.php')):
				$viewer = ' data-fancybox';
			endif;
			break;

		case 'lightbox':
			if(file_exists('includes/jquery/jquery.lightbox.js') 
				|| file_exists('includes/lightbox/lightbox.js') 
				|| file_exists('includes/lightbox/jquery.lightbox.js') 
				|| file_exists('includes/js/jquery.lightbox.js') 
				|| file_exists('includes/js/jquery.lightbox.php')):
				$viewer = ' data-lightbox="'.$slideshow.'"';
			endif;
			break;

		case 'lightboxevo':
			if(file_exists('includes/js/jquery.lightbox.evolution.php')):
				$viewer = '  class="lightbox-evo"'.(($slideshow) ? ' data-rel="'.$slideshow.'"' : '');
			endif;
			break;
	
	endswitch;
	return $viewer;
}

function _index_navigation_header()
{
	global $db, $admin_file, $lang_new, $module_name, $admin, $settings, $bgcolor, $userinfo;		
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '	<tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sh(),6).'>'._suh($lang_new[$module_name]['MODULE']).'</td>'."\n";
	echo '  </tr>'."\n";		
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('16.6%','center',_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'">'._sut($lang_new[$module_name]['MAIN']).'</a></td>'."\n";
	echo '    <td'._tdcss('16.6%','center',_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=newdownloads">'._sut($lang_new[$module_name]['NEW']).'</a></td>'."\n";
	echo '    <td'._tdcss('16.6%','center',_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=mostpopular">'._sut($lang_new[$module_name]['POPULAR']).'</a></td>'."\n";
	echo '    <td'._tdcss('16.6%','center',_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=statistics">'._sut($lang_new[$module_name]['STATISTICS']).'</a></td>'."\n";
	echo '    <td'._tdcss('16.6%','center',_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=search">'._sut($lang_new[$module_name]['SEARCH']).'</a></td>'."\n";
	echo '    <td'._tdcss('16.6%','center',_sc()).'>';
	if($settings['users_can_upload'] == true):
		echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=submitdownload">'._sut($lang_new[$module_name]['SUBMITDOWNLOAD']).'</a>';
	else:
		echo '      <span style="text-decoration: line-through;">'._sut($lang_new[$module_name]['SUBMITDOWNLOAD']).'</span>';
	endif;
	echo '    </td>'."\n";
	echo '  </tr>'."\n";

	if($settings['show_legend'] == true):

		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),6).'>'._suh($lang_new[$module_name]['LEGEND']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '	<tr'._bgColor(1).'>'."\n";
		echo '	  <td'._tdcss(false,'center',_sc(),6).'>'."\n";		
		echo '      <table width="100%" border="0" cellpadding="0" cellspacing="0">'."\n";
		echo '        <tr>'."\n";
		echo '	        <td'._tdcss('33%','center').'>'._sut($lang_new[$module_name]['NEW_TODAY']).' (<span class="legend-images-sprite legend_new_today"></span>)</td>'."\n";
		echo '	        <td'._tdcss('34%','center').'>'._sut($lang_new[$module_name]['NEW_LAST_3DAY']).' (<span class="legend-images-sprite legend_new_3_today"></span>)</td>'."\n";
		echo '	        <td'._tdcss('33%','center').'>'._sut($lang_new[$module_name]['NEW_THIS_WEEK']).' (<span class="legend-images-sprite legend_new_this_week"></span>)</td>'."\n";
		echo '        </tr>'."\n";	
		echo '        <tr>'."\n";
		echo '	        <td'._tdcss('33%','center').'>'._sut($lang_new[$module_name]['UPDATED_TODAY']).' (<span class="legend-images-sprite legend_updated_today"></span>)</td>'."\n";
		echo '	        <td'._tdcss('34%','center').'>'._sut($lang_new[$module_name]['UPDATED_LAST_3DAY']).' (<span class="legend-images-sprite legend_updated_3_days"></span>)</td>'."\n";
		echo '	        <td'._tdcss('33%','center').'>'._sut($lang_new[$module_name]['UPDATED_THIS_WEEK']).' (<span class="legend-images-sprite legend_updated_this_week"></span>)</td>'."\n";
		echo '        </tr>'."\n";
		echo '      </table>'."\n";		
		echo '    </td>'."\n";
		echo '  </tr>'."\n";

	endif;

	if($settings['overview_display'] == true && in_array($_GET['action'],explode(',',$settings['overview_display_areas'])) || $_GET['action'] == ''):

		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),6).'>'._suh($lang_new[$module_name]['OVERVIEW']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss(false,false,_sc(),6).'>';

		echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '        <tr'._bgColor(1).'>'."\n";
		echo '	        <td'._tdcss('50%',false,_sc()).' valign="top">';
		echo '            <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '              <tr'._bgColor(2).'>'."\n";
		echo '	              <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['LATEST_FILES']).'</td>';
		echo '              </tr>'."\n";
		$sql 	 = "SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isactive` = 1 && `isapproved` = 1 && `isbroken` = 0 ORDER BY `date` DESC LIMIT 0,".$settings['overview_count'];
		$result  = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		if($numrows > 0):
		
			echo '              <tr'._bgColor(2).'>'."\n";
			echo '	              <td'._tdcss(false,'center',_sh()).'>#</td>';
			echo '	              <td'._tdcss(false,false,_sh()).'>'._suh($lang_new[$module_name]['DOWNLOAD']).'</td>';
			echo '	              <td'._tdcss(false,'center',_sh()).'>'._suh($lang_new[$module_name]['HITS']).'</td>';
			echo '              </tr>'."\n";
			$x = 1;
			while($lf = $db->sql_fetchrow($result)):
			
				$iteminfo['isnew'] = (($lf['isupdated'] == '0000-00-00 00:00:00') ? $lf['date'] : $lf['isupdated']);
				echo '              <tr'._bgColor(1).'>'."\n";
				echo '	              <td'._tdcss('7%','center',_sc()).'>'.$x.'</td>';
				echo '	              <td'._tdcss('78%',false,_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$lf['did'].'#'.$lf['did'].'">'._colorization($lf['title'],$lf['color']).'</a>'._item_is_new($iteminfo['isnew'],$lf['isupdated'])._mostpopular($lf['hits']).'</td>';
				echo '	              <td'._tdcss('15%','center',_sc()).'>'.$lf['hits'].'</td>';
				echo '              </tr>'."\n";
				$x++;
			
			endwhile;
			$db->sql_freeresult($result);

		else:

			echo '              <tr'._bgColor(2).'>'."\n";
			echo '	              <td'._tdcss(false,'center',_sc(),3).'>'._sut($lang_new[$module_name]['NOINFO']).'</td>';
			echo '              </tr>'."\n";

		endif;
		echo '            </table>'."\n";
		echo '          </td>'."\n";
		# MOST DOWNLOADED FILES, LIMITED TO THE VALUE SET IN THE SETTINGS
		echo '	        <td'._tdcss('50%',false,_sc()).' valign="top">';
		echo '            <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '              <tr'._bgColor(2).'>'."\n";
		echo '	              <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['MOST_DOWNLOADS']).'</td>';
		echo '              </tr>'."\n";
		$sql 	 = "SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `hits` <> 0 && `isactive` = 1 && `isapproved` = 1 && `isbroken` = 0 ORDER BY `hits` DESC LIMIT 0,".$settings['overview_count'];
		$result  = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		if($numrows > 0):

			echo '              <tr'._bgColor(2).'>'."\n";
			echo '	              <td'._tdcss(false,'center',_sh()).'>#</td>';
			echo '	              <td'._tdcss(false,false,_sh()).'>'._suh($lang_new[$module_name]['DOWNLOAD']).'</td>';
			echo '	              <td'._tdcss(false,'center',_sh()).'>'._suh($lang_new[$module_name]['HITS']).'</td>';
			echo '              </tr>'."\n";
			$s = 1;
			while($md = $db->sql_fetchrow($result)):

				$iteminfo['isnew'] = (($md['isupdated'] == '0000-00-00 00:00:00') ? $md['date'] : $md['isupdated']);
				echo '              <tr'._bgColor(1).'>'."\n";
				echo '	              <td'._tdcss('7%','center',_sc()).'>'.$s.'</td>';
				echo '	              <td'._tdcss('78%',false,_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$md['did'].'">'._colorization($md['title'],$md['color']).'</a>'._item_is_new($iteminfo['isnew'],$md['isupdated'])._mostpopular($md['hits']).'</td>';
				echo '	              <td'._tdcss('15%','center',_sc()).'>'.$md['hits'].'</td>';
				echo '              </tr>'."\n";
				$s++;

			endwhile;
			$db->sql_freeresult($result);

		else:

			echo '              <tr'._bgColor(2).'>'."\n";
			echo '	              <td'._tdcss(false,'center',_sc(),3).'>'._sut($lang_new[$module_name]['NOINFO']).'</td>';
			echo '              </tr>'."\n";
		
		endif;
		echo '            </table>'."\n";
		echo '          </td>'."\n";
		echo '        </tr>'."\n";
		echo '      </table>'."\n";
		echo '    </td>'."\n";
		echo '  </tr>'."\n";
	
	endif;
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sf(),6).'>'.((is_admin($admin)) ? '[&#8618;] <a'._ls().' href="'.$admin_file.'.php?op=file_repository">'._suh($lang_new[$module_name]['ADMINISTRATION_MODULE']).'</a> [&#8617;]' : '&nbsp;').'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";

	$sql 	 = "SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isapproved` = 0 && `isbroken` = 0 && `suid` = '".$userinfo['user_id']."' ORDER BY `date`";
	$result  = $db->sql_query($sql);
	$waiting = $db->sql_numrows($result);

	$settings['show_user_awaiting_approval_message'] = true;
	if($settings['show_user_awaiting_approval_message'] && $waiting > 0):

		echo '<br />';
		echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '	<tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['SUBMITTED_HEADER']).'</td>'."\n";
		echo '  </tr>'."\n";

		$x = 1;
		while($awaiting = $db->sql_fetchrow($result)):

			echo '  <tr'._bgColor(1).'>'."\n";
			echo '	  <td'._tdcss('5%','center',_sc()).'>'.$x.'</td>'."\n";
			echo '	  <td'._tdcss(false,false,_sc()).'>Your download named "<span style="font-weight: 800;">'.$awaiting['title'].'</span>" you submitted on <span style="font-weight: 800;">'._timestamp($awaiting['date'],$settings['date_format']).'</span> is awaiting apporval by the admin team.</td>'."\n";
			echo '  </tr>'."\n";
			$x++;

		endwhile;

		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),2).'>&nbsp;</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";

	endif;
}

function _item_is_new($time,$update)
{
	global $lang_new, $module_name;
	$startdate = time();
    $count = 0;
    $checktime = time() - strtotime($time);
    $check_upd = time() - strtotime($update);
	if ($update == '0000-00-00 00:00:00'):

        if ($checktime <= 86400 ):
			return ('&nbsp;<span class="legend-images-sprite legend_new_today" alt="'.$lang_new[$module_name]['NEW_TODAY'].'" title="'.$lang_new[$module_name]['NEW_TODAY'].'"></span>'); 
		elseif ($checktime <= 259200):
			return ('&nbsp;<span class="legend-images-sprite legend_new_3_today" alt="'.$lang_new[$module_name]['NEW_LAST_3DAY'].'" title="'.$lang_new[$module_name]['NEW_LAST_3DAY'].'"></span>'); 
		elseif ($checktime <= 604800):
			return ('&nbsp;<span class="legend-images-sprite legend_new_this_week" alt="'.$lang_new[$module_name]['NEW_THIS_WEEK'].'" title="'.$lang_new[$module_name]['NEW_THIS_WEEK'].'"></span>');
		endif;

	else:

		if ($check_upd <= 86400):
			return ('&nbsp;<span class="legend-images-sprite legend_updated_today" alt="'.$lang_new[$module_name]['UPDATED_TODAY'].'" title="'.$lang_new[$module_name]['UPDATED_TODAY'].'"></span>');
		elseif ($check_upd <= 259200):
			return ('&nbsp;<span class="legend-images-sprite legend_updated_3_days" alt="'.$lang_new[$module_name]['UPDATED_LAST_3DAY'].'" title="'.$lang_new[$module_name]['UPDATED_LAST_3DAY'].'"></span>');
		elseif ($check_upd <= 604800):
			return ('&nbsp;<span class="legend-images-sprite legend_updated_this_week" alt="'.$lang_new[$module_name]['UPDATED_THIS_WEEK'].'" title="'.$lang_new[$module_name]['UPDATED_THIS_WEEK'].'"></span>');
		endif;

	endif;
}

function _sc($view=true)
{
	global $themes;

	if(!isset($themes[get_theme()]['cell']))
	$themes[get_theme()]['cell'] = '';

	return ($themes[get_theme()]['cell'] == 0) ? 'row1'.(($view == 0) ? ' displayNone' : '') : (($view == 0) ? 'displayNone' : false);
}

function _sf()
{
	global $themes;

	if(!isset($themes[get_theme()]['head']))
	$themes[get_theme()]['head'] = '';

	return ($themes[get_theme()]['head'] == 0) ? 'catBottom' : false;
}

function _sh($view=true)
{
	global $themes;
	
	if(!isset($themes[get_theme()]['head']))
	$themes[get_theme()]['head'] = '';
	
	return ($themes[get_theme()]['head'] == 0) ? 'catHead'.(($view == 0 ) ? ' displayNone' : '') : (($view == 0) ? 'displayNone' : false);
}

function _list_available_permission_groups($name, $value)
{
	global $db, $lang_new, $module_name, $settings;		
	$result = $db->sql_query("SELECT * FROM `"._GROUPS_TABLE."` WHERE `group_single_user` != '1' ORDER BY `group_name`");
	$groups  = '<select class="glowing-border"';
	$groups .= ' style="';
	$groups .= 'border: 1px solid; ';
	$groups .= 'cursor: pointer; ';
	$groups .= 'font-size: 11px !important; ';
	$groups .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
	$groups .= 'letter-spacing: 1px; ';
	$groups .= 'margin: 0px 1px 1px; ';
	$groups .= ((!defined('NUKE_EVO')) ? 'padding: 4px; ' : 'padding: 5px; ');
	$groups .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';" name="'.$name.'">';
	$groups .= '        <optgroup label="'.$lang_new[$module_name]['GROUPS_GENERAL'].'">'."\n";
	$groups .= '          <option value="0" '.(($value == '' || $value == 0) ? 'selected="selected"' : '').'>'.$lang_new[$module_name]['ALL_VISITORS'].'</option>'."\n";
	$groups .= '          <option value="1" '.(($value == 1) ? 'selected="selected"' : '').'>'.$lang_new[$module_name]['REGISTERED'].'</option>'."\n";
	$groups .= '          <option value="2" '.(($value == 2) ? 'selected="selected"' : '').'>'.$lang_new[$module_name]['ADMINISTRATORS'].'</option>'."\n";
	$groups .= '        </optgroup>'."\n";
	if( $db->sql_numrows($result) > 0 )
	{
		$groups .= '    <optgroup label="'.$lang_new[$module_name]['FORUM_GROUPS'].'">'."\n";			
		while($ginfo = $db->sql_fetchrow($result)) 
		{
			$ginfo['group_id'] = $ginfo['group_id'] + 2;
			$groups .= '  <option value="'.$ginfo['group_id'].'" '.(($value == $ginfo['group_id']) ? 'selected="selected"' : '').'>'._sut($ginfo['group_name']).'</option>'."\n";
		}
		$db->sql_freeresult($result);
	}
	$groups .= '      </select>'."\n";
	return $groups;
}

function _input_checkbox($n,$d,$l,$v=array())
{
	$checkbox = '<label for="'.$n.'"><input type="checkbox" name="'.$n.'" value="'.$d.'"'.((in_array($d,$v)) ? ' checked' : '').'/>'.$l.'</label>';
	return $checkbox;
}

// function _input($t=false,$n=false,$w=false,$v='',$m=false,$p=false,$r=false,$c=false,$arr=false)
function _input($t=false,$n=false,$w=false,$v='',$m=false,$p=false,$r=false,$c=false)
{
	if(!isset($checked))
	$checked = '';
	
	$input  = '<input'.$checked.' type="'.$t.'" id="'.$n.'" name="'.$n.'" value="'.(($t == 'checkbox' && $n == 'status') ? '1' : $v).'"'; //  autocomplete="off"

	// if ($n == 'fupload'):
	// 	$input .= '  accept=".zip,.rar" ';
	// endif;

 //    if($n == 'fileupload')
 //        $input .= ' accept="image/*" ';


    if($t <> 'hidden')
    {
    	$input .= ' style="';
    	$input .= ($t == 'checkbox') ? 'background: transparent; border: 0; cursor: pointer; ' : '';
    	$input .= ($t == 'color') ? 'cursor: pointer; height: 27px; ' : '';
    	$input .= 'border: 1px solid; ';
    	$input .= 'box-sizing: border-box; ';
    	$input .= 'font-size: 13px; ';
    	$input .= 'letter-spacing: 1px; ';
    	$input .= 'margin: 0px 1px 1px; ';
//---------------------------------------------------------------------
//	IF THE INPUT IS SPECIFIED AS A FILE INPUT, REDUCE THE PADDING,
//	BUT, LEAVE THE PADDING FOR ALL THE OTHER FIELDS ALONE
//---------------------------------------------------------------------
    	$input .= ($t == 'file') ? 'cursor: pointer; padding: 3px; ' : 'padding: 5px; ';
//---------------------------------------------------------------------
    	$input .= 'width: '.$w.';';
    	$input .= '"';
    }
	$input .= ($m <> false) ? ' maxlength="'.$m.'"' : '';
	$input .= ($p <> false) ? ' placeholder="'.$p.'"' : '';
	$input .= ($r <> false) ? ' required' : '';
	$input .= ($c) ? ' class="'.$c.'"' : '';
	$input .= '/>';
	return $input;
}

function _input_numbers($n=null,$m=1,$t=100,$s=1,$v=null)
{
	$input  = '<input type="number" id="'.$n.'" name="'.$n.'" min="'.$m.'" max="'.$t.'" step="'.$s.'" value="'.$v.'"';
	$input .= ' style="';
	$input .= 'border: 1px solid; ';
	$input .= 'box-sizing: border-box; ';
	// $input .= 'height: 23px; ';
	$input .= 'font-size: 13px; ';
	$input .= 'letter-spacing: 1px; ';
	$input .= 'margin: 0px 1px 1px; ';
//---------------------------------------------------------------------
//	IF THE INPUT IS SPECIFIED AS A FILE INPUT, REDUCE THE PADDING,
//	BUT, LEAVE THE PADDING FOR ALL THE OTHER FIELDS ALONE
//---------------------------------------------------------------------
    $input .= ($t == 'file') ? 'cursor: pointer; padding: 4px; ' : 'padding: 5px; ';
//---------------------------------------------------------------------
	$input .= '"';
	$input .= ' />';
	return $input;
}

function _kill_the_function()
{
    global $lang_new, $module_name;
    CloseTable();
    echo '<span style="float: right;"><a'._ls().' class="copyright-popup" href="javascript:void(0);">'.$lang_new[$module_name]['COPYRIGHT'].'</a></span>';
    include_once(NUKE_BASE_DIR.'footer.php');
    die();
}

function _ls()
{
	return ' style="cursor: pointer; text-decoration: none;"';
}

function _module_themes()
{
	global $db, $module_name, $lang_new;
	static $themes;
    
	if(isset($themes) && is_array($themes))
		return $themes;
      
	$sql 	= "SELECT `cell`, `head`, `per_row`, `show_left`, `theme_name` FROM `"._FILE_REPOSITORY_THEMES."`";    
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) 
	{
		$themes[$row['theme_name']]['per_row']   	= $row['per_row'];
		$themes[$row['theme_name']]['show_left'] 	= $row['show_left'];
		$themes[$row['theme_name']]['cell'] 		= $row['cell'];
		$themes[$row['theme_name']]['head'] 		= $row['head'];
	}
 	$db->sql_freeresult($result);   
	return $themes;
}

function _mostpopular($hits) 
{
	global $lang_new, $module_name, $settings;
	if($hits >= $settings['pophits'])
		return '&nbsp;<span class="legend-images-sprite legend_popular" alt="'.$lang_new[$module_name]['HOT'].'" title="'.$lang_new[$module_name]['HOT'].'"></span>';	
}

function _redirect($redirect)
{
	if(function_exists('redirect'))
		redirect($redirect);
	else
		Header('Location:'.$redirect);
}

function _selectbox($n,$ops,$v,$r=false)
{
	global $lang_new, $module_name, $settings;
	$select  = '<select class="uppertext-style" id="'.$n.'" name="'.$n.'"';
	$select .= ' style="';
	$select .= 'border: 1px solid; ';
	$select .= 'cursor: pointer; ';
	$select .= 'font-size: 11px !important; ';
	$select .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
	$select .= 'letter-spacing: 1px; ';
	$select .= 'margin: 0px 1px 1px; ';
	$select .= (!defined('NUKE_EVO')) ? 'padding: 4px; ' : 'padding: 5px; ';
	$select .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';';
	$select .= '"'.(($r <> false) ? ' required' : '').'>';
	foreach($ops as $value => $option) {
		$select .= '<option value="'.$value.'"'.(($_GET['action'] == 'recruitment_apply') ? '' : (($v == $value) ? ' selected="selected"' : '')).'>'.$option.'</option>';
	}
	$select .= '</select>';
	return $select;
}

function _settings_variables()
{
	global $db, $module_name, $lang_new;
	static $settings;
	
   	if(isset($settings) && is_array($settings))
		return $settings;
	
	$result = $db->sql_query("SELECT `config_value`, `config_name` FROM `"._FILE_REPOSITORY_SETTINGS."`");
	while ($row = $db->sql_fetchrow($result))
		$settings[$row['config_name']] = $row['config_value'];
	$db->sql_freeresult($result);
   	return $settings;
}

function _submit($v,$class=false,$disabled=false)
{
	global $settings;
	$submit  = '<input'.(($disabled == true) ? ' disabled' : '').' type="submit" id="submit" name="submit" value="'.$v.'"';
	$submit .= ' style="';
	$submit .= 'font-size: 11px !important; ';
	$submit .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
	$submit .= 'height: 24px; ';
 	$submit .= 'letter-spacing: 1px; ';
 	$submit .= 'cursor: pointer; ';
 	$submit .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').'; ';
 	$submit .= 'padding-left: 5px; padding-right: 5px;';
	$submit .= '"';
	$submit .= ' class="mainoption uppertext-style'.(($class <> false) ? ' '.$class : '').'" />';
	return $submit;
}

function _suh($s,$f=false)
{
	global $settings;
	$uppertext  = '<span class="upperhead-style" style="';
	$uppertext .= 'text-transform: '.(($settings['uhead'] == 1) ? 'uppercase' : 'none').';';
	if($f <> false)
		$uppertext .= ' font-size: '.$f.'px';
	$uppertext .= '">'.$s.'</span>';
	return $uppertext;
}

function _sut($s,$f=false,$t=false)
{
	global $settings;
	$uppertext  = '<span class="uppertext-style" style="';
	$uppertext .= 'text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';';
	if($t <> false)
		$uppertext .= ' -webkit-transform: translateY(50%);';
	if($f <> false)
		$uppertext .= ' font-size: '.$f.'px';
	$uppertext .= '">'.$s.'</span>';
	return $uppertext;
}

function _tdcss($w=false,$a=false,$c=false,$cs=false,$dh=false,$rs=false)
{
	global $settings;
	$tablecss  = ' style="';
	$tablecss .= ($dh <> false) ? '' : 'height: 30px; ';
	$tablecss .= 'font-size: 11px !important; ';
	$tablecss .= 'font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; ';
	$tablecss .= 'letter-spacing: 1px; ';
	$tablecss .= 'padding-left: 5px; ';
	$tablecss .= 'padding-right: 5px; ';
	$tablecss .= ($w <> false) ? 'width: '.$w.'; ' : '';
	$tablecss .= ($a <> false) ? 'text-align: '.$a.'; ' : '';
    $tablecss .= 'overflow: hidden; text-overflow: ellipsis;';
	$tablecss .= '"';
	$tablecss .= ($cs <> false) ? ' colspan="'.$cs.'"' : '';
	$tablecss .= ($rs <> false) ? ' rowspan="'.$rs.'"' : '';
	$tablecss .= ($c <> false || $c <> '') ? ' class="'.$c.'"' : '';
	return $tablecss;
}

function _textarea($n,$v,$r=false)
{
	$textarea  = '<textarea name="'.$n.'" id="'.$n.'"';
	$textarea .= ' style="';
	$textarea .= 'border: 1px solid; ';
	$textarea .= 'box-sizing: border-box; ';
	$textarea .= 'cursor: auto; ';
	$textarea .= 'height: 250px; ';
	$textarea .= 'letter-spacing: 1px; ';
	$textarea .= 'min-height: 130px; ';
	$textarea .= 'padding: 5px; ';
	$textarea .= 'resize: vertical; ';
	$textarea .= 'width: 100%;';
	$textarea .= '"'.(($r <> false) ? ' required' : '').'>'.$v.'</textarea>';
	return $textarea;
}

function _timestamp($date,$format='M d, Y g:i a') 
{
	global $userinfo;
	$date = @date_create($date);
	return _sut(@date_format($date,$format));
}

function _user_is_within_group_name($gid,$isallowed=true) 
{
    global $db, $lang_new, $module_name;
	
    if($isallowed == 0)
    {
    	$groupname = '<span style="color: red;">'._sut($lang_new[$module_name]['UPLOAD_DISABLED']).'</span>';
    }
    else
    {
	    if ($gid == 0)
			$groupname = _sut($lang_new[$module_name]['ALL_VISITORS']);
		elseif ($gid == 1)
			$groupname = _sut($lang_new[$module_name]['REGISTERED']);
		elseif ($gid == 2)
			$groupname = _sut($lang_new[$module_name]['ADMINISTRATORS']);
		elseif ($gid > 2) 
		{
			$group_id = ($gid - 2);
			list($group_name) = $db->sql_fetchrow($db->sql_query("SELECT `group_name` FROM `"._GROUPS_TABLE."` WHERE `group_id`='$group_id'"));
			$groupname = ((!defined('NUKE_EVO')) ? _sut($group_name) : _sut(GroupColor($group_name)));
		}
	}
	return $groupname;
}

function _yesno($n,$v,$r=false)
{
	global $lang_new, $module_name;
	return _selectbox($n,array(1 => $lang_new[$module_name]['Y'], 0 => $lang_new[$module_name]['N']),$v,$r);
}

function _generate_rand_string()
{
	for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a[$x], $i++);
	return $s;
}

function _client_side_file_upload($type,$upload,$uploaddir,$index)
{
	global $db, $lang_new, $module_name, $settings;
	if (!empty($upload))
	{
		$file_extensions = $settings['allowed_file_extensions'];
		$image_extensions = $settings['allowed_image_extensions'];

		$file['name']   = $upload['name'][$index];
		$file['name']   = preg_replace('/\s*/m', '', $file['name']);
		$file['temp']   = $upload['tmp_name'][$index];
		$file['type']   = str_replace('"', '', $upload['type'][$index]);
		$file['type']   = str_replace("'", '', $file['type']);
		$file['error']  = $upload['error'][$index];
		$file['size']   = $upload['size'][$index];
		$file_parts     = @pathinfo($upload['name'][$index]);
        $file['ext']    = $file_parts['extension'];



        if($type == 'image'):
        	$file['desc']  = preg_replace('/\s*/m','',$_POST['userscreen_desc'][$index]);
        else:
			$file['desc']  = preg_replace('/\s*/m','',$_POST['userfile_desc'][$index]);
		endif;
		//$newfilename    = strtolower($file['cname']).'-'.$random_number.$file_extension;
	} else {
       	$error = 'upload not working.';
   	}
	
	if (is_uploaded_file($file['temp']) && $file['error'] == 0) 
	{
		if ($file['size'] <= 1)
		{
			$error = 2;
            $error_msg = 'File does not have a valid size.';
		} 
		else 
		{
			// if (!in_array($file['type'],array('application/x-zip-compressed', 'image/png','image/gif','image/jpeg','image/pjpeg')))
			// {
			// 	$error       = 3;
			// 	$error_msg = 'invalid filetype : '.$file['type'];
			// } 
			if ( $type == 'file' )
			{
				if (!in_array($file['ext'],explode(',',$file_extensions)))
				{
					
					$error       = 3;
					$error_msg .= 'invalid filetype : '.$file['ext'].explode(',',$file_extensions);
				}
				else
				{
					return;
				}
			}			
			elseif ( $type == 'image' )
			{
				if (!in_array($file['ext'],explode(',',$image_extensions)))
				{
					
					$error       = 3;
					$error_msg .= 'invalid imagetype : '.$file['ext'];
				}				
			}				
			else 
			{
				if($file['desc']):
					$file['name'] = strtolower($file['desc']).'-'._generate_rand_string().'.'.$file['ext'];
				else:
					$file['name'] = strtolower($file_parts['filename']).'-'._generate_rand_string().'.'.$file['ext'];
				endif;

				if (@move_uploaded_file($file['temp'], $uploaddir.$file['name']))
				{
					if (@chmod($uploaddir.$file['name'],0755))
					{
						$error     = 0;
						$error_msg .= '';
					} else {
						@unlink($upload['tmp_name']);
						$error     = 4;
						$error_msg .= 'CHMOD Error';
					}
				} 
				// else {
				// 	$error     = 5;
				// 	$error_msg = $lang_new[$module_name]['ERROR_IMAGEUPLOAD'];				
				// }
			}
		}
	}

	$file['upload']    = $uploaddir;
	$file['error']     = $error;
	$file['error_msg'] = $error_msg;
	return $file;
}

?>