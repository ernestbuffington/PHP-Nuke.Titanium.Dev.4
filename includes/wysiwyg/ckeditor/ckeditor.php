<?php 
/*=======================================================================
 PHP-Nuke Titanium | Nuke-Evolution Basic : Enhanced and Advanced
 =======================================================================*/

/************************************************************************
  Nuke-Evolution: CKeditor wysiwyg integration file
  ============================================

  Filename      : ckeditor.php
  Author        : Travo
  Version       : 1.0
  Date          : 12/10/2009  (dd/mm/yyyy)

  Notes         : This file based off the FCKeditor integration file by
				  Frederico Caldeira Knabben
				
				  CKEditor - The text editor for Internet - http://ckeditor.com
				  Copyright (c) 2003-2009, CKSource - Frederico Knabben.
				  All rights reserved.
 ************************************************************************/

function ckeditor_getInstance($field='editor', $width='100%', $height='300px', $value='') {
      static $ckeditor;
        if (!isset($ckeditor)) {
            $ckeditor = new ckeditor;
        }
        $ckeditor->fields[$field] = array('width' => $width, 'height' => $height, 'value' => $value);
        return $ckeditor;	
}

class ckeditor {
	var $fields = array();
	var $first = true;
	
	function setHeader() {
        global $modheader;
        
		if ($this->first == false) {
            $modheader = '';
            return;
        }
		
        $this->first = false;
		$modheader = '<script src="includes/wysiwyg/ckeditor/ckeditor.js"></script>';

    }
	
	function getHtml($name) {
        $html  = '<div>';
		$html .= '<textarea name="' . $name . '">' . htmlspecialchars($this->fields[$name]['value']) . '</textarea>';
		$html .= '<script>';
		$html .= 'var editor = CKEDITOR.replace(\'' . $name . '\',{height:"' . $this->fields[$name]['height'] . '", width:"' . $this->fields[$name]['width'] . '"});';
		$html .= '</script>';
		$html .= '</div>';
		
		return $html;
    }
	
	function getInstance($field='editor', $width='100%', $height='300px', $value='') {
        static $ckeditor;
		
        if (!isset($ckeditor)) {
            $ckeditor = new ckeditor;
        }
		
        $ckeditor->fields[$field] = array('width' => $width, 'height' => $height, 'value' => $value);
        return $ckeditor;
    }
}
?>
