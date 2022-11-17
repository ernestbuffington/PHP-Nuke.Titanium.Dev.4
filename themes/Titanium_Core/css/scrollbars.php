<?php
global $theme_name;
echo "/* themes/".$theme_name."/css/scrollbars.php Fly Kit scroll bars Style Sheet */\n"; 
echo "/* css/scrollbars.php (scroll bar colors) */\n"; 
global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
?>
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: <?=$bgcolor2?>; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: <?=$bgcolor5?>; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: <?=$bgcolor1?>; 
}
<?
