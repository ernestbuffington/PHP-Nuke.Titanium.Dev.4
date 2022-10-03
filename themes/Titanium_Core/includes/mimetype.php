<?php
#---------------------------------------------------------------------------------------#
# THEME SYSTEM FILE                                                                     #
#---------------------------------------------------------------------------------------#
# THEME INFO                                                                            #
# Titanium_Core Theme v2.0 (Fixed & Full Width)                                         #
#                                                                                       #
# Final Build Date 03/16/2021 Tuesday 12:54am                                           #
#                                                                                       #
# A Very Nice Gold Theme Design.                                                        #
# Copyright © 2021 By: TheGhost AKA EA Buffington                                       #
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
# Purpose: PHP-Nuke Titanium                                                            #
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
global $doctype;
$output  .= '<?xml version="1.0" encoding="' . $mime . '"?>'."\n";
$charset = defined('_CHARSET') ? _CHARSET : 'UTF-8';
$mime = defined('_MIME') ? _MIME : 'text/html';
$is304 = false;

if(empty($doctype)) 
$doctype = 'transitional';


switch ($doctype) 
{
    case 'strict':
        $output .=  '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
        define('DOCTYPE', 'strict');
        break;
    case 'transitional':
         $output  .= '<!DOCTYPE html'."\n";
         $output  .= 'PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'."\n";
         $output  .= '"DTD/xhtml1-transitional.dtd">'."\n";
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

$output  .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'._LANGCODE.'" />'."\n";
$output  .= '<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="https://www.facebook.com/2008/fbml" />'."\n"; 

$output .= "<!-- START <head> -->\n";
$output .= "<head>\n";

$output .= '<!--[if IE]>';
$output .= "\n".'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'."\n";
$output .= '<![endif]-->';
$output .= "\n".'<meta http-equiv="Content-Type" content="'.$mime.'; charset='.$charset.'"/>'."\n";
$output .= '<meta http-equiv="Content-Language" content="'._LANGCODE.'" />'."\n";
$output .= '<meta http-equiv="Content-Style-Type" content="text/css" />'."\n";
$output .= '<meta http-equiv="Content-Script-Type" content="text/javascript" />'."\n";


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
