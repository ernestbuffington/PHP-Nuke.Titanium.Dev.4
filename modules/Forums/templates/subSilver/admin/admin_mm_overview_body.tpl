<script>
    //
    // Taking from the Attachment MOD of Acyd Burn
    //
    function select(status)
    {
        for (i = 0; i < document.mmo_list.length; i++)
        {
            document.mmo_list.elements[i].checked = status;
        }
    }
</script>
<h1>{L_MMO_TITLE}</h1>
<p>{L_MMO_TEXT}</p>
  <!-- BEGIN mm_switch_markunmark -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
    <form method="post" action="{S_MODE_ACTION}">
    <tr>
        <td align="center" nowrap="nowrap"><span class="genmed">{L_MMO_CHOOSE}:&nbsp;{S_MODE_SELECT}&nbsp;&nbsp;{L_MMO_ORDER}&nbsp;{S_ORDER_SELECT}&nbsp;&nbsp;</span>
        <input type="submit" name="submit" value="{L_MMO_GO}" class="liteoption" />
        </td>
    </tr>
    </form>
</table>
  <!-- END mm_switch_markunmark -->

<form action="{S_MMO_ACTION}" method="post" name="mmo_list">
<table border="0" cellpadding="3" cellspacing="1" class="forumline" align="center">
    <tr> 
      <th align="center">&nbsp;{L_MMO_ACTION}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_MOD}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_TOPIC}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_OLDTOPIC}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_PARENT}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_TARGET}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_TIME}&nbsp;</th>
    <th align="center">&nbsp;{L_MMO_DELETE}&nbsp;</th>
    </tr>
  <!-- BEGIN mm_no_overview -->
  <tr> 
      <td align="center" class="row1" colspan="8"><span class="gensmall">{mm_no_overview.NO_OVERVIEW}</span></td>
  </tr>
  <!-- END mm_no_overview -->
  <!-- BEGIN mm_overview -->
  <tr> 
      <td align="center" class="row2"><span class="gensmall"><strong>{mm_overview.MOVED_TYPE}</strong></span></td>
      <td align="center" class="row1"><span class="gensmall">{mm_overview.MOVED_MOD}</span></td>
    <td align="center" class="row2"><span class="gensmall">{mm_overview.MOVED_TOPIC}</span></td>
    <td align="center" class="row1"><span class="gensmall">{mm_overview.MOVED_OLDTOPIC}</span></td>
    <td align="center" class="row2"><span class="gensmall">{mm_overview.MOVED_PARENT}</span></td>
    <td align="center" class="row1"><span class="gensmall">{mm_overview.MOVED_TARGET}</span></td>
    <td align="center" class="row2"><span class="gensmall">{mm_overview.MOVED_TIME}</span></td>
    <td align="center" class="row1" align="center" valign="middle"><input type="checkbox" name="mmo_list[]" value="{mm_overview.MOVED_ID}" /></td>
    </tr>
  <!-- END mm_overview -->
  <!-- BEGIN mm_switch_markunmark -->
  <tr>
 <td class="catHead" colspan="8" height="28" align="right"> 
 <strong><span class="gensmall"><a href="javascript:select(true);" class="gensmall">{L_MMO_MARK}</a> &nbsp; <a href="javascript:select(false);" class="gensmall">{L_MMO_UNMARK}</a></span></strong>&nbsp;&nbsp;
        <input type="submit" name="delete" class="liteoption" value="{L_MMO_DELETE}" />
        </td>
  </tr>
  
</table>

<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
  <tr> 
    <td width="50%"align="center"><span class="nav">{PAGE_NUMBER}&nbsp;&nbsp;{PAGINATION}</span></td>
  </tr>
  <!-- END mm_switch_markunmark -->
</table>

</form>

<br clear="all">