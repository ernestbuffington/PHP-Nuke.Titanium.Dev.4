<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
/*****[BEGIN]******************************************
 [ Mod:     facebook id                        v1.0.0 ]
 ******************************************************/
global $domain;

echo "\n\n<div id=\"fb-root\"></div>\n"; 
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";

echo "window.fbAsyncInit = function() {\n";
echo "FB.init({\n";
echo "appId      : '423684921023883',\n"; 
echo "channelUrl : 'http://music.86it.us/channel.html',\n"; 
echo "status     : true,\n"; 
echo "cookie     : true,\n"; 
echo "xfbml      : true,\n"; 
echo "oauth      : true\n";   
echo "});\n";
// Additional initialization code here
echo "};\n";

// Load the SDK Asynchronously
echo "(function(d){\n";
echo "var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}\n";
echo "js = d.createElement('script'); js.id = id; js.async = true;\n";
echo "js.src = \"//connect.facebook.net/en_US/all.js\";\n";
echo "d.getElementsByTagName('head')[0].appendChild(js);\n";
echo "}(document));\n\n\n";

echo "//-->\n";
echo "</script>\n\n\n";
/*****[END]********************************************
 [ Mod:     facebook id                        v1.0.0 ]
 ******************************************************/
?>