<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

if ((isset($_POST['topicid']) && !empty($_POST['topicid'])) && (isset($_GET['topicid']) && !empty($_GET['topicid']))) 
$topicid = (isset($_GET['topicid']) && !stristr($_GET['topicid'],'..') && !stristr($_GET['topicid'],'://')) ? addslashes(trim($_GET['topicid'])) : false;
else 
$topicid = (isset($_REQUEST['topicid']) && !stristr($_REQUEST['topicid'],'..') && !stristr($_REQUEST['topicid'],'://')) ? addslashes(trim($_REQUEST['topicid'])) : false;

if ((isset($_POST['fb_source']) && !empty($_POST['fb_source'])) && (isset($_GET['fb_source']) && !empty($_GET['fb_source']))) 
$fb_source = (isset($_GET['fb_source']) && !stristr($_GET['fb_source'],'..') && !stristr($_GET['fb_source'],'://')) ? addslashes(trim($_GET['fb_source'])) : false;
else 
$fb_source = (isset($_REQUEST['fb_source']) && !stristr($_REQUEST['fb_source'],'..') && !stristr($_REQUEST['fb_source'],'://')) ? addslashes(trim($_REQUEST['fb_source'])) : false;

if ((isset($_POST['tt']) && !empty($_POST['tt'])) && (isset($_GET['tt']) && !empty($_GET['tt']))) 
$tt = (isset($_GET['tt']) && !stristr($_GET['tt'],'..') && !stristr($_GET['tt'],'://')) ? addslashes(trim($_GET['tt'])) : false;
else 
$tt = (isset($_REQUEST['tt']) && !stristr($_REQUEST['tt'],'..') && !stristr($_REQUEST['tt'],'://')) ? addslashes(trim($_REQUEST['tt'])) : false;

//&raquo;
// Item Delimiter 
$spacer = "-]";
$lft = "-]";
$rgt = "[-";
$newpagetitle = '';

    global
 	$admin_file, 
   $musicprefix,
		$cookie, 
		$slogan, 
	 $pagetitle, 
	  $sitename, 
        $prefix, 
		  $file, 
		   $db3, 
   $user_prefix, 
           $sid, 
	 $new_topic, 
	       $lft, 
		   $rgt, 
		  $dash, 
		$domain, 
		  $name, 
		   $lft, 
		   $rgt, 
 		  $dash;
	
    if (file_exists("upload/upu/files/$name.png"))
	{ 
       $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."upload/upu/files/$name.png\" />\n";    
	   $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."upload/upu/files/$name.png\" />\n";
	}
    else
	{
	   $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/titanium/$name.png\" />\n";	
       $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/titanium/$name.png\" />\n";
	}
	
     
	 if ($topicid)
	 {
       list($ntt) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$topicid'", SQL_NUM);
       if($ntt)
	   $newtopictext = $ntt;
	   $newpagetitle = "$spacer Titanium Tunes -] $newtopictext [-";
	 }
	 else
     if ($tt)
	 {
       list($newtt) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$tt'", SQL_NUM);
       if($newtt)
	   $newtopictext = $newtt;
	   $newpagetitle = "$spacer Titanium Tunes -] $newtopictext [-";
	 }
     else
	 $newpagetitle = "$spacer Titanium Tunes [-";
	 
	 $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
	 
	 if($topicid)
	 $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Music_Topics_Extended&tt=$topicid\" />\n";
     else
	 $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Music_Topics_Extended&tt=$tt\" />\n";
      
	 if($topicid)
     $facebook_ogdescription = "<meta property=\"og:description\" content=\"This is a collection of my favorite music. Just thought I would share it with everyone! Soon Titanium Tunes will have the ability to do song dedications! ;-)\" />\n";
     else
     $facebook_ogdescription = "<meta property=\"og:description\" content=\"-] Titanium Tunes [- Network Music Collections - Soon we will have the ability for you to make song dedications! ;-)\" />\n";

     $facebook_ogtype = "<meta property=\"og:type\" content=\"website\" />\n";
?>