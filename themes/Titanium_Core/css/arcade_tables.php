<?php
global $theme_name; 

echo "\n\n/* ".$theme_name."/css/arcade_tables.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4;
/* <?=$bgcolor1?> */
?>
<script>
var table = document.getElementById("Table-1");
var rowCount = table.rows.length;

for(var i=0;i<6;i++) {
row = table.insertRow(rowCount);
cell1 = row.insertCell(0);
cell1.name = "animate";
cell1.id = i ;
var content = document.createElement("output");                
content.innerHTML = i ;
cell1.appendChild(content);
rowCount++;

  // if (i%2 == 0) {
       setInterval(function() {
           $(input[name="animate"]).animate( { backgroundColor: '#f08080' }, 'slow')
           .animate( { backgroundColor: 'red' }, 'slow'); 
                 }, 1000);
   // }

}​
</script>
/* Main arcade table cell colors and backgrounds */
td.whoisplaying_row {
	white-space: nowrap;
	background: #8d7b4d;
	border: 0px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
    text-decoration: none;
}

td.arcadeRow1 {
	background: #988653;
    background-color: #988653;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

td.arcadeRow2 {
	background: #645838;
    background-color: #645838;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

td.arcadeRow3 {
	background: #8d7b4d;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

/* Arcade Category Row Left */
td.arcadeCat, td.arcadeCatHead, td.arcadeCatSides, td.arcadeCatLeft, td.arcadeCatRight, td.arcadeCatBottom {
	background-color: #343434;
	color: #FFF;
	border: 1px solid #787878;
	white-space: nowrap;
	padding: 4px;
}

td.arcadeCat, td.arcadeCatHead, td.arcadeCatBottom {
	white-space: nowrap;
	background: #988653;
    background-color: #988653;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
   
}

/*
 * Setting additional nice inner borders for the arcade table cells.
 * The names indicate which sides the border will be on.
 * Don't worry if you don't understand this, just ignore it :-)
 *----------------------------------------------------------------
*/


/* Arcade Center Top Title Bar*/
th.arcadeThHead, th.arcadeThSides, th.arcadeThTop, th.arcadeThLeft, th.arcadeThRight, th.arcadeThBottom, th.arcadeThCornerL, th.arcadeThCornerR {
	color: #F1F1F1;
	font-size: 14px;
	background-color: #97834f;
	background: #97834f;
	white-space: nowrap;
	border: 3px solid #c9b06d;
	padding: 4px;
    box-shadow: inset 1px 1px 3px #000;
}

/* Forum_Body.tpl - Last Column */
td.arcadeRow3Right, td.arcadeSpaceRow {
	height: 25px;
	color: #F1F1F1;
	border: 1px solid #222;
	border-bottom-width: 0;
	font-size: 10px;
	background-color: <?=$bgcolor1?>;
	white-space: nowrap;
}
<?
