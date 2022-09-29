<?php
/************************************************************************/
/* [Google-Site-Map] 1.0 by TheGhost              			            */
/* =================================                                    */
/* Copyright (c) 2021 by The 86it Developers Network          			*/
/* http://www.86it.us                                                   */
/************************************************************************/
$titanium_module_name = basename(dirname(__FILE__));
$mod_name = 'Google Site Map';
$author_name = 'Ernest Buffington';
$author_email = 'ernest.buffington@gmail.com';
$author_homepage = 'http://php-nuke-titanium.86it.us';
$license = 'GNU/GPL';
$download_location = 'http://www.86it.us';
$titanium_module_version = 'v1.0b';
$release_date = 'April 11th, 2021';
$titanium_module_description = 'Google Site Map';
$mod_cost = '$300.00 US Dollars';

function show_copyright() 
{
    global $mod_cost, $forum, $mod_name, $titanium_module_name, $release_date, $author_name, $author_email, $author_homepage, $license, $download_location, $titanium_module_version, $titanium_module_description;

    if ($mod_name == "") { $mod_name = str_replace("-", " ", $titanium_module_name); }

    print '<html>';
    print '<head><title>'.$mod_name.': Copyright Information</title></head>';
	print '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">';
	print '<div align="center"><table border="0" cellpadding="0" cellspacing="0"><tr>';
	print '<td width="290" align="center"><font size="2" face="Arial,Helvetica"><strong>Copyright &copy; The 86it Developers Network</strong><br />';
	print '</tr></table></div><hr />';
	print '<font size="2" face="Arial,Helvetica">';
	print '&#8226;&nbsp;<strong>Module Name:</strong> '.$mod_name.'<br />';
    
	if ($titanium_module_version != "") { print '&#8226;&nbsp;<strong>Module Version:</strong> '.$titanium_module_version.'<br />'; }
	if ($release_date != "") { print '&#8226;&nbsp;<strong>Module Release Date:</strong> '.$release_date.'<br />'; }
	if ($mod_cost != "") { print '&#8226;&nbsp;<strong>Module Cost:</strong> '.$mod_cost.'<br />'; }
	if ($license != "") { print '&#8226;&nbsp;<strong>License:</strong> '.$license.'<br />'; }
	if ($author_name != "") { print '&#8226;&nbsp;<strong>Author Name:</strong> '.$author_name.'<br/ >'; }
	if ($author_email != "") { print '&#8226;&nbsp;<strong>Author E-mail:</strong> '.$author_email.'<br />'; }
	if ($titanium_module_description != "") { print '&#8226;&nbsp;<strong>Module Description:</strong> '.$titanium_module_description.'<br />'; }
	if ($download_location != "") { print '&#8226;&nbsp;<strong>Download:</strong> <a href="'.$download_location.'" target="new">www.86it.us</a>'; }
	
	print '<hr>';
	print '<div align="center">'.$mod_name.' for <a href="http://www.86it.us" target="_blank">PHP-Nuke Titanium</a><br /><br />[<a href="javascript:void(0)" onClick=javascript:self.close()>Close</a>]</font></div></td>';

	print '<hr />';
    print '</font>';
    print '</body>';
    print '</html>';
}

show_copyright();
