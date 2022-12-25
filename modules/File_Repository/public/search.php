<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|----------------------------------------------------------------------
*/

if (!defined('IN_FILE_REPOSITORY'))
	die('Access Denied');

function _query_the_download_database()
{
	global $db, $lang_new, $module_name, $settings, $themes;
	OpenTable();
	_index_navigation_header();

    if (!isset($_POST['cid']));
	$_POST['cid'] = 0;
	
	$cid = (int) $_POST['cid'];
	
    if (!isset($_REQUEST['query']));
	$_REQUEST['query'] = '';
	
	$query 	= addslashes($_REQUEST['query']);
	echo '<br />';
	echo '<form action="modules.php?name=File_Repository&action=search" method="post">'."\n";
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['SEARCH_DATABASE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%','right',_sc()).'>'._sut($lang_new[$module_name]['SEARCH_QUERY']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._input('text','query','250px','').'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%','right',_sc()).'>'._sut($lang_new[$module_name]['CATEGORY']).'</td>'."\n";
	echo '    <td'._tdcss('50%',false,_sc()).'>'._category_parents_and_children('cid','',true).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sf(),2).'>'._submit($lang_new[$module_name]['SEARCH']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";

	if($query <> '')
	{
		echo '<br />';
		echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sh(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._suh(sprintf($lang_new[$module_name]['SEARCH_RESULTS'],$query)).'</td>'."\n";
		echo '  </tr>'."\n";
		$where 	= ($cid > 0) ? ' AND `cid`='.$cid : '';
		$sql 	  = "SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE (`title` LIKE '%".$query."%' OR `description` LIKE '%".$query."%') AND `isactive` > 0".$where;
		$result   = $db->sql_query($sql);
		$numrows  = $db->sql_numrows($result);
		if($numrows > 0)
		{
			if($settings['download_view'] == 0)
			{
				echo '  <tr'._bgColor(2).'>'."\n";
				echo '    <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$module_name]['TITLE']).'</td>'.PHP_EOL;
				echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['VIEWS']).'</td>'.PHP_EOL;
				echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['DOWNLOADS']).'</td>'.PHP_EOL;
				echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['FILE_SIZE']).'</td>'.PHP_EOL;
				echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($lang_new[$module_name]['DATE_ADDED']).'</td>'.PHP_EOL;
				echo '  </tr>'."\n";
				while($q = $db->sql_fetchrow($result))
				{
					$v 			= (($q['version']) ? sprintf($lang_new[$module_name]['V'],$q['version']) : '');
					$iteminfo 	= _collect_iteminfo($q['did']);
					$screen[$items] = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$q['did']."' ORDER BY RAND()"));
					echo '  <tr'._bgColor(1).'>'."\n";
					if($screen[$items]['filename'])
					{
						echo '    <td'._tdcss('5%','center',_sc()).'><a'._image_viewer($screen[$items]['filename'],'item-'.$q['did']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img style="border: 1px solid white; height: 28px; width: 30px;" src="modules/'.$module_name.'/files/screenshots/'.$screen[$items]['filename'].'" border="0" /></a></td>';
						echo '    <td'._tdcss('45%',false,_sc()).'>';
						echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$q['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
						echo '    </td>';
					} else {
						echo '    <td'._tdcss(false,false,_sc(),2).'>';
						echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$q['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
						echo '    </td>';
					}
					echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['views'].'</td>';
					echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['hits'].'</td>';
					echo '    <td'._tdcss('10%','center',_sc()).'>'._sut($iteminfo['filesize']).'</td>';
					echo '    <td'._tdcss('20%','center',_sc()).'>'.$iteminfo['date'].'</td>';
					echo '  </tr>'."\n";
					$items++;
				}
			} 
			else 
			{
				$items = 0;
				while($q = $db->sql_fetchrow($result))
				{
					$v 				= (($q['version']) ? sprintf($lang_new[$module_name]['V'],$q['version']) : '');
					$iteminfo 		= _collect_iteminfo($q['did']);
					$screen[$items] = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$q['did']."' ORDER BY RAND()"));
					$ustring 		= ($iteminfo['updated'] == '0000-00-00 00:00:00') ? _sut($lang_new[$module_name]['DATE_ADDED']) : _sut($lang_new[$module_name]['UPDATED']);
					if($screen[$items]['filename'])
						$colspan = false;
					else 
						$colspan = 2;

					if($themes[get_theme()]['per_row'] == 3)
						$filePerRow = '33%';
					elseif($themes[get_theme()]['per_row'] == 2)
						$filePerRow = '50%';
					elseif($themes[get_theme()]['per_row'] == 1)
						$filePerRow = '100%';
					
					if ($items == 0)
						echo '  <tr'._bgColor(1).'>'."\n";

					echo '    <td'._tdcss($filePerRow,false,_sc()).' valign="top">'."\n";
					echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
					echo '        <tr'._bgColor(1).'>'."\n";
					if($screen[$items]['filename'])
					echo '          <td'._tdcss('10%','center',_sc()).'><div class="thumbnail_border"><a'._image_viewer($screen[$items]['filename'],'item-'.$q['did']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img src="'._FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$screen[$items]['filename'].'" border="0" /></a></div></td>';
					echo '          <td'._tdcss('90%',false,_sc(),$colspan).' valign="top">';
					echo '            <table width="100%" border="0" cellpadding="4" cellspacing="1">'."\n";
					echo '              <tr>'."\n";
					echo '                <td'._tdcss(false,false,false,false,true).'>';
					echo '                  '._sut($lang_new[$module_name]['DOWNLOAD']).' : <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$q['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
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
			$db->sql_freeresult($result);
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sh(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>&nbsp;</td>'."\n";
			echo '  </tr>'."\n";
		}
		else
		{
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._sut(sprintf($lang_new[$module_name]['SEARCH_RESULTS_NONE'],$query)).'</td>'."\n";
			echo '  </tr>'."\n";
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,false,_sf(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>&nbsp;</td>'."\n";
			echo '  </tr>'."\n";
		}
		echo '</table>'."\n";
	}
	echo '</form>'."\n";
	CloseTable();
}

_query_the_download_database();

?>