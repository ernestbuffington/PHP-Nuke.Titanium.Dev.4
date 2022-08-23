/////No need to edit beyond here //////////////////////////

function getElementbyClass(rootobj, classname){
    var temparray=new Array()
    var inc=0
    var rootlength=rootobj.length
    for (i=0; i<rootlength; i++){
	if (rootobj[i].className==classname)
	    temparray[inc++]=rootobj[i]
    }
    return temparray
}

function sweeptoggle(ec){
    var inc=0
    while (ccollect[inc]){
	ccollect[inc].style.display=(ec=="contract")? "none" : ""
	inc++
    }
    revivestatus()
}


function expandcontent(curobj, cid){
    if (ccollect.length>0){
	document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="none")? "none" : ""
	curobj.src=(document.getElementById(cid).style.display=="none")? expandsymbol : contractsymbol
    }
}

function revivecontent(){
    selectedItem=getselectedItem()
    selectedComponents=selectedItem.split("|")
    for (i=0; i<selectedComponents.length-1; i++)
    document.getElementById(selectedComponents[i]).style.display="none"
}

function revivestatus(){
    var inc=0
    while (statecollect[inc]){
	if (ccollect[inc].style.display=="none")
	    statecollect[inc].src=expandsymbol
	else
	    statecollect[inc].src=contractsymbol
	inc++
    }
}

function get_cookie(Name) {
    var search = Name + "="
    var returnvalue = "";
    if (document.cookie.length > 0) {
    	offset = document.cookie.indexOf(search)
    	if (offset != -1) {
    	    offset += search.length
    	    end = document.cookie.indexOf(";", offset);
    	    if (end == -1) end = document.cookie.length;
    	    returnvalue=unescape(document.cookie.substring(offset, end))
    	}
    }
    return returnvalue;
}

function getselectedItem(){
    if (get_cookie(window.location.host) != ""){
    	selectedItem=get_cookie(window.location.host)
    	return selectedItem
    }
    else
	return ""
}

function saveswitchstate(){
    var inc=0, selectedItem=""
    while (ccollect[inc]){
    	if (ccollect[inc].style.display=="none")
    	    selectedItem+=ccollect[inc].id+"|"
    	inc++
    }
    if (get_cookie(window.location.host) != selectedItem){ //only update cookie if current states differ from cookie's
	var expireDate = new Date()
	expireDate.setDate(expireDate.getDate()+parseInt(memoryduration))
	document.cookie = window.location.host+"="+selectedItem+";path=/;expires=" + expireDate.toGMTString()
    }
}

function do_onload(){
    uniqueidn=window.location.host+"firsttimeload"
    var alltags=document.all? document.all : document.getElementsByTagName("*")
    ccollect=getElementbyClass(alltags, "switchcontent")
    statecollect=getElementbyClass(alltags, "showstate")
    if (enablepersist=="on" && get_cookie(window.location.host)!="" && ccollect.length>0)
    revivecontent()
    if (ccollect.length>0 && statecollect.length>0)
    revivestatus()
}

var ccollect;

if (window.addEventListener)
    window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
    window.attachEvent("onload", do_onload)
else if (document.getElementById)
    womAdd('do_onload()');

if (enablepersist=="on" && document.getElementById)
    window.onunload=saveswitchstate