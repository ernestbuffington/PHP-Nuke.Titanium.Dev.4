<?php 

/**
 * SCEditor
 * http://www.sceditor.com/
 *
 * Copyright (C) 2011-2013, Sam Clarke (samclarke.com)
 *
 * SCEditor is licensed under the MIT license:
 *	http://www.opensource.org/licenses/mit-license.php
 *
 * @fileoverview SCEditor - A lightweight WYSIWYG BBCode and HTML editor
 * @author Sam Clarke
 * @requires jQuery
 **/

function sceditor_getInstance($field='editor', $width='100%', $height='300px', $value='') 
{
	static $sceditor;
	if (!isset($sceditor)) 
	{
		$sceditor = new sceditor;
	}
	$sceditor->fields[$field] = array('width' => $width, 'height' => $height, 'value' => $value);
	return $sceditor;	
}

class sceditor 
{	
	var $fields = array();
	var $first = true;
	
	function setHeader()
	{
		global $modheader, $img_width, $img_height, $board_config, $img_viewer;        
		if ($this->first == false) 
		{
			$modheader = '';
			return;
		}
		$this->first = false;

		$modheader .= '<script>'.PHP_EOL;
		if (!defined('IN_PHPBB'))
			$modheader .= '  var reimg_maxWidth = '.$img_width.', reimg_maxHeight = '.$img_height.', reimg_relWidth = 0, reimg_img_viewer = "'.$img_viewer.'";'.PHP_EOL;
		else
			$modheader .= '  var reimg_maxWidth = '.$board_config['image_resize_width'].', reimg_maxHeight = '.$board_config['image_resize_height'].', reimg_relWidth = 0, reimg_img_viewer = "'.$img_viewer.'";'.PHP_EOL;
		$modheader .= '</script>'.PHP_EOL;
		$modheader .= '<link rel="stylesheet" href="includes/wysiwyg/sceditor/css/square.css" type="text/css"/>'.PHP_EOL;
		$modheader .= '<script src="includes/wysiwyg/sceditor/jquery.sceditor.bbcode.js"></script>'.PHP_EOL;
		$modheader .= '<script src="includes/wysiwyg/sceditor/bbcodes_sceditor.js"></script>'.PHP_EOL;
		/* $modheader .= '<link rel="stylesheet" href="includes/wysiwyg/sceditor/css/jquery.spectrum.css" type="text/css"/>'; */
		/* $modheader .= '<script src="includes/wysiwyg/sceditor/jquery.spectrum.js"></script>'; */
	}
	
	function getHtml($name)
	{
		global $board_config, $db, $prefix, $lang, $userinfo;
		$allowed = true;
		
		
		if($_GET['name'] == 'Profile')
			$allowed = false;

        if(!isset($JStoHTML))
        $JStoHTML = '';			
		
		$JStoHTML .= '<textarea style="border: 1px solid; box-sizing: border-box; cursor: auto; height: '.$this->fields[$name]['height'].'; letter-spacing: 1px; min-height: 130px; padding: 5px; resize: vertical; width: '.$this->fields[$name]['width'].';" id="'.$name.'" name="'.$name.'">'.$this->fields[$name]['value'].'</textarea>'.PHP_EOL;
		$JStoHTML .= '<script>'.PHP_EOL;
		$JStoHTML .= 'nuke_jq(function($) {'.PHP_EOL;
		$JStoHTML .= '  $("#'.$name.'").sceditor({'.PHP_EOL;
		$JStoHTML .= '		width: "100%",'.PHP_EOL;
		$JStoHTML .= '		emoticonsEnabled: "'.(($board_config['allow_smilies'] == 1) ? true : false).'",'.PHP_EOL;
		$JStoHTML .= '		plugins: "bbcode",'.PHP_EOL;
		$JStoHTML .= '		style: "includes/wysiwyg/sceditor/css/jquery.sceditor.default.min.css",'.PHP_EOL;

		if($allowed == true) // ,orderedlist
			$JStoHTML .= '		toolbar: "bold,italic,underline,strike|left,center,right|'.(($board_config['allow_smilies']) ? 'emoticon|' : '').'font,size,color,removeformat|bulletlist|php,code,quote|horizontalrule,image,email,link,unlink|video|maximize,source",'.PHP_EOL;
		else
			$JStoHTML .= '		toolbar: "bold,italic,underline,strike|left,center,right,justify|'.(($board_config['allow_smilies']) ? 'emoticon|' : '').'font,size,color,removeformat|horizontalrule,link,unlink,email,image|maximize,source",'.PHP_EOL;

		$JStoHTML .= '		fonts: "Arial,Arial Black,Comic Sans MS,Courier New,Georgia,Impact,Sans-serif,Serif,Times New Roman,Trebuchet MS,Verdana",'.PHP_EOL;
		if($board_config['allow_smilies'])
		{
			$JStoHTML .= '		emoticonsRoot: "'.$board_config['smilies_path'].'/",'.PHP_EOL;
			$JStoHTML .= '		emoticons: {'.PHP_EOL;
			$sql = "SELECT emoticon, code, smile_url FROM ".$prefix."_bbsmilies ORDER BY smilies_id";
			if ($result = $db->sql_query($sql))
			{
				$i = 0;
				$rowset = array();
				
				if(!isset($dropdownsmilies))
                $dropdownsmilies = '';			

				if(!isset($moresmilies))
                $moresmilies = '';			

				while ($row = $db->sql_fetchrow($result))
				{
					if (empty($rowset[$row['smile_url']]))
					{
						$rowset[$row['smile_url']]['code'] = str_replace("'", "\\'", str_replace('\\', '\\\\', $row['code']));
						$rowset[$row['smile_url']]['emoticon'] = $row['emoticon'];
						$rowset[$row['smile_url']]['smile_url'] = $row['smile_url'];
						if($i <= 15)
							$dropdownsmilies .= '				"'.$rowset[$row['smile_url']]['code'].'" : "'.$rowset[$row['smile_url']]['smile_url'].'",'.PHP_EOL;
						else
							$moresmilies .= '				"'.$rowset[$row['smile_url']]['code'].'" : "'.$rowset[$row['smile_url']]['smile_url'].'",'.PHP_EOL;
						$i++;
					}
				}
	        	$db->sql_freeresult($result);
			}
			$JStoHTML .= '			dropdown: {'.PHP_EOL;
			$JStoHTML .= '            '.$dropdownsmilies;
			$JStoHTML .= '			},'.PHP_EOL;
			$JStoHTML .= '			more: {'.PHP_EOL;
			$JStoHTML .= '            '.$moresmilies;
			$JStoHTML .= '			}'.PHP_EOL;
			$JStoHTML .= '		}'.PHP_EOL;
		}
		$JStoHTML .= '	});'.PHP_EOL;
		# PUT THE BBCODE EDITOR IN SOURCE MODE - USER BASED SETTING
		if($userinfo['sceditor_in_source'] == TRUE)
			$JStoHTML .= '	$("#'.$name.'").sceditor("instance").sourceMode(true);';

		$JStoHTML .= '	$(document).on("click","#preview,#submit",function(event)'.PHP_EOL;
		$JStoHTML .= '	{'.PHP_EOL;
		$JStoHTML .= '		formErrors = false;'.PHP_EOL;
		$JStoHTML .= '		if ($("#'.$name.'").sceditor("instance").val(true).length < 2)'.PHP_EOL;
		$JStoHTML .= '		{'.PHP_EOL;
		$JStoHTML .= '			formErrors = "'._EMPTY_MESSAGE.'";'.PHP_EOL;
		$JStoHTML .= '		}'.PHP_EOL;
		$JStoHTML .= '		if (formErrors)'.PHP_EOL;
		$JStoHTML .= '		{'.PHP_EOL;
		$JStoHTML .= '			event.preventDefault();'.PHP_EOL;
		$JStoHTML .= '			alert(formErrors);'.PHP_EOL;
		$JStoHTML .= '		}'.PHP_EOL;
		$JStoHTML .= '	});'.PHP_EOL;

		$JStoHTML .= '});'.PHP_EOL;
		$JStoHTML .= '</script>'.PHP_EOL;		
		return $JStoHTML;
	}
	
	function getInstance($field='editor', $width='100%', $height='300px', $value='')
	{
		static $sceditor;
		if (!isset($sceditor)) 
		{
			$sceditor = new sceditor;
		}
		$sceditor->fields[$field] = array('width' => $width, 'height' => $height, 'value' => $value);
		return $sceditor;
	}
}

?>