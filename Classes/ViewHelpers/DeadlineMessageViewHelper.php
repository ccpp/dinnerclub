<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class DeadlineMessageViewHelper extends AbstractViewHelper {

	/**
	 * @var \CP\Dinnerclub\Domain\Repository\RegistrationRepository
	 * @inject
	 */
	protected $registrationRepository;

	/**
	 * @param GeorgRinger\News\Domain\Model\News event
	 */
	public function render(News $event = null) {
		if (!$event) {
			$event = $this->renderChildren();
		}

		$today = new \DateTime("12:00");
		$deadline = clone $event->getDatetime();
		$deadline->modify("12:00");
		if ($today == $deadline) {
			return "Anmeldung nur bis 12:00 m&ouml;glich!";
		}

		$tomorrow = new \DateTime("tomorrow 12:00");
		if ($tomorrow == $deadline) {
			return "Die Anmeldung ist noch bis morgen 12:00 offen.";
		}

		return "";
	}
}

