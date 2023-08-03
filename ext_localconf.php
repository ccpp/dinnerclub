<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
<INCLUDE_TYPOSCRIPT: source="FiLE:EXT:dinnerclub/Configuration/TSconfig/rte.ts">
<INCLUDE_TYPOSCRIPT: source="FiLE:EXT:dinnerclub/Configuration/TSconfig/news.ts">
<INCLUDE_TYPOSCRIPT: source="FiLE:EXT:dinnerclub/Configuration/TSconfig/tt_content.ts">
');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'CP.Dinnerclub',
	'piRegistration',
	array(
		'Registration' => 'register'
	),
	array(
		'Registration' => 'register'
	)
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
	'CP\Dinnerclub\Controller\DinnerclubCommandController';

// TODO og:image should be  1.9 : 1


if (!$_SERVER['REQUEST_URI'] == '/browserconfig.xml') {
	//$_SERVER['REQUEST_URI'] = '/';
	//$_GET['type'] = 98;
	#$_GET['eID'] = $_EXTKEY;

	// Stop realurl:
	$_SERVER['SCRIPT_NAME'] = '';
	$_SERVER['PATH_INFO'] = '';
}
