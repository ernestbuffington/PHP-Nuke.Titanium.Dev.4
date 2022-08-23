<?php
/*=======================================================================
 PHP-Nuke Titanium: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

               global $file, 
	$facebook_ogdescription, 
	$facebook_ogimage_width,
   $facebook_ogimage_height,
          $facebook_ogimage,
	                 $topic, 
					 $catid, 
					  $name, 
					$domain, 
					   $sid, 
			   $portaladmin, 
			     $new_topic, 
				       $db, 
			$prefix;
			
          // Item Delimiter
             $spacer = "-]";
                $lft = "-]";
                $rgt = "[-";
                $dash = "-";
           // Item Delimiter
    $item_delim = "&raquo;";

	$newpagetitle= "$sitename $item_delim $name";

    $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name\" />\n";

    list($portaladminname, 
	              $avatar, 
				   $email) = $db->sql_ufetchrow("SELECT `username`,`user_avatar`, `user_email` FROM `".$prefix."_users` WHERE `user_id`='$portaladmin'", SQL_NUM);
	 	 	 
	if(isset($portaladminname))
    $facebook_ogdescription = "<meta property=\"og:description\" content=\"-] A New Blog has been posted by $portaladminname [-\" />\n";

	list($topicimage) = $db->sql_ufetchrow("SELECT `topicimage` FROM `".$prefix."_blog_topics` WHERE `topicid`='$topic'", SQL_NUM);
	
	if (isset($topicimage))
	{ 
	   //facebook page image
       $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/topics/$topicimage\" />\n";
	   $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/topics/$topicimage\" />\n";
       
	   $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
       $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
       $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
	}
	else
    {
       $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/$portaladmin.png\" />\n";
	   $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/$portaladmin.png\" />\n";
       
	   $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
       $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
       $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
	}
	
    if (isset($new_topic) && is_numeric($new_topic)) 
	{
        list($top, $topicimage) = $db->sql_ufetchrow("SELECT `topictext`,`topicimage` FROM `".$prefix."_blog_topics` WHERE `topicid`='$new_topic'", SQL_NUM);
    
	    $newpagetitle= "$sitename $item_delim $top";
    
	    $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name&file=topics&topic=$new_topic\" />\n"; 	 	 
    
	    $facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $top [-\" />\n";
    
	   //facebook page image
	    $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/topics/$topicimage\" />\n";
		$facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/topics/$topicimage\" />\n";
        $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";		
        $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
        $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
	} 
	else 
	if ($file == 'article' && isset($sid) && is_numeric($sid))
	{
        list($art, $top) = $db->sql_ufetchrow("SELECT `title`, `topic` FROM `".$prefix."_blogs` WHERE `sid`='$sid'", SQL_NUM);
    
	    if ($top) 
		{
            list($top, $topicimage) = $db->sql_ufetchrow("SELECT `topictext`,`topicimage` FROM `".$prefix."_blog_topics` WHERE `topicid`='$top'", SQL_NUM);

            if ($sitename == $top)
			$newpagetitle= "$sitename $item_delim $art";
			else
			$newpagetitle= "$sitename $item_delim $top $item_delim $art";

            $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name&file=article&sid=$sid&mode=0&order=0&thold=0\" />\n";

			list($hometext) = $db->sql_ufetchrow("SELECT `hometext` FROM `".$prefix."_blogs` WHERE `sid`='$sid'", SQL_NUM);

			$hometext = stripslashes(check_html($hometext, "nohtml")); 	 	 

            $facebook_ogdescription = "<meta property=\"og:description\" content=\"$hometext\" />\n";

            //facebook page image
            $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/topics/$topicimage\" />\n";            
			$facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/topics/$topicimage\" />\n";
            $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n";
			$facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
            $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
        } 
		else 
		{
            $newpagetitle= "$sitename $item_delim $art";
            $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name\" />\n"; 	 	 
            $facebook_ogdescription = "<meta property=\"og:description\" content=\"-] $art [-\" />\n";
		}
    }
	else 
	if ($file == 'topics' && isset($topic) && is_numeric($topic))
	{
      $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name&file=topics&topic=$topic\" />\n";
	  
	  // _stories -> topic is the same as _topics -> topicid
	  list($topicname, $topictext, $topicimage) = $db->sql_ufetchrow("SELECT `topicname`, 
	                                                                         `topictext`,
																			`topicimage` 
																	  FROM `".$prefix."_blog_topics` 
																	  WHERE `topicid`='$topic'", SQL_NUM);

	  if ($topictext == $sitename)
	  $newpagetitle= "$sitename $item_delim $name";
	  else
	  $newpagetitle= "$sitename $item_delim $name $item_delim $topictext"; 	 	  	 	 
      
	  $facebook_ogdescription = "<meta property=\"og:description\" content=\"Current $name Topic -] $topictext [-\" />\n";

      //facebook page image
      $facebook_ogimage_normal = "<meta property=\"og:image\" content=\"".HTTP."images/topics/$topicimage\" />\n";
	  $facebook_ogimage = "<meta property=\"og:image:secure_url\" content=\"".HTTPS."images/topics/$topicimage\" />\n";
	  
	  $facebookimagetype = "<meta property=\"og:image:type\" content=\"image/png\" />\n"; 
      $facebook_ogimage_width = "<meta property=\"og:image:width\" content=\"200\" />\n";
      $facebook_ogimage_height = "<meta property=\"og:image:height\" content=\"200\" />\n";
	}
    else 
	if ($file == 'categories' && isset($catid) && is_numeric($catid))
	{
      $facebook_ogurl = "<meta property=\"og:url\" content=\"".HTTPS."modules.php?name=$name&file=categories&op=newindex&catid=$catid\" />\n";
	  
	  // _stories -> topic is the same as _topics -> topicid
	  list($cattitle) = $db->sql_ufetchrow("SELECT `title` FROM `".$prefix."_blogs_cat` WHERE `catid`='$catid'", SQL_NUM);
      
	  if ($cattitle == $sitename)
	  $newpagetitle= "Current $name Category $item_delim $cattitle"; 	 	 
	  else
	  $newpagetitle= "$sitename $item_delim Current $name Category $item_delim $cattitle"; 	 	 

      $facebook_ogdescription = "<meta property=\"og:description\" content=\"Current $name Category -] $cattitle [-\" />\n";
	}
?>