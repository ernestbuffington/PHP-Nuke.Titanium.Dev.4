<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

global $ThemeSel;

echo "<script languag=\"JavaScript\" src=\"themes/".$ThemeSel."/js/fade.js\"></script>\n";
echo "<script language=\"javascript\" src=\"themes/".$ThemeSel."/js/liveclock.js\"></script>\n";
echo "<script language=\"javascript\" src=\"themes/".$ThemeSel."/js/typeface-0.15.js\"></script>\n";
echo "<script language=\"javascript\" src=\"themes/".$ThemeSel."/fonts/helvetiker_bold.typeface.js\"></script>\n";
?>