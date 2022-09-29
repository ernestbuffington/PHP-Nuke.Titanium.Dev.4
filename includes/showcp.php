<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Enhanced Copyright
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : showcp.php
   Author        : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 11.21.2005 (mm.dd.yyyy)

   Notes         : Enhanced Copyright.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function show_copyright($author_name = "", 
                  $author_user_email = "", 
				    $author_homepage = "", 
					        $license = "", 
				  $download_location = "", 
		    $titanium_module_version = "", 
		$titanium_module_description = "") 
{
    if (empty($author_name)) { $author_name = "N/A"; }

    if (empty($author_user_email)) { $author_user_email = "N/A"; }

    if (!empty($author_homepage)) { $homepage = "<a href='$author_homepage' target='_blank'>Author's Homepage</a>"; } else { $homepage = "No Website Available"; }

    if (empty($license)) { $license = "N/A"; }

    if (!empty($download_location)) { $download = "<a href='$download_location' target='_blank'>Module's Download</a>"; } else { $download = "No Download Available"; }

    if (empty($titanium_module_version)) { $titanium_module_version = "N/A"; }

    if (empty($titanium_module_description)) { $titanium_module_description = "N/A"; }

    $titanium_module_name = basename(dirname($_SERVER['PHP_SELF']));
    $titanium_module_name = str_replace("_", " ", $titanium_module_name);

    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n"
        ."<html>\n"
        ."<head>\n"
        ."<title>$titanium_module_name: Copyright Information</title>\n"
        ."<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />\n"
        ."<style type='text/css'>\n"
        ."<!--";
    echo '
body {
    font-size: 10px;
    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
    color: black;
    background: #D3D3D3;
}
a {
    font-size: 10px;
    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
    color: black;
}        
';
    echo "//-->\n"
        ."</style>\n"
        ."</head>\n"
        ."<body>\n"
        
		."<div align='center'><strong>Module Copyright &copy; Information</strong><br />"
		."$titanium_module_name module for <a href='http://www.php-nuke-titanium.86it.us' target='_blank'>PHP-Nuke Titanium</a><br /><br /></div>\n"
        
		."<img src='../../images/menu/orange.png' border='0' alt='' />&nbsp;<strong>Module's Name:</strong> $titanium_module_name<br />\n"
        ."<img src='../../images/menu/orange.png' border='0' alt='' />&nbsp;<strong>Module's Version:</strong> $titanium_module_version<br />\n"
        ."<img src='../../images/menu/orange.png' border='0' alt='' />&nbsp;<strong>Module's Description:</strong> $titanium_module_description<br />\n"
        ."<img src='../../images/menu/orange.png' border='0' alt='' />&nbsp;<strong>License:</strong> $license<br />\n"
        ."<img src='../../images/menu/orange.png' border='0' alt='' />&nbsp;<strong>Author's Name:</strong> $author_name<br />\n"
        ."<img src='../../images/menu/orange.png' border='0' alt='' />&nbsp;<strong>Author's Email:</strong> $author_user_email<br /><br />\n"
        ."<div align='center'>[ $homepage | $download | <a href='#' onclick='javascript:self.close()'>Close</a> ]</div>\n"
        ."</body>\n"
        ."</html>";
}
?>
