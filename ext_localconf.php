<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
tx_news.templateLayouts {
	53 =  --div--,Dinner Club
	54 = Startansicht
	55 = Registration
	56 = Detailansicht ohne Registration
	57 = Detailansicht mit Anmeldungen
}
');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'CP.DinnerClub',
	'piRegistration',
	array(
		'Registration' => 'confirm, register'
	),
	array(
		'Registration' => 'confirm, register'
	)
);
