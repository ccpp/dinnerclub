<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use CP\Dinnerclub\Domain\Model\DinnerclubEvent;

class RegistrationAllowedViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @param CP\Dinnerclub\Domain\Model\DinnerclubEvent $newsItem
	 */
	public function render(DinnerclubEvent $newsItem = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}

		if (!$newsItem->isRegistrationPossible()) {
			return false;
		}

		$deadline = clone $newsItem->getDatetime();
		$deadline->modify("12:00");

		if (new \DateTime() > $deadline) {
			return false;
		}

		$registrationCountLimit = $newsItem->getRegistrationCountLimit();
		if ($registrationCountLimit) {
			if ($newsItem->countPersons() >= $registrationCountLimit) {
				return false;
			}
		}

		return true;
	}
}

