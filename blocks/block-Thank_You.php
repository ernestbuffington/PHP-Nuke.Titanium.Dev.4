<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

$content  = '<br />';
$content .= '<div align="center">';
$content .= '<div id="player"></div>';
$content .= '<script>';
$content .= "var tag = document.createElement('script');";
$content .= 'tag.src = "https://www.youtube.com/iframe_api";';
$content .= "var firstScriptTag = document.getElementsByTagName('script')[0];";
$content .= 'firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);';

#load the player
$content .= 'var player;';
$content .= 'function onYouTubeIframeAPIReady() {';
$content .= "player = new YT.Player('player', {";
$content .= "height: '390',";
$content .= "width: '640',";
$content .= "videoId: 'kJHpJKMTDQA',";
$content .= 'events: {';
$content .= "'onReady': onPlayerReady,";
$content .= "'onStateChange': onPlayerStateChange";
$content .= '}';
$content .= '});';
$content .= '}';

$content .= 'function onPlayerReady(event) {';
$content .= 'event.target.playVideo();';
$content .= '}';
$content .= 'var done = false;';
$content .= 'function onPlayerStateChange(event) {';
$content .= 'if (event.data == YT.PlayerState.PLAYING && !done) {';
$content .= 'setTimeout(stopVideo, 4526000);';
$content .= 'done = true;';
$content .= '}';
$content .= '}';
$content .= 'function stopVideo() {';
$content .= 'player.stopVideo();';
$content .= '}';
$content .= '</script>';
$content  .= '</div><br />';
?>
