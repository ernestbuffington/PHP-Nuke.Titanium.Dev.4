<!-- BEGIN ban_home -->
<script language="javascript">
<!-- BEGIN new_ban -->
function newban(){
	forms('{NEW_BAN}','{L_NEW_BAN}');
	tijd('{ban_home.new_ban.d}','{ban_home.new_ban.m}','{ban_home.new_ban.Y}','{ban_home.new_ban.i}','{ban_home.new_ban.s}','{ban_home.new_ban.g}');	
}
<!-- END new_ban -->
<!-- BEGIN ban -->
function edit{ban_home.ban.ID}(url){
	forms(url,'{L_EDIT}','{ban_home.ban.ban_id}','{ban_home.ban.ban_username}','{ban_home.ban.ban_ip}','{ban_home.ban.ban_email}','{ban_home.ban.reason}','{ban_home.ban.time}','{ban_home.ban.reason_private}','{ban_home.ban.ban_cookie}');
<!-- BEGIN edit_ban -->
	tijd('{ban_home.ban.edit_ban.d}','{ban_home.ban.edit_ban.m}','{ban_home.ban.edit_ban.Y}','{ban_home.ban.edit_ban.i}','{ban_home.ban.edit_ban.s}','{ban_home.ban.edit_ban.g}');	
<!-- END edit_ban -->
}
<!-- END ban -->

function view(id,url){
	window.open(url, '_phpbbview', 'HEIGHT=250,resizable=yes,WIDTH=400');
}
function forms(act,tit,ban_id,ban_username,ban_ip,ban_email,reason,time,reason_private,cookie){
	if(act == undefined){ return }
	if(tit == undefined){ return }
	if(ban_id == undefined){ ban_id = 0; }
	if(ban_username == undefined){ ban_username = ''; }
	if(ban_ip == undefined){ ban_ip = ''; }
	if(ban_email == undefined){ ban_email = ''; }
	if(reason == undefined){ reason = ''; }
	if(time == undefined){ time = 0; }
	if(reason_private == undefined){ reason_private = ''; }
	if(cookie == undefined){ cookie == 1;}
	form = document.getElementById('ban_form');
	form.action = act;
	form.ban_id.value = ban_id;
	form.username.value = ban_username;
	form.ban_ip.value = ban_ip;
	form.ban_email.value = ban_email;
	form.reason.value = reason;
	form.time.value = time;
	if(time == 0){
		form.perm.checked = true;
	}
	form.reason_private.value = reason_private;
	if(cookie == 1){
		form.ban_cookie.checked = true;
	}
	document.getElementById('form_titel').innerHTML = tit;
	form.style.display = 'block';
}

function tijd(d,m,Y,i,s,g){
	form = document.getElementById('ban_form');
	var t = new Array();
	t['month'] = parseFloat(m);
	t['day'] = parseFloat(d);
	t['year'] = parseFloat(Y);
	t['hours'] = parseFloat(g);
	t['minute'] = parseFloat(i);
	t['seconds'] = parseFloat(s);
	form.month.options[0].selected  = true;
	form.day.options[0].selected  = true;
	form.year.options[0].selected  = true;
	form.hour.options[0].selected  = true;
	form.minute.options[0].selected  = true;
	form.seconds.options[0].selected  = true;
	for(i=0;i<form.month.options.length;i++){
		if(form.month.options[i].value == t['month']){
			form.month.options[i].selected = true;
			break;
		}
	}
	for(i=0;i<form.day.options.length;i++){
		if(form.day.options[i].value == t['day']){
			form.day.options[i].selected = true;
			break;
		}
	}
	for(i=0;i<form.year.options.length;i++){
		if(form.year.options[i].value == t['year']){
			form.year.options[i].selected = true;
			break;
		}
	}
	for(i=0;i<form.hour.options.length;i++){
		if(form.hour.options[i].value == t['hours']){
			form.hour.options[i].selected = true;
			break;
		}
	}
	for(i=0;i<form.minute.options.length;i++){
		if(form.minute.options[i].value == t['minute']){
			form.minute.options[i].selected = true;
			break;
		}
	}			
	for(i=0;i<form.seconds.options.length;i++){
		if(form.seconds.options[i].value == t['seconds']){
			form.seconds.options[i].selected = true;
			break;
		}
	}	
	if(form.year.options.selectedIndex == 0){
		form.year.options[form.year.options.length] = new Option(" "+t['year']+" ",t['year'],false,true);
	}
}
function hide(form){
	form.style.display = 'none';
}
function times(id){
	document.getElementById("datetracker").innerHTML = id;
	document.getElementById("datetracker").style.display = 'block';
	setTimeout('document.getElementById("datetracker").style.display = "none";',10000);
}
function deleteIt(id){
	if(confirm('{L_DELETE2}')){
		return true;
	}
}
</script>
<h1>{L_BAN_TITLE}</h1>

<p>{L_BAN_EXPLAIN}</p>
<!-- END ban_home -->
<form method="post" name="post" id="ban_form" style="display:none; ">
<table width="100%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
<tr>
  <th colspan="2">
  <div id="form_titel"></div>
  </th>
</tr>
<tr>
  <td class="row1">
  {L_USERNAME} <br><span class="gensmall">{L_USERNAME_EXPLAIN}</span>
  </td>
  <td class="row2">
  <input name="username" type="text" id="username">
  <input name="ban_id" type="hidden" id="ban_id">
  <input type="submit" name="usersubmit" value="{L_FIND_USERNAME}" class="liteoption" onclick="window.open('{U_SEARCH_USER}', '_phpbbsearch', 'HEIGHT=250,resizable=yes,WIDTH=400');return false;" />
  </td>
</tr>
<tr>
  <td class="row1">
    {L_IP}<br><span class="gensmall"> {L_IP_EXPLAIN} </span>   
  </td>
  <td class="row2">
  <input name="ban_ip" type="text" id="ban_ip">
  </td>
</tr>
<tr>
  <td class="row1">
   {L_EMAIL_ADDRESS}<br><span class="gensmall">{L_EMAIL_ADDRESS_EXPLAIN}</span>   
  </td>
  <td class="row2">
    <input name="ban_email" type="text" id="ban_email">
  </td>
</tr>
<tr>
  <td class="row1">
    {L_REASON}<br><span class="gensmall">{L_REASON_EXPLAIN}</span>
  </td>
  <td class="row2">
    <textarea name="reason" cols="50" rows="10" id="reason"></textarea></td>
</tr>
<tr>
  <td class="row1">
    {L_REASON_PRIVATE}<br><span class="gensmall">{L_REASON_PRIVATE_EXPLAIN}</span>
  </td>
  <td class="row2"><textarea name="reason_private" cols="50" rows="10" id="reason_private"></textarea></td>
</tr>
<tr>
  <td class="row1">
    {L_TIME}<br><span class="gensmall">{L_TIME_EXPLAIN}</span>
  </td>
  <td class="row2">{DAY}<br><br>{MONTH}<br><br>{YEAR}<br><br>{HOUR}<br><br>{MIN}<br><br>{SEC}<br>
  <input name="time" type="hidden" id="time"><label for="perm">
        <input name="perm" type="checkbox" id="perm" value="1">
        {L_PERM_BAN}</label></td>
</tr>
<tr>
   <td CLASS="row1" COLSPAN="2">
     <label for="ban_cookie"><INPUT TYPE="checkbox" CHECKED name="ban_cookie" id="ban_cookie" value="1" />{L_BAN_COOKIE}</label>
   </td>
</tr>
	<tr> 
	  <td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />  <input type="reset" value="{L_RESET}" class="liteoption" />  
      <input type="button" name="Button" value="{L_HIDE}" onclick="hide(this.form);" class="liteoption" >  </td>
	</tr>
</table>
</form>
<!-- BEGIN ban_home -->
<form method="post" name="post" action="{S_BANLIST_ACTION}&start={START}&act=delmulti">
<div id="datetracker" style="display:none;"></div>
  <table width="100%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
    <tr>
      <th class="thTop">{L_USERNAME}</th>
      <th class="thTop">{L_IP_AND_HOSTNAME}</th>
      <th class="thTop">{L_EMAIL_ADDRESS}</th>
      <th class="thTop">{L_REASON}</th>
      <th class="thTop">{L_TIME}</th>
	  <th class="thTop">{L_BY}</th>
      <th class="thTop">{L_VIEW_VALUE}</th>
      <th class="thTop">{L_EDIT}</th>
      <th class="thTop">{L_DELETE}</th>
	  <th class="thTop">{L_COOKIE}</th>
	  <th class="thTop"><input name="delmulti" type="submit" value="{L_DEL_MULTI}"></th>
    </tr>
	<!-- BEGIN ban -->
    <tr>
      <td class="row1">{ban_home.ban.USERNAME}</td>
      <td class="row2">{ban_home.ban.IP} {ban_home.ban.HOSTNAME}</td>
      <td class="row1"><a href="mailto:{ban_home.ban.EMAIL}">{ban_home.ban.EMAIL}</a></td>
      <td class="row2">{ban_home.ban.REASON}</td>
      <td class="row1">{ban_home.ban.TIME}</td>
      <td class="row2"><a href="{ban_home.ban.BY_PRO}">{ban_home.ban.BY}</a></td>
      <td class="row1"><a href="javascript:view({ban_home.ban.ID},'{ban_home.ban.VIEW_ACT}');">{L_VIEW_VALUE}</a></td>
      <td class="row2"><a href="javascript:edit{ban_home.ban.ID}('{ban_home.ban.EDIT_ACT}');">{L_EDIT}</a></td>
	  <td class="row1"><a href="{ban_home.ban.DELETE_ACT}" onclick="return deleteIt({ban_home.ban.ID});">{L_DELETE}</a></td>
	  <td class="row2">{ban_home.ban.COOKIE_BAN}</td>
	  <td class="row1"><input type="checkbox" name="deletelist[]" value="{ban_home.ban.ID}"></td>
    </tr>
	<!-- END ban -->
	<!-- BEGIN no_ban -->
	<tr>
	 <td align="center" colspan="11">{ban_home.no_ban.L_NO_BAN}</td>
	</tr>
	<!-- END no_ban -->
	<tr>
	<td class="row1" colspan="11">{L_COOKIE_EXP}</td>
	</tr>
	<tr>
	<td class="row2" colspan="11">{L_VERSION_CHECKER}</td>
	</tr>
	<tr><td class="row1" colspan="11">{PAG}</td>
	</tr>
	<tr> 
	  <td class="catBottom" colspan="11" align="center">{MODE}{SORT}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />  
      <input type="button" name="Button" value="{L_NEW_BAN}" class="mainoption" onclick="newban();" /> 
	  <input type="button" name="Button" value="{L_BOT_BAN}" class="mainoption" onclick="location.href= '{U_BAN_BOT}';" /></td>
	</tr>	
  </table>
</form>
<p>{L_BAN_EXPLAIN_WARN}</p>
<!-- END ban_home -->
<!-- BEGIN banlist -->
<table width="100%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
<tr>
<th colspan="4" class="thTop">{L_BANLIST}</th>
</tr>
<tr>
    <th class="thTop">{L_USERNAME}</th>    <th class="thTop">{L_IP}</th>    <th class="thTop">{L_EMAIL}</th>
    <th class="thTop">{L_REASON}</th>
</tr>
<!-- BEGIN row -->
<tr>
<td class="row1">{banlist.row.USERNAME}</td>
<td class="row2">{banlist.row.IP}</td>
<td class="row1">{banlist.row.EMAIL}</td>
<td class="row2">{banlist.row.REASON}</td>
</tr>
<!-- END row -->
</table>
<!-- END banlist -->