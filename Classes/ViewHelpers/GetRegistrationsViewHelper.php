<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class GetRegistrationsViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @Inject
	 */
	protected $registrationRepository;

	/**
	 * @param GeorgRinger\News\Domain\Model\News item
	 */
	public function render(News $newsItem = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}
		return $this->registrationRepository->findByEvent($newsItem);
	}
}
