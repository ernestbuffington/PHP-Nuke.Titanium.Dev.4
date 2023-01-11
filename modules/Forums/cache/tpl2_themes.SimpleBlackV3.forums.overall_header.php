<?php

// eXtreme Styles mod cache. Generated on Wed, 21 Dec 2022 15:47:33 +0000 (time=1671637653)

?><?php echo isset($this->vars['META']) ? $this->vars['META'] : $this->lang('META'); ?>
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
<?php

$switch_send_pc_dateTime_count = ( isset($this->_tpldata['switch_send_pc_dateTime.']) ) ?  sizeof($this->_tpldata['switch_send_pc_dateTime.']) : 0;
for ($switch_send_pc_dateTime_i = 0; $switch_send_pc_dateTime_i < $switch_send_pc_dateTime_count; $switch_send_pc_dateTime_i++)
{
 $switch_send_pc_dateTime_item = &$this->_tpldata['switch_send_pc_dateTime.'][$switch_send_pc_dateTime_i];
 $switch_send_pc_dateTime_item['S_ROW_COUNT'] = $switch_send_pc_dateTime_i;
 $switch_send_pc_dateTime_item['S_NUM_ROWS'] = $switch_send_pc_dateTime_count;

?>
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
            if ( href.indexOf('<?php echo isset($this->vars['U_SELF']) ? $this->vars['U_SELF'] : $this->lang('U_SELF'); ?>') == 0 ) {
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
<?php

} // END switch_send_pc_dateTime

if(isset($switch_send_pc_dateTime_item)) { unset($switch_send_pc_dateTime_item); } 

?>
<!-- End add - Advanced time management MOD -->
<a name="top"></a><?php

$boarddisabled_count = ( isset($this->_tpldata['boarddisabled.']) ) ?  sizeof($this->_tpldata['boarddisabled.']) : 0;
for ($boarddisabled_i = 0; $boarddisabled_i < $boarddisabled_count; $boarddisabled_i++)
{
 $boarddisabled_item = &$this->_tpldata['boarddisabled.'][$boarddisabled_i];
 $boarddisabled_item['S_ROW_COUNT'] = $boarddisabled_i;
 $boarddisabled_item['S_NUM_ROWS'] = $boarddisabled_count;

?>
  <br /><div align="center"><span class="gen"><strong><?php echo isset($this->vars['L_BOARD_CURRENTLY_DISABLED']) ? $this->vars['L_BOARD_CURRENTLY_DISABLED'] : $this->lang('L_BOARD_CURRENTLY_DISABLED'); ?></strong></span></div><br />
<?php

} // END boarddisabled

if(isset($boarddisabled_item)) { unset($boarddisabled_item); } 

?>
<!-- Quick Search -->
<?php

$switch_quick_search_count = ( isset($this->_tpldata['switch_quick_search.']) ) ?  sizeof($this->_tpldata['switch_quick_search.']) : 0;
for ($switch_quick_search_i = 0; $switch_quick_search_i < $switch_quick_search_count; $switch_quick_search_i++)
{
 $switch_quick_search_item = &$this->_tpldata['switch_quick_search.'][$switch_quick_search_i];
 $switch_quick_search_item['S_ROW_COUNT'] = $switch_quick_search_i;
 $switch_quick_search_item['S_NUM_ROWS'] = $switch_quick_search_count;

?>
<br /><script>
<!--
function checkSearch()
{
    <?php echo isset($switch_quick_search_item['CHECKSEARCH']) ? $switch_quick_search_item['CHECKSEARCH'] : ''; ?>
    else
    {
        return true;
    }
}
//-->
</script>
<?php

} // END switch_quick_search

if(isset($switch_quick_search_item)) { unset($switch_quick_search_item); } 

?>
