<?php
global $theme_name;
echo "/* Fly Kit Footer Style Sheet */\n"; 
echo "/* ".$theme_name."/css/footer.php (Footer Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
global $choose, $filename1;
   
  
   $filename1 = 'black_glass_once_piece_header.png'; 
   define('LOGO_BACKGROUND', '"../../../themes/'.$theme_name.'/backgrounds/'.$filename1.'"'); 
   define('CONTAIN', 'background-repeat: no-repeat;
                background-position: center center; 
					                    width 100%;
					                  height 115px;
					                  z-index: 780;
					        background-size: cover;					                  
							          opacity: 1.0;');
?>
/*---------------------------------------------------------------*/
/* Footer Style Sheet                                            */
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
/* Footer Style Sheet                                            */
/*---------------------------------------------------------------*/
.flames {
  background: url(<?php echo LOGO_BACKGROUND; ?>);
<?php echo CONTAIN; ?> 
}

.inferno_footer_table {
  opacity: 0.9;
   background-color: black; 
    background-image: 
     url(themes/<?=$theme_name?>/backgrounds/top_box.png),       /* top black glass - TheGhost add 03/19/2021 */
      url(themes/<?=$theme_name?>/backgrounds/box_bottom.png);    /* bottom flames   - TheGhost add 03/19/2021 */
     background-position:
    top right, 
   bottom left; 
  background-repeat: 
 repeat-x; /* this makes the top glass block and the bottom flame block repeat from left to right and vice vs - TheGhost add 08/04/2019 */ 
}
<?
