<?php
defined('TYPO3_MODE') or die();

return array(
	'ctrl' => array(
		'title' => 'Dinnerclub registration',
		'label' => 'name',
	),
	'types' => array(
		'0' => array(
			'showitem' => 'event, name, count, original_count'
		)
	),
	'columns' => array(
		'event' => array(
			'label' => 'Event',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_news_domain_model_news',
				'eval' => 'required',
			),
		),
		'name' => array(
			'label' => 'Name',
			'config' => array(
				'type' => 'input',
				'eval' => 'required',
			),
		),
		'count' => array(
			'label' => 'Count',
			'config' => array(
				'type' => 'input',
				'eval' => 'int,required',
			),
		),
		'original_count' => array(
			'label' => 'Original count',
			'config' => array(
				'type' => 'input',
				'eval' => 'int,required',
			),
		),
	),
);
