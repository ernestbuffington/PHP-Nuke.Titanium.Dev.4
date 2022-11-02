/*
Created 2004-2006 by Joshua Paine <http://letterblock.com/>
Links are appreciated. Telling me when you use this is really appreciated.
Nothing is required: I hereby place the code contained in this file in
the public domain and disclaim any and all proprietary rights to it.

See <http://demo.fairsky.us/javascript/fsp.js>
Last Update: 2006-05-25
*/

function documentRegister(tag,effect,func,ev,exclusive)
{
  document.toRegister[document.toRegister.length] = {
    tag:tag,
    effect:effect,
    func:func,
    event:ev,
    exclusive:exclusive
  };
}

function doRegister(n)
{
  if(!n) n = document;
  if(!n.fspAlreadyRegistered)
  {
    n.fspAlreadyRegistered = true;
    var t, y;
    var r = document.toRegister;
    for(var x=0; x<r.length; x++)
    {
      t = n.getElementsByTagName(r[x].tag);
      if(r[x].tag==='*' && t.length===0) t = document.all;
      for(y=0; y<t.length; y++)
      {
        if(!r[x].effect || hasClassName(t[y],"Fsp."+r[x].effect) || hasClassName(t[y],r[x].effect) || t[y].className.indexOf("Fsp."+r[x].effect+":") > -1 || t[y].className.indexOf("Fsp."+r[x].effect+".") > -1)
        {
          if(r[x].event === 'load')
          {
            t[y].load = r[x].func;
            t[y].load({ currentTarget:t[y] });
          }
          else
          {
            addEventHandler(t[y],r[x].event,r[x].func,r[x].exclusive);
          }
        }
      }
    }
  }
}

function addEventHandler(el,ev,func,exclusive)
{
  if(exclusive)
  {
    if(eval("el.on"+ev+" = func;")) return true;
    else return false;
  }
  else
  {
    if(el.addEventListener)
    {
      el.addEventListener(ev,func,false);
      return true;
    }
    else if(el.attachEvent)
    {
      el['e'+ev+func] = func;
      el[ev+func] = function(){el['e'+ev+func]( window.event );};
      return el.attachEvent( 'on'+ev, el[ev+func] );
    }
    else return false;
  }
}

function dumpProps(obj)
{
  var str, p, i, val;
  i = 0;
  str='';
  for(p in obj)
  {
    val = ''+eval('obj.'+p);
    val = val.substring(0,300);
    str += p+' = '+val+'\n';
    if(i++===15){ alert(str); str=''; i=0; }
  }
  alert(str);
}

function fspImageToolbarRemoval()
{
  this.setAttribute('galleryimg','false');
}

function addClassName(el,newClass)
{
  var ary = el.className.split(' ');
  var x=0;
  while(x<ary.length && ary[x]!==newClass) x++;
  if(x<ary.length) return false;
  else
  {
    ary[ary.length] = newClass;
    el.className = ary.join(' ');
    return true;
  }
}

function removeClassName(el,oldClass)
{
  var ary = el.className.split(' ');
  var className = new Array();
  for(var x=0; x<ary.length; x++) if(ary[x]!==oldClass) className[className.length] = ary[x];
  if(ary.length===className.length) return false;
  else
  {
    el.className = className.join(' ');
    return true;
  }
}

function replaceClassName(el,oldClass,newClass)
{
  var ary = el.className.split(' ');
  var x = 0;
  while(x<ary.length && ary[x]!==oldClass) x++;
  if(x<ary.length)
  {
    el.className = ary.join(' ');
    return true;
  }
  else return false;
}

function hasClassName(el,searchClass)
{
  var ary = el.className.split(' ');
  var x = 0;
  while(x<ary.length && ary[x]!==searchClass && ary[x].substr(0,ary[x].search(":"))!==searchClass) x++;
  return (x<ary.length);
}

document.toRegister = new Array();
document.register = documentRegister;
document.fspUpdate = doRegister;

addEventHandler(window,'DOMContentLoaded',function(){ doRegister(); },false);
addEventHandler(window,'load',function(){ doRegister(); },false);

document.register('img',null,fspImageToolbarRemoval,'load',false);

