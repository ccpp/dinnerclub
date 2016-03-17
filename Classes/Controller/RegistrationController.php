<?php
namespace CP\Dinnerclub\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use GeorgRinger\News\Domain\Model\News;
use CP\Dinnerclub\Domain\Model\Registration;

class RegistrationController extends ActionController {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Service\CacheService
	 * @inject
	 */
	protected $cacheService;

	/**
	 * @param \CP\Dinnerclub\Domain\Model\Registration $registration
	 * @param \string $modification
	 */
	public function registerAction(Registration $registration, $modification = null) {
		$registration->setPid($registration->event->getPid());
		$this->registrationRepository->add($registration);

		$this->view->assign('event', $registration->event);
		$this->view->assign('registration', $registration);
	}
}
