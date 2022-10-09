<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

// ==========================================
// PHP-NUKE: Shout Box
// ==========================
//
// Copyright (c) 2003-2005 by Aric Bolf (SuperCat)
// http://www.OurScripts.net
//
// Copyright (c) 2002 by Quiecom
// http://www.Quiecom.com
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation
// ===========================================

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       08/10/2005
      NukeSentinel                             v2.4.2       10/29/2005
-=[Mod]=-
      Advanced Username Color                  v1.0.5       10/10/2005
 ************************************************************************/

//if(!defined('NUKE_EVO')) exit;

global $prefix, $ShoutSubmit, $ShoutComment, $db, $user, $cookie, $shoutuid, $top_content, $mid_content, $bottom_content, $ShoutMarqueewidth, $ShoutMarqueeheight, $currentlang;

switch($ShoutSubmit) {
    default:
    ShoutBox($ShoutSubmit, $ShoutComment, $shoutuid);
    break;
}

if (!isset($_GET['Action']) && $_GET['Action'] != 'AJAX') {
    $content .= '<script type="text/javascript">
    //<![CDATA[
	var SBheight = \''.$ShoutMarqueeheight.'\';var SBcontent = new String(\''.$mid_content.'\');
	//]]>
	</script>
    <script type="text/javascript" src="includes/shoutbox.js"></script>';
    $content .= $top_content."\n";
    $content .= "<div align=\"center\" id=\"shoutbox\"><script type=\"text/javascript\">document.write(SBtxt);</script></div>\n";
    $content .= $bottom_content."\n";
}

?>