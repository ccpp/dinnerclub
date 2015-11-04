<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use CP\Dinnerclub\Domain\Model\DinnerclubEvent;

class DeadlineMessageViewHelper extends AbstractViewHelper {

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
	 * @param CP\Dinnerclub\Domain\Model\DinnerclubEvent event
	 * @param \bool verbose
	 */
	public function render(DinnerclubEvent $event = null, $verbose = null) {
		if (!$event) {
			$event = $this->renderChildren();
		}

		$settings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Dinnerclub', 'piRegistration');
		$whichMessage = $verbose ? 'Verbose' : 'Short';
		if (@$settings['registrationCountLimit']) {
			if ($event->countPersons() >= $settings['registrationCountLimit']) {
				return $settings['maximumReachedMessage' . $whichMessage];
			}
		}

		$today = new \DateTime("12:00");
		$deadline = clone $event->getDatetime();
		$deadline->modify("12:00");
		if ($today == $deadline) {
			if (new \DateTime() < $deadline)
				return $settings['deadlineMessageSameDay'];
			else
				return $settings['afterDeadlineMessage' . $whichMessage];
		}

		$tomorrow = new \DateTime("tomorrow 12:00");
		if ($tomorrow == $deadline) {
			return $settings['deadlineMessagedayBefore'];
		}

		return "";
	}
}

