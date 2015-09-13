<?php
$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['typeicons']['60'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('dinner_club') . 'Resources/Public/Icons/favicon.ico';
$GLOBALS['TCA']['tx_news_domain_model_news']['types'][60] = $GLOBALS['TCA']['tx_news_domain_model_news']['types'][0];
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['config']['items'][] = array("Dinner Club", 60);
