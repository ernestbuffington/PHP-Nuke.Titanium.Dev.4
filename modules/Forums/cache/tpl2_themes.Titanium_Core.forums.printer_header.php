<?php

// eXtreme Styles mod cache. Generated on Sun, 25 Sep 2022 16:11:53 +0000 (time=1664122313)

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="<?php echo isset($this->vars['S_CONTENT_DIRECTION']) ? $this->vars['S_CONTENT_DIRECTION'] : $this->lang('S_CONTENT_DIRECTION'); ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo isset($this->vars['S_CONTENT_ENCODING']) ? $this->vars['S_CONTENT_ENCODING'] : $this->lang('S_CONTENT_ENCODING'); ?>">
<meta http-equiv="Content-Style-Type" content="text/css">
<?php echo isset($this->vars['META']) ? $this->vars['META'] : $this->lang('META'); ?>
<title><?php echo isset($this->vars['SITENAME']) ? $this->vars['SITENAME'] : $this->lang('SITENAME'); ?> :: <?php echo isset($this->vars['PAGE_TITLE']) ? $this->vars['PAGE_TITLE'] : $this->lang('PAGE_TITLE'); ?></title>
<style type="text/css">
<!--

body { 
	background-color: white;
}

/* The largest text used in the index page title and toptic title etc. */
.maintitle {
			font-weight: bold; font-size: 22px; font-family: "<?php echo isset($this->vars['T_FONTFACE2']) ? $this->vars['T_FONTFACE2'] : $this->lang('T_FONTFACE2'); ?>",<?php echo isset($this->vars['T_FONTFACE1']) ? $this->vars['T_FONTFACE1'] : $this->lang('T_FONTFACE1'); ?>;
			text-decoration: none; line-height : 120%; color : <?php echo isset($this->vars['T_BODY_TEXT']) ? $this->vars['T_BODY_TEXT'] : $this->lang('T_BODY_TEXT'); ?>;
}

/* General text */
.gen { font-size : <?php echo isset($this->vars['T_FONTSIZE3']) ? $this->vars['T_FONTSIZE3'] : $this->lang('T_FONTSIZE3'); ?>px; }
.genmed { font-size : <?php echo isset($this->vars['T_FONTSIZE2']) ? $this->vars['T_FONTSIZE2'] : $this->lang('T_FONTSIZE2'); ?>px; }
.gensmall { font-size : <?php echo isset($this->vars['T_FONTSIZE1']) ? $this->vars['T_FONTSIZE1'] : $this->lang('T_FONTSIZE1'); ?>px; }
.gen,.genmed,.gensmall { color : black; }
a.gen,a.genmed,a.gensmall { color: black; text-decoration: none; }
a.gen:hover,a.genmed:hover,a.gensmall:hover	{ color: <?php echo isset($this->vars['T_BODY_HLINK']) ? $this->vars['T_BODY_HLINK'] : $this->lang('T_BODY_HLINK'); ?>; text-decoration: underline; }

/* Forum category titles */
.cattitle		{ font-weight: bold; font-size: <?php echo isset($this->vars['T_FONTSIZE3']) ? $this->vars['T_FONTSIZE3'] : $this->lang('T_FONTSIZE3'); ?>px ; letter-spacing: 1px; color : black}
a.cattitle		{ text-decoration: none; color : black; }
a.cattitle:hover{ text-decoration: underline; }

/* Forum title: Text and link to the forums used in: index.php */
.forumlink		{ font-weight: bold; font-size: <?php echo isset($this->vars['T_FONTSIZE3']) ? $this->vars['T_FONTSIZE3'] : $this->lang('T_FONTSIZE3'); ?>px; color : black; }
a.forumlink 	{ text-decoration: none; color : black; }
a.forumlink:hover{ text-decoration: underline; color : black; }

/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav			{ font-weight: bold; font-size: <?php echo isset($this->vars['T_FONTSIZE2']) ? $this->vars['T_FONTSIZE2'] : $this->lang('T_FONTSIZE2'); ?>px; color : black;}
a.nav			{ text-decoration: none; color : black; }
a.nav:hover		{ text-decoration: underline; }

/* titles for the topics: could specify viewed link colour too */
.topictitle			{ font-weight: bold; font-size: <?php echo isset($this->vars['T_FONTSIZE2']) ? $this->vars['T_FONTSIZE2'] : $this->lang('T_FONTSIZE2'); ?>px; color : black; }
a.topictitle:link   { text-decoration: none; color : black; }
a.topictitle:visited { text-decoration: none; color : black; }
a.topictitle:hover	{ text-decoration: underline; color : <?php echo isset($this->vars['T_BODY_HLINK']) ? $this->vars['T_BODY_HLINK'] : $this->lang('T_BODY_HLINK'); ?>; }

/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name			{ font-size : <?php echo isset($this->vars['T_FONTSIZE2']) ? $this->vars['T_FONTSIZE2'] : $this->lang('T_FONTSIZE2'); ?>px; color : black;}

/* Location, number of posts, post date etc */
.postdetails		{ font-size : <?php echo isset($this->vars['T_FONTSIZE1']) ? $this->vars['T_FONTSIZE1'] : $this->lang('T_FONTSIZE1'); ?>px; color : black; }

/* The content of the posts (body of text) */
.postbody { font-size : <?php echo isset($this->vars['T_FONTSIZE3']) ? $this->vars['T_FONTSIZE3'] : $this->lang('T_FONTSIZE3'); ?>px; line-height: 18px}
a.postlink:link	{ text-decoration: none; color : black }
a.postlink:visited { text-decoration: none; color : black; }
a.postlink:hover { text-decoration: underline; color : <?php echo isset($this->vars['T_BODY_HLINK']) ? $this->vars['T_BODY_HLINK'] : $this->lang('T_BODY_HLINK'); ?>}

/* Quote & Code blocks */
.code { 
	font-family: <?php echo isset($this->vars['T_FONTFACE3']) ? $this->vars['T_FONTFACE3'] : $this->lang('T_FONTFACE3'); ?>; font-size: <?php echo isset($this->vars['T_FONTSIZE2']) ? $this->vars['T_FONTSIZE2'] : $this->lang('T_FONTSIZE2'); ?>px; color: black;
	background-color: white; border: black; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

.quote {
	font-family: <?php echo isset($this->vars['T_FONTFACE1']) ? $this->vars['T_FONTFACE1'] : $this->lang('T_FONTFACE1'); ?>; font-size: <?php echo isset($this->vars['T_FONTSIZE2']) ? $this->vars['T_FONTSIZE2'] : $this->lang('T_FONTSIZE2'); ?>px; color: black; line-height: 125%;
	background-color: white; border: black; border-style: solid;
	border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

/* Copyright and bottom info */
.copyright		{ font-size: <?php echo isset($this->vars['T_FONTSIZE1']) ? $this->vars['T_FONTSIZE1'] : $this->lang('T_FONTSIZE1'); ?>px; font-family: <?php echo isset($this->vars['T_FONTFACE1']) ? $this->vars['T_FONTFACE1'] : $this->lang('T_FONTFACE1'); ?>; color: black; letter-spacing: -1px;}
a.copyright		{ color: black; text-decoration: none;}
a.copyright:hover { color: <?php echo isset($this->vars['T_BODY_TEXT']) ? $this->vars['T_BODY_TEXT'] : $this->lang('T_BODY_TEXT'); ?>; text-decoration: underline;}


/* The text input fields background colour */
input.post, textarea.post, select {
	background-color : white;
}

input { text-indent : 2px; }

/* This is the line in the posting page which shows the rollover
  help line. This is actually a text box, but if set to be the same
  colour as the background no one will know ;)
*/
.helpline { background-color: #00ffff; border-style: none; }


/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@import url("templates/subSilver/formIE.css"); 
-->
</style>
</head>

<body bgcolor="white" text="black" link="black" vlink="black">
<span class="gen"><a name="top"></a></span>