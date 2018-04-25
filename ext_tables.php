<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Dinnerclub');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'piRegistration',
	'Dinnerclub Registration'
);

// This does always not work in Configuration/TCA/Overrides/tx_news_domain_model_news
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'tx_dinnerclub_notification_emails', '60', 'after:bodytext');
