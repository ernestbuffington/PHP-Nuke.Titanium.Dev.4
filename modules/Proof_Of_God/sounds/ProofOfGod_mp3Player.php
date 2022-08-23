<?php 
echo "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"250\" height=\"300\" title=\"player1\">";
echo "<param name=\"movie\" value=\"mp3player.swf?config=config.xml&playlist.xml\">";
echo "<param name=\"quality\" value=\"high\">";
echo "<embed src=\"mp3player.swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"250\" height=\"300\"></embed>";
echo "</object>";
?>