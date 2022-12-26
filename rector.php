<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\ValueObject\PhpVersion;

use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;

use Rector\CodeQuality\Rector\FuncCall\AddPregQuoteDelimiterRector;

use Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector;

use Rector\CodeQuality\Rector\FuncCall\ArrayKeysAndInArrayToArrayKeyExistsRector;

use Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector;

use Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector;

use Rector\CodeQuality\Rector\FuncCall\BoolvalToTypeCastRector;

use Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector;

use Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector;

use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;

use Rector\CodeQuality\Rector\FuncCall\FloatvalToTypeCastRector;

use Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector;

use Rector\CodeQuality\Rector\For_\ForToForeachRector;

use Rector\CodeQuality\Rector\Foreach_\ForeachItemsAssignToEmptyArrayToAssignRector;

use Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector;

use Rector\CodeQuality\Rector\FuncCall\IntvalToTypeCastRector;

use Rector\CodeQuality\Rector\FuncCall\IsAWithStringWithThirdArgumentRector;

use Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector;

use Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector;

use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;

use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToArrayFilterRector;

use Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector;

use Rector\CodeQuality\Rector\FuncCall\SimplifyFuncGetArgsCountRector;

use Rector\CodeQuality\Rector\FuncCall\SimplifyInArrayValuesRector;

use Rector\CodeQuality\Rector\FuncCall\SimplifyRegexPatternRector;

use Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector;

use Rector\CodeQuality\Rector\FuncCall\StrvalToTypeCastRector;

use Rector\CodeQuality\Rector\Ternary\TernaryEmptyArrayArrayDimFetchToCoalesceRector;

use Rector\CodeQuality\Rector\Expression\TernaryFalseExpressionToIfRector;

use Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector;

use Rector\CodingStyle\Rector\Class_\AddArrayDefaultToArrayPropertyRector;

use Rector\CodingStyle\Rector\Property\AddFalseDefaultToBoolPropertyRector;

use Rector\CodingStyle\Rector\FuncCall\CallUserFuncArrayToVariadicRector;

use Rector\CodingStyle\Rector\FuncCall\ConsistentImplodeRector;

use Rector\CodingStyle\Rector\FuncCall\CountArrayToEmptyArrayComparisonRector;

use Rector\CodingStyle\Rector\If_\NullableCompareToNullRector;

use Rector\CodingStyle\Rector\ArrowFunction\StaticArrowFunctionRector;

use Rector\CodingStyle\Rector\Ternary\TernaryConditionVariableAssignmentRector;

use Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector;

use Rector\Compatibility\Rector\Class_\AttributeCompatibleAnnotationRector;

use Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector;

use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;

use Rector\MysqlToMysqli\Rector\Assign\MysqlAssignToMysqliRector;
use Rector\MysqlToMysqli\Rector\FuncCall\MysqlFuncCallToMysqliRector;

use Rector\Php53\Rector\Variable\ReplaceHttpServerVarsByServerRector;

use Rector\Php53\Rector\Ternary\TernaryToElvisRector;

use Rector\Php54\Rector\Array_\LongArrayToShortArrayRector;

use Rector\Php55\Rector\FuncCall\PregReplaceEModifierRector;

use Rector\Php56\Rector\FunctionLike\AddDefaultValueForUndefinedVariableRector;

use Rector\Php70\Rector\FuncCall\CallUserMethodRector;

use Rector\Php70\Rector\List_\EmptyListRector;

use Rector\Php70\Rector\FuncCall\EregToPregMatchRector;

use Rector\Php70\Rector\FuncCall\NonVariableToVariableOnFunctionCallRector;

use Rector\Php70\Rector\FuncCall\RandomFunctionRector;

use Rector\Php70\Rector\Ternary\TernaryToNullCoalescingRector;

use Rector\Php71\Rector\Assign\AssignArrayToStringRector;

use Rector\Php71\Rector\FuncCall\CountOnNullRector;

use Rector\Php72\Rector\FuncCall\GetClassOnNullRector;

use Rector\Php72\Rector\Assign\ListEachRector;

use Rector\Php72\Rector\Assign\ReplaceEachAssignmentWithKeyCurrentRector;

use Rector\Php72\Rector\FuncCall\StringifyDefineRector;

use Rector\Php72\Rector\FuncCall\StringsAssertNakedRector;

use Rector\Php72\Rector\Unset_\UnsetCastRector;

use Rector\Php72\Rector\While_\WhileEachToForeachRector;

use Rector\Php73\Rector\BooleanOr\IsCountableRector;

use Rector\Php73\Rector\FuncCall\JsonThrowOnErrorRector;

use Rector\Php73\Rector\FuncCall\RegexDashEscapeRector;

use Rector\Php73\Rector\FuncCall\SetCookieRector;

use Rector\Php73\Rector\FuncCall\StringifyStrNeedlesRector;

use Rector\Php74\Rector\ArrayDimFetch\CurlyToSquareBracketArrayStringRector;

use Rector\Php74\Rector\FuncCall\FilterVarToAddSlashesRector;

use Rector\Php74\Rector\FuncCall\MbStrrposEncodingArgumentPositionRector;

use Rector\Php74\Rector\Assign\NullCoalescingOperatorRector;

use Rector\Php74\Rector\Ternary\ParenthesizeNestedTernaryRector;

use Rector\Php74\Rector\Double\RealToFloatTypeCastRector;

use Rector\Php74\Rector\Property\RestoreDefaultNullToNullableTypePropertyRector;

use Rector\Php80\Rector\ClassMethod\AddParamBasedOnParentClassMethodRector;

use Rector\Php80\Rector\NotIdentical\StrContainsRector;

use Rector\Php80\Rector\Identical\StrEndsWithRector;
use Rector\Php80\Rector\Identical\StrStartsWithRector;

use Rector\Php80\Rector\Class_\StringableForToStringRector;

use Rector\Php80\Rector\FuncCall\TokenGetAllToObjectRector;

use Rector\Php80\Rector\FunctionLike\UnionTypesRector;

use Rector\Php81\Rector\Class_\ConstantListClassToEnumRector;

use Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector;

use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;






# special add 1 ConsistentPregDelimiterRector
use Rector\CodingStyle\Rector\FuncCall\ConsistentPregDelimiterRector;






use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector;
//addded
use Rector\TypeDeclaration\Rector\ClassMethod\AddMethodCallBasedStrictParamTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeBasedOnPHPUnitDataProviderRector;

return static function (RectorConfig $rectorConfig): void 
{
	$rectorConfig->skip([
        //__DIR__ . '/src/SingleFile.php',
        __DIR__ . '/assets',
        //__DIR__ . '/blocks',
        __DIR__ . '/install',
		//__DIR__ . '/modules/Forums',
		//__DIR__ . '/modules/Advertising',
		//__DIR__ . '/modules/Arcade_Tweaks',
		//__DIR__ . '/modules/Blog_Submit',
		//__DIR__ . '/modules/Blog_Topics',
		//__DIR__ . '/modules/Blogs',
		//__DIR__ . '/modules/Blogs_Top',
		//__DIR__ . '/modules/Bookmarks',
		//__DIR__ . '/modules/Cemetery',
		//__DIR__ . '/modules/cPanel_Login',
		//__DIR__ . '/modules/CSS_Color_Chart',
		//__DIR__ . '/modules/CSS_Reference',
		//__DIR__ . '/modules/Docs',
		//__DIR__ . '/modules/Donations',
		//__DIR__ . '/modules/ECalendar',
		//__DIR__ . '/modules/Evo_UserBlock',
		//__DIR__ . '/modules/FAQ',
		//__DIR__ . '/modules/Feedback',
		//__DIR__ . '/modules/File_Repository',
		//__DIR__ . '/modules/Google-Site-Map',
		//__DIR__ . '/modules/Groups',
		//__DIR__ . '/modules/HTML_Newsletter',
		//__DIR__ . '/modules/HTML_to_PHP',
		//__DIR__ . '/modules/Image_Repository',
		//__DIR__ . '/modules/Link_Us',
		//__DIR__ . '/modules/Loan_Amortization',
		//__DIR__ . '/modules/Member_List',
		//__DIR__ . '/modules/My_Forum_Topics',
		//__DIR__ . '/modules/Network',
		//__DIR__ . '/modules/Network_Advertising',
		//__DIR__ . '/modules/Network_Projects',
		//__DIR__ . '/modules/NukeSentinel',
		//__DIR__ . '/modules/Private_Messages',
		//__DIR__ . '/modules/Profile',
		//__DIR__ . '/modules/Proof_Of_God',
		//__DIR__ . '/modules/Recommend_Us',
		//__DIR__ . '/modules/Reviews',
		//__DIR__ . '/modules/Search',
		//__DIR__ . '/modules/Shout_Box',
		//__DIR__ . '/modules/Spambot_Killer',
		//__DIR__ . '/modules/Statistics',
		//__DIR__ . '/modules/Surveys',
		//__DIR__ . '/modules/Titanium_SandBox',
		//__DIR__ . '/modules/Web_Links',
		//__DIR__ . '/modules/Your_Account',
		//__DIR__ . '/admin',
		//__DIR__ . '/includes',
		//__DIR__ . '/themes',
		//__DIR__ . '/dev_modules',
		//__DIR__ . '/cgi-bin',
		//__DIR__ . '/.well-known',
		__DIR__ . '/vendor',
        // or use fnmatch
        //__DIR__ . '/src/*/Tests/*',
    ]);
	
	$rectorConfig->paths([
	    //__DIR__ . '/includes/functions_mods_settings.php',
		//__DIR__ . '/includes/usercp_register.php',
		//__DIR__ . '/includes/sessions.php',
		//__DIR__ . '/includes/bbcode.php',
		//__DIR__ . '/includes/template.php', RECTOR DOES NOT SEE SHIT
        //__DIR__ . '/admin',
		//__DIR__ . '/admin/modules/index.php', RECTOR DOES NOT SEE SHIT
		//__DIR__ . '/admin/modules/menu.php',
        //__DIR__ . '/images',
        //__DIR__ . '/mainfile.php',
        //__DIR__ . '/index.php',
		//__DIR__ . '/includes/Facebook/FacebookApp.php',
		//_DIR__ . '/includes/usercp_register.php', DONE
		//__DIR__ . '/includes/classes/class.variables.php',
		//__DIR__ . '/includes/nukesentinel.php', 
		//__DIR__ . '/includes/functions_report.php', 
		//__DIR__ . '/includes/viewtopic_quickreply.php', 
		//__DIR__ . '/includes/classes/class.cache.php',
		//__DIR__ . '/includes/functions_evo_custom.php',
		//__DIR__ . '/includes/functions_search.php', RECTOR DOES NOT SEE ANYTHING TO REFACTOR
		//__DIR__ . '/modules/Forums/glance.php',
		//__DIR__ . '/modules/Members_List/index.php',
		//__DIR__ . '/modules/Forums/search.php',
		//__DIR__ . '/modules/Forums/stats_mod/includes/constants.php', #nada
		//__DIR__ . '/modules/Forums/stats_mod/includes/lang_functions.php', #nada
		//__DIR__ . '/modules/Forums/stats_mod/includes/stat_functions.php', #nada
		//__DIR__ . '/modules/Forums/stats_mod/includes/template.php', #nada		
		//__DIR__ . '/modules/Forums/stats_mod/core.php', #nada		
		//__DIR__ . '/modules/Forums/stats_mod/db_cache.php', #nada		
		__DIR__ . '/modules/Forums/stats_mod/functions.php', #nada		
		//__DIR__ . '/modules/Blogs_Top/index.php',
		//__DIR__ . '/modules/Blogs/categories.php',
		//__DIR__ . '/modules/Forums/attach_mod/includes/functions_attach.php',
		//__DIR__ . '/modules/Forums/attach_mod/displaying.php',
		//__DIR__ . '/modules/Private_Messages/index.php',
		//__DIR__ . '/modules/Forums/index.php',
		//__DIR__ . '/modules/Forums/attach_mod/includes/functions_includes.php', DONE FIXED
		//__DIR__ . '/modules/Forums/viewtopic.php', ERROR AFTER REFACTOR
		//__DIR__ . '/blocks/block-Titanium_Portal_Menu.php',
		//__DIR__ . '/includes/functions_post.php',
		//__DIR__ . '/modules/Shout_Box/shout.php',
       //__DIR__ . '/modules/Your_Account/public/new_user1.php',
	   //__DIR__ . '/modules/Forums/posting.php',
        //
    ]);

    # special add 1 ConsistentPregDelimiterRector
    $rectorConfig->ruleWithConfiguration(ConsistentPregDelimiterRector::class, [
        ConsistentPregDelimiterRector::DELIMITER => '#',
    ]);
    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
	
	$rectorConfig->phpVersion(PhpVersion::PHP_81);
     //define sets of rules
        $rectorConfig->sets([
            LevelSetList::UP_TO_PHP_82,
			SetList::CODE_QUALITY,
			
        ]);


};

?>