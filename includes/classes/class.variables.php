<?php
/*=======================================================================
 PHP-Nuke Titanium | Nuke-Evolution Basic : Enhanced and Advanced
 =======================================================================*/

/**
 *
 * Variable validation and checking class.
 * Will add slashes to all input variables (ie POST, GET, COOKIE)
 *
 * The orginal concept and some of the orginal code credit goes to
 * d11wtq (Chris Corbyn) from http://forums.devnetwork.net
 *
 * @author(s) Ernest Allen Buffington, Chris Corbyn, Technocrat
 * @version $Id:$ (4.0.3)
 * @package v4
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

defined('NUKE_EVO') || die('Direct access is not allowed');

# Valid domains
define('REGEXP_TLD', '/(\.AC
                       |\.AD
					   |\.AE|
					   \.AERO|
					   \.AF|
					   \.AG|
					   \.AI|
					   \.AL|
					   \.AM|
					   \.AN|
					   \.AO|
					   \.AQ|
					   \.AR|
					   \.ARPA|
					   \.AS|
					   \.AT|
					   \.AU|
					   \.AW|
					   \.AX|
					   \.AZ|
					   \.BA|
					   \.BB|
					   \.BD|
					   \.BE|
					   \.BF|
					   \.BG|
					   \.BH|
					   \.BI|
					   \.BIZ|
					   \.BJ|
					   \.BM|
					   \.BN|
					   \.BO|
					   \.BR|
					   \.BS|
					   \.BT|
					   \.BV|
					   \.BW|
					   \.BY|
					   \.BZ|
					   \.CA|
					   \.CAT|
					   \.CC|
					   \.CD|
					   \.CF|
					   \.CG|
					   \.CH|
					   \.CI|
					   \.CK|
					   \.CL|
					   \.CM|
					   \.CN|
					   \.CO|
					   \.COM|
					   \.EXCHANGE|
					   \.COOP|
					   \.CR|
					   \.CU|
					   \.CV|
					   \.CX|
					   \.CY|
					   \.CZ|
					   \.DE|
					   \.DJ|
					   \.DK|
					   \.DM|
					   \.DO|
					   \.DZ|
					   \.EC|
					   \.EDU|
					   \.EE|
					   \.EG|
					   \.ER|
					   \.ES|
					   \.ET|
					   \.EU|
					   \.FI|
					   \.FJ|
					   \.FK|
					   \.FM|
					   \.FO|
					   \.FR|
					   \.GA|
					   \.GB|
					   \.GD|
					   \.GE|
					   \.GF|
					   \.GG|
					   \.GH|
					   \.GI|
					   \.GL|
					   \.GM|
					   \.GN|
					   \.GOV|
					   \.GP|
					   \.GQ|
					   \.GR|
					   \.GS|
					   \.GT|
					   \.GU|
					   \.GW|
					   \.GY|
					   \.HK|
					   \.HM|
					   \.HN|
					   \.HR|
					   \.HT|
					   \.HU|
					   \.ID|
					   \.IE|
					   \.IL|
					   \.IM|
					   \.IN|
					   \.INFO|
					   \.INT|
					   \.IO|
					   \.IQ|
					   \.IR|
					   \.IS|
					   \.IT|
					   \.JE|
					   \.JM|
					   \.JO|
					   \.JOBS|
					   \.JP|
					   \.KE|
					   \.KG|
					   \.KH|
					   \.KI|
					   \.KM|
					   \.KN|
					   \.KR|
					   \.KW|
					   \.KY|
					   \.KZ|
					   \.LA|
					   \.LB|
					   \.LC|
					   \.LI|
					   \.LK|
					   \.LR|
					   \.LS|
					   \.LT|
					   \.LU|
					   \.LV|
					   \.LY|
					   \.MA|
					   \.MC|
					   \.MD|
					   \.MG|
					   \.MH|
					   \.MIL|
					   \.MK|
					   \.ML|
					   \.MM|
					   \.MN|
					   \.MO|
					   \.MOBI|
					   \.MP|
					   \.MQ|
					   \.MR|
					   \.MS|
					   \.MT|
					   \.MU|
					   \.MUSEUM|
					   \.MV|
					   \.MW|
					   \.MX|
					   \.MY|
					   \.MZ|
					   \.NA|
					   \.NAME|
					   \.NC|
					   \.NE|
					   \.NET|
					   \.NF|
					   \.NG|
					   \.NI|
					   \.NL|
					   \.NO|
					   \.NP|
					   \.NR|
					   \.NU|
					   \.NZ|
					   \.OM|
					   \.ORG|
					   \.PA|
					   \.PE|
					   \.PF|
					   \.PG|
					   \.PH|
					   \.PK|
					   \.PL|
					   \.PM|
					   \.PN|
					   \.PR|
					   \.PRO|
					   \.PS|
					   \.PT|
					   \.PW|
					   \.PY|
					   \.QA|
					   \.RE|
					   \.RO|
					   \.RU|
					   \.RW|
					   \.SA|
					   \.SB|
					   \.SC|
					   \.SD|
					   \.SE|
					   \.SG|
					   \.SH|
					   \.SI|
					   \.SJ|
					   \.SK|
					   \.SL|
					   \.SM|
					   \.SN|
					   \.SO|
					   \.SR|
					   \.ST|
					   \.SU|
					   \.SV|
					   \.SY|
					   \.SZ|
					   \.TC|
					   \.TD|
					   \.TEL|
					   \.TF|
					   \.TG|
					   \.TH|
					   \.TJ|
					   \.TK|
					   \.TL|
					   \.TM|
					   \.TN|
					   \.TO|
					   \.TP|
					   \.TR|
					   \.TRAVEL|
					   \.TT|
					   \.TV|
					   \.TW|
					   \.TZ|
					   \.UA|
					   \.UG|
					   \.UK|
					   \.UM|
					   \.US|
					   \.UY|
					   \.UZ|
					   \.VA|
					   \.VC|
					   \.VE|
					   \.VG|
					   \.VI|
					   \.VN|
					   \.VU|
					   \.WF|
					   \.WS|
					   \.YE|
					   \.YT|
					   \.YU|
					   \.ZA|
					   \.ZM|
					   \.ZW)/i');
# Alpha Numeric
define('REGEXP_ALPHANUMERIC', '/[^\d\w]/i');
define('REGEXP_ALPHANUMERIC_SPACE', '/[^\d\w\s]/i');
# Just Alpha
define('REGEXP_ALPHA', '/[^\w]/i');
define('REGEXP_ALPHA_SPACE', '/[^\w\s]/i');

require_once(NUKE_INCLUDE_DIR.'utf/utf_tools.php');

/**
 * Changed/Updated for PHP 8.1
 * 12/19/2022 1:25 pm Ernest Allen Buffington
 *
 * Selects and runs the correct slash adding function
 * This function is outside the class due to array_map in deepSlash
 *
 * @param string $function The function selected to add slashes
 * @param mixed $data The data to add slashes too
 * @return Data with slashes
 */
function slashFunction($function, $data) {
    global $db;

    # Error check
    if (empty($data)) 
	return $data;

    return match ($function) {
        'mysql_real_escape_string' => mysql_real_escape_string($data),
        'mysql_escape_string' => mysql_escape_string($data),
        'mysqli_real_escape_string' => mysqli_real_escape_string($db->db_connect_id, (string) $data),
        'mysqli_escape_string' => mysqli_escape_string($db->db_connect_id, (string) $data),
        default => addslashes((string) $data),
    };
}
/**
 * Changed/Updated for PHP 8.1
 * 12/19/2022 1:20 pm Ernest Allen Buffington
 *
 * Will add slashes to arrays
 * This function is outside the class due to array_map
 *
 * @param mixed $data The data to add slashes to
 * @return Data with slashes
 */
function deepSlash($data) {
    global $db, $dbtype;
    # If there is no data get out
    if (empty($data)): 
	  return $data;
	endif;
    # Get what function to use
    static $function;
      if (empty($function)):
        # If for some reason there is no DB connector
        if (!isset($db) || !is_object($db)):
          # Use addslashes
          $function = 'addslashes';
        elseif($dbtype == 'mysqli' && function_exists('mysqli_real_escape_string')):
          $function = 'mysqli_real_escape_string';
        elseif ($dbtype == 'mysqli_escape_string'):
          $function = 'mysqli_escape_string';
        elseif (function_exists('mysql_real_escape_string')):
          $function = 'mysql_real_escape_string';
         else:
          $function = 'mysql_escape_string';
         endif;
    endif;
    # If the data wasnt an array for some reason add slashes to it and send it back
    if(!is_array($data)): 
	  return slashFunction($function, $data);
	endif;

      # Loop through the data
      foreach ($data as $k => $v):
        # If its an array
        if(is_array($data[$k])): 
          # Go though this function again
          $data[$k] = array_map('deepSlash', $data[$k]);
		elseif(is_numeric($v) || empty($v)): 
            $data[$k] = $v;
		else: 
            $v = str_replace("\r\n", "\n", (string) $v);
            $v = str_replace("\r", "\n", $v);
            $v = trim($v);
         
		       if (!empty($v)): 
                 $data[$k] = slashFunction($function, $v);
                 $data[$k] = str_replace('\n', "\n", (string) $data[$k]);
                 $data[$k] = utf8_normalize_nfc($data[$k]);
                 # Get the registered globals also
                 global ${$k};
			       if(isset(${$k}) && !empty(${$k})): 
                     ${$k} = $data[$k];
                   endif;
			   else: 
                 $data[$k] = '';
                 global ${$k};
			     if(isset(${$k}) && !empty(${$k})): 
                    ${$k} = '';
                 endif;
              endif;
		endif;
	endforeach;
	return $data;
}
/**
 * Changed/Updated for PHP 8.1
 * 12/19/2022 12:15 am Ernest Allen Buffington
 *
 * Will strip slashes from arrays
 * This function is outside the class due to array_map
 *
 * @param mixed $data The data to strip slashes from
 * @return Data without slashes
 */
 function deepStrip($data) {
  # Error check
  if(empty($data)):       
    return $data;
  endif;
  # array check     
  if(!is_array($data)):   
    return stripslashes((string) $data);
  endif;
  # Loop through the data
  foreach ($data as $k => $v):
    # If its an array
    if(is_array($data[$k])):
       # Go though this function again
       $data[$k] = array_map('deepStrip', $data[$k]);
	elseif(is_numeric($v) || empty($v)): 
       $data[$k] = $v;
	else: 
       $data[$k] = stripslashes((string) $v);
       # Get the registered globals also
       global ${$k};
       if(isset(${$k}) && !empty(${$k})): 
         ${$k} = $data[$k];
       endif;
    endif;
  endforeach;
  
  return $data;
 }

/**
 * Chamged/Updated for PHP 8.1 
 * 12/19/2022 11:56 am Ernest Allen Buffington 
 * Now Loads from Vendor Directory
 * @ HTML Purifier 4.14.0
 */
function deepPurifier($data) 
{
	global $html_auth, $admin;

    static $config, $purifier;

    # Error check
    if(empty($data) || !isset($data))       
	return $data;

    if(!is_array($data))   
	return stripslashes((string) $data);
	
	if(is_array($data)){
	  $test  = json_encode($data);
    }

	if(!preg_match('/[<|>]/', $test)) 
	{
        return $data;
    }

 	
	if(!isset($config) || empty($config)) 
	{
        $siteRootDir = dirname($_SERVER['DOCUMENT_ROOT']);
        defined('EZYANG_BASE_DIR') or define('EZYANG_BASE_DIR', $siteRootDir . '/public_html/vendor/ezyang/htmlpurifier/library/HTMLPurifier/');
        if(file_exists(EZYANG_BASE_DIR.'Bootstrap.php')):
            require_once(EZYANG_BASE_DIR.'Bootstrap.php');
        endif;
		
        if(file_exists(EZYANG_BASE_DIR.'HTMLPurifier.autoload.php')):
            require_once(EZYANG_BASE_DIR.'HTMLPurifier.autoload.php');
        endif;
		
        defined('ROOT_DIR') or define('ROOT_DIR', $siteRootDir . '/public_html/');
		set_include_path(ROOT_DIR. get_include_path() );
		
		$config = HTMLPurifier_Config::createDefault();
		$config->set('Core.Encoding', 'UTF-8');
		$config->set('HTML.Doctype', 'HTML 4.01 Transitional');
		if(!is_god($admin) || (is_god($admin) && !$html_auth)) 
		{
			$config->set('HTML.Trusted', true);
			$config->set('HTML.SafeObject', true);
			$config->set('HTML.SafeEmbed', true);
            $config->set('HTML.AllowedAttributes','img@height,img@width,img@src,iframe@src,iframe@allowfullscreen');
            $config->set('HTML.AllowedAttributes', 'src, height, width, alt');
			$config->set('HTML.AllowedElements', ['img', 'iframe', 'div', 'script', 'object', 'p', 'span', 'pre', 'b', 'i', 'u', 'strong', 'em', 'sup', 'a', 'img', 'table', 'tr', 'td', 'tbody', 'thead', 'param']);
 			$config->set('Output.FlashCompat', true);
 			$config->set('Attr.EnableID', true);
			$config->set('Filter.Custom', [new HTMLPurifier_Filter_YouTube()]);
         }
        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('iframe', 'allowfullscreen', 'Bool');
		$purifier = new HTMLPurifier($config);
    }
 # Loop through the data
 foreach ($data as $k => $v) {
         # If its an array
        if (is_array($data[$k])) {
            # Go though this function again
            $data[$k] = array_map('deepStrip', $data[$k]);
        } elseif (is_numeric($v) || empty($v)) {
            $data[$k] = $v;
         } else {
            if (isset($_GET['op']) && $_GET['op'] == 'Configure' && isset($_GET['sub']) && $_GET['sub'] == '11') {
                $data[$k] = $v;
                continue;
            } elseif ($k == 'xsitename' || $k == 'xslogan') {
                $data[$k] = $v;
                continue;
            } elseif (isset($_GET['name'])) {
                # If forum post let it pass to the forum html security
                if ($_GET['name'] == 'Forums' && (isset($_GET['file']) && ($_GET['file'] == 'posting')) && ($k == 'message' || $k == 'subject')) {
                     $data[$k] = $v;
                     continue;
                }
                # If PM let it pass to the forum html security
                if ($_GET['name'] == 'Private_Messages' && ($k == 'message' || $k == 'subject')) {
                     $data[$k] = $v;
                     continue;
                }
                # If SIG let it pass to the forum html security
                if ($_GET['name'] == 'Profile' && (isset($_GET['mode']) && ($_GET['mode'] == 'signature')) && $k == 'signature') {
                    $data[$k] = $v;
                    continue;
                }
            }
            # If its a strip lets purify it
            if (!is_god($admin) || (is_god($admin) && !$html_auth)) {
 					$data[$k] = $purifier->purify($v);
 				}
            $data[$k] = str_replace('\n', "\n", (string) $data[$k]);
            # Get the registered globals also
            global ${$k};
            if (isset(${$k}) && !empty(${$k})) {
                ${$k} = $data[$k];
             }
         }
     }
    return $data;
}

/**
 * Example:
 * <code>
 * <?php
 *     global $_GETVAR;
 *     //$variable = $_GETVAR->get($var, $loc, $type, $default, $minlen, $maxlen, $regex);
 *     $foo = $_GETVAR->get('foo', '_GET', 'string', null, 1, 10, '/^foo/i');
 * ?>
 * </code>
 */

/**
 * Updated/Changed for PHP 8.1
 * 10/19/2022 11:59 am Ernest ALlen Buffington
 * 
 * @package v4.0.3
 * @subpackage Variables
 */
class Titanium_Variables
{
    /**
     * The raw or "dirty" variable
     * This should not be used normally
     * @var mixed
     */
    var $rawVariable   = null;
    /**
     * Failed variable
     * @var bool
     */
    var $failed         = false;
    /**
     * Reason for failure
     * @var string
     */
    var $reason        = '';

    /**
	 * @Since Titanium v4.0.3
     * Constructor
     * Checks for valid input
     * Then strips magic_quotes if on
     * Then adds mysql slashes
     */
    function check_valid_inputTypes() {
		//Check for valid input
        $this->_validInput($_POST);
        $this->_validInput($_GET);
        $this->_validInput($_COOKIE);
        $this->_validInput($_FILES);
        //Strip magic if on, then add slashes
        $_POST      = $this->_undoMagic($_POST);
        $_POST      = deepPurifier($_POST);
        $_POST      = $this->_addSlashesArray($_POST);
        $_GET       = $this->_undoMagic($_GET);
        $_GET       = deepPurifier($_GET);
        $_GET       = $this->_addSlashesArray($_GET);
        $_REQUEST   = $this->_undoMagic($_REQUEST);
        $_REQUEST   = deepPurifier($_REQUEST);
        $_REQUEST   = $this->_addSlashesArray($_REQUEST);
        $_COOKIE    = $this->_undoMagic($_COOKIE);
        $_COOKIE    = $this->_addSlashesArray($_COOKIE);
        $_FILES     = $this->_undoMagic($_FILES);
        $_FILES     = deepPurifier($_FILES);
    }

    /**
     * Fixes quotes to help against SQL injections
     * This should not have be used unless the slashes are stripped
     * @Since Titanium v4.0.3
     * @access public
     * @param string $string
     * @return string escaped string
     */
    function fixQuotes(&$string) {
        return deepSlash($string);
    }

    /**
     * Changed/Written for PHP 8.1 by Ernest Allen Buffington
     * 12/19/2022 10:30 am
     *	 	 
	 * Gets the variable and runs all the proper sub functions
     *
     * @access public
     *
     * @param string $var the variable to check
     * @param string $loc the location to retrieve the variable
     * @param string $type the type to check against the variable
     * @param string $default the default value to give the variable if there is a failure
     * @param string $minlen the min length to check against variable
     * @param string $maxlen the max length to check against variable
     * @param string $regex the regex to check against the variable
     *
     * @return mixed
     */
    function get($var, $loc, $type='string', $default=null, $minlen='', $maxlen='', $regex='') {
        //Restart
        $this->failed            = false;
        $this->reason            = '';
        $this->rawVariable       = null;

        # Check for errors
        if (empty($var) || empty($type) || empty($loc)) {
            die('_GETVAR Error!!<br />'.var_dump(debug_backtrace()));
        }

        # Make sure the location is valid
        $loc = $this->_validLocation($loc);
        
		# Check to make sure the variable is there
        if (!$this->_checkLocation($loc, $var)) return $this->_failed('location', $default);
        
		# Set the variable and the set $var to the retrieved value
        $var = $this->rawVariable = $this->_getLocation($loc, $var);
        
		# Type check
        if (!$this->_checkType($var, $type)) return $this->_failed('type', $default);

        # If there is length
        # Check length
        if ((!empty($minlen) || !empty($maxlen)) && !$this->_checkLength($var, $minlen, $maxlen)) {
            return $this->_failed('length', $default);
         }		
		
        # If there is regex
        # Check the regex
        if (!empty($regex) && !$this->_checkMatch($var, $regex)) {
            return $this->_failed('pattern', $default);
        }
		
		# Change the type if needed
        $var = $this->_changetype($var, $type);

        return $var;
    }
    /**
     * Strips slashes
     * @Since Titanium v4.0.3
     * @param mixed $data
     * @return mixed
     */
    function stripSlashes(&$data) {
        if (empty($data))       
		  return $data;
        if (is_numeric($data))  
		  return $data;
        if (is_array($data))    
		  return $this->_stripSlashesArray($data);
        if (is_string($data))   
		  return stripslashes($data);
        
		return $data;
    }

/**
 * Changed/Written for PHP 8.1 by Ernest Allen Buffington
 * 12/19/2022 10:30 am
 *
 * Unset everything
 * Original Code was from phpbb v3
 * @access public
 * @param bool $force force the unset
 */
function unsetVariables($force=false) 
{
  # If registered globals is on
  if ((ini_get('register_globals') == '1' || strtolower(ini_get('register_globals')) == 'on') || $force): 
          # Code from Titanium v4.0.3
          $not_unset = ['phpEx', 'phpbb_root_path', 'name', 'admin', 'nukeuser', 'user', 'no_page_header', 'cookie', 'db', 'prefix', 'cancel', 'name'];
 
           # Not only will array_merge and array_keys give a warning if
           # a parameter is not an array, array_merge will actually fail.
           # So we check if _SESSION has been initialised.
           if (!isset($_SESSION) || !is_array($_SESSION)):
            $_SESSION = [];
           endif;

             # Merge all into one array; unset this later
             $input = [...$_GET, ...$_POST, ...$_COOKIE, ...$_SERVER, ...$_SESSION, ...$_ENV, ...$_FILES];
 
             unset($input['input']);
             unset($input['not_unset']);
 
           foreach (array_keys($input) as $var):
               if (!in_array($var, $not_unset)):
                 unset(${$var});
               endif;
           endforeach;
 
           unset($input);
endif;
}

    /**
     * Adds slashes to an array
     * @Since Titanium v4.0.3
     * @param mixed $data
     * @return mixed Data without slashes
     */
    function _addSlashesArray(&$data) {
        return deepSlash($data);
    }
    /**
	 * Changed/Updated for PHP 8.1
	 * 12/19/2022 am Ernest Allen Buffington
	 *
     * Changes the type to int or float
     *
     * @param mixed $var
     * @param string $type
     * @return mixed
     */
    function _changetype($var, $type) {
        switch (strtolower((string) $type)):
            case 'bool':
                if (is_bool($var)): 
                  return $var;
                endif;
                
				if (is_numeric($var)): 
                  return (bool)$var;
                endif;
                
				if (is_string($var)): 
				  if ($var == 'true'): 
                    return true;
				  else: 
                    return false;
                  endif;
				endif;
            break;

            case 'int':
            case 'integer': 
			   return (is_string($var)) ? (int)$var : $var;

            case 'double':
            case 'float':   
			   return (is_string($var)) ? (float)$var : $var;

            default: 
			   return $var;
        
		endswitch;
    }
    /**
     * Changed/Updated for PHP 8.1
     * 12/19/2022 11:46 am Ernest Allen Buffington
     *
     * Checks variable length of a string or the size of a number
     *
     * @access private
     *
     * @param mixed $var variable to check
     * @param string $minlen the min length to check against variable
     * @param string $maxlen the max length to check against variable
     *
     * @return bool
     */
  function _checkLength($var, $minlen, $maxlen) 
  {
        if (empty($var)): 
		  return false;
		endif;
        
		if (is_numeric($var)): 

            if (empty($minlen)): 
			  $minlen = 0;
			endif;

			if (empty($maxlen)): 
			  return $var >= $minlen;
			endif;

			return ($var >= $minlen && $var <= $maxlen);
		elseif ($this->_checkType($var, 'string')): 

            if (!empty($maxlen) && !empty($minlen) && $this->_checkType($maxlen, 'int') && $this->_checkType($minlen, 'int')): 
                return (strlen((string) $var) >= ((int) $minlen)) && (strlen((string) $var) <= ((int) $maxlen));
			elseif (!empty($maxlen) && $this->_checkType($maxlen, 'int')): 
                return strlen((string) $var) <= ((int) $maxlen);
            elseif ($this->_checkType($minlen, 'int')): 
                return strlen((string) $var) >= ((int) $minlen);
            endif;

       endif;
       
	     return true;
     }
    /**
     * Checks to make sure the location has valid data
     *
     * @access private
     * @Since Titanium v4.0.3
     * @param string $loc the location to check for the variable
     * @param string $var the variable name to check for
     *
     * @return mixed
     */
    function _checkLocation($loc, $var) {
        switch ($loc) {
            case '_GET':
                return isset($_GET[$var]);
            case '_POST':
                return isset($_POST[$var]);
            case '_COOKIE':
                return isset($_COOKIE[$var]);
            case '_SESSION':
                session_start();
                return isset($_SESSION[$var]);
            case '_REQUEST':
                return isset($_REQUEST[$var]);
            case '_SERVER':
                return isset($_SERVER[$var]);
            case '_FILES':
                return isset($_FILES[$var]);
        }
        return false;
    }
    /**
     * Changed/Updated for PHP 8.1
     * 12/19/2022 11:21 am Ernest Allen Buffington
     *
     * Type checks variable against preg_match pattern
     *
     * @access private
     *
     * @param mixed $var the variable to type check
     * @param string $pattern the pattern to check against variable
     *
     * @return bool
     */
     function _checkMatch($var, $pattern) {
        return (bool) preg_match($pattern, (string) $var);
     }    
	 /**
	 * Updated/Changed for PHP 8.1
	 * 12/19/2022 11:19 am Ernest Allen Buffington
	 *
     * Type checks variable type
     *
     * @access private
     *
     * @param mixed $var variable to type check
     * @param string $type what to type check against variable
     *
     * @return bool
     */
    function _checkType($var, $type) {
        switch (strtolower((string) $type)) {
	            case 'bool':
                if (is_bool($var)) {
                    return true;
                }
                if (is_numeric($var)) {
                    return ($var == '1' || $var == '0');
                }
                if (is_string($var)) {
                    $var = strtolower($var);
                    return ($var == 'true' || $var == 'false');
                }
                return false;
            break;
            //
            case 'str':
            case 'string':  return is_string($var);
            //
            case 'int':
            case 'integer': {
                if (is_string($var)) {
                    if (!is_numeric($var)) {
                        return false;
                    } else {
                        return true;
                    }
                }
                return is_int($var);
            }
            //
            case 'double':
            case 'float': {
                if (is_string($var)) {
                    if (!is_numeric($var)) {
                        return false;
                    } else {
                        return true;
                    }
                }
                return is_float($var);
            }
            //
            case 'array':   return is_array($var);
            case 'object':  return is_object($var);
            case 'numeric': return is_numeric($var);
            //
            case 'url': return preg_match(REGEXP_URL, (string) $var);
             //
            case 'email':
                 //Test to make sure there is a valid domain
            if (!preg_match(REGEXP_TLD, (string) $var)) return false;
                 //Test for @ and if the structure is correct
            return (preg_match('#.*@.*\..*#', (string) $var) && preg_match(REGEXP_EMAIL, (string) $var));
            break;            //Just alpha [a-z, A-Z]
            case 'alpha': return !preg_match(REGEXP_ALPHA, (string) $var);
             //Just alphanumeric
            case 'alphanumeric': return !preg_match(REGEXP_ALPHANUMERIC, (string) $var);
             //Just alpha with spaces
             case 'alpha_space':
             case 'alphaspace': return !preg_match(REGEXP_ALPHA_SPACE, (string) $var);            
            //Alphanumeric with spaces
            case 'alphanumeric_space':
            case 'alphanumericspace': return !preg_match(REGEXP_ALPHANUMERIC, (string) $var);
         }
        return false;
    }
    /**
     * Sets up the failure
     * @Since Titanium v4.0.3
     * @access private
     * @param string $reason the reason for the failure
     * @param string $default the default value to send back
     * @return null
     */
    function _failed($reason, $default=null) {
        $this->failed = true;
        $this->reason = $reason;
        return $default;
    }
    /**
     * Changed/Updated fro PHP 8.1
     * 12/19/2022 11:26 am Ernest Allen Buffington
     *
	 * Gets the data from the location
     *
     * @access private
     * @param string $loc the location to retrieve from
     * @param string $var the variable name to retrieve
     * @return mixed
     */
    function _getLocation($loc, $var)
    {
        return match ($loc) {
            '_GET' => $_GET[$var],
            '_POST' => $_POST[$var],
            '_COOKIE' => $_COOKIE[$var],
            '_SESSION' => $_SESSION[$var],
            '_REQUEST' => $_REQUEST[$var],
            '_SERVER' => $_SERVER[$var],
            '_FILES' => $_FILES[$var],
            default => null,
        };
     }

    /**
     * Strip slashes from an array of strings
     * @Since Titanium v4.0.3
     * @access private
     * @param array $data the data array to strip slashes from
     * @return array escaped string array
     */
    function _stripSlashesArray(&$data) {
        return deepStrip($data);
    }
    /**
     * Undoes magic quotes if on
     * @Since Titanium v4.0.3
     * @access private
     * @param mixed $data the data to strip
     * @return mixed stripped variable
     */
    function _undoMagic(&$data) {
        if (empty($data)) return $data;
        static $magic_quotes;
        // if (!isset($magic_quotes)) $magic_quotes = get_magic_quotes_gpc();
        return ($magic_quotes) ? $this->_stripSlashesArray($data) : $data;
    }
    /**
     * Changed/Updated for PHP 8.1
     * 12/19/2022 11:32 am Ernest ALlen Buffington
     *
     * Checks to make sure the location passed in was valid
     *
     * @access private
     * @param string $loc the location to validate
     * @return string a valid location
     */
    function _validLocation($loc) {
        return match (strtolower((string) $loc)) {
            'get', '$_get', '_get' => '_GET',
            'post', '$_post', '_post' => '_POST',
            'cookie', '$_cookie', '_cookie' => '_COOKIE',
            'server', '$_server', '_server' => '_SERVER',
            'session', '$_session', '_session' => '_SESSION',
            'files', '$_files', '_files' => '_FILES',
            default => '_REQUEST',
        };
     }
    /**
     * Changed/Updated for PHP 8.1
     * 12/19/2022 11:43 am Ernest Allen Buffington
     *
     * Makes sure there is not any evil variables
     *
     * @param $input
     */
    function _validInput(&$input) {
        static $banned = ['_files', 
		         'http_post_files', 
				            '_env', 
				   'http_env_vars', 
				            '_get', 
				   'http_get_vars', 
				           '_post', 
				  'http_post_vars', 
				         '_cookie', 
				'http_cookie_vars', 
				         '_server', 
			    'http_server_vars', 
				        '_session', 
			   'http_session_vars', 
			             'globals', 
						'_request', 
				 'phpbb_root_path', 
				           'phpex', 
						'userinfo', 
						      'db'];
 
        foreach ($input as $k => $v) {
            if (is_array($input[$k])) {
                foreach (array_keys($input[$k]) as $k2) {
                    if (in_array(strtolower($k2), $banned)) {
                        die('Dork Alert: Input hack attempt!!');
                    }
                }
            } elseif (in_array(strtolower((string) $k), $banned)) {
                die('Dork Alert: Input hack attempt!!');
             }
        }
    }
}

global $_GETVAR;
$_GETVAR = new Titanium_Variables();
$_GETVAR->check_valid_inputTypes();

/**
 * @todo
 * @Get rid of all the garbage and update entire framework@!
 */

?>