<?php
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");
global $titanium_prefix, $titanium_db, $cookie, $titanium_user;
$index = 1;
require_once("mainfile.php");
$pnt_module = basename(dirname(__FILE__));
get_lang($pnt_module);
$userinfo = getusrinfo($titanium_user);
$titanium_userid = $userinfo["user_id"];
$markname=@htmlentities($markname);
if (!isset($titanium_userid) || $titanium_userid == "")
$titanium_userid=0;
# If no was pressed
if (isset($action) && $action==_NO)
Header("Location: modules.php?name=".$pnt_module."&file=marks&category=".$catid."&catname=".$catname);
# If yes was pressed
if(isset($action) && $action==_YES && isset($catid) && $catid != ""):
	$delmarksquery = "delete from ".$titanium_prefix."_cemetery where id=$markid AND user_id=$titanium_userid";	
	$titanium_db->sql_query ($delmarksquery,$titanium_db);
	$updatecatquery = "update ".$titanium_prefix."_cemetery_cat set mod_date=now() where category_id=$catid";
	$titanium_db->sql_query ($updatecatquery,$titanium_db);
	Header("Location: modules.php?name=".$pnt_module."&file=marks&category=".$catid."&catname=".$catname);
endif;
$pagetitle = _DELETEBOOKMARK;
include("header.php");
OpenTable();
echo "<center><span class=storytitle>"._DELETEBOOKMARK."</span></center><P>\n";
echo "<center><a href=modules.php?name=".$pnt_module.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_cat>"._NEWCATEGORY."</a> | <a href=modules.php?name=".$pnt_module."&amp;file=edit_mark>"._NEWBOOKMARK."</a></center>";
CloseTable();
OpenTable();
?>
<center><? echo _DELETEBOOKMARKCONFIRM ?> '<?=$markname?>'?<p>
<p>
<form action=modules.php>
<input type=hidden name=name value="<?=$pnt_module?>">
<input type=hidden name=file value="del_mark">
<input type=hidden name=catid value="<?=$catid?>">
<input type=hidden name=catname value="<?=$catname?>">
<input type=hidden name=markid value="<?=$markid?>">
<input type=submit name=action value="<? echo _YES ?>">&nbsp;&nbsp;&nbsp;<input type=submit name=action value="<? echo _NO ?>">
</form>
</center>
<?
CloseTable();
include("footer.php");
?> 
