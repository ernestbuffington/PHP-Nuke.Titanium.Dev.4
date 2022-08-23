function GetCookie(name) {
  var arg=name+"=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i  = 0;
  while (i < clen) {
    var j = i + alen;
    if (document.cookie.substring(i,j) == arg)
      return getCookieVal (j);
    i = document.cookie.indexOf(" ", i) + 1;
    if (i == 0) break;
  }
  return null;
}

function getCookieVal (offset) {
   var endstr = document.cookie.indexOf (";", offset);
     if (endstr == 1)
       endstr = document.cookie.length;
     return unescape(document.cookie.substring(offset, endstr));
}

function SetCookie (name, value, expires) {
  var exp = new Date();
  var expiro = (exp.getTime() + (24 * 60 * 60 * 1000 * expires));
  exp.setTime(expiro);
  var expstr = "; expires=" + exp.toGMTString();
  document.cookie = name + "=" + escape(value) + expstr;
}

function DeleteCookie(name){
  if (GetCookie(name)) {
    document.cookie = name + "=" + "; expires = Thu, 01-Jan-70 00:00:01 GMT";
  }
}

var imagepath = "images/";
////////////////////////////////////
blockarray = new Array();
var blockarrayint = -1;

function doblocks(imgpath) {
  if (imgpath != null) imagepath = imgpath;
  for (var q = 0; q < blockarray.length; q++) {
    xyzswitch(blockarray[q]);
  }
}

function xswitch(listID) {
  if(listID.style.display=="none") {
    listID.style.display="";
  } else {
    listID.style.display="none";
  }
}

function icoswitch(bid) {
  icoID = document.getElementById('pic'+bid);
  if(icoID.src.indexOf("minus") != -1) {
    icoID.src = imagepath+"plus.gif";
    SetCookie('block'+bid,'yes',365);
  } else {
    icoID.src = imagepath+"minus.gif";
    DeleteCookie('block'+bid);
  }
}

function xyzswitch(bid) {
    xswitch(document.getElementById('ph'+bid));
    xswitch(document.getElementById('pe'+bid));
    icoswitch(bid);
}

function addblock(bid) {
    var blockopen=GetCookie('block'+bid);
    if (blockopen != null) {
        blockarrayint += 1;
        blockarray[blockarrayint] = bid;
    }
}

////////////////////////////////////
var hiddenblocks = new Array();
var blocks = GetCookie('hiddenblocks');
if (blocks != null) {
  var hidden = blocks.split(":");
  for (var loop = 0; loop < hidden.length; loop++) {
    var hiddenblock = hidden[loop];
    hiddenblocks[hiddenblock] = hiddenblock;
  }
}

function blockswitch(bid) {
  var bph  = document.getElementById('ph'+bid);
  var bpe  = document.getElementById('pe'+bid);
  var bico = document.getElementById('pic'+bid);
  if (bph.style.display=="none") {
    bph.style.display="";
    bpe.style.display="none";
    hiddenblocks[bid] = bid;
    bico.src = imagepath+"plus.gif";
  } else {
    bph.style.display="none";
    bpe.style.display="";
    hiddenblocks[bid] = null;
    bico.src = imagepath+"minus.gif";
  }
  var cookie = null;
  for (var q = 1; q < hiddenblocks.length; q++) {
    if (hiddenblocks[q] != null) {
      if (cookie != null) {
        cookie = (cookie+":"+hiddenblocks[q]);
      } else {
        cookie = hiddenblocks[q];
      }
    }
  }
  if (cookie != null) {
    SetCookie('hiddenblocks', cookie, 365);
  } else {
    DeleteCookie('hiddenblocks');
  }
}