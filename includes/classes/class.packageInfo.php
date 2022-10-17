<?php

namespace titanium\fileLogger {
    
    /**
     * Package info
     * 
     * About this package.
     */
    class PackageInfo {
        
        protected static $packageInfo = array(
            'version' => 4.2,
            
            'authors' => array(
                'gehaxelt' => array(
                    'github' => 'https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4',
                    'email' => 'ernest.buffington@gmail.com',
                    'site' => 'https://www.php-nuke-titanium.86it.us'
                ),
                
                'pedzed' => array(
                    'github' => 'https://github.com/ernestbuffington/PHP-Nuke.Titanium.Dev.4'
                )
            )
        );
        
        public static function getInfo(){
            return self::$packageInfo;
        }
        
    }
    
}
