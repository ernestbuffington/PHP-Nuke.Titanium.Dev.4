<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('NUKE_EVO')) {
    die('You can\'t access this file directly...');
}

global $prefix, $db, $content, $pollcomm, $user, $userinfo, $cookie, $multilingual, $currentlang, $evoconfig, $cache, $identify;

// Fetch random poll
$make_random = (int) $evoconfig['poll_random'];

// Fetch number of days in between voting per user
$number_of_days = (int) $evoconfig['poll_days'];

$querylang = ($multilingual == 1) ? "WHERE (planguage='$currentlang' OR planguage='') AND artid='0'" : "WHERE artid='0'";
$queryorder = ($make_random !== 0) ? 'RAND()' : 'pollID DESC';

$pollID = (isset($_REQUEST['pollID'])) ? (int)$_REQUEST['pollID'] : '';

if(isset($pollID) && is_numeric($pollID)) {
    $result = $db->sql_query("SELECT pollID, pollTitle, voters FROM ".$prefix."_poll_desc WHERE `pollID`=".(int) $pollID);
} else {
    $result = $db->sql_query("SELECT pollID, pollTitle, voters FROM ".$prefix."_poll_desc $querylang ORDER BY $queryorder LIMIT 1");
}

if ($db->sql_numrows($result) < 1) {
    $content = "<br />"._NOSURVEYS."<br /><br />";
} else {
    [$pollID, $pollTitle, $voters] = $db->sql_fetchrow($result);
    $db->sql_freeresult($result);
    $pollTitle = stripslashes((string) $pollTitle);
    $url = "modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID";
    //$sum = "";
    $button = "";
    $content = "<span class=\"content\"><strong>$pollTitle</strong></span><br /><br />\n";
    $content .= '<form action="modules.php?name=Surveys" method="post">';
    $content .= '<table border="0" cellpadding="2" cellspacing="0" width="100%">';

    $ip = $identify->get_ip();
    $past = time()-86400*$number_of_days;
    $result = $db->sql_query("SELECT ip FROM ".$prefix."_poll_check WHERE ip='$ip' AND pollID='$pollID'");
    $result2 = $db->sql_query("SELECT optionText, voteID, optionCount FROM ".$prefix."_poll_data WHERE pollID='$pollID' AND optionText!='' ORDER BY voteID");

	if(!isset($sum))
	$sum = 0;

	if(!isset($percent))
	$percent = 0;

    if ($db->sql_numrows($result) > 0) {
        while ($row = $db->sql_fetchrow($result2)) {
            $options[] = $row;
            if($sum > 0):
			  $sum += (int)$row['optionCount'];
			endif;
        }
        $ThemeSel = get_theme();
        $leftbar = file_exists("themes/$ThemeSel/images/survey_leftbar.gif") ? 'survey_leftbar.gif' : 'leftbar.gif';
        $mainbar = file_exists("themes/$ThemeSel/images/survey_mainbar.gif") ? 'survey_mainbar.gif' : 'mainbar.gif';
        $rightbar = file_exists("themes/$ThemeSel/images/survey_rightbar.gif") ? 'survey_rightbar.gif' : 'rightbar.gif';
        $l_size = getimagesize("themes/$ThemeSel/images/$leftbar");
        $m_size = getimagesize("themes/$ThemeSel/images/$mainbar");
        $r_size = getimagesize("themes/$ThemeSel/images/$rightbar");
        if (file_exists("themes/$ThemeSel/images/survey_mainbar_d.gif")) $mainbar_d = 'survey_mainbar_d.gif';
        if (isset($mainbar_d)) $m1_size = getimagesize("themes/$ThemeSel/images/$mainbar_d");

        foreach ($options as $option) {
            if($sum > 0):
			  $percent = (100 / $sum * $option['optionCount']);
			endif;
            $percentInt = (int)$percent * .85;
            $percent2 = (int)$percent;
            $content .= "<tr><td>$option[optionText]<br />";
            $content .= "<img src=\"themes/$ThemeSel/images/$leftbar\" height=\"$l_size[1]\" width=\"$l_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            if ($percent > 0) {
                $content .= "<img src=\"themes/$ThemeSel/images/$mainbar\" height=\"$m_size[1]\" width=\"$percentInt%\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            } elseif (!isset($mainbar_d)) {
                $content .= "<img src=\"themes/$ThemeSel/images/$mainbar\" height=\"$m_size[1]\" width=\"$m_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\">";
            }
            $content .= "<img src=\"themes/$ThemeSel/images/$rightbar\" height=\"$r_size[1]\" width=\"$r_size[0]\" alt=\"$percent2 %\" title=\"$percent2 %\"><br />";
            $content .= "</td></tr>\n";
        }
        $button = '';
    }
    else {
        
		while ($row = $db->sql_fetchrow($result2)) 
		{
            $content .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$row['voteID']."\"></td><td width=\"100%\"><span class=\"content\">".$row['optionText']."</span></td></tr>\n";
			$sum += (int) $row['optionCount'];
        }
        
		$button .= '<input type="hidden" name="pollID" value="'.$pollID.'">';
        $button .= '<input type="hidden" name="forwarder" value="'.$url.'">';
        $button .= '<input type="submit" value="'._VOTE.'"><br /><br />';
    }
    $db->sql_freeresult($result2);

    $content .= "</table><br /><center>$button
    <span class=\"content\"><a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=$cookie[4]&amp;order=$cookie[5]&amp;thold=$cookie[6]\"><strong>"._RESULTS."</strong></a><br />
    <a href=\"modules.php?name=Surveys\"><strong>"._POLLS."</strong></a><br />
    <br />"._VOTES." <strong>$sum</strong>\n";
    if ($pollcomm) {
        $result = $db->sql_query("SELECT COUNT(*) FROM ".$prefix."_pollcomments WHERE pollID='$pollID'");
        [$numcom] = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
        $content .= "<br /> "._PCOMMENTS." <strong>$numcom</strong>\n";
    }
    $content .= "</span></center></form>\n";
}

?>
