<?php

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	exit('Access Denied');
}

function titanium_cache_delete( $name, $cat='config' ) 
{
	global $cache;
	return $cache->delete($name, $cat);
}

function titanium_cache_set( $name, $cat='config', $fileData )
{
	global $cache;
	return $cache->save($name, $cat, $fileData);
}

function titanium_cache_load($name, $cat='config')
{
	global $cache;
	return $cache->load($name, $cat);
}

function titanium_cache_clear()
{
	global $cache;
	$cache->clear();
}

function titanium_cache_resync()
{
	global $cache;
	$cache->resync();
}

?>
