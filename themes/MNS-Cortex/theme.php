<?php
/*=======================================================================================
 PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System : Using the PHP-Nuke Titanium Core
 ========================================================================================*/
/*****************************************************************************************/
/* MNS-Cortex v.3.0 theme designed by Ernest "TheGhost" Buffington                       */
/* This theme was designed to fit the new generation wide screen monitors                */
/*                                                                                       */
/* MNS-Cortex v.3.0 is a free public theme package designed for PHP-Nuke Titanium        */
/* Copyright (c) 2009 by TheGhost All Rights Reserved                                    */
/*****************************************************************************************/
/* For more commercial and public themes, custom graphics and photoshop tutorials        */
/* visit www.mynetworkspace.in                                                           */
/*****************************************************************************************/
/* For support of this great CMS visit MyNetworkSpace http://www.mynetworkspace.in       */
/*****************************************************************************************/
/* PHP-Nuke Copyright (c) 2005 by Francisco Burzi http://phpnuke.org                     */
/*****************************************************************************************/
/*****[CHANGES]*****************************************************************************************************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/29/2005
      Theme Management                         v1.0.2       12/14/2005       
	  MyNetworkSpace Patched                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  SWF Header Class                         v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Resolution Checker                       v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Detect Browser Type                      v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Page Loading Animation                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Safari Browser Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  FireFox Browser Support                  v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  Internet Explorer Support                v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
	  File Extension Support                   v1.0.0       10/09/2009       Modified for the MyNetworkSpace Network
 ********************************************************************************************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
{
    exit('Access Denied');
}

$theme_name = basename(dirname(__FILE__));

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
include_once(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

/************************************************************/
/* Theme Colors Definition                                  */
/************************************************************/
global $ThemeInfo;

$bgcolor1 = $ThemeInfo['bgcolor1'];
$bgcolor2 = $ThemeInfo['bgcolor2'];
$bgcolor3 = $ThemeInfo['bgcolor3'];
$bgcolor4 = $ThemeInfo['bgcolor4'];
$textcolor1 = $ThemeInfo['textcolor1'];
$textcolor2 = $ThemeInfo['textcolor2'];

/************************************************************/
/* OpenTable Functions                                      */
/************************************************************/
include_once(NUKE_THEMES_DIR.$theme_name.'/tables.php');
/************************************************************/
/* OpenTable Functions                                      */
/************************************************************/


/************************************************************/
/* Function FormatStory()                                   */
/************************************************************/
function FormatStory($thetext, $notes, $swf, $suspect,  $aid, $informant) 
{
    global $anonymous, $domain;

/* SWF Header Class */
require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
/* SWF Header Class */

	if(!empty($topicimage)) {
        if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
            $t_image = "themes/$ThemeSel/images/topics/$topicimage";
        } else {
            $t_image = "$tipath$topicimage";
        }
        $topic_img = "<a href=\"modules.php?name=News&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";
    } else {
        $topic_img = "";
    }
	
	if (!empty($notes)){$notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";} 
	else{$notes = "";}
    
	//TheGhost added Mug Shot
    if ($suspect =='none.gif') 
	{
      //$suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\ width=\"1\" height=\"1\"></NO RESIZE><br />\n"; 
	  // $suspect = "<hr />".$topic_img;
	    $suspect = "<hr />";
	}
	else
	{
	  $suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE><hr />\n";
	}    
	
	
	if ($aid == $informant) 
	{
        echo "<span class=\"content\" color=\"#505050\">$thetext$notes</span>\n";
    } 
	else 
	{
        if(defined('WRITES')) 
		{
            if(!empty($informant)) 
			{
                if(is_array($informant)) 
				{
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $boxstuff = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } 
			else 
			{
                $boxstuff = "$anonymous ";
            }
            
			$boxstuff .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } 
		else 
		{
            $boxstuff .= "$thetext$notes\n";
        }

        echo "<span class=\"content\" color=\"#505050\">$boxstuff</span>\n";
    }
}
/************************************************************/
/* Function FormatStory()                                   */
/************************************************************/








/************************************************************/
/* Function themeheader()                                   */
/************************************************************/
function themeheader() 
{
	global $user, $cookie, $prefix, $sitekey, $db, $name, $banners, $theme_name, $_SERVER, $HTTP_USER_AGENT, $HTTP_SERVER_VARS, $browser, $file_extension;
	
    //
    // Determine the Browser the User is using, because of some nasty incompatibilities.
    //

    if (!empty($_SERVER['HTTP_USER_AGENT']))
    {
      $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    }
    else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT']))
    {
      $HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
    }
    else if (!isset($HTTP_USER_AGENT))
    {
      $HTTP_USER_AGENT = '';
    }	

    // Store Screen Resolution - Some Assholes Still have piece os shit computers!!!!!
    if(!isset($_COOKIE["theme_resolution"]))
	{
     ?>
      <script language="javascript"><!--
      writeCookie();
      
	  function writeCookie() 
      {
        var today = new Date();
        var the_date = new Date("June 16, 2023");
        var the_cookie_date = the_date.toGMTString();
        var the_cookie = "theme_resolution="+ screen.width +"x"+ screen.height +"x"+ screen.colorDepth;
        var the_cookie = the_cookie + ";expires=" + the_cookie_date;
        document.cookie=the_cookie;
      }
      
	  //--></script>
     <?php
    } 
	else 
	{ 
	  $theme[theme_res] = $_COOKIE["theme_resolution"]; 
	}
	
    if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //This browser handles PNG files just fine
       $browser_version = $log_version[2];
       $browser_agent = 'opera';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else 
	if (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
       $browser_version = $log_version[1];
       $browser_agent = 'ie';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.jpg';
    }
    else 
	if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //Mac Only
       $browser_version = $log_version[1];
       $browser_agent = 'omniweb';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
    }
    else 
	if (ereg('Netscape([0-9]{1})', $HTTP_USER_AGENT, $log_version))
    {
	   //This browser handles PNG files just fine
       $browser_version = $log_version[1];
       $browser_agent = 'netscape';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
	}
    else 
	if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //This browser handles PNG files just fine
       $browser_version = $log_version[1];
       $browser_agent = 'mozilla';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else 
	if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version))
    {
	   //This is garbage, I did not wish to wast an hour figuring out
	   //what to install for a windows based machine - This may work ok
	   //under a linux environment but as for windows I think I would rather
	   //drive a 10 penny nail into my nutsack
       $browser_version = $log_version[1];
       $browser_agent = 'konqueror';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.png';
    }
    else
    {
       $browser_version = 0;
       $browser_agent = 'other';
       $agent = strtolower(getenv("HTTP_USER_AGENT"));
	   $file_extension = '.jpg';
    }
	
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
    echo "<HTML>\n";
    echo "<HEAD>\n"; 
    echo "<meta http-equiv=\"Content-Language\" content=\"en-us\">\n";
   /* echo "<SCRIPT LANGUAGE=\"JavaScript\" src=\"themes/".$theme_name."/js/fade.js\"></script>\n"; */
   /* echo "<SCRIPT LANGUAGE=\"JavaScript\" src=\"themes/".$theme_name."/js/enabler.js\"></script>\n"; */
   /* echo "<script language=\"javascript\" src=\"themes/".$theme_name."/js/liveclock.js\"></script>\n"; */
    echo "</head>\n\n\n";     	

    echo "<BODY>";
    echo "<body topmargin=\"0\" leftmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">\n";


    $tmpl_file = "themes/MNS-Cortex/header.html";
    $thefile = implode("", file($tmpl_file));
    $thefile = addslashes($thefile);
    $thefile = "\$r_file=\"".$thefile."\";";
    eval($thefile);
    print $r_file;

    echo "<script language=\"javascript\" src=\"js/theghostwashere.js\"></script>\n";

    //echo 'Browser Version :'.$browser_version.'<br />';
	//echo 'Your browser is '.$browser_agent.' based.<br />';
	//echo 'Agent           :'.$agent.'<br />';
	//echo 'File Extension  :'.$file_extension.'<br />';

/*   
   $ads = ads(0);
   
   if(empty($ads)) 
   {
   
   echo "<a href=\"index.php\" target=\"_self\">\n";
   echo "<img src=\"themes/".$theme_name."/header/nukestyle-hd_banner.png\" border=\"0\" alt='' title='' width=\"472\" height=\"74\"></a>";
   
   }
   else
   {
   echo "$ads";
   }
*/   
   
//LEFT SIDE BACKGROUND
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
		."<tr valign=\"top\">\n"
        ."<td width=\"20\" valign=\"top\" background=\"themes/MNS-Cortex/images/left.jpg\"><img src=\"themes/MNS-Cortex/images/left.jpg\" width=\"20\" height=\"2\" border=\"0\"></td>\n"
		."<td width=\"165\" valign=\"top\">\n";

    
	if(blocks_visible('left')) 
	{
        blocks('left');
    } 
	else 
	{

    }
   
   //this controls the gap between the left block and the left side of the center table!!! 
	echo "</td>\n"
    	."<td width=\"0\" valign=\"top\" background=\"themes/MNS-Cortex/images/spacer.gif\"><img src=\"themes/MNS-Cortex/images/spacer.gif\" width=\"9\" height=\"1\" border=\"0\"></td>\n"
    	."<td width=\"100%\">\n";
}



/************************************************************/
/* Function themefooter()                                   */
/************************************************************/
function themefooter() 
{
    global $index, $user, $banners, $cookie, $prefix, $dbi, $db, $admin, $adminmail, $total_time, $start_time, $foot1, $foot2, $foot3, $foot4, $nukeurl, $ip, $theme_name, $ThemeInfo;

$showsub = "<FORM action=modules.php?op=modload&amp;name=Newsletter&amp;file=index&amp;func=action method=post><font class=copyright>&nbsp;<b>Email</b><br>&nbsp;<INPUT maxLength=100 size=20 class=\"sub\" name=new_email value=\"Your Email\" onFocus=\"if(this.value=='Your Email')this.value='';\" value style=\"width:150;height:18;FONT-SIZE: 9px;\"><BR><BR>&nbsp;<SELECT name=new_sub><OPTION value=sub selected>Subscribe<OPTION value=unsub>Unsubscribe</OPTION></SELECT><BR><BR>&nbsp;<SELECT name=new_type><OPTION value=0 selected>Text<OPTION value=1>HTML</OPTION></SELECT><br><br>&nbsp;<INPUT type=image class=\"liteoption1\" value=Submit src=\"themes/".$theme_name."/images/submit.gif\" border=\"0\"></font></FORM>";	
	
$maxshow = 10;	// Number of downloads to dispaly in the block.
$a = 1;
$result = $db->sql_query("select lid, title, hits from ".$prefix."_links_links order by date DESC limit 0,$maxshow");

while(list($lid, $title, $hits) = $db->sql_fetchrow($result)) 
{
    $title2 = ereg_replace("_", " ", "$title");
    $show .= "&nbsp;&nbsp;&nbsp;$a: <a href=\"modules.php?name=Web_Links&amp;l_op=viewlinkdetails&amp;lid=$lid&amp;ttitle=$title\">$title2</a><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"content\">$hits<font class=\"copyright\"> times<br>";
     $showlinks = " <A name= \"scrollingCode\"></A><MARQUEE behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"127\" height=\"109\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$show";

$a++; 
}
$db->sql_freeresult($result);

global $prefix, $db;

$a = 1;
$sql = "SELECT lid, title FROM ".$prefix."_downloads_downloads ORDER BY hits DESC LIMIT 0,20";
$result = $db->sql_query($sql);

while ($row = $db->sql_fetchrow($result)) 
{
    $title2 = ereg_replace("_", " ", $row[title]);
	$content .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\"><img src=\"themes/".$theme_name."/images/hole.gif\" border=0></a> $a: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]&amp;title=$row[title]\">$title2</a></span><br>";
	 $showdl = " <font class=copyright>&nbsp;</b><br>&nbsp;<A name= \"scrollingCode\"></A><MARQUEE behavior= \"scroll\" align= \"left\" direction= \"up\" width=\"126\" height=\"105\" scrollamount= \"2\" scrolldelay= \"30\" onmouseover='this.stop()' onmouseout='this.start()'>$content";
	 
    $a++; 
}

$db->sql_freeresult($result);

	//this is where i control the gap between the right block and the right side of the center block   
	echo "</td>\n"
	    ."<td><img src=\"themes/".$theme_name."/images/spacer.png\" width=\"7\" height=\"15\" border=\"0\" alt=\"\"></td>\n"
	    ."<td valign=\"top\" background=\"themes/".$theme_name."/sides/rightbbg.png\" width=\"21\">\n";
	
    if(blocks_visible('right')) 
    {
		
       echo"</td>"
         . "<td width=\"170\" valign=\"top\">";
		 
       blocks('right');
    }
	

      echo"</td>"
        . "<td width=\"20\" valign=\"top\" background=\"themes/".$theme_name."/images/right.jpg\"><img src=\"themes/".$theme_name."/images/right.jpg\" width=\"20\" height=\"2\"></td>"
        . "</tr>"
        . "</table>";

      ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="322" height="193" valign="top"><table width="322" border="0" cellpadding="0" cellspacing="0" background="themes/<?=$theme_name?>/images/fl.jpg">
          <tr>
            <td width="84" height="47"></td>
            <td width="127">&nbsp;</td>
            <td width="111">&nbsp;</td>
          </tr>
          <tr>
            <td height="112">&nbsp;</td>
            <td valign="top"><?=$showlinks?></td>
          <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="34">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      <td width="100%" align="center" background="themes/<?=$theme_name?>/images/fmm.jpg">
      <IMG SRC="themes/<?=$theme_name?>/header/spacer.png" WIDTH="1" HEIGHT="17"><br />      
	  <?
   
      echo "<center>";
      footmsg();
      echo "</center>";
      
	  
	  ?>
      </td>
      <td width="321" valign="top"><table width="321" border="0" cellpadding="0" cellspacing="0" background="themes/<?=$theme_name?>/images/fr.jpg">
          <tr>
            <td width="109" height="37">&nbsp;</td>
            <td width="126">&nbsp;</td>
            <td width="86">&nbsp;</td>
          </tr>
          <tr>
            <td height="124">&nbsp;</td>
            <td valign="top"><?=$showdl?></td>
          <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="32">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>

      <?
}
/************************************************************/
/* Function themefooter()                                   */
/************************************************************/





/************************************************************/
/* Function themeindex()                                    */
/* This function format the stories on the Homepage         */
/************************************************************/
function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $swf, $suspect, $morelink, $topicname, $topicimage, $topictext) 
{
  global $anonymous, $tipath, $theme_name, $sid, $domain;
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
    $ThemeSel = get_theme();
    
	if(!empty($topicimage)) {
        if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
            $t_image = "themes/$ThemeSel/images/topics/$topicimage";
        } else {
            $t_image = "$tipath$topicimage";
        }
        $topic_img = "<a href=\"modules.php?name=News&amp;new_topic=".$topic."\"><img src=\"".$t_image."\" border=\"0\" alt=\"$topictext\" /></a>";
    } else {
        $topic_img = "";
    }	
	
	if (!empty($notes)) 
	{
        $notes = "<br /><br /><strong>"._NOTE."</strong> $notes\n";
    } 
	else 
	{
        $notes = "";
    }

	if ($suspect == 'none.gif')
	{
	  //$suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\" width=\"1\" height=\"1\" ></NO RESIZE>";
	  //$suspect = "<hr />".$topic_img;
	  $suspect = "<hr />";
	}
    else
	{
	  $suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE><hr />";
	}
	
	
	$content = '';

    if ($aid == $informant) 
	{
        $content = "$thetext$notes\n";
    } 
	else 
	{
        if(defined('WRITES')) 
		{
            if(!empty($informant)) 
			{
                if(is_array($informant)) 
				{
                    $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } 
			else 
			{
                $content = "$anonymous ";
            }

            $content .= _WRITES." \"$thetext\"$notes\n";
        } 
		else 
		{
            $content .= "$thetext$notes\n";
        }
    }

    $posted = _POSTEDBY." ";
    $posted .= get_author($aid);
    $posted .= " "._ON." $time  ";
    $datetime = substr($morelink, 0, strpos($morelink, "|") - strlen($morelink));
    $morelink = substr($morelink, strlen($datetime) + 2);
	
    ?>  
    <table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="center" width="100%"><font color="#FFFFFF"><strong><?=$topictext?></strong></font></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
    </tr>
    <tr>
    <td width="15" background="themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>
    <td width="24"></td>
    <td width="100%">
    
    <strong>.::[</strong> <strong>Topic</strong> &raquo; <a href="modules.php?name=News&amp;new_topic="<?=$topic?>"<font color="#CC0000"><?=$topictext?></font><strong></a> Title</strong> &raquo; <font color="#CC0000"><?=$title?> </font><strong>]::.
    </strong><br />
    <strong>.::[</strong> <?=$posted?> <strong>]::.</strong><br />
    <?=$suspect?>
    <?=$content?><hr /><center>
    
	<?
  
	  $newswf = new swfheader(false) ;
      $newswf->loadswf("upload/upu/files/$swf") ;
      $newswf->display($trans);  
  
      if ($swf == "none.swf")
      {
      
	  }
     else
     {
  echo "<br />If the above Flash Paper is not visible, please update the site cache</span> <a class=\"underline\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
  echo"<hr />";
  
  }
  
?>	
</center>

    <strong>.::[</strong> <font class="option" color="#cc0000">( This message has been read <?=$counter?> times ) </font><strong>]::.</strong><br />
    <strong>.::[</strong> <?=$datetime?> <font class="option" color="#000000"><img src="images/sommaire/larrow.png" border="0"> click here to comment or read more about</font> <font class="option" color="#cc0000"><?=$title?> | <?=$morelink?></font> <strong>]::.</strong>


</td>

<td width="25"></td>

<td width="15" background="themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="1357">&nbsp;</td>
		<td align="right" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
	</tr>
</table><br />
<?

}
/************************************************************/
/* Function themearticle()                                  */
/************************************************************/
function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $swf, $suspect) 
{
    global $admin, $sid, $tipath, $theme_name, $domain;
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
require_once(NUKE_CLASSES_DIR.'class.swfheader.php');
/************************************************************/
/* SWF Header Class                                         */
/************************************************************/
    $ThemeSel = get_theme();
    
	$posted = _POSTEDON." $datetime "._BY." ";
    $posted .= get_author($aid);
    
	if (!empty($notes)) 
	{
        $notes = "<br /><br /><strong>"._NOTE."</strong> <i>$notes</i>\n";
    } 
	else 
	{
        $notes = '';
    }
    //Mug Shot
    if ( isset($_POST['file1']['filename']) && !empty($_POST['file1']['filename']) )  
    {
       $suspect = $_POST['file1']['filename'];
    } 
      
	
	if ($suspect == 'none.png')
	$suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\" width=\"1\" height=\"1\" ></NO RESIZE>\n";
    else
	$suspect = "<hr /><NO RESIZE><img src=\"http://".$domain."/upload/upu/files/$suspect\"></NO RESIZE><hr />\n";
	
    if ( isset($_POST['file2']['filename']) && !empty($_POST['file2']['filename']) )  
    {
       $swf = $_POST['file2']['filename'];
    } 
    else 
    {
      $swf = Fix_Quotes($swf);
    }

    $content = '';

    if ($aid == $informant) 
	{
        $content = "$thetext$notes\n";
    } 
	else 
	{
		if(defined('WRITES')) 
		{
            if(!empty($informant)) 
			{
                if(is_array($informant)) 
				{
                    $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant[0]\">$informant[1]</a> ";
                } 
				else 
				{
                    $content = "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant\">$informant</a> ";
                }
            } 
			else 
			{
                $content = "$anonymous ";
            }
            
			$content .= ""._WRITES." <i>\"$thetext\"</i>$notes\n";
        } 
		else 
		{
            $content .= "$thetext$notes\n";
        }
    }
	

    ?>  
    <table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/leftcorner.png" width="39" height="50"></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="center" width="100%"><font color="#FFFFFF"><strong><?=$topictext?></strong></font></td>
    <td background="themes/<?=$theme_name?>/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">
    <img src="themes/<?=$theme_name?>/tables/OpenTable/rightcorner.png" width="39" height="50"></td>
    </tr>
    <tr>
    <td width="15" background="themes/<?=$theme_name?>/tables/OpenTable/leftside.png"></td>
    <td width="24"></td>
    <td width="100%">
    
    <strong>.::[</strong> <strong>Topic</strong> &raquo; <a href="modules.php?name=News&amp;new_topic="<?=$topic?>"<font color="#CC0000"><?=$topictext?></font><strong></a> Title</strong> &raquo; <font color="#CC0000"><?=$title?> </font><strong>]::.
    </strong><br />
    <strong>.::[</strong> <?=$posted?> <strong>]::.</strong><br />
    <?=$suspect?>
    <?=$content?><hr /><center>
    
	<?

     $newswf = new swfheader(false) ;
     $newswf->loadswf("upload/upu/files/$swf") ;
     $newswf->display($trans);  
  
     if ($swf == "none.swf")
     {
  
     }
     else
     {
  echo "<br />If the above Flash Paper is not visible, please update the site cache</span> <a class=\"underline\" href=\"javascript:clear_cache.submit()\">" . _UPDATECACHE . "</a>";
  echo"<hr />";
  }

?>	
</center>

    <strong>.::[</strong> <font class="option" color="#cc0000">PLEASE TAKE THE TIME TO RATE THIS </font><strong>]::.</strong><br />
    
</td>

<td width="25"></td>

<td width="15" background="themes/<?=$theme_name?>/tables/CloseTable/rightside.png"></td>
</tr>
<tr>
<td align="left" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/CloseTable/leftbottomcorner.png"></td>
<td background="themes/<?=$theme_name?>/tables/CloseTable/bottommiddle.png" width="1357">&nbsp;</td>
		<td align="right" width="39" colspan="2"><img src="themes/<?=$theme_name?>/tables/CloseTable/bottomrightcorner.png"></td>
	</tr>
</table><br />
<?
}


function themecenterbox($title, $content) 
{
    OpenTable();
    echo '<center><span class="option"><strong>'.$title.'</strong></span></center><br />'.$content;
    CloseTable();
}

function themepreview($title, $hometext, $bodytext='', $notes='', $swf='', $suspect='') 
{
    echo '<strong>'.$title.'</strong><br /><br />'.$hometext;

    if (!empty($bodytext)) 
	{
        echo '<br /><br />'.$bodytext;
    }
    
	if (!empty($notes)) 
	{
        echo '<br /><br /><strong>'._NOTE.'</strong> <i>'.$notes.'</i>';
    }
}
/************************************************************/
/* Function themesidebox()                                  */
/************************************************************/
function themesidebox($title, $content, $bid=0) 
{
   global $theme_name;

   echo"<style type=\"text/css\">"
     . "<!--"
     . ".style1 {"
     . "color: #FFFFFF;"
     . "font-weight: bold;"
     . "}"
     . "-->"
     . "</style>";

   ?> 
   <table class=block cellSpacing="0" cellPadding="0" border="0" width="249">
   <tr>
   <td background="themes/MNS-Cortex/tables/OpenTable/topmiddle.png">
   <img src="themes/MNS-Cortex/tables/OpenTable/leftcorner.png" border="0" width="39" height="50"></td>
   <td width="195" align="center" background="themes/MNS-Cortex/tables/OpenTable/topmiddle.png" valign="top"><IMG SRC="themes/MNS-Cortex/images/spacer.png" WIDTH="1" HEIGHT="11"><br />
   <span class="style1"><?=$title?></span></td>
   <td>
   <img src="themes/MNS-Cortex/tables/OpenTable/rightcorner.png" border="0" width="39" height="50"></td>
   </tr>
   <tr>
   <td colSpan="3">
   <table cellSpacing="0" cellPadding="0" width="100%" border="0">
   <tr>
   <td width="15" background="themes/MNS-Cortex/tables/OpenTable/leftside.png">
   <img src="themes/MNS-Cortex/tables/OpenTable/leftside.png" border="0" width="15" height="4"></td>
   <td width="100%" >
   <table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">
   <tr>
   <td width="195">
   <?=$content?>         </td>
   </tr>
   </table>
   </td>
   <td width="15" background="themes/MNS-Cortex/tables/CloseTable/rightside.png">
   <img src="themes/MNS-Cortex/tables/CloseTable/rightside.png" border="0" width="15" height="4"></td>
   </tr>
   </table>
   </td>
   </tr>
   <tr>
   <td width="39" height="52">
   <img src="themes/MNS-Cortex/tables/CloseTable/leftbottomcorner.png" border="0" width="39" height="52"></td>
   <td width="195" height="27" background="themes/MNS-Cortex/tables/CloseTable/bottommiddle.png">        </td>
   <td width="39" height="27">
   <img src="themes/MNS-Cortex/tables/CloseTable/bottomrightcorner.png" border="0" width="39" height="52"></td>
   </tr>
   </table>
   <br>
   <?

}
?>