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
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

defined('NUKE_BASE_DIR') or die('Stop, What do you think you are doing!?!');

get_lang($module_name);

function RecommendSite() 
{
    global $module_name, $userinfo, $customlang;
    include_once(NUKE_BASE_DIR.'header.php');
    if ( !get_query_var( 'recap', 'get', 'int' ) ):
    	title($customlang[$module_name]['recommend']);
    else:
    	/**
	 	 *	If recaptcha has failed, display the error header.
	 	 */
    	title($customlang[$module_name]['recaptcha_error']);
    endif;
    OpenTable();

    $your_name = ( is_user() ) ? $userinfo['username'] : '';
    $your_mail = ( is_user() ) ? $userinfo['user_email'] : '';
	
	/**
	 *	Make sure the user is actually logged in, We do not want any anonymous users in here.
	 */
	if ( !is_user() ):
	
		echo '<div class="center">'.sprintf($customlang[$module_name]['must_be_user'], '<a class="bbcode-href" href="modules.php?name=Your_Account">', '</a>').'</div>';
		CloseTable();
    	include_once(NUKE_BASE_DIR.'footer.php');
		exit;
	
	endif;

	/**
	 *	If the sender fails the recaptcha, Send them back to the main index page.
	 */
	if ( get_query_var( 'recap', 'get', 'int' ) == 1 ):

		echo '<div class="col-12 center"><h2 style="color:#FF0000 !important;">'.$customlang[$module_name]['recaptcha_failed'].'</h2><br />[ <a href="modules.php?name=Recommend_Us">'.$customlang[$module_name]['goback'].'</a> ]</div>';
		CloseTable();
		include_once(NUKE_BASE_DIR.'footer.php');

	endif;

	echo '<style>';
	echo 'div.g-recaptcha {';
	echo '  margin: 0 auto;';
	echo '  width: 304px;';
	echo '}';
	echo '</style>';

    $gfxchk = array(0,1,2,3,4,5,6,7);

    ?>

	<form action="" method="post">
	<div class="col-10" style="display: table; border-collapse: separate; border-spacing: 10px; margin: 0 auto">

	  <div class="col-12" style="display: table-row;">	    	
        <div class="col-6" style="display: table-cell;"><?php echo $customlang[$module_name]['your_name'] ?></div>
        <div class="col-6" style="display: table-cell;"><input style="width: 98%" type="text" name="yname" value="<?php echo $your_name ?>" required></div>
	  </div>
	  <div class="col-12" style="display: table-row;">	    	
        <div class="col-6" style="display: table-cell;"><?php echo $customlang[$module_name]['your_mail'] ?></div>
        <div class="col-6" style="display: table-cell;"><input style="width: 98%" type="email" name="ymail" value="<?php echo $your_mail ?>" required></div>
	  </div>

	  <div class="col-12" style="display: table-row;">	    	
        <div class="col-6" style="display: table-cell;"><?php echo $customlang[$module_name]['friend_name'] ?></div>
        <div class="col-6" style="display: table-cell;"><input style="width: 98%" type="text" name="fname" value="" required></div>
	  </div>
	  <div class="col-12" style="display: table-row;">	    	
        <div class="col-6" style="display: table-cell;"><?php echo $customlang[$module_name]['friend_mail'] ?></div>
        <div class="col-6" style="display: table-cell;"><input style="width: 98%" type="email" name="fmail" value="" required></div>
	  </div>

	  <div class="col-12" style="display: table-row;">	    	
        <div class="col-6" style="display: table-cell; vertical-align: top;"><?php echo $customlang[$module_name]['message'] ?><span class="evo-sprite help tooltip float-right" title="<?php echo $customlang[$module_name]['optional'] ?>"></span></div>
        <div class="col-6" style="display: table-cell;"><textarea name="message" style="height: 100px; min-height: 100px; width: 98%;"></textarea></div>	      
	  </div>

	</div>
	<?php

	echo security_code($gfxchk, 'normal');

	?>
	  <input type="hidden" name="op" value="SendSite">	    
	  <div class="col-12 center" style="padding-top: 10px;"><input type="submit" value="<?php echo $customlang[$module_name]['send'] ?>"></div>
	</form>
	

    <?php

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}

function SendSite() 
{
    global $sitename, $slogan, $nukeurl, $module_name, $customlang;

    $yname = get_query_var( 'yname', 'post' );
    $ymail = get_query_var( 'ymail', 'post' );
    $fname = get_query_var( 'fname', 'post' );
    $fmail = get_query_var( 'fmail', 'post' );
    $short_message = get_query_var( 'message', 'post' );

    $subject  = $customlang[$module_name]['interesting']." $sitename ".$customlang[$module_name]['from']." $yname";
	$message  = $customlang[$module_name]['hello']." $fname<br /><br />";
	$message .= $customlang[$module_name]['your_friend'].": $yname ".$customlang[$module_name]['our_site']." $sitename ".$customlang[$module_name]['interest_sent']."<br /><br />";
	$message .= $customlang[$module_name]['sitename'].": $sitename<br />$slogan<br />";
	$message .= $customlang[$module_name]['siteurl'].": <a href=\"$nukeurl\">$nukeurl</a><br /><br />";
	if ( $short_message ):
		$message .= $customlang[$module_name]['why_i_recommend'].": <br /><br /> $short_message";
	endif;

	$gfxchk = array(0,1,2,3,4,5,6,7);
	if ( !security_code_check($_POST['g-recaptcha-response'], $gfxchk) ):

		/*
    	 *	If the user fails to complete the reCaptcha, redirec them back for another try.
    	 */
		redirect("modules.php?name=$module_name&recap=1");
	elseif (empty($fname) || empty($fmail) || empty($yname) || empty($ymail)):

		/*
    	 *	The user failed to provide the required fields, Let's redirect them and they can try again.
    	 */
		redirect("modules.php?name=$module_name");
	else:

		/**
		 *	OK, Let's set the email headers
		 */
    	$headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: '.$ymail, 'Reply-To: '.$ymail, 'Return-Path: '.$ymail );

    	/*
    	 *	OK, Now the headers are set, we can send the email.
    	 */
      	phpmailer($fmail, $subject, $message, $headers);

      	/*
    	 *	OK, we are done here, redirewct the user back to the homepage.
    	 */
		redirect("modules.php?name=$module_name&op=SiteSent&fname=$fname");

    endif;
}

function SiteSent() 
{	
    include_once(NUKE_BASE_DIR.'header.php');
    global $module_name, $customlang;
    $fname = get_query_var( 'fname', 'get' );
    OpenTable();
    echo '<div class="col-12 center">'.$customlang[$module_name]['reference'].' '.$fname.'...<br /><br />'.$customlang[$module_name]['thank_you'].'</div>';
    CloseTable();
    header( "refresh:5; url=index.php" );
    include_once(NUKE_BASE_DIR.'footer.php');
}

switch(isset($op)) {

    case "SendSite":
        SendSite();
    	break;

    case "SiteSent":
        SiteSent();
    	break;

    default:
        RecommendSite();
    	break;

}

?>