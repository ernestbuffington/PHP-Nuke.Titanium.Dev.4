<?php
global $theme_name;

echo "\n\n/* Universal/css/footer.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

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
.flames
{
    background: url(<?php echo LOGO_BACKGROUND; ?>);
	<?php echo CONTAIN; ?> 
}

.inferno_footer_table
{
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
