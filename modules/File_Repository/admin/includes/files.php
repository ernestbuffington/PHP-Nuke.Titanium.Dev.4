<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	File Repository
|	VERSION 			:	1.0.0
|----------------------------------------------------------------------
*/

if (!defined('IN_FILE_REPOSITORY'))
	die('Access Denied');

function _file_repository_files()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	$count_downloads = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."`"));
//-------------------------------------------------------------------------------------
//	THIS IS THE DEFAULT PAGINATION CLASS THAT COMES WITH EVOLUTION XTREME.
//-------------------------------------------------------------------------------------
	$pagination = new Paginator(isset($_GET['page']),$count_downloads);
	$pagination->set_Limit($settings['most_popular']);
	$pagination->set_Links(3);
	$limit1 = $pagination->getRange1();
	$limit2 = $pagination->getRange2();
//-------------------------------------------------------------------------------------
	// $search_cid     = (!empty($_POST['search_cid'])) ? ' WHERE `cid`='.$_POST['search_cid'] : '';
	$search_cid     = (!empty($_POST['search_cid'])) ? ' && `cid`='.$_POST['search_cid'] : '';
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),5).'>'._suh($lang_new[$module_name]['FILE_LIST']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss('5%','center',_sh()).'>'._suh($lang_new[$module_name]['ACTIVE']).'</td>'."\n";
	echo '    <td'._tdcss('55%',FALSE,_sh()).'>'._suh($lang_new[$module_name]['ITEM']).'</td>'."\n";
	echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['RATINGS']).'</td>'."\n";
	echo '    <td'._tdcss('10%','center',_sh()).'>'._suh($lang_new[$module_name]['DOWNLOADS']).'</td>'."\n";
	echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($lang_new[$module_name]['DOWNLOADS_PERMISSIONS']).'</td>'."\n";
	echo '  </tr>'."\n";
	# add the comment in to this query, so like if comment.did = file.did and what not, turn two queries into one.
	$result = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isnew` = 0 && `isapproved` = 1$search_cid ORDER BY `title` ASC LIMIT ".$limit1.", ".$limit2);
	echo '  <tr'._bgColor(1).(($db->sql_numrows($result) == 0 ) ? '' : ' style="display:none;"').'>';
	echo '    <td'._tdcss(FALSE,'center',_sc(),5).'>'._sut($lang_new[$module_name]['FILE_NONE']).'</td>';
	echo '  </tr>';
	while($download = $db->sql_fetchrow($result))
	{
		if($download['title'])
		{
			$count_comments = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_COMMENTS."` WHERE `did`='".$download['did']."'"));
			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss('5%','center',_sc()).'>'._sut((($download['isactive'] == 1) ? $lang_new[$module_name]['Y'] : $lang_new[$module_name]['N'])).'</td>'."\n";
			echo '    <td'._tdcss('55%',FALSE,_sc()).'>'."\n";
			echo '      <table width="100%" border="0" cellpadding="0" cellspacing="0">'."\n";
			echo '        <tr>'."\n";
			echo '          <td'._tdcss('80%',FALSE).'><a'._ls().' href="modules.php?name='.$module_name.'&amp;action=view&amp;did='.$download['did'].'" target="_blank">'._colorization($download['title'],$download['color']).'</a></td>'."\n";
			echo '          <td'._tdcss('20%','right').'>';
			echo '            <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=editfile&amp;did='.$download['did'].'"><i class="fa fa-pen"></i></a>';
			echo '            <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=deleteitem&did='.$download['did'].'"><i class="fa fa-times-circle"></i></a>';
			echo '          </td>'."\n";
			echo '        </tr>'."\n";
			echo '      </table>'."\n";
			echo '    </td>'."\n";
			echo '    <td'._tdcss('10%','center',_sc()).'>'.$count_comments.'</td>'."\n";
			echo '    <td'._tdcss('10%','center',_sc()).'>'.$download['hits'].'</td>'."\n";
			echo '    <td'._tdcss('20%','center',_sc()).'>'._user_is_within_group_name($download['groups']).'</td>'."\n";
			echo '  </tr>'."\n";
		}
		
	}
	$db->sql_freeresult($result);
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'right',_sf(),5).'>'."\n";
	if($count_downloads > $settings['most_popular'])
	{
		if ($pagination->getCurrent() == 1)
			$first = ' | '.$lang_new[$module_name]['FIRST'].' | ';
		else
			$first = ' | <a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=files&amp;page='.$pagination->getFirst().'">'.$lang_new[$module_name]['FIRST'].'</a> |';
			
		if ($pagination->getPrevious())
			$prev = '<a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=files&amp;page='.$pagination->getPrevious().'">'.$lang_new[$module_name]['PREV'].'</a> | ';
		else
			$prev = $lang_new[$module_name]['PREV'].' | ';
			
		if ($pagination->getNext())
			$next = '<a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=files&amp;page='.$pagination->getNext().'">'.$lang_new[$module_name]['NEXT'].'</a> | ';
		else
			$next = $lang_new[$module_name]['NEXT'].' | ';
			
		if ($pagination->getLast())
			$last = '<a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=files&amp;page='.$pagination->getLast().'">'.$lang_new[$module_name]['LAST'].'</a>';
		else
			$last = $lang_new[$module_name]['LAST'];
			
		echo $pagination->getFirstOf().' to '.$pagination->getSecondOf().' of '.$pagination->getTotalItems().' '.$first." ".$prev." ".$next." ".$last;
	} else {
		echo '&nbsp;';
	}
	echo '    </td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
}

function _file_repository_broken_files()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	$count_broken_downloads = $db->sql_ufetchrow("SELECT count(isbroken) as isbroken FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isbroken`=1");
	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),3).'>'._suh($lang_new[$module_name]['BROKEN_ITEMS']).'</td>'."\n";
	echo '  </tr>'."\n";
	$result = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isbroken`=1 ORDER BY `title`");
	if($count_broken_downloads['isbroken'] > 0):

		$isbroken = 1;
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss('10%','center',_sh()).'>#</td>'."\n";
		echo '    <td'._tdcss('70%',FALSE,_sh()).'>'.$lang_new[$module_name]['FILE_TITLE'].'</td>'."\n";
		echo '    <td'._tdcss('20%','center',_sh()).'>'.$lang_new[$module_name]['FILE_OPTIONS'].'</td>'."\n";
		echo '  </tr>'."\n";
		while($broken = $db->sql_fetchrow($result)):

			echo '  <tr'._bgColor(2).'>'."\n";
			echo '    <td'._tdcss('10%','center',_sc()).'>'.$isbroken.'</td>'."\n";
			echo '    <td'._tdcss('70%',FALSE,_sc()).'>'.$broken['title'].'</td>'."\n";
			echo '    <td'._tdcss('20%','center',_sc()).'><a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=editfile&amp;did='.$broken['did'].'">'.$lang_new[$module_name]['REPAIR'].'</a>&nbsp;|&nbsp;<a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=deleteitem&amp;did='.$broken['did'].'">'.$lang_new[$module_name]['DELETE'].'</a></td>'."\n";
			echo '  </tr>'."\n";
			$isbroken++;

		endwhile;

	else:

		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(FALSE,'center',_sc(),3).'>'.$lang_new[$module_name]['BROKEN_ITEMS_NONE'].'</td>'."\n";
		echo '  </tr>'."\n";

	endif;

	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sf(),3).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
}

//------------------
function _file_repository_attach_file()
{
	global $db, $admin_file, $userinfo;
//-------------------------------------------------------------------------------
//	ON UPLOAD GIVE THE FILE A RANDOM NAME TO PREVENT DOUBLING OF FILES
//-------------------------------------------------------------------------------
	for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a[$x], $i++);
//-------------------------------------------------------------------------------
	$title       		= str_replace(array('_',' '),'-',$_POST['title']);
	$filename          	= strtolower($_POST['name']);
	$file_extension    	= substr($filename, strrpos($filename, '.'));
	$newfilename       	= strtolower($title).'-'.$s.$file_extension;
	@rename(NUKE_BASE_DIR._FILE_REPOSITORY_DIR.$_POST['name'], NUKE_BASE_DIR._FILE_REPOSITORY_DIR.$newfilename);
	$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_FILES."` (`fid`, `did`, `ftitle`, `filename`, `filesize`) VALUES (NULL, '".$_POST['did']."', '".$title."', '".$newfilename."', '".$_POST['size']."')");
	die(json_encode(array('file' => $newfilename, 'size' => _convertsize($_POST['size']), 'fid' => $db->sql_nextid(), 'title' => $title)));
}
//------------------

function _file_repository_add_file()
{
	global $db, $admin_file, $userinfo;
	$result = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_CATEGORIES."`");
	if($db->sql_numrows($result) > 0)
	{
//-----------------------------------------------------------------------------------------------------------------
// INSERT A NEW ITEM INTO THE DATABASE, THIS FUNCTION IS NEEDED FOR THE NEW JQUERY FILE AND SCREENSHOT UPLOADER
//-----------------------------------------------------------------------------------------------------------------
		$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_ITEMS."` (`date`, `isnew`, `isapproved`, `semail`, `sname`) VALUES (now(), '1', '1', '".$userinfo['user_email']."', '".$userinfo['username']."')");
		$did = $db->sql_nextid();
		_redirect($admin_file.'.php?op='._MODNAME.'&action=newfile&did='.$did);
//-----------------------------------------------------------------------------------------------------------------
	} else {
//---------------------------------------------------------------------
// 	IF NO CATEGORIES EXISTS, REDIRECT SO THEY HAVE TO MAKE ONE
//---------------------------------------------------------------------
		_redirect($admin_file.'.php?op='._MODNAME.'&action=newcat');
//---------------------------------------------------------------------
	}
}

function _file_repository_new_file()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	$max_post_size_bytes = _convert2bytes(ini_get('post_max_size'));
	$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `did`='".$_GET['did']."'"));
	$row['isactive'] = ($_GET['action'] == 'newfile') ? 1 : $row['isactive'];
	echo '<form action="'.$admin_file.'.php?op=file_repository&amp;action=savefile" method="post" id="adding_new_download">'."\n";
	echo _input('hidden','did',false,$row['did']);
	if ( $_GET['action'] == 'newfile' ):
		echo _input('hidden','isapproved',false,1);
		echo _input('hidden','isupdated',false,0);
	endif;

	// echo _input('hidden','submitted_to_database',FALSE,true);

	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),2).'>'._suh($lang_new[$module_name]['FILE_ADD']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','title','250px',$row['title']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['PREVIEW']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','preview','250px',$row['preview']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['FILE_COLOR']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','colorize','100px',$row['color']).'&nbsp;<span class="color_title" style="color:'.$row['color'].';">'.$row['title'].'</span></td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['FILE_VERSION']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','version','100px',$row['version']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['FILE_CATEGORY']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._category_parents_and_children('cid',$row['cid']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['ATTACH_LOCAL_FILE']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'><a'._ls().' href="javascript:void(0);" class="mainforum_btn" id="isuploaded"><span style="text-transform: '.(($settings['utext'] == 1) ? 'uppercase' : 'none').';">'.$lang_new[$module_name]['SHOW_LOCAL'].'</span></a></td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).' class="attachment_options" style="display: none;">'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['LOCAL_FILES']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).' class="attachment_options" style="display: none;">'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc(),2).'>';
	echo '      <table style="width: 100%; white-space: nowrap;" cellpadding="0" cellspacing="0" border="0">';
	echo '        <tr>';
	echo '          <td'._tdcss('25%').'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
	echo '          <td'._tdcss('45%').'>'._sut($lang_new[$module_name]['FILE']).'</td>'."\n";
	echo '          <td'._tdcss('20%','center').'>'._sut($lang_new[$module_name]['FILE_SIZE']).'</td>'."\n";
	echo '          <td'._tdcss('10%','center').'>'._sut($lang_new[$module_name]['FILE_OPTIONS']).'</td>'."\n";
	echo '        <tr>';
	$dh = opendir(_FILE_REPOSITORY_DIR);
	$i=0;
	while (false !== ($filename = readdir($dh))) 
	{
		$count = $db->sql_numrows($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_FILES."` WHERE `filename`='".$filename."'"));
		if($filename != '.' && $filename != '..' && $filename != '.htaccess' && $filename != 'index.html' && $filename != 'screenshots' && $count != 1)
		{
			$filesize = filesize(_FILE_REPOSITORY_DIR.$filename);
			echo '        <tr id="attachment-'.$i.'">';
			echo '          <td'._tdcss('25%').'><input data-titleid="'.$i.'" type="text" class="atitle" name="atitle'.$i.'" value="" autocomplete="off" style="border: 1px solid; box-sizing: border-box; font-size: 13px; letter-spacing: 1px; margin: 0px 1px 1px; padding: 5px; width: 94%;"></td>';
			echo '          <td'._tdcss('45%').'>'.$filename.'</td>'."\n";
			echo '          <td'._tdcss('20%','center').'>'._convertsize($filesize).'</td>';
			echo '          <td'._tdcss('10%','center').'><span data-id="'.$i.'" data-did="'.$row['did'].'" data-filename="'.$filename.'" data-filesize="'.$filesize.'" data-atitle'.$i.'="" class="dm-sprite attachment" alt="Attach File to Download" title="Attach File to Download"></span></td>';
			echo '        <tr>';
		}
		$i++;
	}
	echo '      </table>';
	echo '    </td>';
	echo '  </tr>';
	echo '  <tr>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['FILES']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sc(),2).'>'."\n";
	echo '      <table style="width: 100%; white-space: nowrap;" border="0" cellpadding="4" cellspacing="0">'."\n";
	echo '        <tr>'."\n";
	echo '          <td'._tdcss('25%').'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
	echo '          <td'._tdcss('45%').'>'._sut($lang_new[$module_name]['FILE']).'</td>'."\n";
	echo '          <td'._tdcss('20%','center').'>'._sut($lang_new[$module_name]['FILE_SIZE']).'</td>'."\n";
	echo '          <td'._tdcss('10%','center').'>'._sut($lang_new[$module_name]['FILE_OPTIONS']).'</td>'."\n";
	echo '        </tr>'."\n";
	$result = $db->sql_query("SELECT `fid`, `ftitle`, `filename`, `filesize` FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$_GET['did']."'");
	if($db->sql_numrows($result) > 0)
	{
		while($file = $db->sql_fetchrow($result))
		{
			$filename = '<a'._ls().' href="'.$admin_file.'.php?op=file_repository&amp;action=downloadfile&amp;filename='.$file['filename'].'&amp;filesize='.$file['filesize'].'">'.$file['filename'].'</a>';
			echo '        <tr id="file-'.$file['fid'].'">'."\n";
			echo '          <td'._tdcss('25%',FALSE,FALSE,FALSE,TRUE).'>'.$file['ftitle'].'</td>'."\n";
			echo '          <td'._tdcss('45%',FALSE,FALSE,FALSE,TRUE).'>'.$filename.((!file_exists(_FILE_REPOSITORY_DIR.$file['filename'])) ? '<span style="color: darkred;">&nbsp;'.$lang_new[$module_name]['FILE_MISSING'].'</span>' : '').'</td>'."\n";
			echo '          <td'._tdcss('20%','center',FALSE,FALSE,TRUE).'>'._convertsize($file['filesize']).'</td>'."\n";
			echo '          <td'._tdcss('10%','center',FALSE,FALSE,TRUE).'><i data-id="'.$file['fid'].'" class="fa fa-times-circle delete-download"></i></td>'."\n";
			echo '        </tr>'."\n";
		}
	}			
	$db->sql_freeresult($result);	
	echo '        <tr id="fileupload_submit">'."\n";
	echo '          <td'._tdcss('25%').'>&nbsp;'._input('text','ftitle','94%','').'</td>'."\n";
	echo '          <td'._tdcss('45%').'>&nbsp;'._input('file','fupload','85%','').'</td>'."\n";
	echo '          <td'._tdcss('20%','center').'><span id="fileupload-percentage">-</span></td>'."\n";
	echo '          <td'._tdcss('10%','center').'>'._submit($lang_new[$module_name]['UPLOAD'],'fileupload').'</td>'."\n";
	echo '        </tr>'."\n";
	echo '      </table>'."\n";
	echo '</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['SCREENSHOTS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sc(),2).'>'."\n";
	echo '      <table style="width: 100%; white-space:nowrap;" border="0" cellpadding="2" cellspacing="0">'."\n";
	echo '        <tr>'."\n";
	echo '          <td'._tdcss('25%').'>'._sut($lang_new[$module_name]['FILE_TITLE']).'</td>'."\n";
	echo '          <td'._tdcss('45%').'>'._sut($lang_new[$module_name]['FILE']).'</td>'."\n";
	echo '          <td'._tdcss('20%','center').'>'._sut($lang_new[$module_name]['FILE_SIZE']).'</td>'."\n";
	echo '          <td'._tdcss('10%','center').'>'._sut($lang_new[$module_name]['FILE_OPTIONS']).'</td>'."\n";
	echo '        </tr>'."\n";
	$result = $db->sql_query("SELECT `pid`, `filename`, `size`, `title` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `did`='".$_GET['did']."' AND `active`=1");
	if($db->sql_numrows($result) > 0)
	{
		while($screen = $db->sql_fetchrow($result))
		{
			echo '        <tr id="screen-'.$screen['pid'].'">'."\n";
			echo '          <td'._tdcss('25%',FALSE,FALSE,FALSE,TRUE).'>'.$screen['title'].'</td>'."\n";
			echo '          <td'._tdcss('45%',FALSE,FALSE,FALSE,TRUE).'><a'._ls().get_image_viewer('screens').' href="'._FILE_REPOSITORY_SCREENS.$screen['filename'].'" title="'.$screen['title'].'">'.$screen['filename'].'</a>'.((!file_exists(_FILE_REPOSITORY_SCREENS.$screen['filename'])) ? '<span style="color: darkred;">&nbsp;'.$lang_new[$module_name]['FILE_MISSING'].'</span>' : '').'</td>'."\n";
			echo '          <td'._tdcss('20%','center',FALSE,FALSE,TRUE).'>'._convertsize($screen['size']).'</td>'."\n";
			echo '          <td'._tdcss('10%','center',FALSE,FALSE,TRUE).'><i data-id="'.$screen['pid'].'" class="fa fa-times-circle delete-screenshot"></i></td>'."\n";
			echo '        </tr>'."\n";
		}
	}			
	$db->sql_freeresult($result);
	echo '        <tr id="imageupload_submit">'."\n";
	echo '          <td'._tdcss('25%').'>&nbsp;'._input('text','stitle','94%','').'</td>'."\n";
	echo '          <td'._tdcss('45%').'>&nbsp;'._input('file','supload','85%','').'</td>'."\n";
	echo '          <td'._tdcss('20%','center').'><span id="screenupload-percentage">-</span></td>'."\n";
	echo '          <td'._tdcss('10%','center').'>'._submit($lang_new[$module_name]['UPLOAD'],'imageupload').'</td>'."\n";
	echo '        </tr>'."\n";
	echo '      </table>'."\n";
	echo '</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['DESCRIPTION']).'</td>'."\n";
	echo '  </tr>'."\n";	
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss(FALSE,FALSE,_sc(),2).'>'._textarea('description',$row['description']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).(($settings['developer_mode'] == true) ? '' : ' style="display: none;"').'>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['FIXES']).'</td>'."\n";
	echo '  </tr>'."\n";	
	echo '  <tr'._bgColor(1).(($settings['developer_mode'] == true) ? '' : ' style="display: none;"').'>'."\n";
	echo '    <td'._tdcss(FALSE,FALSE,_sc(),2).'>'._textarea('fixes',$row['fixes']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['AUTHOR_DETAILS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['AUTHOR']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','author','250px',$row['author']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['EMAIL']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('email','author_email','250px',$row['author_email']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['WEBSITE']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','author_website','250px',$row['author_website']).'</td>'."\n";
	echo '  </tr>'."\n";
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	DETAILS
//---------------------------------------------------------------------
	echo '  <tr>'."\n";
	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['DETAILS']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['ISALLOWED']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._list_available_permission_groups('isallowed',$row['groups']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['POSTS']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','posts','100px',$row['posts']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['HITS']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','hits','100px',$row['hits']).'</td>'."\n";
	echo '  </tr>'."\n";

	if ( $_GET['action'] != 'newfile' ):

		echo '  <tr'._bgColor(1).(($row['isapproved'] == 1) ? ' display: none;' : '').'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['ISUPDATED']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._selectbox('isupdated',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),0).'</td>'."\n";
		echo '  </tr>'."\n";
		# added 1.1.0
		echo '  <tr'._bgColor(1).'>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['APPROVED']).'</td>'."\n";
		echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._selectbox('isapproved',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$row['isapproved']).'</td>'."\n";
		echo '  </tr>'."\n";
		# added in 1.1.0

	endif;		
	echo '  <tr'._bgColor(1).'>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['ACTIVE']).'</td>'."\n";
	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._selectbox('isactive',array(0 => $lang_new[$module_name]['N'], 1 => $lang_new[$module_name]['Y']),$row['isactive']).'</td>'."\n";
	echo '  </tr>'."\n";

	// if(file_exists(_FILE_REPOSITORY_PLUGINS.'shop/functions.php'))
	// {
	// 	echo '  <tr>'."\n";
	// 	echo '	  <td'._tdcss(FALSE,FALSE,_sh(),2).'>'._suh($lang_new[$module_name]['PAYPAL']).'</td>'."\n";
	// 	echo '  </tr>'."\n";
	// 	echo '  <tr'._bgColor(1).'>'."\n";
	// 	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['ACCOUNT']).'</td>'."\n";
	// 	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','paypal','250px',$row['paypal']).'</td>'."\n";
	// 	echo '  </tr>'."\n";
	// 	echo '  <tr'._bgColor(1).'>'."\n";
	// 	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._sut($lang_new[$module_name]['PRICE']).'</td>'."\n";
	// 	echo '    <td'._tdcss('50%',FALSE,_sc()).'>'._input('text','price','100px',$row['price']).'&nbsp;'._selectbox('currency',array('AUD' => $lang_new[$module_name]['AUD'], 'CAD' => $lang_new[$module_name]['CAD'], 'EUR' => $lang_new[$module_name]['EUR'], 'GBP' => $lang_new[$module_name]['GBP'], 'USD' => $lang_new[$module_name]['USD']),$row['currency']).'</td>'."\n";
	// 	echo '  </tr>'."\n";
	// }
//---------------------------------------------------------------------
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sf(),2).'>'._submit($lang_new[$module_name]['SAVE']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo '</form>'."\n";
}

function _file_repository_save_file()
{
	global $db, $admin_file, $module_name, $userinfo, $settings;
	$author      		= (!empty($_POST['author'])) ? _escape_string($_POST['author']) : '';
	$author_email      	= (!empty($_POST['author_email'])) ? $_POST['author_email'] : '';
	$author_website     = (!empty($_POST['author_website'])) ? $_POST['author_website'] : '';
	$cid      			= (!empty($_POST['cid'])) ? intval($_POST['cid']) : 0;
	$color      		= (!empty($_POST['colorize'])) ? $_POST['colorize'] : '';
	$currency      		= (!empty($_POST['currency'])) ? $_POST['currency'] : '';
	$description      	= (!empty($_POST['description'])) ? _escape_string($_POST['description']) : '';
	$did      			= (!empty($_POST['did'])) ? intval($_POST['did']) : '';
	$fixes      		= (!empty($_POST['fixes'])) ? _escape_string($_POST['fixes']) : '';
	$groups      		= (!empty($_POST['isallowed'])) ? intval($_POST['isallowed']) : 0;
	$hits      			= (!empty($_POST['hits'])) ? intval($_POST['hits']) : 0;
	$isactive      		= (!empty($_POST['isactive'])) ? intval($_POST['isactive']) : 0;
	$isapproved      	= (!empty($_POST['isapproved'])) ? intval($_POST['isapproved']) : 0;
	$isfeatured	     	= (!empty($_POST['isfeatured'])) ? intval($_POST['isfeatured']) : 0;
	$isupdated 			= (!empty($_POST['isupdated'])) ? intval($_POST['isupdated']) : 0;
	$paypal 			= (!empty($_POST['paypal'])) ? $_POST['paypal'] : '';
	$posts 				= (!empty($_POST['posts'])) ? intval($_POST['posts']) : 0;
	$preview 			= (!empty($_POST['preview'])) ? $_POST['preview'] : '';
	$semail      		= (!empty($_POST['semail'])) ? $_POST['semail'] : '';	
	$sname      		= (!empty($_POST['sname'])) ? _escape_string($_POST['sname']) : '';
	$title      		= (!empty($_POST['title'])) ? _escape_string(trim($_POST['title'])) : '';
	$version      		= (!empty($_POST['version'])) ? $_POST['version'] : '';
	$db->sql_query("UPDATE `"._FILE_REPOSITORY_ITEMS."` SET 
		`author` = '".$author."',
		`author_email` = '".$author_email."',
		`author_website` = '".$author_website."',
		`cid` = '".$cid."',
		`color` = '".$color."',
		`currency` = '".$currency."',
		`description` = '".$description."',
		`fixes` = '".$fixes."',
		`groups` = '".$groups."',
		`hits` = '".$hits."',
		`isactive` = '".$isactive."',
		`isapproved` = '".$isapproved."',
		`isbroken` = '0',
		`isfeatured` = '".$isfeatured."',
		`isnew` = '0',
		`paypal` = '".$paypal."',
		`posts` = '".$posts."',
		`preview` = '".$preview."',
		`semail` = '".$userinfo['user_email']."',
		`sname` = '".$userinfo['user_id']."',
		`title` = '".$title."', 
		`version` = '".$version."' WHERE `did` = '".$did."'");

	if($isupdated == 1)
	{
		$db->sql_query("UPDATE `"._FILE_REPOSITORY_ITEMS."` SET `isupdated` = now() WHERE `did` = '".$did."'");
	}
	_redirect($admin_file.'.php?op=file_repository&action=files');
}

function _file_repository_upload_files()
{
	global $db, $lang_new, $module_name, $userinfo;
//-------------------------------------------------------------------------------
//	IF THIS FUNCTION IS NOT USED VIA XMLHttpRequest THEN KILL THE FUNCTION
//-------------------------------------------------------------------------------
	if (!$_SERVER['HTTP_X_REQUESTED_WITH'])
		die(json_encode(array('error' => 'Nice Try, Better Luck Next Time...')));
//-------------------------------------------------------------------------------
//-------------------------------------------------------------------------------
//	ON UPLOAD GIVE THE FILE A RANDOM NAME TO PREVENT DOUBLING OF FILES
//-------------------------------------------------------------------------------
	for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a[$x], $i++);
//-------------------------------------------------------------------------------
	$title       		= str_replace(array('_',' '),'-',$_POST['title']);
	$filename          	= strtolower($_FILES['fupload']['name']);
	$file_extension    	= substr($filename, strrpos($filename, '.'));
	$newfilename       	= strtolower($title).'-'.$s.$file_extension;
	$size              	= $_FILES['fupload']['size'];
	if(@move_uploaded_file($_FILES['fupload']['tmp_name'], NUKE_BASE_DIR.$_POST['uploaddir'].$newfilename))
	{
		$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_FILES."` (`fid`, `did`, `ftitle`, `filename`, `filesize`) VALUES (NULL, '".$_POST['did']."', '".$_POST['title']."', '".$newfilename."', '".$size."')");
//-------------------------------------------------------------------------------
//	Return a JSON array with all the information
//-------------------------------------------------------------------------------
		die(json_encode(array('file' => $newfilename, 'size' => _convertsize($size), 'fid' => $db->sql_nextid(), 'title' => $_POST['title'])));
//-------------------------------------------------------------------------------
	}
}

function _file_repository_delete_item()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	// merge this query into one.

	$did = ($_GET['did']) ? $_GET['did'] : $_POST['did'];

	$row  = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `did`='".$did."'"));
	$rowf = $db->sql_fetchrow($db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_FILES."` WHERE `did`='".$row['did']."'"));

	# I MAY RE-ADD THIS IN A LATER UPDATE.
	// $db->sql_query("DELETE FROM `"._DOWNLOAD_REPOSITORY_HISTORY."` WHERE `fid`='".$rowf['fid']."'");
	// $db->sql_query("DELETE FROM `"._DOWNLOAD_REPOSITORY_RATINGS."` WHERE `did`='".$row['did']."'");
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

	if(!$_SERVER['HTTP_X_REQUESTED_WITH']):

		if($_GET['area'] == 'clientuploads'):
			_redirect($admin_file.'.php?op='._MODNAME.'&action=clientuploads');
		else:
			_redirect($admin_file.'.php?op='._MODNAME.'&action=files');
		endif;

	endif;
}

function _file_repository_delete_files()
{
	global $db;
	$result 		= $db->sql_query("SELECT `filename` FROM `"._FILE_REPOSITORY_FILES."` WHERE `fid`='".$_POST['fid']."'");
	list($filename) = $db->sql_fetchrow($result);
//---------------------------------------------------------------------
//	DELETE THE FILE FROM THE UPLOAD DIRECTORY 
//---------------------------------------------------------------------
	if(file_exists(_FILE_REPOSITORY_DIR.$filename))
		@unlink(_FILE_REPOSITORY_DIR.$filename);
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	ONCE THE FILE HAS BEEN REMOVE, DELETE FROM THE DATABASE
//---------------------------------------------------------------------
	$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_FILES."` WHERE `fid`='".$_POST['fid']."'");
	$db->sql_optimize(_FILE_REPOSITORY_FILES);
//---------------------------------------------------------------------
}

// _FILE_REPOSITORY_SCREENS
function _file_repository_upload_screens()
{
	global $db, $lang_new, $module_name, $userinfo;
//-------------------------------------------------------------------------------
//	If this function is not used via XMLHttpRequest then kill the function
//-------------------------------------------------------------------------------
	if (!$_SERVER['HTTP_X_REQUESTED_WITH'])
		die(json_encode(array('error' => $lang_new[$module_name]['ERROR_NICE_TRY'])));
//-------------------------------------------------------------------------------	
//-------------------------------------------------------------------------------
//	If the uploaded file is not an image mimetype kill the function
//-------------------------------------------------------------------------------	
	// if(!in_array($_FILES['supload']['type'], array('image/png', 'image/gif', 'image/jpeg', 'image/pjpeg')))
	// 	die(json_encode(array('error' => $lang_new[$module_name]['ERROR_NOT_SUPPORTED'])));
//-------------------------------------------------------------------------------	
//-------------------------------------------------------------------------------
//	On upload give the file a random name to prevent doubling of files
//-------------------------------------------------------------------------------
	for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $s .= $a[$x], $i++);
//-------------------------------------------------------------------------------
	$title       		= str_replace(array('_',' '),'-',$_POST['title']);
	$filename          	= strtolower($_FILES['supload']['name']);
	$file_extension    	= substr($filename, strrpos($filename, '.'));
//-------------------------------------------------------------------------------
//	This is for all the whiners about download file name changes lol
//-------------------------------------------------------------------------------
	$newfilename       	= strtolower($title).'-'.$s.$file_extension;
//-------------------------------------------------------------------------------
	$size              	= $_FILES['supload']['size'];	
	$size_array        	= @getimagesize($_FILES['supload']['tmp_name']);		
	$filescreen        	= $size_array[0].' x '.$size_array[1];	

	if(@move_uploaded_file($_FILES['supload']['tmp_name'], NUKE_BASE_DIR.$_POST['screendir'].$newfilename))
	{
//-------------------------------------------------------------------------------
//	Create a thumbnail for the download info page
//-------------------------------------------------------------------------------
		_create_thumb_from_image(NUKE_BASE_DIR.$_POST['screendir'].$newfilename, NUKE_BASE_DIR.$_POST['screendir'].'thumbs/thumb_100x100_'.$newfilename, array('width'=>'100','height'=>'100','aspect_ratio'=>true));
		_create_thumb_from_image(NUKE_BASE_DIR.$_POST['screendir'].$newfilename, NUKE_BASE_DIR.$_POST['screendir'].'thumbs/thumb_190x120_'.$newfilename, array('width'=>'190','height'=>'120','aspect_ratio'=>true));
//-------------------------------------------------------------------------------
		$db->sql_query("INSERT INTO `"._FILE_REPOSITORY_SCREENSHOTS."` (`pid`, `did`, `active`, `filename`, `size`, `submitter`, `title`) VALUES (NULL, '".$_POST['did']."', 1, '".$newfilename."', '".$size."', '".$userinfo['username']."', '".$_POST['title']."')");
		$pid = $db->sql_nextid();
//-------------------------------------------------------------------------------
//	Return a JSON array with all the information
//-------------------------------------------------------------------------------
		die(json_encode(array('image' => $newfilename, 'size' => _convertsize($size), 'pid' => $pid, 'title' => $_POST['title'])));
//-------------------------------------------------------------------------------
	}
}

function _file_repository_delete_screens()
{
	global $db;
	$result 			= $db->sql_query("SELECT `filename` FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `pid`='".$_POST['pid']."'");
	list($screenshot) 	= $db->sql_fetchrow($result);
	if(file_exists(_FILE_REPOSITORY_SCREENS.$screenshot))
	{
		@unlink(_FILE_REPOSITORY_SCREENS.'thumbs/thumb_100x100_'.$screenshot);
		@unlink(_FILE_REPOSITORY_SCREENS.'thumbs/thumb_190x120_'.$screenshot);
		@unlink(_FILE_REPOSITORY_SCREENS.$screenshot);
	}
	$db->sql_query("DELETE FROM `"._FILE_REPOSITORY_SCREENSHOTS."` WHERE `pid`='".$_POST['pid']."'");
	$db->sql_optimize(_FILE_REPOSITORY_SCREENSHOTS);
}

function _file_repository_client_uploads()
{
	global $db, $admin_file, $lang_new, $module_name, $settings;
	_admin_navigation_menu();
	$result = $db->sql_query("SELECT * FROM `"._FILE_REPOSITORY_ITEMS."` WHERE `isapproved` = 0 ORDER BY `date` ASC");
	$num_client_uploads = $db->sql_numrows($result);

	echo '<table style="width: 100%;" border="0" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(FALSE,'center',_sh(),5).'>'._suh($lang_new[$module_name]['FILE_LIST']).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss('5%','center',_sh()).'>#</td>'."\n";
	echo '    <td'._tdcss('40%',FALSE,_sh()).'>'._suh($lang_new[$module_name]['ITEM']).'</td>'."\n";
	echo '    <td'._tdcss('30%','center',_sh()).'>'._suh($lang_new[$module_name]['SUBMITTER_DETAILS']).'</td>'."\n";
	echo '    <td'._tdcss('20%','center',_sh()).'>'._suh($lang_new[$module_name]['SUBMITTED']).'</td>'."\n";
	echo '    <td'._tdcss('5%','center',_sh()).'>'._suh($lang_new[$module_name]['OPTION']).'</td>'."\n";
	echo '  </tr>'."\n";

	if ( $num_client_uploads > 0 ):

		$submissions = 1;
		while($submitted = $db->sql_fetchrow($result)):

			echo '  <tr'._bgColor(1).'>'."\n";
			echo '    <td'._tdcss('5%','center',_sc()).'>'.$submissions.'</td>'."\n";
			echo '    <td'._tdcss('40%',FALSE,_sc()).'><a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=editfile&amp;did='.$submitted['did'].'">'.$submitted['title'].'</a></td>'."\n";
			echo '    <td'._tdcss('30%',FALSE,_sc()).'><a'._ls().' href="modules.php?name=Profile&amp;mode=viewprofile&amp;u='.$submitted['suid'].'" target="_blank">'.$submitted['sname'].'</a>&nbsp;(<a'._ls().' href="mailto:'.$submitted['semail'].'">'.$submitted['semail'].'</a>)</td>'."\n";
			echo '    <td'._tdcss('20%','center',_sc()).'>'._timestamp($submitted['date'],$settings['date_format']).'</td>'."\n";
			echo '    <td'._tdcss('5%','center',_sc()).'><a href="'.$admin_file.'.php?op='._MODNAME.'&amp;action=deleteitem&did='.$submitted['did'].'&amp;area=clientuploads"><span class="dm-sprite delete-button"></span></a></td>'."\n";
			echo '  </tr>'."\n";
			$submissions++;

		endwhile;

	else:
		echo '  <tr'._bgColor(2).'>'."\n";
		echo '    <td'._tdcss(false,'center',_sc(),5).'>No Client uploads yet!</td>'."\n";
		echo '  </tr>'."\n";
	endif;
	echo '  <tr'._bgColor(2).'>'."\n";
	echo '    <td'._tdcss(false,'right',_sf(),5).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";

}

function _file_repository_download_file()
{
	global $do_gzip_compress;
	$cType = (preg_match('#Opera(/| )([0-9].[0-9]{1,2})#i', getenv('HTTP_USER_AGENT'))) ? 'application/octetstream' : 'application/octet-stream';
	if ($do_gzip_compress = true)
	{
		while (ob_end_clean());
		header('Content-Encoding: none');
	}
	header('Pragma: public');
	header('Content-type: '.$cType.'; name='.$_GET['filename']);
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private',false);
	header('Content-length: '.$_GET['filesize']);
	header('Content-Disposition: inline; filename='.$_GET['filename']);
	@readfile(_FILE_REPOSITORY_DIR.$_GET['filename']);
	exit;
}

switch($_GET['action'])
{
	case 'addfile':
		_file_repository_add_file();
		break;

	case 'attachfile':
		_file_repository_attach_file();
		break;

	case 'brokenfiles':
		_file_repository_broken_files();
		break;

	case 'clientuploads':
		_file_repository_client_uploads();
		break;

	case 'deletefile':
		_file_repository_delete_files();
		break;

	case 'deleteitem':
		_file_repository_delete_item();
		break;

	case 'deletescreen':
		_file_repository_delete_screens();
		break;

	case 'downloadfile':
		_file_repository_download_file();
		break;

	case 'editfile':
	case 'newfile':
		_file_repository_new_file();
		break;

	case 'savefile':
		_file_repository_save_file();
		break;

	case 'uploadfile':
		_file_repository_upload_files();
		break;

	case 'uploadscreen':
		_file_repository_upload_screens();
		break;

	default:
		_file_repository_files();
		break;
}

?>