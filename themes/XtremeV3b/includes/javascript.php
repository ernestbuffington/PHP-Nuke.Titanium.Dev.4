<?php
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Inferno Theme v1.0 (Fixed & Full Width)                                               #
#                                                                                       #
# Final Build Date 03/16/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Fire and Brimstone Theme Design.                                          #
# Copyright © 2021 By: TheGhost AKA EABuffington                                        #
# e-Mail : ernest.buffington@gmail.com                                                  #
#---------------------------------------------------------------------------------------#
# CREATION INFO                                                                         #
# Created On: 03/16/2021 Tuesday 12:54am (v1.0)                                         #
#                                                                                       #
# Credit goes to Lonestar On: 1st August, 2019 (v3.0)                                   #
# HTML5 Theme Code By: Lonestar (Lonestar-Modules.com)                                  #
#                                                                                       #
# Credit goes to TheMortal                                                              #
# For his CSS MENU                                                                      #
#                                                                                       #
# Read CHANGELOG File for Updates & Upgrades Info                                       #
#                                                                                       #
# Designed By: TheGhost & Sebastian                                                     #
# Web Site: https://www.86it.us                                                         #
# Purpose: PHP-Nuke Titanium | Nuke Evolution Xtreme                                    #
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2006 by Francisco Burzi phpnuke.org                            #
# Nuke Evolution Xtreme (c) 2010 : Enhanced PHP-Nuke Web Portal System                  #
# PHP-Nuke Titanium (c) 2021     : Enhanced PHP-Nuke Web Portal System                  #
#---------------------------------------------------------------------------------------#
#                                                                                       #
# Special Honorable Mentions                                                            #
#---------------------------------------------------------------------------------------#
# killigan                                                                              # 
# -[04/17/2010] Updated Nuke Sentinel to version 2.6.01                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# SgtLegend                                                                             #   
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
# -[04/18/2010] Updated the installer/upgrade files and display                         #
# -[04/19/2010] Improved load time for global variables                                 #
# -[04/21/2010] Upgraded Swift mail to version 4.0.6                                    #
# -[04/21/2010] Upgraded HTML Purifier to version 4                                     # 
#---------------------------------------------------------------------------------------#
# Technocrat                                                                            # 
# -[04/22/2010] Added speed tweaks to the cache and PHP version compare                 #  
#---------------------------------------------------------------------------------------#
# Eyecu                                                                                 # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
# Wolfstar                                                                              # 
# -[04/17/2010] Updated Nuke Evolution to XHTML 1.0 Transitional                        #
#---------------------------------------------------------------------------------------#
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) 
exit('Access Denied');
#// do not use echo in this file myCopyRight
#// use $output .=
#//global $ThemeSel;
# This is a script load example
/* echo "<script type=\"text/javascript\" language=\"javascript\" src=\"".HTTPS."themes/".$ThemeSel."/js/liveclock.js\"></script>\n"; */
global $domain;
?>
<!-- 80sPXL W00 Thin V1 Font Info CSS -->
<link href="//db.onlinewebfonts.com/c/783dd6c2d08bdc67012a0eec73fc1702?family=80sPXLW00-Thin" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="myCopyRight" tabindex="-1" role="dialog" aria-labelledby="CenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content modal-popout-bg">
      
      <div class="modal-header">

        <h1 class="modal-title" id="CenterTitle">
        <font size="2" class="display-1" color="#000000"><i class="bi bi-arrow-right-square-fill"></i> Theme: <?=THEME?>
                 <br /><i class="bi bi-arrow-right-square-fill"></i> Copyright Domain: <?=$domain?>
                 <br /><i class="bi bi-arrow-right-square-fill"></i> Intended Use: Thee Tint Shop
                 <br /><i class="bi bi-arrow-right-square-fill"></i> Designed For: PHP-Nuke Titanium v3.0.0
                 <br /><i class="bi bi-arrow-right-square-fill"></i> Core Engine: Nuke-Evolution Xtreme v2.0.9f
                 <br /><i class="bi bi-arrow-right-square-fill"></i> Creation Date: 3/21/2021 3:05pm
                 <br /><i class="bi bi-arrow-right-square-fill"></i> Created By: Ernest Buffington aka TheGhost
        </font>
        </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  </font>

  <h1 class="display-1"><font size="4" color="black"><i class="bi bi-sliders"></i> Special Notes</font></h1> 

  <p class="lead">

  <font size="1" color="black"><strong>
  This is a very versatile theme layout and can be configured in many different ways. We will help you in any possible way provided you're a network member. If we are hosting your website or portal then you are eligible for free help. As far as configuring this theme for your web portal, just send a private message to TheGhost aka Ernest Buffington and he will help you get started.  We hope you enjoy this theme and we look forward to making thousands more and we hope they are as nice as this one.</p>
  </font></strong>

  <hr class="my-4">
  
  <font size="2" color="crimson"><strong>
  <p>Coming soon we will have several different versatile themes that you will be able to easily build upon and change to fit your website or network portal needs.</p>
  </font></strong>
  
  <div class="card-header">
  <font color="#000000"><strong>Features</strong></font>
  </div>


  <div class="card-body">
  <h5 class="card-title">
  <font size"2" color="#000000">
  <i class="devicon-javascript-plain colored"></i> Advanced Resolution Checking
  <br /><i class="devicon-php-plain colored"></i> Fluid Resizeable Layout
  <br /><i class="devicon-html5-plain colored"></i> Video Background Support
  <br /><i class="devicon-bootstrap-plain-wordmark colored"></i> BootStrap v3.4.1 Support
  <br /><i class="devicon-devicon-plain-wordmark"></i> Devicon v2.10.1 Support
  <br /><i class="devicon-css3-plain colored"></i> 2 Scrolling Marquees
  <br /><i class="devicon-php-plain colored"></i> Network Advertising and Personal Advertising Support
  <br /><i class="devicon-facebook-plain colored"></i> Titanium SDK v5 adds facebook Support to this theme.
  <br /><i class="devicon-facebook-plain colored"></i> Current Theme Resoltiuon: <?=$_COOKIE["theme_resolution"]?> 
  </h5>
  </font>
  </div>


  </div>
  
  <div class="modal-footer">
  <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
  </div>
    </div>
  </div>
</div>
<?

?>
