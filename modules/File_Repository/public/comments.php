<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|----------------------------------------------------------------------
*/

if (!defined('MODULE_FILE')) 
	die("You can't access this file directly...");

function _file_repository_comments()
{
	global $db, $admin_file, $lang_new, $module_name, $settings, $themes, $userinfo, $admin, $user;
	OpenTable();
	_index_navigation_header();
	$did 		= _escape_string($_GET['did']);
	$iteminfo 	= _collect_iteminfo($did);

	$sql 	= "SELECT * FROM `"._FILE_REPOSITORY_COMMENTS."` WHERE `did` = '".$did."' AND `uid` = '".$userinfo['user_id']."'";
	$result = $db->sql_query($sql);
	$count 	= $db->sql_numrows($result);

	if (_check_users_permissions($iteminfo['groups']) == true && is_user($user))
	{
		echo '<br />';
		echo '<form action="modules.php?name='.$module_name.'&amp;action=savecomment" method="post">'."\n";
		echo _input('hidden','did',FALSE,$did);
		echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh(sprintf($lang_new[$module_name]['COMMENT_ON'],$iteminfo['title_colored'])).'</td>'."\n";
		echo '  </tr>'."\n";
		if($count <> 1)
		{
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss('50%','right',_sc()).'>'._sut('Rate this Download').'</td>'."\n";
			echo '    <td'._tdcss('50%',false,_sc()).'>'._selectbox('rating',array(''=>$lang_new[$module_name]['RATE'],'1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),'',true).'</td>'."\n";
			echo '  </tr>'."\n";
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),2).'>'._textarea('comment','',true).'</td>'."\n";
			echo '  </tr>'."\n";
			echo '  <tr'._bgColor(1).'>'."\n";	
			echo '    <td'._tdcss('50%','right',_sc()).'>'._sut($lang_new[$module_name]['SECURITY_CODE']).'</td>'."\n";
			echo '    <td'._tdcss('50%',false,_sc(),(($screenshots['count'] == 0) ? 1 : 2)).'>'."\n";
		 	echo (!defined('NUKE_EVO')) ? '<img style="border: 1px solid black;" src="images/captcha.php?size=small&file='.$settings['captcha'].'" border="0" alt="" />' : security_code(array(2,4,5,7), 'normal', '0.95')."\n";
			echo '</td>'."\n";
			echo '  </tr>'."\n";
			if (!defined('NUKE_EVO')) {
				echo '  <tr'._bgColor(1).'>'."\n";	
				echo '    <td'._tdcss('50%','right',_sc()).'>'._sut($lang_new[$module_name]['SECURITY_TYPE']).'</td>'."\n";
				echo '    <td'._tdcss('50%',false,_sc(),(($screenshots['count'] == 0) ? 1 : 2)).'>'._input('text','gfx_check','100px','',false,false,true).'</td>'."\n";
				echo '  </tr>'."\n";
			}
		}
		else
		{
			echo '  <tr'._bgColor(1).'>'."\n";	
			echo '    <td'._tdcss(false,'center',_sc(),2).'>'._sut($lang_new[$module_name]['RATING_ONCE']).'</td>'."\n";
			echo '  </tr>'."\n";
		}
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),2).'>'.(($count == 1) ? '[ <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$did.'">'._sut($lang_new[$module_name]['GOBACK']).'</a> ]' : _submit($lang_new[$module_name]['SAVE'])).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
		echo '</form>'."\n";
	}
	else
	{
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n";
		if(is_user($user))
		{
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut(sprintf($lang_new[$module_name]['RESTRICTED'],$iteminfo['whocan'])).'</td>'."\n";
			echo '  </tr>'."\n";
		}
		else
		{	
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut($lang_new[$module_name]['RESTRICTED_REGISTERED']).'</td>'."\n";
			echo '  </tr>'."\n";			
		}
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>[ <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$did.'">'._sut($lang_new[$module_name]['GOBACK']).'</a> ]</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}
	CloseTable();
}

function _file_repository_save_my_comment()
{
	global $db, $admin_file, $lang_new, $module_name, $settings, $themes, $userinfo, $admin, $user, $tnsl_bUseShortLinks;
	$comment  	= (!empty($_POST['comment'])) ? _escape_string($_POST['comment']) : '';
	$did      	= (!empty($_POST['did'])) ? intval($_POST['did']) : '';
	$iteminfo 	= _collect_iteminfo($did);
	$rating   	= (!empty($_POST['rating'])) ? intval($_POST['rating']) : '0';
	$gfxcheck 	= (!defined('NUKE_EVO')) ? security_code_check($_POST['gfx_check'],array(2,4,5,7)) : security_code_check($_POST['g-recaptcha-response'], array(2,4,5,7));
	if (!$gfxcheck && _check_users_permissions($iteminfo['groups']) == true && $settings['usegfxcheck'] == true) 
	{
		OpenTable();
		_index_navigation_header();
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n"; //  style="table-layout: fixed;"
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss(false,'center',_sc(),3).'>'.$lang_new[$module_name]['NOMATCH'].'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>[ <a href="modules.php?name='.$module_name.'&amp;action=comments&amp;did='.$did.'">'.$lang_new[$module_name]['GOBACK'].'</a> ]</td>'."\n"; // '._submit($lang_new[$module_name]['DOWNLOAD']).'
		echo '  </tr>'."\n";
		echo '</table>'."\n";
		CloseTable();
	}
	else
	{
		$sql = "INSERT INTO `"._FILE_REPOSITORY_COMMENTS."` (`cid`, `did`, `comment`, `date`, `rating`, `uid`, `user`) VALUES (NULL, '".$did."', '".$comment."', now(), '".$rating."', '".$userinfo['user_id']."', '".$userinfo['username']."')";
		$db->sql_query($sql);
		if($tnsl_bUseShortLinks == true)
		{
			_redirect('file-repository-item-'.$did.'.html');
		}
		else
		{
			_redirect('modules.php?name='.$module_name.'&action=view&did='.$did);
		}
	}
}

switch($action)
{
	case 'savecomment':
		_file_repository_save_my_comment();
		break;

	default:
		_file_repository_comments();
		break;
}

?>