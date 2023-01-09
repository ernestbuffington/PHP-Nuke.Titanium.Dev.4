<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

include_once(NUKE_DONATIONS_INCLUDES . 'base.php');

/*==============================================================================================
    Function:    head_open()
    In:          $title
                    Header title
    Return:      N/A
    Notes:       Displays the page header, graphic admin, and the title
================================================================================================*/
function head_open ($title='') {
    global $sitename, $lang_donate, $admin_file;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
	echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=Donations\">" .$lang_donate['ADMIN_HEADER']. "</a></div>\n";
    echo "<br /><br />";
	echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" .$lang_donate['RETURNMAIN']. "</a> ]</div>\n";
	CloseTable();
	//echo "<br />";
    //title("<div align=\"center\">\n".$title."</div>\n");
    OpenTable();
    return;
}

/*==============================================================================================
    Function:    foot_close()
    In:          N/A
    Return:      N/A
    Notes:       Close the open table and displays the footer
================================================================================================*/
function foot_close () {
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
    return;
}

/*==============================================================================================
    Function:    br2nl()
    In:          N/A
    Return:      N/A
    Notes:       Changes <br> or <br /> to \n
================================================================================================*/
function br2nl($str) {
   $str = preg_replace("/(\r\n|\n|\r)/", "", $str);
   return preg_replace("=<br */?>=i", "\n", $str);
}

/*==============================================================================================
    Function:    config_select()
    In:          N/A
    Return:      N/A
    Notes:       Displays the donation config links
================================================================================================*/
function config_select () 
{
    global $lang_donate, $admin_file;
    echo '<table style="margin: auto; width: 50%;" cellpadding="4" cellspacing="1" border="0" class="forumline">';
    echo '  <tr>';
    echo '    <td class="row1"><a href="'.$admin_file.'.php?op=Donations&amp;file=current">'.$lang_donate['CURRENT_DONATIONS'].'</a></td>';
    echo '    <td class="row1"><a href="'.$admin_file.'.php?op=Donations&amp;file=add">'.$lang_donate['ADD_DONATION'].'</a></td>';
    echo '    <td class="row1"><a href="'.$admin_file.'.php?op=Donations&amp;file=values">'.$lang_donate['DONATION_VALUES'].'</a></td>';
    echo '  </tr>';

    echo '  <tr>';
    echo '    <td class="row1"><a href="'.$admin_file.'.php?op=Donations&amp;file=config_block">'.$lang_donate['CONFIG_BLOCK'].'</a></td>';
     echo '   <td class="row1"><a href="'.$admin_file.'.php?op=Donations&amp;file=config_donations">'.$lang_donate['CONFIG_GENERAL'].'</a></td>';
    echo '    <td class="row1"><a href="'.$admin_file.'.php?op=Donations&amp;file=config_page">'.$lang_donate['CONFIG_PAGE'].'</a></td>';
    echo '  </tr>';
    echo '</table>';
}

/*==============================================================================================
    Function:    DonateError()
    In:          $text
                    Message text
                 $close
                    CloseTable or not
    Return:      N/A
    Notes:       Displays an error message
================================================================================================*/
function DonateError($text, $close=1) {
    global $lang_donate;
    echo '<div align="center">';
    echo $lang_donate['ERROR'] . '<br />';
    echo $text;
    echo '</div>';
    if ($close) {
        CloseTable();
    }
    die();
}

/*==============================================================================================
    Function:    donate_radio()
    In:          $data
                    Array of radio button data
                 $br
                    A <br /> after the radio button
    Return:      Radio button HTML code using the passed in array
    Notes:       N/A
================================================================================================*/
function donate_radio ($data, $br=0) {
    $out = '';
    foreach ($data as $single) {
        $mouseover = '';
        // if (isset($single['mouseover'])) {
        //     $mouseover = $single['mouseover'];
        // }
		if(!isset($single['help']))
		$single['help'] = '';
        $out .= "<input type=\"radio\" name=\"".$single['name']."\" value=\"".$single['value']."\" ".$single['help']." ".$single['checked']." ".$mouseover.">".$single['text']."\n";
        // if($br) {
        //     $out .= "<br />";
        // }
    }
    // if ($br) {
    //     $out = substr($out, 0, strlen($out) - 6);
    // }
    return $out;
}

/*==============================================================================================
    Function:    donate_text()
    In:          $name
                    Name of the text box
                 $text
                    Text to be displayed in the box
                 $size
                    Size of the text box
                 $max
                    Max characters
    Return:      Text box HTML code
    Notes:       N/A
================================================================================================*/
function donate_text ($name, $text, $size='', $max='', $help='') {
    $size = ($size) ? "size=\"".$size."\"" : '';
    $max = ($max) ? "maxlength=\"".$max."\"" : '';
    return "<input type=\"text\" name=\"".$name."\" value=\"".$text."\" ".$size." ".$max." $help />";
}

/*==============================================================================================
    Function:    donate_area()
    In:          $name
                    Name of the text area
                 $text
                    Text to be displayed in the area
                 $rows
                    How many rows big
                 $cols
                    How many cols big
    Return:      Text area HTML code
    Notes:       N/A
================================================================================================*/
function donate_text_area ($name, $text, $rows=5, $cols=20, $help='') {
    
	if(!isset($size))
	$size = '';

	if(!isset($max))
	$max = '';
	
	$size = ($size) ? "size=\"".$size."\"" : '';
    $max = ($max) ? "maxlength=\"".$max."\"" : '';
    return "<TEXTAREA name=\"".$name."\" rows=\"".$rows."\" cols=\"".$cols."\" $help />".$text."</TEXTAREA>";
}

/*==============================================================================================
    Function:    donate_combo()
    In:          $name
                    Name of the combo box
                 $data
                    Array of the data to put in the box
                 $default
                    Default choice
    Return:      Combo box HTML code
    Notes:       N/A
================================================================================================*/
function donate_combo ($name, $data, $default) {
    $out = "<select name=\"".$name."\">\n";
    foreach ($data as $single) {
        $selected = ($default == $single['value']) ? 'SELECTED' : '';
        $out .= "<option value=\"".$single['value']."\" ".$selected.">".$single['text']."</option>\n";
    }
    $out .= "</select>\n";
    return $out;
}

/*==============================================================================================
    Function:    make_help_popup()
    In:          $text
                    Popup text
                 $caption
                    Popup caption
    Return:      N/A
    Notes:       The javacode for the popup
================================================================================================*/
function make_help_popup($text, $caption) {
    return "onmouseover=\"return overlib('".$text."', BELOW, CENTER, CAPTION, '".$caption."', WIDTH, 300, OFFSETY, 20, FGCOLOR, '#ffffff', BGCOLOR, '#000000', TEXTCOLOR, '#000000', CAPCOLOR, '#ffffff', CLOSECOLOR, '#ffffff', CAPICON, '', BORDER, '2');\" onmouseout=\"return nd();\"";
}

?>