<?php
namespace CP\DinnerclubExt\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use GeorgRinger\News\Domain\Model\News;

class DinnerclubEvent extends \CP\Dinnerclub\Domain\Model\DinnerclubEvent {

	/**
	 * @var string
	 */
	protected $notificationEmails;

	/**
	 * @return array
	 */
	public function getNotificationEmails() {
		return GeneralUtility::trimExplode(",", $this->notificationEmails, true);
	}

	/**
	 * @param array
	 * @return void
	 */
	public function setNotificationEmails($notificationEmails) {
		if (is_array($notificationEmails)) {
			$notificationEmails = implode(", ", $notificationEmails);
		}
		$this->notificationEmails = $notificationEmails;
	}
}
