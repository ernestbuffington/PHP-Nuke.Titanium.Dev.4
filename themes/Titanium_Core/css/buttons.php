<?php
global $theme_name;

echo "/* themes/".$theme_name."/css/buttons.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: <?=$bgcolor3?> !important;
}
 */
?>
/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  buttons.php
 * @author  :  TheGhost
 * @version :  3.0
 * @date    :  11/22/2022 (DD/MM/YYY)
 * @license :  Copyright (c) 2022 The 86it Developers Network under the MIT license
 * @notes   :  n/a
 *
 * -- -------------------------------------------------------------------
 * \/ STYLESHEET NAVIGATION
 * -- -------------------------------------------------------------------
 *
 *  1.  Buttons for Entire Website
 *  2.  
 *  3.  
 * --- -------------------------------------------------------------------
 */

/*
 * 1. Buttons for Entire Website
 *----------------------------------------
 */
.over-ride{
font-size:4.6mm;
vertical-align: middle;
color: #cccccc;
}

.btn-hover-one {
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: transparent;
  border: 1px solid <?=$bgcolor1?>;
  border-radius: 1.0em;
  color: <?=$bgcolor4?>;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-self: center;
  -ms-flex-item-align: center;
  align-self: center;
  font-size: 0.5rem;
  font-weight: 400;
  line-height: 1;
  margin: 1px;
  padding: 1.2em 2.8em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  background-color: <?=$bgcolor1?> !important;
  border-color: <?=$bgcolor2?>;
 -webkit-transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
  transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out; 
  display:inline-block;   
}

.btn-hover-one:hover {
    background-color: <?=$bgcolor2?> !important;
    border-color: <?=$textcolor1?>;
    color: white;
    box-shadow: 0 0 40px 40px <?=$bgcolor2?> inset;
    display:inline-block;
}

.btn-hover-two {
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: transparent;
  color: white;
  border: 1px solid <?=$bgcolor4?>;
  border-radius: 1.9em;
  color: <?=$bgcolor1?>;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-self: center;
  -ms-flex-item-align: center;
  align-self: center;
  font-size: 0.5rem;
  font-weight: 400;
  line-height: 1;
  margin: 1px;
  padding: 1.2em 2.8em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
  background-color: <?=$bgcolor4?> !important;
  border-color: <?=$bgcolor2?>;
 -webkit-transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out;
  transition: box-shadow 300ms ease-in-out, color 300ms ease-in-out; 
  display:inline-block;   
}

.btn-hover-two:hover {
    background-color: <?=$bgcolor3?> !important;
    border-color: <?=$textcolor1?>;
    color: white;
    box-shadow: 0 0 40px 40px <?=$bgcolor2?> inset;
    display:inline-block;
}
<?


