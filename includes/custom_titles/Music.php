<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//&raquo;
$spacer = "-]"; $lft = "-]"; $rgt = "[-"; $dash = "-"; $newpagetitle = '';

global
 $admin_file, 
     $cookie, 
	 $slogan, 
  $pagetitle, 
   $sitename, 
$musicprefix, 
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
	    $sid,
		$lft, 
	    $rgt, 
 	   $dash;

   if ((isset($_POST['topic']) && !empty($_POST['topic'])) && (isset($_GET['topic']) && !empty($_GET['topic'])))
   { 
     $topicidnumber = (isset($_GET['topic']) && !stristr($_GET['topic'],'..') && !stristr($_GET['topic'],'://')) ? addslashes(trim($_GET['topic'])) : false;
   }
   else 
   $topicidnumber = (isset($_REQUEST['topic']) && !stristr($_REQUEST['topic'],'..') && !stristr($_REQUEST['topic'],'://')) ? addslashes(trim($_REQUEST['topic'])) : false;
 
   if ((isset($_POST['file']) && !empty($_POST['file'])) && (isset($_GET['file']) && !empty($_GET['file']))) 
   {
     $requestfile = (isset($_GET['file']) && !stristr($_GET['file'],'..') && !stristr($_GET['file'],'://')) ? addslashes(trim($_GET['file'])) : false;
   }
   else 
   $requestfile = (isset($_REQUEST['file']) && !stristr($_REQUEST['file'],'..') && !stristr($_REQUEST['file'],'://')) ? addslashes(trim($_REQUEST['file'])) : false;

   if ((isset($_POST['sid']) && !empty($_POST['sid'])) && (isset($_GET['sid']) && !empty($_GET['sid'])))
   { 
     $sid = (isset($_GET['sid']) && !stristr($_GET['sid'],'..') && !stristr($_GET['sid'],'://')) ? addslashes(trim($_GET['sid'])) : false;
   }
   else 
   $sid = (isset($_REQUEST['sid']) && !stristr($_REQUEST['sid'],'..') && !stristr($_REQUEST['sid'],'://')) ? addslashes(trim($_REQUEST['sid'])) : false;

   $newpagetitle= "-] Titanium $name [-";
   $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
	
   if (isset($new_topic) && is_numeric($new_topic)) 
   {
        list($top) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$new_topic'", SQL_NUM);
   
        $newpagetitle= "-] $top [-";
		$facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
    } 
	else 
	if ($file == 'article' && isset($sid) && is_numeric($sid))
	{
        list($art, $top) = $db3->sql_ufetchrow("SELECT `title`, `topic` FROM `".$musicprefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
    
	    if ($top) 
		{
            list($top) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$top'", SQL_NUM);
        
		    $newpagetitle= "-] $top $item_delim $art [-";
            $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
		} 
		else 
		{
            $newpagetitle= "-] $art [-";
		    $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
        }
    }

     $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/titanium/Music.png\" />\n";
	 $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/titanium/Music.png\" />\n";
     $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
     $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
     $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";

	 $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Music\" />\n"; 	
     $facebook_ogdescription = "<meta property=\"og:description\" content=\"$spacer The 86it Social Network -] Titanium Tunes [-\" />\n"; 	 
     $facebook_ogtitle = "$sitename -] Titanium Tunes [-";
    
	if (isset($new_topic) && is_numeric($new_topic)) 
	{
        list($top) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$new_topic'", SQL_NUM);
        
		$newpagetitle= "-] $top [-";
	    $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";
    } 

	if ($file == 'article' && isset($sid) && is_numeric($sid))
	{
		//good to go
        if (file_exists("upload/upu/files/$name$sid.png")) 
        {
          $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."upload/upu/files/$name$sid.png\" />\n";
		  $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."upload/upu/files/$name$sid.png\" />\n";
          $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
          $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
          $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
        }
        else
        {
          $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/titanium/Music002.png\" />\n";
		  $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/titanium/Music002.png\" />\n";
          $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
          $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
          $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
		}
		//good to go
		 

        //good to go
        list($art, $top) = $db3->sql_ufetchrow("SELECT `title`, `topic` FROM `".$musicprefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
        //good to go
		    
	    if ($top)  
		{
            //////////////////////////////////////////////////////////
            //Keep start (never delete or move)
	        //////////////////////////////////////////////////////////
            list($top) = $db3->sql_ufetchrow("SELECT `topictext` FROM `".$musicprefix."_topics` WHERE `topicid`='$top'", SQL_NUM);
            $newpagetitle= "-] $top - Song : $art [-";
		    $facebook_ogtitle = "<meta property=\"og:title\" content=\"$newpagetitle\" />\n";	

			//good to go
			list($cateid) = $db3->sql_ufetchrow("SELECT `catid` FROM `".$musicprefix."_stories` WHERE `sid`='$sid'", SQL_NUM);
			$thiscateid = $cateid;
			
			list($author) = $db3->sql_ufetchrow("SELECT `title` FROM `".$musicprefix."_stories_cat` WHERE `catid`='$thiscateid'", SQL_NUM);
			$songauthor = $author;
            //good to go
			
			//good to go
			$facebook_ogdescription = "<meta property=\"og:description\" content=\"$spacer Titanium Tunes -] Song By $songauthor [-\" />\n"; 	 
           //////////////////////////////////////////////////////////
           //Keep end (never delete or move)
	       //////////////////////////////////////////////////////////
        }
		  
        $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=Music&file=article&sid=$sid&mode=0&thold=-1\" />\n"; 	
	}
?>