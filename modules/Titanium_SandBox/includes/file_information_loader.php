<?php 
if (!defined('MODULE_FILE')) { 
   die('You can\'t access this file directly...');
}

###############################			
# TEST CODE GOES HERE - START #
###############################
//OpenTable();
global $testfile, $description, $facebook_font_color;

//SPAN OPEN facebook light grey (not active font and color)
$so = "<span style=\"position: relative; color: rgb(118, 118, 118); font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; font-size: 11px; line-height: 14px; -webkit-text-size-adjust: none;\">";
//SPAN CLOSE facebook light grey (not active font and color) 

$fbdivblue = "<span style=\"position: relative; cursor: pointer; color: rgb(59, 89, 152); text-decoration: none; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; font-size: 11px; line-height: 14px; -webkit-text-size-adjust: none;\">";

$fbdiv = "<span style=\"position: relative; text-decoration: none; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; font-size: 12px; line-height: 15px; -webkit-text-size-adjust: none;\">";

$sc = '</span>';

//$dir is the chosen directory
$dir = "./modules/Titanium_SandBox";
$dir_admin = "./modules/Titanium_SandBox/admin";
$dir_css = "./modules/Titanium_SandBox/css";
$dir_facebook = "./modules/Titanium_SandBox/facebook";
$dir_images = "./modules/Titanium_SandBox/images";
$dir_includes = "./modules/Titanium_SandBox/includes";
$dir_js = "./modules/Titanium_SandBox/js";
$dir_songs = "./modules/Titanium_SandBox/songs";
$dir_file_descriptions = "./modules/Titanium_SandBox/project_file_descriptions";

$folderCount = $fileCount = 0;

////////////////////////////////////////////////////////////////////////////////
$css = img('css.png', 'Titanium_SandBox');
$css_img = "<img align=\"absmiddle\" width=\"17\" src=\"$css\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$bar = img('bar.gif', 'Titanium_SandBox');
$bar_img = "<img align=\"absmiddle\" width=\"17\" src=\"$bar\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$tee = img('tree-T.gif', 'Titanium_SandBox');
$tee_img = "<img align=\"absmiddle\" width=\"17\" src=\"$tee\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$L = img('tree-L.gif', 'Titanium_SandBox');
$L_img = "<img align=\"absmiddle\" width=\"17\" src=\"$L\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$pointer_icon = img('pointright.gif', 'Titanium_SandBox');
////////////////////////////////////////////////////////////////////////////////
$fpl = img('finger-pointing-left-icon.png', 'Titanium_SandBox');
$fpl_img = "<img align=\"abstop\" width=\"17\" src=\"$fpl\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$fpl_grey = img('finger-pointing-left-icon-grey.png', 'Titanium_SandBox');
$fplg_img = "<img align=\"abstop\" width=\"15\" src=\"$fpl_grey\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$fpr = img('finger-pointing-right-icon.png', 'Titanium_SandBox');
$fpr_img = "<img align=\"absbottom\" width=\"17\" src=\"$fpr\" border=\"0\">";
////////////////////////////////////////////////////////////////////////////////
$php = img('php-file.png', 'Titanium_SandBox');
////////////////////////////////////////////////////////////////////////////////
$php_active = img('php-file-active.png', 'Titanium_SandBox');
////////////////////////////////////////////////////////////////////////////////
$folder = img('folder.png', 'Titanium_SandBox');
////////////////////////////////////////////////////////////////////////////////

echo $fbdiv;
$php_dir = "<img align=\"absbottom\" width=\"17\" src=\"$folder\" border=\"0\">";
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox</font></strong> ".$fpl_img."  Your facebook SandBox folder, which is relative to your portal root directory (public_html).<br>";

if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];
	
	foreach( $dir_array as $file )
	{
		

		if( stripos( $file, '.' ) > 0)
		{
		   $fileCount++;

			if ($file == $testfile)
			{
			   $file_description = str_replace(".php", "_description.php", $file); 
			    
			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description))
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php_active\" border=\"0\" alt=\"$file ($description)\" title=\"$file ($description)\" >";
			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			   else
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			}
			
			if (($file != $testfile) && ($file != 'index.php') && ($file != 'index.html'))
			{
			   $file_description = str_replace(".php", "_description.php", $file); 
			    
			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description))
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php\" border=\"0\" alt=\"$file ($description)\" title=\"$file ($description)\" >";
			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " ".$so."{$file} ".$fplg_img." $description ".$sc."<br />";
			   else
			   echo $tee_img." ".$php_file. " ".$so."{$file} ".$fplg_img." $description".$sc."<br />";
			}
			
			if ($file == 'index.php')
			{
			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php_active\" border=\"0\" alt=\"index.php (module index file.)\" title=\"index.php (module index file.)\" >";
			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." This is your module index file, this is where we call your project file.<br />";
			   else
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." This is your module index file, this is where we call your project file.<br />";
				
			}



		}
	}
    
	//echo $L_img." <strong>This is the structure of your Titanium_SandBox module.<br />";
}       

echo '<hr>';
$dir = $dir_admin;
$php_dir = "<img align=\"absbottom\" width=\"17\" src=\"$folder\" border=\"0\">";
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/admin</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{

	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

	foreach( $dir_array as $file )
	{
		if( stripos( $file, '.' ) > 0){

		   $fileCount++;

			if (($file != $testfile) && ($file != 'index.php') && ($file != 'index.html'))
			{
			   $file_description = str_replace(".php", "_description.php", $file); 
			    
			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description))
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php\" border=\"0\" alt=\"$file ($description)\" title=\"$file ($description)\" >";

			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			   else
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			}
			
			if ($file == 'index.php')
			{

			   $file_description = str_replace(".php", "_description.php", $file); 

			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description))
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php\" border=\"0\" alt=\"index.php (module index file.)\" title=\"index.php (module index file.)\" >";

			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			   else
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
				
			}
		}
	}
}       
echo '<hr>';
$dir = $dir_css;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/css</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

	foreach( $dir_array as $file ){
		if( stripos( $file, '.' ) > 0){

		   $fileCount++;

			if (($file != $testfile) && ($file != 'index.php') && ($file != 'index.html'))
			{
               $file_description = str_replace(".css", "_description.css", $file);
			    
			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description))
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php\" border=\"0\" alt=\"$file ($description)\" title=\"$file ($description)\" >";

			   if ($file == $last_file)
			   echo $L_img." ".$css_img. " {$file} ".$fpl_img." $description<br />";
			   else
			   echo $tee_img." ".$css_img. " {$file} ".$fpl_img." $description<br />";
			}
			
			if ($file == 'index.php')
			{
			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php_active\" border=\"0\" alt=\"index.php (module index file.)\" title=\"index.php (module index file.)\" >";
			   echo $php_file. " {$file} ".$fpl_img." This is your module index file.<br />";
				
			}
		}
	}
}       
echo '<hr>';
$dir = $dir_facebook;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/facebook</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir_facebook );

    $files = scandir($dir_facebook, 1);
    
	$last_file = $files[0];

	foreach( $dir_array as $file )
	{
		if( stripos( $file, '.' ) > 0){

		   $fileCount++;

			if (($file != 'index.php') && ($file != 'index.html'))
			{
			   $file_description = str_replace(".php", "_description.php", $file); 
			    
			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description))
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php\" border=\"0\" alt=\"$file ($description)\" title=\"$file ($description)\" >";

			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			   
			   if ($file != $last_file)
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			}
			
			if ($file == 'index.php')
			{

			   $file_description = str_replace(".php", "_description.php", $file); 

			   if(file_exists(MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description)) 
		       include (MODULES.'Titanium_SandBox/project_file_descriptions/'.$file_description);
			   else
			   $description = 'please add the file <font color=#CC0000>'.$file_description.'</font> to <strong>modules/Titanium_SandBox/project_file_decriptions</strong> folder.';

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php_active\" border=\"0\" alt=\"index.php (module index file.)\" title=\"index.php (module index file.)\" >";

			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
			   if ($file != $last_file)
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." $description<br />";
				
			}
		}
	}
}       

echo '<hr>';
$dir = $dir_images;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/images</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{


	
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

	foreach( $dir_array as $file )
	{
		if( stripos( $file, '.' ) > 0){

		   $fileCount++;

			if (($file != 'index.php') && ($file != 'index.html'))
			{

			   $php_file = "<img align=\"absmiddle\" width=\"17\" src=\"$php\" border=\"0\" >";

			   if ($file == $last_file)
			   echo $L_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." image file<br />";
			   
			   if ($file != $last_file)
			   echo $tee_img." ".$php_file. " <strong><font color=#326b21>{$file}</font></strong> ".$fpl_img." image file<br />";
			}
			
		}
	}
}       
echo '<hr>';
$dir = $dir_includes;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/includes</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

}       
echo '<hr>';
$dir = $dir_js;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/js</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

}       
echo '<hr>';
$dir = $dir_songs;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/songs</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

}       
echo '<hr>';
$dir = $dir_file_descriptions;
echo $php_dir. " <strong><font color='$facebook_font_color'>modules/Titanium_SandBox/project_file_descriptions</font></strong> ".$fpl_img." Module Sub Folder<br>";
if( is_dir( $dir ) )
{
	$dir_array = scandir( $dir );

    $files = scandir($dir, 1);
    $last_file = $files[0];

}
echo '<hr>'; 
    echo "<strong>Total File Count : <font color=\"#C00000\">" . $fileCount."</font></strong>";
//echo '<hr>'; 
echo $sc;

//CloseTable();      
########################################
# TEST CODE GOES HERE - END            #
########################################
?> 
