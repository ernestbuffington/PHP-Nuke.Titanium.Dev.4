<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1a14629efd23a512ecd8ce2ef4e7dc94
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
        '9e71c1459ef1226520e4b26dac3a180d' => __DIR__ . '/..' . '/php81_bc/strftime/src/php-8.1-strftime.php',
    );

    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Detection\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Detection\\' => 
        array (
            0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Detection\\MobileDetect' => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/src/MobileDetect.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1a14629efd23a512ecd8ce2ef4e7dc94::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1a14629efd23a512ecd8ce2ef4e7dc94::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit1a14629efd23a512ecd8ce2ef4e7dc94::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit1a14629efd23a512ecd8ce2ef4e7dc94::$classMap;

        }, null, ClassLoader::class);
    }
}