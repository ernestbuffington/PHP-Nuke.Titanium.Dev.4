/* global o3_shadow, o3_bubble */

function generatePopUp(e) {
    if (!(!olIe4 || olOp || !olIe55 || "undefined" !== typeof o3_shadow && o3_shadow || "undefined" !== typeof o3_bubble && o3_bubble)) {
        var o, t, i = 0;
        t = backDropSource(o = parseInt(o3_width), over.offsetHeight, i++), t += '<div style="position: absolute; top: 0; left: 0; width: ' + o + "px; z-index: " + i + ';">' + e + "</div>", layerWrite(t);
    }
}

function backDropSource(e, o, t) {
    return '<iframe frameborder="0" scrolling="no" src="javascript:false;" width="' + e + '" height="' + o + '" style="z-index: ' + t + '; filter: Beta(Style=0,Opacity=0);"></iframe>';
}

function hideSelectBox() {
    if (!(olNs4 || olOp || olIe55)) {
        var e, o, t, i, r, a, n, f, l, s;
        if (olIe4) s = 0;
        else {
            if (!(s = navigator.userAgent.match(/Gecko\/(\d{8})/i))) return;
            s = parseInt(s[1]);
        }
        if (s < 20030624) {
            e = parseInt(over.style.left), o = parseInt(over.style.top), t = o3_width, i = o3_aboveheight ? parseInt(o3_aboveheight) : over.offsetHeight, l = olIe4 ? o3_frame.document.all.tags("SELECT") : o3_frame.document.getElementsByTagName("SELECT");
            for (var d = 0; d < l.length; d++) !olIe4 && l[d].size < 2 || (r = pageLocation(l[d], "Left"), n = pageLocation(l[d], "Top"), a = l[d].offsetWidth, f = l[d].offsetHeight, e + t < r || e > r + a || o + i < n || o > n + f || (l[d].isHidden = 1, l[d].style.visibility = "hidden"));
        }
    }
}

function showSelectBox() {
    if (!(olNs4 || olOp || olIe55)) {
        var e, o;
        if (olIe4) o = 0;
        else {
            if (!(o = navigator.userAgent.match(/Gecko\/(\d{8})/i))) return;
            o = parseInt(o[1]);
        }
        if (o < 20030624) {
            e = olIe4 ? o3_frame.document.all.tags("SELECT") : o3_frame.document.getElementsByTagName("SELECT");
            for (var t = 0; t < e.length; t++) void 0 !== e[t].isHidden && e[t].isHidden && (e[t].isHidden = 0, e[t].style.visibility = "visible");
        }
    }
}

function pageLocation(e, o) {
    for (var t = 0; e.offsetParent;) t += e["offset" + o], e = e.offsetParent;
    return t += e["offset" + o];
}
"undefined" !== typeof olInfo && void 0 !== olInfo.meets && olInfo.meets(4.1) ? (registerHook("createPopup", generatePopUp, FAFTER), registerHook("hideObject", showSelectBox, FAFTER), olHideForm = 1) : console.log("overLIB 4.10 or later is required for the HideForm Plugin.");