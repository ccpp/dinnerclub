<?php
namespace CP\DinnerClub\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use GeorgRinger\News\Domain\Model\News;

class RegistrationController extends ActionController {

	/**
	 * @var \CP\DinnerClub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Service\CacheService
	 * @inject
	 */
	protected $cacheService;

	/**
	 * @param \GeorgRinger\News\Domain\Model\News $event
	 * @param \int $count
	 * @param \string $name
	 */
	public function confirmAction(News $event, $count, $name) {
		$this->view->assign('event', $event);
		$this->view->assign('count', $count);
		$this->view->assign('name', $name);
	}

	/**
	 * @param \GeorgRinger\News\Domain\Model\News $event
	 * @param \int $count
	 * @param \string $name
	 */
	public function registerAction(News $event, $count, $name) {
		$registration = $this->objectManager->create('CP\\DinnerClub\\Domain\\Model\\Registration');
		$registration->event = $event;
		$registration->count = $count;
		$registration->name = $name;
		$registration->setPid($event->getPid());
		$this->registrationRepository->add($registration);

		// TODO clear news page's cache (get from template?)
		$this->cacheService->clearPageCache(array(1, 3));

		$this->uriBuilder->reset()->setTargetPageUid(8);
		$this->redirectToUri($this->uriBuilder->uriFor());
	}
}
