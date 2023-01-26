<?php
/*
|======================================================================
|	COPYRIGHT (c) 2018 by headshotdomain.net
|	AUTHOR :		coRpSE	
|	WEBSITE :		https://www.headshotdomain.net
|	PROJECT :		ECalendar
|	VERSION :		1.0.0
|======================================================================
*/

if (!defined('ADMIN_FILE')) {
   die('Access Denied');
}
if(!isset($addJStoBody))
$addJStoBody = '';
$addJStoBody .= "\n".'<script>'."\n";
$addJStoBody .= 'nuke_jq(function($) {'."\n";
$addJStoBody .= '    $( "#datepicker" ).datepicker({dateFormat: \'yy/mm/dd\', minDate:0});'."\n";
$addJStoBody .= '  })'."\n";
$addJStoBody .= '</script>'."\n";
addJSToBody($addJStoBody,'inline');
addCSSToHead('./modules/ECalendar/css/astyle.css','file');
global $prefix, $db, $admdata;
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if(is_mod_admin($module_name)) {

/*===================================================
| Main Admin Calendar section
===================================================*/
function main() {
    global $prefix, $db, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();	
	   echo '<div style="text-align:center;"><h2>'._ECALENDAR.'</h2><br>'._ADDED.'<br><br></div>' , PHP_EOL
	   , '<form action="' , $admin_file , '.php?op=ecalendar_add" method="post" autocomplete="off" autocapitalize="off">' , PHP_EOL
	   , '<table cellpadding="2" cellspacing="2" style="width:400px; margin: 0 auto; border:0px;">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<th colspan="2" style="font-size:16px;">'._ADDE.'</th>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="width:100px; text-align:right;">'._TITLE.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<input type="text" name="title" maxlength="150" autofocus="autofocus" required="required">' , PHP_EOL
	   , '<span class="tooltip-html evo-sprite about float-right" title="'._TTITLE.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="text-align:right; width:100px;">'._DATE.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<input type="text" id="datepicker" name="date" placeholder="YYYY/MM/DD" required="required">' , PHP_EOL
	   , '<span class="tooltip-html evo-sprite about float-right" title="'._TDATE.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr><tr>' , PHP_EOL
	   , '<td style="text-align:right; width:100px;">'._REOCCURRING.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<select name="reoccur" >' , PHP_EOL
	   , '<option value="0">'._REOCCUR1.'</option>' , PHP_EOL
	   , '<option value="1">'._REOCCUR2.'</option>' , PHP_EOL
	   , '<option value="2">'._REOCCUR3.'</option>' , PHP_EOL
	   , '</select> ' , PHP_EOL
	   , '<span class="tooltip-html evo-sprite about float-right" title="'._TREOC.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL

	   , '</tr><tr>' , PHP_EOL
	   , '<td style="text-align:right; width:100px;">'._TIME.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<select name="hour">' , PHP_EOL
	   , '<option value="">&nbsp;</option>' , PHP_EOL;
		 for($i=1; $i<=12; $i++)
			{
			echo "<option value=".$i.">".$i."</option>";
			}
       echo ' </select> : ' , PHP_EOL
	   , '<select name="min">' , PHP_EOL
	   , '<option value="00">00</option>' , PHP_EOL
	   , '<option value="15">15</option>' , PHP_EOL
	   , '<option value="30">30</option>' , PHP_EOL
	   , '<option value="45">45</option>' , PHP_EOL
	   , '</select> : ' , PHP_EOL
	   , '<select name="ampm">' , PHP_EOL
	   , '<option value="0">AM</option>' , PHP_EOL
       , '<option value="1">PM</option>' , PHP_EOL
	   , '</select>' , PHP_EOL
	   , '<span class="tooltip-html evo-sprite about float-right" title="'._TALLDAY.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
       , '<tr>' , PHP_EOL
   	   , '<td colspan="2"><div style="width:100%; text-align:center;">' , PHP_EOL
	   , '<input type="submit" name="ecalendar_add" value="'._SUB.'" />' , PHP_EOL
	   , '</div></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '</table>' , PHP_EOL
	   , '</form>' , PHP_EOL
	   , '<br><br>' , PHP_EOL;  // spacer

		events_display();

    CloseTable();

    include_once(NUKE_BASE_DIR.'footer.php');
}


/*===================================================
| Event Edit Section
===================================================*/
function edit_event($eid) {
    global $prefix, $db, $admin_file;

		$result = $db->sql_query("SELECT eid, month, day, year, reoccur, time, ampm, title FROM ".$prefix."_ecalendar WHERE eid = '$eid'");
		list($eid, $month, $day, $year, $reoccur, $time, $ampm, $title) = $db->sql_fetchrow($result);
		addCSSToHead('./modules/ECalendar/css/astyle.css','file');
		$hour = '';
		$min = '';
		if (!empty($time)){ 
		$tarr = str_split($time, strlen($time)/2);
		$hour = $tarr[0];
		$min = $tarr[1];
		}
		$date= $year.'/'.$month.'/'.$day;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();

	   echo '<form action="' , $admin_file , '.php?op=ecalendar_update&amp;eid='.$eid.'" method="post"  autocomplete="off" autocapitalize="off">' , PHP_EOL
	   , '<table cellpadding="2" cellspacing="2" style="width:400px; margin: 0 auto; border:0px;">' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<th colspan="2" style="font-size:16px;">'._ADDE.'</th>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="width:100px; text-align:right;">'._TITLE.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<input type="text" name="title" value="'.$title.'" maxlength="150" autofocus="autofocus">' , PHP_EOL
	   , '<span class="tooltip-interact icon-sprite icon-info" title="'._TTITLE.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '<tr>' , PHP_EOL
	   , '<td style="text-align:right; width:100px;">'._DATE.' sdfg:</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<input type="text" id="datepicker" name="date" value="'.$date.'" placeholder="YYYY/MM/DD">' , PHP_EOL
	   , '<span class="tooltip-interact icon-sprite icon-info" title="'._TDATE.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr><tr>' , PHP_EOL
	   , '<td style="text-align:right; width:100px;">'._REOCCURRING.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<select name="reoccur">' , PHP_EOL;

	   	for ($i=0; $i<=2; ++$i) {
		echo '<option value="' , $i , '" ' . ($reoccur == $i ? ' selected="selected"' : '') . '>';
		if ($i == 0) {
			echo _REOCCUR1;
		} elseif ($i == 1) {
			echo _REOCCUR2;
		} elseif ($i == 2) {
			echo _REOCCUR3;
		}
		echo '</option>' , PHP_EOL;
		}
	   echo ' </select>' , PHP_EOL
	   , '<span class="tooltip-interact icon-sprite icon-info" title="'._TREOC.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr><tr>' , PHP_EOL
	   , '<td style="text-align:right; width:100px;">'._TIME.':</td>' , PHP_EOL
	   , '<td style="text-align:center;">' , PHP_EOL
	   , '<select name="hour">' , PHP_EOL
	   , '<option value="">&nbsp;</option>' , PHP_EOL;
		 for($i=1; $i<=12; $i++)
			{
			echo "<option value='".$i."' ". ($hour == $i ? ' selected="selected"' : '') .">".$i."</option>";
			}
       echo ' </select> : ' , PHP_EOL
	   , '<select name="min">' , PHP_EOL
	   , '<option value="00" '. ($min == '00' ? 'selected="selected"' : '') .'>00</option>' , PHP_EOL
	   , '<option value="15" '. ($min == '15' ? 'selected="selected"' : '') .'>15</option>' , PHP_EOL
	   , '<option value="30" '. ($min == '30' ? 'selected="selected"' : '') .'>30</option>' , PHP_EOL
	   , '<option value="45" '. ($min == '45' ? 'selected="selected"' : '') .'>45</option>' , PHP_EOL
	   , '</select> : ' , PHP_EOL

	   , '<select name="ampm">' , PHP_EOL;	   
	   	for ($i=0; $i<=1; ++$i) {
		echo '<option value="' , $i , '"' , ($ampm == $i ? ' selected="selected"' : '') , '>';
		if ($i == 0) {
			echo "AM";
		} elseif ($i == 1) {
			echo "PM";
		}
		echo '</option>' , PHP_EOL;
	}
	   echo  '</select>' , PHP_EOL
	   , '<span class="tooltip-interact icon-sprite icon-info" title="'._TALLDAY.'"></span>' , PHP_EOL
	   , '</td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
       , '<tr>' , PHP_EOL
   	   , '<td colspan="2"><div style="width:100%; text-align:center;">' , PHP_EOL
	   , '<input type="submit" name="ecalendar_update" value="'._SUB.'" />' , PHP_EOL
	   , '</div></td>' , PHP_EOL
	   , '</tr>' , PHP_EOL
	   , '</table>' , PHP_EOL
	   , '</form>' , PHP_EOL;

	events_display();

    CloseTable();

    include_once(NUKE_BASE_DIR.'footer.php');
}


/*===================================================
| Events Display Section
===================================================*/
function events_display() {
	global $prefix, $db, $admin_file;
	$count_events = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ecalendar"));
	if(!isset($_GET['page']))
	$_GET['page'] = '';
	$pagination = new Paginator($_GET['page'],$count_events);
	$pagination->set_Limit(10);
	$pagination->set_Links(3);
	$limit1 = $pagination->getRange1();
	$limit2 = $pagination->getRange2();

        $result = $db->sql_query("SELECT eid, month, day, year, reoccur, time, ampm, title FROM ".$prefix."_ecalendar ORDER by `eid` ASC  LIMIT ".$limit1.", ".$limit2);
		echo '<div style="width:100%; overflow-y: auto; overflow-x: hidden; max-height: 800px;">' , PHP_EOL
		, '<table style="width:80%; margin: 0 auto;" border="0" cellpadding="2" cellspacing="2" class="forumline" align="center">' , PHP_EOL
		, '<tr>' , PHP_EOL
		, '<th class="catHead" style="width: 100px; font-size:14px;">'._DATE.'</th>' , PHP_EOL
		, '<th class="catHead" style="font-size:14px;">'._TITLE.'</th>' , PHP_EOL
		, '<th class="catHead" style="width: 100px; font-size:14px;">'._TIME.'</th>' , PHP_EOL
		, '<th class="catHead" style="width: 150px; font-size:14px;">'._REOCCURRING.'</th>' , PHP_EOL
		, '<th class="catHead" style="width:50px; font-size:14px;">&nbsp;</th>' , PHP_EOL
		, '</tr>' , PHP_EOL;
        if ($db->sql_numrows($result) > 0) {
            while (list($eid, $month, $day, $year, $reoccur, $time, $ampm, $title) = $db->sql_fetchrow($result)) {
				$x++;
				$bgcolor = ($x%2 == 0) ? 'row2' : 'row3';
				$ampm = ($ampm == 0) ? 'AM' : 'PM';
				if ($reoccur == '0'){ $treocc = _REOCCUR1; }else if($reoccur == '1'){ $treocc =  _REOCCUR2; }else{$treocc =  _REOCCUR3;}
				$edate = $month.'/'.$day.'/'.$year;
				$date = $year.$month.$day;
				$times = (!empty($time)) ? $time .' '. $ampm : 'All Day';
				$today = date("Ymd") - 1;
		        echo '<tr>' , PHP_EOL
				, '<td class="'.$bgcolor.'">'.$edate.'</td>' , PHP_EOL
				, '<td class="'.$bgcolor.'">'.$title.'</td>' , PHP_EOL
				, '<td class="'.$bgcolor.'">'.$times.'</td>' , PHP_EOL
				, '<td class="'.$bgcolor.'">'.$treocc.'</td>' , PHP_EOL
				, '<td class="'.$bgcolor.'">' , PHP_EOL
				  , '<div class="eddel_container">' , PHP_EOL
				  , '<a href="'.$admin_file.'.php?op=ecalendar_edit&amp;eid='.$eid.'">' . get_evo_icon('evo-sprite edit tooltip', _EDIT_EVENT) . '</a>' , PHP_EOL
				  , '<a href="'.$admin_file.'.php?op=ecalendar_del&amp;eid='.$eid.'">'.get_evo_icon('evo-sprite delete tooltip', _DEL_EVENT).'</a>' , PHP_EOL
				  , '</div>' , PHP_EOL
				, '</td>' , PHP_EOL
				, '</tr>' , PHP_EOL;

				$today = date("Ymd");
				if (($today > $date) && ($reoccur == 0)){
					$result = $db->sql_query("DELETE FROM `".$prefix."_ecalendar` WHERE eid = '$eid'");
				}
            }
			echo '</table>' , PHP_EOL;
			echo '<br />' , PHP_EOL;
	      } else {
			    echo '<tr>' , PHP_EOL;
				echo '<td class="row2" colspan="5" style="width: 80%; text-align: center; font-weight: bold;">' , PHP_EOL;
				echo '-- '._NOE.' --' , PHP_EOL;
				echo '</td>' , PHP_EOL;
				
				echo '</tr>' , PHP_EOL;
				echo '</table>' , PHP_EOL;
        }
		echo '</div>' , PHP_EOL;
		$db->sql_freeresult($result);
				if($count_events > 10)
		{
			if ($pagination->getCurrent() == 1)
				$first = ' | '._EFIRST.' | ';
			else
				$first = ' | <a href="' . $admin_file . '.php?op=ecalendar&amp;page='.$pagination->getFirst().'">'._EFIRST.'</a> |';

			if ($pagination->getPrevious())
				$prev = '<a href="' . $admin_file . '.php?op=ecalendar&amp;page='.$pagination->getPrevious().'">'._EPREV.'</a> | ';
			else
				$prev = _EPREV.' | ';

			if ($pagination->getNext())
				$next = '<a href="' . $admin_file . '.php?op=ecalendar&amp;page='.$pagination->getNext().'">'._ENEXT.'</a> | ';
			else
				$next = _ENEXT.' | ';

			if ($pagination->getLast())
				$last = '<a href="' . $admin_file . '.php?op=ecalendar&amp;page='.$pagination->getLast().'">'._ELAST.'</a>';
			else
				$last = _ELAST;

			echo _EVENTS .' '.$pagination->getFirstOf().' to '.$pagination->getSecondOf().' of '.$pagination->getTotalItems().' '.$first." ".$prev." ".$next." ".$last;
		} else {
			echo '&nbsp;';
		}
}

/*===================================================
| Event Delete Function
===================================================*/
function remove_event($eid){
    global $prefix, $db, $admin_file;
	$eid = intval($eid);
    $result = $db->sql_query("DELETE FROM `".$prefix."_ecalendar` WHERE eid = '$eid'");
	redirect($admin_file.".php?op=ecalendar");
}

/*===================================================
| Event Add/Save Function
===================================================*/
function add_event() {
    global $prefix, $db, $admin_file;
	$date = $_POST['date'];
	$date = str_replace('/','',$date);
	$month = date("m", strtotime($date));
	$day =  date("d", strtotime($date));
	$year =  date("Y", strtotime($date));
	$reoccur = $_POST["reoccur"];
	if (!empty($_POST['hour'])){
	$time = $_POST['hour'].":".$_POST['min'];
	}else{
	$time = "";
	}
	$ampm = $_POST['ampm'];
	$title = htmlentities($_POST['title'], ENT_QUOTES);
	$result = $db->sql_query("INSERT INTO `".$prefix."_ecalendar`(`month`, `day`, `year`, `reoccur`, `time`, `ampm`, `title`) VALUES ('".$month."', '".$day."', '".$year."', '".$reoccur."', '".$time."', '".$ampm."', '".$title."')");
	include_once(NUKE_BASE_DIR.'header.php');
		if(!$result) {

				OpenTable();
    				echo '<div style="text-align:center;"><strong>'._ERR.'</strong><br />', PHP_EOL
    				   , '<a href="'.$admin_file.'.php?op=ecalendar">'._GOBACK.'</div>' , PHP_EOL;
    			CloseTable();
  		} else {
			OpenTable();
				header("Refresh: 1; url='".$admin_file.".php?op=ecalendar'");
        		echo '<div style="text-align:center;">'._ESUCCESS.'</div>' , PHP_EOL
				   , '<br /><br />' , PHP_EOL
				   , '<div align="center">'._PWAIT.'</div>' , PHP_EOL;
			CloseTable();
  }

		include_once(NUKE_BASE_DIR.'footer.php');
}


/*===================================================
| Event Edit Save Section
===================================================*/

function update_event($eid) {
    global $prefix, $db, $admin_file;
	$date = $_POST['date'];
	$date = str_replace('/','',$date);
	$month = date("m", strtotime($date));
	$day =  date("d", strtotime($date));
	$year =  date("Y", strtotime($date));
	if (!empty($_POST['hour'])){
	$time = $_POST['hour'].":".$_POST['min'];
	}else{
	$time = "";
	}
	$reoccur = $_POST["reoccur"];
	$ampm = $_POST['ampm'];
	$title = htmlentities($_POST['title'], ENT_QUOTES);
 $db->sql_query("UPDATE `".$prefix."_ecalendar` SET `day` = '".$day."', `month` = '".$month."', `year` = '".$year."', `reoccur` = '".$reoccur."', `time` = '".$time."', `ampm` = '".$ampm."', `title` = '".$title."' WHERE eid = '$eid'");
	redirect($admin_file.".php?op=ecalendar");
}
/*===================================================
| End of ECalendar Functions
===================================================*/
switch ($op){
	case "ecalendar":
	main();
	break;

	case "ecalendar_del":
	remove_event($eid);
	break;

	case "ecalendar_edit":
	edit_event($eid);
	break;

	case "ecalendar_update":
	update_event($eid);
	break;

    case "ecalendar_add":
        add_event();
    break;
}

} else {
    DisplayError("<strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$module_name\"");
}

?>