<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'tx_dinnerclub_notification_emails', '60', 'after:bodytext');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', array(
	'tx_dinnerclub_notification_emails' => array(
		'exclude' => 1,
		'label' => 'Benachrichtigungs-E-Mail(s)',
		'config' => array(
			'type' => 'input',
		),
	),
));

