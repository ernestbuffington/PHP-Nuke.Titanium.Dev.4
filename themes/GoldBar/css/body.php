<?php
global $theme_name;
echo "\n\n/* ".$theme_name."/css/body.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 
global $screen_width, $screen_height;

?>
/*
 * 4. Page Header
 *--------------------------------------------------
*/
fieldset {
 display: block; 
  margin-left: 2px; 
   margin-right: 2px; 
	padding-top: 0.15em; 
     padding-bottom: 0.625em; 
     padding-left: 0.75em; 
    padding-right: 0.75em; 
     border: 2px groove (internal value);
    -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
  border-radius: 8px;
}

/* Modules Link START */
a.modules,input.modules
{
 display:inline-block;
 box-sizing: border-box;
 text-decoration:none;
 font-family:'Roboto',sans-serif;
 font-weight:bold;
 
 /* Start Link Color - Regular Appearance */
 color: #d5dfe3;
 
 text-align:center;
 transition: all 1.0s;
}
a.modules:hover,input.modules:hover
{
  /* Main Font Color */
  color: white;
 /* Highlight Color On Hover */
}

@media all and (max-width:30em)
{
  a.modules, input.modules
  {
    display:block;
  }
}
/* Modules Link END */

.visitors:hover
{
/* filter: grayscale(0%); */
  filter: saturate(5px);
  transform: rotate(360deg);
  transition: transform .8s ease-in-out;
  cursor: pointer;
}
.visitors
{
/* filter: grayscale(100%); */
  transition: all .2s ease-in-out;
  max-width: 100vmin;
  max-height: 70vmin;
  box-shadow: 0 0.2rem 1rem rgba(0, 0, 0, 0.2);
  border-radius: 100%;
}

img.rounded-corners {
  border-radius: 20px; 
}

img.rounded-corners-last-vistors {
  border-radius: 9px; 
}

img.rounded-corners-user-info {
  border-radius: 20px; 
}

blink{
animation: blinker 0.6s linear infinite;
color: #1c87c9;
}

@keyframes blinker {  
50% { opacity: 0; }
}

.blink-one {
animation: blinker-one 1s linear infinite;
}

@keyframes blinker-one {  
0% { opacity: 0; }
}

.blink-two {
animation: blinker-two 1.4s linear infinite;
}

@keyframes blinker-two 
{  
  100% { 
    opacity: 0; 
  }
}
<?
