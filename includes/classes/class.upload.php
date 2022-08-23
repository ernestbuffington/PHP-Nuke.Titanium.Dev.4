<?php 
###################### GnaUnited.com Presents  #####################
#  Project: My Uploads                                             #
#  Public Version: 4.4 Unregistered                                #
#  Technical Version: 4.4.0                                        #
#  License: Commercial                                             #
####################################################################

class myubrowse 
{
        ################################################################################################################	
        # Uploads Dir Size
		################################################################################################################
		function uploads_dirsize_wu($folder) 
		{
           if(!eregi("/$", $this->direct) && !eregi("\\\\$", $this->direct)) $this->direct = $this->direct."/";
           $this->direct = $this->direct.$folder."/";
           $open = opendir($this->direct);
           $tsize = 0;
           
		   while($files = readdir($open)) 
		   {
                $filename = $this->direct.$files;
                if(is_file($filename)) $tsize += filesize($this->direct.$files);
            }
        
		 return $tsize;
        
		}
        ################################################################################################################	
        # Uploads Dir Size
		################################################################################################################


        
		function uploads_getbettersize($number) 
		{
            if(($number >= 1024 && $number <= 1048575) 
			|| ($number <= -1024 && $number > -1048575)) 
			{
               $number = $number / 1024;
               $number = round($number, 1);
               $number = $number." ".MYU_KB;
            } 
			else
			if($number >= 1048576 || $number <= -1048576) 
			{
               $number = ($number / 1024) / 1024;
               $number = round($number, 2);
               $number = $number." ".MYU_MB;
            } 
			else 
			$number = $number." ".MYU_BYTES;
            
			return $number;
        }

        
		function myubrowse($admin, $network_prefix, $db2, $module_name, $user_prefix) 
		{
                global $admin_file;
                
				$this->admin = $admin;
                $this->prefix = $network_prefix;
                $this->user_prefix = $network_prefix;
                $this->db = $db2;
                $this->module_name = $module_name;
                $this->pagetitle = " - ".MYU_MYUPLOADS;
                
				$sql = "SELECT * FROM ".$this->prefix."_uploads";
                
				if(!$this->db->sql_query($sql, FALSE)) 
				{
                        header("location: " . $admin_file . ".php?op=uploads_install");
                        exit;
                }
                
				$res = $this->db->sql_query($sql, FALSE);
                
				if($this->db->sql_numrows($res) == 0) 
				{
                        header("location: " . $admin_file . ".php?op=uploads_install");
                        exit;
                }
                
				while($row = $this->db->sql_fetchrow($res)) 
				{
                  if($row['type'] == "limit") $this->maxlimit = $row['info'];
                  if($row['type'] == "directory") $this->direct = $row['info'];
                  if($row['type'] == "howtoban") $this->howtoban = $row['info'];
                  if($row['type'] == "url") $this->url = $row['info'];
                  if($row['type'] == "version") $this->version = $row['info'];
                  if($row['type'] == "user_type") $this->allow_all = $row['info'];
                }
        }
        
        function uploads_getusrinfo_by_id($user_id) 
		{
            $sql = "SELECT * FROM ".$this->user_prefix."_users WHERE user_id = '$user_id'";
            $res = $this->db->sql_query($sql, FALSE);
                   $userinfo = $this->db->sql_fetchrow($res);
            return $userinfo;
        }

        function index() 
		{
                include_once(NUKE_BASE_DIR.'header.php');
                title(MYU_MYUPLOADS);
                OpenTable();
                echo "<strong>".MYU_FOLDERTOCONTINUE."<br /><form action=\"modules.php?name=".$this->module_name."&amp;file=browse&amp;op=browse\" method=\"post\">
				<select name=\"user_folder\">";
                
				if(!eregi("/$", $this->direct) && !eregi("\\\\$", $this->direct)) $this->direct = $this->direct."/";
                $sql = "SELECT * FROM ".$this->user_prefix."_users WHERE user_id != '1' ORDER BY username";
                $res = $this->db->sql_query($sql, FALSE);
                while($row = $this->db->sql_fetchrow($res)) {
                    if(is_dir($this->direct.$row['username'])) {
                            $this->direct_a = $this->direct.$row['username'];
                                   $open = opendir($this->direct_a);
                                   $count = 0;
                                   while($files = readdir($open)) if(is_file($this->direct_a."/".$files)) $count++;
                                closedir($open);
                                if($count != 1) $say = MYU_MYUFILES;
                                else $say = MYU_MYUFILES;
                                $size = $this->uploads_dirsize_wu($row['username']);
                                $size = $this->uploads_getbettersize($size);
                                echo "<option value=\"".$row['username']."\">".$row['username']." ($count $say, $size)</option>\n";
                        } else {
                                $count = "0 ".MYU_MYUFILES;
                                $size = $this->uploads_getbettersize("0");
                                echo "<option value=\"".$row['username']."\">".$row['username']." ($count, $size)</option>\n";
                        }
                }
                echo "</select> <input type=\"submit\" class=\"liteoption\" value=\"".MYU_SUBMIT."\"> <input type=\"submit\" class=\"liteoption\" name=\"cancel\" value=\"".MYU_GOBACK."\"></form>";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
        }

        function browse($user_folder) 
		{
                global $directory_mode, $user_prefix, $db2, $network_prefix;
		        $sql = "SELECT user_id FROM ".$this->user_prefix."_users WHERE username = '$user_folder'";
                $res = $this->db->sql_query($sql, FALSE);
                $row = $this->db->sql_fetchrow($res);
                $userinfo = $this->uploads_getusrinfo_by_id($row['user_id']);
                if(!eregi("/$", $this->direct) && !eregi("\\\\$", $this->direct)) $this->direct = $this->direct ."/";
                $orig = $this->direct;
                $this->direct = $this->direct.$userinfo['username']."/";
                if(!eregi("/$", $url)) $url .= "/";
                        if(!is_dir($this->direct)) {
                    $old_umask = umask(0);
                        if(!mkdir($this->direct, $directory_mode)) {
                                $decperms = @fileperms($orig);
                                $octalperms = sprintf("%o", $decperms);
                                $perms = (substr($octalperms, 2));
                                die(sprintf(MYU_MYUPLOADSCOULD, $this->direct, $perms)." ".MYU_PLEASEMAKESURE);
                        }
                        umask($old_umask);
                }
                include_once(NUKE_BASE_DIR.'header.php');
                title(MYU_MYUPLOADS);
                OpenTable();
                $user_color = UsernameColor($user_folder);
                echo "<table border=\"0\" width=\"100%\" cellspacing=\"2\" cellpadding=\"2\"><tr><td colspan=\"2\" align=\"center\"><span class=\"title\">$user_color</span></td></tr>"
                    ."<tr><td><strong>".MYU_FILENAME."</strong></td><td><strong>".MYU_FILESIZE."</strong></td></tr>\n";
                $open = opendir($this->direct);
                $i = 0;
                while($files = readdir($open)) {
                         $filename = $this->direct.$files;
                         if(is_file($filename)) {
                        $i++;
                                 $size = filesize($this->direct.$files);
                                 $size = $this->uploads_getbettersize($size);
                        $smaller_name = substr($files, 0, 25);
                                 if($smaller_name != $files) $smaller_name .= "...";
                               echo "<tr><td><a href=\"".$this->url.$userinfo['username']."/".stripslashes($files)."\" target=\"_blank\" title=\"".stripslashes($files)."\">$smaller_name</a></td>\n"
                                           ."<td>$size</td></tr>\n";
                           }
                }
                if($i == 0) echo "<tr><td><i>".MYU_THEUSERHASNO."</i></td></tr>\n";
                echo "</table>";
                closedir($open);
                echo "<form action=\"modules.php?name=".$this->module_name."&amp;file=browse\" method=\"post\">\n"
                    ."<center><input type=\"submit\" class=\"liteoption\" value=\"".MYU_GOBACK."\"></center>\n";
                CloseTable();
                include_once(NUKE_BASE_DIR.'footer.php');
        }
}
   
?>    