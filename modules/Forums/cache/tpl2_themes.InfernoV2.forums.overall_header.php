<?php

// eXtreme Styles mod cache. Generated on Wed, 24 Mar 2021 09:28:46 +0000 (time=1616578126)

?><?php echo isset($this->vars['META']) ? $this->vars['META'] : $this->lang('META'); ?>

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
<?php

$switch_send_pc_dateTime_count = ( isset($this->_tpldata['switch_send_pc_dateTime.']) ) ?  sizeof($this->_tpldata['switch_send_pc_dateTime.']) : 0;
for ($switch_send_pc_dateTime_i = 0; $switch_send_pc_dateTime_i < $switch_send_pc_dateTime_count; $switch_send_pc_dateTime_i++)
{
 $switch_send_pc_dateTime_item = &$this->_tpldata['switch_send_pc_dateTime.'][$switch_send_pc_dateTime_i];
 $switch_send_pc_dateTime_item['S_ROW_COUNT'] = $switch_send_pc_dateTime_i;
 $switch_send_pc_dateTime_item['S_NUM_ROWS'] = $switch_send_pc_dateTime_count;

?>
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

<a name="top"></a>
<table style="margin: auto; width: 680px; table-layout: fixed;" cellpadding="1" cellspacing="4" border="0">
  <tr>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_main.png">
        </span>
        <a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="mainmenu"><?php echo isset($this->vars['L_MINI_INDEX']) ? $this->vars['L_MINI_INDEX'] : $this->lang('L_MINI_INDEX'); ?></a>
    </td>    
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_members.png">
        </span>
        <a href="<?php echo isset($this->vars['U_MEMBERLIST']) ? $this->vars['U_MEMBERLIST'] : $this->lang('U_MEMBERLIST'); ?>" class="mainmenu"><?php echo isset($this->vars['L_MEMBERLIST']) ? $this->vars['L_MEMBERLIST'] : $this->lang('L_MEMBERLIST'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_search.png">
        </span>
        <a href="<?php echo isset($this->vars['U_SEARCH']) ? $this->vars['U_SEARCH'] : $this->lang('U_SEARCH'); ?>" class="mainmenu"><?php echo isset($this->vars['L_SEARCH']) ? $this->vars['L_SEARCH'] : $this->lang('L_SEARCH'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_groups.png">
        </span>
        <a href="<?php echo isset($this->vars['U_GROUP_CP']) ? $this->vars['U_GROUP_CP'] : $this->lang('U_GROUP_CP'); ?>" class="mainmenu"><?php echo isset($this->vars['L_USERGROUPS']) ? $this->vars['L_USERGROUPS'] : $this->lang('L_USERGROUPS'); ?></a>
    </td>    
  </tr>
  <tr>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_ranks.png">
        </span>
        <a href="<?php echo isset($this->vars['U_RANKS']) ? $this->vars['U_RANKS'] : $this->lang('U_RANKS'); ?>" class="mainmenu"><?php echo isset($this->vars['L_RANKS']) ? $this->vars['L_RANKS'] : $this->lang('L_RANKS'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_staff.png">
        </span>
        <a href="<?php echo isset($this->vars['U_STAFF']) ? $this->vars['U_STAFF'] : $this->lang('U_STAFF'); ?>" class="mainmenu"><?php echo isset($this->vars['L_STAFF']) ? $this->vars['L_STAFF'] : $this->lang('L_STAFF'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_stats.png">
        </span>
        <a href="<?php echo isset($this->vars['U_STATISTICS']) ? $this->vars['U_STATISTICS'] : $this->lang('U_STATISTICS'); ?>" class="mainmenu"><?php echo isset($this->vars['L_STATISTICS']) ? $this->vars['L_STATISTICS'] : $this->lang('L_STATISTICS'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_faq.png">
        </span>
        <a href="<?php echo isset($this->vars['U_FAQ']) ? $this->vars['U_FAQ'] : $this->lang('U_FAQ'); ?>" class="mainmenu"><?php echo isset($this->vars['L_FAQ']) ? $this->vars['L_FAQ'] : $this->lang('L_FAQ'); ?></a>
    </td>
  </tr>

  <tr>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_rules.png">
        </span>
        <a href="<?php echo isset($this->vars['U_RULES']) ? $this->vars['U_RULES'] : $this->lang('U_RULES'); ?>" class="mainmenu"><?php echo isset($this->vars['L_RULES']) ? $this->vars['L_RULES'] : $this->lang('L_RULES'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_profile.png">
        </span>
        <a href="<?php echo isset($this->vars['U_PROFILE']) ? $this->vars['U_PROFILE'] : $this->lang('U_PROFILE'); ?>" class="mainmenu"><?php echo isset($this->vars['L_PROFILE']) ? $this->vars['L_PROFILE'] : $this->lang('L_PROFILE'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_message.png">
        </span>
        <a href="<?php echo isset($this->vars['U_PRIVATEMSGS']) ? $this->vars['U_PRIVATEMSGS'] : $this->lang('U_PRIVATEMSGS'); ?>" class="mainmenu"><?php echo isset($this->vars['PRIVATE_MESSAGE_INFO']) ? $this->vars['PRIVATE_MESSAGE_INFO'] : $this->lang('PRIVATE_MESSAGE_INFO'); ?></a>
    </td>
    <td style="text-align: left; width: 170px;">
        <span style="display:inline-block; vertical-align:middle; margin-top: -4px;">
            <img src="themes/<?php echo isset($this->vars['THEME_NAME']) ? $this->vars['THEME_NAME'] : $this->lang('THEME_NAME'); ?>/forums/images/links/icon_mini_login.png">
        </span>
        <a href="<?php echo isset($this->vars['U_LOGIN_LOGOUT']) ? $this->vars['U_LOGIN_LOGOUT'] : $this->lang('U_LOGIN_LOGOUT'); ?>" class="mainmenu"><?php echo isset($this->vars['L_LOGIN_LOGOUT']) ? $this->vars['L_LOGIN_LOGOUT'] : $this->lang('L_LOGIN_LOGOUT'); ?></a>
    </td>
  </tr>
</table>
	
<?php

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
<br /><script type="text/javascript">
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

<div align="center">
<form name="search_block" method="post" action="<?php echo isset($this->vars['U_SEARCH']) ? $this->vars['U_SEARCH'] : $this->lang('U_SEARCH'); ?>" onsubmit="return checkSearch()">
<input type="hidden" name="search_fields" value="all" />
<input type="hidden" name="show_results" value="topics" />
<table border="0" cellpadding="4" cellspacing="1" class="wtf col-12">
  <tr>
    <td align="center"><?php echo isset($switch_quick_search_item['L_QUICK_SEARCH_FOR']) ? $switch_quick_search_item['L_QUICK_SEARCH_FOR'] : ''; ?> <input class="post" type="text" name="search_keywords" size="15" /> <?php echo isset($switch_quick_search_item['L_QUICK_SEARCH_AT']) ? $switch_quick_search_item['L_QUICK_SEARCH_AT'] : ''; ?> 
        <select name="site_search">
            <?php echo isset($switch_quick_search_item['SEARCHLIST']) ? $switch_quick_search_item['SEARCHLIST'] : ''; ?>
        </select>
        <input class="mainoption" type="submit" value="<?php echo isset($this->vars['L_SEARCH']) ? $this->vars['L_SEARCH'] : $this->lang('L_SEARCH'); ?>" />
    </td>
  </tr>
</table>
</form>
</div>
<?php

} // END switch_quick_search

if(isset($switch_quick_search_item)) { unset($switch_quick_search_item); } 

?>
<br />