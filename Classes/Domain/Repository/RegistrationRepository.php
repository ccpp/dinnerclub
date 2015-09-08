<?php
namespace CP\DinnerClub\Domain\Repository;
use TYPO3\CMS\Extbase\Persistence\Repository;

class RegistrationRepository extends Repository {

	public function initializeObject() {
		$querySettings = $this->objectManager->create('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}
}
