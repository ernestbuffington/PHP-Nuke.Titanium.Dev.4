<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Caching System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : class.cache.php
   Author        : JeFFb68CAM & Quake (www.Evo-Mods.com)
   Version       : 3.0.2
   Date          : 03.04.2006 (mm.dd.yyyy)

   Notes         : New cache that only uses one file
                   in order to improve overall performance.

                   Some function were derived from dragonfly cms and are
                   noted
************************************************************************/

if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

define("CACHE_OFF", 0);
define("FILE_CACHE", 1);
define("SQL_CACHE", 2);
define("XCACHE", 3);
define("APC_CACHE", 4);
define("MEMCACHED", 5);
//Must be in seconds (default = 1 week)
define("TTL", 604800);

if (!defined('CACHE_PREFIX')) {
	define('CACHE_PREFIX', '');
}

//Cache
require_once(NUKE_ZEND_DIR.'Cache.php');
//require_once(NUKE_ZENDF1_DIR.'Cache.php');


class cache 
{
    public $changed = false;
    public $saved = [];
    public $valid = false;
    public $ttl = 0;
    public $zend;

    // constructor
    function __construct($type) {
        $this->valid = ($this->type == CACHE_OFF || ($this->type == FILE_CACHE && (!is_writable(NUKE_CACHE_DIR) || ini_get('safe_mode')))) ? false : ($this->type == FILE_CACHE || $this->type == SQL_CACHE || $this->type == XCACHE || $this->type == APC_CACHE || $this->type == MEMCACHED);
        if($this->type == FILE_CACHE) {
        	$frontendOptions = ['lifetime' => 3600, 'automatic_serialization' => true];
			$backendOptions = ['cache_dir' => NUKE_CACHE_DIR];
			$this->zend = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
		} elseif($this->type == XCACHE) {
			$frontendOptions = ['lifetime' => 3600, 'automatic_serialization' => true];
			$this->zend = Zend_Cache::factory('Core', 'Xcache', $frontendOptions);
			$this->checkPrefix();
		} elseif($this->type == APC_CACHE) {
			$frontendOptions = ['lifetime' => 3600, 'automatic_serialization' => true];
			$this->zend = Zend_Cache::factory('Core', 'APC', $frontendOptions);
			$this->checkPrefix();
		} elseif($this->type == MEMCACHED) {
			$frontendOptions = ['lifetime' => 3600, 'automatic_serialization' => true];
			$this->zend = Zend_Cache::factory('Core', 'Memcached', $frontendOptions);
			$this->checkPrefix();
        } elseif($this->type == SQL_CACHE) {
            global $db, $prefix;
            /*list($saved_cache) = $db->sql_ufetchrow("SELECT cache_data FROM " . $prefix . "_config");
            @eval($saved_cache);
            $this->saved = $saved_cache;*/
        }

    }

    function clear(): bool {
		if(!$this->valid) return false;
        $this->zend->clean(Zend_Cache::CLEANING_MODE_ALL);
        return true;
    }

    // This function counts the number of rows that are in the saved cache
    function count_rows($cat = "") {
		if(!$this->valid) return false;
        $count = 0;
		
        if (!empty($cat)) {
            $count = ($this->saved[$cat]) ? count($this->saved[$cat]) : 0;
        } elseif (is_array($this->saved)) {
            foreach($this->saved as $sub) {
                            $count += is_countable($sub) ? count($sub) : 0;
                        }
        }
        return $count;
    }

    // This function passes the variable $cache_changed, and then the function resync will handle it
    function save($name, $cat='config', $fileData): bool {
        if(!$this->valid) return false;
        if(!isset($fileData)) return false;
        if(empty($fileData)) return false;
        if($fileData == false) return false;
		
		$name = str_replace([' ', '.', '-'], '_', (string) $name);
		$this->saved[$cat][$name] = $fileData;
        $this->changed = true;
        $this->zend->save($fileData, CACHE_PREFIX.$cat.'_'.$name);
        return true;
    }

    // This function loads a cache value
    function load($name, $cat='config') {
        if(!$this->valid) return false;
		
		$name = str_replace([' ', '.', '-'], '_', (string) $name);
        return $this->zend->load(CACHE_PREFIX.$cat.'_'.$name);
    }

    // This function passes the variable $cache_changed, and then the function resync will handle it
    function delete($name, $cat='config'): bool {
		if(!$this->valid) return false;
		$name = str_replace([' ', '.', '-'], '_', (string) $name);
		
		if ($name && $cat) {
      if (isset($this->saved[$cat][$name])){
               	unset($this->saved[$cat][$name]);
               	$this->changed = true;
               }
  } elseif (isset($this->saved[$cat])) {
      unset($this->saved[$cat]);
      $this->changed = true;
  }
		
		$this->zend->remove(CACHE_PREFIX.$cat.'_'.$name);
        return true;
    }

    function checkPrefix() {
    	if (CACHE_PREFIX === '') {
			DisplayError(_CACHE_PREFIX_ERROR);
       }
    }

    // This function handles changes in the cache
    function resync(): bool
    {
        //$this->clear();
        return (bool) $this->valid;
    }
}

global $use_cache;
// Set up the cache class reference
$cache = new cache($use_cache);

?>
