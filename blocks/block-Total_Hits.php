<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   2.1.0
 Nuke-Evo Version       :   RC3
 Nuke-Evo Build         :   463
 Nuke-Evo Patch         :   0
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   04-May-2009

 Copyright (c) 2007 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $db, $evoconfig, $startdate;

function block_Hits_cache($block_cachetime) {
    global $db, $cache;
	
	$blockcache = [];
	
	if(!isset($blockcache[0]['stat_created']))
	$blockcache[0]['stat_created'] = '';
	
    if ((($blockcache = $cache->load('hits', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $result = $db->sql_ufetchrow('SELECT `count` FROM `'._COUNTER_TABLE.'` WHERE `type`="total" AND `var`="hits" LIMIT 1');
        $blockcache[1]['count'] = $result['count'];
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('hits', 'blocks', $blockcache);
    }
    return $blockcache;
}

$blocksession = block_Hits_cache($evoconfig['block_cachetime']);

$content = "<div style='text-align: center; width: 100%;'>\n";
if (empty($blocksession[1]['count'])) {
    $content .= "<p style='text-align:center;'>"._BLOCKPROBLEM2."</p>\n";
} else {
    $content .= "<p style='text-align: center;'>"._WERECEIVED."</p>\n";
    $content .= "<p style='text-align: center; font-weight: bold; font-size: large;'><a href='modules.php?name=Statistics'>".number_format ( $blocksession[1]['count'] , 0 , "." , "," )."</a></p>";
    $content .= "<p style='text-align: center;'>"._PAGESVIEWS."&nbsp;".$startdate."</p>\n";
}
$content .= "</div>\n";

?>