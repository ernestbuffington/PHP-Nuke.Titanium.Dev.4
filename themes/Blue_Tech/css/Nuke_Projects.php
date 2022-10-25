<?php 
global $theme_name;
echo "/* Fly Kit Nuke Projects Style Sheet */\n"; 
echo "/* ".$theme_name."/css/Nuke_Projects.php (Nuke Projects Style Sheet) */\n\n"; 

global $font_color, $screen_width, $screen_height, $textcolor1, $textcolor2, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
global $font_colorH, $font_colorV, $font_colorA, $font_colorL, $body_color; 


?>
/*---------------------------------------------------------------*/
/* Nuke Projects Style Sheet                                     */
/*                                                               */
/* Designed and Coded By: Ernest Buffington aka TheGhost         */
/* Coded On: 16th October, 2022                                  */
/* Copyright © 2022 Brandon Maintenance Management               */
/*                                                               */
/* PLEASE STEAL AND/OR USE THIS CSS CODE                         */
/* NO NEED FOR WRITTEN PERMISSION                                */
/* I did not trade a goat for this code!                         */
/*---------------------------------------------------------------*/

/*---------------------------------------------------------------*/
/* Nuke Projects Style Sheet                                     */
/*---------------------------------------------------------------*/

/* Modules Link START */
a.modules,input.modules {   /* Modules Link */
  display:inline-block;
   box-sizing: border-box;
    text-decoration:none;
     font-family:'Roboto',sans-serif;
      font-weight:bold;
    color: grey;            /* Link Color */
   text-align:center;
  transition: all 0.2s;
}

a.modules:hover,input.modules:hover {
  color:darkgrey;           /* Highlight Color On Hover */
}

@media all and (max-width:30em) {
  a.modules, input.modules {
    display:block;
  }
}
/* Modules Link END */

.circle {

}

/* Project Link Active Project START */
a.projectlinkactive,input.projectlkactive {
  display:inline-block;
   box-sizing: border-box;
    text-decoration:none;
     font-family:'Roboto',sans-serif;
    font-weight:bold;
   color: #66FF00;          /* Link Color */
  text-align:center;
 transition: all 0.2s;
}

a.projectlinkactive:hover,input.projectlinkactive:hover {
  color:white;              /* Highlight Color Hover */
}

@media all and (max-width:30em) {
  a.projectlinkactive, input.projectlinkactive {
    display:block;
  }
}
/* Project Link Active Project END */

/* Project Link InActive Project START */
a.projectlinkinactive,input.projectlinkinactive {
  display:inline-block;
   box-sizing: border-box;
    text-decoration:none;
     font-family:'Roboto',sans-serif;
    font-weight:bold;
   color: grey;             /* Link Color - Regular Appearance */
  text-align:center;
 transition: all 0.2s;
}

a.projectlinkinactive:hover,input.projectlinkinactive:hover {
  color:white;              /* Highlight Color On Hover */
}

@media all and (max-width:30em) {
  a.projectlinkinactive, input.projectlinkinactive {
    display:block;
  }
}
/* Project Link InActive Project END */


/* Project Link Pending Project START */
a.projectlinkpending,input.projectlinkpending {
  display:inline-block;
   box-sizing: border-box;
    text-decoration:none;
     font-family:'Roboto',sans-serif;
    font-weight:bold;
   color: #66FFFF;          /* Start Link Color - Regular Appearance */
  text-align:center;
 transition: all 0.2s;
}

a.projectlinkpending:hover,input.projectlinkpending:hover {
  color:white;              /* Highlight Color On Hover */
}

@media all and (max-width:30em) {
  a.projectlinkpending, input.projectlinkpending {
    display:block;
  }
}
/* Project Link Pending Project END */


/* Project Link Released Project START */
a.projectlinkreleased,input.projectlinkreleased {
  display:inline-block;
   box-sizing: border-box;
    text-decoration:none;
     font-family:'Roboto',sans-serif;
    font-weight:bold;
   color: #FF3366;          /* Start Link Color - Regular Appearance */
  text-align:center;
 transition: all 0.2s;
}

a.projectlinkreleased:hover,input.projectlinkreleased:hover {
  color:white;              /* Highlight Color On Hover */
}

@media all and (max-width:30em) {
  a.projectlinkreleased, input.projectlinkreleased {
    display:block;
  }
}
/* Project Link Released Project END */


/* Regular Project Link */
a.projectlink,input.projectlink {
  display:inline-block;
   box-sizing: border-box;
    text-decoration:none;
     font-family:'Roboto',sans-serif;
    font-weight:bold;
   color: white;            /* Start Link Color - Regular Appearance */
  text-align:center;
 transition: all 0.2s;
}

a.projectlink:hover,input.projectlink:hover {
  color:white;              /* Highlight Color On Hover */
}

@media all and (max-width:30em) {
  a.projectlink, input.projectlink {
    display:block;
  }
}

/* Proof Of God v1.0 Style Sheet Cell Colors and Backgrounds START */ 
/* Main table cell colours and backgrounds */
td.proof_of_god_row1 {
  background: <?=$bgcolor2?>;
   border: 1px solid #212f47;
  padding: 4px;
}

td.proof_of_god_row2 {
  border: 1px solid #212f47;
 padding: 14px;
}

td.proof_of_god_row3 {
  background-color: <?=$bgcolor4?>;
   border: 1px solid border: 1px solid <?=$bgcolor3?>;
  border: 1px solid <?=$bgcolor3?>;
 padding: 4px;
}

/* Nuke_Projects Style Sheet Cell Colors and Backgrounds START */ 
/* Main table cell colours and backgrounds */
td.projects_row1 {
  background: <?=$bgcolor2?>;
   border: 1px solid #212f47;
  padding: 4px;
}

td.projects_row2 {
  border: 1px solid #212f47;
 padding: 14px;
}

td.projects_row3 {
  background-color: <?=$bgcolor4?>;
    border: 1px solid border: 1px solid <?=$bgcolor3?>;
   border: 1px solid <?=$bgcolor3?>;
  padding: 4px;
}

/* Nuke_Projects Style Sheet Cell Colors and Backgrounds END */ 
input[type='checkbox']{
   width:17px;height:17px;
  cursor: pointer;
}
<?
