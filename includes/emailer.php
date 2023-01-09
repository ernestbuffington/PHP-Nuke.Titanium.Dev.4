<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
                                emailer.php
                             -------------------
    begin                : Sunday Aug. 12, 2001
    copyright            : (C) 2001 The phpBB Group
    email                : support@phpbb.com

    Id: emailer.php,v 1.15.2.34 2003/07/26 11:41:35 acydburn Exp

***************************************************************************/

/***************************************************************************
* phpbb2 forums port version 2.0.5 (c) 2003 - Nuke Cops (http://nukecops.com)
*
* Ported by Nuke Cops to phpbb2 standalone 2.0.5 Test
* and debugging completed by the Elite Nukers and site members.
*
* You run this package at your sole risk. Nuke Cops and affiliates cannot
* be held liable if anything goes wrong. You are advised to test this
* package on a development system. Backup everything before implementing
* in a production environment. If something goes wrong, you can always
* backout and restore your backups.
*
* Installing and running this also means you agree to the terms of the AUP
* found at Nuke Cops.
*
* This is version 2.0.5 of the phpbb2 forum port for PHP-Nuke. Work is based
* on Tom Nitzschner's forum port version 2.0.6. Tom's 2.0.6 port was based
* on the phpbb2 standalone version 2.0.3. Our version 2.0.5 from Nuke Cops is
* now reflecting phpbb2 standalone 2.0.5 that fixes some bugs and the
* invalid_session error message.
***************************************************************************/

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

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*****[CHANGES]**********************************************************
-=[Mod]=-
      Custom mass PM                           v1.4.7       07/04/2005
 ************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

//
// The emailer class has support for attaching files, that isn't implemented
// in the 2.0 release but we can probable find some way of using it in a future
// release
//
class emailer
{
        public $msg, $subject, $extra_headers;
        public $addresses, $reply_to, $from;
		public $use_smtp;

        public $tpl_msg = [];

        function __construct($use_smtp)
        {
           $this->reset();
           $this->reply_to = $this->from = '';
        }

    // Resets all the data (address, template file, etc etc to default
    function reset()
    {
        $this->addresses = [];
        $this->vars = $this->msg = $this->extra_headers = '';
    }

    // Sets an email address to send to
    function email_address($address)
    {
        $this->addresses['to'] = trim((string) $address);
    }

    function cc($address)
    {
        $this->addresses['cc'][] = trim((string) $address);
    }

    function bcc($address)
    {
        $this->addresses['bcc'][] = trim((string) $address);
    }

    function replyto($address)
    {
        $this->reply_to = trim((string) $address);
        }

        function from($address)
        {
                $this->from = trim((string) $address);
        }

        // set up subject for mail
        function set_subject($subject = '')
        {
                $this->subject = trim(preg_replace('#[\n\r]+#s', '', (string) $subject));
        }

        // set up extra mail headers
        function extra_headers($headers)
        {
                $this->extra_headers .= trim((string) $headers) . "\n";
        }

        function use_template($template_file, $template_lang = '')
        {
                global $board_config, $phpbb_root_path;

                if (trim((string) $template_file) == '')
                {
                        message_die(GENERAL_ERROR, 'No template file set', '', __LINE__, __FILE__);
                }

                if (trim((string) $template_lang) == '')
                {
                        $template_lang = $board_config['default_lang'];
                }

                if (empty($this->tpl_msg[$template_lang . $template_file]))
                {
                        $tpl_file = $phpbb_root_path . 'language/lang_' . $template_lang . '/email/' . $template_file . '.tpl';

                        if (!file_exists(phpbb_realpath($tpl_file)))
                        {
                                $tpl_file = $phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/email/' . $template_file . '.tpl';

                                if (!file_exists(phpbb_realpath($tpl_file)))
                                {
                                        message_die(GENERAL_ERROR, 'Could not find email template file :: ' . $template_file, '', __LINE__, __FILE__);
                                }
                        }

                        if (!($fd = fopen($tpl_file, 'r')))
                        {
                                message_die(GENERAL_ERROR, 'Failed opening template file :: ' . $tpl_file, '', __LINE__, __FILE__);
                        }

                        $this->tpl_msg[$template_lang . $template_file] = fread($fd, filesize($tpl_file));
                        fclose($fd);
                }

                $this->msg = $this->tpl_msg[$template_lang . $template_file];

                return true;
        }

        // assign variables
        function assign_vars($vars)
        {
                $this->vars = (empty($this->vars)) ? $vars : $this->vars . $vars;
        }

        // Send the mail out to the recipients set previously in var $this->address
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        function send($error_level=0)
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        {
                global $board_config, $lang, $phpEx, $phpbb_root_path, $db, $cache;

            // Escape all quotes, else the eval will fail.
                $this->msg = str_replace ("'", "\'", (string) $this->msg);
                $this->msg = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->msg);

                // Set vars
                reset ($this->vars);
                //while (list($key, $val) = each($this->vars))
				foreach ($this->vars as $key => $val)
                {
                        ${$key} = $val;
                }

                eval("\$this->msg = '$this->msg';");

                // Clear vars
                reset ($this->vars);
                //while (list($key, $val) = each($this->vars))
				foreach ($this->vars as $key => $val)
                {
                        unset(${$key});
                }

                // We now try and pull a subject from the email body ... if it exists,
                // do this here because the subject may contain a variable
                $drop_header = '';
                $match = [];
                if (preg_match('#^(Subject:(.*?))$#m', $this->msg, $match))
                {
                        $this->subject = (trim($match[2]) != '') ? trim($match[2]) : (($this->subject != '') ? $this->subject : 'No Subject');
                        $drop_header .= '[\r\n]*?' . preg_quote($match[1], '#');
                }
                else
                {
                        $this->subject = (($this->subject != '') ? $this->subject : 'No Subject');
                }

                if (preg_match('#^(Charset:(.*?))$#m', $this->msg, $match))
                {
                        $this->encoding = (trim($match[2]) != '') ? trim($match[2]) : trim((string) $lang['ENCODING']);
                        $drop_header .= '[\r\n]*?' . preg_quote($match[1], '#');
                }
                else
                {
                        $this->encoding = trim((string) $lang['ENCODING']);
                }

                if ($drop_header != '')
                {
                        $this->msg = trim(preg_replace('#' . $drop_header . '#s', '', $this->msg));
                }

        $to = $this->addresses['to'];

        if(!isset($this->addresses['cc']))
		$this->addresses['cc'] = '';

        if(!isset($cc))
		$cc = '';

        if(!isset($this->addresses['bcc']))
		$this->addresses['bcc'] = '';

        if(!isset($bcc))
		$bcc = '';
		
		if ( is_array( $this->addresses['cc'] ) ) 
            $cc = (count($this->addresses['cc'])) ? implode(', ', $this->addresses['cc']) : '';
        else
            $cc = '';

        if ( is_array( $this->addresses['cc'] ) )
            $bcc = (count($this->addresses['bcc'])) ? implode(', ', $this->addresses['bcc']) : '';
        else
            $bcc = '';

        // Build header
        $this->extra_headers = (($this->reply_to != '') ? "Reply-to: $this->reply_to\n" : '') . (($this->from != '') ? "From: $this->from\n" : "From: " . $board_config['board_email'] . "\n") . "Return-Path: " . $board_config['board_email'] . "\nMessage-ID: <" . md5(uniqid(time())) . "@" . $board_config['server_name'] . ">\nMIME-Version: 1.0\nContent-type: text/plain; charset=" . $this->encoding . "\nContent-transfer-encoding: 8bit\nDate: " . date('r', time()) . "\nX-Priority: 3\nX-MSMail-Priority: Normal\nX-Mailer: PHP\nX-MimeOLE: Produced By phpBB2\n" . $this->extra_headers . (($cc != '') ? "Cc: $cc\n" : '')  . (($bcc != '') ? "Bcc: $bcc\n" : '');

                // Send message ... removed $this->encode() from subject for time being
                if ( $this->use_smtp )
                {
                        if ( !defined('SMTP_INCLUDED') )
                        {
                                include(__DIR__."/smtp.php");
                        }

                        $result = smtpmail($to, $this->subject, $this->msg, $this->extra_headers);
                }
                else
                {
            $empty_to_header = ($to == '') ? TRUE : FALSE;
            $to = ($to == '') ? (($board_config['sendmail_fix']) ? ' ' : 'Undisclosed-recipients:;') : $to;
                        $result = mail((string) $to, (string) $this->subject, preg_replace("#(?<!\r)\n#s", "\n", $this->msg), $this->extra_headers);

                        if (!$result && !$board_config['sendmail_fix'] && $empty_to_header)
                        {
                                $to = ' ';

                                $sql = "UPDATE " . CONFIG_TABLE . "
                                        SET config_value = '1'
                                        WHERE config_name = 'sendmail_fix'";
                                if (!$db->sql_query($sql))
                                {
                                        message_die(GENERAL_ERROR, 'Unable to update config table', '', __LINE__, __FILE__, $sql);
                                }
/*****['BEGIN']******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                                $cache->delete('board_config', 'config');
/*****['END']********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                                $board_config['sendmail_fix'] = 1;
                                $result = mail($to, (string) $this->subject, preg_replace("#(?<!\r)\n#s", "\n", $this->msg), $this->extra_headers);
                        }
                }

                // Did it work?
/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                if (!$result && !$error_level)
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                {
                        message_die(GENERAL_ERROR, 'Failed sending email :: ' . (($this->use_smtp) ? 'SMTP' : 'PHP') . ' :: ' . $result, '', __LINE__, __FILE__);
                }

/*****[BEGIN]******************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
                return $result;
/*****[END]********************************************
 [ Mod:     Custom mass PM                     v1.4.7 ]
 ******************************************************/
        }

        // Encodes the given string for proper display for this encoding ... nabbed
        // from php.net and modified. There is an alternative encoding method which
        // may produce lesd output but it's questionable as to its worth in this
        // scenario IMO
        function encode($str)
        {
                if ($this->encoding == '')
                {
                        return $str;
                }

                // define start delimimter, end delimiter and spacer
                $end = "?=";
                $start = "=?$this->encoding?B?";
                $spacer = "$end\r\n $start";

                // determine length of encoded text within chunks and ensure length is even
                $length = 75 - strlen($start) - strlen($end);
                $length = floor($length / 2) * 2;

                // encode the string and split it into chunks with spacers after each chunk
                $str = chunk_split(base64_encode((string) $str), $length, $spacer);

                // remove trailing spacer and add start and end delimiters
                $str = preg_replace('#' . preg_quote($spacer, '#') . '$#', '', $str);

                return $start . $str . $end;
        }

        //
        // Attach files via MIME.
        //
        function attachFile($filename, $szFilenameToDisplay, $mimetype = "application/octet-stream", $szFromAddress = '')
        {
                $mime_filename = null;
                $out = null;
                global $lang;
                $mime_boundary = "--==================_846811060==_";

                $this->msg = '--' . $mime_boundary . "\nContent-Type: text/plain;\n\tcharset=\"" . $lang['ENCODING'] . "\"\n\n" . $this->msg;

                if ($mime_filename)
                {
                        $filename = $mime_filename;
                        $encoded = $this->encode_file($filename);
                }

                $fd = fopen($filename, "r");
                $contents = fread($fd, filesize($filename));

                $this->mimeOut = "--" . $mime_boundary . "\n";
                $this->mimeOut .= "Content-Type: " . $mimetype . ";\n\tname=\"$szFilenameToDisplay\"\n";
                $this->mimeOut .= "Content-Transfer-Encoding: quoted-printable\n";
                $this->mimeOut .= "Content-Disposition: attachment;\n\tfilename=\"$szFilenameToDisplay\"\n\n";

                if ( $mimetype == "message/rfc822" )
                {
                        $this->mimeOut .= "From: ".$szFromAddress."\n";
                        $this->mimeOut .= "To: ".$this->emailAddress."\n";
                        $this->mimeOut .= "Date: ".date("D, d M Y H:i:s") . " UT\n";
                        $this->mimeOut .= "Reply-To:".$szFromAddress."\n";
                        $this->mimeOut .= "Subject: ".$this->mailSubject."\n";
                        $this->mimeOut .= "X-Mailer: PHP/".phpversion()."\n";
                        $this->mimeOut .= "MIME-Version: 1.0\n";
                }

                $this->mimeOut .= $contents."\n";
                $this->mimeOut .= "--" . $mime_boundary . "--" . "\n";

                return $out;
                // added -- to notify email client attachment is done
        }

        function getMimeHeaders($filename, $mime_filename="")
        {
                $mime_boundary = "--==================_846811060==_";

                if ($mime_filename)
                {
                        $filename = $mime_filename;
                }

                $out = "MIME-Version: 1.0\n";
                $out .= "Content-Type: multipart/mixed;\n\tboundary=\"$mime_boundary\"\n\n";
                $out .= "This message is in MIME format. Since your mail reader does not understand\n";
                $out .= "this format, some or all of this message may not be legible.";

                return $out;
        }

        //
        // Split string by RFC 2045 semantics (76 chars per line, end with \r\n).
        //
        function myChunkSplit($str)
        {
                $stmp = $str;
                $len = strlen((string) $stmp);
                $out = "";

                while ($len > 0)
                {
                        if ($len >= 76)
                        {
                                $out .= substr((string) $stmp, 0, 76) . "\r\n";
                                $stmp = substr((string) $stmp, 76);
                                $len = $len - 76;
                        }
                        else
                        {
                                $out .= $stmp . "\r\n";
                                $stmp = "";
                                $len = 0;
                        }
                }
                return $out;
        }

        //
        // Split the specified file up into a string and return it
        //
        function encode_file($sourcefile)
        {
                $encoded = null;
                if (is_readable(phpbb_realpath($sourcefile)))
                {
                        $fd = fopen($sourcefile, "r");
                        $contents = fread($fd, filesize($sourcefile));
              $encoded = $this->myChunkSplit(base64_encode($contents));
              fclose($fd);
                }

                return $encoded;
        }

} // class emailer

?>
