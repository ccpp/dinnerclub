<?php
namespace CP\Dinnerclub\Controller;

use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use GeorgRinger\News\Domain\Model\News;
use CP\Dinnerclub\Domain\Model\Registration;

class RegistrationController extends ActionController {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @Inject
	 */
	protected $registrationRepository;

	/**
	 * @var TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @Inject
	 */
	protected $persistenceManager;

	/**
	 * @var \CP\Dinnerclub\Utility\MailNotificationUtility
	 * @Inject
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
		$this->persistenceManager->persistAll();
try {
		$this->mailNotificationUtility->notifyRegistration($registration, $this->settings);
} catch(\Exception $e) {
}
		$this->view->assign('event', $registration->event);
		$this->view->assign('registration', $registration);
	}

}
