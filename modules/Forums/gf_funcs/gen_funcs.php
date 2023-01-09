<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                               gen_funcs.php
 *                            -------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 ***************************************************************************/

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

# changed for php 8.1
function get_var_gf($variable) {
        global $_GET, $_POST ;
 
         $var = $variable['name'] ;
         ${$var} = $variable['default'] ?? '' ;
         $method = $variable['method'] ?? '' ;
         $default = $variable['default'] ?? '' ;
 
         switch($method) {
                 case 'POST':
                    ${$var} = $_POST[$var] ?? $default;
                     break;
 
                 case 'GET' :
                    ${$var} = $_GET[$var] ?? $default;
                     break;
 
                 default:
                    if(isset($_POST[$var]) || isset($_GET[$var]))
                     {
                            ${$var} = $_POST[$var] ?? $_GET[$var];
                     }
         }
 
         if ( isset($variable['intval']) and $variable['intval']) {
                ${$var} = intval(${$var});
         }
 
         if ( isset($variable['okvar']) ) {
                if ( !in_array(${$var},$variable['okvar']) ) {
                        ${$var} = $default ;
                 }
         }
 
        return ${$var} ;
 }


function strip_htmlchars($t="") {
        $t = preg_replace("/&(?!#[0-9]+;)/s", '&amp;', $t );
        $t = str_replace( "<", "&lt;"  , $t );
        $t = str_replace( ">", "&gt;"  , $t );
        $t = str_replace( '"', "&quot;", $t );
    
        return $t;
}
    
function add_htmlchars($t="") {
        $t = str_replace( "&lt;"  , "<", $t );
        $t = str_replace( "&gt;"  , ">", $t );
        $t = str_replace( "&quot;", '"', $t );
        $t = str_replace( "&amp;" , "&", $t );

        return $t;
}

?>