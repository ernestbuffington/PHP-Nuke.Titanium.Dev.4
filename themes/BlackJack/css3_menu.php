<?php

echo '<div align="center">';

echo '<nav style="text-align: center;" id="menu">';
echo '  <input type="checkbox" id="responsive-menu" onclick="updatemenu()"><label></label>';
echo '  <ul>';
//echo '    <li><a class="dropdown-arrow" href="'.HTTPS.'">Home</a>';

//echo '      <ul class="sub-menus">';
echo '        <li><a href="'.HTTPS.'">Home</a></li>';
//echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=search">Forums Search</a></li>';
//echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=search&search_id=newposts">New Posts</a></li>';
//echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=search&search_id=unanswered">Unanswered Posts</a></li>';
//echo '        <li><a href="'.HTTPS.'modules.php?name=Your_Account&redirect=search&search_id=egosearch">My Posts</a></li>';
//echo '      </ul>';

//echo '    </li>';

echo '    <li><a class="dropdown-arrow" href="'.HTTPS.'modules.php?name=Forums">Forums</a>';
echo '      <ul class="sub-menus">';

if (is_admin()){
echo '        <li><a style="color: red;" href="'.HTTPS.'modules.php?name=Forums&file=fixgroup">Fix Groups</a></li>';
echo '        <li>---------------------------------</li>';
}
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums">Forums Main</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=search">Forums Search</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=search&search_id=newposts">New Posts</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=search&search_id=unanswered">Unanswered Posts</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Your_Account&redirect=search&search_id=egosearch">My Posts</a></li>';
echo '        <li>---------------------------------</li>';
echo '        <li><a style="color: pink;" href="'.HTTPS.'modules.php?name=Forums&file=viewonline">Who is Online</a></li>';
echo '        <li><a style="color: red;" href="'.HTTPS.'modules.php?name=Forums&file=rules">Forum Rules</a></li>';
echo '        <li><a style="color: yellow;" href="'.HTTPS.'modules.php?name=Forums&file=ranks">Forum Ranks</a></li>';
echo '        <li><a style="color: green;" href="'.HTTPS.'modules.php?name=Forums&file=staff">Forum Staff</a></li>';
echo '      </ul>';
echo '    </li>';


echo '    <li><a class="dropdown-arrow" href="'.HTTPS.'modules.php?name=Blogs">Blogs</a>';
echo '      <ul class="sub-menus">';
echo '        <li><a href="'.HTTPS.'modules.php?name=Blogs">Blogs Main</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Blog_Topics">Blog Topics</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Blog_Archives">Blog Archives</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Blogs_Top">Blogs Top 10</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Blog_Submit">Submit Blog</a></li>';
echo '      </ul>';
echo '    </li>';

echo '    <li><a class="dropdown-arrow" href="'.HTTPS.'modules.php?name=File_Repository">Downloads</a>';
echo '      <ul class="sub-menus">';
echo '        <li><a href="'.HTTPS.'modules.php?name=File_Repository">Downloads Main</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=File_Repository&action=newdownloads">Downloads New</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=File_Repository&action=mostpopular">Most Popular</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=File_Repository&action=statistics">Statistics</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=File_Repository&action=search">Search</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=File_Repository&action=submitdownload">UPLOAD FILE</a></li>';
echo '      </ul>';
echo '    </li>';


echo '    <li><a class="dropdown-arrow" href="#">Arcade</a>';
echo '      <ul class="sub-menus">';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=arcade">Arcade Main</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=arcade_search&x=2">Newest Games</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=arcade_search&x=1">Not Played Yet</a></li>';
echo '      </ul>';
echo '    </li>';

echo '    <li><a class="dropdown-arrow" href="#">FAQ</a>';
echo '      <ul class="sub-menus">';
echo '        <li><a href="'.HTTPS.'/modules.php?name=FAQ">FAQ</a></li>';
echo '        <li><a href="'.HTTPS.'modules.php?name=Forums&file=faq">Forum FAQ</a></li>';
echo '      </ul>';
echo '    </li>';


echo '    <li></li>';


echo '  </ul>';
echo '</nav>';

echo '</div>';


?>