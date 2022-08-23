// JavaScript Document// Make Visible für Bildaufleuchten
function makevisible(cur,which){
strength=(which==0)? 1 : 0.6

if (cur.style.MozOpacity)
cur.style.MozOpacity=strength
else if (cur.filters)
cur.filters.alpha.opacity=strength*100
}

function hover (feld, Bild) {
	feld.style.backgroundImage="url(images/" + Bild + ")";
}

function dehover (feld, Bild) {
	feld.style.backgroundImage="url(images/" + Bild + ")";
}