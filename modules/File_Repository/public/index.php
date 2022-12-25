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

function _file_repository_index()
{
	global $db, $admin_file, $lang_new, $module_name, $settings, $themes, $admin, $user;
	OpenTable();
	echo '<br />';
	_index_navigation_header();
	$cid 			 = (isset($_GET['cid'])) ? $_GET['cid'] : 0;
	$count_downloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `cid` = '".$cid."' && `isbroken` = 0 && `isactive` = 1 && `isapproved` = 1 && `isbroken` = 0"));
//-------------------------------------------------------------------------------------
//	THIS IS THE DEFAULT PAGINATION CLASS THAT COMES WITH EVOLUTION XTREME.
//-------------------------------------------------------------------------------------
	$pagination = new Paginator(isset($_GET['page']),$count_downloads);
	$pagination->set_Limit($settings['most_popular']);
	$pagination->set_Links(3);
	$limit1 = $pagination->getRange1();
	$limit2 = $pagination->getRange2();
//-------------------------------------------------------------------------------------

	$result 	= $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='".$cid."' ORDER BY `cname`, `parentid` DESC");	
	if($db->sql_numrows($result) > 0)
	{
		echo '<br />';
		echo '<table style="white-space:nowrap; width: 100%; table-layout:fixed;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";	
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),3).'><a name="'.isset($_GET['cid']).'"></a>'._suh($lang_new[$module_name]['CATEGORY_LIST']).'</td>'."\n";
		echo '  </tr>'."\n";
		$count = 1;
		while($c = $db->sql_fetchrow($result))
		{
			$cat_downloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `cid`='".$c['cid']."' && `isactive` > 0 && `isbroken` = 0"));
			if ($count == 1) 
				echo '  <tr'._bgColor(1).'>'."\n";

			echo '    <td'._tdcss('33%',false,_sc(),false,true).' valign="top"></a>'."\n";
			echo '      <table style="white-space:nowrap; width: 100%;" border="0" cellpadding="1" cellspacing="1">'."\n";
			echo '        <tr>'."\n";
			echo '          <td colspan="2"><a'._ls().' href="modules.php?name='.$module_name.'&amp;cid='.$c['cid'].'#'.$c['cid'].'">'._colorization($c['cname'],$c['color']).'</a></td>'."\n";
			echo '          <td style="height: 30px; text-align: center; width: 10%;">'.$cat_downloads.'</td>'."\n";
			echo '        </tr>'."\n";
			$sresult = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='".$c['cid']."' ORDER BY `cname`");
			while($s = $db->sql_fetchrow($sresult))
			{
				$scat_downloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `cid`='".$s['cid']."' && `isactive` > 0 && `isbroken` = 0"));
				echo '  <tr>'."\n";
				echo '    <td style="text-align: center; width: 10%;"><span'.(($scat_downloads > 0) ? ' style="color: green;"' : '').'>&#8618;</span></td>'."\n";
				echo '    <td style="width: 80%;"><a'._ls().' href="modules.php?name='.$module_name.'&amp;cid='.$s['cid'].'#'.$s['cid'].'">'._colorization($s['cname'],$s['color']).'</a></td>'."\n";
				echo '    <td style="text-align: center; width: 10%;">'.$scat_downloads.'</td>'."\n";
				echo '  </tr>'."\n";
			}
			$db->sql_freeresult($sresult);
			echo '      </table>'."\n";
			echo '    </td>'."\n";	
			if ($count == 3) 
			{
				echo '  </tr>'."\n"; 
				$count = 0;
			}			
			$count++;
		}
		$db->sql_freeresult($result);
		if($count > 1)
		{
			if ($count == 2) 
			{
				echo '	  <td'._tdcss('33%','center',_sc(),2,true).'>&nbsp;</td>'."\n";
				echo '  </tr>'."\n";
			}
			elseif($count == 3)
			{
				echo '	  <td'._tdcss('33%','center',_sc(),false,true).'>&nbsp;</td>'."\n";
				echo '  </tr>'."\n";
			}
		}
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(false,'center',_sf(),3).'>&nbsp;</td>'."\n";
		echo '  </tr>'."\n";		
		echo '</table>'."\n";
	}

	$dresult = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isactive`='1' && `isbroken`='0' && `cid`='".$cid."' LIMIT ".$limit1.", ".$limit2);
	if($db->sql_numrows($dresult) > 0)
	{
		if(!isset($themes[get_theme()]['per_row']))
		$themes[get_theme()]['per_row'] = '';
		
		echo '<br />';
		echo '<a name="'.$cid.'"></a>';
		echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" style="white-space:nowrap; table-layout:fixed;">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";	
		echo '    <td'._tdcss(false,false,_sh(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._category_parents_name($cid).'</td>'."\n";
		echo '  </tr>'."\n";
		if($settings['download_view'] == 0)
		{
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['TITLE']).'</td>';
			echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['VIEWS']).'</td>';
			echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['DOWNLOADS']).'</td>';
			echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['FILE_SIZE']).'</td>';
			echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($lang_new[$module_name]['DATE_ADDED']).'</td>';
			echo '  </tr>'."\n";
			$items = 0;
			while($d = $db->sql_fetchrow($dresult))
			{
				$v 			= (($d['version']) ? sprintf($lang_new[$module_name]['V'],$d['version']) : '');
				$iteminfo 	= _collect_iteminfo($d['did']);
				$screen[$items] = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$d['did']."' ORDER BY RAND()"));
				echo '  <tr'._bgColor(1).'>'."\n";
				if($screen[$items]['filename'])
				{
					echo '    <td'._tdcss('5%','center',_sc()).'><div class="thumbnail_border"><a'.get_image_viewer('item-'.$d['did'], $screen[$items]['title']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img style="border: 1px solid white; height: 28px; width: 30px;" src="modules/'.$module_name.'/files/screenshots/'.$screen[$items]['filename'].'" border="0" /></a></div></td>';
					echo '    <td'._tdcss('45%',false,_sc()).'>';
					echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$d['did'].'#'.$d['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
					echo '    </td>';
				} else {
					echo '    <td'._tdcss(false,false,_sc(),2).'>';
					echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$d['did'].'#'.$d['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
					echo '    </td>';
				}
				echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['views'].'</td>';
				echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['hits'].'</td>';
				echo '    <td'._tdcss('10%','center',_sc()).'>'._sut($iteminfo['filesize']).'</td>';
				echo '    <td'._tdcss('20%','center',_sc()).'>'.$iteminfo['date'].'</td>';
				echo '  </tr>'."\n";
				$items++;
			}
			$db->sql_freeresult($dresult);
		} 
		else 
		{
			$items = 0;
			while($d = $db->sql_fetchrow($dresult))
			{
				$v 				= (($d['version']) ? sprintf($lang_new[$module_name]['V'],$d['version']) : '');
				$iteminfo 		= _collect_iteminfo($d['did']);
				$screen[$items] = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$d['did']."' ORDER BY RAND()"));
				$ustring 		= ($iteminfo['updated'] == '0000-00-00 00:00:00') ? _sut($lang_new[$module_name]['DATE_ADDED']) : _sut($lang_new[$module_name]['UPDATED']);
				if(isset($screen[$items]['filename']))
					$colspan = false;
				else 
					$colspan = 2;

				if($themes[get_theme()]['per_row'] == 3)
					$filePerRow = '33%';
				elseif($themes[get_theme()]['per_row'] == 2)
					$filePerRow = '50%';
				elseif($themes[get_theme()]['per_row'] == 1)
					$filePerRow = '100%';
				
				if(!isset($filePerRow))
				$filePerRow = '';
				
				if ($items == 0)
					echo '  <tr'._bgColor(1).'>'."\n";

				echo '    <td'._tdcss($filePerRow,false,_sc()).' valign="top">'."\n";
				echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
				echo '        <tr'._bgColor(1).'>'."\n";
				if(isset($screen[$items]['filename']))
				echo '          <td'._tdcss('10%','center',_sc()).'><div class="thumbnail_border"><a'.get_image_viewer('item-'.$d['did'], $screen[$items]['title']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img src="'._FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$screen[$items]['filename'].'" border="0" /></a></div></td>';
				echo '          <td'._tdcss('90%',false,_sc(),$colspan).' valign="top">';
				echo '            <table width="100%" border="0" cellpadding="4" cellspacing="1">'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>';
				echo '                  '._sut($lang_new[$module_name]['DOWNLOAD']).' : <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$d['did'].'#'.$d['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
				echo '                </td>'."\n";
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'._sut($lang_new[$module_name]['PERMISSIONS']).' : '.$iteminfo['whocan'].'</td>';
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'._sut($lang_new[$module_name]['FILE_VERSION']).' : '.(($iteminfo['version']) ? $iteminfo['version'] : $lang_new[$module_name]['NA']).'</td>';
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'.$ustring.' : '.$iteminfo['isupdated'].'</td>';
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'._sut($lang_new[$module_name]['DOWNLOADS']).' : '.$iteminfo['hits'].'</td>';
				echo '              </tr>'."\n";
				echo '            </table>'."\n";
				echo '          </td>';
				echo '        </tr>';
				echo '      </table>'."\n";
				echo '    </td>';
				$items++;
				if ($items == $themes[get_theme()]['per_row']) 
				{ 
					echo '  </tr>'."\n";
					$items = 0; 
				}
			}
			if ($items == 1) 
			{
				echo '    <td'._tdcss($filePerRow,false,_sc(),(($themes[get_theme()]['per_row'] == 3) ? '2' : false)).'>&nbsp;</td>'."\n";
				echo '  </tr>'."\n";
			}
  			elseif ($items > 1) 
			{
				echo '    <td'._tdcss($filePerRow,false,_sc()).'>&nbsp;</td>'."\n";
				echo '  </tr>'."\n";
			}
		}
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'right',_sf(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'."\n";
		if($count_downloads > $settings['most_popular'])
		{
			if ($pagination->getCurrent() == 1)
				$first = ' | '.$lang_new[$module_name]['FIRST'].' | ';
			else
				$first = ' | <a href="modules.php?name='.$module_name.'&amp;cid='.$cid.'&amp;page='.$pagination->getFirst().'">'.$lang_new[$module_name]['FIRST'].'</a> |';
				
			if ($pagination->getPrevious())
				$prev = '<a href="modules.php?name='.$module_name.'&amp;cid='.$cid.'&amp;page='.$pagination->getPrevious().'">'.$lang_new[$module_name]['PREV'].'</a> | ';
			else
				$prev = $lang_new[$module_name]['PREV'].' | ';
				
			if ($pagination->getNext())
				$next = '<a href="modules.php?name='.$module_name.'&amp;cid='.$cid.'&amp;page='.$pagination->getNext().'">'.$lang_new[$module_name]['NEXT'].'</a> | ';
			else
				$next = $lang_new[$module_name]['NEXT'].' | ';
				
			if ($pagination->getLast())
				$last = '<a href="modules.php?name='.$module_name.'&amp;cid='.$cid.'&amp;page='.$pagination->getLast().'">'.$lang_new[$module_name]['LAST'].'</a>';
			else
				$last = $lang_new[$module_name]['LAST'];
				
			echo $pagination->getFirstOf().' to '.$pagination->getSecondOf().' of '.$pagination->getTotalItems().' '.$first." ".$prev." ".$next." ".$last;
		} else {
			echo '&nbsp;';
		}
		echo '    </td>'."\n";
		echo '  </tr>'."\n";
		echo '</table>'."\n";
	}
	echo '<br />';
	CloseTable();
}

if(!isset($action))
$action = 'I left you farbehind';

switch($action)
{
	case 'comments':
	case 'savecomment':
		include_once(_FILE_REPOSITORY_PUBLIC.'comments.php');
		break;

	case 'copyright':
		// die('hello it worked');
		_grab_copyright_data();
		break;

	case 'gogetit':
	case 'view':
	case 'viewfiles':
		include_once(_FILE_REPOSITORY_PUBLIC.'view.php');
		break;

	case 'mostpopular':
		include_once(_FILE_REPOSITORY_PUBLIC.'popular.php');
		break;

	case 'newdownloads':
	case 'newdownloadsdate':
		include_once(_FILE_REPOSITORY_PUBLIC.'newdownloads.php');
		break;

	case 'search':
		include_once(_FILE_REPOSITORY_PUBLIC.'search.php');
		break;

	case 'statistics':
		include_once(_FILE_REPOSITORY_PUBLIC.'statistics.php');
		break;

	case 'submitdownload':
	case 'submitdownload_save':
	case 'submitdownload_success':
		include_once(_FILE_REPOSITORY_PUBLIC.'submit.php');
		break;

	default:
		_file_repository_index();
		break;
}

?>