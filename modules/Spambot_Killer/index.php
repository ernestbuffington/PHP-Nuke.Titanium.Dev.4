<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: Spambot Killer
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : index.php
   Author        : N/A
   Optimized by  : LombudXa (Rodmar) (www.evolved-Systems.net)
   Version       : 2.0.0
   Date          : 09.18.2005 (mm.dd.yyyy)

   Description   : Floods spambots with useless emails!
                   Spambots often get your email by harvesting it from
                   your website. This script feeds them tons of fake
                   emails until they crash, loading their database with
                   fake emails that will bounce when spammed!
                   This script has been designed for deadliness. It
                   attracts spambots with advertising keywords (you must
                   link to it first), generates about 300+ fake emails
                   and 10 links back to it (with a slightly different URL
                   each time), several kilobytes of random ASCII to
                   confuse the spambot, a limit on the number of times
                   the page is retrieved by a spambot (to limit bandwidth
                   consumption), and then sends the spambots to dozens of
                   other similar deathtraps! (So the spambot still
                   receives tons of fake emails, but the bandwidth
                   consumed is not all yours!).
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $bgcolor2;

$module_name = basename(dirname(__FILE__));
include_once(NUKE_BASE_DIR.'header.php');
get_lang($module_name);
title(_SBK);
define('INDEX_FILE', true);

/*****[BEGIN]******************************************
 [ Configuration:                                     ]
 ******************************************************/
//Keywords
$keywords = "Accounting Business Cooperatives Customer Commerce Defence Education Training Employment Email Human Resources Investing Companies Management Marketing Advertising Opportunities Small Business Big Trade Technology Free Cheap Sale Automobiles Cars";

//Words
$spamwords = $keywords;
$words = explode(" ", strtolower($spamwords));

//300 useless emails!
$numemails = 300;

//Chars
$spamchars = "a b c d e f g h i j k l m n o p q r s t u v w x y z 1 2 3 4 5 6 7 8 9 0";
$chars = explode(" ", $spamchars);

//Domains
$domains = array(".com", ".net", ".org", ".co.uk", ".nl", ".de");
srand(microtime() * 1000000);
/*****[END]********************************************
 [ Configuration:                                     ]
 ******************************************************/

//Functions
function gensalt($length) {
    global $chars;
    //mt_srand(microtime() * 1000000);
	mt_srand(0, MT_RAND_MT19937);
    $salt = "";
    for($j=0; $j<$length; $j++) {
        $salt .= $chars[mt_rand(0, count($chars) - 1)];
    }
    return $salt;
}

OpenTable();

echo '<div style="height: 50em; overflow: auto;">'.$keywords ."<p><body></p>"; //Fool targeted spambots!

$emailsserved = 0;
for($i=0; $i<$numemails; $i++) {
    $emailaddr = "";
    for($j=0; $j<mt_rand(2,3); $j++) {
        $emailaddr .= $words[mt_rand(0, count($words) - 1)];
    }

    //Append some junk to make it less likely to hit
    $emailaddr .= gensalt(mt_rand(0,6));
    $emailaddr .= "@";
    for($j=0; $j<mt_rand(2,3); $j++) {
        $emailaddr .= $words[mt_rand(0, count($words) - 1)];
    }

    //Append some junk to make the domain more unlikely to hit
    $emailaddr .= gensalt(mt_rand(0,6));
    $emailaddr .= $domains[mt_rand(0, count($domains) - 1)];
    echo "<a href=\"mailto:".$emailaddr."\">".$emailaddr."</a><br />\n";
    $emailsserved++;

    //Some bonuses
    if (mt_rand(1, 5) == 1) {
        $emailaddr = gensalt(mt_rand(7, 14)) . "@" . gensalt(mt_rand(8, 12)) . $domains[mt_rand(0, count($domains)-1)];
        echo "<a href=\"mailto:".$emailaddr."\">".$emailaddr."</a><br />\n";
        $emailsserved++;
    }

    //For real dumb spambots who don't even recognise MD5 hashes ;)
    if (mt_rand(1, 15) == 1) {
        $emailaddr = md5(mt_rand(1, 1000000)) . "@" . md5(mt_rand(1, 1000000)) . $domains[mt_rand(0, count($domains)-1)];
        echo "<a href=\"mailto:".$emailaddr."\">".$emailaddr."</a><br />\n";
        $emailsserved++;
    }
}
echo "<p>".$emailsserved. _SBK_SERVED."</p>\n";

//Don't use up too much bandwidth: limit hits by spambots
if ($counter <= 3) {
    for($i=0; $i<10; $i++) {
        //Random salt
        $salt = gensalt(30);
        echo "<a href=\"modules.php?name=Spambot_Killer&amp;count=$counter&amp;salt=$salt\">"._SBK_MORE."</a><br />\n";
    }

    //More death traps, so even though spambots can no longer eat your bandwidth there are other ways for them to get fake emails
    $death = explode(" ", "http://www.turnstep.com/cgi-bin/Infinospam.pl http://www.turnstep.com/cgi-bin/Spamthis.pl http://www.turnstep.com/cgi-bin/Shovel.pl ttp://members.hostedscripts.com/antispam.html http://www.obliquity.com/computer/spambait/loopback.html http://fantomaster.com/faantispamtip2.html http://www.towerofbabel.com/antispam/ http://mcmillan.net.nz/tackle.html http://www.unicom.com/spambait/ http://www.mts.net/~mbreault/maillist.html http://www.100megsfree3.com/bookmarks/index.htm http://www.cling.gu.se/~cl3polof/spambait.html http://www.update.uu.se/~thorild/foolmagnet/ http://www.sparkingwire.com/ http://members.sitegadgets.com/stoplavelle/email.html http://www.flame.org/st/st.cgi/Magic http://www.shadowstorm.com/cgi-bin/botbait http://web.greens.org/c/p/oo/ http://www.rts.com.au/cgi-bin/email.cgi/ http://www.fleiner.com/bots/mailtrap.shtml http://www.geocities.com/spamresources/spambots.htm http://spiders.must.die.net/a/b/a/index.htm http://www.technosoft21.com/spam.php");

    //Link to them
    if ($counter >= 2) {
        foreach($death as $dying) {
            $salt = gensalt(30);
            echo "<a href=\"".$dying."?salt=".$salt."\">".$dying."</a><br />\n";
        }
    }
}

//Shovel some junk down the throat of the spambot - try to make it crash! ;)
$limit = 8000; //Crank it up for effectiveness!
echo "<p>"._SBK_BOTS_ONLY."</p><hr />";
for($i=0; $i<$limit; $i++) {
    echo chr(mt_rand(0, 255));
    if (mt_rand(1, 25) == 1) echo "<a href=mailto:";
    if (mt_rand(1, 25) == 1) echo ">";
    if (mt_rand(1, 25) == 1) echo "</a>";
}

echo '</div>';

CloseTable();

include_once(NUKE_BASE_DIR.'footer.php');

?>