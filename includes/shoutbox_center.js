//Scroll = 1; -> Scrolling
//Scroll = 0; -> No Scrolling
var Scroll = 1;

function allonloads(){
    SBpopulate();
}

// Insert Smiles to message box
function x(){ return; }

function DoSmilie(addSmilie, messageDef){
    var addSmilie, messageDef, revisedMessage;
    var currentMessage = document.shoutform1.ShoutComment.value;
    if (currentMessage == messageDef){ currentMessage=''; }
    revisedMessage = currentMessage+addSmilie;
    document.shoutform1.ShoutComment.value=revisedMessage;
    document.shoutform1.ShoutComment.focus();
    return;
}

//Drop-Down smilies
function MM_findObj(n, d){
    var p,i,x;
    if (!d) d = document;
    if ((p=n.indexOf("?"))>0&&parent.frames.length){
        d = parent.frames[n.substring(p+1)].document;
        n = n.substring(0,p);
    }
    if (!(x=d[n])&&d.all){
        x = d.all[n];
    }
    for (i=0;!x&&i<d.forms.length;i++) x = d.forms[i][n];
    for (i=0;!x&&d.layers&&i<d.layers.length;i++) x = MM_findObj(n,d.layers[i].document);
    if (!x && d.getElementById){
        x = d.getElementById(n);
    }
    return x;
}

//end Drop-Down smilies
/*
Original Javascript code by dynamic drive, modified by SuperCat https://ourscripts.86it.us
Cross browser Marquee II-  Dynamic Drive (www.dynamicdrive.com)
For full source code, 100's more DHTML scripts, and TOS, visit http://www.dynamicdrive.com
Credit MUST stay intact
*/
var SBspeed = 1;
var SBiedom = document.all || document.getElementById;
var SBactualheight = '';
var SBheight = '200px';
var SBcross_marquee, SBns_marquee;
var SBSet = 0;

if (Scroll == 1) {
    if (SBiedom){
        SBtxt='<div style="position:relative;width:100%;height:'+SBheight+';overflow:hidden" onmouseover="SBspeed=0" onmouseout="SBspeed=1"><div id="SBiemarquee" style="position:absolute;left:0px;top:0px;width:100%;"></div></div>';
    } else {
        SBtxt='<ilayer width=100% height='+SBheight+' name="SBns_marquee"><layer name="SBns_marquee2" width=100% height='+SBheight+' left=0 top=0 onmouseover="SBspeed=0" onmouseout="SBspeed=1"></layer></ilayer>';
    }
} else {
    if (SBiedom){
        SBtxt='<div id="SBiemarquee"></div>';
    } else {
        SBtxt='<ilayer width=100% height='+SBheight+' name="SBns_marquee"></ilayer>';
    }
}

function SBscroll(){
    if(SBiedom){
        if (parseInt(SBcross_marquee.style.top)>(SBactualheight*(-1)+2)){
            SBcross_marquee.style.top=parseInt(SBcross_marquee.style.top)-SBspeed+"px";
        } else {
            SBcross_marquee.style.top=parseInt(SBheight)+2+"px";
        }
    } else {
        if (SBns_marquee.top>(SBactualheight*(-1)+2)){
            SBns_marquee.top-=SBspeed;
        } else {
            SBns_marquee.top=parseInt(SBheight)+2;
        }
    }
    SBSet = 1;
}

function changeBoxSize(showhide) {
    document.getElementById('smilies_hide').style.display='none';
    document.getElementById('smilies_show').style.display='none';
    document.getElementById('smilies_'+showhide).style.display='block';
}

function SBpopulate(){
    if (SBiedom){
        SBcross_marquee=document.getElementById? document.getElementById("SBiemarquee") : document.all.SBiemarquee;
        SBcross_marquee.style.top=parseInt(SBheight)+8+"px";
        SBcross_marquee.innerHTML=SBcontent;
        SBactualheight=SBcross_marquee.offsetHeight;
    } else {
        SBns_marquee=document.SBns_marquee.document.SBns_marquee2;
        SBns_marquee.top=parseInt(SBheight)+8;
        SBns_marquee.document.write(SBcontent);
        SBns_marquee.document.close();
        SBactualheight=SBns_marquee.document.height;
    }
    if (SBSet == 0 && Scroll == 1){
        this.setInterval("SBscroll()",50);
    }
}

var Base64 = {

    // private property
    _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode : function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
            this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
            this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },

    // public method for decoding
    decode : function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

    // private method for UTF-8 encoding
    _utf8_encode : function (string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode : function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}

function AjaxShout() {
    var shout = nuke_jq('#ShoutComment').val(), submit = nuke_jq('#ShoutSubmit').val(), id = nuke_jq('#shoutuid').val();
	
	nuke_jq.post('modules.php?name=Shout_Box', {shoutbox_action: 'post_shout', ShoutComment: Base64.encode(shout), ShoutSubmit: submit, shoutuid: id}, function(data){
		shout_response(data);
		nuke_jq('#SBiemarquee').css('top', SBheight);
		nuke_jq('#shoutform1').get(0).reset();
	}, 'json');
	
	return false;
}

function AjaxRefresh() {
    nuke_jq.post('modules.php?name=Shout_Box', {shoutbox_action: 'refresh_shouts'}, function(data){
        shout_response(data);
    }, 'json');
}

setInterval('AjaxRefresh()', 10000);

function shout_response(request) {
	nuke_jq('#SBiemarquee').fadeOut(0).html(request['mid']).fadeIn(500);
	
	if (request['top'] != null) {
		nuke_jq('#shout_top').html(request['top']).show().delay(5000).fadeOut(500);
	}
}

function OnEnter(e) {
    if(window.event)
          keyCode = window.event.keyCode;     //IE
     else
          keyCode = e.which;     //firefox

    if(keyCode == 13) {
        AjaxShout();
        return false;
    }
    return true;
}

if(window.addEventListener)
    window.addEventListener("load",allonloads,false);
else if (window.attachEvent)
    window.attachEvent("onload", allonloads)
else if (document.getElementById)
    womAdd('allonloads()');