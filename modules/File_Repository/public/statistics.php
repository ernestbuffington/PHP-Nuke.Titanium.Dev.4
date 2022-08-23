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

function _general_statistics()
{
	global $db, $lang_new, $module_name, $settings;
	OpenTable();
	_index_navigation_header();
	# TOTAL CATEGORY COUNT
	$cresult			= $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."`");
	$totalcategories 	= $db->sql_numrows($cresult);
	# TOTAL ACTIVE DOWNLOADS
	$dresult  			= $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."`");
	$totaldownloads     = $db->sql_numrows($dresult);
	# COUNT THE TOTAL FILE DOWNLOADS THROUGHOUT THE MODULE
	$sresult  			= $db->sql_query("SELECT SUM(hits) as totalhits FROM `"._FILE_REPOSITORY_ITEMS."`");
	$statistic          = $db->sql_fetchrow($sresult);
	# GRAB THE TOTAL FILE DATABASE SIZE
	$sresult2  			= $db->sql_query("SELECT SUM(filesize) as totalsize FROM `"._FILE_REPOSITORY_FILES."`");
	$statistic2         = $db->sql_fetchrow($sresult2);
	# GRAB THE TOP 5 POPULAR FILES
	$presult  			= $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `hits` > 0 && `isactive` = 1 ORDER BY `hits` DESC, `title` ASC LIMIT 0,5");
	$totalpopular       = $db->sql_numrows($presult);
	# GRAB THE LATEST FILE FROM THE DATABASE
	$lresult  			= $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isactive` = 1 ORDER BY `date` DESC LIMIT 0,5");

	echo '<br />';
	echo '<table style="width: 100%; table-layout:fixed;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['STATISTICS_HEADER']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss(false,false,_sc()).'>';
	echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '        <tr'._bgColor(1).'>';
	echo '          <td'._tdcss('70%',false,_sc()).'>'._sut($lang_new[$module_name]['TOTAL_CATEGORIES']).'</td>';
	echo '          <td'._tdcss('30%','center',_sc()).'>'.$totalcategories.'</td>';
	echo '        </tr>';
	echo '        <tr'._bgColor(1).'>';
	echo '          <td'._tdcss('70%',false,_sc()).'>'._sut($lang_new[$module_name]['TOTAL_FILES']).'</td>';
	echo '          <td'._tdcss('30%','center',_sc()).'>'.$totaldownloads.'</td>';
	echo '        </tr>';
	echo '      </table>'."\n";
	echo '    </td>'."\n";
	echo '    <td'._tdcss(false,false,_sc()).'>';
	echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '        <tr'._bgColor(1).'>';
	echo '          <td'._tdcss('70%',false,_sc()).'>'._sut($lang_new[$module_name]['TOTAL_DOWNLOADS']).'</td>';
	echo '          <td'._tdcss('30%','center',_sc()).'>'.(($statistic['totalhits']) ? $statistic['totalhits'] : '0').'</td>';
	echo '        </tr>';
	echo '        <tr'._bgColor(1).'>';
	echo '          <td'._tdcss('70%',false,_sc()).'>'._sut($lang_new[$module_name]['TOTAL_DATABASE_SIZE']).'</td>';
	echo '          <td'._tdcss('30%','center',_sc()).'>'.(($statistic2['totalsize']) ? _convertsize($statistic2['totalsize']) : 0).'</td>';
	echo '        </tr>';
	echo '      </table>'."\n";
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	# TOP 5 POPULAR FILES
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss('50%',false,_sh()).'>'._suh($lang_new[$module_name]['TOPFIVE']).'</td>'."\n";
	echo '	  <td'._tdcss('50%',false,_sh()).'>'._suh($lang_new[$module_name]['LATEST_FILES']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '	  <td'._tdcss('50%',false,_sc()).' valign="top">';
	echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	if($totalpopular > 0)
	{
		echo '        <tr'._bgColor(2).'>'."\n";
		echo '          <td'._tdcss('70%',false,_sh()).'>'._suh($lang_new[$module_name]['TITLE']).'</td>'."\n";
		echo '          <td'._tdcss('30%','center',_sh()).'>'._suh($lang_new[$module_name]['HITS']).'</td>'."\n";
		echo '        </tr>'."\n";
		while($popular = $db->sql_fetchrow($presult))
		{
			$iteminfo['isnew'] = (($popular['isupdated'] == '0000-00-00 00:00:00') ? $popular['date'] : $popular['isupdated']);
			echo '        <tr'._bgColor(1).'>'."\n";
			echo '	        <td'._tdcss('70%',false,_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$popular['did'].'">'._colorization($popular['title'],$popular['color']).'</a>'._item_is_new($iteminfo['isnew'],$popular['isupdated'])._mostpopular($popular['hits']).'</td>';
			echo '	        <td'._tdcss('30%','center',_sc()).'>'.$popular['hits'].'</td>';
			echo '        </tr>';
		}
		$db->sql_freeresult($presult);
	} else {
		echo '        <tr'._bgColor(1).'>'."\n";
		echo '	        <td'._tdcss(false,'center',_sc(),2).'>'.$lang_new[$module_name]['NOINFO'].'</td>';
		echo '        </tr>';
	}
	echo '      </table>'."\n";
	echo '    </td>'."\n";
	echo '	  <td'._tdcss('50%',false,_sc()).' valign="top">';
	echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	if($totaldownloads > 0)
	{
		echo '        <tr'._bgColor(2).'>'."\n";
		echo '          <td'._tdcss('70%',false,_sh()).'>'._suh($lang_new[$module_name]['TITLE']).'</td>'."\n";
		echo '          <td'._tdcss('30%','center',_sh()).'>'._suh($lang_new[$module_name]['DATE_ADDED']).'</td>'."\n";
		echo '        </tr>'."\n";
		while($latest = $db->sql_fetchrow($lresult))
		{
			$iteminfo['isnew'] = (($latest['isupdated'] == '0000-00-00 00:00:00') ? $latest['date'] : $latest['isupdated']);
			echo '        <tr'._bgColor(1).'>'."\n";
			echo '	        <td'._tdcss('70%',false,_sc()).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$latest['did'].'">'._colorization($latest['title'],$latest['color']).'</a>'._item_is_new($iteminfo['isnew'],$latest['isupdated'])._mostpopular($latest['hits']).'</td>';
			echo '	        <td'._tdcss('30%','center',_sc()).'>'._timestamp($latest['date']).'</td>';
			echo '        </tr>';
		}
		$db->sql_freeresult($lresult);
	} else {
		echo '        <tr'._bgColor(1).'>'."\n";
		echo '	        <td'._tdcss(false,'center',_sc(),2).'>'.$lang_new[$module_name]['NOINFO'].'</td>';
		echo '        </tr>';
	}
	echo '      </table>'."\n";
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(false,'center',_sf(),2).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
}

_general_statistics();

?>