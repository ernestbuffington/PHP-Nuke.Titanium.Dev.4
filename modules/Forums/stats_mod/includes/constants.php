<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/***************************************************************************
 *                                constants.php
 *                            -------------------
 *   begin                : Sat, Jan 04, 2003
 *   copyright            : (C) 2003 Meik Sievertsen
 *   email                : acyd.burn@gmx.de
 *
 *   $Id: constants.php,v 1.7 2003/02/11 17:31:12 acydburn Exp $
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

if (!defined('IN_PHPBB'))
{
    die('Hacking attempt');
}

// Define Table Constants
define('STATS_CONFIG_TABLE', $prefix . '_bbstats_config');
define('MODULE_ADMIN_TABLE', $prefix . '_bbstats_module_admin_panel');
define('CACHE_TABLE', $prefix . '_bbstats_module_cache');
define('MODULE_GROUP_AUTH_TABLE', $prefix . '_bbstats_module_group_auth');
define('MODULE_INFO_TABLE', $prefix . '_bbstats_module_info');
define('MODULES_TABLE', $prefix . '_bbstats_modules');
define('SMILIE_INDEX_TABLE', $prefix . '_bbstats_smilies_index');
define('SMILIE_INFO_TABLE', $prefix . '_bbstats_smilies_info');

if(is_admin()):
    define('STATS_DEBUG', true); // Debug Mode
else:
	define('STATS_DEBUG',false);
endif;

// Cache Defines
define('HIGHEST_PRIORITY', 100);
define('LOWEST_PRIORITY', 101);
define('EQUAL_PRIORITY', 102);

?>