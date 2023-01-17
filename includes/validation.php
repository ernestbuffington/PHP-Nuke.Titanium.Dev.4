<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Validation
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : validation.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.1.0
   Date          : 01.06.2005 (mm.dd.yyyy)

   Notes         : Validates strings
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

define('REGEXP_USERNAME','/[^\w{}\[\]«»=|-]/i');
define('REGEXP_TEXT','/[^a-z]/i');
define('REGEXP_FULLNAME','/[a-z]{2,}+\s{1}+[a-z]{2,}/i');
define('REGEXP_URL','/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}((:[0-9]{1,5})?\/.*)?$/i');
//Email defines from http://www.iamcal.com/publish/articles/php/parsing_email/
define('REGEXP_EMAIL_QTEXT', '[^\\x0d\\x22\\x5c\\x80-\\xff]');
define('REGEXP_EMAIL_DTEXT', '[^\\x0d\\x5b-\\x5d\\x80-\\xff]');
define('REGEXP_EMAIL_ATOM', '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.'\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+');
define('REGEXP_EMAIL_QUOTED_PAIR', '\\x5c[\\x00-\\x7f]');
define('REGEXP_EMAIL_DOMAIN_LITERAL', "\\x5b(".REGEXP_EMAIL_DTEXT."|".REGEXP_EMAIL_QUOTED_PAIR.")*\\x5d");
define('REGEXP_EMAIL_QUOTED_STRING',  "\\x22(".REGEXP_EMAIL_QTEXT."|".REGEXP_EMAIL_QUOTED_PAIR.")*\\x22");
define('REGEXP_EMAIL_SUBDOMAIN', "(".REGEXP_EMAIL_ATOM."|".REGEXP_EMAIL_DOMAIN_LITERAL.")");
define('REGEXP_EMAIL_WORD', "(".REGEXP_EMAIL_ATOM."|".REGEXP_EMAIL_QUOTED_STRING.")");
define('REGEXP_EMAIL_DOMAIN', REGEXP_EMAIL_SUBDOMAIN."(\\x2e".REGEXP_EMAIL_SUBDOMAIN.")*");
define('REGEXP_EMAIL_LOCAL_PART', REGEXP_EMAIL_WORD."(\\x2e".REGEXP_EMAIL_WORD.")*");
define('REGEXP_EMAIL', "!^".REGEXP_EMAIL_LOCAL_PART."\\x40".REGEXP_EMAIL_DOMAIN."$!");

/*
 $item = Item to check
 $type = Type to validate: text, fullname, username, email, url, number
 $where = The location of the validation ex. 'submit news'
 $silent = 1 will return false if failed, 0 will display the error message
 $required = 1 for required, 0 for not
 $high = Highest value, or string size
 $low = Lowest value, or string size
 $type_lang = If set will write that insted of the type ex. 'Nickname'
 $append = Anything you want to add to the error message ex. 'Thank you'
*/
function Validate($item, $type, $where, $silent=0, $required=0, $high=0, $low=0, $type_lang='', $append='') {
    
	if(!isset($currentlang))
	$currentlang = 'english';
	
	if (file_exists('language/custom/lang-'.$currentlang.'.php')) {
        include_once('language/custom/lang-'.$currentlang.'.php');
    } else {
        include_once('language/custom/lang-english.php');
    }
    if(is_array($item)) {
        return ValidateArray($item, $type, $where, $silent, $required, $high, $low, $type_lang, $append, $html);
    }
    if(!$required) {
        if(empty($item)) {
            return;
        }
    }
    if(is_string($item)) {
         $item = check_words($item);
         if(strstr($item, '*')) {
             if(!$silent) DisplayError(sprintf(VALIDATE_WORD,(!empty($type_lang)) ? $type_lang : $type) . $append); else return false;
         }
    }
    $high = intval($high);
    $low = intval($low);
    if(isset($item) && !empty($item)) {
        if($type == 'username') {
           if(preg_match(REGEXP_USERNAME,$item)) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_USERNAME, $where) . $append); else return false;
           }
        } else if($type == 'fullname') {
           if(!preg_match(REGEXP_FULLNAME,$item)) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_FULLNAME, $where) . $append); else return false;
           }
        } else if($type == 'text') {
           if(preg_match(REGEXP_TEXT,$item)) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_TEXT, $where) . $append); else return false;
           }
        } else if($type == 'number') {
           if(!is_numeric($item)) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_NUMBER, $where) . $append); else return false;
           }
        } else if($type == 'email') {
           if(!preg_match(REGEXP_EMAIL,$item)) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_EMAIL, $where) . $append); else return false;
           }
        } else if($type == 'url') {
           if(!preg_match(REGEXP_URL,$item)) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_URL, $where) . $append); else return false;
           }
        } else if($type == 'int') {
           if((is_string($item) && !is_numeric($item)) || (!is_string($item) && !is_int($item))) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_INT, $where) . $append); else return false;
           }
        } else if($type == 'float' || $type == 'double') {
            if((is_string($item) && !is_numeric($item)) || (!is_string($item) && !is_float($item))) {
              if(!$silent) DisplayError(sprintf(VALIDATE_ERROR,(!empty($type_lang)) ? $type_lang : VALIDATE_FLOAT, $where) . $append); else return false;
           }
        }
    }
    if($high != 0 || $low != 0) {
        if($type == 'username' || $type == 'fullname' || $type == 'text' || $type == '') {
            if($high != 0 && $low != 0) {
                $between = 'between '.$low.' & '.$high;
            } else if($high != 0) {
                $between = 'less than '.$high;
            } else {
                $between = 'greater than '.$low;
            }
            if($high == $low) {
                if(strlen($item) != $high) {
                    if(!$silent) DisplayError(sprintf(VALIDATE_TEXT_SIZE, (!empty($type_lang)) ? $type_lang : $type, $where, $low) . $append); else return false;
                }
            } else {
                if($high != 0) {
                    if(strlen($item) > $high) {
                        if(!$silent) DisplayError(sprintf(VALIDATE_TEXT_SIZE, (!empty($type_lang)) ? $type_lang : $type, $where, $between) . $append); else return false;
                    }
                }
                if($low != 0) {
                    if(strlen($item) < $low) {
                        if(!$silent) DisplayError(sprintf(VALIDATE_TEXT_SIZE, (!empty($type_lang)) ? $type_lang : $type, $where, $between) . $append); else return false;
                    }
                }
            }
        } else if($type == 'number') {
            if($high != 0 && $low != 0) {
                $between = 'between '.$low.' & '.$high;
            } else if($high != 0) {
                $between = 'less than '.$high;
            } else {
                $between = 'greater than '.$low;
            }
            if($high == $low) {
                if($item != intval($high)) {
                    if(!$silent) DisplayError(sprintf(VALIDATE_NUMBER_SIZE, (!empty($type_lang)) ? $type_lang : $type, $where, $low) . $append); else return false;
                }
            } else {
                if($high != 0) {
                    if($item > intval($high)) {
                        if(!$silent) DisplayError(sprintf(VALIDATE_NUMBER_SIZE, (!empty($type_lang)) ? $type_lang : $type, $where, $between) . $append); else return false;
                    }
                }
                if($low != 0) {
                    if($item < intval($low)) {
                        if(!$silent) DisplayError(sprintf(VALIDATE_NUMBER_SIZE, (!empty($type_lang)) ? $type_lang : $type, $where, $between) . $append); else return false;
                    }
                }
            }
        }
    }
    return true;
}

function ValidateArray($item, $type, $where, $silent=0, $required=0, $high=0, $low=0, $type_lang='', $append='', $html='') {
    if(!is_array($item)) {
        if($required) {
            return false;
        } else {
            return true;
        }
    }
    foreach($item as $element) {
        if(!Validate($element, $type, $where, $silent, $required, $high, $low, $type_lang, $append, $html)) {
            return false;
        }
    }
    return true;
}
?>