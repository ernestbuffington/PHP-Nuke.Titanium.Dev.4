<?php
/**
 * Username Avalibility Check.
 *
 * Does a check via AJAX to check if the username a new registered user enters is in use.
 *
 * @since 2.0.9e 
 *
 * @author coRpSE <https://www.headshotdomain.net>
 * @version 1.0
 * @license GPL-3.0
 */

if(!defined('NUKE_FILE')) 
    die('Access forbbiden');

if (isset($name) && preg_match('/^Your[ _]Account|Profile$/', $name)) 
{
	$JStoHead  = '<script>';
	$JStoHead .= '	nuke_jq(function($)';
	$JStoHead .= '	{';
	$JStoHead .= '		$("#username_input").focusout(function()';
	$JStoHead .= '		{';
	$JStoHead .= '			var $this = $(this);';
	$JStoHead .= '			if ($this.data("last") === this.value) {';
	$JStoHead .= ' 				return;';
	$JStoHead .= '			}';
	$JStoHead .= '			$.post("modules.php?name=Your_Account&op=username_check", {username: this.value}, function(data)';
	$JStoHead .= '			{';
	$JStoHead .= '				$("#username_check_result").html(data);';
	$JStoHead .= '			});';
	$JStoHead .= '			$this.data("last", this.value);';
	$JStoHead .= '		});';
	$JStoHead .= '	});';
	$JStoHead .= '</script>';
	addJSToBody($JStoHead,'inline');
}

?>