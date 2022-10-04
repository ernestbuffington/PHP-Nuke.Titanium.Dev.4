<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NSN News                                             */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://nukescripts.86it.us                           */
/* Copyright (c)2000-2005 by NukeScripts Network         */
/********************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

function blogs_save_config($config_name, $config_value){
    global $pnt_prefix, $pnt_db, $cache;
    $pnt_db->sql_query("UPDATE ".$pnt_prefix."_nsnne_config SET config_value='$config_value' WHERE config_name='$config_name'");
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $cache->delete('blogs', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
}

function blog_get_configs(){
    global $pnt_prefix, $pnt_db, $cache;
    static $config;
    if(isset($config)) return $config;
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    if(($config = $cache->load('blogs', 'config')) === false) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $configresult = $pnt_db->sql_query("SELECT config_name, config_value FROM ".$pnt_prefix."_nsnne_config");
        while (list($config_name, $config_value) = $pnt_db->sql_fetchrow($configresult)) {
            $config[$config_name] = $config_value;
        }
        $pnt_db->sql_freeresult($configresult);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $cache->save('blogs', 'config', $config);
    }
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    return $config;
}

function automated_blogs() 
{
    global $pnt_prefix, $multilingual, $currentlang, $pnt_db;
    
	$result = $pnt_db->sql_query('SELECT * FROM '.$pnt_prefix.'_autonews WHERE datePublished<="'.date('Y-m-d G:i:s', time()).'"');
    
	while ($row2 = $pnt_db->sql_fetchrow($result)) 
	{
        $title = addslashes($row2['title']);
        $hometext = addslashes($row2['hometext']);
        $bodytext = addslashes($row2['bodytext']);
        $notes = addslashes($row2['notes']);

        $pnt_db->sql_query("INSERT INTO ".$pnt_prefix."_stories VALUES (NULL, 
		                                              '$row2[catid]', 
													    '$row2[aid]', 
														    '$title', 
											  '$row2[datePublished]',
											   '$row2[dateModified]', 
													     '$hometext', 
														 '$bodytext', 
														         '0', 
																 '0', 
													  '$row2[topic]', 
												  '$row2[informant]', 
												            '$notes', 
													  '$row2[ihome]', 
												  '$row2[alanguage]', 
												      '$row2[acomm]', 
													             '0', 
																 '0', 
																 '0', 
																 '0', 
												 '$row2[associated]', 
												                 '0', 
																 '1')");
    }
    if ($pnt_db->sql_numrows($result)) 
	{
        $pnt_db->sql_query('DELETE FROM '.$pnt_prefix.'_autonews WHERE datePublished<="'.date('Y-m-d G:i:s', time()).'"');
    }
    $pnt_db->sql_freeresult($result);
}

?>