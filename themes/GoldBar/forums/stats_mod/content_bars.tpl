<!-- view:bars -->

<table border="0" cellpadding="4" cellspacing="1" class="forumline" width="100%"> 
<tr> 
    <td class="catHead" align="center" colspan="{NUM_COLUMNS}"> 
        <span class="cattitle">{MODULE_NAME}</span> 
    </td> 
</tr> 
<tr>    
<!-- BEGIN column -->
    <th colspan="1" class=<!-- IF column.FIRST_COLUMN -->"thCornerL"<!-- ELSEIF column.LAST_COLUMN -->"thCornerR"<!-- ELSE -->"thTop"<!-- ENDIF --> align="center" <!-- IF not column.FIRST_COLUMN and not column.LAST_COLUMN -->width="10%"<!-- ENDIF -->><strong>{column.VALUE}</strong></th>
<!-- END column -->
</tr> 

<!-- BEGIN row -->
  <tr> 
<!-- BEGIN row_column -->
    <!-- IF row.row_column.RANK_COLUMN -->
        <td class=<!-- IF row.row_column.ROW is even -->"row1"<!-- ELSE -->"row2"<!-- ENDIF --> align="{row.row_column.ALIGNMENT}" width="10%"><span class="gen">{row.row_column.VALUE}</span></td> 
    <!-- ELSEIF row.row_column.GRAPH_COLUMN -->
        <td class=<!-- IF row.row_column.ROW is even -->"row1"<!-- ELSE -->"row2"<!-- ENDIF --> align="{row.row_column.ALIGNMENT}" width="50%"> 
            <table cellspacing="0" cellpadding="0" border="0" align="left">
            <tr> 
                <td align="right"><img src="{LEFT_GRAPH_IMAGE}" width="4" height="12" /></td> 
            </tr> 
            </table> 
            <table cellspacing="0" cellpadding="0" border="0" align="left" width="{row.row_column.VALUE}%"> 
            <tr> 
                <td><img src="{GRAPH_IMAGE}" width="100%" height="12" /></td> 
            </tr> 
            </table> 
            <table cellspacing="0" cellpadding="0" border="0" align="left"> 
            <tr> 
                <td align="left"><img src="{RIGHT_GRAPH_IMAGE}" width="4" height="12" /></td> 
            </tr> 
            </table> 
        </td> 
    <!-- ELSE -->
        <td class=<!-- IF row.row_column.ROW is even -->"row1"<!-- ELSE -->"row2"<!-- ENDIF --> align="{row.row_column.ALIGNMENT}" width="10%">
        <!-- IF row.row_column.AUTH_REPLACEMENT and row.row_column.AUTH_LANG_ENTRY -->
        <span class="gen" style="color:red">{row.row_column.VALUE}</span>
        <!-- ELSE -->
        <span class="gen">{row.row_column.VALUE}</span>
        <!-- ENDIF -->
        </td>
    <!-- ENDIF -->
<!-- END row_column -->
  </tr> 
<!-- END row -->

</table>