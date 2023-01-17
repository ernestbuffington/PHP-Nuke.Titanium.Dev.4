<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/*         Additional security & Abstraction layer conversion           */
/*                           2003 chatserv                              */
/*      http://www.nukefixes.com -- http://www.nukeresources.com        */
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
 ************************************************************************/

if(!defined('ADMIN_FILE')) {
  exit('Access Denied');
}

define('IN_SETTINGS', true);

function settings_header() 
{
    global $admin_file, $admlang;
    OpenTable();
    echo '<table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
    echo '  <tr>'.PHP_EOL;
    echo '    <td class="catHead" colspan="3" style="text-align: center;">'.$admlang['preferences']['config'].'</td>'.PHP_EOL;
    echo '  </tr>'.PHP_EOL;
    echo '  <tr>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=1">'.$admlang['preferences']['general'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=4">'.$admlang['preferences']['footer'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=7">'.$admlang['preferences']['comment_opts'].'</a></td>'.PHP_EOL;
    echo '  </tr>'.PHP_EOL;
    echo '  <tr>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=12">'.$admlang['preferences']['plugins'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=3">'.$admlang['preferences']['language_opts'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=8">'.$admlang['preferences']['graphics'].'</a></td>'.PHP_EOL;
    echo '  </tr>'.PHP_EOL;
    echo '  <tr>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=9">'.$admlang['preferences']['misc'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=11">'.$admlang['preferences']['meta'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=6">'.$admlang['preferences']['submissions'].'</a></td>'.PHP_EOL;
    echo '  </tr>'.PHP_EOL;
    echo '  <tr>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=10">'.$admlang['preferences']['security'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=5">'.$admlang['preferences']['backend'].'</a></td>'.PHP_EOL;
    echo '    <td class="row1" style="width: 33.3%;"><a href="'.$admin_file.'.php?op=Configure&sub=2">'.$admlang['preferences']['censor'].'</a></td>'.PHP_EOL;
    echo '  </tr>'.PHP_EOL;

    if(!isset($_GET['sub'])):
        echo '</table>'.PHP_EOL;
        CloseTable();
        echo '<br />'.PHP_EOL;
    endif;
}

function show_settings($sub) {
    global $admin_file, $admlang;
    include_once(NUKE_BASE_DIR.'header.php');
    OpenTable();
    echo "<div align=\"center\">\n".$admlang['preferences']['header']."</div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">".$admlang['global']['header_return']."</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    settings_header();


    if(isset($_GET['sub'])) 
    {
        // OpenTable();
        echo "<form action='".$admin_file.".php' method='post'>";
        // echo '  <tr>'.PHP_EOL;
        // echo '    <td class="row1" colspan="3">'.PHP_EOL;
    }
    switch($sub) 
    {
        case 1:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/general.php');
            break;

        case 2:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/censor.php');
            break;

        case 3:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/language.php');
            break;

        case 4:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/footer.php');
            break;

        case 5:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/backend.php');
            break;

        case 6:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/submissions.php');
            break;

        case 7:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/comments.php');
            break;

        case 8:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/graphicadmin.php');
            break;

        case 9:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/miscellaneous.php');
            break;

        case 10:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/security.php');
            break;

        case 11:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/meta.php');
            break;

        case 12:
            include_once(NUKE_ADMIN_MODULE_DIR.'settings/plugins.php');
            break;
    }


    if(isset($_GET['sub']))  
    {
        echo '    </td>'.PHP_EOL;
        echo '  </tr>'.PHP_EOL;
        echo '  <input type="hidden" name="sub" value="'.$sub.'" />';
        echo '  <input type="hidden" name="op" value="ConfigSave" />';
        echo '  <tr>'.PHP_EOL;
        echo '    <td class="catBottom" colspan="3" style="text-align: center;"><input style="cursor: pointer;" type="submit" value="'.$admlang['global']['save_changes'].'" /></td>'.PHP_EOL;
        echo '  </tr>'.PHP_EOL;
        echo '</table>'.PHP_EOL;
        
        echo '</form>';
        CloseTable();
    }
    include_once(NUKE_BASE_DIR.'footer.php');
}

function save_settings($sub) 
{
    global $db, $prefix, $admin_file, $cache, $admLang;

    switch($sub) {

        case 1:
            $xsitename = htmlentities($_POST['xsitename'], ENT_QUOTES);
            $xslogan = htmlentities($_POST['xslogan'], ENT_QUOTES);
            $xnukeurl = $_POST['xnukeurl'];
            $xsite_logo = htmlentities($_POST['xsite_logo'], ENT_QUOTES);
            $xstartdate = $_POST['xstartdate'];
            $xlocale = $_POST['xlocale'];
            $xadminmail = validate_mail($_POST['xadminmail']);
            Validate($xadminmail, 'email', 'Nuke Settings', 0, 1, 0, 0, '', '<br /><center>'. $admLang['ADMIN']['GOBACK'] .'</center>');
            $xtop = intval($_POST['xtop']);
            $xstoryhome = intval($_POST['xstoryhome']);
            $xoldnum = intval($_POST['xoldnum']);
            $xultramode = intval($_POST['xultramode']);
            $xanonpost = intval($_POST['xanonpost']);
            $confirm = intval($_POST["confirm"]);
            ValidateURL($xnukeurl, 0, "Site URL");
            $server_url = "https://" . $_SERVER["HTTP_HOST"];
            $pos = strrpos($_SERVER["PHP_SELF"],"/");
            if(!empty($pos)) {
                $server_url .= substr($_SERVER["PHP_SELF"],0,$pos);
            }
            if($xnukeurl != $server_url && empty($confirm)) {
                include_once(NUKE_BASE_DIR."header.php");
                OpenTable();
                echo "<center>". sprintf($admLang['ADMIN']['URL_CONFIRM_ERROR'], $xnukeurl,$server_url) ."<br /><br />".$admLang['ADMIN']['URL_SERVER_ERROR'];
                echo "<form action='".$admin_file.".php?op=ConfigSave' method='post'>";
                foreach ($_POST as $key => $value) {
                    echo "<input type='hidden' name='".$key."' value='".$value."'>";
                }
                echo "<input type='hidden' name='confirm' value='1'>";
                echo "<input type='submit' value='" . _YES . "'></form>";
                echo "<form action='".$admin_file.".php?op=Configure&sub=".$sub."' method='post'><input type='submit' value='" . _NO . "'></form></center>";
                CloseTable();
                include_once("footer.php");
            }
            $db->sql_query("UPDATE ".$prefix."_config SET sitename='$xsitename', 
			                                                nukeurl='$xnukeurl', 
														site_logo='$xsite_logo', 
														      slogan='$xslogan', 
														startdate='$xstartdate',
														adminmail='$xadminmail', 
														  anonpost='$xanonpost', 
														            top='$xtop', 
														storyhome='$xstoryhome', 
														      oldnum='$xoldnum', 
													    ultramode='$xultramode', 
														      locale='$xlocale'");
		
		break;

        case 2:
            $xcensor = intval($_POST['xcensor']);
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xcensor."' WHERE evo_field='censor'");
            $xcensor_words = str_replace("\n"," ", $_POST['xcensor_words']);
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xcensor_words."' WHERE evo_field='censor_words'");
        break;

        case 3:
            $xlanguage = Fix_Quotes(strtolower($_POST['xlanguage']));
            $xmultilingual = intval($_POST['xmultilingual']);
            $xuseflags = intval($_POST['xuseflags']);
            $db->sql_query("UPDATE ".$prefix."_config SET multilingual='$xmultilingual', useflags='$xuseflags', language='$xlanguage'");
        break;

        case 4:
            $xfoot1 = Fix_Quotes($_POST['xfoot1']);
            $xfoot2 = Fix_Quotes($_POST['xfoot2']);
            $xfoot3 = Fix_Quotes($_POST['xfoot3']);
            $db->sql_query("UPDATE ".$prefix."_config SET foot1='$xfoot1', foot2='$xfoot2', foot3='$xfoot3'");
        break;

        case 5:
            $xbackend_title = htmlentities($_POST['xbackend_title'], ENT_QUOTES);
            $xbackend_language = Fix_Quotes($_POST['xbackend_language']);
            $db->sql_query("UPDATE ".$prefix."_config SET backend_title='$xbackend_title', backend_language='$xbackend_language'");
        break;

        case 6:
            $xnotify_subject = htmlentities($_POST['xnotify_subject'], ENT_QUOTES);
            $xnotify = intval($_POST['xnotify']);
            $xnotify_email = validate_mail($_POST['xnotify_email']);
            $xnotify_message = $_POST['xnotify_message'];
            $xnotify_from = $_POST['xnotify_from'];
            $db->sql_query("UPDATE ".$prefix."_config SET notify='$xnotify', notify_subject='$xnotify_subject', notify_email='$xnotify_email', notify_message='$xnotify_message', notify_from='$xnotify_from'");
        break;

        case 7:
            $xmoderate = intval($_POST['xmoderate']);
            $xcommentlimit = intval($_POST['xcommentlimit']);
            $xanonymous = Fix_Quotes($_POST['xanonymous']);
            $db->sql_query("UPDATE ".$prefix."_config SET moderate='$xmoderate', commentlimit='$xcommentlimit', anonymous='$xanonymous'");
        break;

        case 8:
            $xadmingraphic = intval($_POST['xadmingraphic']);
            $xadmin_pos = intval($_POST['xadmin_pos']);
            $db->sql_query("UPDATE ".$prefix."_config SET admingraphic='$xadmingraphic', admin_pos='$xadmin_pos'");
        break;

        case 9:
            $xhttpref = intval($_POST['xhttpref']);
            $xhttprefmax = intval($_POST['xhttprefmax']);
            $xpollcomm = intval($_POST['xpollcomm']);
            $xarticlecomm = intval($_POST['xarticlecomm']);
            $xmy_headlines = intval($_POST['xmy_headlines']);
            $xadminssl = intval($_POST['xadminssl']);
            $xqueries_count = intval($_POST['xqueries_count']);
            $xuse_colors = intval($_POST['xuse_colors']);
            $xlock_modules = intval($_POST['xlock_modules']);
            $xbanners = intval($_POST['xbanners']);
            $xlazytap = intval($_POST['xlazytap']);
            
			$xtextarea = $_POST['xtextarea'];
            
			$ximg_resize = intval($_POST['ximg_resize']);
            $ximg_width = intval($_POST['ximg_width']);
            $ximg_height = intval($_POST['ximg_height']);
            lazy_tap_check($xlazytap);
            $xcollapse = intval($_POST['xcollapse']);
            $xcollapsetype = intval($_POST['xcollapsetype']);
            $xanalytics = $_POST['xanalytics'];
            $xblock_cachetime  = intval($_POST['xblock_cachetime']);
			$xhtml_auth = $_POST['xhtml_auth'];
            $db->sql_query("UPDATE ".$prefix."_config SET httpref='$xhttpref', httprefmax='$xhttprefmax', pollcomm='$xpollcomm', articlecomm='$xarticlecomm', my_headlines='$xmy_headlines', banners='$xbanners'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xadminssl."' WHERE evo_field='adminssl'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xqueries_count."' WHERE evo_field='queries_count'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xuse_colors."' WHERE evo_field='use_colors'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xlock_modules."' WHERE evo_field='lock_modules'");
            
			$db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xtextarea."' WHERE evo_field='textarea'");
			
			$db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xlazytap."' WHERE evo_field='lazy_tap'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$ximg_resize."' WHERE evo_field='img_resize'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$ximg_width."' WHERE evo_field='img_width'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$ximg_height."' WHERE evo_field='img_height'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xcollapse."' WHERE evo_field='collapse'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xcollapsetype."' WHERE evo_field='collapsetype'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xanalytics."' WHERE evo_field='analytics'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xblock_cachetime."' WHERE evo_field='block_cachetime'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xhtml_auth."' WHERE evo_field='html_auth'");
        break;

        case 10:
            $admin_fc_status = intval($_POST['admin_fc_status']);
            $admin_fc_attempts = intval($_POST['admin_fc_attempts']);
            $admin_fc_timeout = intval($_POST['admin_fc_timeout']);
            $admin_iphub_status = intval($_POST['admin_iphub_status']);
            $admin_iphub_key = $_POST['admin_iphub_key'];
            $admin_iphub_ctime = intval($_POST['admin_iphub_ctime']);
            $recapcolor = $_POST['recap_color'];
            $recaplang = $_POST['recap_lang'];
            $recap_site_key = $_POST['recap_skey'];
            $recap_private_key = $_POST['recap_pkey'];
            $xusegfxcheck = intval($_POST['xusegfxcheck']);

            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$admin_fc_status."' WHERE evo_field='admin_fc_status'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$admin_fc_attempts."' WHERE evo_field='admin_fc_attempts'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$admin_fc_timeout."' WHERE evo_field='admin_fc_timeout'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$admin_iphub_status."' WHERE evo_field='iphub_status'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$admin_iphub_key."' WHERE evo_field='iphub_key'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$admin_iphub_ctime."' WHERE evo_field='iphub_cookietime'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$recapcolor."' WHERE evo_field='recap_color'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$recaplang."' WHERE evo_field='recap_lang'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$recap_site_key."' WHERE evo_field='recap_site_key'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$recap_private_key."' WHERE evo_field='recap_priv_key'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$xusegfxcheck."' WHERE evo_field='usegfxcheck'");
        break;

        case 11:
            if($_GET['act'] == "delete") {
                if(!empty($_GET['meta'])) {
                    $db->sql_query("DELETE FROM " . $prefix . "_meta WHERE meta_name = '" . $_GET['meta'] . "'");
                }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $cache->delete('metatags', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            } else {
                $sql = 'SELECT meta_name, meta_content FROM '.$prefix.'_meta';
                $result = $db->sql_query($sql);
                $i=0;
                while(list($meta_name, $meta_content) = $db->sql_fetchrow($result)) {
                    $metatags[$i] = array();
                    $metatags[$i]['meta_name'] = $meta_name;
                    $metatags[$i]['meta_content'] = $meta_content;
                    $i++;
                }
                $db->sql_freeresult($result);

                for($i=0, $maxi=count($metatags);$i<$maxi;$i++) {
                    $metatag = $metatags[$i];
                    $db->sql_query("UPDATE ".$prefix."_meta SET meta_content='".$_POST['x' . $metatag['meta_name']]."' WHERE meta_name='".$metatag['meta_name']."'");
                }
                if(!empty($_POST['new_name']) && (!empty($_POST['new_value']) || $_POST['new_value'] == '0')) {
                    $db->sql_query("INSERT INTO ".$prefix."_meta (meta_name, meta_content) VALUES ('" . $_POST['new_name'] . "', '" . $_POST['new_value'] . "')");
                }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $cache->delete('metatags', 'config');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            }
         break;

         case 12:
            # PRIVATE MESSAGES POPUP ALERT by Lonestar of lonestar-modules.com
            $pm_alert_status = intval($_POST['pm_alert_status']);
            $pm_cookie_name = $_POST['pm_cookie_name'];
            $pm_cookie_minutes = intval($_POST['pm_cookie_minutes']);
            $pm_cookie_seconds = intval($_POST['pm_cookie_seconds']);
            $pm_overlay_color = $_POST['pm_overlay_color'];
            $pm_button_color = $_POST['pm_button_color'];
            $pm_button_color2 = $_POST['pm_button_color2'];
            $pm_alert_sound = intval($_POST['pm_alert_sound']);
            $ximg_viewer = $_POST['img_viewer'];            
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_alert_status."' WHERE evo_field='pm_alert_status'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_cookie_name."' WHERE evo_field='pm_cookie_name'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_cookie_minutes."' WHERE evo_field='pm_cookie_minutes'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_cookie_seconds."' WHERE evo_field='pm_cookie_seconds'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_overlay_color."' WHERE evo_field='pm_overlay_color'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_button_color."' WHERE evo_field='pm_button_color'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_button_color2."' WHERE evo_field='pm_button_color2'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$pm_alert_sound."' WHERE evo_field='pm_alert_sound'");
            $db->sql_query("UPDATE "._EVOCONFIG_TABLE." SET evo_value='".$ximg_viewer."' WHERE evo_field='img_viewer'");
            break;
    }

	# This should have been in the very 1st relase of Evolution	added by Ernest Buffington
	# Anytime you modify the settings for the website it updates the proper fields.
	# This information is used to tell the crawlers/bots when the website was last updated on the index page.
	# Reference : https://stackoverflow.com/questions/267658/having-both-a-created-and-last-updated-timestamp-columns-in-mysql-4-0												  
    //$db->sql_query("UPDATE ".$prefix."_config(datePublished, dateModified) values(null, null)");
	
	$cache->delete('nukeconfig', 'config');
    $cache->delete('titanium_evoconfig', 'config');
    redirect($admin_file.'.php?op=Configure&sub='.$sub);
}

function lazy_tap_check($set) 
{
    global $admLang;
    if ($set == 0){
        return true;
    }
    $filename = NUKE_BASE_DIR . '.htaccess';
    if(!is_file($filename)) {
        DisplayError($admLang['MISCELLANEOUS']['LAZY_TAP_NF']);
    }
    if($handle = @fopen($filename,"r")) {
        $content = @fread($handle, filesize($filename));
        @fclose($handle);
    } else {
        DisplayError($admLang['MISCELLANEOUS']['LAZY_TAP_ERROR_OPEN']);
    }
    if (empty($content)) {
        DisplayError($admLang['MISCELLANEOUS']['LAZY_TAP_ERROR']);
    }
    $pos = strpos($content,'RewriteEngine on');
    $pos2 = strpos($content,'RewriteRule');
    if ($pos === false || $pos2 === false) {
        DisplayError($admLang['MISCELLANEOUS']['LAZY_TAP_ERROR']);
    }
}
?>
