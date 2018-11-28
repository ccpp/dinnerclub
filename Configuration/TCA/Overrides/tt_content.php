<?php

$GLOBALS['TCA']['tt_content']['palettes']['background'] = array(
	'showitem' => 'tx_dinnerclubtheme_backgroundcolor,tx_dinnerclubtheme_backgroundimage',
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'tt_content',
	'--palette--;Hintergrund;background',
	'',
	'after:section_frame');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
	'tt_content', array(
		'tx_dinnerclubtheme_backgroundcolor' => array(
			'label' => 'Hintergrund',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('keiner / transparent', 0),
					array('dunkel', 1),
					array('parallax', 2),
				),
			),
		),
		'tx_dinnerclubtheme_backgroundimage' => array(
			'label' => 'Hintergrundbild',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'tx_dinnerclubtheme_backgroundimage',
				array(
				),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
	));
