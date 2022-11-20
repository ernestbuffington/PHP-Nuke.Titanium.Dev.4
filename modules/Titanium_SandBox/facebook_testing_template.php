<?php 
if (!defined('MODULE_FILE')) {  
   die('You can\'t access this file directly...');
}
############################################################################################################################################################################			
# TEST CODE GOES HERE - START
############################################################################################################################################################################
	OpenTable();
	global $board_config, $domain,$pnt_db, $pnt_db2, $userdata, $userinfo; 
	$user_avatar = 'seb.png';
	$avatar_img = ($board_config['allow_avatar_upload']) ? '<img class="rounded-corners-profile" src="'.$board_config['avatar_path'].'/'.$user_avatar.'" alt="https://'.$domain.'/modules/Forums/images/avatars/'.$user_avatar.'" />' : '';
    echo $avatar_img;
	echo '<br>';
    echo "allow_avatar_upload=".$board_config['allow_avatar_upload']; // allow_avatar_upload = 1
	echo '<br>';
	echo "avatar path=",$board_config['avatar_path']; // modules/Forums/images/avatars
	echo '<br>';
	echo $user_avatar; // name of file in the database field
	echo '<br>';
	echo "->".$userdata['user_avatar_type']."<- User Avatar Type"; 
	echo '<br>';
	echo $profiledata['user_avatar'];
	echo $board_config['default_avatar_set']."<- default_avatar_set";
	echo '<br>';
	echo $board_config['default_avatar_users_url']."<- default_avatar_users_url";
	
	CloseTable();
    global $facebook_plugin_width, $facebookappid, $facebookappsecret; //used to set the deafult width of iframes and tables
	OpenTable();
	echo "<center>\n";
	echo"<div id=\"fb-root\"></div>\n";
    echo "<script>\n";
    echo "<!--\n";
	
	echo"window.fbAsyncInit = function() {\n";
    echo"FB.init({\n";
    echo"appId      : '321826067848805',\n";
    echo"channelUrl : '//cvs.86it.us/channel.html',\n";
    echo"status     : true, \n";
    echo"cookie     : true, \n";
    echo"xfbml      : true  \n";
    echo"});\n";
    
	// Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
    // for any authentication related change, such as login, logout or session refresh. This means that
    // whenever someone who was previously logged out tries to log in again, the correct case below
    // will be handled.
	echo "FB.Event.subscribe('auth.authResponseChange', function(response) {\n";
    
	// Here we specify what we do with the response anytime this event occurs.
    echo "if (response.status === 'connected') {\n";
    
	// The response object is returned with a status field that lets the app know the current
    // login status of the person. In this case, we're handling the situation where they
    echo "// have logged in to the app.\n";
    echo "testAPI();\n";
    echo "} else if (response.status === 'not_authorized') {\n";
    
	// In this case, the person is logged into Facebook, but not into the app, so we call
    // FB.login() to prompt them to do so.
    // In real-life usage, you wouldn't want to immediately prompt someone to login
    // like this, for two reasons:
    // (1) JavaScript created popup windows are blocked by most browsers unless they
    // result from direct interaction from people using the app (such as a mouse click)
    // (2) it is a bad experience to be continually prompted to login upon page load.
	echo"FB.login();\n";
    echo"} else {\n";
    
	// In this case, the person is not logged into Facebook, so we call the login() 
    // function to prompt them to do so. Note that at this stage there is no indication
    // of whether they are logged into the app. If they aren't then they'll see the Login
    // dialog right after they log in to Facebook. 
    // The same caveats as above apply to the FB.login() call here.
	echo"FB.login();\n";
    echo"}\n";
    echo"});\n";
    echo"};\n";
   
   // Load the SDK asynchronously
   echo"(function(d){\n";
   echo"var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];\n";
   echo"if (d.getElementById(id)) {return;}\n";
   echo"js = d.createElement('script'); js.id = id; js.async = true;\n";
   echo"js.src = \"//connect.facebook.net/en_US/all.js\";\n";
   echo"ref.parentNode.insertBefore(js, ref);\n";
   echo"}(document));\n";
   
   // Here we run a very simple test of the Graph API after login is successful. 
   // This testAPI() function is only called in those cases. 
   echo"function testAPI() {\n";
   echo"console.log('Welcome!  Fetching your information.... ');\n";
   echo"FB.api('/me', function(response) {\n";
   echo"console.log('Good to see you, ' + response.name + '.');\n";
   echo"});\n";
   echo"}\n";

   echo "//-->\n";
   echo "</script>\n\n";
   
   //Below we include the Login Button social plugin. This button uses the JavaScript SDK to"
   //present a graphical Login button that triggers the FB.login() function when clicked."
   //Learn more about options for the login button plugin:"
   //docs/reference/plugins/login/ 
   echo"<fb:login-button show-faces=\"true\" width=\"200\" max-rows=\"1\"></fb:login-button>";
 
   echo "</center>";
   echo "<br><br>";
	
	CloseTable3();
############################################################################################################################################################################			
# TEST CODE GOES HERE - END
############################################################################################################################################################################
?> 
