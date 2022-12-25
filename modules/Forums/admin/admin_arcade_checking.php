<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *                            admin_arcade_checking.php
 *                            -------------------------
 *
 *   PHPNuke Ported Arcade - http://www.nukearcade.com
 *   Original Arcade Mod phpBB by giefca - http://www.gf-phpbb.com
 *
 *  Version 1.0  01 Dec 2004  by Rica
 * 
 ***************************************************************************/

if (!defined('IN_PHPBB')) define('IN_PHPBB', true);

if( !empty($setmodules) )
{
  $file = basename(__FILE__);
  $module['Arcade_Admin']['Settings_check'] = $file;
  return;
}

$root_path = "./../../../";
$phpbb_root_path = "./../";

require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

$problemcount=0;
$tableproblem=0;
$fileuploadproblem=0;

echo "<div><h1>Arcade Checking</h1>\n"
    ."<p>This function will search and check for frequent errors during Arcade Mod V3+ Installation.</p>"
    ."</div>";
echo "<table cellpadding=\"4\" align=\"center\" border=\"1\">";

//
// UPLOAD CHECKING
//

$filechecklist=array(
                "arcade.php",
                "blocks/block-Arcade.php",
                "blocks/block-Titanium_Arcade_Center.php",
                "images/arcade_mod/arcade_logo.png",
                "includes/functions_arcade.php",
                "modules/Forums/arcade.php",
                "modules/Forums/arcade_search.php",
                "modules/Forums/comments.php",
                "modules/Forums/comments_list.php",
                "modules/Forums/comments_new.php",
                "modules/Forums/commentspopup_new.php",
                "modules/Forums/games.php",
                "modules/Forums/gamespopup.php",
                "modules/Forums/hall_of_fame.php",
                "modules/Forums/headingarcade.php",
                "modules/Forums/proarcade.php",
                "modules/Forums/scoreboard.php",
                "modules/Forums/statarcade.php",
                "modules/Forums/toparcade.php",
                "modules/Forums/whoisplaying.php",
                "modules/Forums/admin/admin_arcade.php",
                "modules/Forums/admin/admin_arcade_add.php",
                "modules/Forums/admin/admin_arcade_auth.php",
                "modules/Forums/admin/admin_arcade_comments.php",
                "modules/Forums/admin/admin_arcade_games.php",
                "modules/Forums/admin/arcade_elmt.php",
                "modules/Forums/gf_funcs/gen_funcs.php",
                "modules/Forums/games/pics/arcade.gif",
                "modules/Forums/language/lang_english/lang_main_arcade.php",
                "modules/Forums/language/lang_english/lang_admin_arcade.php",
                "modules/Forums/templates/subSilver/admin/admin_arcade_comments_body.tpl",
                "modules/Forums/templates/subSilver/admin/admin_edit_comments_body.tpl",
                "modules/Forums/templates/subSilver/admin/admin_edit_games.tpl",
                "modules/Forums/templates/subSilver/admin/arcade_add_body.tpl",
                "modules/Forums/templates/subSilver/admin/arcade_cat_delete_body.tpl",
                "modules/Forums/templates/subSilver/admin/arcade_cat_manage_body.tpl",
                "modules/Forums/templates/subSilver/admin/arcade_catedit_body.tpl",
                "modules/Forums/templates/subSilver/admin/arcade_config_body.tpl",
                "modules/Forums/templates/subSilver/admin/arcade_manage_body.tpl",
                "modules/Forums/templates/subSilver/admin/auth_arcade_body.tpl",
                "modules/Forums/templates/subSilver/images/couronne.gif",
                "modules/Forums/templates/subSilver/images/delfavs.gif",
                "modules/Forums/templates/subSilver/images/favs.gif",
                "modules/Forums/templates/subSilver/images/loupe.gif",
                "modules/Forums/templates/subSilver/images/scoreboard.gif"
                        );

echo "    <tr>\n"
    ."        <th colspan=2>Files Uploaded Checking</th>\n"
    ."    </tr>\n"
    ."    <tr>\n"
    ."        <td align=\"center\" width=\"150\"><strong>Filename</strong></td><td align=\"center\"><strong>Status</strong></th>\n"
    ."    </tr>\n";
$filetotal=0;
$fileok=0;    
foreach($filechecklist as $filename){
    $filetotal++;
    if (file_exists($root_path.$filename)) {

        $fileok++;
    }else {
        echo "<tr><td>ROOT/$filename</td>";
        $problemcount++;
        $fileuploadproblem++;
        echo "<td align=\"center\"> &lt;)- FAILED - File doesn't exist -(&gt;";
    }
    echo "</tr>\n";
}
echo "<tr><td colspan=2><strong>$fileok files found , $fileuploadproblem not found for a Total of $filetotal files checked</strong></td></tr>";
echo "<tr><td align=\"center\" colspan=2><u>Files Uploaded Checking</u>: ".($fileuploadproblem==0?"OK":"<strong>Failed</strong>")."</td></tr>";
echo "<tr><td colspan=2><em>Note: Templates of your THEME(s) have <strong>not</strong> been checked</td></tr>";

//                     
// PHP-NUKE FILE'S EDIT CHECKING
//

echo "    <tr>\n"
    ."        <th colspan=2>PhpNuke File Edit's,  Basic Checking</th>\n"
    ."    </tr>\n"
    ."    <tr>\n"
    ."        <td align=\"center\" width=\"150\"><strong>Filename</strong></td><td align=\"center\"><strong>Status</strong></th>\n"
    ."    </tr>\n";

$fileeditproblem=0;
$fileeditchecking=array("index.php"=>"#Arcade MOD - IBProSupport#",
                        "includes/constants.php"=>"#PAGE_SCOREBOARD#",
                        "modules/Forums/admin/index.php"=>"#case PAGE_GAME:#",
                        "modules/Forums/admin/admin_users.php"=>"#game_highuser = 0 ;#");
foreach($fileeditchecking as $file=>$pattern){
    $fp=fopen($root_path.$file, "r");
    $file_content = fread($fp, filesize($root_path.$file));
    echo "<tr><td>ROOT/$file</td>";
    if (preg_match($pattern,$file_content)) {
        echo "<td align=\"center\"> OK</td>";
    }else
    {
    $fileeditproblem++;
    echo "<td align=\"center\"> &lt;)- FAILED - File doesn't seem to be edited -(&gt;";
    }
    fclose($fp);
}
echo "<tr><td align=\"center\" colspan=2><u>File Edit Checking</u>: ".($fileeditproblem==0?"OK":"<strong>Failed</strong>")."</td></tr>";

//
// DATABASE CHECKING
//

echo "    <tr>\n"
    ."        <th colspan=2>Database Checking</th>\n"
    ."    </tr>\n"
    ."    <tr>\n"
    ."        <td align=\"center\" width=\"150\"><strong>Tablename</strong></td><td align=\"center\"><strong>Status</strong></th>\n"
    ."    </tr>\n";
$tablecheck=array(GAMES_TABLE,SCORES_TABLE,GAMEHASH_TABLE,ARCADE_CATEGORIES_TABLE,ARCADE_TABLE,AUTH_ARCADE_ACCESS_TABLE,COMMENTS_TABLE,ARCADE_FAV_TABLE);
foreach($tablecheck as $tablename){
    echo "<tr><td>$tablename</td>";
    $SQL="SELECT COUNT(*) FROM $tablename";
    $result=$db->sql_query($SQL);
    if ($result) 
        echo "<td align=\"center\"> OK</td>";
    else {
        $problemcount++;
        $tableproblem++;
        echo "<td align=\"center\"> &lt;)- FAILED - Table doesn't exist -(&gt;";
    }
    echo "</tr>\n";
}
echo "<tr><td align=\"center\" colspan=2><u>Database Checking</u>: ".($tableproblem==0?"OK":"<strong>Failed</strong>")."</td></tr>";

//
// PHPBB PREFERENCE CHECKING
//

echo "    <tr>\n"
    ."        <th colspan=2>phpBB Preferences Checking</th>\n"
    ."    </tr>\n"
    ."    <tr>\n"
    ."        <td align=\"center\" width=\"150\"><strong>Name</strong></td><td align=\"center\"><strong>Status</strong></td>\n"
    ."    </tr>\n";
echo "<tr><td>phpBB Pref - Script Path:<br />\"<strong>".$board_config['script_path']."</strong>\"</td>";
echo "<td align=\"center\">".($board_config['script_path']=="/modules/Forums/"?" OK":"<strong>Potential problem</strong>:<br />\"/modules/Forums/\" expected")."</td></tr>";

echo "<tr><td>phpBB Pref - Server Name:<br />\"<strong>".$board_config['server_name']."</strong>\"</td>";

//
echo "<td align=\"center\">";
if (preg_match("@http:\/\/@i",$board_config['server_name'])) {
    echo "<strong>*</strong>Server name should not contain \"http://\" prefix.";
} else {
    echo " OK";
}
echo "</td>";

echo "<tr><td>phpBB Pref - Cookie Domain:<br />\"<strong>".$board_config['cookie_domain']."</strong>\"</td>";
echo "<td align=\"center\">".(($board_config['cookie_domain']=="" or $board_config['cookie_domain']==$board_config['server_name'])?" OK":"<strong>Failed</strong> Empty value or <strong>".$board_config['server_name']."</strong> expected.")."</td></tr>";
if ($board_config['cookie_domain']=="" or $board_config['cookie_domain']==$board_config['server_name']) {
    
}else {$problemcount++;}

echo "<tr><td>phpBB Pref - Cookie Path:<br />\"<strong>".$board_config['cookie_path']."</strong>\"</td>";
echo "<td align=\"center\">".($board_config['cookie_path']=="/" ?" OK":"<strong>Failed</strong> \"<strong>/</strong>\" expected.")."</td></tr>";
if (!$board_config['cookie_path']=="/") {
    $problemcount++;    
}
echo "    <tr>\n"
    ."        <th colspan=2>Admin User ID Checking</th>\n"
    ."    </tr>\n"
    ."    <tr>\n"
    ."        <td align=\"center\" width=\"150\"><strong>Name</strong></td><td align=\"center\"><strong>Status</strong></td>\n"
    ."    </tr>\n";

$sql = "SELECT user_level FROM " . USERS_TABLE . " WHERE user_id = 2";
$row = $db->sql_fetchrow($db->sql_query($sql));
if (empty($row))
{
echo "<tr><td>Admin User ID Check</td>";
echo "<td align=\"center\"><strong>Failed</strong> no user_id = 2.</td></tr>";
$problemcount++;
}
else
{
echo "<tr><td>Admin User ID Check</td>";
echo "<td align=\"center\">".($row['user_level']=="2" ?" OK":"<strong>Failed</strong> user_id (2) is not admin.")."</td></tr>";
if (!$row['user_level']=="2") {
    $problemcount++;
}
}

echo "    <tr>\n"
    ."        <th colspan=2>Checking Results</th>\n"
    ."    </tr>\n"
    ."    <tr>\n"
    ."        <td colspan=2>".(($problemcount==0)?" Installation seems OK":"There is $problemcount potential errors in your installation")."</td>"
    ." </tr>";

echo "</table>";

include('./page_footer_admin.'.$phpEx);
?>
