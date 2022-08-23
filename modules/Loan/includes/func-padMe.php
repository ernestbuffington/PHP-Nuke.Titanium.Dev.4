<?php
/*======================================================================
  PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *   copyright            : (C) ESO Software Inc.
 *   email                : scottybcoder#gmail.com
 ***************************************************************************/

/********************************************************************
   1.  function to pad a string left or right to line up text output
       ( you have to use a monospace font (like courier) )
   2.   1st arg string to pad, second arg 1 for left, 2 for right,
        3rd arg for lenght of padded string, 4th arg for pad char
                                                           author TSB
 ********************************************************************/
function padMe($padStr, $intL_R, $intLength, $padChar)
{
   if ( $intL_R == 1 )
   {
      for ($i = 1;$i < $intLength + 1;$i++)
      {
          if (strlen($padStr) < $intLength)
		  {
             $padStr = $padChar . $padStr;
		  }
	  }
   }
   if ( $intL_R == 2 )
   {
      for ($i = 1;$i < $intLength + 1;$i++)
      {
          if (strlen($padStr) < $intLength)
		  {
             $padStr = $padStr . $padChar;
		  }
	  }
   }
   return $padStr;
}
?>
