<?php
defined('TYPO3_MODE') or die();

return array(
	'ctrl' => array(
		'title' => 'Dinner Club registration',
		'label' => 'name',
	),
	'types' => array(
		'0' => array(
			'showitem' => 'event, name, count'
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
	),
);
