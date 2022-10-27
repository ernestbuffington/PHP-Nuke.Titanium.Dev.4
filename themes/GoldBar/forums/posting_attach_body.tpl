<!-- GitHub v1.0 Theme -->
<!-- BEGIN show_apcp -->
    <tr>
        <th class="thHead" colspan="2"><h1>{L_ATTACH_POSTING_CP}</h1></th>
    </tr>
    <tr>
        <td class="row1" colspan="2"><span class="gensmall">{L_ATTACH_POSTING_CP_EXPLAIN}</span></td>
    </tr>

    <tr> 
        <td class="row1"><span class="gen"><strong>{L_OPTIONS}</strong></span></td> 
        <td class="row2" nowrap="nowrap"><input type="submit" name="add_attachment_box" value="{L_ADD_ATTACHMENT_TITLE}" class="titaniumbutton">
<!-- END show_apcp -->
    <!-- BEGIN switch_posted_attachments -->
        &nbsp; <input type="submit" name="posted_attachments_box" value="{L_POSTED_ATTACHMENTS}" class="titaniumbutton">
    <!-- END switch_posted_attachments -->
<!-- BEGIN show_apcp -->
    </td></tr> 
<!-- END show_apcp -->
    {S_HIDDEN}
    <!-- BEGIN hidden_row -->
    {hidden_row.S_HIDDEN}
    <!-- END hidden_row -->

    {ADD_ATTACHMENT_BODY}

    {POSTED_ATTACHMENTS_BODY}