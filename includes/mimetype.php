<?php
/*=======================================================================
            PHP-Nuke Titanium (CMS) Enhanced And Advanced
 ========================================================================

 /*****[CHANGES]**********************************************************
  The Nuke-Evo Base Engine : v2.1.0 RC3 dated May 4th, 2009 is what we
  used to build our new content management system. 
   
  This file was re-written for PHP-Nuke Titanium and all modifications
  were done by Ernest Allen Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is written for Social Networking and uses a centralized 
  database that is chained to The Scorpion Network & The 86it Social Network

  It is not intended for single user platforms and has the requirement of
  remote database access to https://the.scorpion.network and 
  https://www.86it.us which is a new Social Networking System designed by 
  Ernest Buffington that requires a FEDERATED MySQL engine in order to 
  function at all.
  
  The federated database concept was created in the 1980's and has been
  available a very long time. In fact it was a part of MySQL before they
  ever started to document it. There is not much information available
  about using a FEDERATED engine and a lot of the documention is not very
  complete with regard to every detail; it is superficial and partial to
  say thge least. 
  
  The core engine from Nuke Evolution was used to create 
  PHP-Nuke Titanium. Almost all versions of PHP-Nuke were unstable and not 
  very secure. We have made it so that it is enhanced and advanced!
  
  PHP-Nuke Titanium is now a secure custom FORK of the ORIGINAL PHP-Nuke
  that was purchased by Ernest Buffington of Sebastian Enterprises.
  
  PHP-Nuke Titanium is not backward compatible to any of the prior versions of
  PHP-Nuke, Nuke-Evoltion or Nuke-Evo.
  
  The module framework of PHP-Nuke is the only thing that still functions 
  in the same way that Francis Burzi had intended and even that had to be
  safer and more secure to be a reliable form of internet communications.
  
 ************************************************************************
 * PHP-NUKE: Advanced Content Management System                         *
 * ============================================                         *
 * Copyright (c) 2002 by Francisco Burzi                                *
 * http://phpnuke.org                                                   *
 *                                                                      *
 * This program is free software. You can redistribute it and/or modify *
 * it under the terms of the GNU General Public License as published by *
 * the Free Software Foundation; either version 2 of the License.       *
 ************************************************************************/
global $doctype;

$charset = defined('_CHARSET') ? _CHARSET : 'UTF-8';
$mime = defined('_MIME') ? _MIME : 'text/html';
$is304 = false;

if (empty($doctype)) 
{
    $doctype = 'transitional';
}

switch ($doctype) 
{
    case 'strict':
        $output .=  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
        define('DOCTYPE', 'strict');
        break;
    case 'transitional':
        $output .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        define('DOCTYPE', 'transitional');
        break;
    case 'frameset':
        $output .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';
        define('DOCTYPE', 'frameset');
        break;
    case 'math':
        $output .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0//EN" "http://www.w3.org/TR/MathML2/dtd/xhtml-math11-f.dtd">';
        define('DOCTYPE', 'math');
        break;
    case 'xhtml11':
        $output .=  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
        define('DOCTYPE', 'xhtml11');
        break;
    case 'default':
        $output .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        define('DOCTYPE', 'transitional');
        break;
}

$output  = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
$output .= "\n".'<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'">'."\n";
$output .= "".'<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml">'."\n"; 

$output .= "\n\n<!-- START <head> -->\n\n";
$output .= "<head>\n";

$output .= '<!--[if IE]>';
$output .= "\n<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />\n";
$output .= '<![endif]-->';
$output .= "\n<meta http-equiv='Content-Type' content='".$mime."; charset=".$charset.";' />\n";
$output .= "<meta http-equiv='Content-Language' content='"._LANGCODE."' />\n";
$output .= "<meta http-equiv='Content-Style-Type' content='text/css' />\n";
$output .= "<meta http-equiv='Content-Script-Type' content='text/javascript' />\n";


/*# NOTE: To allow for q-values with one space (text/html; q=0.5),
# use the following regex:
# "/text\/html;[\ ]{0,1}q=([0-1]{0,1}\.\d{0,4})/i"*/
if((isset($_SERVER['HTTP_ACCEPT'])) && (stristr($_SERVER['HTTP_ACCEPT'],'application/xhtml+xml')))  {
    if(preg_match('/application\/xhtml\+xml;q=([0-1]{0,1}\.\d{0,4})/i',$_SERVER['HTTP_ACCEPT'],$matches)) {
        $xhtml_q = $matches[1];
        if(preg_match('/text\/html;q=([0-1]{0,1}\.\d{0,4})/i',$_SERVER['HTTP_ACCEPT'],$matches)) {
            $html_q = $matches[1];
            if((float)$xhtml_q >= (float)$html_q) {
                $mime = $mime;
            }
        }
    }
} else {
    $mime = 'text/html';
}

//# Get the file stats and compute last-modified time.
$filestats = @stat($_SERVER["SCRIPT_FILENAME"]);
$lastmod = $filestats[9] - date('Z');  #Convert Local time -> GMT

//# ETag is "inode-lastmodtime-filesize" - See PHP stat function for more detail
$etag = '"' . dechex($filestats[1]) . "-" . dechex($lastmod) . "-" . dechex($filestats[7]) . '"';

//# Check HTTP_IF_NONE_MATCH
//# and report a 304 Not Modified header if they match.
if (isset ($_SERVER['HTTP_IF_NONE_MATCH'])) {
    if ($etag === stripslashes($_SERVER['HTTP_IF_NONE_MATCH']))
        $is304 = true;
}

if ($is304) {
    if (isset($_SERVER['SERVER_PROTOCOL']) && $_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
        header('HTTP/1.1 304 Not Modified');
    } else {
        header('HTTP/1.0 304 Not Modified');
    }
    header('ETag: ' . $etag);
    header('Vary: Accept');
    header('Connection: close');
    exit;
}

header('Content-Type: ' . $mime . ';charset=' . $charset);
//header("Cache-Control: max-age=86400, s-maxage=86400");
header('Vary: Accept');
/*# If for some reason we didn't get a valid file modification time
# from the stat function, or it errored out, DO NOT send the ETag
# header as it will not be valid. Valid in this since is defined
# as modified AFTER Dec 24, 1999.
//if ($lastmod > 946080000) {        # 946080000 = Dec 24, 1999 4PM
//    header("ETag: " . $etag);
//}
*/
echo $output;
?>
