<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 - 2018 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|----------------------------------------------------------------------
*/

if (!defined('MODULE_FILE')) 
	die("You can't access this file directly...");

function _file_repository_submitdownload()
{
	global $db, $admin_file, $lang_new, $module_name, $settings, $themes, $userinfo, $admin, $user;
	OpenTable();
	_index_navigation_header();

	$result  = $db->sql_query( "SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='0' AND `isallowed`='1' ORDER BY `cname`" );
	$numrows = $db->sql_numrows( $result );
	$categories = $db->sql_fetchrow( $result );

	echo '<br />';
	echo '<form action="modules.php?name='.$module_name.'&amp;action=submitdownload_save" method="post" enctype="multipart/form-data">'."\n";
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'center',_sh(),2).'>'._suh($lang_new[$module_name]['SUBMITDOWNLOAD_HEADER']).'</td>'."\n";
	echo '  </tr>'."\n";
	if ($numrows > 0 && $settings['users_can_upload'] == true && _check_users_permissions($settings['group_allowed_to_upload']) == true ):

		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sc(),2).'>Information on how the system works will be posted here.</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','title','250px',$row['title'],false,false,true).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['PREVIEW']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','preview','250px',$row['preview']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['FILE_VERSION']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','version','100px',$row['version']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',false,_sc()).'>'._sut($lang_new[$module_name]['CATEGORY']).'</td>'."\n";
		echo '    <td'._tdcss('50%',false,_sc()).'>'._category_parents_and_children('cid',0,false,true).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,false,_sh(),2).'>'._sut($lang_new[$module_name]['FILES']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss(false,false,_sc(),2).'>';
		echo '      <table style="width: 100%; white-space: nowrap;" cellpadding="0" cellspacing="0" border="0">';
		echo '        <tr>';
		echo '          <td'._tdcss('25%').'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
		echo '          <td'._tdcss('75%').'>'._sut($lang_new[$module_name]['FILE']).'</td>'."\n";
		echo '        </tr>';
		if($settings['users_file_upload_amount'] >= 1):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userfile_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userfile[]','100%','',false,false,false,'userfile_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_file_upload_amount'] >= 2):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userfile_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userfile[]','100%','',false,false,false,'userfile_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_file_upload_amount'] >= 3):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userfile_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userfile[]','100%','',false,false,false,'userfile_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_file_upload_amount'] >= 4):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userfile_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userfile[]','100%','',false,false,false,'userfile_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_file_upload_amount'] == 5):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userfile_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userfile[]','100%','',false,false,false,'userfile_upload').'</td>'."\n";
			echo '        </tr>';

		endif;			
		echo '      </table>';
		echo '    </td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,false,_sh(),2).'>'._sut($lang_new[$module_name]['SCREENSHOTS']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss(false,false,_sc(),2).'>'."\n";
		echo '      <table style="width: 100%; white-space: nowrap;" cellpadding="0" cellspacing="0" border="0">'."\n";
		echo '        <tr>'."\n";
		echo '          <td'._tdcss('25%').'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
		echo '          <td'._tdcss('75%').'>'._sut($lang_new[$module_name]['FILE']).'</td>'."\n";
		echo '        <tr>'."\n";
		if($settings['users_screens_upload_amount'] >= 1):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userscreen_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userscreen[]','100%','',false,false,false,'userimage_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_screens_upload_amount'] >= 2):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userscreen_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userscreen[]','100%','',false,false,false,'userimage_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_screens_upload_amount'] >= 3):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userscreen_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userscreen[]','100%','',false,false,false,'userimage_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_screens_upload_amount'] >= 4):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userscreen_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userscreen[]','100%','',false,false,false,'userimage_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		if($settings['users_screens_upload_amount'] == 5):

			echo '        <tr>';
			echo '          <td'._tdcss('25%').'>'._input('text','userscreen_desc[]','100%','').'</td>';
			echo '          <td'._tdcss('75%').'>'._input('file','userscreen[]','100%','',false,false,false,'userimage_upload').'</td>'."\n";
			echo '        </tr>';

		endif;
		echo '      </table>'."\n";
		echo '    </td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['DESCRIPTION']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss(FALSE,FALSE,_sc(),2).'>'._textarea('submit_description','').'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['AUTHOR_DETAILS']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['AUTHOR']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','author','250px',$row['author'],false,false,false).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['EMAIL']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('email','author_email','250px',$row['author_email'],false,false,false).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['WEBSITE']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','author_website','250px',$row['author_website']).'</td>'."\n";
		echo '  </tr>'."\n";
		// display the submitters information.
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['SUBMITTER_DETAILS']).'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['SUBMITTER_USERNAME']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'.$userinfo['username'].'</td>'."\n";
		echo '  </tr>'."\n";
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['SUBMITTER_EMAIL']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'.$userinfo['user_email'].'</td>'."\n";
		echo '  </tr>'."\n";

		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(FALSE,'center',_sf(),2).'>'._submit($lang_new[$module_name]['SAVE']).'</td>'."\n";
		echo '  </tr>'."\n";

	else:

		if($settings['users_can_upload'] == false):

			// echo $lang_new[$module_name]['USER_UPLOAD_DISABLED'];
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),2).'>'.$lang_new[$module_name]['USER_UPLOAD_DISABLED'].'</td>'."\n";
			echo '  </tr>'."\n";

		elseif($numrows == 0):

			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),2).'>No Categories have been set allow any uploads at this time.</td>'."\n";
			echo '  </tr>'."\n";

		else:

			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss(false,'center',_sc(),2).'>You do not have permissions to upload.</td>'."\n";
			echo '  </tr>'."\n";

		endif;
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(FALSE,'center',_sf(),2).'>&nbsp;</td>'."\n";
		echo '  </tr>'."\n";

	endif;
	
	echo '</table>'."\n";
	echo _input('hidden','semail',FALSE,$userinfo['user_email']);
	echo _input('hidden','sname',FALSE,$userinfo['username']);
	echo _input('hidden','suid',FALSE,$userinfo['user_id']);
	echo '</form>'."\n";
	CloseTable();
}

function _file_repository_get_file_information($upload)
{
	$file['name']   = $upload['name'];
	$file['name']   = preg_replace('/\s*/m', '', $file['name']);
	$file['temp']   = $upload['tmp_name'];
	$file['type']   = str_replace('"', '', $upload['type']);
	$file['type']   = str_replace("'", '', $file['type']);
	$file['error']  = $upload['error'];
	$file['size']   = $upload['size'];
	$file_parts     = @pathinfo($upload['name']);
    $file['ext']    = $file_parts['extension'];
    return $file;
}

function _file_repository_delete_on_client_error($did)
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	// merge this query into one.

	$did = ($_GET['did']) ? $_GET['did'] : $_POST['did'];

	$row  = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `did`='".$did."'"));
	$rowf = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$row['did']."'"));

	$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `did`='".$row['did']."'");
	$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$row['did']."'");

	$result = $db->sql_query("SELECT `pid`, `filename` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$row['did']."'");
	$countShots = $db->sql_numrows($result);
	if($countShots > 0)
	{
		while ($row2 = $db->sql_fetchrow($result))
		{
			@unlink(_FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$row2['filename']);
			@unlink(_FILE_REPOSITORY_SCREENS.'thumbs/thumb_190x120_'.$row2['filename']);
			@unlink(_FILE_REPOSITORY_SCREENS.$row2['filename']);
			$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `pid`='".$row2['pid']."'");
		}
		$db->sql_freeresult($result);
	}
	@unlink(_FILE_REPOSITORY_DIR.$rowf['filename']);
}

function _file_repository_save_submitdownload()
{
	global $db, $admin_file, $module_name, $userinfo, $settings;

	// $_FILES['userfile'] = array();

	$result  = $db->sql_query( "SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."` WHERE `parentid`='0' AND `isallowed`='1' ORDER BY `cname`" );
	$numrows = $db->sql_numrows( $result );
	$categories = $db->sql_fetchrow( $result );

	if ($numrows > 0 && $settings['users_can_upload'] == true && _check_users_permissions($settings['group_allowed_to_upload']) == true ):

		$error_messages = array();
		$file_extensions = $settings['allowed_file_extensions'];
		$image_extensions = $settings['allowed_image_extensions'];

		$author      		= (!empty($_POST['author'])) ? _escape_string($_POST['author']) : '';
		$author_email      	= (!empty($_POST['author_email'])) ? $_POST['author_email'] : '';
		$author_website     = (!empty($_POST['author_website'])) ? $_POST['author_website'] : '';
		$cid      			= (!empty($_POST['cid'])) ? intval($_POST['cid']) : 0;
		$description      	= (!empty($_POST['submit_description'])) ? _escape_string($_POST['submit_description']) : '';
		$did      			= (!empty($_POST['did'])) ? intval($_POST['did']) : '';
		$preview 			= (!empty($_POST['preview'])) ? $_POST['preview'] : '';
		$semail      		= (!empty($_POST['semail'])) ? $_POST['semail'] : '';	
		$sname      		= (!empty($_POST['sname'])) ? _escape_string($_POST['sname']) : '';
		$suid      			= (!empty($_POST['suid'])) ? intval($_POST['suid']) : 0;
		$title      		= (!empty($_POST['title'])) ? _escape_string($_POST['title']) : '';
		$version      		= (!empty($_POST['version'])) ? $_POST['version'] : '';

		$sql = "INSERT INTO `"._FILE_REPOSITORY_ITEMS."` (`cid`, `author`, `author_email`, `author_website`, `date`, `description`, `did`, `isapproved`, `preview`, `semail`, `sname`, `suid`, `title`, `version`) VALUES ('".$cid."', '".$author."', '".$author_email."', '".$author_website."', now(), '".$description."', NULL, 0, '".$preview."', '".$semail."', '".$sname."', '".$suid."', '".$title."', '".$version."')";
		$db->sql_query($sql);
		$did = $db->sql_nextid();

		for( $i = 0 ; $i < count($_FILES['userfile']['name']) ; $i++ ):

			if($_FILES['userfile']['name'][$i]):

				$fileupload['name']   = $_FILES['userfile']['name'][$i];
				$fileupload['name']   = preg_replace('/\s*/m', '', $fileupload['name']);

				$fileupload['desc']  	= $_POST['userfile_desc'][$i];
				$fileupload['error']  	= $_FILES['userfile']['error'][$i];
				$file_parts     		= @pathinfo($_FILES['userfile']['name'][$i]);
		    	$fileupload['ext'] 		= $file_parts['extension'];
		    	$fileupload['size']		= $_FILES['userfile']['size'][$i];
		    	$fileupload['temp']   	= $_FILES['userfile']['tmp_name'][$i];

		    	# Check the file selected for upload, Is in the allowed extensions array.
				if (!in_array($fileupload['ext'],explode(',',$file_extensions))):
					$error_messages[] = 'Invalid File Type: Download Field '.($i+1);
				endif;

			endif;

			if (is_uploaded_file($fileupload['temp']) && $fileupload['error'] == 0 && count( $error_messages ) == 0):

				# If the uploaded file has no size, Do nothing with it.
				if ($fileupload['size'] <= 1):
					$error_messages[] = 'File does not have a valid size.';
				else:
				
					# If the user does not submit a file description, simple use the filename itself to fill the in the gap.
					if($fileupload['desc']):
						$fileupload['name'] = strtolower($fileupload['desc']).'-'._generate_rand_string().'.'.$fileupload['ext'];
					else:
						$fileupload['name'] = strtolower($fileupload['name']).'-'._generate_rand_string().'.'.$fileupload['ext'];
					endif;

					# Move the file to the specified upload directory.
					if (@move_uploaded_file($fileupload['temp'], _FILE_REPOSITORY_DIR.$fileupload['name']))
					{
						# check if the upload directory is CHMOD 755, if not return an error.
						if (!@chmod(_FILE_REPOSITORY_DIR.$fileupload['name'],0755)):

							@unlink($fileupload['temp']);
							$error_messages[] = 'CHMOD Error';

						endif;

						if(count($error_messages) == 0 && $fileupload['name']):
							$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_FILES."` (`fid`, `did`, `ftitle`, `filename`, `filesize`) VALUES (NULL, '".$did."', '".$fileupload['desc']."', '".$fileupload['name']."', '".$fileupload['size']."')");
						endif;
					} 

				endif;

			endif;

		endfor;

		for( $s = 0 ; $s < count($_FILES['userscreen']['name']) ; $s++ ):

			if($_FILES['userscreen']['name'][$s]):

				$userscreen['name']   = $_FILES['userscreen']['name'][$s];
				$userscreen['name']   = preg_replace('/\s*/m', '', $userscreen['name']);

				$userscreen['desc']  	= $_POST['userscreen_desc'][$s];
				$userscreen['error']  	= $_FILES['userscreen']['error'][$s];
				$file_parts     		= @pathinfo($_FILES['userscreen']['name'][$s]);
		    	$userscreen['ext'] 		= $file_parts['extension'];
		    	$userscreen['size']		= $_FILES['userscreen']['size'][$s];
		    	$userscreen['temp']   	= $_FILES['userscreen']['tmp_name'][$s];

				if (!in_array($userscreen['ext'],explode(',',$image_extensions))):
					$error_messages[] = 'Invalid Image Type: Image Field '.($s+1);
				endif;

			endif;

			if (is_uploaded_file($userscreen['temp']) && $userscreen['error'] == 0 && count( $error_messages ) == 0):

				# If the uploaded file has no size, Do nothing with it.
				if ($userscreen['size'] <= 1):
					$error_messages[] = 'File does not have a valid size.';
				else:
				
					# If the user does not submit a file description, simple use the filename itself to fill the in the gap.
					if($userscreen['desc']):
						$userscreen['name'] = strtolower($userscreen['desc']).'-'._generate_rand_string().'.'.$userscreen['ext'];
					else:
						$userscreen['name'] = strtolower($userscreen['name']).'-'._generate_rand_string().'.'.$userscreen['ext'];
					endif;

					if (@move_uploaded_file($userscreen['temp'], _FILE_REPOSITORY_SCREENS.$userscreen['name'])):

						# Generate the thumbnails for this submitted download.
						_create_thumb_from_image(_FILE_REPOSITORY_SCREENS.$userscreen['name'], _FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$userscreen['name'], array(
							'width' => '100',
			 				'height' => '100',
							'aspect_ratio' => true
						));

						_create_thumb_from_image(_FILE_REPOSITORY_SCREENS.$userscreen['name'], _FILE_REPOSITORY_SCREENS.'thumbs/thumb_190x120_'.$userscreen['name'], array(
							'width' => '190',
							'height' => '120',
							'aspect_ratio' => true
						));

						$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_SCREENSHOTS."` (`pid`, `did`, `active`, `filename`, `size`, `submitter`, `title`) VALUES (NULL, '".$did."', 1, '".$userscreen['name']."', '".$userscreen['size']."', '".$userinfo['username']."', '".$userscreen['desc']."')");

					endif;

				endif;

			endif;

		endfor;

		if (count( $error_messages ) > 0):
			_file_respotiroy_error_messages( $error_messages );
		else:
			_redirect('modules.php?name='.$module_name.'&action=submitdownload_success');
		endif;

	else:
		_redirect('modules.php?name='.$module_name);
	endif;
}

function _file_respotiroy_error_messages( $error_messages )
{
	global $lang_new, $module_name, $settings, $userinfo;
	OpenTable();
	echo '<div style="text-align: center;">';
	echo '<h2>There seems to have been a problem '.$userinfo['username'].'</h2>';
	echo '<p>Below is a list of error that have been returned</p>';

	echo '<p>';
	$errors = 1;
	foreach( $error_messages as $messages ):
		echo $errors.'.  '.$messages.'<br />';
		$errors++;
	endforeach;
	echo '</p>';
	echo '<p>Please click <a href="javascript:history.go(-1)">here</a> to return to the previous page and check to make sure the file & image types are allowed.</p>';
	echo '</div>';
	CloseTable();
}

function _file_repository_success_submitdownload()
{
	global $lang_new, $module_name, $settings, $userinfo;
	OpenTable();
	echo '<div style="text-align: center;">';
	echo '<p>'.sprintf($lang_new[$module_name]['SUBMITDOWNLOAD_SUCCESS'], $userinfo['username']).'</p>';
	echo '</div>';
	CloseTable();
}

switch($action):

	case 'submitdownload_success':
		_file_repository_success_submitdownload();
		break;

	case 'submitdownload_save':
		_file_repository_save_submitdownload();
		break;

	default:
		_file_repository_submitdownload();
		break;

endswitch;

		// 	echo '        <tr>'."\n";
		// 	echo '          <td'._tdcss('25%').'><input name="screenshot_title[]" type="text" style="border: 1px solid; width:96%" /></td>'."\n";
		// 	echo '          <td'._tdcss('65%').'><input name="screenshot[]" type="file" style="border: 1px solid; width:96%" accept="image/*" /></td>'."\n";
		// 	echo '          <td'._tdcss('10%','center').'><span id="add-screen-field" class="dm-sprite attachment" alt="'.$lang_new[$module_name]['SCREENSHOT_ANOTHER'].'" title="'.$lang_new[$module_name]['SCREENSHOT_ANOTHER'].'"></span></td>'."\n";
		// 	echo '        <tr>'."\n";
		// 	# below the comment is a placeholder for the mulitple screenshots.
		// 	echo '        <tr id="text_screen" style="display: none;">'."\n";
		// 	echo '          <td'._tdcss(false,false,false,2).'></td>'."\n";
		// 	echo '        <tr>'."\n";

		# below the comment is a placeholder for the mulitple downloads.
		// echo '        <tr id="text" style="display: none;">';
		// echo '          <td'._tdcss(false,'center',false,2).'></td>';
		// echo '        <tr>';

?>