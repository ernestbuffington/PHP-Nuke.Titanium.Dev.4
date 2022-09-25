<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/********************************************************************/
/*                       Sommaire Paramétrable                      */
/*                                                                  */
/*                      par marcoledingue@free.fr                   */
/*                                                                  */
/*                          v.2.1.1 - 26/05/2004                    */
/********************************************************************/

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
/************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       10/01/2005
      Caching System                           v1.0.0       11/01/2005
      Module Simplifications                   v1.0.0       11/17/2005
 ************************************************************************/

if(!defined('NUKE_EVO')) exit;

global $titanium_db, $admin, $titanium_user, $titanium_prefix, $titanium_user_prefix, $cookie, $def_module, $currentlang, $cookie, $cache;

if (file_exists(NUKE_LANGUAGE_DIR.'Sommaire/lang-'.$currentlang.'.php')) {
    include_once(NUKE_LANGUAGE_DIR.'Sommaire/lang-'.$currentlang.'.php');
} else {
    include_once(NUKE_LANGUAGE_DIR.'Sommaire/lang-english.php');
}

$gestiongroupe = 1; // mettre 0 permet de forcer Sommaire Paramétrable à ne pas gérer les groupes. (gain de 1 requête SQL)
$detectPM = 1; // Put 0 to deactivate the detection of the Private Messages.  (gains 1 SQL query)
$detectMozilla = (preg_match("/Mozilla/i",$_SERVER['HTTP_USER_AGENT']) && !preg_match("/MSIE/i",$_SERVER['HTTP_USER_AGENT']) && !preg_match("/Opera/i",$_SERVER['HTTP_USER_AGENT']) && !preg_match("/Konqueror/i",$_SERVER['HTTP_USER_AGENT'])) ? 1 : 0 ;
$detectMozilla = 0;

// One recovers the unit in welcome orderly (index) and one will test if one must do the management of the groups.
// (Grouped together requests to optimize the calls to the DB).
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if(!($row = $cache->load('sommaire_row', 'block'))) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$sql="SELECT t1.invisible, t2.main_module FROM ".$titanium_prefix."_sommaire AS t1, ".$titanium_prefix."_main AS t2 LIMIT 1";
$result = $titanium_db->sql_query($sql);
$row = $titanium_db->sql_fetchrow($result);
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->save('sommaire_row', 'block', $row);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$main_module_titanium = $row['main_module'];
$type_invisible = $row['invisible'];
if ($gestiongroupe==1) {
    $gestiongroupe = ($row['invisible']=="4" || $row['invisible']=="5") ? 1 : 0 ;
}
else {
    $gestiongroupe=0;
}

//one will test if the visitor is an admin and or a member
$is_admin = (is_admin()) ? 1 : 0 ;
$is_user = (is_user()) ? 1 : 0 ;
$ThemeSel = get_theme(); // récupère le thème du membre : évite une requête.
$uid = $cookie[0];
//$pathicon = "themes/$ThemeSel/images/sommaire";
$path_icon = "images/sommaire";
$imgnew="new.gif";

///////////// on récupère les infos pour savoir si le user a des messages privés non lus /////////////////
if ($is_user==1 && $detectPM==1) {
    $uid=intval($uid); // on sécurise l'appel à la BDD
     $newpms = $titanium_db->sql_fetchrow($titanium_db->sql_query("SELECT COUNT(*) FROM " . $titanium_prefix . "_bbprivmsgs WHERE privmsgs_to_userid='$uid' AND (privmsgs_type='5' OR privmsgs_type='1')")); //2 requetes SQL
}
// voilà, si $newpms[0]>0 --> il y a des PMs non lus //


//////// on va mettre la liste des modules dans la variable $titanium_modules /////////////////////
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if(!($tempoA = $cache->load('sommaire_tempo', 'block'))) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if ($gestiongroupe==1) {
    $sql = "SELECT title, custom_title, view, active, groups FROM ".$titanium_prefix."_modules WHERE active='1' AND inmenu='1' AND `title` NOT LIKE '~l~%' ORDER BY custom_title ASC";
}
else {
    $sql = "SELECT title, custom_title, view, active FROM ".$titanium_prefix."_modules WHERE active='1' AND inmenu='1' AND `title` NOT LIKE '~l~%' ORDER BY custom_title ASC";
}
    $titanium_modulesaffiche= $titanium_db->sql_query($sql);
    while($tempo = $titanium_db->sql_fetchrow($titanium_modulesaffiche)) {
        $tempoA[] = $tempo;
    }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->save('sommaire_tempo', 'block', $tempoA);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $compteur=0;
    if (is_array($tempoA)) {
        foreach($tempoA as $tempo) {
            $titanium_module[$compteur]= $tempo['title'];
            $customtitle[$compteur] = $tempo['custom_title'];
            $view[$compteur] = $tempo['view'];
            $active[$row['title']] = $tempo['active'];
            $mod_group[$compteur] = ($gestiongroupe==1) ? $tempo['groups'] : "";
            $compteur++;
            if ($tempo['view']==3) { $gestionsubscription="yes";}
        }
    }
/////// ok, on a les infos de la table modules //////////////

//// on va récupérer le module par défaut dans le thème (s'il existe)
if (file_exists("themes/$ThemeSel/module.php")) {
    include("themes/$ThemeSel/module.php");
    $is_active = ($active[$default_module]!=0) ? 1 : 0 ; // permet de savoir si le Default Module est actif.
    if ($is_active==1 AND file_exists("modules/$default_module/index.php")) {
        $main_module_titanium = $default_module;
    }
}


$total_phpbb2_actions="";
$flagmenu = 0;  // flag qui est mis automatiquement à "1" quand il y a un module dans la rubrique 99
                // --> permet d'afficher 1 seule fois la barre horizontale.
    // on va mettre les données de la table nuke_sommaire_categories dans les variables adéquates.
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if (!($row2A = $cache->load('sommaire_row2', 'block'))) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $sql2= "SELECT groupmenu, module, url, url_text, image, new, new_days, class, bold FROM ".$titanium_prefix."_sommaire_categories ORDER BY id ASC";
    $result2= $titanium_db->sql_query($sql2);
    while($row2=$titanium_db->sql_fetchrow($result2)) {
        $row2A[] = $row2;
    } //on récupère la première ligne de la table, et on affecte aux variables.
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->save('sommaire_row2', 'block', $row2A);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $compteur=0;
    $totalcompteur=0;
    $categorie=$row2A[0]['groupmenu'];
    $titanium_moduleinthisgroup[$categorie][$compteur]=$row2A[0]['module'];
    $linkinthisgroup[$categorie][$compteur]=$row2A[0]['url'];
    $linktextinthisgroup[$categorie][$compteur]=$row2A[0]['url_text'];
    $imageinthisgroup[$categorie][$compteur]=$row2A[0]['image'];
    $newinthisgroup[$categorie][$compteur]=$row2A[0]['new'];
    $newdaysinthisgroup[$categorie][$compteur]=$row2A[0]['new_days'];
    $classinthisgroup[$categorie][$compteur]=$row2A[0]['class'];
    $grasinthisgroup[$categorie][$compteur]=$row2A[0]['bold'];
    $totalcategorymodules[$totalcompteur]=$row2A[0]['module']; //utile quand groupmenu=99 -->cette variable liste tous les modules affichés dans des catégories
    $compteur2=$categorie;
    $total_phpbb2_actions="sommaire_showhide('sommaire-".$row2A[0]['groupmenu']."','nok','sommaireupdown-".$row2A[0]['groupmenu']."');";
    $totalcompteur=1;
    unset($row2A[0]);
    //    echo "{$titanium_moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
    if (is_array($row2A)) {
    foreach($row2A as $row2) { //ensuite on fait la même chose pour toutes les autres lignes.
        $categorie=$row2['groupmenu'];
        $totalcategorymodules[$totalcompteur]=$row2['module'];
        $totalcompteur++;

        if ($compteur2==$categorie) { //permet de savoir si on a changé de catégorie (groupmenu différent) : dans ce cas on remet le 2ème compteur à 0.
            $compteur++;
        }
        else {
            $total_phpbb2_actions=$total_phpbb2_actions."sommaire_showhide('sommaire-".$row2['groupmenu']."','nok','sommaireupdown-".$row2['groupmenu']."');";
            $compteur=0;
        }
        $titanium_moduleinthisgroup[$categorie][$compteur]=$row2['module'];
        $linkinthisgroup[$categorie][$compteur]=$row2['url'];
        $linktextinthisgroup[$categorie][$compteur]=$row2['url_text'];
        $imageinthisgroup[$categorie][$compteur]=$row2['image'];
        $newinthisgroup[$categorie][$compteur]=$row2['new'];
        $newdaysinthisgroup[$categorie][$compteur]=$row2['new_days'];
        $classinthisgroup[$categorie][$compteur]=$row2['class'];
        $grasinthisgroup[$categorie][$compteur]=$row2['bold'];
        $compteur2=$categorie;
    //    echo "{$titanium_moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
    }
    }
// --> OK, les variables ont pris la valeur adéquate de la table nuke_sommaire_categories

$content ="
<!-- Sommaire realise grace au module Sommaire Parametrable v.2.1.1 - ©marcoledingue - marcoledingue .-:@at@:-. free.fr -->
";
?>
<script type="text/javascript" language="JavaScript">
function sommaire_envoielistbox(page) {
    var reg= new RegExp('(_sommaire_targetblank)$','g');
    if (reg.test(page)) {
        page=page.replace(reg,"");
        window.open(page,'','menubar=yes,status=yes, location=yes, scrollbars=yes, resizable=yes');
    }else if (page!="select") {
            top.location.href=page;
    }
}
function sommaire_ouvre_popup(page,nom,option) {
    window.open(page,nom,option);
}
</script>
<?php

    $dynamictest=0;
    // Ensuite, on charge la table nuke_sommaire //
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if (!($row3 = $cache->load('sommaire_row3', 'block'))) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $sql = "SELECT groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, bold, new, listbox, dynamic FROM ".$titanium_prefix."_sommaire ORDER BY groupmenu ASC";
    $result = $titanium_db->sql_query($sql);
    while ($row = $titanium_db->sql_fetchrow($result)) {  // on va afficher chaque catégorie, puis les modules correspondants//
        $row3[] = $row;
    }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->save('sommaire_row3', 'block', $row3);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $content.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
    $classpointeur=0;
    foreach($row3 as $row) {  // on va afficher chaque catégorie, puis les modules correspondants//
        $som_groupmenu = $row['groupmenu'];
        $som_name = str_replace("&amp;nbsp;","&nbsp;",$row['name']);
        $som_image = $row['image'];
        $som_lien = $row['lien'];
        $som_hr = $row['hr'];
        $som_center = $row['center'];
        $som_bgcolor = $row['bgcolor'];
        $invisible[$classpointeur] = $row['invisible'];
        $categoryclass[$classpointeur] = $row['class'];
        $som_bold = $row['bold'];
        $som_new = $row['new'];
        $som_listbox = $row['listbox'];
        $som_dynamic = $row['dynamic'];
        if ($som_dynamic=="on" && $dynamictest!=1 && $detectMozilla!=1) {
            $dynamic=1;
            ?>
            <script type="text/javascript" language="JavaScript">
            function sommaire_showhide(tableau, trigger, somimagename) {
                if (document.getElementById(tableau).style.display == "none" && trigger!="nok") {
                    document.getElementById(tableau).style.display = ""; //block
                    document.images[somimagename].src="<?echo $path_icon;?>/admin/up.gif";
                }
                else {
                    var reg= new RegExp("<?echo $path_icon;?>/admin/up.gif$","gi");
                    if (reg.test(document.images[somimagename].src)) {
                        document.images[somimagename].src="<?echo $path_icon;?>/admin/down.gif";
                    }
                    document.getElementById(tableau).style.display = "none";
                }
            }
            </script>
            <?php
        }
        $dynamictest=1;

        if ($som_hr == "on") {
            $content.="<tr><td><hr width=\"100%\"></td></tr>"; //15 mars 2005 : ajout de width=100%
        }

        if ($som_groupmenu <> 99) {

            if ($dynamic==1 && $detectMozilla!=1 && $titanium_moduleinthisgroup[$som_groupmenu]['0'] && $som_listbox!="on") { // si on a des liens/modules dans cette catégorie (catégorie non vide), et que ce n'est pas une listbox
                $reenrouletout=preg_replace("/sommaire_showhide\(\'sommaire-$som_groupmenu\',\'nok\',\'sommaireupdown-$som_groupmenu\'\);/","",$total_phpbb2_actions);
                $action_somgroupmenu="onclick=\"$reenrouletout sommaire_showhide('sommaire-$som_groupmenu','ok','sommaireupdown-$som_groupmenu')\" style=\"cursor:pointer\""; // menu dynamique
            }
            else {
            $action_somgroupmenu="";
            }
            $content.="
                        <tr height=\"4\" bgcolor=\"$som_bgcolor\"><td></td></tr>
                        ";
            $content.="<tr $action_somgroupmenu><td bgcolor=\"$som_bgcolor\" >";

            if ($som_center=="on") {
                $content.="<div align=\"center\">";
            }
            if ($som_lien<>"") {
                if (strpos($som_lien,"LANG:_")===0) { // gestion multilingue
                    $som_lien = str_replace("LANG:","",$som_lien);
                    eval( "\$som_lien = $som_lien;");
                }//fin gestion multilingue
                $testepopup=strpos($som_lien,"javascript:window.open(");
                if ($testepopup===0) {
                    $som_lien = str_replace("window.open","sommaire_ouvre_popup",$som_lien);
                    $content.="<a href=\"$som_lien\"";
                }
                else {
                $content.="<a href=\"$som_lien\"";
                $testehttp=strpos($som_lien,"http://");
                $testehttps=strpos($som_lien,"https://");
                $testeftp=strpos($som_lien,"ftp://");
                if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
                    $content.=" target=\"_blank\"";
                }
                $content.=">";
                }
            }

            if ($som_image<> "noimg") {
/************************************************************************************/
/*                 Modifications par MAC06  17/07/2003                              */
/*                  http://visiondesign.free.fr                                     */
/*                     magetmac06@hotmail.com                                       */
/*  Les modifs permettent d'inserer soit un swf (Flash), soit une image normale.    */
/*  Les images et les swf doivent etre placés dans "images/sommaire/".              */
/************************************************************************************/
                if (preg_match("/\.swf/i",$som_image)) { //////////////////// support des fichiers FLASH - par MAC06 //////////////////////////
                    $content .= "<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"179\" height=\"20\" id=\"$som_groupmenu\"><PARAM NAME=movie VALUE=\"$path_icon/$som_image\"><PARAM NAME=quality VALUE=high><EMBED src=\"$path_icon/$som_image\" quality=high WIDTH=\"160\" HEIGHT=\"20\" TYPE=\"application/x-shockwave-flash\" wmode=\"transparent\"></EMBED></OBJECT><br />";
                }
                else {
                $fermebalise= (!empty($som_lien)) ? "</a>" : "" ;
                    $content.="<img src=\"$path_icon/$som_image\" border=\"0\">".$fermebalise."&nbsp;";
                }
            }

             // gestion multilingue : si le nom de catégorie commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
            if (strpos($som_name,"LANG:_")===0) {
                $som_name = str_replace("LANG:","",$som_name);
                eval( "\$som_name = $som_name;");
            }//fin gestion multilingue

            if (preg_match("/\.swf/i",$som_image) || empty($som_name) || $som_name==" " ||$som_name=="&nbsp;" ||$som_name=="&amp;nbsp;") { //////////////////// support des fichiers FLASH - par MAC06 -+- marcoledingue : ajout du second check, qui permet d'avoir des catégories avec un nom vide. //////////////////////////
                $no_category_text[$som_groupmenu]=1;
            }
            else {
                if ($som_lien<>"") {

                 // gestion multilingue : si l'url de catégorie commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
                    if (strpos($som_lien,"LANG:_")===0) {
                        $som_lien = str_replace("LANG:","",$som_lien);
                        eval( "\$som_lien = $som_lien;");
                    }//fin gestion multilingue
                    $testepopup=strpos($som_lien,"javascript:window.open(");
                    if ($testepopup===0) {
                        $som_lien = str_replace("window.open","sommaire_ouvre_popup",$som_lien);
                        $content.="<a href=\"$som_lien\"";
                    }
                    else {
                        $content.="<a href=\"$som_lien\"";
                        $testehttp=strpos($som_lien,"http://");
                        $testeftp=strpos($som_lien,"ftp://");
                        $testehttps=strpos($som_lien,"https://");
                        if ($testehttp===0 || $testeftp===0 ||$testehttps===0) {
                            $content.=" target=\"_blank\"";
                        }
                    }
                $content.=" class=\"$categoryclass[$classpointeur]\">";
                }

                $content.="<span class=\"$categoryclass[$classpointeur]\">";

                $bold1 = ($som_bold=="on") ? "<strong>" : "" ;
                $bold2 = ($som_bold=="on") ? "</strong>" : "" ;
                $new = ($som_new=="on") ? "<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">" : "" ;

                $content.="".$bold1."$som_name".$bold2."".$new."";
            }

            $content.="</span>";

            if ($som_lien<>"") {
                $content.="</a>";
            }

            if ($dynamic==1 && $detectMozilla!=1 && $titanium_moduleinthisgroup[$som_groupmenu]['0']) {
                $zeimage = ($som_listbox=="on") ? "null.gif" :"down.gif" ;
                $content.="<img align=\"bottom\" id=\"sommaireupdown-$som_groupmenu\" name=\"sommaireupdown-$som_groupmenu\" src=\"$path_icon/admin/$zeimage\" border=0>";
            }
            if ($som_center=="on") {
                $content.="</div>";
            }
            $content.="</td></tr>\n";

        }
        $keyinthisgroup=0;

        if ($som_groupmenu!=99 && !$titanium_moduleinthisgroup[$som_groupmenu]['0']) { // 15 mars 2005 : si la catégorie ne contient pas de module/lien, on doit afficher quand même le décalage de 4px !
            //$content.="<tr><td bgcolor=\"$som_bgcolor\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td></td></tr></table></td></tr>";
            $content.="<tr height=\"4\" bgcolor=\"$som_bgcolor\"><td></td></tr>";
        }
        elseif ($som_groupmenu<>99 && $titanium_moduleinthisgroup[$som_groupmenu]['0']) {
        if ($som_listbox=="on") {// on désactive le réenroulage automatique si le menu est dynamique.
            $content.="<tr><td bgcolor=\"$som_bgcolor\"><span name=\"sommaire-$som_groupmenu\" id=\"sommaire-$som_groupmenu\"></span>";
            $aenlever="sommaire_showhide\('sommaire-".$som_groupmenu."','nok','sommaireupdown-".$som_groupmenu."'\);";
            $total_phpbb2_actions = str_replace("$aenlever", "" , $total_phpbb2_actions);

            $content.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"100%\">";

            $content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistbox\">"
                    ."<select name=\"somlistbox$keysommaire\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
                    ."<option value=\"select\">"._SOMSELECTALINK."";
        }
        else {
            $content.="<tr name=\"sommaire-$som_groupmenu\" id=\"sommaire-$som_groupmenu\"><td bgcolor=\"$som_bgcolor\">";
            $content.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
        }

        if ($som_image<>"noimg" && !preg_match("/\.swf/i",$som_image) && $som_center<>"on") { ///////////////////////////support des fichiers FLASH - par MAC06 /////////////////////////
            $catimagesize = getimagesize("$path_icon/$som_image");//là on va récupérer la largeur de l'image de la catégorie, pour aligner les modules avec le titre de la catégorie.
        }
        else {
            $catimagesize[0]=1; //2.1.2beta5 : corrige un problème d'affichage avec les middot pour un menu sans image
        }

        while ($titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]) { //on va checker si chaque module indiqué dans la catégorie en cours est installé et activé/visible //
            if ($linkinthisgroup[$som_groupmenu][$keyinthisgroup] == 'modules.php?name=wsatourney_main') {
            define('D', true);
            }
            if ($grasinthisgroup[$som_groupmenu][$keyinthisgroup]=="on") { // va mettre le lien en gras si indiqué.
                $gras1="<strong>";
                $gras2="</strong>";
            }
            else {
                $gras1 = $gras2 = "";
            }

            if ($som_listbox=="on") { // gestion des listbox
                if ($titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="Lien externe") {
                     // gestion multilingue : si le lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
                    if (strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_")===0) {
                        $zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
                        eval( "\$zelink_lang = $zelink_lang;");
                        $linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
                    }//fin gestion multilingue
                    $testehttp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
                    $testeftp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
                    $testehttps=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");
                    $testepopup=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
                    if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
                        $zelink= "_sommaire_targetblank";
                    }
                    elseif ($testepopup===0) {
                        $zelink=" target=\"popup_sommaire\"";
                    }
                    else {
                        $zelink="";
                    }
                    // gestion multilingue : si le texte du lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
                    $linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
                    if (strpos($linklang,"LANG:_")===0) {
                        $linklang = str_replace("LANG:","",$linklang);
                        eval( "\$linklang = $linklang;");
                        if (empty($linklang)) {$keyinthisgroup++;continue;} //2.1.2beta4 : permet de ne pas afficher la ligne si le texte du lien n'a pas été défini pour cette langue.
                        $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
                    }//fin gestion multilingue
                    $content.= "<option value=\"".$linkinthisgroup[$som_groupmenu][$keyinthisgroup]."".$zelink."\">".$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]."";
                }
                elseif($titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]!="SOMMAIRE_HR") {
                    for ($z=0;$z<count($titanium_module);$z++) { //pour chaque module activé et visible on va regarder où on l'affiche
                        if ($titanium_module[$z]!=$main_module_titanium && (($is_admin===1 AND $view[$z] == 2) OR $view[$z] != 2) && $titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]==$titanium_module[$z]) {
                            $isin = ($mod_group[$z]==0 || ($titanium_userpoints>0 && $titanium_userpoints>=$pointsneeded[$mod_group[$z]])) ? 1 : 0 ;
                            if ($view[$z]==1 && $is_user==0 && ($invisible[0]==3 || $invisible[0]==5)) { //on n'affiche pas si c'est un visiteur et que l'on a coché 'modules invisbles' dans l'admin du sommaire
                            }
                            elseif ($view[$z]==1 && $is_user==1 && $invisible[0]==5 && $isin==0) {//on n'affiche pas si c'est un membre, qui n'est pas dans le bon groupe et que l'on a coché 'modules invisibles' dans l'admin du sommaire
                            }
                            else {// sinon OK, on affiche le module dans le drop-down.
                            $customtitle2 = (!empty($customtitle[$z])) ? $customtitle[$z] : str_replace("_", " ", $titanium_module[$z]);
                            $content.="<option value=\"modules.php?name=".$titanium_module[$z]."\">".$customtitle2."";
                            }
                        }
                    }
                }
            }
			//
            elseif($titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="Lien externe" && !preg_match("@modules.php?name=@i", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]) && !preg_match("@((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=@i",$linkinthisgroup[$som_groupmenu][$keyinthisgroup])) { // gestion des liens externes - v2.1.2beta5 : ajout d'un check supplémentaire pour gérer les liens externes (target blank mais sur le serveur)
                     // gestion multilingue : si le lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
                if (strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_")===0) {
                    $zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
                    eval( "\$zelink_lang = $zelink_lang;");
                    $linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
                }//fin gestion multilingue

                $testepopup=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"javascript:window.open(");
                if ($testepopup===0) {
                            $linkinthisgroup[$som_groupmenu][$keyinthisgroup] = str_replace("window.open","sommaire_ouvre_popup",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
                            $zelink="";
                            }
                else {
                    $testehttp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"http://");
                    $testeftp=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"ftp://");
                    $testehttps=strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"https://");

                    if ($testehttp===0 || $testeftp===0 || $testehttps===0) {
                        $zelink= " target=\"_blank\"";
                    }
                    else {
                        $zelink="";
                    }
                }
            // gestion multilingue : si le texte du lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
            $linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
            if (strpos($linklang,"LANG:_")===0) {
                $linklang = str_replace("LANG:","",$linklang);
                eval( "\$linklang = $linklang;");
                if (empty($linklang)) {$keyinthisgroup++;continue;} //2.1.2beta4 : permet de ne pas afficher la ligne si le texte du lien n'a pas été défini pour cette langue.
                $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
            }//fin gestion multilingue

            $content.="<tr>";

            $new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup]=="on") ? "<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">" : "" ;
            $imagedulien="<img src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" border=0>";
            if ($linkinthisgroup[$som_groupmenu][$keyinthisgroup]) { // v212b4 : n'affiche aucun lien si la case LIEN est vide.
                $lelien="<a href=\"".$linkinthisgroup[$som_groupmenu][$keyinthisgroup]."\"".$zelink." class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">";
                $close_lelien="</a>";
            }
            else {
                $lelien="";
                $close_lelien="";
            }
            $letexte="<span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$linktextinthisgroup[$som_groupmenu][$keyinthisgroup]."</span>";

                if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup]<>"middot.gif" && (empty($linktextinthisgroup[$som_groupmenu][$keyinthisgroup]) || $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]==" " || $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=="&nbsp;" || $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=="&amp;nbsp;")) { //si le texte du lien est vide l'image va être clickable
                    $content.="<td colspan=2 width=\"100%\">".$lelien.$imagedulien.$close_lelien.$new.""; //v2.1.2b4 : ajout de la variable $close_lelien
                    $content.="</td></tr>\n";
                }
                elseif ($imageinthisgroup[$som_groupmenu][$keyinthisgroup]<>"middot.gif") { //si le texte n'est pas vide
                    if ($no_category_text[$som_groupmenu]===1) {    //V2.1.2beta3
                        $content.="<td colspan=2 align=\"left\" width=\"100%\">".$imagedulien."&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
                    }
                    else {
                        $content.="<td width=\"$catimagesize[0]\" align=\"right\">".$imagedulien."</td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
                    }
                        $content.="</td></tr>\n";
                }
                else { // si l'image utilisée est le middot
                    if ($no_category_text[$som_groupmenu]===1) {    //V2.1.2beta3
                    // v2.1.2beta7 : ajout de la classe pour le middot
                        $content.="<td colspan=2 align=\"left\" width=\"100%\"><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
                    }
                    else {
                        $content.="<td width=\"$catimagesize[0]\" align=\"right\"><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\"><strong><big>&middot;</big></strong></span></td><td>&nbsp;".$lelien.$gras1.$letexte.$gras2.$close_lelien.$new.""; //v2.1.2beta4 : ajout de $close_lelien
                    }
                    $content.="</td></tr>\n";
                }
            }
            elseif ($titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="SOMMAIRE_HR") {
                $content.="<tr><td colspan=2>";
                $content.="<hr>";
                $content.="</td></tr>\n";
            }
            else {// un module normal, ou bien un lien interne (lien externe vers une page spécifique d'un module du site)
                for ($z=0;$z<count($titanium_module);$z++) { //pour chaque module activé et visible on va regarder où on l'affiche
                    if ($titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]=="Lien externe") { //si c'est un lien externe, il commence par 'modules.php?name=' ==>c'est un lien vers un module du site
                        $temponomdumodule=preg_split("/&/", $linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
                        if (preg_match("@((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=@i",$linkinthisgroup[$som_groupmenu][$keyinthisgroup])) { // v2.1.2beta5 : les liens externes target blank qui pointent vers le serveur sont traités comme des modules.
                            $nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
                            $targetblank="target=\"_blank\"";
                        }
                        elseif (preg_match("@((http(s)?)|(ftp(s)?))://".$_SERVER['SERVER_NAME']."/modules.php\?name=@i",$linkinthisgroup[$som_groupmenu][$keyinthisgroup])) { // v2.1.2beta6 : les liens externes target blank qui pointent vers le serveur sont traités comme des modules.
                            $nomdumodule = substr(strstr($temponomdumodule[0],'modules.php'),17);
                            $targetblank="";
                        }
                        else {
                            $nomdumodule = str_replace("modules.php\?name=","",$temponomdumodule[0]);
                            $targetblank="";
                        }
                         // gestion multilingue : si le lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
                        if (strpos($linkinthisgroup[$som_groupmenu][$keyinthisgroup],"LANG:_")===0) {
                            $zelink_lang = str_replace("LANG:","",$linkinthisgroup[$som_groupmenu][$keyinthisgroup]);
                            eval( "\$zelink_lang = $zelink_lang;");
                            $linkinthisgroup[$som_groupmenu][$keyinthisgroup] = $zelink_lang;
                        }//fin gestion multilingue
                        // gestion multilingue : si le texte du lien commence par 'LANG:_' alors c'est multilingue, donc on va afficher ce qui a été inscrit dans le fichier de langue.
                        $linklang=$linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
                        if (strpos($linklang,"LANG:_")===0) {
                            $linklang = str_replace("LANG:","",$linklang);
                            eval( "\$linklang = $linklang;");
                        if (empty($linklang)) {$keyinthisgroup++;continue 2;} //2.1.2beta7 : permet de ne pas afficher la ligne si le texte du lien n'a pas été défini pour cette langue. 2 car on doit sortir de for et de while.
                            $linktextinthisgroup[$som_groupmenu][$keyinthisgroup]=$linklang;
                        }//fin gestion multilingue

                        $customtitle2 = $linktextinthisgroup[$som_groupmenu][$keyinthisgroup];
                        $urldumodule = $linkinthisgroup[$som_groupmenu][$keyinthisgroup];
                    }
                    else {
                        $temponomdumodule=array(); //beta8 : on vide cette variable car il n'y a aucun paramètre dans l'url.
                        $targetblank="";
                        $nomdumodule =$titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup];
                        $customtitle2 = (!empty($customtitle[$z])) ? $customtitle[$z] : str_replace("_", " ", $titanium_module[$z]);
                        $urldumodule = "modules.php?name=$nomdumodule";
                    }
                    if (!($titanium_module[$z]==$main_module_titanium && $titanium_moduleinthisgroup[$som_groupmenu][$keyinthisgroup]!="Lien externe")) { //on n'affiche pas le module en homepage, sauf s'il est appelé par un lien externe
                        if (($is_admin===1 AND $view[$z] == 2) OR $view[$z] != 2) { //si on n'est pas admin et que le module est réservé aux admins, il n'apparaît pas
                            if ($nomdumodule==$titanium_module[$z]) {
                                if ($dynamic==1 && $detectMozilla!=1) {
                                    //détection améliorée de la catégorie à ouvrir
                                    $temprequesturi=preg_split('/&/',$_SERVER['REQUEST_URI']);
                                    $tempurldumodule=preg_split('/&/',$urldumodule);
                                    $nbparam=count($tempurldumodule);
                                    $nbrequest=count($temprequesturi);
                                    $requesturi=$temprequesturi[0];
                                    if ($nbparam<=$nbrequest) {
                                        for ($i=1;$i<$nbparam;$i++) {
                                            $requesturi.="&".$temprequesturi[$i];
                                        }
                                    }
                                    if (preg_match(addcslashes("@$urldumodule@", '?&'), $requesturi)) { // si la page visualisée est le module[$z], alors on récupère son groupmenu pour ne pas enrouler la catégorie par défaut.
                                        $categorieouverte=$som_groupmenu;
                                    }
                                }
                                if ($imageinthisgroup[$som_groupmenu][$keyinthisgroup]!="middot.gif") {
                                    $limage="<img src=\"$path_icon/categories/".$imageinthisgroup[$som_groupmenu][$keyinthisgroup]."\" border=\"0\">";
                                }
                                else {
                                    $limage="<strong><big>&middot;</big></strong>";
                                }

                                //gestion des groupes
                                $isin=0;
                                if ($is_user==1 && ($invisible[0]==5 || $invisible[0]==4) && $view[$z]==1){
                                    $isin = ($mod_group[$z]==0 || ($titanium_userpoints>0 && $titanium_userpoints>=$pointsneeded[$mod_group[$z]])) ? 1 : 0 ;
                                }

                                if($is_user==1 && $view[$z]==1 && $invisible[0]==4 && $isin==0) {// c'est un membre, qui n'est pas dans le groupe pouvant visualiser ce module
                                    $limage="<img src=\"$path_icon/admin/interdit.gif\" title=\""._SOMRESTRICTED."\">";
                                }
                                elseif ($is_user==0 && $view[$z]==1 && ($invisible[0]==2 || $invisible[0]==4)) {//visiteur non membre, ne peut pas visualiser un module r�serv� aux membres.
                                    $limage="<img src=\"$path_icon/admin/interdit.gif\" title=\""._SOMRESTRICTED."\">";
                                }

                                if ($is_user==1 && $view[$z]==1 && $invisible[0]==5 && $isin==0 && $is_admin==0) { //c'est un membre, mais pas dans le bon groupe pour voir le module.
                                }
                                elseif($is_user==0 && $view[$z]==1 && $invisible[0]==5 && $is_admin==0) { //c'est un visiteur, il doit �tre membre et faire partie d'un groupe pour voir le module.
                                }
                                elseif ($is_user==0 AND $view[$z]==1 AND $invisible[0]==3 && $is_admin==0) { //c'est un visiteur, il doit �tre membre pour voir le module (pas de gestion des groupes)
                                }
                                else {

                                    if (($newpms[0]) AND ($titanium_module[$z] =="Private_Messages")) {
                                        $disp_pmicon="<img src=\"images/blocks/email-y.gif\" height=\"10\" width=\"14\" alt=\""._SOMNEWPM."\" title=\""._SOMNEWPM."\">";
                                    }
                                    else {
                                        $disp_pmicon="";
                                    }
                                    ////// ajout support NEW! automatique pour les modules de base.
                                    $new = ($newinthisgroup[$som_groupmenu][$keyinthisgroup]=="on") ? "<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">" : "" ;

                                    if ($nomdumodule=="Downloads" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
                                        $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
                                        $sqlimgnew="SELECT date FROM ".$titanium_prefix."_downloads_downloads".$where." ORDER BY date DESC LIMIT 1";
                                        $resultimgnew=$titanium_db->sql_query($sqlimgnew);
                                        $rowimgnew = $titanium_db->sql_fetchrow($resultimgnew);
                                        if ($rowimgnew['date']) {
                                            preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
                                            $zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
                                            $now=time();
                                            if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
                                                $new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">";
                                            }
                                        }
                                    }
                                    elseif ($nomdumodule=="Web_Links" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
                                        $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
                                        $sqlimgnew="SELECT date FROM ".$titanium_prefix."_links_links".$where." ORDER BY date DESC LIMIT 1";
                                        $resultimgnew=$titanium_db->sql_query($sqlimgnew);
                                        $rowimgnew = $titanium_db->sql_fetchrow($resultimgnew);
                                        if ($rowimgnew['date']) {
                                            preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
                                            $zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
                                            $now=time();
                                            if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
                                                $new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">";
                                            }
                                        }
                                    }
                                    elseif ($nomdumodule=="Content" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
                                        $where = (preg_match("/^cid=[0-9]*$/",$temponomdumodule[2])) ? " WHERE $temponomdumodule[2]" : "";
                                        $sqlimgnew="SELECT date FROM ".$titanium_prefix."_pages".$where." ORDER BY date DESC LIMIT 1";
                                        $resultimgnew=$titanium_db->sql_query($sqlimgnew);
                                        $rowimgnew = $titanium_db->sql_fetchrow($resultimgnew);
                                        if ($rowimgnew['date']) {
                                            preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['date'], $datetime);
                                            $zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
                                            $now=time();
                                            if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
                                                $new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">";
                                            }
                                        }
                                    }
                                    elseif ($nomdumodule=="Reviews" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
                                        $where = "";
                                        $sqlimgnew="SELECT date FROM ".$titanium_prefix."_reviews".$where." ORDER BY date DESC LIMIT 1";
                                        $resultimgnew=$titanium_db->sql_query($sqlimgnew);
                                        $rowimgnew = $titanium_db->sql_fetchrow($resultimgnew);
                                        if ($rowimgnew['date']) {
                                            preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/", $rowimgnew['date'], $datetime);
                                            $zedate = mktime(0,0,0,$datetime[2],$datetime[3],$datetime[1]);
                                            $now=time();
                                            if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
                                                $new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">";
                                            }
                                        }
                                    }
                                    elseif ($nomdumodule=="Journal" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
                                        $where = "";
                                        $sqlimgnew="SELECT mdate FROM ".$titanium_prefix."_journal".$where." ORDER BY mdate DESC LIMIT 1";
                                        $resultimgnew=$titanium_db->sql_query($sqlimgnew);
                                        $rowimgnew = $titanium_db->sql_fetchrow($resultimgnew);
                                        if ($rowimgnew['mdate']) {
                                            preg_match ("/([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})/", $rowimgnew['mdate'], $datetime);
                                            $zedate = mktime(0,0,0,$datetime[1],$datetime[2],$datetime[3]);
                                            $now=time();
                                            if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
                                                $new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">";
                                            }
                                        }
                                    }
                                    elseif ($nomdumodule=="Blog" && $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]!="-1") {
                                        $where = (preg_match("/^new_topic=[0-9]*$/",$temponomdumodule[1])) ? " WHERE ".str_replace("new_","",$temponomdumodule[1])."" : "";
                                        $sqlimgnew="SELECT datePublished FROM ".$titanium_prefix."_stories".$where." ORDER BY datePublished DESC LIMIT 1";
                                        $resultimgnew=$titanium_db->sql_query($sqlimgnew);
                                        $rowimgnew = $titanium_db->sql_fetchrow($resultimgnew);
                                        if ($rowimgnew['datePublished']) {
                                            preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/", $rowimgnew['datePublished'], $datetime);
                                            $zedate = mktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
                                            $now=time();
                                            if(intval(($now-$zedate)/86400) <= $newdaysinthisgroup[$som_groupmenu][$keyinthisgroup]) {
                                                $new="<img src=\"$path_icon/admin/$imgnew\" border=0 title=\""._SOMNEWCONTENT."\">";
                                            }
                                        }
                                    }
                                    if ($limage!="middot.gif" && (empty($customtitle2) || $customtitle2==" " || $customtitle2=="&nbsp;" || $customtitle2=="&amp;nbsp;")) { //si le texte du lien est vide l'image va être clickable
                                        if ($no_category_text[$som_groupmenu]===1) {    //V2.1.2beta3
                                            $content.="<tr><td colspan=2 align=\"left\" width=\"100%\">&nbsp;<a href=\"".$urldumodule."\" ".$targetblank.">".$limage."</a>".$new."";
                                        }
                                        else {
                                            $content.="<tr><td width=\"$catimagesize[0]\" align=\"right\"></td><td>&nbsp;<a href=\"".$urldumodule."\" ".$targetblank.">".$limage."</a>".$new."";
                                        }
                                    $content.="</td></tr>\n";
                                    }
                                    else {
                                        $width=" width=\"$catimagesize[0]\"";
                                        if ($no_category_text[$som_groupmenu]===1) {    //V2.1.2beta3
                                            $content.="<tr><td colspan=2 align=\"left\" width=\"100%\">".$limage."".$disp_pmicon."";
                                        }
                                        else {
                                            $content.="<tr><td".$width." align=\"right\">".$limage.""."</td><td>".$disp_pmicon."";
                                        }
                                        $content.="&nbsp;<a href=\"".$urldumodule."\" class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\" ".$targetblank."><span class=\"".$classinthisgroup[$som_groupmenu][$keyinthisgroup]."\">".$gras1."$customtitle2".$gras2."</span></a>".$new."";
                                        $content.="</td></tr>\n";
                                    }
                                }
                            }

                        }
                    }
                }// end for
               }// end else (pas lien externe et pas listbox)
            $keyinthisgroup++;
        }// end while
        if ($som_listbox=="on") {
            $content.="</select></form></td></tr>";
        }
        $content.="</table>";

        $content.="</td></tr>";
        $content.="<tr height=\"4\" bgcolor=\"$som_bgcolor\"><td></td></tr>";
        }//end if somgroupmenu<>99

    if ($som_groupmenu == 99 && $is_admin==1) { // si on est à la catégorie 99, on affiche tous les modules installés/activés/visibles qui n'ont pas été affichés dans les catégories.
        $content.="<tr><td>";
        for ($z=0;$z<count($titanium_module);$z++) {
            $customtitle2 = str_replace ("_"," ", $titanium_module[$z]);
            if (!empty($customtitle[$z])) {
                $customtitle2 = $customtitle[$z];
            }
            if ($titanium_module[$z] != $main_module_titanium) {
                 if (($is_admin===1 AND $view[$z] == 2) OR $view[$z] != 2) {

                    $incategories=0;
                    for ($i=0;$i<count($totalcategorymodules);$i++) {
                        if ($titanium_module[$z]==$totalcategorymodules[$i]) {
                            $incategories=1;
                        }
                    }
                    if ($incategories==0) {
                        $flagmenu = $flagmenu+1;
                        if ($flagmenu==1) {
                            $content .="<hr><div align=\"center\">"._SOMMAIREADMINVIEWALLMODULES."</div><br />";   // si il y a des modules affichés en rubrique 99, on affiche avant une ligne horizontale
        $content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistboxvisibles\">"
                        ."<select width=\"100%\" name=\"somlistboxvisibles\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
                        ."<option value=\"select\">"._SOMSELECTALINK."";
                        }
                            $content .= "<option value=\"modules.php?name=$titanium_module[$z]\">$customtitle2</option>\n";
                    }
                }
            }
        }//end for groupmenu=99
        $content.="</select></form>";
        $content.="</td></tr>";
    }//end if groupmenu=99
    }
    $content.="</table>";
    if ($dynamic==1 && $detectMozilla!=1) { // on va réenrouler toutes les catégories, sauf celle contenant le module affiché sur la page
        $aenlever="sommaire_showhide\('sommaire-".$categorieouverte."','nok','sommaireupdown-".$categorieouverte."'\);";
        $total_phpbb2_actions = str_replace("$aenlever", "" , $total_phpbb2_actions);
        $content.="<script type=\"text/javascript\" language=\"JavaScript\">$total_phpbb2_actions;</script>";
    }


    /* If you're Admin you and only you can see Inactive modules and test it */
    /* If you copied a new module is the /modules/ directory, it will be added to the database */

if ($is_admin===1) {

    $key=count($titanium_module); // $key va permettre de se positionner dans $titanium_module[] pour rajouter des modules à la fin

    $content .= "<br /><center><strong>"._INVISIBLEMODULES."</strong><br />";
    $content .= "<span class=\"tiny\">"._ACTIVEBUTNOTSEE."</span></center>";
    if (!($a == 1 AND $dummy != 1)) {
        $content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistboxinvisibles\">"
                        ."<select name=\"somlistboxinvisibles\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
                        ."<option value=\"select\">"._SOMSELECTALINK."";
        $sql = "SELECT title, custom_title FROM ".$titanium_prefix."_modules WHERE active='1' AND inmenu='0' AND `title` NOT LIKE '~l~%' ORDER BY title ASC";
        $result = $titanium_db->sql_query($sql);
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $titanium_module[$key]=$row['title'];
            $key++;
            $mn_title = $row['title'];
            $custom_title = $row['custom_title'];
            $mn_title2 = str_replace("_", " ", $mn_title);
            if (!empty($custom_title)) {
                $mn_title2 = $custom_title;
            }
            if (!empty($mn_title2)) {
                $content .= "<option value=\"modules.php?name=".$mn_title."\">".$mn_title2."";
                $dummy = 1;
            } else {
                $a = 1;
            }
        }
        $content.= "</select></form>\n";
    }
    else {
        $content .= "<br /><strong><big>&middot;</big></strong>&nbsp;<i>"._NONE."</i><br />\n";
    }

    $content .= "<br /><center><strong>"._NOACTIVEMODULES."</strong><br />";
    $content .= "<span class=\"tiny\">"._FORADMINTESTS."</span></center>";
    if (!($a == 1 AND $dummy != 1)) {
        $content.="<form action=\"modules.php\" method=\"get\" name=\"sommaireformlistboxinactifs\">"
                ."<select name=\"somlistboxinactifs\" onchange=\"sommaire_envoielistbox(this.options[this.selectedIndex].value)\">"
                ."<option value=\"select\">"._SOMSELECTALINK."";
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
if (!($row4 = $cache->load('sommaire_row4', 'block'))) {
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $sql = "SELECT title, custom_title FROM ".$titanium_prefix."_modules WHERE active='0' AND `title` NOT LIKE '~l~%' ORDER BY title ASC";
        $result = $titanium_db->sql_query($sql);
        while ($row = $titanium_db->sql_fetchrow($result)) {
            $row4[] = $row;
        }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
$cache->save('sommaire_row4', 'block', $row4);
}
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        if (is_array($row4)) {
        foreach($row4 as $row) {
            $titanium_module[$key]=$row['title'];
            $key++;
            $mn_title = $row['title'];
            $custom_title = $row['custom_title'];
            $mn_title2 = str_replace("_", " ", $mn_title);
            if (!empty($custom_title)) {
            $mn_title2 = $custom_title;
            }
            if (!empty($mn_title2)) {
                $content .= "<option value=\"modules.php?name=".$mn_title."\">".$mn_title2."";
            $dummy = 1;
            } else {
                $a = 1;
                }
        }
        }
        $content.= "</select></form>\n";
    }
    else {
            $content .= "<br /><strong><big>&middot;</big></strong>&nbsp;<i>"._NONE."</i><br />\n";
    }

/*****[BEGIN]******************************************
 [ Base:    Module Simplifications             v1.0.0 ]
 ******************************************************/
    update_modules();
/*****[END]********************************************
 [ Base:    Module Simplifications             v1.0.0 ]
 ******************************************************/
}//end if admin

?>