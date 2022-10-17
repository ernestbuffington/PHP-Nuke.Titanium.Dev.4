<?php
global $theme_name;
echo "/* Fly Kit Side Blocks Style Sheet */\n"; 
echo "/* ".$theme_name."/css/sideblocks.php (Side Blocks Style Sheet) */\n\n"; 

global $screen_width, $screen_height;

?>
/*---------------------------------------------------------------*/
/* Side Blocks Style Sheet                                       */
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
/* Side Blocks Style Sheet                                       */
/*---------------------------------------------------------------*/

.sideblock_flames {
  opacity: 0.9;
   background-color: black;	
    background-image: 
     url(../../../themes/<?=$theme_name?>/backgrounds/glasstop.png),
      url(../../../themes/<?=$theme_name?>/backgrounds/box_bottom.png);
      background-position:
     top right,   /* this positions the first image  - TheGhost add 3/19/2021 */
    bottom left;  /* this positions the second image - TheGhost add 3/19/2021 */
   background-repeat:
  no-repeat;      /* this applies to both images     - TheGhost add 3/19/2021 */ 
}
<?
