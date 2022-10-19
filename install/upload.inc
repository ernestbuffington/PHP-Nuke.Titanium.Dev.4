<?php

if (isset($_FILES['testfile'])){
	$testfile = $_FILES['testfile'];
	echo '<h3>Test uploaded file</h2>';
	if (!is_uploaded_file($testfile['tmp_name'])){
		switch($testfile['error']){
			case 1:
				echo 'File exceeds the upload_max_filesize directive in php.ini.<br /><br />';
				break;
			case 2:
				echo 'File exceeds the MAX_FILE_SIZE directive that was specified in the html form.<br /><br />';
				break;
			case 3:
				echo 'File was only partially uploaded.<br /><br />';
				break;
			case 4:
				echo 'No file was uploaded.<br /><br />';
				break;
			case 0: //no error; possible file attack!
			default: //a default error, just in case!  :)
				echo 'There was a problem with your upload.<br /><br />';
			break;
		}
	} else {
		$test_dir = $root_path.'/test';
		$test_file = 'test/testfile.inc';
		mkdir($test_dir, 0777);
		echo 'Open the temp file ';
		$fp = fopen($testfile['tmp_name'], 'r');
		if ($fp) {
			echo '<font color="green">succeed</font><br /><br />';
			fclose($fp);
		}
		echo 'Move the temp file ';
        if (move_uploaded_file($testfile['tmp_name'], $test_file)) {
			echo '<font color="green">succeeded</font> using: move_uploaded_file()<br /><br />';
        } elseif (copy($file['tmp_name'], $test_file)) {
			echo '<font color="green">succeeded</font> using: copy()<br /><br />';
        } else {
			$test_file = 'testfile.inc';
			if (move_uploaded_file($testfile['tmp_name'], $test_file)){
				echo '<font color="green">succeeded</font> using safe_mode: move_uploaded_file()<br /><br />';
			} elseif (copy($file['tmp_name'], $test_file)) {
				echo '<font color="green">succeeded</font> using safe_mode: copy()<br /><br />';
			}
        }
		echo 'Open the moved file ';
		$fp = fopen($test_file, 'r');
		if ($fp) {
			echo '<font color="green">succeeded</font><br /><br />';
			fclose($fp);
		}
		echo 'CHMOD the file';
		if (chmod($test_file, 0666)) {
			echo '<font color="green">succeeded</font><br /><br />';
		}
		echo 'Delete the file ';
		if (unlink($test_file)) {
			echo '<font color="green">succeeded</font><br /><br />';
		}
		rmdir($test_dir);
	}
}