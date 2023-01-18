<?php
global $theme_name;
echo "/* Fly Kit CSS Forum Style Sheet */\n"; 
echo "/* ".$theme_name."/css/primary_page_styles.php (Forum Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Primary Page Styles Sheet                                     */
/*                                                               */
/* Designed and Coded By: Ernest Buffington aka TheGhost         */
/* Coded On: 16th October, 2022                                  */
/* Copyright © 2022 Brandon Maintenance Management               */
/*                                                               */
/* PLEASE STEAL AND/OR USE THIS CSS CODE                         */
/* NO NEED FOR WRITTEN PERMISSION                                */
/* I did not trade a goat for this code!                         */
/*---------------------------------------------------------------*/

/*---------------------------------------------------------------*/
/* Primary Page Styles Sheet                                     */
/*---------------------------------------------------------------*/

#flex-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

#flex-item {

}

.container {
	margin: 0 auto;
}

body {	
	font-size: 14px;
	color: #fff;
	font-family: "Open Sans", sans-serif;
	text-rendering: optimizeLegibility;
}

a { 
	color: #ccc;
	text-decoration: none;
}

a:hover,
a.bbcode-href:hover { 
	color: #f5a405;
}

a.bbcode-href {
	color: #ce982d;
}
<?
