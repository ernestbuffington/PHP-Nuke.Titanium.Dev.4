<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;
function themecenterbox($title, $content)
{ 
  print "\n\n<!-- CENTER BLOCK CONTENT START -->\n";
  
  global $invisble_facebook_block;
  global $theme_name;	
  global $bgcolor4;

  if ($invisble_facebook_block == true):
    echo $content;
    $invisble_facebook_block =  false;
  else:
  
  print '<div align="center" id="borderCenterBlocks">'.PHP_EOL;
  
  print '<div align="center"><strong>'.$title.'</strong></div>'.PHP_EOL;

  print '<div align="left" id="text">'.PHP_EOL;
  print ''.$content.''.PHP_EOL;
  print '</div>'.PHP_EOL;
  
  print '</div>'.PHP_EOL;
  
  endif;
  
  print '<div align="center" style="padding:10px;">'.PHP_EOL;
  print '</div>'.PHP_EOL;
  
  print "<!-- CENTER BLOCK CONTENT END -->\n\n";  
}

?>
