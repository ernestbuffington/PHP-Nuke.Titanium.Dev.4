<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/

/*****[CHANGES]**********************************************************
-=[Base]=-
      Nuke Patched                             v3.1.0       06/26/2005
      Caching System                           v1.0.0       11/20/2005
 ************************************************************************/

if(!defined('IN_SETTINGS')) {
  exit('Access Denied');
}

global $prefix, $db, $admdata, $admLang;

function Get_Meta_Array() 
{
    global $prefix, $db;
    
    $sql = 'SELECT meta_name, meta_content FROM '.$prefix.'_meta';
    $result = $db->sql_query($sql);
    $i=0;
    while(list($meta_name, $meta_content) = $db->sql_fetchrow($result)) {
        $metatags[$i] = array();
        $metatags[$i]['meta_name'] = $meta_name;
        $metatags[$i]['meta_content'] = $meta_content;
        $i++;
    }
    $db->sql_freeresult($result);
    
    return $metatags;
}

$metatags = Get_Meta_Array();
echo '  <tr>'.PHP_EOL;
echo '    <td class="catHead" colspan="3" style="font-weight: bold; text-align: center; text-transform: uppercase;">'.$admlang['meta']['title'].'</td>'.PHP_EOL;
echo '  </tr>'.PHP_EOL;
echo '  <tr>'.PHP_EOL;
echo '    <td class="row1" colspan="3">'.PHP_EOL;
echo '      <table border="0" cellpadding="4" cellspacing="1" class="forumline" style="width: 100%;">'.PHP_EOL;
for($i=0, $maxi=count($metatags);$i<$maxi;$i++) 
{
    $metatag = $metatags[$i];
    echo '        <tr>'.PHP_EOL;
    echo '          <td class="row1" style="width: 50%;">'.$metatag['meta_name'].'</td>'.PHP_EOL;
    echo '          <td class="row1" style="width: 50%;">'.PHP_EOL;
    echo '            <input type="text" name="x'.$metatag['meta_name'].'" value="'.$metatag['meta_content'].'" style="width: 350px;" />'.PHP_EOL;
    echo '            <a href="'.$admin_file.'.php?op=ConfigSave&amp;sub=11&amp;act=delete&amp;meta='.$metatag['meta_name'].'">'.get_evo_icon('evo-sprite delete').'</a>'.PHP_EOL;
    echo '          </td>'.PHP_EOL;
    echo '        </tr>'.PHP_EOL;
}
echo '        <tr>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="new_name" value="" style="width: 200px;"></td>'.PHP_EOL;
echo '          <td class="row1" style="width: 50%;"><input type="text" name="new_value" value="" style="width: 350px;"></td>'.PHP_EOL;
echo '        </tr>'.PHP_EOL;
echo '      </table>'.PHP_EOL;
        
?>