<?php
namespace CP\DinnerclubExt\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use CP\Dinnerclub\Domain\Model\Registration;

class RegistrationController extends \CP\Dinnerclub\Controller\RegistrationController {

	/**
	 * @var \CP\DinnerclubExt\Utility\MailNotificationUtility
	 * @inject @lazy
	 */
	protected $mailNotificationUtility;

	/**
	 * Do not redirect back to startPage, but show confirmation text instead
	 *
	 * @param \CP\Dinnerclub\Domain\Model\Registration $registration
	 * @param \string $modification
	 */
	public function registerAction(Registration $registration, $modification = null) {
		$registration->setPid($registration->event->getPid());
		$this->registrationRepository->add($registration);
		$this->mailNotificationUtility->notifyRegistration($registration, GeneralUtility::trimExplode(",", $this->settings['additionalNotificationEmails'], true));
		return parent::confirmAction($registration);
	}

}
