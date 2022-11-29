<!-- view:values -->

<table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
<tr> 
    <td class="catHead" align="center" colspan="{NUM_COLUMNS}"> 
        <span class="cattitle">{MODULE_NAME}</span> 
    </td> 
</tr> 
<tr>    
<!-- BEGIN column -->
    <th colspan="1" class=<!-- IF column.FIRST_COLUMN -->"thCornerL"<!-- ELSEIF column.LAST_COLUMN -->"thCornerR"<!-- ELSE -->"thTop"<!-- ENDIF --> align="center" width="{column.WIDTH}%"><strong>{column.VALUE}</strong></th>
<!-- END column -->
</tr> 

<!-- BEGIN row -->
  <tr>
<!-- BEGIN row_column -->
    <td class=<!-- IF row.row_column.ROW is even -->"row2"<!-- ELSE -->"row1"<!-- ENDIF --> align="{row.row_column.ALIGN}" width="{row.row_column.WIDTH}%"><span class="gen">{row.row_column.VALUE}</span></td>
<!-- END row_column -->
  </tr> 
<!-- END row -->

</table>