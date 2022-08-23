<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/************************************************************************
   Nuke-Evolution: SQL Control System
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team
  
   Filename      : class.database.php
   Author(s)     : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 12.03.2005 (mm.dd.yyyy)
                                                                        
   Notes         : SQL Control Class for more database options. 
                   Based on the same class by CPG Dragonfly CMS
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

class DB {

    function output($str, $compress, $end=false)
    {
        static $buffer;
        if ($compress) {
            $buffer .= $str;
            if ($end || strlen($buffer) > 20480) {
                echo gzencode($buffer);
                $buffer = '';
            }
        } else {
            echo $str;
        }
    }

    function backup($database, $tables, $filename, $structure=true, $data=true, $drop=true, $compress=true)
    {
        if (!is_array($tables) || empty($tables)) {
            trigger_error('No tables to backup', E_USER_WARNING);
            return false;
        }
        $crlf = "\n";
        # doing some DOS-CRLF magic...
        # this looks better under WinX
        if (preg_match('/[^(]*\((.*)\)[^)]*/',$_SERVER['HTTP_USER_AGENT'],$regs)) {
            if (preg_match('/Win/',$regs[1])) $crlf="\r\n";
        }

        if (GZIPSUPPORT) {
            while (ob_end_clean());
            header('Content-Encoding:');
        } else {
            $compress = false;
        }
        if ($compress) {
            $filename .= '.gz';
            header("Content-Type: application/x-gzip; name=\"$filename\"");
        } else {
            header("Content-Type: text/x-delimtext; name=\"$filename\"");
        }
        header("Content-disposition: attachment; filename=$filename");

        DB::output("# ========================================================$crlf"
            ."#$crlf"
            ."# Database : $database$crlf"
            ."# "._ON." ".date('m-d-Y')."$crlf"
            ."#$crlf"
            ."# ========================================================$crlf"
            ."$crlf", $compress);
        set_time_limit(0);
        foreach ($tables AS $table) {
            if ($structure) {
                DB::output("$crlf#$crlf"."# Table structure for table '$table'$crlf"."#$crlf$crlf", $compress);
                DB::output(DB::get_table_struct($database, $table, $crlf, $drop).";$crlf$crlf", $compress);
            }
            if ($data) {
                DB::output("$crlf#$crlf"."# Dumping data for table '$table'$crlf"."#$crlf$crlf", $compress);
                DB::get_table_content($database, $table, $crlf, false, true, $compress);
            }
        }
        if ($compress) DB::output('', true, true);
        exit;
    }

    // Return $table's CREATE definition
    // Returns a string containing the CREATE statement on success
    function get_table_struct($database, $table, $crlf, $drop)
    {
        global $db;
        $schema_create = '';
        if ($drop) { $schema_create .= "DROP TABLE IF EXISTS $table;$crlf"; }
        $schema_create .= "CREATE TABLE $table ($crlf";

        $result = $db->sql_query("SHOW FIELDS FROM $database.$table");
        while ($row = $db->sql_fetchrow($result)) {
            $schema_create .= "   $row[Field] $row[Type]";
            if (isset($row['Default']) && (!empty($row['Default']) || $row['Default'] == '0'))
                $schema_create .= " DEFAULT '$row[Default]'";
            if ($row['Null'] != 'YES') $schema_create .= ' NOT NULL';
            if ($row['Extra'] != '') $schema_create .= " $row[Extra]";
            $schema_create .= ",$crlf";
        }
        $db->sql_freeresult($result);
        $schema_create = preg_replace("/,$crlf/".'$', '', $schema_create);
        
        $result = $db->sql_query("SHOW KEYS FROM $table");
        $index = array();
        while ($row = $db->sql_fetchrow($result)) {
            $kname=$row['Key_name'];
			if (($kname != "PRIMARY") && ($row['Non_unique'] == 0))
			$kname="UNIQUE|$kname";
		if ($row['Index_type'] == "FULLTEXT")
                    $kname="FULLTEXT|$kname";
                if (!isset($index[$kname]))
                     $index[$kname] = array();
                 $index[$kname][] = $row['Column_name'];
            }
            $db->sql_freeresult($result);
        while(list($x, $columns) = @each($index)) {
                 $schema_create .= ",$crlf";
                 if($x == "PRIMARY")
                     $schema_create .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
                 elseif (substr($x,0,6) == "UNIQUE")
                    $schema_create .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
                 elseif (substr($x,0,8) == "FULLTEXT")
                    $schema_create .= "   FULLTEXT ".substr($x,9)." (" . implode($columns, ", ") . ")";
                 else
                    $schema_create .= "   KEY $x (" . implode($columns, ", ") . ")";
            }
        
            $schema_create .= "$crlf)";
            return (stripslashes($schema_create));
        }

    // Get the content of $table as a series of INSERT statements.
    function get_table_content($database, $table, $crlf, $complete=false, $echo=false, $compress=false)
    {
        global $db;
        $str = $fields = '';
        $result = $db->sql_query("SELECT * FROM $database.$table");
        $fieldcount = $db->sql_numfields($result);
        if ($complete) {
            $fields = array();
            for ($j=0; $j<$fieldcount;$j++) {
                $fields[] = $db->sql_fieldname($j, $result);
            }
            $fields = '('.implode(', ', $fields).') ';
        }
        while ($row = $db->sql_fetchrow($result)) {
            $str .= "INSERT INTO $table $fields VALUES (";
            for ($j=0; $j<$fieldcount;$j++) {
                if ($j>0) $str .= ', ';
                // Can't use addslashes as we don't know what value has magic_quotes_sybase.
                if (!isset($row[$j])) { $str .= 'NULL'; }
                elseif ($row[$j] != '') { $str .= "'".Fix_Quotes($row[$j])."'"; }
                else { $str .= "''"; }
            }
            $str .= ");$crlf";
            if ($echo) {
                DB::output($str, $compress);
                $str = '';
            }
        }
        $db->sql_freeresult($result);
        return $str;
    }

    function query_file($file, &$error, $replace_prefix=false)
    {
        $error = false;
        if (!is_array($file)) {
            $tmp['name'] = $tmp['tmp_name'] = $file;
            $tmp['type'] = preg_match("/\.gz$/is",$file) ? 'application/x-gzip' : 'text/plain';
            $file = $tmp;
        }
        if (empty($file['tmp_name']) || empty($file['name'])) echo('ERROR no file specified!');
        // Most servers identify a .gz as x-tar
//        if (preg_match("/^(text\/[a-zA-Z]+)|(application\/(x\-)?gzip(\-compressed)?)|(application\/octet-stream)$/is", $file['type'])) {
        if (preg_match("/^(text\/[a-zA-Z]+)|(application\/(x\-)?(gzip|tar)(\-compressed)?)|(application\/octet-stream)$/is", $file['type'])) {
            $filedata = '';
            $open = 'gzopen';
            $eof = 'gzeof';
            $read = 'gzgets';
            $close = 'gzclose';
            if (!GZIPSUPPORT) {
                if (preg_match("/\.gz$/is",$file['name'])) {
                    $error = "Can't decompress file";
                    return false;
                }
                $open = 'fopen';
                $eof = 'feof';
                $read = 'fread';
                $close = 'fclose';
            }
            $rc = $open($file['tmp_name'], 'rb');
            if ($rc) {
                while (!$eof($rc)) $filedata .= $read($rc, 100000);
                $close($rc);
            } else {
                $error = 'Couldn\'t open '.$file['tmp_name'].' for processing';
            }
        } else {
            $error = "Invalid filename: $file[type] $file[name]";
        }
        if ($error) { return false; }
        $filedata = DB::remove_remarks($filedata);
        $queries = DB::split_sql_file($filedata, ";\n");
        if (count($queries) < 1) {
            $error = 'There are no queries in '.$file['name'];
            return false;
        }
        global $db, $prefix;
        set_time_limit(0);
        foreach($queries AS $query) {
            if (!$replace_prefix) {
                $query = preg_replace('#(TABLE|INTO|EXISTS|ON) ([a-zA-Z]*?(_))#i', "\\1 $prefix".'_', $query);
            } else {
                foreach($replace_prefix AS $oldprefix => $newprefix) {
                    if ($oldprefix != $newprefix) {
                        $query = preg_replace("/$oldprefix/", $newprefix, $query);
                    }
                }
            }
            if (SQL_LAYER == 'mysql' || SQL_LAYER == 'mysqli' && preg_match('/^CREATE TABLE /', $query) && !preg_match('/ENGINE=MyISAM/', $query))
            {
                $query .= ' ENGINE=MyISAM';
            }
            $db->sql_query($query);
        }
        return true;
    }

    // remove_remarks will strip the sql comment lines out of an uploaded sql file
    function remove_remarks($lines)
    {
        $lines = explode("\n", $lines);
        $linecount = count($lines);
        $output = '';
        for ($i = 0; $i < $linecount; $i++) {
            $line = trim($lines[$i]);
            if (strlen($line) > 0) {
                if ($line[0] != "#" && $line[0] != "-") { $output .= $line . "\n"; }
                // Trading a bit of speed for lower mem. use here.
                $lines[$i] = '';
            }
        }
        return $output;
    }

    // split_sql_file will split an uploaded sql file into single sql statements.
    // Note: expects trim() to have already been run on $sql.
    function split_sql_file(&$sql, $delimiter)
    {
        // Split up our string into "possible" SQL statements.
        $tokens = explode($delimiter, $sql);
        unset($sql);
        $output = array();

        // we don't actually care about the matches preg gives us.
        $matches = array();

        // this is faster than calling count($tokens) every time thru the loop.
        $token_count = count($tokens);
        for ($i = 0; $i < $token_count; $i++) {
            // Don't wanna add an empty string as the last thing in the array.
            if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0))) {
                // This is the total number of single quotes in the token.
                $total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
                // Counts single quotes that are preceded by an odd number of backslashes,
                // which means they're escaped quotes.
                $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

                $unescaped_quotes = $total_quotes - $escaped_quotes;

                // If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
                if (($unescaped_quotes % 2) == 0) {
                    // It's a complete sql statement.
                    $output[] = $tokens[$i];
                    // save memory.
                    $tokens[$i] = '';
                } else {
                    // incomplete sql statement. keep adding tokens until we have a complete one.
                    // $temp will hold what we have so far.
                    $temp = $tokens[$i] . $delimiter;
                    // save memory..
                    $tokens[$i] = '';

                    // Do we have a complete statement yet?
                    $complete_stmt = false;

                    for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++) {
                        // This is the total number of single quotes in the token.
                        $total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
                        // Counts single quotes that are preceded by an odd number of backslashes,
                        // which means they're escaped quotes.
                        $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

                        $unescaped_quotes = $total_quotes - $escaped_quotes;

                        if (($unescaped_quotes % 2) == 1) {
                            // odd number of unescaped quotes. In combination with the previous incomplete
                            // statement(s), we now have a complete statement. (2 odds always make an even)
                            $output[] = $temp . $tokens[$j];

                            $tokens[$j] = '';
                            $temp = '';

                            // exit the loop.
                            $complete_stmt = true;
                            // make sure the outer loop continues at the right point.
                            $i = $j;
                        } else {
                            // even number of unescaped quotes. We still don't have a complete statement.
                            // (1 odd and 1 even always make an odd)
                            $temp .= $tokens[$j] . $delimiter;
                            $tokens[$j] = '';
                        }
                    } // for..
                } // else
            }
        }
        return $output;
    }
} 

?>