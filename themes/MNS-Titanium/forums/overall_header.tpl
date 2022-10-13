{META}
<!-- start mod : Resize Posted Images Based on Max Width -->
<script type="text/javascript">
//<![CDATA[
<!--

var rmw_max_width = {IMAGE_RESIZE_WIDTH}; // you can change this number, this is the max width in pixels for posted images
var rmw_max_height = {IMAGE_RESIZE_HEIGHT}; // you can change this number, this is the max height in pixels for posted images
var rmw_border_1 = '1px solid {T_BODY_LINK}';
var rmw_border_2 = '2px dotted {T_BODY_LINK}';
var rmw_image_title = '{L_RMW_IMAGE_TITLE}';

//-->
//]]>
</script>
<script type="text/javascript" src="{U_RMW_JSLIB}"></script>
<!-- fin mod : Resize Posted Images Based on Max Width -->
<!-- BEGIN switch_enable_pm_popup -->
<script type="text/javascript">
<!--
    if ( {PRIVATE_MESSAGE_NEW_FLAG} )
    {
        window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
    }
//-->
</script>
<!-- END switch_enable_pm_popup -->
<!-- Start add - Advanced time management MOD -->
<!-- BEGIN switch_send_pc_dateTime -->
<script type="text/javascript">
<!-- Start Replace - window.onload = send_pc_dateTime -->
send_pc_dateTime();
<!-- End Replace - window.onload = send_pc_dateTime -->

function send_pc_dateTime() {
    var pc_dateTime = new Date()
    pc_timezoneOffset = pc_dateTime.getTimezoneOffset()*(-60);
    pc_date = pc_dateTime.getFullYear()*10000 + (pc_dateTime.getMonth()+1)*100 + pc_dateTime.getDate();
    pc_time = pc_dateTime.getHours()*3600 + pc_dateTime.getMinutes()*60 + pc_dateTime.getSeconds();

    for ( i = 0; document.links.length > i; i++ ) {
        with ( document.links[i] ) {
            if ( href.indexOf('{U_SELF}') == 0 ) {
                textLink = '' + document.links[i].firstChild.data
                if ( textLink.indexOf('http://') != 0 && textLink.indexOf('www.') != 0 && (textLink.indexOf('@') == -1 || textLink.indexOf('@') == 0 || textLink.indexOf('@') == textLink.length-1 )) {
                    if ( href.indexOf('?') == -1 ) {
                        pc_data = '?pc_tzo=' + pc_timezoneOffset + '&pc_d=' + pc_date + '&pc_t=' + pc_time;
                    } else {
                        pc_data = '&pc_tzo=' + pc_timezoneOffset + '&pc_d=' + pc_date + '&pc_t=' + pc_time;
                    }
                    if ( href.indexOf('#') == -1 ) {
                        href += pc_data;
                    } else {
                        href = href.substring(0, href.indexOf('#')) + pc_data + href.substring(href.indexOf('#'), href.length);
                    }
                }
            }
        }
    }
}
</script>
<!-- END switch_send_pc_dateTime -->
<!-- End add - Advanced time management MOD -->
	
<center>
<a name="top"></a><a href="{U_INDEX}" class="forummenu">{I_MINI_INDEX}{L_MINI_INDEX}</a>
            &nbsp;&nbsp;<a href="{U_SEARCH}" class="forummenu">{I_MINI_SEARCH}{L_SEARCH}</a>
            &nbsp;&nbsp;<a href="{U_GROUP_CP}" class="forummenu">{I_MINI_USERGROUPS}{L_USERGROUPS}</a>
            &nbsp;&nbsp;<a href="{U_PROFILE}" class="forummenu">{I_MINI_PROFILE}{L_PROFILE}</a>
            &nbsp;&nbsp;<a href="{U_MEMBERLIST}" class="forummenu">{I_MINI_MEMBERLIST}{L_MEMBERLIST}</a>
            &nbsp;&nbsp;<a href="{U_PRIVATEMSGS}" class="forummenu">{I_MINI_PRIVATEMSGS}{PRIVATE_MESSAGE_INFO}</a>
            &nbsp;<a class="forummenu" href="modules.php?name=Groups">
			<img height="13" alt="Usergroups" hspace="3" src="themes/MNS-Titanium/forums/images/icon_mini_groups.gif" width="12" border="0">
			</a><a href="modules.php?name=Forums&file=buddylist" class="forummenu">Buddy List</a><br />
            &nbsp;<a href="{U_RANKS}" class="forummenu">{I_RANKS}{L_RANKS}</a>
            &nbsp;&nbsp;<a href="{U_STAFF}" class="forummenu">{I_STAFF}{L_STAFF}</a>
            &nbsp;&nbsp;<a href="{U_STATISTICS}" class="forummenu">{I_STATISTICS}{L_STATISTICS}</a>
            &nbsp;&nbsp;<a href="{U_RULES}" class="forummenu">{I_RULES}{L_RULES}</a>
            &nbsp;&nbsp;<a href="{U_FAQ}" class="forummenu">{I_MINI_FAQ}{L_FAQ}</a>
            &nbsp;&nbsp;<a href="{U_LOGIN_LOGOUT}" class="forummenu">{I_MINI_LOGIN_LOGOUT}{L_LOGIN_LOGOUT}</a></center><br />
<!-- BEGIN boarddisabled -->
  <br /><div align="center"><span class="gen"><strong>{L_BOARD_CURRENTLY_DISABLED}</strong></span></div><br />
<!-- END boarddisabled -->
