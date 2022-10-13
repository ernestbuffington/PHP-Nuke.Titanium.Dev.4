<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
/*****[BEGIN]******************************************
 [ Mod:     facebook id                        v1.0.0 ]
 ******************************************************/
    //Include the JavaScript SDK on your page once, ideally right after the opening <body> tag.
    echo "\n<div id=\"fb-root\"></div>\n";
    echo "<script type=\"text/javascript\">\n";
    echo "<!--\n";

    echo "(function(d, s, id) {\n";
    echo "  var js, fjs = d.getElementsByTagName(s)[0];\n"; 
    echo "  if (d.getElementById(id)) {return;}\n";
    echo "  js = d.createElement(s); js.id = id;\n";
    echo "  js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId='423684921023883'\";\n";
    echo "  fjs.parentNode.insertBefore(js, fjs);\n";
    echo "}(document, 'script', 'facebook-jssdk'));\n";

    echo "//-->\n";
    echo "</script>\n\n";
/*****[END]********************************************
 [ Mod:     facebook id                        v1.0.0 ]
 ******************************************************/
?>