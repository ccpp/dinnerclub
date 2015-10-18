<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
<INCLUDE_TYPOSCRIPT: source="FiLE:EXT:dinnerclub/Configuration/TSconfig/rte.ts">
<INCLUDE_TYPOSCRIPT: source="FiLE:EXT:dinnerclub/Configuration/TSconfig/news.ts">
');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'CP.Dinnerclub',
	'piRegistration',
	array(
		'Registration' => 'confirm, register'
	),
	array(
		'Registration' => 'confirm, register'
	)
);
