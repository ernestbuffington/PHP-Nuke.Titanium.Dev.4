<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/*********************************************
  CPG Dragonfly™ CMS
  ********************************************
  Copyright (c) 2004 - 2005 by CPG-Nuke Dev Team
  http://dragonflycms.org

  Dragonfly is released under the terms and conditions
  of the GNU GPL version 2 or any later version

  $Source: /cvs/html/includes/classes/rss.php,v $
  $Revision: 1.5 $
  $Author: djmaze $
  $Date: 2005/12/17 04:05:48 $
**********************************************/

/************************************************************************
   Nuke-Evolution: RSS Reader
   ============================================
   Copyright (c) 2005 by The Nuke-Evolution Team

   Filename      : class.rss.php
   Author(s)     : Quake (www.Nuke-Evolution.com)
   Version       : 1.0.0
   Date          : 12.08.2005 (mm.dd.yyyy)

   Notes         : This class reads rss files from other sites.
                   Based on RSS Reader from CPG Dragonfly
************************************************************************/

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    exit('Access Denied');
}

class RSS {

    function get_tag($tagname, &$string) {
        preg_match("#<$tagname.*?>(.*?)</$tagname>#si", $string, $tag);
        if (!isset($tag[1])) { 
            return false;
        }
        $tag = strtr($tag[1], array('<![CDATA['=>'', ']]>'=>''));
        return trim($tag);
    }

    function read($url, $items_limit=10) {
        $channeltags = array ('title', 'link', 'description', 'language', 'generator', 'copyright', 'category', 'pubDate', 'managingEditor', 'webMaster', 'lastBuildDate', 'rating', 'docs', 'ttl');
        $itemtags = array('title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'pubDate', 'source');
        if (!($data = RSS::get_fileinfo($url))) {
           return false;
        }
        preg_match("'<channel.*?>(.*?)</channel>'si", $data['data'], $channel);
        $channel = str_replace('&apos;', '&#039;', $channel[1]);
        foreach($channeltags as $channeltag) {
            $tag = RSS::get_tag($channeltag, $channel);
            if (!empty($tag)) { $rss[$channeltag] = $tag; }
        }
        $rss['title'] = strip_tags(urldecode($rss['title']));
        $rss['link'] = strip_tags($rss['link']);
        $rss['desc'] =& $rss['description'];
        if (isset($rss['ttl'])) {
            $rss['ttl'] = intval($rss['ttl']);
        }
        preg_match_all('#<item(| .*?)>(.*?)</item>#si', $data['data'], $items);
        $items = $items[2];
        for ($i=0;$i<$items_limit;$i++) {
            if (isset($items[$i]) && !empty($items[$i])) {
                $item = array();
                foreach($itemtags as $itemtag) {
                    $tag = RSS::get_tag($itemtag, $items[$i]);
                    if (!empty($tag)) { $item[$itemtag] = $tag; }
                }
                if (!empty($item)) {
                    $item['title'] = strip_tags(urldecode($item['title']));
                    $item['link'] = isset($item['link']) ? strip_tags($item['link']) : '';
                    $item['desc'] =& $item['description'];
                    $rss['items'][] = $item;
                }
            }
        }
        return $rss;
    }

    function get_fileinfo($url)
    {
        $rdf = parse_url($url);
        if (!isset($rdf['host'])) return false;
        if (!isset($rdf['path'])) $rdf['path'] = '/';
        if (!isset($rdf['port'])) $rdf['port'] = 80;
        if (!isset($rdf['query'])) $rdf['query'] = '';
        elseif ($rdf['query'] != '') $rdf['query'] = '?'.$rdf['query'];
        $file = array('size'=>0, 'type'=>'', 'date'=>0, 'animation'=>false, 'modified'=>true);
        if ($fp = fsockopen($rdf['host'], $rdf['port'], $errno, $errstr, 15)) {
            fputs($fp, 'GET '.$rdf['path'].$rdf['query']." HTTP/1.0\r\n");
            fputs($fp, 'User-Agent: Nuke-Evolution RSS Reader\r\n');
           if (GZIPSUPPORT) fputs($fp, "Accept-Encoding: gzip;q=0.9\r\n");
            fputs($fp, "HOST: $rdf[host]\r\n\r\n");
            $data = rtrim(fgets($fp, 300));
            preg_match('#.* ([0-9]+) (.*)#i', $data, $head);
            if (($head[1] >= 301 && $head[1] <= 303) || $head[1] == 307) {
                while (!empty($data)) {
                    $data = rtrim(fgets($fp, 300)); // read lines
                    if (stristr($data, 'Location: ')) {
                        $new_location = trim(str_replace('Location: ', '', $data));
                        break;
                    }
                }
                $head[2] .= ($head[1]==302) ? ' at' : ' to';
                fputs($fp,"Connection: close\r\n\r\n"); fclose($fp);
                DisplayError("$url $head[2] <strong>$new_location</strong>");
                return RSS::get_fileinfo($new_location);
            } elseif ($head[1] != 200) {
                fputs($fp,"Connection: close\r\n\r\n"); fclose($fp);
                DisplayError($url."<br />$data");
                return false;
            }
            $GZIP = false;
            while (!empty($data)) {
                $data = rtrim(fgets($fp, 300));
                if (strstr($data, 'Content-Length: ')) {
                    $file['size'] = trim(str_replace('Content-Length: ', '', $data));
                }
                elseif (strstr($data, 'Content-Type: ')) {
                    $file['type'] = trim(str_replace('Content-Type: ', '', $data));
                }
                elseif (strstr($data, 'Last-Modified: ')) {
                    $file['date'] = trim(str_replace('Last-Modified: ', '', $data));
                }
                if (stristr($data, 'Content-Encoding: gzip') || stristr($data, 'Content-Encoding: x-gzip')) { $GZIP = true; }
            }
            $data = '';
            while(!feof($fp)) {
                $data .= fread($fp, 1024); // read binary
            }
            if ($GZIP) { $data = gzinflate(substr($data,10,-4)); }
            $file['data'] = $data;
            fputs($fp,"Connection: close\r\n\r\n");
            fclose($fp);
        } else {
            DisplayError($errstr);
            return false;
        }
        return $file;
    }

}

?>