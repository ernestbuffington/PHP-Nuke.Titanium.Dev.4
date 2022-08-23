<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

//Display the page title
donation_title();


//Get values
global $gen_configs;
$gen_configs = get_gen_configs();

OpenTable();
echo "<div align=\"center\">\n";
if(!empty($gen_configs['cancel_image'])) {
    echo "<img src=\"".$gen_configs['cancel_image']."\" border=\"0\" alt=\"\">\n";
    echo "<br />";
}
echo nl2br($gen_configs['cancel_message']);
echo "</div>";
CloseTable();

?>