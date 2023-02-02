<?php
define('SETUP_URL_CHECK', 'https://an602.86it.us');
define('BASE_DIR', __DIR__ . '/');
define('SETUP_GRAPHICS_DIR', BASE_DIR . 'graphics/');
define('SETUP_INCLUDE_DIR', BASE_DIR . 'include/');
define('SETUP_LANGUAGE_DIR', BASE_DIR . 'language/');
define('SETUP_SQL_DIR', BASE_DIR . 'sql/');
define('SETUP_STEPS_DIR', BASE_DIR . 'steps/');
define('SETUP_UDL_DIR', BASE_DIR . 'udl/');
define('SETUP_STYLE_DIR', BASE_DIR . 'style/');
define('SETUP_UPGRADES_SQL_DIR', BASE_DIR . 'sql/');
define('SETUP_UPGRADES_STEPS_DIR', BASE_DIR . 'sql/');
define('SETUP_TEXTAREA_DIR', $_SERVER['DOCUMENT_ROOT']. '/includes/');
define('SETUP_NUKE_INCLUDES_DIR', $_SERVER['DOCUMENT_ROOT']. '/includes/');
define('SETUP_CACHE_DIR', $_SERVER['DOCUMENT_ROOT']. '/includes/cache/');
define('SETUP_FORUM_AVATARS_DIR', $_SERVER['DOCUMENT_ROOT']. '/modules/Forums/images/avatars/');
define('SETUP_FORUM_FILE_DIR', $_SERVER['DOCUMENT_ROOT']. '/modules/Forums/files/');
define('SETUP_GOOGLE_SITE_MAP_DIR', $_SERVER['DOCUMENT_ROOT']. '/xmls/sitemap/');
define('SETUP_IMAGE_REPOSITORY_DIR', $_SERVER['DOCUMENT_ROOT']. '/modules/Image_Repository/files/');
define('SETUP_FILE_REPOSITORY_DIR', $_SERVER['DOCUMENT_ROOT']. '/modules/File_Repository/files/');
define('SETUP_LOG_DIR', $_SERVER['DOCUMENT_ROOT']. '/includes/log/');
define('SETUP_UPLOADS_DIR', $_SERVER['DOCUMENT_ROOT']. '/');
//define('SETUP_BBCODE_JS', 'https://'.$_SERVER['HTTP_HOST']. '/includes/js/bbcode.js');

define('ROOT_DIR', 'https://'.$_SERVER['HTTP_HOST']. '/');
if(!isset($root_dir))
$root_dir = ROOT_DIR;

define('SETUP_LANGUAGE_COMMON_DIR', $_SERVER['DOCUMENT_ROOT']. '/language/common/');
define('SETUP_THEME_MAIN_DIR', $_SERVER['DOCUMENT_ROOT']. '/themes/');

