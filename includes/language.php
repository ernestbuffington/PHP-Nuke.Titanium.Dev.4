<?php

/*********************************************
  CPG Dragonfly™ CMS
  ********************************************
  Copyright (c) 2004 - 2005 by CPG-Nuke Dev Team
  http://dragonflycms.org

  Dragonfly is released under the terms and conditions
  of the GNU GPL version 2 or any later version

  $Source: /cvs/html/includes/functions/language.php,v $
  $Revision: 9.14 $
  $Author: djmaze $
  $Date: 2006/01/18 03:16:15 $
**********************************************/

/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*****[CHANGES]**********************************************************
-=[Base]=-
      Language Selector                        v3.0.0       12/11/2005
-=[Mod]=-
      Custom Language File                     v1.0.1       06/02/2005
 ************************************************************************/

if (!defined('NUKE_EVO')) {
    die("You can't access this file directly...");
}

global $language, $multilingual;

// This data was taken from Dragonfly CMS 
// http://www.dragonflycms.org
$browserlang = array(
    'af' => 'afrikaans', // ISO-8859-1
    'sq' => 'albanian',  // ISO-8859-1
    'ar' => 'arabic',   // 1256
    'ar-dz' => 'arabic', // algeria
    'ar-bh' => 'arabic', // bahrain
    'ar-eg' => 'arabic', // egypt
    'ar-iq' => 'arabic', // iraq
    'ar-jo' => 'arabic', // jordan
    'ar-kw' => 'arabic', // kuwait
    'ar-lb' => 'arabic', // lebanon
    'ar-ly' => 'arabic', // libya
    'ar-ma' => 'arabic', // morocco
    'ar-om' => 'arabic', // oman
    'ar-qa' => 'arabic', // qatar
    'ar-sa' => 'arabic', // Saudi Arabia
    'ar-sy' => 'arabic', // syria
    'ar-tn' => 'arabic', // tunisia
    'ar-ae' => 'arabic', // U.A.E
    'ar-ye' => 'arabic', // yemen
    'hy' => 'armenian',
    'ast' => 'asturian',
    'eu' => 'basque',
    'be' => 'belarusian',
    'bs' => 'bosanski',//bosnian -bosanski is nuke lang name
    'bg' => 'bulgarian',
    'ca' => 'catalan',
    'zh' => 'chinese',
    'zh-cn' => 'chinese', // China
    'zh-hk' => 'chinese', // Hong Kong
    'zh-sg' => 'chinese', // Singapore
    'zh-tw' => 'chinese', // Taiwan
    'hr' => 'croatian',   // 1250
    'cs' => 'czech',
    'da' => 'danish',   // ISO-8859-1
    'dcc' => 'desi',    // Deccan, India
    'nl' => 'dutch',    // ISO-8859-1
    'nl-be' => 'dutch', // Belgium
    'en' => 'english',
    'en-au' => 'english', // Australia
    'en-bz' => 'english', // Belize
    'en-ca' => 'english', // Canada
    'en-ie' => 'english', // Ireland
    'en-jm' => 'english', // Jamaica
    'en-nz' => 'english', // New Zealand
    'en-ph' => 'english', // Philippines
    'en-za' => 'english', // South Africa
    'en-tt' => 'english', // Trinidad
    'en-gb' => 'english', // United Kingdom
    'en-us' => 'english', // United States
    'en-zw' => 'english', // Zimbabwe
    'eo' => 'esperanto',
    'et' => 'estonian',
    'eu' => 'euraska',   // ISO-8859-1
    'fo' => 'faeroese',
    'fi' => 'finnish',   // ISO-8859-1
    'fr' => 'french',   // ISO-8859-1
    'fr-be' => 'french', // Belgium
    'fr-ca' => 'french', // Canada
    'fr-fr' => 'french', // France
    'fr-lu' => 'french', // Luxembourg
    'fr-mc' => 'french', // Monaco
    'fr-ch' => 'french', // Switzerland
    'gl' => 'galego', //galician- galego is nuke lang name // ISO-8859-1
    'ka' => 'georgian',
    'de' => 'german',   // ISO-8859-1
    'de-at' => 'german', // Austria
    'de-de' => 'german', // Germany
    'de-li' => 'german', // Liechtenstein
    'de-lu' => 'german', // Luxembourg
    'de-ch' => 'german', // Switzerland
    'el' => 'greek',      // ISO-8859-7
    'he' => 'hebrew',
    'hu' => 'hungarian',  // ISO-8859-2
    'is' => 'icelandic',  // ISO-8859-1
    'id' => 'indonesian', // ISO-8859-1
    'ga' => 'irish',
    'it' => 'italian',  // ISO-8859-1
    'it-ch' => 'italian', // Switzerland
    'ja' => 'japanese',
    'ko' => 'korean',
    'ko-kp' => 'korean', // North Korea
    'ko-kr' => 'korean', // South Korea
    'ku' => 'kurdish',    // 1254
    'lv' => 'latvian',
    'lt' => 'lithuanian',   // 1257
    'mk' => 'macedonian',   // 1251
    'ms' => 'malayu',
    'no' => 'norwegian',    // ISO-8859-1
    'nb' => 'norwegian',    // bokmal
    'nn' => 'norwegian',    // nynorsk
    'pl' => 'polish',      // ISO-8859-2
    'pt' => 'portuguese',   // 28591, Latin-I, iso-8859-1
    'pt-br' => 'brazilian', // Brazil
    'ro' => 'romanian',  // 28592, Central Europe, iso-8859-2
    'ru' => 'russian',    // 1251 ANSI
    'gd' => 'scots gealic',
    'sr' => 'serbian',
    'sk' => 'slovak',      // 1250 ANSI
    'sl' => 'slovenian',    // 28592, Central Europe, iso-8859-2
    'es' => 'spanish',    // 28591, Latin-I, iso-8859-1
    'es-ar' => 'spanish',   // Argentina
    'es-bo' => 'spanish', // Bolivia
    'es-cl' => 'spanish', // Chile
    'es-co' => 'spanish', // Colombia
    'es-cr' => 'spanish', // Costa Rica
    'es-do' => 'spanish', // Dominican Republic
    'es-ec' => 'spanish', // Ecuador
    'es-sv' => 'spanish', // El Salvador
    'es-gt' => 'spanish', // Guatemala
    'es-hn' => 'spanish', // Honduras
    'es-mx' => 'spanish', // Mexico
    'es-ni' => 'spanish', // Nicaragua
    'es-pa' => 'spanish', // Panama
    'es-py' => 'spanish', // Paraguay
    'es-pe' => 'spanish', // Peru
    'es-pr' => 'spanish', // Puerto Rico
    'es-es' => 'castellano', // Spain
    'es-uy' => 'spanish', // Uruguay
    'es-ve' => 'spanish', // Venezuela
    'sv' => 'swedish',
    'sv-fi' => 'swedish',   // Finland
    'sw' => 'swahili',    // Kenya and Tanzania
    'th' => 'thai',      // 874
    'tr' => 'turkish',    // 1254
    'ug' => 'uighur',      // ISO-8859-1, 28591 Turkish, Uzbek, China
    'uk' => 'ukrainian',
    'vi' => 'vietnamese',
    'cy' => 'welsh',
    'xh' => 'xhosa',
    'yi' => 'yiddish',
    'zu' => 'zulu'
);

//To resolve getting the random capital letters ie (English)
$language = strtolower($language);
$multilingual = intval($multilingual);
$currentlang = $language;

if ($multilingual) {
    if (isset($_GET['newlang']) && is_lang($_GET['newlang'])) {
        $currentlang = $_GET['newlang'];
    } else if (isset($_POST['newlang']) && is_lang($_POST['newlang'])) {
        $currentlang = $_POST['newlang'];
    } elseif (isset($_COOKIE['lang']) && is_lang($_COOKIE['lang'])) {
        $currentlang = $_COOKIE['lang'];
    } else {
        $currentlang = detect_lang($browserlang);
    }
    if (!is_lang($currentlang)) {
        $currentlang = $language;
    }
    setcookie('lang', $currentlang, time()+31536000);
}

//Fallback
if (empty($currentlang)) {
    $currentlang = 'english';
}

define('_LANGCODE', array_search($currentlang, $browserlang));
unset($browserlang);

include_lang($currentlang);

function is_lang($language) {
    $maincheck = file_exists(NUKE_LANGUAGE_DIR.'lang-'.$language.'.php');
    $admncheck = file_exists(NUKE_ADMIN_DIR.'language/lang-'.$language.'.php');
    if($maincheck && $admncheck) {
        return true;
    }
    return false;
}

function include_lang($language) {
    include_once(NUKE_LANGUAGE_DIR.'lang-'.$language.'.php');
    include_once(NUKE_LANGUAGE_DIR.'custom/lang-'.$language.'.php');
	include_once(NUKE_LANGUAGE_DIR.'blocks/lang-'.$language.'.php');
    if(defined('ADMIN_FILE')) {
        include_once(NUKE_ADMIN_DIR.'language/lang-'.$language.'.php');
        include_once(NUKE_ADMIN_DIR.'language/custom/lang-'.$language.'.php');
    }
}

function detect_lang($browserlang) {
    $http_accept_language = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : getenv('HTTP_ACCEPT_LANGUAGE');
    $accepted_languages = explode(',', strtolower($http_accept_language));
    foreach ($accepted_languages as $browser_lang) {
        $langcode = ($browser_lang[2] == '-') ? substr($browser_lang, 0, 5) : substr($browser_lang, 0, 2);
        $tmplang = $browserlang[$langcode];
        if (is_lang($tmplang)) {
            return $tmplang;
        }
    }
    return false;
}

function get_lang($module) {
    global $currentlang, $language;
    static $included;
    if(!isset($included)) {
        $included = array();
    } elseif(isset($included[$module])) {
        return $included[$module];
    }
    if (file_exists(NUKE_MODULES_DIR.$module.'/language/lang-'.$currentlang.'.php')) {
        $path = NUKE_MODULES_DIR.$module.'/language/lang-'.$currentlang.'.php';
    } elseif (file_exists(NUKE_MODULES_DIR.$module.'/language/lang-'.$language.'.php')) {
        $path = NUKE_MODULES_DIR.$module.'/language/lang-'.$language.'.php';
    } elseif (file_exists(NUKE_MODULES_DIR.$module.'/language/lang-english.php')) {
        $path = NUKE_MODULES_DIR.$module.'/language/lang-english.php';
    } else {
        return $included[$module] = false;
    }
    require_once($path);
    return $included[$module] = true;
}

function lang_list() {
    static $languages;
    if (!isset($languages)) {
        $handle = opendir(NUKE_LANGUAGE_DIR);
        while (false !== ($file = readdir($handle))) {
            if (preg_match('/lang-(.*?)\.php/i', $file, $lang)) {
                $languages[] = $lang[1];
            }
        }
        closedir($handle);
        sort($languages);
    }
    return $languages;
}

?>