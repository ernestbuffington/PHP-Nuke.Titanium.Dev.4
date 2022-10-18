<?php
global $theme_name;
echo "/* Fly Kit Banner Ads Style Sheet */\n"; 
echo "/* ".$theme_name."/css/banner_ads.php (Banner Ad Settings) */\n\n"; 
global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* <?=$bgcolor1?> */
?>
/*---------------------------------------------------------------*/
/* Banner Ads CSS                                                */
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
/* Banner Ads CSS                                                */
/*---------------------------------------------------------------*/
#hdr-banner-ads {
	width: 468px;
	height: 60px;
	float: right;
	clear: right;
	margin: 40px 15px 0 0;
}

.banner_box {
  z-index: 780;
   color: rgb(104, 182, 4);
 opacity: 9.0;
}

.banner_left {
position: absolute;
margin: 92px 95px 15px 95px;
left: 0;
display:inline;
z-index: 9999;
}

.banner_right {
position: absolute;
margin: 15px 95px 15px 10px;
right: 0;
display:inline;
z-index: 9999;
}
<?
