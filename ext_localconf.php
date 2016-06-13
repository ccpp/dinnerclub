<?php

// Add login action to existing plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'CP.Dinnerclub',
	'piRegistration',
	array(
		'Registration' => 'register, anonymousLogin'
	),
	array(
		'Registration' => 'register, anonymousLogin'
	)
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['headerNoCache'][$_EXTKEY] = "CP\\DinnerclubExt\\Hooks\\TypoScriptFrontendHook->checkCacheHook";
