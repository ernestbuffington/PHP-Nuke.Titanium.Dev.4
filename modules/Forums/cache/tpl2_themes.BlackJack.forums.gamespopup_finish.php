<?php

// eXtreme Styles mod cache. Generated on Thu, 29 Dec 2022 16:43:05 +0000 (time=1672332185)

?><table width="100%" cellspacing="1" cellpadding="0" class="forumline">
                <tr>
                        <th align="center" colspan="4"><?php echo isset($this->vars['GAMENAME']) ? $this->vars['GAMENAME'] : $this->lang('GAMENAME'); ?></th>
                </tr>
                <tr>
                        <td align='center' class='row2'><span class="genmed"><strong>Rank</strong></span></td>
                        <td align='center' class='row2'><span class="genmed"><strong>User</strong></span></td>
                        <td align='center' class='row2'><span class="genmed"><strong>Score</strong></span></td>
                        <td align='center' class='row2'><span class="genmed"><strong>Date</strong></span></td>
                </tr>
  <?php

$scorerow_count = ( isset($this->_tpldata['scorerow.']) ) ?  sizeof($this->_tpldata['scorerow.']) : 0;
for ($scorerow_i = 0; $scorerow_i < $scorerow_count; $scorerow_i++)
{
 $scorerow_item = &$this->_tpldata['scorerow.'][$scorerow_i];
 $scorerow_item['S_ROW_COUNT'] = $scorerow_i;
 $scorerow_item['S_NUM_ROWS'] = $scorerow_count;

?>
                                        <tr>
                                        <td class="<?php echo isset($scorerow_item['CLASS']) ? $scorerow_item['CLASS'] : ''; ?>" align="center"><span class="gensmall"><?php echo isset($scorerow_item['POS']) ? $scorerow_item['POS'] : ''; ?></span></td>
                                        <td class="<?php echo isset($scorerow_item['CLASS']) ? $scorerow_item['CLASS'] : ''; ?>" align="center">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                         <td align=center><span class="gensmall"><?php echo isset($scorerow_item['USERNAME']) ? $scorerow_item['USERNAME'] : ''; ?></span></td>
                                                         <td width="25" align="center"><?php echo isset($scorerow_item['URL_STATS']) ? $scorerow_item['URL_STATS'] : ''; ?></td>
                                                        </tr>
                                                        </table>
                                        </td>
                                        <td class="<?php echo isset($scorerow_item['CLASS']) ? $scorerow_item['CLASS'] : ''; ?>" align="center"><span class='gensmall'><?php echo isset($scorerow_item['SCORE']) ? $scorerow_item['SCORE'] : ''; ?></span></td>
                                        <td class="<?php echo isset($scorerow_item['CLASS']) ? $scorerow_item['CLASS'] : ''; ?>" align="center"><span class='gensmall'><?php echo isset($scorerow_item['DATEHIGH']) ? $scorerow_item['DATEHIGH'] : ''; ?></span></td>
                                        </tr>
  <?php

} // END scorerow

if(isset($scorerow_item)) { unset($scorerow_item); } 

?>
</table>

 <table width="100%" cellpadding="5" cellspacing="1" border="0">
   <tr>
        <td align="center"><span class='gensmall'>[&nbsp;<a href=<?php echo isset($this->vars['PLAYAGAIN']) ? $this->vars['PLAYAGAIN'] : $this->lang('PLAYAGAIN'); ?>>Play Again</a>]&nbsp;-&nbsp;[&nbsp;<a href="javascript:window.close();">Close This Window</a>]</span></td>
   </tr>
  </table>