/*
Scroller
FairSky Pages Component
-----------------------
Copyright 2004 Joshua Paine
Created by Joshua Paine of FairSky Networks <http://fairsky.us/>
Contact at <http://fairsky.us/contact>
Updated 2005-08-10

The latest version should be available at
<http://demo.fairsky.us/javascript/scroller.html>

You may copy, reuse, or produce derivative works of this code
only under the terms of the Linky License v0.1 or later.
The Linky License can be found at <http://fairsky.us/linky>.
The main points of the license are:
	1) Do not alter or remove this notice.
	2) Notify me of your usage through one of the means listed
	   at <http://fairsky.us/contact>.
*/

var gScrollers = new Array();
var gScrollerDefaultDelay = 60;
var gScrollerDefaultIncrement = 1;
var gScrollerTimeouts = new Array();

function scrollerLoad()
{
	var pos;
	if(window.getComputedStyle && (pos = window.getComputedStyle(this,null).position))
		if(pos!=="absolute" && pos!=="fixed") this.style.position = "relative";
	else if(this.currentStyle && (pos = this.currentStyle.position))
		if(pos!=="absolute" && pos!=="fixed") this.style.position = "relative";
	while(!this.id || gScrollers[this.id]) this.id="a"+Math.floor(10000 * Math.random());
	gScrollers[this.id] = this;
	this.scrollIncrement = this.className.match(/Scroller\.Increment:([0-9]+)/);
	if(this.scrollIncrement && this.scrollIncrement[1]) this.scrollIncrement = 1*this.scrollIncrement[1];
	else this.scrollIncrement = gScrollerDefaultIncrement;
	this.scrollDelay = this.className.match(/Scroller\.Delay:([0-9]+)/);
	if(this.scrollDelay && this.scrollDelay[1]) this.scrollDelay = 1*this.scrollDelay[1];
	else this.scrollDelay = gScrollerDefaultDelay;
	this.style.overflow = "hidden";
	this.scrollChild = this.getElementsByTagName("*").item(0);
	this.scrollChild.style.position = "absolute";
	this.scrollCurrent = Math.round(this.clientHeight * 0.9);
	this.pauseScroll = scrollerOver;
	this.resumeScroll = scrollerOut;
	this.scrollChild.style.top = this.scrollCurrent + "px";
	moveScroller(this.id);
}

function moveScroller(id)
{
	var s;
	if(gScrollers && (s = gScrollers[id]))
	{
		s.scrollCurrent = s.scrollCurrent-s.scrollIncrement;
		if(s.scrollCurrent < (-1 * s.scrollChild.clientHeight)) s.scrollCurrent = (s.clientHeight);
		s.scrollChild.style.top = s.scrollCurrent + "px";
		setScrollTimeout(id);
	}
}

function scrollerOver()
{
	if(this.id && gScrollerTimeouts && gScrollerTimeouts[this.id]) clearTimeout(gScrollerTimeouts[this.id]);
}

function scrollerOut()
{
	if(this.id && gScrollers && gScrollers[this.id])
		setScrollTimeout(this.id);
}

function setScrollTimeout(id)
{
	gScrollerTimeouts[id] = setTimeout("clearTimeout(gScrollerTimeouts['"+id+"']);moveScroller('"+id+"');",gScrollers[id].scrollDelay);
}

function pauseAllScrollers()
{
	for(var x=0; x<gScrollers.length; x++) gScrollers[x].onMouseOver();
}

function resumeAllScrollers()
{
	for(var x=0; x<gScrollers.length; x++) gScrollers[x].onMouseOut();
}

document.register('div','Scroller',scrollerLoad,'load',false);
document.register('div','Scroller',scrollerOver,'mouseover',true);
document.register('div','Scroller',scrollerOut,'mouseout',true);