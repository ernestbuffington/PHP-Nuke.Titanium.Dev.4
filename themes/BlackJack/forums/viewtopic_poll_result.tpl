<tr> 
  <td class="row2" colspan="2"><br />
    <table cellspacing="0" cellpadding="4" border="0" style="margin: auto">
      <tr> 
        <td colspan="4" style="text-align: center"><h1>{POLL_QUESTION}</h1></td>
      </tr>
      <!-- BEGIN poll_option -->
      <tr>
        <td>
        <div align="center">
        <table width="400px" border="1" cellpadding="0" cellspacing="0"><tr><td>
        
        <span style="color: lime;">{poll_option.POLL_OPTION_CAPTION}</span><br/>( votes: <strong>{poll_option.POLL_OPTION_RESULT}</strong> )&nbsp;[ {poll_option.POLL_OPTION_PERCENT_VALUE} of the voters ]&nbsp;
        <div style="padding-top:1px;"></div>
        {poll_option.POLL_PROGRESS_BAR}<br/>
        
        </td></tr></table></div>
        </td>
      </tr>
      <!-- END poll_option -->
      <tr> 
        <td colspan="4" style="text-align: center">{L_TOTAL_VOTES} : <strong>{TOTAL_VOTES}</strong></td>
      </tr>
    </table>
    <br />
  </td>
</tr>