function ieupdate() {
    // Mark Bennett
    // Code to rewrite the swfs for the msie update
    // only affects ie on a pc
    if (isIE()) {
        var theObjects = document.getElementsByTagName("object");
        var theObjectsLen = theObjects.length;
        for (var i = 0; i < theObjectsLen; i++) {
            if (theObjects[i].outerHTML) {
                // does the object use the 'data' attribute?
                // if so msie completely ignores any <param> in the outerHTML
                // so lets ditch it, as msie doesn't use it, only mozilla etc
                if (theObjects[i].data) {
                    theObjects[i].removeAttribute("data");
                }
                theObjects[i].outerHTML = theObjects[i].outerHTML;
            }
        }
    }
}

function isIE() {
  // only for Win IE 6+
  // But not in Windows 98, Me, NT 4.0, 2000
  var strBrwsr= navigator.userAgent.toLowerCase();
  if (strBrwsr.indexOf("msie") > -1 && strBrwsr.indexOf("mac") < 0) {
    if (parseInt(strBrwsr.charAt(strBrwsr.indexOf("msie")+5)) < 6) {
      return false;
    }
    if (strBrwsr.indexOf("win98") > -1 ||
       strBrwsr.indexOf("win 9x 4.90") > -1 ||
       strBrwsr.indexOf("winnt4.0") > -1 ||
       strBrwsr.indexOf("windows nt 5.0") > -1)
    {
      return false;
    }
    return true;
  } else {
    return false;
  }
}

if (window.attachEvent)
    window.attachEvent("onload", ieupdate)
else if (document.getElementById)
    womAdd('ieupdate()');