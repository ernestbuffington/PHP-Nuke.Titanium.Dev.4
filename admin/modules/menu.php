<?php
/********************************************************/
/* Titanium Portal Menu  v3.01b - 01 November 2012      */
/* This file displays the administration console        */
/* to edit your Portal Menu                             */
/*                                                      */
/* Titanium Portal Menu                                 */
/* ernest.buffington@gmail.com                          */
/* ---------------------------------------------------- */
/* This program's license is General Public License     */
/* http://www.gnu.org/licenses/gpl.txt                  */
/********************************************************/
global $admin_file, $admin, $key, $deletecat, $db, $prefix, $sql, $upgrade_test, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolorhide, $ThemeSel;

if (!preg_match("/".$admin_file.".php/", $_SERVER['PHP_SELF'])){die ("You can't access this file directly...");}

$aid = trim($aid);

$result = $db->sql_query("select name, radminsuper from ".$prefix."_authors where aid='$aid'");

$row = $db->sql_fetchrow($result);

if ($row['radminsuper']!=1){die("You Are Not An Admin");}

$ThemeSel = get_theme();

$urlofimages = "images/menu";

if (file_exists(NUKE_ADMIN_DIR.'language/Menu/lang-'.$currentlang.'.php')) 
    include_once(NUKE_ADMIN_DIR.'language/Menu/lang-'.$currentlang.'.php');
else 
    include_once(NUKE_ADMIN_DIR.'language/Menu/lang-english.php');

$bgcolorhide='#c0c0c0';
$bgcolorhidefallback='#909090';

function menu_js_code() { # this php function will send all java script functions.
	global $urlofimages, $ThemeSel, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolorhide, $bgcolorhidefallback, $admin_file;
?>
<script language="Javascript">
function menuadminshowhide(zenom, numero) {
	if (numero==1) {
		document.getElementById(zenom).style.display='';
	}
	else if (numero==0) {
		document.getElementById(zenom).style.display='none';
	}
}
function menuchangecatimgnew(zeimage, keymenu, z) {
	var reg= new RegExp("<?php echo "$urlofimages";?>/admin/new.gif","gi");
	
	if (z=="") {
		var thiselement="menuformnew["+keymenu+"]";
	}
	else {
		var thiselement="menuformmodulenew["+keymenu+"]["+z+"]";
	}

	if (reg.test(zeimage.src)) {
		zeimage.src="<?php echo "$urlofimages";?>/admin/new_gray.gif";
		document.forms.form_menu.elements[thiselement].value="";
	}
	else {
		zeimage.src="<?php echo "$urlofimages";?>/admin/new.gif";
		document.forms.form_menu.elements[thiselement].value="on";
	}
}

function disab (cetobjet,valeur,formlink,formlinktext,linkvaleur,linktextvaleur) {
	if (valeur=='SEP') {
		cetobjet.selectedIndex=0;
	}
	if (valeur=='External Link') {

		if (linkvaleur=='') {
			formlink.value="http://";
			formlinktext.value="";
		}
		else {
			formlink.value=linkvaleur;
			formlinktext.value=linktextvaleur;
		}
		formlink.disabled=false;
		formlinktext.disabled=false;
		formlink.style.visibility='visible';
		formlinktext.style.visibility='visible';
	}
	else if(valeur=='MENUTEXTONLY') {
		formlink.value="";
		formlink.disabled=true;
		formlinktext.disabled=false;
		formlink.style.visibility='hidden';
		formlinktext.style.visibility='visible';
	}
	else {
		formlink.value="";
		formlink.style.visibility='hidden';
		formlink.disabled=true;
		formlinktext.value="";
		formlinktext.style.visibility='hidden';
		formlinktext.disabled=true;
	}
}

function targetblank(keymenu,valeur) {
	testehttp = valeur.slice(0,7 );
	testehttps = valeur.slice(0,8 );
	testeftp = valeur.slice(0,6);
	http='http://';
	https='https://';
	ftp='ftp://';
	if (valeur=="") {
		document.images["targetblank"+keymenu].style.display="none";
		document.images["targetnone"+keymenu].style.display="none";
	}
	else if(testehttp == http || testeftp == ftp || testehttps==https) {
		document.images["targetblank"+keymenu].style.display="inline";
		document.images["targetnone"+keymenu].style.display="none";
	}
	else {
		document.images["targetblank"+keymenu].style.display="none";
		document.images["targetnone"+keymenu].style.display="inline";
	}
}

function check_numeric (my_element, old_value) {
	var text_value = my_element.value;
	if (text_value.length >0) {
		if (isNaN(text_value)) {
			alert ("<?php echo ""._MENU_MSGNOTNUM."";?>");
			my_element.value = old_value;
		}
	}
	else {
		alert ("<?php echo ""._MENU_MSGVOID.""?>");
		my_element.value = old_value;
	}
}

function senddit(keymenu, z, type) {
	var reg= new RegExp("[&]","gi");
	var seg= new RegExp("[\?]","gi");
	if (z!='imacategory') {
		var modulename = document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"].value;
		var lienname = document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+z+"]"].value;
		lienname = lienname.replace(reg,"[SOMSYMBOLEet]");
		lienname = lienname.replace(seg,"[SOMSYMBOLEinterro]");
		var image = document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].value;
		var lienclass = document.forms.form_menu.elements["menuformmoduleclass["+keymenu+"]["+z+"]"].value;
		var new_days = document.forms.form_menu.elements["menuformmodulenew_days["+keymenu+"]["+z+"]"].value;
		// pour schedule
		//var date_debut = document.forms.form_menu.elements["menu_schedule_date_debut["+keymenu+"]["+z+"]"].value;
		//var date_fin = document.forms.form_menu.elements["menu_schedule_date_fin["+keymenu+"]["+z+"]"].value;
		//var days = document.forms.form_menu.elements["menu_schedule_days["+keymenu+"]["+z+"]"].value;
	}
	else {
		//var date_debut = document.forms.form_menu.elements["menu_schedule_date_debut_cat["+keymenu+"]"].value;
		//var date_fin = document.forms.form_menu.elements["menu_schedule_date_fin_cat["+keymenu+"]"].value;
		//var days = document.forms.form_menu.elements["menu_schedule_days_cat["+keymenu+"]"].value;
	}
	var catname = document.forms.form_menu.elements["menuformname["+keymenu+"]"].value;
	catname = catname.replace(reg,"[SOMSYMBOLEet]");
	catname = catname.replace(seg,"[SOMSYMBOLEinterro]");
	var catimage = document.forms.form_menu.elements["menuformimage["+keymenu+"]"].value;
	var categoryclass = document.forms.form_menu.elements["menuformeachcategoryclass["+keymenu+"]"].value;
	var dynamic = document.forms.form_menu.elements["menuformdynamic["+keymenu+"]"].value;
	var zeurl="<?php echo $admin_file;?>"+".php?op=menu&go="+type+"&modulename="+modulename+"&lienname="+lienname+"&image="+image+"&catname="+catname+"&catimage="+catimage+"&categoryclass="+categoryclass+"&lienclass="+lienclass+"&new_days="+new_days+"&keymenu="+keymenu+"&z="+z+"&date_debut="+date_debut+"&date_fin="+date_fin+"&days="+days+"&dynamic="+dynamic;
	window.open(zeurl,'menu_'+type+'link','location=no, width=600, height=250, menubar=no, status=no, scrollbars=auto, menubar=no');
	//alert(zeurl);
}

function changeimage(zeimage,valeur) {
	var url="<?php echo $urlofimages; ?>/";
	if (valeur=="noimg") {
		valeur="admin/noimg.gif";
	}
	document.images[zeimage].src=url+valeur;
}

function changeimage_cat(zeimage,valeur) {
	var url="<?php echo $urlofimages; ?>/";
	if (valeur=="middot.gif") {
		valeur="admin/middot.gif";
	}
	else {
		valeur="categories/"+valeur;
	}
	document.images[zeimage].src=url+valeur;
}

function menu_manage_sublevels(keymenu, z, sens) {
	var url="<?php echo $urlofimages; ?>";
	if (sens=='left') {
		if (document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value!=0) {
			document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value=parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)-1;
			document.images["sublevelspacer1["+keymenu+"]["+z+"]"].width=document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value*15;
		}
		if (document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value==0) {
			document.images["imageleft["+keymenu+"]["+z+"]"].style.display="none";
		}
		document.images["imageright["+keymenu+"]["+z+"]"].style.display="inline";
		var nextz=parseInt(z)+1;
		if (parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)+1<parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+nextz+"]"].value)) {
			menu_manage_sublevels(keymenu,nextz,'left');
			document.images["imageright["+keymenu+"]["+nextz+"]"].style.display="none";
		}
		else if (parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)==parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+nextz+"]"].value)) {
			document.images["imageright["+keymenu+"]["+nextz+"]"].style.display="inline";
		}
		else if (parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)<parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+nextz+"]"].value)) {
			document.images["imageright["+keymenu+"]["+nextz+"]"].style.display="none";
		}
	}
	else {
		var previousz=parseInt(z)-1;
		// Si le sublevel est déjà supérieur au sublevel d'au-dessus, on ne fait rien !
		if (parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)<=parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+previousz+"]"].value)) {
			document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value=parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)+1;
			document.images["sublevelspacer1["+keymenu+"]["+z+"]"].width=document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value*15;
			if (document.images["imageleft["+keymenu+"]["+z+"]"].style.display=="none") {
				document.images["imageleft["+keymenu+"]["+z+"]"].style.display="inline"
			}
			if (parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)>parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+previousz+"]"].value)) {
				document.images["imageright["+keymenu+"]["+z+"]"].style.display="none"
			}
			var nextz=parseInt(z)+1;
			if (parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+z+"]"].value)>=parseInt(document.forms.form_menu.elements["sublevel["+keymenu+"]["+nextz+"]"].value)) {
				document.images["imageright["+keymenu+"]["+nextz+"]"].style.display="inline"
			}
		}
	}
}

var oldschool;
function menu_move_updown(keymenu,z,lastz,sens) {
	if ((z==0 && sens=='up') || (z==lastz && sens=='down')) {
		alert("You shouldn't see this. no action taken.");
	}
	else {

		if (sens=='up') {
			var otherz=parseInt(z)-1;
		}
		else {
			var otherz=parseInt(z)+1;
		}
		var old_menuformingroup = document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"].selectedIndex;//select
		var old_menuformmodulelink = document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+z+"]"].value;//input
		var old_menuformmodulelinktext = document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+z+"]"].value;//input
		if (oldschool==1) {
			var old_menuformmoduleimage = document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].selectedIndex;//select
		}
		else {
			var old_menuformmoduleimage = document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].value;//hidden
		}
		var old_menuformmodulegras = document.forms.form_menu.elements["menuformmodulegras["+keymenu+"]["+z+"]"].checked;//checkbox
		var old_menuformmodulenew = document.forms.form_menu.elements["menuformmodulenew["+keymenu+"]["+z+"]"].value;//hidden
		var old_menuformmoduleclass = document.forms.form_menu.elements["menuformmoduleclass["+keymenu+"]["+z+"]"].value;//hidden
		var old_menuformmodulenew_days = document.forms.form_menu.elements["menuformmodulenew_days["+keymenu+"]["+z+"]"].value;//hidden
		//var old_menu_schedule_date_debut = document.forms.form_menu.elements["menu_schedule_date_debut["+keymenu+"]["+z+"]"].value; //hidden
		//var old_menu_schedule_date_fin = document.forms.form_menu.elements["menu_schedule_date_fin["+keymenu+"]["+z+"]"].value; //hidden
		//var old_menu_schedule_days = document.forms.form_menu.elements["menu_schedule_days["+keymenu+"]["+z+"]"].value; //hidden

		document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"].focus(); 
		document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"].selectedIndex=document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"].selectedIndex;
		document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+otherz+"]"].value;
		document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+otherz+"]"].value;
		
		if (oldschool==1) {
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].focus();
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].selectedIndex=document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].selectedIndex;
		}
		else {
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].value;
		}
		document.forms.form_menu.elements["menuformmodulegras["+keymenu+"]["+z+"]"].checked=document.forms.form_menu.elements["menuformmodulegras["+keymenu+"]["+otherz+"]"].checked;
		document.forms.form_menu.elements["menuformmodulenew["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menuformmodulenew["+keymenu+"]["+otherz+"]"].value;
		document.forms.form_menu.elements["menuformmoduleclass["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menuformmoduleclass["+keymenu+"]["+otherz+"]"].value;
		document.forms.form_menu.elements["menuformmodulenew_days["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menuformmodulenew_days["+keymenu+"]["+otherz+"]"].value;
		//document.forms.form_menu.elements["menu_schedule_date_debut["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menu_schedule_date_debut["+keymenu+"]["+otherz+"]"].value;
		//document.forms.form_menu.elements["menu_schedule_date_fin["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menu_schedule_date_fin["+keymenu+"]["+otherz+"]"].value;
		//document.forms.form_menu.elements["menu_schedule_days["+keymenu+"]["+z+"]"].value=document.forms.form_menu.elements["menu_schedule_days["+keymenu+"]["+otherz+"]"].value;

		document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"].focus();
		document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"].selectedIndex=old_menuformingroup;
		document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+otherz+"]"].value=old_menuformmodulelink;
		document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+otherz+"]"].value=old_menuformmodulelinktext;
		if (oldschool==1) {
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].focus();
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].selectedIndex=old_menuformmoduleimage;
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].blur();
		}
		else {
			document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].value=old_menuformmoduleimage;
			document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"].blur();
		}
		document.forms.form_menu.elements["menuformmodulegras["+keymenu+"]["+otherz+"]"].checked=old_menuformmodulegras;
		document.forms.form_menu.elements["menuformmodulenew["+keymenu+"]["+otherz+"]"].value=old_menuformmodulenew;
		document.forms.form_menu.elements["menuformmoduleclass["+keymenu+"]["+otherz+"]"].value=old_menuformmoduleclass;
		//document.forms.form_menu.elements["menu_schedule_date_debut["+keymenu+"]["+otherz+"]"].value=old_menu_schedule_date_debut;
		//document.forms.form_menu.elements["menu_schedule_date_fin["+keymenu+"]["+otherz+"]"].value=old_menu_schedule_date_fin;
		//document.forms.form_menu.elements["menu_schedule_days["+keymenu+"]["+otherz+"]"].value=old_menu_schedule_days;

		if (document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"].selectedIndex==2 || document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"].selectedIndex==2) {
			disab(document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"],document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+otherz+"]"].value,document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+otherz+"]"],document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+otherz+"]"],document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+otherz+"]"].value,document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+otherz+"]"].value);
			disab(document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"],document.forms.form_menu.elements["menuformingroup["+keymenu+"]["+z+"]"].value,document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+z+"]"],document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+z+"]"],document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+z+"]"].value,document.forms.form_menu.elements["menuformmodulelinktext["+keymenu+"]["+z+"]"].value);
			targetblank(keymenu+'_'+z,document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+z+"]"].value);
			targetblank(keymenu+'_'+otherz,document.forms.form_menu.elements["menuformmodulelink["+keymenu+"]["+otherz+"]"].value);
		}
		changeimage_cat('image'+keymenu+'_'+z,document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+z+"]"].value);
		changeimage_cat('image'+keymenu+'_'+otherz,document.forms.form_menu.elements["menuformmoduleimage["+keymenu+"]["+otherz+"]"].value);

		if (document.forms.form_menu.elements["menuformmodulenew["+keymenu+"]["+otherz+"]"].value=="on") {
			document.images['somnew'+keymenu+'_'+otherz].src="<?php echo "$urlofimages";?>/admin/new.gif";
		}
		else {
			document.images['somnew'+keymenu+'_'+otherz].src="<?php echo "$urlofimages";?>/admin/new_gray.gif";
		}
		if (document.forms.form_menu.elements["menuformmodulenew["+keymenu+"]["+z+"]"].value=="on") {
			document.images['somnew'+keymenu+'_'+z].src="<?php echo "$urlofimages";?>/admin/new.gif";
		}
		else {
			document.images['somnew'+keymenu+'_'+z].src="<?php echo "$urlofimages";?>/admin/new_gray.gif";
		}
		
		if (document.getElementById('spana'+keymenu+'_'+z).className!=document.getElementById('spana'+keymenu+'_'+otherz).className) {
			if (document.getElementById('spana'+keymenu+'_'+z).className=='menu_hidden') {
				menu_hidelink(keymenu,z,'show',this.document);
				menu_hidelink(keymenu,otherz,'hide',this.document);
			}
			else if (document.getElementById('spana'+keymenu+'_'+otherz).className=='menu_hidden') {
				menu_hidelink(keymenu,z,'hide',this.document);
				menu_hidelink(keymenu,otherz,'show',this.document);
			}
		}
	}
}



function findPosX(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
	curleft += obj.x;
	return curleft;
}

function findPosY(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
	curtop += obj.y;
	return curtop;
}

var keymenu_image;
var zimage;

function menu_displayimagelist(zeimage,zediv_id) {
	var obj=document.getElementById(zediv_id);
	var div_padding=parseInt(obj.style.padding);
	obj.style.top=(findPosY( zeimage ) - div_padding + zeimage.height + 1) + 'px';
	obj.style.left=(findPosX( zeimage ) - div_padding + zeimage.width + 1) + 'px';
	obj.style.display='block';
	fSwapSelect(zediv_id); 
}

function menu_changeimageform(image_name) {
	var url="<?php echo $urlofimages; ?>";
	document.forms.form_menu.elements["menuformimage["+keymenu_image+"]"].value=image_name;
	if (image_name=='noimg') {
		image_name='admin/noimg.gif';
	}
	document.images["catimage"+keymenu_image].src=url+'/'+image_name;
	keymenu_image=0;
}

function menu_changeimageform_cat(image_name) {
	var url="<?php echo $urlofimages; ?>/categories/";
	document.forms.form_menu.elements["menuformmoduleimage["+keymenu_image+"]["+zimage+"]"].value=image_name;
	if (image_name=='middot.gif') {
		image_name="<?php echo $urlofimages; ?>/admin/middot.gif";
	}
	else {
		image_name=url+'/'+image_name;
	}
	document.images["image"+keymenu_image+"_"+zimage].src=image_name;
	keymenu_image=0;
	zimage=0;
}

// fix for IE : hide the <select> box under the image list because it overlaps the <div>  
// (sidenote at 4.00 am : yes, Internet Explorer IS evil. definetely. I'm so sick of finding workarounds for this crap.)
// Thanks ASP-PHP.net !! great script !
function fSwapSelect( sId ) {
	oObj = document.getElementById(sId); 
	
	var agt=navigator.userAgent.toLowerCase();
	//real browsers. they don't need this hack, so we don't need to use CPU more than necessary ;-)
	if (agt.indexOf('opera')!=-1 || agt.indexOf('firefox')!=-1 || agt.indexOf('konqueror')!=-1) { 
		document.getElementById(sId+'_table').title="";
		return;
	}

	Top_Element  = findPosY(oObj);
	Left_Element  = findPosX(oObj);
	Largeur_Element  = oObj.offsetWidth;
	Hauteur_Element  = oObj.offsetHeight;
	oSelects = document.getElementsByTagName('SELECT');
	if (oSelects.length > 0) {
		for (i = 0; i < oSelects.length; i++) {
			oSlt = oSelects[i];
			Top_Select = findPosY(oSlt);
			Left_Select = findPosX(oSlt);
			Largeur_Select = oSlt.offsetWidth;
			Hauteur_Select = oSlt.offsetHeight;
			isLeft = false;
			if ((Left_Element > (Left_Select - Largeur_Element)) && (Left_Element < (Left_Select + Largeur_Select))) {
				isLeft = true;
			}
			isTop = false;
			if ((Top_Element > (Top_Select - Hauteur_Element)) && (Top_Element < (Top_Select + Hauteur_Select))) {
				isTop = true;
			}
			if (isLeft && isTop) {
				sVis = (oObj.style.visibility == 'hidden') ? 'visible' : 'hidden';
				if (oSlt.style.visibility != sVis) {oSlt.style.visibility = sVis;}
			} else {
				if (oSlt.style.visibility != 'visible') {oSlt.style.visibility = 'visible';}
			}
		}
	}
}

var clicked=0;
var s=0;

function hideallimagelists() {
	if(!s) return;
	if(clicked==1) {
	document.getElementById('menu_imagelist').style.display='none';
	fSwapSelect('menu_imagelist');
	document.getElementById('menu_imagelist_cat').style.display='none';
	fSwapSelect('menu_imagelist_cat');
	clicked=0;
	s=0;
	}
	else {
	clicked++;	
	}
}

document.onclick=hideallimagelists;

window.onload=menu_onload;
function menu_onload() {
	zediv=document.getElementById('imagelist_wrapper');
	zediv2=document.getElementById('imagelist_wrapper_cat');
	if (window.addEventListener) { // decent browsers
		zediv.addEventListener('mouseout',hidediv,false);
		zediv2.addEventListener('mouseout',hidediv,false);
	}
	else if (window.attachEvent) { // IE proprietary functions
		zediv.attachEvent('onmouseout', hidediv_ie);
		zediv2.attachEvent('onmouseout', hidediv2_ie);
	}
	else {
		alert('Your browser does not support DOM addEventListener or IE\'s proprietary attachEvent.\nImpossible to detect onmouseout for the DIV element.\nPlease let me know if this happens : marcoledingue at.a@t.at free.fr');
	}
}

function hidediv_ie(event) {
	if ( event.toElement == zediv.parentNode ) {
		document.getElementById('menu_imagelist').style.display='none';
		fSwapSelect('menu_imagelist');
		document.getElementById('menu_imagelist_cat').style.display='none';
		fSwapSelect('menu_imagelist_cat');
	}
	else {
		event.returnValue=false;
	}
}

function hidediv2_ie(event) {
	if ( event.toElement == zediv2.parentNode ) {
		document.getElementById('menu_imagelist').style.display='none';
		fSwapSelect('menu_imagelist');
		document.getElementById('menu_imagelist_cat').style.display='none';
		fSwapSelect('menu_imagelist_cat');
	}
	else {
		event.returnValue=false;
	}
}

function hidediv(e) {
	if ( e.eventPhase == 2 && (e.relatedTarget == e.currentTarget.parentNode || e.relatedTarget == document.body || e.relatedTarget == document.documentElement) ) {
		document.getElementById('menu_imagelist').style.display='none';
		fSwapSelect('menu_imagelist'); 
		document.getElementById('menu_imagelist_cat').style.display='none';
		fSwapSelect('menu_imagelist_cat');
	}
	else {
		e.preventDefault();
	}
}

function menu_hidecategory(keymenu,sens,zedoc) {
	if (sens=='hide') {
		zedoc.getElementById('showhide_weight_'+keymenu).className='menu_hidden';
		zedoc.getElementById('showhide_cat_'+keymenu).className='menu_hidden';
		zedoc.getElementById('showhide_suppr_'+keymenu).className='menu_hidden';
		zedoc.getElementById('showhide_content_'+keymenu).style.display='none';
	}
	else {
		zedoc.getElementById('showhide_weight_'+keymenu).className='menu_showed';
		zedoc.getElementById('showhide_cat_'+keymenu).className='menu_showed';
		zedoc.getElementById('showhide_suppr_'+keymenu).className='menu_showed';
		zedoc.getElementById('showhide_content_'+keymenu).style.display='';
	}
}

function menu_hidelink(keymenu,z,sens,zedoc) {
	if (sens=='hide') {
		zedoc.getElementById('spana'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spanb'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spanc'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spand'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spane'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spanf'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spang'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spanh'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spani'+keymenu+'_'+z).className='menu_hidden';
		zedoc.getElementById('spanj'+keymenu+'_'+z).className='menu_hidden';		
	}
	else {
		zedoc.getElementById('spana'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spanb'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spanc'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spand'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spane'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spanf'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spang'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spanh'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spani'+keymenu+'_'+z).className='menu_showed';
		zedoc.getElementById('spanj'+keymenu+'_'+z).className='menu_showed';
	}
}

</script>
<?php

} 
//end of js code.
$ThemeSel=get_theme();

function index() 
{
	       global $admin_file, 
		                  $db, 
						 $sql, 
				      $prefix, 
					$bgcolor1, 
					$bgcolor2, 
					$bgcolor3, 
					$bgcolor4, 
				 $bgcolorhide, 
		 $bgcolorhidefallback, 
		          $textcolor1, 
				         $key, 
				   $deletecat, 
				$upgrade_test, 
				 $urlofimages;
	
	include_once("header.php");
	
	if ($bgcolor2 == 'silver' || $bgcolor2 == '#c0c0c0' || $bgcolor3 == 'silver' || $bgcolor3=='#c0c0c0') {
		$bgcolorhide=$bgcolorhidefallback;
	}
		
	menu_js_code();
	
	$handle=opendir("$urlofimages");

	$menu_counter=0;

	$old_school_imagedropdown=0;

	while ($tempo = readdir($handle)) 
	{
		$file[$menu_counter]= $tempo;
	
		if (preg_match("/\.swf$/",$file[$menu_counter])) 
		{
			$old_school_imagedropdown=1;
		}
		
		$menu_counter++;
	}
	
	closedir($handle);

if ($old_school_imagedropdown == 0) 
{
  echo "<div id=\"menu_imagelist\" style=\"display: none; z-index:2; position: absolute; padding: 15px;\">";
  echo "<div id=\"imagelist_wrapper\" style=\"z-index:3; background-color: ".$bgcolor3."; border: 1px solid black;\">";
		
  
  echo "<table width=\"100%\" cellpadding=2 title=\""._MENU_JSFIXFORIE1."\" style=\"background-color: ".$bgcolor3.";\" id=\"menu_imagelist_table\">";
  
  $imgcounter = 1;
  
  echo "<tr><td><a href=\"javascript:menu_changeimageform('noimg');\"><img src=\"".$urlofimages."/admin/noimg.gif\" onmouseover=\"this.style.outline='1px outset "
  .$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
  
  for ($i=0;$i<count($file);$i++) 
  {
	if ($file[$i] != "." && $file[$i] != ".." && $file[$i] != "categories" && $file[$i] != "admin") 
	{
	  if ($imgcounter >= 4) 
	  {
		$imgcounter = 0;
		echo "</tr><tr>";
	  }
		
        echo "<td><a href=\"javascript:menu_changeimageform('".$file[$i]."');\"><img src=\"".$urlofimages."/".$file[$i]."\" onmouseover=\"this.style.outline='1px outset "
		.$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
      
	  $imgcounter++;
  }
}
	echo "</tr></table>";
	echo "</div>";
	echo "</div>";
}

	$handle = opendir("$urlofimages/categories");
	
	$menu_counter = 0;
	
	$old_school_imagedropdown_cat = 0;
	
	while ($tempo = readdir($handle)) 
	{
		$file2[$menu_counter] = $tempo;
	
		if (preg_match("/\.swf$/",$file2[$menu_counter])) 
		{
			$old_school_imagedropdown_cat=1;
		}
		
		$menu_counter++;
	}
	
	closedir($handle);
	
	sort($file2,SORT_STRING);
	
	if ($old_school_imagedropdown_cat == 0) 
	{
		echo "<script>oldschool=0;</script>"; 
		echo "<div id=\"menu_imagelist_cat\" style=\"display: none; z-index:2; position: absolute; padding: 15px;\">";
		echo "<div id=\"imagelist_wrapper_cat\" style=\"z-index:3; background-color: ".$bgcolor3."; border: 1px solid black;\">";
		
		echo "<table cellpadding=2 style=\"background-color: ".$bgcolor3.";\" title=\""._MENU_JSFIXFORIE1."\" id=\"menu_imagelist_cat_table\">";
		
		$imgcounter = 1;
		
		echo "<tr><td><a href=\"javascript:menu_changeimageform_cat('middot.gif');\"><img src=\"".$urlofimages."/admin/middot.gif\" onmouseover=\"this.style.outline='1px outset "
		.$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
	
		for ($i=0;$i < count($file2);$i++) 
		{
			if ($file2[$i] != "." && $file2[$i] != "..") 
			{
				if ($imgcounter >= 4) {
					$imgcounter = 0;
					echo "</tr><tr>";
				}
			
				echo "<td><a href=\"javascript:menu_changeimageform_cat('".$file2[$i]."');\"><img src=\"".$urlofimages."/categories/".$file2[$i]."\" onmouseover=\"this.style.outline='1px outset "
				.$bgcolor2."'\" onmouseout=\"this.style.outline='none'\"></a></td>";
				$imgcounter++;
			}
		}
		
		echo "</tr></table>";
		echo "</div>";
		echo "</div>";
	}
	else 
	{
		echo "<script>oldschool=1;</script>";
	}
	
	$sql = "SELECT title FROM ".$prefix."_modules ORDER BY title ASC";
	
	$modules_attach = $db->sql_query($sql);
	
	$menu_counter = 0;
	
	while ($tempo = $db->sql_fetchrow($modules_attach)): 
		$modules[$menu_counter] = $tempo['title'];
		$menu_counter++;
	endwhile;

	$sql2 = "SELECT * FROM ".$prefix."_menu_categories ORDER BY id ASC";
	
	$result2 = $db->sql_query($sql2);

	$menu_counter = 0;
	
	$row2 = $db->sql_fetchrow($result2); 
	
	$categorie = $row2['groupmenu'];
	
	$moduleinthisgroup[$categorie][$menu_counter] = (stripslashes($row2['module'])); 
	
	$linkinthisgroup[$categorie][$menu_counter] = (stripslashes($row2['url'])); 
	 
	$linktextinthisgroup[$categorie][$menu_counter] = (stripslashes($row2['url_text'])); 
	
	$imageinthisgroup[$categorie][$menu_counter] = $row2['image'];
	
	$newinthisgroup[$categorie][$menu_counter] = $row2['new'];
	
	$new_days=$new_daysinthisgroup[$categorie][$menu_counter] = $row2['new_days'];
	
	$firstclass=$classofthismodule[$categorie][$menu_counter] = $row2['class'];
	
	$grasofthismodule[$categorie][$menu_counter] = $row2['bold'];
	
	$sublevel[$categorie][$menu_counter] = $row2['sublevel'];
	
	$idofthismodule[$categorie][$menu_counter] = $row2['id'];
	
	//$date_debut_link[$categorie][$menu_counter] = $row2['date_debut'];
	
	//$date_fin_link[$categorie][$menu_counter] = $row2['date_fin'];
	
	$days_link[$categorie][$menu_counter] = $row2['days'];

	$menu_counter2=$categorie;

	while ($row2 = $db->sql_fetchrow($result2)) 
	{ 
	  $categorie = $row2['groupmenu'];
	  
	  if ($menu_counter2 == $categorie) 
	  { 
	     $menu_counter++;
	  }
	  else 
	  {
		$menu_counter = 0;
	  }

	 $moduleinthisgroup[$categorie][$menu_counter] = (stripslashes($row2['module']));
	 
	 $linkinthisgroup[$categorie][$menu_counter] = (stripslashes($row2['url'])); 
	 
	 $linktextinthisgroup[$categorie][$menu_counter] = (stripslashes($row2['url_text'])); 
	 
	 $imageinthisgroup[$categorie][$menu_counter] = $row2['image'];
	 
	 $newinthisgroup[$categorie][$menu_counter] = $row2['new'];
	 
	 $new_daysinthisgroup[$categorie][$menu_counter] = $row2['new_days'];
	 
	 $classofthismodule[$categorie][$menu_counter] = $row2['class'];
	 
	 $grasofthismodule[$categorie][$menu_counter] = $row2['bold'];
	 
	 $sublevel[$categorie][$menu_counter] = $row2['sublevel'];
	 
	 $idofthismodule[$categorie][$menu_counter] = $row2['id'];
	 
	 //$date_debut_link[$categorie][$menu_counter] = $row2['date_debut'];
	 
	 //$date_fin_link[$categorie][$menu_counter] = $row2['date_fin'];
	 
	 $days_link[$categorie][$menu_counter] = $row2['days'];
	 
	 $menu_counter2 = $categorie;

	}

    global $title; 
    
	$title = 'Menu Block Admin'; 
    
	OpenTable(); 
	
	echo "<style type=\"text/css\">"
	.".texte 	{ COLOR: $textcolor1; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica}"
	.".red {COLOR: #FF0000; FONT-SIZE: 10px; FONT-FAMILY: Verdana, Helvetica; FONT-WEIGHT: bold}"
	
	."INPUT {BORDER-TOP-COLOR: #000000;" 
	."BORDER-LEFT-COLOR: #000000;" 
	."BORDER-RIGHT-COLOR: #000000;" 
	."BORDER-BOTTOM-COLOR: #000000;" 
	."BORDER-TOP-WIDTH: 1px;" 
	."BORDER-LEFT-WIDTH: 1px;" 
	."FONT-SIZE: 10px;" 
	."BORDER-BOTTOM-WIDTH: 1px;" 
	."FONT-FAMILY: Verdana,Helvetica; BORDER-RIGHT-WIDTH: 1px}"
	
	.".disabled { background-color: $bgcolor1; border-style: none}"
	."IMG {border: 0;}"
	.".menu_hidden {background-image: url(".$urlofimages."/admin/hidden_background.gif); background-repeat: repeat;}"
	.".menu_showed {background-image: '';}"
	."</style>";

	# nuke_menu
	$sql = "SELECT * FROM ".$prefix."_menu ORDER BY groupmenu ASC";
	
	$result = $db->sql_query($sql);
	
	if (!$result) {die("<div class=\"red\" align=\"center\" style=\"font-size:16px\"><strong><br>"._MENU_NOTABLEPB."<br></strong></div>");}

    global $admin_file;
	
	echo"<div align=\"center\">[<a href=\"$admin_file.php\"> Back To Main Admin Area</a>]</div>";

	
	echo "<form action=\"".$admin_file.".php?op=menu&amp;go=send\" method=\"post\" name=\"form_menu\">"
	    ."<table width=\"100%\" align=\"center\"><tr><td colspan=\"2\">"
	    ."<table width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=$bgcolor1><tr><td bgcolor=\"#000000\">"
	    ."<table width=\"100%\" align=\"center\" cellspacing=\"1\" cellpadding=\"4\"  bordercolor=\"$bgcolor1\">"
	    ."<tr align=\"center\"><td bgcolor=\"$bgcolor2\"><strong>"._MENU_WEIGHT."</strong></td>"
		."<td bgcolor=\"$bgcolor2\" ><strong>"._MENU_CATEGORIES."</strong></td><td bgcolor=\"$bgcolor2\" ><strong>"._MENU_ACTION."</strong></td></tr>";

	$now = time();
	$key = 0;

	if (!$result) 
	{
	   echo "<tr><td colspan=4>"._MENU_NOTABLEPB."</td></tr>";
	}
	
	while ($row = $db->sql_fetchrow($result)) 
	{  
	   $groupmenu[$key] = $row['groupmenu'];
	   
	   $catname[$key] = $row['name'];
	   
	   $image[$key] = $row['image'];
	   
	   $lien[$key] = $row['lien'];
	   
	   $hr[$key] = $row['hr'];
	   
	   //$center[$key] = $row['center'];
	   
	   $categoriebgcolor[$key] = $row['bgcolor'];
	   
	   $invisible[$key] = $row['invisible'];
	   
	   $categoryclass[$key] = $row['class'];
	   
	   $new[$key] = $row['new'];
	   
	   $bold[$key] = $row['bold'];
	   
	   //$listbox[$key] = $row['listbox'];
	   
	   //$dynamic[$key] = $row['dynamic'];
	   
	   //$date_debut_cat[$key] = $row['date_debut'];
	   
	   //$date_fin_cat[$key] = $row['date_fin'];
	   
	   $days_cat[$key] = $row['days'];	

	if ($groupmenu[$key] == 99) 
	{ 
	   echo "<tr align=\"center\"><td bgcolor=\"$bgcolor1\" colspan=3><strong><br>"._MENU_NEWCATEGORY."<br><br></strong></td></tr>";
	   
	   //$checkshowadmin = ($catname[$key] == 'menunoadmindisplay') ? "" : "checked"; 
	   
	   $catname[$key] = $row['name'] = ""; 
	   
	   $key99 = $groupmenu[$key];
	   
	   $key99 = $key;
	   
	   $keyadd = $groupmenu[$key-1]; 
	   
	   $keyadd = $keyadd+1;
	   
	   $groupmenu[$key] = $keyadd;
	}
	
	//if (strpos($days_cat[$key],'8')!== false || $now < $date_debut_cat[$key] || ($date_fin_cat[$key] > 0 && $now > $date_fin_cat[$key])) 
	//{
	//	$catclass = " class=\"menu_hidden\"";
	//	$display_cat = " style=\"display: none;\"";
	//}
	//else 
	//{
		$catclass = "";
		$display_cat = "";
	//}

	
	echo "<tr align=\"center\">"
	    ."<td bgcolor=\"$bgcolor2\"".$catclass." rowspan=\"2\" id=\"showhide_weight_$key\"><center>"
	    ."<input type=\"text\" class=\"select\" name=\"menuformgroupmenu[$key]\" size=\"3\" maxlength=2 value=\"$groupmenu[$key]\" onchange='check_numeric(this,$groupmenu[$key])'></center><br>";
	
	//echo "<input type=\"hidden\" name=\"menu_schedule_date_debut_cat[".$key."]\" value=\"".$date_debut_cat[$key]."\">";
	
	//echo "<input type=\"hidden\" name=\"menu_schedule_date_fin_cat[".$key."]\" value=\"".$date_fin_cat[$key]."\">";
	
	//echo "<input type=\"hidden\" name=\"menu_schedule_days_cat[".$key."]\" value=\"".$days_cat[$key]."\">";
	
	
	echo "</td>"
	."<td bgcolor=\"$bgcolor3\"".$catclass." id=\"showhide_cat_$key\"><table align=\"left\" cellspacing=\"0\" cellpadding=\"0\" border = \"0\">";

	$newcolor = ($new[$key] == "on") ? "new.gif" : "new_gray.gif";
	
	echo "<tr height=8><td></td></tr><tr align=\"center\"><td><strong>"._MENU_CATNAME."</strong></td>";
	
	if ($old_school_imagedropdown == 1) 
	{ 
		echo "<td><strong>"._MENU_IMGNAME."</strong></td>";
	}
	
	echo "<td align=\"center\" width=\"100%\"><strong>"._MENU_CATLINK."</strong></td><td></td><td>"._MENU_BOLD."</strong></td><td></td><td></td></tr><tr height=\"8\"><td></td></tr><tr align=\"center\">";
	
	echo "<td align =\"left\">";
	echo "<input type=\"Hidden\" name=\"menuformkeymenu\" value=\"$key\">" 
	."<input type=\"Hidden\" name=\"menuformgroupmenu[99]\" value=\"99\">";

	$zeimgname = ($image[$key] == "noimg" || $image[$key] == '') ? "admin/noimg.gif" : $image[$key];

	if ($old_school_imagedropdown == 0) 
	{
		if (!defined('_MENU_ADMINIMGDROPDOWN')) define('_MENU_ADMINIMGDROPDOWN', '_MENU_ADMINIMGDROPDOWN');
		echo "<table cellpadding=0 cellspacing=0 border=0><tr><td style=\"padding-right: 3px;\"><table title=\""._MENU_ADMINIMGDROPDOWN."\" cellpadding=1 cellspacing=0 style=\"cursor: pointer; margin: 
		0px; border: 1px solid black;\" onclick=\"clicked=0;s=1;keymenu_image='".$key."';menu_displayimagelist(document.images['catimage".$key."'],'menu_imagelist');\"><tr><td><img 
		src=\"".$urlofimages."/".$zeimgname."\" name=\"catimage".$key."\" title=\""._MENU_ADMINIMGDROPDOWN."\"></td><td style=\"vertical-align: bottom; background-color: "
		.$bgcolor2."; padding: 0px;\"><img src=\"".$urlofimages."/admin/dn.gif\" title=\""._MENU_ADMINIMGDROPDOWN."\"></td></tr></table></td>";
	}
	else 
	{
		echo "<table cellpadding=0 cellspacing=0 border=0><tr><td style=\"padding-right: 3px;\"><img src=\"".$urlofimages."/".$zeimgname."\" name=\"catimage".$key."\"></td>";
	}
	
	if ($image[$key] == "") 
	{
		$image[$key] = "noimg";
	}
	
	echo "<td><input type=\"text\" class=\"select\" name=\"menuformname[$key]\" size=\"20\" maxlength=150 value=\"$catname[$key]\"></td></tr></table>";

	if ($old_school_imagedropdown == 0) 
	{
		echo "<input type=\"hidden\" name=\"menuformimage[$key]\" value=\"".$image[$key]."\"></td>";
	}
	else 
	{ 
		echo "</td><td><select name=\"menuformimage[$key]\" onchange=\"changeimage('catimage".$key."',this.value)\">";
		$selected = ($image[$key] == "noimg") ? "selected" : "";
		echo "<option value=\"noimg\" $selected>"._MENU_NOIMG."</option>";

		for ($i=0;$i < count($file);$i++) 
		{   # chaque image /images/menu
		    if ($file[$i] != "." && $file[$i] != ".." && $file[$i] != "categories" && $file[$i] != "admin") 
			{
			   if ($file[$i]==$image[$key]) 
			   {
				  echo "<option value =\"$file[$i]\" selected>$file[$i]</option>";
			   }
			   else 
			   {
				  echo "<option value =\"$file[$i]\" >$file[$i]</option>";
			   }
		    }
	    }

		echo "</select></td>";
	}

	echo ""
	."<td align=\"center\">";

	if(!isset($lien[$key]))
	$lien[$key] = '';
	
	$testehttp=strpos($lien[$key],"http://");
	$testeftp=strpos($lien[$key],"ftp://");
	$testehttps=strpos($lien[$key],"https://");
	
	if ($testehttp === 0 || $testeftp === 0 || $testehttps === 0) 
	{
		$displaytargetblank = "inline";
		$displaytargetnone = "none";
	}
	else
	if ($lien[$key]!= "") 
	{
		$displaytargetblank = "none";
		$displaytargetnone = "inline";
	}
	else 
	{
		$displaytargetblank = "none";
		$displaytargetnone = "none";
	}
	
	echo "<img style=\"display: ".$displaytargetblank."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetblank.gif\" name=\"targetblank$key\" alt=\""._MENU_TARGETBLANK."\" title=\""._MENU_TARGETBLANK."\">";
	
	echo "<img style=\"display: ".$displaytargetnone."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetnone.gif\" name=\"targetnone$key\" alt=\""._MENU_TARGETNONE."\" title=\""._MENU_TARGETNONE."\">";

	echo "<input type=\"text\" class=\"select\" name=\"menuformlien[$key]\" size=\"20\" value=\"$lien[$key]\" onchange='targetblank(\"".$key."\",this.value)'></td>";
	
	//$checked = ($center[$key] == "on") ? "checked" : "";
	
	echo "<td align=\"center\"></td>";

	$checked = ($bold[$key] <> "") ? "checked" : "";
	
	echo "<td align=\"center\"><input type=\"checkbox\" name=\"menuformbold[$key]\" $checked></td>";
	
	$checked = ($new[$key] <> "") ? "on" : "";
	
	$colornew = ($checked == "on") ? "new" : "new_gray";
	
	echo "<td><input type=\"hidden\" name=\"menuformnew[$key]\" value=\"$checked\"><img name=\"somcatnew$key\" src=\""
	.$urlofimages."/admin/$colornew.gif\" style=\"cursor: pointer;\" alt=\""._MENU_IMGNEWTITLE."\" title=\""._MENU_IMGNEWTITLE."\" onclick=\"menuchangecatimgnew(document.images['somcatnew$key'],'$key','');\">&nbsp;</td>";

	echo "<td></td>"
	."</tr>"
	."<tr height=8><td></td></tr><tr><td align=\"left\" colspan=10 style=\"white-space: nowrap\"><strong>"._MENU_MISEENPAGE."</strong>&nbsp;:&nbsp;"; //v2.1 colspan was 6
	
	$checked = ($hr[$key] == "on") ? "checked" : "";
	
	echo "<input type=\"checkbox\" name=\"menuformhr[$key]\" id=\"menuformhr[$key]\" $checked>&nbsp;<LABEL FOR=\"menuformhr[$key]\">Horizonatal Rule</LABEL>&nbsp;&nbsp;&nbsp;";
	
	//$checked = ($listbox[$key] == "on") ? "checked" : "";
	
	//echo "<input type=\"checkbox\" name=\"menuformlistbox[$key]\" id=\"menuformlistbox[$key]\" $checked>&nbsp;<LABEL FOR=\"menuformlistbox[$key]\">"._MENU_LISTBOX."</LABEL>&nbsp;&nbsp;&nbsp;";
	
	echo "<input type=\"text\" class=\"select\" name=\"menuformbgcolor[$key]\" size=8 value=\"$categoriebgcolor[$key]\">&nbsp;"._MENU_BGCOLOR."&nbsp;&nbsp;&nbsp;</td>"
	."</tr><tr height=8><td></td></tr></table></td>"
	."<td bgcolor=\"$bgcolor2\"".$catclass." rowspan=2 id=\"showhide_suppr_$key\">";
	
	if(!isset($key99))
	$key99 = '';

	if ($key99 <> 99)
	{
		echo "<div class=\"red\"><a href=\"".$admin_file.".php?op=menu&amp;go=deletecat&amp;deletecat=$groupmenu[$key]&amp;catname=$catname[$key]\" title=\""._MENU_SUPPR."\" 
		onclick=\"if (confirm('"._MENU_JSSAVEBEFORE."')) {document.forms.form_menu.submit();};\"><img src=\"".$urlofimages."/admin/trash.png\" border=0 width=\"50\"></a></div>";
	}
	
	echo "</td>"
	."</tr><tr><td bgcolor=\"$bgcolor1\" id=\"showhide_content_$key\"".$display_cat.">";
	
    if(!isset($moduleinthisgroup[$groupmenu[$key]]))
	$moduleinthisgroup[$groupmenu[$key]] = null;
	
	if(is_array($moduleinthisgroup[$groupmenu[$key]])) 
	{
      if ($moduleinthisgroup[$groupmenu[$key]] > count($moduleinthisgroup[$groupmenu[$key]]))
      $nbmodules = $namemodules = count($moduleinthisgroup[$groupmenu[$key]]);
    } 
	else 
	{ 	
      $nbmodules = $namemodules = 0;
    }
    
	$namemodules=$namemodules+4; // this was +4 in old code testing now - I took this from his sommaire garbage menu

	echo "<table align=\"center\" border=0 cellspacing=0 cellpadding=2 width=\"100%\"><tr><td></td><td align =\"center\">"
	._MENU_CATCONTENT."</td><td align=\"center\">"._MENU_LINKURL."</td><td align=\"center\">"._MENU_LINKTEXT."</td><td width=\"3\"></td>";

	if ($old_school_imagedropdown_cat == 1) 
	{
		echo "<td align=\"center\">"._MENU_IMAGE."</td>";
	}
	else 
	{
	
	}
	
	echo "<td align=\"center\">"._MENU_BOLD."</td><td></td><td></td></tr>";
	echo "<tr><td colspan=11 height=4></td></tr>";

	for ($z=0;$z < $namemodules;$z++) 
	{
		$formpointer=$key."_".$z."";
		
		if(!isset($imageinthisgroup[$groupmenu[$key]][$z]))
		$imageinthisgroup[$groupmenu[$key]][$z] = '';

		if ($imageinthisgroup[$groupmenu[$key]][$z] == '' || $imageinthisgroup[$groupmenu[$key]][$z] == 'middot.gif') 
		{
			$posterimageinthiscategorie = "admin/middot.gif";
		}
		else 
		{
			$posterimageinthiscategorie = "categories/".$imageinthisgroup[$groupmenu[$key]][$z];
		}

		if(!isset($sublevel[$groupmenu[$key]][$z]))
		$sublevel[$groupmenu[$key]][$z] = '';

		if ($sublevel[$groupmenu[$key]][$z] > 0) 
		{
			$sublevelwidth = 15*$sublevel[$groupmenu[$key]][$z];
			$inputadresswidth = 20;
			$inputlinktextwidth = 15;
			$sublevelimage1 = "<img src=\"$urlofimages/admin/null.gif\" name=\"sublevelspacer1[$key][$z]\" height=\"1px\" width=\"".$sublevelwidth."px\">";
			$sublevelbgcolor = "";
		}
		else 
		{
			$sublevelwidth = 1;
			$sublevelimage1 = "<img src=\"$urlofimages/admin/null.gif\" name=\"sublevelspacer1[$key][$z]\" height=\"1px\" width=\"1px\">";
			$inputadresswidth = 20;
			$inputlinktextwidth = 15;
			$sublevelbgcolor = "";
		}

		$now = time();
		
		//if (strpos($days_link[$groupmenu[$key]][$z],'8')!== false || $now < $date_debut_link[$groupmenu[$key]][$z] || ($date_fin_link[$groupmenu[$key]][$z] > 0 && $now > $date_fin_link[$groupmenu[$key]][$z])) 
		//{
		//	$linkclass = " class=\"menu_hidden\"";
		//}
		//else 
		//{
			$linkclass = "";
		//}
		echo "<tr id=\"span$formpointer\"><td id=\"spana$formpointer\"".$linkclass." style=\"text-align:left; vertical-align: middle;\">";
				 
		$flechehaut =($z == 0) ? "" : "<a href=\"javascript:menu_move_updown('".$key."','".$z."','".$namemodules."','up');\"><img src=\"$urlofimages/admin/up.gif\" 
		alt=\"move up\" title=\""._MENU_MOVEUP."\"></a><br><img src=\"$urlofimages/admin/null.gif\" height=\"2px\" width=\"1px\"><br>";
		
		$flechebas=($z == $namemodules-1) ? "" : "<a href=\"javascript:menu_move_updown('".$key."','".$z."','".$namemodules."','down');\"><img src=\"$urlofimages/admin/down.gif\" 
		alt=\"move down\" title=\""._MENU_MOVEDOWN."\"></a>";

		echo "".$flechehaut.$flechebas."</td><td id=\"spanb$formpointer\"".$linkclass." style=\"text-align:left; vertical-align: middle;\">";
		
		if ($old_school_imagedropdown_cat == 0) 
		{
			if (!defined('_MENU_ADMINIMGDROPDOWN')) define('_MENU_ADMINIMGDROPDOWN', '_MENU_ADMINIMGDROPDOWN');
			if (!defined('_MENU_ADMINIMGDROPDOWNCAT')) define('_MENU_ADMINIMGDROPDOWNCAT', '_MENU_ADMINIMGDROPDOWNCAT');
			
			echo "<table cellspacing=0 cellpadding=0 border=0 style=\"vertical-align: middle;\"><tr><td style=\"padding-right: 3px;\"><table cellspacing=0 cellpadding=0 border=0><tr><td>"
			.$sublevelimage1."</td><td><table title=\""._MENU_ADMINIMGDROPDOWNCAT."\" cellpadding=0 cellspacing=0 style=\"cursor: pointer; margin: 0px; border: 1px solid black;\" 
			onclick=\"clicked=0;s=1;keymenu_image='".$key."';zimage='".$z."';menu_displayimagelist(document.images['image".$formpointer."'],'menu_imagelist_cat');\"><tr><td style=\"padding: 1px;\"><img 
			src=\"".$urlofimages."/".$posterimageinthiscategorie."\" name=\"image".$formpointer."\" title=\""._MENU_ADMINIMGDROPDOWN."\"></td><td style=\"padding: 0px; margin: 0px; 
			vertical-align: bottom; background-color: ".$bgcolor2.";\"><img src=\"".$urlofimages."/admin/dn.gif\" title=\""._MENU_ADMINIMGDROPDOWN."\"></td></tr></table></td></tr></table>";
		}
		else 
		{
			echo "<table cellspacing=0 cellpadding=0 border=0 style=\"vertical-align: middle;\"><tr><td style=\"padding-right: 3px;\">".$sublevelimage1."<img 
			src=\"".$urlofimages."/".$zeimgname."\" name=\"image".$formpointer."\">";
		}
	
	echo "</td>";

		if(!isset($linkinthisgroup[$groupmenu[$key]][$z]))
		$linkinthisgroup[$groupmenu[$key]][$z] = '';

		$linkvalue = $linkinthisgroup[$groupmenu[$key]][$z];
		

		if(!isset($linktextinthisgroup[$groupmenu[$key]][$z]))
		$linktextinthisgroup[$groupmenu[$key]][$z] = '';

		$linktextvalue = $linktextinthisgroup[$groupmenu[$key]][$z];

		$zz = $z+1;

		if ($z == $namemodules-1) 
		{ 
			$hideok = 1;
			$menuzenom = "menuspan$key";
		}
		else 
		{
			$hideok = 1;
			$menuzenom = "span".$key."_".$zz."";
		}
		
        echo "<td id=\"spanc$formpointer\"".$linkclass." style=\"vertical-align: middle;\">";
		
		echo "<table cellpadding=0 cellspacing=0 border=0 height=\"1px\" style=\"vertical-align: bottom\"><tr><td>";
		
		echo "<select name=\"menuformingroup[$key][$z]\" 
		onchange='disab(this,this.value,this.form.elements[\"menuformmodulelink[$key][$z]\"],this.form.elements[\"menuformmodulelinktext[$key][$z]\"],\"$linkvalue\",\"$linktextvalue\"); 
		menuadminshowhide(\"$menuzenom\",$hideok)'>";

		if(!isset($moduleinthisgroup[$groupmenu[$key]][$z]))
		$moduleinthisgroup[$groupmenu[$key]][$z] = '';
		
		echo "<option value=\"None\">ADD MODULE LINK TO MENU";
		$selected = ($moduleinthisgroup[$groupmenu[$key]][$z] == "Horizonatal Rule") ? "selected" : "";
		echo "<option value=\"Horizonatal Rule\" $selected>*Horizonatal Rule*";
		$selected = ($moduleinthisgroup[$groupmenu[$key]][$z] == "External Link") ? "selected" : "";
		echo "<option value=\"External Link\" $selected>*External Link*";
		$selected = ($moduleinthisgroup[$groupmenu[$key]][$z] == "MENUTEXTONLY") ? "selected" : "";
		echo "<option value=\"MENUTEXTONLY\" $selected>*Text Without Url*";
		echo "<option value=\"SEP\">=======================";
		
		for ($i=0;$i < count($modules);$i++) 
		{
			$selected = ($modules[$i]==$moduleinthisgroup[$groupmenu[$key]][$z]) ? "selected" : "";
			
			if ($modules[$i] == '..')
			{
				
			}
			else
			echo "<option value=\"$modules[$i]\" $selected>$modules[$i]";
		
		}
		
		echo "</select>";
		echo "</td><td>"; 

		$sublevel[$groupmenu[$key]][$z] = ($sublevel[$groupmenu[$key]][$z]) ? $sublevel[$groupmenu[$key]][$z] : 0;
		
		echo "<input type=\"hidden\" name=\"sublevel[$key][$z]\" value=\"".$sublevel[$groupmenu[$key]][$z]."\">";

		if ($z == 0) 
		{
			$flechegauche = "";
			$flechedroite = "";
		}
		else 
		{
			if ($sublevel[$groupmenu[$key]][$z] == 0) 
			{
				$display_fleche_gauche = " style=\"display: none;\"";
			}
			else 
			{
				$display_fleche_gauche = "";
			}
			
			if ($sublevel[$groupmenu[$key]][$z] > $sublevel[$groupmenu[$key]][$z-1]) 
			{
				$display_fleche_droite = " style=\"display: none;\"";
			}
			else 
			{
				$display_fleche_droite = "";
			}
			
			$flechegauche = "<a href=\"javascript:menu_manage_sublevels('$key','$z','left')\"><img 
			src=\"$urlofimages/admin/left.gif\" name=\"imageleft[$key][$z]\" alt=\"delete sublevel\" title=\""._MENU_REMOVESUBLEVEL."\"".$display_fleche_gauche."></a><img 
			src=\"$urlofimages/admin/null.gif\" height=\"1px\" width=\"2px\">";
			
			$flechedroite = "<a href=\"javascript:menu_manage_sublevels('$key','$z','right')\"><img src=\"$urlofimages/admin/right.gif\" 
			name=\"imageright[$key][$z]\" alt=\"make sublevel\" title=\""._MENU_ADDSUBLEVEL."\"".$display_fleche_droite."></a>";
		}

		echo $flechegauche.$flechedroite;
		
		echo "</td></tr></table>";
		echo "</td>";
        echo "</td></tr></table>";
		
		$testehttp = strpos($linkinthisgroup[$groupmenu[$key]][$z],"http://");
		$testeftp = strpos($linkinthisgroup[$groupmenu[$key]][$z],"ftp://");
		$testehttps = strpos($linkinthisgroup[$groupmenu[$key]][$z],"https://");
		
		if ($testehttp === 0 || $testeftp === 0 || $testehttps === 0) 
		{
			$displaytargetblank = "inline";
			$displaytargetnone = "none";
		}
		elseif ($linkinthisgroup[$groupmenu[$key]][$z]!= "") 
		{
			$displaytargetblank = "none";
			$displaytargetnone = "inline";
		}
		else 
		{
			$displaytargetblank="none";
			$displaytargetnone="none";
		}
		
		echo "<td align=\"center\" id=\"spand$formpointer\"".$linkclass.">";
		
		echo "<img style=\"display: ".$displaytargetblank."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetblank.gif\" 
		name=\"targetblank$formpointer\" alt=\""._MENU_TARGETBLANK."\" title=\""._MENU_TARGETBLANK."\">";
		
		echo "<img style=\"display: ".$displaytargetnone."; width: 15px; margin-right: 5px;\" src=\"".$urlofimages."/admin/targetnone.gif\" 
		name=\"targetnone$formpointer\" alt=\""._MENU_TARGETNONE."\" title=\""._MENU_TARGETNONE."\">";

		if ($moduleinthisgroup[$groupmenu[$key]][$z]=="External Link") 
		{   # 'External Link' 
			$visibility_link = "";
			$visibility_link_text = "";
		}
		elseif ($moduleinthisgroup[$groupmenu[$key]][$z] == "MENUTEXTONLY") 
		{   # Text Only
			$visibility_link = "style=\"visibility:hidden;\" disabled";
			$visibility_link_text = "";
		}
		else 
		{ # "External Link" 
			$visibility_link = "style=\"visibility:hidden;\" disabled";
			$visibility_link_text = "style=\"visibility:hidden;\" disabled";
		}
		
		
		echo "<input type=\"text\" class=\"select\"".$visibility_link." name=\"menuformmodulelink[$key][$z]\" value=\"".$linkinthisgroup[$groupmenu[$key]][$z]."\" 
		size=".$inputadresswidth." onChange='targetblank(\"".$formpointer."\",this.value)' >"
		
		."</td><td id=\"spane$formpointer\"".$linkclass.">"
		."<input type=\"text\" class=\"select\"".$visibility_link_text." name=\"menuformmodulelinktext[$key][$z]\" size=".$inputlinktextwidth." value=\"".$linktextinthisgroup[$groupmenu[$key]][$z]."\">";
		
		echo "</td>";
		
	if ($old_school_imagedropdown_cat == 0) 
	{
		$imagenewschool = ($imageinthisgroup[$groupmenu[$key]][$z] == '') ? 'middot.gif': $imageinthisgroup[$groupmenu[$key]][$z];
		
		echo "<td id=\"spanf$formpointer\"".$linkclass."><input type=\"hidden\" name=\"menuformmoduleimage[".$key."][".$z."]\" value=\"".$imagenewschool."\"></td>";
	}
	else 
	{   # flash
		echo "<td id=\"spanf$formpointer\"".$linkclass." align=\"center\"><select name=\"menuformmoduleimage[$key][$z]\" onChange=\"changeimage_cat('image".$formpointer."',this.value)\">";
		echo "<option value='middot.gif' >"._MENU_NOIMG." ( <strong>&middot;</strong> )</option>";
		
		for ($i=0;$i < count($file2);$i++) 
		{
			if ($file2[$i] != "." && $file2[$i] != "..") 
			{
				if ($file2[$i] == $imageinthisgroup[$groupmenu[$key]][$z]) 
				{
					echo "<option value =\"$file2[$i]\" selected>$file2[$i]</option>";
				}
				else 
				{
					echo "<option value =\"$file2[$i]\" >$file2[$i]</option>";
				}
			}
		}
		echo "</select></td>";
	}
		
		if(!isset($grasofthismodule[$groupmenu[$key]][$z]))
		$grasofthismodule[$groupmenu[$key]][$z] = '';

		$checked = ($grasofthismodule[$groupmenu[$key]][$z] <> "") ? "checked" : "";

		echo "<td id=\"spang$formpointer\"".$linkclass." align=\"center\"><input type=\"checkbox\" name=\"menuformmodulegras[$key][$z]\" $checked></td>";

		if(!isset($newinthisgroup[$groupmenu[$key]][$z]))
		$newinthisgroup[$groupmenu[$key]][$z] = '';
		
		$checked = ($newinthisgroup[$groupmenu[$key]][$z] <> "") ? "on" : "";

		$colornew = ($checked == "on") ? "new" : "new_gray";

		echo "<td id=\"spanh$formpointer\"".$linkclass." align=\"center\"><input type=\"hidden\" name=\"menuformmodulenew[$key][$z]\" id=\"menuformmodulenew[$key][$z]\" 
		value=\"".$checked."\"><img name=\"somnew$formpointer\" src=\"".$urlofimages."/admin/$colornew.gif\" style=\"cursor: pointer;\" 
		alt=\""._MENU_IMGNEWTITLE."\" title=\""._MENU_IMGNEWTITLE."\" onclick=\"menuchangecatimgnew(document.images['somnew$formpointer'],'$key','$z');\"></td>";

		echo "<td></td>"; 

		echo "<td id=\"spanj$formpointer\"".$linkclass.">";

		//echo "[<a href='javascript:senddit(".$key.", ".$z.",\"edit\")' title=\""._MENU_MOREOPTIONS."\">+</a>]";

		echo "</td>";

		echo "</tr>";

		if ($z > $nbmodules) 
		{ 
		   echo "<script type=\"text/javascript\" language=\"JavaScript\">"
		       ."menuadminshowhide(\"span$formpointer\",0);"
		       ." </script>";
		}

		if(!isset($classofthismodule[$groupmenu[$key]][$z]))
		$classofthismodule[$groupmenu[$key]][$z] = '';

		$inputmoduleclass = ($classofthismodule[$groupmenu[$key]][$z] == "") ? $firstclass : $classofthismodule[$groupmenu[$key]][$z];
		
		echo "<input type=\"hidden\" name=\"menuformmoduleclass[$key][$z]\" value=\"".$inputmoduleclass."\">";
		
		if(!isset($new_daysinthisgroup[$groupmenu[$key]][$z]))
		$new_daysinthisgroup[$groupmenu[$key]][$z] = '';

		$inputnewdays = ($new_daysinthisgroup[$groupmenu[$key]][$z] == "") ? $new_days : $new_daysinthisgroup[$groupmenu[$key]][$z];
		
		echo "<input type=\"hidden\" name=\"menuformmodulenew_days[$key][$z]\" value=\"".$inputnewdays."\">";
		
		//echo "<input type=\"hidden\" name=\"menu_schedule_date_debut[$key][$z]\" value=\"".$date_debut_link[$groupmenu[$key]][$z]."\">";
		
		//echo "<input type=\"hidden\" name=\"menu_schedule_date_fin[$key][$z]\" value=\"".$date_fin_link[$groupmenu[$key]][$z]."\">";
		
		//echo "<input type=\"hidden\" name=\"menu_schedule_days[$key][$z]\" value=\"".$days_link[$groupmenu[$key]][$z]."\">";
		
	} 

	echo "<tr id=\"menuspan$key\" style=\"display:none;\"><td></td><td colspan=8>"._MENU_SENDTOHAVEMORE."</td></tr>";//affiche le message demandant d'envoyer les modifs.
	
	echo "</table>";
	
	echo"</td></tr>";

	echo "<input type=\"hidden\" name=\"menuformeachcategoryclass[$key]\" value=\"$categoryclass[$key]\">";
	
	$key++;
	
	} 


	$radio1 = ($invisible[$key99] == 1) ? "checked" : "";
	
	$radio2 = ($invisible[$key99] == 2 || $invisible[$key99] == 4) ? "checked" : ""; 
	
	$radio3 = ($invisible[$key99] == 3 || $invisible[$key99] == 5) ? "checked" : "";
	
	$radionew = ($new_days ==-1) ? "" : "checked";
	
	$disablenewdays = ($new_days==-1) ? "disabled" : "";
	
	$new_days_value = ($new_days==-1) ? "" : $new_days;
	
	echo '</table></td></tr></table>';
	echo '<br></td></tr>';
	echo '<tr><td colspan="2"><br><div  align=\"center\"><strong>'._MENU_GENERALOPTIONS.' :</strong></div></br>';
	
	echo "<table cellpadding=\"0\" cellspacing=\"0\" align=\"center\"><tr><td></td><td width=\"50\"></td><td></td></tr>";
	echo "<tr><td><input type=\"text\" class=\"select\" name=\"menuformclass\" size=\"15\" value=\"$categoryclass[0]\">&nbsp;"._MENU_CATEGORIESCLASS."</td>";
	
	echo "<td></td><td></td></tr>";
	
	echo "<tr><td><input type=\"text\" class=\"select\" name=\"menuformclassformodules\" size=\"15\" value=\"".$firstclass."\">&nbsp;"._MENU_MODULESCLASS."</td>";
	
	echo "<td></td><td></td></tr>";
	
	echo "<tr><td></td></tr>";
	
	echo "<tr><td colspan=3><input type=\"checkbox\" name=\"menuformnew_type\" id=\"menuformnew_type\" $radionew 
	onchange='if (this.form.elements[\"menuformnew_days\"].disabled==true){this.form.elements[\"menuformnew_days\"].disabled=false;}else{this.form.elements[\"menuformnew_days\"].disabled=true;}'><LABEL 
	for=\"menuformnew_type\"><strong>"._MENU_AUTODETECTNEW."</strong></LABEL>&nbsp;("._MENU_SINCE." <input type=\"text\" class=\"select\" name=\"menuformnew_days\";
	value=\"".$new_days_value."\" size=2 $disablenewdays> "._MENU_NBDAYS.")";
	
	echo "<input type=\"hidden\" name=\"menuformfirstnew_days\" value=\"".$new_days."\"><input type=\"hidden\" name=\"menuformfirstclass\" value=\"".$firstclass."\"></td></tr>";
	
	echo '<tr><td colspan = "3"></td></tr>
	<tr><td colspan = "3"></td></tr>
	</table></td></tr>';


	echo "<tr><td width=\"50%\" align=\"left\"></td><td width=\"50%\" align=\"center\">&nbsp;</td></tr>";
	
	echo "<tr><td width=\"50%\" align=\"left\"><input type=\"reset\" value=\""._MENU_CANCEL."\"></td><td width=\"50%\" align=\"center\"><input type=\"submit\" value=\"SAVE YOUR MODIFICATIONS\"></td></tr>";
	echo "</table>";
	echo "</form>";

	echo "<br><br>"._MENU_REMARKS.""._MENU_REMARKSTWO.""
	    ."<br><div align=\"center\"><br><br>version 1.0 - &copy; <a href=\"mailto:ernest.buffington@gmail.com?body=Read the FAQ before asking me questions!!\">Ernest Allen Buffington</a></div>";

	CloseTable();
	include("footer.php");
}


function send() 
{ 
      global $menuformkeymenu, 
	       $menuformgroupmenu, 
		        $menuformname, 
			   $menuformimage, 
			    $menuformlien, 
			 $menuformingroup, 
		 $menuformmoduleimage, 
		  $menuformmodulelink, 
	  $menuformmodulelinktext, 
	          
			  //$menuformcenter, 
			  
			      $menuformhr, 
			 $menuformbgcolor,
			   $menuformradio, 
			   $menuformclass, 
			    $menuformbold, 
				 $menuformnew, 
			 $menuformlistbox, 
   $menuformeachcategoryclass, 
          $menuformmodulegras, 
		   $menuformmodulenew, 
		    $menuformnew_type, 
			$menuformnew_days, 
	  $menuformmodulenew_days, 
	   $menuformfirstnew_days, 
	     $menuformmoduleclass, 
	 $menuformclassformodules, 
	      $menuformfirstclass, 
		     
			 $menuformdynamic, 
			 
			        $sublevel, 
					      $db, 
					  $prefix, 
					     $sql,
				  $admin_file;

  $menuformnew_days = ($menuformnew_type == "on") ? $menuformnew_days : "-1";
   
  //$nom = ($menushowadmin == "on") ? $menushowadmin : "menunoadmindisplay"; 

for ($i = 0; $i <= $menuformkeymenu; $i++) 
{
	if ((!preg_match("/([0-9]{1,2})/",$menuformgroupmenu[$i])) || ($menuformgroupmenu[$i] == 99)) 
	{
		include_once("header.php");
		GraphicAdmin();
		OpenTable();
		echo"<div align=\"center\">";
		echo ""._MENU_INVALIDWEIGHT."&nbsp;'$menuformname[$i]'&nbsp;($menuformgroupmenu[$i])";
		echo "<br>"._MENU_MUSTBENUM."";
		echo "</div>";
		CloseTable();
		include_once("footer.php");
		return;
	}
	
	for($j = 0; $j <= $menuformkeymenu; $j++) 
	{
		if ($i <> $j) 
		{
			if ($menuformgroupmenu[$i] == $menuformgroupmenu[$j]) 
			{
				include_once("header.php");
				GraphicAdmin();
				OpenTable();
				echo"<div align=\"center\">";
				echo ""._MENU_CATS."&nbsp;'$menuformname[$i]'&nbsp;"._MENU_AND."&nbsp;'$menuformname[$j]'&nbsp;"._MENU_SAMEWEIGHT."&nbsp;($menuformgroupmenu[$i])";
				echo "<br>"._MENU_MODIFWEIGHT."";
				echo "<br>NB :&nbsp;"._MENU_MUSTBENUM."";
				echo "</div>";
				CloseTable();
				include_once("footer.php");
				return;
			}
		}
	}
}

$db->sql_query("DELETE FROM ".$prefix."_menu");
$db->sql_query("DELETE FROM ".$prefix."_menu_categories");

global $db, $prefix;

$sql="SELECT * FROM ".$prefix."_modules LIMIT 1";
$result=$db->sql_query($sql);
$row=$db->sql_fetchrow($result);

if(isset($row['mod_group']))
{
    global $db, $prefix;

	$sql2 = "SELECT * FROM ".prefix."_users LIMIT 1";
	$result2 = $db->sql_query($sql2);
	$row2 = $db->sql_fetchrow($result2);
	$managment_group = (isset($row2['points'])) ? 1 : 0;
}
else 
{
	$managment_group = 0;
}

for ($i = 0; $i <= $menuformkeymenu; $i++) 
{
	for ($j = 0; $j < count($menuformingroup[$i]); $j++) 
	{
		$menu_class = ($menuformfirstclass != $menuformclassformodules) ? $menuformclassformodules : $menuformmoduleclass[$i][$j];
		
		$menu_class = ($menu_class == "") ? $menuformclassformodules : $menu_class; 
		
		$menu_new_days = ($menuformfirstnew_days != $menuformnew_days) ? $menuformnew_days : $menuformmodulenew_days[$i][$j];
		
		$menu_new_days = ($menu_new_days == "") ? $menuformnew_days : $menu_new_days; 
		
		if ($managment_group == 1 && $menuformradio == 2) 
		{
			$invisible = 4;
		}
		elseif ($managment_group == 1 && $menuformradio == 3) 
		{
			$invisible = 5;
		}
		else 
		{
			$invisible = $menuformradio;
		}
		
		if ($menuformingroup[$i][$j] != "None") 
		{
			if ($menuformingroup[$i][$j] == "Horizonatal Rule") // <hr />
			{
				$menuformmodulelink[$i][$j] = "";
				$menuformmodulelinktext[$i][$j] = "";
				$menuformmoduleimage[$i][$j] = "";

			}
			else
			if ($menuformingroup[$i][$j] == "MENUTEXTONLY") //text with no link
			{
				$menuformmodulelink[$i][$j] = "";
			}
			else
			if ($menuformingroup[$i][$j] == "External Link") {//link extetrnal
				
			}
			else 
			{ 
				$menuformmodulelink[$i][$j] = "";
				$menuformmodulelinktext[$i][$j] = "";
			}
			
			if (empty($menu_new_days))
			$menu_new_days = -1;

			//if (empty($menu_schedule_date_debut[$i][$j]))
			//$menu_schedule_date_debut[$i][$j] = 0;

			if (empty($menu_schedule_date_fin[$i][$j]))
			$menu_schedule_date_fin[$i][$j] = 0;
			
			$sql="INSERT INTO ".$prefix."_menu_categories (groupmenu, 
			                                                  module, 
															     url, 
															url_text, 
															   image, 
															     new, 
															new_days, 
															   class, 
															    bold, 
															sublevel, 
															    days) 
			
			VALUES ('".$menuformgroupmenu[$i]."', 
			        '".$menuformingroup[$i][$j]."', 
					'".$menuformmodulelink[$i][$j]."', 
					'".$menuformmodulelinktext[$i][$j]."', 
					'".$menuformmoduleimage[$i][$j]."', 
					'".$menuformmodulenew[$i][$j]."', 
					'".$menu_new_days."', 
					'".$menu_class."', 
					'".$menuformmodulegras[$i][$j]."',
					'".$sublevel[$i][$j]."',
					'".$menu_schedule_days[$i][$j]."')";
			
			$db->sql_query($sql);
			
		}
		
	}

	if ($menuformname[$i] == '' && $menuformimage[$i] == "noimg" && $menuformlien[$i] == '' && $menuformhr[$i] == '' && $menuformcenter[$i] == '' && $menuformbgcolor[$i] == '') 
	{
	
	}
	else 
	{
		$menu_class = ($menuformeachcategoryclass[0] != $menuformclass) ? $menuformclass : $menuformeachcategoryclass[$i];
		$menu_class = ($menu_class == "") ? $menuformclass : $menu_class; 

        if (empty($invisible))
        $invisible = 0;

		$sql="INSERT INTO ".$prefix."_menu (groupmenu, 
		                                         name, 
												image, 
												 lien, 
												   hr, 
											  bgcolor, 
											invisible, 
											    class, 
												 bold, 
												  new, 
											     days) 
	    
		VALUES ('".$menuformgroupmenu[$i]."', 
		        '".$menuformname[$i]."', 
				'".$menuformimage[$i]."', 
				'".$menuformlien[$i]."', 
				'".$menuformhr[$i]."', 
				'".$menuformbgcolor[$i]."', 
				'".$invisible."', 
				'".$menu_class."', 
				'".$menuformbold[$i]."', 
				'".$menuformnew[$i]."', 
				'".$menu_schedule_days_cat[$i]."')";
		
		$db->sql_query($sql);
		
	} 
}
$sqlz = "INSERT INTO `".$prefix."_menu` (`groupmenu`, `name`, `image`, `lien`, `hr`, `bgcolor`, `invisible`, `class`, `bold`, `new`, `days`) 
VALUES ('99', NULL, NULL, NULL, NULL, NULL, '0', 'categories', NULL, NULL, NULL);";
$db->sql_query($sqlz);

include_once("header.php");
OpenTable();
echo "<br><div align=\"center\">"._MENU_SUCCESS."</div>";
echo "<br><div align=\"center\">[<a href=\"admin.php\"> Back To Main Admin Area</a>]</div>";
echo "<br><div align=\"center\">[<a href=\"".$admin_file.".php?op=menu\">"._MENU_BACKADMIN."</a>]</div>";
	  
CloseTable();
include_once("footer.php");
}

function edit() 
{
	      global $key, 
	               $z, 
	      $modulename, 
	       $link_name, 
	        $lienlien, 
	           $image, 
	        $new_days, 
       $categoryclass, 
          $link_class, 
	         $catname, 
	        $catimage, 
	        $bgcolor1, 
	        $bgcolor3, 
	        $bgcolor2, 
	        $bgcolor4, 
	         $ThemeSel, 
    $menu_edit_posted, 
 $menu_category_class, 
     $menu_link_class, 
	   $menu_new_days, 
	              $db, 
			  $prefix, 
		 $urlofimages, 
		  $admin_file;
	
	if ($menu_edit_posted != "ok") 
	{
		if ($catimage <> "noimg" && !preg_match("/.swf/",$catimage)) 
		{
			if ($z != 'imacategory') 
			{
				$catimagesize = getimagesize("".$urlofimages."/$catimage");
			
				if ($image <> "middot.gif") 
				{
					$moduleimagesize = getimagesize("".$urlofimages."/categories/$image");
				}
				else 
				{
					$moduleimagesize[0] = 5;
				}
				$imagesize =$catimagesize[0]-$moduleimagesize[0];

				if ($imagesize < 0) {
					$imagesize = 0;
				}
			}
		}
		else {
			$imagesize=0;
			$catimage="admin/noimg.gif";
		}
		$catname = preg_replace("/\[SOMSYMBOLEet\]/","&",$catname); 
		$link_name = preg_replace("/\[SOMSYMBOLEet\]/","&",$link_name);
		$catname = preg_replace("/\[SOMSYMBOLEinterro\]/","?",$catname);
		$link_name = preg_replace("/\[SOMSYMBOLEinterro\]/","?",$link_name);
		
		include_once('themes/'.$ThemeSel.'/theme.php'); 
		
	
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html><head><title>"._MENU_EDITLINKTITLE."</title>
		<LINK REL="StyleSheet" HREF="themes/$ThemeSel/style/style.css" TYPE="text/css"></head>
		<body>';

		echo '<table border="1" width="100%">
	    <tr>
		<td bgcolor="grey">';

		echo '<form action="'.$admin_file.'.php?op=menu&amp;go=edit" method="post">
		<input type="hidden" name="menueditposted" value="ok">
		<table cellspacing=2 cellpadding=3 align="center">
		<tr class="title"><td colspan=3 align="center" bgcolor="darkgrey" >'._MENU_MOREOPTIONS.'</td></tr>
		<tr height=6><td></td></tr><tr>
		<td align="left" bgcolor="darkgrey"><img src="'.$urlofimages.'/'.$catimage.'">&nbsp;'.$catname.'</td>
		<td align="left" bgcolor="darkgrey">'._MENU_CLASS.' : <input type="text" class="select" name="categoryclass" value="'.$categoryclass.'" size=10>
		<input type="hidden" name="z" value="'.$z.'"><input type="hidden" name="keymenu" value="'.$key.'">
		</td>';
		
		//$dynvalue = ($dynamic=='on') ? "" : "checked";
		echo "<td><input type=\"checkbox\" name=\"alwaysopen\" id=\"alwaysopen\" $dynvalue><LABEL for=\"alwaysopen\">"._ALWAYS_OPEN."</LABEL></td>
		</tr><tr height=3><td></td></tr>";

		if ($z!="imacategory") {
			echo "<tr bgcolor=\"darkgrey\">";
			$displayimage= ($image=="middot.gif") ? "<strong>&middot;</strong>" : "<img src=\"".$urlofimages."/categories/$image\">";
			if ($modulename=="External Link" || $modulename=="MENUTEXTONLY") {
				echo "<td bgcolor=\"darkgrey\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\">".$displayimage."&nbsp;$link_name</td>";
			}
			elseif ($modulename=="Horizonatal Rule") {
				echo "<td bgcolor=\"darkgrey\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\"><hr></td>";
			}
			else {
				echo "<td bgcolor=\"darkgrey\"><img src=\"".$urlofimages."/admin/none.gif\" width=\"$imagesize\" height=\"1\">".$displayimage."&nbsp;$modulename</td>";
			}
			$disabled=($modulename=="Horizonatal Rule") ? "disabled" : "" ;
			echo "<td bgcolor=\"darkgrey\">"._MENU_CLASS." : <input type=\"text\" class=\"select\" name=\"somlienclass\" value=\"$link_class\" size=10></td>
		<td>"._MENU_SINCE." <input type=\"text\" class=\"select\" name=\"somnew_days\" value=\"$new_days\" $disabled size=2> "._MENU_NBDAYS."
		";

			echo "</td></tr>";
		}
		echo "<tr><td height=10></td></tr><tr><td align=\"center\" colspan=3><input type=\"submit\"></td></tr><tr><td height=15></td></tr>
		<tr><td colspan=3>"._MENU_ATTENTIONMOREOPTIONS."</td></tr></table></form>";
	echo '</td>
	</tr>
    </table>

		</body>
		</html>';

	}
	else{
		$dynamic = ($_POST['alwaysopen']=='on') ? '' : 'on' ;
	?>
	<script language="Javascript">
	<?php if ($z!="imacategory") { ?>
	opener.document.forms.form_menu.elements["menuformmoduleclass[<?php echo $key;?>][<?php echo $z;?>]"].value="<?php echo $menu_link_class;?>";
	opener.document.forms.form_menu.elements["menuformmodulenew_days[<?php echo $key;?>][<?php echo $z;?>]"].value="<?php echo $menu_new_days;?>";
	<?php } ?>
	opener.document.forms.form_menu.elements["menuformeachcategoryclass[<?php echo $key;?>]"].value="<?php echo $menu_category_class;?>";
	</script>
	<?php
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
		<html><head><title>"._MENU_EDITLINKTITLE."</title>
		<LINK REL=\"StyleSheet\" HREF=\"themes/$ThemeSel/style/style.css\" TYPE=\"text/css\"></head>
		<body>";

	echo "<br><br><div align=\"center\"><span  class=\"title\">"._MENU_MOREOPTIONSUCCESS."</span><br>"._MENU_SENDTOVALIDATE."<br><br><br><br><br><br><div align=\"center\" class=\"title\">[<a href=\"javascript:window.close()\">"._MENU_CLOSE."</a>]</div>";
	
	echo"</body></html>";
	}
}

function menu_schedule() {
}

function deletecat() {
	global $admin_file;
	if (!isset($admin_file)) {$admin_file="admin";}
	global $deletecat, $key, $confirm, $catname, $db, $prefix;
	
	if ($confirm<>"YES") {
		include_once ("header.php");
		OpenTable();
		$catname=htmlspecialchars($catname);
		echo"<div align=\"center\">"._MENU_WARNINGDELETECAT." <i>$catname</i> ?<br><br>";
		echo"[ <a href=\"".$admin_file.".php?op=menu\">"._MENU_NO."</a> | <a href=\"".$admin_file.".php?op=menu&amp;go=deletecat&amp;deletecat=$deletecat&amp;confirm=YES\">"._MENU_YES."</a> ]"
		."</div>";
		CloseTable();
		GraphicAdmin();
		include_once("footer.php");
	}
	else 
	{
		$confirm="NO";
		$db->sql_query("DELETE FROM ".$prefix."_menu WHERE groupmenu='$deletecat'");
		$db->sql_query("DELETE FROM ".$prefix."_menu_categories WHERE groupmenu='$deletecat'");
		index();
	}
}
if(!isset($go))
$go = '';

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
?>
