<?php
global $theme_name;
echo "/* themes/".$theme_name."/css/scrollbars.php Fly Kit scroll bars Style Sheet */\n"; 
echo "/* css/scrollbars.php (scroll bar colors) */\n"; 
global $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5, $fieldset_border_width, $locked_width;
?>
::-webkit-scrollbar {
  width: 2px;
}
::-webkit-scrollbar {
  width: 11px;
  background: <?=$bgcolor1?>;
  -webkit-border-radius: 1ex;
}
::-webkit-scrollbar-thumb {
  background: <?=$bgcolor5?>;
  -webkit-border-radius: 1ex;
  -webkit-box-shadow: 0px 2px 2px <?=$bgcolor1?>;
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: <?=$bgcolor5?>; 
}
::-webkit-scrollbar-corner {
  background: <?=$bgcolor5?>;
}
/* Track */
::-webkit-scrollbar-track {
  background: <?=$bgcolor1?>; 
}

/* Mozilla Scroll Bars      Gray Thumb / Black Track */
html, body
{
  scrollbar-color: <?=$bgcolor5?> <?=$bgcolor1?>;
  scrollbar-width: thin;
}

/* Mac */
.scrollable-element 
{
  scrollbar-color: dark;
}
<?
