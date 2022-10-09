<?php
/*
|======================================================================
|	COPYRIGHT (c) 2018 by headshotdomain.net
|	AUTHOR :				coRpSE
|	WEBSITE :				https://www.headshotdomain.net
|	PROJECT :				ECalendar
|	VERSION :				1.0.0
|======================================================================
*/
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
}
global $prefix, $db;

get_lang("ECalendar");
$cal_center = ($side == 'c' || $side == 'd') ? "0" : "1";
$bstyle = ($cal_center == 1) ? 'bside' : 'bcenter';
$ThemeSel = get_theme();
$themepath = './themes/'.$ThemeSel.'/style/ECalendar/'.$bstyle.'-style.css';
$style_path = (!file_exists($themepath)) ? './modules/ECalendar/css/' : './themes/'.$ThemeSel.'/style/ECalendar/';
$content = '<link rel="stylesheet" type="text/css" href="'.$style_path.$bstyle.'-style.css" media="screen" />' . PHP_EOL;

    $month = date("m");
    $year = date("Y");
    $days_of_week = array('S','M','T','W','Th','F','S');
    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $date_info = getdate(strtotime('first day of', mktime(0,0,0,$month,1,$year)));
    $day_of_week = $date_info['wday'];
	$today = date("d");
	$content .= '<div id="cwraper">' . PHP_EOL;
	$content .= '<div id="cbody">' . PHP_EOL;
    $content .= '<table class="calendar">' . PHP_EOL;
    $content .= '<tr><td class="header" colspan="7"><a href="./modules.php?name=ECalendar">' . $date_info['month'] . ' ' . $year . '</a></td></tr>' . PHP_EOL;
    $content .= '<tr>' . PHP_EOL;
    foreach ( $days_of_week as $day ) {
      $content .= '<th class="cheader">' . $day . '</th>' . PHP_EOL;
    }

    $content .= '</tr><tr>';
    if ( $day_of_week > 0 ) {
      $content .= '<td colspan="' . $day_of_week . '"></td>' . PHP_EOL;
    }

    // Start num_days counter
    $current_day = 1;
    // Loop and build days
    while ( $current_day <= $num_days ) {
      if ( $day_of_week == 7 ) {
        $day_of_week = 0;
        $content .= '</tr><tr>' . PHP_EOL;
      }

		$sql = 'WHERE `day`= '.$current_day.' AND `month` = '.$month.' AND `year` = '.$year.' AND  `reoccur` = \'0\' OR (`day` = '.$current_day.' AND `reoccur` = \'1\') OR (`day` = '.$current_day.' AND `month` = '.$month.' AND `reoccur` = \'2\')';
	  	$result = $db->sql_query("SELECT eid FROM ".$prefix."_ecalendar ".$sql);
	    if ($db->sql_numrows($result) > 0) {
			$et ='<a data-fancybox data-animation-duration="700" data-src="#animatedModal'.$current_day.'" href="" class="btn btn-primary">' . PHP_EOL;
			$et .='<div class="event">' . PHP_EOL;
			$et .='<div id="animatedModal'.$current_day.'" class="animated-modal">' . PHP_EOL;
			$et .='<h2>'._TODEVENTS.'</h2><br>' . PHP_EOL;
			$et .='<div style="overflow-y: auto; overflow-x: hidden; max-height: 300px;">' . PHP_EOL;
			$result = $db->sql_query("SELECT `eid`, `month`, `day`, `year`, `reoccur`, `time`, `ampm`, `title` FROM ".$prefix."_ecalendar ".$sql." ORDER by `eid` DESC");
			while (list($eid, $emonth, $eday, $eyear, $reoccur, $time, $ampm, $title) = $db->sql_fetchrow($result)) {
			$date = $eyear.$emonth.$eday;
			// Remove past events
				$tdate = date("Ymd") - 1;
				if (($tdate > $date) && ($reoccur == 0)){
					$result = $db->sql_query("DELETE FROM `".$prefix."_ecalendar` WHERE eid = '$eid'");
				}
			// End
				$ampm = ($ampm == 0) ? 'AM' : 'PM';
				$dedate = $emonth.'/'.$eday.'/'.$year;
				$times = (!empty($time)) ? $time .' '. $ampm : 'All Day';
				if ($reoccur == '0'){ $treocc = _REOCCUR1; }else if($reoccur == '1'){ $treocc =  _REOCCUR2; }else{$treocc =  _REOCCUR3;}
				$et .='-----------------------------------------------------<br>' . PHP_EOL;
				$et .='<table style="1px solid;" align="center">' . PHP_EOL;
				$et .='<tr><td style="width:75px;"><strong>'._ETITLE.':</strong></td><td style="width:300px;">'.$title.'</td></tr>' . PHP_EOL;
				$et .='<tr><td style="width:75px;"><strong>'._ET.':</strong></td><td style="width:300px;">'.$times.'</td></tr>' . PHP_EOL;
				$et .='<tr><td style="width:75px;"><strong>'._EDATE.':</strong></td><td style="width:300px;">'.$dedate . PHP_EOL;
				$et .='&nbsp;<span style="font-size: smaller; color:#FF0000;">'._DATEPAT.'</span></td></tr>' . PHP_EOL;
				$et .='<tr><td style="width:75px;"><strong>'._REOCCURRING.':</strong></td><td style="width:300px;">'.$treocc.'</td></tr>' . PHP_EOL;
				$et .='</table>' . PHP_EOL;
				$x++;
			}
			$et .='-----------------------------------------------------' . PHP_EOL;
			$et .='</div></div>' . PHP_EOL;
			$event = $et;
		}else{
			$event = '<div>' . PHP_EOL;
		}
		$content .= ($today == $current_day) ? '<td class="today">' . $event . $current_day . '</div></td>' : '<td class="day">' . $event .  $current_day . '</div></td>' . PHP_EOL;
		$current_day++;
		$day_of_week++;
	}
	if ( $day_of_week != 7 ) {
		$remaining_days = 7 - $day_of_week;
		$content .= '<td colspan="'. $remaining_days .'"></td>' . PHP_EOL;
	}
	$content .= '</tr>' . PHP_EOL;
	$content .= '</table>' . PHP_EOL;
	$content .= '</div>' . PHP_EOL;
	$content .= '</div>' . PHP_EOL;
  ?>