<?php
namespace CP\DinnerclubExt\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use GeorgRinger\News\Domain\Model\News;
use NN\NnAddress\Domain\Model\Person;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

class DinnerclubEvent extends \CP\Dinnerclub\Domain\Model\DinnerclubEvent {

	/**
	 * @var string
	 */
	protected $notificationEmails;

	/**
	 * @var DateTime
	 */
	public $lastNotification;

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

	/**
	 * @return array
	 */
	public function getCookEmails() {
		$cook = $this->getCook();
		return $cook ? $this->extractEmails($cook) : array();
	}

	/**
	 * @return array
	 */
	public function getContactPersonEmails() {
		$contactPerson = $this->getContactPerson();
		return $contactPerson ? $this->extractEmails($contactPerson) : array();
	}

	/**
	 * @param \Object
	 * @return array
	 */
	protected function extractEmails($person) {
		if (!is_object($person)) {
			return;
		}

		$mails = array();

		$name = $person->getFirstName() . ' ' . $person->getLastName();
		if ($person instanceof Person) {
			foreach ($person->getMails() as $mail) {
				$mails [$mail->getEmail()] = $name;
			}
		} elseif ($person instanceof FrontendUser) {
			$mails [$person->getEmail()]= $name;
		} else {
			throw new \Exception("Invalid person class");
		}
		return $mails;
	}
}
