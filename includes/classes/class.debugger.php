<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/*======================================================================= 
  Last Modified: 12/05/2022 2:12 am Ernest Allen Buffington
 =======================================================================*/
if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])):
  exit('Access Denied');
endif;

class error_handler {

    var $errors = array();
    var $debug = false;
    var $file;
    var $line;

    function __construct($debug=false) {
        if (!is_bool($debug) && $debug == 'full') {
            if(is_admin()) {
                error_reporting(E_ALL); # report all errors
                ini_set("display_errors", "1");
            } else {
                error_reporting(E_ALL ^ E_NOTICE);
            }
            $this->debug = true;
        } else if ($debug) {
            $this->debug = $debug;
            error_reporting(E_ALL ^ E_NOTICE);
        } else {
            if(!is_admin()) {
                error_reporting(0);
            }
        }
    }

    function _backtrace()
    {
        $this->file = 'unknown';
        $this->line = 0;
        if (version_compare(PHPVERS, '4.3', '>=')) {
            $tmp = debug_backtrace();
            $j = count($tmp);
            for ($i=0; $i<$j; ++$i) {
                if(basename($tmp[$i]['file']) != 'class.debugger.php') {
                    $this->file = $tmp[$i]['file'];
                    $this->line = $tmp[$i]['line'];
                    break;
                }
            }
        }
    }

    function handle_error($message, $type='Notice') {
        if ($this->debug) {
            $this->_backtrace();
            $error['message'] = $type.": ".$message." in ".$this->file." on line ".$this->line."<br />";
            $this->errors[] = $error;
        }
    }

    function return_errors() {
        if($this->debug) {
            if(is_array($this->errors)) {
                foreach ($this->errors as $key => $value) {
                    $content .= "<tr><td align='center'>".$value['message']."</td></tr>";
                }
            }
        }
        return $content;
    }

}

$debugger = new error_handler($debug);

?>