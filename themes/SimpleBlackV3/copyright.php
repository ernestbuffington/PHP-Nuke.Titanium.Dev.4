<?php
if(realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])): 
  exit('Access Denied');
endif;

echo PHP_EOL.'<!-- Copyright Modal START -->'.PHP_EOL;
echo '<div class="modal fade" id="myCopyRight" tabindex="-1" role="dialog" aria-labelledby="CenterTitle" aria-hidden="true">'.PHP_EOL;
echo '<div class="modal-dialog modal-dialog-centered" role="document">'.PHP_EOL;
echo '<div class="modal-content modal-popout-bg">'.PHP_EOL;
echo '<div class="modal-header">'.PHP_EOL;
echo '<h1 class="modal-title modal-text1" id="CenterTitle">'.PHP_EOL;
echo '<i class="bi bi-arrow-right-square-fill"></i> Theme Name: '.THEME.''.PHP_EOL;
echo '<br /><i class="bi bi-arrow-right-square-fill"></i> Markup Language: HTML 4.01 Transitional'.PHP_EOL;
echo '<br /><i class="bi bi-arrow-right-square-fill"></i> Copyright: <i class="far fa-copyright"></i> DarkForge Graphics'.PHP_EOL;
echo '<br /><i class="bi bi-arrow-right-square-fill"></i> Creation Date: '.THEME_DATE.''.PHP_EOL;
echo '<br /><i class="bi bi-arrow-right-square-fill"></i> Author: '.THEME_AUTHOR.''.PHP_EOL;
echo '<br /><i class="bi bi-arrow-right-square-fill"></i> License: GNU General Public License'.PHP_EOL;
echo '<br /><i class="bi bi-arrow-right-square-fill"></i> Core Support: PHP-Nuke Titanium v4.0.2 <> 4.x.x'.PHP_EOL;
echo '</h1>'.PHP_EOL;
echo '</div>'.PHP_EOL;
echo '<div class="modal-body">'.PHP_EOL;
echo '<h1 class="display-1 modal-text2"><i class="bi bi-sliders"></i> Theme Overview</h1>'.PHP_EOL;
echo '<div class="lead">'.PHP_EOL;
echo '<div class="modal-text3">'.THEME_OVERVIEW.'</div>'.PHP_EOL;
echo '</div>'.PHP_EOL;
echo '<div class="card-header modal-text1"><strong>Features</strong></div>'.PHP_EOL;
echo '<div class="card-body">'.PHP_EOL;
echo '<div class="modal-text4">'.PHP_EOL;
echo '<i class="bi bi-pen"></i> Blog Signature Mod Support'.PHP_EOL;
echo '<br /><i class="devicon-java-plain-wordmark colored"></i> Javascript'.PHP_EOL;
echo '<br /><i class="devicon-javascript-plain colored"></i> Advanced Resolution Checking'.PHP_EOL;
echo '<br /><i class="devicon-php-plain colored"></i> Fluid Resizeable Layout'.PHP_EOL;
echo '<br /><i class="devicon-html5-plain colored"></i> Video Background Support'.PHP_EOL;
echo '<br /><i class="devicon-bootstrap-plain-wordmark colored"></i> BootStrap v3.4.1 Support'.PHP_EOL;
echo '<br /><i class="devicon-devicon-plain-wordmark"></i> Devicon v2.10.1 Support'.PHP_EOL;
echo '<br /><i class="devicon-css3-plain colored"></i> 5 Available Scrolling Marquees'.PHP_EOL;
echo '<br /><i class="devicon-php-plain colored"></i> Network Advertising and Personal Advertising Support'.PHP_EOL;
echo '<br /><i class="devicon-facebook-plain colored"></i> Titanium SDK v5 (adds facebook Support)'."\n";
echo '<br /><i class="bi bi-display"></i> Current Theme Resoltiuon: '.$_COOKIE["theme_resolution"].' '.PHP_EOL;
echo '</div></div></div>'.PHP_EOL;
echo '<div class="modal-footer">'.PHP_EOL;
echo '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'.PHP_EOL;
echo '</div></div></div></div>'.PHP_EOL;
echo '<!-- Copyright Modal END -->'.PHP_EOL;

?>
