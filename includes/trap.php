<?

//Idea taken from http://seven-3-five.blogspot.com/2006/09/simple-php-based-bad-bot-trap_04.html

$ip = $_SERVER['REMOTE_ADDR'];
header("Content-type: text/html; charset=utf-8");
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>Caught You!</title>
    </head>

    <body>
    <p>You will now be banned!</p>

    </body>
</html>';
$text = 'deny from ' . $ip . "\r\n";
$file = dirname(__FILE__).'/.htaccess';

if (is_file($file) && is_writable($file)){
    if ($handle = @fopen($file, 'a')) {
        fwrite($handle, $text);
        fclose($handle);
    }
}

?>