<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class RegistrationAllowedViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @param GeorgRinger\News\Domain\Model\News item
	 */
	public function render(News $newsItem = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}

		$deadline = clone $newsItem->getDatetime();
		$deadline->modify("12:00");

		if (new \DateTime() > $deadline) {
			return false;
		}

		$sum = 0;
		foreach ($this->registrationRepository->findByEvent($newsItem) as $registration) {
			$sum -= $registration->originalCount;
			$sum += $registration->count;
		}
		if ($sum > 120) {
			return false;
		}

		return true;
	}
}

