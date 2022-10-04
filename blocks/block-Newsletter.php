<?php

if(!defined('NUKE_EVO')) exit;

global $pnt_db, $pnt_user_prefix, $userinfo;

if (is_user()) {
    $newsletter = $userinfo['newsletter'];
    $pnt_user_id = $userinfo['user_id'];
    if ($newsletter) {
        $message = _NEWSLETTERBLOCKSUBSCRIBED;
        $action = '<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input type="submit" name="nb_unsubscribe" value="'._NEWSLETTERBLOCKUNSUBSCRIBE.'" /></form>';
        if (isset($_POST['nb_unsubscribe'])) {
            $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET newsletter='0' WHERE user_id='$pnt_user_id'");
            redirect_titanium($_SERVER['REQUEST_URI']);
        }
    } else {
        $message = _NEWSLETTERBLOCKNOTSUBSCRIBED;
        $action = '<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><input type="submit" name="nb_subscribe" value="'._NEWSLETTERBLOCKSUBSCRIBE.'" /></form>';
        if (isset($_POST['nb_subscribe'])) {
            $pnt_db->sql_query("UPDATE ".$pnt_user_prefix."_users SET newsletter='1' WHERE user_id='$pnt_user_id'");
            redirect_titanium($_SERVER['REQUEST_URI']);
        }
    }
} else {
    $message = _NEWSLETTERBLOCKREGISTER;
    $action = '<a href="modules.php?name=Your_Account&amp;op=new_user" title="'._NEWSLETTERBLOCKREGISTERNOW.'">'._NEWSLETTERBLOCKREGISTERNOW.'</a>';
}

$content = '<div align="center"><img src="images/admin/newsletter.png" alt="'._NEWSLETTER.'" title="'._NEWSLETTER.'" /><br /><br />'.$message.'<br /><br />'.$action.'</div>';

?>