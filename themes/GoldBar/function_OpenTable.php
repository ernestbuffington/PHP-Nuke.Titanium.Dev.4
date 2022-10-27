<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
    exit('Access Denied');

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() 
{
global $theme_name, $bgcolor4, $opacity;

echo "\n\n<!-- function_OpenTable START -->\n";
print '<table style="opacity: '.$opacity.';" cellSpacing="0" cellPadding="0" border="0" width="100%">'."\n";

print '<tr><td width="39" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/TABLES/invisible_pixel.gif);">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_left_corner.png" border="0" width="39" height="50"></td>'."\n";

print '<td align="center" style="background: repeat-x; background-image: url('.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_middle_piece.png);"></td>'."\n";

print '<td align="right" width="39">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_right_corner_10.png" border="0" width="39" height="50"></td>'."\n";

print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table cellSpacing="0" cellPadding="0" width="100%" border="0">'."\n";
print '<tr>'."\n";

print '<td width="39" height="3" background="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/left_side_middle_151515.png">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/left_side_middle_151515.png" border="0" width="39" height="3"></td>'."\n";

print '<td width="100%">'."\n";
print '<table cellSpacing="0" cellPadding="8" width="100%" border="0" style="border-collapse: collapse" bordercolor="#111111">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";
echo "<!-- function_OpenTable top END -->\n\n\n\n\n";
}
?>


