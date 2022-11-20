<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


if (!defined('MODULE_FILE')) {
   die('You can\'t access this file directly...');
}

global $_GETVAR;
$_GETVAR->unsetVariables();

$module_name = basename(dirname(__FILE__));
get_lang($module_name);

define('NUKE_DONATIONS', dirname(__FILE__) . '/');
define('NUKE_DONATIONS_INCLUDES', NUKE_DONATIONS . 'includes/');

include_once(NUKE_DONATIONS_INCLUDES . 'base.php');

function donation_index() {
    global $lang_donate;
    donation_title();
    OpenTable();
    echo "<div class=\"acenter\">\n";
    echo "<a href=\"modules.php?name=Donations&op=view\"><img src=\"images/donations/view.png\" border=\"0\" alt=\"".$lang_donate['VIEW_DONATIONS']."\"><br />".$lang_donate['VIEW_DONATIONS']."</a><br /><br />";
    echo "<a href=\"modules.php?name=Donations&op=make\"><img src=\"images/donations/money.png\" border=\"0\" alt=\"".$lang_donate['MAKE_DONATIONS']."\"><br />".$lang_donate['MAKE_DONATIONS']."</a>";

    echo "</div>\n";
    CloseTable();
}

// global $more_js;
$donation_js = '<script>
function createCookie(name, value, days)
{
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
    }
  else var expires = "";
  document.cookie = name+"="+value+expires+";";
}
function donationcookie() {
   createCookie("DONATION", "1", 1);
}
</script>';
addCSSToHead($donation_js,'inline');

$op = $_GETVAR->get('op', 'REQUEST');

include_once(NUKE_BASE_DIR.'header.php');
switch ($op) {
    case 'thankyou':
        include_once(NUKE_DONATIONS_INCLUDES . 'thankyou.php');
    break;
    case 'cancel':
        include_once(NUKE_DONATIONS_INCLUDES . 'cancel.php');
    break;
    case 'make':
        include_once(NUKE_DONATIONS_INCLUDES . 'make.php');
    break;
    case 'view':
        include_once(NUKE_DONATIONS_INCLUDES . 'view.php');
    break;
    case 'confirm':
        include_once(NUKE_DONATIONS_INCLUDES . 'confirm.php');
    break;
    default:
        donation_index();
    break;
}
include_once(NUKE_BASE_DIR.'footer.php');

?>