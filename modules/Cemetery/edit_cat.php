<?php
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");
global $titanium_prefix, $titanium_db, $cookie, $titanium_user;
$userinfo = getusrinfo( $titanium_user );
$titanium_userid = $userinfo["user_id"];
$catname=@htmlentities($catname);
$catcomment=@htmlentities($catcomment);
if (!isset($titanium_userid) || $titanium_userid == "")
$titanium_userid=0;
$index = 1;
require_once("mainfile.php");
$titanium_module_name = basename(dirname(__FILE__));
get_lang($titanium_module_name);
if ($form_done=="yes"):
	if (isset($catid) && $catid!="")
		$query = "update ".$titanium_prefix."_cemetery_cat set name='$catname',description='$catcomment',mod_date=now() where category_id='$catid'";
	else
		$query = "insert into ".$titanium_prefix."_cemetery_cat (user_id,name,description,mod_date) values ($titanium_userid,'$catname','$catcomment',now())";
	$titanium_db->sql_query ($query,$titanium_db);
	header("Location: modules.php?name=$titanium_module_name");
endif;
$pagetitle = "My Personal Bookmarks - " . _ADDOREDITCATEGORY;
include("header.php");
OpenTable();
echo "<span class=boxtitle><center><strong>" . _ADDOREDITCATEGORY . "</strong></center></span><p>";
echo "<center>[ <a href=modules.php?name=".$titanium_module_name.">". _CATEGORIES ."</a> | <a href=modules.php?name=".$titanium_module_name."&amp;file=edit_mark>"._NEWBOOKMARK."</a> ]</center>";
CloseTable();
OpenTable();
?>
<form method=post action=modules.php>
<input type=hidden name=name value='<?=$titanium_module_name?>'>
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
