<?php

// eXtreme Styles mod cache. Generated on Wed, 14 Apr 2021 11:41:06 +0000 (time=1618400466)

?><?php echo isset($this->vars['META']) ? $this->vars['META'] : $this->lang('META'); ?>
<script type="text/javascript"> 
function ismaxlength(obj){ 
var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : "" 
if (obj.getAttribute && obj.value.length>mlength) 
obj.value=obj.value.substring(0,mlength) 
} 
</script> 
<!-- start mod : Resize Posted Images Based on Max Width -->
<script type="text/javascript">
//<![CDATA[
<!--
var rmw_max_width = <?php echo isset($this->vars['IMAGE_RESIZE_WIDTH']) ? $this->vars['IMAGE_RESIZE_WIDTH'] : $this->lang('IMAGE_RESIZE_WIDTH'); ?>; // you can change this number, this is the max width in pixels for posted images
var rmw_max_height = <?php echo isset($this->vars['IMAGE_RESIZE_HEIGHT']) ? $this->vars['IMAGE_RESIZE_HEIGHT'] : $this->lang('IMAGE_RESIZE_HEIGHT'); ?>; // you can change this number, this is the max height in pixels for posted images
var rmw_border_1 = '1px solid <?php echo isset($this->vars['T_BODY_LINK']) ? $this->vars['T_BODY_LINK'] : $this->lang('T_BODY_LINK'); ?>';
var rmw_border_2 = '2px dotted <?php echo isset($this->vars['T_BODY_LINK']) ? $this->vars['T_BODY_LINK'] : $this->lang('T_BODY_LINK'); ?>';
var rmw_image_title = '<?php echo isset($this->vars['L_RMW_IMAGE_TITLE']) ? $this->vars['L_RMW_IMAGE_TITLE'] : $this->lang('L_RMW_IMAGE_TITLE'); ?>';
//-->
//]]>
</script>
<script type="text/javascript" src="<?php echo isset($this->vars['U_RMW_JSLIB']) ? $this->vars['U_RMW_JSLIB'] : $this->lang('U_RMW_JSLIB'); ?>"></script>
<!-- fin mod : Resize Posted Images Based on Max Width -->
<script type="text/javascript">
function postThank(method){
	(function($){
		var showThank = (method == 'show') ? 'block' : 'none';
		var hideThank = (method == 'show') ? 'none' : 'block';
		
		$('#show_thank').css('display', showThank);
		$('#hide_thank').css('display', hideThank);
	})(jQuery);
}

<script language="JavaScript" type="text/javascript"> 
var oMarquees = [], oMrunning, 
   oMInterv =        20,     //interval between increments 
   oMStep =          1,      //number of pixels to move between increments 
   oMDirection =     'left'; //'left' for LTR text, 'right' for RTL text 

/***     Do not edit anything after here     ***/ 

function doDMarquee() { 
   if( oMarquees.length || !document.getElementsByTagName ) { return; } 
   var oDivs = document.getElementsByTagName('div'); 
   for( var i = 0, oDiv; i < oDivs.length; i++ ) { 
      oDiv = oDivs[i]; 
      if( oDiv.className && oDiv.className.match(/\bdmarquee\b/) ) { 
         if( !( oDiv = oDiv.getElementsByTagName('div')[0] ) ) { continue; } 
         if( !( oDiv.mchild = oDiv.getElementsByTagName('div')[0] ) ) { continue; } 
         oDiv.mchild.style.cssText += ';white-space:nowrap;'; 
         oDiv.mchild.style.whiteSpace = 'nowrap'; 
         oDiv.style.height = oDiv.offsetHeight + 'px'; 
         oDiv.style.overflow = 'hidden'; 
         oDiv.style.position = 'relative'; 
         oDiv.mchild.style.position = 'absolute'; 
         oDiv.mchild.style.top = '0px'; 
         oDiv.mchild.style[oMDirection] = oDiv.offsetWidth + 'px'; 
         oMarquees[oMarquees.length] = oDiv; 
         i += 2; 
      } 
   } 
   oMrunning = setInterval('aniMarquee()',oMInterv); 
} 
function aniMarquee() { 
   var oDiv, oPos; 
   for( var i = 0; i < oMarquees.length; i++ ) { 
      oDiv = oMarquees[i].mchild; 
      oPos = parseInt(oDiv.style[oMDirection]); 
      if( oPos <= -1 * oDiv.offsetWidth ) { 
         oDiv.style[oMDirection] = oMarquees[i].offsetWidth + 'px'; 
      } else { 
         oDiv.style[oMDirection] = ( oPos - oMStep ) + 'px'; 
      } 
   } 
} 
if( window.addEventListener ) { 
   window.addEventListener('load',doDMarquee,false); 
} else if( document.addEventListener ) { 
   document.addEventListener('load',doDMarquee,false); 
} else if( window.attachEvent ) { 
   window.attachEvent('onload',doDMarquee); 
} 
</script>
 
<?php

$switch_enable_pm_popup_count = ( isset($this->_tpldata['switch_enable_pm_popup.']) ) ?  sizeof($this->_tpldata['switch_enable_pm_popup.']) : 0;
for ($switch_enable_pm_popup_i = 0; $switch_enable_pm_popup_i < $switch_enable_pm_popup_count; $switch_enable_pm_popup_i++)
{
 $switch_enable_pm_popup_item = &$this->_tpldata['switch_enable_pm_popup.'][$switch_enable_pm_popup_i];
 $switch_enable_pm_popup_item['S_ROW_COUNT'] = $switch_enable_pm_popup_i;
 $switch_enable_pm_popup_item['S_NUM_ROWS'] = $switch_enable_pm_popup_count;

?>
<script type="text/javascript">
<!--
    if ( <?php echo isset($this->vars['PRIVATE_MESSAGE_NEW_FLAG']) ? $this->vars['PRIVATE_MESSAGE_NEW_FLAG'] : $this->lang('PRIVATE_MESSAGE_NEW_FLAG'); ?> )
    {
        window.open('<?php echo isset($this->vars['U_PRIVATEMSGS_POPUP']) ? $this->vars['U_PRIVATEMSGS_POPUP'] : $this->lang('U_PRIVATEMSGS_POPUP'); ?>', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
    }
//-->
</script>
<?php

} // END switch_enable_pm_popup

if(isset($switch_enable_pm_popup_item)) { unset($switch_enable_pm_popup_item); } 

?>
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
</script>
<?php

} // END switch_send_pc_dateTime

if(isset($switch_send_pc_dateTime_item)) { unset($switch_send_pc_dateTime_item); } 

?>
<!-- End add - Advanced time management MOD -->
<a name="top"></a>
<table width="85%"  border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td ><hr /><div align ="center">
                &nbsp;<a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_INDEX']) ? $this->vars['I_MINI_INDEX'] : $this->lang('I_MINI_INDEX'); ?><?php echo isset($this->vars['L_MINI_INDEX']) ? $this->vars['L_MINI_INDEX'] : $this->lang('L_MINI_INDEX'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_SEARCH']) ? $this->vars['U_SEARCH'] : $this->lang('U_SEARCH'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_SEARCH']) ? $this->vars['I_MINI_SEARCH'] : $this->lang('I_MINI_SEARCH'); ?><?php echo isset($this->vars['L_SEARCH']) ? $this->vars['L_SEARCH'] : $this->lang('L_SEARCH'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_GROUP_CP']) ? $this->vars['U_GROUP_CP'] : $this->lang('U_GROUP_CP'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_USERGROUPS']) ? $this->vars['I_MINI_USERGROUPS'] : $this->lang('I_MINI_USERGROUPS'); ?><?php echo isset($this->vars['L_USERGROUPS']) ? $this->vars['L_USERGROUPS'] : $this->lang('L_USERGROUPS'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_PROFILE']) ? $this->vars['U_PROFILE'] : $this->lang('U_PROFILE'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_PROFILE']) ? $this->vars['I_MINI_PROFILE'] : $this->lang('I_MINI_PROFILE'); ?><?php echo isset($this->vars['L_PROFILE']) ? $this->vars['L_PROFILE'] : $this->lang('L_PROFILE'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_MEMBERLIST']) ? $this->vars['U_MEMBERLIST'] : $this->lang('U_MEMBERLIST'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_MEMBERLIST']) ? $this->vars['I_MINI_MEMBERLIST'] : $this->lang('I_MINI_MEMBERLIST'); ?><?php echo isset($this->vars['L_MEMBERLIST']) ? $this->vars['L_MEMBERLIST'] : $this->lang('L_MEMBERLIST'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_PRIVATEMSGS']) ? $this->vars['U_PRIVATEMSGS'] : $this->lang('U_PRIVATEMSGS'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_PRIVATEMSGS']) ? $this->vars['I_MINI_PRIVATEMSGS'] : $this->lang('I_MINI_PRIVATEMSGS'); ?><?php echo isset($this->vars['PRIVATE_MESSAGE_INFO']) ? $this->vars['PRIVATE_MESSAGE_INFO'] : $this->lang('PRIVATE_MESSAGE_INFO'); ?></a>
            &nbsp;<br />
            &nbsp;<a href="<?php echo isset($this->vars['U_ARCADE']) ? $this->vars['U_ARCADE'] : $this->lang('U_ARCADE'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_ARCADE']) ? $this->vars['I_MINI_ARCADE'] : $this->lang('I_MINI_ARCADE'); ?><?php echo isset($this->vars['L_ARCADE']) ? $this->vars['L_ARCADE'] : $this->lang('L_ARCADE'); ?></a>&nbsp;
                        &nbsp;<a href="<?php echo isset($this->vars['U_RANKS']) ? $this->vars['U_RANKS'] : $this->lang('U_RANKS'); ?>" class="fheader"><?php echo isset($this->vars['I_RANKS']) ? $this->vars['I_RANKS'] : $this->lang('I_RANKS'); ?><?php echo isset($this->vars['L_RANKS']) ? $this->vars['L_RANKS'] : $this->lang('L_RANKS'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_STAFF']) ? $this->vars['U_STAFF'] : $this->lang('U_STAFF'); ?>" class="fheader"><?php echo isset($this->vars['I_STAFF']) ? $this->vars['I_STAFF'] : $this->lang('I_STAFF'); ?><?php echo isset($this->vars['L_STAFF']) ? $this->vars['L_STAFF'] : $this->lang('L_STAFF'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_STATISTICS']) ? $this->vars['U_STATISTICS'] : $this->lang('U_STATISTICS'); ?>" class="fheader"><?php echo isset($this->vars['I_STATISTICS']) ? $this->vars['I_STATISTICS'] : $this->lang('I_STATISTICS'); ?><?php echo isset($this->vars['L_STATISTICS']) ? $this->vars['L_STATISTICS'] : $this->lang('L_STATISTICS'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_RULES']) ? $this->vars['U_RULES'] : $this->lang('U_RULES'); ?>" class="fheader"><?php echo isset($this->vars['I_RULES']) ? $this->vars['I_RULES'] : $this->lang('I_RULES'); ?><?php echo isset($this->vars['L_RULES']) ? $this->vars['L_RULES'] : $this->lang('L_RULES'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_FAQ']) ? $this->vars['U_FAQ'] : $this->lang('U_FAQ'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_FAQ']) ? $this->vars['I_MINI_FAQ'] : $this->lang('I_MINI_FAQ'); ?><?php echo isset($this->vars['L_FAQ']) ? $this->vars['L_FAQ'] : $this->lang('L_FAQ'); ?></a>
            &nbsp;&nbsp;<a href="<?php echo isset($this->vars['U_LOGIN_LOGOUT']) ? $this->vars['U_LOGIN_LOGOUT'] : $this->lang('U_LOGIN_LOGOUT'); ?>" class="fheader"><?php echo isset($this->vars['I_MINI_LOGIN_LOGOUT']) ? $this->vars['I_MINI_LOGIN_LOGOUT'] : $this->lang('I_MINI_LOGIN_LOGOUT'); ?><?php echo isset($this->vars['L_LOGIN_LOGOUT']) ? $this->vars['L_LOGIN_LOGOUT'] : $this->lang('L_LOGIN_LOGOUT'); ?></a><hr /></div>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
<?php

$boarddisabled_count = ( isset($this->_tpldata['boarddisabled.']) ) ?  sizeof($this->_tpldata['boarddisabled.']) : 0;
for ($boarddisabled_i = 0; $boarddisabled_i < $boarddisabled_count; $boarddisabled_i++)
{
 $boarddisabled_item = &$this->_tpldata['boarddisabled.'][$boarddisabled_i];
 $boarddisabled_item['S_ROW_COUNT'] = $boarddisabled_i;
 $boarddisabled_item['S_NUM_ROWS'] = $boarddisabled_count;

?><div align="center"><span class="gen"><strong><?php echo isset($this->vars['L_BOARD_CURRENTLY_DISABLED']) ? $this->vars['L_BOARD_CURRENTLY_DISABLED'] : $this->lang('L_BOARD_CURRENTLY_DISABLED'); ?></strong></span></div><br />
<?php

} // END boarddisabled

if(isset($boarddisabled_item)) { unset($boarddisabled_item); } 

?>