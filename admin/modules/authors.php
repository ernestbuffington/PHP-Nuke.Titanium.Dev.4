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
      Evolution Functions                      v1.5.0       12/20/2005
 ************************************************************************/
if (!defined('ADMIN_FILE')) 
die ('Illegal File Access');

global $prefix, $db;

if (is_mod_admin()) 
{
/*********************************************************/
/* Admin/Authors Functions                               */
/*********************************************************/
function displayadmins() 
{
    global $admin, $prefix, $db, $language, $multilingual, $admin_file, $admlang;
    if (is_admin()) {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo '<div style="text-align: center; margin-bottom: 20px;">[ <a href="'.$admin_file.'.php?op=mod_authors">'.$admlang['authors']['header'].'</a> ]
		<br />[ <a href="'.$admin_file.'.php">'.$admlang['global']['header_return'].'</a> ]</div>';
        
		echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" colspan="6" style="text-align: center; text-transform: uppercase;">'.$admlang['authors']['header'].'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" colspan="6" style="text-align: center; text-transform: uppercase;">'.$admlang['authors']['god'].'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" style="text-align: center; width: 5%;">#</td>'."\n";
        echo '    <td class="catHead" style="text-transform: uppercase; width: 25%;">'.$admlang['authors']['author'].'</td>'."\n";
        echo '    <td class="catHead" style="text-transform: uppercase; width: 25%;">'.$admlang['global']['email'].'</td>'."\n";
        echo '    <td class="catHead" style="text-align: center; text-transform: uppercase; width: 15%;">'.$admlang['global']['language'].'</td>'."\n";
        echo '    <td class="catHead" style="text-align: center; text-transform: uppercase; width: 15%;">'.$admlang['authors']['option1'].'</td>'."\n";
        echo '    <td class="catHead" style="text-align: center; text-transform: uppercase; width: 15%;">'.$admlang['global']['delete'].'</td>'."\n";
        echo '  </tr>'."\n";
        $result = $db->sql_query("SELECT `aid`, `email`, `name`, `admlanguage`, `url` FROM `".$prefix."_authors`");
        $countAuthor = 1;
        while ($row = $db->sql_fetchrow($result)) 
        {
            $admlanguage    = $row['admlanguage'];
            $authorID       = substr((string) $row['aid'], 0,25);
            $name           = substr((string) $row['name'], 0,50);
            if (empty($admlanguage)) 
                $admlanguage = $admlang['global']['all'];

            if($row['url'])
                $authorURL = '<span style="float:right;"><a href="'.$row['url'].'"><span class="ml-sprite ml-www tooltip"></span></a></span>';
            else
                $authorURL = '';

            $row_class = ($countAuthor % 2) ? 'row1' : 'row2';

            echo '  <tr>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;">'.$countAuthor.'</td>'."\n";
            echo '    <td class="'.$row_class.'"><span style="float:left;">'.$authorID.'</span>'.$authorURL.'</td>'."\n";
            echo '    <td class="'.$row_class.'">'.$row['email'].'</td>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;">'.$admlanguage.'</td>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;"><a href="'.$admin_file.'.php?op=modifyadmin&amp;chng_aid='.$authorID.'">'.$admlang['authors']['modify'].'</a></td>'."\n";
            echo '    <td class="'.$row_class.'" style="text-align: center;">'.(($name == 'God') ? $admlang['authors']['main'] : '<a href="'.$admin_file.'.php?op=deladmin&amp;del_aid='.$authorID.'">'.$admlang['global']['delete'].'</a>').'</td>'."\n";
            echo '  </tr>'."\n";
            $countAuthor++;
        }

        echo '  <tr>'."\n";
        echo '    <td class="catBottom" colspan="6" style="text-align: center;">[ <a href="'.$admin_file.'.php">'.$admlang['global']['header_return'].'</a> ]</td>'."\n";
        echo '  </tr>'."\n";
        echo '</table>'."\n";

        echo '<br />';

        echo '<form action="'.$admin_file.'.php" method="post" name="newauthor">';
        echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" colspan="2" style="text-align: center; text-transform: uppercase;">'.$admlang['authors']['add'].'</td>'."\n";
        echo '  </tr>'."\n";
        # Author username
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%;">';
        echo '      <span style="float: left; margin: 2px;">'.$admlang['global']['name'].'</span>';
        echo '      <span class="evo-sprite help tooltip float-right" title="'.$admlang['authors']['can_not'].'"></span>';
        echo '    </td>'."\n";
        echo '    <td class="row1" style="width: 50%;"><input type="text" name="add_name" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '  </tr>'."\n";
        # Author Nickname field
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%;">'.$admlang['global']['nickname'].'</td>'."\n";
        echo '    <td class="row1" style="width: 50%;"><input type="text" name="add_aid" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '  </tr>'."\n";
        # Author Email
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%;">'.$admlang['global']['email'].'</td>'."\n";
        echo '    <td class="row1" style="width: 50%;"><input type="text" name="add_email" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '  </tr>'."\n";
        # Author URL
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%;">'.$admlang['global']['url'].'</td>'."\n";
        echo '    <td class="row1" style="width: 50%;"><input type="text" name="add_url" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '  </tr>'."\n";
        # Author Language selection
        if ($multilingual == 1) 
        {
            $languageslist = lang_list();
            echo '  <tr>'."\n";
            echo '    <td class="row1" style="width: 50%;">'.$admlang['global']['language'].'</td>'."\n";
            echo '    <td class="row1" style="width: 50%;">';
            echo '      <select name="add_admlanguage">';
            for ($i = 0, $maxi = is_countable($languageslist) ? count($languageslist) : 0; $i < $maxi; $i++) 
            {
                if(!empty($languageslist[$i])) 
                {
                    echo '        <option name="xlanguage" value="'.$languageslist[$i].'"'.(($languageslist[$i]==$language) ? ' selected="selected"' : '').'>'.ucwords((string) $languageslist[$i]).'</option>';     
                }
            }            
            echo '      </select>';
            echo '    </td>'."\n";
            echo '  </tr>'."\n";
        } 
        else 
        {
            echo '<input type="hidden" name="add_admlanguage" value="">';
        }
        # Setup the author permissions.
        $result = $db->sql_query("SELECT `mid`, `title` FROM `".$prefix."_modules` ORDER BY `title` ASC");
        $a = 0;
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%; vertical-align: text-top;">';
        echo '      <span style="float: left; margin: 2px;">'.$admlang['global']['permissions'].'</span>';
        echo '      <span class="evo-sprite help tooltip float-right" title="'.$admlang['authors']['superwarn'].'"></span>';
        echo '    </td>'."\n";
        echo '    <td class="row1" style="width: 50%;">';
        echo '      <table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '        <tr>';
        while ($row = $db->sql_fetchrow($result)) 
        {
            $title = str_replace("_", " ", (string) $row['title']);
            if (file_exists('modules/'.$row['title'].'/admin/index.php') AND file_exists('modules/'.$row['title'].'/admin/links.php') AND file_exists('modules/'.$row['title'].'/admin/case.php')) 
            {
                echo '          <td class="row1" style="width: 33%;"><input  type="checkbox" name="auth_modules[]" value="'.intval($row['mid']).'">&nbsp;'.$title.'</td>';
                if ($a == 2) 
                {
                    echo '  </tr>';
                    // echo '  <tr>';
                    // echo '    <td>&nbsp;</td>';
                    $a = 0;
                } else {
                    $a++;
                }
            }
        }
        $db->sql_freeresult($result);
        echo '        </tr>';
        echo '        <tr>';
        echo '          <td class="row1" colspan="3"><input type="checkbox" name="add_radminsuper" value="1"> <strong>'.$admlang['authors']['superadmin'].'</strong></td>';
        echo '        </tr>';
        echo '      </table>';
        echo '    </td>'."\n";
        echo '  </tr>'."\n";
        # Author password
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width: 50%;">'.$admlang['global']['password'].'</td>'."\n";
        echo '    <td class="row1" style="width: 50%;"><input type="password" name="add_pwd" style="width: 250px;" maxlength="50" required></td>'."\n";
        echo '  </tr>'."\n";
        # Submit the form
        echo '  <tr>'."\n";
        echo '    <td class="catBottom" colspan="2" style="text-align: center;"><input class="mainoption" style="text-transform: uppercase;" type="submit" value="'.$admlang['authors']['submit'].'"></td>'."\n";
        echo '  </tr>'."\n";
        echo '</table>'."\n";
        echo '<input type="hidden" name="op" value="AddAuthor">';
        echo '</form>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

function modifyadmin($chng_aid) 
{
    $language = null;
    $sel = null;
    $a = null;
    $sel1 = null;
    global $admin, $prefix, $db, $multilingual, $admin_file, $admlang;
    if (is_admin()) 
    {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        $adm_aid = $chng_aid;
        $adm_aid = trim((string) $adm_aid);
        $row = $db->sql_fetchrow($db->sql_query("SELECT aid, name, url, email, pwd, radminsuper, admlanguage from " . $prefix . "_authors where aid='$chng_aid'"));
        $chng_aid = $row['aid'];
        $chng_name = $row['name'];
        $chng_url = stripslashes((string) $row['url']);
        $chng_email = stripslashes((string) $row['email']);
        $chng_pwd = $row['pwd'];
        $chng_radminsuper = intval($row['radminsuper']);
        $chng_admlanguage = $row['admlanguage'];
        $chng_aid = substr((string) $chng_aid, 0,25);
        $aid = $chng_aid;

        echo '<div style="text-align: center; margin-bottom: 20px;"><a href="'.$admin_file.'.php?op=mod_authors">'.$admlang['authors']['header'].'</a><br /><br/><a href="'.$admin_file.'.php">'.$admlang['global']['header_return'].'</a></div>';

        echo '<form action="'.$admin_file.'.php" method="post" name="newauthor">';
        # The name of the admin account, can not be changed, so we add it in the form as a hidden field.
        echo '<input type="hidden" name="chng_name" value="'.$chng_name.'">';
        echo '<table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="catHead" colspan="2" style="text-align: center;">'.$admlang['authors']['modify'].'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['name'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%">'.$chng_name.'</td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['nickname'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%"><input type="text" name="chng_aid" value="'.$chng_aid.'" style="width: 250px" maxlength="25" required></td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['email'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%"><input type="text" name="chng_email" value="'.$chng_email.'" style="width: 250px" maxlength="25" required></td>'."\n";
        echo '  </tr>'."\n";
        echo '  <tr>'."\n";
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['url'].'</td>'."\n";
        echo '    <td class="row1" style="width:50%"><input type="text" name="chng_url" value="'.$chng_url.'" style="width: 250px" maxlength="25" required></td>'."\n";
        echo '  </tr>'."\n";

        if ($multilingual == 1):

            echo '  <tr>';
            echo '    <td class="row1" style="width:50%">'.$admlang['global']['language'].'</td>';
            echo '    <td class="row1" style="width:50%">';
            echo "<select name=\"chng_admlanguage\">";
            $languageslist = lang_list();
            for ($i=0, $maxi = is_countable($languageslist) ? count($languageslist) : 0; $i < $maxi; $i++) {
                if(!empty($languageslist[$i])) {
                    echo "<option name='xlanguage' value='".$languageslist[$i]."' ";
                    if($languageslist[$i]==$language) echo "selected";
                    echo ">".ucwords((string) $languageslist[$i])."\n";
                }
            }
            if (empty($chng_admlanguage)) {
                $allsel = 'selected';
            } else {
                    $allsel = '';
            }
            echo '<option value="" '.$allsel.'>'.$admlang['global']['all'].'</option></select></td></tr>';

        else:

            echo '<input type="hidden" name="chng_admlanguage" value="">';
        endif;

        echo '  <tr>';
        echo '    <td class="row1" style="width:50%">'.$admlang['global']['permissions'].'</td>';
        if ($row['name'] != 'God'):

        	echo '    <td class="row1" style="width: 50%;">';
        	echo '      <table style="width: 100%;" border="0" cellpadding="3" cellspacing="1" class="forumline">'."\n";
        	echo '        <tr>';
            $result = $db->sql_query("SELECT mid, title, admins FROM ".$prefix."_modules ORDER BY title ASC");
            while ($row = $db->sql_fetchrow($result)):

                $title = str_replace("_", " ", (string) $row['title']);
                if (file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/index.php') AND file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/links.php') AND file_exists(NUKE_MODULES_DIR.$row['title'].'/admin/case.php')):

                    if(!empty($row['admins'])):

                        $admins = explode(",", (string) $row['admins']);
                        $sel = '';
                        for ($i=0, $maxi=count($admins); $i < $maxi; $i++):

                            if ($chng_name == $admins[$i])
                                $sel = 'checked';
                        
                        endfor;

                    endif;
                    echo '<td class="row1" style="width: 33%;"><input type="checkbox" name="auth_modules[]" value="'.intval($row['mid']).'" '.$sel.'> '.$title.'</td>';
                    $sel = "";
                    if ($a == 2) 
                    {
                        echo '  </tr>';
                        $a = 0;
                    } else {
                        $a++;
                    }
                
                endif;

            endwhile;
            $db->sql_freeresult($result);
            if ($chng_radminsuper == 1) {
                $sel1 = 'checked';
            }
            echo '        </tr>';
	        echo '        <tr>';
	        echo '          <td class="row1" colspan="3"><input type="checkbox" name="chng_radminsuper" value="1" '.$sel1.'> <strong>'.$admlang['authors']['superadmin'].'</strong></td>';
	        echo '        </tr>';
	        echo '      </table>';
	        echo '    </td>'."\n";
	        echo '  </tr>'."\n";

        else:

            echo '<input type="hidden" name="auth_modules[]" value="">';
            $sel1 = 'checked';
            echo '    <td class="row1" style="width: 50%"><input type="checkbox" name="chng_radminsuper" value="1" '.$sel1.'>'.$admlang['authors']['superadmin'].'</strong></td>';
        	echo '  </tr>';

        endif;        

        echo '  <tr>';
        echo '    <td class="row1" style="width: 50%">'.$admlang['global']['password'].'</td>';
        echo '    <td class="row1" style="width: 50%"><input type="password" name="chng_pwd" style="width: 250px" maxlength="45"></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td class="row1" style="width: 50%">'.$admlang['global']['password_retype'].'</td>';
        echo '    <td class="row1" style="width: 50%"><input type="password" name="chng_pwd2" style="width: 250px" maxlength="45"></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td colspan="2" class="catBottom" style="text-align: center"><input type="submit" value="'.$admlang['global']['save_changes'].'"></td>';
        echo '  </tr>';
        echo '</table>';
        echo '<input type="hidden" name="adm_aid" value="'.$adm_aid.'">';
        echo '<input type="hidden" name="op" value="UpdateAuthor">';
        echo '</form>';
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

function updateadmin($chng_aid, $chng_name, $chng_email, $chng_url, $chng_radminsuper, $chng_pwd, $chng_pwd2, $chng_admlanguage, $adm_aid, $auth_modules) {
    $dummy = null;
    global $admin, $prefix, $db, $admin_file;
    if (is_admin()) {
        Validate($chng_aid, 'username', 'Modify Authors', 0, 1, 0, 2, 'Nickname:', '<br /><center>'. _GOBACK .'</center>');
        Validate($chng_url, 'url', 'Modify Authors', 0, 0, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        Validate($chng_email, 'email', 'Modify Authors', 0, 1, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        if (!empty($chng_pwd2)) {
            Validate($chng_pwd, '', 'Modify Authors', 0, 1, 0, 2, 'password', '<br /><center>'. _GOBACK .'</center>');
            if($chng_pwd != $chng_pwd2) {
                DisplayError(_PASSWDNOMATCH . "<br /><br /><center>" . _GOBACK . "</center>");
            }
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $chng_pwd = md5((string) $chng_pwd);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
            $chng_aid = substr((string) $chng_aid, 0,25);
            if ($chng_radminsuper == 1) {
                $result = $db->sql_query("SELECT mid, admins FROM ".$prefix."_modules");
                while ($row = $db->sql_fetchrow($result)) {
                    $admins = explode(",", (string) $row['admins']);
                    $adm = '';
                    for ($a=0, $maxi=count($admins); $a < $maxi; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                $db->sql_query("update " . $prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='$chng_radminsuper', pwd='$chng_pwd', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                if ($adm_aid == $chng_aid) {
                    redirect($admin_file.".php?op=logout");
                } else {
                    // redirect($admin_file.".php?op=mod_authors");
                    redirect($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
                }
            } else {
                if ($chng_name != 'God') {
                      $db->sql_query("update " . $prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='0', pwd='$chng_pwd', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                }
                $result = $db->sql_query("SELECT mid, admins FROM ".$prefix."_modules");
                while ($row = $db->sql_fetchrow($result)) {
                    $admins = explode(",", (string) $row['admins']);
                    $adm = '';
                    for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $db->sql_query("UPDATE ".$prefix."_authors SET radminsuper='$chng_radminsuper' WHERE name='$chng_name' AND aid='$adm_aid'");
                    $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                for ($i=0, $maxi=is_countable($auth_modules) ? count($auth_modules) : 0; $i < $maxi; $i++) {
                    $row = $db->sql_fetchrow($db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE mid='".intval($auth_modules[$i])."'"));
                    if(!empty($row['admins'])) {
                        $admins = explode(",", (string) $row['admins']);
                        for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                            if ($admins[$a] == $chng_name) {
                                $dummy = 1;
                            }
                        }
                    }
                    if ($dummy != 1) {
                        $adm = $row['admins'].$chng_name;
                        $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm,' WHERE mid='".intval($auth_modules[$i])."'");
                    }
                    $dummy = '';
                }
                // redirect($admin_file.".php?op=mod_authors");
                redirect($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
            }
        } else {
            if ($chng_radminsuper == 1) {
                $result = $db->sql_query("SELECT mid, admins FROM ".$prefix."_modules");
                while ($row = $db->sql_fetchrow($result)) {
                    $admins = explode(",", (string) $row['admins']);
                    $adm = '';
                    for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                $db->sql_query("update " . $prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='$chng_radminsuper', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                // redirect($admin_file.".php?op=mod_authors");
                redirect($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
            } else {
                if ($chng_name != 'God') {
                        $db->sql_query("update " . $prefix . "_authors set aid='$chng_aid', email='$chng_email', url='$chng_url', radminsuper='0', admlanguage='$chng_admlanguage' where name='$chng_name' AND aid='$adm_aid'");
                }
                $result = $db->sql_query("SELECT mid, admins FROM ".$prefix."_modules");
                while ($row = $db->sql_fetchrow($result)) {
                    $admins = explode(",", (string) $row['admins']);
                    $adm = '';
                    for ($a=0, $maxa = count($admins); $a < $maxa; $a++) {
                        if ($admins[$a] != $chng_name && !empty($admins[$a])) {
                            $adm .= $admins[$a].',';
                        }
                    }
                    $db->sql_query("UPDATE ".$prefix."_authors SET radminsuper='$chng_radminsuper' WHERE name='$chng_name' AND aid='$adm_aid'");
                    $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
                }
                for ($i=0, $maxi=is_countable($auth_modules) ? count($auth_modules) : 0; $i < $maxi; $i++) {
                    $row = $db->sql_fetchrow($db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE mid='".intval($auth_modules[$i])."'"));
                    if(!empty($row['admins'])) {
                        $admins = explode(",", (string) $row['admins']);
                        for ($a=0, $maxa=count($admins); $a < $maxa; $a++) {
                            if ($admins[$a] == $chng_name) {
                                $dummy = 1;
                            }
                        }
                    }
                    if ($dummy != 1) {
                        $adm = $row['admins'].$chng_name;
                        $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm,' WHERE mid='".intval($auth_modules[$i])."'");
                    }
                    $dummy = '';
                }
                redirect($admin_file.'.php?op=modifyadmin&chng_aid='.$chng_aid);
            }
        }
        if ($adm_aid != $chng_aid) {
            $result2 = $db->sql_query("SELECT sid, aid, informant from " . $prefix . "_blogs where aid='$adm_aid'");
            while ($row2 = $db->sql_fetchrow($result2)) {
                $sid = intval($row2['sid']);
                $old_aid = $row2['aid'];
                $old_aid = substr((string) $old_aid, 0,25);
                $informant = $row2['informant'];
                $informant = substr((string) $informant, 0,25);
                if ($old_aid == $informant) {
                    $db->sql_query("update " . $prefix . "_blogs set informant='$chng_aid' where sid='$sid'");
                }
                $db->sql_query("update " . $prefix . "_blogs set aid='$chng_aid' WHERE sid='$sid'");
            }
        }
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}

function deladmin2($del_aid) {
    $radminarticle = null;
    $admlang = [];
    global $admin, $prefix, $db, $admin_file;
    if (is_admin()) {
        $del_aid = substr((string) $del_aid, 0,25);
        $result = $db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE title='Blog'");
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT name FROM ".$prefix."_authors WHERE aid='$del_aid'"));
        while ($row = $db->sql_fetchrow($result)) {
            $admins = explode(",", (string) $row['admins']);
            $auth_user = 0;
            for ($i=0, $maxi=count($admins); $i < $maxi; $i++) {
                if ($row2['name'] == $admins[$i]) {
                    $auth_user = 1;
                }
            }
            if ($auth_user == 1) {
                $radminarticle = 1;
            }
        }
        $db->sql_freeresult($result);
        if ($radminarticle == 1) {
            $row2 = $db->sql_fetchrow($db->sql_query("SELECT sid from " . $prefix . "_blogs where aid='$del_aid'"));
            $sid = intval($row2['sid']);
            if (!empty($sid)) {
                include_once(NUKE_BASE_DIR.'header.php');
                OpenTable();
                echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=mod_authors\">" . $admlang['authors']['header'] . "</a></div>\n";
                echo "<br /><br />";
                echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['authors']['header_return'] . "</a> ]</div>\n";
                CloseTable();
                echo "<br />";
                OpenTable();
                echo "<center><span class=\"title\"><strong>" . _AUTHORSADMIN . "</strong></span></center>";
                CloseTable();
                echo "<br />";
                OpenTable();
                echo "<center><span class=\"option\"><strong>" . _PUBLISHEDSTORIES . "</strong></span><br /><br />"
                    ."" . _SELECTNEWADMIN . ":<br /><br />";
                $result3 = $db->sql_query("SELECT aid from " . $prefix . "_authors where aid!='$del_aid'");
                echo "<form action=\"".$admin_file.".php\" method=\"post\"><select name=\"newaid\">";
                while ($row3 = $db->sql_fetchrow($result3)) {
                    $oaid = $row3['aid'];
                    $oaid = substr((string) $oaid, 0,25);
                    echo "<option name=\"newaid\" value=\"$oaid\">$oaid</option>";
                }
                $db->sql_freeresult($result3);
                echo "</select><input type=\"hidden\" name=\"del_aid\" value=\"$del_aid\">"
                    ."<input type=\"hidden\" name=\"op\" value=\"assignstories\">"
                    ."<input type=\"submit\" value=\"" . _OK . "\">"
                    ."</form>";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
                return;
            }
        }
        redirect($admin_file.".php?op=deladminconf&del_aid=$del_aid");
    } else {
        DisplayError("Unauthorized editing of authors detected<br /><br />"._GOBACK);
    }
}


if(isset($add_aid) && $add_aid != $_POST['add_aid']) {
    die('Illegal Variable');
}
if(isset($add_name) && $add_name != $_POST['add_name']) {
    die('Illegal Variable');
}

switch ($op) {

    case "mod_authors":
        displayadmins();
    break;

    case "modifyadmin":
        modifyadmin($chng_aid);
    break;

    case "UpdateAuthor":
        echo $chng_aid;
        updateadmin($chng_aid, $chng_name, $chng_email, $chng_url, $chng_radminsuper, $chng_pwd, $chng_pwd2, $chng_admlanguage, $adm_aid, $auth_modules);
    break;

    case "AddAuthor":
        global $admin_file;

        $add_aid = substr((string) $add_aid, 0,25);
        $add_name = substr((string) $add_name, 0,25);
        Validate($add_aid, 'username', 'Add Authors', 0, 1, 0, 2, 'Nickname:', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_name, 'username', 'Add Authors', 0, 1, 0, 2, 'Name:', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_url, 'url', 'Add Authors', 0, 0, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_email, 'email', 'Add Authors', 0, 1, 0, 0, '', '<br /><center>'. _GOBACK .'</center>');
        Validate($add_pwd, '', 'Add Authors', 0, 1, 0, 2, 'password', '<br /><center>'. _GOBACK .'</center>');
/*****[BEGIN]******************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        $add_pwd = md5((string) $add_pwd);
/*****[END]********************************************
 [ Base:     Evolution Functions               v1.5.0 ]
 ******************************************************/
        for ($i=0,$maxi=is_countable($auth_modules) ? count($auth_modules) : 0; $i < $maxi; $i++) {
            $row = $db->sql_fetchrow($db->sql_query("SELECT admins FROM ".$prefix."_modules WHERE mid='".intval($auth_modules[$i])."'"));
            $adm = $row['admins'] . $add_name;
            $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm,' WHERE mid='".intval($auth_modules[$i])."'");
        }
        $result = $db->sql_query("insert into " . $prefix . "_authors values ('$add_aid', '$add_name', '$add_url', '$add_email', '$add_pwd', '0', '$add_radminsuper', '$add_admlanguage')");
        if (!$result) {
            redirect($admin_file.".php");
        }
        $db->sql_freeresult($result);
        redirect($admin_file.".php?op=mod_authors");
    break;

    case "deladmin":
        include_once(NUKE_BASE_DIR.'header.php');
        $del_aid = trim((string) $del_aid);
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=mod_authors\">" . $admlang['authors']['header'] . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . $admlang['global']['header_return'] . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        echo "<center><span class=\"option\"><strong>" . $admlang['authors']['delete'] . "</strong></span><br /><br />"
            ."" . $admlang['authors']['delete_sure'] . " <i>$del_aid</i>?<br /><br />";
        echo "[ <a href=\"".$admin_file.".php?op=deladmin2&amp;del_aid=$del_aid\">" . $admlang['global']['yes'] . "</a> | <a href=\"".$admin_file.".php?op=mod_authors\">" . $admlang['global']['no'] . "</a> ]";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    break;

    case "deladmin2":
        deladmin2($del_aid);
    break;

    case "assignstories":
        $del_aid = trim((string) $del_aid);
        $result = $db->sql_query("SELECT sid from " . $prefix . "_blogs where aid='$del_aid'");
        while ($row = $db->sql_fetchrow($result)) {
            $sid = intval($row['sid']);
            $db->sql_query("update " . $prefix . "_blogs set aid='$newaid', informant='$newaid' where aid='$del_aid'");
            $db->sql_query("update " . $prefix . "_authors set counter=counter+1 where aid='$newaid'");
        }
        $db->sql_freeresult($result);
        redirect($admin_file.".php?op=deladminconf&del_aid=$del_aid");
    break;

    case "deladminconf":
        $del_aid = trim((string) $del_aid);
        $db->sql_query("delete from " . $prefix . "_authors where aid='$del_aid' AND name!='God'");
        $result = $db->sql_query("SELECT mid, admins FROM ".$prefix."_modules");
        while ($row = $db->sql_fetchrow($result)) {
            $admins = explode(",", (string) $row['admins']);
               $adm = "";
               for ($a=0, $maxa=count($admins); $a < $maxa; $a++) {
                if ($admins[$a] != $del_aid && !empty($admins[$a])) {
                    $adm .= $admins[$a].',';
                   }
               }
            $db->sql_query("UPDATE ".$prefix."_modules SET admins='$adm' WHERE mid='".intval($row['mid'])."'");
        }
        $db->sql_freeresult($result);
        redirect($admin_file.".php?op=mod_authors");
    break;

}

} else {
    echo "Access Denied";
}

?>
