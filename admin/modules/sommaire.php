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
/************************************************************************/

/*************************************************************************/
/*                    Module Copyright (c) Information                     */
/*              Module Sommaire paramtrable for PHP-Nuke.               */
/*                            - 26 Mai  2004 -                           */
/*                                                                       */
/* Nom du Module: Sommaire paramtrable                                  */
/* Version du Module: 2.1.1                                              */
/*                                                                       */
/* Description du Module:                                                */
/*       Bloc Sommaire paramtrable : affichage par catgories, avec de  */
/*       nombreuses possibilits de prsentation :                       */
/*       - Menu dynamique (catgories affiches/caches avec un clic     */
/*       - Ajout manuel d'une icone 'NEW' devant les catgories          */
/*       - Ajout manuel d'une icone 'NEW' devant les liens/modules       */
/*       - Ajout automatique d'une icone 'NEW' devant les modules de     */
/*         base, avec la dtection des nouveauts du site, et choix de   */
/*         la dure des "nouveauts".                                    */
/*       - Possibilit de mettre un lien ou une catgorie en gras        */
/*       - Contenu des catgories peut tre affich en listbox           */
/*       - Choix du style des liens/modules (classe css)                 */
/*       - Affichage possible des catgories avec uniquement une image   */
/*       - Affichage possible des liens/modules avec uniquement une image*/
/*       - Barre horizontale pour sparer 2 catgories ou 2 liens (v2.1) */
/*       - Titre de catgorie centr                                     */
/*       - Couleur de fond diffrente pour chaque catgorie              */
/*       - Image sur les catgories et les modules                       */
/*       - Ajout de liens externe (n'importe quelle url)                 */
/*       - Affichage d'une icne dans le sommaire si le membre a des     */
/*         Messages Privs non lus.                                      */
/*       - Masquer ou non aux visiteurs les modules rservs aux membres */
/*       - Choisir le style (dans style.css) des noms de catgories      */
/*       - Mettre un fichier FLASH .swf  la place du nom de catgorie   */
/*         (FLASH implment par MAC06 - magetmac06@hotmail.com)         */
/*                                                                       */
/* License: GNU/GPL                                                      */
/* Nom de l'Auteur: marcoledingue                                        */
/* Email de l'Auteur : marcoledingue@free.fr                             */
/*************************************************************************/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       10/01/2005
      Caching System                           v1.0.0       11/01/2005
 ************************************************************************/

if (!defined('ADMIN_FILE')) {
   die ('Illegal File Access');
}

global $admin, $keysommaire, $currentlang, $deletecat, $titanium_db, $titanium_prefix, $sql, $upgrade_test, $bgcolor1, $zetheme, $admin_file, $admdata, $titanium_cache;

if ($admdata['radminsuper'] == 1) {

$zetheme=get_theme();
$urlofimages="images/sommaire";
//$urlofimages="themes/$zetheme/images/sommaire";

if (file_exists(NUKE_ADMIN_DIR.'language/Sommaire/lang-'.$currentlang.'.php')) {
    include_once(NUKE_ADMIN_DIR.'language/Sommaire/lang-'.$currentlang.'.php');
} else {
    include_once(NUKE_ADMIN_DIR.'language/Sommaire/lang-english.php');
}


$more_js .= "<script language=\"Javascript\">
    function sommaireadminshowhide(zenom, numero) {
        if (numero==1) {
            document.getElementById(zenom).style.display='';
        }
        else if (numero==0) {
            document.getElementById(zenom).style.display='none';
         }
     }
    function sommairechangecatimgnew(zeimage) {
        var reg= new RegExp(\"{$urlofimages}/admin/new.gif\",\"gi\");
        if (reg.test(zeimage.src)) {zeimage.src=\"{$urlofimages}/admin/new_gray.gif\";}
        else {zeimage.src=\"{$urlofimages}/admin/new.gif\";}
    }
	
    function disab (cetobjet,valeur,formlink,formlinktext,linkvaleur,linktextvaleur) {
		if (valeur=='SEP') {
			cetobjet.selectedIndex=0;
		}
		if (valeur=='Lien externe') {
			 formlink.disabled=false;
			 if (linkvaleur=='') {
				 formlink.value=\"http://\";
				 formlinktext.value=\"\";
			 }
			 else {
				 formlink.value=linkvaleur;
				 formlinktext.value=linktextvaleur;
			 }
			 formlinktext.disabled=false;
			 formlink.style.backgroundColor=\"#FFFFFF\";
			 formlink.style.borderStyle=\"solid\";
			 formlinktext.style.backgroundColor=\"#FFFFFF\";
			 formlinktext.style.borderStyle=\"solid\";
		}
		else {
		 formlink.disabled=true;
		 formlink.value=\"\";
		 formlink.style.backgroundColor=\"{$bgcolor1}\";
		 formlink.style.borderStyle=\"none\";
		 formlinktext.disabled=true;
		 formlinktext.value=\"\";
		 formlinktext.style.backgroundColor=\"{$bgcolor1}\";
		 formlinktext.style.borderStyle=\"none\";
		}
	}
		
    function targetblank(pointeur,valeur) {
        testehttp = valeur.slice(0,7 );
        testeftp = valeur.slice(0,6);
        http='http://';
        ftp='ftp://';
        if(testehttp == http || testeftp == ftp) {
            pointeur.src=\"{$urlofimages}/admin/targetblank.gif\";
            pointeur.alt=\""._SOMTARGETBLANK."\";
            pointeur.title=\""._SOMTARGETBLANK."\";
        }
        else {
            pointeur.src=\"{$urlofimages}/admin/targetnone.gif\";
            pointeur.alt=\""._SOMTARGETNONE."\";
            pointeur.title=\""._SOMTARGETNONE."\";
        }
    }
	
    function check_numeric (my_element, old_value) {
        var text_value = my_element.value;
        if (text_value.length >0) {
            if (isNaN(text_value)) {
                alert (\""._SOMMSGNOTNUM."\");
                my_element.value = old_value;
            }
        }
        else {
            alert (\""._SOMMSGVOID."\");
            my_element.value = old_value;
        }
    }
	
    function envoiedit(keysommaire, z) {
        var reg= new RegExp(\"[&]\",\"gi\");
        var seg= new RegExp(\"[\?]\",\"gi\");
        var modulename = document.forms.form_sommaire.elements['sommaireformingroup['+keysommaire+']['+z+']'].value;
        var lienname = document.forms.form_sommaire.elements['sommaireformmodulelinktext['+keysommaire+']['+z+']'].value;
        lienname = lienname.replace(reg,\"[SOMSYMBOLEet]\");
        lienname = lienname.replace(seg,\"[SOMSYMBOLEinterro]\");
        var image = document.forms.form_sommaire.elements['sommaireformmoduleimage['+keysommaire+']['+z+']'].value;
        //var lienlien = document.forms.form_sommaire.elements['sommaireformmodulelink['+keysommaire+']['+z+']'].value;
        //var gras = document.forms.form_sommaire.elements['sommaireformmodulegras['+keysommaire+']['+z+']'].value;
        //var new = document.forms.form_sommaire.elements['sommaireformmodulenew['+keysommaire+']['+z+']'].value;
        var catname = document.forms.form_sommaire.elements['sommaireformname['+keysommaire+']'].value;
        catname = catname.replace(reg,\"[SOMSYMBOLEet]\");
        catname = catname.replace(seg,\"[SOMSYMBOLEinterro]\");
        var catimage = document.forms.form_sommaire.elements['sommaireformimage['+keysommaire+']'].value;
        var categoryclass = document.forms.form_sommaire.elements['sommaireformeachcategoryclass['+keysommaire+']'].value;
        var lienclass = document.forms.form_sommaire.elements['sommaireformmoduleclass['+keysommaire+']['+z+']'].value;
        var new_days = document.forms.form_sommaire.elements['sommaireformmodulenew_days['+keysommaire+']['+z+']'].value;
        var zeurl='{$admin_file}'+'.php?op=sommaire&amp;go=edit&amp;modulename='+modulename+'&amp;lienname='+lienname+'&amp;image='+image+'&amp;catname='+catname+'&amp;catimage='+catimage+'&amp;categoryclass='+categoryclass+'&amp;lienclass='+lienclass+'&amp;new_days='+new_days+'&amp;keysommaire='+keysommaire+'&amp;z='+z;
        window.open(zeurl,'sommaire_editlink','location=no, width=600, height=250, menubar=no, status=no, scrollbars=no, menubar=no');
        //alert(zeurl);
    }
</script>\n";

$zetheme=get_theme();

function index() {

global $titanium_db, $sql, $titanium_prefix, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $textcolor1, $keysommaire, $deletecat, $upgrade_test, $urlofimages; 
global $admin_file, $more_js;

include_once(NUKE_BASE_DIR.'header.php');
OpenTable();
echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=sommaire\">" . _SOM_ADMIN_HEADER . "</a></div>\n";
echo "<br /><br />";
echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SOM_RETURNMAIN . "</a> ]</div>\n";
CloseTable();
echo "<br />";
OpenTable();

//on va regarder tous les fichiers dans /images/sommaire pour en faire la liste
    $handle=@opendir("$urlofimages");
    $compteur=0;
    while ($tempo = @readdir($handle)) {
        $file[$compteur]= $tempo;
        $compteur++;
    }
    @closedir($handle);
// --> OK, la liste des fichiers est dans $file (utile plus bas pour faire la liste droulante des images).

//on va regarder tous les fichiers dans /images/sommaire/categories pour en faire la liste
    $handle=@opendir("$urlofimages/categories");
    $compteur=0;
    while ($tempo = @readdir($handle)) {
        $file2[$compteur]= $tempo;
        $compteur++;
    }
    @closedir($handle);
// --> OK, la liste des fichiers est dans $file2 (utile plus bas pour faire la liste droulante des images des modules).


// on va mettre la liste des modules dans la variable $titanium_modules
$sql = "SELECT title FROM ".$titanium_prefix."_modules ORDER BY title ASC";
$titanium_modulesaffiche= $titanium_db->sql_query($sql);
$compteur=0;
while ($tempo = $titanium_db->sql_fetchrow($titanium_modulesaffiche)) {
    $titanium_modules[$compteur]= $tempo['title'];
    $compteur++;
}

// on va mettre les donnes de la table nuke_sommaire_categories dans les variables adquates.
    $sql2= "SELECT id, groupmenu, module, url, url_text, image, new, new_days, class, bold FROM ".$titanium_prefix."_sommaire_categories ORDER BY id ASC";
    $result2= $titanium_db->sql_query($sql2);

    $compteur=0;
    $row2=$titanium_db->sql_fetchrow($result2); //on rcupre la premire ligne de la table, et on affecte aux variables.
    $categorie=$row2['groupmenu'];
    $titanium_moduleinthisgroup[$categorie][$compteur]=$row2['module'];
    $linkinthisgroup[$categorie][$compteur]=$row2['url'];
    $linktextinthisgroup[$categorie][$compteur]=$row2['url_text'];
    $imageinthisgroup[$categorie][$compteur]=$row2['image'];
    $newinthisgroup[$categorie][$compteur]=$row2['new'];
    $new_days=$new_daysinthisgroup[$categorie][$compteur]=$row2['new_days'];
    $firstclass=$classofthismodule[$categorie][$compteur]=$row2['class'];
    $grasofthismodule[$categorie][$compteur]=$row2['bold'];
    $idofthismodule[$categorie][$compteur]=$row2['id'];
    $compteur2=$categorie; 
//        echo "{$titanium_moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
    
    while ($row2 = $titanium_db->sql_fetchrow($result2)) { //ensuite on fait la mme chose pour toutes les autres lignes.
        $categorie=$row2['groupmenu'];
        if ($compteur2==$categorie) { //permet de savoir si on a chang de catgorie (groupmenu diffrent) : dans ce cas on remet le 2me compteur  0.
            $compteur++;
        }
        else {
            $compteur=0;
        }
        $titanium_moduleinthisgroup[$categorie][$compteur]=$row2['module'];
        $linkinthisgroup[$categorie][$compteur]=$row2['url'];
        $linktextinthisgroup[$categorie][$compteur]=$row2['url_text'];
        $imageinthisgroup[$categorie][$compteur]=$row2['image'];
        $newinthisgroup[$categorie][$compteur]=$row2['new'];
        $new_daysinthisgroup[$categorie][$compteur]=$row2['new_days'];
        $classofthismodule[$categorie][$compteur]=$row2['class'];
        $grasofthismodule[$categorie][$compteur]=$row2['bold'];
        $idofthismodule[$categorie][$compteur]=$row2['id'];
        $compteur2=$categorie;
//        echo "{$titanium_moduleinthisgroup[$categorie][$compteur]}<br />{$linkinthisgroup[$categorie][$compteur]}<br />{$linktextinthisgroup[$categorie][$compteur]}<br />{$imageinthisgroup[$categorie][$compteur]}<br />";
    }
// --> OK, les variables ont pris la valeur adquate de la table nuke_sommaire_categories


echo "<div align=\"center\" class=\"title\">"._SOMADMINTITLE."</div>";
CloseTable();
echo"<br />";
OpenTable();
echo "<head><style type=\"text/css\">"
.".texte     { COLOR: $textcolor1; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica}"
.".red {COLOR: #FF0000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; FONT-WEIGHT: bold}"
."INPUT         {BORDER-TOP-COLOR: #000000; BORDER-LEFT-COLOR: #000000; BORDER-RIGHT-COLOR: #000000; BORDER-BOTTOM-COLOR: #000000; BORDER-TOP-WIDTH: 1px; BORDER-LEFT-WIDTH: 1px; FONT-SIZE: 10px; BORDER-BOTTOM-WIDTH: 1px; FONT-FAMILY: Verdana,Helvetica; BORDER-RIGHT-WIDTH: 1px}"
.".disabled { background-color: $bgcolor1; border-style: none}"
."</style></head>";

// on rcupre la table nuke_sommaire
    $sql = "SELECT groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, new, bold, listbox, dynamic FROM ".$titanium_prefix."_sommaire ORDER BY groupmenu ASC";
    $result = $titanium_db->sql_query($sql);
    if (!$result) {die("<div class=\"red\" align=\"center\" style=\"font-size:16px\"><strong><br />"._SOMNOTABLEPB."<br /></strong></div>");}
    

    echo""
    ."<br /><div class=\"red\" align=\"center\"><br />"._SOMATTNSUPPRCAT."<br /></div>";

    echo ""
    ."<form action=\"".$admin_file.".php?op=sommaire&amp;go=send\" method=\"post\" name=\"form_sommaire\">"
    ."<table align=\"center\"><tr><td colspan=\"2\">"
    ."<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>"
    ."<table width=\"720\" align=\"center\" cellspacing=\"1\" cellpadding=\"4\">"
    ."<tr align=\"center\"><td><strong>"._SOMWEIGHT."</strong></td><td><strong>"._SOMCATEGORIES."</strong></td><td><strong>"._SOMACTION."</strong></td></tr>";

    
// on va afficher le tableau d'administration : une ligne pour chaque catgorie rentre dans la table, + une dernire ligne pour ajouter une catgorie.
    $keysommaire=0;
    if (!$result) {echo "<tr><td colspan=4>"._SOMNOTABLEPB."</td></tr>";}
    while ($row = $titanium_db->sql_fetchrow($result)) {  // on crit une ligne du formulaire avec les donnes de nuke_sommaire pour chaque ligne de nuke_sommaire
        $groupmenu[$keysommaire] = $row['groupmenu'];
        $catname[$keysommaire] = $row['name'];
        $image[$keysommaire] = $row['image'];
        $lien[$keysommaire] = $row['lien'];
        $hr[$keysommaire] = $row['hr'];
        $center[$keysommaire] = $row['center'];
        $categoriebgcolor[$keysommaire] = $row['bgcolor'];
        $invisible[$keysommaire] = $row['invisible'];
        $categoryclass[$keysommaire] = $row['class'];
        $new[$keysommaire]= $row['new'];
        $bold[$keysommaire]= $row['bold'];
        $listbox[$keysommaire] = $row['listbox'];
        $dynamic[$keysommaire] = $row['dynamic'];
//        $key99=0;

        if ($groupmenu[$keysommaire]==99) { //quand on est  la dernire catgorie de la table (99 - catgorie vide), on affiche une nouvelle ligne du tableau
            echo "<tr align=\"center\"><td  colspan=3><strong><br />"._SOMNEWCATEGORY."<br /><br /></strong></td></tr>";
            $key99=$groupmenu[$keysommaire];
            $keyadd = $groupmenu[$keysommaire-1]; // pour incrmenter : $groupmenu[$keysommaire] n'existe pas, puisque on a affich toutes les lignes de nuke_sommaire!
            $keyadd = $keyadd+1;
            $groupmenu[$keysommaire]=$keyadd;
        }
        echo""
            ."<tr align=\"center\">"
            ."<td rowspan=\"2\" >"
            ."<input type=\"text\" name=\"sommaireformgroupmenu[$keysommaire]\" size=\"2\" maxlength=2 value=\"$groupmenu[$keysommaire]\" onchange='check_numeric(this,$groupmenu[$keysommaire])'><br /></td>"
            ."<td><table align=\"left\" cellspacing=\"0\" cellpadding=\"0\">";

            $newcolor = ( $new[$keysommaire]=="on" ) ? "new.gif" : "new_gray.gif" ;
            echo "<tr height=8><td></td></tr><tr align=\"center\"><td></td><td><strong>"._SOMCATNAME."</strong></td><td></td><td><strong>"._SOMIMGNAME."</strong></td><td colspan=2><strong>"._SOMCATLINK."</strong></td><td>&nbsp;<strong>"._SOMBOLD."</strong></td><td>&nbsp;<img id=\"somcatnew$keysommaire\" src=\"".$urlofimages."/admin/$newcolor\"></td></tr><tr height=\"8\"><td></td></tr><tr align=\"center\">";        
        echo"<input type=\"Hidden\" name=\"sommaireformkeysommaire\" value=\"$keysommaire\">" //utile pour la fonction send : on sait  quelle ligne on fait rfrence
            ."<input type=\"Hidden\" name=\"sommaireformgroupmenu[99]\" value=\"99\">"//utile car la requte sql efface toutes les donnes et n'crit dans nuke_sommaire que les donnes entres dans le formulaire.
            ."<td align=\"right\">";

// si l'image de catgorie indique dans la DB est "noimg" (--> pas d'image!), on affiche l'image 'null.gif', qui est une image transparente.
        $zeimgname = ($image[$keysommaire]=="noimg" || $image[$keysommaire]=='') ? "admin/null.gif" : $image[$keysommaire];
            echo "<img src=\"".$urlofimages."/".$zeimgname."\" name=\"catimage".$keysommaire."\">";

// fonction jscript permettant de changer l'image affiche (en fonction de la valeur indique dans la listbox 'image dans cette catgorie')
        echo "<script language=\"Javascript\">"
            ."function change".$keysommaire."(valeur) {"
            ."var url=\"".$urlofimages."/\";"
            ."if (valeur==\"noimg\") {"
            ."valeur=\"admin/null.gif\";"
            ."}"
            ."document.images.catimage".$keysommaire.".src=url+valeur;"
            ."}</script>"

            ."&nbsp;</td>"
            ."<td>"
            ."<input type=\"text\" name=\"sommaireformname[$keysommaire]\" size=\"20\" maxlength=150 value=\"$catname[$keysommaire]\"></td>"
            ."<td>&nbsp;</td><td>&nbsp;"

            ."<select name=\"sommaireformimage[$keysommaire]\" onchange=\"change".$keysommaire."(this.value)\">";

            $selected = ($image[$keysommaire]=="noimg") ? "selected" : "" ;
            echo "<option value=\"noimg\" $selected>"._SOMNOIMG."</option>";

        for ($i=0;$i<count($file);$i++) { //on cre une entre dans la listbox pour chaque image prsente dans le rpertoire /images/sommaire
            if ($file[$i] != "." && $file[$i] != ".." && $file[$i] != "categories" && $file[$i] != "admin") {
                if ($file[$i]==$image[$keysommaire]) {
                    echo "<option value =\"$file[$i]\" selected>$file[$i]</option>";
                }
                else {
                    echo "<option value =\"$file[$i]\" >$file[$i]</option>";
                }
            }
        }
        
        echo "</select></td>"
            ."<td align=\"right\">";
            
        $testehttp=strpos($lien[$keysommaire],"http://");
        $testeftp=strpos($lien[$keysommaire],"ftp://");
        $testehttps=strpos($lien[$keysommaire],"https://");
        $affichetblank = ($testehttp===0 || $testeftp===0 || $testehttps===0) ? "targetblank" : "none"; //permet d'afficher l'image "ouvrir dans une nouvelle fentre" si le lien commence par http:// ou ftp://
        $alttblank = ($testehttp===0 || $testeftp===0 || $testehttps===0) ? ""._SOMTARGETBLANK."" : ""._SOMTARGETNONE.""; //permet d'afficher l'image "ouvrir dans une nouvelle fentre" si le lien commence par http:// ou ftp://
        echo "<img src=\"".$urlofimages."/admin/".$affichetblank.".gif\" name=\"targetblank$keysommaire\" alt=\"".$alttblank."\" title=\"".$alttblank."\" width=15>";
            
        echo"&nbsp;</td><td align=\"left\">"
        ."<input type=\"text\" name=\"sommaireformlien[$keysommaire]\" size=\"20\" value=\"$lien[$keysommaire]\" onchange='targetblank(document.images.targetblank$keysommaire,this.value)'></td>";
        
        $checked = ( $bold[$keysommaire]<>"" ) ? "checked" : "" ;//on coche la case par dfaut si c'est indiqu dans la DB
        echo "<td><input type=\"checkbox\" name=\"sommaireformbold[$keysommaire]\" $checked></td>";
        $checked = ( $new[$keysommaire]<>"" ) ? "checked" : "" ;
        echo "<td><input type=\"checkbox\" name=\"sommaireformnew[$keysommaire]\" $checked onchange=\"sommairechangecatimgnew(document.images['somcatnew$keysommaire'])\"></td>"
        ."</tr>"
        ."<tr height=8><td></td></tr><tr><td align=\"left\" colspan=10><strong>"._SOMMISEENPAGE."</strong>&nbsp;:&nbsp;"; //v2.1 colspan was 6
        $checked = ($hr[$keysommaire]=="on") ? "checked" : "" ;
        echo "<input type=\"checkbox\" name=\"sommaireformhr[$keysommaire]\" $checked>&nbsp;"._SOMHR."&nbsp;&nbsp;&nbsp;";
        $checked = ($center[$keysommaire]=="on") ? "checked" : "" ;
        echo "<input type=\"checkbox\" name=\"sommaireformcenter[$keysommaire]\" $checked>&nbsp;"._SOMCENTER."&nbsp;&nbsp;&nbsp;";
        $checked = ($listbox[$keysommaire]=="on") ? "checked" : "" ;
        echo "<input type=\"checkbox\" name=\"sommaireformlistbox[$keysommaire]\" $checked>&nbsp;"._SOMLISTBOX."&nbsp;&nbsp;&nbsp;";
        echo "<input type=\"text\" name=\"sommaireformbgcolor[$keysommaire]\" size=8 value=\"$categoriebgcolor[$keysommaire]\">&nbsp;"._SOMBGCOLOR."&nbsp;&nbsp;&nbsp;</td>"
            ."</tr><tr height=8><td></td></tr></table></td>"
            ."<td rowspan=2>";
        if ($key99<>99){
            echo"<div class=\"red\"><a href=\"".$admin_file.".php?op=sommaire&amp;go=deletecat&amp;deletecat=$groupmenu[$keysommaire]&amp;catname=$catname[$keysommaire]\" title=\""._SOMSUPPR."\" onclick=\"if (confirm('"._SOMJSSAVEBEFORE."')) {document.forms.form_sommaire.submit();};\"><img src=\"".$urlofimages."/admin/trash.gif\" border=0></a></div>";
        }    
        echo "</td>"
            ."</tr><tr><td>";
        
// maintentant, on va afficher les modules inscrits dans la catgorie actuelle
        
// combien y a-t-il de modules dans cette catgorie ?
if ( is_array( $titanium_moduleinthisgroup[$groupmenu[$keysommaire]]) ) {
    if ( $titanium_moduleinthisgroup[$groupmenu[$keysommaire]] > count($titanium_moduleinthisgroup[$groupmenu[$keysommaire]]) ) // if the requested page doesn't exist
    $nbmodules = $nombremodules = count($titanium_moduleinthisgroup[$groupmenu[$keysommaire]]);
} else { 	
    $nbmodules = $nombremodules = 0;
}
 //       $nbmodules = $nombremodules = count($titanium_moduleinthisgroup[$groupmenu[$keysommaire]]);
        $nombremodules=$nombremodules+5; // on en ajoute 5, qui vont tre vides
        
        echo "<table align=\"center\"><td></td><td align =\"center\">"._SOMCATCONTENT."</td><td width=\"3\"></td><td align=\"center\">"._SOMLINKURL."</td><td width=\"3\"></td><td align=\"center\">"._SOMLINKTEXT."</td><td width=\"3\"></td><td align=\"center\">"._SOMIMAGE."</td><td align=\"center\">"._SOMBOLD."</td><td></td></tr>";
        echo "<tr><td colspan=10 height=4></td></tr>";
        
        for ($z=0;$z<$nombremodules;$z++) {
            $formpointeur=$keysommaire."_".$z."";
            
            // permet d'afficher le middot pour les champs vides ajouts (quand nombremodules a t augment de 1 ou 2)
            if ($imageinthisgroup[$groupmenu[$keysommaire]][$z]=='' || $imageinthisgroup[$groupmenu[$keysommaire]][$z]=='middot.gif') {
                $afficheimageinthiscategorie="admin/middot.gif";
            }
            else {
                $afficheimageinthiscategorie="categories/".$imageinthisgroup[$groupmenu[$keysommaire]][$z];
            }
            echo "<tr id=\"span$formpointeur\"><td valign=\"center\"><img src=\"".$urlofimages."/$afficheimageinthiscategorie\" name=\"image$formpointeur\">"
                // on va changer l'image affiche devant le nom du module...
                ."<script language=\"Javascript\">"
                ."function changeimage$formpointeur(cedoc,valeur) {"
                    ."if (valeur==\"middot.gif\") {"
                    ."url =\"".$urlofimages."/admin/\";"
                    ."}"
                    ."else {"
                    ."var url=\"".$urlofimages."/categories/\";"
                    ."}"
                    ."document.images.image$formpointeur.src=url+valeur;"
                ."}"
                ."</script>";

            echo "</span></td><td align=\"center\">";
    // ces 2 variables vont servir  envoyer  la fonction jscript 'disab' la valeur de l'url et de son texte.
            $linkvalue=$linkinthisgroup[$groupmenu[$keysommaire]][$z];
            $linktextvalue=$linktextinthisgroup[$groupmenu[$keysommaire]][$z];

//echo "{$titanium_moduleinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
$zz=$z+1;

if ($z==$nombremodules-1) { // si on est  la dernire listbox, on affiche le message demandant d'envoyer les modifs.
    $hideok =  1;
    $sommairezenom = "sommairespan$keysommaire";
}
else {
    $hideok =  1;
    $sommairezenom = "span".$keysommaire."_".$zz."";
}
    // si on slectionne 'Lien externe' dans la liste des modules, cela va afficher les inputbox.
            echo "<select name=\"sommaireformingroup[$keysommaire][$z]\" onchange='disab(this,this.value,this.form.elements[\"sommaireformmodulelink[$keysommaire][$z]\"],this.form.elements[\"sommaireformmodulelinktext[$keysommaire][$z]\"],\"$linkvalue\",\"$linktextvalue\"); sommaireadminshowhide(\"$sommairezenom\",$hideok)'>";
            echo "<option value=\"Aucun\">";
            $selected = ($titanium_moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="SOMMAIRE_HR") ? "selected" : "" ;
            echo "<option value=\"SOMMAIRE_HR\" $selected>*"._SOMMAIREHR."*";
            $selected = ($titanium_moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="Lien externe") ? "selected" : "" ;
            echo "<option value=\"Lien externe\" $selected>*"._SOMEXTLINK."*";
            echo "<option value=\"SEP\">";
            for ($i=0;$i<count($titanium_modules);$i++) {
                $selected = ($titanium_modules[$i]==$titanium_moduleinthisgroup[$groupmenu[$keysommaire]][$z]) ? "selected" : "" ;
                echo "<option value=\"$titanium_modules[$i]\" $selected>$titanium_modules[$i]";
                //echo"{$titanium_moduleinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";
            }
            echo "</select></td>";
            //echo "<td></td>";
            
            if ($titanium_moduleinthisgroup[$groupmenu[$keysommaire]][$z]=="Lien externe") { // si 'Lien externe' est indiqu dans la DB, on affiche les inputbox, sinon on les masque par dfaut
                echo "<td align=\"center\">";
                $testehttp=strpos($linkinthisgroup[$groupmenu[$keysommaire]][$z],"http://");
                $testeftp=strpos($linkinthisgroup[$groupmenu[$keysommaire]][$z],"ftp://");
                $testehttps=strpos($linkinthisgroup[$groupmenu[$keysommaire]][$z],"https://");
                if ($testehttp===0 || $testeftp===0 || $testehttps===0) { //permet d'afficher l'image "ouvrir dans une nouvelle fentre" si le lien commence par http:// ou ftp://
                    echo "<img src=\"".$urlofimages."/admin/targetblank.gif\" name=\"targetblank$formpointeur\" alt=\""._SOMTARGETBLANK."\" title=\""._SOMTARGETBLANK."\">";
                }
                else {// si le lien ne commence pas par http ou ftp, on met l'image targetnone.gif
                    echo "<img src=\"".$urlofimages."/admin/targetnone.gif\" name=\"targetblank$formpointeur\" alt=\""._SOMTARGETNONE."\" title=\""._SOMTARGETNONE."\">";
                }
                echo "</td><td align=\"center\">"
                ."<input type=\"text\" name=\"sommaireformmodulelink[$keysommaire][$z]\" value=\"".$linkinthisgroup[$groupmenu[$keysommaire]][$z]."\" size=20 onChange='targetblank(document.images.targetblank$formpointeur,this.value)'>"
                ."</td><td></td><td>"
                ."<input type=\"text\" name=\"sommaireformmodulelinktext[$keysommaire][$z]\" size=15 value=\"".$linktextinthisgroup[$groupmenu[$keysommaire]][$z]."\" ></td>";
            }

            else { // si "Lien externe" n'est pas slectionn par dfaut
                echo"<td><img src=\"".$urlofimages."/admin/none.gif\" name=\"targetblank$formpointeur\" alt=\"\" title=\"\"></td>";
                echo"<td align=\"center\">"
                ."<input type=\"text\" class=\"disabled\" name=\"sommaireformmodulelink[$keysommaire][$z]\" value=\"".$linkinthisgroup[$groupmenu[$keysommaire]][$z]."\" size=20 disabled onChange='targetblank(document.images.targetblank$formpointeur,this.value)' >"
                ."</td><td></td><td>"
                ."<input type=\"text\" class=\"disabled\" name=\"sommaireformmodulelinktext[$keysommaire][$z]\" size=15 disabled value=\"".$linktextinthisgroup[$groupmenu[$keysommaire]][$z]."\"></td>";
            }

//echo"{$linkinthisgroup[$groupmenu[$keysommaire]][$z]}<br />{$linktextinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";

            echo "<td></td><td align=\"center\">"
                ."<select name=\"sommaireformmoduleimage[$keysommaire][$z]\" onChange='changeimage$formpointeur(this.document,this.value)'>"
                ."<option value='middot.gif' >"._SOMNOIMG." ( <strong>&middot;</strong> )</option>";
            for ($i=0;$i<count($file2);$i++) {
                if ($file2[$i] != "." && $file2[$i] != "..") {
                    if ($file2[$i]==$imageinthisgroup[$groupmenu[$keysommaire]][$z]) {
                        echo "<option value =\"$file2[$i]\" selected>$file2[$i]</option>";
                    }
                    else {
                        echo "<option value =\"$file2[$i]\" >$file2[$i]</option>";
                    }
                }
            }
            echo "</select></td>";
            
//echo "{$imageinthisgroup[$groupmenu[$keysommaire]][$z]}<br />";

        $checked = ( $grasofthismodule[$groupmenu[$keysommaire]][$z]<>"" ) ? "checked" : "" ;
        echo "<td align=\"center\"><input type=\"checkbox\" name=\"sommaireformmodulegras[$keysommaire][$z]\" $checked></td>";
        $checked = ( $newinthisgroup[$groupmenu[$keysommaire]][$z]<>"" ) ? "checked" : "" ;
        $phpbb2_colornew = ($checked=="checked") ? "new" : "new_gray";
        echo "<td align=\"center\"><input type=\"checkbox\" name=\"sommaireformmodulenew[$keysommaire][$z]\" $checked onchange=\"sommairechangecatimgnew(document.images['somnew$formpointeur'])\"><img name=\"somnew$formpointeur\" src=\"".$urlofimages."/admin/$phpbb2_colornew.gif\"></td>";
        echo "<td>";
        if ($z<$nbmodules) {
    //        echo "[<a href='javascript:envoiedit(document.forms.form_sommaire.elements[\"sommaireformingroup[".$keysommaire."][".$z."]\"].value,\"b\",\"c\",\"d\",\"e\",\"f\",\"g\")' title=\"More options\">+</a>]";
    //        echo "[<a href='javascript:envoiedit(document.forms.form_sommaire.elements[\"sommaireformingroup[".$keysommaire."][".$z."]\"].value, document.forms.form_sommaire.elements[\"sommaireformmodulelink[".$keysommaire."][".$z."]\"].value, document.forms.form_sommaire.elements[\"sommaireformmodulelinktext[".$keysommaire."][".$z."]\"].value, document.forms.form_sommaire.elements[\"sommaireformmoduleimage[".$keysommaire."][".$z."]\"].value, document.forms.form_sommaire.elements[\"sommaireformmodulegras[".$keysommaire."][".$z."]\"].value, document.forms.form_sommaire.elements[\"sommaireformmodulenew[".$keysommaire."][".$z."]\"].value, ".$idofthismodule[$groupmenu[$keysommaire]][$z].",\"".$catname[$keysommaire]."\", document.forms.form_sommaire.elements[\"sommaireformimage[".$keysommaire."]\"].value, \"".$groupmenu[$keysommaire]."\", ".$keysommaire.", ".$z.")' title=\""._SOMMOREOPTIONS."\">+</a>]";
            //echo "[<a href='javascript:envoiedit(".$keysommaire.", ".$z.")' title=\""._SOMMOREOPTIONS."\">+</a>]";
        }
        echo "</td>";
        echo "</tr>";

        if ($z>$nbmodules) { // pour n'afficher qu'une seul liste droulante vide, on cache les autres.
            echo "<script language=\"JavaScript\">"
            ."sommaireadminshowhide(\"span$formpointeur\",0);"
            ." </script>";
            }
    
    $inputmoduleclass = (empty($classofthismodule[$keysommaire][$z])) ? $firstclass : $classofthismodule[$keysommaire][$z];
    echo "<input type=\"hidden\" name=\"sommaireformmoduleclass[$keysommaire][$z]\" value=\"".$inputmoduleclass."\">";
    $inputnewdays= (empty($new_daysinthisgroup[$keysommaire][$z])) ? $new_days : $new_daysinthisgroup[$keysommaire][$z];
    echo "<input type=\"hidden\" name=\"sommaireformmodulenew_days[$keysommaire][$z]\" value=\"".$inputnewdays."\">";
    
    //echo "<br />{$new_daysinthisgroup[$keysommaire][$z]}<br />";
    
    } //end for : on a affich tous les modules/liens de cette catgorie

    echo "<tr id=\"sommairespan$keysommaire\"><td></td><td colspan=8>"._SOMSENDTOHAVEMORE."</td></tr>";//affiche le message demandant d'envoyer les modifs.
    echo "</table>";
    echo"</td></tr>";
    
    echo "<script language=\"JavaScript\">"
    ."sommaireadminshowhide(\"sommairespan$keysommaire\",0);"
    ." </script>";

    
    echo "<input type=\"hidden\" name=\"sommaireformeachcategoryclass[$keysommaire]\" value=\"$categoryclass[$keysommaire]\">";
    
    $keysommaire++;
} //end while : on a affich toutes les catgories.


$radio1=($invisible[0]==1) ? "checked" : "";
$radio2=($invisible[0]==2 || $invisible[0]==4) ? "checked" : ""; //gestion des groupes : si 4==>icone 'interdit' avec gestion groupes
$radio3=($invisible[0]==3 || $invisible[0]==5) ? "checked" : "";//gestion des groupes : si 5==>modules invisibles avec gestion groupes

$radionew=($new_days==-1) ? "" : "checked";
$disablenewdays=($new_days==-1) ? "disabled" : "";
$new_days_value = ($new_days==-1) ? "" : $new_days;

$checkdynamic = ($dynamic[0]=="on") ? "checked" : "" ;

    echo "</table></td></tr></table>"
        ."<br /></td></tr>"
        ."<tr><td colspan=\"2\"><br /><div  align=\"center\"><strong>"._SOMGENERALOPTIONS." :</strong></div><br /><br />"
        ."<table cellpadding=\"0\" cellspacing=\"0\" align=\"center\"><tr><td><strong>"._SOMDISPLAYMEMBERSONLYMODULES." :</strong></td><td width=\"50\"></td><td><strong>"._SOMDISPLAYCLASSES."</strong></td></tr>"
        ."<tr><td><input type=\"radio\" name=\"sommaireformradio\" value=\"1\" $radio1>"._SOMDISPLAYMODULENORMAL."</td>"
        ."<td></td><td><input type=\"text\" name=\"sommaireformclass\" size=\"15\" value=\"$categoryclass[0]\">&nbsp;"._SOMCATEGORIESCLASS."</td></tr>"
        ."<tr><td><input type=\"radio\" name=\"sommaireformradio\" value=\"2\" $radio2>"._SOMDISPLAYMODULEWITHICON." <img src=\"".$urlofimages."/admin/interdit.gif\"> "._SOMDISPLAYMODULEWITHICONFORVISTORS."</td>"
        ."<td></td><td><input type=\"text\" name=\"sommaireformclassformodules\" size=\"15\" value=\"".$firstclass."\">&nbsp;"._SOMMODULESCLASS."</td></tr>"
        ."<tr><td><input type=\"radio\" name=\"sommaireformradio\" value=\"3\" $radio3>"._SOMDISPLAYMODULEINVISIBLE."</td></tr>"
        ."<tr><td colspan=3><input type=\"checkbox\" name=\"sommaireformnew_type\" $radionew onchange='if (this.form.elements[\"sommaireformnew_days\"].disabled==true){this.form.elements[\"sommaireformnew_days\"].disabled=false;}else{this.form.elements[\"sommaireformnew_days\"].disabled=true;}'><strong>"._SOMAUTODETECTNEW."</strong>&nbsp;("._SOMSINCE." <input type=\"text\" name=\"sommaireformnew_days\" value=\"".$new_days_value."\" size=2 $disablenewdays> "._SOMNBDAYS.")"
        ."<input type=\"hidden\" name=\"sommaireformfirstnew_days\" value=\"".$new_days."\"><input type=\"hidden\" name=\"sommaireformfirstclass\" value=\"".$firstclass."\"></td></tr>"
        ."<tr><td colspan=3><input type=\"checkbox\" name=\"sommaireformdynamic\" $checkdynamic><strong>"._SOMDYNAMICMENU."</strong><br /><br /></td></tr></table></td></tr>"
        ."<tr><td width=\"50%\" align=\"center\"><input type='reset' value=\""._SOMCANCEL."\"></td><td width=\"50%\" align=\"center\"><input type=\"submit\" value=\""._SOMPOST."\"></td></tr>"
        ."</table>"
        ."</form>";
    
    echo""
        ."<br /><br />"._SOMREMARKS.""._SOMMAIREREMARKSTWO.""
        ."<br /><div align=\"center\"><a href=\"http://marcoledingue.free.fr/modules.php?name=Content&amp;pa=list_pages_categories&amp;cid=1\" style=\"FONT-SIZE:16px\" target=\"_blank\"><strong>FAQ</strong></a><br /><br />version 2.1.1 - &copy; <a href=\"mailto:marcoledingue@free.fr?body=Read the FAQ before asking me questions!!\">marcoledingue</a></div>";
        
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php');
}


function send() { // fonction appele quand on clique 'OK' sur le formulaire
    global $sommaireformkeysommaire, $sommaireformgroupmenu, $sommaireformname, $sommaireformimage, $sommaireformlien, $sommaireformingroup, $sommaireformmoduleimage, $sommaireformmodulelink, $sommaireformmodulelinktext, $sommaireformcenter, $sommaireformhr, $sommaireformbgcolor,$sommaireformradio, $sommaireformclass, $sommaireformbold, $sommaireformnew , $sommaireformlistbox, $sommaireformeachcategoryclass, $sommaireformmodulegras, $sommaireformmodulenew, $sommaireformnew_type, $sommaireformnew_days, $sommaireformmodulenew_days, $sommaireformfirstnew_days, $sommaireformmoduleclass, $sommaireformclassformodules, $sommaireformfirstclass, $sommaireformdynamic, $titanium_db, $titanium_prefix, $sql;
global $admin_file, $titanium_cache, $more_js;

//    global $sommaireformmoduleimage0_0, $sommaireformmoduleimage0_1, $sommaireformmoduleimage0_2, $sommaireformmoduleimage1_0, $sommaireformmoduleimage1_1, $sommaireformmoduleimage1_2;
    $sommaireformnew_days=($sommaireformnew_type=="on") ? $sommaireformnew_days : "-1" ;
    
 //si les valeurs de 'groupmenu' (Poids) entres dans le formulaire ne sont pas des nombres de 0  98, --> die
    for ($i=0; $i<=$sommaireformkeysommaire; $i++) {
        if ((!preg_match("/([0-9]{1,2})/",$sommaireformgroupmenu[$i])) OR ($sommaireformgroupmenu[$i]==99)) {
            include_once(NUKE_BASE_DIR.'header.php');
            OpenTable();
            echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=sommaire\">" . _SOM_ADMIN_HEADER . "</a></div>\n";
            echo "<br /><br />";
            echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SOM_RETURNMAIN . "</a> ]</div>\n";
            CloseTable();
            echo "<br />";
            OpenTable();
            echo"<div align=\"center\">";
            echo ""._SOMINVALIDWEIGHT."&nbsp;'$sommaireformname[$i]'&nbsp;($sommaireformgroupmenu[$i])";
            echo "<br />"._SOMMUSTBENUM."";
            echo "</div>";
            CloseTable();
            include_once(NUKE_BASE_DIR.'footer.php');
            return;
        }
     // si 2 catgories ont le mme groupmenu (poids) --> die
        for($j=0; $j<=$sommaireformkeysommaire; $j++) {
            if ($i<>$j) {
                if ($sommaireformgroupmenu[$i]==$sommaireformgroupmenu[$j]) {
                    include_once(NUKE_BASE_DIR.'header.php');
                    OpenTable();
                    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=sommaire\">" . _SOM_ADMIN_HEADER . "</a></div>\n";
                    echo "<br /><br />";
                    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SOM_RETURNMAIN . "</a> ]</div>\n";
                    CloseTable();
                    echo "<br />";
                    OpenTable();
                    echo"<div align=\"center\">";
                    echo ""._SOMCATS."&nbsp;'$sommaireformname[$i]'&nbsp;"._SOMAND."&nbsp;'$sommaireformname[$j]'&nbsp;"._SOMSAMEWEIGHT."&nbsp;($sommaireformgroupmenu[$i])";
                    echo "<br />"._SOMMODIFWEIGHT."";
                    echo "<br />NB :&nbsp;"._SOMMUSTBENUM."";
                    echo "</div>";
                    CloseTable();
                    include_once(NUKE_BASE_DIR.'footer.php');
                    return;
                }
            }
        }
    }
    
// sinon, on insre les donnes dans les tables nuke_sommaire et nuke_sommaire_categories.
// d'abord, on va effacer les donnes de ces 2 tables !
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $titanium_cache->delete('sommaire_row', 'block');
    $titanium_cache->delete('sommaire_row2', 'block');
    $titanium_cache->delete('sommaire_row3', 'block');
    $titanium_cache->delete('sommaire_row4', 'block');
    $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/    
    $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_sommaire");
    $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_sommaire_categories");

//dtection de nuke v.7 : y a-t-il une gestion des groupes?
global $titanium_user_prefix;
$sql="SELECT * FROM ".$titanium_prefix."_modules LIMIT 1";
$result=$titanium_db->sql_query($sql);
$row=$titanium_db->sql_fetchrow($result);
// echo  mysqli_connect_error();
if(isset($row['mod_group'])){
    $sql2="SELECT * FROM ".$titanium_user_prefix."_users LIMIT 1";
    $result2=$titanium_db->sql_query($sql2);
    $row2=$titanium_db->sql_fetchrow($result2);
    // echo  mysqli_connect_error();
    $gestiongroupe=(isset($row2['points'])) ? 1 : 0 ;
}
else {
    $gestiongroupe=0;
}

//  chaque ligne du formulaire, on fait une requte pour insrer les donnes.
    for ($i=0; $i<=$sommaireformkeysommaire; $i++) {
        for ($j=0; $j<count($sommaireformingroup[$i]); $j++) {
            $zeclass = ($sommaireformfirstclass != $sommaireformclassformodules) ? $sommaireformclassformodules : $sommaireformmoduleclass[$i][$j] ;
            $zeclass = (empty($zeclass)) ? $sommaireformclassformodules : $zeclass ; //si la classe est vide, alors on remplit avec la classe par dfaut.
            $zenew_days = ($sommaireformfirstnew_days != $sommaireformnew_days) ? $sommaireformnew_days : $sommaireformmodulenew_days[$i][$j] ;//si on n'a pas chang le nb jours dans l'admin, on recopie les valeurs prcdentes.
            $zenew_days = (empty($zenew_days)) ? $sommaireformnew_days : $zenew_days ; //si le nb de jour est vide, alors on remplit avec le nb de jours par dfaut.
            if ($sommaireformingroup[$i][$j] =="Lien externe") { //si il y a un lien, on insre les donnes du lien
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $titanium_cache->delete('sommaire_row', 'block');
                $titanium_cache->delete('sommaire_row2', 'block');
                $titanium_cache->delete('sommaire_row3', 'block');
                $titanium_cache->delete('sommaire_row4', 'block');
                $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $sql="INSERT INTO ".$titanium_prefix."_sommaire_categories (groupmenu, module, url, url_text, image, new, new_days, class, bold) VALUES ('$sommaireformgroupmenu[$i]', '".$sommaireformingroup[$i][$j]."', '".$sommaireformmodulelink[$i][$j]."', '".$sommaireformmodulelinktext[$i][$j]."', '".$sommaireformmoduleimage[$i][$j]."', '".$sommaireformmodulenew[$i][$j]."', '".$zenew_days."', '".$zeclass."', '".$sommaireformmodulegras[$i][$j]."')";
                $titanium_db->sql_query($sql);
            }
            elseif ($sommaireformingroup[$i][$j] =="SOMMAIRE_HR") {
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $titanium_cache->delete('sommaire_row', 'block');
                $titanium_cache->delete('sommaire_row2', 'block');
                $titanium_cache->delete('sommaire_row3', 'block');
                $titanium_cache->delete('sommaire_row4', 'block');
                $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $sql="INSERT INTO ".$titanium_prefix."_sommaire_categories (groupmenu, module, url, url_text, image, new, new_days, class, bold) VALUES ('$sommaireformgroupmenu[$i]', '".$sommaireformingroup[$i][$j]."', '', '' , '', '".$sommaireformmodulenew[$i][$j]."', '".$zenew_days."',  '".$zeclass."', '".$sommaireformmodulegras[$i][$j]."')";
                $titanium_db->sql_query($sql);
            }
            else if ($sommaireformingroup[$i][$j] !="Aucun") { //sinon, (si il y a un module) on insre le nom du module, et pas de lien.
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $titanium_cache->delete('sommaire_row', 'block');
                $titanium_cache->delete('sommaire_row2', 'block');
                $titanium_cache->delete('sommaire_row3', 'block');
                $titanium_cache->delete('sommaire_row4', 'block');
                $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
                $sql="INSERT INTO ".$titanium_prefix."_sommaire_categories (groupmenu, module, url, url_text, image, new, new_days, class, bold) VALUES ('$sommaireformgroupmenu[$i]', '".$sommaireformingroup[$i][$j]."', '', '' , '".$sommaireformmoduleimage[$i][$j]."', '".$sommaireformmodulenew[$i][$j]."', '".$zenew_days."',  '".$zeclass."', '".$sommaireformmodulegras[$i][$j]."')";
                $titanium_db->sql_query($sql);
                //
            }
        // --> si 'Aucun' est slectionn dans les modules, on n'insre aucune donne !
        }

// si la catagorie ne contient aucune donne (compltement vide), alors on ne l'insre pas dans la DB.
        if ($sommaireformname[$i]=='' && $sommaireformimage[$i]=="noimg" && $sommaireformlien[$i]=='' && $sommaireformhr[$i]=='' && $sommaireformcenter[$i]=='' && $sommaireformbgcolor[$i]=='') {

        }
        else {
            $zeclass = ($sommaireformeachcategoryclass[0]!=$sommaireformclass) ? $sommaireformclass : $sommaireformeachcategoryclass[$i] ;// si la class a t change via l'admin, on indique cette classe pour toutes les catgories, sinon on recopie le nom de la classe utilise auparavant.
            $zeclass = (empty($zeclass)) ? $sommaireformclass : $zeclass ; //si la classe est vide, alors on remplit avec la classe par dfaut.
            if ($gestiongroupe==1 && $sommaireformradio==2) {
                $invisible=4;
            }
            elseif ($gestiongroupe==1 && $sommaireformradio==3) {
                $invisible=5;
            }
            else {
                $invisible=$sommaireformradio;
            }
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $titanium_cache->delete('sommaire_row', 'block');
            $titanium_cache->delete('sommaire_row2', 'block');
            $titanium_cache->delete('sommaire_row3', 'block');
            $titanium_cache->delete('sommaire_row4', 'block');
            $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $sql="INSERT INTO ".$titanium_prefix."_sommaire (groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, bold, new, listbox, dynamic) VALUES ('$sommaireformgroupmenu[$i]', '$sommaireformname[$i]', '$sommaireformimage[$i]', '$sommaireformlien[$i]', '$sommaireformhr[$i]', '$sommaireformcenter[$i]', '$sommaireformbgcolor[$i]', '$invisible', '$zeclass', '$sommaireformbold[$i]', '$sommaireformnew[$i]', '$sommaireformlistbox[$i]', '$sommaireformdynamic')";
            $titanium_db->sql_query($sql);
            // 
        } //end for 2
    }// end for 1 : toutes les catgories et leur contenu sont rentres dans la DB
// ensuite, on insre la catgorie 99.
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
            $titanium_cache->delete('sommaire_row', 'block');
            $titanium_cache->delete('sommaire_row2', 'block');
            $titanium_cache->delete('sommaire_row3', 'block');
            $titanium_cache->delete('sommaire_row4', 'block');
            $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
    $sql="INSERT INTO ".$titanium_prefix."_sommaire (groupmenu, name, image, lien, hr, center, bgcolor, invisible, class, bold, new, listbox, dynamic) VALUES ('$sommaireformgroupmenu[99]', NULL, NULL, NULL, NULL,NULL,NULL,NULL,NULL, NULL, NULL, NULL, NULL)";
    $titanium_db->sql_query($sql);
//    echo "<br />$sommaireformgroupmenu[99]&nbsp;";
    include_once(NUKE_BASE_DIR.'header.php'); 
    OpenTable();
    echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=sommaire\">" . _SOM_ADMIN_HEADER . "</a></div>\n";
    echo "<br /><br />";
    echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SOM_RETURNMAIN . "</a> ]</div>\n";
    CloseTable();
    echo "<br />";
    OpenTable();
    // 
    echo "<div align=\"center\">"._SOMSUCCESS."</div>";
    echo "<br /><br /><br /><div align=\"center\">[<a href=\"".$admin_file.".php?op=sommaire\">"._SOMBACKADMIN."</a>]</div>";
    CloseTable();
    include_once(NUKE_BASE_DIR.'footer.php'); 
}

function edit() {
global $keysommaire, $z, $titanium_modulename, $lienname, $lienlien, $image, $new_days, $categoryclass, $lienclass, $catname, $catimage, $bgcolor1, $bgcolor3, $bgcolor2, $bgcolor4, $zetheme, $sommaireeditposted, $somcategoryclass, $somlienclass, $somnew_days, $titanium_db, $titanium_prefix, $urlofimages;
global $admin_file;
    if ($sommaireeditposted!="ok") {
        if ($catimage<>"noimg" && !preg_match("#.swf#i",$catimage) && $som_center<>"on") {
            $catimagesize = getimagesize("".$urlofimages."/$catimage");//l on va rcuprer la largeur de l'image de la catgorie, pour aligner les modules avec le titre de la catgorie.
            if ($image<>"middot.gif") {
                $titanium_moduleimagesize = getimagesize("".$urlofimages."/categories/$image");
            }
            else {
                $titanium_moduleimagesize[0]=5;
            }
            $imagesize =$catimagesize[0]-$titanium_moduleimagesize[0];
            if ($imagesize<0) {
                $imagesize=0;
            }
        }
        else {
            $imagesize=0;
            $catimage="admin/null.gif";
        }
        $catname = str_replace("[SOMSYMBOLEet]","&",$catname);
        $lienname = str_replace("[SOMSYMBOLEet]","&",$lienname);
        $catname = str_replace("[SOMSYMBOLEinterro]","?",$catname);
        $lienname = str_replace("[SOMSYMBOLEinterro]","?",$lienname);
        include("themes/$zetheme/theme.php");
        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
        <html lang=\""._LANGCODE."\">
        <head><title>"._SOMEDITLINKTITLE."</title>
        <link rel=\"StyleSheet\" href=\"themes/$zetheme/style/style.css\" type=\"text/css\"></head>
        <body>
        <form action=\"".$admin_file.".php?op=sommaire&amp;go=edit\" method=\"post\">
        <input type=\"hidden\" name=\"sommaireeditposted\" value=\"ok\">
        <table cellspacing=2 cellpadding=3 align=\"center\">
        <tr class=\"title\"><td colspan=3 align=\"center\" >"._SOMMOREOPTIONS."</td></tr>
        <tr height=6><td></td></tr><tr>
        <td align=\"left\" bgcolor=\"$bgcolor3\"><img src=\"".$urlofimages."/$catimage\">&nbsp;$catname</td>
        <td align=\"left\" bgcolor=\"$bgcolor3\">"._SOMCLASS." : <input type=\"text\" name=\"somcategoryclass\" value=\"$categoryclass\" size=10></td>
        </tr><tr height=3><td></td></tr>
        <tr bgcolor=\"$bgcolor1\">";
        $displayimage= ($image=="middot.gif") ? "<strong>&middot;</strong>" : "<img src=\"".$urlofimages."/categories/$image\">";
        if ($titanium_modulename=="Lien externe") {
            echo "<td bgcolor=\"$bgcolor1\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\">".$displayimage."&nbsp;$lienname</td>";
        }
        elseif ($titanium_modulename=="SOMMAIRE_HR") {
            echo "<td bgcolor=\"$bgcolor1\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\"><hr></td>";
        }
        else {
            echo "<td bgcolor=\"$bgcolor1\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\">".$displayimage."&nbsp;$titanium_modulename</td>";
        }
        $disabled=($titanium_modulename=="SOMMAIRE_HR") ? "disabled" : "" ;
        echo "<td bgcolor=\"$bgcolor1\">"._SOMCLASS." : <input type=\"text\" name=\"somlienclass\" value=\"$lienclass\" size=10></td>
        <td>"._SOMSINCE." <input type=\"text\" name=\"somnew_days\" value=\"$new_days\" $disabled size=2> "._SOMNBDAYS."
        <input type=\"hidden\" name=\"keysommaire\" value=\"$keysommaire\"><input type=\"hidden\" name=\"z\" value=\"$z\">";
        
        echo "</td></tr><tr><td height=10></td></tr><tr><td align=\"center\" colspan=3><input type=\"submit\"></td></tr><tr><td height=15></td></tr>
        <tr><td colspan=3>"._SOMATTENTIONMOREOPTIONS."</td></tr></table></form>
        </body>
        </html>";
        
    }
    else{
    ?>
    <script language="Javascript">
    opener.document.forms.form_sommaire.elements["sommaireformmoduleclass[<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $keysommaire;?>][<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $z;?>]"].value="<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $somlienclass;?>";
    opener.document.forms.form_sommaire.elements["sommaireformmodulenew_days[<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $keysommaire;?>][<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $z;?>]"].value="<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $somnew_days;?>";
    opener.document.forms.form_sommaire.elements["sommaireformeachcategoryclass[<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $keysommaire;?>]"].value="<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/
 echo $somcategoryclass;?>";
    </script>
    <?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

        echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
        <html lang=\""._LANGCODE."\">
        <head><title>"._SOMEDITLINKTITLE."</title>
        <link rel=\"StyleSheet\" href=\"themes/$zetheme/style/style.css\" type=\"text/css\"></head>
        <body>";
        //echo "key:$keysommaire - z:$z - $somlienclass - $somnew_days - $somlienid - $somcategoryclass<br />";
        echo "<br /><br /><div align=\"center\"><span  class=\"title\">"._SOMMOREOPTIONSUCCESS."</span><br />"._SOMSENDTOVALIDATE."<br /><br /><br /><br /><br /><br /><div align=\"center\" class=\"title\">[<a href=\"javascript:window.close()\">"._SOMCLOSE."</a>]</div>";
        echo"</body></html>";
    }
}

function deletecat() { //pour supprimer une catgorie (fonction appele par le clic sur "supprimer" dans une ligne du formulaire)
global $admin_file, $more_js;
    global $deletecat, $keysommaire, $confirm, $catname, $titanium_db, $titanium_prefix, $titanium_cache;
    if ($confirm<>"YES") {
        include_once(NUKE_BASE_DIR.'header.php');
        OpenTable();
        echo "<div align=\"center\">\n<a href=\"$admin_file.php?op=sommaire\">" . _SOM_ADMIN_HEADER . "</a></div>\n";
        echo "<br /><br />";
        echo "<div align=\"center\">\n[ <a href=\"$admin_file.php\">" . _SOM_RETURNMAIN . "</a> ]</div>\n";
        CloseTable();
        echo "<br />";
        OpenTable();
        $catname=htmlspecialchars($catname);
        echo"<div align=\"center\">"._SOMWARNINGDELETECAT." <i>$catname</i> ?<br /><br />";
        echo"[ <a href=\"".$admin_file.".php?op=sommaire\">"._SOMNO."</a> | <a href=\"".$admin_file.".php?op=sommaire&amp;go=deletecat&amp;deletecat=$deletecat&amp;confirm=YES\">"._SOMYES."</a> ]"
        ."</div>";
        CloseTable();
        include_once(NUKE_BASE_DIR.'footer.php');
    }
    else {
        $confirm="NO";
/*****[BEGIN]******************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $titanium_cache->delete('sommaire_row', 'block');
        $titanium_cache->delete('sommaire_row2', 'block');
        $titanium_cache->delete('sommaire_row3', 'block');
        $titanium_cache->delete('sommaire_row4', 'block');
        $titanium_cache->delete('sommaire_tempo', 'block');
/*****[END]********************************************
 [ Base:    Caching System                     v3.0.0 ]
 ******************************************************/
        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_sommaire WHERE groupmenu='$deletecat'");
        $titanium_db->sql_query("DELETE FROM ".$titanium_prefix."_sommaire_categories WHERE groupmenu='$deletecat'");
        // 
        index();
    }
}

switch($go) {

default:
index();
break;

case "send":
send();
break;

case "deletecat":
deletecat();
break;

case "edit":
edit();
break;

}

} else {
    echo "Access Denied";
}

?>