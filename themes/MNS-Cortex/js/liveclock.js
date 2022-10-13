///////////////////////////////////////////////////////////
// "Live Clock" script (3.0)
// By Mark Plachetta (astroboy@zip.com.au)
// http://www.zip.com.au/~astroboy/liveclock/
///////////////////////////////////////////////////////////

var LC_Style=[
	"Arial",			// clock font
	"2",				// font size
	"black",			// font colour
	"black",			// background colour
	"The time is: ",	// html before time
	"",					// html after time
	300,				// clock width
	2,					// 12(1) or 24(0) hour?
	1,					// update never(0) secondly(1) minutely(2)
	3,					// no date(0) dd/mm/yy(1) mm/dd/yy(2) DDDD MMMM(3) DDDD MMMM YYYY(4)
	0,					// abbreviate days/months yes(1) no(0)
	null				// gmt offset (null to disable)
];

///////////////////////////////////////////////////////////

var LC_IE=(document.all);
var LC_NS=(document.layers);
var LC_N6=(window.sidebar);
var LC_Old=(!LC_IE && !LC_NS && !LC_N6);

var LC_Clocks=new Array();

var LC_DaysOfWeek=[
	["Sunday","Sun"],
	["Monday","Mon"],
	["Tuesday","Tue"],
	["Wednesday","Wed"],
	["Thursday","Thu"],
	["Friday","Fri"],
	["Saturday","Sat"]
];

var LC_MonthsOfYear=[
	["January","Jan"],
	["February","Feb"],
	["March","Mar"],
	["April","Apr"],
	["May","May"],
	["June","Jun"],
	["July","Jul"],
	["August","Aug"],
	["September","Sep"],
	["October","Oct"],
	["November","Nov"],
	["December","Dec"]
];

var LC_ClockUpdate=[0,1000,60000];

///////////////////////////////////////////////////////////

function LC_CreateClock(c) {
	if(LC_IE||LC_N6){clockTags='<span id="'+c.Name+'" style="width:'+c.Width+'px;background-color:'+c.BackColor+'"></span>'}
	else if(LC_NS){clockTags='<ilayer width="'+c.Width+'" bgColor="'+c.BackColor+'" id="'+c.Name+'Pos"><layer id="'+c.Name+'"></layer></ilayer>'}

	if(!LC_Old){document.write(clockTags)}
	else{LC_UpdateClock(LC_Clocks.length-1)}
}

function LC_InitializeClocks(){
	LC_OtherOnloads();
	if(LC_Old){return}
	for(i=0;i<LC_Clocks.length;i++){
		LC_UpdateClock(i);
		if (LC_Clocks[i].Update) {
			eval('var '+LC_Clocks[i].Name+'=setInterval("LC_UpdateClock("+'+i+'+")",'+LC_ClockUpdate[LC_Clocks[i].Update]+')');
		}
	}
}

function LC_UpdateClock(Clock){
	var c=LC_Clocks[Clock];

	var t=new Date();
	if(!isNaN(c.GMT)){
	var offset=t.getTimezoneOffset();
	if(navigator.appVersion.indexOf('MSIE 3') != -1){offset=offset*(-1)}
		t.setTime(t.getTime()+offset*60000);
		t.setTime(t.getTime()+c.GMT*3600000);
	}
	var day=t.getDay();
	var md=t.getDate();
	var mnth=t.getMonth();
	var hrs=t.getHours();
	var mins=t.getMinutes();
	var secs=t.getSeconds();
	var yr=t.getYear();

	if(yr<1900){yr+=1900}

	if(c.DisplayDate>=3){
		md+="";
		abbrev="th";
		if(md.charAt(md.length-2)!=1){
			var tmp=md.charAt(md.length-1);
			if(tmp==1){abbrev="st"}
			else if(tmp==2){abbrev="nd"}
			else if(tmp==3){abbrev="rd"}
		}
		md+=abbrev;
	}

	var ampm="";
	if(c.Hour12==1){
		ampm="AM";
		if(hrs>=12){ampm="PM"; hrs-=12}
		if(hrs==0){hrs=12}
	}
	if(mins<=9){mins="0"+mins}
	if(secs<=9){secs="0"+secs}

	var html = '<font color="'+c.FntColor+'" face="'+c.FntFace+'" size="'+c.FntSize+'">';
	html+=c.OpenTags;
	html+=hrs+':'+mins;
	if(c.Update==1){html+=':'+secs}
	if(c.Hour12){html+=' '+ampm}
	if(c.DisplayDate==1){html+=' '+md+'/'+(mnth+1)+'/'+yr}
	if(c.DisplayDate==2){html+=' '+(mnth+1)+'/'+md+'/'+yr}
	if(c.DisplayDate>=3){html+=' on '+LC_DaysOfWeek[day][c.Abbreviate]+', '+md+' '+LC_MonthsOfYear[mnth][c.Abbreviate]}
	if(c.DisplayDate>=4){html+=' '+yr}
	html+=c.CloseTags;
	html+='</font>';

	if(LC_NS){
		var l=document.layers[c.Name+"Pos"].document.layers[c.Name].document;
		l.open();
		l.write(html);
		l.close();
	}else if(LC_N6||LC_IE){
		document.getElementById(c.Name).innerHTML=html;
	}else{
		document.write(html);
	}
}

function LiveClock(a,b,c,d,e,f,g,h,i,j,k,l){
	this.Name='LiveClock'+LC_Clocks.length;
	this.FntFace=a||LC_Style[0];
	this.FntSize=b||LC_Style[1];
	this.FntColor=c||LC_Style[2];
	this.BackColor=d||LC_Style[3];
	this.OpenTags=e||LC_Style[4];
	this.CloseTags=f||LC_Style[5];
	this.Width=g||LC_Style[6];
	this.Hour12=h||LC_Style[7];
	this.Update=i||LC_Style[8];
	this.Abbreviate=j||LC_Style[10];
	this.DisplayDate=k||LC_Style[9];
	this.GMT=l||LC_Style[11];
	LC_Clocks[LC_Clocks.length]=this;
	LC_CreateClock(this);
}

///////////////////////////////////////////////////////////

LC_OtherOnloads=(window.onload)?window.onload:new Function;
window.onload=LC_InitializeClocks;
