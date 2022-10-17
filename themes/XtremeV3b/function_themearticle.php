<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

function themearticle($aid, $informant, $datetime, $modified, $title, $counter, $thetext, $topic, $topicname, $topicimage, $topictext, $writes = false) 
{
    global $admin, $sid, $tipath, $theme_name, $appID, $my_url;
    global $digits_color, $digits_txt_color;

	if (!empty($topicimage)): 
		$t_image = (file_exists(xtremev3b_images_dir.'topics/'.$topicimage)) 
		? xtremev3b_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
		$topic_img  = '<td width="25%" align="center" class="extra">';
		$topic_img .= '<a href="modules.php?name=Blog&new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';
	else: 
		$topic_img = '';
	endif;
	$notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
	$content = '';
	if ($aid == $informant): 
		$content = $thetext.$notes;
	else: 
		if ($writes):
			if (!empty($informant)): 
				$content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='
				.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
			else: 
				$content = $anonymous.'';
			endif;
			    $content .= _WRITES.' '.$thetext.$notes;
		else: 
			    $content .= $thetext.$notes;
       endif;
	endif;
    $posted = _POSTEDON.' '.$datetime.' '._BY.' ';
    $posted .= get_author($aid);
    $reads = '( <span style="color: yellow;">Reads</span>: <span style="color: red;">'.$counter.'</span> )';
    print '<table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">';
    print '<tr>';
    print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">';
    print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/leftcorner.png" width="39" height="50"></td>';
    print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png" width="100%">';
    print '<span class="blocktitle"><div align="center"><strong>'.$title.'</strong></div></span>';
    print '</td>';
    print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">';
    print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/rightcorner.png" width="39" height="50"></td>';
    print '</tr>';
    print '<tr>';
    print '<td width="15" background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/leftside.png"></td>';
    print '<td width="24"></td>';
    print '<td width="100%">';
    print '<div align="left" id="text">'.''.$title.'</div><p>';
    print '<div align="left" id="text">';
	print ''.$posted.'';
    print '<hr>'.$content.'<hr></div>';
    print blog_signature($aid);
    print "\n\n".'<!-- facebook functions START -->'."\n";
    facebook_likes();
    facebook_comments();
    print '<!-- facebook functions END -->'."\n\n\n";	
    print '<div align="right"><img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="20" border="0" /><br />'.$reads.'<img 
	src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>';
    print '</td>';
    print '<td width="25"></td>';
    print '<td width="15" background="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/rightside.png"></td>';
    print '</tr>';
    print '<tr>';
    print '<td align="left" width="39" colspan="2"><img src="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/leftbottomcorner.png"></td>';
    print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/bottommiddle.png" width="100%"></td>';
    print '<td align="right" width="39" colspan="2"><img src="'.HTTPS.'themes/'.$theme_name.'/tables/CloseTable/bottomrightcorner.png"></td>';
    print '</tr>';
    print '</table>';
    print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/invisible_pixel.gif" height=6><br>'."\n";
}
