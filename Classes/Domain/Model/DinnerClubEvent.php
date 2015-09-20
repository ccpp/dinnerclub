<?php
namespace CP\DinnerClub\Domain\Model;
use GeorgRinger\News\Domain\Model\News;

class DinnerClubEvent extends News {

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
				$result = $this->frontendUserRepository->findByUid($matches[2]);
				$result->mails = array(
					0 => array('email' => $result->getEmail()),
				);
				return $result;
			case 'tx_nnaddress_domain_model_person':
				return $this->personRepository->findByUid($matches[2]);
			}
		}
		return $this->cook;
	}
}
