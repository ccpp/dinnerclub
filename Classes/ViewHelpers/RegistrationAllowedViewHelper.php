<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use CP\Dinnerclub\Domain\Model\DinnerclubEvent;

class RegistrationAllowedViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * @param CP\Dinnerclub\Domain\Model\DinnerclubEvent $newsItem
	 */
	public function render(DinnerclubEvent $newsItem = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}

		$deadline = clone $newsItem->getDatetime();
		$deadline->modify("12:00");

		if (new \DateTime() > $deadline) {
			return false;
		}

		$settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Dinnerclub', 'piRegistration');

		if (@$settings['registrationCountLimit']) {
			if ($newsItem->countPersons() >= $settings['registrationCountLimit']) {
				return false;
			}
		}

		return true;
	}
}

