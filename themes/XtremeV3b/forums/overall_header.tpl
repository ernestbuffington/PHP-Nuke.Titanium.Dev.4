{META}

<script type="text/javascript">
function postThank(method)
{
	(function($)
	{
		var showThank = (method == 'show') ? 'block' : 'none';
		var hideThank = (method == 'show') ? 'none' : 'block';		
		$('#show_thank').css('display', showThank);
		$('#hide_thank').css('display', hideThank);
	})(jQuery);
}

// nuke_jq(function($) {
//     $('.dmarquee').doDMarquee();
// });
</script>

<!-- Start add - Advanced time management MOD -->
<!-- BEGIN switch_send_pc_dateTime -->
<script type="text/javascript">
//<![CDATA[
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
//]]>
</script>
<!-- END switch_send_pc_dateTime -->
<!-- End add - Advanced time management MOD -->

<a name="top"></a>
<table style="margin: auto; width: 680px; table-layout: fixed;" cellpadding="1" cellspacing="4" border="0">
  <tr>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_main.png">
        </span>
        <a href="{U_INDEX}" class="mainmenu">{L_MINI_INDEX}</a>
    </td>    
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_members.png">
        </span>
        <a href="{U_MEMBERLIST}" class="mainmenu">{L_MEMBERLIST}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_search.png">
        </span>
        <a href="{U_SEARCH}" class="mainmenu">{L_SEARCH}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_groups.png">
        </span>
        <a href="{U_GROUP_CP}" class="mainmenu">{L_USERGROUPS}</a>
    </td>    
  </tr>
  <tr>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_ranks.png">
        </span>
        <a href="{U_RANKS}" class="mainmenu">{L_RANKS}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_staff.png">
        </span>
        <a href="{U_STAFF}" class="mainmenu">{L_STAFF}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_stats.png">
        </span>
        <a href="{U_STATISTICS}" class="mainmenu">{L_STATISTICS}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_faq.png">
        </span>
        <a href="{U_FAQ}" class="mainmenu">{L_FAQ}</a>
    </td>
  </tr>

  <tr>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_rules.png">
        </span>
        <a href="{U_RULES}" class="mainmenu">{L_RULES}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_profile.png">
        </span>
        <a href="{U_PROFILE}" class="mainmenu">{L_PROFILE}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_message.png">
        </span>
        <a href="{U_PRIVATEMSGS}" class="mainmenu">{PRIVATE_MESSAGE_INFO}</a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/{THEME_NAME}/forums/images/links/icon_mini_login.png">
        </span>
        <a href="{U_LOGIN_LOGOUT}" class="mainmenu">{L_LOGIN_LOGOUT}</a>
    </td>
  </tr>
</table>
	
<!-- BEGIN boarddisabled -->
  <br /><div align="center"><span class="gen"><strong>{L_BOARD_CURRENTLY_DISABLED}</strong></span></div><br />
<!-- END boarddisabled -->
<!-- Quick Search -->
<!-- BEGIN switch_quick_search -->
<br /><script type="text/javascript">
<!--
function checkSearch()
{
    {switch_quick_search.CHECKSEARCH}
    else
    {
        return true;
    }
}
//-->
</script>

<div align="center">
<form name="search_block" method="post" action="{U_SEARCH}" onsubmit="return checkSearch()">
<input type="hidden" name="search_fields" value="all" />
<input type="hidden" name="show_results" value="topics" />
<table border="0" cellpadding="4" cellspacing="1" class="center col-12">
  <tr>
    <td>{switch_quick_search.L_QUICK_SEARCH_FOR} <input class="post" type="text" name="search_keywords" size="15" /> {switch_quick_search.L_QUICK_SEARCH_AT} 
        <select name="site_search">
            {switch_quick_search.SEARCHLIST}
        </select>
        <input class="mainoption" type="submit" value="{L_SEARCH}" />
    </td>
  </tr>
</table>
</form>
</div>
<!-- END switch_quick_search -->
<br />