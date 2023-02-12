<?php
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 coRpSE                                            */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}

global $admin_file, $currentlang;
	if (is_mod_admin('admin'))
		{
			if (file_exists(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php')) 
			{
				include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php');
			} else {
				include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-english.php');
			}
		
		
function abget_country($tempip)
	{
		global $prefix, $db;
		$tempip = str_replace(".*", ".0", $tempip);
		$tempip = sprintf("%u", ip2long($tempip));
		$result = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_ip2country` WHERE `ip_lo`<='$tempip' AND `ip_hi`>='$tempip' LIMIT 0,1");
		$countryinfo = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		return $countryinfo;
	}



//*************************************************************************
//*************************************************************************
//  Start of stats section
//*************************************************************************
//*************************************************************************
function honeypotstats()
	{	
	  	global $prefix, $db, $admin_file;

		$result = $db->sql_query("SELECT check1, check2, check3, check4, check5, check6, c8opt1, c8opt2, fs9opt1, fs9opt2, headcolor, rowcolor1, rowcolor2, pagebgcolor, pagebordercolor, fontcolor, fontcolor2 FROM ".$prefix."_honeypot_config");
		list($check1, $check2, $check3, $check4, $check5, $check6, $c8opt1, $c8opt2, $fs9opt1, $fs9opt2, $headcolor, $rowcolor1, $rowcolor2, $pagebgcolor, $pagebordercolor, $fontcolor, $fontcolor2) = $db->sql_fetchrow($result);
		
		addCSSToHead('./includes/honeypot/css/honeypot_stats.css','file');
    $hpcss2head .='<style>';
	$hpcss2head .='.maincontent {';
	$hpcss2head .='border:1px solid '.$pagebordercolor.';';
	$hpcss2head .='}';
	$hpcss2head .='.pothead {';
	$hpcss2head .='color: '.$fontcolor2.';';
	$hpcss2head .='text-shadow: 0 0 5px '.$pagebordercolor.';';
	$hpcss2head .='border:1px solid '.$pagebordercolor.';';
	$hpcss2head .='}';
	$hpcss2head .='.potlogo p{';
	$hpcss2head .='text-shadow: 0 0 15px '.$pagebordercolor.';';
	$hpcss2head .='color: '.$fontcolor2.';';
	$hpcss2head .='}';
	$hpcss2head .='.pot {';
	$hpcss2head .='border:1px solid '.$pagebordercolor .';';
	$hpcss2head .='color: '.$fontcolor.';';
	$hpcss2head .='background-color: '.$pagebgcolor.';';
	$hpcss2head .='}';
	$hpcss2head .='.minipot {';
	$hpcss2head .='color: '.$fontcolor.';';
	$hpcss2head .='border:0px solid '.$pagebordercolor.';';
	$hpcss2head .='}';
	$hpcss2head .='.minipot-text {';
	$hpcss2head .='color: '.$fontcolor.';';
	$hpcss2head .='border:0px solid '.$pagebordercolor.';;';
	$hpcss2head .='}';
	$hpcss2head .='.pot A:link {color:'.$fontcolor.';} ';
	$hpcss2head .='.pot A:visited {color:'.$fontcolor.';} ';
	$hpcss2head .='.pot A:active {color:'.$fontcolor.';} ';
	$hpcss2head .='.pot A:hover {color:'.$fontcolor2.';}';
	$hpcss2head .='		</style>';

	addCSSToHead(''.$hpcss2head.'','inline');
			
					include("header.php");	
					
					$result1 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '0'");
list($waitscript) = $db->sql_fetchrow($result1);
$db->sql_freeresult($result1);
					$result2 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '1'");
list($textremoval) = $db->sql_fetchrow($result2);
$db->sql_freeresult($result2);
					$result3 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '2'");
list($hidden) = $db->sql_fetchrow($result3);
$db->sql_freeresult($result3);
					$result4 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '3'");
list($customquestion) = $db->sql_fetchrow($result4);
$db->sql_freeresult($result4);
					$result5 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '4' OR potnum = '5'");
list($sfsspam) = $db->sql_fetchrow($result5);
$db->sql_freeresult($result5);
					$result6 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '6'");
list($bscheck) = $db->sql_fetchrow($result6);
$db->sql_freeresult($result6);
					$result7 = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot` WHERE potnum = '7'");
list($fscheck) = $db->sql_fetchrow($result7);
$db->sql_freeresult($result7);


	
		echo '<script src="https://www.gstatic.com/charts/loader.js"></script>' , PHP_EOL
		,'    <script>
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          [\'Task\', \'Bots Caught\'],
          [\'Wait Script\', '.$waitscript.'],
          [\'Text Removal\', '.$textremoval.'],
          [\'Honeypot / Hidden Question\', '.$hidden.'],
          [\'Custom Question\', '.$customquestion.'],
          [\'SFS Blacklist\', '.$sfsspam.'],
          [\'BotScout Blacklist\', '.$bscheck.'],
          [\'FSpamlist Blacklist\', '.$fscheck.']
        ]);

        var options = {
          title: \'Honeypot Blocker Results PieChart\',
          is3D: true,
		  backgroundColor: \''.$rowcolor2.'\',
		  titleTextStyle: {color: \''.$fontcolor.'\', fontSize: \'32px\'},
  		  legendTextStyle: {color: \''.$fontcolor.'\', fontSize: \'16px\'},
		  colors: [\'#00A209\', \'#486EFF\', \'#AB00BC\', \'#C30012\', \'#D08E00\', \'#00C3B4\', \'#77D100\'],
        };

        var chart = new google.visualization.PieChart(document.getElementById(\'piechart_3d\'));
        chart.draw(data, options);
      }
    </script>' , PHP_EOL;

		OpenTable();
		echo '<div class="potlogo">' , PHP_EOL
		,'<p>'._HONEYPOT_MAIN.'<br /><img src="./images/honeypot/nukehoneypot.png" height="107px" width="360px" alt="Honeypot Protected">' , PHP_EOL
		,'</p></div>' , PHP_EOL
		,'<div align="center">[ <a href="admin.php?op=honeypot"><strong>'._HONEYPOT_BOTLIST.'</strong></a> ]' , PHP_EOL
		,' &nbsp; -- &nbsp; ' , PHP_EOL
		,'[ <a href="'.$admin_file.'.php">'._HONEYPOT_MAINADMIN.'</a> ]' , PHP_EOL
		,' &nbsp; -- &nbsp; ' , PHP_EOL
		,'[ <a href="admin.php?op=honeypotconfig"><strong>HoneyPot Configuration</strong></a> ]</div>' , PHP_EOL;
		CloseTable();
		
		OpenTable();
	
$result_total = $db->sql_query("SELECT COUNT(potnum) FROM `". $prefix ."_honeypot`");
list($total_blocked) = $db->sql_fetchrow($result_total);
$db->sql_freeresult($result_total);
	
function checkPercentage($total, $check_blocked) {
	if ($total > 0) {
   $percentage = number_format(($check_blocked/$total),3)*100;
	}else{
		$percentage = 0;
	}
   return $percentage.'%';
}

		echo '<div class="maincontent">' , PHP_EOL
		    , 'There have been a total of '.$total_blocked.' bots blocked by the Honeypot<br />', PHP_EOL
			, 'Below are a few stats to know which is stopping the bots the most.<br /><br />' , PHP_EOL
			, '<strong>Bots listed in they order the system checks does its checks.</strong><br /><br />' , PHP_EOL
			, '<span id="example-dis">*DISABLED*</span> signifies that script is disabled in the config & not in use.<br /><br />' , PHP_EOL
			, '<table border="0" cellpadding="2" cellspacing="1" width="700px" class="pot">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td width="300px" class="pothead" bgcolor="'.$headcolor.'" align="center">Checker Type</td>' , PHP_EOL
			, '<td width="200px" class="pothead" bgcolor="'.$headcolor.'" align="center">Total Blocked</td>' , PHP_EOL
			, '<td width="200px" class="pothead" bgcolor="'.$headcolor.'" align="center">Overall Percentage</td>' , PHP_EOL

			, '</tr>' , PHP_EOL;


	echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_WAITSCRIPT .(($check3 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $waitscript , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $waitscript) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;
		
			echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_TEXTREMOVALSCRIPT .(($check2 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $textremoval , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $textremoval) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;
		
			echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_HIDDENTEXTFIELD .(($check1 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $hidden , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $hidden) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;
		
			echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_CUSTOMQUESTION .(($check4 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $customquestion , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $customquestion) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;
		
			echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_SFSCHECK .(($check5 == 0 && $check6 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $sfsspam , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $sfsspam) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;
		
			echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_BSCHECK .(($c8opt1 == 0 && $c8opt2 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL  
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $bscheck , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $bscheck) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;
		
			echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="left">' , PHP_EOL
		, _HONEYPOT_FSCHECK .(($fs9opt1 == 0 && $fs9opt2 == 0) ? '<span class="disabled">*DISABLED*</span>' : '') , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, $fscheck , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" align="center">' , PHP_EOL
		, checkPercentage($total_blocked, $fscheck) , PHP_EOL 
	    ,'</td>' , PHP_EOL
		, '</tr>' , PHP_EOL;


		echo"</table>" , PHP_EOL;
		

   echo '<br /><br />' , PHP_EOL
        , '<div id="piechart_3d" class="minipot-text" style="width: 700px; height: 500px;"></div>' , PHP_EOL
		, '</div>' , PHP_EOL;
		
		CloseTable();

		OpenTable();
		echo '<p class="tiny" style="text-align:center;">Mod Created by coRpSE ' , PHP_EOL
			, '<a href="http://www.headshotdomain.net" title="HeadShotDomain" target="_blank">' , PHP_EOL
			, 'www.headshotdomain.net' , PHP_EOL
			, '</a></p>' , PHP_EOL
			, '<div align="center" style="text-align:center;">' , PHP_EOL
			, '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' , PHP_EOL
			, '<input type="hidden" name="cmd" value="_s-xclick" />' , PHP_EOL
			, '<input type="hidden" name="hosted_button_id" value="FBDV9KVDGAN2E" />' , PHP_EOL
			, '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />' , PHP_EOL
			, '<img style="border:0; width:1px; height:1px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" />' , PHP_EOL
			, '<br /><br />Help support this project, every little bit helps.<br />' , PHP_EOL
			, '</form>' , PHP_EOL
			, '</div>' , PHP_EOL;
		CloseTable();
				
	}
//*************************************************************************
//*************************************************************************
//  End of stats section
//*************************************************************************
//*************************************************************************


function honeypot()
	{
		global $prefix, $db, $admin_file;
		$result1 = $db->sql_query("SELECT botlisting, perpage, pagenumberpos, headcolor, rowcolor1, rowcolor2, pagebgcolor, pagebordercolor, fontcolor, fontcolor2, usefeedback, email FROM ".$prefix."_honeypot_config");
		list($botlisting, $perpage, $pagenumberpos, $headcolor, $rowcolor1, $rowcolor2, $pagebgcolor, $pagebordercolor, $fontcolor, $fontcolor2, $usefeedback, $email) = $db->sql_fetchrow($result1);
		if($pagenumberpos == 0)
		{
			$page_numberpos = "top";
		} 
		elseif ($pagenumberpos == 1)
		{
			$page_numberpos = "bottom";
		}
		elseif ($pagenumberpos == 2)
		{
			$page_numberpos = "both";
		}
	
		if($botlisting == 0)
		{
			$orderby = "ASC";
		}
		elseif ($botlisting == 1)
		{
			$orderby = "DESC";
		}
		
		if (isset($_GET['del']) && $_GET['del'] == 'all') 
		{
			$db->sql_query('DELETE FROM `'.$prefix.'_honeypot`');
			$db->sql_query('ALTER TABLE `'.$prefix.'_honeypot` AUTO_INCREMENT = 1');
			$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_honeypot`');
			Header("Location: admin.php?op=honeypot");
		} 
		else 
		{
			global $prefix, $db, $bgcolor2, $admin_file;
			
			addCSSToHead('./includes/honeypot/css/honeypot.css','file');
			
			$hpcss2head = '<style>';
			$hpcss2head .='.button, button.inputbutton, input.inputarea, div.pagination a {';
			$hpcss2head .='		border:1px solid '.$pagebordercolor .';';
			$hpcss2head .='		color: '.$fontcolor.';';
			$hpcss2head .='		background-color: '.$pagebgcolor .';';
			$hpcss2head .='		}';
			$hpcss2head .='		div.pagination span {';
			$hpcss2head .='		border:1px solid '.$pagebordercolor .';';
			$hpcss2head .='		color: '.$fontcolor.';';
			$hpcss2head .='		background-color: '.$pagebgcolor .';';
			$hpcss2head .='		}';
			$hpcss2head .='		.button, button.inputbutton:hover, div.pagination a:hover,div.pagination a:active,div.pagination span.current {';
			$hpcss2head .='		border:1px solid '.$pagebordercolor .';';
			$hpcss2head .='		background-color: '.$rowcolor1 .';';
			$hpcss2head .='		}';
			$hpcss2head .='		.pothead {';
			$hpcss2head .='		color: '.$fontcolor2.';';
			$hpcss2head .='		text-shadow: 0 0 5px '.$pagebordercolor.';';
			$hpcss2head .='		border:1px solid '.$pagebordercolor.';';
			$hpcss2head .='		}';
			$hpcss2head .='		.potlogo p{';
			$hpcss2head .='		text-shadow: 0 0 15px '.$pagebordercolor.';';
			$hpcss2head .='		color: '.$fontcolor2.';';
			$hpcss2head .='		}';
			$hpcss2head .='		.pot {';
			$hpcss2head .='		border:1px solid '.$pagebordercolor .';';
			$hpcss2head .='		color: '.$fontcolor.';';
			$hpcss2head .='		}';
			$hpcss2head .='		.minipot {';
			$hpcss2head .='		color: '.$fontcolor.';';
			$hpcss2head .='		border:0px solid '.$pagebordercolor.';';
			$hpcss2head .='		}';
			$hpcss2head .='		.minipot-text {';
			$hpcss2head .='		color: '.$fontcolor.';';
			$hpcss2head .='		border:0px solid '.$pagebordercolor.';;';
			$hpcss2head .='		}';
			$hpcss2head .='		.pot A:link {color:'.$fontcolor.';} ';
			$hpcss2head .='		.pot A:visited {color:'.$fontcolor.';} ';
			$hpcss2head .='		.pot A:active {color:'.$fontcolor.';} ';
			$hpcss2head .='		.pot A:hover {color:'.$fontcolor2.';}';
			$hpcss2head .='		.hp-bot-box {';
			$hpcss2head .='			border: 5px solid '.$pagebordercolor.';';
			$hpcss2head .='			background-color: '.$pagebgcolor.';';
			$hpcss2head .='			color: '.$fontcolor.';';
			$hpcss2head .='		}';
			$hpcss2head .='		</style>';
			addCSSToHead(''.$hpcss2head.'','inline');
			include("header.php");		
			OpenTable();
			echo '<div class="potlogo"><p>'._HONEYPOT_MAIN.'</p>' , PHP_EOL
				,'<p><img src="./images/honeypot/nukehoneypot.png" height="107px" width="360px" alt="Honeypot Protected"></p></div>' , PHP_EOL
				, '<div align="center">' , PHP_EOL
				,'[ <a href="admin.php?op=honeypotconfig"><strong>'._HONEYPOT_CONFIG.'</strong></a> ]' , PHP_EOL
				,' &nbsp; -- &nbsp; ' , PHP_EOL
				,'[ <a href="'.$admin_file.'.php">'._HONEYPOT_MAINADMIN.'</a> ]' , PHP_EOL;
				
			if(isset($_GET['search']))
			{
				echo' &nbsp; -- &nbsp; ' , PHP_EOL
				.'[ <a href="admin.php?op=honeypot"><strong>'._HONEYPOT_BOTLIST.'</strong></a> ]' , PHP_EOL;
			}
				echo ' &nbsp; -- &nbsp; ' , PHP_EOL
		,'[ <a href="admin.php?op=honeypotstats"><strong>HoneyPot Stats</strong></a> ]</div>' , PHP_EOL
				,'<br>' , PHP_EOL
				  ,'<div align="center">' , PHP_EOL
					,'<form method="get" action="./admin.php" id="searchform">' , PHP_EOL
					,'<input type="hidden" name="op" value="honeypot" />' , PHP_EOL
					,'<input type="text" name="search" size="30" class="inputarea" required>' , PHP_EOL
					,'<input type="submit" value="Search" class="inputbutton">' , PHP_EOL
					,'</form>' , PHP_EOL
				,'</div>' , PHP_EOL
				,'<div align="center" style="font-style: italic;">'._HONRYPOT_ONLY_IP_EMAIL.'</div>' , PHP_EOL;
			CloseTable();

	//Checker to see if the installer is still on your site
	if (file_exists('./honeypot-install.php')) 
	{
		OpenTable();
		echo '<p style="font-weight: bold; text-align:center;">'._HONEYPOT_INSTALLCHECK.':</p>' , PHP_EOL
		,'<br/>' , PHP_EOL;

			if (file_exists('./includes/honeypot/flash.js')) 
			{
				echo "<script type=\"text/javascript\" src=\"./includes/honeypot/flash.js\"></script>" , PHP_EOL;
			}
		echo"<style type=\"text/css\">
			.blink {
			display: inline;
			}
			</style>" , PHP_EOL
				, '<body onload="blink();">' , PHP_EOL
				, '<span class="blink">', PHP_EOL
				, '<p style="color: #FF0000; text-align:center; font-size:x-large;">'._HONEYPOT_INSTALLCHECKFAIL.'</p>' , PHP_EOL
				, '</span>' , PHP_EOL;
		CloseTable();
	}
	//End Checker


	OpenTable();
	echo '<div class="pagination" style="text-align:right;">' , PHP_EOL
		,'<form method="post" action="./admin.php?op=honeypot&amp;del=all" id="delte_all">' , PHP_EOL
		,'<button name="delete_all" type="submit" id="delete_all" class="inputbutton" value="'._HONEYPOT_DELETELIST.'" onclick="return confirm(\''._HONEYPOT_DELETEALL_ANCHOR.'\');">'._HONEYPOT_DELETELIST.'</button>' , PHP_EOL
		,'</form>' , PHP_EOL
		,'</div>' , PHP_EOL
		,'<br /><br />' , PHP_EOL;
	
		// Number of results per page
		if(isset($_GET['page'])) {
				$currentPage = $db->sql_escapestring($_GET['page']);
		}else{
			$currentPage = 1;
		}
	
		//limit
		$limitQ = 'LIMIT ' .($currentPage - 1) * $perpage .',' .$perpage;
		
		// total results
		if(isset($_GET['search'])){
			$nameip = $db->sql_escapestring($_GET['search']);
			$where = ' WHERE `email` LIKE \'%' . $nameip . '%\' OR `ip` LIKE \'%' . $nameip . '%\'';
			$num = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_honeypot`' . $where . ''));
		}else{
			$num = $db->sql_numrows($db->sql_query('SELECT * FROM `' . $prefix . '_honeypot`'));
		}
	
		// round up total pages from total results
		$total_pages = ceil($num/$perpage);
	
	
		if(isset($_GET['search'])){
			$page_url = "admin.php?op=honeypot&search=$nameip";
		}else{
			$page_url = "admin.php?op=honeypot";
		}
	
		if (($page_numberpos=='top') OR ($page_numberpos=='both') ) {
	
			if($total_pages >=2){
				$adjacents = 3;
				$page = (int)$_GET["page"];
					if($page<=0) $page = 1;
						$reload = $page_url;
			// call pagination function:
					echo "<p>";
				echo paginate($reload, $page, $total_pages, $adjacents).'</p>';
			} 
		}

	echo '<script>' , PHP_EOL
		, 'var checked=false;' , PHP_EOL
		, 'var frmname=\'\';' , PHP_EOL
		, 'function checkedAll(frmname)' , PHP_EOL
		, '{' , PHP_EOL
		, ' 	var valus= document.getElementById(frmname);' , PHP_EOL
		, 'if (checked==false)' , PHP_EOL
		, '  {' , PHP_EOL
		, ' 	checked=true;' , PHP_EOL
		, '  }' , PHP_EOL
		, 'else' , PHP_EOL
		, '  {' , PHP_EOL
		, ' 	checked = false;' , PHP_EOL
		, '  }' , PHP_EOL
		, 'for (var i =0; i < valus.elements.length; i++)' , PHP_EOL
		, '  {' , PHP_EOL
		, ' 	valus.elements[i].checked=checked;' , PHP_EOL
		, '  }' , PHP_EOL
		, '}' , PHP_EOL
		, '</script>' , PHP_EOL
// Jquery for Hidden div start
		, '<script>' , PHP_EOL
		, 'nuke_jq(document).ready(function(){' , PHP_EOL
		, '		nuke_jq(".mark").bind("mouseover", function () {' , PHP_EOL
		, '			var index = nuke_jq(this).attr("id").replace("mark", "");' , PHP_EOL
		, '			nuke_jq(".addinfo" + index).show();' , PHP_EOL
		, '		});' , PHP_EOL
		, '		nuke_jq(".mark").bind("mouseout", function () {' , PHP_EOL
		, '			var index = nuke_jq(this).attr("id").replace("mark", "");' , PHP_EOL
		, '			nuke_jq(".addinfo" + index).hide();' , PHP_EOL
		, '		});' , PHP_EOL
		, '});' , PHP_EOL
		, '</script>' , PHP_EOL
// End jquer for Hidden div
		, '<form name="form1" method="post" id ="checkall">' , PHP_EOL
		, '<table border="0" cellpadding="2" cellspacing="1" width="100%">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td width="45px" class="pothead" bgcolor="'.$headcolor.'" align="center">'._HONEYPOT_ID.'</td>' , PHP_EOL
			, '<td width="25%" class="pothead" bgcolor="'.$headcolor.'" align="center">'._HONEYPOT_IP.'</td>' , PHP_EOL
			, '<td width="25%" class="pothead" bgcolor="'.$headcolor.'" align="center">'._HONEYPOT_DATETIME.'</td>' , PHP_EOL
			, '<td width="25%" class="pothead" bgcolor="'.$headcolor.'" align="center">'._HONEYPOT_CAUGHTBY.'</td>' , PHP_EOL
			, '<td width="25%" class="pothead" bgcolor="'.$headcolor.'" align="center">'._HONEYPOT_REASON.'</td>' , PHP_EOL
			, '<td width="30px" class="pothead" bgcolor="'.$headcolor.'" align="center">'._HONEYPOT_DELETE.'</td>' , PHP_EOL
			, '</tr>' , PHP_EOL;

		if(isset($_GET['search'])){
			$nameip = $db->sql_escapestring($_GET['search']);
			$result = $db->sql_query("SELECT id, username, realname, email, ip, date, potnum, reason FROM ".$prefix."_honeypot WHERE email LIKE '%$nameip%' OR ip LIKE '%$nameip%' ORDER BY id $orderby $limitQ");
		}else{
			$result = $db->sql_query("SELECT id, username, realname, email, ip, date, potnum, reason FROM ".$prefix."_honeypot ORDER BY id $orderby $limitQ");
		}
		$total_count = $db->sql_numrows($result);
		while ($row = $db->sql_fetchrow($result)) {
		$row_color = ( $rowcolor1 != $row_color ) ? $rowcolor1 : $rowcolor2;

		if ($row['potnum'] == 0){
			$script = _HONEYPOT_WAITSCRIPT;
		}elseif ($row['potnum'] == 1){
			$script = _HONEYPOT_TEXTREMOVALSCRIPT;
		}elseif ($row['potnum'] == 2){
			$script = _HONEYPOT_HIDDENTEXTFIELD;
		}elseif ($row['potnum'] == 3){
			$script = _HONEYPOT_CUSTOMQUESTION;
		}elseif ($row['potnum'] == 4){
			$script = _HONEYPOT_SFSCHECK;
		}elseif ($row['potnum'] == 5){
			$script = _HONEYPOT_SFSCHECK;
		}elseif ($row['potnum'] == 6){
			$script = _HONEYPOT_BSCHECK;
		}elseif ($row['potnum'] == 7){
			$script = _HONEYPOT_FSCHECK;
		}
	$ip2c = abget_country($row['ip']);	
	
	if (!empty($ip2c['c2c']))
	{
		$ip2c_image = '<span class="countries '.strtolower($ip2c['c2c']).'" alt="'.ucfirst (strtolower($ip2c['country'])).'" title="'.ucfirst (strtolower($ip2c['country'])).'"></span>&nbsp;';
	}
	else
	{
		// $ip2c_image = "<img src=\"images/info/flags/unknown.png\" border=\"0\" alt=\"UnKnown\" title=\"UnKnown\"  style=\"max-width: 20px; max-height:15px;\"/>&nbsp;";
		$ip2c_image = '<span class="countries blank" alt="UnKnown" title="UnKnown"></span>&nbsp;';
	}

	echo '<tr>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="mark pot" id="mark',$row['id'],'" width="45px" align="center">' , PHP_EOL
		, '<span class="minipot">' , $row['id'] , '</span>', PHP_EOL;
// Hidden Div start
	echo '<div class="addinfo',$row['id'],' hp-bot-box">' , PHP_EOL
	   , '<div class="pothead text-center">' , _HONEYPOT_ADDITIONALINFO , '</div>' , PHP_EOL
	   , '<hr>' , PHP_EOL
	   , '<p class="minipot-text"><span class="minipot thick">' , _HONEYPOT_USERNAME , '</span> &nbsp;&nbsp;-&nbsp;&nbsp; ' , htmlspecialchars($row['username'], ENT_QUOTES, _CHARSET) , '</p>' , PHP_EOL
	   , '<p class="minipot-text"><span class="minipot thick">' , _HONEYPOT_REALNAME , '</span> &nbsp;&nbsp;-&nbsp;&nbsp; ' , htmlspecialchars($row['realname'], ENT_QUOTES, _CHARSET) , '</p>' , PHP_EOL
	   , '<p class="minipot-text"><span class="minipot thick">'._HONEYPOT_IP.'</span> &nbsp;&nbsp;-&nbsp;&nbsp; '.$ip2c_image . $row['ip'].'</p>' , PHP_EOL
	   , '<p class="minipot-text"><span class="minipot thick">' , _HONEYPOT_EMAIL , '</span> &nbsp;&nbsp;-&nbsp;&nbsp; ' , htmlspecialchars($row['email'], ENT_QUOTES, _CHARSET) , '</p>' , PHP_EOL
	   , '</div>' , PHP_EOL;
	   
// Hidden Div end
	echo '</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="pot" width="25%" align="center">' , PHP_EOL
			, '<a href="http://dnsquery.org/ipwhois/'.$row['ip'].'" target="_blank">'.$ip2c_image . $row['ip'].'</a></td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="pot" width="25%" align="center">'.$row['date'].'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="pot" width="25%" align="center">'.$script.'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="pot" width="25%">&nbsp;'.$row['reason'].'</td>' , PHP_EOL
		, '<td bgcolor="'.$row_color.'" class="pot" align="center">' , PHP_EOL
			, '<input type="checkbox" name="checkbox[]" id="checkbox[]" value="'.$row['id'].'"></td>' , PHP_EOL
		, '</tr>' , PHP_EOL;

	}
		echo"</table>" , PHP_EOL;
		




	if (($total_count == 0) && (isset($_POST['nameip']))){
			echo'<table border="0" cellpadding="2" cellspacing="1" width="100%">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td width="100%" align="center" style="font-weight:900; font-size:16;">'._HONEYPOT_EMPTY_SEARCH.'</td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '</table>' , PHP_EOL;
		}elseif ($total_count == 0 && (!isset($_POST['nameip']))){
			echo '<table border="0" cellpadding="2" cellspacing="1" width="100%">' , PHP_EOL
			, '<tr>' , PHP_EOL
			, '<td width="100%" align="center" style="font-weight:900; font-size:16;">'._HONEYPOT_NO_CONTENT.'</td>' , PHP_EOL
			, '</tr>' , PHP_EOL
			, '</table>' , PHP_EOL;
		}
		if (($page_numberpos=='bottom') OR ($page_numberpos=='both') ) {

			if($total_pages >=2){
				$adjacents = 3;
				$page = (int)$_GET["page"];
					if($page<=0) $page = 1;
					$reload = $page_url;
			// call pagination function:
				echo '<p>' , PHP_EOL
				. paginate($reload, $page, $total_pages, $adjacents).'</p>' , PHP_EOL;
			}
		}
	echo '<div class="pagination" style="text-align:right;">' , PHP_EOL
		. '<button type="button" name="checkall" onclick="checkedAll(\'checkall\');" value="'._HONEYPOT_CHECKALL.'" class="inputbutton"/>'._HONEYPOT_CHECKALL.'</button>' , PHP_EOL
		. '<button name="delete" type="submit" id="delete" class="inputbutton" value="'._HONEYPOT_DELETESELECTED.'" onclick="return confirm(\''._HONEYPOT_DELETESELECTED_ANCHOR.'\');">'._HONEYPOT_DELETESELECTED.'</button>' , PHP_EOL
		. '</div>' , PHP_EOL
		. '</form>' , PHP_EOL
		. '<br/>' , PHP_EOL;
	// Check if delete button active, start this
	if (isset($_POST) && isset($_POST['delete'])) {
		$checkbox = $_POST['checkbox'];
		$count = count($checkbox);

		for($i = 0; $i < $count; $i++){
			$id = (int) $checkbox[$i];

				if ($id > 0) {
					$resultds = $db->sql_query("DELETE FROM `".$prefix."_honeypot` WHERE id='".$_POST['checkbox'][$i]."'");
					$db->sql_query('OPTIMIZE TABLE `'.$prefix.'_honeypot`');
				}
			if($resultds){
				Header("Location: admin.php?op=honeypot&search=$nameip");
			}
		}
	}
		CloseTable();

		OpenTable();
		echo '<p class="tiny" style="text-align:center;">Mod Created by coRpSE ' , PHP_EOL
			, '<a href="http://www.headshotdomain.net" title="HeadShotDomain" target="_blank">' , PHP_EOL
			, 'www.headshotdomain.net' , PHP_EOL
			, '</a></p>' , PHP_EOL
			, '<div align="center" style="text-align:center;">' , PHP_EOL
			, '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' , PHP_EOL
			, '<input type="hidden" name="cmd" value="_s-xclick" />' , PHP_EOL
			, '<input type="hidden" name="hosted_button_id" value="FBDV9KVDGAN2E" />' , PHP_EOL
			, '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />' , PHP_EOL
			, '<img style="border:0; width:1px; height:1px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" />' , PHP_EOL
			, '<br /><br />Help support this project, every little bit helps.<br />' , PHP_EOL
			, '</form>' , PHP_EOL
			, '</div>' , PHP_EOL;
		CloseTable();
		}
	}

	function honeypotconfig()
	{
		global $prefix, $db, $admin_file, $bgcolor2;

		$result2 = $db->sql_query("SELECT usehp, botlisting, perpage, pagenumberpos, headcolor, rowcolor1, rowcolor2, pagebgcolor, pagebordercolor, fontcolor, fontcolor2, check1, check2, check3, check4, check5, check6, c7opt1, c7opt2, c7amount, c8opt1, c8opt2, usebsapi, c8apikey, fs9opt1, fs9opt2, fs9apikey, check3time, check4question, check4answer, usefeedback, email, version FROM ".$prefix."_honeypot_config");
		list($usehp, $botlisting, $perpage, $pagenumberpos, $headcolor, $rowcolor1, $rowcolor2, $pagebgcolor, $pagebordercolor, $fontcolor, $fontcolor2, $check1, $check2, $check3, $check4, $check5, $check6, $c7opt1, $c7opt2, $c7amount, $c8opt1, $c8opt2, $usebsapi, $c8apikey, $fs9opt1, $fs9opt2, $fs9apikey, $check3time, $check4question, $check4answer, $usefeedback, $email, $hpversion) = $db->sql_fetchrow($result2);
$hpcss2head = '<style>'."\n";
$hpcss2head .= '	.pothead {'."\n";
$hpcss2head .= '		border:1px solid '.$pagebgcolor .';'."\n";
$hpcss2head .= '	}'."\n";
$hpcss2head .= '	.potlogo p{'."\n";
$hpcss2head .= '		text-shadow: 0 0 15px '.$pagebgcolor .';'."\n";
$hpcss2head .= '	}'."\n";
$hpcss2head .= '	.pot {'."\n";
$hpcss2head .= '		border:1px solid '.$pagebordercolor .';'."\n";
$hpcss2head .= '	}'."\n";
$hpcss2head .= '	td.spacer {'."\n";
$hpcss2head .= '		background-color: '.$bgcolor2.';'."\n";
$hpcss2head .= '	}'."\n";
$hpcss2head .= '	</style>'."\n";
$hpjs2head = '<script>'."\n";
$hpjs2head .= '  nuke_jq(document).ready(function(){'."\n";
$hpjs2head .= '      nuke_jq(\'.img-zoom\').hover(function() {'."\n";
$hpjs2head .= '          nuke_jq(this).addClass(\'transition\');'."\n";
$hpjs2head .= '      }, function() {'."\n";
$hpjs2head .= '          nuke_jq(this).removeClass(\'transition\');'."\n";
$hpjs2head .= '      });'."\n";
$hpjs2head .= '    });'."\n";
$hpjs2head .= '  </script>'."\n";

			addCSSToHead(''.$hpcss2head.'','inline');
			addCSSToHead('./includes/honeypot/css/honeypot_cfg.css','file');
			addJSToBody(''.$hpjs2head.'','inline', true);
			include("header.php");	

		OpenTable();
		echo '<div class="potlogo">' , PHP_EOL
		,'<p>'._HONEYPOT_MAIN.'<br /><img src="./images/honeypot/nukehoneypot.png" height="107px" width="360px" alt="Honeypot Protected">' , PHP_EOL
		,'</p></div>' , PHP_EOL
		,'<div align="center">[ <a href="admin.php?op=honeypot"><strong>'._HONEYPOT_BOTLIST.'</strong></a> ]' , PHP_EOL
		,' &nbsp; -- &nbsp; ' , PHP_EOL
		,'[ <a href="'.$admin_file.'.php">'._HONEYPOT_MAINADMIN.'</a> ]' , PHP_EOL
		,' &nbsp; -- &nbsp; ' , PHP_EOL
		,'[ <a href="admin.php?op=honeypotstats"><strong>HoneyPot Stats</strong></a> ]</div>' , PHP_EOL;
		
	//Version Check and update feed fetcher
		$url = "http://www.headshotdomain.net/script_vchecker/evo-hpchangelog.xml";
	// Check first to see if fopen is allowed
		if (ini_get('allow_url_fopen') == true) 
		{
			$xml = simplexml_load_file($url);
		}
		else
		{
	//If fopen is not allowed, it will try using a CUrl instead.
			function download_page($path)
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$path);
				curl_setopt($ch, CURLOPT_FAILONERROR,1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 15);
				$retValue = curl_exec($ch); 
				curl_close($ch);
				return $retValue;
			}
			$sXML = download_page($url);
	//Check to see if XML failr to retrieve,
			try 
			{
				$xml = new SimpleXMLElement($sXML);
			}
	//If retrieval fails, it will stop from displaying errors and force the fail message
			catch (Exception $e) 
			{
				$xml = "";
			}
		}
		if($xml) 
		{
			$checkerresponse = $xml->latest_version->version;	
				echo '<br /><div id="vchecker">'._HONEYPOT_VERSIONCHECK."</div>" , PHP_EOL;		
			if ($hpversion < $checkerresponse) 
			{
				echo '<div id="vcheckbad">'._HONEYPOT_YOURVERSION , $hpversion , _HONEYPOT_YOURVERSION1 , $checkerresponse , _HONEYPOT_YOURVERSION2.'</div>' , PHP_EOL;
			}else{
				echo '<div id="vcheckgood">'._HONEYPOT_LATESTVERSION , $hpversion.'</div>' , PHP_EOL;
			}
			//End Checker

			echo '<br />' , PHP_EOL;
			//Get changlog info.
			//Version Check to see if your using the latest version of the HoneyPot
			echo '<div style="text-align:center;">'._HONEYPOT_CHANGELOG.'</div><br />' , PHP_EOL;
		}else{
			echo '<div style="text-align:center;">'._HP_XML_ERROR.'</div><br />' , PHP_EOL;
		}
		CloseTable();


	//Checker to see if the installer is still on your site
	if (file_exists('./honeypot-install.php')) 
	{
		OpenTable();
		echo '<p style="font-weight: bold; text-align:center;">'._HONEYPOT_INSTALLCHECK.':</p>' , PHP_EOL
		,'<br>' , PHP_EOL;

			if (file_exists('./includes/honeypot/flash.js')) 
			{
				echo "<script type=\"text/javascript\" src=\"./includes/honeypot/flash.js\"></script>" , PHP_EOL;
			}
		echo"<style type=\"text/css\">
			.blink {
			display: inline;
			}
			</style>" , PHP_EOL
				, '<body onload="blink();">' , PHP_EOL
				, '<span class="blink">', PHP_EOL
				, '<p style="color: #FF0000; text-align:center; font-size:x-large;">'._HONEYPOT_INSTALLCHECKFAIL.'</p>' , PHP_EOL
				, '</span>' , PHP_EOL;
		CloseTable();
	}
	//End Checker


	OpenTable();
	echo '<div style="text-align: center; font-weight:900;">'._HONEYPOT_CONFIGAREA.'<br/></div>', PHP_EOL
	   , '<form action="' , $admin_file , '.php?op=honeypotconfig" method="post">' , PHP_EOL
	   , '<table border="1" cellpadding="2" cellspacing="2" class="centered" style="width:500px">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="width:275px">' , _HONEYPOT_USE , ':</td>' , PHP_EOL
	   , '<td style="width:225px">' , PHP_EOL
	   , '<select name="usehp">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($usehp == $i ? ' selected="selected"' : '') , '>';
		if ($i == 0) {
			echo _HONEYPOT_OFF;
		} elseif ($i == 1) {
			echo _HONEYPOT_ON;
		} 
		echo '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_LISTING , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="botlisting">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($botlisting == $i ? ' selected="selected"' : '') , '>';
		if ($i == 0) {
			echo _HONEYPOT_ACSEND;
		} elseif ($i == 1) {
			echo _HONEYPOT_DESCENDING;
		}
		echo '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_ITEMSPERPAGE  , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="perpage">' , PHP_EOL;
	for ($i=1; $i<=10; ++$i) {
		echo '<option value="' , $i , '"' , ($perpage / 10 == $i ? ' selected="selected"' : '') , '>';
		if ($i == 1) {
			echo '10';
		} elseif ($i == 2) {
			echo '20';
		} elseif ($i == 3) {
			echo '30';
		} elseif ($i == 4) {
			echo '40';
		} elseif ($i == 5) {
			echo '50';
		} elseif ($i == 6) {
			echo '60';
		} elseif ($i == 7) {
			echo '70';
		} elseif ($i == 8) {
			echo '80';
		} elseif ($i == 9) {
			echo '90';
		} elseif ($i == 10) {
			echo '100';
		}
		echo '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_PAGERPOSITION , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="pagenumberpos">' , PHP_EOL;
	for ($i=0; $i<=2; ++$i) {
		echo '<option value="' , $i , '"' , ($pagenumberpos == $i ? ' selected="selected"' : '') , '>';
		if ($i == 0) {
			echo _HONEYPOT_POSITIONTOP;
		} elseif ($i == 1) {
			echo _HONEYPOT_POSITIONBOTH;
		} elseif ($i == 2) {
			echo _HONEYPOT_POSITIONBOTTOM;
		}
		echo '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_HEADCOLOR , ':</td>' , PHP_EOL
	   , '<td> <input type="color" name="headcolor" value="' , $headcolor , '"/></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_ROWCOLOR1 , ':</td>' , PHP_EOL
	   , '<td> <input type="color" name="rowcolor1" value="' , $rowcolor1 , '"/></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_ROWCOLOR2 , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="color" name="rowcolor2" value="' , $rowcolor2 , '"/>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_PAGEBGCOLOR , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="color" name="pagebgcolor" value="' , $pagebgcolor , '" />' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_PAGEBORDERCOLOR , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="color" name="pagebordercolor" value="' , $pagebordercolor , '"/>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_FONTCOLOR , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="color" name="fontcolor" value="' , $fontcolor , '"/>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_FONTCOLOR2 , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="color" name="fontcolor2" value="' , $fontcolor2 , '"/>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK1 , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="check1">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($check1 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK2 , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="check2">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($check2 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK3 , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="check3">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($check3 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK3TIME , ':</td>' , PHP_EOL
	   , '<td>', PHP_EOL
	   , '<select name="check3time">' , PHP_EOL;
	for ($i=1; $i<=12; ++$i) {
		echo '<option value="' , $i , '"' , ($check3time / 5 == $i ? ' selected="selected"' : '') , '>';
		if ($i == 1) {
			echo '5';
		} elseif ($i == 2) {
			echo '10';
		} elseif ($i == 3) {
			echo '15';
		} elseif ($i == 4) {
			echo '20';
		} elseif ($i == 5) {
			echo '25';
		} elseif ($i == 6) {
			echo '30';
		} elseif ($i == 7) {
			echo '35';
		} elseif ($i == 8) {
			echo '40';
		} elseif ($i == 9) {
			echo '45';
		} elseif ($i == 10) {
			echo '50';
		} elseif ($i == 11) {
			echo '55';
		} elseif ($i == 12) {
			echo '60';
		}
		echo '</option>' , PHP_EOL;
	}
	echo '</select>' , _HONEYPOT_SEC , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK4 , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="check4">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($check4 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK4QUESTION , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td><input type="text" name="check4question" value="' , $check4question , '" size="30" maxlength="255" /><br /><em>' , _HONEYPOT_LIMIT ,'</em></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_CHECK4ANSWER , ':</td>' , PHP_EOL
	   , '<td><input type="text" name="check4answer" value="' , $check4answer , '" size="30" maxlength="255" /><br /><em>' , _HONEYPOT_LIMIT ,'</em></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//--------[SPACER]-------------
	echo '<tr>' , PHP_EOL
	   , '<td colspan="2" class="spacer"><br /><br /></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//-----------------------------
	echo '<tr>' , PHP_EOL
	   , '<td>'._HONEYPOT_CHECK7OPTIONS.'</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<table style="width:100%;">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_WHITELISTEMAIL.'</th>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_WHITELISTEIP.'</th>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid">' , PHP_EOL
	   , '<select name="c7opt1">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($c7opt1 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid">' , PHP_EOL
	   , '<select name="c7opt2">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($c7opt2 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '</table>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>'._HONEYPOT_WHITELISTCOUNT.'</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="text" name="c7amount" maxlength="100" value="' , $c7amount , '" />' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//--------[SPACER]-------------
	echo '<tr>' , PHP_EOL
	   , '<td colspan="2" class="spacer"><br /><br /></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//-----------------------------
	echo '<tr>' , PHP_EOL
	   , '<td>'._HONEYPOT_CHECK_5_AND_6.'</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<table style="width:100%;">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_BSEMAIL.'</th>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_BSIP.'</th>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid; border-bottom:1px solid;">' , PHP_EOL
	   , '<select name="check5">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($check5 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid; border-bottom:1px solid;">' , PHP_EOL
	   , '<select name="check6">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($check6 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '</table>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//--------[SPACER]-------------
	echo '<tr>' , PHP_EOL
	   , '<td colspan="2" class="spacer"><br /><br /></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//-----------------------------
	echo '<tr>' , PHP_EOL
	   , '<td width="315px">'._HONEYPOT_CHECK8OPTIONS , PHP_EOL
	   , '<div class="text-center">' , PHP_EOL
	   , '<button type="button" onclick="getAPIkey()" class="text-center">'._HONEYPOT_BSAPIKEYBUTTON.'</button>' , PHP_EOL
	   , '</div>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<table style="width:100%;">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_BSEMAIL.'</th>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_BSIP.'</th>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid; border-bottom:1px solid;">' , PHP_EOL
	   , '<select name="c8opt1">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($c8opt1 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid; border-bottom:1px solid;">' , PHP_EOL
	   , '<select name="c8opt2">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($c8opt2 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '</table>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_BSUSEAPIKEY , '</td>' , PHP_EOL
	   , '<td>', PHP_EOL
	   , '<select name="usebsapi">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($usebsapi == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>'._HONEYPOT_BSAPIKEY.'</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="text" size="30" name="c8apikey" value="' , $c8apikey , '" />' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
	if (!empty($c8apikey)){
		echo '<tr>' , PHP_EOL
		   , '<td bgcolor="#f8ce55" style="color:#000000">' , _HONEYPOT_BSAPITEST , '</td>' , PHP_EOL
		   , '<td class="text-center">' , PHP_EOL
		   , '<button type="button" class="apitest" alt="' , _HONEYPOT_BSAPITESTBUTTONP , '" title="' , _HONEYPOT_BSAPITESTBUTTONP , '" onclick="testAPIkey()">'._HONEYPOT_BSAPITESTBUTTONT.'</button>' , PHP_EOL
		   , '</td>' , PHP_EOL
		   , '</tr>' , PHP_EOL;
	}
//--------[SPACER]-------------
	echo '<tr>' , PHP_EOL
	   , '<td colspan="2" class="spacer"><br /><br /></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//-----------------------------
	echo '<tr>' , PHP_EOL
	   , '<td>'._HONEYPOT_CHECK9OPTIONS.'<br />' , PHP_EOL
	   , '<div class="text-center">' , PHP_EOL
	   , '<button type="button" onclick="getFsAPIkey()" class="text-center">'._HONEYPOT_FSAPIKEYBUTTON.'</button>' , PHP_EOL
	   , '</div>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<table style="width:100%;">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_BSEMAIL.'</th>' , PHP_EOL
	   , '<th class="hpheader">'._HONEYPOT_BSIP.'</th>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid; border-bottom:1px solid;">' , PHP_EOL
	   , '<select name="fs9opt1">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($fs9opt1 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '<td style="border-right:1px solid; border-left:1px solid; border-bottom:1px solid;">' , PHP_EOL
	   , '<select name="fs9opt2">' , PHP_EOL;
	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($fs9opt2 == $i ? ' selected="selected"' : '') , '>' , ($i == 1 ? _HONEYPOT_YES : _HONEYPOT_NO) , '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '</table>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_FSAPIKEY , '</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<input type="text" size="30" name="fs9apikey" value="' , $fs9apikey , '" />' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
	if (!empty($fs9apikey)){
		echo '<tr>' , PHP_EOL
		   , '<td bgcolor="#f8ce55" style="color:#000000">'._HONEYPOT_FSAPITEST.' <img class="img-zoom" src="./images/honeypot/example-fspam.png"/> '._HONEYPOT_FSAPITEST2.'</td>' , PHP_EOL
		   , '<td class="text-center">' , PHP_EOL
		   , '<button type="button" class="apitest" alt="'._HONEYPOT_BSAPITESTBUTTONP.'" title="'._HONEYPOT_BSAPITESTBUTTONP.'" onclick="testFsAPIkey()">'._HONEYPOT_BSAPITESTBUTTONT.'</button>' , PHP_EOL
		   , '</td>' , PHP_EOL
		   , '</tr>' , PHP_EOL;
	}
//--------[SPACER]-------------
	echo '<tr>' , PHP_EOL
	   , '<td colspan="2" class="spacer"><br /><br /></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL;
//-----------------------------
	   echo '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_FEEDBACK , ':</td>' , PHP_EOL
	   , '<td>' , PHP_EOL
	   , '<select name="usefeedback">' , PHP_EOL;
	for ($i=0; $i<=2; ++$i) {
		echo '	<option value="' , $i , '"' , ($usefeedback == $i ? ' selected="selected"' : '') , '>';
		if ($i == 0) {
			echo _HONEYPOT_FEEDBACK1;
		} elseif ($i == 1) {
			echo _HONEYPOT_FEEDBACK2;
		} elseif ($i == 2){
			echo _HONEYPOT_DONTUSE;
		}
		echo '</option>' , PHP_EOL;
	}
	echo '</select>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td>' , _HONEYPOT_ADMIN_EMAIL , ':</td>' , PHP_EOL
	   , '<td> <input type="text" name="email" value="' , $email , '" size="30" maxlength="255" /></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td colspan="2" class="text-center">' , PHP_EOL
	   , '<input type="hidden" name="op" value="honeypotconfigsave" />' , PHP_EOL
	   , '<br /><br />' , PHP_EOL
	   , '<input type="image" src="images/honeypot/button/saveconfig1.png" onmouseover="this.src=\'images/honeypot/button/saveconfig2.png\'" onmouseout="this.src=\'images/honeypot/button/saveconfig1.png\'" style="width:176px; height:49px" alt="Save Info" />' , PHP_EOL
	   , '<br />' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL

	   , '</table>' , PHP_EOL
	   , '</form>' , PHP_EOL

		, "<script>" , PHP_EOL
		, "function getAPIkey() {
			var myWindow = window.open(\"http://botscout.com/getkey.htm\", \"BotScout\", \"width=850, height=600, scrollbars=yes\");
		}" , PHP_EOL
		, "function getFsAPIkey() {
			var myWindow = window.open(\"http://fspamlist.com/index.php?c=register\", \"fspamlist\", \"width=850, height=600, scrollbars=yes\");
		}" , PHP_EOL
		, "function testAPIkey(){
		var win = window.open('http://botscout.com/test/?multi&name=test&mail=test@test.com&ip=123.123.123.123&key=$c8apikey', '1366002941508', 'width=275,height=50,left=600,top=400');
		setTimeout(function(){
		win.close()
		}, 6000);
		return false;
	}" , PHP_EOL
		, "function testFsAPIkey(){
		var win = window.open('http://www.fspamlist.com/api.php?key=$fs9apikey&spammer=test@test.com', '1366002941508',  'width=475,height=250,left=600,top=400');
		setTimeout(function(){
		win.close()
		}, 6000);
		return false;
	}" , PHP_EOL
		, "</script>", PHP_EOL
		, "<div id=\"light\" class=\"white_content\" style=\"text-align:left;\">"._HONEYPOT_EXAMPLE."<div style=\"position: absolute; right: 0; bottom: 0;\"><a href = \"javascript:void(0)\" onclick = \"document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'\"><img src=\"./images/honeypot/button/close.png\"></a></div></div>" , PHP_EOL
		, "<div id=\"fade\" class=\"black_overlay\"></div>" , PHP_EOL

		, "<div id=\"updateinfo\" class=\"update_content\" style=\"text-align:left;\">", PHP_EOL
		, "<div id=\"update_con2\">", PHP_EOL;
		$items = $xml->changelog->update;
		foreach($items as $item) 
		{
			$version= $item->version;
			$date = $item->date;
			$new = $item->changes->new;	
			echo '<div style="background-color:#f8ce55;color:#000;padding:4px;font-weight:900;">'.$version.' - '.$date.'</div>';
			echo '<blockquote>';
			foreach($new as $notes) 
			{
				echo '<div>&#x25cf; '.$notes.'</div>';
			}
			echo '</blockquote>';
		}
		echo "</div>";
		
		echo "<div style=\"position: absolute; right: 0; bottom: 0; z-index:1200;\">
				<a href = \"javascript:void(0)\" onclick = \"document.getElementById('updateinfo').style.display='none';document.getElementById('fade').style.display='none'\"><img src=\"./images/honeypot/button/close.png\"></a>
			</div>";
		echo "</div>";
		
		echo "<div id=\"fade\" class=\"black_overlay\"></div>";
	CloseTable();
	
	OpenTable();
		echo '<div style="text-align:center;">Mod Created by coRpSE ' , PHP_EOL
			, '<a href="http://www.headshotdomain.net" title="HeadShotDomain" target="_blank">www.headshotdomain.net</a></p>' , PHP_EOL
			, '<div align="center" style="text-align:center;">' , PHP_EOL
			, '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">' , PHP_EOL
			, '<input type="hidden" name="cmd" value="_s-xclick" />' , PHP_EOL
			, '<input type="hidden" name="hosted_button_id" value="FBDV9KVDGAN2E" />' , PHP_EOL
			, '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />' , PHP_EOL
			, '<img style="border:0; width:1px; height:1px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" />' , PHP_EOL
			, '<br /><br />Help support this project, every little bit helps.<br />' , PHP_EOL
			, '</form>' , PHP_EOL
			, '</div></div>' , PHP_EOL;
		CloseTable();
	}
	//save config start
	function honeypotconfigsave($usehp, $botlisting, $perpage, $pagenumberpos, $headcolor, $rowcolor1, $rowcolor2, $pagebgcolor, $pagebordercolor, $fontcolor, $fontcolor2, $check1, $check2, $check3, $check4, $check5, $check6, $c7opt1, $c7opt2, $c7amount, $c8opt1, $c8opt2, $usebsapi, $c8apikey, $fs9opt1, $fs9opt2, $fs9apikey, $check3time, $check4question, $check4answer,$usefeedback, $email) {
	include("header.php");
	global $prefix, $db, $module_name;

		$usehp = htmlentities($usehp, ENT_QUOTES);
		$botlisting = htmlentities($botlisting, ENT_QUOTES);
		$perpage = htmlentities($perpage*10, ENT_QUOTES);
		$pagenumberpos = htmlentities($pagenumberpos, ENT_QUOTES);
		$headcolor = htmlentities($headcolor, ENT_QUOTES);
		$rowcolor1 = htmlentities($rowcolor1, ENT_QUOTES);
		$rowcolor2 = htmlentities($rowcolor2, ENT_QUOTES);
		$pagebgcolor = htmlentities($pagebgcolor, ENT_QUOTES);
		$pagebordercolor = htmlentities($pagebordercolor, ENT_QUOTES);
		$fontcolor = htmlentities($fontcolor, ENT_QUOTES);
		$fontcolor2 = htmlentities($fontcolor2, ENT_QUOTES);
		$check1 = htmlentities($check1, ENT_QUOTES);	
		$check2 = htmlentities($check2, ENT_QUOTES);
		$check3 = htmlentities($check3, ENT_QUOTES);
		$check4 = htmlentities($check4, ENT_QUOTES);
		$check5 = htmlentities($check5, ENT_QUOTES);
		$check6 = htmlentities($check6, ENT_QUOTES);
		$c7opt1 = htmlentities($c7opt1, ENT_QUOTES);
		$c7opt2 = htmlentities($c7opt2, ENT_QUOTES);
		$c7amount = htmlentities($c7amount, ENT_QUOTES);
		$c8opt1 = htmlentities($c8opt1, ENT_QUOTES);
		$c8opt2 = htmlentities($c8opt2, ENT_QUOTES);
		$usebsapi = htmlentities($usebsapi, ENT_QUOTES);
		$c8apikey = htmlentities($c8apikey, ENT_QUOTES);
		$fs9opt1 = htmlentities($fs9opt1, ENT_QUOTES);
		$fs9opt2 = htmlentities($fs9opt2, ENT_QUOTES);
		$fs9apikey = htmlentities($fs9apikey, ENT_QUOTES);
		$check3time = htmlentities($check3time*5, ENT_QUOTES);
		$check4question = htmlentities($check4question, ENT_QUOTES);
		$check4answer = htmlentities($check4answer, ENT_QUOTES);
		$usefeedback = htmlentities($usefeedback, ENT_QUOTES);
		$email = htmlentities($email, ENT_QUOTES);

		$db->sql_query("UPDATE ".$prefix."_honeypot_config SET 
		usehp='$usehp',
		botlisting='$botlisting',
		perpage='$perpage',
		pagenumberpos='$pagenumberpos',
		headcolor='$headcolor',
		rowcolor1='$rowcolor1',

		rowcolor2='$rowcolor2',
		pagebgcolor='$pagebgcolor',
		pagebordercolor='$pagebordercolor',
		fontcolor='$fontcolor',
		fontcolor2='$fontcolor2',
		check1='$check1',
		check2='$check2',
		check3='$check3',
		check4='$check4',
		check5='$check5',
		check6='$check6',
		c7opt1='$c7opt1',
		c7opt2='$c7opt2',
		c7amount='$c7amount',
		c8opt1='$c8opt1',
		c8opt2='$c8opt2',
		usebsapi='$usebsapi',
		c8apikey='$c8apikey',
		fs9opt1='$fs9opt1',
		fs9opt2='$fs9opt2',
		fs9apikey='$fs9apikey',
		check3time='$check3time',
		check4question='$check4question',
		check4answer='$check4answer',
		usefeedback='$usefeedback',
		email='$email'", $db);
		Header("Location: admin.php?op=honeypotconfig");
	}
	//save config end
//	include("header.php");
	switch ($op) 
	{
		case "honeypot":
			honeypot();
			break;
		case "honeypotconfig":
			honeypotconfig();
			break;
		case "honeypotconfigsave":
			honeypotconfigsave ($usehp, $botlisting, $perpage, $pagenumberpos, $headcolor, $rowcolor1, $rowcolor2, $pagebgcolor, $pagebordercolor, $fontcolor, $fontcolor2, $check1, $check2, $check3, $check4, $check5, $check6, $c7opt1, $c7opt2, $c7amount, $c8opt1, $c8opt2, $usebsapi, $c8apikey, $fs9opt1, $fs9opt2, $fs9apikey, $check3time, $check4question, $check4answer, $usefeedback, $email);
			break;
		case "honeypotstats":
			honeypotstats();
			break;
	}
	include("footer.php");


} else {
    echo 'Access Denied';
}


function paginate($reload, $page, $tpages, $adjacents) {

	$prevlabel = ""._HONEYPOT_PREV."";
	$nextlabel = ""._HONEYPOT_NEXT."";

	$out = "<div class=\"pagination\" align=\"center\">";

	// previous
	if($page==1) {
	//$out.= "<span>" . $prevlabel . "</span>";
	}
	elseif($page==2) {
		$out.= "<a href=\"" . $reload . "\">" . $prevlabel . "</a>";
	}
	else {
		$out.= "<a href=\"" . $reload . "&page=" . ($page-1) . "\">" . $prevlabel . "</a>";
	}

	// first
	if($page>($adjacents+1)) {
		$out.= "<a href=\"" . $reload . "\">1</a>";
	}

	// interval
	if($page>($adjacents+2)) {
		$out.= "...";
	}

	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span class=\"current\">" . $i . "</span>";
		}
		elseif($i==1) {
			$out.= "<a href=\"" . $reload . "\">" . $i . "</a>";
		}
		else {
			$out.= "<a href=\"" . $reload . "&page=" . $i . "\">" . $i . "</a>";
		}
	}

	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "...";
	}

	// last
	if($page<($tpages-$adjacents)) {
		$out.= "<a href=\"" . $reload . "&page=" . $tpages . "\">" . $tpages . "</a>";
	}

	// next
	if($page<$tpages) {
	$out.= "<a href=\"" . $reload . "&page=" . ($page+1) . "\">" . $nextlabel . "</a>";
	}
	else {
	//$out.= "<span>" . $nextlabel . "</span>";
	}

	$out.= "</div>";

	return $out;
}
//include("footer.php");

?>