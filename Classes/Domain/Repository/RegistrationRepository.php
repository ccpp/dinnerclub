<?php
namespace CP\Dinnerclub\Domain\Repository;
use TYPO3\CMS\Extbase\Persistence\Repository;

class RegistrationRepository extends Repository {

	public function initializeObject() {
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}
}
