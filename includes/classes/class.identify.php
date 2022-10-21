<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*    MOO CMS, Copyright (c) 2005 The MOO Dev. Group. All rights reserved.

    This source file is free software; you can redistribute it and/or
    modify it under the terms of the MOO Public License as published
    by the MOO Development Group; either version 1 of the License, or
    (at your option) any later version.

    CVS: 1.26
    http://cvs.moocms.com/moo/moo_core/handlers/security.php
*/

/************************************************************************
   Nuke-Evolution: Evolution Functions
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : class.identify.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.0
   Date          : 01.26.2005 (mm.dd.yyyy)

   Notes         : IDs the users info
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

class identify {
    private $agent = 'none';

    function __construct() {
        if (isset($_SERVER['HTTP_USER_AGENT']) && !empty($_SERVER['HTTP_USER_AGENT'])) {
            $this->agent = $_SERVER['HTTP_USER_AGENT'];
        }
    }
    # [21-Oct-2022 02:06:07 UTC] PHP Deprecated:  Non-static method identify::get_ip() should not be called statically
	# so I changed it to public static - TheGhost 10/20/2022 10:19 pm
    public static function get_ip() {
        static $visitor_ip;
        if (!empty($visitor_ip)) { return $visitor_ip; }
        $visitor_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : $_ENV['REMOTE_ADDR'];
        $ips = array();
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != 'unknown') {
            $ips = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != 'unknown') {
            $ips[] = $_SERVER['HTTP_CLIENT_IP'];
        }
        for ($i = 0; $i < count($ips); $i++) {
            $ips[$i] = trim($ips[$i]);
            # IPv4
            if (strstr($ips[$i], '.')) {
                # check for a hybrid IPv4-compatible address
                $pos = strrpos($ips[$i], ':');
                if ($pos !== FALSE) { $ips[$i] = substr($ips[$i], $pos+1); }
                # Don't assign local network ip's
                if (preg_match('#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$#', $ips[$i]) &&
                    !preg_match('#^(10|127.0.0|172.(1[6-9]|2[0-9]|3[0-1])|192\.168)\.#', $ips[$i]))
                {
                    $visitor_ip = $ips[$i];
                    break;
                }
            }
            # IPv6
            else if (strpos($ips[$i], ':') !== FALSE) {
                # fix shortened ip's
                $c = substr_count($ips[$i], ':');
                if ($c < 7) { $ips[$i] = str_replace('::', str_pad('::', 9-$c, ':'), $ips[$i]); }
                if (preg_match('#^([0-9A-F]{0,4}:){7}[0-9A-F]{0,4}$#i', $ips[$i])) {
                    $visitor_ip = $ips[$i];
                    break;
                }
            }
        }

        return $visitor_ip;
    }

    function identify_agent($find_bot = true) {
        global $identify;
        static $data;

        if (!isset($data)) {
            $data = array();
        } else if (is_array($data)) {
            return $data;
        }

        $pattern = array(
            # Netscape
            '#^Mozilla/[34].[0-8]{1,2}( \[[a-zA-Z\-]{2,5}\])? \(([a-zA-Z0-9]+); [UI]#',
            # Gecko family: Netscape, Firefox, Thunderbird, Camino, Galeon, Epiphany, Linspire, MultiZilla, K-Meleon, WebWasher, Mozilla
            '#^Mozilla/5.0 \(([a-zA-Z0-9]+); U; (.*[^;])(; [a-zA-Z\-]{2,5})?; rv:[0-9\.]+.*?\) Gecko/[0-9]{8} .* (Firefox).*#',
            '#^Mozilla/5.0 \(([a-zA-Z0-9]+); U; (.*[^;])(; [a-zA-Z\-]{2,5})?; rv:[0-9\.]+.*?\) Gecko/[0-9]{8}( \(No IDN\))? ([a-zA-Z6\-]+)/[0-9\.]+.*#',
            '#^Mozilla/5.0 \(([a-zA-Z0-9]+); U; (.*[^;])(; [a-zA-Z\-]{2,5})?; rv:[0-9\.]+.*?\) Gecko/[0-9]{8}( \(No IDN\))?$#',
            # Galeon
            '#^Mozilla/5.0 (Galeon)/[0-9\.]+ \(([a-zA-Z0-9]+); (.*[^;]); U\)#',
            # Konqueror
            '#^Mozilla/5.0 \(compatible; (Konqueror)/[0-9\.\-rc]+; (i686 )?(Linux|FreeBSD).*#',
            # Lynx
            '#^(Lynx)/2.[0-9\.]+(rel|dev)[0-9\.]+ libwww-FM/.*#',
            # Safari family: Safari, OmniWeb, Shiira, DEVONtech
            '#^Mozilla/5\.0 \(Macintosh; U; (PPC|Intel) Mac OS X; [a-zA-Z\-]{2,5}\) AppleWebKit/.*? \(KHTML, like Gecko.*?\) ([a-zA-Z]+)/.*#',
            '#^Mozilla/5\.0 \(Macintosh; (PPC|Intel) Mac OS X [\d_-]{2,10}\) AppleWebKit/.*? \(KHTML, like Gecko.*?\) ([a-zA-Z]+)/.*#',
            '#^Mozilla/5\.0 \(Windows; U; (.*[^;]); [a-zA-Z\-]{2,5}\) AppleWebKit/.*? \(KHTML, like Gecko\) .*#',
            # w3m
            '#^(w3m)/[0-9\.]+#',
            # Links
            '#^(Links) \([0-9].[a-z0-9]+; ([a-zA-Z]+) #',
            # ELinks
            '#^(ELinks)/0.[0-9]+ \([a-z]+; ([a-zA-Z]+) #',
            # Voyager
            '#^Mozilla/4.0 \(compatible; (Voyager); (AmigaOS).*#',
            # Opera
            '#^(Opera)/[67].[0-9]{1,2} \((.*?); U\)[\ ]{1,2}\[[a-zA-Z\-]{2,5}\]#', # Opera 6-7
            '#^Mozilla/[45].0 \(compatible; MSIE [56].0; (.*?)\) (Opera) [567].[0-9]{1,2} \[[a-zA-Z\-]{2,5}\]#', # Opera 6-7 faking IE
            '#^Mozilla/5.0 \((.*?); U\) (Opera) [67].[0-9]{1,2} \[[a-zA-Z\-]{2,5}\]#', # Opera 6-7 faking Gecko
            '#^(Opera)/[89].[0-9]{1,2} \((.*?); U; [a-zA-Z\-]{2,5}\)#', # Opera 8-9
            '#^Mozilla/4.0 \(compatible; MSIE 6.0; (.*?); [a-zA-Z\-]{2,5}\) (Opera) [89].[0-9]{1,2}#', # Opera 8-9 faking IE
            '#^Mozilla/5.0 \((.*?); U; [a-zA-Z\-]{2,5}\) (Opera) [89].[0-9]{1,2}#', # Opera 8-9 faking Gecko
            # IE
            '#^Mozilla/4.0 \([a-z]+; MSIE (4.0|5.0|5.5|6.0|7.0)[b1]?(; .*[^;])?; (Windows) [A-Z0-9\ \.]+[;)](.*)?#',
            '#^Mozilla/2.0 \(compatible; MSIE (3.0|4.0)[1]?(; .*[^;])?; (Windows) [A-Z0-9\ \.]+[;)](.*)?#',
            '#^Mozilla/4.0 \(compatible; MSIE 5.[1-2][1-7]; Mac_PowerPC\)#', # 5.: 13, 16, 17, 21, 22, 23
            # Dillo/0.8.5-i18n-misc
            '#^Dillo/[0-9\.]+.*#',
            # mobile phones
            '#^KWC-[a-zA-Z0-9]+/[0-9\.]+ UP.Browser/[0-9\.]+#',
            '#^LG-[A-Z0-9]+ (.*?)Profile/MIDP-[12]#',
            '#^Nokia[0-9i]+/[0-9\.]+ \([0-9\.]+\) (.*?)Profile/MIDP-[12]#',
            '#^SAMSUNG-[A-Z0-9\-]+/[A-Z0-9]+ UP.Browser/[0-9\.]+#',
            '#^SonyEricsson[a-zA-Z0-9]+/[A-Z0-9]+ (.*?)Profile/MIDP-[12]#',
            '#^BlackBerry[a-zA-Z0-9]+/[A-Z0-9\.]+ (.*?)Profile/MIDP-[A-Z0-9\.]+ Configuration/CLDC-[A-Z0-9\.]+#',
            # PlayStation
            '#^Mozilla/4.0 \(PSP \(PlayStation Portable\); 2.00\)#'
        );
        
        $replacement = array(
            # Netscape
            array('Netscape', '$1', 'Gecko', ''),
            # Gecko family
            array('$4', '$2', 'Gecko', ''),
            array('$5', '$2', 'Gecko', ''),
            array('Mozilla', '$2', 'Gecko', ''),
            # Galeon
            array('$1', '$3', '', ''),
            # Konqueror
            array('$1', '$3', 'KHTML', ''),
            # Lynx
            array('$1', '', '', ''),
            # Safari family
            array('$2', 'Mac', 'Safari', ''),
            array('$2', 'Mac', 'Safari', ''),
            array('Safari', 'Win', 'Safari', ''),
            # w3m
            array('$1', '', '', ''),
            # Links
            array('$1', '$2', '', ''),
            # ELinks
            array('$1', '$2', '', ''),
            # Voyager
            array('$1', '$2', '', ''),
            # Opera
            array('$1', '$2', '', ''),
            array('$1', '$2', '', ''),
            array('$2', '$1', '', ''),
            array('$1', '$2', '', ''),
            array('$2', '$1', '', ''),
            array('$2', '$1', '', ''),
            # IE
            array('MSIE', '$3', '', '$4', '$1'),
            array('MSIE', '$3', '', '$4', '$1'),
            array('MSIE', 'Mac', '', '$4', '$1'),
            # Dillo
            array('Dillo', 'Linux', '', ''),
            # mobile phones
            array('WAP', '', '', 'KWC'),
            array('WAP', '', '', 'LG'),
            array('WAP', '', '', 'Nokia'),
            array('WAP', '', '', 'SAMSUNG'),
            array('WAP', '', '', 'SonyEricsson'),
            array('WAP', '', '', 'BlackBerry'),
            # PlayStation
            array('PlayStation', '', '', 'Sony')
        );
        
        // Go through all the patterns and set the UA data for whichever matches
        foreach ($pattern as $k => $p) {
            if (preg_match($p, $this->agent, $matches)) {
                $r = $replacement[$k];

                // Go through all the replacement values and find the corresponding data to go with it
                foreach ($r as $j => $v) {
                    if (preg_match('/^\$(\d)$/', $v, $num)) {
                        $r[$j] = $matches[(int) $num[0]];
                    }
                }

                $this->set_data($r[0], $r[1], $r[2], $r[3], $data, isset($r[4]) ? $r[4] : '');
                break;
            }
        }

        unset($pattern, $replacement);

        if (!isset($data['ua'])) {
            if ($find_bot) {
                return $data = $identify->detect_bot();
            } else {
                return $data;
            }
        } else if ($data['ua'] === 'MSIE') {
            preg_match_all('#(iRider|Crazy Browser|NetCaptor|Maxthon|Avant Browser)#s', $data['ext'], $regs);

            if (!empty($regs[0])) {
                $data['ua'] = str_replace(' Browser', '', $regs[0][count($regs[0]) - 1]);
                $data['ext'] = '';
            }
        }

        preg_match('#(Win|Mac|Linux|FreeBSD|SunOS|IRIX|BeOS|OS/2|AIX|Amiga)#is', $data['os'], $regs);
        $data['os'] = $regs[0];
        
        if ($data['os'] === 'Win') {
            $data['os'] = 'Windows';
        }

        return $data;
    }

    function set_data($ua, $os, $engine, $extra, &$data, $version = '') {
        if (empty($ua)) {
            return false;
        }

        $data = array(
            'ua'        => $ua,
            'os'        => $os,
            'engine'    => empty($engine) ? $ua : $engine,
            'ext'       => $extra,
            'version'   => $version
        );
    }

    function detect_bot($where = false) {
        global $db, $prefix;

        $bot        = false;
        $where      = ($where ? "WHERE agent_name LIKE '$where%'" : '');
        $result     = $db->sql_query('SELECT agent_name, agent_fullname FROM '.$prefix.'_security_agents'.$where.' ORDER BY agent_name', true);
        $find       = array('\\', '(', ')', '{', '}', '.', '$', '*');
        $replace    = array('\\\\', '\(', '\)', '\{', '\}', '\.', '\$', '\*');

        while ($row = $db->sql_fetchrow($result)) 
        {
            $row[1] = str_replace($find, $replace, $row[1]);

            if (!empty($row[1]) && $row[1] !== 'NULL') 
            {
                if (stristr($this->agent, $row[1])) 
                {
                    $bot = $row[0];
                } 
                elseif ($bot && empty($where)) 
                {
                    break;
                }
            }
        }
        
        $db->sql_freeresult($result);
        return ($bot === false) ? false : array('ua' => 'bot', 'bot' => $bot, 'engine' => 'bot');
    }
}