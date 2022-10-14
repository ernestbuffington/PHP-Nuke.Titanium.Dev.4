<?php
global $theme_name;

echo "\n\n/* Titanium_Core/css/body.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;

?>
.block {
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;
}

.otthree {
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;
}

BODY 
{
FONT-SIZE: 12px; 
CURSOR: default; 
COLOR: #000000; 
BACKGROUND-color: #cccccc; 
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif; 
TEXT-DECORATION: none;

scrollbar-face-color: #cccccc;
scrollbar-highlight-color: #969696;
scrollbar-3dlight-color: #cccccc;
scrollbar-darkshadow-color: #646464;
scrollbar-shadow-color: #4B4B4B;
scrollbar-arrow-color: #c0c0c0;
scrollbar-track-color: #cccccc;
}

A:link {
FONT-SIZE: 12px;
FONT-WEIGHT: normal; 
COLOR: #000000;
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif;
TEXT-DECORATION: none;
}

A:visited {
FONT-SIZE: 12px;
FONT-WEIGHT: normal; 
COLOR: #000000;
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif; 
TEXT-DECORATION: none;
}

A:active {
FONT-SIZE: 12px;
FONT-WEIGHT: normal; 
COLOR: #000000;
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif; 
TEXT-DECORATION: overline underline;
}

A:hover {
FONT-SIZE: 12px;
FONT-WEIGHT: bold; 
COLOR: #cc0000; 
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif; 
TEXT-DECORATION: none;
}


TEXTAREA	
{
color:#000000;
BACKGROUND: transparent;
BORDER-BOTTOM-WIDTH: 2px; 
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif font:12px;
}

P 
{
FONT-SIZE: 12px; 
COLOR: #000000; 
LINE-HEIGHT: 1.4; 
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif; 
TEXT-DECORATION: none;
}

TABLE 
{
border-width: 0px;
FONT-SIZE: 12px; 
COLOR: #000000; 
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif;
TEXT-DECORATION: none;
}

td.info1	
{
border:2px solid; border-color:#000000 #c0c0c0 #c0c0c0 #000000; BACKGROUND: #BEBDBD;
}

TD.content 
{
FONT-SIZE: 12px;
COLOR: #000000;
TEXT-DECORATION: none
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif;
scrollbar-face-color: #cccccc;
scrollbar-highlight-color: #969696;
scrollbar-3dlight-color: #cccccc;
scrollbar-darkshadow-color: #646464;
scrollbar-shadow-color: #4B4B4B;
scrollbar-arrow-color: #c0c0c0;
scrollbar-track-color: #cccccc;
}

TD.story 
{
color:#000000;
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif;
}

SELECT 
{
background-color: cecece;
FONT-SIZE: 12px;
COLOR: #000000;
TEXT-DECORATION: none
font-family: Tahoma, Verdana, "Myriad Web", Syntax, sans-serif;
scrollbar-face-color: #cccccc;
scrollbar-highlight-color: #969696;
scrollbar-3dlight-color: #cccccc;
scrollbar-darkshadow-color: #646464;
scrollbar-shadow-color: #4B4B4B;
scrollbar-arrow-color: #c0c0c0;
scrollbar-track-color: #cccccc;
}

.gentextarea
{
border-style: inset;
border-width: 2px;
}

.thLeft
{
border-style: outset;
border-width: 2px;
}

.thRight
{
border-style: outset;
border-width: 2px;
}

.pb
{
border-style: outset;
border-width: 2px;
}

.forumlink
{
font-weight:bold;
font-size:12px;
background:inherit;
color:#000000;
}
a.forumlink
{
font-weight:bold;
text-decoration:none;
background:inherit;
color:#000000;
}
a.forumlink:visited
{
font-weight:bold;
text-decoration:none;
background:inherit;
color:#000000;
}
a.forumlink:hover
{
font-weight:bold;
text-decoration:none;
background:inherit;
color:#CC0000;
}

/* The register, login, search etc links at the top of the page */
.forummenu		
{ 
font-weight: bold; 
font-size : 12px; 
color : #000000;
}
a.forummenu		
{ 
text-decoration: none;
font-weight: bold;  
color : #000000;
}
a.forummenu:visited
{
font-weight: bold;   
text-decoration: none; 
color : #000000;
}
a.forummenu:hover
{
font-weight: bold;   
text-decoration: none; 
color : #cc0000;
}


/* The register, login, search etc links at the top of the page */
.mainmenu		{ font-size : 12px; color : #000000;}
a.mainmenu		{ text-decoration: none; color : #000000;}
a.mainmenu:hover{ text-decoration: none; color : #cc0000;}

/* Forum category titles */
.cattitle		{ font-weight: bold; font-size: 13px; letter-spacing: 0px; color : #2f6f19}
a.cattitle		{ font-weight: bold; font-size: 13px; text-decoration: none; color : #2f6f19; }
a.cattitle:hover{ font-weight: bold; font-size: 13px; text-decoration: none; color : #cc0000;}


/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-weight: bold; font-size: 12px; color : #000000;}
a.nav			{ font-weight: bold; text-decoration: none; color : #000000; }
a.nav:hover		{ font-weight: bold; text-decoration: NONE; color : #cc0000;}

.code
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.quote
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.thLeft
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.thRight
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.thCornerL
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.thTop
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.thCornerR
{
backgroundRepeat: repeat-xy center;
BACKGROUND-IMAGE: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png); 
BACKGROUND-REPEAT: repeat-xy center; 
backgroundImage: url(../../../themes/MNS-Titanium/images/backgrounds/block_light_grey.png);
accelerator: false;

color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row1 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row1cell 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row1rt 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row1lt 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row1d 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row1u 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row2u 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row2 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row3 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

TD.row4 
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

td.rowlt
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}
td.rowrt
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}
td.rowpic
{
color:inherit;
border-right: #707070 2px solid;
border-top: #c0c0c0 2px solid;
border-bottom: #707070 2px solid;
border-left: #c0c0c0 2px solid;
}

.nrm01
{
FONT-SIZE: 12px; 
font-family: verdana,arial,sans-serif,helvetica; 
BACKGROUND: transparent;
}

INPUT 		
{
FONT-SIZE: 12px; 
font-family: verdana,arial,sans-serif,helvetica; 
BACKGROUND: transparent;
}

#listbutton
{
border:2px solid #4B4B4B;
background-color:#F3F3F3;
width:60px;
height:12px;
font: normal 12px Arial, Verdana, Helvetica, sans-serif;
text-align:center;
cursor:pointer;cursor:pointer;
vertical-align:top;
}

.expandhighlight, .expandhighlight a
{
color:red;
}

IMG {
BORDER-RIGHT: #c0c0c0 0px solid; 
BORDER-TOP: #c0c0c0 0px solid; 
BORDER-LEFT: #c0c0c0 0px solid; 
BORDER-BOTTOM: #c0c0c0 0px solid;
}
 
.online2 {
opacity:0.5;
filter:alpha(opacity=50);
}

bottom{Z-INDEX:2;LEFT:0px;width:100%;POSITION:absolute;TOP:594px;height:30px;text-align:center}





<?

