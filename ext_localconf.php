<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
tx_news.templateLayouts {
	53 =  --div--,Dinnerclub
	54 = Startansicht
	55 = Registration
	56 = Detailansicht ohne Registration
	57 = Detailansicht mit Anmeldungen
	58 = Ab-/Ummeldungsformular
}
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
