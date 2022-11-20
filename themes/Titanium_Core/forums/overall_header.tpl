{META}
<script>
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
<script>
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
<a name="top"></a><!-- BEGIN boarddisabled -->
  <br /><div align="center"><span class="gen"><strong>{L_BOARD_CURRENTLY_DISABLED}</strong></span></div><br />
<!-- END boarddisabled -->
<!-- Quick Search -->
<!-- BEGIN switch_quick_search -->
<br /><script>
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
<!-- END switch_quick_search -->
