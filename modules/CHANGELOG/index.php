<?php
#########################################################################
# Titanium CHANGELOG v2.0                                               #
#########################################################################
# PHP-Nuke Titanium : Enhanced PHP-Nuke Web Portal System               #
#########################################################################
# [CHANGES]                                                             #
# Table Header Module Fix by TheGhost               v1.0.0   01/30/2012 #
# Nuke Patched                                      v3.1.0   06/26/2005 #
#########################################################################
if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}



$titanium_module_name = basename(dirname(__FILE__));

if ( isset($HTTP_GET_VARS['name']) || isset($HTTP_POST_VARS['name']) )
{
        $name = ( isset($HTTP_POST_VARS['name']) ) ? htmlspecialchars($HTTP_POST_VARS['name']) : htmlspecialchars($HTTP_GET_VARS['name']);
}
else
{
        $name = '';
}

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
        $mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
        $mode = '';
}
//
// Generate page
//
global $titanium_module_name;

$titanium_title = 'Live Change Log v11.1';
$pagetitle = 'PHP-Nuke Titanium &raquo; '.$titanium_title;

if(!isset($titanium_module_name) || empty($titanium_module_name)){
    $titanium_module_name = basename(dirname(__FILE__));
}
get_lang($titanium_module_name);
 
include_once(NUKE_MODULES_DIR.$titanium_module_name.'/includes/functions.php');
include_once(NUKE_INCLUDE_DIR.'titanium_base_dir.php');

define(CUR_TITANIUM, strtolower(TITANIUM_EDITION));
function titanium_check_version() {
    $ver = titanium_get_version();
    return (NUKE_EVO == $ver) ? 0 : 1;
}

include(NUKE_BASE_DIR.'header.php');
#########################################################################
# Table Header Module Fix Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
if(!function_exists('OpenTableModule')) 
OpenTable();
else
OpenTableModule();
#########################################################################
# Table Header Module End Start - by TheGhost   v1.0.0     01/30/2012
#########################################################################
global $chnangelogstatus, $myappid;

//$titanium_browser = new Browser();
echo "<br />";
//include (NUKE_INCLUDE_DIR."/facebook/facebook.php");

global $myappid, $secret;
    
		
$style = "<link rel=\"stylesheet\" href=\"modules/$titanium_module_name/style/style.css\" type=\"text/css\">\n";
echo $style;

$favicon = img('chrome_logo.png', 'CHANGELOG'); 
//echo $favicon;
//echo $favicon;
?>
<table width="100%" cellspacing="2" cellpadding="2" >
	<tr>
		<td align="left" valign="top" class="row1" width="10">
		<a href="modules.php?name=CHANGELOG"><img border="0" width="60" align=top src="<?=$favicon?>" alt="PHP-Nuke Titanium" title="PHP-Nuke Titanium" hspace="5" vspace="5"></a></td>
		<td class="row2" align="left" width="100%" valign="top" >
        <?
        $chnangelogstatus = "";
	
		titanium_version();        
		
		?>
        </td>
	    </tr>
	    <td colspan="2">
	    

<?







if ($titanium_user) 
{
//echo "<hr>";
//echo "<b><font color=\"#3b5998\">facebook</font></b> currently has over <font color=red>350,000</font> developers and entrepreneurs from <font color=red>225</font> countries."; 
//echo "<hr>";
//echo "<b><font color=\"#3b5998\">facebook</font></b> currently has over <font color=red>800 million</font> users. (Soon to be <font color=red>1 Billion</font> users."; 
//echo "<hr>"; 
   // proceed knowing you have a logged in user who's authenticated
} 
else 
{
   // proceed knowing you require user login and/or authentication
}

global $domain, $facebook_plugin_width, $name;
//facebook likebutton
?>
<br />
<center>
      <div class="fb-like" data-href="http://<?=$domain?>/modules.php?name=<?=$name?>" ref="<?=$name?>" data-send="false"  width="<?=$facebook_plugin_width?>" show_faces="true" font="verdana"></div>
<br /><br /><div class="fb-comments" data-href="http://<?=$domain?>/modules.php?name=<?=$name?>" ref="<?=$name?>" data-num-posts="5" data-width="<?=$facebook_plugin_width?>">
</div>
</center>
</table>
<br />
<?php
CloseTable();
echo "<br />";
include(NUKE_BASE_DIR.'footer.php');
?> 
