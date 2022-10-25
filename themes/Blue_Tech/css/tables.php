<?php
global $theme_name;
echo "/* Fly Kit CSS Forum Style Sheet */\n"; 
echo "/* ".$theme_name."/css/tables.php (Forum Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Tables Style Sheet                                            */
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
/* Tables Style Sheet                                            */
/*---------------------------------------------------------------*/

/* The Outline Round the Main Forum Tables */
.forumline {
	background: #333;
	border: #222 0px solid;
}

/* Changes Color for: Story Box - Post By Line */
td.content {
	color: #fff;
	font-size: 11px;
	text-decoration: none;
}

td.extra {
	border: 0 solid #131313;
	border-right-color: #898989;
	border-bottom-color: #898989;
}

/* Main table cell colours and backgrounds */
td.row1 {
	background: #494949;
	border: 1px solid #787878;
	padding: 4px;
}

td.row2 {
	background-color: #494949;
	border: 1px solid #787878;
	padding: 4px;
}

td.row3 {
	background-color: #4c4c4c;
	border: 1px solid #222;
	border: 1px solid #787878;
	padding: 4px;
}

/* Category Row Right */
td.rowpic {
	background: #292929;
	border: #cccccc 1px solid;
	padding-left: 2px;
	padding-right: 2px;
	padding-bottom: 2px;
}

/* Recent Topics Row*/
th {
	color: #FFF;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: #3d3d3d;
	white-space: nowrap;
	text-align: center;
}

th.bar {
	background: #333;
	border: #222 1px solid;
	color: #ddd;
	font-size: 11px;
	font-weight: bold;
	text-align: center;
}

/* Category Row Left */
td.cat, td.catHead, td.catSides, td.catLeft, td.catRight, td.catBottom {
	background-color: #343434;
	color: #FFF;
	border: 1px solid #787878;
	white-space: nowrap;
	padding: 4px;
}

td.cat, td.catHead, td.catBottom {
	background-color: #343434;
	color: #FFF;
	border: 1px solid #787878;
	white-space: nowrap;
}

/*
 * Setting additional nice inner borders for the main table cells.
 * The names indicate which sides the border will be on.
 * Don't worry if you don't understand this, just ignore it :-)
 *----------------------------------------------------------------
*/


/* Recent Topics, Row1, Viewforum_Body.tpl */
th.thHead, th.thSides, th.thTop, th.thLeft, th.thRight, th.thBottom, th.thCornerL, th.thCornerR {
	color: #F1F1F1;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: #444;
	white-space: nowrap;
}

/* Forum_Body.tpl - Last Column */
td.row3Right, td.spaceRow {
	height: 25px;
	color: #F1F1F1;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: #444;
	white-space: nowrap;
}

td.forums,th.forums{padding-left:5px;}
td.threads,th.threads{width:80px;}
td.last_post,th.last_post{width:200px;padding-left:5px;}

/* Changes Color for: Story Box - Post By Line */
td.content {
	color: #fff;
	font-size: 11px;
	text-decoration: none;
}
td.extra {
	border: 0 solid #131313;
	border-right-color: #898989;
	border-bottom-color: #898989;
}
<?
