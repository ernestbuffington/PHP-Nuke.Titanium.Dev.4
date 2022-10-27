<?php
global $theme_name;
echo "/* Fly Kit Scroll Bars Style Sheet */\n"; 
echo "/* themes/".$theme_name."/css/scrollbars.php (scroll bar colors) */\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;

?>
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #8d7b4d; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #af975f; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #645838; 
}
<?
