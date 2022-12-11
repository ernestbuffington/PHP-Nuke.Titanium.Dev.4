<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Core\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        //__DIR__ . '/admin',
        //__DIR__ . '/blocks',
        //__DIR__ . '/images',
        __DIR__ . '/includes',
        //__DIR__ . '/install',
        //__DIR__ . '/language',
        //__DIR__ . '/modules',
        //__DIR__ . '/themes',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
    
	$rectorConfig->phpVersion(PhpVersion::PHP_80);
     //define sets of rules
       // $rectorConfig->sets([
       //     LevelSetList::UP_TO_PHP_80
       // ]);
};
