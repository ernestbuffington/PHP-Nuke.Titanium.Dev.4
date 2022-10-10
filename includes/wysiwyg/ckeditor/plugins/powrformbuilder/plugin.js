window.addPowrPlugin = function(editor, appslug){
  editor.focus();
  editor.fire( 'saveSnapshot' );
  if( !editor.document.$.getElementById('powr-js') ){ //If powr js hasn't been added, add to head
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.src = "https://www.powr.io/powr.js?platform=ckeditor";
    s.id = 'powr-js';
    editor.document.$.head.append(s);
  }
  var unique_label = 'xxxxxxxx_'.replace(/[x]/g, function(c) {
    var r = (Math.random() * 16) | 0,
      v = c == 'x' ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  }) + new Date().getTime();
  var html_value = '<div class="powr-'+appslug+'" id="'+unique_label+'"></div>';
  var newElement = CKEDITOR.dom.element.createFromHtml( html_value, editor.document );
  editor.insertElement( newElement );

  editor.fire( 'saveSnapshot' );
}
CKEDITOR.plugins.add( 'powrformbuilder', {
  icons: 'formbuilder',
  init: function( editor ) {
    editor.ui.addButton( 'formbuilder', {
      label: 'Insert POWr Form Builder',
      command: 'insertpowrformbuilder',
      toolbar: 'insert'
    });
    editor.addCommand("insertpowrformbuilder", { // create named command
      exec: function(editor) {
        window.addPowrPlugin(editor, 'form-builder');
      }
    });
    editor.ui.addRichCombo( 'powrdropdown', {
      label: '+ POWr',
      title: 'Insert POWr Plugin',
      toolbar: 'insert',
      panel: {
        multiSelect: false,
        attributes: { 'aria-label': 'Insert POWr Plugin' },
        css: CKEDITOR.skin.getPath( 'editor' )
      },
      init: function() {
        this.startGroup( 'Popular' ); this.add( 'form-builder', 'Form Builder' ); this.add( 'social-feed', 'Social Feed' ); this.add( 'popup', 'Popup' ); this.add( 'countdown-timer', 'Countdown Timer' ); this.add( 'media-gallery', 'Media Gallery' ); this.add( 'multi-slider', 'Multi Slider' ); this.add( 'social-media-icons', 'Social Media Icons' ); this.add( 'paypal-button', 'Paypal Button' ); this.add( 'price-table', 'Price Table' ); this.add( 'chat', 'Chat' ); this.add( 'comments', 'Comments' ); this.startGroup( 'Forms and Surveys' ); this.add( 'contact-form', 'Contact Form' ); this.add( 'form-builder', 'Form Builder' ); this.add( 'mailing-list', 'Mailing List' ); this.add( 'order-form', 'Order Form' ); this.add( 'poll', 'Poll' ); this.add( 'survey', 'Survey' ); this.startGroup( 'Galleries and Sliders' ); this.add( 'banner-slider', 'Banner Slider' ); this.add( 'event-gallery', 'Event Gallery' ); this.add( 'event-slider', 'Event Slider' ); this.add( 'flickr-gallery', 'Flickr Gallery' ); this.add( 'image-slider', 'Image Slider' ); this.add( 'media-gallery', 'Media Gallery' ); this.add( 'microblog', 'Microblog' ); this.add( 'multi-slider', 'Multi Slider' ); this.add( 'photo-gallery', 'Photo Gallery' ); this.add( 'video-gallery', 'Video Gallery' ); this.add( 'video-slider', 'Video Slider' ); this.add( 'vimeo-gallery', 'Vimeo Gallery' ); this.add( 'youtube-gallery', 'Youtube Gallery' ); this.startGroup( 'Social' ); this.add( 'chat', 'Chat' ); this.add( 'comments', 'Comments' ); this.add( 'facebook-feed', 'Facebook Feed' ); this.add( 'instagram-feed', 'Instagram Feed' ); this.add( 'pinterest-feed', 'Pinterest Feed' ); this.add( 'reviews', 'Reviews' ); this.add( 'rss-feed', 'RSS Feed' ); this.add( 'social-feed', 'Social Feed' ); this.add( 'social-media-icons', 'Social Media Icons' ); this.add( 'tumblr-feed', 'Tumblr Feed' ); this.add( 'twitter-feed', 'Twitter Feed' ); this.startGroup( 'eCommerce' ); this.add( 'ecommerce', 'Ecommerce' ); this.add( 'digital-download', 'Digital Download' ); this.add( 'paypal-button', 'Paypal Button' ); this.add( 'plan-comparison', 'Plan Comparison' ); this.add( 'price-table', 'Price Table' ); this.startGroup( 'Miscellaneous' ); this.add( 'about-us', 'About Us' ); this.add( 'button', 'Button' ); this.add( 'booking', 'Booking' ); this.add( 'countdown-timer', 'Countdown Timer' ); this.add( 'count-up-timer', 'Count Up Timer' ); this.add( 'faq', 'FAQ' ); this.add( 'graph', 'Graph' ); this.add( 'hit-counter', 'Hit Counter' ); this.add( 'holiday-countdown', 'Holiday Countdown' ); this.add( 'job-board', 'Job Board' ); this.add( 'map', 'Map' ); this.add( 'menu', 'Menu' ); this.add( 'music-player', 'Music Player' ); this.add( 'notification-bar', 'Notification Bar' ); this.add( 'popup', 'Popup' ); this.add( 'resume', 'Resume' ); this.add( 'scroll-to-top', 'Scroll To Top' ); this.add( 'tabs', 'Tabs' ); this.add( 'weather', 'Weather' );
      },
      onClick: function( value ) {
        window.addPowrPlugin(editor, value);
      }
    });
  }
});
