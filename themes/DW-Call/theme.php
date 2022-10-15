<?php
/**
 * @package   DW-Call
 * @author    WiCKED <https://designwicked.com>
 * @author    Lonestar <https://lonestar-modules.com> (HTML and CSS updated)
 * @version   1.0 
 * @copyright 2021 <https://designwicked.com>
 * @link      https://designwicked.com
 */

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): exit('Access Denied'); endif;

$theme_name = basename(dirname(__FILE__));

define('DW_CALL_VERSION', '1.0');

include_once(NUKE_THEMES_DIR.$theme_name.'/theme_info.php');
add_css_to_head('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap', 'file');
add_css_to_head('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap', 'file');
add_css_to_head('https://fonts.googleapis.com/css2?family=Electrolize&display=swap', 'file');
/**
 * ? I have minified the CSS file, Help with load times, However there are two stylesheets, the un-minified version is for modifications,
 * ? If you make modifications to the other stylesheet, use the following site "https://cssminifier.com" to minify the CSS again.
 * ? Be careful not to minifiy and save the development CSS file.
 * 
 * ? When updating any CSS or HTML, be sure to update the version number, So when the user uploads the changes, 
 * ? they get the latest stylesheet/HTML changes.
 */
/*add_css_to_head('themes/'.$theme_name.'/style/style.css', 'file', time());*/
add_css_to_head('themes/'.$theme_name.'/style/style.min.css', 'file', '1.0');



$add_formControl = '
<script>
jQuery.noConflict(), jQuery(function($) 
{
	$("form[name=\'post\'] textarea").addClass("form-control");
});
</script>
';

add_js_to_body($add_formControl, 'inline');

function OpenTable() { ?>

	<div class="center-blocks">
		<div class="content-pos-1">
			<div class="content-pos-1-inner"></div>
		</div>
		<div class="content-pos-2">
			<div class="content-pos-2-inner clearfix">

<?php }

function CloseTable() { ?>

			</div>
		</div>
		<div class="content-pos-3">
			<div class="content-pos-3-inner"></div>
		</div>
	</div>

<?php }

function themeheader() { global $ThemeInfo; ?>
	<body>

	<div class="header-footer-bg">
	<!------------------------------------------container starts------------------------------------------>
	<div class="container">
		<!------------------------------------------Header section starts------------------------------------------>
		<div class="hd-body">
			<div class="hd-row1">
				<div class="hd-row1-inner"></div>
		    </div>
			<div class="hd-row2">
			    <div class="hd-row2-inner-1"></div>
				<div class="hd-row2-inner-2"></div>
            </div>
			<div class="hd-row3">
			    <div class="hd-row3-buttons">
                <a class="hd-row3-buttons-link-1" href="index.php"><span></span></a>
                <a class="hd-row3-buttons-link-2" href="modules.php?name=Forums"><span></span></a>
                <a class="hd-row3-buttons-link-3" href="modules.php?name=File_Repository"><span></span></a>
                <a class="hd-row3-buttons-link-4" href="modules.php?name=Web_Links"><span></span></a>
                <a class="hd-row3-buttons-link-5" href="modules.php?name=Profile"><span></span></a>
                </div>
				<div class="hd-row3-inner-2"></div>
				<div class="hd-row3-inner-3"></div>
		    </div>
            <div class="hd-row4">
                <div class="hd-row4-inner"></div>
            </div>
	    </div>
		<!------------------------------------------Header section ends------------------------------------------>

		<!------------------------------------------content section starts------------------------------------------>
		<div class="main-body">
			<?php if( blocks_visible('left') && !defined('ADMIN_FILE') ): ?>
			<!------------------------------------------left blocks section starts------------------------------------------>
			<div class="left-blocks col-sidebar">
                <?php echo blocks('left') ?>
			</div>
			<!------------------------------------------left blocks section ends------------------------------------------>
			<?php endif; ?>

			<!------------------------------------------center blocks section starts------------------------------------------>
			<div class="center-content">

<?php }

function themefooter() { global $ThemeInfo; ?>

			</div>
			<!------------------------------------------center blocks section ends------------------------------------------>
			
			<?php if( blocks_visible('right') && !defined('ADMIN_FILE') ): ?>
			<!------------------------------------------right blocks section starts------------------------------------------>
			<div class="right-blocks col-sidebar">
				<?php echo blocks('right') ?>
			</div>
			<!------------------------------------------right blocks section ends------------------------------------------>
			<?php endif; ?>

		</div>
		<!------------------------------------------content section ends------------------------------------------>

		<!------------------------------------------footer section starts------------------------------------------>
		
		
		<div class="footer-background">
			<div class="ft-row1">
			    <div class="ft-row1-inner"></div>
			</div>
			<div class="footer-mid">
				    <div class="footer-mid-inner1">
					<div align="left" style="line-height: 20px; padding-top:3px; padding-left:15px; padding-bottom: 10px;"><span class="blk"><?php echo $ThemeInfo['fms1'] ?></p></span></div>
					<div align="left" style="line-height: 20px; padding-top:63px; padding-left:15px; padding-bottom: 10px;"><span class="blk"><?php echo $ThemeInfo['fms2'] ?></p></span></div>
					</div>
					<div class="footer-mid-inner2"></div>
					<div class="footer-mid-innerb">
					<?php if ( $ThemeInfo['banners'] == 'yes' ): ?>
					<div class="footer-mid-advert">
						<?php echo ads(2); ?>
					</div>
					<?php endif; ?>
			</div>
			<div class="ft-bot">
			    <div class="ft-bot-inner1"></div>
				<div class="ft-bot-inner2"></div>
				<a href="https://www.designwicked.com/" target="_blank"><div class="ft-bot-inner3"></div></a>
			</div>
		</div>
		<!------------------------------------------footer section ends------------------------------------------>		

	</div>
	<!------------------------------------------container ends------------------------------------------>
	</div>
	
<?php }

function themecenterbox($title, $content) { ?>

	<div class="center-content">
		<div class="content-pos-1">
			<div class="content-pos-1-inner"></div>
		</div>
		<div class="content-pos-2">
			<div class="content-pos-2-inner"><span class="boxcontent"><?php echo $content; ?></span></div>
		</div>
		<div class="content-pos-3">
			<div class="content-pos-3-inner"></div>
		</div>
	</div>

<?php }

function themesidebox($title, $content, $bid = 0) { ?> 

<div class="side-blocks">
    <div class="block-top"><span class="blk">
        <?php echo $title; ?></span>
    </div>
    <div class="block-subtop">
    </div>
    <div class="block-content">
        <div class="block-content-inner"><span class="blkcon">
            <?php echo $content; ?></span>
        </div>
    </div>

    <div class="block-pos-4"></div>

</div>

<?php }

function themeindex () {

	$args = func_get_args();
	$author 		 = $args[0];
	$informant 		 = $args[1];
	$date 			 = $args[2];
	$the_title 		 = $args[3];
	$counter 		 = $args[4];
	$blog_ID 		 = $args[5];
	$the_content 	 = $args[6];
	$the_content_len = strlen ( $the_content );
	$notes 			 = $args[7];
	$comments 		 = $args[8];
	$topicname 		 = $args[9];
	$topicimage 	 = $args[10];
	$topictext	 	 = $args[11];
	
	$posted  = _POSTEDBY.' ';
    $posted .= get_author($author);
    $posted .= ' '._ON.' '.$date;
	?>

	<div class="theme-news-index">
		<div class="theme-news-index-pos-1">
			<div class="theme-news-index-pos-1-inner">
				<span><a href="modules.php?name=News&amp;new_topic=<?php echo $blog_ID; ?>"><div class="storytitle"><?php echo $the_title; ?></div></a></span>
			</div>
		</div>
		<div class="theme-news-index-pos-5">
			<div class="theme-news-index-pos-5-inner"><span class="content"><?php echo $the_content; ?></span></div>
		</div>

		<div class="theme-news-index-pos-6">
			<div class="theme-news-index-pos-6-inner"><div class="stposted"><?php echo $posted.' '.$comments; ?></div></div>
		</div>
	</div>

<?php }

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext) {

	$args = func_get_args();
	$author 		 = $args[0];
	$informant 		 = $args[1];
	$date 			 = $args[2];
	$the_title 		 = $args[3];
	$the_content     = $args[4];
	
	$posted  = _POSTEDBY.' ';
    $posted .= get_author($author);
    $posted .= ' '._ON.' '.$date;
	?>

    <div class="theme-news-index">
		<div class="theme-news-index-pos-1">
			<div class="theme-news-index-pos-1-inner">
				<span><div class="storytitle"><?php echo $the_title; ?></div></span>
			</div>
		</div>
		<div class="theme-news-index-pos-5">
			<div class="theme-news-index-pos-5-inner"><span class="content"><?php echo $the_content; ?></span></div>
		</div>

		<div class="theme-news-index-pos-6">
			<div class="theme-news-index-pos-6-inner"><div class="stposted"><?php echo $posted.' '.$comments; ?></div></div>
		</div>
	</div>

<?php }

function themepreview($title, $hometext, $bodytext='', $notes='') 
{

}
