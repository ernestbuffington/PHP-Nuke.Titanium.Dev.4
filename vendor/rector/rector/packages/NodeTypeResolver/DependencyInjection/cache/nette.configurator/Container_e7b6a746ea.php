<?php
// source: phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/conf/config.neon
// source: /home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/static-reflection.neon
// source: /home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/better-infer.neon
// source: /home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/parser.neon
// source: array

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_e7b6a746ea extends _PHPStan_4dd92cd93\Nette\DI\Container
{
	protected $tags = [
		'phpstan.parser.richParserNodeVisitor' => [
			'04' => true,
			'05' => true,
			'06' => true,
			'07' => true,
			'09' => true,
			'010' => true,
			'011' => true,
			'012' => true,
			'013' => true,
			'067' => true,
		],
		'phpstan.stubFilesExtension' => ['033' => true],
		'phpstan.broker.methodsClassReflectionExtension' => ['084' => true, '088' => true],
		'phpstan.broker.propertiesClassReflectionExtension' => ['085' => true, '090' => true, '0206' => true],
		'phpstan.broker.allowedSubTypesClassReflectionExtension' => ['089' => true],
		'phpstan.broker.dynamicFunctionReturnTypeExtension' => [
			'0139' => true,
			'0140' => true,
			'0141' => true,
			'0142' => true,
			'0143' => true,
			'0144' => true,
			'0145' => true,
			'0146' => true,
			'0147' => true,
			'0148' => true,
			'0149' => true,
			'0151' => true,
			'0152' => true,
			'0153' => true,
			'0154' => true,
			'0155' => true,
			'0156' => true,
			'0157' => true,
			'0158' => true,
			'0159' => true,
			'0160' => true,
			'0161' => true,
			'0162' => true,
			'0163' => true,
			'0164' => true,
			'0165' => true,
			'0167' => true,
			'0168' => true,
			'0169' => true,
			'0170' => true,
			'0174' => true,
			'0175' => true,
			'0177' => true,
			'0178' => true,
			'0179' => true,
			'0181' => true,
			'0184' => true,
			'0185' => true,
			'0191' => true,
			'0192' => true,
			'0193' => true,
			'0194' => true,
			'0195' => true,
			'0196' => true,
			'0197' => true,
			'0198' => true,
			'0208' => true,
			'0211' => true,
			'0212' => true,
			'0213' => true,
			'0214' => true,
			'0215' => true,
			'0217' => true,
			'0218' => true,
			'0219' => true,
			'0220' => true,
			'0221' => true,
			'0222' => true,
			'0223' => true,
			'0224' => true,
			'0225' => true,
			'0226' => true,
			'0227' => true,
			'0228' => true,
			'0229' => true,
			'0230' => true,
			'0231' => true,
			'0232' => true,
			'0234' => true,
			'0235' => true,
			'0236' => true,
			'0237' => true,
			'0238' => true,
			'0239' => true,
			'0240' => true,
			'0241' => true,
			'0244' => true,
			'0253' => true,
			'0257' => true,
			'0258' => true,
			'0261' => true,
			'0262' => true,
			'0263' => true,
			'0264' => true,
			'0265' => true,
			'0266' => true,
		],
		'phpstan.typeSpecifier.functionTypeSpecifyingExtension' => [
			'0150' => true,
			'0166' => true,
			'0176' => true,
			'0205' => true,
			'0209' => true,
			'0210' => true,
			'0242' => true,
			'0243' => true,
			'0245' => true,
			'0246' => true,
			'0247' => true,
			'0248' => true,
			'0249' => true,
			'0250' => true,
			'0251' => true,
			'0252' => true,
			'0254' => true,
			'0256' => true,
		],
		'phpstan.broker.dynamicStaticMethodReturnTypeExtension' => [
			'0171' => true,
			'0173' => true,
			'0183' => true,
			'0267' => true,
			'0273' => true,
		],
		'phpstan.broker.dynamicMethodReturnTypeExtension' => [
			'0172' => true,
			'0180' => true,
			'0186' => true,
			'0187' => true,
			'0190' => true,
			'0208' => true,
			'0233' => true,
			'0259' => true,
			'0260' => true,
			'0267' => true,
			'0268' => true,
			'0269' => true,
			'0270' => true,
			'0271' => true,
			'0272' => true,
		],
		'phpstan.dynamicStaticMethodThrowTypeExtension' => [
			'0182' => true,
			'0188' => true,
			'0189' => true,
			'0201' => true,
			'0202' => true,
			'0203' => true,
			'0204' => true,
			'0207' => true,
		],
		'phpstan.dynamicFunctionThrowTypeExtension' => ['0199' => true, '0200' => true],
		'phpstan.typeSpecifier.methodTypeSpecifyingExtension' => ['0216' => true],
		'phpstan.rules.rule' => ['rules.0' => true, 'rules.1' => true],
	];

	protected $types = ['container' => '_PHPStan_4dd92cd93\Nette\DI\Container'];
	protected $aliases = [];

	protected $wiring = [
		'_PHPStan_4dd92cd93\Nette\DI\Container' => [['container']],
		'PHPStan\Rules\Rule' => [['0105', '0106', '0108', '0109', '0122'], ['rules.0', 'rules.1']],
		'PHPStan\Rules\Debug\DumpTypeRule' => [['rules.0']],
		'PHPStan\Rules\Debug\FileAssertRule' => [['rules.1']],
		'PhpParser\BuilderFactory' => [['01']],
		'PHPStan\Parser\LexerFactory' => [['02']],
		'PhpParser\NodeVisitorAbstract' => [
			['03', '04', '05', '06', '07', '08', '09', '010', '011', '012', '013', '055', '067', '076'],
		],
		'PhpParser\NodeVisitor' => [
			['03', '04', '05', '06', '07', '08', '09', '010', '011', '012', '013', '055', '067', '076'],
		],
		'PhpParser\NodeVisitor\NameResolver' => [['03']],
		'PHPStan\Parser\ArrayFilterArgVisitor' => [['04']],
		'PHPStan\Parser\ArrayMapArgVisitor' => [['05']],
		'PHPStan\Parser\ArrayWalkArgVisitor' => [['06']],
		'PHPStan\Parser\ClosureArgVisitor' => [['07']],
		'PHPStan\Parser\CurlSetOptArgVisitor' => [['08']],
		'PHPStan\Parser\ArrowFunctionArgVisitor' => [['09']],
		'PHPStan\Parser\NewAssignedToPropertyVisitor' => [['010']],
		'PHPStan\Parser\ParentStmtTypesVisitor' => [['011']],
		'PHPStan\Parser\TryCatchTypeVisitor' => [['012']],
		'PhpParser\NodeVisitor\NodeConnectingVisitor' => [['013']],
		'PHPStan\Node\Printer\ExprPrinter' => [['014']],
		'PhpParser\PrettyPrinter\Standard' => [['015']],
		'PhpParser\PrettyPrinterAbstract' => [['015']],
		'PHPStan\Node\Printer\Printer' => [['015']],
		'PHPStan\Broker\AnonymousClassNameHelper' => [['016']],
		'PHPStan\Php\PhpVersion' => [['017']],
		'PHPStan\Php\PhpVersionFactory' => [['018']],
		'PHPStan\Php\PhpVersionFactoryFactory' => [['019']],
		'PHPStan\PhpDocParser\Lexer\Lexer' => [['020']],
		'PHPStan\PhpDocParser\Parser\TypeParser' => [['021']],
		'PHPStan\PhpDocParser\Parser\ConstExprParser' => [['022']],
		'PHPStan\PhpDocParser\Parser\PhpDocParser' => [['023']],
		'PHPStan\PhpDoc\ConstExprParserFactory' => [['024']],
		'PHPStan\PhpDoc\PhpDocInheritanceResolver' => [['025']],
		'PHPStan\PhpDoc\PhpDocNodeResolver' => [['026']],
		'PHPStan\PhpDoc\PhpDocStringResolver' => [['027']],
		'PHPStan\PhpDoc\ConstExprNodeResolver' => [['028']],
		'PHPStan\PhpDoc\TypeNodeResolver' => [['029']],
		'PHPStan\PhpDoc\TypeNodeResolverExtensionRegistryProvider' => [['030']],
		'PHPStan\PhpDoc\TypeStringResolver' => [['031']],
		'PHPStan\PhpDoc\StubValidator' => [['032']],
		'PHPStan\PhpDoc\StubFilesExtension' => [['033']],
		'PHPStan\PhpDoc\CountableStubFilesExtension' => [['033']],
		'PHPStan\PhpDoc\StubFilesProvider' => [['034']],
		'PHPStan\PhpDoc\DefaultStubFilesProvider' => [['034']],
		'PHPStan\Analyser\Analyser' => [['035']],
		'PHPStan\Analyser\FileAnalyser' => [['036']],
		'PHPStan\Analyser\RuleErrorTransformer' => [['037']],
		'PHPStan\Analyser\IgnoredErrorHelper' => [['038']],
		'PHPStan\Analyser\InternalScopeFactory' => [['039']],
		'PHPStan\Analyser\LazyInternalScopeFactory' => [['039']],
		'PHPStan\Analyser\ScopeFactory' => [['040']],
		'PHPStan\Analyser\NodeScopeResolver' => [['041']],
		'PHPStan\Analyser\ConstantResolver' => [['042']],
		'PHPStan\Analyser\ConstantResolverFactory' => [['043']],
		'PHPStan\Analyser\ResultCache\ResultCacheManagerFactory' => [['044']],
		'PHPStan\Analyser\ResultCache\ResultCacheClearer' => [['045']],
		'PHPStan\Cache\Cache' => [['046']],
		'PHPStan\Collectors\Registry' => [['047']],
		'PHPStan\Collectors\RegistryFactory' => [['048']],
		'PHPStan\Command\AnalyseApplication' => [['049']],
		'PHPStan\Command\AnalyserRunner' => [['050']],
		'PHPStan\Command\FixerApplication' => [['051']],
		'PHPStan\Dependency\DependencyResolver' => [['052']],
		'PHPStan\Dependency\ExportedNodeFetcher' => [['053']],
		'PHPStan\Dependency\ExportedNodeResolver' => [['054']],
		'PHPStan\Dependency\ExportedNodeVisitor' => [['055']],
		'PHPStan\DependencyInjection\Container' => [['056'], ['057']],
		'PHPStan\DependencyInjection\Nette\NetteContainer' => [['057']],
		'PHPStan\DependencyInjection\DerivativeContainerFactory' => [['058']],
		'PHPStan\DependencyInjection\Reflection\ClassReflectionExtensionRegistryProvider' => [['059']],
		'PHPStan\DependencyInjection\Type\DynamicReturnTypeExtensionRegistryProvider' => [['060']],
		'PHPStan\DependencyInjection\Type\OperatorTypeSpecifyingExtensionRegistryProvider' => [['061']],
		'PHPStan\DependencyInjection\Type\DynamicThrowTypeExtensionProvider' => [['062']],
		'PHPStan\File\FileHelper' => [['063']],
		'PHPStan\File\FileExcluderFactory' => [['064']],
		'PHPStan\File\FileExcluderRawFactory' => [['065']],
		'PHPStan\File\FileExcluder' => [2 => ['fileExcluderAnalyse', 'fileExcluderScan']],
		'PHPStan\File\FileFinder' => [2 => ['fileFinderAnalyse', 'fileFinderScan']],
		'PHPStan\File\FileMonitor' => [['066']],
		'PHPStan\NodeVisitor\StatementOrderVisitor' => [['067']],
		'PHPStan\Parallel\ParallelAnalyser' => [['068']],
		'PHPStan\Parallel\Scheduler' => [['069']],
		'PHPStan\Parser\FunctionCallStatementFinder' => [['070']],
		'PHPStan\Process\CpuCoreCounter' => [['071']],
		'PHPStan\Reflection\FunctionReflectionFactory' => [['072']],
		'PHPStan\Reflection\InitializerExprTypeResolver' => [['073']],
		'PHPStan\Reflection\MethodsClassReflectionExtension' => [['074', '084', '086', '088']],
		'PHPStan\Reflection\Annotations\AnnotationsMethodsClassReflectionExtension' => [['074']],
		'PHPStan\Reflection\PropertiesClassReflectionExtension' => [['075', '085', '086', '090', '0206']],
		'PHPStan\Reflection\Annotations\AnnotationsPropertiesClassReflectionExtension' => [['075']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\CachingVisitor' => [['076']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\FileNodesFetcher' => [['077']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\ComposerJsonAndInstalledJsonSourceLocatorMaker' => [['078']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedDirectorySourceLocatorFactory' => [['079']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedDirectorySourceLocatorRepository' => [['080']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedPsrAutoloaderLocatorFactory' => [['081']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocatorFactory' => [['082']],
		'PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocatorRepository' => [['083']],
		'PHPStan\Reflection\Mixin\MixinMethodsClassReflectionExtension' => [['084']],
		'PHPStan\Reflection\Mixin\MixinPropertiesClassReflectionExtension' => [['085']],
		'PHPStan\Reflection\Php\PhpClassReflectionExtension' => [['086']],
		'PHPStan\Reflection\Php\PhpMethodReflectionFactory' => [['087']],
		'PHPStan\Reflection\Php\Soap\SoapClientMethodsClassReflectionExtension' => [['088']],
		'PHPStan\Reflection\AllowedSubTypesClassReflectionExtension' => [['089']],
		'PHPStan\Reflection\Php\EnumAllowedSubTypesClassReflectionExtension' => [['089']],
		'PHPStan\Reflection\Php\UniversalObjectCratesClassReflectionExtension' => [['090']],
		'PHPStan\Reflection\ReflectionProvider\ReflectionProviderProvider' => [['091']],
		'PHPStan\Reflection\SignatureMap\NativeFunctionReflectionProvider' => [['092']],
		'PHPStan\Reflection\SignatureMap\SignatureMapParser' => [['093']],
		'PHPStan\Reflection\SignatureMap\SignatureMapProvider' => [['097'], ['094', '095']],
		'PHPStan\Reflection\SignatureMap\FunctionSignatureMapProvider' => [['094']],
		'PHPStan\Reflection\SignatureMap\Php8SignatureMapProvider' => [['095']],
		'PHPStan\Reflection\SignatureMap\SignatureMapProviderFactory' => [['096']],
		'PHPStan\Rules\Api\ApiRuleHelper' => [['098']],
		'PHPStan\Rules\AttributesCheck' => [['099']],
		'PHPStan\Rules\Arrays\NonexistentOffsetInArrayDimFetchCheck' => [['0100']],
		'PHPStan\Rules\ClassCaseSensitivityCheck' => [['0101']],
		'PHPStan\Rules\Comparison\ConstantConditionRuleHelper' => [['0102']],
		'PHPStan\Rules\Comparison\ImpossibleCheckTypeHelper' => [['0103']],
		'PHPStan\Rules\Exceptions\ExceptionTypeResolver' => [1 => ['0104'], [1 => 'exceptionTypeResolver']],
		'PHPStan\Rules\Exceptions\DefaultExceptionTypeResolver' => [['0104']],
		'PHPStan\Rules\Exceptions\MissingCheckedExceptionInFunctionThrowsRule' => [['0105']],
		'PHPStan\Rules\Exceptions\MissingCheckedExceptionInMethodThrowsRule' => [['0106']],
		'PHPStan\Rules\Exceptions\MissingCheckedExceptionInThrowsCheck' => [['0107']],
		'PHPStan\Rules\Exceptions\TooWideFunctionThrowTypeRule' => [['0108']],
		'PHPStan\Rules\Exceptions\TooWideMethodThrowTypeRule' => [['0109']],
		'PHPStan\Rules\Exceptions\TooWideThrowTypeCheck' => [['0110']],
		'PHPStan\Rules\FunctionCallParametersCheck' => [['0111']],
		'PHPStan\Rules\FunctionDefinitionCheck' => [['0112']],
		'PHPStan\Rules\FunctionReturnTypeCheck' => [['0113']],
		'PHPStan\Rules\Generics\CrossCheckInterfacesHelper' => [['0114']],
		'PHPStan\Rules\Generics\GenericAncestorsCheck' => [['0115']],
		'PHPStan\Rules\Generics\GenericObjectTypeCheck' => [['0116']],
		'PHPStan\Rules\Generics\TemplateTypeCheck' => [['0117']],
		'PHPStan\Rules\Generics\VarianceCheck' => [['0118']],
		'PHPStan\Rules\IssetCheck' => [['0119']],
		'PHPStan\Rules\Methods\MethodCallCheck' => [['0120']],
		'PHPStan\Rules\Methods\StaticMethodCallCheck' => [['0121']],
		'PHPStan\Rules\Methods\MethodSignatureRule' => [['0122']],
		'PHPStan\Rules\Methods\MethodParameterComparisonHelper' => [['0123']],
		'PHPStan\Rules\MissingTypehintCheck' => [['0124']],
		'PHPStan\Rules\NullsafeCheck' => [['0125']],
		'PHPStan\Rules\Constants\AlwaysUsedClassConstantsExtensionProvider' => [['0126']],
		'PHPStan\Rules\Constants\LazyAlwaysUsedClassConstantsExtensionProvider' => [['0126']],
		'PHPStan\Rules\PhpDoc\ConditionalReturnTypeRuleHelper' => [['0127']],
		'PHPStan\Rules\PhpDoc\AssertRuleHelper' => [['0128']],
		'PHPStan\Rules\PhpDoc\UnresolvableTypeHelper' => [['0129']],
		'PHPStan\Rules\Properties\ReadWritePropertiesExtensionProvider' => [['0130']],
		'PHPStan\Rules\Properties\LazyReadWritePropertiesExtensionProvider' => [['0130']],
		'PHPStan\Rules\Properties\PropertyDescriptor' => [['0131']],
		'PHPStan\Rules\Properties\PropertyReflectionFinder' => [['0132']],
		'PHPStan\Rules\RuleLevelHelper' => [['0133']],
		'PHPStan\Rules\UnusedFunctionParametersCheck' => [['0134']],
		'PHPStan\Type\FileTypeMapper' => [['0135']],
		'PHPStan\Type\TypeAliasResolver' => [['0136']],
		'PHPStan\Type\TypeAliasResolverProvider' => [['0137']],
		'PHPStan\Type\BitwiseFlagHelper' => [['0138']],
		'PHPStan\Type\DynamicFunctionReturnTypeExtension' => [
			[
				'0139',
				'0140',
				'0141',
				'0142',
				'0143',
				'0144',
				'0145',
				'0146',
				'0147',
				'0148',
				'0149',
				'0151',
				'0152',
				'0153',
				'0154',
				'0155',
				'0156',
				'0157',
				'0158',
				'0159',
				'0160',
				'0161',
				'0162',
				'0163',
				'0164',
				'0165',
				'0167',
				'0168',
				'0169',
				'0170',
				'0174',
				'0175',
				'0177',
				'0178',
				'0179',
				'0181',
				'0184',
				'0185',
				'0191',
				'0192',
				'0193',
				'0194',
				'0195',
				'0196',
				'0197',
				'0198',
				'0208',
				'0211',
				'0212',
				'0213',
				'0214',
				'0215',
				'0217',
				'0218',
				'0219',
				'0220',
				'0221',
				'0222',
				'0223',
				'0224',
				'0225',
				'0226',
				'0227',
				'0228',
				'0229',
				'0230',
				'0231',
				'0232',
				'0234',
				'0235',
				'0236',
				'0237',
				'0238',
				'0239',
				'0240',
				'0241',
				'0244',
				'0253',
				'0257',
				'0258',
				'0261',
				'0262',
				'0263',
				'0264',
				'0265',
				'0266',
			],
		],
		'PHPStan\Type\Php\ArgumentBasedFunctionReturnTypeExtension' => [['0139']],
		'PHPStan\Type\Php\ArrayIntersectKeyFunctionReturnTypeExtension' => [['0140']],
		'PHPStan\Type\Php\ArrayChunkFunctionReturnTypeExtension' => [['0141']],
		'PHPStan\Type\Php\ArrayColumnFunctionReturnTypeExtension' => [['0142']],
		'PHPStan\Type\Php\ArrayCombineFunctionReturnTypeExtension' => [['0143']],
		'PHPStan\Type\Php\ArrayCurrentDynamicReturnTypeExtension' => [['0144']],
		'PHPStan\Type\Php\ArrayFillFunctionReturnTypeExtension' => [['0145']],
		'PHPStan\Type\Php\ArrayFillKeysFunctionReturnTypeExtension' => [['0146']],
		'PHPStan\Type\Php\ArrayFilterFunctionReturnTypeReturnTypeExtension' => [['0147']],
		'PHPStan\Type\Php\ArrayFlipFunctionReturnTypeExtension' => [['0148']],
		'PHPStan\Type\Php\ArrayKeyDynamicReturnTypeExtension' => [['0149']],
		'PHPStan\Type\FunctionTypeSpecifyingExtension' => [
			[
				'0150',
				'0166',
				'0176',
				'0205',
				'0209',
				'0210',
				'0242',
				'0243',
				'0245',
				'0246',
				'0247',
				'0248',
				'0249',
				'0250',
				'0251',
				'0252',
				'0254',
				'0256',
			],
		],
		'PHPStan\Analyser\TypeSpecifierAwareExtension' => [
			[
				'0150',
				'0166',
				'0176',
				'0205',
				'0209',
				'0210',
				'0216',
				'0242',
				'0243',
				'0245',
				'0246',
				'0247',
				'0248',
				'0249',
				'0250',
				'0251',
				'0252',
				'0254',
				'0256',
				'0258',
			],
		],
		'PHPStan\Type\Php\ArrayKeyExistsFunctionTypeSpecifyingExtension' => [['0150']],
		'PHPStan\Type\Php\ArrayKeyFirstDynamicReturnTypeExtension' => [['0151']],
		'PHPStan\Type\Php\ArrayKeyLastDynamicReturnTypeExtension' => [['0152']],
		'PHPStan\Type\Php\ArrayKeysFunctionDynamicReturnTypeExtension' => [['0153']],
		'PHPStan\Type\Php\ArrayMapFunctionReturnTypeExtension' => [['0154']],
		'PHPStan\Type\Php\ArrayMergeFunctionDynamicReturnTypeExtension' => [['0155']],
		'PHPStan\Type\Php\ArrayNextDynamicReturnTypeExtension' => [['0156']],
		'PHPStan\Type\Php\ArrayPopFunctionReturnTypeExtension' => [['0157']],
		'PHPStan\Type\Php\ArrayRandFunctionReturnTypeExtension' => [['0158']],
		'PHPStan\Type\Php\ArrayReduceFunctionReturnTypeExtension' => [['0159']],
		'PHPStan\Type\Php\ArrayReplaceFunctionReturnTypeExtension' => [['0160']],
		'PHPStan\Type\Php\ArrayReverseFunctionReturnTypeExtension' => [['0161']],
		'PHPStan\Type\Php\ArrayShiftFunctionReturnTypeExtension' => [['0162']],
		'PHPStan\Type\Php\ArraySliceFunctionReturnTypeExtension' => [['0163']],
		'PHPStan\Type\Php\ArraySpliceFunctionReturnTypeExtension' => [['0164']],
		'PHPStan\Type\Php\ArraySearchFunctionDynamicReturnTypeExtension' => [['0165']],
		'PHPStan\Type\Php\ArraySearchFunctionTypeSpecifyingExtension' => [['0166']],
		'PHPStan\Type\Php\ArrayValuesFunctionDynamicReturnTypeExtension' => [['0167']],
		'PHPStan\Type\Php\ArraySumFunctionDynamicReturnTypeExtension' => [['0168']],
		'PHPStan\Type\Php\Base64DecodeDynamicFunctionReturnTypeExtension' => [['0169']],
		'PHPStan\Type\Php\BcMathStringOrNullReturnTypeExtension' => [['0170']],
		'PHPStan\Type\DynamicStaticMethodReturnTypeExtension' => [['0171', '0173', '0183', '0267', '0273']],
		'PHPStan\Type\Php\ClosureBindDynamicReturnTypeExtension' => [['0171']],
		'PHPStan\Type\DynamicMethodReturnTypeExtension' => [
			[
				'0172',
				'0180',
				'0186',
				'0187',
				'0190',
				'0208',
				'0233',
				'0259',
				'0260',
				'0267',
				'0268',
				'0269',
				'0270',
				'0271',
				'0272',
			],
		],
		'PHPStan\Type\Php\ClosureBindToDynamicReturnTypeExtension' => [['0172']],
		'PHPStan\Type\Php\ClosureFromCallableDynamicReturnTypeExtension' => [['0173']],
		'PHPStan\Type\Php\CompactFunctionReturnTypeExtension' => [['0174']],
		'PHPStan\Type\Php\CountFunctionReturnTypeExtension' => [['0175']],
		'PHPStan\Type\Php\CountFunctionTypeSpecifyingExtension' => [['0176']],
		'PHPStan\Type\Php\CurlGetinfoFunctionDynamicReturnTypeExtension' => [['0177']],
		'PHPStan\Type\Php\CurlInitReturnTypeExtension' => [['0178']],
		'PHPStan\Type\Php\DateFormatFunctionReturnTypeExtension' => [['0179']],
		'PHPStan\Type\Php\DateFormatMethodReturnTypeExtension' => [['0180']],
		'PHPStan\Type\Php\DateFunctionReturnTypeExtension' => [['0181']],
		'PHPStan\Type\DynamicStaticMethodThrowTypeExtension' => [
			['0182', '0188', '0189', '0201', '0202', '0203', '0204', '0207'],
		],
		'PHPStan\Type\Php\DateIntervalConstructorThrowTypeExtension' => [['0182']],
		'PHPStan\Type\Php\DateIntervalDynamicReturnTypeExtension' => [['0183']],
		'PHPStan\Type\Php\DateTimeCreateDynamicReturnTypeExtension' => [['0184']],
		'PHPStan\Type\Php\DateTimeDynamicReturnTypeExtension' => [['0185']],
		'PHPStan\Type\Php\DateTimeModifyReturnTypeExtension' => [['0186', '0187']],
		'PHPStan\Type\Php\DateTimeConstructorThrowTypeExtension' => [['0188']],
		'PHPStan\Type\Php\DateTimeZoneConstructorThrowTypeExtension' => [['0189']],
		'PHPStan\Type\Php\DsMapDynamicReturnTypeExtension' => [['0190']],
		'PHPStan\Type\Php\DioStatDynamicFunctionReturnTypeExtension' => [['0191']],
		'PHPStan\Type\Php\ExplodeFunctionDynamicReturnTypeExtension' => [['0192']],
		'PHPStan\Type\Php\FilterVarDynamicReturnTypeExtension' => [['0193']],
		'PHPStan\Type\Php\GetCalledClassDynamicReturnTypeExtension' => [['0194']],
		'PHPStan\Type\Php\GetClassDynamicReturnTypeExtension' => [['0195']],
		'PHPStan\Type\Php\GetParentClassDynamicFunctionReturnTypeExtension' => [['0196']],
		'PHPStan\Type\Php\GettimeofdayDynamicFunctionReturnTypeExtension' => [['0197']],
		'PHPStan\Type\Php\HashFunctionsReturnTypeExtension' => [['0198']],
		'PHPStan\Type\DynamicFunctionThrowTypeExtension' => [['0199', '0200']],
		'PHPStan\Type\Php\IntdivThrowTypeExtension' => [['0199']],
		'PHPStan\Type\Php\JsonThrowTypeExtension' => [['0200']],
		'PHPStan\Type\Php\ReflectionClassConstructorThrowTypeExtension' => [['0201']],
		'PHPStan\Type\Php\ReflectionFunctionConstructorThrowTypeExtension' => [['0202']],
		'PHPStan\Type\Php\ReflectionMethodConstructorThrowTypeExtension' => [['0203']],
		'PHPStan\Type\Php\ReflectionPropertyConstructorThrowTypeExtension' => [['0204']],
		'PHPStan\Type\Php\StrContainingTypeSpecifyingExtension' => [['0205']],
		'PHPStan\Type\Php\SimpleXMLElementClassPropertyReflectionExtension' => [['0206']],
		'PHPStan\Type\Php\SimpleXMLElementConstructorThrowTypeExtension' => [['0207']],
		'PHPStan\Type\Php\StatDynamicReturnTypeExtension' => [['0208']],
		'PHPStan\Type\Php\MethodExistsTypeSpecifyingExtension' => [['0209']],
		'PHPStan\Type\Php\PropertyExistsTypeSpecifyingExtension' => [['0210']],
		'PHPStan\Type\Php\MinMaxFunctionReturnTypeExtension' => [['0211']],
		'PHPStan\Type\Php\NumberFormatFunctionDynamicReturnTypeExtension' => [['0212']],
		'PHPStan\Type\Php\PathinfoFunctionDynamicReturnTypeExtension' => [['0213']],
		'PHPStan\Type\Php\PregFilterFunctionReturnTypeExtension' => [['0214']],
		'PHPStan\Type\Php\PregSplitDynamicReturnTypeExtension' => [['0215']],
		'PHPStan\Type\MethodTypeSpecifyingExtension' => [['0216']],
		'PHPStan\Type\Php\ReflectionClassIsSubclassOfTypeSpecifyingExtension' => [['0216']],
		'PHPStan\Type\Php\ReplaceFunctionsDynamicReturnTypeExtension' => [['0217']],
		'PHPStan\Type\Php\ArrayPointerFunctionsDynamicReturnTypeExtension' => [['0218']],
		'PHPStan\Type\Php\LtrimFunctionReturnTypeExtension' => [['0219']],
		'PHPStan\Type\Php\MbFunctionsReturnTypeExtension' => [['0220']],
		'PHPStan\Type\Php\MbConvertEncodingFunctionReturnTypeExtension' => [['0221']],
		'PHPStan\Type\Php\MbSubstituteCharacterDynamicReturnTypeExtension' => [['0222']],
		'PHPStan\Type\Php\MbStrlenFunctionReturnTypeExtension' => [['0223']],
		'PHPStan\Type\Php\MicrotimeFunctionReturnTypeExtension' => [['0224']],
		'PHPStan\Type\Php\HrtimeFunctionReturnTypeExtension' => [['0225']],
		'PHPStan\Type\Php\ImplodeFunctionReturnTypeExtension' => [['0226']],
		'PHPStan\Type\Php\NonEmptyStringFunctionsReturnTypeExtension' => [['0227']],
		'PHPStan\Type\Php\StrCaseFunctionsReturnTypeExtension' => [['0228']],
		'PHPStan\Type\Php\StrlenFunctionReturnTypeExtension' => [['0229']],
		'PHPStan\Type\Php\StrPadFunctionReturnTypeExtension' => [['0230']],
		'PHPStan\Type\Php\StrRepeatFunctionReturnTypeExtension' => [['0231']],
		'PHPStan\Type\Php\SubstrDynamicReturnTypeExtension' => [['0232']],
		'PHPStan\Type\Php\ThrowableReturnTypeExtension' => [['0233']],
		'PHPStan\Type\Php\ParseUrlFunctionDynamicReturnTypeExtension' => [['0234']],
		'PHPStan\Type\Php\TriggerErrorDynamicReturnTypeExtension' => [['0235']],
		'PHPStan\Type\Php\VersionCompareFunctionDynamicReturnTypeExtension' => [['0236']],
		'PHPStan\Type\Php\PowFunctionReturnTypeExtension' => [['0237']],
		'PHPStan\Type\Php\RoundFunctionReturnTypeExtension' => [['0238']],
		'PHPStan\Type\Php\StrtotimeFunctionReturnTypeExtension' => [['0239']],
		'PHPStan\Type\Php\RandomIntFunctionReturnTypeExtension' => [['0240']],
		'PHPStan\Type\Php\RangeFunctionReturnTypeExtension' => [['0241']],
		'PHPStan\Type\Php\AssertFunctionTypeSpecifyingExtension' => [['0242']],
		'PHPStan\Type\Php\ClassExistsFunctionTypeSpecifyingExtension' => [['0243']],
		'PHPStan\Type\Php\ClassImplementsFunctionReturnTypeExtension' => [['0244']],
		'PHPStan\Type\Php\DefineConstantTypeSpecifyingExtension' => [['0245']],
		'PHPStan\Type\Php\DefinedConstantTypeSpecifyingExtension' => [['0246']],
		'PHPStan\Type\Php\FunctionExistsFunctionTypeSpecifyingExtension' => [['0247']],
		'PHPStan\Type\Php\InArrayFunctionTypeSpecifyingExtension' => [['0248']],
		'PHPStan\Type\Php\IsArrayFunctionTypeSpecifyingExtension' => [['0249']],
		'PHPStan\Type\Php\IsCallableFunctionTypeSpecifyingExtension' => [['0250']],
		'PHPStan\Type\Php\IsIterableFunctionTypeSpecifyingExtension' => [['0251']],
		'PHPStan\Type\Php\IsSubclassOfFunctionTypeSpecifyingExtension' => [['0252']],
		'PHPStan\Type\Php\IteratorToArrayFunctionReturnTypeExtension' => [['0253']],
		'PHPStan\Type\Php\IsAFunctionTypeSpecifyingExtension' => [['0254']],
		'PHPStan\Type\Php\IsAFunctionTypeSpecifyingHelper' => [['0255']],
		'PHPStan\Type\Php\CtypeDigitFunctionTypeSpecifyingExtension' => [['0256']],
		'PHPStan\Type\Php\JsonThrowOnErrorDynamicReturnTypeExtension' => [['0257']],
		'PHPStan\Type\Php\TypeSpecifyingFunctionsDynamicReturnTypeExtension' => [['0258']],
		'PHPStan\Type\Php\SimpleXMLElementAsXMLMethodReturnTypeExtension' => [['0259']],
		'PHPStan\Type\Php\SimpleXMLElementXpathMethodReturnTypeExtension' => [['0260']],
		'PHPStan\Type\Php\StrSplitFunctionReturnTypeExtension' => [['0261']],
		'PHPStan\Type\Php\StrTokFunctionReturnTypeExtension' => [['0262']],
		'PHPStan\Type\Php\SprintfFunctionDynamicReturnTypeExtension' => [['0263']],
		'PHPStan\Type\Php\SscanfFunctionDynamicReturnTypeExtension' => [['0264']],
		'PHPStan\Type\Php\StrvalFamilyFunctionReturnTypeExtension' => [['0265']],
		'PHPStan\Type\Php\StrWordCountFunctionDynamicReturnTypeExtension' => [['0266']],
		'PHPStan\Type\Php\XMLReaderOpenReturnTypeExtension' => [['0267']],
		'PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension' => [['0268', '0269', '0270', '0271', '0272']],
		'PHPStan\Type\Php\DatePeriodConstructorReturnTypeExtension' => [['0273']],
		'PHPStan\Type\ClosureTypeFactory' => [['0274']],
		'PHPStan\Type\Constant\OversizedArrayBuilder' => [['0275']],
		'PHPStan\Analyser\TypeSpecifier' => [['typeSpecifier']],
		'PHPStan\Analyser\TypeSpecifierFactory' => [['typeSpecifierFactory']],
		'PHPStan\File\RelativePathHelper' => [
			0 => ['relativePathHelper'],
			2 => [1 => 'simpleRelativePathHelper', 'parentDirectoryRelativePathHelper'],
		],
		'PHPStan\File\ParentDirectoryRelativePathHelper' => [2 => ['parentDirectoryRelativePathHelper']],
		'PHPStan\Reflection\ReflectionProvider' => [['reflectionProvider'], ['broker'], [2 => 'betterReflectionProvider']],
		'PHPStan\Broker\Broker' => [['broker']],
		'PHPStan\Broker\BrokerFactory' => [['brokerFactory']],
		'PHPStan\Cache\CacheStorage' => [2 => ['cacheStorage']],
		'PHPStan\Cache\FileCacheStorage' => [2 => ['cacheStorage']],
		'PHPStan\Parser\Parser' => [
			2 => [
				'currentPhpVersionRichParser',
				'currentPhpVersionSimpleParser',
				'currentPhpVersionSimpleDirectParser',
				'defaultAnalysisParser',
				'php8Parser',
				'pathRoutingParser',
				'cachedRectorParser',
				'rectorParser',
			],
		],
		'PHPStan\Parser\RichParser' => [2 => ['currentPhpVersionRichParser', 'rectorParser']],
		'PHPStan\Parser\CleaningParser' => [2 => ['currentPhpVersionSimpleParser']],
		'PHPStan\Parser\SimpleParser' => [2 => ['currentPhpVersionSimpleDirectParser', 'php8Parser']],
		'PHPStan\Parser\PathRoutingParser' => [2 => ['defaultAnalysisParser', 'pathRoutingParser']],
		'PhpParser\Parser' => [2 => ['phpParserDecorator', 'currentPhpVersionPhpParser', 'php8PhpParser']],
		'PHPStan\Parser\PhpParserDecorator' => [2 => ['phpParserDecorator']],
		'PhpParser\Lexer' => [2 => ['currentPhpVersionLexer', 'php8Lexer']],
		'PhpParser\ParserAbstract' => [2 => ['currentPhpVersionPhpParser', 'php8PhpParser']],
		'PhpParser\Parser\Php7' => [2 => ['currentPhpVersionPhpParser', 'php8PhpParser']],
		'PHPStan\Rules\Registry' => [['registry']],
		'PHPStan\Rules\LazyRegistry' => [['registry']],
		'PHPStan\PhpDoc\StubPhpDocProvider' => [['stubPhpDocProvider']],
		'PHPStan\Reflection\ReflectionProvider\ReflectionProviderFactory' => [['reflectionProviderFactory']],
		'PHPStan\BetterReflection\SourceLocator\Type\SourceLocator' => [
			0 => ['0283'],
			2 => ['betterReflectionSourceLocator'],
		],
		'PHPStan\BetterReflection\Reflector\Reflector' => [
			0 => ['originalBetterReflectionReflector'],
			2 => [
				1 => 'betterReflectionReflector',
				'betterReflectionClassReflector',
				'betterReflectionFunctionReflector',
				'betterReflectionConstantReflector',
				'nodeScopeResolverReflector',
			],
		],
		'PHPStan\BetterReflection\Reflector\DefaultReflector' => [['originalBetterReflectionReflector']],
		'PHPStan\Reflection\BetterReflection\Reflector\MemoizingReflector' => [
			2 => ['betterReflectionReflector', 'nodeScopeResolverReflector'],
		],
		'PHPStan\BetterReflection\Reflector\ClassReflector' => [2 => ['betterReflectionClassReflector']],
		'PHPStan\BetterReflection\Reflector\FunctionReflector' => [2 => ['betterReflectionFunctionReflector']],
		'PHPStan\BetterReflection\Reflector\ConstantReflector' => [2 => ['betterReflectionConstantReflector']],
		'PHPStan\Reflection\BetterReflection\BetterReflectionProvider' => [2 => ['betterReflectionProvider']],
		'PHPStan\Reflection\BetterReflection\BetterReflectionSourceLocatorFactory' => [['0276']],
		'PHPStan\Reflection\BetterReflection\BetterReflectionProviderFactory' => [['0277']],
		'PHPStan\Reflection\BetterReflection\SourceStubber\PhpStormStubsSourceStubberFactory' => [['0278']],
		'PHPStan\BetterReflection\SourceLocator\SourceStubber\SourceStubber' => [1 => ['0279', '0280']],
		'PHPStan\BetterReflection\SourceLocator\SourceStubber\PhpStormStubsSourceStubber' => [['0279']],
		'PHPStan\BetterReflection\SourceLocator\SourceStubber\ReflectionSourceStubber' => [['0280']],
		'PhpParser\Lexer\Emulative' => [2 => ['php8Lexer']],
		'PHPStan\Command\ErrorFormatter\ErrorFormatter' => [
			[
				'errorFormatter.raw',
				'errorFormatter.table',
				'errorFormatter.checkstyle',
				'errorFormatter.json',
				'errorFormatter.junit',
				'errorFormatter.prettyJson',
				'errorFormatter.gitlab',
				'errorFormatter.github',
				'errorFormatter.teamcity',
			],
			['0281'],
		],
		'PHPStan\Command\ErrorFormatter\CiDetectedErrorFormatter' => [['0281']],
		'PHPStan\Command\ErrorFormatter\RawErrorFormatter' => [['errorFormatter.raw']],
		'PHPStan\Command\ErrorFormatter\TableErrorFormatter' => [['errorFormatter.table']],
		'PHPStan\Command\ErrorFormatter\CheckstyleErrorFormatter' => [['errorFormatter.checkstyle']],
		'PHPStan\Command\ErrorFormatter\JsonErrorFormatter' => [['errorFormatter.json', 'errorFormatter.prettyJson']],
		'PHPStan\Command\ErrorFormatter\JunitErrorFormatter' => [['errorFormatter.junit']],
		'PHPStan\Command\ErrorFormatter\GitlabErrorFormatter' => [['errorFormatter.gitlab']],
		'PHPStan\Command\ErrorFormatter\GithubErrorFormatter' => [['errorFormatter.github']],
		'PHPStan\Command\ErrorFormatter\TeamcityErrorFormatter' => [['errorFormatter.teamcity']],
		'Rector\NodeTypeResolver\Reflection\BetterReflection\RectorBetterReflectionSourceLocatorFactory' => [['0282']],
		'Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocator\IntermediateSourceLocator' => [['0283']],
		'Rector\NodeTypeResolver\Contract\SourceLocatorProviderInterface' => [['0284']],
		'Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocatorProvider\DynamicSourceLocatorProvider' => [
			['0284'],
		],
		'PHPStan\Parser\CachedParser' => [2 => ['cachedRectorParser']],
	];


	public function __construct(array $params = [])
	{
		parent::__construct($params);
		$this->parameters += [
			'bootstrapFiles' => [
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionUnionType.php',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionAttribute.php',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/Attribute.php',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionIntersectionType.php',
			],
			'excludes_analyse' => [],
			'excludePaths' => null,
			'level' => null,
			'paths' => [],
			'exceptions' => [
				'implicitThrows' => true,
				'uncheckedExceptionRegexes' => [],
				'uncheckedExceptionClasses' => [],
				'checkedExceptionRegexes' => [],
				'checkedExceptionClasses' => [],
				'check' => ['missingCheckedExceptionInThrows' => false, 'tooWideThrowType' => false],
			],
			'featureToggles' => [
				'bleedingEdge' => false,
				'disableRuntimeReflectionProvider' => false,
				'skipCheckGenericClasses' => [
					'DatePeriod',
					'CallbackFilterIterator',
					'FilterIterator',
					'RecursiveCallbackFilterIterator',
					'AppendIterator',
					'NoRewindIterator',
					'LimitIterator',
					'InfiniteIterator',
					'CachingIterator',
					'RegexIterator',
				],
				'explicitMixedInUnknownGenericNew' => false,
				'explicitMixedForGlobalVariables' => false,
				'explicitMixedViaIsArray' => false,
				'arrayFilter' => false,
				'arrayUnpacking' => false,
				'nodeConnectingVisitorCompatibility' => true,
				'nodeConnectingVisitorRule' => false,
				'illegalConstructorMethodCall' => false,
				'disableCheckMissingIterableValueType' => false,
				'strictUnnecessaryNullsafePropertyFetch' => false,
				'looseComparison' => false,
				'consistentConstructor' => false,
				'checkUnresolvableParameterTypes' => false,
				'readOnlyByPhpDoc' => false,
				'phpDocParserRequireWhitespaceBeforeDescription' => false,
				'runtimeReflectionRules' => false,
				'notAnalysedTrait' => false,
				'curlSetOptTypes' => false,
				'listType' => false,
				'missingMagicSerializationRule' => false,
				'nullContextForVoidReturningFunctions' => false,
				'unescapeStrings' => false,
				'duplicateStubs' => false,
				'invarianceComposition' => false,
			],
			'fileExtensions' => ['php'],
			'checkAdvancedIsset' => false,
			'checkAlwaysTrueCheckTypeFunctionCall' => false,
			'checkAlwaysTrueInstanceof' => false,
			'checkAlwaysTrueStrictComparison' => false,
			'checkAlwaysTrueLooseComparison' => false,
			'checkClassCaseSensitivity' => false,
			'checkExplicitMixed' => false,
			'checkImplicitMixed' => false,
			'checkFunctionArgumentTypes' => false,
			'checkFunctionNameCase' => false,
			'checkGenericClassInNonGenericObjectType' => false,
			'checkInternalClassCaseSensitivity' => false,
			'checkMissingIterableValueType' => false,
			'checkMissingCallableSignature' => false,
			'checkMissingVarTagTypehint' => false,
			'checkArgumentsPassedByReference' => false,
			'checkMaybeUndefinedVariables' => false,
			'checkNullables' => false,
			'checkThisOnly' => true,
			'checkUnionTypes' => false,
			'checkBenevolentUnionTypes' => false,
			'checkListType' => false,
			'checkExplicitMixedMissingReturn' => false,
			'checkPhpDocMissingReturn' => false,
			'checkPhpDocMethodSignatures' => false,
			'checkExtraArguments' => false,
			'checkMissingTypehints' => false,
			'checkTooWideReturnTypesInProtectedAndPublicMethods' => false,
			'checkUninitializedProperties' => false,
			'checkDynamicProperties' => false,
			'deprecationRulesInstalled' => false,
			'inferPrivatePropertyTypeFromConstructor' => true,
			'reportMaybes' => false,
			'reportMaybesInMethodSignatures' => false,
			'reportMaybesInPropertyPhpDocTypes' => false,
			'reportStaticMethodSignatures' => false,
			'mixinExcludeClasses' => [],
			'scanFiles' => [],
			'scanDirectories' => [],
			'parallel' => [
				'jobSize' => 20,
				'processTimeout' => 600.0,
				'maximumNumberOfProcesses' => 32,
				'minimumNumberOfJobsPerProcess' => 2,
				'buffer' => 134217728,
			],
			'phpVersion' => null,
			'polluteScopeWithLoopInitialAssignments' => true,
			'polluteScopeWithAlwaysIterableForeach' => true,
			'propertyAlwaysWrittenTags' => [],
			'propertyAlwaysReadTags' => [],
			'additionalConstructors' => [],
			'treatPhpDocTypesAsCertain' => true,
			'usePathConstantsAsConstantString' => false,
			'rememberPossiblyImpureFunctionValues' => true,
			'tipsOfTheDay' => true,
			'reportMagicMethods' => false,
			'reportMagicProperties' => false,
			'ignoreErrors' => [],
			'internalErrorsCountLimit' => 50,
			'cache' => ['nodesByFileCountMax' => 1024, 'nodesByStringCountMax' => 256],
			'reportUnmatchedIgnoredErrors' => true,
			'scopeClass' => 'PHPStan\Analyser\MutatingScope',
			'typeAliases' => [],
			'universalObjectCratesClasses' => ['stdClass'],
			'stubFiles' => [
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionAttribute.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionClass.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionClassConstant.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionFunctionAbstract.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionMethod.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionParameter.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionProperty.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/iterable.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ArrayObject.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/WeakReference.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ext-ds.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ImagickPixel.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/PDOStatement.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/date.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/mysqli.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/zip.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/dom.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/spl.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/SplObjectStorage.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/Exception.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/arrayFunctions.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/core.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/typeCheckingFunctions.stub',
			],
			'earlyTerminatingMethodCalls' => [],
			'earlyTerminatingFunctionCalls' => [],
			'memoryLimitFile' => '/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/.memory_limit',
			'tempResultCachePath' => '/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/resultCaches',
			'resultCachePath' => '/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/resultCache.php',
			'resultCacheChecksProjectExtensionFilesDependencies' => false,
			'staticReflectionClassNamePatterns' => [],
			'dynamicConstantNames' => [
				'ICONV_IMPL',
				'LIBXML_VERSION',
				'LIBXML_DOTTED_VERSION',
				'Memcached::HAVE_ENCODING',
				'Memcached::HAVE_IGBINARY',
				'Memcached::HAVE_JSON',
				'Memcached::HAVE_MSGPACK',
				'Memcached::HAVE_SASL',
				'Memcached::HAVE_SESSION',
				'PHP_VERSION',
				'PHP_MAJOR_VERSION',
				'PHP_MINOR_VERSION',
				'PHP_RELEASE_VERSION',
				'PHP_VERSION_ID',
				'PHP_EXTRA_VERSION',
				'PHP_WINDOWS_VERSION_MAJOR',
				'PHP_WINDOWS_VERSION_MINOR',
				'PHP_WINDOWS_VERSION_BUILD',
				'PHP_ZTS',
				'PHP_DEBUG',
				'PHP_MAXPATHLEN',
				'PHP_OS',
				'PHP_OS_FAMILY',
				'PHP_SAPI',
				'PHP_EOL',
				'PHP_INT_MAX',
				'PHP_INT_MIN',
				'PHP_INT_SIZE',
				'PHP_FLOAT_DIG',
				'PHP_FLOAT_EPSILON',
				'PHP_FLOAT_MIN',
				'PHP_FLOAT_MAX',
				'DEFAULT_INCLUDE_PATH',
				'PEAR_INSTALL_DIR',
				'PEAR_EXTENSION_DIR',
				'PHP_EXTENSION_DIR',
				'PHP_PREFIX',
				'PHP_BINDIR',
				'PHP_BINARY',
				'PHP_MANDIR',
				'PHP_LIBDIR',
				'PHP_DATADIR',
				'PHP_SYSCONFDIR',
				'PHP_LOCALSTATEDIR',
				'PHP_CONFIG_FILE_PATH',
				'PHP_CONFIG_FILE_SCAN_DIR',
				'PHP_SHLIB_SUFFIX',
				'PHP_FD_SETSIZE',
				'OPENSSL_VERSION_NUMBER',
				'ZEND_DEBUG_BUILD',
				'ZEND_THREAD_SAFE',
			],
			'customRulesetUsed' => null,
			'editorUrl' => null,
			'editorUrlTitle' => null,
			'errorFormat' => null,
			'__validate' => true,
			'debugMode' => true,
			'productionMode' => false,
			'tempDir' => '/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection',
			'rootDir' => '/home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan',
			'currentWorkingDirectory' => '/home/phpnuke/public_html',
			'cliArgumentsVariablesRegistered' => true,
			'tmpDir' => '/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection',
			'additionalConfigFiles' => [
				'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/static-reflection.neon',
				'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/better-infer.neon',
				'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/parser.neon',
			],
			'composerAutoloaderProjectPaths' => [],
			'generateBaselineFile' => null,
			'usedLevel' => '0',
			'cliAutoloadFile' => null,
			'fixerTmpDir' => '/tmp/phpstan-fixer',
			'singleReflectionFile' => null,
			'singleReflectionInsteadOfFile' => null,
			'analysedPaths' => null,
			'analysedPathsFromConfig' => null,
		];
	}


	public function createService01(): PhpParser\BuilderFactory
	{
		return new PhpParser\BuilderFactory;
	}


	public function createService02(): PHPStan\Parser\LexerFactory
	{
		return new PHPStan\Parser\LexerFactory($this->getService('017'));
	}


	public function createService03(): PhpParser\NodeVisitor\NameResolver
	{
		return new PhpParser\NodeVisitor\NameResolver(null, ['preserveOriginalNames' => true]);
	}


	public function createService04(): PHPStan\Parser\ArrayFilterArgVisitor
	{
		return new PHPStan\Parser\ArrayFilterArgVisitor;
	}


	public function createService05(): PHPStan\Parser\ArrayMapArgVisitor
	{
		return new PHPStan\Parser\ArrayMapArgVisitor;
	}


	public function createService06(): PHPStan\Parser\ArrayWalkArgVisitor
	{
		return new PHPStan\Parser\ArrayWalkArgVisitor;
	}


	public function createService07(): PHPStan\Parser\ClosureArgVisitor
	{
		return new PHPStan\Parser\ClosureArgVisitor;
	}


	public function createService08(): PHPStan\Parser\CurlSetOptArgVisitor
	{
		return new PHPStan\Parser\CurlSetOptArgVisitor;
	}


	public function createService09(): PHPStan\Parser\ArrowFunctionArgVisitor
	{
		return new PHPStan\Parser\ArrowFunctionArgVisitor;
	}


	public function createService010(): PHPStan\Parser\NewAssignedToPropertyVisitor
	{
		return new PHPStan\Parser\NewAssignedToPropertyVisitor;
	}


	public function createService011(): PHPStan\Parser\ParentStmtTypesVisitor
	{
		return new PHPStan\Parser\ParentStmtTypesVisitor;
	}


	public function createService012(): PHPStan\Parser\TryCatchTypeVisitor
	{
		return new PHPStan\Parser\TryCatchTypeVisitor;
	}


	public function createService013(): PhpParser\NodeVisitor\NodeConnectingVisitor
	{
		return new PhpParser\NodeVisitor\NodeConnectingVisitor;
	}


	public function createService014(): PHPStan\Node\Printer\ExprPrinter
	{
		return new PHPStan\Node\Printer\ExprPrinter($this->getService('015'));
	}


	public function createService015(): PHPStan\Node\Printer\Printer
	{
		return new PHPStan\Node\Printer\Printer;
	}


	public function createService016(): PHPStan\Broker\AnonymousClassNameHelper
	{
		return new PHPStan\Broker\AnonymousClassNameHelper($this->getService('063'), $this->getService('simpleRelativePathHelper'));
	}


	public function createService017(): PHPStan\Php\PhpVersion
	{
		return $this->getService('018')->create();
	}


	public function createService018(): PHPStan\Php\PhpVersionFactory
	{
		return $this->getService('019')->create();
	}


	public function createService019(): PHPStan\Php\PhpVersionFactoryFactory
	{
		return new PHPStan\Php\PhpVersionFactoryFactory(null, []);
	}


	public function createService020(): PHPStan\PhpDocParser\Lexer\Lexer
	{
		return new PHPStan\PhpDocParser\Lexer\Lexer;
	}


	public function createService021(): PHPStan\PhpDocParser\Parser\TypeParser
	{
		return new PHPStan\PhpDocParser\Parser\TypeParser($this->getService('022'));
	}


	public function createService022(): PHPStan\PhpDocParser\Parser\ConstExprParser
	{
		return $this->getService('024')->create();
	}


	public function createService023(): PHPStan\PhpDocParser\Parser\PhpDocParser
	{
		return new PHPStan\PhpDocParser\Parser\PhpDocParser($this->getService('021'), $this->getService('022'));
	}


	public function createService024(): PHPStan\PhpDoc\ConstExprParserFactory
	{
		return new PHPStan\PhpDoc\ConstExprParserFactory(false);
	}


	public function createService025(): PHPStan\PhpDoc\PhpDocInheritanceResolver
	{
		return new PHPStan\PhpDoc\PhpDocInheritanceResolver($this->getService('0135'), $this->getService('stubPhpDocProvider'));
	}


	public function createService026(): PHPStan\PhpDoc\PhpDocNodeResolver
	{
		return new PHPStan\PhpDoc\PhpDocNodeResolver($this->getService('029'), $this->getService('028'), $this->getService('0129'));
	}


	public function createService027(): PHPStan\PhpDoc\PhpDocStringResolver
	{
		return new PHPStan\PhpDoc\PhpDocStringResolver($this->getService('020'), $this->getService('023'));
	}


	public function createService028(): PHPStan\PhpDoc\ConstExprNodeResolver
	{
		return new PHPStan\PhpDoc\ConstExprNodeResolver;
	}


	public function createService029(): PHPStan\PhpDoc\TypeNodeResolver
	{
		return new PHPStan\PhpDoc\TypeNodeResolver(
			$this->getService('030'),
			$this->getService('091'),
			$this->getService('0137'),
			$this->getService('042'),
			$this->getService('073')
		);
	}


	public function createService030(): PHPStan\PhpDoc\TypeNodeResolverExtensionRegistryProvider
	{
		return new PHPStan\PhpDoc\LazyTypeNodeResolverExtensionRegistryProvider($this->getService('056'));
	}


	public function createService031(): PHPStan\PhpDoc\TypeStringResolver
	{
		return new PHPStan\PhpDoc\TypeStringResolver($this->getService('020'), $this->getService('021'), $this->getService('029'));
	}


	public function createService032(): PHPStan\PhpDoc\StubValidator
	{
		return new PHPStan\PhpDoc\StubValidator($this->getService('058'), false);
	}


	public function createService033(): PHPStan\PhpDoc\CountableStubFilesExtension
	{
		return new PHPStan\PhpDoc\CountableStubFilesExtension(false);
	}


	public function createService034(): PHPStan\PhpDoc\DefaultStubFilesProvider
	{
		return new PHPStan\PhpDoc\DefaultStubFilesProvider(
			$this->getService('056'),
			[
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionAttribute.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionClass.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionClassConstant.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionFunctionAbstract.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionMethod.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionParameter.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ReflectionProperty.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/iterable.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ArrayObject.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/WeakReference.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ext-ds.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/ImagickPixel.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/PDOStatement.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/date.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/mysqli.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/zip.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/dom.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/spl.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/SplObjectStorage.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/Exception.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/arrayFunctions.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/core.stub',
				'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/typeCheckingFunctions.stub',
			],
			'/home/phpnuke/public_html'
		);
	}


	public function createService035(): PHPStan\Analyser\Analyser
	{
		return new PHPStan\Analyser\Analyser(
			$this->getService('036'),
			$this->getService('registry'),
			$this->getService('047'),
			$this->getService('041'),
			50
		);
	}


	public function createService036(): PHPStan\Analyser\FileAnalyser
	{
		return new PHPStan\Analyser\FileAnalyser(
			$this->getService('040'),
			$this->getService('041'),
			$this->getService('defaultAnalysisParser'),
			$this->getService('052'),
			$this->getService('037'),
			true
		);
	}


	public function createService037(): PHPStan\Analyser\RuleErrorTransformer
	{
		return new PHPStan\Analyser\RuleErrorTransformer;
	}


	public function createService038(): PHPStan\Analyser\IgnoredErrorHelper
	{
		return new PHPStan\Analyser\IgnoredErrorHelper($this->getService('063'), [], true);
	}


	public function createService039(): PHPStan\Analyser\LazyInternalScopeFactory
	{
		return new PHPStan\Analyser\LazyInternalScopeFactory('PHPStan\Analyser\MutatingScope', $this->getService('056'));
	}


	public function createService040(): PHPStan\Analyser\ScopeFactory
	{
		return new PHPStan\Analyser\ScopeFactory($this->getService('039'));
	}


	public function createService041(): PHPStan\Analyser\NodeScopeResolver
	{
		return new PHPStan\Analyser\NodeScopeResolver(
			$this->getService('reflectionProvider'),
			$this->getService('073'),
			$this->getService('nodeScopeResolverReflector'),
			$this->getService('059'),
			$this->getService('defaultAnalysisParser'),
			$this->getService('0135'),
			$this->getService('stubPhpDocProvider'),
			$this->getService('017'),
			$this->getService('025'),
			$this->getService('063'),
			$this->getService('typeSpecifier'),
			$this->getService('062'),
			$this->getService('0130'),
			true,
			true,
			[],
			[],
			true
		);
	}


	public function createService042(): PHPStan\Analyser\ConstantResolver
	{
		return $this->getService('043')->create();
	}


	public function createService043(): PHPStan\Analyser\ConstantResolverFactory
	{
		return new PHPStan\Analyser\ConstantResolverFactory($this->getService('091'), $this->getService('056'));
	}


	public function createService044(): PHPStan\Analyser\ResultCache\ResultCacheManagerFactory
	{
		return new class ($this) implements PHPStan\Analyser\ResultCache\ResultCacheManagerFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(array $fileReplacements): PHPStan\Analyser\ResultCache\ResultCacheManager
			{
				return new PHPStan\Analyser\ResultCache\ResultCacheManager(
					$this->container->getService('053'),
					$this->container->getService('fileFinderScan'),
					$this->container->getService('reflectionProvider'),
					$this->container->getService('034'),
					'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/resultCache.php',
					'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/resultCaches',
					$this->container->parameters['analysedPaths'],
					[],
					'0',
					null,
					[
						'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionUnionType.php',
						'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionAttribute.php',
						'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/Attribute.php',
						'phar:///home/phpnuke/public_html/vendor/rector/rector/vendor/phpstan/phpstan/phpstan.phar/stubs/runtime/ReflectionIntersectionType.php',
					],
					[],
					[],
					$fileReplacements,
					false
				);
			}
		};
	}


	public function createService045(): PHPStan\Analyser\ResultCache\ResultCacheClearer
	{
		return new PHPStan\Analyser\ResultCache\ResultCacheClearer(
			'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/resultCache.php',
			'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/resultCaches'
		);
	}


	public function createService046(): PHPStan\Cache\Cache
	{
		return new PHPStan\Cache\Cache($this->getService('cacheStorage'));
	}


	public function createService047(): PHPStan\Collectors\Registry
	{
		return $this->getService('048')->create();
	}


	public function createService048(): PHPStan\Collectors\RegistryFactory
	{
		return new PHPStan\Collectors\RegistryFactory($this->getService('056'));
	}


	public function createService049(): PHPStan\Command\AnalyseApplication
	{
		return new PHPStan\Command\AnalyseApplication(
			$this->getService('050'),
			$this->getService('032'),
			$this->getService('044'),
			$this->getService('038'),
			50,
			$this->getService('034'),
			$this->getService('registry'),
			$this->getService('040'),
			$this->getService('037')
		);
	}


	public function createService050(): PHPStan\Command\AnalyserRunner
	{
		return new PHPStan\Command\AnalyserRunner(
			$this->getService('069'),
			$this->getService('035'),
			$this->getService('068'),
			$this->getService('071')
		);
	}


	public function createService051(): PHPStan\Command\FixerApplication
	{
		return new PHPStan\Command\FixerApplication(
			$this->getService('066'),
			$this->getService('044'),
			$this->getService('045'),
			$this->getService('038'),
			$this->getService('071'),
			$this->getService('069'),
			$this->parameters['analysedPaths'],
			'/home/phpnuke/public_html',
			'/tmp/phpstan-fixer',
			32
		);
	}


	public function createService052(): PHPStan\Dependency\DependencyResolver
	{
		return new PHPStan\Dependency\DependencyResolver(
			$this->getService('063'),
			$this->getService('reflectionProvider'),
			$this->getService('054'),
			$this->getService('0135')
		);
	}


	public function createService053(): PHPStan\Dependency\ExportedNodeFetcher
	{
		return new PHPStan\Dependency\ExportedNodeFetcher($this->getService('defaultAnalysisParser'), $this->getService('055'));
	}


	public function createService054(): PHPStan\Dependency\ExportedNodeResolver
	{
		return new PHPStan\Dependency\ExportedNodeResolver($this->getService('0135'), $this->getService('014'));
	}


	public function createService055(): PHPStan\Dependency\ExportedNodeVisitor
	{
		return new PHPStan\Dependency\ExportedNodeVisitor($this->getService('054'));
	}


	public function createService056(): PHPStan\DependencyInjection\Container
	{
		return new PHPStan\DependencyInjection\MemoizingContainer($this->getService('057'));
	}


	public function createService057(): PHPStan\DependencyInjection\Nette\NetteContainer
	{
		return new PHPStan\DependencyInjection\Nette\NetteContainer($this);
	}


	public function createService058(): PHPStan\DependencyInjection\DerivativeContainerFactory
	{
		return new PHPStan\DependencyInjection\DerivativeContainerFactory(
			'/home/phpnuke/public_html',
			'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection',
			[
				'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/static-reflection.neon',
				'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/better-infer.neon',
				'/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/../../../config/phpstan/parser.neon',
			],
			$this->parameters['analysedPaths'],
			[],
			$this->parameters['analysedPathsFromConfig'],
			'0',
			null,
			null,
			$this->parameters['singleReflectionFile'],
			$this->parameters['singleReflectionInsteadOfFile']
		);
	}


	public function createService059(): PHPStan\DependencyInjection\Reflection\ClassReflectionExtensionRegistryProvider
	{
		return new PHPStan\DependencyInjection\Reflection\LazyClassReflectionExtensionRegistryProvider($this->getService('056'));
	}


	public function createService060(): PHPStan\DependencyInjection\Type\DynamicReturnTypeExtensionRegistryProvider
	{
		return new PHPStan\DependencyInjection\Type\LazyDynamicReturnTypeExtensionRegistryProvider($this->getService('056'));
	}


	public function createService061(): PHPStan\DependencyInjection\Type\OperatorTypeSpecifyingExtensionRegistryProvider
	{
		return new PHPStan\DependencyInjection\Type\LazyOperatorTypeSpecifyingExtensionRegistryProvider($this->getService('056'));
	}


	public function createService062(): PHPStan\DependencyInjection\Type\DynamicThrowTypeExtensionProvider
	{
		return new PHPStan\DependencyInjection\Type\LazyDynamicThrowTypeExtensionProvider($this->getService('056'));
	}


	public function createService063(): PHPStan\File\FileHelper
	{
		return new PHPStan\File\FileHelper('/home/phpnuke/public_html');
	}


	public function createService064(): PHPStan\File\FileExcluderFactory
	{
		return new PHPStan\File\FileExcluderFactory($this->getService('065'), [], null);
	}


	public function createService065(): PHPStan\File\FileExcluderRawFactory
	{
		return new class ($this) implements PHPStan\File\FileExcluderRawFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(array $analyseExcludes): PHPStan\File\FileExcluder
			{
				return new PHPStan\File\FileExcluder($this->container->getService('063'), $analyseExcludes);
			}
		};
	}


	public function createService066(): PHPStan\File\FileMonitor
	{
		return new PHPStan\File\FileMonitor($this->getService('fileFinderAnalyse'));
	}


	public function createService067(): PHPStan\NodeVisitor\StatementOrderVisitor
	{
		return new PHPStan\NodeVisitor\StatementOrderVisitor;
	}


	public function createService068(): PHPStan\Parallel\ParallelAnalyser
	{
		return new PHPStan\Parallel\ParallelAnalyser(50, 600.0, 134217728);
	}


	public function createService069(): PHPStan\Parallel\Scheduler
	{
		return new PHPStan\Parallel\Scheduler(20, 32, 2);
	}


	public function createService070(): PHPStan\Parser\FunctionCallStatementFinder
	{
		return new PHPStan\Parser\FunctionCallStatementFinder;
	}


	public function createService071(): PHPStan\Process\CpuCoreCounter
	{
		return new PHPStan\Process\CpuCoreCounter;
	}


	public function createService072(): PHPStan\Reflection\FunctionReflectionFactory
	{
		return new class ($this) implements PHPStan\Reflection\FunctionReflectionFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(
				PHPStan\BetterReflection\Reflection\Adapter\ReflectionFunction $reflection,
				PHPStan\Type\Generic\TemplateTypeMap $templateTypeMap,
				array $phpDocParameterTypes,
				?PHPStan\Type\Type $phpDocReturnType,
				?PHPStan\Type\Type $phpDocThrowType,
				?string $deprecatedDescription,
				bool $isDeprecated,
				bool $isInternal,
				bool $isFinal,
				?string $filename,
				?bool $isPure,
				PHPStan\Reflection\Assertions $asserts,
				?string $phpDocComment,
				array $phpDocParameterOutTypes
			): PHPStan\Reflection\Php\PhpFunctionReflection {
				return new PHPStan\Reflection\Php\PhpFunctionReflection(
					$this->container->getService('073'),
					$reflection,
					$this->container->getService('defaultAnalysisParser'),
					$this->container->getService('070'),
					$this->container->getService('046'),
					$templateTypeMap,
					$phpDocParameterTypes,
					$phpDocReturnType,
					$phpDocThrowType,
					$deprecatedDescription,
					$isDeprecated,
					$isInternal,
					$isFinal,
					$filename,
					$isPure,
					$asserts,
					$phpDocComment,
					$phpDocParameterOutTypes
				);
			}
		};
	}


	public function createService073(): PHPStan\Reflection\InitializerExprTypeResolver
	{
		return new PHPStan\Reflection\InitializerExprTypeResolver(
			$this->getService('042'),
			$this->getService('091'),
			$this->getService('017'),
			$this->getService('061'),
			$this->getService('0275')
		);
	}


	public function createService074(): PHPStan\Reflection\Annotations\AnnotationsMethodsClassReflectionExtension
	{
		return new PHPStan\Reflection\Annotations\AnnotationsMethodsClassReflectionExtension;
	}


	public function createService075(): PHPStan\Reflection\Annotations\AnnotationsPropertiesClassReflectionExtension
	{
		return new PHPStan\Reflection\Annotations\AnnotationsPropertiesClassReflectionExtension;
	}


	public function createService076(): PHPStan\Reflection\BetterReflection\SourceLocator\CachingVisitor
	{
		return new PHPStan\Reflection\BetterReflection\SourceLocator\CachingVisitor;
	}


	public function createService077(): PHPStan\Reflection\BetterReflection\SourceLocator\FileNodesFetcher
	{
		return new PHPStan\Reflection\BetterReflection\SourceLocator\FileNodesFetcher(
			$this->getService('076'),
			$this->getService('defaultAnalysisParser')
		);
	}


	public function createService078(): PHPStan\Reflection\BetterReflection\SourceLocator\ComposerJsonAndInstalledJsonSourceLocatorMaker
	{
		return new PHPStan\Reflection\BetterReflection\SourceLocator\ComposerJsonAndInstalledJsonSourceLocatorMaker(
			$this->getService('080'),
			$this->getService('081'),
			$this->getService('079'),
			$this->getService('017')
		);
	}


	public function createService079(): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedDirectorySourceLocatorFactory
	{
		return new PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedDirectorySourceLocatorFactory(
			$this->getService('077'),
			$this->getService('fileFinderScan'),
			$this->getService('017')
		);
	}


	public function createService080(): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedDirectorySourceLocatorRepository
	{
		return new PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedDirectorySourceLocatorRepository($this->getService('079'));
	}


	public function createService081(): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedPsrAutoloaderLocatorFactory
	{
		return new class ($this) implements PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedPsrAutoloaderLocatorFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(PHPStan\BetterReflection\SourceLocator\Type\Composer\Psr\PsrAutoloaderMapping $mapping): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedPsrAutoloaderLocator
			{
				return new PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedPsrAutoloaderLocator($mapping, $this->container->getService('083'));
			}
		};
	}


	public function createService082(): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocatorFactory
	{
		return new class ($this) implements PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocatorFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(string $fileName): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocator
			{
				return new PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocator(
					$this->container->getService('077'),
					$fileName
				);
			}
		};
	}


	public function createService083(): PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocatorRepository
	{
		return new PHPStan\Reflection\BetterReflection\SourceLocator\OptimizedSingleFileSourceLocatorRepository($this->getService('082'));
	}


	public function createService084(): PHPStan\Reflection\Mixin\MixinMethodsClassReflectionExtension
	{
		return new PHPStan\Reflection\Mixin\MixinMethodsClassReflectionExtension([]);
	}


	public function createService085(): PHPStan\Reflection\Mixin\MixinPropertiesClassReflectionExtension
	{
		return new PHPStan\Reflection\Mixin\MixinPropertiesClassReflectionExtension([]);
	}


	public function createService086(): PHPStan\Reflection\Php\PhpClassReflectionExtension
	{
		return new PHPStan\Reflection\Php\PhpClassReflectionExtension(
			$this->getService('040'),
			$this->getService('041'),
			$this->getService('087'),
			$this->getService('025'),
			$this->getService('074'),
			$this->getService('075'),
			$this->getService('097'),
			$this->getService('defaultAnalysisParser'),
			$this->getService('stubPhpDocProvider'),
			$this->getService('091'),
			$this->getService('0135'),
			true,
			['stdClass']
		);
	}


	public function createService087(): PHPStan\Reflection\Php\PhpMethodReflectionFactory
	{
		return new class ($this) implements PHPStan\Reflection\Php\PhpMethodReflectionFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(
				PHPStan\Reflection\ClassReflection $declaringClass,
				?PHPStan\Reflection\ClassReflection $declaringTrait,
				PHPStan\Reflection\Php\BuiltinMethodReflection $reflection,
				PHPStan\Type\Generic\TemplateTypeMap $templateTypeMap,
				array $phpDocParameterTypes,
				?PHPStan\Type\Type $phpDocReturnType,
				?PHPStan\Type\Type $phpDocThrowType,
				?string $deprecatedDescription,
				bool $isDeprecated,
				bool $isInternal,
				bool $isFinal,
				?bool $isPure,
				PHPStan\Reflection\Assertions $asserts,
				?PHPStan\Type\Type $selfOutType,
				?string $phpDocComment,
				array $phpDocParameterOutTypes
			): PHPStan\Reflection\Php\PhpMethodReflection {
				return new PHPStan\Reflection\Php\PhpMethodReflection(
					$this->container->getService('073'),
					$declaringClass,
					$declaringTrait,
					$reflection,
					$this->container->getService('reflectionProvider'),
					$this->container->getService('defaultAnalysisParser'),
					$this->container->getService('070'),
					$this->container->getService('046'),
					$templateTypeMap,
					$phpDocParameterTypes,
					$phpDocReturnType,
					$phpDocThrowType,
					$deprecatedDescription,
					$isDeprecated,
					$isInternal,
					$isFinal,
					$isPure,
					$asserts,
					$selfOutType,
					$phpDocComment,
					$phpDocParameterOutTypes
				);
			}
		};
	}


	public function createService088(): PHPStan\Reflection\Php\Soap\SoapClientMethodsClassReflectionExtension
	{
		return new PHPStan\Reflection\Php\Soap\SoapClientMethodsClassReflectionExtension;
	}


	public function createService089(): PHPStan\Reflection\Php\EnumAllowedSubTypesClassReflectionExtension
	{
		return new PHPStan\Reflection\Php\EnumAllowedSubTypesClassReflectionExtension;
	}


	public function createService090(): PHPStan\Reflection\Php\UniversalObjectCratesClassReflectionExtension
	{
		return new PHPStan\Reflection\Php\UniversalObjectCratesClassReflectionExtension(
			$this->getService('reflectionProvider'),
			['stdClass'],
			$this->getService('075')
		);
	}


	public function createService091(): PHPStan\Reflection\ReflectionProvider\ReflectionProviderProvider
	{
		return new PHPStan\Reflection\ReflectionProvider\LazyReflectionProviderProvider($this->getService('056'));
	}


	public function createService092(): PHPStan\Reflection\SignatureMap\NativeFunctionReflectionProvider
	{
		return new PHPStan\Reflection\SignatureMap\NativeFunctionReflectionProvider(
			$this->getService('097'),
			$this->getService('betterReflectionReflector'),
			$this->getService('0135'),
			$this->getService('stubPhpDocProvider')
		);
	}


	public function createService093(): PHPStan\Reflection\SignatureMap\SignatureMapParser
	{
		return new PHPStan\Reflection\SignatureMap\SignatureMapParser($this->getService('031'));
	}


	public function createService094(): PHPStan\Reflection\SignatureMap\FunctionSignatureMapProvider
	{
		return new PHPStan\Reflection\SignatureMap\FunctionSignatureMapProvider(
			$this->getService('093'),
			$this->getService('073'),
			$this->getService('017')
		);
	}


	public function createService095(): PHPStan\Reflection\SignatureMap\Php8SignatureMapProvider
	{
		return new PHPStan\Reflection\SignatureMap\Php8SignatureMapProvider(
			$this->getService('094'),
			$this->getService('077'),
			$this->getService('0135'),
			$this->getService('017'),
			$this->getService('073')
		);
	}


	public function createService096(): PHPStan\Reflection\SignatureMap\SignatureMapProviderFactory
	{
		return new PHPStan\Reflection\SignatureMap\SignatureMapProviderFactory(
			$this->getService('017'),
			$this->getService('094'),
			$this->getService('095')
		);
	}


	public function createService097(): PHPStan\Reflection\SignatureMap\SignatureMapProvider
	{
		return $this->getService('096')->create();
	}


	public function createService098(): PHPStan\Rules\Api\ApiRuleHelper
	{
		return new PHPStan\Rules\Api\ApiRuleHelper;
	}


	public function createService099(): PHPStan\Rules\AttributesCheck
	{
		return new PHPStan\Rules\AttributesCheck(
			$this->getService('reflectionProvider'),
			$this->getService('0111'),
			$this->getService('0101')
		);
	}


	public function createService0100(): PHPStan\Rules\Arrays\NonexistentOffsetInArrayDimFetchCheck
	{
		return new PHPStan\Rules\Arrays\NonexistentOffsetInArrayDimFetchCheck($this->getService('0133'), false, false);
	}


	public function createService0101(): PHPStan\Rules\ClassCaseSensitivityCheck
	{
		return new PHPStan\Rules\ClassCaseSensitivityCheck($this->getService('reflectionProvider'), false);
	}


	public function createService0102(): PHPStan\Rules\Comparison\ConstantConditionRuleHelper
	{
		return new PHPStan\Rules\Comparison\ConstantConditionRuleHelper($this->getService('0103'), true);
	}


	public function createService0103(): PHPStan\Rules\Comparison\ImpossibleCheckTypeHelper
	{
		return new PHPStan\Rules\Comparison\ImpossibleCheckTypeHelper(
			$this->getService('reflectionProvider'),
			$this->getService('typeSpecifier'),
			['stdClass'],
			true,
			false
		);
	}


	public function createService0104(): PHPStan\Rules\Exceptions\DefaultExceptionTypeResolver
	{
		return new PHPStan\Rules\Exceptions\DefaultExceptionTypeResolver($this->getService('reflectionProvider'), [], [], [], []);
	}


	public function createService0105(): PHPStan\Rules\Exceptions\MissingCheckedExceptionInFunctionThrowsRule
	{
		return new PHPStan\Rules\Exceptions\MissingCheckedExceptionInFunctionThrowsRule($this->getService('0107'));
	}


	public function createService0106(): PHPStan\Rules\Exceptions\MissingCheckedExceptionInMethodThrowsRule
	{
		return new PHPStan\Rules\Exceptions\MissingCheckedExceptionInMethodThrowsRule($this->getService('0107'));
	}


	public function createService0107(): PHPStan\Rules\Exceptions\MissingCheckedExceptionInThrowsCheck
	{
		return new PHPStan\Rules\Exceptions\MissingCheckedExceptionInThrowsCheck($this->getService('exceptionTypeResolver'));
	}


	public function createService0108(): PHPStan\Rules\Exceptions\TooWideFunctionThrowTypeRule
	{
		return new PHPStan\Rules\Exceptions\TooWideFunctionThrowTypeRule($this->getService('0110'));
	}


	public function createService0109(): PHPStan\Rules\Exceptions\TooWideMethodThrowTypeRule
	{
		return new PHPStan\Rules\Exceptions\TooWideMethodThrowTypeRule($this->getService('0135'), $this->getService('0110'));
	}


	public function createService0110(): PHPStan\Rules\Exceptions\TooWideThrowTypeCheck
	{
		return new PHPStan\Rules\Exceptions\TooWideThrowTypeCheck;
	}


	public function createService0111(): PHPStan\Rules\FunctionCallParametersCheck
	{
		return new PHPStan\Rules\FunctionCallParametersCheck(
			$this->getService('0133'),
			$this->getService('0125'),
			$this->getService('017'),
			$this->getService('0129'),
			$this->getService('0132'),
			false,
			false,
			false,
			false,
			false
		);
	}


	public function createService0112(): PHPStan\Rules\FunctionDefinitionCheck
	{
		return new PHPStan\Rules\FunctionDefinitionCheck(
			$this->getService('reflectionProvider'),
			$this->getService('0101'),
			$this->getService('0129'),
			$this->getService('017'),
			false,
			true
		);
	}


	public function createService0113(): PHPStan\Rules\FunctionReturnTypeCheck
	{
		return new PHPStan\Rules\FunctionReturnTypeCheck($this->getService('0133'));
	}


	public function createService0114(): PHPStan\Rules\Generics\CrossCheckInterfacesHelper
	{
		return new PHPStan\Rules\Generics\CrossCheckInterfacesHelper;
	}


	public function createService0115(): PHPStan\Rules\Generics\GenericAncestorsCheck
	{
		return new PHPStan\Rules\Generics\GenericAncestorsCheck(
			$this->getService('reflectionProvider'),
			$this->getService('0116'),
			$this->getService('0118'),
			false,
			[
				'DatePeriod',
				'CallbackFilterIterator',
				'FilterIterator',
				'RecursiveCallbackFilterIterator',
				'AppendIterator',
				'NoRewindIterator',
				'LimitIterator',
				'InfiniteIterator',
				'CachingIterator',
				'RegexIterator',
			]
		);
	}


	public function createService0116(): PHPStan\Rules\Generics\GenericObjectTypeCheck
	{
		return new PHPStan\Rules\Generics\GenericObjectTypeCheck;
	}


	public function createService0117(): PHPStan\Rules\Generics\TemplateTypeCheck
	{
		return new PHPStan\Rules\Generics\TemplateTypeCheck(
			$this->getService('reflectionProvider'),
			$this->getService('0101'),
			$this->getService('0116'),
			$this->getService('0136'),
			false
		);
	}


	public function createService0118(): PHPStan\Rules\Generics\VarianceCheck
	{
		return new PHPStan\Rules\Generics\VarianceCheck;
	}


	public function createService0119(): PHPStan\Rules\IssetCheck
	{
		return new PHPStan\Rules\IssetCheck($this->getService('0131'), $this->getService('0132'), false, true, false);
	}


	public function createService0120(): PHPStan\Rules\Methods\MethodCallCheck
	{
		return new PHPStan\Rules\Methods\MethodCallCheck(
			$this->getService('reflectionProvider'),
			$this->getService('0133'),
			false,
			false
		);
	}


	public function createService0121(): PHPStan\Rules\Methods\StaticMethodCallCheck
	{
		return new PHPStan\Rules\Methods\StaticMethodCallCheck(
			$this->getService('reflectionProvider'),
			$this->getService('0133'),
			$this->getService('0101'),
			false,
			false
		);
	}


	public function createService0122(): PHPStan\Rules\Methods\MethodSignatureRule
	{
		return new PHPStan\Rules\Methods\MethodSignatureRule(false, false);
	}


	public function createService0123(): PHPStan\Rules\Methods\MethodParameterComparisonHelper
	{
		return new PHPStan\Rules\Methods\MethodParameterComparisonHelper($this->getService('017'));
	}


	public function createService0124(): PHPStan\Rules\MissingTypehintCheck
	{
		return new PHPStan\Rules\MissingTypehintCheck(
			false,
			false,
			false,
			false,
			[
				'DatePeriod',
				'CallbackFilterIterator',
				'FilterIterator',
				'RecursiveCallbackFilterIterator',
				'AppendIterator',
				'NoRewindIterator',
				'LimitIterator',
				'InfiniteIterator',
				'CachingIterator',
				'RegexIterator',
			]
		);
	}


	public function createService0125(): PHPStan\Rules\NullsafeCheck
	{
		return new PHPStan\Rules\NullsafeCheck;
	}


	public function createService0126(): PHPStan\Rules\Constants\LazyAlwaysUsedClassConstantsExtensionProvider
	{
		return new PHPStan\Rules\Constants\LazyAlwaysUsedClassConstantsExtensionProvider($this->getService('056'));
	}


	public function createService0127(): PHPStan\Rules\PhpDoc\ConditionalReturnTypeRuleHelper
	{
		return new PHPStan\Rules\PhpDoc\ConditionalReturnTypeRuleHelper;
	}


	public function createService0128(): PHPStan\Rules\PhpDoc\AssertRuleHelper
	{
		return new PHPStan\Rules\PhpDoc\AssertRuleHelper($this->getService('073'));
	}


	public function createService0129(): PHPStan\Rules\PhpDoc\UnresolvableTypeHelper
	{
		return new PHPStan\Rules\PhpDoc\UnresolvableTypeHelper;
	}


	public function createService0130(): PHPStan\Rules\Properties\LazyReadWritePropertiesExtensionProvider
	{
		return new PHPStan\Rules\Properties\LazyReadWritePropertiesExtensionProvider($this->getService('056'));
	}


	public function createService0131(): PHPStan\Rules\Properties\PropertyDescriptor
	{
		return new PHPStan\Rules\Properties\PropertyDescriptor;
	}


	public function createService0132(): PHPStan\Rules\Properties\PropertyReflectionFinder
	{
		return new PHPStan\Rules\Properties\PropertyReflectionFinder;
	}


	public function createService0133(): PHPStan\Rules\RuleLevelHelper
	{
		return new PHPStan\Rules\RuleLevelHelper(
			$this->getService('reflectionProvider'),
			false,
			true,
			false,
			false,
			false,
			false,
			false
		);
	}


	public function createService0134(): PHPStan\Rules\UnusedFunctionParametersCheck
	{
		return new PHPStan\Rules\UnusedFunctionParametersCheck($this->getService('reflectionProvider'));
	}


	public function createService0135(): PHPStan\Type\FileTypeMapper
	{
		return new PHPStan\Type\FileTypeMapper(
			$this->getService('091'),
			$this->getService('defaultAnalysisParser'),
			$this->getService('027'),
			$this->getService('026'),
			$this->getService('016'),
			$this->getService('063')
		);
	}


	public function createService0136(): PHPStan\Type\TypeAliasResolver
	{
		return new PHPStan\Type\UsefulTypeAliasResolver(
			[],
			$this->getService('031'),
			$this->getService('029'),
			$this->getService('reflectionProvider')
		);
	}


	public function createService0137(): PHPStan\Type\TypeAliasResolverProvider
	{
		return new PHPStan\Type\LazyTypeAliasResolverProvider($this->getService('056'));
	}


	public function createService0138(): PHPStan\Type\BitwiseFlagHelper
	{
		return new PHPStan\Type\BitwiseFlagHelper($this->getService('reflectionProvider'));
	}


	public function createService0139(): PHPStan\Type\Php\ArgumentBasedFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArgumentBasedFunctionReturnTypeExtension;
	}


	public function createService0140(): PHPStan\Type\Php\ArrayIntersectKeyFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayIntersectKeyFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0141(): PHPStan\Type\Php\ArrayChunkFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayChunkFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0142(): PHPStan\Type\Php\ArrayColumnFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayColumnFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0143(): PHPStan\Type\Php\ArrayCombineFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayCombineFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0144(): PHPStan\Type\Php\ArrayCurrentDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayCurrentDynamicReturnTypeExtension;
	}


	public function createService0145(): PHPStan\Type\Php\ArrayFillFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayFillFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0146(): PHPStan\Type\Php\ArrayFillKeysFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayFillKeysFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0147(): PHPStan\Type\Php\ArrayFilterFunctionReturnTypeReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayFilterFunctionReturnTypeReturnTypeExtension;
	}


	public function createService0148(): PHPStan\Type\Php\ArrayFlipFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayFlipFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0149(): PHPStan\Type\Php\ArrayKeyDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayKeyDynamicReturnTypeExtension;
	}


	public function createService0150(): PHPStan\Type\Php\ArrayKeyExistsFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\ArrayKeyExistsFunctionTypeSpecifyingExtension;
	}


	public function createService0151(): PHPStan\Type\Php\ArrayKeyFirstDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayKeyFirstDynamicReturnTypeExtension;
	}


	public function createService0152(): PHPStan\Type\Php\ArrayKeyLastDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayKeyLastDynamicReturnTypeExtension;
	}


	public function createService0153(): PHPStan\Type\Php\ArrayKeysFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayKeysFunctionDynamicReturnTypeExtension($this->getService('017'));
	}


	public function createService0154(): PHPStan\Type\Php\ArrayMapFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayMapFunctionReturnTypeExtension;
	}


	public function createService0155(): PHPStan\Type\Php\ArrayMergeFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayMergeFunctionDynamicReturnTypeExtension;
	}


	public function createService0156(): PHPStan\Type\Php\ArrayNextDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayNextDynamicReturnTypeExtension;
	}


	public function createService0157(): PHPStan\Type\Php\ArrayPopFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayPopFunctionReturnTypeExtension;
	}


	public function createService0158(): PHPStan\Type\Php\ArrayRandFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayRandFunctionReturnTypeExtension;
	}


	public function createService0159(): PHPStan\Type\Php\ArrayReduceFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayReduceFunctionReturnTypeExtension;
	}


	public function createService0160(): PHPStan\Type\Php\ArrayReplaceFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayReplaceFunctionReturnTypeExtension;
	}


	public function createService0161(): PHPStan\Type\Php\ArrayReverseFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayReverseFunctionReturnTypeExtension;
	}


	public function createService0162(): PHPStan\Type\Php\ArrayShiftFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayShiftFunctionReturnTypeExtension;
	}


	public function createService0163(): PHPStan\Type\Php\ArraySliceFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArraySliceFunctionReturnTypeExtension;
	}


	public function createService0164(): PHPStan\Type\Php\ArraySpliceFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArraySpliceFunctionReturnTypeExtension;
	}


	public function createService0165(): PHPStan\Type\Php\ArraySearchFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArraySearchFunctionDynamicReturnTypeExtension($this->getService('017'));
	}


	public function createService0166(): PHPStan\Type\Php\ArraySearchFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\ArraySearchFunctionTypeSpecifyingExtension;
	}


	public function createService0167(): PHPStan\Type\Php\ArrayValuesFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayValuesFunctionDynamicReturnTypeExtension($this->getService('017'));
	}


	public function createService0168(): PHPStan\Type\Php\ArraySumFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArraySumFunctionDynamicReturnTypeExtension;
	}


	public function createService0169(): PHPStan\Type\Php\Base64DecodeDynamicFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\Base64DecodeDynamicFunctionReturnTypeExtension;
	}


	public function createService0170(): PHPStan\Type\Php\BcMathStringOrNullReturnTypeExtension
	{
		return new PHPStan\Type\Php\BcMathStringOrNullReturnTypeExtension($this->getService('017'));
	}


	public function createService0171(): PHPStan\Type\Php\ClosureBindDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ClosureBindDynamicReturnTypeExtension;
	}


	public function createService0172(): PHPStan\Type\Php\ClosureBindToDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ClosureBindToDynamicReturnTypeExtension;
	}


	public function createService0173(): PHPStan\Type\Php\ClosureFromCallableDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ClosureFromCallableDynamicReturnTypeExtension;
	}


	public function createService0174(): PHPStan\Type\Php\CompactFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\CompactFunctionReturnTypeExtension(false);
	}


	public function createService0175(): PHPStan\Type\Php\CountFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\CountFunctionReturnTypeExtension;
	}


	public function createService0176(): PHPStan\Type\Php\CountFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\CountFunctionTypeSpecifyingExtension;
	}


	public function createService0177(): PHPStan\Type\Php\CurlGetinfoFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\CurlGetinfoFunctionDynamicReturnTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0178(): PHPStan\Type\Php\CurlInitReturnTypeExtension
	{
		return new PHPStan\Type\Php\CurlInitReturnTypeExtension;
	}


	public function createService0179(): PHPStan\Type\Php\DateFormatFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateFormatFunctionReturnTypeExtension;
	}


	public function createService0180(): PHPStan\Type\Php\DateFormatMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateFormatMethodReturnTypeExtension;
	}


	public function createService0181(): PHPStan\Type\Php\DateFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateFunctionReturnTypeExtension;
	}


	public function createService0182(): PHPStan\Type\Php\DateIntervalConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\DateIntervalConstructorThrowTypeExtension;
	}


	public function createService0183(): PHPStan\Type\Php\DateIntervalDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateIntervalDynamicReturnTypeExtension;
	}


	public function createService0184(): PHPStan\Type\Php\DateTimeCreateDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateTimeCreateDynamicReturnTypeExtension;
	}


	public function createService0185(): PHPStan\Type\Php\DateTimeDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateTimeDynamicReturnTypeExtension;
	}


	public function createService0186(): PHPStan\Type\Php\DateTimeModifyReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateTimeModifyReturnTypeExtension;
	}


	public function createService0187(): PHPStan\Type\Php\DateTimeModifyReturnTypeExtension
	{
		return new PHPStan\Type\Php\DateTimeModifyReturnTypeExtension('DateTimeImmutable');
	}


	public function createService0188(): PHPStan\Type\Php\DateTimeConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\DateTimeConstructorThrowTypeExtension;
	}


	public function createService0189(): PHPStan\Type\Php\DateTimeZoneConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\DateTimeZoneConstructorThrowTypeExtension;
	}


	public function createService0190(): PHPStan\Type\Php\DsMapDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\DsMapDynamicReturnTypeExtension;
	}


	public function createService0191(): PHPStan\Type\Php\DioStatDynamicFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\DioStatDynamicFunctionReturnTypeExtension;
	}


	public function createService0192(): PHPStan\Type\Php\ExplodeFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ExplodeFunctionDynamicReturnTypeExtension($this->getService('017'));
	}


	public function createService0193(): PHPStan\Type\Php\FilterVarDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\FilterVarDynamicReturnTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0194(): PHPStan\Type\Php\GetCalledClassDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\GetCalledClassDynamicReturnTypeExtension;
	}


	public function createService0195(): PHPStan\Type\Php\GetClassDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\GetClassDynamicReturnTypeExtension;
	}


	public function createService0196(): PHPStan\Type\Php\GetParentClassDynamicFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\GetParentClassDynamicFunctionReturnTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0197(): PHPStan\Type\Php\GettimeofdayDynamicFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\GettimeofdayDynamicFunctionReturnTypeExtension;
	}


	public function createService0198(): PHPStan\Type\Php\HashFunctionsReturnTypeExtension
	{
		return new PHPStan\Type\Php\HashFunctionsReturnTypeExtension($this->getService('017'));
	}


	public function createService0199(): PHPStan\Type\Php\IntdivThrowTypeExtension
	{
		return new PHPStan\Type\Php\IntdivThrowTypeExtension;
	}


	public function createService0200(): PHPStan\Type\Php\JsonThrowTypeExtension
	{
		return new PHPStan\Type\Php\JsonThrowTypeExtension($this->getService('reflectionProvider'), $this->getService('0138'));
	}


	public function createService0201(): PHPStan\Type\Php\ReflectionClassConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionClassConstructorThrowTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0202(): PHPStan\Type\Php\ReflectionFunctionConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionFunctionConstructorThrowTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0203(): PHPStan\Type\Php\ReflectionMethodConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionMethodConstructorThrowTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0204(): PHPStan\Type\Php\ReflectionPropertyConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionPropertyConstructorThrowTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0205(): PHPStan\Type\Php\StrContainingTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\StrContainingTypeSpecifyingExtension;
	}


	public function createService0206(): PHPStan\Type\Php\SimpleXMLElementClassPropertyReflectionExtension
	{
		return new PHPStan\Type\Php\SimpleXMLElementClassPropertyReflectionExtension;
	}


	public function createService0207(): PHPStan\Type\Php\SimpleXMLElementConstructorThrowTypeExtension
	{
		return new PHPStan\Type\Php\SimpleXMLElementConstructorThrowTypeExtension;
	}


	public function createService0208(): PHPStan\Type\Php\StatDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\StatDynamicReturnTypeExtension;
	}


	public function createService0209(): PHPStan\Type\Php\MethodExistsTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\MethodExistsTypeSpecifyingExtension;
	}


	public function createService0210(): PHPStan\Type\Php\PropertyExistsTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\PropertyExistsTypeSpecifyingExtension($this->getService('0132'));
	}


	public function createService0211(): PHPStan\Type\Php\MinMaxFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\MinMaxFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0212(): PHPStan\Type\Php\NumberFormatFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\NumberFormatFunctionDynamicReturnTypeExtension;
	}


	public function createService0213(): PHPStan\Type\Php\PathinfoFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\PathinfoFunctionDynamicReturnTypeExtension($this->getService('reflectionProvider'));
	}


	public function createService0214(): PHPStan\Type\Php\PregFilterFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\PregFilterFunctionReturnTypeExtension;
	}


	public function createService0215(): PHPStan\Type\Php\PregSplitDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\PregSplitDynamicReturnTypeExtension($this->getService('0138'));
	}


	public function createService0216(): PHPStan\Type\Php\ReflectionClassIsSubclassOfTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\ReflectionClassIsSubclassOfTypeSpecifyingExtension;
	}


	public function createService0217(): PHPStan\Type\Php\ReplaceFunctionsDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ReplaceFunctionsDynamicReturnTypeExtension;
	}


	public function createService0218(): PHPStan\Type\Php\ArrayPointerFunctionsDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ArrayPointerFunctionsDynamicReturnTypeExtension;
	}


	public function createService0219(): PHPStan\Type\Php\LtrimFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\LtrimFunctionReturnTypeExtension;
	}


	public function createService0220(): PHPStan\Type\Php\MbFunctionsReturnTypeExtension
	{
		return new PHPStan\Type\Php\MbFunctionsReturnTypeExtension($this->getService('017'));
	}


	public function createService0221(): PHPStan\Type\Php\MbConvertEncodingFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\MbConvertEncodingFunctionReturnTypeExtension;
	}


	public function createService0222(): PHPStan\Type\Php\MbSubstituteCharacterDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\MbSubstituteCharacterDynamicReturnTypeExtension($this->getService('017'));
	}


	public function createService0223(): PHPStan\Type\Php\MbStrlenFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\MbStrlenFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0224(): PHPStan\Type\Php\MicrotimeFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\MicrotimeFunctionReturnTypeExtension;
	}


	public function createService0225(): PHPStan\Type\Php\HrtimeFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\HrtimeFunctionReturnTypeExtension;
	}


	public function createService0226(): PHPStan\Type\Php\ImplodeFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ImplodeFunctionReturnTypeExtension;
	}


	public function createService0227(): PHPStan\Type\Php\NonEmptyStringFunctionsReturnTypeExtension
	{
		return new PHPStan\Type\Php\NonEmptyStringFunctionsReturnTypeExtension;
	}


	public function createService0228(): PHPStan\Type\Php\StrCaseFunctionsReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrCaseFunctionsReturnTypeExtension;
	}


	public function createService0229(): PHPStan\Type\Php\StrlenFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrlenFunctionReturnTypeExtension;
	}


	public function createService0230(): PHPStan\Type\Php\StrPadFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrPadFunctionReturnTypeExtension;
	}


	public function createService0231(): PHPStan\Type\Php\StrRepeatFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrRepeatFunctionReturnTypeExtension;
	}


	public function createService0232(): PHPStan\Type\Php\SubstrDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\SubstrDynamicReturnTypeExtension;
	}


	public function createService0233(): PHPStan\Type\Php\ThrowableReturnTypeExtension
	{
		return new PHPStan\Type\Php\ThrowableReturnTypeExtension;
	}


	public function createService0234(): PHPStan\Type\Php\ParseUrlFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\ParseUrlFunctionDynamicReturnTypeExtension;
	}


	public function createService0235(): PHPStan\Type\Php\TriggerErrorDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\TriggerErrorDynamicReturnTypeExtension;
	}


	public function createService0236(): PHPStan\Type\Php\VersionCompareFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\VersionCompareFunctionDynamicReturnTypeExtension;
	}


	public function createService0237(): PHPStan\Type\Php\PowFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\PowFunctionReturnTypeExtension;
	}


	public function createService0238(): PHPStan\Type\Php\RoundFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\RoundFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0239(): PHPStan\Type\Php\StrtotimeFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrtotimeFunctionReturnTypeExtension;
	}


	public function createService0240(): PHPStan\Type\Php\RandomIntFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\RandomIntFunctionReturnTypeExtension;
	}


	public function createService0241(): PHPStan\Type\Php\RangeFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\RangeFunctionReturnTypeExtension;
	}


	public function createService0242(): PHPStan\Type\Php\AssertFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\AssertFunctionTypeSpecifyingExtension;
	}


	public function createService0243(): PHPStan\Type\Php\ClassExistsFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\ClassExistsFunctionTypeSpecifyingExtension;
	}


	public function createService0244(): PHPStan\Type\Php\ClassImplementsFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\ClassImplementsFunctionReturnTypeExtension;
	}


	public function createService0245(): PHPStan\Type\Php\DefineConstantTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\DefineConstantTypeSpecifyingExtension;
	}


	public function createService0246(): PHPStan\Type\Php\DefinedConstantTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\DefinedConstantTypeSpecifyingExtension;
	}


	public function createService0247(): PHPStan\Type\Php\FunctionExistsFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\FunctionExistsFunctionTypeSpecifyingExtension;
	}


	public function createService0248(): PHPStan\Type\Php\InArrayFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\InArrayFunctionTypeSpecifyingExtension;
	}


	public function createService0249(): PHPStan\Type\Php\IsArrayFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\IsArrayFunctionTypeSpecifyingExtension(false);
	}


	public function createService0250(): PHPStan\Type\Php\IsCallableFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\IsCallableFunctionTypeSpecifyingExtension($this->getService('0209'));
	}


	public function createService0251(): PHPStan\Type\Php\IsIterableFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\IsIterableFunctionTypeSpecifyingExtension;
	}


	public function createService0252(): PHPStan\Type\Php\IsSubclassOfFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\IsSubclassOfFunctionTypeSpecifyingExtension($this->getService('0255'));
	}


	public function createService0253(): PHPStan\Type\Php\IteratorToArrayFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\IteratorToArrayFunctionReturnTypeExtension;
	}


	public function createService0254(): PHPStan\Type\Php\IsAFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\IsAFunctionTypeSpecifyingExtension($this->getService('0255'));
	}


	public function createService0255(): PHPStan\Type\Php\IsAFunctionTypeSpecifyingHelper
	{
		return new PHPStan\Type\Php\IsAFunctionTypeSpecifyingHelper;
	}


	public function createService0256(): PHPStan\Type\Php\CtypeDigitFunctionTypeSpecifyingExtension
	{
		return new PHPStan\Type\Php\CtypeDigitFunctionTypeSpecifyingExtension;
	}


	public function createService0257(): PHPStan\Type\Php\JsonThrowOnErrorDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\JsonThrowOnErrorDynamicReturnTypeExtension(
			$this->getService('reflectionProvider'),
			$this->getService('0138')
		);
	}


	public function createService0258(): PHPStan\Type\Php\TypeSpecifyingFunctionsDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\TypeSpecifyingFunctionsDynamicReturnTypeExtension(
			$this->getService('reflectionProvider'),
			true,
			['stdClass'],
			false
		);
	}


	public function createService0259(): PHPStan\Type\Php\SimpleXMLElementAsXMLMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\SimpleXMLElementAsXMLMethodReturnTypeExtension;
	}


	public function createService0260(): PHPStan\Type\Php\SimpleXMLElementXpathMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\SimpleXMLElementXpathMethodReturnTypeExtension;
	}


	public function createService0261(): PHPStan\Type\Php\StrSplitFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrSplitFunctionReturnTypeExtension($this->getService('017'));
	}


	public function createService0262(): PHPStan\Type\Php\StrTokFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrTokFunctionReturnTypeExtension;
	}


	public function createService0263(): PHPStan\Type\Php\SprintfFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\SprintfFunctionDynamicReturnTypeExtension;
	}


	public function createService0264(): PHPStan\Type\Php\SscanfFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\SscanfFunctionDynamicReturnTypeExtension;
	}


	public function createService0265(): PHPStan\Type\Php\StrvalFamilyFunctionReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrvalFamilyFunctionReturnTypeExtension;
	}


	public function createService0266(): PHPStan\Type\Php\StrWordCountFunctionDynamicReturnTypeExtension
	{
		return new PHPStan\Type\Php\StrWordCountFunctionDynamicReturnTypeExtension;
	}


	public function createService0267(): PHPStan\Type\Php\XMLReaderOpenReturnTypeExtension
	{
		return new PHPStan\Type\Php\XMLReaderOpenReturnTypeExtension;
	}


	public function createService0268(): PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension('ReflectionClass');
	}


	public function createService0269(): PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension('ReflectionClassConstant');
	}


	public function createService0270(): PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension('ReflectionFunctionAbstract');
	}


	public function createService0271(): PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension('ReflectionParameter');
	}


	public function createService0272(): PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension
	{
		return new PHPStan\Type\Php\ReflectionGetAttributesMethodReturnTypeExtension('ReflectionProperty');
	}


	public function createService0273(): PHPStan\Type\Php\DatePeriodConstructorReturnTypeExtension
	{
		return new PHPStan\Type\Php\DatePeriodConstructorReturnTypeExtension;
	}


	public function createService0274(): PHPStan\Type\ClosureTypeFactory
	{
		return new PHPStan\Type\ClosureTypeFactory(
			$this->getService('073'),
			$this->getService('0280'),
			$this->getService('originalBetterReflectionReflector'),
			$this->getService('currentPhpVersionPhpParser')
		);
	}


	public function createService0275(): PHPStan\Type\Constant\OversizedArrayBuilder
	{
		return new PHPStan\Type\Constant\OversizedArrayBuilder;
	}


	public function createService0276(): PHPStan\Reflection\BetterReflection\BetterReflectionSourceLocatorFactory
	{
		return new PHPStan\Reflection\BetterReflection\BetterReflectionSourceLocatorFactory(
			$this->getService('phpParserDecorator'),
			$this->getService('php8PhpParser'),
			$this->getService('0279'),
			$this->getService('0280'),
			$this->getService('083'),
			$this->getService('080'),
			$this->getService('078'),
			$this->getService('081'),
			$this->getService('077'),
			[],
			[],
			$this->parameters['analysedPaths'],
			[],
			$this->parameters['analysedPathsFromConfig'],
			$this->parameters['singleReflectionFile']
		);
	}


	public function createService0277(): PHPStan\Reflection\BetterReflection\BetterReflectionProviderFactory
	{
		return new class ($this) implements PHPStan\Reflection\BetterReflection\BetterReflectionProviderFactory {
			private $container;


			public function __construct(Container_e7b6a746ea $container)
			{
				$this->container = $container;
			}


			public function create(PHPStan\BetterReflection\Reflector\Reflector $reflector): PHPStan\Reflection\BetterReflection\BetterReflectionProvider
			{
				return new PHPStan\Reflection\BetterReflection\BetterReflectionProvider(
					$this->container->getService('091'),
					$this->container->getService('073'),
					$this->container->getService('059'),
					$reflector,
					$this->container->getService('0135'),
					$this->container->getService('025'),
					$this->container->getService('017'),
					$this->container->getService('092'),
					$this->container->getService('stubPhpDocProvider'),
					$this->container->getService('072'),
					$this->container->getService('relativePathHelper'),
					$this->container->getService('016'),
					$this->container->getService('063'),
					$this->container->getService('0279')
				);
			}
		};
	}


	public function createService0278(): PHPStan\Reflection\BetterReflection\SourceStubber\PhpStormStubsSourceStubberFactory
	{
		return new PHPStan\Reflection\BetterReflection\SourceStubber\PhpStormStubsSourceStubberFactory(
			$this->getService('php8PhpParser'),
			$this->getService('017')
		);
	}


	public function createService0279(): PHPStan\BetterReflection\SourceLocator\SourceStubber\PhpStormStubsSourceStubber
	{
		return $this->getService('0278')->create();
	}


	public function createService0280(): PHPStan\BetterReflection\SourceLocator\SourceStubber\ReflectionSourceStubber
	{
		return new PHPStan\BetterReflection\SourceLocator\SourceStubber\ReflectionSourceStubber;
	}


	public function createService0281(): PHPStan\Command\ErrorFormatter\CiDetectedErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\CiDetectedErrorFormatter(
			$this->getService('errorFormatter.github'),
			$this->getService('errorFormatter.teamcity')
		);
	}


	public function createService0282(): Rector\NodeTypeResolver\Reflection\BetterReflection\RectorBetterReflectionSourceLocatorFactory
	{
		return new Rector\NodeTypeResolver\Reflection\BetterReflection\RectorBetterReflectionSourceLocatorFactory(
			$this->getService('0276'),
			$this->getService('0283')
		);
	}


	public function createService0283(): Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocator\IntermediateSourceLocator
	{
		return new Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocator\IntermediateSourceLocator([
			$this->getService('0284'),
		]);
	}


	public function createService0284(): Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocatorProvider\DynamicSourceLocatorProvider
	{
		return new Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocatorProvider\DynamicSourceLocatorProvider(
			$this->getService('077'),
			$this->getService('017')
		);
	}


	public function createServiceBetterReflectionClassReflector(): PHPStan\BetterReflection\Reflector\ClassReflector
	{
		return new PHPStan\BetterReflection\Reflector\ClassReflector($this->getService('betterReflectionSourceLocator'));
	}


	public function createServiceBetterReflectionConstantReflector(): PHPStan\BetterReflection\Reflector\ConstantReflector
	{
		return new PHPStan\BetterReflection\Reflector\ConstantReflector($this->getService('betterReflectionSourceLocator'));
	}


	public function createServiceBetterReflectionFunctionReflector(): PHPStan\BetterReflection\Reflector\FunctionReflector
	{
		return new PHPStan\BetterReflection\Reflector\FunctionReflector($this->getService('betterReflectionSourceLocator'));
	}


	public function createServiceBetterReflectionProvider(): PHPStan\Reflection\BetterReflection\BetterReflectionProvider
	{
		return new PHPStan\Reflection\BetterReflection\BetterReflectionProvider(
			$this->getService('091'),
			$this->getService('073'),
			$this->getService('059'),
			$this->getService('betterReflectionReflector'),
			$this->getService('0135'),
			$this->getService('025'),
			$this->getService('017'),
			$this->getService('092'),
			$this->getService('stubPhpDocProvider'),
			$this->getService('072'),
			$this->getService('relativePathHelper'),
			$this->getService('016'),
			$this->getService('063'),
			$this->getService('0279')
		);
	}


	public function createServiceBetterReflectionReflector(): PHPStan\Reflection\BetterReflection\Reflector\MemoizingReflector
	{
		return new PHPStan\Reflection\BetterReflection\Reflector\MemoizingReflector($this->getService('originalBetterReflectionReflector'));
	}


	public function createServiceBetterReflectionSourceLocator(): PHPStan\BetterReflection\SourceLocator\Type\SourceLocator
	{
		return $this->getService('0282')->create();
	}


	public function createServiceBroker(): PHPStan\Broker\Broker
	{
		return $this->getService('brokerFactory')->create();
	}


	public function createServiceBrokerFactory(): PHPStan\Broker\BrokerFactory
	{
		return new PHPStan\Broker\BrokerFactory($this->getService('056'));
	}


	public function createServiceCacheStorage(): PHPStan\Cache\FileCacheStorage
	{
		return new PHPStan\Cache\FileCacheStorage('/home/phpnuke/public_html/vendor/rector/rector/packages/NodeTypeResolver/DependencyInjection/cache/PHPStan');
	}


	public function createServiceCachedRectorParser(): PHPStan\Parser\CachedParser
	{
		return new PHPStan\Parser\CachedParser($this->getService('rectorParser'), 256);
	}


	public function createServiceContainer(): Container_e7b6a746ea
	{
		return $this;
	}


	public function createServiceCurrentPhpVersionLexer(): PhpParser\Lexer
	{
		return $this->getService('02')->create();
	}


	public function createServiceCurrentPhpVersionPhpParser(): PhpParser\Parser\Php7
	{
		return new PhpParser\Parser\Php7($this->getService('currentPhpVersionLexer'));
	}


	public function createServiceCurrentPhpVersionRichParser(): PHPStan\Parser\RichParser
	{
		return new PHPStan\Parser\RichParser(
			$this->getService('currentPhpVersionPhpParser'),
			$this->getService('currentPhpVersionLexer'),
			$this->getService('03'),
			$this->getService('056')
		);
	}


	public function createServiceCurrentPhpVersionSimpleDirectParser(): PHPStan\Parser\SimpleParser
	{
		return new PHPStan\Parser\SimpleParser($this->getService('currentPhpVersionPhpParser'), $this->getService('03'));
	}


	public function createServiceCurrentPhpVersionSimpleParser(): PHPStan\Parser\CleaningParser
	{
		return new PHPStan\Parser\CleaningParser($this->getService('currentPhpVersionSimpleDirectParser'), $this->getService('017'));
	}


	public function createServiceDefaultAnalysisParser(): PHPStan\Parser\PathRoutingParser
	{
		return $this->getService('pathRoutingParser');
	}


	public function createServiceErrorFormatter__checkstyle(): PHPStan\Command\ErrorFormatter\CheckstyleErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\CheckstyleErrorFormatter($this->getService('simpleRelativePathHelper'));
	}


	public function createServiceErrorFormatter__github(): PHPStan\Command\ErrorFormatter\GithubErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\GithubErrorFormatter($this->getService('simpleRelativePathHelper'));
	}


	public function createServiceErrorFormatter__gitlab(): PHPStan\Command\ErrorFormatter\GitlabErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\GitlabErrorFormatter($this->getService('simpleRelativePathHelper'));
	}


	public function createServiceErrorFormatter__json(): PHPStan\Command\ErrorFormatter\JsonErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\JsonErrorFormatter(false);
	}


	public function createServiceErrorFormatter__junit(): PHPStan\Command\ErrorFormatter\JunitErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\JunitErrorFormatter($this->getService('simpleRelativePathHelper'));
	}


	public function createServiceErrorFormatter__prettyJson(): PHPStan\Command\ErrorFormatter\JsonErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\JsonErrorFormatter(true);
	}


	public function createServiceErrorFormatter__raw(): PHPStan\Command\ErrorFormatter\RawErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\RawErrorFormatter;
	}


	public function createServiceErrorFormatter__table(): PHPStan\Command\ErrorFormatter\TableErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\TableErrorFormatter(
			$this->getService('relativePathHelper'),
			$this->getService('simpleRelativePathHelper'),
			$this->getService('0281'),
			true,
			null,
			null
		);
	}


	public function createServiceErrorFormatter__teamcity(): PHPStan\Command\ErrorFormatter\TeamcityErrorFormatter
	{
		return new PHPStan\Command\ErrorFormatter\TeamcityErrorFormatter($this->getService('simpleRelativePathHelper'));
	}


	public function createServiceExceptionTypeResolver(): PHPStan\Rules\Exceptions\ExceptionTypeResolver
	{
		return $this->getService('0104');
	}


	public function createServiceFileExcluderAnalyse(): PHPStan\File\FileExcluder
	{
		return $this->getService('064')->createAnalyseFileExcluder();
	}


	public function createServiceFileExcluderScan(): PHPStan\File\FileExcluder
	{
		return $this->getService('064')->createScanFileExcluder();
	}


	public function createServiceFileFinderAnalyse(): PHPStan\File\FileFinder
	{
		return new PHPStan\File\FileFinder($this->getService('fileExcluderAnalyse'), $this->getService('063'), ['php']);
	}


	public function createServiceFileFinderScan(): PHPStan\File\FileFinder
	{
		return new PHPStan\File\FileFinder($this->getService('fileExcluderScan'), $this->getService('063'), ['php']);
	}


	public function createServiceNodeScopeResolverReflector(): PHPStan\Reflection\BetterReflection\Reflector\MemoizingReflector
	{
		return $this->getService('betterReflectionReflector');
	}


	public function createServiceOriginalBetterReflectionReflector(): PHPStan\BetterReflection\Reflector\DefaultReflector
	{
		return new PHPStan\BetterReflection\Reflector\DefaultReflector($this->getService('betterReflectionSourceLocator'));
	}


	public function createServiceParentDirectoryRelativePathHelper(): PHPStan\File\ParentDirectoryRelativePathHelper
	{
		return new PHPStan\File\ParentDirectoryRelativePathHelper('/home/phpnuke/public_html');
	}


	public function createServicePathRoutingParser(): PHPStan\Parser\PathRoutingParser
	{
		return new PHPStan\Parser\PathRoutingParser(
			$this->getService('063'),
			$this->getService('cachedRectorParser'),
			$this->getService('cachedRectorParser'),
			$this->getService('php8Parser'),
			$this->parameters['singleReflectionFile']
		);
	}


	public function createServicePhp8Lexer(): PhpParser\Lexer\Emulative
	{
		return $this->getService('02')->createEmulative();
	}


	public function createServicePhp8Parser(): PHPStan\Parser\SimpleParser
	{
		return new PHPStan\Parser\SimpleParser($this->getService('php8PhpParser'), $this->getService('03'));
	}


	public function createServicePhp8PhpParser(): PhpParser\Parser\Php7
	{
		return new PhpParser\Parser\Php7($this->getService('php8Lexer'));
	}


	public function createServicePhpParserDecorator(): PHPStan\Parser\PhpParserDecorator
	{
		return new PHPStan\Parser\PhpParserDecorator($this->getService('defaultAnalysisParser'));
	}


	public function createServiceRectorParser(): PHPStan\Parser\RichParser
	{
		return new PHPStan\Parser\RichParser(
			$this->getService('currentPhpVersionPhpParser'),
			$this->getService('currentPhpVersionLexer'),
			$this->getService('03'),
			$this->getService('056')
		);
	}


	public function createServiceReflectionProvider(): PHPStan\Reflection\ReflectionProvider
	{
		return $this->getService('reflectionProviderFactory')->create();
	}


	public function createServiceReflectionProviderFactory(): PHPStan\Reflection\ReflectionProvider\ReflectionProviderFactory
	{
		return new PHPStan\Reflection\ReflectionProvider\ReflectionProviderFactory($this->getService('betterReflectionProvider'));
	}


	public function createServiceRegistry(): PHPStan\Rules\LazyRegistry
	{
		return new PHPStan\Rules\LazyRegistry($this->getService('056'));
	}


	public function createServiceRelativePathHelper(): PHPStan\File\RelativePathHelper
	{
		return new PHPStan\File\FuzzyRelativePathHelper(
			$this->getService('parentDirectoryRelativePathHelper'),
			'/home/phpnuke/public_html',
			$this->parameters['analysedPaths']
		);
	}


	public function createServiceRules__0(): PHPStan\Rules\Debug\DumpTypeRule
	{
		return new PHPStan\Rules\Debug\DumpTypeRule($this->getService('reflectionProvider'));
	}


	public function createServiceRules__1(): PHPStan\Rules\Debug\FileAssertRule
	{
		return new PHPStan\Rules\Debug\FileAssertRule($this->getService('reflectionProvider'));
	}


	public function createServiceSimpleRelativePathHelper(): PHPStan\File\RelativePathHelper
	{
		return new PHPStan\File\SimpleRelativePathHelper('/home/phpnuke/public_html');
	}


	public function createServiceStubPhpDocProvider(): PHPStan\PhpDoc\StubPhpDocProvider
	{
		return new PHPStan\PhpDoc\StubPhpDocProvider(
			$this->getService('defaultAnalysisParser'),
			$this->getService('0135'),
			$this->getService('034')
		);
	}


	public function createServiceTypeSpecifier(): PHPStan\Analyser\TypeSpecifier
	{
		return $this->getService('typeSpecifierFactory')->create();
	}


	public function createServiceTypeSpecifierFactory(): PHPStan\Analyser\TypeSpecifierFactory
	{
		return new PHPStan\Analyser\TypeSpecifierFactory($this->getService('056'));
	}


	public function initialize()
	{
	}
}
