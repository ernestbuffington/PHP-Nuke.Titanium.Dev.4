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

function get_var_gf($variable) {
        global $HTTP_GET_VARS, $HTTP_POST_VARS ;

        $var = $variable['name'] ;
        $$var = ( isset($variable['default']) ) ? $variable['default'] : '' ;
        $method = ( isset($variable['method']) ) ? $variable['method'] : '' ;
        $default = ( isset($variable['default']) ) ? $variable['default'] : '' ;

        switch($method) {
                case 'POST':
                    $$var = (isset($HTTP_POST_VARS[$var])) ? $HTTP_POST_VARS[$var] : $default;
                    break;

                case 'GET' :
                    $$var = (isset($HTTP_GET_VARS[$var])) ? $HTTP_GET_VARS[$var] : $default;
                    break;

                default:
                    if(isset($HTTP_POST_VARS[$var]) || isset($HTTP_GET_VARS[$var]))
                    {
                            $$var = (isset($HTTP_POST_VARS[$var])) ? $HTTP_POST_VARS[$var] : $HTTP_GET_VARS[$var];
                    }
        }

        if ( isset($variable['intval']) and $variable['intval']) {
                $$var = intval($$var);
        }

        if ( isset($variable['okvar']) ) {
                if ( !in_array($$var,$variable['okvar']) ) {
                        $$var = $default ;
                }
        }

        return $$var ;
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