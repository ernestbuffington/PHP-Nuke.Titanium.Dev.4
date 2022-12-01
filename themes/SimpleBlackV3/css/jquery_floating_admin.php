<?php
global $theme_name;

echo "/* themes/".$theme_name."/css/jquery_floating_admin.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $font_color, $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
global $font_colorH, $font_colorV, $font_colorA, $font_colorL, $body_color; 


?>
/**
 * Very simple jQuery plugin to keep all important admin link in a nice floating menu. 
 *
 * @package    Floating admnistration links
 * @author     Author <crazycoder@live.co.uk>
 * @copyright  2016 - 2019 by lonestar-modules.com
 * @version    2.0
 */

.toggle-menu 						
{ 

padding: 10px 10px 10px 10px; 
margin-top: 0px; 
color: white;
cursor: pointer; 
background-color: rgba(17,17,17,0.9); 
z-index: 1000; font-size: 2em; 
left: 0px !important;
}

.toggle-menu > .fa-menu-icon 		
{ 
transition: transform .3s; color: #d8d8d8; 
}

.toggle-menu:hover > .fa-menu-icon 	
{ 
transition: transform .3s; 
transform: rotate(-180deg) scale(1); 
}

.sidebar-menu 						
{ 
position: fixed; 
width: 250px; 
z-index: 999999999; 
top: 0; 
left: 0; 
bottom: 0; 
background-color: <?=$bgcolor4?>; 
color: <?=$font_colorH?>;
height: 100vh;	
max-height: 100%; 
}

.sidebar-menu ul 					
{ 
list-style: none; 
color: <?=$font_colorH?>;
}

.fa-times-extend 					
{ 
color: <?=$font_colorH?>;
right: 10px; 
top: 8px; 
cursor: pointer; 
position: absolute; 
transition: all 0.2s ease-in-out; 
font-size: 20px; 

}

.fa-times-extend:hover 				
{ 
opacity: 1; 
color: red; 
}

.navigation-section 				
{ 
padding: 0; 
margin: 35px 0; 
display: block; 
color: <?=$font_colorH?>;
}

.navigation-item 					
{ 
font-weight: 200; 
box-sizing: border-box; 
font-size: 14px; 
transition: all 0.3s; 
cursor: pointer; 
color: <?=$font_colorH?>;
}

.navigation-item-divider 			
{ 
display: block; 
margin: 10px 20px; 
border-top: 1px solid #0a0a0a; 
-webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.04); 
box-shadow: inset 0 1px 0 rgba(255,255,255,.04); 
height: 8px; 
color: <?=$font_colorH?>;
}

.navigation-item a 					
{ 
user-select: none; 
position: relative; 
display: block; 
padding: 5px 20px; 
font-family: inherit; 
font-weight: 200; 
font-size: 14px; 
color: <?=$font_colorH?>;
}
.navigation-item a:before 			
{ 
content: ''; 
display: block; 
position: absolute; 
width: 0; 
height: 100%; 
left: 0; 
top: 0; 
-webkit-transition: width .3s; 
transition: width .3s; 
color: <?=$font_colorH?>;
}

.navigation-item a:focus:before, 
.navigation-item a:hover:before 	
{ 
width: 4px; 
color: <?=$font_colorH?>;
}

.navigation-item a .fas 			
{ 
color: <?=$font_colorH?>;
vertical-align: sub; 
text-align: left; 
font-size: 22px; 
width: 1.2857142857142858em; 
}

.navigation-section > li:hover > a, 
.navigation-section > li > a:hover 	
{ 
background-color: rgba(0,0,0,.2); 
transition: width 3s 
color: <?=$font_colorH?>;
}

.hide-menu 							
{ 
margin-left: -252px; 
color: <?=$font_colorH?>;
}

.opacity-one 						
{ 
opacity: 1; 
transition: all 0.2s; 
color: <?=$font_colorH?>;
}
