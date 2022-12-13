<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Core\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    
	$rectorConfig->skip([
        //__DIR__ . '/src/SingleFile.php',
        __DIR__ . '/assets',
        __DIR__ . '/blocks',
        __DIR__ . '/install',
		//__DIR__ . '/modules/Forums',
		__DIR__ . '/modules/Advertising',
		__DIR__ . '/modules/Arcade_Tweaks',
		__DIR__ . '/modules/Blog_Submit',
		__DIR__ . '/modules/Blog_Topics',
		__DIR__ . '/modules/Blogs',
		__DIR__ . '/modules/Blogs_Top',
		__DIR__ . '/modules/Bookmarks',
		__DIR__ . '/modules/Cemetery',
		__DIR__ . '/modules/cPanel_Login',
		__DIR__ . '/modules/CSS_Color_Chart',
		__DIR__ . '/modules/CSS_Reference',
		__DIR__ . '/modules/Docs',
		__DIR__ . '/modules/Donations',
		__DIR__ . '/modules/ECalendar',
		__DIR__ . '/modules/Evo_UserBlock',
		__DIR__ . '/modules/FAQ',
		__DIR__ . '/modules/Feedback',
		__DIR__ . '/modules/File_Repository',
		__DIR__ . '/modules/Google-Site-Map',
		__DIR__ . '/modules/Groups',
		__DIR__ . '/modules/HTML_Newsletter',
		__DIR__ . '/modules/HTML_to_PHP',
		__DIR__ . '/modules/Image_Repository',
		__DIR__ . '/modules/Link_Us',
		__DIR__ . '/modules/Loan_Amortization',
		__DIR__ . '/modules/Member_List',
		__DIR__ . '/modules/My_Forum_Topics',
		__DIR__ . '/modules/Network',
		__DIR__ . '/modules/Network_Advertising',
		__DIR__ . '/modules/Network_Projects',
		__DIR__ . '/modules/NukeSentinel',
		__DIR__ . '/modules/Private_Messages',
		__DIR__ . '/modules/Profile',
		__DIR__ . '/modules/Proof_Of_God',
		__DIR__ . '/modules/Recommend_Us',
		__DIR__ . '/modules/Reviews',
		__DIR__ . '/modules/Search',
		__DIR__ . '/modules/Shout_Box',
		__DIR__ . '/modules/Spambot_Killer',
		__DIR__ . '/modules/Statistics',
		//__DIR__ . '/modules/Surveys',
		__DIR__ . '/modules/Titanium_SandBox',
		__DIR__ . '/modules/Web_Links',
		//__DIR__ . '/modules/Your_Account',
		
		
		__DIR__ . '/admin',
		//__DIR__ . '/includes',
		__DIR__ . '/themes',
		__DIR__ . '/dev_modules',
		__DIR__ . '/cgi-bin',
		__DIR__ . '/.well-known',
		__DIR__ . '/vendor',
		
        // or use fnmatch
        //__DIR__ . '/src/*/Tests/*',
    ]);
	
	$rectorConfig->paths([
        //__DIR__ . '/admin',
        //__DIR__ . '/images',
        //
        
        //__DIR__ . '/index.php',
		__DIR__ . '/includes/functions_browser.php',
		//__DIR__ . '/includes/usercp_avatar.php',
		//__DIR__ . '/modules/Blogs/comments.php',
		//__DIR__ . '/includes/functions.php',
		//__DIR__ . '/modules/Shout_Box/shout.php',
       //__DIR__ . '/modules/Your_Account/public/new_user1.php',
        //
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
	
	$rectorConfig->phpVersion(PhpVersion::PHP_81);
     //define sets of rules
        $rectorConfig->sets([
            LevelSetList::UP_TO_PHP_81,
			SetList::CODE_QUALITY,
			
        ]);


};
