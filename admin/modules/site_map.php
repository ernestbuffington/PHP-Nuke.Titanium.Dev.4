<?php
/************************************************************************/
/* [Google-Site-Map] 1.0 by TheGhost              			            */
/* =================================                                    */
/* Copyright (c) 2021 by The 86it Developers Network          			*/
/* http://www.86it.us                                                   */
/************************************************************************/
if ( !defined('ADMIN_FILE') ) die ("Access Denied");

if (!is_mod_admin()) die ("Access Denied");

global $pnt_prefix, $pnt_db, $sitename, $currentlang, $admin_file;

if (file_exists(NUKE_MODULES_DIR.'Google-Site-Map/language/lang-'.$currentlang.'.php')):
    include_once(NUKE_MODULES_DIR.'Google-Site-Map/language/lang-'.$currentlang.'.php');
else:
    include_once(NUKE_MODULES_DIR.'Google-Site-Map/language/lang-english.php');
endif;


$result = $pnt_db->sql_query("SELECT * FROM ".$pnt_prefix."_jmap");
    
	while ($row=$pnt_db->sql_fetchrow($result)):
        $nametask = $row["name"];
        $value = $row["value"];
        $conf[$nametask]=$value;
    endwhile;
	  
$xml = $conf["xml"];
$ndown = $conf["ndown"];
$nnews = $conf["nnews"];
$nrev = $conf["nrev"];
$ntopics = $conf["ntopics"];
$nuser = $conf["nuser"];

include(NUKE_BASE_DIR.'header.php');

Opentable();
print '<div align="center"><strong>'._GOOGLE_SITEMAPADMIN.'</strong></div><br />';

print '<div align="center">';
print '<table class="googlesitemap" align="center" border="5" cellpadding="15" cellspacing="20" dir="ltr" id="googlesitemap">';
print '<tbody>';
print '<tr>';
print '<td>';

            print'
                <form action="'.$PHP_SELF.'" method="post">
                    <table border="0" id="table6" width="50%" align="center">
                        <tr>
                            <td width="50%" height="30%" align="center">
                    <table border="0" width="588" id="table7" height="296">
                        <tr>
                            <td width="146" height="102">
                                <p align="left">'._XMLCREATE.'</td>
                            <td height="102">';
        if($xml==1) {
            print '<p align="left">'._YES.'&nbsp;<input name="xml" type="radio" value="1" checked>
                                                '._NO.'&nbsp;<input name="xml" type="radio" value="0" ></p>';
        }
        else {
            print '<p align="left">'._YES.'&nbsp;<input name="xml" type="radio" value="1" >
                                                '._NO.'&nbsp;<input name="xml" type="radio" value="0" checked></p>';
        }
            print '            </td>
                            <td height="102">
                                <p align="left">'._BDOWN.'</td>
                            <td height="102">
                                &nbsp;<p align="left"><input name="ndown" size="6" value="'.$ndown.'"></p>
                                <p align="left">&nbsp;</td>
                            </tr>
                            <tr>
                            <td width="146" height="102">
                                <p align="left">Blogs</td>
                            <td width="146" height="102">
                                <p align="left">&nbsp; </p>
                                <p align="left"><input name="nnews" size="6" value="'.$nnews.'"></p>
                                &nbsp;</td>
                            <td width="147" height="102">
                                <p align="left">'._BREV.'</td>
                            <td width="147" height="102">&nbsp;<p align="left">
                                <input name="nrev" size="6" value="'.$nrev.'"></p>
                                <p align="left">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="146" height="102">
                                <p align="left">'._NTOPICS.'</td>
                            <td width="146" height="102">
                                <p align="left">&nbsp; </p>
                                <p align="left"><input name="ntopics" size="6" value="'.$ntopics.'"></p>
                            &nbsp;</td>
                            <td width="147" height="102">
                                <p align="left">'._BUSER.'</td>
                            <td width="147" height="102">&nbsp;<p align="left">
                                <input name="nuser" size="6" value="'.$nuser.'"></p>
                                <p align="left">&nbsp;</td>
                        </tr>
                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" height="72">
                <table border="0" width="566" id="table14">
                    <tr>
                        <td width="188">&nbsp;</td>
                        <td width="164">
                            <p align="center"><input type="submit" value="'._OK.'" name="ok"></p>
                            <p align="center">&nbsp;</td>
                        <td width="200">&nbsp;</td>
                       </tr>
                </table></td>
                </tr>
            </table>
            </form>
';

            $xml=htmlspecialchars($_POST['xml']);
            $nnews=htmlspecialchars($_POST['nnews']);
            $ntopics=htmlspecialchars($_POST['ntopics']);
            $ndown=htmlspecialchars($_POST['ndown']);
            $nrev=htmlspecialchars($_POST['nrev']);
            $nuser=htmlspecialchars($_POST['nuser']);

            if( $xml!="" && $nnews!="" && $ntopics!="" && $ndown!="" && $nrev!="" && $nuser!="" )
            {
            //$pnt_db->sql_query("UPDATE ".$pnt_prefix."_jmap SET xml = ".$xml.", nnews = ".$nnews.", ntopics = ".$ntopics.", ndown = ".$ndown.", nrev = ".$nrev.", nuser = ".$nuser);
            $pnt_db->sql_query("UPDATE " . $pnt_prefix . "_jmap SET value = '".$xml."' WHERE name = 'xml'");
            $pnt_db->sql_query("UPDATE " . $pnt_prefix . "_jmap SET value = '".$nnews."' WHERE name = 'nnews'");
            $pnt_db->sql_query("UPDATE " . $pnt_prefix . "_jmap SET value = '".$ntopics."' WHERE name = 'ntopics'");
            $pnt_db->sql_query("UPDATE " . $pnt_prefix . "_jmap SET value = '".$ndown."' WHERE name = 'ndown'");
            $pnt_db->sql_query("UPDATE " . $pnt_prefix . "_jmap SET value = '".$nrev."' WHERE name = 'nrev'");
            $pnt_db->sql_query("UPDATE " . $pnt_prefix . "_jmap SET value = '".$nuser."' WHERE name = 'nuser'");

            Header("Location: ".$admin_file.".php?op=site_map");
            }


           print '<div align="center">[ <a href="'.$admin_file.'.php?op=site_map">'._GOOGLE_SITEMAP_ADMIN_HEADER.'</a> ]</div>';
           print '<div align="center">[ <a href="'.$admin_file.'.php">' . _GOOGLE_SITEMAP_RETURNMAIN . '</a> ]</div>';


print '</td>';
print '</tr>';
print '</tbody>';
print '</table>';
print '</div>';

print'
<script type="text/javascript">
 <!--
 function copy() {
   var w = 400;
   var h = 350;
   var l = Math.floor((screen.width-w)/2);
   var t = Math.floor((screen.height-h)/2);
      window.open("modules/Google-Site-Map/copyright.php","","width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
 }
 //-->
</script>';
print '<div align="center"><a href="javascript:copy()">&copy; Google Site Map</a></div>';

Closetable();

include(NUKE_BASE_DIR.'footer.php');


switch ($op) :
    case "site_map":
    break;
endswitch;
