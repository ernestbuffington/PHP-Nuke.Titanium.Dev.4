/**
 * Very simple jQuery plugin to keep all important admin link in a nice floating menu.
 *
 * @package    Floating admnistration links
 * @author     Author <crazycoder@live.co.uk>
 * @copyright  2016 - 2019 by lonestar-modules.com
 * @version    2.0
 */

jQuery.noConflict(), jQuery(function($) 
{
	var admin_links = '';
	var access_level = false;
	admin_links += '<i class="fa fa-times fa-times-extend"></i>'
	admin_links += '<ul class="navigation-section">'
	$.each(JSON.parse(links_json), function(i, obj) {
		/**
		* If the navigation menu has "fontawesome" icon set, we will display the icon.
		*/
		if ( obj.fa_icon ) {
			fontawesome_icon = '<i class="fas ' + obj.fa_icon + '"></i> '
		} else {
			/**
			 * If the navigation menu does not have a "fontawesome" icon set, we will display an empty value.
			 */
			fontawesome_icon = ''
		}

		if ( obj.title && obj.access_level == true && obj.file_exists == true ) {
			admin_links += '<li class="navigation-item"><a href="' + obj.url + '">' + fontawesome_icon + obj.title + '</a></li>'
		}

		/**
		 * This is a "divider", we use this to seperate more important links from others.
		 */
		if ( obj.divider === true && obj.access_level == true ) {
			admin_links += '<li class="navigation-item-divider"></li>'
		}
	});
	admin_links += '</ul>'
	
	/**
	 * Prepend the button and menu div wrapper into the body of the website.
	 */
	$('<div class="toggle-menu opacity-one""><i class="fas fa-angle-double-left fa-menu-icon"></i></div><div class="sidebar-menu hide-menu"></div>').prependTo('body');

	/**
	 * Prepend the un-ordered list to the div prepended above
	 */
	$('.sidebar-menu').prepend(admin_links);

	/**
	 * Due to the number of themes out there, I have had to add a default color to the menu anchor links,
	 * This means they lose their default hover state, But you can not get the value of a pseudo css element via jQuery,
	 * So instead we used the color of the "Back to Top" mod for the hover color, as this will probably always match the theme color.
	 */
	$( ".navigation-section > li > a" ).hover(
  		function() {
  			/**
  			 * When the cursor is hovered over the link, it will replace the color with the value set for "Back to Top" mod, via the theme ATO.
  			 */
    		$( this ).css( "color", uitotophover );
  		}, function() {
    		/**
  			 * On "mouseout" return the anchor colors back to default. 
  			 */
    		$( this ).css("color", "#d8d8d8");
  		}
	);

	/**
	 * This is the close button you will see when the menu is open.
	 */
	$(".fa-times").click(function()
	{
	    $(".sidebar-menu").addClass("hide-menu").css({"transition": "margin-left 0.5s", "border-right": ""});
	    $(".toggle-menu").css("opacity", 1);
	});

	/**
	 * This is the button at the top left hand corner of the screen, which when clicked will display the menu.
	 */
	$(".toggle-menu").click(function()
	{
	    $(".sidebar-menu").removeClass("hide-menu").addClass("side-menu-visible").css({"transition": "margin-left 0.5s", "border-right": "2px solid " + uitotophover + ""});
	    $(this).css("opacity", 0);
	});

	/**
	 * If the user click anywhere but the navigation menu, we want to close the menu.
	 */
	$(document).mouseup(function (e) 
	{
	    if ( !$(".sidebar-menu").is(e.target) && $(".sidebar-menu").has(e.target).length === 0 && $(".sidebar-menu").hasClass('side-menu-visible') ) 
	    {
	        $(".sidebar-menu").addClass("hide-menu").css({"transition": "margin-left 0.5s", "border-right": ""});
	        $(".toggle-menu").css("opacity", 0.9);
	    }
	});

});