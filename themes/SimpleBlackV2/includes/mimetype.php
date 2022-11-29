<?php
global $ThemeSel;
echo "\n<!-- Loading MimeType from themes/".$ThemeSel."/mimetype.php -->\n";
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" />'."\n";
echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'" />'."\n";
echo '<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml" />'."\n"; 
echo "<!-- START <head> -->\n";
echo "<!-- Loading Header from themes/".$ThemeSel."/mimetype.php START -->\n";
echo '<head>'."\n";
echo '<!--[if IE]>'."\n";
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'."\n";
echo '<![endif]-->'."\n";
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
echo '<meta http-equiv="Content-Language" content="'._LANGCODE.'" />'."\n";
echo '<meta http-equiv="Content-Style-Type" content="text/css" />'."\n";
echo '<meta http-equiv="Content-Script-Type" content="text/javascript" />'."\n";
echo "<!-- Loading Header from themes/".$ThemeSel."/mimetype.php END -->\n\n";

