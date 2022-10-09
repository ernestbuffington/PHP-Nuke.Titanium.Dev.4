<?php
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");
global $prefix, $db, $cookie, $user;
$userinfo = getusrinfo( $user );
$userid = $userinfo["user_id"];
$catname=@htmlentities($catname);
$catcomment=@htmlentities($catcomment);
if (!isset($userid) || $userid == "")
$userid=0;
$index = 1;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if ($form_done=="yes"):
	if (isset($catid) && $catid!="")
		$query = "update ".$prefix."_cemetery_cat set name='$catname',description='$catcomment',mod_date=now() where category_id='$catid'";
	else
		$query = "insert into ".$prefix."_cemetery_cat (user_id,name,description,mod_date) values ($userid,'$catname','$catcomment',now())";
	$db->sql_query ($query,$db);
	header("Location: modules.php?name=$module_name");
endif;
$pagetitle = "My Personal Bookmarks - " . _ADDOREDITCATEGORY;
include("header.php");
OpenTable();
echo "<span class=boxtitle><center><strong>" . _ADDOREDITCATEGORY . "</strong></center></span><p>";
echo "<center>[ <a href=modules.php?name=".$module_name.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</center>";
CloseTable();
OpenTable();
?>
<form method=post action=modules.php>
<input type=hidden name=name value='<?=$module_name?>'>
<input type=hidden name=file value='edit_cat'>
<input type=hidden name=form_done value='yes'>
<input type=hidden name=catid value='<?=$catid?>'>
<table align=center>
<tr><td><? echo _CEMETERY_NAME ?></td><td><input class=inset type=text name=catname value='<?=$catname?>'></td></tr>
<tr><td><? echo _CEMETERY_CATEGORY_DESCRIPTION ?></td><td><input class=inset type=text name=catcomment size=48 maxlength=254 value='<?=$catcomment?>'></td></tr>
<tr><td>&nbsp;</td><td><input type=submit value="<? echo _SAVE ?>"></td></tr>
</table>
</form>
<?php
CloseTable();
include("footer.php");
?> 
