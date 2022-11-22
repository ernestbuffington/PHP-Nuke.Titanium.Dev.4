<?php
#---------------------------------------------------------------------------------------#
# CMS INFO                                                                              #
# PHP-Nuke Copyright (c) 2002 by Francisco Burzi phpnuke.org                            #
# PHP-Nuke Titanium (c) 2019 : Enhanced PHP-Nuke Web Portal System                      #
#---------------------------------------------------------------------------------------#
global $theme_name;
echo "/* themes/".$theme_name."/css/CKeditor.php - Fly Kit CKeditor Style Sheet */\n"; 
echo "/* Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved. */\n"; 
echo "/* For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license */\n"; 

global $screen_width, $screen_height, $bgcolor1, $bgcolor2, $bgcolor3, $bgcolor4, $bgcolor5;
?>
/**
 * Stylesheet for the Titanium Core Theme
 *
 * @filename:  CKeditor.php
 * @author  :  TheGhost
 * @version :  3.0
 * @date    :  11/22/2022 (DD/MM/YYY)
 * @license :  Copyright (c) 2022 The 86it Developers Network under the MIT license
 * @notes   :  n/a
 *
 * -- -------------------------------------------------------------------
 * \/ STYLESHEET NAVIGATION
 * -- -------------------------------------------------------------------
 *  PRESETS
 *  1.  "Source" button label
 *  2.  "Font Size" combo width  
 *  3.  "Font Size" panel size  
 *  4.  Editable regions
 * --- -------------------------------------------------------------------
 */

/*
 * 1. "Source" button label
 *----------------------------------------
 */
.cke_button__source_label,
.cke_button__sourcedialog_label
{
	display: inline;
}

/*
 * 2. "Font Size" combo width
 *----------------------------------------
 */
.cke_combo__fontsize .cke_combo_text
{
	width: 30px;
}

/*
 * 3. "Font Size" panel size
 *----------------------------------------
 */
.cke_combopanel__fontsize
{
	width: 120px;
}

/*
 * 4. Editable regions
 *----------------------------------------
 */

textarea.cke_source
{
	font-family: 'Courier New', Monospace;
	font-size: small;
	color: #000000;
    background-color: #FFFFFF; 
	white-space: pre-wrap;
	border: none;
	padding: 0;
	margin: 0;
	display: block;
}

.cke_wysiwyg_frame, .cke_wysiwyg_div
{
	color: #000000;
	background-color: #FFFFFF;
}
:host ::ng-deep .ck-editor__editable_inline p {
  margin: 0;
}
.cke_editable p 
{ 
  margin: 0 !important; 
}

p {
    line-height:19px;        
}
b {
    line-height:0px; 
}​

<?
