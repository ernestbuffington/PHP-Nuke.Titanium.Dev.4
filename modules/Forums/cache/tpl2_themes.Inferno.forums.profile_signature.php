<?php

// eXtreme Styles mod cache. Generated on Tue, 16 Mar 2021 00:26:15 +0000 (time=1615854375)

?><table border="0" cellpadding="4" cellspacing="1" width="100%">
  <tr> 
    <td align="left"><span class="nav"><a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a></span></td>
  </tr>
</table>
<?php

$switch_current_sig_count = ( isset($this->_tpldata['switch_current_sig.']) ) ?  sizeof($this->_tpldata['switch_current_sig.']) : 0;
for ($switch_current_sig_i = 0; $switch_current_sig_i < $switch_current_sig_count; $switch_current_sig_i++)
{
 $switch_current_sig_item = &$this->_tpldata['switch_current_sig.'][$switch_current_sig_i];
 $switch_current_sig_item['S_ROW_COUNT'] = $switch_current_sig_i;
 $switch_current_sig_item['S_NUM_ROWS'] = $switch_current_sig_count;

?>
<form method="post" action="<?php echo isset($this->vars['SIG_LINK']) ? $this->vars['SIG_LINK'] : $this->lang('SIG_LINK'); ?>" name="preview">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle"><?php echo isset($this->vars['SIG_PREVIEW']) ? $this->vars['SIG_PREVIEW'] : $this->lang('SIG_PREVIEW'); ?></td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="bottom"><span class="gen"><?php echo isset($this->vars['CURRENT_PREVIEW']) ? $this->vars['CURRENT_PREVIEW'] : $this->lang('CURRENT_PREVIEW'); ?></span></td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['PROFIL_IMG']) ? $this->vars['PROFIL_IMG'] : $this->lang('PROFIL_IMG'); ?> <?php echo isset($this->vars['EMAIL_IMG']) ? $this->vars['EMAIL_IMG'] : $this->lang('EMAIL_IMG'); ?> <?php echo isset($this->vars['PM_IMG']) ? $this->vars['PM_IMG'] : $this->lang('PM_IMG'); ?> <?php echo isset($this->vars['WWW_IMG']) ? $this->vars['WWW_IMG'] : $this->lang('WWW_IMG'); ?></td>
  </tr>
</table>

<br />

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle"><?php echo isset($this->vars['SIG_EDIT']) ? $this->vars['SIG_EDIT'] : $this->lang('SIG_EDIT'); ?></td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;">
      <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr>
          <td class="row1" style="text-align: center; width: 33.3%;"><?php echo isset($this->vars['HTML_STATUS']) ? $this->vars['HTML_STATUS'] : $this->lang('HTML_STATUS'); ?></td>
          <td class="row1" style="text-align: center; width: 33.3%;"><?php echo isset($this->vars['BBCODE_STATUS']) ? $this->vars['BBCODE_STATUS'] : $this->lang('BBCODE_STATUS'); ?></td>
          <td class="row1" style="text-align: center; width: 33.3%;"><?php echo isset($this->vars['SMILIES_STATUS']) ? $this->vars['SMILIES_STATUS'] : $this->lang('SMILIES_STATUS'); ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;"><?php echo isset($this->vars['BB_BOX']) ? $this->vars['BB_BOX'] : $this->lang('BB_BOX'); ?></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" style="text-align: center; width: 100%;">
      <input style="cursor: pointer;" type="button" value="<?php echo isset($this->vars['L_PROFILE']) ? $this->vars['L_PROFILE'] : $this->lang('L_PROFILE'); ?>" onClick="location='<?php echo isset($this->vars['U_PROFILE']) ? $this->vars['U_PROFILE'] : $this->lang('U_PROFILE'); ?>'"> 
      <input style="cursor: pointer;" type="button" value="<?php echo isset($this->vars['SIG_CURRENT']) ? $this->vars['SIG_CURRENT'] : $this->lang('SIG_CURRENT'); ?>" onClick="location='<?php echo isset($this->vars['SIG_LINK']) ? $this->vars['SIG_LINK'] : $this->lang('SIG_LINK'); ?>'">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_PREVIEW']) ? $this->vars['SIG_PREVIEW'] : $this->lang('SIG_PREVIEW'); ?>" name="preview">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_SAVE']) ? $this->vars['SIG_SAVE'] : $this->lang('SIG_SAVE'); ?>" name="save">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_CANCEL']) ? $this->vars['SIG_CANCEL'] : $this->lang('SIG_CANCEL'); ?>" name="cancel">
    </td>
  </tr>
</table>
</form>
<?php

} // END switch_current_sig

if(isset($switch_current_sig_item)) { unset($switch_current_sig_item); } 

?>

<?php

$switch_preview_sig_count = ( isset($this->_tpldata['switch_preview_sig.']) ) ?  sizeof($this->_tpldata['switch_preview_sig.']) : 0;
for ($switch_preview_sig_i = 0; $switch_preview_sig_i < $switch_preview_sig_count; $switch_preview_sig_i++)
{
 $switch_preview_sig_item = &$this->_tpldata['switch_preview_sig.'][$switch_preview_sig_i];
 $switch_preview_sig_item['S_ROW_COUNT'] = $switch_preview_sig_i;
 $switch_preview_sig_item['S_NUM_ROWS'] = $switch_preview_sig_count;

?>
<form method="post" action="<?php echo isset($this->vars['SIG_LINK']) ? $this->vars['SIG_LINK'] : $this->lang('SIG_LINK'); ?>" name="preview">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle"><?php echo isset($this->vars['SIG_PREVIEW']) ? $this->vars['SIG_PREVIEW'] : $this->lang('SIG_PREVIEW'); ?></td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="bottom"><span class="gen"><?php echo isset($this->vars['REAL_PREVIEW']) ? $this->vars['REAL_PREVIEW'] : $this->lang('REAL_PREVIEW'); ?></span></td>
  </tr>
  <tr> 
    <td class="row2" width="520" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['PROFIL_IMG']) ? $this->vars['PROFIL_IMG'] : $this->lang('PROFIL_IMG'); ?> <?php echo isset($this->vars['EMAIL_IMG']) ? $this->vars['EMAIL_IMG'] : $this->lang('EMAIL_IMG'); ?> <?php echo isset($this->vars['PM_IMG']) ? $this->vars['PM_IMG'] : $this->lang('PM_IMG'); ?> <?php echo isset($this->vars['WWW_IMG']) ? $this->vars['WWW_IMG'] : $this->lang('WWW_IMG'); ?></td>
  </tr>
</table>

<br />

<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle"><?php echo isset($this->vars['SIG_EDIT']) ? $this->vars['SIG_EDIT'] : $this->lang('SIG_EDIT'); ?></td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;">
      <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr>
          <td class="row1" style="text-align: center; width: 33.3%;"><?php echo isset($this->vars['HTML_STATUS']) ? $this->vars['HTML_STATUS'] : $this->lang('HTML_STATUS'); ?></td>
          <td class="row1" style="text-align: center; width: 33.3%;"><?php echo isset($this->vars['BBCODE_STATUS']) ? $this->vars['BBCODE_STATUS'] : $this->lang('BBCODE_STATUS'); ?></td>
          <td class="row1" style="text-align: center; width: 33.3%;"><?php echo isset($this->vars['SMILIES_STATUS']) ? $this->vars['SMILIES_STATUS'] : $this->lang('SMILIES_STATUS'); ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="row1" colspan="2" style="width: 100%;"><?php echo isset($this->vars['BB_BOX']) ? $this->vars['BB_BOX'] : $this->lang('BB_BOX'); ?></td>
  </tr>
  <tr>
    <td class="catBottom" colspan="2" style="text-align: center; width: 100%;">
      <input style="cursor: pointer;" type="button" value="<?php echo isset($this->vars['L_PROFILE']) ? $this->vars['L_PROFILE'] : $this->lang('L_PROFILE'); ?>" onClick="location='<?php echo isset($this->vars['U_PROFILE']) ? $this->vars['U_PROFILE'] : $this->lang('U_PROFILE'); ?>'"> 
      <input style="cursor: pointer;" type="button" value="<?php echo isset($this->vars['SIG_CURRENT']) ? $this->vars['SIG_CURRENT'] : $this->lang('SIG_CURRENT'); ?>" onClick="location='<?php echo isset($this->vars['SIG_LINK']) ? $this->vars['SIG_LINK'] : $this->lang('SIG_LINK'); ?>'">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_PREVIEW']) ? $this->vars['SIG_PREVIEW'] : $this->lang('SIG_PREVIEW'); ?>" name="preview" id="preview">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_SAVE']) ? $this->vars['SIG_SAVE'] : $this->lang('SIG_SAVE'); ?>" name="save" id="submit">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_CANCEL']) ? $this->vars['SIG_CANCEL'] : $this->lang('SIG_CANCEL'); ?>" name="cancel">
    </td>
  </tr>
</table>
</form>
<?php

} // END switch_preview_sig

if(isset($switch_preview_sig_item)) { unset($switch_preview_sig_item); } 

?>

<?php

$switch_save_sig_count = ( isset($this->_tpldata['switch_save_sig.']) ) ?  sizeof($this->_tpldata['switch_save_sig.']) : 0;
for ($switch_save_sig_i = 0; $switch_save_sig_i < $switch_save_sig_count; $switch_save_sig_i++)
{
 $switch_save_sig_item = &$this->_tpldata['switch_save_sig.'][$switch_save_sig_i];
 $switch_save_sig_item['S_ROW_COUNT'] = $switch_save_sig_i;
 $switch_save_sig_item['S_NUM_ROWS'] = $switch_save_sig_count;

?>
<form method="post" action="<?php echo isset($this->vars['SIG_LINK']) ? $this->vars['SIG_LINK'] : $this->lang('SIG_LINK'); ?>" name="preview">
<table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
  <tr>
    <td class="catHead" colspan="2" style="height: 30px; letter-spacing: 1px; text-align: center; text-transform: uppercase;" valign="middle"><?php echo isset($this->vars['SIG_SAVE']) ? $this->vars['SIG_SAVE'] : $this->lang('SIG_SAVE'); ?></td>
  </tr>
  <tr> 
    <td class="row1" valign="middle" align="middle" height="50"><span class="gen"><?php echo isset($this->vars['SAVE_MESSAGE']) ? $this->vars['SAVE_MESSAGE'] : $this->lang('SAVE_MESSAGE'); ?></span></td>
  </tr>
  <tr> 
    <td class="catBottom" align="middle">
      <input style="cursor: pointer;" type="button" value="<?php echo isset($this->vars['L_PROFILE']) ? $this->vars['L_PROFILE'] : $this->lang('L_PROFILE'); ?>" onClick="location='<?php echo isset($this->vars['U_PROFILE']) ? $this->vars['U_PROFILE'] : $this->lang('U_PROFILE'); ?>'"> 
      <input style="cursor: pointer;" type="button" value="<?php echo isset($this->vars['SIG_CURRENT']) ? $this->vars['SIG_CURRENT'] : $this->lang('SIG_CURRENT'); ?>" onClick="location='<?php echo isset($this->vars['SIG_LINK']) ? $this->vars['SIG_LINK'] : $this->lang('SIG_LINK'); ?>'">
      <input style="cursor: pointer;" type="submit" value="<?php echo isset($this->vars['SIG_CANCEL']) ? $this->vars['SIG_CANCEL'] : $this->lang('SIG_CANCEL'); ?>" name="cancel">
    </td>
  </tr>
</table>
</form>
<?php

} // END switch_save_sig

if(isset($switch_save_sig_item)) { unset($switch_save_sig_item); } 

?>