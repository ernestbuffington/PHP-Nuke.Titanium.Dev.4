<?php

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/

$bgcolor1 = "#474646";
$bgcolor2 = "#474646";
$bgcolor3 = "#474646";
$bgcolor4 = "#474646";
$textcolor1 = "#FFFFFF";
$textcolor2 = "#FFFFFF";

/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/************************************************************/
function OpenTable3() {
    global $bgcolor1, $bgcolor2;
?>
<table border="0" align=center cellpadding="0" cellspacing="0" width="98%">
  <tr>
   <td><img name="tlc" src="themes/BioLab/images/tlc.gif" width="20" height="25" border="0" alt=""></td> 
   <td width="100%" background="themes/BioLab/images/tm.gif"><img name="tm" src="themes/BioLab/images/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="trc" src="themes/BioLab/images/trc.gif" width="20" height="25" border="0" alt=""></td>
  </tr>
  <tr>
    <td background="themes/BioLab/images/leftside.gif"><img name="leftside" src="themes/BioLab/images/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>
     <td valign="top">
<?
}

function CloseTable3() {
?>
</td>
    <td background="themes/BioLab/images/rightside.gif"><img name="rightside" src="themes/BioLab/images/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img name="blc" src="themes/BioLab/images/blc.gif" width="20" height="25" border="0" alt=""></td>
   
    <td background="themes/BioLab/images/tbm.gif"><img name="tbm" src="themes/BioLab/images/invisible_pixel.gif" width="1" height="1" border="0" alt=""></td>
   <td><img name="brc" src="themes/BioLab/images/brc.gif" width="20" height="25" border="0" alt=""></td>
  </tr></table>
<?
}

function OpenTable() {
	global $name; 
if (($name=='Sections') OR ($name=='Content')) {
   echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" ><tr><td class=extra>\n"; 
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" ><tr><td>\n"; 
} 
else 
{
    ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <!--DWLayoutTable-->
  <tr> 
    <td height="28" colspan="3" valign="top"><img src="themes/MNS-Cortex/images/ttl.jpg" width="28" height="28"></td>
    <td width="100%" valign="top" background="themes/MNS-Cortex/images/tt.jpg"><img name="tm" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
    <td colspan="3" valign="top"><img src="themes/MNS-Cortex/images/ttr.jpg" width="28" height="28"></td>
  </tr>
  <tr> 
    <td width="20" height="69" valign="top" background="themes/MNS-Cortex/images/tl.jpg"><img name="left" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
    <td colspan="5" valign="top" bgcolor="#18222E"> 
      <?
}
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" ><tr><td class=extra>\n";
    echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"8\" ><tr><td>\n";
}

function CloseTable() {
	global $name; 
if (($name=='Sections') OR ($name=='Content')) { 
   echo "</td></tr></table></td></tr></table>\n"; 
}    
else 
{
    ?>
    </td>
    <td width="19" valign="top" background="themes/MNS-Cortex/images/tr.jpg"><img name="right" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr> 
    <td height="28" colspan="2" valign="top"><img src="themes/MNS-Cortex/images/tbl.jpg" width="27" height="28"></td>
    <td colspan="3" valign="top" background="themes/MNS-Cortex/images/tb.jpg"><img name="btm" src="themes/MNS-Cortex/images/spacer.gif" width="1" height="1" border="0" alt=""></td>
    <td colspan="2" valign="top"><img src="themes/MNS-Cortex/images/tbr.jpg" width="27" height="28"></td>
  </tr>
  <tr> 
    <td height="0"></td>
    <td width="7"></td>
    <td width="1"></td>
    <td></td>
    <td width="1"></td>
    <td width="8"></td>
    <td></td>
  </tr>
  <tr> 
    <td height="1"><img src="spacer.gif" alt="" width="20" height="1"></td>
    <td><img src="spacer.gif" alt="" width="7" height="1"></td>
    <td><img src="spacer.gif" alt="" width="1" height="1"></td>
    <td></td>
    <td><img src="spacer.gif" alt="" width="1" height="1"></td>
    <td><img src="spacer.gif" alt="" width="8" height="1"></td>
    <td><img src="spacer.gif" alt="" width="19" height="1"></td>
  </tr>
</table>
<?
}
}

function CloseTable2() {
    echo "</td></tr></table></td></tr></table>\n";
}

/************************************************************/
/* FormatStory                                              */
/************************************************************/

function FormatStory($thetext, $notes, $aid, $informant) {
    global $anonymous;
    if ($notes != "") {
        $notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        echo "<font class=\"content\" color=\"#000000\">$thetext$notes</font>\n";
    } else {
        if($informant != "") {
            $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $boxstuff = "$anonymous ";
        }
        $boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        echo "<font class=\"content\" color=\"#000000\">$boxstuff</font>\n";
    }
}

/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
    function themeheader() {
    global $user, $cookie, $sitekey, $prefix, $name, $db;
    
    cookiedecode($user);
    mt_srand ((double)microtime()*1000000);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
    $datekey = date("F j");
    $rcode = hexdec(md5($_SERVER[HTTP_USER_AGENT] . $sitekey . $random_num . $datekey));
    $code = substr($rcode, 2, 6);
    $username = $cookie[1];
    if ($username == "") {
        $username = "Anonymous";
    }
    
    if ($username == "Anonymous") {
        $theuser = "<form action=\"modules.php?name=Your_Account\" method=\"post\"><input type=\"text\" name=\"username\" value=\"username\" onFocus=\"if(this.value=='username')this.value='';\" value style=\"width:90;height:18;\" class=1>
  <p><input type=\"password\" name=\"user_password\" value=\"password\" onFocus=\"if(this.value=='password')this.value='';\" value style=\"width:90;height:18;\" class=1>
    <input type=\"hidden\" name=\"random_num\" value=\"$random_num\">
    <input type=\"hidden\" name=\"gfx_check\" value=\"$code\">
    <input type=\"hidden\" name=\"op\" value=\"login\">
  </p>
  <p>
    &nbsp;<input type=\"image\" value=\"login\" class=\"noborder\" src=\"themes/MNS-Cortex/images/login.gif\" border=\"0\" alt=login>
    <img src=\"themes/MNS-Cortex/images/spacer.gif\" border=0 width=4 height=1><a href=\"modules.php?name=Your_Account&op=new_user\"><img src=\"themes/MNS-Cortex/images/reg.gif\" border=0 alt=register></a></p>
  </td></form>
<p>\n"; } else { $theuser = "<img src=\"themes/MNS-Cortex/images/spacer.gif\" border=0 width=4 height=1><font class=copyright>Welcome 
  $username</font></p>
<p><a href=\"modules.php?name=Your_Account&op=logout\"><img src=\"themes/MNS-Cortex/images/logout.gif\" border=0 alt=logout></a></TD>\n"; 
  }
    
$sql = "SELECT msg1, msg2, msg3, link1, link2, link3, link4, link5, link1url, link2url, link3url, link4url, link5url, searchbox, flash FROM ".$prefix."_themecp";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$msg1 = $row[msg1];
$msg2 = $row[msg2];
$msg3 = $row[msg3];
$link1 = $row[link1];
$link2 = $row[link2];
$link3 = $row[link3];
$link4 = $row[link4];
$link5 = $row[link5];
$link1url = $row[link1url];
$link2url = $row[link2url];
$link3url = $row[link3url];
$link4url = $row[link4url];
$link5url = $row[link5url];
$searchbox = $row[searchbox];
$flash = $row[flash];
$public_msg = public_message(); 
echo "$public_msg";

if ($searchbox == 1) {	
	$search1 ="<form action=\"modules.php?op=modload&name=Search&file=index\" method=\"post\"><input type=\"text\" name=\"query\" value=\"type search here\" onFocus=\"if(this.value=='type search here')this.value='';\" value style=\"width:120;height:18;\" class=1>&nbsp;<input type=\"image\" class=\"noborder\" value=\"search\" src=\"themes/MNS-Cortex/images/search.gif\" border=\"0\" alt=\"submit search\"></TD></form>\n";
} else {
	$search1 ="&nbsp;</td>\n";
}

    

   echo "<body topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";

    $tmpl_file = "themes/MNS-Cortex/header.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
    

//LEFT SIDE BACKGROUND
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
		."<tr valign=\"top\">\n"
        ."<td width=\"20\" valign=\"top\" background=\"themes/MNS-Cortex/images/left.jpg\"><img src=\"themes/MNS-Cortex/images/left.jpg\" width=\"20\" height=\"2\" border=\"0\"></td>\n"
		."<td width=\"165\" valign=\"top\">\n";
    if (($name=='Forums') OR ($name=='Private_Messages') OR ($name=='Members_List') OR ($name=='Shopping_Cart') OR ($name=='Your_Account')) { 
} else { 
blocks(left); 
} 
    echo "</td>\n"
    	."<td width=\"0\" valign=\"top\" background=\"themes/MNS-Cortex/images/spacer.gif\"><img src=\"themes/MNS-Cortex/images/spacer.gif\" width=\"0\" height=\"1\" border=\"0\"></td>\n"
    	."<td width=\"100%\">\n";
}

/************************************************************/
/* Function themefooter()                                   */
/************************************************************/

$foot1 = "test";
$foot2 = "test";
$foot3 = "test";
$foot4 = "test";
function themefooter() {
    global $index, $banners, $prefix, $dbi, $total_time, $start_time, $foot1, $foot2, $foot3, $foot4;
$footer_message = $foot1. "<br>" . $foot2 . "<br>" . $foot3 . "<br>" . $foot4;
$showsub = "<FORM action=modules.php?op=modload&amp;name=Newsletter&amp;file=index&amp;func=action method=post><font class=copyright>&nbsp;<b>Email</b><br>&nbsp;<INPUT maxLength=100 size=20 class=\"sub\" name=new_email value=\"Your Email\" onFocus=\"if(this.value=='Your Email')this.value='';\" value style=\"width:150;height:18;FONT-SIZE: 9px;\"><BR><BR>&nbsp;<SELECT name=new_sub><OPTION value=sub selected>Subscribe<OPTION value=unsub>Unsubscribe</OPTION></SELECT><BR><BR>&nbsp;<SELECT name=new_type><OPTION value=0 selected>Text<OPTION value=1>HTML</OPTION></SELECT><br><br>&nbsp;<INPUT type=image class=\"liteoption1\" value=Submit src=\"themes/MNS-Cortex/images/submit.gif\" border=\"0\"></font></FORM>";

$maxshow = 10;	// Number of downloads to dispaly in the block.
$a = 1;
$result = sql_query("select lid, title, hits from ".$prefix."_links_links order by date DESC limit 0,$maxshow", $dbi);
while(list($lid, $title, $hits) = sql_fetch_row($result, $dbi)) {
    $title2 = ereg_replace("_", " ", "$title");
    $show .= "&nbsp;&nbsp;&nbsp;$a: <a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$title\">$title2</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"content\">$hits<font class=\"copyright\"> times<br>";
     $showlinks = " <A name= \"scrollingCode\"></A><MARQUEE behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"127\" height=\"109\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$show";
    
    
    $a++;
}

global $prefix, $db;

$a = 1;
$sql = "SELECT lid, title FROM ".$prefix."_downloads_downloads ORDER BY hits DESC LIMIT 0,10";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $title2 = ereg_replace("_", " ", $row[title]);
   // $content .= "<strong><big>&middot;</big></strong>&nbsp;$a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a><br>";
	$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\"><img src=\"themes/MNS-Cortex/images/hole.gif\" border=0></a> $a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a></span><br>";
	 $showdl = " <font class=copyright>&nbsp;</b><br>&nbsp;<A name= \"scrollingCode\"></A><MARQUEE behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"126\" height=\"105\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$content";

    $a++;
}
if ($banners == 1) {
    $numrows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_banner WHERE type='0' AND active='1'"));
   /* Get a random banner if exist any. */ 
   /* More efficient random stuff, thanks to Cristian Arroyo from http://www.planetalinux.com.ar */ 

    if ($numrows>1) { 
   $numrows = $numrows-1; 
   mt_srand((double)microtime()*1000000); 
   $bannum = mt_rand(0, $numrows); 
    } else { 
   $bannum = 0; 
    } 
    $sql = "SELECT bid, imageurl, clickurl, alttext FROM ".$prefix."_banner WHERE type='0' AND active='1' LIMIT $bannum,1"; 
    $result = $db->sql_query($sql); 
    $row = $db->sql_fetchrow($result); 
    $bid = $row[bid]; 
    $imageurl = $row[imageurl]; 
    $clickurl = $row[clickurl]; 
    $alttext = $row[alttext]; 
    
    if (!is_admin($admin)) { 
       $db->sql_query("UPDATE ".$prefix."_banner SET impmade=impmade+1 WHERE bid='$bid'"); 
    } 
    if($numrows>0) { 
   $sql2 = "SELECT cid, imptotal, impmade, clicks, date FROM ".$prefix."_banner WHERE bid='$bid'"; 
   $result2 = $db->sql_query($sql2); 
   $row2 = $db->sql_fetchrow($result2); 
   $cid = $row2[cid]; 
   $imptotal = $row2[imptotal]; 
   $impmade = $row2[impmade]; 
   $clicks = $row2[clicks]; 
   $date = $row2[date]; 

/* Check if this impression is the last one and print the banner */ 

   if (($imptotal <= $impmade) AND ($imptotal != 0)) { 
       $db->sql_query("UPDATE ".$prefix."_banner SET active='0' WHERE bid='$bid'"); 
       $sql3 = "SELECT name, contact, email FROM ".$prefix."_bannerclient WHERE cid='$cid'"; 
       $result3 = $db->sql_query($sql3); 
       $row3 = $db->sql_fetchrow($result3); 
       $c_name = $row3[name]; 
       $c_contact = $row3[contact]; 
       $c_email = $row3[email]; 
       if ($c_email != "") { 
      $from = "$sitename <$adminmail>"; 
      $to = "$c_contact <$c_email>"; 
      $message = ""._HELLO." $c_contact:\n\n"; 
      $message .= ""._THISISAUTOMATED."\n\n"; 
      $message .= ""._THERESULTS."\n\n"; 
      $message .= ""._TOTALIMPRESSIONS." $imptotal\n"; 
      $message .= ""._CLICKSRECEIVED." $clicks\n"; 
      $message .= ""._IMAGEURL." $imageurl\n"; 
      $message .= ""._CLICKURL." $clickurl\n"; 
      $message .= ""._ALTERNATETEXT." $alttext\n\n"; 
      $message .= ""._HOPEYOULIKED."\n\n"; 
      $message .= ""._THANKSUPPORT."\n\n"; 
      $message .= "- $sitename "._TEAM."\n"; 
      $message .= "$nukeurl"; 
      $subject = "$sitename: "._BANNERSFINNISHED.""; 
      mail($to, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion()); 
       } 
   } 
    $showbanners = "<a href=\"banners.php?op=click&bid=$bid\" target=\"_blank\"><img src=\"$imageurl\" border=\"0\" alt='$alttext' title='$alttext'></a>"; 
    }
}


    if ($index == 1) {
echo"</td>"
  . "    <td width=\"170\" valign=\"top\">"
 ."";


    blocks(right);

	}
echo"</td>"
  . "    <td width=\"20\" valign=\"top\" background=\"themes/MNS-Cortex/images/right.jpg\"><img src=\"themes/MNS-Cortex/images/right.jpg\" width=\"20\" height=\"2\"></td>"
  . "  </tr>"
  . "</table>"
 ."";
    
   
    include("themes/MNS-Cortex/footer.php");
    
}

/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
    global $anonymous, $tipath;

$ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
        $t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
        $t_image = "$tipath$topicimage";
}
    if ($notes != "") {
        $notes = "<br><br><b>"._NOTE."</b> $notes\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        $content = "$thetext$notes\n";
    } else {
        if($informant != "") {
            $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $content = "$anonymous ";
        }
        $content .= ""._WRITES." \"$thetext\"$notes\n";
    }
    //Code Changed - just show posted by
    $posted1 = get_author($aid);
        $posted = " $time $timezone";
    //End Code Change
    
    $tmpl_file = "themes/MNS-Cortex/story_home.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themeindex()                                    */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {
    global $admin, $sid, $tipath;
$ThemeSel = get_theme();
    if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
        $t_image = "themes/$ThemeSel/images/topics/$topicimage";
    } else {
        $t_image = "$tipath$topicimage";
}
    $posted = ""._POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
    if ($notes != "") {
        $notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>\n";
    } else {
        $notes = "";
    }
    if ("$aid" == "$informant") {
        $content = "$thetext$notes\n";
    } else {
        if($informant != "") {
            $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
        } else {
            $content = "$anonymous ";
        }
        $content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
    }
    $tmpl_file = "themes/MNS-Cortex/story_page.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/

function themesidebox($title, $content) {
    $tmpl_file = "themes/MNS-Cortex/blocks.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;
}

?>