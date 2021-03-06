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
