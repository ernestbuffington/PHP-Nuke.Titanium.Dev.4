<?php
global $theme_name;
echo "/* Fly Kit CSS Forum Style Sheet */\n"; 
echo "/* ".$theme_name."/css/forum.php (Forum Style Sheet) */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Forums Style Sheet                                            */
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
/* Forums Style Sheet                                            */
/*---------------------------------------------------------------*/
/*
 * Page elements
 *--------------------------------------------------
*/
textarea, select, input {
	background-color: #333;
	color: #fff;
	font-family: "Open Sans", sans-serif;
	letter-spacing: 0px;
	margin: 0px 1px 1px;
	padding: 4px;
	border: 1px solid #D29A2B;
	resize: vertical;
	box-sizing: border-box;
}

/*
 * 6. User interaction
 *--------------------------------------------------
*/
.welcomebg {
	background: url('../images/hdr/Usernav_01.png') no-repeat;
	height: 60px;
	min-width: 280px;
	width: 280px;
	color: #D29A2B;
	text-indent: 96px;
}
.userlinksbg {
	background: url('../images/hdr/Usernav_03.png') no-repeat;
	height: 60px;
	min-width: 280px;
	width: 280px;
	color: #D29A2B;
	text-indent: -80px;
}

/*
 * 11. Inputs
 *--------------------------------------------------
*/
input {
	color: #D29A2B;
	font-size: 13px;
	border: 1px solid #858585;
	padding: 4px;
	letter-spacing: 1px;
	box-sizing: border-box;
}

input.noborder {
	color: #fff;
	font: 11px arial, helvetica, sans-serif;
	border: 0 solid #fff;
}

input.sub {
	color: #D29A2B;
	font-size: 11px;
	background-color: #444;
	border: 1px solid #858585;
}

input.button, input.mainoption, input.liteoption {
	color: #D29A2B;
	font-size: 13px;
}



/*
 * Clearfix
 *
 * The Magnificent Clearfix: Updated to prevent margin-collapsing on child elements.
 * j.mp/bestclearfix
 *--------------------------------------------------
*/
.clearfix:before,
.clearfix:after {
	content: "\0020";
	display: block;
	height: 0;
	overflow: hidden;
}
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }

/*--------------------------------------------------------------*/
/* Everything Below this Line Needs to be Added to Other Themes */
/*--------------------------------------------------------------*/

input[type='submit'],input[type='checkbox'],input[type='radio']{cursor:pointer;}

select{color: #fff;border:1px solid #D29A2B;cursor:pointer;margin:0 1px 1px;box-sizing:border-box;}

input{color: #fff;border:1px solid #D29A2B;box-sizing:border-box;letter-spacing:1px;margin:0 1px 1px;padding:5px;box-sizing:border-box;}

span.uppercase{text-transform:uppercase;}

input[type='radio']{background-color:transparent!important;width:18px;height:18px;}

input[type='checkbox']{width:18px;height:18px;}

input[type='image']{border:none;padding:0;}

progress{background-color:#f3f3f3;border:0;height:18px;}

.codebox{border-style:solid;display:block;padding: 10px;;border:1px solid #b5b7b9;background-color:#343434;}

.codebox code{display:block;font:1em Monaco,"Open Sans",sans-serif;max-height:500px;max-width:100%;overflow:auto;margin:0;padding: 5px 3px;}

.codebox p{display:block;font-weight:600;border-bottom:1px solid #ccc;text-transform:uppercase;}

.phpcodebox {background-color:#fdf6e3;}

.phpcodebox p{color:#333 ;}

.code_select {color:#676767;}

.code_select:hover {color: #D29A2B;}

.notepaper{position:relative;margin:auto;padding:29px 20px 20px 45px;width:90%;line-height:32px;color:#6a5f49;text-shadow:0 1px 1px #fff;background-color:#f2f6c1;background-image:-webkit-radial-gradient(center,cover,rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.1) 90%),-webkit-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px); background-image:-moz-radial-gradient(center,cover,rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.1) 90%),-moz-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px); background-image:-o-radial-gradient(center,cover,rgba(255,255,255,0.7) 0%,rgba(255,255,255,0.1) 90%),-o-repeating-linear-gradient(top,transparent 0%,transparent 29px,rgba(239,207,173,0.7) 29px,rgba(239,207,173,0.7) 30px);border:1px solid #c3baaa;border-color:rgba(195,186,170,0.9);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px rgba(255,255,255,0.5),inset 0 0 5px #d8e071,0 0 1px rgba(0,0,0,0.1),0 2px rgba(0,0,0,0.02);box-shadow:inset 0 1px rgba(255,255,255,0.5),inset 0 0 5px #d8e071,0 0 1px rgba(0,0,0,0.1),0 2px rgba(0,0,0,0.02)}
.notepaper:before,.notepaper:after{content:'';position:absolute;top:0;bottom:0;}
.notepaper:before{left:28px;width:2px;border:solid #efcfad;border-color:rgba(239,207,173,0.9);border-width:0 1px;}
.notepaper:after{z-index:-1;left:0;right:0;background:rgba(242,246,193,0.9);border:1px solid rgba(170,157,134,0.7);-webkit-transform:rotate(2deg);-moz-transform:rotate(2deg);-ms-transform:rotate(2deg);-o-transform:rotate(2deg);transform:rotate(2deg)}

.curly-quotes:before,.curly-quotes:after{display:inline-block;vertical-align:top;height:30px;line-height:48px;font-size:50px;opacity:.2;}

.curly-quotes:before{content:'\201C';margin-right:4px;margin-left:-8px;}

.curly-quotes:after{content:'\201D';margin-left:4px;margin-right:-8px;}

.quote-by{display:block;padding-right:10px;font-size:13px;font-style:italic;color:#84775c;}

.lt-ie8 .notepaper{padding:15px 25px;}

.lastpost .fa{float:right;padding:10px;transition:all .2s ease-in-out;}

.forum-ranks {margin-bottom: 2px;}

.forum-avatar {padding-bottom: 5px;}
<?
