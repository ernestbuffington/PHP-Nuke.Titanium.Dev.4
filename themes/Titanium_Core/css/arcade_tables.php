<?php
global $theme_name; 

echo "\n\n/* ".$theme_name."/css/arcade_tables.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* <?=$bgcolor1?> */
?>
/* Main arcade table cell colors and backgrounds */
td.arcade_row1 {
	background: #988653;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

td.arcade_row2 {
	background: #8d7b4d;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

td.arcade_row3 {
	background: #8d7b4d;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

/* Arcade Category Row Left */
td.arcade_cat, td.arcade_catHead, td.arcade_catSides, td.arcade_catLeft, td.arcade_catRight, td.arcade_catBottom {
	background-color: #343434;
	color: #FFF;
	border: 1px solid #787878;
	white-space: nowrap;
	padding: 4px;
}

td.arcade_cat, td.arcade_catHead, td.arcade_catBottom {
	white-space: nowrap;
  	background: #8d7b4d;
	border: 3px solid #c9b06d;
	padding: 4px;
   
}
<?
