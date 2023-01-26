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

function _file_repository_categories()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	$result = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."`");
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),5).'>'._suh($lang_new[$module_name]['CATEGORY_LIST']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['CATEGORY_NAME']).'</td>'."\n";	
	echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['FILES']).'</td>'."\n";							
	echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['CATEGORY_UPLOADS']).'</td>'."\n";
	echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($lang_new[$module_name]['UPLOAD_PERMISSIONS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).(($db->sql_numrows($result) == 0 ) ? '' : ' style="display:none;"').'>';
	echo '    <td'._tdcss(FALSE,'center',_sc(),5).'>'._sut($lang_new[$module_name]['CATEGORY_NONE']).'</td>';
	echo '  </tr>';
	echo _categories_from_database(0);
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sf(),5).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
}

function _file_repository_add_category()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `cid`='".isset($_GET['cid'])."'"));
	echo '<form action="'.$admin_file.'.php?op=file_repository&action=savecat" method="post">'."\n";
//---------------------------------------------------------------------
//	HIDDEN FIELD USED FOR UPDATING CATEGORY VARIABLES
//---------------------------------------------------------------------
	echo '<input type="hidden" name="cid" value="'.isset($row['cid']).'" />';
//---------------------------------------------------------------------
//	HIDDEN FIELD USED FOR UPDATING CATEGORY VARIABLES
//---------------------------------------------------------------------
    if (!isset($row['parentid'])) $row['parentid'] = 0;
    if (!isset($row['cname'])) $row['cname'] = 'Not Set';
    if (!isset($row['color'])) $row['color'] = 'Not Set';
    if (!isset($row['isallowed'])) $row['isallowed'] = '';
    if (!isset($row['permissions'])) $row['permissions'] = '';

	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),2).'>'._suh($lang_new[$module_name]['CATEGORY_ADD']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).(($row['parentid'] == 0 && $_GET['action'] <> 'newcat') ? ' style="display:none;"' : '').'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['CATEGORY_PARENT']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._category_parents('parent',$row['parentid']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['CATEGORY_NAME']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','title','250px',$row['cname']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['CATEGORY_COLOR']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','colorize','100px',$row['color']).'&nbsp;<span class="color_title" style="color:'.$row['color'].';">'.$row['cname'].'</span></td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['CATEGORY_ALLOWED']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._selectbox('isallowed',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$row['isallowed']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['CATEGORY_WHOADD']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._list_available_permission_groups('permissions',$row['permissions']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sf(),2).'>'._submit($lang_new[$module_name]['SAVE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo '</form>'."\n";
}

function _file_repository_save_category()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;	
	$active            	= (!empty($_POST['active'])) ? intval($_POST['active']) : 0;
	$cid              	= (!empty($_POST['cid'])) ? intval($_POST['cid']) : '';
	$permissions		= (!empty($_POST['permissions'])) ? intval($_POST['permissions']) : 0;
	$cname             	= (!empty($_POST['title'])) ? _escape_string($_POST['title']) : '';
	$color             	= (!empty($_POST['colorize'])) ? $_POST['colorize'] : '';
	$parentid          	= (!empty($_POST['parent'])) ? $_POST['parent'] : 0;
	$isallowed    		= (!empty($_POST['isallowed'])) ? intval($_POST['isallowed']) : 0;
	if($cid)
		$db->sql_query("UPDATE `"._FILE_REPOSITORY_CATEGORIES."` SET `cname`='$cname', `color`='$color', `permissions`='$permissions', `isallowed`='$isallowed' WHERE `cid`='$cid'");
	else		
		$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_CATEGORIES."` (`cid`, `cname`, `color`, `parentid`, `permissions`, `isallowed`) VALUES (NULL, '$cname', '$color', '$parentid', '$permissions', '$isallowed')");		
	_redirect($admin_file.'.php?op=file_repository&action=categories');
}

switch($_GET['action'])
{
	case 'newcat':
	case 'editcat':
		_file_repository_add_category();
		break;

	case 'deletecat':
		_category_deletion($_GET['cid']);
		_redirect($admin_file.'.php?op='._MODNAME.'&action=categories');
		break;

	case 'savecat':
		_file_repository_save_category();
		break;

	default:
		_file_repository_categories();
		break;
}

?>