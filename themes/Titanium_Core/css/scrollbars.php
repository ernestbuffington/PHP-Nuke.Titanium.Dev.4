<?php
global $theme_name;
echo "/* themes/".$theme_name."/css/scrollbars.php Fly Kit scroll bars Style Sheet */\n"; 
echo "/* css/scrollbars.php (scroll bar colors) */\n"; 
global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
?>
::-webkit-scrollbar {
  width: 2px;
}

::-webkit-scrollbar {
  height: 12px;
  width: 12px;
  background: <?=$bgcolor1?>;
  -webkit-border-radius: 1ex;
}

::-webkit-scrollbar-thumb {
  background: <?=$bgcolor1?>;
  -webkit-border-radius: 1ex;
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.75);
}

::-webkit-scrollbar-corner {
  background: <?=$bgcolor5?>;
}
html, body{scrollbar-color: <?=$bgcolor1?> <?=$bgcolor2?>}

/* Track */
::-webkit-scrollbar-track {
  background: <?=$bgcolor1?>; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: <?=$bgcolor2?>; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: <?=$bgcolor1?>; 
}
<?
