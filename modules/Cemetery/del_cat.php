<?php
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");
global $pnt_prefix, $pnt_db, $cookie, $pnt_user;
$index = 1;
require_once("mainfile.php");
$pnt_module = basename(dirname(__FILE__));
get_lang($pnt_module);
$userinfo = getusrinfo( $pnt_user );
$pnt_userid = $userinfo["user_id"];
$catname=@htmlentities($catname);
if (!isset($pnt_userid) || $pnt_userid == "")
$pnt_userid=0;
# If no was pressed
if (isset($action) && $action==_NO)
Header("Location: modules.php?name=".$pnt_module);
# If yes was pressed
if (isset($action)  && $action==_YES && isset($catid) && $catid!=""):
	$delmarksquery = "delete from ".$pnt_prefix."_cemetery where category_id=$catid AND user_id=$pnt_userid";
	$delcatquery   = "delete from ".$pnt_prefix."_cemetery_cat where category_id=$catid AND user_id=$pnt_userid";
	$pnt_db->sql_query ($delmarksquery,$pnt_db);
	$pnt_db->sql_query ($delcatquery,$pnt_db);
	Header("Location: modules.php?name=".$pnt_module);
endif;
$pagetitle = " - " . _DELETECATEGORY;
include("header.php");
OpenTable();
echo "<center><span class=storytitle>"._DELETECATEGORY."</span></center><P>\n";
echo "<center><a href=modules.php?name=".$pnt_module.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_mark>"._NEWBOOKMARK."</a></center>";
CloseTable();
OpenTable();
?>
<center><? echo _DELETECATEGORYCONFIRM ?> '<?=$catname?>'?<p> <strong><? echo _BOOKMARKSDELETED ?></strong><p>
<p>
<form action=modules.php>
<input type=hidden name=name value="<?=$pnt_module?>">
<input type=hidden name=file value="del_cat">
<input type=hidden name=catid value="<?=$catid?>">
<input type=submit name=action value="<? echo _YES?>">&nbsp;&nbsp;&nbsp;<input type=submit name=action value="<? echo _NO ?>">
</form>
</center>
<?
CloseTable();
include("footer.php");
?> 
