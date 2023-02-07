<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* Theme Article 
/*--------------------------*/
function themearticle($aid, $informant, $datetime, $modified, $title, $counter, $thetext, $topic, $topicname, $topicimage, $topictext, $writes = false) 
{
  print "\n\n<!-- THEME ARTICAL CONTENT START -->\n";

  global $userinfo, $bgcolor4, $admin, $sid, $tipath, $theme_name, $appID, $my_url;
  global $digits_color, $digits_txt_color;
	
    if (!empty($topicimage)) 
    {
      $t_image = (file_exists(theme_images_dir.'topics/'.$topicimage)) ? theme_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
      $topic_img = '<td width="25%" align="center" class="extra"><a href="modules.php?name=Blogs&new_topic='.$topic.'"><img src="'.$t_image.'" alt="'.$topictext.'" title="'.$topictext.'"></a></td>'.PHP_EOL;
	} 
	else 
	$topic_img = '';
	
	$notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : ''.PHP_EOL;
	$content = '';
	
	if ($aid == $informant) 
	    $content = $thetext.$notes;
	else 
	{
		if ($writes)
		{
			if (!empty($informant)) 
			{
				$content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a 
				href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> '.PHP_EOL;
			}
			else 
				$content = $anonymous.' ';
			
			$content .= _WRITES.' '.$thetext.$notes;
		} 
		else 
			$content .= $thetext.$notes;
	}

print '<section id="content">';  

$posted = '<strong>Posted by '.get_author($aid).' '.$datetime.'</strong>'.PHP_EOL;
$reads = '(<span style="color: '.$digits_txt_color.';"> Reads :</span> <span style="color: '.$digits_color.';"><strong>'.$counter.'</strong></span> )'.PHP_EOL;

print '<div align="center" id="borderThemeArticle">'.PHP_EOL;

echo '<div align="center" id="text"><strong>'.$topictext.'</strong></div>'.PHP_EOL;

print '<div align="center" style="padding-top:1px;"><strong>'.$title.'</strong></div>'.PHP_EOL;

print '<div align="left" id="text">'.$posted.'</div>'.PHP_EOL;

print '<div align="center" style="padding-top:6px;"></div>'.PHP_EOL;

//content START
echo '<div align="left" id="text">'.PHP_EOL;
echo ''.$content.''.PHP_EOL;
//content END

print blog_signature($aid).''.PHP_EOL;

print '</div>'.PHP_EOL;
print '<br/><br/>';
print '<section id="comments">';

print '<div align="left" id="respond">';

print '  <h3>Leave a Comment</h3>';

print '  <form action="post_comment.php" method="post" id="commentform">';

print '    <label for="comment_author" class="required">Your name</label><br/>';
print '    <input type="text" name="comment_author" id="comment_author" value="'.$userinfo['username'].'" tabindex="1" required="required"><br/>';

print '    <label for="email" class="required">Your email;</label><br/>';
print '    <input type="email" name="email" id="email" value="'.$userinfo['user_email'].'" tabindex="2" required="required"><br/>';

print '    <label for="comment" class="required">Your message</label><br/>';
print '    <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea><br/>';

//print '    <-- comment_post_ID value hard-coded as 1 -->';
print '    <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID" /><br/>';
print '    <input name="submit" type="submit" value="Submit comment" /><br/>';

print '  </form>';

print '</div>';


echo '<div valign="bottom" align="right">'.$reads.'</div>'.PHP_EOL;

print '<div align="center" style="padding-top:14px;"></div>'.PHP_EOL;

print '</div>'.PHP_EOL;

print '<div align="center" style="padding:10px;">'.PHP_EOL;
print '</div>'.PHP_EOL;

print "<!-- THEME ARTICAL CONTENT END -->\n\n";
}

?>
