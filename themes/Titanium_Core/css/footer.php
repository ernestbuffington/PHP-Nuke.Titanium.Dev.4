<?php
global $theme_name;

echo "\n\n/* themes/".$theme_name."/css/footer.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
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

<?
