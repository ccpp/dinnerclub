<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('dinnerclub', 'Configuration/TypoScript', 'Dinnerclub');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('dinnerclub', 'Configuration/TypoScript/DirectMail', 'Dinnerclub Newsletter');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'dinnerclub',
	'piRegistration',
	'Dinnerclub Registration'
);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
	\TYPO3\CMS\Core\Imaging\IconRegistry::class
)->registerIcon(
	'dinnerclub',
	\TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
	['source' => 'EXT:dinnerclub/Resources/Public/Icons/favicon.ico']
);
