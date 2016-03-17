<?php
namespace CP\Dinnerclub\Domain\Model;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
	protected $cookEmails;

	/**
	 * @var \string
	 */
	protected $contactPerson;


	/**
	 * @var \NN\NnAddress\Domain\Repository\PersonRepository
	 * @inject
	 * @lazy
	 */
	protected $personRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 * @lazy
	 */
	protected $frontendUserRepository;

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;


	/**
	 * @return \Object
	 */
	public function getCooks() {
		return $this->stringToObjects('tx_dinnerclub_cook', $this->cook);
	}

	/**
	 * @return \Object
	 */
	public function getContactPersons() {
		return $this->stringToObjects('tx_dinnerclub_contactperson', $this->contactPerson);
	}

	/**
	 * @return array
	 */
	public function getCookEmails() {
		return $this->extractEmails($this->getCooks());
	}

	public function getContactPersonEmails() {
		return $this->extractEmails($this->getContactPersons());
	}


	protected function stringToObjects($column, $ref) {
		$rm = GeneralUtility::makeInstance('TYPO3\CMS\Core\Database\RelationHandler');
		$tca = $GLOBALS['TCA']['tx_news_domain_model_news']['columns'][$column];
		$rm->start(
			$this->cook,
			$tca['config']['allowed'],
			$tca['config']['MM'],
			$this->getUid(),
			'tx_news_domain_model_news',
			$tca);

		$result = array();
		foreach ($rm->itemArray as $ref) {
			switch($ref['table']) {
			case 'fe_users':
				$result []= $this->frontendUserRepository->findByUid($ref['id']);
				break;
			case 'tx_nnaddress_domain_model_person':
				$result []= $this->personRepository->findByUid($ref['id']);
				break;
			}
		}
		return $result;
	}

	protected function extractEmails($persons) {
		$mails = array();
		foreach ($persons as $person) {
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
		}
		return $mails;
	}

	/**
	 * Counts the number of persons registered for this event
	 * @return int
	 */
	public function countPersons() {
		$sum = 0;
		foreach ($this->registrationRepository->findByEvent($this) as $registration) {
			$sum -= $registration->originalCount;
			$sum += $registration->count;
		}
		return $sum;
	}
}
