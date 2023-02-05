<?php

/**
*****************************************************************************************
** PHP-Nuke Titanium v4.0.4 - Project Start Date 11/04/2022 Friday 4:09 am             **
*****************************************************************************************
** https://www.php-nuke-titanium.86it.us
** https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4
** https://www.php-nuke-titanium.86it.us/index.php (DEMO)
** Apache License, Version 2.0. MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File class.template.php 2018-10-07 07:16:00 Thor
**
** CHANGES
**
** 2018-10-07 - Updated Masthead, Github, !defined('IN_NUKE')
**/

if (!defined('IN_NUKE'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ('Error 404 - Page Not Found');
}

class Template {
    public $vars; /// Holds all the template variables
	public $_tpldata = ['.' => [0 => []]];
	public $_rootref;
	public $root = '';
	public $cachepath = '';
	public $inherit_root = '';
	public $expire = '';
	public $block_names = [];
	public $block_else_level = [];
	public $cache_dir = '';
	public $compiled_code;
	public $files = [];
	public $filename = [];

    /**
     * Constructor
     *
     * @param $file string the file name you want to load
     */
    function __construct($file = NULL) {
	global $theme, $phpEx, $pmbt_cache;
	$this->expire = $pmbt_cache->theme_expire;
	$this->cache_dir = $pmbt_cache->cache_dir;
	$this->cachepath = $pmbt_cache->cache_dir;
	if($file){
        $this->file = $this->check_file($file);
		}
		else
		$this->file = $file;
    }
    /**
     * Look for file in cache.
     */
	function set_custom_template($template_path, $template_name)
	{
		global $phpbb_root_path;

		$this->root = $template_path;
		$this->cachepath = $phpbb_root_path . $this->cache_dir . 'ctpl_' . str_replace('_', '-', (string) $template_name) . '_';

		return true;
	}
    function check_file($name)
	{
	  global $theme, $phpEx;
	  // ----Clear name to Just the file name----//
	  $name = str_replace([$this->cache_dir, "themes/".$theme."/templates/"], '', (string) $name);
	//  die('/'.$name);
	  if(!preg_match('/(.*).\bhtml\b/',$name)){
	   		die('This is not a Template File: ' . $name );
	  }
	  $theme_name = "themes/".$theme."/templates/".$name;
	  $cache_file = $this->cache_dir.$theme.'_' .str_replace("admin/","admin_",$name).".".$phpEx;;

	   if(!file_exists($theme_name))	{
	   		die('Template path could not be found: ' . $theme_name );
		}
		if (!file_exists($cache_file) OR (filemtime($cache_file) < (time() - $this->expire))){
		$file_out = $this->compile(file_get_contents($theme_name));
		$this->compile_write($name,$file_out);
		}
		return $cache_file;
	}
    /**
     * Set a template variable.
     */
    function set($name, $value) {
        $this->vars[$name] = is_object($value) ? $value->fetch() : $value;
    }

	function set_filenames($filename_array)
	{
		if (!is_array($filename_array))
		{
			return false;
		}
		foreach ($filename_array as $handle => $filename)
		{
			if (empty($filename))
			{
				trigger_error("template->set_filenames: Empty filename specified for $handle", E_USER_ERROR);
			}

			$this->filename[$handle] = $filename;
			$this->files[$handle] = $this->root . '/' . $filename;


			if ($this->inherit_root)
			{
				$this->files_inherit[$handle] = $this->inherit_root . '/' . $filename;
			}
		}
		return true;
	}
	function assign_vars($vararray)
	{
		foreach ($vararray as $key => $val)
		{
			$this->_rootref[$key] = $val;
		}

		return true;
	}

	/**
	* Assign a single variable to a single key
	* @access public
	*/
	function assign_var($varname, $varval)
	{
		$this->_rootref[$varname] = $varval;

		return true;
	}
    /**
     * Open, parse, and return the template file.
     *
     * @param $file string the template file name
     */
	function destroy_block_vars($blockname)
	{
		if (str_contains((string) $blockname, '.'))
		{
			// Nested block.
			$blocks = explode('.', (string) $blockname);
			$blockcount = sizeof($blocks) - 1;

			$str = &$this->_tpldata;
			for ($i = 0; $i < $blockcount; $i++)
			{
				$str = &$str[$blocks[$i]];
				$str = &$str[sizeof($str) - 1];
			}

			unset($str[$blocks[$blockcount]]);
		}
		else
		{
			// Top-level block.
			unset($this->_tpldata[$blockname]);
		}

		return true;
	}
	function destroy()
	{
		$this->_tpldata = ['.' => [0 => []]];
	}
	function _tpl_load(&$handle)
	{
		global $user, $phpEx, $config,$theme;

		$filename = $this->cachepath . str_replace('/', '.', (string) $this->filename[$handle]) . '.' . $phpEx;
		$this->files_template[$handle] = $user->theme . '\'';

		$recompile = false;
		if (!file_exists($filename) || @filesize($filename) === 0)
		{
			$recompile = true;
		}
		else if ($config['load_tplcompile'])
		{
			// No way around it: we need to check inheritance here
			if ($user->theme['template_inherits_id'] && !file_exists($this->files[$handle]))
			{
				$this->files[$handle] = $this->files_inherit[$handle];
				$this->files_template[$handle] = $user->theme;
			}
			$recompile = (@filemtime($filename) < filemtime($this->files[$handle])) ? true : false;
		}
		// Recompile page if the original template is newer, otherwise load the compiled version
		if (!$recompile)
		{
			return $filename;
		}
		if(preg_match("/language\/email\//",(string) $this->files[$handle]))
		{
			$data = $this->compile(trim(file_get_contents($this->files[$handle])));
		}
		elseif(preg_match("/style\/upgrade\//",(string) $this->files[$handle]))
		{
			$data = $this->compile(trim(file_get_contents($this->files[$handle])));
		}
		else
		{
			$data = $this->compile(trim(file_get_contents("themes/".$theme."/templates".$this->files[$handle])));
		}
		//die(str_replace($this->root . '/','',$this->files[$handle]));
		$this->compiled_code[$handle] = $data;
		//die($this->compiled_code);
				//echo(str_replace($this->root . '/','',$this->files[$handle]));

		$this->compile_write(str_replace($this->root . '/','',(string) $this->files[$handle]), $data);
			return false;
	}

	function display($handle, $include_once = true)
	{
		global $user, $phpbb_hook;


		if (defined('IN_ERROR_HANDLER'))
		{
			if ((E_NOTICE & error_reporting()) == E_NOTICE)
			{
				error_reporting(error_reporting() ^ E_NOTICE);
			}
		}

		if ($filename = $this->_tpl_load($handle))
		{
			($include_once) ? include_once($filename) : include($filename);
		}
		else
		{
			if($this->compiled_code[$handle]){
			//echo $this->compiled_code[$handle];
			eval(' ?>' . $this->compiled_code[$handle] . '<?php ');
			}
		}

		return true;
	}
	function assign_display($handle, $template_var = '', $return_content = true, $include_once = false)
	{
		ob_start();
		$this->display($handle, $include_once);
		$contents = ob_get_clean();

		if ($return_content)
		{
			return $contents;
		}

		$this->assign_var($template_var, $contents);

		return true;
	}
    function fetch($file = NULL) {
	global $user, $theme,$startpagetime,$TheQueryCount;
       if(!$file) $file = $this->file;
	   else
	   $file = $this->check_file($file);
	   $this->assign_vars(['S_GENTIME'=> abs(round(microtime()-$startpagetime,2)), 'S_QUERYCOUNT'=>$TheQueryCount]);
        if($this->vars)extract($this->vars);          // Extract the vars to local namespace
        ob_start();                    // Start output buffering
        include_once($file);                // Include the file
        $contents = ob_get_contents(); // Get the contents of the buffer
        ob_end_clean();                // End buffering and discard
        return $contents;              // Return the contents
    }

	function remove_php_tags(&$code)
	{
		// This matches the information gathered from the internal PHP lexer
		$match = ['#<([\?%])=?.*?\1>#s', '#<script\s+language\s*=\s*(["\']?)php\1\s*>.*?</script\s*>#s', '#<\?php(?:\r\n?|[ \n\t]).*?\?>#s'];

		$code = preg_replace($match, '', (string) $code);
	}

	/**
	* The all seeing all doing compile method. Parts are inspired by or directly from Smarty
	* @access private
	*/
	function compile($code, $no_echo = false, $echo_var = '')
	{
		global $config;

		if ($echo_var)
		{
			global ${$echo_var};
		}

		// Remove any "loose" php ... we want to give admins the ability
		// to switch on/off PHP for a given template. Allowing unchecked
		// php is a no-no. There is a potential issue here in that non-php
		// content may be removed ... however designers should use entities
		// if they wish to display < and >
		//$this->remove_php_tags($code);

		// Pull out all block/statement level elements and separate plain text
		preg_match_all('#<!-- PHP -->(.*?)<!-- ENDPHP -->#s', (string) $code, $matches);
		$php_blocks = $matches[1];
		$code = preg_replace('#<!-- PHP -->.*?<!-- ENDPHP -->#s', '<!-- PHP -->', (string) $code);

		preg_match_all('#<!-- INCLUDE ([a-zA-Z0-9\_\-\+\./]+) -->#', $code, $matches);
		$include_blocks = $matches[1];
		$code = preg_replace('#<!-- INCLUDE [a-zA-Z0-9\_\-\+\./]+ -->#', '<!-- INCLUDE -->', $code);

		preg_match_all('#<!-- INCLUDEPHP ([a-zA-Z0-9\_\-\+\./]+) -->#', $code, $matches);
		$includephp_blocks = $matches[1];
		$code = preg_replace('#<!-- INCLUDEPHP [a-zA-Z0-9\_\-\+\./]+ -->#', '<!-- INCLUDEPHP -->', $code);

		preg_match_all('#<!-- ([^<].*?) (.*?)? ?-->#', $code, $blocks, PREG_SET_ORDER);

		$text_blocks = preg_split('#<!-- [^<].*? (?:.*?)? ?-->#', $code);

		for ($i = 0, $j = sizeof($text_blocks); $i < $j; $i++)
		{
			$this->compile_var_tags($text_blocks[$i]);
		}
		$compile_blocks = [];

		for ($curr_tb = 0, $tb_size = sizeof($blocks); $curr_tb < $tb_size; $curr_tb++)
		{
			$block_val = &$blocks[$curr_tb];

			switch ($block_val[1])
			{
				case 'BEGIN':
					$this->block_else_level[] = false;
					$compile_blocks[] = '<?php ' . $this->compile_tag_block($block_val[2]) . ' ?>';
				break;

				case 'BEGINELSE':
					$this->block_else_level[sizeof($this->block_else_level) - 1] = true;
					$compile_blocks[] = '<?php }} else { ?>';
				break;

				case 'END':
					array_pop($this->block_names);
					$compile_blocks[] = '<?php ' . ((array_pop($this->block_else_level)) ? '}' : '}}') . ' ?>';
				break;

				case 'IF':
					$compile_blocks[] = '<?php ' . $this->compile_tag_if($block_val[2], false) . ' ?>';
				break;

				case 'ELSE':
					$compile_blocks[] = '<?php } else { ?>';
				break;

				case 'ELSEIF':
					$compile_blocks[] = '<?php ' . $this->compile_tag_if($block_val[2], true) . ' ?>';
				break;

				case 'ENDIF':
					$compile_blocks[] = '<?php } ?>';
				break;

				case 'DEFINE':
					$compile_blocks[] = '<?php ' . $this->compile_tag_define($block_val[2], true) . ' ?>';
				break;

				case 'UNDEFINE':
					$compile_blocks[] = '<?php ' . $this->compile_tag_define($block_val[2], false) . ' ?>';
				break;

				case 'INCLUDE':
					$temp = array_shift($include_blocks);
					$compile_blocks[] = $this->compile(file_get_contents($temp));
					$this->fetch($temp);
				break;

				case 'INCLUDEPHP':
					$compile_blocks[] = ($config['tpl_allow_php']) ? '<?php ' . $this->compile_tag_include_php(array_shift($includephp_blocks)) . ' ?>' : '';
				break;

				case 'PHP':
					$compile_blocks[] = '<?php ' . array_shift($php_blocks) . '?>';
				break;

				default:
					$this->compile_var_tags($block_val[0]);
					$trim_check = trim($block_val[0]);
					$compile_blocks[] = (!$no_echo) ? ((!empty($trim_check)) ? $block_val[0] : '') : ((!empty($trim_check)) ? $block_val[0] : '');
				break;
			}
		}

		$template_php = '';
		for ($i = 0, $size = sizeof($text_blocks); $i < $size; $i++)
		{
			$trim_check_text = trim($text_blocks[$i]);
			$template_php .= (!$no_echo) ? (($trim_check_text != '') ? $text_blocks[$i] : '') . ($compile_blocks[$i] ?? '') : (($trim_check_text != '') ? $text_blocks[$i] : '') . ($compile_blocks[$i] ?? '');
		}

		// There will be a number of occasions where we switch into and out of
		// PHP mode instantaneously. Rather than "burden" the parser with this
		// we'll strip out such occurences, minimising such switching
		if ($no_echo)
		{
			return "\$$echo_var .= '" . str_replace(' ?><?php ', ' ', $template_php) . "'";
		}

		return str_replace(' ?><?php ', ' ', $template_php);
	}

	/**
	* Compile variables
	* @access private
	*/
	function compile_var_tags(&$text_blocks)
	{
		// change template varrefs into PHP varrefs
		$varrefs = [];

		// This one will handle varrefs WITH namespaces
		preg_match_all('#\{((?:[a-z0-9\-_]+\.)+)(\$)?([A-Z0-9\-_]+)\}#', (string) $text_blocks, $varrefs, PREG_SET_ORDER);

		foreach ($varrefs as $var_val)
		{
			$namespace = $var_val[1];
			$varname = $var_val[3];
			$new = $this->generate_block_varref($namespace, $varname, true, $var_val[2]);

			$text_blocks = str_replace($var_val[0], $new, (string) $text_blocks);
		}

		// This will handle the remaining root-level varrefs
		// transform vars prefixed by L_ into their language variable pendant if nothing is set within the tpldata array
		if (str_contains((string) $text_blocks, '{L_'))
		{
			$text_blocks = preg_replace('#\{L_([a-z0-9\-_]*)\}#is', "<?php echo ((isset(\$this->_rootref['L_\\1'])) ? \$this->_rootref['L_\\1'] : ((isset(\$user->lang['\\1'])) ? \$user->lang['\\1'] : ((defined('\\1')) ? \\1 : '{ \\1 }'))); ?>", (string) $text_blocks);
		}

		// Handle addslashed language variables prefixed with LA_
		// If a template variable already exist, it will be used in favor of it...
		if (str_contains((string) $text_blocks, '{LA_'))
		{
			$text_blocks = preg_replace('#\{LA_([a-z0-9\-_]*)\}#is', "<?php echo ((isset(\$this->_rootref['LA_\\1'])) ? \$this->_rootref['LA_\\1'] : ((isset(\$this->_rootref['L_\\1'])) ? addslashes(\$this->_rootref['L_\\1']) : ((isset(\$user->lang['\\1'])) ? addslashes(\$user->lang['\\1']) : '{ \\1 }'))); ?>", (string) $text_blocks);
		}
		if (str_contains((string) $text_blocks, '{LANG_'))
		{
			$text_blocks = preg_replace('#\{LANG_([a-z0-9\-_]*)\}#is', "<?php echo \\1; ?>", (string) $text_blocks);
		}

		// Handle remaining varrefs
		$text_blocks = preg_replace('#\{([A-Z0-9\-_]+)\}#', "<?php echo (isset(\$this->_rootref['\\1'])) ? \$this->_rootref['\\1'] : ''; ?>", (string) $text_blocks);
		$text_blocks = preg_replace('#\{\$([A-Z0-9\-_]+)\}#', "<?php echo (isset(\$this->_tpldata['DEFINE']['.']['\\1'])) ? \$this->_tpldata['DEFINE']['.']['\\1'] : ''; ?>", $text_blocks);

		return;
	}

	/**
	* Compile blocks
	* @access private
	*/
	function compile_tag_block($tag_args)
	{
		$no_nesting = false;

		// Is the designer wanting to call another loop in a loop?
		if (str_starts_with((string) $tag_args, '!'))
		{
			// Count the number if ! occurrences (not allowed in vars)
			$no_nesting = substr_count((string) $tag_args, '!');
			$tag_args = substr((string) $tag_args, $no_nesting);
		}

		// Allow for control of looping (indexes start from zero):
		// foo(2)    : Will start the loop on the 3rd entry
		// foo(-2)   : Will start the loop two entries from the end
		// foo(3,4)  : Will start the loop on the fourth entry and end it on the fifth
		// foo(3,-4) : Will start the loop on the fourth entry and end it four from last
		if (preg_match('#^([^()]*)\(([\-\d]+)(?:,([\-\d]+))?\)$#', (string) $tag_args, $match))
		{
			$tag_args = $match[1];

			if ($match[2] < 0)
			{
				$loop_start = '($_' . $tag_args . '_count ' . $match[2] . ' < 0 ? 0 : $_' . $tag_args . '_count ' . $match[2] . ')';
			}
			else
			{
				$loop_start = '($_' . $tag_args . '_count < ' . $match[2] . ' ? $_' . $tag_args . '_count : ' . $match[2] . ')';
			}

			if (strlen($match[3]) < 1 || $match[3] == -1)
			{
				$loop_end = '$_' . $tag_args . '_count';
			}
			else if ($match[3] >= 0)
			{
				$loop_end = '(' . ($match[3] + 1) . ' > $_' . $tag_args . '_count ? $_' . $tag_args . '_count : ' . ($match[3] + 1) . ')';
			}
			else //if ($match[3] < -1)
			{
				$loop_end = '$_' . $tag_args . '_count' . ($match[3] + 1);
			}
		}
		else
		{
			$loop_start = 0;
			$loop_end = '$_' . $tag_args . '_count';
		}

		$tag_template_php = '';
		array_push($this->block_names, $tag_args);

		if ($no_nesting !== false)
		{
			// We need to implode $no_nesting times from the end...
			$block = array_slice($this->block_names, -$no_nesting);
		}
		else
		{
			$block = $this->block_names;
		}

		if (sizeof($block) < 2)
		{
			// Block is not nested.
			$tag_template_php = '$_' . $tag_args . "_count = (isset(\$this->_tpldata['$tag_args'])) ? sizeof(\$this->_tpldata['$tag_args']) : 0;";
			$varref = "\$this->_tpldata['$tag_args']";
		}
		else
		{
			// This block is nested.
			// Generate a namespace string for this block.
			$namespace = implode('.', $block);

			// Get a reference to the data array for this block that depends on the
			// current indices of all parent blocks.
			$varref = $this->generate_block_data_ref($namespace, false);

			// Create the for loop code to iterate over this block.
			$tag_template_php = '$_' . $tag_args . '_count = (isset(' . $varref . ')) ? sizeof(' . $varref . ') : 0;';
		}

		$tag_template_php .= 'if ($_' . $tag_args . '_count) {';

		/**
		* The following uses foreach for iteration instead of a for loop, foreach is faster but requires PHP to make a copy of the contents of the array which uses more memory
		* <code>
		*	if (!$offset)
		*	{
		*		$tag_template_php .= 'foreach (' . $varref . ' as $_' . $tag_args . '_i => $_' . $tag_args . '_val){';
		*	}
		* </code>
		*/

		$tag_template_php .= 'for ($_' . $tag_args . '_i = ' . $loop_start . '; $_' . $tag_args . '_i < ' . $loop_end . '; ++$_' . $tag_args . '_i){';
		$tag_template_php .= '$_'. $tag_args . '_val = &' . $varref . '[$_'. $tag_args. '_i];';

		return $tag_template_php;
	}

	/**
	* Compile IF tags - much of this is from Smarty with
	* some adaptions for our block level methods
	* @access private
	*/
	function compile_tag_if($tag_args, $elseif)
	{
		// Tokenize args for 'if' tag.
		preg_match_all('/(?:
			"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"         |
			\'[^\'\\\\]*(?:\\\\.[^\'\\\\]*)*\'     |
			[(),]                                  |
			[^\s(),]+)/x', (string) $tag_args, $match);

		$tokens = $match[0];
		$is_arg_stack = [];

		for ($i = 0, $size = sizeof($tokens); $i < $size; $i++)
		{
			$token = &$tokens[$i];

			switch ($token)
			{
				case '!==':
				case '===':
				case '<<':
				case '>>':
				case '|':
				case '^':
				case '&':
				case '~':
				case ')':
				case ',':
				case '+':
				case '-':
				case '*':
				case '/':
				case '@':
				break;

				case '==':
				case 'eq':
					$token = '==';
				break;

				case '!=':
				case '<>':
				case 'ne':
				case 'neq':
					$token = '!=';
				break;

				case '<':
				case 'lt':
					$token = '<';
				break;

				case '<=':
				case 'le':
				case 'lte':
					$token = '<=';
				break;

				case '>':
				case 'gt':
					$token = '>';
				break;

				case '>=':
				case 'ge':
				case 'gte':
					$token = '>=';
				break;

				case '&&':
				case 'and':
					$token = '&&';
				break;

				case '||':
				case 'or':
					$token = '||';
				break;

				case '!':
				case 'not':
					$token = '!';
				break;

				case '%':
				case 'mod':
					$token = '%';
				break;

				case '(':
					array_push($is_arg_stack, $i);
				break;

				case 'is':
					$is_arg_start = ($tokens[$i-1] == ')') ? array_pop($is_arg_stack) : $i-1;
					$is_arg	= implode('	', array_slice($tokens,	$is_arg_start, $i -	$is_arg_start));

					$new_tokens	= $this->_parse_is_expr($is_arg, array_slice($tokens, $i+1));

					array_splice($tokens, $is_arg_start, sizeof($tokens), $new_tokens);

					$i = $is_arg_start;

				// no break

				default:
					if (preg_match('#^((?:[a-z0-9\-_]+\.)+)?(\$)?(?=[A-Z])([A-Z0-9\-_]+)#s', (string) $token, $varrefs))
					{
						$token = (!empty($varrefs[1])) ? $this->generate_block_data_ref(substr($varrefs[1], 0, -1), true, $varrefs[2]) . '[\'' . $varrefs[3] . '\']' : (($varrefs[2]) ? '$this->_tpldata[\'DEFINE\'][\'.\'][\'' . $varrefs[3] . '\']' : '$this->_rootref[\'' . $varrefs[3] . '\']');
					}
					else if (preg_match('#^\.((?:[a-z0-9\-_]+\.?)+)$#s', (string) $token, $varrefs))
					{
						// Allow checking if loops are set with .loopname
						// It is also possible to check the loop count by doing <!-- IF .loopname > 1 --> for example
						$blocks = explode('.', $varrefs[1]);

						// If the block is nested, we have a reference that we can grab.
						// If the block is not nested, we just go and grab the block from _tpldata
						if (sizeof($blocks) > 1)
						{
							$block = array_pop($blocks);
							$namespace = implode('.', $blocks);
							$varref = $this->generate_block_data_ref($namespace, true);

							// Add the block reference for the last child.
							$varref .= "['" . $block . "']";
						}
						else
						{
							$varref = '$this->_tpldata';

							// Add the block reference for the last child.
							$varref .= "['" . $blocks[0] . "']";
						}
						$token = "@sizeof($varref)";
					}
					else if (!empty($token))
					{
						$token = '\'' . $token . '\'';
					}

				break;
			}
		}

		// If there are no valid tokens left or only control/compare characters left, we do skip this statement
		if (!sizeof($tokens) || str_replace([' ', '=', '!', '<', '>', '&', '|', '%', '(', ')'], '', implode('', $tokens)) == '')
		{
			$tokens = ['false'];
		}
		return (($elseif) ? '} else if (' : 'if (') . (implode(' ', $tokens) . ') { ');
	}

	/**
	* Compile DEFINE tags
	* @access private
	*/
	function compile_tag_define($tag_args, $op)
	{
		preg_match('#^((?:[a-z0-9\-_]+\.)+)?\$(?=[A-Z])([A-Z0-9_\-]*)(?: = (\'?)([^\']*)(\'?))?$#', (string) $tag_args, $match);

		if (empty($match[2]) || (!isset($match[4]) && $op))
		{
			return '';
		}

		if (!$op)
		{
			return 'unset(' . (($match[1]) ? $this->generate_block_data_ref(substr($match[1], 0, -1), true, true) . '[\'' . $match[2] . '\']' : '$this->_tpldata[\'DEFINE\'][\'.\'][\'' . $match[2] . '\']') . ');';
		}

		// Are we a string?
		if ($match[3] && $match[5])
		{
			$match[4] = str_replace(['\\\'', '\\\\', '\''], ['\'', '\\', '\\\''], $match[4]);

			// Compile reference, we allow template variables in defines...
			$match[4] = $this->compile($match[4]);

			// Now replace the php code
			$match[4] = "'" . str_replace(['<?php echo ', '; ?>'], ["' . ", " . '"], (string) $match[4]) . "'";
		}
		else
		{
			preg_match('#true|false|\.#i', $match[4], $type);
			//print_r($type);
			if(!$type) $type = [0=>'no'];

			$match[4] = match (strtolower($type[0])) {
       'true', 'false' => strtoupper($match[4]),
       '.' => doubleval($match[4]),
       default => intval($match[4]),
   };
		}

		return (($match[1]) ? $this->generate_block_data_ref(substr((string) $match[1], 0, -1), true, true) . '[\'' . $match[2] . '\']' : '$this->_tpldata[\'DEFINE\'][\'.\'][\'' . $match[2] . '\']') . ' = ' . $match[4] . ';';
	}

	/**
	* Compile INCLUDE tag
	* @access private
	*/
	function compile_tag_include($tag_args)
	{
		return "include_once('$tag_args');";
	}

	/**
	* Compile INCLUDE_PHP tag
	* @access private
	*/
	function compile_tag_include_php($tag_args)
	{
		return "include('" . $tag_args . "');";
	}

	/**
	* parse expression
	* This is from Smarty
	* @access private
	*/
	function _parse_is_expr($is_arg, $tokens)
	{
		$expr = null;
  $expr_end = 0;
		$negate_expr = false;

		if (($first_token = array_shift($tokens)) == 'not')
		{
			$negate_expr = true;
			$expr_type = array_shift($tokens);
		}
		else
		{
			$expr_type = $first_token;
		}

		switch ($expr_type)
		{
			case 'even':
				if (@$tokens[$expr_end] == 'by')
				{
					$expr_end++;
					$expr_arg = $tokens[$expr_end++];
					$expr = "!(($is_arg / $expr_arg) % $expr_arg)";
				}
				else
				{
					$expr = "!($is_arg & 1)";
				}
			break;

			case 'odd':
				if (@$tokens[$expr_end] == 'by')
				{
					$expr_end++;
					$expr_arg = $tokens[$expr_end++];
					$expr = "(($is_arg / $expr_arg) % $expr_arg)";
				}
				else
				{
					$expr = "($is_arg & 1)";
				}
			break;

			case 'div':
				if (@$tokens[$expr_end] == 'by')
				{
					$expr_end++;
					$expr_arg = $tokens[$expr_end++];
					$expr = "!($is_arg % $expr_arg)";
				}
			break;
		}

		if ($negate_expr)
		{
			$expr = "!($expr)";
		}

		array_splice($tokens, 0, $expr_end, $expr);

		return $tokens;
	}

	/**
	* Generates a reference to the given variable inside the given (possibly nested)
	* block namespace. This is a string of the form:
	* ' . $this->_tpldata['parent'][$_parent_i]['$child1'][$_child1_i]['$child2'][$_child2_i]...['varname'] . '
	* It's ready to be inserted into an "echo" line in one of the templates.
	* NOTE: expects a trailing "." on the namespace.
	* @access private
	*/
	function generate_block_varref($namespace, $varname, $echo = true, $defop = false)
	{
		// Strip the trailing period.
		$namespace = substr((string) $namespace, 0, -1);

		// Get a reference to the data block for this namespace.
		$varref = $this->generate_block_data_ref($namespace, true, $defop);
		// Prepend the necessary code to stick this in an echo line.

		// Append the variable reference.
		$varref .= "['$varname']";
		$varref = ($echo) ? "<?php echo $varref; ?>" : ($varref ?? '');

		return $varref;
	}

	/**
	* Generates a reference to the array of data values for the given
	* (possibly nested) block namespace. This is a string of the form:
	* $this->_tpldata['parent'][$_parent_i]['$child1'][$_child1_i]['$child2'][$_child2_i]...['$childN']
	*
	* If $include_last_iterator is true, then [$_childN_i] will be appended to the form shown above.
	* NOTE: does not expect a trailing "." on the blockname.
	* @access private
	*/
	function generate_block_data_ref($blockname, $include_last_iterator, $defop = false)
	{
		// Get an array of the blocks involved.
		$blocks = explode('.', (string) $blockname);
		$blockcount = sizeof($blocks) - 1;

		// DEFINE is not an element of any referenced variable, we must use _tpldata to access it
		if ($defop)
		{
			$varref = '$this->_tpldata[\'DEFINE\']';
			// Build up the string with everything but the last child.
			for ($i = 0; $i < $blockcount; $i++)
			{
				$varref .= "['" . $blocks[$i] . "'][\$_" . $blocks[$i] . '_i]';
			}
			// Add the block reference for the last child.
			$varref .= "['" . $blocks[$blockcount] . "']";
			// Add the iterator for the last child if requried.
			if ($include_last_iterator)
			{
				$varref .= '[$_' . $blocks[$blockcount] . '_i]';
			}
			return $varref;
		}
		else if ($include_last_iterator)
		{
			return '$_'. $blocks[$blockcount] . '_val';
		}
		else
		{
			return '$_'. $blocks[$blockcount - 1] . '_val[\''. $blocks[$blockcount]. '\']';
		}
	}

	/**
	* Write compiled file to cache directory
	* @access private
	*/
	function compile_write($handle, $data)
	{
	//echo $handle;
	global $theme, $phpEx;
		$filename = $this->cache_dir.$theme.'_'.str_replace("admin/","admin_",(string) $handle).'.'.$phpEx;
		//die($filename);
		$data = "<?php\n if (!defined('IN_PMBT'))\n{\n include_once './../security.php';\n}\n" . ((str_starts_with((string) $data, '<?php')) ? substr((string) $data, 5) : ' ?>' . $data);
		if ($fp = @fopen($filename, 'wb'))
		{
			@flock($fp, LOCK_EX);
			@fwrite ($fp, $data);
			@flock($fp, LOCK_UN);
			@fclose($fp);

			//phpbb_chmod($filename, CHMOD_READ | CHMOD_WRITE);
		}

		return;
	}
	function _tpl_include($filename, $include = true)
	{
      $content = new Template();
      $content->_rootref = $this->_rootref;
	  $content->block_names = $this->block_else_level;
	  $content->block_else_level = $this->block_else_level;
	  $content->vars = $this->vars;
      //foreach($this->_rootref as $key => $val)
       //{
       //   $content->set($key, $val);
       //}
     // echo $content->fetch($filename);
	}
	function assign_block_vars($blockname, $vararray)
	{
		if (str_contains((string) $blockname, '.'))
		{
			// Nested block.
			$blocks = explode('.', (string) $blockname);
			$blockcount = sizeof($blocks) - 1;

			$str = &$this->_tpldata;
			for ($i = 0; $i < $blockcount; $i++)
			{
				$str = &$str[$blocks[$i]];
				$str = &$str[sizeof($str) - 1];
			}

			$s_row_count = isset($str[$blocks[$blockcount]]) ? sizeof($str[$blocks[$blockcount]]) : 0;
			$vararray['S_ROW_COUNT'] = $s_row_count;

			// Assign S_FIRST_ROW
			if (!$s_row_count)
			{
				$vararray['S_FIRST_ROW'] = true;
			}

			// Now the tricky part, we always assign S_LAST_ROW and remove the entry before
			// This is much more clever than going through the complete template data on display (phew)
			$vararray['S_LAST_ROW'] = true;
			if ($s_row_count > 0)
			{
				unset($str[$blocks[$blockcount]][($s_row_count - 1)]['S_LAST_ROW']);
			}

			// Now we add the block that we're actually assigning to.
			// We're adding a new iteration to this block with the given
			// variable assignments.
			$str[$blocks[$blockcount]][] = $vararray;
		}
		else
		{
			// Top-level block.
			$s_row_count = (isset($this->_tpldata[$blockname])) ? sizeof($this->_tpldata[$blockname]) : 0;
			$vararray['S_ROW_COUNT'] = $s_row_count;

			// Assign S_FIRST_ROW
			if (!$s_row_count)
			{
				$vararray['S_FIRST_ROW'] = true;
			}

			// We always assign S_LAST_ROW and remove the entry before
			$vararray['S_LAST_ROW'] = true;
			if ($s_row_count > 0)
			{
				unset($this->_tpldata[$blockname][($s_row_count - 1)]['S_LAST_ROW']);
			}

			// Add a new iteration to this block with the variable assignments we were given.
			$this->_tpldata[$blockname][] = $vararray;
		}

		return true;
	}
}
?>
