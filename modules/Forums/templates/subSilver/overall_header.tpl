<?xml version="1.0" encoding=""?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" />
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml" /><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Language" content="en" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
{META}
{NAV_LINKS}

<title>{SITENAME} :: {PAGE_TITLE}</title>
<!-- link rel="stylesheet" href="modules/Forums/templates/subSilver/{T_HEAD_STYLESHEET}" type="text/css" -->
<style>
<!--
/*
  The original subSilver Theme for phpBB version 2+
  Created by subBlue design
  http://www.subBlue.com

  NOTE: These CSS definitions are stored within the main page body so that you can use the phpBB2
  theme administration centre. When you have finalised your style you could cut the final CSS code
  and place it in an external file, deleting this section to save bandwidth.
*/

/* General page style. The scroll bar colours only visible in IE5.5+ */
body { 
    background-color: {T_BODY_BGCOLOR};
    scrollbar-face-color: {T_TR_COLOR2};
    scrollbar-highlight-color: {T_TD_COLOR2};
    scrollbar-shadow-color: {T_TR_COLOR2};
    scrollbar-3dlight-color: {T_TR_COLOR3};
    scrollbar-arrow-color:  {T_BODY_LINK};
    scrollbar-track-color: {T_TR_COLOR1};
    scrollbar-darkshadow-color: {T_TH_COLOR1};
}

/* General font families for common tags */
font,th,td,p { font-family: {T_FONTFACE1} }
a:link,a:active,a:visited { color : {T_BODY_LINK}; }
a:hover        { text-decoration: underline; color : {T_BODY_HLINK}; }
hr    { height: 0px; border: solid {T_TR_COLOR3} 0px; border-top-width: 1px;}

/* This is the border line & background colour round the entire page */
.bodyline    { background-color: {T_TD_COLOR2}; border: 1px {T_TH_COLOR1} solid; }

/* This is the outline round the main forum tables */
.forumline    { background-color: {T_TD_COLOR2}; border: 2px {T_TH_COLOR2} solid; }

/* Main table cell colours and backgrounds */
td.row1    { background-color: {T_TR_COLOR1}; }
td.row2    { background-color: {T_TR_COLOR2}; }
td.row3    { background-color: {T_TR_COLOR3}; }

/*
  This is for the table cell above the Topics, Post & Last posts on the index.php page
  By default this is the fading out gradiated silver background.
  However, you could replace this with a bitmap specific for each forum
*/
td.rowpic {
        background-color: {T_TD_COLOR2};
        background-image: url(modules/Forums/templates/subSilver/images/{T_TH_CLASS3});
        background-repeat: repeat-y;
}

/* Header cells - the blue and silver gradient backgrounds */
th    {
    color: {T_FONTCOLOR3}; font-size: {T_FONTSIZE2}px; font-weight : bold; 
    background-color: {T_BODY_LINK}; height: 25px;
    background-image: url(modules/Forums/templates/subSilver/images/{T_TH_CLASS2});
}

td.cat,td.catHead,td.catSides,td.catLeft,td.catRight,td.catBottom {
            background-image: url(modules/Forums/templates/subSilver/images/{T_TH_CLASS1});
            background-color:{T_TR_COLOR3}; border: {T_TH_COLOR3}; border-style: solid; height: 28px;
}

/*
  Setting additional nice inner borders for the main table cells.
  The names indicate which sides the border will be on.
  Don't worry if you don't understand this, just ignore it :-)
*/
td.cat,td.catHead,td.catBottom {
    height: 29px;
    border-width: 0px 0px 0px 0px;
}
th.thHead,th.thSides,th.thTop,th.thLeft,th.thRight,th.thBottom,th.thCornerL,th.thCornerR {
    font-weight: bold; border: {T_TD_COLOR2}; border-style: solid; height: 28px;
}
td.row3Right,td.spaceRow {
    background-color: {T_TR_COLOR3}; border: {T_TH_COLOR3}; border-style: solid;
}

th.thHead,td.catHead { font-size: {T_FONTSIZE3}px; border-width: 1px 1px 0px 1px; }
th.thSides,td.catSides,td.spaceRow     { border-width: 0px 1px 0px 1px; }
th.thRight,td.catRight,td.row3Right     { border-width: 0px 1px 0px 0px; }
th.thLeft,td.catLeft      { border-width: 0px 0px 0px 1px; }
th.thBottom,td.catBottom  { border-width: 0px 1px 1px 1px; }
th.thTop     { border-width: 1px 0px 0px 0px; }
th.thCornerL { border-width: 1px 0px 0px 1px; }
th.thCornerR { border-width: 1px 1px 0px 0px; }

/* The largest text used in the index page title and toptic title etc. */
.maintitle    {
    font-weight: bold; font-size: 22px; font-family: "{T_FONTFACE2}",{T_FONTFACE1};
    text-decoration: none; line-height : 120%; color : {T_BODY_TEXT};
}

/* General text */
.gen { font-size : {T_FONTSIZE3}px; }
.genmed { font-size : {T_FONTSIZE2}px; }
.gensmall { font-size : {T_FONTSIZE1}px; }
.gen,.genmed,.gensmall { color : {T_BODY_TEXT}; }
a.gen,a.genmed,a.gensmall { color: {T_BODY_LINK}; text-decoration: none; }
a.gen:hover,a.genmed:hover,a.gensmall:hover    { color: {T_BODY_HLINK}; text-decoration: underline; }

/* The register, login, search etc links at the top of the page */
.mainmenu        { font-size : {T_FONTSIZE2}px; color : {T_BODY_TEXT} }
a.mainmenu        { text-decoration: none; color : {T_BODY_LINK};  }
a.mainmenu:hover{ text-decoration: underline; color : {T_BODY_HLINK}; }

/* Forum category titles */
.cattitle        { font-weight: bold; font-size: {T_FONTSIZE3}px ; letter-spacing: 1px; color : {T_BODY_LINK}}
a.cattitle        { text-decoration: none; color : {T_BODY_LINK}; }
a.cattitle:hover{ text-decoration: underline; }

/* Forum title: Text and link to the forums used in: index.php */
.forumlink        { font-weight: bold; font-size: {T_FONTSIZE3}px; color : {T_BODY_LINK}; }
a.forumlink     { text-decoration: none; color : {T_BODY_LINK}; }
a.forumlink:hover{ text-decoration: underline; color : {T_BODY_HLINK}; }

/* Used for the navigation text, (Page 1,2,3 etc) and the navigation bar when in a forum */
.nav            { font-weight: bold; font-size: {T_FONTSIZE2}px; color : {T_BODY_TEXT};}
a.nav            { text-decoration: none; color : {T_BODY_LINK}; }
a.nav:hover        { text-decoration: underline; }

/* titles for the topics: could specify viewed link colour too */
.topictitle,h1,h2    { font-weight: bold; font-size: {T_FONTSIZE2}px; color : {T_BODY_TEXT}; }
a.topictitle:link   { text-decoration: none; color : {T_BODY_LINK}; }
a.topictitle:visited { text-decoration: none; color : {T_BODY_VLINK}; }
a.topictitle:hover    { text-decoration: underline; color : {T_BODY_HLINK}; }

/* Name of poster in viewmsg.php and viewtopic.php and other places */
.name            { font-size : {T_FONTSIZE2}px; color : {T_BODY_TEXT};}

/* Location, number of posts, post date etc */
.postdetails        { font-size : {T_FONTSIZE1}px; color : {T_BODY_TEXT}; }

/* The content of the posts (body of text) */
.postbody { font-size : {T_FONTSIZE3}px; line-height: 18px}
a.postlink:link    { text-decoration: none; color : {T_BODY_LINK} }
a.postlink:visited { text-decoration: none; color : {T_BODY_VLINK}; }
a.postlink:hover { text-decoration: underline; color : {T_BODY_HLINK}}

/* Quote & Code blocks */
.code { 
    font-family: {T_FONTFACE3}; font-size: {T_FONTSIZE2}px; color: {T_FONTCOLOR2};
    background-color: {T_TD_COLOR1}; border: {T_TR_COLOR3}; border-style: solid;
    border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

.quote {
    font-family: {T_FONTFACE1}; font-size: {T_FONTSIZE2}px; color: {T_FONTCOLOR1}; line-height: 125%;
    background-color: {T_TD_COLOR1}; border: {T_TR_COLOR3}; border-style: solid;
    border-left-width: 1px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px
}

/* Copyright and bottom info */
.copyright        { font-size: {T_FONTSIZE1}px; font-family: {T_FONTFACE1}; color: {T_FONTCOLOR1}; letter-spacing: -1px;}
a.copyright        { color: {T_FONTCOLOR1}; text-decoration: none;}
a.copyright:hover { color: {T_BODY_TEXT}; text-decoration: underline;}

/* Form elements */
input,textarea, select {
    color : {T_BODY_TEXT};
    font: normal {T_FONTSIZE2}px {T_FONTFACE1};
    border-color : {T_BODY_TEXT};
}

/* The text input fields background colour */
input.post, textarea.post, select {
    background-color : {T_TD_COLOR2};
}

/* Start replacement - Advanced time management MOD */
/* input { text-indent : 2px; }
/* End replacement - Advanced time management MOD */

/* The buttons used for bbCode styling in message post */
input.button {
    background-color : {T_TR_COLOR1};
    color : {T_BODY_TEXT};
    font-size: {T_FONTSIZE2}px; font-family: {T_FONTFACE1};
}

/* The main submit button option */
input.mainoption {
    background-color : {T_TD_COLOR1};
    font-weight : bold;
}

/* None-bold submit button */
input.liteoption {
    background-color : {T_TD_COLOR1};
    font-weight : normal;
}

/* This is the line in the posting page which shows the rollover
  help line. This is actually a text box, but if set to be the same
  colour as the background no one will know ;)
*/
.helpline { background-color: {T_TR_COLOR2}; border-style: none; }

/* Import the fancy styles for IE only (NS4.x doesn't use the @import function) */
@importurl "modules/Forums/templates/subSilver/formIE.css" 
-->
</style>
<!-- start mod : Resize Posted Images Based on Max Width -->
<script>
//<![CDATA[
<!--

var rmw_max_width = {IMAGE_RESIZE_WIDTH}; // you can change this number, this is the max width in pixels for posted images
var rmw_border_1 = '1px solid {T_BODY_LINK}';
var rmw_border_2 = '2px dotted {T_BODY_LINK}';
var rmw_image_title = '{L_RMW_IMAGE_TITLE}';

-->
//]]>

</script>
<script src="{U_RMW_JSLIB}"></script>
<!-- fin mod : Resize Posted Images Based on Max Width -->
<!-- BEGIN switch_enable_pm_popup -->
<script>
<!--
    if ( {PRIVATE_MESSAGE_NEW_FLAG} )
    {
        window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
    }
//-->
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - Advanced time management MOD -->
<!-- BEGIN switch_send_pc_dateTime -->
<script>
<!-- Start Replace - window.onload = send_pc_dateTime -->
send_pc_dateTime();
<!-- End Replace - window.onload = send_pc_dateTime -->

function send_pc_dateTime() {
    var pc_dateTime = new Date();
    pc_timezoneOffset = pc_dateTime.getTimezoneOffset()*(-60);
    pc_date = pc_dateTime.getFullYear()*10000 + (pc_dateTime.getMonth()+1)*100 + pc_dateTime.getDate();
    pc_time = pc_dateTime.getHours()*3600 + pc_dateTime.getMinutes()*60 + pc_dateTime.getSeconds();

    for ( i = 0; document.links.length > i; i++ ) {
        with ( document.links[i] ) {
            if ( href.indexOf('{U_SELF}') === 0 ) {
                textLink = '' + document.links[i].firstChild.data;
                if ( textLink.indexOf('http://') !== 0 && textLink.indexOf('www.') !== 0 && (textLink.indexOf('@') === -1 || textLink.indexOf('@') === 0 || textLink.indexOf('@') === textLink.length-1 )) {
                    if ( href.indexOf('?') === -1 ) {
                        pc_data = '?pc_tzo=' + pc_timezoneOffset + '&pc_d=' + pc_date + '&pc_t=' + pc_time;
                    } else {
                        pc_data = '&pc_tzo=' + pc_timezoneOffset + '&pc_d=' + pc_date + '&pc_t=' + pc_time;
                    }
                    if ( href.indexOf('#') === -1 ) {
                        href += pc_data;
                    } else {
                        href = href.substring(0, href.indexOf('#')-1) + pc_data + href.substring(href.indexOf('#'), href.length-1);
                    }
                }
            }
        }
    }
}
</script>
<!-- END switch_send_pc_dateTime -->
<!-- End add - Advanced time management MOD -->
</head>
<body bgcolor="{T_BODY_BGCOLOR}" text="{T_BODY_TEXT}" link="{T_BODY_LINK}" vlink="{T_BODY_VLINK}">

<a name="top"></a>

<table width="100%" cellspacing="0" cellpadding="10" border="0" align="center"> 
    <tr> 
        <td class="bodyline"><table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr> 
                <table cellspacing="0" cellpadding="2" border="0">
                    <tr>
                        <td align="center" valign="top" nowrap="nowrap"><center><span class="mainmenu">&nbsp;<a href="{U_INDEX}" class="mainmenu">{I_MINI_INDEX}{L_MINI_INDEX}</a>&nbsp;&nbsp;<a href="{U_SEARCH}" class="mainmenu">{I_MINI_SEARCH}{L_SEARCH}</a>&nbsp;&nbsp;<a href="{U_GROUP_CP}" class="mainmenu">{I_MINI_USERGROUPS}{L_USERGROUPS}</a>&nbsp;&nbsp;<a href="{U_PROFILE}" class="mainmenu">{I_MINI_PROFILE}{L_PROFILE}</a>&nbsp;&nbsp;<a href="{U_MEMBERLIST}" class="mainmenu">{I_MINI_MEMBERLIST}{L_MEMBERLIST}</a>&nbsp;&nbsp;<a href="{U_PRIVATEMSGS}" class="mainmenu">{I_MINI_PRIVATEMSGS}{PRIVATE_MESSAGE_INFO}</a>&nbsp;<br />
                        &nbsp;<a href="{U_ARCADE}" class="mainmenu">{I_MINI_ARCADE}{L_ARCADE}</a>&nbsp;&nbsp;<a href="{U_RANKS}" class="mainmenu">{I_RANKS}{L_RANKS}</a>&nbsp;&nbsp;<a href="{U_STAFF}" class="mainmenu">{I_STAFF}{L_STAFF}</a>&nbsp;&nbsp;<a href="{U_STATISTICS}" class="mainmenu">{I_STATISTICS}{L_STATISTICS}</a>&nbsp;&nbsp;<a href="{U_RULES}" class="mainmenu">{I_RULES}{L_RULES}</a>&nbsp;&nbsp;<a href="{U_FAQ}" class="mainmenu">{I_MINI_FAQ}{L_FAQ}</a>&nbsp;&nbsp;<a href="{U_LOGIN_LOGOUT}" class="mainmenu">{I_MINI_LOGIN_LOGOUT}{L_LOGIN_LOGOUT}</a>&nbsp;</span></center></td>
                    </tr>
                </table></td>
            </tr>
        </table>

<!-- Quick Search -->
<!-- BEGIN switch_quick_search -->
<br /><script>
<!--
function checkSearch()
{
    {switch_quick_search.CHECKSEARCH}
    else
    {
        return true;
    }
}
//-->
</script>
<center>
<table width="100%" cellpadding="2" cellspacing="1" border="0"><form name="search_block" method="post" action="{U_SEARCH}" onSubmit="return; 
checkSearch();">
  <tr>            
    <td align="center"><span class="gensmall" style="line-height: 150%">
    {switch_quick_search.L_QUICK_SEARCH_FOR} <input class="post" type="text" name="search_keywords" size="15"> 
{switch_quick_search.L_QUICK_SEARCH_AT} <select class="post" name="site_search">{switch_quick_search.SEARCHLIST}</select>
    <input class="mainoption" type="submit" value="{L_SEARCH}"></span></td>
  </tr>
  <tr>
    <td align="center"><a href="{U_SEARCH}" class="gensmall">{switch_quick_search.L_ADVANCED_FORUM_SEARCH}</a></td>
  </tr>
<input type="hidden" name="search_fields" value="all">
<input type="hidden" name="show_results" value="topics"></form>
</table>
</center>
<!-- END switch_quick_search -->

<!-- BEGIN boarddisabled -->
  <br /><div align="center"><span class="gen"><strong>{L_BOARD_CURRENTLY_DISABLED}</strong></span></div><br />
<!-- END boarddisabled -->

        <br />