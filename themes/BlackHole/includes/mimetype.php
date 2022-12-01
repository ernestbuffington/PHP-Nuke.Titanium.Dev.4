<?php
global $ThemeSel;
echo "\n<!-- Loading MimeType from themes/".$ThemeSel."/mimetype.php -->\n";
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo '<!DOCTYPE html>'."\n";
echo '<html lang="en">'."\n";
echo '<!-- See https://mathiasbynens.be/notes/xhtml5 for more info. -->'."\n";
echo '<!-- This document is served as application/xhtml+xml to trigger HTML5 in XML serialization mode. -->'."\n";
echo '<!-- The DOCTYPE is optional in XML mode, but if you don’t want to omit it, it needs to be uppercase. -->'."\n";
echo '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
echo "<!-- Loading Header from themes/".$ThemeSel."/mimetype.php START -->\n";
echo '<head>'."\n";
echo '<meta charset=UTF-8>'."\n";
echo "<!-- Loading Header from themes/".$ThemeSel."/mimetype.php END -->\n\n";

