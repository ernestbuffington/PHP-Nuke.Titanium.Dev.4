<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
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
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/
/********************************************************/
/* NSN News                                             */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright (c) 2000-2005 by NukeScripts Network         */
/********************************************************/

if (!defined('ADMIN_FILE')) 
   exit ("Access Denied");


global $titanium_prefix, $titanium_db, $admdata;
$titanium_module_name = basename(dirname(dirname(__FILE__)));
if(is_mod_admin($titanium_module_name)) {

include_once(NUKE_INCLUDE_DIR.'nsnne_func.php');
$blog_config = blog_get_configs();

/*********************************************************/
/* Topics Manager Functions                              */
/*********************************************************/

function topicsmanager() 
{
    global $titanium_prefix, $titanium_db, $admin_file, $tipath;

    include(NUKE_BASE_DIR."header.php");

    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
    echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
    CloseTable();
   
    OpenTable();
    echo "<center><span class=\"option\"><strong>"._CURRENTTOPICS . "</strong></span><br />"._CLICK2EDIT . "</span></center><br />"
        ."<table border=\"0\" width=\"100%\" align=\"center\" cellpadding=\"2\">";
    $count = 0;
    $result = $titanium_db->sql_query("SELECT topicid, topicname, topicimage, topictext from " . $titanium_prefix . "_topics order by topicname");
    while ($row = $titanium_db->sql_fetchrow($result)):
        $topicid = intval($row['topicid']);
        $topicname = $row['topicname'];
        $topicimage = $row['topicimage'];
        $topictext = $row['topictext'];
        echo "<td align=\"center\" width='17%' valign='top'>"
            ."<a href=\"".$admin_file.".php?op=topicedit&amp;topicid=$topicid\"><img src=\"$tipath$topicimage\" border=\"0\" alt=\"\" /></a><br />"
            ."<span class=\"content\"><strong>$topictext</td>";
        $count++;

        if($count == 6): 
            echo "</tr><tr>";
            $count = 0;
        endif;
    endwhile;
    echo "</table>";
    CloseTable();

    OpenTable();
    echo "<div align=\"center\"><span class=\"option\"><strong><span class=\"over-ride\">"._ADDATOPIC . "</span></strong></span></div><br />";
    echo "<form action=\"".$admin_file.".php\" method=\"post\">";
    echo "<strong>"._TOPICNAME . ":</strong><br /><span class=\"tiny\">"._TOPICNAME1 . "<br />";
    echo ""._TOPICNAME2 . "</span><br />";
    echo "<input type=\"text\" name=\"topicname\" size=\"20\" maxlength=\"20\" value=\"$topicname\"><br /><br />";
    echo "<strong>"._TOPICTEXT . ":</strong><br /><span class=\"tiny\">"._TOPICTEXT1 . "<br />";
    echo ""._TOPICTEXT2 . "</span><br />";
    echo "<input type=\"text\" name=\"topictext\" size=\"40\" maxlength=\"40\" value=\"$topictext\"><br /><br />";
    echo "<strong>"._TOPICIMAGE . ":</strong><br />";

    # display the topic image using JQuery 
    ?>
    <script>
    $(document).ready(function() {
    $("#imageSelector").change(function() {
        var src = $(this).val();
        $("#imagePreview").html(src ? "<img src=<?php echo $tipath ?>" + src + ">" : "");
    });
    });
    </script>
    <?

    echo "<select id=\"imageSelector\" name=\"topicimage\" required>";
	$handle=opendir($tipath);
    
	while($file = readdir($handle)): 
      if((preg_match("~^([_0-9a-zA-Z]+)([.]{1})([_0-9a-zA-Z]{3})$~",$file)) AND $file != "AllTopics.gif") 
      $tlist .= "$file ";
    endwhile;
    closedir($handle);
    $tlist = explode(" ", $tlist);
    sort($tlist);
    for ($i=0; $i < count($tlist); $i++): 
      if(!empty($tlist[$i])) 
      echo "<option name=\"topicimage\" value=\"$tlist[$i]\">$tlist[$i]\n";
    endfor;
 
    echo "</select>";
	echo '<div align="center" id="imagePreview"></div>';
    echo '<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>';
    
	echo "<input type=\"hidden\" name=\"op\" value=\"topicmake\">";
    
	# 6 pixel spacer
    echo '<div align="center" style="padding-top:6px;">';
    echo '</div>';

	echo "<input type=\"submit\" value=\""._ADDTOPIC . "\">";
    echo "</form>";
	
    # 6 pixel spacer
    echo '<div align="center" style="padding-top:6px;">';
    echo '</div>';
	
    CloseTable();
    include(NUKE_BASE_DIR."footer.php");
}

function topicedit($topicid) 
{
    global $titanium_prefix, $titanium_db, $admin_file, $tipath;

    include(NUKE_BASE_DIR."header.php");

    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">"._TOPICS_ADMIN_HEADER."</a></div>\n";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">"._TOPICS_RETURNMAIN."</a> ]</div>\n";
    echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER."</strong></span></center>";
    CloseTable();
   
    OpenTable();
    
	# 6 pixel spacer
    echo '<div align="center" style="padding-top:6px;">';
    echo '</div>';

    $query = $titanium_db->sql_query("SELECT topicid, topicname, topicimage, topictext from ".$titanium_prefix . "_topics where topicid='$topicid'");
    list($topicid, $topicname, $topicimage, $topictext) = $titanium_db->sql_fetchrow($query);
    $topicid = intval($topicid);
    echo "<img src=\"$tipath$topicimage\" align=\"right\" alt=\"$topictext\" />";
    echo "<span class=\"option\"><strong><span class=\"over-ride\">"._EDITTOPIC.": $topictext</span></strong></span>";
    echo "<form action=\"".$admin_file.".php\" method=\"post\"><br />";
    echo "<strong>"._TOPICNAME.":</strong><br /><span class=\"tiny\">"._TOPICNAME1."<br />";
    echo ""._TOPICNAME2."</span><br />";
    echo "<input type=\"text\" name=\"topicname\" size=\"20\" maxlength=\"20\" value=\"$topicname\"><br /><br />";
    echo "<strong>"._TOPICTEXT.":</strong><br /><span class=\"tiny\">"._TOPICTEXT1."<br />";
    echo ""._TOPICTEXT2."</span><br />";
    echo "<input type=\"text\" name=\"topictext\" size=\"40\" maxlength=\"40\" value=\"$topictext\"><br /><br />";
    echo "<strong>"._TOPICIMAGE.":</strong><br />";

    # display the topic image using JQuery 
    ?>
    <script>
    $(document).ready(function() {
    $("#imageSelector").change(function() {
        var src = $(this).val();
        $("#imagePreview").html(src ? "<img src=<?php echo $tipath ?>" + src + ">" : "");
    });
    });
    </script>
    <?

    echo "<select id=\"imageSelector\" name=\"topicimage\">";
    
	$handle=opendir($tipath);
    
	while ($file = readdir($handle)):
      if ( (preg_match("#^([_0-9a-zA-Z]+)([.]{1})([_0-9a-zA-Z]{3})$#",$file)) AND $file != "AllTopics.gif") 
      $tlist .= "$file ";
    endwhile;
    
	closedir($handle);
    
	$tlist = explode(" ", $tlist);
    
	sort($tlist);
    
	for($i=0; $i < count($tlist); $i++): 
      if(!empty($tlist[$i])): 
        if ($topicimage == $tlist[$i]) 
        $sel = "selected";
        else
        $sel = "";
        echo "<option name=\"topicimage\" value=\"$tlist[$i]\" $sel>$tlist[$i]\n";
      endif;
    endfor;
    echo "</select><br /><br />";
	echo '<div align="center" id="imagePreview"></div>';
    echo '<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>';

    echo "<strong>"._ADDRELATED . ":</strong><br />";
    
	# 6 pixel spacer
	echo '<div align="center" style="padding-top:6px;">';
    echo '</div>';
    
	echo ""._SITENAME . ": <input type=\"text\" name=\"name\" size=\"30\" maxlength=\"30\"><br />";
    
	# 6 pixel spacer
	echo '<div align="center" style="padding-top:6px;">';
    echo '</div>';
	
	echo ""._URL . ": <input type=\"text\" name=\"url\" value=\"http://\" size=\"50\" maxlength=\"200\"><br /><br />";
    echo "<strong>"._ACTIVERELATEDLINKS . ":</strong><br />";
    echo "<table width=\"100%\" border=\"0\">";
    $res = $titanium_db->sql_query("SELECT rid, name, url from ".$titanium_prefix . "_related where tid='$topicid'");
    $num = $titanium_db->sql_numrows($res);
    
	if ($num == 0) 
    echo "<tr><td><span class=\"tiny\">"._NORELATED . "</span></td></tr>";
    
        while($row2 = $titanium_db->sql_fetchrow($res)):
            $rid = intval($row2['rid']);
            $name = $row2['name'];
            $url = stripslashes($row2['url']);
        echo "<tr><td align=\"left\"><span class=\"content\"><strong><big>&middot;</big></strong>&nbsp;&nbsp;<a href=\"$url\">$name</a></td>"
            ."<td align=\"center\"><span class=\"content\"><a 
			href=\"$url\">$url</a></td><td align=\"right\"><span class=\"content\">[ <a 
			href=\"".$admin_file.".php?op=relatededit&amp;tid=$topicid&amp;rid=$rid\">"._EDIT."</a> | <a 
			href=\"".$admin_file.".php?op=relateddelete&amp;tid=$topicid&amp;rid=$rid\">"._DELETE."</a> ]</td></tr>";
       endwhile;
    
	echo "</table><br /><br />"
        ."<input type=\"hidden\" name=\"topicid\" value=\"$topicid\">"
        ."<input type=\"hidden\" name=\"op\" value=\"topicchange\">"
        ."<INPUT type=\"submit\" value=\""._SAVECHANGES."\"> <span class=\"content\">[ <a 
		href=\"".$admin_file.".php?op=topicdelete&amp;topicid=$topicid\">"._DELETE."</a> ]</span>"
        ."</form>";

    # 6 pixel spacer
    echo '<div align="center" style="padding-top:6px;">';
    echo '</div>';

    CloseTable();
    include(NUKE_BASE_DIR."footer.php");
}

function relatededit($tid, $rid) {
    global $titanium_prefix, $titanium_db, $admin_file;
    include(NUKE_BASE_DIR."header.php");
    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
   // echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	//CloseTable();
	
   // OpenTable();
    echo "<center><span class=\"title\"><strong>"._TOPICSMANAGER . "</strong></span></center>";
    CloseTable();
   
    $rid = intval($rid);
    $tid = intval($tid);
    $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT name, url from ".$titanium_prefix . "_related where rid='$rid'"));
        $name = $row['name'];
        $url = $row['url'];
    $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT topictext, topicimage from ".$titanium_prefix . "_topics where topicid='$tid'"));
        $topictext = $row2['topictext'];
        $topicimage = $row2['topicimage'];
    OpenTable();
    echo "<center>"
        ."<img src=\"images/topics/$topicimage\" align=\"right\" alt=\"$topictext\" />"
        ."<span class=\"option\"><strong>"._EDITRELATED . "</strong></span><br />"
        ."<strong>"._TOPIC . ":</strong> $topictext</center>"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        .""._SITENAME . ": <input type=\"text\" name=\"name\" value=\"$name\" size=\"30\" maxlength=\"30\"><br /><br />"
        .""._URL . ": <input type=\"text\" name=\"url\" value=\"$url\" size=\"60\" maxlength=\"200\"><br /><br />"
        ."<input type=\"hidden\" name=\"op\" value=\"relatedsave\">"
        ."<input type=\"hidden\" name=\"tid\" value=\"$tid\">"
        ."<input type=\"hidden\" name=\"rid\" value=\"$rid\">"
        ."<input type=\"submit\" value=\""._SAVECHANGES . "\"> "._GOBACK . ""
        ."</form>";
    CloseTable();
    include(NUKE_BASE_DIR."footer.php");
}

function relatedsave($tid, $rid, $name, $url) {
    global $titanium_prefix, $titanium_db, $admin_file;
    $rid = intval($rid);
    $titanium_db->sql_query("update ".$titanium_prefix . "_related set name='$name', url='$url' where rid='$rid'");
    redirect_titanium($admin_file.".php?op=topicedit&topicid=$tid");
}

function relateddelete($tid, $rid) {
    global $titanium_prefix, $titanium_db, $admin_file;
    $rid = intval($rid);
    $titanium_db->sql_query("delete from ".$titanium_prefix . "_related where rid='$rid'");
    redirect_titanium($admin_file.".php?op=topicedit&topicid=$tid");
}

function topicmake($topicname, $topicimage, $topictext) {
    global $titanium_prefix, $titanium_db, $admin_file;
    $topicname = Fix_Quotes($topicname);
    $topicimage = Fix_Quotes($topicimage);
    $topictext = Fix_Quotes($topictext);
    $titanium_db->sql_query("INSERT INTO ".$titanium_prefix . "_topics VALUES (NULL,'$topicname','$topicimage','$topictext','0')");
    redirect_titanium($admin_file.".php?op=topicsmanager#Add");
}

function topicchange($topicid, $topicname, $topicimage, $topictext, $name, $url) {
    global $titanium_prefix, $titanium_db, $admin_file;
    $topicname = Fix_Quotes($topicname);
    $topicimage = Fix_Quotes($topicimage);
    $topictext = Fix_Quotes($topictext);
    $name = Fix_Quotes($name);
    $url = Fix_Quotes($url);
    $topicid = intval($topicid);
    $titanium_db->sql_query("update ".$titanium_prefix . "_topics set topicname='$topicname', topicimage='$topicimage', topictext='$topictext' where topicid='$topicid'");
    if (!$name) {
    } else {
        $titanium_db->sql_query("insert into ".$titanium_prefix . "_related VALUES (NULL, '$topicid','$name','$url')");
    }
    redirect_titanium($admin_file.".php?op=topicedit&topicid=$topicid");
}

function topicdelete($topicid, $ok=0) {
    global $titanium_prefix, $titanium_db, $blog_config, $admin_file;
    $topicid = intval($topicid);
    if ($ok==1) {
    $row = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT sid from " . $titanium_prefix . "_stories where topic='$topicid'"));
        $sid = intval($row['sid']);
        // Copyright (c) 2000-2005 by NukeScripts Network
        if($blog_config['hometopic'] == $topicid) { blogs_save_config("hometopic", "0"); }
        // Copyright (c) 2000-2005 by NukeScripts Network
        $titanium_db->sql_query("delete from " . $titanium_prefix . "_stories where topic='$topicid'");
        $titanium_db->sql_query("delete from " . $titanium_prefix . "_topics where topicid='$topicid'");
        $titanium_db->sql_query("delete from " . $titanium_prefix . "_related where tid='$topicid'");
    $row2 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT sid from " . $titanium_prefix . "_comments where sid='$sid'"));
        $sid = intval($row2['sid']);
        $titanium_db->sql_query("delete from " . $titanium_prefix . "_comments where sid='$sid'");
        redirect_titanium($admin_file.".php?op=topicsmanager");
    } else {
        global $topicimage;
        include(NUKE_BASE_DIR."header.php");
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
        //echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	   // CloseTable();
	    
        //OpenTable();
        echo "<center><span class=\"title\"><strong>" . _TOPICSMANAGER . "</strong></span></center>";
        CloseTable();
       
    $row3 = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT topicimage, topictext from " . $titanium_prefix . "_topics where topicid='$topicid'"));
        $topicimage = $row3['topicimage'];
        $topictext = $row3['topictext'];
        OpenTable();
        echo "<center><img src=\"images/topics/$topicimage\" alt=\"$topictext\" /><br /><br />"
            ."<strong>" . _DELETETOPIC . " $topictext</strong><br /><br />"
            ."" . _TOPICDELSURE . " <i>$topictext</i>?<br />"
            ."" . _TOPICDELSURE1 . "<br /><br />"
            ."[ <a href=\"".$admin_file.".php?op=topicsmanager\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=topicdelete&amp;topicid=$topicid&amp;ok=1\">" . _YES . "</a> ]</center><br /><br />";
        CloseTable();
        include(NUKE_BASE_DIR."footer.php");
    }
}

switch ($op) {

    case "topicsmanager":
    topicsmanager();
    break;

    case "topicedit":
    topicedit($topicid);
    break;

    case "topicmake":
    topicmake($topicname, $topicimage, $topictext);
    break;

    case "topicdelete":
    topicdelete($topicid, $ok);
    break;

    case "topicchange":
    topicchange($topicid, $topicname, $topicimage, $topictext, $name, $url);
    break;

    case "relatedsave":
    relatedsave($tid, $rid, $name, $url);
    break;

    case "relatededit":
    relatededit($tid, $rid);
    break;

    case "relateddelete":
    relateddelete($tid, $rid);
    break;

}

} 
else 
{
        include(NUKE_BASE_DIR."header.php");
        OpenTable();
	    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=topicsmanager\">" . _TOPICS_ADMIN_HEADER . "</a></div>\n";
       // echo "<br /><br />";
	    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _TOPICS_RETURNMAIN . "</a> ]</div>\n";
	   // CloseTable();

       // OpenTable();
        echo "<center><strong>"._ERROR."</strong><br /><br />You do not have administration permission for module \"$titanium_module_name\"</center>";
        CloseTable();
        include(NUKE_BASE_DIR."footer.php");
}

?>