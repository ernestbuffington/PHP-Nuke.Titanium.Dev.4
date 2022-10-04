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

function _most_popular_download_info()
{
	global $titanium_db, $lang_new, $pnt_module, $userinfo, $admin, $titanium_user, $settings, $themes;
	OpenTable();
	_index_navigation_header();

	// $pageroot       = (!empty($_GET['page'])) ? $_GET['page'] : 1;
	// $perpage        = $settings['most_popular'];
	// $page           = (isset($pageroot)) ? intval($pageroot) : 1;	
	// $calc           = $perpage * $page;
	// $phpbb2_start          = $calc - $perpage;

	$count_downloads = $titanium_db->sql_numrows($titanium_db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isactive` = 1 && `isbroken` = 0 && `hits` <> 0"));
//-------------------------------------------------------------------------------------
//	THIS IS THE DEFAULT PAGINATION CLASS THAT COMES WITH EVOLUTION XTREME.
//-------------------------------------------------------------------------------------
	$pagination = new Paginator($_GET['page'],$count_downloads);
	$pagination->set_Limit($settings['most_popular']);
	// $pagination->set_Limit(1);
	$pagination->set_Links(3);
	$limit1 = $pagination->getRange1();
	$limit2 = $pagination->getRange2();
//-------------------------------------------------------------------------------------

	$sql 	 = "SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isactive` = 1 && `hits` <> 0 ORDER BY `hits` DESC LIMIT ".$limit1.", ".$limit2;
	$result  = $titanium_db->sql_query($sql);
	$numrows = $titanium_db->sql_numrows($result);
	echo '<br />';
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sh(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._suh($lang_new[$pnt_module]['POPULAR_MOST_DOWNLOADED']).'</td>'."\n";
	echo '  </tr>'."\n";
	if($numrows > 0)
	{
		if($settings['download_view'] == 0)
		{
			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss(false,false,_sh(),2).'>'._suh($lang_new[$pnt_module]['TITLE']).'</td>'.PHP_EOL;
			echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$pnt_module]['VIEWS']).'</td>'.PHP_EOL;
			echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$pnt_module]['DOWNLOADS']).'</td>'.PHP_EOL;
			echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$pnt_module]['FILE_SIZE']).'</td>'.PHP_EOL;
			echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($lang_new[$pnt_module]['DATE_ADDED']).'</td>'.PHP_EOL;
			echo '  </tr>'."\n";
			while($popular = $titanium_db->sql_fetchrow($result))
			{
				$v 			= (($popular['version']) ? sprintf($lang_new[$pnt_module]['V'],$popular['version']) : '');
				$iteminfo 	= _collect_iteminfo($popular['did']);
				$screen[$items] = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$popular['did']."' ORDER BY RAND()"));
				echo '  <tr'._bgColor(1).'>'."\n";
				if($screen[$items]['filename'])
				{
					echo '    <td'._tdcss('5%','center',_sc()).'><a'._image_viewer($screen[$items]['filename'],'item-'.$popular['did']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img style="border: 1px solid white; height: 28px; width: 30px;" src="modules/'.$pnt_module.'/files/screenshots/'.$screen[$items]['filename'].'" border="0" /></a></td>';
					echo '    <td'._tdcss('45%',false,_sc()).'>';
					echo '      <a'._ls().' href="modules.php?name='.$pnt_module.'&amp;action=view&amp;did='.$popular['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
					echo '    </td>';
				} else {
					echo '    <td'._tdcss(false,false,_sc(),2).'>';
					echo '      <a'._ls().' href="modules.php?name='.$pnt_module.'&amp;action=view&amp;did='.$popular['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
					echo '    </td>';
				}
				echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['views'].'</td>';
				echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['hits'].'</td>';
				echo '    <td'._tdcss('10%','center',_sc()).'>'._sut($iteminfo['filesize']).'</td>';
				echo '    <td'._tdcss('20%','center',_sc()).'>'.$iteminfo['date'].'</td>';
				echo '  </tr>'."\n";
				$items++;
			}
			$titanium_db->sql_freeresult($result);
		}
		else
		{
			$items = 0;
			while($popular = $titanium_db->sql_fetchrow($result))
			{
				$v 				= (($popular['version']) ? sprintf($lang_new[$pnt_module]['V'],$popular['version']) : '');
				$iteminfo 		= _collect_iteminfo($popular['did']);
				$screen[$items] = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$popular['did']."' ORDER BY RAND()"));
				$ustring 		= ($iteminfo['updated'] == '0000-00-00 00:00:00') ? _sut($lang_new[$pnt_module]['DATE_ADDED']) : _sut($lang_new[$pnt_module]['UPDATED']);
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
				echo '          <td'._tdcss('10%','center',_sc()).'><div class="thumbnail_border"><a'.get_image_viewer('screens').' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img src="'._FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$screen[$items]['filename'].'" border="0" /></a></div></td>';
				echo '          <td'._tdcss('90%',false,_sc(),$colspan).' valign="top">';
				echo '            <table width="100%" border="0" cellpadding="4" cellspacing="1">'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>';
				echo '                  '._sut($lang_new[$pnt_module]['DOWNLOAD']).' : <a'._ls().' href="modules.php?name='.$pnt_module.'&amp;action=view&amp;did='.$popular['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
				echo '                </td>'."\n";
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'._sut($lang_new[$pnt_module]['PERMISSIONS']).' : '.$iteminfo['whocan'].'</td>';
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'._sut($lang_new[$pnt_module]['FILE_VERSION']).' : '.(($iteminfo['version']) ? $iteminfo['version'] : $lang_new[$pnt_module]['NA']).'</td>';
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'.$ustring.' : '.$iteminfo['isupdated'].'</td>';
				echo '              </tr>'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>'._sut($lang_new[$pnt_module]['DOWNLOADS']).' : '.$iteminfo['hits'].'</td>';
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
	} else {
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '	  <td'._tdcss(false,'center',_sc(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._sut($lang_new[$pnt_module]['NOINFO']).'</td>'."\n";
		echo '  </tr>'."\n";
	}
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'right',_sf(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'."\n";
	if($count_downloads > $settings['most_popular'])
	{
		if ($pagination->getCurrent() == 1)
			$first = ' | '.$lang_new[$pnt_module]['FIRST'].' | ';
		else
			$first = ' | <a href="modules.php?name='.$pnt_module.'&amp;action=mostpopular&amp;page='.$pagination->getFirst().'">'.$lang_new[$pnt_module]['FIRST'].'</a> |';
			
		if ($pagination->getPrevious())
			$prev = '<a href="modules.php?name='.$pnt_module.'&amp;action=mostpopular&amp;page='.$pagination->getPrevious().'">'.$lang_new[$pnt_module]['PREV'].'</a> | ';
		else
			$prev = $lang_new[$pnt_module]['PREV'].' | ';
			
		if ($pagination->getNext())
			$next = '<a href="modules.php?name='.$pnt_module.'&amp;action=mostpopular&amp;page='.$pagination->getNext().'">'.$lang_new[$pnt_module]['NEXT'].'</a> | ';
		else
			$next = $lang_new[$pnt_module]['NEXT'].' | ';
			
		if ($pagination->getLast())
			$last = '<a href="modules.php?name='.$pnt_module.'&amp;action=mostpopular&amp;page='.$pagination->getLast().'">'.$lang_new[$pnt_module]['LAST'].'</a>';
		else
			$last = $lang_new[$pnt_module]['LAST'];
			
		echo $pagination->getFirstOf().' to '.$pagination->getSecondOf().' of '.$pagination->getTotalItems().' '.$first." ".$prev." ".$next." ".$last;
	} else {
		echo '&nbsp;';
	}
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
}

_most_popular_download_info();

?>