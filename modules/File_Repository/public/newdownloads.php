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

function _show_list_newdownloads()
{
	global $db, $admin_file, $lang_new, $module_name, $userinfo, $settings, $admin, $user;
	
	$counter = 0;
	$allweekdownloads = 0;
	while ($counter <= 7-1)
	{
		$newdownloaddayRaw = (time()-(86400 * $counter));
		$newdownloadDB = date('Y-m-d', $newdownloaddayRaw);
		$totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `date` LIKE '%$newdownloadDB%' AND `isactive` > '0'"));
		$counter++;
		$allweekdownloads = $allweekdownloads + $totaldownloads;
	}
	
	$counter = 0;
	$allmonthdownloads = 0;
	while ($counter <=30-1)
	{
		$newdownloaddayRaw = (time()-(86400 * $counter));
		$newdownloadDB = date('Y-m-d', $newdownloaddayRaw);
		$totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `date` LIKE '%$newdownloadDB%' AND `isactive` > '0'"));
		$allmonthdownloads = $allmonthdownloads + $totaldownloads;
		$counter++;
	}
	
	$newdownloadshowdays = (!empty($_GET['newdownloadshowdays'])) ? $_GET['newdownloadshowdays'] : 7;	
	
	OpenTable();
	_index_navigation_header();	
	echo '<br />';
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '	<tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['NEW_DOWNLOADS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '	<tr'._bgColor(1).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sc(),2).'>'._sut($lang_new[$module_name]['NEW_DOWNLOADS_TOTALS']).': '._sut($lang_new[$module_name]['LASTWEEK']).' - '.$allweekdownloads.' \ '._sut($lang_new[$module_name]['LAST30']).' - '.$allmonthdownloads.'</td>'."\n";
	echo '  </tr>'."\n";
	echo '	<tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sh(),2).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=newdownloads&amp;newdownloadshowdays=7">'._suh($lang_new[$module_name]['1WEEK']).'</a> - <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=newdownloads&amp;newdownloadshowdays=14">'._suh($lang_new[$module_name]['2WEEKS']).'</a> - <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=newdownloads&amp;newdownloadshowdays=30">'._suh($lang_new[$module_name]['30DAYS']).'</a></td>'."\n";
	echo '  </tr>'."\n";		
	echo '	<tr'._bgColor(1).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sc(),2).'>'._sut(sprintf($lang_new[$module_name]['NEW_DOWNLOADS_LAST'],$newdownloadshowdays)).':<br /><br />';		
	$counter = 0;
	$allweekdownloads = 0;
	while ($counter <= $newdownloadshowdays-1) 
	{
		$newdownloaddayRaw = (time()-(86400 * $counter));
		$newdownloadDB = Date("Y-m-d", $newdownloaddayRaw);
		$totaldownloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `date` LIKE '%$newdownloadDB%' AND `isactive` > '0'"));
		$counter++;
		$allweekdownloads = $allweekdownloads + $totaldownloads;
		echo '<strong><big>&middot;</big></strong> <a href="modules.php?name='.$module_name.'&amp;action=newdownloadsdate&amp;selectdate='.$newdownloaddayRaw.'">'.$newdownloadDB.'</a>&nbsp('.$totaldownloads.')<br />'."\n";
	}
	$counter = 0;
	$allmonthdownloads = 0;		
	echo '</td>'."\n";
	echo '  </tr>'."\n";		
	echo '	<tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sf(),2).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";		
	echo '</table>'."\n";	
	CloseTable();	
}

function _show_list_newdownloads_dates()
{
	global $db, $admin_file, $lang_new, $module_name, $userinfo, $settings, $themes, $admin, $user;
	
	OpenTable();
	_index_navigation_header();
	
	$dateDB           = (date("d-M-Y", $_GET['selectdate']));
	$dateView         = (date("F d, Y", $_GET['selectdate']));
	$newdownloadDB    = (date("Y-m-d", $_GET['selectdate']));

	$sql 		= "SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `date` LIKE '%".$newdownloadDB."%' AND `isactive` > '0'";
	$result  	= $db->sql_query($sql);
	$numrows 	= $db->sql_numrows($result);
	echo '<br />';
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sh(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._timestamp($dateView,'M jS, Y').' - '._suh($lang_new[$module_name]['NEW_DOWNLOADS']).'</td>'."\n";
	echo '  </tr>'."\n";
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
			while($popular = $db->sql_fetchrow($result))
			{
				$v 			= (($popular['version']) ? sprintf($lang_new[$module_name]['V'],$popular['version']) : '');
				$iteminfo 	= _collect_iteminfo($popular['did']);
				$screen[$items] = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$popular['did']."' ORDER BY RAND()"));
				echo '  <tr'._bgColor(1).'>'."\n";
				if($screen[$items]['filename'])
				{
					echo '    <td'._tdcss('5%','center',_sc()).'><a'._image_viewer($screen[$items]['filename'],'item-'.$popular['did']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img style="border: 1px solid white; height: 28px; width: 30px;" src="modules/'.$module_name.'/files/screenshots/'.$screen[$items]['filename'].'" border="0" /></a></td>';
					echo '    <td'._tdcss('45%',false,_sc()).'>';
					echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$popular['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
					echo '    </td>';
				} else {
					echo '    <td'._tdcss(false,false,_sc(),2).'>';
					echo '      <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$popular['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).$v.'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
					echo '    </td>';
				}
				echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['views'].'</td>';
				echo '    <td'._tdcss('10%','center',_sc()).'>'.$iteminfo['hits'].'</td>';
				echo '    <td'._tdcss('10%','center',_sc()).'>'._sut($iteminfo['filesize']).'</td>';
				echo '    <td'._tdcss('20%','center',_sc()).'>'.$iteminfo['date'].'</td>';
				echo '  </tr>'."\n";
				$items++;
			}
			$db->sql_freeresult($result);
		} 
		else 
		{
			$items = 0;
			while($d = $db->sql_fetchrow($result))
			{
				$v 				= (($d['version']) ? sprintf($lang_new[$module_name]['V'],$d['version']) : '');
				$iteminfo 		= _collect_iteminfo($d['did']);
				$screen[$items] = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$d['did']."' ORDER BY RAND()"));
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
				echo '          <td'._tdcss('10%','center',_sc()).'><div class="thumbnail_border"><a'._image_viewer($screen[$items]['filename'],'item-'.$d['did']).' href="'._FILE_REPOSITORY_SCREENS.$screen[$items]['filename'].'" title="'.$screen[$items]['title'].'"><img src="'._FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$screen[$items]['filename'].'" border="0" /></a></div></td>';
				echo '          <td'._tdcss('90%',false,_sc(),$colspan).' valign="top">';
				echo '            <table width="100%" border="0" cellpadding="4" cellspacing="1">'."\n";
				echo '              <tr>'."\n";
				echo '                <td'._tdcss(false,false,false,false,true).'>';
				echo '                  '._sut($lang_new[$module_name]['DOWNLOAD']).' : <a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$d['did'].'">'._colorization($iteminfo['title'],$iteminfo['color']).'</a>'._item_is_new($iteminfo['isnew'],$iteminfo['updated'])._mostpopular($iteminfo['hits']);
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
    			echo '    <td'._tdcss($filePerRow,false,_sc()).'>&nbsp;</td>'."\n";
    			echo '  </tr>'."\n";
  			}
		}
	} else {
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '	  <td'._tdcss(false,'center',_sc(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>'._sut($lang_new[$module_name]['NOINFO']).'</td>'."\n";
		echo '  </tr>'."\n";
	}
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,false,_sf(),(($settings['download_view'] == 0) ? '6' : $themes[get_theme()]['per_row'])).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
}

switch($action)
{
	default: 
		_show_list_newdownloads(); 
		break;
	case 'newdownloadsdate': 
		_show_list_newdownloads_dates();
		break;
}

?>