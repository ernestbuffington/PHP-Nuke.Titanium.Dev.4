<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;

/*--------------------------*/
/* function OpenTable() 
/*--------------------------*/
function OpenTable() 
{
global $theme_name, $bgcolor4;

echo "\n\n<!-- function_OpenTable START -->\n";
print '<table class=table100">'."\n";

print '<tr><td class="tableSB_width_definedLT">'."\n";

print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_left_corner.png" width="39px" height="50px"></td>'."\n";

print '<td class="opentable_width_definedTM"></td>'."\n";

print '<td class="tableSB_width_definedLT">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/top_right_corner_10.png" width="39px" height="50px"></td>'."\n";

print '</tr>'."\n";
print '<tr><td colSpan="3">'."\n";
print '<table class="table100">'."\n";
print '<tr>'."\n";

print '<td class="table1_width_definedLSM">'."\n";
print '<img src="'.HTTPS.'themes/'.$theme_name.'/images/TABLES/left_side_middle_151515.png" width="39px" height="3px"></td>'."\n";

print '<td width="100%">'."\n";
print '<table class="table100">'."\n";
print '<tr>'."\n";
print '<td width="100%" bgcolor="'.$bgcolor4.'">'."\n";
echo "<!-- function_OpenTable top END -->\n\n\n\n\n";
}
?>


