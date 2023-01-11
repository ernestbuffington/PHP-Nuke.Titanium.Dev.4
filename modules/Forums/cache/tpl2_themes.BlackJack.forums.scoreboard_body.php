<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 12:10:00 -0500 (time=1672333800)

?><form method="post" action="<?php echo isset($this->vars['S_POST_DAYS_ACTION']) ? $this->vars['S_POST_DAYS_ACTION'] : $this->lang('S_POST_DAYS_ACTION'); ?>">
  <!-- index phrase display -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0">
    <tr>
      <td align="left" valign="middle" width="100%">
        <a href="<?php echo isset($this->vars['U_INDEX']) ? $this->vars['U_INDEX'] : $this->lang('U_INDEX'); ?>"><?php echo isset($this->vars['L_INDEX']) ? $this->vars['L_INDEX'] : $this->lang('L_INDEX'); ?></a> <?php echo isset($this->vars['NAV_CAT_DESC']) ? $this->vars['NAV_CAT_DESC'] : $this->lang('NAV_CAT_DESC'); ?>&nbsp;<i class="fas fa-arrow-right" style="font-size: 10px; color: #ccc;" aria-hidden="true"></i>&nbsp;
                
                <?php echo isset($this->vars['GAMENAME']) ? $this->vars['GAMENAME'] : $this->lang('GAMENAME'); ?>
          </td>
    </tr>
  </table>

  <!-- affichage "nouveau" | modérateurs + utilisateurs | "marquer lu" et pagination -->
  <table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
        <tr>
          <td align="right" valign="bottom" nowrap>
                <span class="gensmall">
                        <strong><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></strong>
                </span>
          </td>
        </tr>
  </table>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr> 
          <th align="center" width="25" height="25" class="thCornerL" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_POS']) ? $this->vars['L_POS'] : $this->lang('L_POS'); ?>&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_USER']) ? $this->vars['L_USER'] : $this->lang('L_USER'); ?>&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_SCORE']) ? $this->vars['L_SCORE'] : $this->lang('L_SCORE'); ?>&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_DATE']) ? $this->vars['L_DATE'] : $this->lang('L_DATE'); ?>&nbsp;</th>
        </tr>

        </tr>
       </table>
        <?php

$scorerow_count = ( isset($this->_tpldata['scorerow.']) ) ?  sizeof($this->_tpldata['scorerow.']) : 0;
for ($scorerow_i = 0; $scorerow_i < $scorerow_count; $scorerow_i++)
{
 $scorerow_item = &$this->_tpldata['scorerow.'][$scorerow_i];
 $scorerow_item['S_ROW_COUNT'] = $scorerow_i;
 $scorerow_item['S_NUM_ROWS'] = $scorerow_count;

?>
          <table width="100%">


          <td class="row1" align="center" width="100"><font color="gold" size="5"><i class="bi bi-trophy"></i></font>&nbsp;&nbsp;<font size="5"><?php echo isset($scorerow_item['POS']) ? $scorerow_item['POS'] : ''; ?><?php echo isset($scorerow_item['TROPHY']) ? $scorerow_item['TROPHY'] : ''; ?> 
			   </font></td>
			   
	   
          <td class="row3" align="left" width="250"><font size="4">&nbsp;<?php echo isset($scorerow_item['PLAYER_AVATAR']) ? $scorerow_item['PLAYER_AVATAR'] : ''; ?>&nbsp;&nbsp;<?php echo isset($scorerow_item['PLAYER']) ? $scorerow_item['PLAYER'] : ''; ?></font></td>
          <td class="row1" align="center" width="50"><?php echo isset($scorerow_item['URL_STATS']) ? $scorerow_item['URL_STATS'] : ''; ?></td>
          <td class="row3" align="center" width="244"><font size="2">USER SCORE</font></br> <font size="4"><?php echo isset($scorerow_item['SCORE']) ? $scorerow_item['SCORE'] : ''; ?></font></td>
          <td class="row1" align="left" width="235">&nbsp;<font size="3"><i class="bi bi-calendar2-check"></i>&nbsp;<?php echo isset($scorerow_item['DATE']) ? $scorerow_item['DATE'] : ''; ?></font></td>
          <td class="row1" align="center" width="826">&nbsp;</td>
                </tr>
                </table>
        <?php

} // END scorerow

if(isset($scorerow_item)) { unset($scorerow_item); } 

?>

  <table border="0" cellpadding="4" cellspacing="1" width="100%" class="forumline">
        <tr> 
          <th align="center" width="25" height="25" class="thCornerL" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_POS']) ? $this->vars['L_POS'] : $this->lang('L_POS'); ?>&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_USER']) ? $this->vars['L_USER'] : $this->lang('L_USER'); ?>&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_SCORE']) ? $this->vars['L_SCORE'] : $this->lang('L_SCORE'); ?>&nbsp;</th>
          <th align="center" width="288" class="thTop" nowrap="nowrap">&nbsp;<?php echo isset($this->vars['L_DATE']) ? $this->vars['L_DATE'] : $this->lang('L_DATE'); ?>&nbsp;</th>
        </tr>

        </tr>
       </table>

       <div align="center" style="padding-top:6px;">
       </div>
 <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td align="center">[ <?php echo isset($this->vars['URL_ARCADE']) ? $this->vars['URL_ARCADE'] : $this->lang('URL_ARCADE'); ?> ]&nbsp;-&nbsp;[ <?php echo isset($this->vars['URL_BESTSCORES']) ? $this->vars['URL_BESTSCORES'] : $this->lang('URL_BESTSCORES'); ?> ]</td>
   </tr>
  </table>

  <table width="100%" cellspacing="2" border="0" align="center" cellpadding="2">
        <tr> 
                    <td align="right" valign="middle" nowrap="nowrap"><?php echo isset($this->vars['S_TIMEZONE']) ? $this->vars['S_TIMEZONE'] : $this->lang('S_TIMEZONE'); ?><br /><?php echo isset($this->vars['PAGINATION']) ? $this->vars['PAGINATION'] : $this->lang('PAGINATION'); ?></td>
        </tr>
        <tr>
          <td align="left" colspan="2"><?php echo isset($this->vars['PAGE_NUMBER']) ? $this->vars['PAGE_NUMBER'] : $this->lang('PAGE_NUMBER'); ?></td>
        </tr>
  </table>
</form>