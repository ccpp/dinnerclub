<?php
namespace CP\DinnerClub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class CountRegistrationsViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\DinnerClub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @param GeorgRinger\News\Domain\Model\News item
	 */
	public function render(News $newsItem) {
		$sum = 0;
		foreach ($this->registrationRepository->findByEvent($newsItem) as $registration) {
			$sum += $registration->count;
		}
		return $sum;
	}
}
