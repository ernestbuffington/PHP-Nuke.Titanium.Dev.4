<?php
/*=======================================================================
PHP-Nuke Titnaium v3.0.0 : Enhanced PHP-Nuke Web Portal System
=======================================================================*/

/************************************************************************
PHP-Nuke Titnaium : Evolution Functions
============================================
Copyright (c) 2005 by The PHP-Nuke Titanium Team

Filename      : functions_titnaium.php
Author        : The PHP-Nuke Titanium Team
Version       : 1.0.0
Date          : 08.16.2019 (mm.dd.yyyy)

Notes         : Miscellaneous functions
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

/**
 * Check if Folder Exist - 09/26/2022 4am
 * Checks if a folder exist and return canonicalized absolute pathname (long version)
 * @param string $folder the path being checked.
 * @return mixed returns the canonicalized absolute pathname on success otherwise FALSE is returned
 */

function folder_exist($folder)
{
    # Get canonicalized absolute pathname
    $path = realpath($folder);

    # If it exist, check if it's a directory
    if($path !== false AND is_dir($path))
    {
        # Return canonicalized absolute pathname
        return $path;
    }

    # Path/folder does not exist
    return false;
}

/**
 * Forum Icon Path Mod - 09/26/2022 4am
 * This makes it so that each theme is using Independent forum icons!
 * You can now style each theme with custom matching icons
 * Mod Created by Ernest Buffington aka TheGhost
 */

function forum_icon_img_path($icon='', $mymodule='', $empty=true) 
{
    global $currentlang, $ThemeSel, $Default_Theme, $ImageDebug;

    $folder = NUKE_BASE_DIR.'themes/'.$ThemeSel.'/images/forum_icons';
    $source_dir = NUKE_BASE_DIR.'modules/Forums/images/forum_icons';
    
	if(FALSE !== ($path = folder_exist($folder)))
    {
     $forum_icon_path = TITANIUM_THEMES_IMAGE_DIR.$ThemeSel."/"; 
	 //log_write('error', "( ".$forum_icon_path." ) <--- Forum Icon Path!", 'Image Found!');

    }
    else
	{
		# Open the source folder / directory 
        $dir = opendir($source_dir); 	

	    mkdir($folder);
	
	    # Loop through the files in source directory 
        while($file = readdir($dir)) 
        {
          # Skip . and .. 
          if(($file != '.') && ($file != '..')) 
          {  
             # Check if it's folder / directory or file 
             if(is_dir($source_dir.'/'.$file))  
             {    
                # Recursively calling this function for sub directory  
                recursive_files_copy($source_dir.'/'.$file, $folder.'/'.$file); 
             }  
            else 
               {   
                  # Copying the files
                  copy($source_dir.'/'.$file, $folder.'/'.$file);  
               }  
          }  
        }  
     
	    closedir($dir); 
	}
	
	return($forum_icon_path);
}


/**
 * gif image loop fixer, prints image full url
 * 
 * as this is written as a part of framework, there are some config options
 */

// put your images absolute path here eg '/var/www/html/www.example.com/images/'
// or use autodetection below
$GLOBALS['config']['upload_path'] = str_replace("\\", "/", trim(getcwd(), " /\\")).'/images/';
// put your images relative/absolute url here, eg 'http://www.example.com/images/';
$GLOBALS['config']['upload_url'] = '/images/';

function _ig($image)
{

    $image_a = pathinfo($image);

    $new_filename = $GLOBALS['config']['upload_path'].$image_a['dirname'].'/_'.$image_a['filename'].'.'.$image_a['extension'];
    $new_url = $GLOBALS['config']['upload_url'].$image_a['dirname'].'/_'.$image_a['filename'].'.'.$image_a['extension'];

    if ($image_a['extension'] == 'gif'){

        if (!file_exists($new_filename)){

            // load file contents
            $data = file_get_contents($GLOBALS['config']['upload_path'].$image);

            if (!strstr($data, 'NETSCAPE2.0')){

                // gif colours byte
                $colours_byte = $data[10];

                // extract binary string
                $bin = decbin(ord($colours_byte));
                $bin = str_pad($bin, 8, 0, STR_PAD_LEFT);

                // calculate colour table length
                if ($bin[0] == 0){
                    $colours_length = 0;
                } else {
                    $colours_length = 3 * pow(2, (bindec(substr($bin, 1, 3)) + 1)); 
                }

                // put netscape string after 13 + colours table length
                $start = substr($data, 0, 13 + $colours_length);
                $end = substr($data, 13 + $colours_length);

                file_put_contents($new_filename, $start . chr(0x21) . chr(0xFF) . chr(0x0B) . 'NETSCAPE2.0' . chr(0x03) . chr(0x01) . chr(0x00) . chr(0x00) . chr(0x00) . $end);

            } else {

                file_put_contents($new_filename, $data);

            }

        }

        print($new_url);

    } else {

        print($GLOBALS['config']['upload_url'].$image);

    }

}

function img_tag_to_resize($text) {
    global $img_resize;
    if(!$img_resize) return $text;
    if(empty($text)) return $text;
    if(preg_match('/<NO RESIZE>/',$text)) {
        $text = str_replace('<NO RESIZE>', '', $text);
        return $text;
    }
    // $text = preg_replace('/<\s*?img/',"<img resizemod=\"on\" ",$text);
    # <div class="reimg-loading"></div><img class="reimg" onload="reimg(this);" onerror="reimg(this);"
    $text = preg_replace('/<\s*?img/',"<div align=\"center\" class=\"reimg-loading\"></div><img class=\"reimg\" onload=\"reimg(this);\" onerror=\"reimg(this);\" ",$text);
    return $text;
}

function titanium_site_up($url) {
    //Set the address
    $address = parse_url($url);
    $host = $address['host'];
    if (!($ip = @gethostbyname($host))) return false;
    if (@fsockopen($host, 80, $errno, $errdesc, 10) === false) return false;
    return true;
}
