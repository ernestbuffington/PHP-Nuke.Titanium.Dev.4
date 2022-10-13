<?php

/************************************************************************/
/* PHP-NUKE: GZ Shout Admin for PHP-Nuke                                */
/* ============================================                         */
/* Copyright (c) 2004 by ZoNE&Vision                                     */
/* http://www.DestineDesigns.com                                        */
/************************************************************************/

if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
global $db, $prefix;

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {
	include("header.php");
	GraphicAdmin();
	OpenTable();

	echo"<table width=\"100%\"  border=\"1\" cellpadding=\"1\">"
	. "  <tr>"
	. "    <td><div align=\"center\"><strong>DD ShoutBox Admin </strong></div></td>"
	. "  </tr>"
	. "  <tr>"
	. "    <td><div align=\"center\"><a href=\"admin.php?op=DDshout\">Main</a> -  <a href=\"admin.php?op=DD_clearShouts\">Clear Shouts</a> - <a href=\"admin.php?op=DD_install\">Install</a> - <a href=\"admin.php?op=DD_uninstall\">Uninstall</a> </div></td>"
	. "  </tr>"
	. "  <tr>"
	. "    <td><div align=\"center\">"
	."";

	switch($op){
		case DD_install:
		echo"      <p><strong>Install DD ShoutBox </strong></p>"
		. "      <p>*Warning this will install DD ShoutBox*</p>"
		. "      <p>Do you wish to proceed?</p>"
		. "      <form name=\"form1\" method=\"post\" action=\"admin.php?op=post_install\">"
		. "        <p>"
		. "          <select name=\"CHOICE\" id=\"CHOICE\">"
		. "              <option value=\"No\">No</option>"
		. "              <option value=\"Yes\">Yes</option>"
		. "          </select>"
		. "</p>"
		. "        <p>"
		. "          <input type=\"submit\" name=\"Submit\" value=\"Proceed\">    "
		. "            </p>"
		. "      </form>"
		. "      <p>&nbsp;</p>"
		. "      <p>&nbsp;</p>"
		. "        <p>&nbsp; </p>"
		."";
		break;

		case DD_uninstall:
		echo"      <p><strong>Un-Install DD ShoutBox </strong></p>"
		. "      <p>*Warning this will uninstall DD ShoutBox*</p>"
		. "      <p>Do you wish to proceed?</p>"
		. "      <form name=\"form1\" method=\"post\" action=\"admin.php?op=post_uninstall\">"
		. "        <p>"
		. "          <select name=\"CHOICE\" id=\"CHOICE\">"
		. "              <option value=\"No\">No</option>"
		. "              <option value=\"Yes\">Yes</option>"
		. "          </select>"
		. "</p>"
		. "        <p>"
		. "          <input type=\"submit\" name=\"Submit\" value=\"Proceed\">    "
		. "            </p>"
		. "      </form>"
		. "      <p>&nbsp;</p>"
		. "      <p>&nbsp;</p>"
		. "        <p>&nbsp; </p>"
		."";
		break;

		case DD_clearShouts:
		echo"      <p><strong>Clear Shouts</strong></p>"
		. "      <p>*Warning this will erase all shouts from your database*</p>"
		. "      <p>Do you wish to proceed?</p>"
		. "      <form name=\"form1\" method=\"post\" action=\"admin.php?op=post_clear\">"
		. "        <p>"
		. "          <select name=\"CHOICE\" id=\"CHOICE\">"
		. "              <option value=\"No\">No</option>"
		. "              <option value=\"Yes\">Yes</option>"
		. "          </select>"
		. "</p>"
		. "        <p>"
		. "          <input type=\"submit\" name=\"Submit\" value=\"Proceed\">    "
		. "            </p>"
		. "      </form>"
		. "      <p>&nbsp;</p>"
		. "      <p>&nbsp;</p>"
		. "        <p>&nbsp; </p>"
		."";
		break;

		case post_install:
		if($_POST['CHOICE'] == "Yes"){
			$result = mysql_query("CREATE TABLE ". $prefix ."_shout (
PID int(15) NOT NULL auto_increment,
  UID varchar(125) default NULL,
  PDT int(11) default NULL,
  MSG mediumtext,
  IP varchar(16) NOT NULL default '',
 PRIMARY KEY  (`PID`)

) TYPE=MyISAM AUTO_INCREMENT=1");
			if ($result){
				echo"Installed";
			} else {
				echo $prefix;
				echo"Database Error";
			}
		break;
		}


		case post_uninstall:
		if($_POST['CHOICE'] == "Yes"){
			$result = $db->sql_query("DROP TABLE " . $prefix ."_shout");

			if ($result){
				echo"Uninstalled";
			} else {
				echo"Database Error";
			}
			break;
		}

		case post_clear:
		if($_POST['CHOICE'] == "Yes"){
			$result = $db->sql_query("TRUNCATE " . $prefix ."_shout");

			if ($result){
				echo"Shouts Cleared";

			} else {

				echo"Database Error";
			}
			break;
		}



		default:


		echo"      <p align=\"center\"><strong>Welcome to the DD ShoutBox Admin Control Panel!"
		. "      </strong></p>      <p align=\"center\">From here you can Install or Uninstall the DD ShoutBox System; and Clear the DD ShoutBox Content.</p>"
		. "      <p align=\"center\">I hope you enjoy using this system, as much as I did producing this!</p>"
		. "      <p align=\"center\">Enjoy!</p>"
		. "      <p align=\"center\"><a href=\"http://www.DestineDesigns.com\" target=\"_blank\">Destine Designs</a></p>"
		. "	  </div>"
		."";
	}

} else {
	echo "Access Denied";
}
echo"</div></td>"
. "  </tr>"
. "</table>"
."";
CloseTable();
include("footer.php");


?>