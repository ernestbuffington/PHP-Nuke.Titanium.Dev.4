<?php
#########################################################################
# Network Bookmarks                                                     #
# Copyright (c) 2003 by David Moulton dave@themoultons.net              #
# http://www.themoultons.net                                            #
#                                                                       #
# This program is free software. You can redistribute it and/or modify  #
# it under the terms of the GNU General Public License as published by  #
# the Free Software Foundation; either version 2 of the License.        #
#########################################################################

if (!defined('MODULE_FILE')): 
  die ("You can't access this file directly...");
endif;

global $prefix, $db, $cookie, $user;

$userinfo = getusrinfo( $user );
$userid = $userinfo["user_id"];

if(isset($catname))
$catname=htmlentities((string) $catname);

if(isset($catcomment))
$catcomment=htmlentities((string) $catcomment);

if(!isset($catname))
$catname = '';

if(!isset($catcomment))
$catcomment = '';
 
if (!isset($userid) || $userid=="")
$userid=0;

$index = 1;

require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

if ((isset($_POST['catid']) && !empty($_POST['catid'])) && (isset($_GET['catid']) && !empty($_GET['catid']))): 
  $catid = (isset($_GET['catid']) && !stristr((string) $_GET['catid'],'..') && !stristr((string) $_GET['catid'],'://')) ? addslashes(trim((string) $_GET['catid'])) : false;
else: 
  $catid = (isset($_REQUEST['catid']) && !stristr((string) $_REQUEST['catid'],'..') && !stristr((string) $_REQUEST['catid'],'://')) ? addslashes(trim((string) $_REQUEST['catid'])) : false;
endif; 

if(isset($form_done) && $form_done == "yes"):
  if(isset($catid) && $catid != ""):
	$query = "UPDATE ".$prefix."_bookmarks_cat SET name='$catname',description='$catcomment',mod_date=now() WHERE category_id='$catid'";
  else:
	$query = "INSERT INTO ".$prefix."_bookmarks_cat (user_id,name,description,mod_date) VALUES ($userid,'$catname','$catcomment',now())";
  endif;
	$db->sql_query ($query,$db);
	header("Location: modules.php?name=$module_name");
endif;

include("header.php");

OpenTable();
echo "<span class=boxtitle><div align=center><strong>" . _ADDOREDITCATEGORY . "</strong></div></span><p>";
echo "<div align=center>[ <a href=modules.php?name=".$module_name.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</div>";
CloseTable();

OpenTable();
?>
<form method="post" action="modules.php">
<input type="hidden" name="name" value="<?=$module_name?>">
<input type="hidden" name="file" value="edit_cat">
<input type="hidden" name="form_done" value="yes">
<input type="hidden" name="catid" value='<?=$catid?>'>

<div align="center">
<table>
<tr><td><div style="float: right;"><? echo _BCATNAME ?>&nbsp;&nbsp;</div></td><td><input class="inset" type="text" name="catname" size="48" value="<?=$catname?>"></td></tr>
<tr><td></td><td>
<div style="padding-top: 6px;"></div>
</td></tr>
<tr><td><div style="float: right;"><? echo _DESCRIBECATNAME ?>&nbsp;&nbsp;</div></td><td><input class="inset" type="text" name="catcomment" size="48" maxlength="254" value="<?=$catcomment?>"></td></tr>
<tr><td></td><td>
<div style="padding-top: 6px;"></div>
</td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="<? echo _SUBMIT ?>"></td></tr>
</table>
</div>
</form>

<?php
CloseTable();

include("footer.php");

?> 

