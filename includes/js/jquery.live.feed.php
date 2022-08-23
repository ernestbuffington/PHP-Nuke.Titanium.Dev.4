<?php
/**
 * Live feed from Evolution Xtreme.
 *
 * Shows the latest live news coming from the Evolution Xtreme site,
 * It is designed to keep you up to date on changes to the CMS, Blocks, Modules & Themes.
 *
 * @since 2.0.9e 
 *
 * @author Lonestar <https://lonestar-modules.com>
 * @version 1.0.0
 * @license GPL-3.0
 */

if(!defined('NUKE_FILE')) die('Access forbbiden');

if(is_admin() && defined('ADMIN_FILE') && !get_query_var('op', 'get'))
{
    // addJSToHead(NUKE_JQUERY_DIR.'jquery.cookie.js','file');
    addJSToBody(NUKE_JQUERY_SCRIPTS_DIR.'jquery.live.feed.js','file', true);
}

?>