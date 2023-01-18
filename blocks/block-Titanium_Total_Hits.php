<?php
if(!defined('NUKE_EVO')): 
  exit;
endif;

global $db, $evoconfig, $startdate;

/*
 * @count portal web hits v2.0
 * @Author Ernest Allen Buffington
 * @Date 1/18/2023 5:14 am
 **/
function block_Hits_cache($block_cachetime) {
    global $db, $cache;
	
	if(!isset($blockcache[0]['stat_created']))
	$blockcache[0]['stat_created'] = time();
	
    if ((($blockcache = $cache->load('titanium_page_visits', 'blocks')) === false) || empty($blockcache) || intval($blockcache[0]['stat_created']) < (time() - intval($block_cachetime))) {
        $blockcache = [];
		$result = $db->sql_ufetchrow('SELECT `count` FROM `'._COUNTER_TABLE.'` WHERE `type`="total" AND `var`="hits" LIMIT 1');
        //$blockcache[1]['count'] = 0;
        $blockcache[1]['count'] = $result['count'];
        $db->sql_freeresult($result);
        $blockcache[0]['stat_created'] = time();
        $cache->save('titanium_page_visits', 'blocks', $blockcache);
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