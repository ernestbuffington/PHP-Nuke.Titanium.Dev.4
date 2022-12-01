<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/*--------------------------*/
/* Theme Index
/*--------------------------*/
function themeindex($aid, $informant, $time, $modified, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext, $writes = false) 
{
    print "\n\n<!-- THEME INDEX CONTENT START -->\n";
	
    global $bgcolor4, $anonymous, $blogadmin, $tipath, $theme_name, $sid, $ThemeSel, $nukeurl, $customlang;
    global $digits_color, $digits_txt_color;

    if (!empty($topicimage)):
    
        $t_image = (file_exists(theme_images_dir.'topics/'.$topicimage)) ? theme_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
        $topic_img = '<td class="col-3 extra" style="text-align:center;"><a href="modules.php?name=Blogs&new_topic='.$topic.'"><img src="'.$t_image.'" alt="'.$topictext.'" title="'.$topictext.'"></a></td>'.PHP_EOL;
    else:
        $topic_img = ''.PHP_EOL;
    endif;

    $notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : ''.PHP_EOL;
    $content = '';

    if ($aid == $informant):
        $content = $thetext.$notes;
    else: 

        if ($writes):

            if (!empty($informant)) :
                $content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> '.PHP_EOL;
            else:
                $content = $anonymous.' '.PHP_EOL;
            endif;
            $content .= _WRITES.' '.$thetext.$notes;

        else:
            $content .= $thetext.$notes;
        endif;

    endif;

$posted = '<strong>Posted by '.get_author($aid).' '.$time.'</strong>'.PHP_EOL;
$datetime = substr($morelink, 0, strpos($morelink, '|')-strlen($morelink));
$morelink = substr($morelink, strlen($datetime)+2);
$reads = '( <span style="color: '.$digits_txt_color.';">'.$customlang['global']['reads'].'</span>: <span style="color: '.$digits_color.';"><strong>'.$counter.'</strong></span> )'.PHP_EOL;

print '<div align="center" id="borderThemeIndex">'.PHP_EOL;

echo '<div align="center" id="text"><strong>'.$title.'</strong>'.PHP_EOL;
print '</div>'.PHP_EOL;

print '<div align="left" style="padding-top:6px;">'.PHP_EOL;
print ''.$posted.''.PHP_EOL;
print '</div>'.PHP_EOL;

print '<div align="center" style="padding-top:6px;">'.PHP_EOL;
print '</div>'.PHP_EOL;

//content
echo '<div align="left" id="text">'.PHP_EOL;
echo ''.$content.''.PHP_EOL;	

print blog_signature($aid).''.PHP_EOL;
print '</div>';

echo '<div align="center"><br />'.$datetime.' '.$topictext.' | '.$morelink.' '.$reads.'<img src="themes/'.$theme_name.'/images/BLOG/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>'.PHP_EOL;

print '<div align="center" style="padding-top:14px;">'.PHP_EOL;
print '</div>'.PHP_EOL;

print '</div>'.PHP_EOL;
# This stays no matter what END

# This sets the space between blogs listed START
print '<div align="center" style="padding:10px;">'.PHP_EOL;
print '</div>'.PHP_EOL;
# This sets the space between blogs listed END

print "<!-- THEME INDEX CONTENT END -->\n\n";
}
?>
