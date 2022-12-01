<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}
/*--------------------------*/
/* Theme SideBox
/*--------------------------*/
function themesidebox($title, $content, $bid = 0) 
{
  print "\n\n<!-- SIDE BLOCK CONTENT START -->\n";

  global $invisble_facebook_block;
  global $theme_name, $side_block_width, $bgcolor4;	

  if ($invisble_facebook_block == true):

  echo $content;
  $invisble_facebook_block =  false;

  else:
  # Top of center table START (this is where you edit for each theme design)
  
  print '<div id="borderSideBlocks">'.PHP_EOL;
  print '<div align="center"><strong>'.$title.'</strong></div>'.PHP_EOL;
  print '<div align="left" id="text" style="padding-top:6px;">'.PHP_EOL;
  print ''.$content.'</div></div>'.PHP_EOL;

endif;
# This sets the space between center tables listed START
print '<div align="center" style="padding:10px;">'.PHP_EOL;
print '</div>'.PHP_EOL;

print "<!-- SIDE BLOCK CONTENT END -->\n\n";
}

?>
