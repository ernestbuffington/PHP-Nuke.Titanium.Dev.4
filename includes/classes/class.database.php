<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
   PHP-Nuke Titanium: SQL Control System
   ============================================
   Copyright (c) 2022 by The PHP-Nuke Titanium Group
  
   Filename      : class.database.php
   Author(s)     : Ernest Allen Buffington (www.theghost.86it.us)
   Version       : 2.0.0
   Date          : 12.07.2021 (mm.dd.yyyy)
                                                                        
   Notes         : SQL Control Class for more database options. 
                   Based on the same class by CPG Dragonfly CMS
************************************************************************/

/************************************************************************
   Nuke-Evolution: SQL Control System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename               : class.database.php
   Original Author(s)     : Quake (www.Nuke-Evolution.com)
   Version                : 1.0.0
   Date                   : 12.03.2005 (mm.dd.yyyy)
                                                                        
   Notes                  : SQL Control Class for more database options. 
                            Based on the same class by CPG Dragonfly CMS
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])):
  exit('Access Denied');
endif;

class DB {

    function output($str, $compress, $end=false)
    {
        static $buffer;

        if($compress):
          
		  $buffer .= $str;
          
		  if ($end || strlen($buffer) > 20480):
            echo gzencode($buffer);
            $buffer = '';
          endif;
         
		else: 
            echo $str;
        endif;
    }

    function backup($database, $tables, $filename, $structure=true, $data=true, $drop=true, $compress=true)
    {
        if(!is_array($tables) || empty($tables)):
            trigger_error('No tables to backup', E_USER_WARNING);
            return false;
        endif;

        $crlf = "\n";
        
		# doing some DOS-CRLF magic...
        # this looks better under WinX
        if (preg_match('/[^(]*\((.*)\)[^)]*/',(string) $_SERVER['HTTP_USER_AGENT'],$regs)):
          if(preg_match('/Win/',$regs[1])): 
		    $crlf="\r\n";
		  endif;
        endif;

        if(GZIPSUPPORT): 
		
          while(ob_end_clean());
            header('Content-Encoding:');
         
		else: 
            $compress = false;
        endif;
        
		if($compress):
            $filename .= '.gz';
            header("Content-Type: application/x-gzip; name=\"$filename\"");
		else: 
            header("Content-Type: text/x-delimtext; name=\"$filename\"");
        endif;
        
		header("Content-disposition: attachment; filename=$filename");

        (new DB())->output("# ========================================================$crlf"
            ."#$crlf"
            ."# Database : $database$crlf"
            ."# "._ON." ".date('m-d-Y')."$crlf"
            ."#$crlf"
            ."# ========================================================$crlf"
            ."$crlf", $compress);
        set_time_limit(0);

        foreach($tables AS $table):

 			if($structure): 
               (new DB())->output("$crlf#$crlf"."# Table structure for table '$table'$crlf"."#$crlf$crlf", $compress);
                (new DB())->output((new DB())->get_table_struct($database, $table, $crlf, $drop).";$crlf$crlf", $compress);
            endif;
            
			if($data): 
                (new DB())->output("$crlf#$crlf"."# Dumping data for table '$table'$crlf"."#$crlf$crlf", $compress);
                (new DB())->get_table_content($database, $table, $crlf, false, true, $compress);
            endif;

        endforeach;
		
        if($compress): 
		(new DB())->output('', true, true);
		endif;
        
		exit;
    }

    # Return $table's CREATE definition
    # Returns a string containing the CREATE statement on success
    function get_table_struct($database, $table, $crlf, $drop)
    {
        global $db;
        
		$schema_create = '';
        
		if($drop): 
		  $schema_create .= "DROP TABLE IF EXISTS $table;$crlf"; 
		endif;

        $schema_create .= "CREATE TABLE $table ($crlf";

        $result = $db->sql_query("SHOW FIELDS FROM $database.$table");
        
		while($row = $db->sql_fetchrow($result)): 
		
            $schema_create .= "   $row[Field] $row[Type]";
        
		    if(isset($row['Default']) && (!empty($row['Default']) || $row['Default'] == '0')):
              $schema_create .= " DEFAULT '$row[Default]'";
			endif;
				
            if($row['Null'] != 'YES'): 
			  $schema_create .= ' NOT NULL';
			endif;
            
			if($row['Extra'] != ''): 
			  $schema_create .= " $row[Extra]";
			endif;
            
			$schema_create .= ",$crlf";
			
        endwhile;
		
        $db->sql_freeresult($result);
        
		$schema_create = preg_replace("/,$crlf/".'$', '', $schema_create);
        
        $result = $db->sql_query("SHOW KEYS FROM $table");
        
		$index = [];
        
		while($row = $db->sql_fetchrow($result)): 

            $kname=$row['Key_name'];
		
			if (($kname != "PRIMARY") && ($row['Non_unique'] == 0)):
			  $kname="UNIQUE|$kname";
			endif;
		
		    if($row['Index_type'] == "FULLTEXT"):
              $kname="FULLTEXT|$kname";
			endif;
                
			if(!isset($index[$kname])):
              $index[$kname] = [];
			endif;
              
			$index[$kname][] = $row['Column_name'];
        
		endwhile;
		
            $db->sql_freeresult($result);
         
		 foreach($index as $x => $columns):
            			
			$schema_create .= ",$crlf";
            
			if($x == "PRIMARY"):
                $schema_create .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
            elseif (str_starts_with((string) $x, "UNIQUE")):
               $schema_create .= "   UNIQUE ".substr((string) $x,7)." (" . implode($columns, ", ") . ")";
            elseif (str_starts_with((string) $x, "FULLTEXT")):
               $schema_create .= "   FULLTEXT ".substr((string) $x,9)." (" . implode($columns, ", ") . ")";
            else:
               $schema_create .= "   KEY $x (" . implode($columns, ", ") . ")";
			endif;
        
		endforeach;
        
            $schema_create .= "$crlf)";
            
			return (stripslashes($schema_create));
        }

    # Get the content of $table as a series of INSERT statements.
    function get_table_content($database, $table, $crlf, $complete=false, $echo=false, $compress=false)
    {
        global $db;
        
		$str = $fields = [];
        
		$result = $db->sql_query("SELECT * FROM $database.$table");
        
		$fieldcount = $db->sql_numfields($result);
        
		if($complete): 
        
		    $fields = [];
        
		    for($j=0; $j<$fieldcount;$j++): 
                $fields[] = $db->sql_fieldname($j, $result);
            endfor;
        
		    $fields = '('.implode(', ', $fields).') ';
        
		endif;
        
		while($row = $db->sql_fetchrow($result)): 
		
            $str .= "INSERT INTO $table $fields VALUES (";
        
		    for($j=0; $j<$fieldcount;$j++): 
			
                if($j>0): 
				  $str .= ', ';
				endif;
                
				# Can't use addslashes as we don't know what value has magic_quotes_sybase.
                if(!isset($row[$j])): 
				  $str .= 'NULL'; 
                elseif($row[$j] != ''): 
				  $str .= "'".Fix_Quotes($row[$j])."'"; 
                else: 
				  $str .= "''"; 
				endif;

            endfor;
            
			$str .= ");$crlf";
            
			if($echo)
			{
                (new DB())->output($str, $compress);
                $str = '';
            }
        endwhile;
        
		$db->sql_freeresult($result);
        
		return $str;
    }

    function query_file($file, &$error, $replace_prefix=false)
    {
        $tmp = [];
        $filedata = null;
        $error = false;
        
		if(!is_array($file)): 
		
            $tmp['name'] = $tmp['tmp_name'] = $file;
            $tmp['type'] = preg_match("/\.gz$/is",(string) $file) ? 'application/x-gzip' : 'text/plain';
            $file = $tmp;
        
		endif;
        
		if(empty($file['tmp_name']) || empty($file['name'])): 
		  echo('ERROR no file specified!');
		endif;
        
		# Most servers identify a .gz as x-tar
        if(preg_match("/^(text\/[a-zA-Z]+)|(application\/(x\-)?(gzip|tar)(\-compressed)?)|(application\/octet-stream)$/is", (string) $file['type'])): 
		
            $filedata = '';
            $open = 'gzopen';
            $eof = 'gzeof';
            $read = 'gzgets';
            $close = 'gzclose';
        
		    if(!GZIPSUPPORT): 
			
                if(preg_match("/\.gz$/is",(string) $file['name'])): 
				
                    $error = "Can't decompress file";
                    return false;
                
				endif;
                
				$open = 'fopen';
                $eof = 'feof';
                $read = 'fread';
                $close = 'fclose';
            
			endif;
            
			$rc = $open($file['tmp_name'], 'rb');
            
			if($rc): 
                while(!$eof($rc)): 
				  $filedata .= $read($rc, 100000);
                endwhile;
				$close($rc);
			else: 
                $error = 'Couldn\'t open '.$file['tmp_name'].' for processing';
            endif;
         
		else: 
            $error = "Invalid filename: $file[type] $file[name]";
        endif;
        
		if($error): 
		  return false; 
		endif;
        
		$filedata = (new DB())->remove_remarks($filedata);
        $queries = (new DB())->split_sql_file($filedata, ";\n");
        
		if((is_countable($queries) ? count($queries) : 0) < 1): 
		
            $error = 'There are no queries in '.$file['name'];
            return false;
        
		endif;
        
		global $db, $prefix;
        
		set_time_limit(0);
        
		foreach($queries AS $query): 
		
            if(!$replace_prefix): 
                $query = preg_replace('#(TABLE|INTO|EXISTS|ON) ([a-zA-Z]*?(_))#i', "\\1 $prefix".'_', (string) $query);
			else: 
                foreach($replace_prefix AS $oldprefix => $newprefix): 
                    if($oldprefix != $newprefix): 
                        $query = preg_replace("/$oldprefix/", (string) $newprefix, (string) $query);
                    endif;
                endforeach;
            endif;
            
			if(SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli' && preg_match('/^CREATE TABLE /', (string) $query) && !preg_match('/ENGINE=MyISAM/', (string) $query)):
                $query .= ' ENGINE=MyISAM';
            endif;
            
			$db->sql_query($query);
        
		endforeach;
        
		return true;
    }

    # remove_remarks will strip the sql comment lines out of an uploaded sql file
    function remove_remarks($lines)
    {
        $lines = explode("\n", (string) $lines);
     
	    $linecount = count($lines);
     
	    $output = '';
     
	    for($i = 0; $i < $linecount; $i++): 
		
            $line = trim($lines[$i]);
            
			if(strlen($line) > 0): 
			
                if($line[0] != "#" && $line[0] != "-"): 
				  $output .= $line . "\n"; 
				endif;
                
				# Trading a bit of speed for lower mem. use here.
                $lines[$i] = '';
            endif;
        endfor;
        
		return $output;
    }

    # split_sql_file will split an uploaded sql file into single sql statements.
    # Note: expects trim() to have already been run on $sql.
    function split_sql_file(&$sql, $delimiter)
    {
        # Split up our string into "possible" SQL statements.
        $tokens = explode($delimiter, (string) $sql);
        unset($sql);
        $output = [];

        # we don't actually care about the matches preg gives us.
        $matches = [];

        # this is faster than calling count($tokens) every time thru the loop.
        $token_count = count($tokens);
        
		for($i = 0; $i < $token_count; $i++): 
		
            # Don't wanna add an empty string as the last thing in the array.
            if(($i != ($token_count - 1)) || (strlen($tokens[$i] > 0))): 
			
                # This is the total number of single quotes in the token.
                $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
                # Counts single quotes that are preceded by an odd number of backslashes,
                # which means they're escaped quotes.
                $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

                $unescaped_quotes = $total_quotes - $escaped_quotes;

                # If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
                if(($unescaped_quotes % 2) == 0): 
                    # It's a complete sql statement.
                    $output[] = $tokens[$i];
                    # save memory.
                    $tokens[$i] = '';
				else: 
                    # incomplete sql statement. keep adding tokens until we have a complete one.
                    # $temp will hold what we have so far.
                    $temp = $tokens[$i] . $delimiter;
                    # save memory..
                    $tokens[$i] = '';

                    # Do we have a complete statement yet?
                    $complete_stmt = false;

                    for($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++): 
                        # This is the total number of single quotes in the token.
                        $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                        # Counts single quotes that are preceded by an odd number of backslashes,
                        # which means they're escaped quotes.
                        $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

                        $unescaped_quotes = $total_quotes - $escaped_quotes;

                        if(($unescaped_quotes % 2) == 1): 
                            # odd number of unescaped quotes. In combination with the previous incomplete
                            # statement(s), we now have a complete statement. (2 odds always make an even)
                            $output[] = $temp . $tokens[$j];

                            $tokens[$j] = '';
                            $temp = '';

                            # exit the loop.
                            $complete_stmt = true;
                            # make sure the outer loop continues at the right point.
                            $i = $j;
						else: 
                            # even number of unescaped quotes. We still don't have a complete statement.
                            # (1 odd and 1 even always make an odd)
                            $temp .= $tokens[$j] . $delimiter;
                            $tokens[$j] = '';
                        endif;
                    endfor; 
                endif;
            endif;
        endfor;
        return $output;
    }
} 

?>
