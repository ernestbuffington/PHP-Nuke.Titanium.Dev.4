  <tr>
    <td class="row2" colspan="2"><br />
      <form method="POST" action="{S_POLL_ACTION}">
      <table cellspacing="0" cellpadding="4" border="0" style="margin: auto">
        <tr>
          <td style="text-align: center">{POLL_QUESTION}</td>
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
          <td><input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="liteoption" /></td>
        </tr>
        <tr>                        
          <td><a href="{U_VIEW_RESULTS}">{L_VIEW_RESULTS}</a></td>
        </tr>
      </table>
      {S_HIDDEN_FIELDS}
      </form>
    </td>
  </tr>