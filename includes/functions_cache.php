<?php

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	exit('Access Denied');
}

function cache_delete( $name, $cat='config' ) 
{
	global $cache;
	return $cache->delete($name, $cat);
}

function cache_set( $name, string $cat = null, $fileData )
{
	if(!isset($cat))
	$cat = 'config';

	global $cache;
	return $cache->save($name, $cat, $fileData);
}

function cache_load($name, $cat='config')
{
	global $cache;
	return $cache->load($name, $cat);
}

function cache_clear()
{
	global $cache;
	$cache->clear();
}

function cache_resync()
{
	global $cache;
	$cache->resync();
}

?>