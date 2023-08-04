<?php
declare(strict_types = 1);

return array(
	\GeorgRinger\News\Domain\Model\News::class => array(
		'subclasses' => array(
			60 => \CP\Dinnerclub\Domain\Model\DinnerclubEvent::class,
		),
	),
	\CP\Dinnerclub\Domain\Model\Dinnerclub::class => array(
		'tableName' => 'tx_news_domain_model_news',
		'recordType' => 60,
	),
);
