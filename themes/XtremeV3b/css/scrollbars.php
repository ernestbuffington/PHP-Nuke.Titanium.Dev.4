<?php
global $theme_name;
echo "/* Fly Kit Scroll Bars Style Sheet */\n"; 
echo "/* ".$theme_name."/css/scrollbars.php (Scroll Bar Settings) */\n\n"; 
global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
?>
/*---------------------------------------------------------------*/
/* Scroll Bar CSS                                                */
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
/* Scroll Bar CSS                                                */
/*---------------------------------------------------------------*/

::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: <?=$bgcolor2?>; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: <?=$bgcolor5?>; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: <?=$bgcolor1?>; 
}
<?
