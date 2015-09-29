<?php

// Add TCA type 60 (Dinnerclub event)

$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['typeicons']['60'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('dinnerclub') . 'Resources/Public/Icons/favicon.ico';
$GLOBALS['TCA']['tx_news_domain_model_news']['types'][60] = $GLOBALS['TCA']['tx_news_domain_model_news']['types'][0];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['config']['items'][] = array("Dinnerclub event", 60);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'tx_dinnerclub_cook,tx_dinnerclub_contactperson', '60', 'after:bodytext');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', array(
	'tx_dinnerclub_cook' => array(
		'exclude' => 1,
		'label' => 'Koch / Kochteam',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'fe_users,tx_nnaddress_domain_model_person',
			'prepend_tname' => true,
			'size' => 1,
			'maxitems' => 1,
			'minitems' => 0,
			'show_thumbs' => true,
			'wizards' => array(
				array(
					'type' => 'suggest'
				),
			),
		),
	),
	'tx_dinnerclub_contactperson' => array(
		'exclude' => 1,
		'label' => 'Kontaktperson (DC Team)',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'fe_users,tx_nnaddress_domain_model_person',
			'prepend_tname' => true,
			'size' => 1,
			'maxitems' => 1,
			'minitems' => 0,
			'show_thumbs' => true,
			'wizards' => array(
				array(
					'type' => 'suggest'
				),
			),
		),
	),
));
