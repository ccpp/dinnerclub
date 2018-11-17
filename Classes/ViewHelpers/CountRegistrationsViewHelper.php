<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class CountRegistrationsViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @param GeorgRinger\News\Domain\Model\News item
	 * @param boolean vegetarian
	 * @param boolean vegan
	 */
	public function render(News $newsItem = null, $vegetarian = null, $vegan = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}
		$sum = 0;
		foreach ($this->registrationRepository->findByEvent($newsItem) as $registration) {
			if ($vegetarian) {
				$sum += $registration->vegetarian;
			} elseif ($vegan) {
				$sum += $registration->vegan;
			} else {
				$sum -= $registration->originalCount;
				$sum += $registration->count;
			}
		}
		return $sum;
	}
}
