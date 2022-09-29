<?php
/*=======================================================================
 PHP-Nuke Titanium v3.0.0
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/* Version 1.0b                                                         */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
	  Titanium Patched                         v3.0.0       08/14/2019
	  Total Redesign                           v3.0.0       08/26/2019
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}

require_once(NUKE_BASE_DIR.'mainfile.php');

$titanium_module_name = basename(dirname(__FILE__));

get_lang($titanium_module_name);

$pagetitle = "- "._ACTIVETOPICS."";

include_once(NUKE_BASE_DIR.'header.php');
title($sitename.' '._ACTIVETOPICS);

OpenTable();

global $fieldset_color, $fieldset_border_width, $digits_color, $titanium_db, $titanium_prefix, $tipath;

$ThemeSel = get_theme();

$sql = "SELECT t.topicid, t.topicimage, t.topictext, count(s.sid) AS stories, SUM(s.counter) AS readcount FROM ".$titanium_prefix."_topics t LEFT JOIN ".$titanium_prefix."_stories s ON (s.topic = t.topicid) GROUP BY t.topicid, t.topicimage, t.topictext ORDER BY t.topictext";

$result = $titanium_db->sql_query($sql);

if ($titanium_db->sql_numrows($result) > 0) 
{
    $output = "<div align=\"center\"><span class=\"title\"><strong>"._ACTIVETOPICS."</strong></span><br />\n";
    $output .= "<span class=\"content\">"._CLICK2LIST."</span><br /><br />\n";
    $output .= "<form action=\"modules.php?name=Search\" method=\"post\">";
    $output .= "<input type=\"text\" name=\"query\" size=\"30\">  ";
    $output .= "<input type=\"submit\" value=\""._SEARCH."\">";
    $output .= "</form></div><br />";
    echo $output;

    while ($row = $titanium_db->sql_fetchrow($result)) 
	{
        $topicid = intval($row['topicid']);
        $topicimage = stripslashes($row['topicimage']);
        $topictext = stripslashes(check_html($row['topictext'], "nohtml"));
        
		if(file_exists("themes/".$ThemeSel."/images/topics/".$topicimage)) 
		{
          $t_image = "themes/".$ThemeSel."/";
        } 
		else 
		{
          $t_image = "";
        }
        $t_image = $t_image.$tipath.$topicimage;
        
		$output  = '<fieldset style="border-color: '.$fieldset_color.'; border-width: '.$fieldset_border_width.'; border-style: solid;">';	
		$output .= '<legend align="center" id="Legend5" runat="server" visible="true" style="width:auto; margin-bottom: 0px; font-size: 18px; font-weight: bold;"><a href="modules.php?name=Blog&amp;new_topic="'.$topicid.'">'.$topictext.'</a></legend>';
		$output .= '<table border="1" width="100%" align="center" cellpadding="2">';
        
        $output .= '<tr>'; 
        $output .= '<td valign="top" width="35%"><a href="modules.php?name=Blog&amp;new_topic="'.$topicid.'"><img src='.$t_image.' border="0" alt='.$topictext.' title='.$topictext.' hspace="5" vspace="5"></a><br /><br />';
        $output .= '<span class="content">';
        $output .= '<img class="icons" align="absmiddle" width="16" src="'.img('topic-16.png','Blog_Topics').'"> <strong>'._TOPIC.' :</strong><a href="modules.php?name=Blog&amp;new_topic="'.$topicid.'"><strong> '.$topictext.'</strong></a><br />';
        $output .= '<img class="icons" align="absmiddle" width="16" src="'.img('topic-blogs-16.png','Blog_Topics').'"> <strong>'._TOTNEWS.' </strong>( <font color="'.$digits_color.'"><strong>'.$row['stories'].'</strong></font> )<br />';
        $output .= '<img class="icons" align="absmiddle" width="16" src="'.img('reads-icon-16.png','Blog_Topics').'"> <strong>'._TOTREADS.' </strong>( <font color="'.$digits_color.'"><strong>'.(isset($row['readcount']) ? $row['readcount'] : 0).'</strong></font> )</span>';
        $output .= '</td><td valign="top">';
        echo $output;

        if ($row['stories'] > 0) 
		{
            $sql2 = "SELECT s.sid, s.catid, s.title, c.title AS cat_title FROM ".$titanium_prefix."_stories s LEFT JOIN ".$titanium_prefix."_stories_cat c ON s.catid=c.catid WHERE s.topic='$topicid' ORDER BY s.sid DESC LIMIT 0,50";
            $result2 = $titanium_db->sql_query($sql2);
        
		    while ($row2 = $titanium_db->sql_fetchrow($result2)) 
			{
                $cat_link = (intval($row2['catid']) > 0) ? "<a href=\"modules.php?name=Blog&amp;file=categories&amp;op=newindex&amp;catid=".intval($row2['catid'])."\"><strong>".stripslashes(check_html($row2['cat_title'], "nohtml"))."</strong></a>: " : "";
                echo '<img class="icons" align="absmiddle" width="16" src="'.img('topic-blogs-16.png','Blog_Topics').'"> '.$cat_link.'<a href="modules.php?name=Blog&amp;file=article&amp;sid='.intval($row2['sid']).'">'.htmlentities($row2['title']).'</a><br />';
            }
            
			if ($row['stories'] > 0) 
			{
                echo '<div align="right"><a href="modules.php?name=Blog&amp;new_topic='.$topicid.'"><strong><img align="absmiddle" height="50" src="'.img('more.png','Blog_Topics').'"></strong></a></div>';
            }
        } 
		else 
		{
            echo "<i>"._NONEWSYET."</i>";
        }

		echo "</td></tr></table></fieldset><br /><br />"; 
		//CloseTable3();
    }
} 
else 
{
  echo "<i>"._NONEWSYET."</i>";
}
echo "<br /><br /><br /><br />";

CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');
?>