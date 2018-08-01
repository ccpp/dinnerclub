<?php
namespace CP\Dinnerclub\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use GeorgRinger\News\Domain\Model\News;
use NN\NnAddress\Domain\Model\Person;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

class DinnerclubEvent extends News {

	/**
	 * This can be either a PersonRepository or a FrontendUserRepository, dependent on the value.
	 * Unfortunately, extbase cannot handle this: the type can not depend on the value (@see \TYPO3\Extbase\Persistence\Generic\Mapper\DataMapFactory::buildDataMapInternal)
	 * @var \string
	 */
	protected $cook;

	/**
	 * @var \string
	 */
	protected $contactPerson;

	/**
	 * @var \integer
	 */
	public $registrationLimit;

	/**
	 * @var TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject @lazy
	 */
	protected $_objectManager;

	/**
	 * @var \NN\NnAddress\Domain\Repository\PersonRepository
	 * @lazy
	 */
	protected $_personRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 * @lazy
	 */
	protected $_frontendUserRepository;

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $_registrationRepository;

	/**
	 * @var string
	 */
	protected $notificationEmails;

	/**
	 * @var DateTime
	 */
	public $lastNotification;


	/**
	 * @return \Object
	 */
	public function getCook() {
		return $this->stringToObject($this->cook);
	}

	/**
	 * @return \Object
	 */
	public function getContactPerson() {
		return $this->stringToObject($this->contactPerson);
	}


	protected function stringToObject($ref) {
		if(preg_match('/^(.*)_([0-9]*)$/', $ref, $matches)) {
			switch($matches[1]) {
			case 'fe_users':
				$result = $this->_frontendUserRepository->findByUid($matches[2]);
				$result->mails = array(
					0 => array('email' => $result->getEmail()),
				);
				return $result;
			case 'tx_nnaddress_domain_model_person':
				if (!ExtensionManagementUtility::isLoaded('nn_address')) {
					return;
				}

				if (!$this->_personRepository) {
					$this->_personRepository = $this->_objectManager->get('NN\NnAddress\Domain\Repository\PersonRepository');
				}
				return $this->_personRepository->findByUid($matches[2]);
			}
		}
		return $this->cook;
	}

	/**
	 * Counts the number of persons registered for this event
	 * @return int
	 */
	public function countPersons() {
		$sum = 0;
		foreach ($this->_registrationRepository->findByEvent($this) as $registration) {
			$sum -= $registration->originalCount;
			$sum += $registration->count;
		}
		return $sum;
	}

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
