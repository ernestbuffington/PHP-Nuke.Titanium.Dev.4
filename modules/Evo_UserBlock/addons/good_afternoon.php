<?php
/*=======================================================================
 PHP-Nuke Titanium : Nuke-Evolution | Enhanced and Advnanced
 =======================================================================*/

/************************************************************************
   Nuke-Evolution    : Server Info Administration
   PHP-Nuke Titanium : Server Info Administration
   =====================================================================
   Copyright (c) 2005 by The Nuke-Evolution Team
   Copyright (c) 2022 by The PHP-Nuke Titanium Group

   Filename      : good_afternoon.php
   Author(s)     : Ernest Allen Buffington, Technocrat
   Version       : 4.0.3
   Date          : 05.19.2005 (mm.dd.yyyy)
   Last Update   : 12.12.2022 (mm.dd.yyyy)

   Notes         : Evo User Block Good Afternoon Module
************************************************************************/

if(!defined('NUKE_EVO')):
  die ("Illegal File Access");
endif;

global $evouserinfo_addons, $evouserinfo_good_afternoon, $lang_evo_userblock;

function evouserinfo_create_date($format, $gmepoch, $tz)
{
    global $board_config, $lang, $userdata, $pc_dateTime;
    
	static $translate;
    
    if (!defined('ANONYMOUS')):
        define('ANONYMOUS',1);
        define('MANUAL',0);
        define('MANUAL_DST',1);
        define('SERVER_SWITCH',2);
        define('FULL_SERVER',3);
        define('SERVER_PC',4);
        define('FULL_PC',6);
    endif;

    if(empty($translate) && $board_config['default_lang'] != 'english' && is_array($lang['datetime'])):
        reset($lang['datetime']);
	    foreach($lang['datetime'] as $match => $replace): 
          $translate[$match] = $replace;
        endforeach;
		unset($replace); // break the reference with the last element
    endif;

    if(isset($userdata['user_id']) && $userdata['user_id'] != ANONYMOUS):
    
        switch($userdata['user_time_mode']):
        
            case MANUAL_DST:
                $dst_sec = $userdata['user_dst_time_lag'] * 60;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
                break;
            
			case SERVER_SWITCH:
                $dst_sec = date('I', $gmepoch) * $userdata['user_dst_time_lag'] * 60;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
                break;
            
			case FULL_SERVER:
                return (!empty($translate)) ? strtr(date((string)$format, (int)$gmepoch), (string)$translate) : date((string)$format, (int)$gmepoch);
                break;
            
			case SERVER_PC:
                if(isset($pc_dateTime['pc_timezoneOffset'])):
                    $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
				else:
                    $user_pc_timeOffsets = explode("/", $userdata['user_pc_timeOffsets']);
                    $tzo_sec = $user_pc_timeOffsets[0];
                endif;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
                break;

            case FULL_PC:
                if(isset($pc_dateTime['pc_timeOffset'])):
                    $tzo_sec = $pc_dateTime['pc_timeOffset'];
				else:
                    $user_pc_timeOffsets = explode("/", $userdata['user_pc_timeOffsets']);
                    $tzo_sec = (isset($user_pc_timeOffsets[1])) ? $user_pc_timeOffsets[1] : '';
                endif;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
                break;
            default:
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz)), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz));
                break;
				
        endswitch;
     
	else:
    
        switch($board_config['default_time_mode']):
        
            case MANUAL_DST:
                $dst_sec = $board_config['default_dst_time_lag'] * 60;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
                break;

            case SERVER_SWITCH:
                $dst_sec = date('I', $gmepoch) * $board_config['default_dst_time_lag'] * 60;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz) + (int)$dst_sec);
                break;

            case FULL_SERVER:
                return (!empty($translate)) ? strtr(date((string)$format, (int)$gmepoch), (string)$translate) : date((string)$format, (int)$gmepoch);
                break;

            case SERVER_PC:
                if(isset($pc_dateTime['pc_timezoneOffset'])):
                    $tzo_sec = $pc_dateTime['pc_timezoneOffset'];
				else:
                    $tzo_sec = 0;
                endif;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
                break;

            case FULL_PC:
                if(isset($pc_dateTime['pc_timeOffset'])):
                    $tzo_sec = $pc_dateTime['pc_timeOffset'];
				else:
                    $tzo_sec = 0;
                endif;
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (int)$tzo_sec);
                break;

            default:
                return (!empty($translate)) ? strtr(gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz)), (string)$translate) : gmdate((string)$format, (int)$gmepoch + (3600 * (int)$tz));
                break;

        endswitch;
    endif;
}

if(is_user()): 
    global $userinfo;
    $uname = UsernameColor($userinfo['username']);
else: 
    $uname = $lang_evo_userblock['BLOCK']['ANON'];
endif;

global $userinfo;

if(is_user() && isset($userinfo) && is_array($userinfo)): 
    $evouserinfo_time = evouserinfo_create_date('G', time(), $userinfo['user_timezone']);
else: 
    global $board_config;
    $evouserinfo_time = evouserinfo_create_date('G', time(), $board_config['board_timezone']);
endif;

$evouserinfo_good_afternoon = "<div align=\"center\">";

# Morning
if($evouserinfo_time >= 0 && $evouserinfo_time <= 11): 
  $evouserinfo_good_afternoon .= $lang_evo_userblock['BLOCK']['AFTERNOON']['MORNING']."&nbsp;";
# Afternoon
elseif($evouserinfo_time >= 12 && $evouserinfo_time <= 17):
  $evouserinfo_good_afternoon .= $lang_evo_userblock['BLOCK']['AFTERNOON']['AFTERNOON']."&nbsp;";
#Evening
elseif($evouserinfo_time >= 18 && $evouserinfo_time <= 23):
  $evouserinfo_good_afternoon .= $lang_evo_userblock['BLOCK']['AFTERNOON']['EVENING']."&nbsp;";
endif;

# Username
$evouserinfo_good_afternoon .= "<br /><strong>".$uname."</strong></div>";

?>
