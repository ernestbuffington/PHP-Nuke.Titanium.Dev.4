<?php

/************************************************************************
    Nuke-Evolution: Image Repository
    ======================================================
    Copyright (c) 2015 by lonestar-modules.com
    Author        : Lonestar
    Version       : 1.1.0
    Developer     : Lonestar - www.lonestar-modules.com				
    Notes         : N/A
************************************************************************/

if (!defined('MODULE_FILE') || !defined('_IMAGE_REPOSITORY_INDEX') )
	die('NICE TRY, BETTER LUCK NEXT TIME!');

function main()
{
	global $db, $lang_new, $module_name, $userinfo, $nukeurl, $settings, $mysettings, $myimages;
	OpenTable();
	echo '<br />';
	index_navigation_header();
//-------------------------------------------------------------------------
//	UPDATE THE JQUERY IMAGE COUNT VALUE.
//-------------------------------------------------------------------------	
	echo '<script>'."\n";
	echo '	var imagecount_per_page = "'.$settings['perpage'].'"'."\n";
    echo '</script>'."\n";	
//-------------------------------------------------------------------------
//	UPDATE THE JQUERY IMAGE COUNT VALUE.
//-------------------------------------------------------------------------	
//-------------------------------------------------------------------------
//	THIS IS THE PAGINATION CLASS.
//-------------------------------------------------------------------------	
	$pagination = new Paginator($_GET['page'],$myimages);
	$pagination->set_Limit($settings['perpage']);
	$pagination->set_Links(3);
	$limit1 = $pagination->getRange1();
	$limit2 = $pagination->getRange2();
//-------------------------------------------------------------------------
//	THIS IS THE PAGINATION CLASS.
//-------------------------------------------------------------------------	
	$result = $db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$userinfo['user_id']."' ORDER BY `uploaded` DESC LIMIT ".$limit1.", ".$limit2);
	$quotainfo = _quota_percentages($userinfo['user_id']);
	echo '<table style="width:100%;'.(($quotainfo['total_size'] >= $quotainfo['quota']) ? ' display:none;' : '').'" border="0" cellpadding="4" cellspacing="1" class="forumline" id="image_repository_upload">'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catHead',2).'>'._string_to_upper($lang_new[$module_name]['UPLOAD']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss('50%',FALSE,'catBottom').'>'._string_to_upper($lang_new[$module_name]['BROWSE']).'</td>'."\n";
	echo '    <td'.tablecss('50%',FALSE,'catBottom').'>'._string_to_upper($lang_new[$module_name]['PROGRESS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	// echo '    <td'.tablecss('50%',FALSE,'row1').'>'.inputfield('myimage','file',FALSE,'98%',FALSE,'').'</td>'."\n";
	echo '    <td'.tablecss('50%',FALSE,'row1').'><input class="col-12" type="file" name="myimage" id="myimage" style="height: auto;" accept="image/*" /></td>'."\n";
	echo '    <td'.tablecss('50%',FALSE,'row1').'><div class="progress-bar"><span class="upload"></span></div></td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',2).'>'.submitbuttoncss(FALSE,$lang_new[$module_name]['SUBMIT']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";	
//-------------------------------------------------------------------------
//	SHOW THE USER THAT THEIR QUOTA HAS BEEN REACHED.
//  IF THE USER HAS MAXED OUT THEIR QUOTA, REMOVE THE UPLOAD TABLE.
//-------------------------------------------------------------------------	
	echo '<table style="width:100%;'.(($quotainfo['total_size'] >= $quotainfo['quota']) ? '' : ' display:none;').'" border="0" cellpadding="4" cellspacing="1" class="forumline" id="image_repository_quota">'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catHead',2).'>'._string_to_upper($lang_new[$module_name]['ATTENTION']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','row1',2).'>'._string_to_upper(sprintf($lang_new[$module_name]['QUOTA_REACHED'],UsernameColor($userinfo['username']))).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
//-------------------------------------------------------------------------
//	SHOW THE USER THAT THEIR QUOTA HAS BEEN REACHED.
//  IF THE USER HAS MAXED OUT THEIR QUOTA, REMOVE THE UPLOAD TABLE.
//-------------------------------------------------------------------------	
	echo '<br />';	
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" id="imagetable">'."\n";
	echo '	<tr id="errortable_tr">'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',2).' id="errortable_header">'._string_to_upper($lang_new[$module_name]['MYIMAGES']).'</td>'."\n";
	echo '  </tr>'."\n";
//-------------------------------------------------------------------------
//	SHOW THAT NO IMAGES CURRENTLY EXIST IN THEIR DATABASE.
//-------------------------------------------------------------------------	
	echo '  <tr id="noimages" '.(($db->sql_numrows($result) == 0) ? '' : 'style="display:none;"').'>'."\n";
	echo '    <td'.tablecss(FALSE,'center','row1',2).'>'._string_to_upper($lang_new[$module_name]['IMAGE_NONE']).'</td>'."\n";
	echo '  </tr>'."\n";
//-------------------------------------------------------------------------
//	SHOW THAT NO IMAGES CURRENTLY EXIST IN THEIR DATABASE.
//-------------------------------------------------------------------------	
	echo '  <tr id="imagelist" '.(($db->sql_numrows($result) == 0) ? 'style="display:none;"' : '').'>'."\n";
	echo '    <td'.tablecss('15%','center','catBottom').'>'._string_to_upper($lang_new[$module_name]['IMAGE']).'</td>'."\n";
	echo '    <td'.tablecss('85%','center','catBottom').'>'._string_to_upper($lang_new[$module_name]['CODES']).'</td>'."\n";
	echo '  </tr>'."\n";	
	if($db->sql_numrows($result) > 0)
	{
		while($row = $db->sql_fetchrow($result))
		{	
			echo '	<tr class="imagethumbs" id="image-'.$row['pid'].'">'."\n";	
//-------------------------------------------------------------------------
//	CHECK TO MAKE SURE A THUMBNAIL EXISTS, IF IT DOES NOT, MAKE ONE.
//-------------------------------------------------------------------------		
			if(!file_exists(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename']))
			{
				echo '    <td'.tablecss(FALSE,'center','row1').' id="thumbnail_holder'.$row['pid'].'"><a'.linkcss().' data-id="'.$row['pid'].'" class="generate-thumbnail" href="">'.$lang_new[$module_name]['GENERATE'].'</a></td>'."\n";
			}
//-------------------------------------------------------------------------
//	CHECK TO MAKE SURE A THUMBNAIL EXISTS, IF IT DOES NOT, MAKE ONE.
//-------------------------------------------------------------------------	
			else
			{
//-------------------------------------------------------------------------
//	IF THE FULL SIZE IMAGE IS SMALLER THEN THE SET THUMBNAIL SIZE,
//	LET ME KNOW, SO THAT I CAN GENERATE A THUMBNAIL. 
//-------------------------------------------------------------------------	
				$imagesize_info = @getimagesize(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename']);
				if(file_exists(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename']) && ($imagesize_info[0] < _IREPOSITORY_THUMBWIDTH || $imagesize_info[0] < _IREPOSITORY_THUMBHEIGHT) && $row['bypass_thumb'] == 0)
				{
					$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_UPLOADS."` SET `bypass_thumb`='1' WHERE `pid`='".$row['pid']."' && `submitter`='".$userinfo['user_id']."'");
					echo '    <td'.tablecss(FALSE,'center','row1').' id="thumbnail_holder'.$row['pid'].'">';
					echo '      <div class="thumbnail_border"><img class="thumbnail_border" src="'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'].'" /></div>';
					echo '    </td>'."\n"; 
				}
//-------------------------------------------------------------------------
//	IF THE FULL SIZE IMAGE IS SMALLER THEN THE SET THUMBNAIL SIZE,
//	LET ME KNOW, SO THAT I CAN GENERATE A THUMBNAIL.  
//-------------------------------------------------------------------------	
				else
//-------------------------------------------------------------------------
//	IF THE FULL IMAGE HAS A THUMBNAIL, CHECK IT'S SIZE TO MAKE SURE IT,
//	MATCHES THE NEW THUMBNAIL SIZE IN VERSION 1.1.0. 
//-------------------------------------------------------------------------	
				{
					$thumb_info = @getimagesize(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename']);
					if($thumb_info[0] <> _IREPOSITORY_THUMBWIDTH && $thumb_info[1] <> _IREPOSITORY_THUMBHEIGHT && $row['bypass_thumb'] == 0)
					{
						_createthumb(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'], _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'], array('width' => _IREPOSITORY_THUMBWIDTH, 'height' => _IREPOSITORY_THUMBHEIGHT, 'aspect_ratio' => TRUE));
					}
					echo '    <td'.tablecss(FALSE,'center','row1').' id="thumbnail_holder'.$row['pid'].'">';
					echo '      <div class="thumbnail_border"><img class="thumbnail_border" src="'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'].'" /></div>';
					echo '    </td>'."\n";
				}
//-------------------------------------------------------------------------
//	IF THE FULL IMAGE HAS A THUMBNAIL, CHECK IT'S SIZE TO MAKE SURE IT,
//	MATCHES THE NEW THUMBNAIL SIZE IN VERSION 1.1.0. 
//-------------------------------------------------------------------------	
			}		
			echo '    <td'.tablecss(FALSE,'center','row1').'>'."\n";
			echo '      <table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
			echo '        <tr>'."\n";
			echo '          <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['DIRECT'].'</td>';
			echo '          <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('direct','text',FALSE,'98%',FALSE,$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'],FALSE,TRUE,FALSE,FALSE,TRUE).'</td>';
			echo '        </tr>'."\n".'<tr>'."\n";
			echo '          <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['BBCODE'].'</td>';
			echo '          <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('bbcode','text',FALSE,'98%',FALSE,'[img]'.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'].'[/img]',FALSE,TRUE,FALSE,FALSE,TRUE).'</td>';
			echo '        </tr>'."\n".'<tr>'."\n";
			echo '          <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['OPTIONS'].'</td>';
			echo '          <td'.tablecss('80%','left','row1').'>';		
			// echo '            <a'.linkcss().' data-id="'.$row['pid'].'" class="code-popup" href="javascript:void(0);">'.$lang_new[$module_name]['CODES_PLUS'].'</a> | ';
			echo '            <a'.linkcss().get_image_viewer('myimages').' href="'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'].'">'.$lang_new[$module_name]['FULL'].'</a> | ';
			echo '            <a'.linkcss().' data-id="'.$row['pid'].':::'.$row['size'].'" class="delete-image" href="javascript:void(0);">'.$lang_new[$module_name]['DELETE'].'</a>';
			echo '          </td>';
			echo '        </tr>'."\n";
			echo '      </table>'."\n";
			echo '    </td>'."\n";			
			echo '  </tr>'."\n";
		}
		$db->sql_freeresult($result);
	}
//-------------------------------------------------------------------------
//	HERE WE HAVE THE PAGINATION LINKS, IF THE CURRENT IMAGE COUNT DOES NOT,
//	EXCEED THE NUMBER OF IMAGES SPECFIED PER PAGE, SHOW NOTHING.
//-------------------------------------------------------------------------	
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'right','catBottom',2).'>';
//-------------------------------------------------------------------------
//	PAGINATION LINKS
//-------------------------------------------------------------------------
	if($myimages > $settings['perpage'])
	{
		if ($pagination->getCurrent() == 1)
			$first = ' | <span>'.$lang_new[$module_name]['FIRST'].'</span> | ';
		else
			$first = ' | <a'.linkcss().' href="modules.php?name='.$module_name.'&amp;page='.$pagination->getFirst().'">'.$lang_new[$module_name]['FIRST'].'</a> |';
			
		if ($pagination->getPrevious())
			$prev = '<a'.linkcss().' href="modules.php?name='.$module_name.'&amp;page='.$pagination->getPrevious().'">'.$lang_new[$module_name]['PREVIOUS'].'</a> | ';
		else
			$prev = $lang_new[$module_name]['PREVIOUS'].' | ';
			
		if ($pagination->getNext())
			$next = '<a'.linkcss().' href="modules.php?name='.$module_name.'&amp;page='.$pagination->getNext().'">'.$lang_new[$module_name]['NEXT'].'</a> | ';
		else
			$next = $lang_new[$module_name]['NEXT'].' | ';
			
		if ($pagination->getLast())
			$last = '<a'.linkcss().' href="modules.php?name='.$module_name.'&amp;page='.$pagination->getLast().'">'.$lang_new[$module_name]['LAST'].'</a>';
		else
			$last = $lang_new[$module_name]['LAST'];
			
		echo $pagination->getFirstOf().' '.$lang_new[$module_name]['TO'].' '.$pagination->getSecondOf().' '.$lang_new[$module_name]['OF'].' <span class="pagination_total">'.$pagination->getTotalItems().'</span> '.$first . " " . $prev . " " . $next . " " . $last;
//-------------------------------------------------------------------------
//	PAGINATION LINKS
//-------------------------------------------------------------------------
	}
	else
	{
		echo '&nbsp;';
	}
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
//-------------------------------------------------------------------------
//	HERE WE HAVE THE PAGINATION LINKS, IF THE CURRENT IMAGE COUNT DOES NOT,
//	EXCEED THE NUMBER OF IMAGES SPECFIED PER PAGE, SHOW NOTHING.
//-------------------------------------------------------------------------	
	echo '</table>'."\n";
	echo '<br />';
	CloseTable();
}

function uploadmyimage()
{
	global $db, $lang_new, $module_name, $userinfo, $settings;
//-------------------------------------------------------------------------
//	CHECK IF IT'S AN AJAX REQUEST, EXIT IF NOT.
//-------------------------------------------------------------------------
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
        die(json_encode(array('error' => $lang_new[$module_name]['NEXT_TIME'])));
//-------------------------------------------------------------------------
//	CHECK IF IT'S AN AJAX REQUEST, EXIT IF NOT.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	ALERT THE USER, IF THEY HAVE REACHED THEIR ALLOTTED QUOTA.
//-------------------------------------------------------------------------
    $quotainfo = _quota_percentages($userinfo['user_id']);
    if($quotainfo['total_size'] > $quotainfo['quota'])
    {
    	die(json_encode(array('error' => sprintf($lang_new[$module_name]['QUOTA_REACHED'],$userinfo['username']))));
    }
//-------------------------------------------------------------------------
//	ALERT THE USER, IF THEY HAVE REACHED THEIR ALLOTTED QUOTA.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	DO A QUICK CHECK TO MAKE SURE THE FILE BE UPLOADED IS AN IMAGE.
//-------------------------------------------------------------------------
	$image_size_info = @getimagesize($_FILES['myimage']['tmp_name']);
	switch(strtolower($image_size_info['mime']))
	{
		case 'image/png': 
		case 'image/gif': 
		case 'image/jpeg': 
		case 'image/pjpeg':
			break;
		default:
			die(json_encode(array('error' => $lang_new[$module_name]['SUPPORTED'])));
	}
//-------------------------------------------------------------------------
//	DO A QUICK CHECK TO MAKE SURE THE FILE BE UPLOADED IS AN IMAGE.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	MAKE SURE THE IMAGE DOES NOT EXCEED THE SPECIFIED MAX SIZE IN ADMIN.
//-------------------------------------------------------------------------
	if($_FILES['myimage']['size'] > $settings['max_upload'])
		die(json_encode(array('error' => sprintf($lang_new[$module_name]['IMAGE_SIZE_ERROR'],_calculate_size($settings['max_upload'])))));
//-------------------------------------------------------------------------
//	MAKE SURE THE IMAGE DOES NOT EXCEED THE SPECIFIED MAX SIZE IN ADMIN.
//-------------------------------------------------------------------------
	$ext 				= substr($_FILES['myimage']['name'], strpos($_FILES['myimage']['name'], '.')+1, strlen($_FILES['myimage']['name']));
	$randomise 			= _random_string().'.'.strtolower($ext);
	$natural_size  		= $image_size_info[0].' x '.$image_size_info[1];
	if (move_uploaded_file($_FILES['myimage']['tmp_name'], _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$randomise))
	{
//-------------------------------------------------------------------------
//	GENERATE A THUMBNAIL FOR USE IN THE FORUMS.
//-------------------------------------------------------------------------
		$db->sql_query("INSERT INTO `"._IMAGE_REPOSITORY_UPLOADS."` (`pid`,`filename`,`submitter`,`image`,`size`,`screensize`,`uploaded`) VALUES (NULL,'".$randomise."','".$userinfo['user_id']."','".$randomise."','".$_FILES['myimage']['size']."','".$natural_size."','".time()."')");
		if($image_size_info[0] > _IREPOSITORY_THUMBWIDTH || $image_size_info[1] > _IREPOSITORY_THUMBHEIGHT)
		{
			_createthumb(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$randomise, _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$randomise, array('width' => _IREPOSITORY_THUMBWIDTH, 'height' => _IREPOSITORY_THUMBHEIGHT, 'aspect_ratio' => TRUE));
		} else {				
			@copy(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$randomise, _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$randomise);
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_UPLOADS."` SET `bypass_thumb`='1' WHERE `pid`='".$db->sql_nextid()."' && `submitter`='".$userinfo['user_id']."'");
		}
//-------------------------------------------------------------------------
//	GENERATE A THUMBNAIL FOR USE IN THE FORUMS.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	UPON COMPLETION OF THE IMAGE UPLOAD, LET'S GENERATE THE RESPONSE JSON.
//-------------------------------------------------------------------------
		$response = array(
			'name' 			=> $randomise, 
			'image' 		=> $randomise, 
			'size' 			=> $_FILES['myimage']['size'], 
			'resolution'	=> $natural_size, 
			'uploaded'		=> formatTimestamp_to_date('D M d, Y g:i a', time(), $userinfo['user_timezone']), 
			'nextid' 		=> $db->sql_nextid()
		);
		die(json_encode($response));
//-------------------------------------------------------------------------
//	UPON COMPLETION OF THE IMAGE UPLOAD, LET'S GENERATE THE RESPONSE JSON.
//-------------------------------------------------------------------------
	} else {
//-------------------------------------------------------------------------
//	THROW OUT AN ERROR, IF SOMETHING HAS GONE WRONG.
//-------------------------------------------------------------------------
		die(json_encode(array('error' => $lang_new[$module_name]['SOMETHING_WRONG'])));
//-------------------------------------------------------------------------
//	THROW OUT AN ERROR, IF SOMETHING HAS GONE WRONG.
//-------------------------------------------------------------------------
	}
}

function generatemythumb()
{
	global $db, $lang_new, $module_name, $userinfo;
	$row = $db->sql_fetchrow($db->sql_query("SELECT `filename`, `submItter` FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `pid`='".$_POST['pid']."'"));
//-------------------------------------------------------------------------
//	CHECK WHOEVER IS TRYING TO GENERATE THUMB, OWNS THE IMAGE
//-------------------------------------------------------------------------
	if($row['submitter'] == $userinfo['user_id'])
		die(json_encode(array('error' => $lang_new[$module_name]['NEXT_TIME_OWNER'])));
//-------------------------------------------------------------------------
//	CHECK WHOEVER IS TRYING TO GENERATE THUMB, OWNS THE IMAGE
//-------------------------------------------------------------------------	
	$image_size_info = @getimagesize(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename']);
	if($image_size_info[0] > _IREPOSITORY_THUMBWIDTH || $image_size_info[1] > _IREPOSITORY_THUMBHEIGHT)
	{
//-------------------------------------------------------------------------
//	IF THE UPLOADED IMAGE, EXCEEDS THE SPECIFIED THUMBNAIL SIZE,
//	GENERATE A THUMBNAIL, THIS WILL GREATLY IMPROVE ON PAGE LOAD TIMES.
//-------------------------------------------------------------------------	
		if(_createthumb(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'], _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'], array('width' => _IREPOSITORY_THUMBWIDTH, 'height' => _IREPOSITORY_THUMBHEIGHT, 'aspect_ratio' => TRUE)))
			die(json_encode(array('filename' => $row['filename'])));
		else
			die(json_encode(array('error' => $lang_new[$module_name]['SOMETHING_WRONG_THUMB'])));
//-------------------------------------------------------------------------
//	IF THE UPLOADED IMAGE, EXCEEDS THE SPECIFIED THUMBNAIL SIZE,
//	GENERATE A THUMBNAIL, THIS WILL GREATLY IMPROVE ON PAGE LOAD TIMES.
//-------------------------------------------------------------------------	
	} 
	else 
	{
//-------------------------------------------------------------------------
//	IF THE UPLOADED IMAGE, IS EQUAL TOO OR UNDER THE SPECIFIED THUMB SIZE,
//	JUST MOVE THAT IMAGE TO THE THUMBNAIL DIRECTORY AND LEAVE IT ALONE.
//-------------------------------------------------------------------------	
		if(@copy(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'], _IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename']))
			die(json_encode(array('filename' => $row['filename'])));
		else
			die(json_encode(array('error' => $lang_new[$module_name]['SOMETHING_WRONG_THUMB'])));
//-------------------------------------------------------------------------
//	IF THE UPLOADED IMAGE, IS EQUAL TOO OR UNDER THE SPECIFIED THUMB SIZE,
//	JUST MOVE THAT IMAGE TO THE THUMBNAIL DIRECTORY AND LEAVE IT ALONE.
//-------------------------------------------------------------------------	
	}
}

function deletemyimage()
{
	global $db, $lang_new, $module_name, $userinfo;
	$row  = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `pid`='".$_POST['pid']."'"));
	if(is_admin() || $userinfo['user_id'] == $row['submitter'])
	{
//-------------------------------------------------------------------------
//	AWWW, YOU WANT TO DELETE THE IMAGE, OKIES, LETS REMOVE THE FILE,
//	FROM THE DATABASE, AND REMOVE ANY TRACE OF IT.
//-------------------------------------------------------------------------	
		if(@unlink(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename']))
		{
			@unlink(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/thumbs/thumb_'.$row['filename']);
			$db->sql_query("DELETE FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `pid`='".$row['pid']."'");
			$db->sql_optimize(_IMAGE_REPOSITORY_UPLOADS);
		}
//-------------------------------------------------------------------------
//	AWWW, YOU WANT TO DELETE THE IMAGE, OKIES, LETS REMOVE THE FILE,
//	FROM THE DATABASE, AND REMOVE ANY TRACE OF IT.
//-------------------------------------------------------------------------	
	} else {
//-------------------------------------------------------------------------
//	IF YOU ARE NOT THE OWNER OF THIS IMAGE, BUGGER OFF.
//-------------------------------------------------------------------------	
		die(json_encode(array('error' => $lang_new[$module_name]['NEXT_TIME_OWNER'])));
//-------------------------------------------------------------------------
//	IF YOU ARE NOT THE OWNER OF THIS IMAGE, BUGGER OFF.
//-------------------------------------------------------------------------	
	}
}

function modal_code_popup()
{
	global $db, $lang_new, $module_name, $userinfo, $nukeurl;
	$result = $db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$userinfo['user_id']."' && `pid`='".$_GET['pid']."'");
	$row = $db->sql_fetchrow($result);
	OpenTable();
	echo '<table style="width: 700px;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '	<tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catHead',2).'>'._string_to_upper($lang_new[$module_name]['EXTRA_CODES']).'</td>'."\n";
	echo '  </tr>'."\n";
//-------------------------------------------------------------------------
//	HERE WE HAVE THE IMAGE URL SHORT CODES, IVE BEEN WORKING ON THIS,
//	BBCODE FOR USE IN THE FORUMS.
//-------------------------------------------------------------------------	
//	echo '  <tr>'."\n";
//	echo '	  <td'.tablecss('20%','right','row1').'>Short Codes</td>'."\n";
//	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('direct','text',FALSE,'98%',FALSE,'[image_repository uid=\''._IREPOSITORY_USER_FOLDER.'\' id=\''.$_GET['pid'].'\']',FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
//	echo '  </tr>'."\n";
//-------------------------------------------------------------------------
//	HERE WE HAVE THE IMAGE URL SHORT CODES, IVE BEEN WORKING ON THIS,
//	BBCODE FOR USE IN THE FORUMS.
//-------------------------------------------------------------------------	
	echo '	<tr>'."\n";
	echo '    <td'.tablecss(FALSE,FALSE,'catHead',2).'>'._string_to_upper($lang_new[$module_name]['CODES']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['DIRECT'].'</td>'."\n";
	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('direct','text',FALSE,'98%',FALSE,$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'],FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['BBCODE'].'</td>'."\n";
	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('bbcode','text',FALSE,'98%',FALSE,'[img]'.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'].'[/img]',FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['HTML'].'</td>'."\n";
	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('html','text',FALSE,'98%',FALSE,'<img src=\''.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'].'\' border=\'0\' alt=\'\' />',FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '    <td'.tablecss(FALSE,FALSE,'catHead',2).'>'._string_to_upper($lang_new[$module_name]['CODES_THUMBS']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['DIRECT'].'</td>'."\n";
	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('direct','text',FALSE,'98%',FALSE,$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'],FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['BBCODE'].'</td>'."\n";
	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('bbcode','text',FALSE,'98%',FALSE,'[url='.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'].'][img]'.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'].'[/img][/url]',FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('20%','right','row1').'>'.$lang_new[$module_name]['HTML'].'</td>'."\n";	
	echo '	  <td'.tablecss('80%',FALSE,'row1').'>'.inputfield('html','text',FALSE,'98%',FALSE,'<a href=\''.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename'].'\' class=\'fancybox\'><img src=\''.$nukeurl.'/'._IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER_THUMBS.'/thumb_'.$row['filename'].'\' border=\'0\' alt=\'\' /></a>',FALSE,TRUE,FALSE,FALSE,TRUE).'</td>'."\n";
	echo '  </tr>'."\n";	
	echo '  <tr>'."\n";
	echo '	  <td'.tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
}
//-------------------------------------------------------------------------
//	USER SETTINGS, LET'S THE MODIFY THE LOOK OF THE PERENTAGE BAR
//-------------------------------------------------------------------------
function mysettings()
{
	global $db, $lang_new, $module_name, $userinfo, $settings, $mysettings;
	
	if(!isset($_POST['submit'])) 
    $_POST['submit'] = '';

	
	if($_POST['submit'] && $_POST['uid'] == $userinfo['user_id'])
	{
//-------------------------------------------------------------------------
//	OK, LETS UPDATE THE USERS SETTINGS.
//-------------------------------------------------------------------------
		$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_USERS."` SET `border_color`='".$_POST['border_color']."', `background_color`='".$_POST['background_color']."', `percent_color`='".$_POST['percent_color']."', `custom_color`='".$_POST['custom_color']."' WHERE `uid` = '".$userinfo['user_id']."'");
//-------------------------------------------------------------------------
//	OK, LETS UPDATE THE USERS SETTINGS.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	UPDATE THE ADMINISTRATION SETTINGS, ONLY ADMINS CAN DO THIS.
//-------------------------------------------------------------------------
		if(is_admin())
		{
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_SETTINGS."` SET `config_value`='"._calculate_bytesize($_POST['quota'])."' WHERE `config_name`='quota'");
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_SETTINGS."` SET `config_value`='"._calculate_bytesize($_POST['max_upload'])."' WHERE `config_name`='max_upload'");
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['spacing']."' WHERE `config_name`='spacing'");
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['perpage']."' WHERE `config_name`='perpage'");
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_SETTINGS."` SET `config_value`='".$_POST['admin_perpage']."' WHERE `config_name`='admin_perpage'");
		}
//-------------------------------------------------------------------------
//	UPDATE THE ADMINISTRATION SETTINGS, ONLY ADMINS CAN DO THIS.
//-------------------------------------------------------------------------
		_redirect('modules.php?name='.$module_name.'&op=settings');
	}

	OpenTable();
	index_navigation_header();
	echo '<form action="modules.php?name='.$module_name.'&amp;op=settings" method="post">'."\n";
	echo '<table style="width:100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catHead',3).'>'._string_to_upper($lang_new[$module_name]['SETTINGS_CONFIGURE']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss(FALSE,FALSE,'catHead',3).'>'._string_to_upper($lang_new[$module_name]['PROGRESS_BAR']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('33.333%',FALSE,'catHead').'>'._string_to_upper($lang_new[$module_name]['BORDER']).'</td>'."\n";
	echo '	  <td'.tablecss('33.333%',FALSE,'catHead').'>'._string_to_upper($lang_new[$module_name]['BACKGROUND']).'</td>'."\n";
	echo '	  <td'.tablecss('33.333%',FALSE,'catHead').'>'._string_to_upper($lang_new[$module_name]['PERCENTAGE']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss('25%','center','row1').'>'.color_selection('border_color',$mysettings['border_color'],FALSE,FALSE,'80%').'</td>'."\n";
	echo '	  <td'.tablecss('25%','center','row1').'>'.color_selection('background_color',$mysettings['background_color'],TRUE,TRUE,'80%').'</td>'."\n";
	echo '	  <td'.tablecss('25%','center','row1').'>'.color_selection('percent_color',$mysettings['percent_color'],TRUE,FALSE,(($mysettings['percent_color'] == 'custom') ? '40%' : '80%')).inputfield('custom_color','text',FALSE,'40%',FALSE,$mysettings['custom_color'],FALSE,FALSE,FALSE,FALSE,FALSE,(($mysettings['percent_color'] == 'custom') ? 'show' : 'none'), '#11007f').'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','row1',2).'><div class="progress-bar"><span></span></div></td>'."\n";
	echo '    <td'.tablecss(FALSE,'center','row1',1).'>';
	echo '      <a data-id="0" class="percentage" href="javascript:void(0);">'.$lang_new[$module_name]['PERCENTAGE-0'].'</a>&nbsp;|&nbsp;';
	echo '      <a data-id="5" class="percentage" href="javascript:void(0);">'.$lang_new[$module_name]['PERCENTAGE-5'].'</a>&nbsp;|&nbsp;';
	echo '      <a data-id="25" class="percentage" href="javascript:void(0);">'.$lang_new[$module_name]['PERCENTAGE-25'].'</a>&nbsp;|&nbsp;';
	echo '      <a data-id="50" class="percentage" href="javascript:void(0);">'.$lang_new[$module_name]['PERCENTAGE-50'].'</a>&nbsp;|&nbsp;';
	echo '      <a data-id="75" class="percentage" href="javascript:void(0);">'.$lang_new[$module_name]['PERCENTAGE-75'].'</a>&nbsp;|&nbsp;';
	echo '      <a data-id="100" class="percentage" href="javascript:void(0);">'.$lang_new[$module_name]['PERCENTAGE-100'].'</a>';
	echo '    </td>';
	echo '  </tr>'."\n";
//-------------------------------------------------------------------------
//	MOVED THE ADMINISTRATION SETTINGS TO HERE TO SAVE ON THE AMOUNT OF,
//	FILES IN THE PACKAGE, THEY ARE ONLY VISIBLE TO THOSE LOGGED IN AS ADMIN
//-------------------------------------------------------------------------
	if(is_admin())
	{
		echo '  <tr>'."\n";
		echo '    <td'.tablecss(FALSE,'center','catHead',3).'>'._string_to_upper($lang_new[$module_name]['ADMINISTRATION']).'</td>'."\n";
		echo '  </tr>'."\n".'<tr>'."\n";
		echo '    <td'.tablecss(FALSE,FALSE,'row1',3).'>';
		echo '      <table style="width:100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
		echo '        <tr>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>Version Check</td>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').' id="version_alert">&nbsp;</td>'."\n";
		echo '        </tr>'."\n".'<tr>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.$lang_new[$module_name]['QUOTA_DEFAULT'].'</td>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.inputfield('quota','text',6,FALSE,FALSE,_calculate_size($settings['quota'])).'</td>'."\n";
		echo '        </tr>'."\n".'<tr>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.$lang_new[$module_name]['IMAGE_MAX'].'</td>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.inputfield('max_upload','text',6,FALSE,FALSE,_calculate_size($settings['max_upload'])).'</td>'."\n";
		echo '        </tr>'."\n".'<tr>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.$lang_new[$module_name]['SPACING'].'</td>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.selectbox('spacing',$settings['spacing'],array('0' => $lang_new[$module_name]['SPACING_NONE'], '1' => '1px', '2' => '2px')).'</td>'."\n";
		echo '        </tr>'."\n".'<tr>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.$lang_new[$module_name]['PERPAGE_IMAGES'].'</td>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.selectbox_range('perpage',$settings['perpage'],'1','51','1').'</td>'."\n";
		echo '        </tr>'."\n".'<tr>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.$lang_new[$module_name]['PERPAGE_USERS'].'</td>'."\n";
		echo '	        <td'.tablecss('50%',FALSE,'row1').'>'.selectbox_range('admin_perpage',$settings['admin_perpage'],'1','51','1').'</td>'."\n";
		echo '        </tr>'."\n";
		echo '      </table>';
		echo '    </td>';		
		echo '  </tr>'."\n";
	}
//-------------------------------------------------------------------------
//	MOVED THE ADMINISTRATION SETTINGS TO HERE TO SAVE ON THE AMOUNT OF,
//	FILES IN THE PACKAGE, THEY ARE ONLY VISIBLE TO THOSE LOGGED IN AS ADMIN
//-------------------------------------------------------------------------
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',3).'>'.submitbuttoncss(FALSE,$lang_new[$module_name]['SAVE_SETTINGS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo inputfield('uid','hidden',FALSE,FALSE,FALSE,$mysettings['uid']);
	echo '</form>'."\n";	
	CloseTable();
}
//-------------------------------------------------------------------------
//	USER SETTINGS, LET'S THE MODIFY THE LOOK OF THE PERENTAGE BAR
//-------------------------------------------------------------------------
function myquota()
{
	global $db, $lang_new, $module_name, $userinfo, $settings;
	$quotainfo = _quota_percentages($userinfo['user_id']);
	OpenTable();
	index_navigation_header();
//-------------------------------------------------------------------------
//	JQUERY, TO UPDATE THE PERCENTAGE BAR WITH YOUR QUOTA PROGRESS
//-------------------------------------------------------------------------
	echo '<script>';
//-------------------------------------------------------------------------
//	IF THIS IS EVOLUTION XTREME, USE JQUERY NOCONFLICT
//-------------------------------------------------------------------------
	if(function_exists('redirect'))
		echo '	nuke_jq(document).ready(function($)';
	else
		echo '	$(document).ready(function($)';
//-------------------------------------------------------------------------
//	IF THIS IS EVOLUTION XTREME, USE JQUERY NOCONFLICT
//-------------------------------------------------------------------------
	echo '	{';
	echo '		$(".progress-bar span").css("width", "'.$quotainfo['percentage'].'%");';
    echo '	});';
    echo '</script>';
//-------------------------------------------------------------------------
//	JQUERY, TO UPDATE THE PERCENTAGE BAR WITH YOUR QUOTA PROGRESS
//-------------------------------------------------------------------------	
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline" id="quotatable">'."\n";
	echo '	<tr>'."\n";
	echo '    <td'.tablecss('20%',FALSE,'catHead').'>'._string_to_upper($lang_new[$module_name]['QUOTA']).'</td>'."\n";
	echo '    <td'.tablecss('20%',FALSE,'catHead').'>'._string_to_upper($lang_new[$module_name]['QUOTA_USED']).'</td>'."\n";
	echo '    <td'.tablecss('60%',FALSE,'catHead').'>'._string_to_upper($lang_new[$module_name]['QUOTA_PROGRESS']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr'.(($quotainfo['total_size'] == 0) ? '' : ' style="display:none;"').'>'."\n";
	echo '	  <td'.tablecss(FALSE,'center','row1',3).'>'.$lang_new[$module_name]['IMAGE_NONE'].'</td>'."\n";
	echo '  </tr>'."\n".'<tr'.(($quotainfo['total_size'] > 0) ? '' : ' style="display:none;"').'>'."\n";
	echo '	  <td'.tablecss('20%','center','row1').'>'._calculate_size($quotainfo['quota']).'</td>'."\n";
	echo '	  <td'.tablecss('20%','center','row1').'>'._calculate_size($quotainfo['total_size']).'</td>'."\n";
	echo '	  <td'.tablecss('60%','center','row1').'><div class="progress-bar"><span class="upload"></span></div></td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss(FALSE,'center','catBottom',3).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
}

function manage_users()
{
	global $db, $lang_new, $module_name, $settings;
//-------------------------------------------------------------------------
//	DENY ANYONE WHO ISNT AN ADMIN.
//-------------------------------------------------------------------------	
	if(!is_admin())
		_redirect('modules.php?name='.$module_name);
//-------------------------------------------------------------------------
//	DENY ANYONE WHO ISNT AN ADMIN.
//-------------------------------------------------------------------------	
	$total  	= $db->sql_numrows($db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_USERS."`"));
//-------------------------------------------------------------------------
//	PAGINATION CLASS, LETS GET IT SETUP.
//-------------------------------------------------------------------------	
	$pagination = new Paginator($_GET['page'],$total);
	$pagination->set_Limit($settings['admin_perpage']);
	$pagination->set_Links(3);
	$limit1 	= $pagination->getRange1();
	$limit2 	= $pagination->getRange2();	
//-------------------------------------------------------------------------
//	PAGINATION CLASS, LETS GET IT SETUP.
//-------------------------------------------------------------------------	
//-------------------------------------------------------------------------
//	REFINE YOUR SEARCH FOR USERS.
//-------------------------------------------------------------------------
	if (isset($_GET['alphanum']) || isset($_POST['alphanum'])) {
		$alphanum = ( isset($_POST['alphanum']) ) ? htmlspecialchars($_POST['alphanum']) : htmlspecialchars($_GET['alphanum']);
		$alphanum = str_replace("\'", "''", $alphanum);
		$alpha_where_first = ( $alphanum == 'num' ) ? "AND u.`username` NOT RLIKE '^[A-Z]' " : "AND u.`username` LIKE '$alphanum%' ";
	} else {
		$alpahnum = '';
		$alpha_where_first = '';
	}
//-------------------------------------------------------------------------
//	REFINE YOUR SEARCH FOR USERS.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	LETS UPDATE THE SELECTED USERS QUOTA.
//-------------------------------------------------------------------------
	if($_POST['quota'])
	{
		$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_USERS."` SET `quota`='"._calculate_bytesize($_POST['quota'])."' WHERE `uid`='".$_POST['uid']."'");
		_redirect('modules.php?name='.$module_name.'&op=users'.(($_POST['page']) ? '&page='.$_POST['page'] : ''));
	}
//-------------------------------------------------------------------------
//	LETS UPDATE THE SELECTED USERS QUOTA.
//-------------------------------------------------------------------------	
	$result 	= $db->sql_query("SELECT * FROM ("._IMAGE_REPOSITORY_USERS." s, "._USERS_TABLE." u) WHERE u.user_id = s.uid ".$alpha_where_first."ORDER BY u.`username` ASC LIMIT ".$limit1.", ".$limit2);
	OpenTable();
	index_navigation_header();
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";	
	echo '	<tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',5).'>'._string_to_upper($lang_new[$module_name]['USERS']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '	  <td'.tablecss(FALSE,'center','row1',5).'>'.(($db->sql_numrows($result) > 0) ? _alphabetlist() : $lang_new[$module_name]['USER_NONE']).'</td>'."\n";
	echo '  </tr>'."\n".'<tr '.(($db->sql_numrows($result) > 0) ? '' : 'style="display:none;"').'>'."\n";
	echo '	  <td'.tablecss('20%',FALSE,'catBottom').'>'.$lang_new[$module_name]['USER'].'</td>'."\n";
	echo '	  <td'.tablecss('20%',FALSE,'catBottom').'>'.$lang_new[$module_name]['IMAGECOUNT'].'</td>'."\n";
	echo '	  <td'.tablecss('20%',FALSE,'catBottom').'>'.$lang_new[$module_name]['QUOTA_USED'].'</td>'."\n";
	echo '	  <td'.tablecss('20%',FALSE,'catBottom').'>'.$lang_new[$module_name]['QUOTA_LEFT'].'</td>'."\n";
	echo '	  <td'.tablecss('20%','center','catBottom').'>'.$lang_new[$module_name]['OPTIONS'].'</td>'."\n";
	echo '  </tr>'."\n";
	$i = 0;
	while($row = $db->sql_fetchrow($result))
	{
		$row['username'] = (function_exists('UsernameColor')) ? UsernameColor($row['username']) : $row['username'];
		$quotainfo = _quota_percentages($row['uid']);
		if($row['uid'] > 1)
		{
			$image_count = $db->sql_numrows($db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$row['uid']."'"));	
			echo '  <tr id="user-'.$row['uid'].'">'."\n";
			if(function_exists('redirect'))
				echo '	  <td'.tablecss('20%',FALSE,'row1').'><a href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$row['user_id'].'" target="_BLANK">'.$row['username'].'</a></td>'."\n";
			else
				echo '	  <td'.tablecss('20%',FALSE,'row1').'><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$row['username'].'" target="_BLANK">'.$row['username'].'</a></td>'."\n";
			echo '	  <td'.tablecss('20%',FALSE,'row1').'>'.(($image_count == 0) ? $lang_new[$module_name]['IMAGECOUNT_ZERO'] : sprintf($lang_new[$module_name]['IMAGECOUNT_TOTAL'], $row['uid'], $image_count)).'</td>'."\n";
			echo '	  <td'.tablecss('20%',FALSE,'row1').'>'._calculate_size($quotainfo['total_size']).'</td>'."\n";
			echo '	  <td'.tablecss('20%',FALSE,'row1').'><form action="modules.php?name='.$module_name.'&amp;op=users&amp;uid='.$row['uid'].'" method="post">'.inputfield('page','hidden',FALSE,FALSE,FALSE,$_GET['page']).inputfield('uid','hidden',FALSE,FALSE,FALSE,$row['uid']).'&nbsp;'.inputfield('quota','text',10,FALSE,FALSE,_calculate_size($row['quota'])).'&nbsp;'.submitbuttoncss(FALSE,$lang_new[$module_name]['SAVE']).'</form></td>'."\n";
			echo '	  <td'.tablecss('20%','center','row1').'><a'.linkcss().' data-id="'.$row['uid'].'" class="delete-user" href="">'.$lang_new[$module_name]['DELETE'].'</a></td>'."\n";
			echo '  </tr>'."\n";
		}
	}
	$db->sql_freeresult($result);
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'right','catBottom',5).'>';
//-------------------------------------------------------------------------
//	PAGINATION LINKS
//-------------------------------------------------------------------------
	if($total > $settings['admin_perpage'])
	{
		if ($pagination->getCurrent() == 1)
			$first = ' | <span>'.$lang_new[$module_name]['FIRST'].'</span> | ';
		else
			$first = ' | <a'.linkcss().' href="modules.php?name='.$module_name.'&amp;op=users&amp;page='.$pagination->getFirst().'">'.$lang_new[$module_name]['FIRST'].'</a> |';
			
		if ($pagination->getPrevious())
			$prev = '<a'.linkcss().' href="modules.php?name='.$module_name.'&amp;op=users&amp;page='.$pagination->getPrevious().'">'.$lang_new[$module_name]['PREVIOUS'].'</a> | ';
		else
			$prev = $lang_new[$module_name]['PREVIOUS'].' | ';
			
		if ($pagination->getNext())
			$next = '<a'.linkcss().' href="modules.php?name='.$module_name.'&amp;op=users&amp;page='.$pagination->getNext().'">'.$lang_new[$module_name]['NEXT'].'</a> | ';
		else
			$next = $lang_new[$module_name]['NEXT'].' | ';
			
		if ($pagination->getLast())
			$last = '<a'.linkcss().' href="modules.php?name='.$module_name.'&amp;op=users&amp;page='.$pagination->getLast().'">'.$lang_new[$module_name]['LAST'].'</a>';
		else
			$last = $lang_new[$module_name]['LAST'];
			
		echo $pagination->getFirstOf().' '.$lang_new[$module_name]['TO'].' '.$pagination->getSecondOf().' '.$lang_new[$module_name]['OF'].' '.$pagination->getTotalItems().' '.$first . " " . $prev . " " . $next . " " . $last;
	}
	else
	{
		echo '&nbsp;';
	}
//-------------------------------------------------------------------------
//	PAGINATION LINKS
//-------------------------------------------------------------------------	
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
}

function manage_users_images()
{
	global $db, $lang_new, $module_name, $settings;
	OpenTable();
	index_navigation_header();
//-------------------------------------------------------------------------
//	DENY ANYONE WHO ISNT AN ADMIN.
//-------------------------------------------------------------------------	
	if(!is_admin())
		_redirect('modules.php?name='.$module_name);
//-------------------------------------------------------------------------
//	DENY ANYONE WHO ISNT AN ADMIN.
//-------------------------------------------------------------------------	
	$result = $db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$_GET['uid']."' ORDER BY `uploaded` DESC");
	echo '<table width="100%" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr>';
	echo '    <td'.tablecss(FALSE,'center','catHead',5).'>'._string_to_upper(sprintf($lang_new[$module_name]['IMAGES_SUBMITTED'],_submitter($_GET['uid']))).'</td>';
	echo '  </tr>';
	echo '  <tr>';
	echo '    <td'.tablecss('20%','center','catHead').'>'._string_to_upper($lang_new[$module_name]['IMAGE']).'</td>';
	echo '    <td'.tablecss('20%','center','catHead').'>'._string_to_upper($lang_new[$module_name]['UPLOADED']).'</td>';
	echo '    <td'.tablecss('20%','center','catHead').'>'._string_to_upper($lang_new[$module_name]['RESOLUTION']).'</td>';
	echo '    <td'.tablecss('20%','center','catHead').'>'._string_to_upper($lang_new[$module_name]['IMAGE_SIZE']).'</td>';
	echo '    <td'.tablecss('20%','center','catHead').'>'._string_to_upper($lang_new[$module_name]['OPTIONS']).'</td>';
	echo '  </tr>';
	while($uploadinfo = $db->sql_fetchrow($result))
	{
		echo '  <tr id="user-image-'.$uploadinfo['pid'].'">';
		echo '    <td'.tablecss('20%','center','row1').'><a'.linkcss().get_image_viewer().' href="'._IREPOSITORY_DIR.'/'.($uploadinfo['submitter']+10000).'/'.$uploadinfo['filename'].'">'.$lang_new[$module_name]['VIEW'].'</a></td>';
		echo '    <td'.tablecss('20%','center','row1').'>'._timestamp('M d, Y | G:i', $uploadinfo['uploaded'], $userinfo['user_timezone']).'</td>';
		echo '    <td'.tablecss('20%','center','row1').'>'.$uploadinfo['screensize'].'</td>';
		echo '    <td'.tablecss('20%','center','row1').'>'._calculate_size($uploadinfo['size']).'</td>';
		echo '    <td'.tablecss('20%','center','row1').'><a'.linkcss().' data-id="'.$uploadinfo['pid'].':::'.$uploadinfo['submitter'].'" class="delete-user-image" href="javascript:void(0);">'.$lang_new[$module_name]['DELETE'].'</a></td>';
		echo '  </tr>';
	}
	echo '  <tr>';
	echo '    <td'.tablecss(FALSE,FALSE,'catBottom',5).'>&nbsp;</td>';
	echo '  </tr>';
	echo '</table>'."\n";
	CloseTable();
}

function admin_delete_image()
{
	global $db, $lang_new, $module_name;		
	if(is_admin())
	{
//-------------------------------------------------------------------------
//	AWWW, YOU WANT TO DELETE THE IMAGE, OKIES, LETS REMOVE THE FILE,
//	FROM THE DATABASE, AND REMOVE ANY TRACE OF IT.
//-------------------------------------------------------------------------	
		$row  = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `pid`='".$_POST['pid']."'"));
		if(@unlink(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/'.$row['filename']))
		{
			@unlink(_IREPOSITORY_DIR._IREPOSITORY_USER_FOLDER.'/thumbs/thumb_'.$row['filename']);
			$db->sql_query("DELETE FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `pid`='".$row['pid']."'");
			$db->sql_optimize(_IMAGE_REPOSITORY_UPLOADS);
		}
		die(json_encode(array('pid' => $row['pid'])));
//-------------------------------------------------------------------------
//	AWWW, YOU WANT TO DELETE THE IMAGE, OKIES, LETS REMOVE THE FILE,
//	FROM THE DATABASE, AND REMOVE ANY TRACE OF IT.
//-------------------------------------------------------------------------	
	} else {
//-------------------------------------------------------------------------
//	IF YOU ARE NOT THE OWNER OF THIS IMAGE, BUGGER OFF.
//-------------------------------------------------------------------------
		die(json_encode(array('error' => $lang_new[$module_name]['NEXT_TIME_OWNER'])));
//-------------------------------------------------------------------------
//	IF YOU ARE NOT THE OWNER OF THIS IMAGE, BUGGER OFF.
//-------------------------------------------------------------------------	
	}
}

function admin_delete_user()
{
	global $db;
	if(is_admin())
	{
		$result = $db->sql_query("SELECT * FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `submitter`='".$_POST['user']."'");
		while($row = $db->sql_fetchrow($result))
		{
			if(file_exists(_IREPOSITORY_DIR.($_POST['user']+10000).'/'.$row['filename']))
			{
				@unlink(_IREPOSITORY_DIR.($_POST['user']+10000).'/'.$row['filename']);
				@unlink(_IREPOSITORY_DIR.($_POST['user']+10000).'/thumbs/thumb_'.$row['filename']);
				$db->sql_query("DELETE FROM `"._IMAGE_REPOSITORY_UPLOADS."` WHERE `pid`='".$row['pid']."'");
			}
		}
		$db->sql_query("DELETE FROM `"._IMAGE_REPOSITORY_USERS."` WHERE `uid`='".$_POST['user']."'");
		$db->sql_freeresult($result);
		die(json_encode(array('user' => $_POST['user'])));
	}
}

function image_forum_upload()
{
	global $db, $lang_new, $module_name, $userinfo, $settings;
//-------------------------------------------------------------------------
//	CHECK IF IT'S AN AJAX REQUEST, EXIT IF NOT.
//-------------------------------------------------------------------------
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
		die('NICE TRY, BETTER LUCK NEXT TIME');
//-------------------------------------------------------------------------
//	CHECK IF IT'S AN AJAX REQUEST, EXIT IF NOT.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	ALERT THE USER, IF THEY HAVE REACHED THEIR ALLOTTED QUOTA.
//-------------------------------------------------------------------------
    $quotainfo = _quota_percentages($userinfo['user_id']);
    if($quotainfo['total_size'] > $quotainfo['quota'])
    {
    	die(json_encode(array('error' => sprintf($lang_new[$module_name]['QUOTA_REACHED'],$userinfo['username']))));
    }
//-------------------------------------------------------------------------
//	ALERT THE USER, IF THEY HAVE REACHED THEIR ALLOTTED QUOTA.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	DO A QUICK CHECK TO MAKE SURE THE FILE BE UPLOADED IS AN IMAGE.
//-------------------------------------------------------------------------
	$image_size_info = @getimagesize($_FILES['forum-image-upload']['tmp_name']);
	switch(strtolower($image_size_info['mime']))
	{
		case 'image/png': 
		case 'image/gif': 
		case 'image/jpeg': 
		case 'image/pjpeg':
			break;
		default:
			die(json_encode(array('error' => $lang_new[$module_name]['IMAGE_ALLOWED'])));
	}
//-------------------------------------------------------------------------
//	DO A QUICK CHECK TO MAKE SURE THE FILE BE UPLOADED IS AN IMAGE.
//-------------------------------------------------------------------------
//-------------------------------------------------------------------------
//	MAKE SURE THE IMAGE DOES NOT EXCEED THE SPECIFIED MAX SIZE IN ADMIN.
//-------------------------------------------------------------------------
	if($_FILES['forum-image-upload']['size'] > $settings['max_upload'])
		die(json_encode(array('error' => sprintf($lang_new[$module_name]['IMAGE_SIZE_ERROR'], _calculate_size($settings['max_upload'])))));
//-------------------------------------------------------------------------
//	MAKE SURE THE IMAGE DOES NOT EXCEED THE SPECIFIED MAX SIZE IN ADMIN.
//-------------------------------------------------------------------------
	$ext 			= substr($_FILES['forum-image-upload']['name'], strpos($_FILES['forum-image-upload']['name'], '.')+1, strlen($_FILES['forum-image-upload']['name']));
	$randomise 		= _random_string().'.'.strtolower($ext);
	$natural_size  	= $image_size_info[0].' x '.$image_size_info[1];
	if (move_uploaded_file($_FILES['forum-image-upload']['tmp_name'], 'modules/'.$_POST['modname'].'/files/'.$_POST['user'].'/'.$randomise))
	{
//-------------------------------------------------------------------------
//	GENERATE A THUMBNAIL FOR USE IN THE FORUMS.
//-------------------------------------------------------------------------
		$db->sql_query("INSERT INTO `"._IMAGE_REPOSITORY_UPLOADS."` (`pid`,`filename`,`submitter`,`image`,`size`,`screensize`,`uploaded`) VALUES (NULL,'".$randomise."','".$userinfo['user_id']."','".$randomise."','".$_FILES['forum-image-upload']['size']."','".$natural_size."','".time()."')");
		if($image_size_info[0] > _IREPOSITORY_THUMBWIDTH || $image_size_info[1] > _IREPOSITORY_THUMBHEIGHT)
		{
			_createthumb('modules/'.$_POST['modname'].'/files/'.$_POST['user'].'/'.$randomise, 'modules/'.$_POST['modname'].'/files/'.$_POST['user'].'/thumbs/thumb_'.$randomise, array('width' => _IREPOSITORY_THUMBWIDTH, 'height' => _IREPOSITORY_THUMBHEIGHT, 'aspect_ratio' => TRUE));
		} else {				
			@copy('modules/'.$_POST['modname'].'/files/'.$_POST['user'].'/'.$randomise, 'modules/'.$_POST['modname'].'/files/'.$_POST['user'].'/thumbs/thumb_'.$randomise);
			$db->sql_query("UPDATE `"._IMAGE_REPOSITORY_UPLOADS."` SET `bypass_thumb`='1' WHERE `pid`='".$db->sql_nextid()."' && `submitter`='".$userinfo['user_id']."'");
		}
//-------------------------------------------------------------------------
//	GENERATE A THUMBNAIL FOR USE IN THE FORUMS.
//-------------------------------------------------------------------------
	}
//-------------------------------------------------------------------------
//	UPON COMPLETION OF THE IMAGE UPLOAD, LET'S GENERATE THE RESPONSE JSON.
//-------------------------------------------------------------------------
	die(json_encode(array('image' => $randomise, 'size' => $_FILES['forum-image-upload']['size'])));
//-------------------------------------------------------------------------
//	UPON COMPLETION OF THE IMAGE UPLOAD, LET'S GENERATE THE RESPONSE JSON.
//-------------------------------------------------------------------------
}

//-------------------------------------------------------------------------
//	IF THE USER VISITING IS NOT A REGISTERED MEMBER, SUGGEST THEY REGISTER
//-------------------------------------------------------------------------
if(!isset($op)) 
$op = '';

if(!is_user())
{
	OpenTable();
	index_navigation_header();
	echo '<table style="width:100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catHead',2).'>'.$lang_new[$module_name]['ATTENTION'].'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','row1',2).'>'.$lang_new[$module_name]['ANONYMOUS'].'</td>'."\n";
	echo '  </tr>'."\n".'<tr>'."\n";
	echo '    <td'.tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	CloseTable();
} 
//-------------------------------------------------------------------------
//	IF THE USER VISITING IS NOT A REGISTERED MEMBER, SUGGEST THEY REGISTER
//-------------------------------------------------------------------------
else 
{
	switch($op)
	{	
		case 'generate_thumb':
			generatemythumb();
			break;
		
		case 'image_data':
			uploadmyimage();
			break;
			
		case 'image_delete':
			deletemyimage();
			break;
			
		case 'image_delete_admin':
			admin_delete_image();
			break;
			
		case 'image_forum_upload':
			image_forum_upload();
			break;
			
		case 'image_modal':
			modal_code_popup();
			break;
			
		case 'settings':
			mysettings();
			break;
			
		case 'users':
			manage_users();
			break;
			
		case 'user_delete_admin':
			admin_delete_user();
			break;
			
		case 'users_images':
			manage_users_images();
			break;
			
		case 'quota':
			myquota();
			break;
				
		default:
			main();
			break;
	}
}

?>
