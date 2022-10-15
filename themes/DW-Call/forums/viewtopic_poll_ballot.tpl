            <tr>
                <td align="center" class="row2" colspan="2" style="padding: 10px 0px 10px 0px;"><br clear="all" /><form method="POST" action="{S_POLL_ACTION}"><table cellspacing="0" cellpadding="4" border="0" align="center">
                    <tr>
                        <td align="center"><span class="gen"><strong><div style="padding: 3px;">{POLL_QUESTION}</div><hr /></strong></span></td>
                    </tr>
                    <tr>
                        <td align="center"><table cellspacing="0" cellpadding="2" border="0" style="padding: 10px;">
                            <!-- BEGIN poll_option -->
                            <tr>
                                <td><input type="radio" name="vote_id" value="{poll_option.POLL_OPTION_ID}" />&nbsp;</td>
                                <td><span class="gen">{poll_option.POLL_OPTION_CAPTION}</span></td>
                            </tr>
                            <!-- END poll_option -->
                        </table></td>
                    </tr>
                    <tr>
                        <td align="center"><hr /><div style="padding: 10px;">
            <input type="submit" name="submit" value="{L_SUBMIT_VOTE}" class="liteoption" /></div>
          </td>
                    </tr>
                    <tr>
                        
          <td align="center"><span class="gensmall"><strong><a href="{U_VIEW_RESULTS}" class="gen">{L_VIEW_RESULTS}</a></strong></span></td>
                    </tr>
                </table>{S_HIDDEN_FIELDS}</form></td>
            </tr>