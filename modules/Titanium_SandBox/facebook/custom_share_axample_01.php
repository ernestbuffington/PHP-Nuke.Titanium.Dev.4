<?php
if (!defined('MODULE_FILE')) { die('You can\'t access this file directly...'); } //you must have this line at the top of every module file you make!

global $facebook_plugin_width, $facebookappid, $feedicon, $name, $domain;

$feedicon = img('Titanium_SandBox.png', 'Titanium_SandBox');

?>
    <p><a class='clickable' onclick='postToFeed(); return false;'><img src="http://<?=$domain?>/modules/Titanium_SandBox/images/FBshare.png"></a></p>
    <p id='msg'></p>

    <script> 
      FB.init({appId: '<?=$facebookappid?>', status: true, cookie: true});

      function postToFeed() {

        // calling the API ...
        var obj = {
          method: 'feed',
          link: 'http://<?=$domain?>/modules.php?name=Titanium_SandBox',
          picture: '<?=$feedicon?>',
          name: 'The facebook SandBox Module - Coded for PHP-Nuke Titanium',
          caption: 'A place to practice with facebook\'s many Social Plugins',
          description: 'A Programming module written by: Ernest Buffington. This module only works with PHP-Nuke Titanium - If you would like to have a Blog portal that interacts with facebook and Google goto http://cvs.86it.us and create a user account using your first and last name. When you are done send a private message to Ernest Buffington. The Blog portals are free and come with a full blown commercial website running PHP-Nuke Titanium v1.0.1z'
        };

        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
      }
    
    </script>
<?
?>