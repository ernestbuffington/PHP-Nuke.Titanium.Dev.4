<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/*********************************************
  CPG Dragonfly™ CMS
  ********************************************
  Copyright (c) 2004 - 2006 by CPG-Nuke Dev Team
  http://dragonflycms.org

  Dragonfly is released under the terms and conditions
  of the GNU GPL version 2 or any later version

  $Revision: 9.25 $
  $Author: djmaze $
**********************************************/

/*
	This was orginally derived from DragonFly CMS/CPG Nuke
	but was modified to work with nuke by other coders that
	removed the copyright information and distributed it
	on other sites.
*/

class BBCode 
{
	public static function encode_html($text) 
	{
		return (preg_match('/</', $text)) ? stripslashes(check_html($text, '')) : $text;
	}

	public static function encode($text)
	{
		# Split all bbcodes.
		$text_parts = BBCode::split_bbcodes($text);
		# Merge all bbcodes and do special actions depending on the type of code.
		$text = '';
		while ($part = array_shift($text_parts)) {
			if (isset($part['code'])) {
				if ($part['code'] == 'list' && $part['text'][5] == '=' && substr($part['text'], -3) != ':o]') {
					# [list=x] for ordered lists.
					$part['text'] = substr($part['text'], 0, -1).':o]';
				}
				if ($part['code'] != 'code' && $part['code'] != 'php' && $part['subc']) {
					$part['text'] = '['.encode_bbcode(substr($part['text'], 1, -1)).']';
				}
			}
			$text .= $part['text'];
		}
		return trim($text);
	}

	public static function decode($text, $allowed=0, $allow_html=false)
	{
		global $bb_codes;
		# First: If there isn't a "[" and a "]" in the message, don't bother.
		if (!(strpos($text, '[') !== false && strpos($text, ']'))) {
			return ($allow_html ? (preg_match('/</', $text) ? $text : nl2br($text)) : nl2br(strip_tags($text)));
		}

		$bb_codes['code_start'] 	= '<div class="codebox"><p>Code: [ <a href="#" class="code_selection">Select all</a> ]</p><pre style="white-space: pre-wrap"><code>';
		$bb_codes['code_end']   	= '</code></pre></div>';

		$bb_codes['php_start'] 		= '<div class="codebox phpcodebox"><p>PHP:&nbsp;&nbsp;[ <a href="#" class="code_selection code_select">Select all</a> ]</p><pre style="white-space: normal">';
		$bb_codes['php_end']   		= '</pre></div>';

		$bb_codes['quote'] 			= '<div class="notepaper"><figure class="quote"><blockquote class="curly-quotes"><figcaption class="quote-by">&mdash; Quote</figcaption>';
		$bb_codes['quote_close']	= '</blockquote></figure></div>';

		# pad it with a space so we can distinguish between FALSE and matching the 1st char (index 0).
		$text = BBCode::split_on_bbcodes($text, $allowed, $allow_html);

		# Patterns and replacements for URL, email tags etc.
		$patterns = $replacements = array();

		# [b] and [/b] for bolding text.
		$text = preg_replace_callback("(\[b\](.*?)\[/b\])is", function($m) { return '<span style="font-weight: bold">'.$m[1].'</span>'; }, $text);

		# [i] and [/i] for italicizing text.
		$text = preg_replace_callback("(\[i\](.*?)\[/i\])is", function($m) { return '<span style="font-style: italic;">'.$m[1].'</span>'; }, $text);

		# [u] and [/u] for underlining text.
		$text = preg_replace_callback("(\[u\](.*?)\[/u\])is", function($m) { return '<span style="text-decoration: underline">'.$m[1].'</span>'; }, $text);

		# [s] and [/s] for striking through text.
		$text = preg_replace_callback("(\[s\](.*?)\[/s\])is", function($m) { return '<span style="text-decoration: line-through;">'.$m[1].'</span>'; }, $text);

		# colors
		$text = preg_replace_callback("(\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\])is", function($m) { return '<span style="color:'.$m[1].'">'.$m[2].'</span>'; }, $text); 

		# align
		$text = preg_replace_callback("(\[align=(left|right|center|justify)\](.*?)\[/align\])is", function($m) { return '<div style="text-align:'.$m[1].';">'.$m[2].'</div>'; }, $text);

		# fonts
		$text = preg_replace_callback("(\[font=(.*?)\](.*?)\[/font\])is", function($m) { return '<span style="font-family: '.$m[1].'">'.$m[2].'</span>'; }, $text);

		# highlight
		$text = preg_replace_callback("(\[highlight=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/highlight\])is", function($m) { return '<span style="background-color: '.$m[1].'">'.$m[2].'</span>'; }, $text);

		# Horizontal Rule
		$text = preg_replace_callback("(\[hr\])is", function($m) { return '<hr />'; }, $text);

		# [url] local
		$text = preg_replace_callback("(\[url\]([\w]+(\.html|\.php|/)[^ \[\"\n\r\t<]*?)\[/url\])is", function($m) { return '<a href="'.$m[1].'" title="'.$m[1].'">'.shrink_url($m[1]).'</a>'; }, $text);
		$text = preg_replace_callback("(\[url=([\w]+(\.html|\.php|/)[^ \[\"\n\r\t<]*?)\](.*?)\[/url\])is", function($m) { return '<a href="'.$m[1].'" title="'.$m[1].'">'.$m[3].'</a>'; }, $text);

        # [url]xxxx://www.cpgnuke.com[/url]
		// $text = preg_replace_callback("(\[url\]([\w]+?://[^ \[\"\n\r\t<]*?)\[/url\])is", function($m) { return '<a href="'.$m[1].'" target="_blank" title="'.$m[1].'">'.shrink_url($m[1]).'</a>'; }, $text);
		$text = preg_replace_callback("#\[url\]((?!javascript)[a-z]+?://)([^\r\n\"<]+?)\[/url\]#si", function($m) { return '<a href="'. $m[1] . $m[2] .'" target="_blank" title="'.$m[1] . $m[2].'">'.$m[1] . $m[2].'</a>'; }, $text);
		
        # [url]www.cpgnuke.com[/url] (no xxxx:// prefix).
		$text = preg_replace_callback("(\[url\]((www|ftp)\.[^ \[\"\n\r\t<]*?)\[/url\])is", function($m) { return '<a href="http://'.$m[1].'" target="_blank" title="'.$m[1].'">'.$m[1].'</a>'; }, $text);
		
        # [url=www.cpgnuke.com]cpgnuke[/url] (no xxxx:// prefix).
		$text = preg_replace_callback("(\[url=((www|ftp)\.[^ \"\n\r\t<]*?)\](.*?)\[/url\])is", function($m) { return '<a href="http://'.$m[1].'" target="_blank" title="'.$m[1].'">'.$m[3].'</a>'; }, $text);
	
        # [url=xxxx://www.cpgnuke.com]cpgnuke[/url]	
		$text = preg_replace_callback("(\[url=(.*?)\](.*?)\[/url\])is", function($m) { return '<a href="'.$m[1].'" target="_blank" title="'.$m[1].'">'.$m[2].'</a>'; }, $text);

		# [spoil]Spoiler[/spoil] code..
    	// $text = preg_replace_callback("(\[spoil\](.*?)\[/spoil\])is", function($m) { return '[spoil:'._BBCODE_UNIQUE_ID.']'.$m[1].'[/spoil:'._BBCODE_UNIQUE_ID.']'; }, $text);

		# Images
		$text = preg_replace_callback("(\[img\](.*?)\[/img\])is", function($m) { return '<img class="reimg" onload="reimg(this);" onerror="reimg(this);" src="'.$m[1].'" border="0" alt="" />'; }, $text);

		# Parse YouTube videos
		$text = preg_replace_callback("#\[video=(.*?)\](.*?)\[/video\]#is", 'BBCode::evo_parse_video_callback', $text);

		# tag/mention a member
    	$text = preg_replace_callback("(\[tag\](.*?)\[/tag\])is", 'BBCode::evo_mention_callback', $text);

    	# Spoiler tag
    	$text = preg_replace_callback("(\[spoil\](.*?)\[/spoil\])is", 'BBCode::evo_spoil_callback', $text);

		/**
		 *  The BBCODES below are for SCEditor support
		 */
		# SCeditor Center Alignment
		$text = preg_replace_callback("(\[center\](.*?)\[/center\])is", function($m) { return '<div style="text-align:center;">'.$m[1].'</div>'; }, $text);
		
		# SCeditor Left Alignment
		$text = preg_replace_callback("(\[left\](.*?)\[/left\])is", function($m) { return '<div style="text-align:left;">'.$m[1].'</div>'; }, $text);
		
		# SCeditor Right Alignment
		$text = preg_replace_callback("(\[right\](.*?)\[/right\])is", function($m) { return '<div style="text-align:right;">'.$m[1].'</div>'; }, $text);
		
		# SCeditor Justify Alignment
		$text = preg_replace_callback("(\[justify\](.*?)\[/justify\])is", function($m) { return '<div style="text-align:justify;">'.$m[1].'</div>'; }, $text);


		# Fix linebreaks on important items
		$text = preg_replace("/<br>/si", "<br \/>", $text);
		$text = preg_replace("/<ul><br \/>/si", "<ul>", $text);
		$text = preg_replace("/<\/ul><br \/>/si", "</ul>", $text);
		$text = preg_replace("/<\/ol><br \/>/si", "</ol>", $text);
		$text = preg_replace("/<\/table><br \/>/si", "</table>", $text);
		$text = preg_replace("/<\/div><br \/>/si", "</div>", $text);
		$text = preg_replace("/<br \/><table/si", "<table", $text);

		# Remove our padding from the string..
		return trim($text);
	}

	public static function evo_spoil_callback( $matches )
	{
		return BBCode::evo_spoil( $matches[1] );
	}

	public static function evo_spoil( $hidden_content )
	{
		$template  = '
		<style>
		.spoiler-container {
			display: block;
		}

		.btn {
		    display: inline-block;
		    font-weight: 400;
		    color: #212529;
		    text-align: center;
		    vertical-align: middle;
		    user-select: none;
		    background-color: transparent;
		    border: 1px solid transparent;
		    padding: .375rem .75rem;
		    font-size: 1rem;
		    line-height: 1.5;
		    border-radius: .25rem;
		    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		    cursor: pointer;
		    outline: none;
		    margin-bottom: 10px;
		}

		.btn:focus {
			outline: none !important;
		}

		.btn-mod.btn-border {
		    color: #ccc;
		    border: 1px solid #414141;
		    background: #181818;
		}

		.btn-mod.btn-border:hover, .btn-mod.btn-border:focus {
		    color: #fff;
		    border-color: #ccc;
		    background: #313131;
		}

		#spoiler-contents {
			display: none;
			margin: 0 20px 10px 20px;
		}
		</style>
		';

		// $template  = addCSStoHead( 'includes/css/bbcode.css' );
		$template .= '<div class="spoiler-container">';
		$template .= '	Spoiler: <button class="btn btn-mod btn-border" type="button" id="reveal-spoiler" name="spoiler">Show</button>';
		$template .= '	<div id="spoiler-contents">Phones Broken</div>';
		$template .= '</div>';
		$template .= '<script>
			var hidden_content = document.getElementById("spoiler-contents");
			document.getElementById("reveal-spoiler").addEventListener("click", function (event) 
			{
				if (window.getComputedStyle(hidden_content).display === "none") 
				{
					hidden_content.style.display = "block";
				}
				else
				{
					hidden_content.style.display = "none";
				}
			});
		</script>';
		return $template;
	}


	
	# Parse the YouTube video
	public static function evo_parse_video_callback( $matches ) 
	{
		return BBCode::evo_parse_video( $matches[1], $matches[2] );
	}

	public static function evo_parse_video( $video, $url )
	{
		global $bbcode_tpl, $board_config, $nukeurl;

		$stripped_url = preg_replace("(^https?://)", "", $nukeurl );

		if(empty($video) || empty($url))
		{
			 return "[video={$video}]{$url}[/video]";
		}

		$parsed_url = parse_url(urldecode($url));

		$winchester = '';
		if($parsed_url == false)
		{
			return "[video={$video}]{$url}[/video]";
		}

		$fragments = array();
		if($parsed_url['fragment'])
		{
			$fragments = explode("&", $parsed_url['fragment']);
		}

		$queries = explode("&", $parsed_url['query']);

		$input = array();
		foreach($queries as $query)
		{
			list($key, $value) = explode("=", $query);
			$key = str_replace("amp;", "", $key);
			$input[$key] = $value;
		}

		$path = explode('/', $parsed_url['path']);
		switch($video):

			/* ----- youtube video embed ----- */
			case "youtube":
				if($fragments[0])
					# http://www.youtube.com/watch#!v=fds123
					$id = str_replace('!v=', '', $fragments[0]); 
				elseif($input['v'])
					# http://www.youtube.com/watch?v=fds123
					$id = $input['v']; 
				else
					# http://www.youtu.be/fds123
					$id = $path[1];

				$video_replace = '<iframe style="max-width: 100%" id="ytplayer-'.$id.'" width="'.$board_config['youtube_width'].'" height="'.$board_config['youtube_height'].'" src="//www.youtube.com/embed/'.$id.'?rel=0&amp;vq=hd1080" frameborder="0" allowfullscreen=""></iframe><br />[<a href="https://www.youtube.com/watch?v='.$id.'" target="_blank">'._WATCH_YOUTUBE.'</a>]';
				break;

			/* ----- twitch video embed ----- */
			case "twitch":

				// if(preg_match("/clip/", $url, $matches)):
				if ( preg_match('/(clips?|clip)/', $url, $matches) ):

					$clips = explode('/', $url);
					// $id = 'embed?clip='.$clips[5].'';
					if ( $matches[1] == 'clip' ):
						$id = 'embed?clip='.$clips[5].'&parent='.$stripped_url.'&autoplay=false&tt_medium=clips_embed';
					else:
						$id = 'embed?clip='.$clips[3].'&parent='.$stripped_url.'&autoplay=false&tt_medium=clips_embed';
					endif;
					$player = 'clips';
				
				else:
				
					if(count($path) >= 3 && $path[1] == 'videos')
					{
						// Direct video embed with URL like: https://www.twitch.tv/videos/179723472
						$id = '?video=v'.$path[2].'&parent='.$stripped_url;
					}
					elseif(count($path) >= 4 && $path[2] == 'v')
					{
						// Direct video embed with URL like: https://www.twitch.tv/waypoint/v/179723472
						$id = '?video=v'.$path[3].'&parent='.$stripped_url;
					}
					elseif(count($path) >= 2)
					{
						// Channel (livestream) embed with URL like: https://twitch.tv/waypoint
						$id = '?channel='.$path[1].'&parent='.$stripped_url;
					}

					$time = explode("?", $url);

					$player = 'player';
				
				endif;
				$video_replace = '<iframe style="max-width: 100%" src="https://'.$player.'.twitch.tv/'.$id.'&amp;autoplay=false" frameborder="0" scrolling="no" height="'.$board_config['twitch_height'].'" width="'.$board_config['twitch_width'].'" allowfullscreen=""></iframe>';                
				// $video_replace = '<pre>'.var_export( $clips, true ).'</pre>'; 
				break;

			default:
				return "[video={$video}]{$url}[/video]";
		
		endswitch;

		if(empty($id))
		{
			return "[video={$video}]{$url}[/video]1";
		}
		return $video_replace;
	}

	public static function evo_mention_callback( $matches )
	{
		return BBCode::evo_mention( $matches[1] );
	}

	public static function evo_mention( $user )
	{
		global $db, $customlang;
		
		// modules.php?name=Private_Messages&mode=post&pm_uname=Lonestar
		// $row = $db->sql_ufetchrow("SELECT `user_id`, `username` FROM `".USERS_TABLE."` WHERE `username` = '".$user."'");
		return '<a href="modules.php?name=Private_Messages&mode=post&pm_uname='.$user.'" target="_blank" alt="'.$customlang['global']['send_pm'].'" title="'.$customlang['global']['send_pm'].'">'.$user.'</a>';
	}

	public static function split_bbcodes($text)
	{
		$curr_pos = 0;
		$str_len = strlen($text);
		$text_parts = array();
		while ($curr_pos < $str_len) {
			# Find bbcode start tag, if not found end the loop.
			$curr_pos = strpos($text, '[', $curr_pos);
			if ($curr_pos === false) { break; }
			$end = strpos($text, ']', $curr_pos);
			if ($end === false) { break; }

			$code_start = substr($text, $curr_pos, $end-$curr_pos+1);
			$code = strtolower(preg_replace('/\[([a-z]+).*]/i', '\\1', $code_start));
			$code_len = strlen($code);

			$end_pos = empty($code) ? false : $end;
			$depth = 0;
			$sub = false;
			while ($end_pos) {
				# Find bbcode end tag, if not found end the loop.
				$end_pos = strpos($text, '[', $end_pos);
				if ($end_pos === false) { break; }
				$end = strpos($text, ']', $end_pos);
				if ($end === false) { break; }
				$code_end = strtolower(substr($text, $end_pos, $code_len+2));
				if ($code_end == "[/$code") {
					if ($depth > 0) {
						$depth--;
						$end_pos++;
						$sub = true;
					} else {
						if ($curr_pos > 0) {
							$text_parts[] = array('text' => substr($text, 0, $curr_pos), 'code' => false, 'subc' => false);
						}
						$text_parts[] = array(
							'text' => substr($text, $curr_pos, $end-$curr_pos+1),
							'code' => $code,
							'subc' => $sub);
						$text = substr($text, $end+1);
						$str_len = strlen($text);
						$curr_pos = 0;
						break;
					}
				} else {
					if (substr($code_end, 0, -1) == "[$code") { $depth++; }
					$end_pos++;
				}
			}
			$curr_pos++;
		}
		if ($str_len > 0) { $text_parts[] = array('text' => $text, 'code' => false, 'subc' => false); }
		return $text_parts;
	}

	# split the bbcodes and use nl2br on everything except [php]
	public static function split_on_bbcodes($text, $allowed=0, $allow_html=false)
	{
		global $bb_codes;
		# Split all bbcodes.
		$text_parts = BBCode::split_bbcodes($text);
		# Merge all bbcodes and do special actions depending on the type of code.
		$text = '';
		while ($part = array_shift($text_parts)) {
			if ($part['code'] == 'php') {
				# [PHP]
				$text .= ($allowed) ? BBCode::decode_php($part['text']) : nl2br(htmlspecialchars($part['text']));
			} elseif ($part['code'] == 'code') {
				# [CODE]
				if (!$allowed && preg_match('/</', $part['text'])) {
					$part['text'] = nl2br(htmlspecialchars($part['text']));
				}
				$text .= $allowed ? BBCode::decode_code($part['text']) : $part['text'];
			} elseif ($part['code'] == 'quote') {
				# [QUOTE] and [QUOTE=""]
				if ($part['text'][6] == ']') {
					$text .= $bb_codes['quote'].BBCode::split_on_bbcodes(substr($part['text'], 7, -8), $allowed, $allow_html).$bb_codes['quote_close'];
				} else {
					$part['text'] = preg_replace('/\[quote="(.*?)"\]/si', $bb_codes['quote_name'], BBCode::split_on_bbcodes(substr($part['text'], 0, -8), $allowed, $allow_html), 1);
					$text .= $part['text'].$bb_codes['quote_close'];
				}
			} elseif ($part['subc']) {
				$tmptext = '['.BBCode::split_on_bbcodes(substr($part['text'], 1, -1)).']';
				$text .= ($part['code'] == 'list') ? BBCode::decode_list($tmptext) : $tmptext;
				unset($tmptext);
			} else {
				if ($allow_html) {
					$tmptext = (!preg_match('/</', $part['text']) ? nl2br($part['text']) : $part['text']);
				} else {
					$tmptext = nl2br(BBCode::encode_html($part['text']));
				}
				$text .= ($part['code'] == 'list') ? BBCode::decode_list($tmptext) : $tmptext;
				unset($tmptext);
			}
		}
		return $text;
	}

	public static function decode_code($text)
	{
		global $bb_codes;
		$text = substr($text, 6, -7);
		$code_entities_match   = array('#<#',  '#>#',  '#"#',    '#:#',   '#\[#',  '#\]#',  '#\(#',  '#\)#',  '#\{#',   '#\}#');
		$code_entities_replace = array('&lt;', '&gt;', '&quot;', '&#58;', '&#91;', '&#93;', '&#40;', '&#41;', '&#123;', '&#125;');
		$text = preg_replace($code_entities_match, $code_entities_replace, $text);
		# Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
		$text = str_replace('  ', '&nbsp; ', $text);
		# now Replace 2 spaces with ' &nbsp;' to catch odd #s of spaces.
		$text = str_replace('  ', ' &nbsp;', $text);
		# Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
		$text = str_replace("\t", '&nbsp; &nbsp;', $text);
		# now Replace space occurring at the beginning of a line
		$text = preg_replace('/^ {1}/m', '&nbsp;', $text);
		// return $bb_codes['code_start'].nl2br($text).$bb_codes['code_end'];
		return $bb_codes['code_start'].$text.$bb_codes['code_end'];
	}

	public static function decode_php($text)
	{
		global $bb_codes;
		$text = substr($text, 5, -6);
		$text = str_replace("\r\n", "\n", $text);
		$text = htmlunprepare($text, true);
		$added = FALSE;
		if (preg_match('/^<\?.*/', $text) <= 0) {
			$text = "<?php\n$text\n";
			$added = TRUE;
		}

		// if (PHPVERS < '4.2') {
		// 	ob_start();
		// 	highlight_string($text);
		// 	$text = ob_get_contents();
		// 	ob_end_clean();
		// } else {
		// 	$text = highlight_string($text, TRUE);
		// }

		$text = highlight_string($text, TRUE);

		if (PHPVERS < '5.0') {
			$text = preg_replace('/<font color="(.*?)">/si', '<span style="color: \\1;">', $text);
			$text = str_replace('</font>', '</span>', $text);
		}
		if ($added == TRUE) {
			if (PHPVERS < '5.0') {
				$text = preg_replace('/^(.*)\n.*?<\/span>(.*)php<br \/>/i', "\\1\n\\2?php<br />", $text, 1);
			}
			$text = preg_replace('/^(.*)\n.*php<br \/><\/span>/i', "\\1\n", $text, 1);
			$text = preg_replace('/^(.*)\n(.*)>.*php<br \/>/i', "\\1\n\\2>", $text, 1);
		}
		$text = str_replace('[', '&#91;', $text);
		return $bb_codes['php_start'].trim($text).$bb_codes['php_end'];
	}

	public static function decode_list($text)
	{
		// &(?![a-z]{2,6};|#[0-9]{1,4};)
		$items = explode('[*]', $text);
		$text = array_shift($items).'<li>';
		$text .= implode('</li><li>', $items);
		if (count($items) > 1) $text = str_replace('[/list', '</li>[/list', $text);
		$text = preg_replace("#<br />[\r\n]+</li>#", "</li>\n", $text);
		unset($items);
		# [list] and [list=x] for (un)ordered lists.
		# unordered lists
		$text = preg_replace('#\[list\]#i', '<ul class="mycode_list">', $text);
		$text = preg_replace('#\[/list:u\]#i', '</ul>', $text);
		$text = preg_replace('#\[/list\]#i', '</ul>', $text);
		# Ordered lists
		$text = preg_replace('#\[list=([ai1])\]#i', '<ol class="mycode_list" type="\\1">', $text);
		$text = preg_replace('#\[/list:o\]#i', '</ol>', $text);

		$text = preg_replace('#(<[ou]l.*?>)<br />#s', '\\1', $text);
		return $text;
	}
}