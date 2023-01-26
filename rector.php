<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        //__DIR__ . '/Forums',
        //__DIR__ . '/admin',
        //__DIR__ . '/blocks',
        //__DIR__ . '/db', # DONE
        //__DIR__ . '/includes',
		//__DIR__ . '/includes',
        //__DIR__ . '/install', # DONE
        //__DIR__ . '/language',
        //__DIR__ . '/modules',
        //__DIR__ . '/themes',
		//__DIR__ . '/mainfile.php',
		//__DIR__ . '/setup', # DONE
		//__DIR__ . '/install.php', # DONE
		//__DIR__ . '/includes/db', # DONE
		//__DIR__ . '/includes/functions_selects.php', # DONE
		//__DIR__ . '/install.php', # DONE
		//__DIR__ . '/includes/classes/class.variables.php', # DONE
		//__DIR__ . '/modules/Evo_UserBlock', # DONE
		//__DIR__ . '/blocks', #done
		//__DIR__ . '/admin/modules/blocks.php', # DONE
		//__DIR__ . '/admin/modules/authors.php', # DONE
		//__DIR__ . '/admin/modules/messages.php', # DONE
		//__DIR__ . '/modules/Forums/admin/admin_users.php', # DONE
		//__DIR__ . '/modules/Arcade_Tweaks', # DONE
		//__DIR__ . '/newscore.php', # DONE
		//__DIR__ . '/includes/classes/class.cache.php',
		//__DIR__ . '/modules/Forums/attach_mod/includes/functions_admin.php',
		//__DIR__ . '/modules/Forums/admin/admin_logs.php',
		//__DIR__ . '/modules/Private_Messages',
		//__DIR__ . '/modules/Forums/groupmsg.php',
		//__DIR__ . '/includes/emailer.php',
		//__DIR__ . '/modules/Forums/reputation.php',
		//__DIR__ . '/modules/Forums/search.php',
		//__DIR__ . '/admin/modules/backup.php',
		//__DIR__ . '/includes/classes/class.database.php',
		//__DIR__ . '/modules/Blogs/associates.php',
		//__DIR__ . '/install/functions.php',
		//__DIR__ . '/install.php',
		//__DIR__ . '/install/file.inc',
		//__DIR__ . '/modules/Statistics/functions.php',
		//__DIR__ . '/modules/Forums/comments_list.php',
		//__DIR__ . '/modules/Forums/comments.php',
		//__DIR__ . '/admin/modules/settings/graphicadmin.php',
		//__DIR__ . '/admin/modules/sommaire.php',
		  __DIR__ . '/modules/Evo_UserBlock/admin/includes/functions.php',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

        $rectorConfig->sets([
            LevelSetList::UP_TO_PHP_81
        ]);
};
