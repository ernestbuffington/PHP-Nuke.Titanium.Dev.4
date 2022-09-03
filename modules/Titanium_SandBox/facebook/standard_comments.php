<?php
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); } //you must have this line at the top of every module file you make!

global $name, $domain, $facebook_plugin_width;

?>
<center>
<div class="fb-like" data-href="http://<?=$domain?>/modules.php?name=<?=$name?>" ref="<?=$name?>" data-send="false"  width="<?=$facebook_plugin_width?>" show_faces="true" font="verdana"></div>
<br /><br /><div class="fb-comments" data-href="http://<?=$domain?>/modules.php?name=<?=$name?>" ref="<?=$name?>" data-num-posts="5" data-width="<?=$facebook_plugin_width?>">
</div>
</center>
<?
?>