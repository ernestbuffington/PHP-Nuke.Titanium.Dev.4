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

/***************************************************************************
 *   This file is part of the phpBB2 port to Nuke 6.0 (c) copyright 2002
 *   by Tom Nitzschner (tom@toms-home.com)
 *   http://bbtonuke.sourceforge.net (or http://www.toms-home.com)
 *
 *   As always, make a backup before messing with anything. All code
 *   release by me is considered sample code only. It may be fully
 *   functual, but you use it at your own risk, if you break it,
 *   you get to fix it too. No waranty is given or implied.
 *
 *   Please post all questions/request about this port on http://bbtonuke.sourceforge.net first,
 *   then on my site. All original header code and copyright messages will be maintained
 *   to give credit where credit is due. If you modify this, the only requirement is
 *   that you also maintain all original copyright messages. All my work is released
 *   under the GNU GENERAL PUBLIC LICENSE. Please see the README for more information.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      NukeSentinel                             v2.4.1       08/31/2005
      Theme Management                         v1.0.2       12/14/2005
-=[Mod]=-
      Anti-Spam                                v1.1.0       06/18/2005
      IE PNG Fix                               v1.0.0       06/24/2005
      Password Strength Meter                  v1.0.0       07/12/2005
      ToolManDHTML                             v0.0.2       03/20/2005
      Switch Content Script                    v2.0.0       03/29/2006
      Resize Posted Images                     v2.4.5       06/15/2005
      IE Embed Fix                             v1.0.0       04/24/2006
	  jQuery Lightbox Resize Images            v0.5
 ************************************************************************/


//Note due to all the windows.onload use womAdd('function_name()'); instead

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
  exit('Access Denied');
}

include_once(NUKE_INCLUDE_DIR.'styles.php');

##################################################
# Include for some common javascripts functions  #
##################################################
addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'javascript/onload.js','file');

###############################################################
# Quick reply javascript Added back 10/08/2022 TheGhost START #
###############################################################
addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'javascript/sqr_show_hide.js','file');
###############################################################
# Quick reply javascript Added back 10/08/2022 TheGhost END   #
###############################################################

/*****[BEGIN]******************************************
 [ Base:    NukeSentinel                       v2.4.1 ]
 ******************************************************/
global $sentineladmin;
if(!defined('FORUM_ADMIN')) 
{
    addJSToHead('includes/nukesentinel/overlib.js','file');
    addJSToHead('includes/nukesentinel/overlib_hideform.js','file');
    addJSToHead('includes/nukesentinel/nukesentinel3.js','file');
}
/*****[END]********************************************
 [ Base:    NukeSentinel                       v2.4.1 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Facebook Mod                       v1.0.0 ]
 ******************************************************/
global $appID, $api_version, $appSecret, $my_url, $connected;
if ($appID > 0) { # This will not load if there is not a facebook app id.
echo "\n<script>\n";
echo "<!--\n";
##################################################################################################################
## titaniumAPI                                                                                                  ##
##################################################################################################################
echo "function titaniumAPI() {\n";                   // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
echo "console.log('Welcome!  Fetching your information.... ');\n";
echo "FB.api('/me', function(response) {\n";
echo "console.log('Successful login for: ' + response.name);\n";
    // this error comes with the following
    // Uncaught TypeError: Cannot set property 'innerHTML' of null
    // echo "document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';\n";
echo "});\n";
echo "}\n";
##################################################################################################################
## statusChangeCallback                                                                                         ##
##################################################################################################################
echo "function statusChangeCallback(response) {\n";  // Called with the results from FB.getLoginStatus().
echo "console.log('statusChangeCallback');\n";
echo "console.log(response);\n";                   // The current login status of the person.
echo "if (response.status === 'connected') {\n";   // Logged into your webpage and Facebook.
echo "titaniumAPI();\n";  
echo "} else {\n";                                 // Not logged into your webpage or we are unable to tell.
echo "document.getElementById('status').innerHTML = 'Please log ' +\n";
echo "'into our Facebook app if you would like to leave a comment.';\n";
echo "}\n";
echo "}\n\n";
##################################################################################################################
## checkLoginState                                                                                              ##
##################################################################################################################
echo "function checkLoginState() {\n";               // Called when a person is finished with the Login Button.
echo "FB.getLoginStatus(function(response) {\n";     // See the onlogin handler
echo "statusChangeCallback(response);\n";
echo "});\n";
echo "}\n\n";



##################################################################################################################
## Facebook Init                                                                                                ##
##################################################################################################################
echo "window.fbAsyncInit = function() {\n";
echo "FB.init({\n";
echo "appId      : '{$appID}',\n"; # the value for this comes from the config.php file in the root.
echo "cookie     : true,\n";
echo "xfbml      : true,\n";
echo "version    : '{$api_version}'\n";  # the value for this comes from the config.php file in the root.
echo "});\n";
##################################################################################################################
### Facebook Login Status                                                                                       ##
##################################################################################################################
echo "FB.getLoginStatus(function(response)\n"; 
echo "{\n";
 
   echo "statusChangeCallback(response);\n";
   
   echo "if (response.status === 'connected')\n";
   echo "{\n";
			 // connected
             echo "var uid = response.authResponse.userID;\n";
             echo "var accessToken = response.authResponse.accessToken;\n";
             echo "console.log(response.authResponse.accessToken);\n";
   echo "}\n";
   echo "else\n"; 
   echo "if (response.status === 'not_authorized')\n";
   echo "{\n";
             // not_authorized
   echo "}\n";
   echo "else\n";
   echo "{\n";
             // not_logged_in
   echo "}\n";
echo "});\n";
##################################################################################################################
## Facebook Log Page View                                                                                       ##
##################################################################################################################
echo "FB.AppEvents.logPageView();\n";   
##################################################################################################################
echo "};\n";

echo "(function(d, s, id){\n";
echo "var js, fjs = d.getElementsByTagName(s)[0];\n";
echo "if (d.getElementById(id)) {return;}\n";
echo "js = d.createElement(s); js.id = id;\n";
echo "js.src = 'https://connect.facebook.net/en_US/sdk.js';\n";

//Just one of the many ways facebook fucks us all, this would not load or even show up!
//Failed to load resource: the server responded with a status of 500 ()
//echo "js.src = 'https://connect.facebook.net/en_US/debug.js';\n"; This

echo "fjs.parentNode.insertBefore(js, fjs);\n";
echo "}(document, 'script', 'facebook-jssdk'));\n";
echo "//-->\n";
echo "</script>\n\n";

  # Check for user facebook cookie? Are you logged in with our facebook app or not!
  if(isset($_COOKIE['fbsr_' . $appID]))
  $connected = '::: Thanks for logging into our facebook app :::';
  else	
  $connected = '::: You aren\'t logged into our facebook app :::';

}
/* echo "\n<script>\n"; */
/* echo "<!--\n";                                */
/* echo "//-->\n";                               */
/* echo "</script>\n\n";                         */
/*****[END]********************************************
 [ Mod:     Facebook Mod                       v1.0.0 ]
 ******************************************************/

if (isset($userpage)) {
    echo "<script>\n";
    echo "<!--\n";
    echo "function showimage() {\n";
    echo "if (!document.images)\n";
    echo "return\n";
    echo "document.images.avatar.src=\n";
    echo "'$nukeurl/modules/Forums/images/avatars/gallery/' + document.Register.user_avatar.options[document.Register.user_avatar.selectedIndex].value\n";
    echo "}\n";
    echo "//-->\n";
    echo "</script>\n\n";
}

global $name;
if (defined('MODULE_FILE') && !defined("HOME_FILE") AND file_exists("modules/".$name."/copyright.php")) {
    echo "<script>\n";
    echo "<!--\n";
    echo "function openwindow(){\n";
    echo "    window.open (\"modules/".$name."/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\");\n";
    echo "}\n\n";
    echo "//-->\n";
    echo "</script>\n\n";
}

/*****[BEGIN]******************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/
if (!defined('ADMIN_FILE')) 
{
    addJSToHead(NUKE_JQUERY_SCRIPTS_DIR.'javascript/anti-spam.js','file', true);
}
/*****[END]********************************************
 [ Mod:     Anti-Spam                         v.1.1.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/
if(get_evo_option('recap_site_key') && get_evo_option('recap_priv_key'))
{
    echo "<script src='https://www.google.com/recaptcha/api.js".(!empty(get_evo_option('recap_lang')) ? "?hl=".get_evo_option('recap_lang') : "")."' defer></script>";
}
 /*****[END]*******************************************
 [ Mod:     Advanced Security Code Control     v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     Arcade                             v1.0.0 ]
 ******************************************************/
# Fixed 10/08/2022 START
# PHP Deprecated:  Unparenthesized `a ? b : c ? d : e` is deprecated. Use either `(a ? b : c) ? d : e` or `a ? b : (c ? d : e)`
$arcade_on = ((isset($_GET['file']) && $_GET['file'] == 'arcade_games') ? true : ((isset($_POST['file']) && $_POST['file'] == 'arcade_games') ?  true : false)); //Fixed TheGhost

if (!$arcade_on) {
    $arcade_on = ((isset($_GET['do']) && $_GET['do'] == 'newscore') ? true : ((isset($_POST['do']) && $_POST['do'] == 'newscore') ? true : false)); //Fixed TheGhost
}
# PHP Deprecated:  Unparenthesized `a ? b : c ? d : e` is deprecated. Use either `(a ? b : c) ? d : e` or `a ? b : (c ? d : e)`
# Fixed 10/08/2022 END
/*****[END]********************************************
 [ Mod:     Arcade                             v1.0.0 ]
 ******************************************************
  
/*****[BEGIN]******************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/
 global $admin_file;
 if(isset($name) && ($name == "Your Account" || $name == "Your_Account" || $name == "Profile" || defined('ADMIN_FILE'))) {
     echo '<script>
        var pwd_strong = "'.PSM_STRONG.'";
        var pwd_stronger = "'.PSM_STRONGER.'";
        var pwd_strongest = "'.PSM_STRONGEST.'";
        var pwd_notrated = "'.PSM_NOTRATED.'";
        var pwd_med = "'.PSM_MED.'";
        var pwd_weak = "'.PSM_WEAK.'";
        var pwd_strength = "'.PSM_CURRENTSTRENGTH.'";
    </script>';
    echo "<script type=\"text/javascript\" src=\"".NUKE_JQUERY_SCRIPTS_DIR."javascript/password_strength.js\" defer></script>\n";
 }
/*****[END]********************************************
 [ Mod:     Password Strength Meter            v1.0.0 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/
if (defined('ADMIN_FILE')) {
    echo "<script>\n";
    echo "<!--\n";
    echo "function themepreview(theme){\n";
    echo "window.open (\"index.php?tpreview=\" + theme + \"\",\"ThemePreview\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=1000,height=800\");\n";
    echo "}\n";
    echo "//-->\n";
    echo "</script>\n\n";
}
/*****[END]********************************************
 [ Base:    Theme Management                   v1.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Mod:     ToolManDHTML                       v0.0.2 ]
 ******************************************************/
if (defined('ADMIN_FILE') && defined('USE_DRAG_DROP')) {
    global $element_ids, $Sajax;
    if(isset($Sajax) && is_object($Sajax)) {
        echo "<script>\n<!--\n";
        echo $Sajax->sajax_show_javascript();
        echo "//-->\n";
        echo "</script>\n";
    }
    $i = 0;
    $script_out = '';
    if(!is_array($element_ids)) $element_ids = array();
    foreach ($element_ids as $id) {
        if(!$i) {
            $script_out .= "var list = document.getElementById(\"".$id."\");\n";
            $i++;
        } else {
            $script_out .= "list = document.getElementById(\"".$id."\");\n";
        }

        global $g2;
        $script_out .= (!$g2) ? "DragDrop.makeListContainer( list, 'g1' );\n" : "DragDrop.makeListContainer( list, 'g2' );\n";
        // $script_out .= "list.onDragOver = function() { this.style[\"background\"] = \"#EEF\"; };\n";
        $script_out .= "list.onDragOut = function() {this.style[\"background\"] = \"none\"; };\n\n\n";
        $script_out .= "list.onDragDrop = function() {onDrop(); };\n";
    }

    //echo "<link rel=\"stylesheet\" href=\"includes/ajax/lists.css\" type=\"text/css\">";
    echo "<script src=\"includes/ajax/coordinates.js\" defer></script>\n";
    echo "<script src=\"includes/ajax/drag.js\" defer></script>\n";
    echo "<script src=\"includes/ajax/dragdrop.js\" defer></script>\n";
    echo "<script><!--
    function confirm(z)
    {
      window.status = 'Sajax version updated';
    }

    function create_drag_drop() {";

        echo $script_out;

    echo "};

    if (window.addEventListener)
        window.addEventListener(\"load\", create_drag_drop, false)
    else if (window.attachEvent)
        window.attachEvent(\"onload\", create_drag_drop)
    else if (document.getElementById)
        womAdd('create_drag_drop()');
    //-->
</script>\n";
}
/*****[END]********************************************
 [ Mod:     ToolManDHTML                       v0.0.2 ]
 ******************************************************/

/*****[BEGIN]******************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
global $plus_minus_images, $collapse;
if ($collapse) 
{
    $JStoBody  = '<script>'.PHP_EOL;
    $JStoBody .= '  var enablepersist   = "on";'.PHP_EOL;
    $JStoBody .= '  var memoryduration  = "7";'.PHP_EOL;
    $JStoBody .= '  var contractsymbol  = "'.$plus_minus_images['minus'].'";'.PHP_EOL;
    $JStoBody .= '  var expandsymbol    = "'.$plus_minus_images['plus'].'";'.PHP_EOL;
    $JStoBody .= '</script>'.PHP_EOL;
    addJSToBody($JStoBody,'inline');
    addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'javascript/collapse_blocks.js','file');
}
/*****[END]********************************************
 [ Base:    Switch Content Script              v2.0.0 ]
 ******************************************************/
/*****[BEGIN]******************************************
 [ Mod:     jQuery                             v1.5.0 ]
 ******************************************************/
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.php');
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.reimg.image.resizer.php');
/**
 * A jQuery Plugin to replace Javascript's window.alert(), window.confirm() and window.prompt() functions
 *
 * @package gasparesganga-jquery-message-box
 * @author  Gaspare Sganga <contact@gasparesganga.com> (https://gasparesganga.com)
 * @version 3.0.0
 * @license MIT
 * @link    https://gasparesganga.com/labs/jquery-message-box/
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.messagebox.php');

/**
 * jQuery lightbox and modal window plugin.
 *
 * @package Color picker
 * @author  Stefan Petre
 * @license MIT and GPL-3.0
 * @link    https://www.eyecon.ro/
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.colorpicker.php');

/**
 * Touch enabled, responsive and fully customizable jQuery lightbox script.
 *
 * @package @fancyapps/fancybox
 * @author  fancyApps
 * @version 3.5.7
 * @license GPL-3.0
 * @link    https://fancyapps.com/fancybox/3/
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.fancybox.php');

/**
 * The original Lightbox script.
 *
 * This lightbox script require a slideshow name to be provided at all times, so i have used gallery as the default, 
 * Can still be changes via the function call.
 *
 * @package Lightbox2
 * @author  Lokesh Dhakar <lokesh.dhakar@gmail.com>
 * @version 2.10.0
 * @license https://raw.githubusercontent.com/lokesh/lightbox2/master/LICENSE  MIT
 * @link    https://lokeshdhakar.com/projects/lightbox2/
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.lightbox.php');

/**
 * jQuery lightbox and modal window plugin.
 *
 * @package jquery-colorbox
 * @author  Jack Moore <hello@jacklmoore.com>
 * @version 1.6.4
 * @license GPL-3.0
 * @link    http://www.jacklmoore.com/colorbox
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.colorbox.php');

/**
 * Lightweight, accessible and responsive lightbox.
 *
 * @package lity
 * @author  Jan Sorgalla
 * @version 2.3.1
 * @license MIT
 * @link    http://sorgalla.com/lity/
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.lightbox-lite.php');

/**
 * Live feed from Evolution Xtreme.
 *
 * Shows the latest live news coming from the Evolution Xtreme site,
 * It is designed to keep you up to date on changes to the CMS, Blocks, Modules & Themes.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @version 1.0.0
 * @license GPL-3.0
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.live.feed.php');

/**
 * Scroll back to top script.
 *
 * A floating button link will appear when you scroll down the page.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @version 1.0.0
 * @license GPL-3.0
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.scroll.to.top.php');            # add in option to change icon per theme

/**
 * New Private message alert
 *
 * Original concept came from coRpSE, This is a modification/re-write of the original mod.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @author coRpSE <https://www.headshotdomain.net>
 * @version 1.0.0
 * @license GPL-3.0
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.private.messages.alert.php');

/**
 * Floating Administration Menu
 *
 * A floating menu designed for Administration quick links.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @version 2.0
 * @license GPL-3.0
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.floating.admin.php');

/**
 * Username Avalibility Check.
 *
 * Does a check via AJAX to check if the username a new registered user enters is in use.
 *
 * @since 2.0.9e 
 *
 * @author coRpSE <https://www.headshotdomain.net>
 * @version 1.0
 * @license GPL-3.0
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.username.availability.php');

/**
 * A flexible and extensible jQuery plugin for modern tooltips.
 *
 * @package tooltipster
 * @author  Caleb Jacob <hello@calebjacob.com>
 * @version 4.2.6
 * @license MIT
 * @link    https://github.com/iamceege/tooltipster
 */
include(NUKE_JQUERY_INCLUDE_DIR.'jquery.tooltipster.php');
/*****[END]********************************************
 [ Mod:     jQuery                             v1.5.0 ]
 ******************************************************/
echo "\n<!--                                                                                
@@@@@@@  @@@  @@@  @@@@@@@@   @@@@@@@@  @@@  @@@   @@@@@@    @@@@@@   @@@@@@@  
@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@@@  @@@  @@@  @@@@@@@@  @@@@@@@   @@@@@@@  
  @@!    @@!  @@@  @@!       !@@        @@!  @@@  @@!  @@@  !@@         @@!    
  !@!    !@!  @!@  !@!       !@!        !@!  @!@  !@!  @!@  !@!         !@!    
  @!!    @!@!@!@!  @!!!:!    !@! @!@!@  @!@!@!@!  @!@  !@!  !!@@!!      @!!    
  !!!    !!!@!!!!  !!!!!:    !!! !!@!!  !!!@!!!!  !@!  !!!   !!@!!!     !!!    
  !!:    !!:  !!!  !!:       :!!   !!:  !!:  !!!  !!:  !!!       !:!    !!:    
  :!:    :!:  !:!  :!:       :!:   !::  :!:  !:!  :!:  !:!      !:!     :!:    
   ::    ::   :::   :: ::::   ::: ::::  ::   :::  ::::: ::  :::: ::      ::    
   :      :   : :  : :: ::    :: :: :    :   : :   : :  :   :: : :       :     
                                                                                -->\n";
# Easter Egg Hunt added by who I'm not sure but it's cute
# addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'Evo.EE.js','file');
# addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'Evo.EE.CMD.js','file');
echo "\n<!-- Ernest Allen Buffington aka TheGhost was here 11/20/2022 -->\n\n";

global $analytics;

if (!empty($analytics)) {
   echo "<script>
           var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
           document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
         </script>
         <script>
           var pageTracker = _gat._getTracker(\"".$analytics."\");
           pageTracker._initData();
           pageTracker._trackPageview();
         </script>";
}

global $more_js;
if (!empty($more_js)) {
    echo $more_js;
}

//DO NOT PUT ANYTHING AFTER THIS LINE
echo "<!--[if IE]><script>womOn();</script><![endif]-->\n";

?>
