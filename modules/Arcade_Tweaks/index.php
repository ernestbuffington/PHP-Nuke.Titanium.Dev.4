<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/**
 * 
 * @version 1.0
 * @copyright 16 September 2004
 */
/**
 * 
 * 
 * Arcade Tweaks 1.0 RC2
 * 
 *         There was 2 "bigs" bugs in the RC1
 *                 - links was "linked" to the root.. so didnt work on nuke system not
 *                 installed in the root directory of the server.
 *                 - For people that had the Comment Mod of JRSweet installed, Comments wasn't
 *                  added and could cause an "error of authentification" when user tried to 
 *                 submit comment.
 *                     NB: Look the Tools menu , there is a little function to fix that.. :)
 *     
 *   - release candidate version 2
 *   - Installation
 *   - Upload html/* to your root directory
 *   - Go to your Nuke Modules admin panel and activate Arcade Tweaks
 *   - You should change default permission in Admin panel for "Administrator"
 *     you can also set it AS "invisible". (BTW , there is a Admin check so 
 *        shouldnt be a problem)
 * 
 *      If you have already installed the Pre-release... Just overwrite yours files.
 *   (NB: There is 2 mores little gif files in images)
 * 
 *   Author : Rica http://www.thehorde.be
 *   Date: 13 September2004 
 * 
 *   Thanks to the original author of this arcade package and to the team from 
 *   http://www.portedmods.com .
 *                                   Phantomk, JRSweets ,TheSwede, barcrest
 * 
 * 
 *     I cant stop to add stuff right now.... :( too much ideas for this module...
 *  But i will wait for the V3.01 of the Arcade Mod before adding anything "heavy".
 *  Please Feel free to contact me on http://www.portedmods.com or on 
 *     http://www.thehorde.be for bugs, questions, and frengrish translation ;)
 * 
 * don't worry about the file size... I love "comments" ... 
 */ 

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       09/20/2005
 ************************************************************************/

if (!defined('MODULE_FILE')) {
    die('You can\'t access this file directly...');
}

define('NUKE_BASE_MODULES', preg_replace('/modules/i', '', dirname(dirname(__FILE__))));

require_once(NUKE_BASE_MODULES.'mainfile.php');

$ArcadeTweaksVersion = "1.0 RC2";

$module_name = basename(dirname(__FILE__));
// First security check... Module allowed only to administrator.
global $admin;

// The following paths are my "standart one"... check that they're yours also...
define('INDEX_FILE', false); // define('INDEX_FILE', true); we want the right blocks, define('INDEX_FILE', false); we don\'t want the right blocks
$filesbypage = 49; // How much files (swf/files) by page we want ?
$swfdirectory = "modules/Forums/games/"; // Where do we need to search the SWF files ?
$picdirectory = "modules/Forums/games/pics/"; // and their pictures.
$defaultgametype = 3; // Default type when a game is added in database
$defaultgamewidth = 550; // Default width when a game is added in database
$defaultgameheight = 380; // Default height when a game is added in database
$picturebyline = 5; // Number of pictures by line on the View Pictures Page

// --------------------------------------------
// Careful with edition above this line......
// --------------------------------------------

if (!is_admin()) {
    include_once(NUKE_BASE_DIR.'header.php');

    title("Arcade Tweaks $ArcadeTweaksVersion");

    echo "This module is for Administrator only.";
    include_once(NUKE_BASE_DIR.'footer.php');
    exit;
} 
// Menu at the top of each page
function menu()
{
    global $module_name, $ArcadeTweaksVersion;

    OpenTable();
    //title("Arcade Tweaks $ArcadeTweaksVersion");
    echo "<center><span class=\"content\">[&nbsp;";
    echo "<a href=\"modules.php?name=$module_name\">Main Page</a>"
     . "&nbsp;|&nbsp;<a href=\"modules/Forums/admin/admin_arcade_games.php\"><i>Arcade Admin</i></a>";
    echo "&nbsp;]<br />\n";
    echo "[&nbsp;";
    echo "<a href=\"modules.php?name=$module_name&amp;m_op=checkswf\">All SWF</a>"
     . "&nbsp;|&nbsp;<a href=\"modules.php?name=$module_name&amp;m_op=checkswf&amp;filefilter=unreferenced\">Unreferenced SWF</a>"
     . "&nbsp;|&nbsp;<a href=\"modules.php?name=$module_name&amp;m_op=checkDB\">Check DB</a>"; 
    echo "&nbsp;|&nbsp;<a href=\"modules.php?name=$module_name&amp;m_op=category\">Category</a>";
    echo "&nbsp;|&nbsp;<a href=\"modules.php?name=$module_name&amp;m_op=tools\">Tools</a>";
    echo "&nbsp;]</span></center>";
    CloseTable();
    //echo "<br />";
} 

// Tools: Few "solos" function .. Where could I put them... hmm here !!! :)
function Tools()
{
    global $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //title("Arcade Tweaks Tools");
    OpenTable();
    echo "<ol>";
    echo "<li> <a href='modules.php?name=$module_name&amp;m_op=checkDB&amp;type012=1'> Select Games of type 0,1 and 2 for processing </a>";
    echo "<li> <a href='modules.php?name=$module_name&amp;m_op=viewpictures'> View pictures in 'games/pics'</a>";
    echo "<li> <a target=\"_blank\" href='modules.php?name=$module_name&amp;m_op=viewpictures'> View pictures in 'games/pics' in a  new window</a>";
    echo "<li> <a href='modules.php?name=$module_name&amp;m_op=dbcoherence'> Check Database Coherence</a>";
    echo "</ol>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 

// Read and Remember Categories
$_categoryArray = Array();
function CategoryTable($catid)
{
    global $db, $prefix, $_categoryArray;
    if (count($_categoryArray) <> 0) {
        return isset($_categoryArray[$catid]);
    } 
    $sql = "SELECT * "
     . "FROM " . $prefix . "_bbarcade_categories ORDER BY `arcade_catorder`";
    $result = $db->sql_query($sql)
    or die("Cannot read Arcade categories.");
    while ($row = $db->sql_fetchrow($result)) {
        $_categoryArray[$row['arcade_catid']] = $row;
    } // while 
    return isset($_categoryArray[$catid]);
} 
// Collect Pictures in pic directory and show them
function ViewPictures()
{
    global $picdirectory, $picturebyline;
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //title("Pictures in <strong>$picdirectory</strong>");
    OpenTable();

    $result = Array();
    if (is_dir($picdirectory)) {
        if ($dh = opendir($picdirectory)) {
            while (($file = readdir($dh)) !== false) {
                if (filetype($picdirectory . $file) == "file") {
                    if ($extpos = strrpos($file, '.')) {
                        $ext = substr($file, $extpos + 1);
                        if ($ext == "gif" or $ext == "jpg") {
                            $result[] = $file;
                        } 
                    } 
                } 
            } 
            closedir($dh); 
            // let's get them in alpha natural order
            sort($result, SORT_STRING);
        } else // if ($dh = opendir($swfdirectory))
            die("Cannot open directory '$picdirectory'");
    } else // if (is_dir($swfdirectory))
        die("'$picdirectory' is not a directory");

    echo "<table align=\"center\" border=0>\n";
    // echo "<tr><th colspan=\"$picturebyline\">Pictures in $picdirectory</th></tr>\n";
    $picinline = 0;
    foreach($result AS $key => $picfile) {
        if ($picinline == 0) {
            echo "\n<tr>";
        } 
        echo " <td width=\"128\" align=\"center\"><img src=\"" . $picdirectory . $picfile . "\" width='32' height='32' title=\"$picfile\" alt=\"$picfile\"><br />"
         . "$picfile</td>\n";
        $picinline++;
        if ($picinline == $picturebyline) {
            echo "</tr>\n<tr>";
            $picinline = 0;
        } 
    } 
    echo "</tr>\n</table>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
// get an Array of SWF files in games directory
function SWFArrayFromDirectory()
{
    global $swfdirectory;
    $result = Array();
    if (is_dir($swfdirectory)) {
        if ($dh = opendir($swfdirectory)) {
            while (($file = readdir($dh)) !== false) {
                if (filetype($swfdirectory . $file) == "file") {
                    if ($extpos = strrpos($file, '.')) {
                        $ext = substr($file, $extpos + 1);
                        if ($ext == "swf") {
                            $result[] = $file;
                        } 
                    } 
                } 
            } 
            // let's get them in alpha natural order
            sort($result, SORT_STRING);
            closedir($dh);
        } else // if ($dh = opendir($swfdirectory))
            die("Cannot open directory '$swfdirectory'");
    } else // if (is_dir($swfdirectory))
        die("'$swfdirectory' is not a directory");
    return $result;
} 
// Add a swf file in DB with default value and search for a picture in pic dir
function IntelliAdd()
{
    global $gamebasename, $prefix, $db, $picdirectory;
    global $defaultgametype, $defaultgamewidth, $defaultgameheight;
    global $gametitle, $arcadetype, $arcade_catid; 
    // try to find a Picture
    // could be improved... for yet, search a picture such AS name.ext , name1.ext, name2.ext
    $PicExt = array(".gif", ".jpg", ".png", ".jpeg", ".bmp");
    $gamepic = "";
    foreach($PicExt AS $Ext) {
        if (file_exists($picdirectory . $gamebasename . $Ext)) {
            $gamepic = $gamebasename . $Ext;
            break;
        } 
        if (file_exists($picdirectory . $gamebasename . "1" . $Ext)) {
            $gamepic = $gamebasename . "1" . $Ext;
            break;
        } 
        if (file_exists($picdirectory . $gamebasename . "2" . $Ext)) {
            $gamepic = $gamebasename . "2" . $Ext;
            break;
        } 
    } 
    // taken from arcade_elmt.php, .. and adapted.
    $sql = "SELECT MAX(game_order) AS max_order
                FROM " . $prefix . "_bbgames";
    if (!$result = $db->sql_query($sql)) {
        die("Cannot find Game Orde at line " . __LINE__ . ", File " . __FILE__);
    } 
    $row = $db->sql_fetchrow($result);

    $max_order = $row['max_order'];
    $next_order = $max_order + 10;

    $sql = "INSERT INTO " . $prefix . "_bbgames ( game_order, game_pic, game_desc, game_highscore, game_highdate, game_highuser, game_name, game_swf, game_width, game_height, game_scorevar, game_type, arcade_catid ) "
     . "VALUES ($next_order, '$gamepic', '', 0, 0, 0, '$gametitle', '" . $gamebasename . ".swf', '$defaultgamewidth', '$defaultgameheight', '$gamebasename','$arcadetype','$arcade_catid')";
    if (!$result = $db->sql_query($sql)) {
        die("Couldn't insert row in games table");
    } 
    // check if comments mod is installed, and add an empty comment if it's the case.
    $commenttableexist = $db->sql_query("SELECT * FROM `" . $prefix . "_bbarcade_comments` LIMIT 0,1");
    if ($commenttableexist) {
        $sql = "SELECT * FROM " . $prefix . "_bbgames WHERE game_order = $next_order ";
        if (!$result = $db->sql_query($sql)) {
            die("Couldn't update comments table");
        } 
        $row = $db->sql_fetchrow($result);
        $game_id = $row['game_id'];

        $sql = "INSERT INTO " . $prefix . "_bbarcade_comments ( game_id, comments_value ) VALUES ($game_id, '')";
        if (!$db->sql_query($sql)) {
            die("Couldn't update comments table");
        } 
    } 

    $sql = "UPDATE " . $prefix . "_bbarcade_categories SET arcade_nbelmt = arcade_nbelmt + 1 WHERE arcade_catid = $arcade_catid";
    if (!$db->sql_query($sql)) {
        die("Couldn't update categories table");
    } 
    // let's go back to the origin page
    checkSwfDir();
} 
function MakeIntelliAddForm($basename)
{
    global $module_name, $_categoryArray;
    CategoryTable(0);
    $content = "\n<form name=\"frm$basename\" action=\"modules.php?name=$module_name&amp;m_op=intelliad\" method=\"post\">\n";
    $content .= "    <input type=\"hidden\" name=\"gamebasename\" value=\"$basename\">\n";
    $content .= "    title: <input type=\"text\" class=\"select\" name=\"gametitle\" size=\"12\" value=\"$basename\">\n";
    $content .= "    <select name=\"arcadetype\">\n";
    $content .= "        <option selected value=\"3\">type 3</option>\n";
    $content .= "        <option value=\"4\" >type 4</option>\n";
    $content .= "    </select>\n";
    $content .= "    <select name=\"arcade_catid\">\n";
    foreach ($_categoryArray AS $category) {
        $content .= "        <option value=\"" . $category['arcade_catid'] . "\" >" . $category['arcade_cattitle'] . "</option>\n";
    } 
    $content .= "    </select>\n";
    $content .= "    <input type=\"submit\" class=\"liteoption\" value=\"IntelliAdd\">";
    $content .= "</form>\n";
    return $content;
} 
function checkSwfDir()
{
    global $swfdirectory, $db, $picdirectory, $prefix;
    global $cstart, $cend, $filesbypage, $module_name, $filefilter;

    $swfOK = 0; //swf found in directory and in database
    $swfNotInDB = 0; // swf found in directory and NOT in database
    $swfMultipleInDB = 0; // swf found in directory and many times database
    $swfCnt = 0; // Total swf found in directory   
    // let's collect swf files
    $swf_array = SWFArrayFromDirectory();

    if ($cend == 0) {
        //$cend = ($cstart == 0)?$filesbypage:($cstart + $filesbypage < count($swf_array))?$cstart + $filesbypage:(count($swf_array));
		$cend = (($cstart == 0) ? $filesbypage:($cstart + $filesbypage) < ((is_countable($swf_array) ? count($swf_array) : 0))) ? $cstart + $filesbypage:(count($swf_array));
    } 
    if ($cend >= count($swf_array)) {
        $cend = count($swf_array)-1;
    } 
    if ($cstart < 0 || $cstart > $cend) {
        $cstart = 0;
    } 
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    OpenTable();

    echo MakePageLinks(0, count($swf_array) , $filesbypage, $cstart);
    echo "<br /><br /><table width=\"100%\" border=\"1\" cellpadding=\"2\">\n";
    echo "    <tr>\n";
    if ($filefilter == "unreferenced") {
        echo "        <th colspan=6>Unreferenced SWF files</th>\n";
    } else {
        echo "        <th colspan=6>Check Arcade SWF files<br />in <em>$swfdirectory</em></th>\n";
    } 
    echo "    </tr>\n"; 
    // I use this $content variable here , because I prefer to have the "count"
    // at the top of the page... if we just use echo , the count will be at
    // the end of the page... :/
    // BTW, I don\'t really understand why it's a problem PhantomK :?
    $content = " <tr>\n"
     . "    <th colspan=1>SWF Name</th><th width=32>&nbsp</th><th>Size</th><th>Status</th><th colspan=2>Adm</th>"
     . "</tr>\n"; 
    // One query string to found how much swf files are correctly referenced.
    $countquery = "SELECT COUNT(*) FROM " . $prefix . "_bbgames WHERE ";
    foreach ($swf_array AS $swffile) {
        $countquery .= "game_swf='$swffile' or ";
    } 
    $countquery .= " game_swf='AnythingThatWillNotBeFounded'";
    $totalcount = $db->sql_fetchrow($db->sql_query($countquery)); 
    // let's go in the swf files array and process them one by one
    for ($i = $cstart;$i <= $cend;$i++) {
        $swffile = $swf_array[$i]; 
        // Get data from DB for this SWF if it exists
        $sql = "SELECT * FROM " . $prefix . "_bbgames WHERE game_swf='$swffile'";

        if (!($result = $db->sql_query($sql))) {
            die('Cannot Read games database.');
        } 
        $count = $db->sql_numrows($result);
        $row = $db->sql_fetchrow($result);
        if (isset($filefilter) and $filefilter == "unreferenced" and $count) {
            continue;
        } 
        $content .= "    <tr>\n";
        $content .= "        <td ><a target=\"_blank\" href=\"" . $swfdirectory . $swffile . "\">$swffile</a></td>\n";

        if (isset($row['game_pic']) and !empty($row['game_pic'])) {
            // the game is referenced and have a pic
            $content .= "        <td width=32><a href='modules.php?name=Forums&amp;file=games&amp;gid=" . $row['game_id'] . "'><img src=\"" . $picdirectory . $row['game_pic'] . "\" width=32 height=32 border=0></a></td>\n";
        } else {
            if ($count > 0) {
                // game referenced without pic
                $content .= "<td width=32 align=center height=32><a href='modules.php?name=Forums&amp;file=games&amp;gid=" . $row['game_id'] . "'><img src=\"modules/$module_name/images/nopic.gif\" width=32 height=32 border=0></a></td>\n";
            } else { // game not referenced
                $content .= "<td width=32 align=center height=32>X</td>\n";
            } 
        } 
        $content .= "        <td align=center>" . GetFriendlySize(filesize($swfdirectory . $swffile)) . "</td>";
        $swfCnt++; 
        // This SWF is referenced ?
        switch ($count) {
            case 0:
                $filenamewithoutext = substr($swffile, 0, strrpos($swffile, '.'));
                $content .= "<td>"
                 . MakeIntelliAddForm($filenamewithoutext) . "</td>" // "<a href=\"modules.php?name=$module_name&amp;m_op=intelliad&amp;gamebasename=$filenamewithoutext&amp;cstart=$cstart\">IntelliAdd</a></td>\n"
                . "<td align=center>[&nbsp;<a href='modules/Forums/admin/arcade_elmt.php?mode=create&amp;game_name=$filenamewithoutext'>Add</a>&nbsp;]</big></td>\n";
                $swfNotInDB++;
                break;
            case 1 :
                $swfOK++; 
                // $row=$db->sql_fetchrow($result);
                $category = CategoryTable($row['arcade_catid']);
                $content .= "<td><strong>" . $row['game_name'] . "</strong>: type " . $row['game_type'] . ", " . $row['game_width'] . "x" . $row['game_height'] . "<br />"
                 . "<a href='modules/Forums/admin/arcade_elmt.php?arcade_catid=" . isset($row['arcade_catid']) . "'>" . isset($category['arcade_cattitle']) . "</a></td><td align=center>[&nbsp;<a href='modules/Forums/admin/arcade_elmt.php?mode=edit&amp;game_id=" . $row['game_id'] . "'>Edit</a>&nbsp;]</td>\n";
                break;
            default:
                $swfMultipleInDB++;
                $content .= "<td><big><strong><u>Multiple entry in DB</u></strong></big></td>\n";
                break;
        } 
        $content .= "</tr>\n";
        $db->sql_freeresult($result);
    } //foreach  
    // ok let's start by showing the count
    echo "    <tr>\n";
    echo "     <td colspan=3 border=0 valign=top ><strong><u>Results</u></strong>:<br /><ul><li><strong>" . count($swf_array) . "</strong> total .SWF files in directory<li><strong>" . $totalcount[0] . "</strong> in database"
     . "<li><strong>" . (count($swf_array) - $totalcount[0]) . "</strong> unreferenced in database</ul></td>\n";
    echo "        <td colspan=2><strong><u>On this page</u></strong><ul><li>$swfCnt Flash Files<li>" . ($swfOK + $swfMultipleInDB) . " referenced in DB<li>$swfMultipleInDB referenced more than once<li>$swfOK referenced once.<li>$swfNotInDB not referenced</ul></td>\n";
    echo "    </tr>\n"; 
    // then the many SWF Files...
    echo $content;
    echo "</table>\n";
    echo MakePageLinks(0, count($swf_array) , $filesbypage, $cstart); 
    // hey it's the end..
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
// Format Data for a line of game's information
function GamesDBRow($row, $showcheckbox = true)
{
    global $picdirectory, $module_name;
    echo "<tr>";

    if (isset($row['game_pic']) and !empty($row['game_pic'])) {
        echo "        <td align=\"center\" width=\"32\"><a href='modules.php?name=Forums&amp;file=games&amp;gid=" . $row['game_id'] . "'><img src=\"" . $picdirectory . $row['game_pic'] . "\" width=32 height=32 border=0></a></td>\n";
    } else {
        echo "<td align=\"center\" width=\"32\" align=center height=32><a href='modules.php?name=Forums&amp;file=games&amp;gid=" . $row['game_id'] . "'><img src=\"modules/$module_name/images/nopic.gif\" width=32 height=32 border=0></a></td>\n";
    } 

    echo "<td>";
    if ($showcheckbox) {
        echo "<input type=\"checkbox\" name=\"gameid[]\" value=\"" . $row['game_id'] . "\">&nbsp;";
    } 
    echo $row['game_name'] . "</td>";
    echo "<td align=center>" . $row['game_width'] . "x" . $row['game_height'] . "</td>";
    $category = CategoryTable($row['arcade_catid']);
    echo "<td align=\"center\"><a href='modules/Forums/admin/arcade_elmt.php?arcade_catid=" . isset($row['arcade_catid']) . "'>" . isset($category['arcade_cattitle']) . "</td>";
    echo "<td align=center>type " . $row['game_type'] . "</td>";
    echo "<td align=center>" . $row['game_set'] . " times    </td>"; 
    // echo "<td>" . $row['game_scorevar'] . "</td>";
    echo"<td align=center>[&nbsp;<a href='modules/Forums/admin/arcade_elmt.php?mode=edit&amp;game_id=" . $row['game_id'] . "'>Edit</a>&nbsp;]</td>";
    echo "</tr>";
} 
// Read and Remember all the games, use memory to avoid sql query...
$__gamesdata = Array();
function ReadAllGames($orderby = "`game_name`")
{
    global $db, $prefix, $__gamesdata; 
    // if already read... return :p
    if (count($__gamesdata)) {
        return $__gamesdata;
    } 
    global $type012; 
    // ok let's make the query
    $__gamesdata = Array();
    $result = $db->sql_query("SELECT * FROM " . $prefix . "_bbgames ORDER BY $orderby")
    or die("Cannot Read games database.");
    while ($row = $db->sql_fetchrow($result)) {
        if (!isset($type012) or ($row['game_type'] < 3)) {
            $__gamesdata[] = $row;
        } 
    } 
    $db->sql_freeresult($result);
    return $__gamesdata;
} 
// Get a field, (by default the name of the game) from a Game's Table row
function FromGameID($GameID, $field = "game_name")
{
    ReadAllGames();
    global $__gamesdata;
    foreach($__gamesdata AS $row) {
        if ($row['game_id'] == $GameID) {
            return $row[$field];
        } 
    } 
    die("Game's data not found");
} 

function SearchDB()
{
    global $module_name, $srchstring, $searchin, $prefix, $db, $titanium_user_prefix, $picdirectory;
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //title("Game's database search");
    echo SearchDBForm();
    OpenTable();

    if (trim($srchstring) <> "") {
        // replace wildcards */? to use with mysql "LIKE"
        $search = str_replace("_", "\\_", $srchstring);
        $search = str_replace("%", "\\%", $search);
        $search = str_replace("*", "%" , $search);
        $search = str_replace("?", "_" , $search);

        switch ($searchin) {
            case "name":
                $field = "`game_name`" ;
                break;
            case "swfname":
                $field = "`game_swf`" ;
                break;
            case "gameid":
                $field = "`game_id`" ;
                break;
            default:
                $field = "`game_name`" ; ;
        } // switch
        if ($searchin != "comment") {
            $sql = "SELECT * FROM " . $prefix . "_bbgames WHERE $field LIKE '$search' ORDER BY `game_name`";
            $result = $db->sql_query($sql) or
            die("Error while searching Games database : $sql");
            if (!$db->sql_numrows()) {
                echo "No matches.<br /><br />" . SearchDBForm();
            } else {
                echo "<form action=\"modules.php?name=$module_name&amp;m_op=submitchange\" name=\"gameselection\"method=\"post\">";
                echo "<table width=\"100%\" border=\"1\">";
                while ($row = $db->sql_fetchrow($result)) {
                    GamesDBRow($row, true);
                } 
                echo "</table>";
                echo "<select name=\"selectaction\">";
                echo "<option value=\"\">---- With Selected... ----</option>";
                echo "<option value=\"changecat\">Change Category</option>";
                echo "<option value=\"changesize\">Change Size</option>";
                echo "<option value=\"removescore\">Remove Scores</option>";
                echo "<option value=\"removefromdb\">Remove from DB</option>";
                echo "<option value=\"removefiles\">Remove files from DB and Dir</option>";
                echo "</select>";
                echo "<input type=\"submit\" class=\"liteoption\"></form>";
            } 
        } //if ($searchin!="comment")
        else { // it's a search on comment
            $commenttable = $prefix . "_bbarcade_comments";
            $gametable = $prefix . "_bbgames";
            $titanium_usertable = $titanium_user_prefix . "_users";
            $search = "%" . $search . "%";
            $sql = "SELECT g.* ,u.username,c.comments_value "
             . "FROM $commenttable c "
             . "LEFT JOIN $gametable g ON g.game_id=c.game_id "
             . "LEFT JOIN $titanium_usertable u ON u.user_id=g.game_highuser "
             . "WHERE c.comments_value LIKE '$search'";
            $result = $db->sql_query($sql)
            or die("Cannot access Comment Table : $sql ," . mysql_error());
            if ($db->sql_numrows()) {
                echo "<table width=100% border=\"1\">";
                while ($row = $db->sql_fetchrow($result)) {
                    echo "<tr><td width='32'><img src='$picdirectory" . $row['game_pic'] . "' width='32' height='32'><td><a href=''>" . $row['game_name'] . "</a><br />by <a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=" . $row['game_highuser'] . "\">" . $row['username'] . "</a></td>";
                    echo "<td>" . $row['comments_value'] . "</td>"
                     . "<td>[&nbsp;<a href='modules.php?name=$module_name&amp;m_op=editcomment&amp;gameid=" . $row['game_id'] . "'>Edit</a>&nbsp;|&nbsp;<a href=''>Delete</a>&nbsp;]</td></tr>";
                } 
                echo "</table>";
            } else {
                echo "No Matches";
            } 
        } 
    } 

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
function ChangeComment()
{ 
    global $prefix,$db,$comment_text,$gameid;
    // 2 lines taken from comments_new.php
    $comment_text = str_replace("\'", "''", $comment_text);
    $comment_text = preg_replace(array('#&(?!(\#[0-9]+;))#', '#<#', '#>#'), array('&amp;', '&lt;', '&gt;'), $comment_text);
    
    $commenttable = $prefix . "_bbarcade_comments";
    $sql = "UPDATE $commenttable SET comments_value = '$comment_text' WHERE game_id = $gameid";     
   if( !$result = $db->sql_query($sql) ) 
   { 
    die("Couldn't insert row in comments table"); 
   } 
    EditComment();
} 
function EditComment()
{
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //title("Comment Edition");
    OpenTable();
    global $db, $gameid,$prefix,$titanium_user_prefix,$module_name;
    if (!isset($gameid)) {
        die("Error : No valid game id. Unable to edit comment.");
    } 

    $commenttable = $prefix . "_bbarcade_comments";
    $gametable = $prefix . "_bbgames";
    $titanium_usertable = $titanium_user_prefix . "_users";
    $sql = "SELECT g.* ,u.username,u.user_id,c.comments_value "
             . "FROM $commenttable c "
             . "LEFT JOIN $gametable g ON g.game_id=c.game_id "
             . "LEFT JOIN $titanium_usertable u ON u.user_id=g.game_highuser "
             . "WHERE c.game_id=$gameid";       
    $result=$db->sql_query($sql) 
        or die("Cannot read table game.");
    $row=$db->sql_fetchrow($result);
    if ($row) {
        echo "<table width=\"100%\" border=1>\n";
        GamesDBRow($row,false);
        echo "<form method=\"post\" action=\"modules.php?name=$module_name&amp;m_op=changecomment&amp;gameid=$gameid\">\n";
        echo "<tr><td></td><td width=150 align=center><strong>Highscore: </strong> ".$row['game_highscore']
            ."<br /><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=".$row['user_id']."\">".$row['username']."</a>"
            ."<br />".date( "D M d, Y g:i a" , $row['game_highdate'] )."</td>\n"
            ."<td colspan=\"10\" align=\"center\"><textarea ROWS=6 COLS=40 name=\"comment_text\">".$row['comments_value']."</textarea></td></tr>\n";
        echo "<tr><td></td><td></td><td align=\"center\" colspan=\"10\"><input type=\"submit\" class=\"liteoption\" value=\"Change Comment\"></td></tr>\n";
        echo "</form>\n";
        echo "</table>\n";
    }
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
function SearchDBForm()
{
    global $module_name, $srchstring;
    $content = "<form action=\"modules.php?name=$module_name&amp;m_op=searchdb\" method=\"post\">\n";
    $content .= "<strong>Search:<strong>&nbsp;<input type=\"text\" class=\"select\" name=\"srchstring\" value=\"$srchstring\" size=\"10\" title=\"Use Wildcards * and ? such AS 'yeti*'\">\n";
    $content .= "&nbsp;<strong>in</strong>&nbsp;<select name=\"searchin\">\n";
    $content .= "    <option selected value=\"name\">Game's Name</option>\n";
    $content .= "    <option value=\"swfname\">SWF File name</option>\n";
    $content .= "    <option value=\"comment\">Comments</option>\n";
    $content .= "    <option value=\"gameid\">Game's ID</option>\n";
    $content .= "</select>\n";
    $content .= "<input type=\"submit\" class=\"liteoption\" value=\"Search..\">";
    $content .= "</form>\n";
    return $content;
} 
// Main function to read and check Games Database
function CheckDB()
{
    global $db, $prefix, $swfdirectory, $picdirectory, $module_name, $filesbypage;
    global $cend, $cstart;

    $gamesdata = &ReadAllGames();
    $totalgames = count($gamesdata);
    $filenotindir = 0 ;
    $picnotindir = 0;
    $gameswithoutpic = 0;
    $filemissing = "<table width=100%>";
    $picsmissing = "<table width=100%>";
    $gameswithscore = 0;
    $gameswithoutscore = 0;
    foreach($gamesdata AS $row) {
        if (!file_exists($swfdirectory . $row['game_swf'])) {
            $filenotindir++;
            $filemissing .= "<tr><td>" . $row['game_swf'] . "</td><td>[&nbsp;<a href=\"modules.php?name=$module_name&amp;m_op=submitchange&amp;selectaction=removefromdb&amp;gameid[]=" . $row['game_id'] . "\">Remove</a>"
             . "&nbsp|&nbsp;<a href='modules/Forums/admin/arcade_elmt.php?mode=edit&amp;game_id=" . $row['game_id'] . "'>Edit</a>&nbsp;]</td></tr>";
        } 
        if (!empty($row['game_pic'])) {
            if (!file_exists($picdirectory . $row['game_pic'])) {
                $picnotindir++;
                $picsmissing .= "<tr><td>" . $row['game_pic'] . "</td><td>[&nbsp;<a href='modules/Forums/admin/arcade_elmt.php?mode=edit&amp;game_id=" . $row['game_id'] . "'>Edit</a>&nbsp;]</td></tr>";
            } 
        } else {
            $gameswithoutpic ++;
        } 
        if ($row['game_highdate'] <> 0) {
            $gameswithscore++;
        } else {
            $gameswithoutscore++;
        } 
    } // while
    $filemissing .= "</table>";
    $picsmissing .= "</table>";
    if ($cend == 0) {
        //$cend = ($cstart == 0)?$filesbypage:($cstart + $filesbypage < count($gamesdata))?$cstart + $filesbypage:(count($gamesdata));
		$cend = (($cstart == 0) ? $filesbypage:($cstart + $filesbypage) < ((is_countable($gamesdata) ? count($gamesdata) : 0))) ? $cstart + $filesbypage:(count($gamesdata));
    } 
    if ($cend > count($gamesdata)) {
        $cend = count($gamesdata);
    } 
    if ($cstart < 0 || $cstart > $cend) {
        $cstart = 0;
    } 
    include_once(NUKE_BASE_DIR.'header.php');

    ?>

<script language="Javascript">
<!-- Check/Unckeck Javascript function
function setCheckboxes(do_check)
{
    var elts      = document.forms['gameselection'].elements['gameid[]'];
    var elts_cnt  = (typeof(elts.length) != 'undefined')? elts.length : 0;

    if (elts_cnt)
    {
        for (var i = 0; i < elts_cnt; i++)
        {
            elts[i].checked = do_check;
        }
    }
    else
    {
        elts.checked = do_check;
    }
    return true;
}
//-->
</script>

<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
    menu();
    OpenTable();
    MakePageDBLinks(0, count($gamesdata), $filesbypage, $cstart);

    echo "<table width='100%' border=1>";
    echo "<tr><th colspan=10>Check Games Database</th></tr>";
    echo "<tr><td colspan=5 width='50%'><strong><u>Results</u></strong>:<ul>";
    echo "<li>$totalgames games in database";
    if ($filenotindir > 0) {
        echo "<li>$filenotindir swf files not found in games directory";
        echo "<ol>$filemissing</ol>";
    } else
        echo "<li> All flash files have been found";

    if ($picnotindir > 0) {
        echo "<li>$picnotindir picture file not found in pictures directory";
        echo "<ol>$picsmissing</ol>";
    } else
        echo "<li> All pics files have been found";

    if ($gameswithoutpic > 0) {
        echo "<li>$gameswithoutpic games don\'t have a pic";
    } else
        echo "<li> All games have a pic";
    echo "<li>$gameswithscore games with High-Score" ;
    echo "<li>$gameswithoutscore games without High-Score" ;
    echo "</ul><br /></td><td colspan=5>" . SearchDBForm() . "</td></tr>";
    echo "<form action=\"modules.php?name=$module_name&amp;m_op=submitchange\" name=\"gameselection\"method=\"post\">"; 
    // Let's show Games
    echo "<tr><th>&nbsp;</th><th>name</th><th>screen</th><th>Cat.</th><th>Type</th><th>Played</th><th>Actions</th></tr>";

    $showcount = 0;
    foreach($gamesdata AS $row) {
        if ($showcount >= $cstart and $showcount < $cend) {
            GamesDBRow($row);
        } 
        $showcount ++;
    } 
    echo "<tr><td></td><td><a href=\"*\" onclick=\"setCheckboxes(true); return false;\">Check All</a>/";
    echo "<a href=\"*\" onclick=\"setCheckboxes(false); return false;\">Uncheck All</a></td></tr>";
    echo "</table>";
    echo "<select name=\"selectaction\">";
    echo "<option value=\"\">---- With Selected... ----</option>";
    echo "<option value=\"changecat\">Change Category</option>";
    echo "<option value=\"changesize\">Change Size</option>";
    echo "<option value=\"removescore\">Remove Scores</option>";
    echo "<option value=\"removefromdb\">Remove from DB</option>";
    echo "<option value=\"removefiles\">Remove files from DB and Dir</option>";
    echo "</select>";
    echo "<input type=\"submit\" class=\"liteoption\"></form>";
    MakePageDBLinks(0, count($gamesdata), $filesbypage, $cstart);
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 

function SubmitChange()
{
    global $db, $prefix, $selectaction, $gameid, $module_name, $_categoryArray;
    if (!is_array($gameid) or count($gameid) == 0 or !isset($selectaction) or empty($selectaction)) {
        Header("Location: modules.php?name=$module_name&m_op=checkDB");
    } 
    switch ($selectaction) {
        case "changecat":
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            //title("Change games category");
            OpenTable();
            echo "<form action=\"modules.php?name=$module_name&amp;m_op=applychange\" method=\"post\"><ul>";
            foreach($gameid AS $gid) {
                echo "<input type=\"hidden\" name=\"gameid[]\" value=\"$gid\"><li>" . FromGameID($gid);
            } 
            echo "</ul>";
            echo "Move to this category: <select name=\"catid\">";
            echo "<option value=\"\">---- Select Category ----";
            CategoryTable(0); // read the category table;
            foreach($_categoryArray AS $row) {
                echo "<option value=\"" . $row['arcade_catid'] . "\">" . $row['arcade_cattitle'];
            } 
            echo "</select>&nbsp;<input type=\"submit\" class=\"liteoption\" name=\"Move\">";
            echo "<input type=\"hidden\" name=\"selectaction\" value=\"changecat\">"
             . "</form>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "changesize":
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            //title("Flash Game Window Size");
            OpenTable();
            echo "<form action=\"modules.php?name=$module_name&amp;m_op=applychange\" method=\"post\"><ul>";
            foreach($gameid AS $gid) {
                echo "<input type=\"hidden\" name=\"gameid[]\" value=\"$gid\"><li>" . FromGameID($gid);
            } 
            echo "</ul>";
            echo "<u>New window size</u>:  <strong>Width:</strong> <input type=\"text\" class=\"select\" name=\"gwidth\" value=\"\" size=\"4\">";
            echo "   <strong>Height:</strong> <input type=\"text\" class=\"select\" name=\"gheight\" value=\"\" size=\"4\">";
            echo "&nbsp;<input type=\"submit\" class=\"liteoption\" value=\"Set Size\">";
            echo "<input type=\"hidden\" name=\"selectaction\" value=\"changesize\">"
             . "</form>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "removescore":
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            //title("Removing Scores");
            OpenTable();
            echo "<form action=\"modules.php?name=$module_name&amp;m_op=applychange\" method=\"post\"><ul>";
            foreach($gameid AS $gid) {
                echo "<input type=\"hidden\" name=\"gameid[]\" value=\"$gid\"><li>" . FromGameID($gid);
            } 
            echo "</ul>";
            echo "Please Confirm you want to remove ALL Scores for this games: ";
            echo "<input type=\"hidden\" name=\"selectaction\" value=\"removescore\">";
            echo "<br /><input type=\"submit\" class=\"liteoption\" value=\"I Confirm\"></form>";
            echo "<form action=\"modules.php?name=$module_name&amp;m_op=checkDB\" name=\"dontconfirm\" method=\"post\">";
            echo "<input type=\"submit\" class=\"liteoption\" value=\"No,Dont Remove scores\"></form>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "removefromdb":
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            //title("Removing Games from database");
            OpenTable();
            echo "<form action=\"modules.php?name=$module_name&amp;m_op=applychange\" method=\"post\"><ul>";
            foreach($gameid AS $gid) {
                echo "<input type=\"hidden\" name=\"gameid[]\" value=\"$gid\"><li>" . FromGameID($gid);
            } 
            echo "</ul>";
            echo "Please Confirm you want to <strong><big>remove this " . count($gameid) . " game(s) from DB</big></strong> (Files will stay in your games directory.): ";
            echo "<input type=\"hidden\" name=\"selectaction\" value=\"removefromdb\">";
            echo "<br /><input type=\"submit\" class=\"liteoption\" value=\"I Confirm\"></form>";
            echo "<form action=\"modules.php?name=$module_name&amp;m_op=checkDB\" name=\"dontconfirm\" method=\"post\">";
            echo "<input type=\"submit\" class=\"liteoption\" value=\"No,Dont Remove this games\"></form>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "removefiles":
            echo "Sooooooorrry... Removing files is not implemented yet.";
            break;
        default:
            Header("Location: modules.php?name=$module_name&m_op=checkDB"); ;
    } // switch( ) 
    // print_r($gameid);
} 

function ApplyChange()
{
    global $db, $prefix, $selectaction, $gameid, $module_name, $_categoryArray;
    if (!is_array($gameid) or count($gameid) == 0 or !isset($selectaction) or empty($selectaction)) {
        Header("Location: modules.php?name=$module_name&m_op=checkDB");
    } 
    switch ($selectaction) {
        case "changecat":
            global $catid;
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            if (!isset($catid) or empty($catid)) {
                die("Invalid Category ID");
            } 
            OpenTable();
            //title("Moving Games");
            echo "<ul>";
            foreach($gameid AS $gid) {
                $sql = "UPDATE " . $prefix . "_bbgames SET"
                 . " arcade_catid = " . $catid
                 . " WHERE game_id = " . $gid;
                $db->sql_query($sql) or die("Cannot update Games Table");
                echo "<li>" . FromGameID($gid);
            } 
            echo "</ul>";
            CategoryTable(0); // read the category table;
            foreach($_categoryArray AS $row) {
                if ($row['arcade_catid'] == $catid) {
                    echo "have been moved to category <strong>" . $row['arcade_cattitle'] . "</strong><br />";
                    break;
                } 
                resynch_arcade_categorie($row['arcade_catid']);
            } 
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "changesize":
            global $gheight, $gwidth;
            $gheight = intval($gheight);
            $gwidth = intval($gwidth);

            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            if (!isset($gheight) or !isset($gwidth) or $gheight <= 0 or $gwidth <= 0) {
                die("Invalid Width/Height");
            } 
            OpenTable();
            //title("Changing Flash Game Window Size");
            echo "<ul>";
            foreach($gameid AS $gid) {
                $sql = "UPDATE " . $prefix . "_bbgames SET"
                 . " game_width = " . $gwidth
                 . ",game_height= " . $gheight
                 . " WHERE game_id = " . $gid;
                $db->sql_query($sql) or die("Cannot update Games Table");
                echo "<li>" . FromGameID($gid);
            } 
            echo "</ul>";
            echo " ... to <strong>width:</strong> $gwidth , <strong>height:</strong> $gheight";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "removescore":
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            OpenTable();
            //title("Removing Scores");
            echo "<ul>";
            foreach($gameid AS $gid) {
                $sql = "UPDATE " . $prefix . "_bbgames SET"
                 . " game_highscore=0"
                 . ",game_highdate=0"
                 . ",game_highuser=0"
                 . " WHERE game_id = " . $gid;
                $db->sql_query($sql) or die("Cannot update Games Table");
                $sql = "DELETE FROM " . $prefix . "_bbscores WHERE game_id=$gid";
                $db->sql_query($sql) or die("Cannot delete scores in Table");
                echo "<li>" . FromGameID($gid);
            } 
            echo "</ul>";
            echo " ... Their Scores have been removed.";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        case "removefromdb":
            include_once(NUKE_BASE_DIR.'header.php');
            menu();
            OpenTable();
            //title("Removing Files From DB");
            echo "<ul>";
            foreach($gameid AS $gid) {
                echo "<li>" . FromGameID($gid);
                $sql = "DELETE FROM " . $prefix . "_bbgames  WHERE game_id = " . $gid;
                $db->sql_query($sql) or die("Cannot delete entry from Games Table");
                $sql = "DELETE FROM " . $prefix . "_bbscores WHERE game_id=$gid";
                $db->sql_query($sql) or die("Cannot delete scores in Table");
            } 
            echo "</ul>";
            echo " ... have been removed from database.";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            break;
        default:
            Header("Location: modules.php?name=$module_name&m_op=checkDB"); ;
    } // switch( ) 
} 
function MakePageDBLinks($phpbb2_start, $phpbb2_end, $delta, $currentpos = null)
{
    global $module_name, $type012;
    $content = "<span class='content'><strong>Goto Pages:&nbsp;&nbsp;</strong>";
    $loccount = $phpbb2_start;
    $page = 1;
    $addfilter = isset($type012)?"&amp;type012=1":"";
    while ($loccount < $phpbb2_end) {
        if ($currentpos == null or $currentpos <> $loccount) {
            $content .= "<a href='modules.php?name=$module_name&amp;m_op=checkDB&amp;cstart=$loccount&amp;cend=" . ($loccount + $delta) . "$addfilter'>$page</a> ";
        } else $content .= "<em>$page</em>&nbsp;";

        $loccount += $delta + 1;
        $page ++;
    } // while
    $content .= "<a href='modules.php?name=$module_name&amp;m_op=checkDB&amp;cstart=$phpbb2_start&amp;cend=$phpbb2_end'> ALL</a>";
    $content .= "</span>";
    echo $content;
} 
function MakePageLinks($phpbb2_start, $phpbb2_end, $delta, $currentpos = null)
{
    global $module_name, $filefilter;
    $content = "<span class='content'><strong>Goto Pages:&nbsp;&nbsp;</strong>";
    $loccount = $phpbb2_start;
    $page = 1;
    $addfilter = isset($filefilter)?"&amp;filefilter=$filefilter":"";
    while ($loccount < $phpbb2_end) {
        if ($currentpos == null or $currentpos <> $loccount) {
            $content .= "<a href='modules.php?name=$module_name&amp;m_op=checkswf$addfilter&amp;cstart=$loccount&amp;cend=" . ($loccount + $delta) . "'>$page</a> ";
        } else $content .= "<em>$page</em>&nbsp;";

        $loccount += $delta + 1;
        $page ++;
    } // while
    $content .= "<a href='modules.php?name=$module_name&amp;m_op=checkswf$addfilter&amp;cstart=$phpbb2_start&amp;cend=$phpbb2_end'> ALL</a>";
    $content .= "</span>";
    return $content;
} 
// Modified version of this code http://www.phpfreaks.com/quickcode/Friendly_File_Size/248.php
// there was a 'round' at the bad location , and I prefer the abbrev
function GetFriendlySize($s)
{
    if ($s <= 1024) return $s . " bytes";
    else if ($s <= 1048576) $s = round(($s / 1024), 2) . " ko";
    else if ($s <= 11559501824) $s = round(($s / 1048576), 2) . " mo";
    else $s = round(($s / 11559501824), 2) . " go";
    return $s;
} 
function SyncAllCategories()
{
    global $_categoryArray;
    CategoryTable(0);
    foreach($_categoryArray AS $row) {
        resynch_arcade_categorie($row['arcade_catid']);
    } 
    ShowCategory();
} 
// taken from admin_arcade_games.php and adapted
function resynch_arcade_categorie($catid)
{
    global $db, $prefix;

    $sql = "SELECT COUNT(*) AS nbelmt FROM " . $prefix . "_bbgames WHERE arcade_catid = $catid";
    if (!$result = $db->sql_query($sql)) {
        die("Cannot opent Games Table");
    } 
    $row = $db->sql_fetchrow($result);
    $nbelmt = $row['nbelmt'];
    $sql = "UPDATE " . $prefix . "_bbarcade_categories SET arcade_nbelmt = $nbelmt WHERE arcade_catid = $catid";
    if (!$result = $db->sql_query($sql)) {
        die("Cannot Update Category Table");
    } 
} 
// adapted from admin_arcade_games.php
function CreateCategory($arcade_cattitle)
{
    global $db, $prefix;
    if (trim($arcade_cattitle) == '') {
        die("Cannot add a category without title");
    } 
    $sql = "SELECT MAX(arcade_catorder) AS max_order
            FROM " . $prefix . "_bbarcade_categories";
    if (!$result = $db->sql_query($sql)) {
        die("Cannot open category table");
    } 
    $row = $db->sql_fetchrow($result);

    $max_order = $row['max_order'];
    $next_order = $max_order + 10;

    $sql = "INSERT INTO " . $prefix . "_bbarcade_categories ( arcade_cattitle, arcade_nbelmt, arcade_catorder )
                VALUES ('" . str_replace("\'", "''", $arcade_cattitle) . "', 0, $next_order)" ;
    if (!$db->sql_query($sql)) {
        die("Couldn't update arcade_categories table");
    } 
    // Let's go back to category page
    ShowCategory();
} 
function ShowCategory()
{
    global $db, $prefix, $module_name, $_categoryArray, $catid;
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //echo "<br />";
    OpenTable();
    CategoryTable(0); // read the category table;
    //title("Games Categories");
    echo "<table width=\"100%\" border=1>\n";
    echo "<tr><th>Title</th><th>id</th><th>elements</th><th>count</th></tr>\n";
    foreach($_categoryArray AS $row) {
        echo "<tr>";
        echo "<td><a href=\"modules/Forums/admin/admin_arcade_games.php?mode=edit&amp;arcade_catid=" . $row['arcade_catid'] . "\">" . $row['arcade_cattitle'] . "</a></td><td align=\"center\">" . $row['arcade_catid'] . "</td>";
        echo "<td><a href=\"modules.php?name=$module_name&amp;m_op=category&amp;catid=" . $row['arcade_catid'] . "\">" . $row['arcade_nbelmt'] . " games recorded</a></td>";
        $result = $db->sql_query("SELECT COUNT(*) AS count FROM " . $prefix . "_bbgames WHERE `arcade_catid`=" . $row['arcade_catid'])
        or die("Cannot read games table.");
        $count = $db->sql_fetchrow($result);
        echo "<td>Counted " . $count['count'];
        if ($count['count'] <> $row['arcade_nbelmt']) {
            echo " [ Not Matching - <a href=\"modules.php?name=$module_name&amp;m_op=resynccat&amp;catid=" . $row['arcade_catid'] . "\">Re-Sync</a> ]";
        } 
        echo "</td>";
        echo "</tr>\n";
    } 
    echo "</table>";
    echo "<br /><hr width='40%'>";
    echo "<center><form action=\"modules.php?name=$module_name&amp;m_op=addcategory\" method=\"post\">Add a Category:&nbsp;";
    echo "<input type=\"text\" class=\"select\" name=\"title\" value=\"\" length=\"15\" maxlength=\"100\">&nbsp;";
    echo "<input type=\"submit\" class=\"liteoption\" value=\"Add\">";
    echo "</form></center>";
    if (isset($catid)) {
        echo "<form action=\"modules.php?name=$module_name&amp;m_op=submitchange\" name=\"gameselection\"method=\"post\">";

        ?>
<script language="Javascript">
<!-- Check/Unckeck Javascript function
function setCheckboxes(do_check)
{
    var elts      = document.forms['gameselection'].elements['gameid[]'];
    var elts_cnt  = (typeof(elts.length) != 'undefined')? elts.length : 0;

    if (elts_cnt)
    {
        for (var i = 0; i < elts_cnt; i++)
        {
            elts[i].checked = do_check;
        }
    }
    else
    {
        elts.checked = do_check;
    }
    return true;
}
//-->
</script>
<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/
        $catid = intval($catid);
        $sql = "SELECT * FROM " . $prefix . "_bbgames WHERE arcade_catid=$catid ORDER BY `game_name`";
        $result = $db->sql_query($sql) or die("Cannot read Games Table");
        if ($db->sql_numrows() > 0) {
            echo "<hr width='40%'>";
            echo "<table width=\"100%\" border=1>";
            while ($row = $db->sql_fetchrow($result)) {
                GamesDBRow($row);
            } 
            echo "<tr><td></td><td><a href=\"*\" onclick=\"setCheckboxes(true); return false;\">Check All</a>/";
            echo "<a href=\"*\" onclick=\"setCheckboxes(false); return false;\">Uncheck All</a></td></tr>";
            echo "</table>";
        } 
        echo "<select name=\"selectaction\">";
        echo "<option value=\"\">---- With Selected... ----</option>";
        echo "<option value=\"changecat\">Change Category</option>";
        echo "<option value=\"changesize\">Change Size</option>";
        echo "<option value=\"removescore\">Remove Scores</option>";
        echo "<option value=\"removefromdb\">Remove from DB</option>";
        echo "<option value=\"removefiles\">Remove files from DB and Dir</option>";
        echo "</select>";
        echo "<input type=\"submit\" class=\"liteoption\"></form>";
    } 
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 

function FixDB()
{
    global $db, $prefix, $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    OpenTable();
    if ($fix = 'commentstable') {
        $commenttableexist = $db->sql_query("SELECT * FROM `" . $prefix . "_bbarcade_comments` LIMIT 0,1");

        if ($commenttableexist) {
            echo "<li><strong>Comments Module</strong> found.<br />Checking if all games have their comments in comments tables.<br /><br />";
            $sql = "SELECT * FROM " . $prefix . "_bbgames ";
            if (!$result = $db->sql_query($sql)) {
                die("Cannot Open Games Table");
            } 
            $missingcomment = 0;

            while ($row = $db->sql_fetchrow($result)) {
                if (!$db->sql_numrows($db->sql_query("SELECT * FROM " . $prefix . "_bbarcade_comments WHERE `game_id`=" . $row['game_id']))) {
                    $sql = "INSERT INTO " . $prefix . "_bbarcade_comments ( game_id, comments_value ) VALUES (" . $row['game_id'] . ", '')";
                    if (!$db->sql_query($sql)) {
                        die("Couldn't update comments table");
                    } 
                    echo "Comments Added for <strong>" . $row['game_name'] . "</strong><br />";
                } 
            } 
        } else {
            "Cannot fix your <strong>Comments Table</strong>, I don\'t find the table in database.";
        } 
    } 

    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
// check for some database incohrence
function DBCoherence()
{
    global $db, $prefix, $module_name;

    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //title("Checking Game database Coherence");
    OpenTable();
    echo "<ul>"; 
    // Checking of number of games in categories compared to the number stored in category table
    echo "<li> <strong>Category Checking</strong><br /><img src='modules/$module_name/images/icon_query.gif' border=0 width=16 height=16> Check if the number of games in category table match the count of games<br /><br />";
    CategoryTable(0); // read the category table;
    global $_categoryArray;
    $CategoryNotSynchronized = 0;

    foreach($_categoryArray AS $row) {
        $result = $db->sql_query("SELECT COUNT(*) AS count FROM " . $prefix . "_bbgames WHERE `arcade_catid`=" . $row['arcade_catid'])
        or die("Cannot read games table.");
        $count = $db->sql_fetchrow($result);
        if ($count['count'] <> $row['arcade_nbelmt']) {
            echo "<strong>" . $row['arcade_cattitle'] . "</strong> not synchronized. [ Not Matching - <a href=\"modules.php?name=$module_name&amp;m_op=resynccat&amp;catid=" . $row['arcade_catid'] . "\">Re-Sync</a> ]<br />";
            $CategoryNotSynchronized++;
        } 
    } 
    if ($CategoryNotSynchronized) {
        echo "<img src='modules/$module_name/images/icon_warn.gif' border=0 width=16 height=16><strong>$CategoryNotSynchronized</strong> don\'t match. [ <a href='modules.php?name=$module_name&amp;m_op=syncallcat'>Resync All Categories</a> ]";
    } else {
        echo "<img src='modules/$module_name/images/icon_info.gif' border=0 width=16 height=16><strong>All categories are synchronized.</strong>";
    } 
    echo "<br /><br />"; 
    // let see if the comment mod is installed and if all games have their "comments"
    // check if comments mod is installed, and add an empty comment if it's the case.
    $commenttableexist = $db->sql_query("SELECT * FROM `" . $prefix . "_bbarcade_comments` LIMIT 0,1");

    if ($commenttableexist) {
        echo "<li><strong>Comments Module</strong> found.<br /><img src='modules/$module_name/images/icon_query.gif' border=0 width=16 height=16> Checking if all games have their comments in comments tables.<br /><br />";
        $sql = "SELECT * FROM " . $prefix . "_bbgames ";
        if (!$result = $db->sql_query($sql)) {
            die("Cannot Open Games Table");
        } 
        $missingcomment = 0;

        while ($row = $db->sql_fetchrow($result)) {
            if (!$db->sql_numrows($db->sql_query("SELECT * FROM " . $prefix . "_bbarcade_comments WHERE `game_id`=" . $row['game_id']))) {
                echo $row['game_name'] . " | ";
                $missingcomment++;
            } 
        } 

        echo $missingcomment? "<br /><br /><img src='modules/$module_name/images/icon_warn.gif' border=0 width=16 height=16><strong>" . $missingcomment . " games don\'t have comments</strong> [ <a href='modules.php?name=$module_name&amp;m_op=fixdb&amp;fix=commentstable'>Fix Comments Table</a> ]<br />"
        : "<img src='modules/$module_name/images/icon_info.gif' border=0 width=16 height=16><strong>All games have their comments rows.</strong><br />";
    } else
        echo "<li><img src='modules/$module_name/images/icon_info.gif' border=0 width=16 height=16> <strong>Comments Module</strong> not found.";

    echo "</ul>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
function ShowDefault()
{
    global $module_name;
    include_once(NUKE_BASE_DIR.'header.php');
    menu();
    //echo "<br />";
    OpenTable();
    title("Arcade Tweaks Description :");
    echo "<strong>Thanks to test Arcade Tweaks RC2.</strong><br />";
    echo "Note that this module is <u>still</u> on Test Mode."
         ."<br />It has been tested succesfully on Nuke 6.8 and 7.6 with Arcade Mod V3."
         ."<br /> If you did installed the ATRC1 ,have already installed the Comments Mod and added some Games with it, check the <a href='modules.php?name=$module_name&amp;m_op=tools'>Tools functions</a> "
         ." (in particular the 'Database Coherence checking').<br /> ";
    echo "<br /><br />";
    echo "Please , Come to <a href=\"http://www.nukearcade.com/\">http://www.nukearcade.com</a> or <a href=\"http://www.thehorde.be/modules.php?name=Downloads&amp;d_op=viewdownload&amp;cid=5\">http://www.thehorde.be</a> for update and comments.";
    echo "<br />Rica<br /><span class='content'><ul>\n";
    echo "<li><a href='modules.php?name=$module_name&amp;m_op=checkswf'><strong>All SWF</strong></a>:<br />\n";
    echo "Browse your game directory and search unreferenced flash games.<br />Allow you to add them with a single click.(NB: Type 3 by default)" . "<br />Search for a picture with a similar base name in the picture directory.";
    echo "<br /><li><a href='modules.php?name=$module_name&amp;m_op=checkswf&amp;filefilter=unreferenced'><strong>Unreferenced SWF</strong></a>:<br />\n";
    echo "Same than above but only show unreferenced SWF";
    echo "<br /><li><a href='modules.php?name=$module_name&amp;m_op=checkDB'><strong>Check DB</strong></a>:<br />\n";
    echo "Analyse your games database.<br />Search for missing swf and pictures files.<br />Search for games without pics.<br />";
    echo "Change category, Flash Window Size, Reset Score";
    echo "<br /><li><a href='modules.php?name=$module_name&amp;m_op=category'><strong>Category</strong></a>:<br />\n";
    echo "Add , resync and check games categories";
    echo "<br /><li><a href='modules.php?name=$module_name&amp;m_op=tools'><strong>Tools</strong></a>:<br />\n";
    echo "Function added to process (remove , edit , etc) type 0,1,2 for the new arcade mod coming up.<br />";
    echo "Browser your pictures directory<br />";
    echo "</ul></span>\n";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
} 
// anti-hack
$cstart = isset($cstart)?intval($cstart):0;
$cend = isset($cend)?intval($cend):0;

if((isset($_POST['m_op']) && !empty($_POST['m_op'])) && (isset($_GET['m_op']) && !empty($_GET['m_op']))): 
  $m_op = (isset($_GET['m_op']) && !stristr($_GET['name'],'..') && !stristr($_GET['m_op'],'://')) ? addslashes(trim($_GET['m_op'])) : false;
else: 
  $m_op = (isset($_REQUEST['m_op']) && !stristr($_REQUEST['m_op'],'..') && !stristr($_REQUEST['m_op'],'://')) ? addslashes(trim($_REQUEST['m_op'])) : false;
endif;


switch ($m_op) {
    case "syncallcat":
        SyncAllCategories();
        break;
    case "resynccat":
        resynch_arcade_categorie($catid); 
        // Let's go back to category page
        ShowCategory();
        break;
    case "addcategory":
        CreateCategory($title);
        break;
    case "submitchange":
        SubmitChange();
        break;
    case "applychange":
        ApplyChange();
        break;
    case "checkDB":
        CheckDB();
        break;
    case "category":
        ShowCategory();
        break;
    case "checkswf":
        checkSwfDir();
        break;
    case "intelliad":
        IntelliAdd();
        break;
    case "viewpictures":
        ViewPictures();
        break;
    case "tools":
        Tools();
        break;
    case "searchdb":
        SearchDB();
    case "dbcoherence":
        DBCoherence();
        break;
    case "fixdb":
        FixDB();
        break;
    case "editcomment":
        EditComment();
        break;
    case "changecomment":
        ChangeComment();
        break;
    default:
        ShowDefault();
        break;
} 

?>