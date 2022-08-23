<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************************************************/
/* CNB Your Account: An Advanced User Management System for phpnuke             */
/* ============================================                                 */
/*                                                                              */
/* Copyright (c) 2004 by Comunidade PHP Nuke Brasil                             */
/* http://dev.phpnuke.org.br & http://www.phpnuke.org.br                        */
/*                                                                              */
/* Contact author: escudero@phpnuke.org.br                                      */
/* International Support Forum: http://ravenphpscripts.com/forum76.html         */
/*                                                                              */
/* This program is free software. You can redistribute it and/or modify         */
/* it under the terms of the GNU General Public License as published by         */
/* the Free Software Foundation; either version 2 of the License.               */
/*                                                                              */
/*********************************************************************************/
/* CNB Your Account it the official successor of NSN Your Account by Bob Marion    */
/*********************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

# enter your domain name here to add an extra layer of protection or leave blank.
# example shows how to use this with a subdomain
//define("CNBYA_DOMAINNAME", "$nukeurl");

# no www or http just the domain name 
# remove the '//' from the next two lines and insert your domain name for additional security
# (don't put 'http://' in front of it, your domain name only!
//define("CNBYA_DOMAINNAME", "");
//if (($_SERVER["SERVER_NAME"] != CNBYA_DOMAINNAME OR $_SERVER["SERVER_NAME"] != CNBYA_DOMAINNAME) AND CNBYA_DOMAINNAME != "") {
//   exit();
//}

define('CNBYA', true);

?>