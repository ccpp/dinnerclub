<?php
defined('TYPO3_MODE') or die();

return array(
	'ctrl' => array(
		'title' => 'Dinnerclub registration',
		'label' => 'name',
		'searchFields' => 'name',
	),
	'types' => array(
		'0' => array(
			'showitem' => 'event, name, count, vegetarian, original_count, accepted_guidelines'
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
		'vegetarian' => array(
			'label' => 'Count Vegetarians',
			'config' => array(
				'type' => 'input',
				'eval' => 'int',
			),
		),
		'vegan' => array(
			'label' => 'Count Vegans',
			'config' => array(
				'type' => 'input',
				'eval' => 'int',
			),
		),
		'original_count' => array(
			'label' => 'Original count',
			'config' => array(
				'type' => 'input',
				'eval' => 'int,required',
			),
		),
		'accepted_guidelines' => array(
			'exclude' => 1,
			'label' => 'Akzeptierte Bedingungen',
			'config' => array(
				'type' => 'input',
				'readOnly' => 1,
			),
		),
	),
);
