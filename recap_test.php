<?php
include('mainfile.php');

 if (is_admin()) {
        include_once(NUKE_BASE_DIR.'header.php');

if (!$_POST['test']){
OpenTable();
echo '<form action="./recap_test.php" method="POST">'. "\n";
echo '<span style="font-size:18px;"> This is just a Recaptcha test to verify its working.<br />Click the recaptcha image then submit.</span>'. "\n";
echo '<input type="hidden" name="test" value="lookup"/><br /><br />'. "\n";
       $gfxchk = array(0,1,2,3,4,5,6,7);
echo  security_code($gfxchk, 'normal'); //Size - compact || normal  //Scale Adjustment - 0.90 = 90% scaledown. 	   
echo '<br />'."\n";
echo '<input type="submit" value="Click to complete the check">'. "\n";
echo '</form><br /><br />'. "\n";
echo 'If the Recaptcha checkbox is missing, then go to <strong>ACP->Preferences->Security Options</strong><br />and verify the recaptchas site & private key are filled in correctly.';
CloseTable();
}


global $module_name;

if ($_POST['test']){
      $gfxchk = array(0,1,2,3,4,5,6,7);
       	if (!security_code_check($_POST['g-recaptcha-response'], $gfxchk)) {
            $result = '<div style="text-align:center; width:100%; color:#990000; font-size:24px;">Recaptcha Failed</div>';
			$result .= '<div style="text-align:center;">This is still good. If your settings wasn\'t right, would wouldn\'t have gotten this message.<br />';
			$result .= 'You failed because you just failed the recaptcha.<br />You may delete this file since everything is good.</div>';
        } else {
			$result = '<div style="text-align:center; width:100%; color:#009900; font-size:24px;">Recaptcha Passed</div>';
			$result .= '<div style="text-align:center;">You may delete this file since everything is good.</div>';
    	}
	OpenTable();
	echo "<pre>\n" . $result . "\n</pre>\n";
	CloseTable();
}
include_once(NUKE_BASE_DIR.'footer.php');
}
?>