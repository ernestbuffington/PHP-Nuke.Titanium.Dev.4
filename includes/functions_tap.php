<?php

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Evolution Functions
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : functions_tap.php
   Author        : Technocrat (www.php-nuke-titanium.86it.us)
   Version       : 1.0.0
   Date          : 01.26.2005 (mm.dd.yyyy)

   Notes         : Evo's Google tap functions
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

define('TAP_PREFIX', 'Titanium-');

define('TAP_SCOPE','[a-z0-9_-]');

/*==========================================================================
  $lazy_tap = 0;  = Tap Off
  $lazy_tap = 1;  = Bots ONLY see the tap
  $lazy_tap = 2;  = Everyone sees the tap
  $lazy_tap = 3;  = Admin's only see the tap && bots
  ==========================================================================*/
global $identify;
if (isset($lazy_tap) && !defined('ADMIN_FILE') && !defined('FORUM_ADMIN') && !defined('IN_ADMIN') && !defined('CNBYA')) {
    
    function tap($buffer) { 
        $buffer = str_replace('&&', '&',$buffer);
        $find = array('/("|\')index.php("|\')/','/("|\')modules.php\?name=('.TAP_SCOPE.'+)("|\')/i');
        
        $base = '/("|\')modules.php\?name=('.TAP_SCOPE.'+)';
        $add = '(&|&amp;|&&|&amp;&amp;)('.TAP_SCOPE.'+)=('.TAP_SCOPE.'+)';
        $close = '("|\')/i';
        $close2 = '\#('.TAP_SCOPE.'+)("|\')/i';
        for ($i = 1; $i < 5; $i++) {
            $combined = $base;
            for ($j = 0; $j < $i; $j++) {
                $combined .= $add;
            }
            $find[] = $combined . $close;
            $find[] = $combined . $close2;
        }
        
        $replace = array('$1'.TAP_PREFIX.'index.html$2','$1'.TAP_PREFIX.'$2.html$3');
        $base = '$1'.TAP_PREFIX.'$2';
        $close = '.html';
        $close2 = '.html#';
        for ($i = 2; $i < 6; $i++) {
            $combined = $base;
            for ($j = 4; $j < ($i * 3); $j = $j + 3) {
                $combined .= '_-_$'.$j.'_-_$'.($j+1);
                $last = $j + 2;
            }
            $replace[] = $combined . $close . '$' . $last;
            $replace[] = $combined . $close2 . '$' . $last . '$' . ($last+1);
        }
    
        //$buffer = preg_replace('/"modules.php\?name=([a-z0-9]+)&amp;([a-z0-9]+)=([a-z0-9]+)&amp;([a-z0-9]+)=([a-z0-9]+)"/i','="modules_name_$1_$2_$3_$4_$5.html"',$buffer);
        $buffer = preg_replace($find,$replace,$buffer);
        return $buffer;
    }

    $user_agent = $identify->identify_agent();
    
    $tap_fire = 0;
    if(($lazy_tap == 1 || $lazy_tap == 3) && !defined('ADMIN_FILE')) {
        if($user_agent['engine'] == 'bot') {
            $tap_fire = 1;
        } else if(is_admin() && $lazy_tap == 3) {
            $tap_fire = 1;
        }
    } else if ($lazy_tap == 2) {
        $tap_fire = 1;
    }
    
    if($tap_fire && !defined('ADMIN_FILE')) {
        ob_start("tap");
    }
}
