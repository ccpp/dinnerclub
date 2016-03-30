<?php
namespace CP\DinnerclubExt\Controller;

use CP\Dinnerclub\Domain\Model\Registration;

class RegistrationController extends \CP\Dinnerclub\Controller\RegistrationController {

	/**
	 * Do not redirect back to startPage, but show confirmation text instead
	 *
	 * @param \CP\Dinnerclub\Domain\Model\Registration $registration
	 * @param \string $modification
	 */
	public function registerAction(Registration $registration, $modification = null) {
		$registration->setPid($registration->event->getPid());
		$this->registrationRepository->add($registration);
		return parent::confirmAction($registration);
	}

}
