<?php
global $theme_name;
echo "/* Fly Kit Modal Style Sheet */\n"; 
echo "/* ".$theme_name."/css/modal.php */\n\n"; 
global $screen_width, $screen_height;
?>
/*---------------------------------------------------------------*/
/* Modal Style Sheet                                             */
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
/* Modal Style Sheet                                             */
/*---------------------------------------------------------------*/

.modal-body {
#   background-image: url(themes/<?=$theme_name?>/backgrounds/1920x1080.png);
}

.modal-backdrop {
}

.modal .modal-popout-bg {
    background-image: url(themes/<?=$theme_name?>/backgrounds/modal_theme_copyright_pop_bg.png); 
}

.modal {
 
  /* Take the box out of the flow, so that it could look like a modal box */
  # position: absolute;

  /* Avoid the awkwardly stretchy box on bigger screens */
  # max-width: 550px;

  /* Aligning it to the absolute center of the page */
  #top: 50%;
  #left: 50%;
  # transform: translate(-50%, -50%);

  /* Some cosmetics */
  # border-radius: 4px;
  # background-color: rgba(0, 0, 0, .1);
  
}

.modal-hidden {
  display: none;
}

/* Make the media inside the box adapt the width of the parent */
.modal img,
.modal iframe,
.modal video 
{
  max-width: 100%;
}

/* Make the inner element relatively-positioned to contain the close button */
.modal-inner {
  position: relative;
  padding: 10px;
}

/* Close button */
.modal-close {
  font-size: 10px;

  /* Take it out of the flow, and align to the top-left corner */
  position: absolute;
  top: -10px;
  right: -10px;

  /* Size it up */
  width: 24px;
  height: 24px;

  /* Text-alignment */
  text-align: center;

  /* Cosmetics */
  color: #eee;
  border-width: 0;
  border-radius: 100%;
  background-color: black;
}
<?
