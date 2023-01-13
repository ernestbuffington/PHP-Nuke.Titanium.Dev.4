<?php

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));

$ThemeSel = get_theme();
$themepath = './themes/'.$ThemeSel.'/style/ECalendar/style.css';
$style_path = (!file_exists($themepath)) ? './modules/'.$module_name.'/css/' : './themes/'.$ThemeSel.'/style/ECalendar/';

addCSSToHead($style_path.'style.css','file');
get_lang($module_name);

include_once(NUKE_BASE_DIR.'header.php');
global $prefix, $db;
title($sitename.' '.'eCalendar');
OpenTable();

$month = '';
$year = '';

if(!isset($_GET['month']))
$_GET['month'] = '';

if(!isset($_GET['year']))
$_GET['year'] = '';

$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));

/* "next month" control */
$rcontrol = '<span style="float:right; font-size:11px;"><a href="modules.php?name=ECalendar&month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month &raquo;</a>&nbsp;&nbsp;</span>';

/* "previous month" control */
$lcontrol = '<span style="float:left; font-size:11px;"><a href="modules.php?name=ECalendar&month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control">&nbsp;&nbsp;&laquo; 	Previous Month</a></span>';

    $days_of_week = array('S','M','T','W','Th','F','S');
    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $date_info = getdate(strtotime('first day of', mktime(0,0,0,$month,1,$year)));
    $day_of_week = $date_info['wday'];
	$today = date("d");
	echo '<div id="cwraperm">' . PHP_EOL;
	echo '<div id="cbodym">' . PHP_EOL;
    echo '<table class="calendarm">' . PHP_EOL;
    echo '<tr> <td class="headerm" colspan="7">'. $lcontrol.' ' . $date_info['month'] . ' ' . $year .  ' '. $rcontrol.'</td> </tr>' . PHP_EOL;
    echo '<tr>' . PHP_EOL;
    foreach ( $days_of_week as $day ) {
      echo '<th class="cheaderm">' . $day . '</th>' . PHP_EOL;
    }

    echo '</tr><tr>';
    if ( $day_of_week > 0 ) {
      echo '<td colspan="' . $day_of_week . '"></td>' . PHP_EOL;
    }

    // Start num_days counter
    $current_day = 1;

    // Loop and build days
    while ( $current_day <= $num_days ) {
      if ( $day_of_week == 7 ) {
        $day_of_week = 0;
        echo '</tr><tr>' . PHP_EOL;
      }
 	//Main SQL call for the information for the day and also for the reoccuring event.
		$sql = 'WHERE `day`= '.$current_day.' AND `month` = '.$month.' AND `year` = '.$year.' AND  `reoccur` = \'0\' OR (`day` = '.$current_day.' AND `reoccur` = \'1\') OR (`day` = '.$current_day.' AND `month` = '.$month.' AND `reoccur` = \'2\')';
	  	$result = $db->sql_query("SELECT eid FROM ".$prefix."_ecalendar ".$sql);
	    if ($db->sql_numrows($result) > 0) {
	        $et ='<a data-fancybox data-animation-duration="700" data-src="#animatedModalm'.$current_day.'" href="" class="btn btn-primary">' . PHP_EOL;
			$et .='<div class="eventm">' . PHP_EOL;
			$et .='<div id="animatedModalm'.$current_day.'" class="animated-modalm">' . PHP_EOL;
         	$et .='<h2>'._TODEVENTS.'</h2><br>' . PHP_EOL;
			$et .='<div style="overflow-y: auto; overflow-x: hidden; max-height: 300px;">' . PHP_EOL;

			$result = $db->sql_query("SELECT `eid`, `month`, `day`, `year`, `reoccur`, `time`, `ampm`, `title` FROM ".$prefix."_ecalendar ".$sql." ORDER by `eid` DESC");
	        while (list($eid, $emonth, $eday, $eyear, $reoccur, $time, $ampm, $title) = $db->sql_fetchrow($result)) {
			
				$date = $eyear.$emonth.$eday;
			// Remove past events
				$today = date("Ymd") - 1;
	 			if (($today > $date) && ($reoccur == 0)){
					$result = $db->sql_query("DELETE FROM `".$prefix."_ecalendar` WHERE eid = '$eid'");
	 			}
			// End				
				$ampm = ($ampm == 0) ? 'AM' : 'PM';
				$dedate = $emonth.'/'.$eday.'/'.$year;

				$times = (!empty($time)) ? $time .' '. $ampm : 'All Day';
				$today = date("Ymd") - 1;
				if ($reoccur == '0'){ $treocc = _REOCCUR1; }else if($reoccur == '1'){ $treocc =  _REOCCUR2; }else{$treocc =  _REOCCUR3;}
				$et .='-----------------------------------------------------<br>' . PHP_EOL;
       			$et .='<table style="1px solid;" align="center">' . PHP_EOL;
          		$et .='<tr><td style="width:75px;"><strong>'._ETITLE.':</strong></td><td style="width:300px;">'.$title.'</td></tr>' . PHP_EOL;
          		$et .='<tr><td style="width:75px;"><strong>'._ET.':</strong></td><td style="width:300px;">'.$times.'</td></tr>' . PHP_EOL;
          		$et .='<tr><td style="width:75px;"><strong>'._EDATE.':</strong></td><td style="width:300px;">'.$dedate . PHP_EOL;
				$et .='&nbsp;<span style="font-size: smaller; color:#FF0000;">'._DATEPAT.'</span></td></tr>' . PHP_EOL;
				$et .='<tr><td style="width:75px;"><strong>'._REOCCURRING.':</strong></td><td style="width:300px;">'.$treocc.'</td></tr>' . PHP_EOL;
          		$et .='</table>' . PHP_EOL;
				//$x++; < what the fuck was this X for???
      	    }
			$et .='-----------------------------------------------------' . PHP_EOL;
		  $et .='</div></div>' . PHP_EOL;
		  $event = $et;
	   }else{
		  $event = '<div>' . PHP_EOL;
	   }

	  echo ($today == $current_day) ? '<td class="todaym">' : '<td class="daym">';
	  echo $event .  $current_day . '</div></td>' . PHP_EOL;
      $current_day++;
      $day_of_week++;
    }

    if ( $day_of_week != 7 ) {
      $remaining_days = 7 - $day_of_week;
      echo '<td colspan="'. $remaining_days .'"></td>' . PHP_EOL;
    }
    echo '</tr>' . PHP_EOL;
    echo '</table>' . PHP_EOL;
	echo '</div>' . PHP_EOL;
	echo '</div>' . PHP_EOL; 
   CloseTable();
include_once(NUKE_BASE_DIR.'footer.php');

?>