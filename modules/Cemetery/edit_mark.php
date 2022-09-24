<?php
if (!defined('MODULE_FILE')) die ("You can't access this file directly...");
global $titanium_prefix, $titanium_db, $cookie, $titanium_user;
if((isset($_POST['popup']) && !empty($_POST['popup'])) && (isset($_GET['popup']) && !empty($_GET['popup']))) 
$popup = (isset($_GET['popup']) && !stristr($_GET['popup'],'..') && !stristr($_GET['popup'],'://')) ? addslashes(trim($_GET['popup'])) : false;
else 
$popup = (isset($_REQUEST['popup']) && !stristr($_REQUEST['popup'],'..') && !stristr($_REQUEST['popup'],'://')) ? addslashes(trim($_REQUEST['popup'])) : false;
$userinfo = getusrinfo($titanium_user);
$titanium_userid = $userinfo["user_id"];
$markurl=@htmlentities($markurl);
$markname=@htmlentities($markname);
$markcomment=@htmlentities($markcomment);
if (!isset($titanium_userid) || $titanium_userid == "")
$titanium_userid=0;
$index = 1;
require_once("mainfile.php");
$titanium_module_name = basename(dirname(__FILE__));
get_lang($titanium_module_name);
if ((isset($_POST['markid']) && !empty($_POST['markid'])) && (isset($_GET['markid']) && !empty($_GET['markid']))) 
$markid = (isset($_GET['markid']) && !stristr($_GET['markid'],'..') && !stristr($_GET['markid'],'://')) ? addslashes(trim($_GET['markid'])) : false;
else 
$markid = (isset($_REQUEST['markid']) && !stristr($_REQUEST['markid'],'..') && !stristr($_REQUEST['markid'],'://')) ? addslashes(trim($_REQUEST['markid'])) : false;
if ($form_done=="yes" && (isset($catid) && $catid != "")):
	if (!isset($popup))
		$popup=1;
	if (isset($markid) && $markid != "")
		$query = "update ".$titanium_prefix."_cemetery set name='$markname',url='$markurl',category_id=$catid,description='$markcomment',mod_date=now(),popup=$popup where id=$markid";
	else
		$query = "insert into ".$titanium_prefix."_cemetery (user_id,category_id,name,url,description,mod_date,popup) values ($titanium_userid,$catid,'$markname','$markurl','$markcomment',now(),$popup)";
	$titanium_db->sql_query ($query,$titanium_db);
	$catquery = "update " . $titanium_prefix . "_cemetery_cat set mod_date=now() where category_id=$catid";
	$titanium_db->sql_query ($catquery,$titanium_db);
	header("Location: modules.php?name=$titanium_module_name&file=marks&category=$catid");
elseif ($form_done=="yes" && (!isset($catid) || $catid=="")):
	$pagetitle = "My Personal Bookmarks - "._ADDOREDITBOOKMARK;
	include("header.php");
	OpenTable();
	echo "<span class=\"boxtitle\"><center><strong>". _ADDOREDITBOOKMARK."</strong></center></span><p>";
	echo "<font color=red>"._ERROR.": "._NEEDGROUP."</font>";
	CloseTable();
	exit();
endif; 
$pagetitle = "My Personal Bookmarks - " . _ADDOREDITBOOKMARK;
include("header.php");
OpenTable();
echo "<span class=\"boxtitle\"><center><strong>" .  _ADDOREDITBOOKMARK . "</strong></center></span><p>";
echo "<center>[ <a href=modules.php?name=".$titanium_module_name.">"._CATEGORIES."</a> | <a href=modules.php?name=".$titanium_module_name."&amp;file=edit_cat>"._NEWCATEGORY."</a> ]</center>";
CloseTable();
OpenTable();
?>
<form method=post action=modules.php>
<input type=hidden name=name value='<?=$titanium_module_name?>'>
<input type=hidden name=file value='edit_mark'>
<input type=hidden name=form_done value='yes'>
<input type=hidden name=markid value='<?=$markid?>'>
<table align=center>
<tr><td><? echo _CATEGORY ?></td><td><select name=catid>
<?
$getcatquery = "select * from " . $titanium_prefix . "_cemetery_cat where user_id=$titanium_userid order by name";
$cat_ret = $titanium_db->sql_query  ($getcatquery,$titanium_db);
for ($i=0;$i<$titanium_db->sql_numrows ($cat_ret,$titanium_db);$i++):
	$catrow = $titanium_db->sql_fetchrow($cat_ret);
	echo "<option value='".$catrow['category_id']."' ";
	if ($catid == $catrow['category_id'])
		echo "SELECTED";
	echo ">".$catrow['name']."\n";
endfor;
$titanium_db->sql_freeresult($cat_ret);
?>
</select> &nbsp; 
<?
if ($i==0)
echo "<a href=modules.php?name=".$titanium_module_name."&amp;file=edit_cat>"._NEEDGROUP."</a>";
?>
</td></tr>
<tr><td><? echo _NAME ?></td><td><input class=inset size=48 type=text name=markname value="<?=$markname?>"></td></tr>
<?
if (!isset($markurl) || $markurl == ""):
 global $titanium_db;
 list($markurl) = $titanium_db->sql_ufetchrow("SELECT `url` FROM `".$titanium_prefix."_cemetery` WHERE `id`='$markid'", SQL_NUM);
 $markurl=@htmlentities($markurl);
	   $popup=1;
endif;
?>
<tr><td><? echo _URL ?></td><td><input class=inset type=text name=markurl value="<?=$markurl?>" size=48></td></tr>
<tr><td><? echo _COMMENT ?></td><td><input class=inset type=text name=markcomment size=48 maxlength=254 value="<?=$markcomment?>"></td></tr>
<tr><td>&nbsp;</td><td><input type=hidden name=popup value="1" <?if ($popup==1 || !isset($popup)){echo "CHECKED";}?>></td></tr>
<tr><td>&nbsp;</td><td><input type=submit value="<? echo _SAVE ?>"></td></tr>
</table>
</form>
<?php
CloseTable();
include("footer.php");
?> 
