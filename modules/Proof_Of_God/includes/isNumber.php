<?php

/******************************************************************************* 
   1.  function returns 1 when only chars 0123456789 and . are found in a string
   2.  it returns 1 when more than one . is found in a string
   3.  it returns 1 when any other char is found in a string
   4.  else it returns 0   (meaning the string is a number)          author  TSB
  ******************************************************************************/ 

function is_num($var)
{
   $counter=0;

   for ($i=0;$i<strlen($var);$i++)
   {
      $ascii_code=ord($var[$i]);
      if ( intval($ascii_code)==46 )
      {
         $counter++;
         if ($counter > 1 )
		 {
            return 0;
            exit;
		 }

      }    

      if (intval($ascii_code) >=48 && intval($ascii_code) <=57 || intval($ascii_code)==46)
	  {
         continue;
      }
	  else
	  {          
         return 0;
         exit;
      }
   } 
   return 1;
} 

?>