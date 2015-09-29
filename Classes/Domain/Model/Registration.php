<?php
namespace CP\Dinnerclub\Domain\Model;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use GeorgRinger\News\Domain\Model\News;

class Registration extends AbstractEntity {
	/**
	 * @var \GeorgRinger\News\Domain\Model\News
	 */
	public $event;

	/**
	 * @var \string
	 */
	public $name;

	/**
	 * @var \int
	 */
	public $count;

	/**
	 * @var \int
	 */
	public $vegetarian;
}
