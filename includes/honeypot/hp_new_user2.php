<?php
/************************************************************************/
/* Nuke HoneyPot - Antibot Script                                       */
/* ==============================                                       */
/*                                                                      */
/* Copyright (c) 2013 - 2014 coRpSE                                     */
/* http://www.headshotdomain.net                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
global $prefix, $db, $currentlang;
if (file_exists(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php')) {
	include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-'.$currentlang.'.php');
} else {
	include_once(NUKE_ADMIN_DIR.'language/Honeypot/lang-english.php');
}
	$result1 = $db->sql_query("SELECT usehp, check3, check3time FROM ".$prefix."_honeypot_config");
	list($usehp, $check3, $check3time) = $db->sql_fetchrow($result1);

if ($usehp == 1){
 if ($check3 == 1){

echo "<tr><td bgcolor='$bgcolor1' colspan='2' width='100%'><p align=\"center\" id=\"countdown-1\"><strong>"._HONEYPOT_ANTIBOTWAIT."</strong>, "._HONEYPOT_PLEASEDONTCLICK." $check3time "._HONEYPOT_SECONDS."</p>
<script>
    var countdown = document.getElementById('countdown-1'),
    passed    = 0,
    seconds   = $check3time;

function countdownTimer() {
        // If the total amount of time passed matches or is greater than the amount of time
        // we expect to stay idle for then we can probably assume the person using the form
        // is a human not a stupid BOT
        if (passed >= seconds) {
                countdown.innerHTML = '<strong>"._HONEYPOT_COUNTDOWNDONE."</strong>';

                // Clear the countdown interval
                clearInterval(itv);
                return;
        }

        var wait = seconds - passed,
            wait = (wait < 10) ? ('0' + wait) : wait;

        // Update the total number of seconds remaining until the countdown is done
        countdown.innerHTML = '<strong>"._HONEYPOT_ANTIBOTWAIT."</strong>, "._HONEYPOT_PLEASEDONTCLICK." ' + wait + ' "._HONEYPOT_SECONDS."';

        // Increment the total amount of time passed
        passed++;
}

// Start the countdown timer
var itv = setInterval(countdownTimer, 1000);
</script></td></tr>" , PHP_EOL;
 }
}
?>