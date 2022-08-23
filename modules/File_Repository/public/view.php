<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|----------------------------------------------------------------------
*/

function _view_downloadinfo()
{
	global $db, $admin_file, $lang_new, $module_name, $settings, $admin, $user, $userinfo;
	OpenTable();
	_index_navigation_header();
//------------------------------------------------------------------------------------------------
//	COLLECT THE ITEM INFORMATION
//------------------------------------------------------------------------------------------------
	$did 		= _escape_string($_GET['did']);
	$iteminfo 	= _collect_iteminfo($did);
//------------------------------------------------------------------------------------------------

	if($iteminfo['isactive'] == 0)
	{
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut($lang_new[$module_name]['NOT_ACTIVE']).'</td>'."\n";
		echo '  </tr>'."\n".'<tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>&nbsp;</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}
	elseif (_check_users_permissions($iteminfo['groups']) == true) 
	{
//------------------------------------------------------------------------------------------------
//	UPDATE THE ITEM VIEW COUNTER / WILL NOT UPDATE IF YOU ARE THE AUTHOR
//------------------------------------------------------------------------------------------------
		$db->sql_query('UPDATE `'._FILE_REPOSITORY_ITEMS.'` SET `views` = `views` + 1 WHERE `did`="'.$did.'" && `sname`!="'.$userinfo['user_id'].'"');
//------------------------------------------------------------------------------------------------
		$screenshots 	= _grab_the_items_screenshots($_GET['did']);
		$colspan		= (($screenshots['count'] == 0) ? '2' : '3');
		$width 			= (($screenshots['count'] == 0) ? '50%' : '40%');
		$ustring 		= ($iteminfo['updated'] == '0000-00-00 00:00:00') ? _sut($lang_new[$module_name]['DATE_ADDED']) : _sut($lang_new[$module_name]['UPDATED']);
		$adminBypass 	= ($settings['adminBypass'] == true && is_admin($admin)) ? false : true;
		echo '<br />';
		echo '<form action="modules.php?name='.$module_name.'&amp;action='.(($iteminfo['filecount'] > 1) ? 'viewfiles&amp;did='.$did : 'gogetit&amp;fid='.$iteminfo['fid']).'" method="POST">'."\n";
		echo '<a name="'.$did.'"></a>';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,false,_sh(),$colspan).'>'."\n";
		echo '      <span style="float: left;">'._category_parents_name($iteminfo['cid'],$iteminfo['title'],$did,$iteminfo['version'],$iteminfo['color']).((is_admin($admin)) ? '&nbsp;( <a'._ls().' href="'.$admin_file.'.php?op=file_repository&amp;action=editfile&amp;did='.$did.'">'._suh($lang_new[$module_name]['MODIFY_ITEM']).'</a> )' : '').'</span>'."\n";
		if($iteminfo['preview'])
		echo '      <span style="float: right;"><a'._ls().' href="'.$iteminfo['preview'].'" target="_blank">'._suh($lang_new[$module_name]['PREVIEW']).'</a></span>'."\n";
		echo '    </td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		if($screenshots['count'])
		echo '    <td'._tdcss('20%','center',_sc(),false,false,5).' valign="top">'.$screenshots['carousel'].'</td>'."\n";
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['AUTHOR']).'&nbsp;:&nbsp;'.$iteminfo['author_www'].'</td>'."\n";
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['AUTHOR_EMAIL']).'&nbsp;:&nbsp;'.((!$iteminfo['author_email']) ? $lang_new[$module_name]['NA'] : $iteminfo['author_email']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['FILE_SIZE']).'&nbsp;:&nbsp;'.$iteminfo['filesize'].'</td>'."\n";
		echo '    <td'._tdcss($width,false,_sc()).'>'.$ustring.'&nbsp;:&nbsp;'.$iteminfo['isupdated'].'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['VIEWS']).'&nbsp;:&nbsp;'.$iteminfo['views'].'</td>'."\n";
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['DOWNLOADS']).'&nbsp;:&nbsp;'.$iteminfo['hits'].'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['POSTS_NEEDED']).'&nbsp;:&nbsp;'.$iteminfo['posts'].'</td>'."\n";
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['WHOCAN']).'&nbsp;:&nbsp;'.$iteminfo['whocan'].'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['FILE_VERSION']).'&nbsp;:&nbsp;'.(($iteminfo['version']) ? $iteminfo['version'] : $lang_new[$module_name]['NA']).'</td>'."\n";
		echo '    <td'._tdcss($width,false,_sc()).'>'._sut($lang_new[$module_name]['RATINGS']).'&nbsp;:&nbsp;'._average_rating($did) .'&nbsp;<a href="modules.php?name='.$module_name.'&amp;action=comments&amp;did='.$did.'"><span class="dm-sprite rate-button"></span></a></td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		if($iteminfo['fixes'] && $settings['developer_mode'] == true)
		{
			echo '    <td'._tdcss(false,false,_sh(),1).'><span class="toggle-description" style="cursor: pointer; text-decoration: underline">'._suh($lang_new[$module_name]['DESCRIPTION']).'</span></td>'."\n";
			echo '    <td'._tdcss(false,false,_sh(),(($screenshots['count'] == 0) ? 1 : 2)).'><span class="toggle-fixes" style="cursor: pointer;">'._suh($lang_new[$module_name]['FIXES']).'</span></td>'."\n";
		} else {
			echo '    <td'._tdcss(false,false,_sh(),$colspan).'>'._suh($lang_new[$module_name]['DESCRIPTION']).'</td>'."\n";
		}
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).' class="item-description">'."\n";	
		echo '    <td'._tdcss(false,false,_sc(),$colspan).'>'.(($iteminfo['description']) ? _decode_bbcode_text(stripslashes($iteminfo['description']),$settings['parse_smilies']) : $lang_new[$module_name]['DESCRIPTION_NONE']).'</td>'."\n";
		echo '  </tr>'."\n";
		if($iteminfo['fixes'] && $settings['developer_mode'] == true)
		{
			echo '  <tr'._bgColor(1).' class="item-fixes" style="display: none;">'."\n";	
			echo '    <td'._tdcss(false,false,_sc(),$colspan).'>'.(($iteminfo['fixes']) ? _decode_bbcode_text(stripslashes($iteminfo['fixes']),$settings['parse_smilies']) : $lang_new[$module_name]['DESCRIPTION_NONE']).'</td>'."\n";
			echo '  </tr>'."\n";
		}
//---------------------------------------------------------------------
		if($userinfo['user_posts'] <= $iteminfo['posts'] && $iteminfo['posts'] <> 0)
		{
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
			echo '  </tr>'."\n";
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),3).'>'.sprintf($lang_new[$module_name]['POSTS_REQUIRED'],$userinfo['user_posts'],$iteminfo['posts']).'</td>'."\n";
			echo '  </tr>'."\n";
		}
		elseif(_check_users_permissions($iteminfo['groups']) == false || $settings['usegfxcheck'] == true && $adminBypass && get_evo_option('recap_site_key') && get_evo_option('recap_priv_key'))
		{
			echo '  <tr'._bgColor(2).'>'."\n";	
			echo '    <td'._tdcss(false,'center',_sh(),$colspan).'>'._sut(sprintf($lang_new[$module_name]['DOWNLOAD_ITEM'],$iteminfo['title_colored'])).'</td>'."\n";
			echo '  </tr>'."\n";
			if(_check_users_permissions($iteminfo['groups']) == true && $settings['usegfxcheck'] == true)
			{
				echo '  <tr'._bgColor(1).'>'."\n";	
				echo '    <td'._tdcss(false,'right',_sc(),1).'>'._sut($lang_new[$module_name]['SECURITY_CODE']).'</td>'."\n";

				if (!defined('NUKE_EVO'))
				{
					echo '    <td'._tdcss(false,false,_sc(),(($screenshots['count'] == 0) ? 1 : 2)).'><img style="border: 1px solid black;" src="images/captcha.php?size=small&file='.$settings['captcha'].'" border="0" alt="" /></td>'."\n";
					echo '  </tr>'."\n";
					echo '  <tr'._bgColor(1).'>'."\n";	
					echo '    <td'._tdcss(false,'right',_sc(),1).'>'._sut($lang_new[$module_name]['SECURITY_TYPE']).'</td>'."\n";
					echo '    <td'._tdcss(false,false,_sc(),(($screenshots['count'] == 0) ? 1 : 2)).'>'._input('text','gfx_check','100px','',false,false,true).'</td>'."\n";
				}
				else
				{
					echo '    <td'._tdcss(false,false,_sc(),(($screenshots['count'] == 0) ? 1 : 2)).'>'.security_code(array(2,4,5,7), 'normal', 1, 'force').'</td>'."\n";
				}
			} 
			else 
			{
				echo '  <tr'._bgColor(1).'>'."\n";	
				echo '    <td'._tdcss(false,'center',_sc(),$colspan).'>'._sut(sprintf($lang_new[$module_name]['RESTRICTED'],$iteminfo['whocan'])).'</td>'."\n";
				echo '  </tr>'."\n";
			}
		}
//---------------------------------------------------------------------
		echo '  <tr'._bgColor(2).'>'."\n";
		if($iteminfo['groups'] == 0 && _check_users_permissions($iteminfo['groups']) == true && $iteminfo['posts'] == 0)
		{
			$submitButton = _submit(sprintf($lang_new[$module_name]['DOWNLOAD_ITEM'],$iteminfo['title']));
		}
		elseif($iteminfo['groups'] > 0 && _check_users_permissions($iteminfo['groups']) == true && $userinfo['user_posts'] >= $iteminfo['posts'])
		{
			$submitButton = _submit(sprintf($lang_new[$module_name]['DOWNLOAD_ITEM'],$iteminfo['title']));
		}
		else
		{
			$submitButton = '';
		}
		echo '    <td'._tdcss(false,'center',_sf(),$colspan).'>'.$submitButton.'</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
		echo _input('hidden','did',false,$did);
		echo '</form>'."\n";
		if($iteminfo['comments'] > 0)
		{
			CloseTable();
			echo '<br />';
			OpenTable();
			echo '<br />';
			echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n"; 
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sh(),2).'>'._sut(sprintf($lang_new[$module_name]['COMMENT_FOR'],$iteminfo['title_colored'])).'</td>'."\n";
			echo '  </tr>'."\n";
			$sql = "SELECT * FROM `"._FILE_REPOSITORY_COMMENTS."` WHERE `did`='".$iteminfo['did']."' ORDER BY `cid` DESC";
			$result = $db->sql_query($sql);
			while($c = $db->sql_fetchrow($result))
			{
				echo '  <tr'._bgColor(1).'>'."\n";
				echo '    <td'._tdcss('20%','center',_sc()).'>';
				echo '      <table width="100%" border="0" cellpadding="2" cellspacing="0" class="forumline">'."\n";
				echo '        <tr'._bgColor(1).'>'."\n";
				echo '          <td'._tdcss(false,'right',false,false,true).'>'.((function_exists('UsernameColor')) ? UsernameColor($c['user']) : $c['user']).'</td>';
				echo '        </tr>'."\n";
				echo '        <tr'._bgColor(1).'>'."\n";
				echo '          <td'._tdcss(false,'right',false,false,true).'>'._timestamp($c['date'],$settings['date_format']).'</td>';
				echo '        </tr>'."\n";
				echo '        <tr'._bgColor(1).'>'."\n";
				echo '          <td'._tdcss(false,'right',false,false,true).'>'._sut($lang_new[$module_name]['RATING']).'&nbsp;:&nbsp;'.$c['rating'].'</td>';
				echo '        </tr>'."\n";
				echo '      </table>'."\n";
				echo '    </td>'."\n";
				echo '    <td'._tdcss('80%',false,_sc()).' valign="top">'.$c['comment'].'</td>'."\n";
				echo '  </tr>'."\n";
			}
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sf(),2).'>&nbsp;</td>'."\n";
			echo '  </tr>'."\n";
			echo '</table>'."\n";
		}
	} 
	elseif($iteminfo['isbroken'] == true)
	{
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut($lang_new[$module_name]['ERROR_DOWNLOAD_MISSING']).'</td>'."\n";
		echo '  </tr>'."\n".'<tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>&nbsp;</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}
	else 
	{
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n".'<tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut(sprintf($lang_new[$module_name]['RESTRICTED'],$iteminfo['whocan'])).'</td>'."\n";
		echo '  </tr>'."\n".'<tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>&nbsp;</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}
	CloseTable();
}

function _view_the_mutiple_files()
{
	global $db, $lang_new, $module_name, $settings, $admin;
	$did = _escape_string($_GET['did']);
	$iteminfo 	 = _collect_iteminfo($did);
	$gfxcheck 	 = (!defined('NUKE_EVO')) ? security_code_check($_POST['gfx_check'],array(2,4,5,7)) : security_code_check($_POST['g-recaptcha-response'],array(0,1,2,3,4,5,6,7));
	$adminBypass = ($settings['adminBypass'] == true && is_admin($admin)) ? false : true;
	OpenTable();
	_index_navigation_header();
	if (!$gfxcheck && _check_users_permissions($iteminfo['groups']) == true && $settings['usegfxcheck'] == true && $adminBypass) 
	{		
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n"; //  style="table-layout: fixed;"
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss(false,'center',_sc(),3).'>'.$lang_new[$module_name]['NOMATCH'].'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>[ <a'._ls().' href="modules.php?name=File_Repository&action=view&did='.$iteminfo['did'].'">'.$lang_new[$module_name]['GOBACK'].'</a> ]</td>'."\n"; // '._submit($lang_new[$module_name]['DOWNLOAD']).'
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}
	else
	{
		// setcookie("ea1", '1', time()+60*2, '/', false);
		setcookie('gfx_code-'.$did,1,time()+24*60*60,'/',false);
		// setcookie('gfx_code','',time()+($time*(60 * 2)));
		// setcookie('gfx_code-'.$did, 'data', time()+60*2, "/", "", "", TRUE);

		$sql 	= "SELECT * FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$did."'";
		$result = $db->sql_query($sql);
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,false,_sh(),3).'>'._category_parents_name($iteminfo['cid'],$iteminfo['title'],$did,$iteminfo['version'],$iteminfo['color']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>';
		echo '    <td'._tdcss('70%',false,_sh()).'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>';
		echo '    <td'._tdcss('15%','center',_sh()).'>'._sut($lang_new[$module_name]['FILE_SIZE']).'</td>';
		echo '    <td'._tdcss('15%','center',_sh()).'>'._sut($lang_new[$module_name]['DOWNLOAD']).'</td>';
		echo '  </tr>';
		while( $f = $db->sql_fetchrow($result) )
		{
			echo '  <tr'._bgColor(1).'>';
			echo '    <td'._tdcss('70%',false,_sc()).'>'.$f['ftitle'].'</td>';
			echo '    <td'._tdcss('15%','center',_sc()).'>'._convertsize($f['filesize']).'</td>';
			echo '    <td'._tdcss('15%','center',_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=gogetit&amp;fid='.$f['fid'].'">Download</a></td>';
			echo '  </tr>';			
		}
		$db->sql_freeresult($result);
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>[ <a'._ls().' href="modules.php?name='.$module_name.'&action=view&did='.$iteminfo['did'].'">'.$lang_new[$module_name]['GOBACK'].'</a> ]</td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}	
	CloseTable();
}

function _retrieve_files()
{
	global $db, $lang_new, $module_name, $settings, $do_gzip_compress, $admin;
	$fid 		= _escape_string($_GET['fid']);
	$iteminfo 	= _collect_iteminfo($fid,true);
	// $gfxcheck 	= (!defined('NUKE_EVO')) ? security_code_check($_POST['gfx_check'],array(2,4,5,7)) : security_code_check($_POST['g-recaptcha-response'],array(2,4,5,7));
	$adminBypass = ($settings['adminBypass'] == true && is_admin($admin)) ? false : true;

	if (!security_code_check($_POST['g-recaptcha-response'],array(0,1,2,3,4,5,6,7)) && _check_users_permissions($iteminfo['groups']) == true && $settings['usegfxcheck'] == true && !isset($_COOKIE['gfx_code-'.$iteminfo['did']]) && $adminBypass && get_evo_option('recap_site_key') && get_evo_option('recap_priv_key'))
	{
		OpenTable();
		_index_navigation_header();
		echo '<br />';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";	
		echo '    <td'._tdcss(false,'center',_sc(),3).'>'.$lang_new[$module_name]['NOMATCH'].' - '.security_code_check($_POST['g-recaptcha-response'],array(0,1,2,3,4,5,6,7)).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sf(),3).'>[ <a'._ls().' href="modules.php?name=File_Repository&action=view&did='.$iteminfo['did'].'">'.$lang_new[$module_name]['GOBACK'].'</a> ]</td>'."\n"; // '._submit($lang_new[$module_name]['DOWNLOAD']).'
		echo '  </tr>'."\n";
		echo '</table>'."\n";
		CloseTable();
	}
	else
	{
		if($iteminfo['filename'] && file_exists(_FILE_REPOSITORY_DIR.$iteminfo['filename']))
		{
			if(_check_users_permissions($iteminfo['groups']) == true)
			{
				# UPDATE THE ITEMS TOTAL HITS
				$db->sql_query("UPDATE `"._FILE_REPOSITORY_ITEMS."` SET `hits` = `hits`+1, `lastdownloaded` = now() WHERE `did`=".$iteminfo['did']);
				$cType = (preg_match('#Opera(/| )([0-9].[0-9]{1,2})#i', getenv('HTTP_USER_AGENT'))) ? 'application/octetstream' : 'application/octet-stream';
				if ($do_gzip_compress = TRUE)
				{
					while (ob_end_clean());
					header('Content-Encoding: none');
				}	
				header('Pragma: public');
				header('Content-type: '.$cType.'; name='.$iteminfo['filename']);
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Cache-Control: private',false);
				header('Content-length: '.$iteminfo['size']);
				header('Content-Disposition: inline; filename='.$iteminfo['filename']);
				@readfile(_FILE_REPOSITORY_DIR.$iteminfo['filename']);
				exit;
			} 
			else 
			{
				OpenTable();
				_index_navigation_header();
				echo '<br />';
				echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
				echo '  <tr'._bgColor(2).'>'."\n";
				echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
				echo '  </tr>'."\n";
				echo '  <tr'._bgColor(1).'>'."\n";	
				echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut(sprintf($lang_new[$module_name]['RESTRICTED'],$iteminfo['whocan'])).'</td>'."\n";
				echo '  </tr>'."\n";
				echo '  <tr'._bgColor(2).'>'."\n";
				echo '    <td'._tdcss(false,'center',_sf(),3).'>&nbsp;</td>'."\n";
				echo '  </tr>'."\n";
				echo '</table>'."\n";
				CloseTable();
			}
		}
		else
		{
			# IF THE FILENAME DOES NOT EXIST, REPORT THE DOWNLOAD AS BROKEN.
			OpenTable();
			_index_navigation_header();
			if($_GET['fid']):
				$file = $db->sql_ufetchrow("SELECT `did` FROM `"._FILE_REPOSITORY_FILES."` WHERE `fid`='".$_GET['fid']."' LIMIT 1");
				$_POST['did'] = ($_POST['did']) ? $_POST['did'] : $file['did'];
			endif;			
			$db->sql_query("UPDATE `"._FILE_REPOSITORY_ITEMS."` SET `isbroken` = 1, `isactive` = 0 WHERE `did`=".$_POST['did']);
			echo '<br />';
			echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="table-layout: fixed;">'."\n";
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sh(),3).'>'._suh($lang_new[$module_name]['ERROR']).'</td>'."\n";
			echo '  </tr>'."\n";
			echo '  <tr'._bgColor(1).'>'."\n";	
			echo '    <td'._tdcss(false,'center',_sc(),3).'>'._sut($lang_new[$module_name]['ERROR_DOWNLOADING']).'</td>'."\n";
			echo '  </tr>'."\n";
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sf(),3).'>[ <a'._ls().' href="modules.php?name='.$module_name.'">'._sut($lang_new[$module_name]['GOBACK']).'</a> ]</td>'."\n";
			echo '  </tr>'."\n";
			echo '</table>'."\n";
			CloseTable();
		}
	}
}

switch($action)
{
	case 'gogetit':
		_retrieve_files();
		break;
		
	case 'viewfiles':
		_view_the_mutiple_files();
		break;

	default:
		_view_downloadinfo(); 
		break;
}

?>