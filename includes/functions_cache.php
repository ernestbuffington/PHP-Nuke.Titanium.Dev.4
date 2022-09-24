<?php

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	exit('Access Denied');
}

function titanium_cache_delete( $name, $cat='config' ) 
{
	global $titanium_cache;
	return $titanium_cache->delete($name, $cat);
}

function titanium_cache_set( $name, $cat='config', $fileData )
{
	global $titanium_cache;
	return $titanium_cache->save($name, $cat, $fileData);
}

function titanium_cache_load($name, $cat='config')
{
	global $titanium_cache;
	return $titanium_cache->load($name, $cat);
}

function titanium_cache_clear()
{
	global $titanium_cache;
	$titanium_cache->clear();
}

function titanium_cache_resync()
{
	global $titanium_cache;
	$titanium_cache->resync();
}

?>
