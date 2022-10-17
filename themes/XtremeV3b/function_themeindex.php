<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) exit('Access Denied');

function themeindex($aid, $informant, $time, $modified, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext, $writes = false) 
{
    global $anonymous, $blogadmin, $tipath, $theme_name, $sid, $ThemeSel, $nukeurl, $customlang;
    global $digits_color, $digits_txt_color;
    global $anonymous, $tipath, $theme_name, $sid, $ThemeSel, $nukeurl, $customlang;

    if (!empty($topicimage)):
        $t_image = (file_exists(xtremev3b_images_dir.'topics/'.$topicimage)) ? xtremev3b_images_dir.'topics/'.$topicimage : $tipath.$topicimage;
        $topic_img = '<td class="col-3 extra" style="text-align:center;"><a href="modules.php?name=Blogs&new_topic='.$topic.'">';
		$topic_img .= '<img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'"></a></td>';
    else:
        $topic_img = '';
    endif;

    $notes = (!empty($notes)) ? '<br /><br /><strong>'._NOTE.'</strong> '.$notes : '';
    $content = '';

    if ($aid == $informant):
        $content = $thetext.$notes;
    else: 

        if ($writes):

            if (!empty($informant)) :
                $content = (is_array($informant)) ? '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'
				.$informant[1].'</a> ' : '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
            else:
                $content = $anonymous.' ';
            endif;
               $content .= _WRITES.' '.$thetext.$notes;
        else:
               $content .= $thetext.$notes;
        endif;
    endif;

    $posted = sprintf($customlang['global']['posted_by'], get_author($aid), $time);
    $datetime = substr($morelink, 0, strpos($morelink, '|')-strlen($morelink));
    $morelink = substr($morelink, strlen($datetime)+2);
    $reads = '( <span style="color: yellow;">'.$customlang['global']['reads'].'</span>: <span style="color: red;">'.$counter.'</span> )';

   print '<table class="otthree"border="0" width="100%" cellspacing="0" cellpadding="0">';
   print '<tr>';
   print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png" align="left" width="39" colspan="2">';
   print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/leftcorner.png" width="39" height="50"></td>';
   print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png" width="100%">';
   print '<span class="blocktitle"><div align="center"><strong>'.$topictext.' » '.$title.'</strong></div></span>';
   print '</td>';
   print '<td background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/topmiddle.png" align="right" width="39" colspan="2">';
   print '<img src="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/rightcorner.png" width="39" height="50"></td>';
   print '</tr>';
   print '<tr>';
   print '<td width="15" background="'.HTTPS.'themes/'.$theme_name.'/tables/OpenTable/leftside.png"></td>';
   print '<td width="24"></td>';
   print '<td width="100%">';
   echo '<div align="left" id="text">'.''.$title.'</div><p>';
   print '<div align="left" id="text">';
   print ''.$posted.'';
   print '<hr>'.$content.'<hr></div>';	
   print blog_signature($aid);
   print '<div align="center"><img src="themes/'.$theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="20" border="0" /><br />'
   .$datetime.' '.$topictext.' | '.$morelink.' '.$reads.'<img src="themes/'.  $theme_name.'/images/invisible_pixel.gif" alt="" width="4" height="1" border="0" /></div>';
CloseTable();
}
