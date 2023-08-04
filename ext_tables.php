<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('dinnerclub', 'Configuration/TypoScript', 'Dinnerclub');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('dinnerclub', 'Configuration/TypoScript/DirectMail', 'Dinnerclub Newsletter');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'dinnerclub',
	'piRegistration',
	'Dinnerclub Registration'
);
