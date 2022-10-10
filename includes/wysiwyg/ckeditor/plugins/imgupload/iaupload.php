<?php
// PHP Upload Script for CKEditor:  http://coursesweb.net/

// HERE SET THE PATH TO THE FOLDERS FOR IMAGES AND AUDIO ON YOUR SERVER (RELATIVE TO THE ROOT OF YOUR WEBSITE ON SERVER)
$upload_dir = array(
 'img'=> '/imgs/',
 'audio'=> '/audio/'
);

// HERE PERMISSIONS FOR IMAGE
$imgset = array(
 'maxsize' => 2000,     // maximum file size, in KiloBytes (2 MB)
 'maxwidth' => 900,     // maximum allowed width, in pixels
 'maxheight' => 800,    // maximum allowed height, in pixels
 'minwidth' => 10,      // minimum allowed width, in pixels
 'minheight' => 10,     // minimum allowed height, in pixels
 'type' => array('bmp', 'gif', 'jpg', 'jpe', 'png'),  // allowed extensions
);

// HERE PERMISSIONS FOR AUDIO
$audioset = array(
 'maxsize' => 20000,    // maximum file size, in KiloBytes (20 MB)
 'type' => array('mp3', 'ogg', 'wav'),  // allowed extensions
);

// If 1 and filename exists, RENAME file, adding "_NR" to the end of filename (name_1.ext, name_2.ext, ..)
// If 0, will OVERWRITE the existing file
define('RENAME_F', 1);

$re = '';
if(isset($_FILES['upload']) && strlen($_FILES['upload']['name']) >1) {
  define('F_NAME', preg_replace('/\.(.+?)$/i', '', basename($_FILES['upload']['name'])));  //get filename without extension

  // get protocol and host name to send the absolute image path to CKEditor
  $protocol = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
  $site = $protocol. $_SERVER['SERVER_NAME'] .'/';
  $sepext = explode('.', strtolower($_FILES['upload']['name']));
  $type = end($sepext);    // gets extension
  $upload_dir = in_array($type, $imgset['type']) ? $upload_dir['img'] : $upload_dir['audio'];
  $upload_dir = trim($upload_dir, '/') .'/';

  //checkings for image or audio
  if(in_array($type, $imgset['type'])){
    list($width, $height) = getimagesize($_FILES['upload']['tmp_name']);  // image width and height
    if(isset($width) && isset($height)) {
      if($width > $imgset['maxwidth'] || $height > $imgset['maxheight']) $re .= '\\n Width x Height = '. $width .' x '. $height .' \\n The maximum Width x Height must be: '. $imgset['maxwidth']. ' x '. $imgset['maxheight'];
      if($width < $imgset['minwidth'] || $height < $imgset['minheight']) $re .= '\\n Width x Height = '. $width .' x '. $height .'\\n The minimum Width x Height must be: '. $imgset['minwidth']. ' x '. $imgset['minheight'];
      if($_FILES['upload']['size'] > $imgset['maxsize']*1000) $re .= '\\n Maximum file size must be: '. $imgset['maxsize']. ' KB.';
    }
  }
  else if(in_array($type, $audioset['type'])){
    if($_FILES['upload']['size'] > $audioset['maxsize']*1000) $re .= '\\n Maximum file size must be: '. $audioset['maxsize']. ' KB.';
  }
  else $re .= 'The file: '. $_FILES['upload']['name']. ' has not the allowed extension type.';

  //set filename; if file exists, and RENAME_F is 1, set "img_name_I"
  // $p = dir-path, $fn=filename to check, $ex=extension $i=index to rename
  function setFName($p, $fn, $ex, $i){
    if(RENAME_F ==1 && file_exists($p .$fn .$ex)) return setFName($p, F_NAME .'_'. ($i +1), $ex, ($i +1));
    else return $fn .$ex;
  }

  $f_name = setFName($_SERVER['DOCUMENT_ROOT'] .'/'. $upload_dir, F_NAME, ".$type", 0);
  $uploadpath = $_SERVER['DOCUMENT_ROOT'] .'/'. $upload_dir . $f_name;  // full file path

  // If no errors, upload the image, else, output the errors
  if($re == '') {
    if(move_uploaded_file($_FILES['upload']['tmp_name'], $uploadpath)) {
      $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
      $url = $site. $upload_dir . $f_name;
      $msg = F_NAME .'.'. $type .' successfully uploaded: \\n- Size: '. number_format($_FILES['upload']['size']/1024, 2, '.', '') .' KB';
      $re = in_array($type, $imgset['type']) ? "window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')"  //for img
       : 'var cke_ob = window.parent.CKEDITOR; for(var ckid in cke_ob.instances) { if(cke_ob.instances[ckid].focusManager.hasFocus) break;} cke_ob.instances[ckid].insertHtml(\'<audio src="'. $url .'" controls></audio>\', \'unfiltered_html\'); alert("'. $msg .'"); var dialog = cke_ob.dialog.getCurrent();  dialog.hide();';
    }
    else $re = 'alert("Unable to upload the file")';
  }
  else $re = 'alert("'. $re .'")';
}

@header('Content-type: text/html; charset=utf-8');
echo '<script>'. $re .';</script>';
