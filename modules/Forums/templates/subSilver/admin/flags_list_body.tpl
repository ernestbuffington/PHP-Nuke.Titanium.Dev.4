<h1>{L_FLAGS_TITLE}</h1>
<p>{L_FLAGS_TEXT}</p>

<form method="post" action="{S_FLAGS_ACTION}">

<table style="width: 30%; margin: auto" cellspacing="1" cellpadding="4" border="0" class="forumline">
  <tr>
    <td class="catHead" style="font-weight: bold; text-transform: uppercase; text-align: center">{L_FLAG}</td>
    <td class="catHead" style="font-weight: bold; text-transform: uppercase; text-align: center">{L_FLAG_PIC}</td>
    <td class="catHead" style="font-weight: bold; text-transform: uppercase; text-align: center">{L_EDIT}</td>
    <td class="catHead" style="font-weight: bold; text-transform: uppercase; text-align: center">{L_DELETE}</td>
  </tr>
  <!-- BEGIN flags -->
  <tr>
    <td class="{flags.ROW_CLASS}">{flags.FLAG}</td>
    <td class="{flags.ROW_CLASS}" style="text-align: center"><span class="countries {flags.IMAGE_DISPLAY}"></span></td> <!-- {flags.IMAGE_DISPLAY} -->
    <td class="{flags.ROW_CLASS}" style="text-align: center"><a href="{flags.U_FLAG_EDIT}">{L_EDIT}</a></td>
    <td class="{flags.ROW_CLASS}" style="text-align: center"><a href="{flags.U_FLAG_DELETE}">{L_DELETE}</a></td>
  </tr>
  <!-- END flags -->			
  <tr>
    <td class="catBottom" align="center" colspan="4"><input type="submit" class="mainoption" name="add" value="{L_ADD_FLAG}" /></td>
  </tr>
</table>
</form>
