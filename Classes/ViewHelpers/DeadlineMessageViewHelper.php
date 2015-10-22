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
	 * @param \bool verbose
	 */
	public function render(News $event = null, $verbose = null) {
		if (!$event) {
			$event = $this->renderChildren();
		}

		$sum = 0;
		foreach ($this->registrationRepository->findByEvent($event) as $registration) {
			$sum -= $registration->originalCount;
			$sum += $registration->count;
		}
		if ($sum > 120) {
			return $verbose ? "Tut uns leid, die Maximalg&auml;stezahl ist leider &uuml;berschritten. Weitere G&auml;ste k&ouml;nnen nur noch auf gut Gl&uuml;ck vorbeischauen"
				: "Anmeldungslimit erreicht!";
		}

		$today = new \DateTime("12:00");
		$deadline = clone $event->getDatetime();
		$deadline->modify("12:00");
		if ($today == $deadline) {
			return $verbose ?
				"Es tut uns leid, die Anmeldung für den Abend ist bereits abgeschlossen.  Aber schau doch einfach trotzdem vorbei. Meistens gibt es auch ohne Anmeldung noch etwas zu essen!"
				: "Anmeldung nur bis 12:00 m&ouml;glich!";
		}

		$tomorrow = new \DateTime("tomorrow 12:00");
		if ($tomorrow == $deadline) {
			return "Die Anmeldung ist noch bis morgen 12:00 offen.";
		}

		if (new \DateTime() > $deadline && new \DateTime() < $event->getDatetime()) {
			return $verbose ? "Es tut uns leid, die Anmeldung f&uuml;r den Abend ist bereits abgeschlossen.Aber schau doch einfach trotzdem vorbei. Meistens gibt es auch ohne Anmeldung noch etwas zu essen!" : "Anmeldung abgeschlossen";
		}

		return "";
	}
}

