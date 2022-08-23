
/***************************************************************************
 *                            def_icons.php
 *                            -------------
 *	begin			: 06/09/2003
 *	copyright		: Ptirhiik
 *	email			: admin@rpgnet-fr.com
 *	version			: 1.0.0 - 06/09/2003
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

$icones = array(
	<!-- BEGIN _outfile_icon -->
	array(
			'ind'	=> {_outfile_icon.IND},
			'img'	=> '{_outfile_icon.IMG}',
			'alt'	=> '{_outfile_icon.ALT}',
			'auth'	=> {_outfile_icon.AUTH},
	),
	<!-- END _outfile_icon -->
);

// definition of special topic
$icon_defined_special = array(
	<!-- BEGIN _outfile_default -->
	'{_outfile_default.NAME}' => array(
		'lang_key'	=> '{_outfile_default.LANG_KEY}',
		'icon'		=> {_outfile_default.ICON},
	),
	<!-- END _outfile_default -->
);
