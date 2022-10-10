<?php 
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
$indicesServer = array('PHP_SELF', 
'argv', 
'argc', 
'GATEWAY_INTERFACE', 
'SERVER_ADDR', 
'SERVER_NAME', 
'SERVER_SOFTWARE', 
'SERVER_PROTOCOL', 
'REQUEST_METHOD', 
'REQUEST_TIME', 
'REQUEST_TIME_FLOAT', 
'QUERY_STRING', 
'DOCUMENT_ROOT', 
'HTTP_ACCEPT', 
'HTTP_ACCEPT_CHARSET', 
'HTTP_ACCEPT_ENCODING', 
'HTTP_ACCEPT_LANGUAGE', 
'HTTP_CONNECTION', 
'HTTP_HOST', 
'HTTP_REFERER', 
'HTTP_USER_AGENT', 
'HTTPS', 
'REMOTE_ADDR', 
'REMOTE_HOST', 
'REMOTE_PORT', 
'REMOTE_USER', 
'REDIRECT_REMOTE_USER', 
'SCRIPT_FILENAME', 
'SERVER_ADMIN', 
'SERVER_PORT', 
'SERVER_SIGNATURE', 
'PATH_TRANSLATED', 
'SCRIPT_NAME', 
'REQUEST_URI', 
'PHP_AUTH_DIGEST', 
'PHP_AUTH_USER', 
'PHP_AUTH_PW', 
'AUTH_TYPE', 
'PATH_INFO', 
'ORIG_PATH_INFO'); 
OpenTable();
echo"<b>Guide to absolute paths... </b>"
  . "<br><br>"
  . "<b>Data: __FILE__</b><br>"
  . "Data type: String<br>"
  . "Purpose: The absolute pathname of the running PHP file, including the filename.<br>"
  . "Caveat: This is not the file called by the PHP processor, it's what is running. So if you are inside an include, it's the include.<br>"
  . "Caveat: Symbolic links are pre-resolved, so don't trust comparison of paths to be accurate.<br>"
  . "Caveat: Don't assume all operating systems use '/' for the directory separator.<br>"
  . "Works on web mode: Yes<br>"
  . "Works on CLI mode: Yes<br>"
  . "<br><br>"
  . "<b>Data: __DIR__</b><br>"
  . "Data type: String<br>"
  . "Purpose: The absolute pathname to the running PHP file, excluding the filename<br>"
  . "Caveat: This is not the file called by the PHP processor, it's what is running. So if you are inside an include, it's the include.<br>"
  . "Caveat: Symbolic links are pre-resolved, so don't trust comparison of paths to be accurate.<br>"
  . "Caveat: Don't assume all operating systems use '/' for the directory separator.<br>"
  . "Works on web mode: Yes<br>"
  . "Works on CLI mode: Yes<br>"
  . "<br><br>"
  . "<b>Data: \$_SERVER['SCRIPT_FILENAME']</b><br>"
  . "Data type: String<br>"
  . "Purpose: The absolute pathname of the origin PHP file, including the filename<br>"
  . "Caveat: Not set on all PHP environments, may need setting by copying from __FILE__ before other files are included.<br>"
  . "Caveat: Symbolic links are not pre-resolved, use PHP's 'realpath' function if you need it resolved.<br>"
  . "Caveat: Don't assume all operating systems use '/' for the directory separator.<br>"
  . "Caveat: \"Filename\" makes you think it is just a filename, but it really is the full absolute pathname. Read the identifier as \"Script's filesystem (path)name\".<br>"
  . "Works on web mode: Yes<br>"
  . "Works on CLI mode: Yes<br>"
  . "<br><br>"
  . "<b>Data: \$_SERVER['PATH_TRANSLATED']</b><br>"
  . "Data type: String<br>"
  . "Purpose: The absolute pathname of the origin PHP file, including the filename<br>"
  . "Caveat: It's probably not set, best to just not use it. Just use realpath(\$_SERVER['SCRIPT_FILENAME']) (and be aware that itself may need to have been emulated).<br>"
  . "Caveat: Symbolic links are pre-resolved, so don't trust comparison of paths to be accurate.<br>"
  . "Caveat: Don't assume all operating systems use '/' for the directory separator.<br>"
  . "Works on web mode: Yes<br>"
  . "Works on CLI mode: No<br>"
  . "<br><br>"
  . "<b>Data: \$_SERVER['DOCUMENT_ROOT']</b><br>"
  . "Data type: String<br>"
  . "Purpose: Get the absolute path to the web server's document root. No trailing slash.<br>"
  . "Caveat: Don't trust this to be set, or set correctly, unless you control the server environment.<br>"
  . "Caveat: May or may not have symbolic links pre-resolved, use PHP's 'realpath' function if you need it resolved.<br>"
  . "Caveat: Don't assume all operating systems use '/' for the directory separator.<br>"
  . "Works on web mode: Yes<br>"
  . "Works on CLI mode: No<br>"
  . "<br><br>"
  . "Note that if something is not set it may be missing from $_SERVER, or it may be blank, so use PHP's 'empty' function for your test.<br>"
  . "Note that if you call \"phpinfo\" on the command line then naturally some of these settings are going to be blank, as no PHP file is involved.<br>"
  ."<br>";

echo"<span class=\"html\">"
  . "1. All elements of the <b>\$_SERVER</b> array whose keys begin with <b>'HTTP_'</b> come from HTTP request headers and are not to be trusted.<br><br>2. All HTTP headers sent to the script are made available through the <b>\$_SERVER</b> array, with names prefixed by <b>'HTTP_'</b>.<br><br>3. <b>\$_SERVER['PHP_SELF']</b> is dangerous if misused. If login.php/nearly_arbitrary_string is requested, <b>\$_SERVER['PHP_SELF']</b> will contain not just login.php, but the entire login.php/nearly_arbitrary_string. If you've printed <b>\$_SERVER['PHP_SELF']</b> as the value of the action attribute of your form tag without performing HTML encoding, an attacker can perform <b>XSS</b> attacks by offering users a link to your site such as this:<br><br>&lt;a href='<a href=\"http://www.example.com/login.php/\" rel=\"nofollow\" target=\"_blank\">http://www.example.com/login.php/</a>\"&gt;&lt;script type=\"text/javascript\"&gt;...&lt;/script&gt;&lt;span a=\"'&gt;Example.com&lt;/a&gt;<br><br>The javascript block would define an event handler function and bind it to the form's submit event. This event handler would load via an &lt;img> tag an external file, with the submitted username and password as parameters.
"
 ."<br><br>";
 
 echo "Use <b>\$_SERVER['SCRIPT_NAME']</b> instead of <b>\$_SERVER['PHP_SELF']</b>. HTML encode every string sent to the browser that should not be interpreted as HTML, unless you are absolutely certain that it cannot contain anything that the browser can interpret as HTML.";


echo "<hr><b>Guide to script parameters...</b>";
echo "<br><br>";
echo "<b>Data: \$_GET</b><br>";
echo "Data type: Array (map)<br>";
echo "Purpose: Contains all GET parameters (i.e. a parsed URL query string).<br>";
echo "Caveat: GET parameter names have to be compliant with PHP variable naming, e.g. dots are not allowed and get substituted.<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: No<br>";
echo "<br><br>";
echo "<b>Data: \$_SERVER['QUERY_STRING']</b><br>";
echo "Data type: String<br>";
echo "Purpose: Gets an unparsed URL query string.<br>";
echo "Caveat: Not set on all PHP environments, may need setting via http_build_query($_GET).<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: No<br>";
echo "<br><br>";
echo "<b>Data: \$_SERVER['argv']</b><br>";
echo "Data type: Array (list)<br>";
echo "Purpose: Get CLI call parameters.<br>";
echo "Works on web mode: Tenuous (just contains a single parameter, the query string)<br>";
echo "Works on CLI mode: Yes<br>";

echo "<hr><b>Guide to URL paths...</b>";
echo "<br><br>";

echo "<b>Data: \$_SERVER['PHP_SELF']</b><br>";
echo "Data type: String<br>";
echo "Purpose: The URL path name of the current PHP file, including path-info (see <b>\$_SERVER['PATH_INFO']</b>) and excluding URL query string. Includes leading slash.<br>";
echo "Caveat: This is after URL rewrites (i.e. it's as seen by PHP, not necessarily the original call URL).<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: Tenuous (emulated to contain just the exact call path of the CLI script, with whatever exotic relative pathname you may call with, not made absolute and not normalised or pre-resolved)<br>";

echo "<br><br>";

echo "<b>Data: \$_SERVER['SCRIPT_NAME']</b><br>";
echo "Data type: String<br>";
echo "Purpose: The URL path name of the current PHP file, excluding path-info and excluding URL query string. Includes leading slash.<br>";
echo "Caveat: This is after URL rewrites (i.e. it's as seen by PHP, not necessarily the original call URL).<br>";
echo "Caveat: Not set on all PHP environments, may need setting via preg_replace('#\.php/.*#', '.php', <b>\$_SERVER['PHP_SELF']</b>).<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: Tenuous (emulated to contain just the exact call path of the CLI script, with whatever exotic relative pathname you may call with, not made absolute and not normalised or pre-resolved)<br>";

echo "<br><br>";
echo "<b>Data: \$_SERVER['REDIRECT_URL']</b><br>";
echo "Data type: String<br>";
echo "Purpose: The URL path name of the current PHP file, path-info is N/A and excluding URL query string. Includes leading slash.<br>";
echo "Caveat: This is before URL rewrites (i.e. it's as per the original call URL).<br>";
echo "Caveat: Not set on all PHP environments, and definitely only ones with URL rewrites.<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: No<br>";

echo "<br><br>";
echo "<b>Data: \$_SERVER['REQUEST_URI']</b><br>";
echo "Data type: String<br>";
echo "Purpose: The URL path name of the current PHP file, including path-info and including URL query string. Includes leading slash.<br>";
echo "Caveat: This is before URL rewrites (i.e. it's as per the original call URL). *<br>";
echo "*: I've seen at least one situation where this is not true (there was another <b>\$_SERVER</b> variable to use instead supplied by the URL rewriter), but the author of the URL rewriter later fixed it so probably fair to dismiss this particular note.<br>";
echo "Caveat: Not set on all PHP environments, may need setting via <b>\$_SERVER['REDIRECT_URL']</b> . '?' . http_build_query(\$_GET) [if <b>\$_SERVER['REDIRECT_URL']</b> is set, and imperfect as we don't know what GET parameters were originally passed vs which were injected in the URL rewrite] --otherwise-- <b>\$_SERVER['PHP_SELF']</b> . '?' . http_build_query($_GET).<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: No<br>";

echo "<br><br>";
echo "<b>Data: \$_SERVER['PATH_INFO']</b><br>";
echo "Data type: String<br>";
echo "Purpose: Find the path-info, which is data after the .php filename in the URL call. It's a strange concept.<br>";
echo "Caveat: Some environments may not support it, it is best avoided unless you have complete server control<br>";
echo "Works on web mode: Yes<br>";
echo "Works on CLI mode: No<br>";

echo "Note that if something is not set it may be missing from $_SERVER, or it may be blank, so use PHP's 'empty' function for your test.";
//phpinfo(32);
echo "<hr>";

echo "Be warned that most contents of the Server-Array (even <b>\$_SERVER['SERVER_NAME']</b>) are provided by the client and can be manipulated. They can also be used for injections and thus MUST be checked and treated like any other user input.";

echo "<hr>";


echo '<table cellpadding=\"3\">'; 
foreach ($indicesServer as $arg) { 
    if (isset($_SERVER[$arg])) { 
        echo '<tr><td><b>'.$arg.'</b></td><td>' . $_SERVER[$arg] . '</td></tr>' ; 
    } 
    else { 
        echo '<tr><td><b>'.$arg.'</b></td><td>UNKNOWN</td></tr>' ; 
    } 
} 
echo '</table>'; 
echo "<hr>";
CloseTable3();
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
