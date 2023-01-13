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
/* Based on php Addon Feedback 1.0                                      */
/* Copyright (c) 2001 by Jack Kozbial                                   */
/* http://www.InternetIntl.com                                          */
/* jack@internetintl.com                                                */
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

if (!defined('MODULE_FILE'))
	die('You can not access this file directly...');

global $lang_new;

// $module_name = basename(dirname(__FILE__));
get_header();

# Let include the language file.
if(file_exists(NUKE_MODULES_DIR.the_module().'/language/lang-'.$currentlang.'.php'))
	include_once(NUKE_MODULES_DIR.the_module().'/language/lang-'.$currentlang.'.php');
else
	include_once(NUKE_MODULES_DIR.the_module().'/language/lang-english.php');

# Just an empty variable so an error is not thrown.
$error_message = array();

OpenTable();

echo '<div class="nuketitle acenter">'.sprintf($lang_new[the_module()]['title'], $sitename).'</div><br /><br />';

if (isset($_POST['action']) && $_POST['action'] == 'submit' ):

	# Throw an error, If the user fails the reCaptcha.
	if (!security_code_check($_POST['g-recaptcha-response'], array(0,1,2,3,4,5,6,7))):
		$error_message[] = $lang_new[$module_name]['reCaptcha'];
	endif;

	if ( empty($_POST['sender_name']) ):
		$error_message[] = $lang_new[$module_name]['name_error'];
	endif;

	if ( empty($_POST['sender_email']) ):
		$error_message[] = $lang_new[$module_name]['email_error'];
	endif;

	if ( empty($_POST['message']) ):
		$error_message[] = $lang_new[$module_name]['message_error'];
	endif;

	# Display all errors found during submission.
	if (count($error_message) > 0):

		echo '<div class="acenter">';
		foreach($error_message as $error_string):
			echo '  <div>'.$error_string.'</div>';
		endforeach;
		echo '  <br /><div>'.sprintf($lang_new[$module_name]['back'],'<a href="javascript:history.go(-1)">','</a>').'</div>';
		echo '</div>';

	else:

		// $sender_name 	= Remove_Slashes(removecrlf($_POST['sender_name']));
  //       $sender_email 	= Remove_Slashes(removecrlf($_POST['sender_email']));
  //       $message 		= Remove_Slashes($_POST['message']);
		$sender_name 	= get_query_var('sender_name', 'post');
        $sender_email 	= get_query_var('sender_email', 'post');
        $message 		= get_query_var('message', 'post');

        $msg  = $sitename."\n\n";
        $msg .= $lang_new[$module_name]['sender'].": $sender_name\n";
        $msg .= $lang_new[$module_name]['sender_email'].": $sender_email\n";
        $msg .= $lang_new[$module_name]['message'].": $message\n\n";
        $msg .= $lang_new[$module_name]['ip'].": ".$nsnst_const['remote_ip']."\n\n";
        $msg = nl2br($msg);

        $subject = sprintf($lang_new[$module_name]['title'], $sitename);
  //       $to = $adminmail;
  //       $mailheaders = "From: $sender_name <$sender_email>\r\n";
  //       $mailheaders .= "Reply-To: $sender_email\r\nX-Mailer: PHP/" . phpversion();
  //       evo_mail($to, $subject, $msg, $mailheaders);


		/**
		 *	OK, Let's set the email headers
		 */
    	$headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: '.$sender_name.' <'.$sender_email.'>', 'Reply-To: '.$sender_email );

    	/*
    	 *	OK, Now the headers are set, we can send the email.
    	 */
      	phpmailer($adminmail, $subject, $msg, $headers);

        echo '<div class="acenter"><p>'.$lang_new[$module_name]['email_sent'].'</p></div>';
        echo '<div class="acenter"><p>'.$lang_new[$module_name]['thanks'].'</p></div>';

	endif;
	CloseTable();
	get_footer();
	die();

endif;

echo '<div>'.$lang_new[$module_name]['note'].'</div><br />';

if(!isset($_POST['message']))
$_POST['message'] = '';

echo '<form action="modules.php?name='.$module_name.'" method="post" name="feedback">';
echo '<input type="hidden" name="action" value="submit">';
echo '<div class="textbold" style="margin-left:1px;">'.$lang_new[$module_name]['name'].'</div><input type="text" name="sender_name" value="'.$userinfo['username'].'" size="30" required><br /><br />';
echo '<div class="textbold" style="margin-left:1px;">'.$lang_new[$module_name]['email'].'</div><input type="email" name="sender_email" value="'.$userinfo['user_email'].'" size="30" required><br /><br />';
echo '<div class="textbold" style="margin-left:1px;">'.$lang_new[$module_name]['message'].'</div><textarea data-autoresize name="message" style="resize: none; width: 99.8%; height: 190px; min-height: 190px;" required>'.$_POST['message'].'</textarea><br /><br />';
echo security_code(array(0,1,2,3,4,5,6,7), 'normal').'<br />';
echo '<input type="submit" name="submit" value="'.$lang_new[$module_name]['send'].'">';
echo '<form>';

CloseTable();
get_footer();

?>