<?php
namespace CP\DinnerclubExt\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use CP\Dinnerclub\Domain\Model\DinnerclubEvent;
use CP\Dinnerclub\Domain\Model\Registration;

class RegistrationController extends \CP\Dinnerclub\Controller\RegistrationController {

	/**
	 * @var TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject @lazy
	 */
	protected $persistenceManager;

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
		parent::confirmAction($registration);
		$this->persistenceManager->persistAll();
		$this->mailNotificationUtility->notifyRegistration($registration, $this->settings);
	}

	/**
	 * Login an anonymous user for an event
	 * @param CP\Dinnerclub\Domain\Model\DinnerclubEvent event
	 * @param string checksum
	 */
	public function anonymousLoginAction(DinnerclubEvent $event, $checksum) {
		if ($checksum != GeneralUtility::stdAuthCode($event->_getProperties(), 'uid, type, title')) {
			throw new \Exception('Unauthorized');
		}

		$GLOBALS["TSFE"]->fe_user->setKey('ses', 'authorizedEvent', $event->getUid());

		$this->redirect('detail', 'news', 'News', array(
			'news' => $event->getUid(),
		), $this->settings['dinnerClubRegistrationOverviewPid'], 1);
	}

}
