<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Journey Links Hack                                          */
/* Copyright (c) 2000 by James Knickelbein                              */
/* Journey Milwaukee (http://www.journeymilwaukee.com)                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

$module_name = basename(dirname(__FILE__));
require(NUKE_MODULES_DIR.$module_name.'/l_config.php');
$outsidevotes = 0;
$anonvotes = 0;
$outsidevoteval = 0;
$anonvoteval = 0;
$regvoteval = 0;
$truecomments = $totalvotesDB;
while($vrow = $db->sql_fetchrow($voteresult)) {
    $ratingDB = intval($vrow['rating']);
    $ratinguserDB = $vrow['ratinguser'];
    $ratingcommentsDB = stripslashes($vrow['ratingcomments']);
    if ($ratingcommentsDB=="") $truecomments--;
    if ($ratinguserDB==$anonymous) {
    $anonvotes++;
    $anonvoteval += $ratingDB;
    }
    if ($useoutsidevoting == 1) {
        if ($ratinguserDB=='outside') {
        $outsidevotes++;
        $outsidevoteval += $ratingDB;
    }
    } else {
    $outsidevotes = 0;
    }
    if ($ratinguserDB!=$anonymous && $ratinguserDB!="outside") {
    $regvoteval += $ratingDB;
    }
}
$regvotes = $totalvotesDB - $anonvotes - $outsidevotes;
if ($totalvotesDB == 0) {
    $finalrating = 0;
} else if ($anonvotes == 0 && $regvotes == 0) {
    /* Figure Outside Only Vote */
    $finalrating = $outsidevoteval / $outsidevotes;
    $finalrating = number_format($finalrating, 4);
} else if ($outsidevotes == 0 && $regvotes == 0) {
    /* Figure Anon Only Vote */
    $finalrating = $anonvoteval / $anonvotes;
    $finalrating = number_format($finalrating, 4);
} else if ($outsidevotes == 0 && $anonvotes == 0) {
    /* Figure Reg Only Vote */
    $finalrating = $regvoteval / $regvotes;
    $finalrating = number_format($finalrating, 4);
} else if ($regvotes == 0 && $useoutsidevoting == 1 && $outsidevotes != 0 && $anonvotes != 0 ) {
    /* Figure Reg and Anon Mix */
    $avgAU = $anonvoteval / $anonvotes;
    $avgOU = $outsidevoteval / $outsidevotes;
    if ($anonweight > $outsideweight ) {
    /* Anon is 'standard weight' */
    $newimpact = $anonweight / $outsideweight;
    $impactAU = $anonvotes;
    $impactOU = $outsidevotes / $newimpact;
    $finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
    $finalrating = number_format($finalrating, 4);
    } else {
    /* Outside is 'standard weight' */
    $newimpact = $outsideweight / $anonweight;
    $impactOU = $outsidevotes;
    $impactAU = $anonvotes / $newimpact;
    $finalrating = ((($avgOU * $impactOU) + ($avgAU * $impactAU)) / ($impactAU + $impactOU));
    $finalrating = number_format($finalrating, 4);
    }
} else {
    /* Registered User vs. Anonymous vs. Outside User Weight Calutions */
    $impact = $anonweight;
    $outsideimpact = $outsideweight;
    if ($regvotes == 0) {
    $regvotes = 0;
    } else {
    $avgRU = $regvoteval / $regvotes;
    }
    if ($anonvotes == 0) {
    $avgAU = 0;
    } else {
    $avgAU = $anonvoteval / $anonvotes;
    }
    if ($outsidevotes == 0 ) {
    $avgOU = 0;
    } else {
    $avgOU = $outsidevoteval / $outsidevotes;
    }
    $impactRU = $regvotes;
    $impactAU = $anonvotes / $impact;
    $impactOU = $outsidevotes / $outsideimpact;
    $finalrating = (($avgRU * $impactRU) + ($avgAU * $impactAU) + ($avgOU * $impactOU)) / ($impactRU + $impactAU + $impactOU);
    $finalrating = number_format($finalrating, 4);
}

?>