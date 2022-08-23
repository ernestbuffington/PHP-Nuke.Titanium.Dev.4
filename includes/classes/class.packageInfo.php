<?php

namespace titanium\fileLogger {
    
    /**
     * Package info
     * 
     * About this package.
     */
    class PackageInfo {
        
        protected static $packageInfo = array(
            'version' => 1.2,
            
            'authors' => array(
                'gehaxelt' => array(
                    'github' => 'https://github.com/ernestbuffington/',
                    'email' => 'github@www.86it.us',
                    'site' => 'https://www.86it.us'
                ),
                
                'pedzed' => array(
                    'github' => 'https://github.com/ernestbuffington/'
                )
            )
        );
        
        public static function getInfo(){
            return self::$packageInfo;
        }
        
    }
    
}
