<?php
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
 exit('Access Denied');
endif;
	
/*--------------------------*/
/* Theme FormatStory
/*--------------------------*/
function FormatStory($thetext, $notes, $aid, $informant) 
{
  print "\n\n<!-- FORMAT STORY CONTENT START -->\n";
  
  global $anonymous;

  $notes = !empty($notes) ? '<br /><br /><strong>'._NOTE.'</strong> <em>'.$notes.'</em>' : ''.PHP_EOL;	
  
  if ($aid == $informant) 
  {
     echo '<span class="content" color="#505050">'.$thetext.$notes.'</span>'.PHP_EOL;
  } 
  else 
  {
     if (defined('WRITES')) 
     {
        if (!empty($informant)) 
        {
           if ( is_array($informant) ):
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant[0].'">'.$informant[1].'</a>'.PHP_EOL;
           else:
            $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>'.PHP_EOL;
         endif;
  } 
  else 
  {
     $boxstuff = $anonymous.' '.PHP_EOL;
  }
  
   $boxstuff .= _WRITES.' <em>'.$thetext.'</em>'.$notes.''.PHP_EOL;
} 
else 
{
  $boxstuff .= $thetext . $notes;
}
      echo '<span class="content" color="#505050">' . $boxstuff . '</span>'.PHP_EOL;
   }

 print "<!-- FORMAT STORY CONTENT END -->\n\n";
}

?>
