<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* Theme Article 
/*--------------------------*/
function themearticle($aid, $informant, $datetime, $modified, $title, $counter, $thetext, $topic, $topicname, $topicimage, $topictext, $writes = false) 
{
    global $bgcolor4, $admin, $sid, $tipath, $theme_name, $appID, $my_url;
    global $digits_color, $digits_txt_color;
	
echo "\n\n<!-- function themearticle START -->\n";

if (!empty($topicimage)) 
{
 $t_image = (file_exists(theme_images_dir.'topics/'.$topicimage)) ? theme_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
 $topic_img = '<td width="25%" align="center" class="extra"><a href="modules.php?name=Blogs&new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';
	} 
	else 
	$topic_img = '';
	
	$notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
	$content = '';
	
	if ($aid == $informant) 
	    $content = $thetext.$notes;
	else 
	{
		if ($writes)
		{
			if (!empty($informant)) 
			{
				$content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
			}
			else 
				$content = $anonymous.' ';
			
			$content .= _WRITES.' '.$thetext.$notes;
		} 
		else 
			$content .= $thetext.$notes;
	}

$posted .= '<strong>Posted by '.get_author($aid).' '.$datetime.'</strong>';
$reads = '(<span style="color: '.$digits_txt_color.';"> Reads :</span> <span style="color: '.$digits_color.';"><strong>'.$counter.'</strong></span> )';

global $opacity;
print '<table style="opacity: '.$opacity.';" cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";

print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td valign="top" align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/top_middle_piece.png);"><br />PHP-Nuke Titanium (US Version)</td>'."\n";

print '<td align="right" width="39">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/left_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '<td width="100%">'."\n";
print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";

# This stays no matter what START
print '<div align="center">';
print '<table style="background-color: none; height:100%; width:99%;" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="theme_article">';
print '<tbody>';
print '<tr>';
print '<td>';

print '<div align="center" style="padding-top:14px;">';
print '</div>';

echo '<div align="center" id="text"><h1><font size="6"><strong>'.$topictext.'</strong></font><br/></h1>';
print '</div>';

print '<div align="center" style="padding-top:1px;"><h2><font size="4"><strong>'.$title.'</strong></font></h2>';
print '</div>';

print ''.$posted.'';

print '<div align="center" style="padding-top:6px;">';
print '</div>';

echo "<!-- CONTENT THEME ARTICLE START -->\n\n";

//content START
echo '<div align="left" id="text">';
echo ''.$content.'</div>';
//content END

echo "\n\n<!-- CONTENT THEME ARTICLE END -->\n\n";

print blog_signature($aid);

echo "\n\n<!-- facebook functions START -->\n";
facebook_likes();
facebook_comments();
echo "<!-- facebook functions END -->\n\n\n";

echo '<div valign="bottom" align="right">'.$reads.'</div>';

print '<div align="center" style="padding-top:14px;">';
print '</div>';

print '</td>';
print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';

# This stays no matter what END	

print '</td>';
print '</tr>';
print '</table>';
print '</td>';

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/right_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/right_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";
print '</td>'."\n";
print '</tr>'."\n";
print '<tr>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/bottom_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" background="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/bottom_middle_piece.png"></td>'."\n";

print '<td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/BLOG/bottom_right_corner.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '</table>'."\n";

# This sets the space between blogs listed START
print '<div align="center" style="padding-top:6px;">';
print '</div>';
# This sets the space between blogs listed END

echo "\n<!-- function themearticle END -->\n\n\n";
}
?>
