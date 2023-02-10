  <tr>
    <td class="row2" colspan="2"><br />
      <form method="POST" action="{S_POLL_ACTION}">
      <table cellspacing="0" cellpadding="4" border="0" style="margin: auto">
        <tr>
          <td style="text-align: center"><h1>{POLL_QUESTION}</h1></td>
        </tr>
        <tr>
          <td align="center">
            <table cellspacing="0" cellpadding="2" border="0">
              <!-- BEGIN poll_option -->
              <tr>
                <td><input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" />&nbsp;</td>
                <td>{poll_option.POLL_OPTION_CAPTION}</td>
              </tr>
              <!-- END poll_option -->
            </table>
          </td>
        </tr>
        <tr>
          <td>
          <div style="padding-top:15px;"></div>
          <div align="center"><input class="buttonlink" type="submit" name="submit" value="{L_SUBMIT_VOTE}"></div>
          <div style="padding-top:15px;"></div>
          </td>
        </tr>
        <tr>                        
          <td>
          <div style="padding-top:1px;"></div>
          <div align="center"><a class="buttonlink" href="{U_VIEW_RESULTS}">{L_VIEW_RESULTS}</a></div>
          <div style="padding-top:15px;"></div>
          
          
          </td>
        </tr>
      </table>
      {S_HIDDEN_FIELDS}
      </form>
    </td>
  </tr>