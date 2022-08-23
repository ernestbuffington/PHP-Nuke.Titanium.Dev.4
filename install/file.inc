<?php

echo '<h3>Testing file read, write and delete access</h3>';
test_create_file('newfile.php');
test_create_dir('test', 'relative path directory/file');
test_create_dir($root_path.'/test', 'absolute path directory/file');

function test_create_file($file){
	if ($file){ echo '<br /><br />'; }
	echo 'Create file \'test/test.php\' ';
	if (@touch($file)){
		chmod($file, 0666);
		echo '<font color="green">succeed</font><br /><br />Writing to file \'test/test.php\' ';
		$fp = fopen($file, 'w');
		if ($fp && fwrite($fp, '<?php return TRUE;')){
			if (fclose($fp)){
				echo '<font color="green">succeed</font><br /><br />Permissions \'test/test.php\' <font color="green">'.permissions($file).'</font><br /><br /Open and output \'test/test.php\' ';
				if (include($file)){ echo '<font color="green">succeed</font><br /><br />'; }
				echo 'Delete file \'test/test.php\' ';
				if (unlink($file)){ echo '<font color="green">succeed</font><br /><br />'; }
			}
		}
	}
}

function test_create_dir($test_dir,$type){
	echo '<h3>Testing '.$type.' read, write and delete access</h3>';
	echo 'Create directory \'test\' ';
	if (@mkdir($test_dir, 0777)){
		if (permissions($test_dir, true) != '0777'){
			echo '<font color="green">succeed</font>, but 0777 failed so forcing thru chmod()<br /><br />';
			chmod($test_dir, 0777);
		} else {
			echo '<font color="green">succeed</font>';
		}
		test_create_file($test_dir.'/newfile.php');
		echo 'Delete directory \'test\' ';
		if (rmdir($test_dir)){ echo '<font color="green">succeed</font></font>'; }
	}
}