<?php
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
$titanium_browser = new Browser();

OpenFancyTable();
global $cookie;
$name = (isset($cookie[1]) && !empty($cookie[1])) ? $cookie[1] : _ANONYMOUS;
log_write('admin', $name.' x-browser_check.php was called from facebook sandbox', 'loaded x-browser_check.php'); 

if($titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() >= 2 ) 
{
echo "<a href=\"https://www.chromium.org/\" target=\"_tab\"><img src=\"https://www.chromium.org/_/rsrc/1438879449147/config/customLogo.gif?revision=3\" align=top width=15 id=\"logo-img-id\" onload=\"ie6ImgFix('logo-img-id');\" alt=\"Logo\" class=\"sites-logo\">
The Chromium Projects</a>";
echo "<hr>";
echo $titanium_browser;
echo "<hr>";
}
  
if( $titanium_browser->isChromeFrame() == true ) 
echo 'ChromeFrame is <font color=red><b>IN USE</b></font><hr>';
else
echo 'ChromeFrame is <font color=red><b>NOT IN USE</b></font><hr>';

if( $titanium_browser->getBrowser() == Browser::BROWSER_CHROME && $titanium_browser->getVersion() >= 2 ) 
{
echo "<a href=\"http://www.google.com/chrome\"><img border=\"0\" align=top width=15 src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&amp;width=32\" width=\"32\"></a> ";
echo 'Your Chrome Support is TURNED <font color=red><b>ON</b></font>';
}
else
{
echo $titanium_browser;
echo "<hr>";  
echo 'Your Chrome Support is TURNED <font color=red><b>OFF</b></font>';
echo "<hr>";
echo "<a href=\"https://www.google.com/chrome\" target=\"_tab\"><img border=\"0\" align=top width=15 src=\"https://www.chromium.org/_/rsrc/1302286290899/chromium-projects/chrome-32.png?height=32&amp;width=32\" width=\"32\"> DOWNLOAD CHROME</a>";
}
CloseFancyTable();
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
