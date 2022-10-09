<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   Nuke-Evolution: Advanced Content Management System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : adminlog.php
   Author        : Technocrat (www.nuke-evolution.com)
   Version       : 1.0.1
   Date          : 06/08/2005 (dd-mm-yyyy)

   Notes         : Admin Tracker stores failed admin logins.
************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Admin Tracker                            v1.0.1       06/08/2005
      Caching System                           v1.0.0       10/31/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

global $prefix, $db, $admdata;

//Clear log is fine you have to be an admin to gain access to it

$log = ($_GET['log']) ? $_GET['log'] : die("Invalid Operation");

if (is_mod_admin()) 
{
    function view_log($file) 
    {
        global $admin_file, $admlang;

        # GRAB THE LOG FILE YOU ARE VIEWING
        $filename = NUKE_INCLUDE_DIR.'log/'.$file.'.log';
        echo '<table style="width: 100%; table-layout:fixed" border="0" cellpadding="3" cellspacing="1" class="forumline">';
        echo '  <tr>';
        echo '    <td class="catHead acenter" style="font-weight: bold; width: 100%;">'.$admlang['logs']['header'].'</td>';
        echo '  </tr>';
        if(!is_file($filename))
        {
            echo '  <tr>';
            echo '    <td class="row1" style="font-size: 13px; font-weight: bold; text-align: center; text-transform: uppercase; width: 100%;">'.$admlang['logs']['not_found'].'</td>';
            echo '  </tr>';
        }
        else
        {
            if(filesize($filename) == 0) 
            {
                echo '  <tr>';
                echo '    <td class="row1 acenter" style="width: 100%;">'.$admlang['logs']['is_clear'].'</td>';
                echo '  </tr>';
                echo '  <tr>';
                echo '    <td class="catBottom acenter" style="font-weight: bold; width: 100%;">';
                echo '      <a href="'.$admin_file.'.php">'.$admlang['global']['back'].'</a>&nbsp;|&nbsp;';
                echo '      <a href="'.$admin_file.'.php?op=adminlog_clear&log='.$file.'"><span style="color:red">'.$admlang['logs']['clear'].'</span></a>';
                echo '    </td>';
                echo '  </tr>';
                echo '</table>';
                return;
            }
            if($handle = @fopen($filename,"r")) 
            {
                $content = @fread($handle, filesize($filename));
                @fclose($handle);
            }
            echo '  <tr>';
            echo '    <td class="row1">';
            echo '      <div style="height: 50em; overflow: auto;">'.nl2br($content).'</div>';
            echo '    </td>';
            echo '  </tr>';
            echo '  <tr>';
            echo '    <td class="catBottom acenter" style="font-weight: bold; width: 100%;">';
            echo '      <a href="'.$admin_file.'.php">'.$admlang['global']['back'].'</a>&nbsp;';
            echo '      <a href="'.$admin_file.'.php?op=adminlog_clear&log='.$file.'"><span style="color:red">'.$admlang['logs']['clear'].'</span></a>';
            echo '    </td>';
            echo '  </tr>';
        }        
        echo '</table>';
    }

    function log_clear($file) 
    {
        global $db, $prefix, $admin_file, $cache, $admlang;

        echo "<div align='center'>";
        echo "".$admlang['logs']['cleared']."<br /><br />";
        $filename = NUKE_INCLUDE_DIR."log/" . $file . ".log";
        if(!is_file($filename)) {
            echo "<div align='center'><strong><span style='color:red'>".$admlang['logs']['not_found']."</span></strong></div>";
        } else {
            if(!$handle = fopen($filename,"w")) {
                echo $admLang['LOGS']['TRACKER_ERR_OPEN'];
            } else {
                fwrite($handle, "");
                fclose($handle);
                $sql_log = "UPDATE ".$prefix."_config SET " . $file . "_log_lines='0'";
                if(!$db->sql_query($sql_log)) {
                   die(mysql_error());
                }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $cache->delete('nukeconfig');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            }
        }
        echo "<br /><br /><a href='".$admin_file.".php'>".$admlang['global']['back']."</a>";
        echo "</div>";
    }

    if ($admdata['radminsuper'] == 1) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        switch ($op) {
            case "adminlog_ack":
            case "viewadminlog":
                view_log($log);
            break;
            case "adminlog_clear":
                log_clear($log);
            break;
        }
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }

} else {
    echo 'Access Denied';
}

?>