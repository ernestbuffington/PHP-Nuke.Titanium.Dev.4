<?php
global $theme_name;

echo "\n\n/* themes/".$theme_name."/css/menu.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
?>
.button {
  background-color: <?=$bgcolor1?>;
  border: none;
  color: white;
  padding: 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}

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
    # button border
    border-color: <?=$textcolor1?>;
    color: #CCC;
    outline: 1;
    # box background
    box-shadow: 0 0 40px 40px <?=$bgcolor2?> inset;
    display:inline-block;
}

.btn-hover-two {
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: transparent;
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
    # button border
    border-color: <?=$textcolor1?>;
    color: #CCC;
    outline: 1;
    # box background
    box-shadow: 0 0 40px 40px <?=$bgcolor2?> inset;
    display:inline-block;
}

/* Dropdown Button */
.dropbtn {
  background-color: <?=$bgcolor1?>;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: <?=$bgcolor1?>;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover 
{
  background-color: <?=$bgcolor2?>;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content 
{
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn 
{
  background-color: <?=$bgcolor1?>;
}

/* Dropdown Button */
.adropbtn {
  background-color: <?=$bgcolor2?>;
  border: none;
}

/* Dropdown Button */
.adropbtn-admin {
  background-color: none;
  border: none;
}


/* Change the background color of the dropdown button when the dropdown content is shown */
.adropdown:hover .adropbtn 
{
  color: <?=$bgcolor1?> !important;
  background-color: <?=$bgcolor4?>;
}


#ul.dropdown-content a:hover 
#{ 
#  color: <?=$bgcolor1?> !important;
#  background-color: <?=$bgcolor4?>; 
#}
<?


