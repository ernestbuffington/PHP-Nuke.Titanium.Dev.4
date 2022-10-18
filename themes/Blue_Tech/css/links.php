<?php
global $theme_name;
echo "/* Fly Kit CSS Forum Style Sheet */\n"; 
echo "/* ".$theme_name."/css/links.php (Forum Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Links Style Sheet                                             */
/*                                                               */
/* Designed and Coded By: Ernest Buffington aka TheGhost         */
/* Coded On: 16th October, 2022                                  */
/* Copyright © 2022 Brandon Maintenance Management               */
/*                                                               */
/* PLEASE STEAL AND/OR USE THIS CSS CODE                         */
/* NO NEED FOR WRITTEN PERMISSION                                */
/* I did not trade a goat for this code!                         */
/*---------------------------------------------------------------*/

/*----------------------------------------------------------------*/
/* Best Viewed Text Settings                                      */
/* Best Viewed w/Minimum Screen Resolution of 'X by X' or Higher! */
/*----------------------------------------------------------------*/

.bviewed {
	font-size: 14px;
	color: #303030;
	text-decoration: none;
	padding-top: 14px;
}

/*---------------------------------------------------------------*/
/* Page Break Settings                                           */
/*---------------------------------------------------------------*/

p { padding-bottom: 5px; text-decoration: none; }
p, table { text-decoration: none; }


/*---------------------------------------------------------------*/
/* List Settings                                                 */
/*---------------------------------------------------------------*/
ul {
	list-style-type: disc;
}

/*---------------------------------------------------------------*/
/* Header Font/Text Settings                                     */
/*---------------------------------------------------------------*/

h1, h2, h3, h4, h5, h6 {
	color: #999;
	font-weight: normal;
}

h1 { font-size: 30px; line-height: 1; margin-bottom: 5px; }
h2 { font-size: 20px; margin-bottom: 7.5px; }
h3 { font-size: 15px; line-height: 1; margin-bottom: 10px; }
h4 { font-size: 12px; line-height: 1.25; margin-bottom: 12.5px; }
h5 { font-size: 10px; font-weight: bold; margin-bottom: 15px; }
h6 { font-size: 10px; font-weight: bold; }

.language-css { color: #cd6a51; }

/*---------------------------------------------------------------*/
/* Text Settings                                                 */
/*---------------------------------------------------------------*/

.left { text-align: left; }
.center { text-align: center; }
.justify { text-align: justify; }
.right { text-align: right; }

/*---------------------------------------------------------------*/
/* Block Title                                                   */
/*---------------------------------------------------------------*/

.blocktitle {
	font-weight: bold;
	font-size: 12px;
	color: #D29A2B;
	letter-spacing: 0px;
	text-decoration: none;
	text-shadow: 0px 0px 5px #636363, 0px 0px 4px #A20303;
	text-transform: uppercase;
}

/*---------------------------------------------------------------*/
/* Heading                                                       */
/*---------------------------------------------------------------*/

.heading {
	font-weight: bold;
	font-size: 11px;
	color: #fff;
	letter-spacing: 0;
	text-decoration: none;
}

/*---------------------------------------------------------------*/
/* Font Shadow                                                   */
/*---------------------------------------------------------------*/

.fa-angle-double-up {
	text-shadow: 0px 0px 5px #636363, 0px 0px 4px #A20303;
}

/*---------------------------------------------------------------*/
/* Font Settings                                                 */
/*---------------------------------------------------------------*/
/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name {
	font-size: 11px;
	color: #FFF;
}

/* Location, number of posts, post date etc */
.postdetails {
	font-size: 10px;
	color: #FFF;
}

/* The content of the posts (body of text) */
.postbody {
	font-size: 15px;
	color: #D3D3D3;
}

/* General Text */
.gen {
	font-size: 13px;
	color: #FFF;
}
.genmed {
	font-size: 12px;
}
.gensmall {
	font-size: 10px;
}
.gen, .genmed, .gensmall {
	color: #FFF;
}

/* Forum Cattitle & Description Text */
.cattitle {
	font-size: 13px !important;
	letter-spacing: 1px;
}

/* The Largest Text Used in the Index Page Title & Toptic Title Etc. */
.maintitle, h1, h2 {
	font-weight: bold;
	font-size: 18px;
	line-height: 120%;
	color: #CCC;
	text-decoration: none;
}

/* The Register, Login, Search, Etc, Links at the Top of the Page */
.mainmenu {
	color: #FFF;
}

/* Forum title: Text and link to the forums used in: index.php */
.forumlink {
	font-weight: bold;
	font-size: 11px;
	color: #FFF;
}

/* Used for the Navigation text, (Page 1,2,3 etc) & the navigation bar when in a forum */
.nav {
	font-weight: bold; font-size: 11px; color: #999;
}

/* Titles for the Topics: Could specify viewed link color too */
.topictitle {
	color: #DDD;
}

/*---------------------------------------------------------------*/
/* Link Settings                                                 */
/*---------------------------------------------------------------*/

a.maintitle:link {
	color: #D29A2B;
	font-size: 18px;
	text-decoration: none;
}

a.maintitle:visited {
	color: #D29A2B;
	font-size: 18px;
	text-decoration: none;
}

a.maintitle:hover {
	color: #888;
	font-size: 18px;
	text-decoration: none;
}

a.gen, a.genmed, a.gensmall {
	background: transparent;
	color: #FFF;
	text-decoration: none;
}

a.gen:hover, a.genmed:hover, a.gensmall:hover {
	color: #D29A2B;
	text-decoration: none;
}

a.mainmenu {
	color: #FFF;
	text-decoration: none;
}

a.mainmenu:hover {
	color: #bbbbbb;
	text-decoration: none;
}

a.cattitle {
	color: #AFAFAF;
	text-decoration: none;
}

a.cattitle:hover {
	color: #D29A2B;
	text-decoration: none;
}

.cattitle3 {
	color: #FED192;
	font-size: 13px !important;
	letter-spacing: 1px;
}

a.cattitle3 {
	color: #AFAFAF;
	text-decoration: none;
}

a.cattitle3:hover {
	color: #D29A2B;
	text-decoration: none;
}

a.forumlink {
	color: #999;
	text-decoration: none;
}

a.forumlink:hover {
	color: #6a0000;
	text-decoration: none;
}

a.nav {
	color: #999; text-decoration: none;
}

a.nav:hover {
	color: #999; text-decoration: none;
}

a.topictitle:link {
	color: #999;
	text-decoration: none;
}

a.topictitle:visited {
	color: #999;
	text-decoration: none;
}

a.topictitle:hover {
	color: #cb5858;
	text-decoration: none;
}

a.postlink:link {
	color: #FED192;
	text-decoration: none;
}

a.postlink:visited,
a.postlink:hover {
	color: #D29A2B;
	text-decoration: underline;
}

.copyright,
a.copyright,
a.copyright:link,
a.copyright:active,
a.copyright:visited {
	font-size: 14px;
	color: #ccc;
	text-decoration: none;
}
a.copyright:hover {
	font-size: 14px;
	color: #f5a405;
	text-decoration: none;
}

a.welcome { 
  color: #1572b6;
   font-size:20px;
   text-decoration: none;
  font-weight:bold
 font-size-adjust:!important;
}

a.welcome:hover,
a.welcome.bbcode-href:hover { 
  color: #f5a405;
   font-size:20px;
    text-decoration: none;
   font-weight:bold
  font-size-adjust:!important;
}

a.welcome.bbcode-href {
  color: #ce982d;
   font-size:20px;
    text-decoration: none;
   font-weight:bold
  font-size-adjust:!important;
}

greatminds {
 font-size:14px;
  font-weight:bold;
 font-size-adjust:!important;
}
<?

