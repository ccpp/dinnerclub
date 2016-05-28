<?php
namespace CP\DinnerclubExt\Utility;

use DateTime;
use DateInterval;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use CP\Dinnerclub\Domain\Model\Registration;
use CP\DinnerclubExt\Domain\Model\DinnerclubEvent;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyObjectStorage;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use GeorgRinger\News\Domain\Repository\NewsRepository;

class MailNotificationUtility {

	/**
	 * @var TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject @lazy
	 */
	protected $objectManager;

	/**
	 * @var GeorgRinger\News\Domain\Repository\NewsRepository
	 * @inject @lazy
	 */
	protected $newsRepository;

	/**
	 * @param \CP\Dinnerclub\Domain\Model\Registration $registration
	 * @param array
	 */
	public function notifyRegistration(Registration $registration, $settings = array()) {
		$event = $registration->event;

		if (!$event->getDatetime()) {
			return;
		}
		$now = new DateTime;
		$lastNotificationDate = clone $event->getDatetime();
		$lastNotificationDate->modify("12:00");
		$firstNotification = clone $lastNotificationDate;
		$firstNotification->sub(new DateInterval("P2D"));

		if ($now < $firstNotification) {
			return;
		}
		if ($event->lastNotification) {
			$diff = $event->lastNotification->diff($now);
			if ($diff->days*24 + $diff->h < 12) {
				return;
			}
		}

		$this->sendMail(
			array_merge($event->getNotificationEmails(), $event->getCookEmails()),
			array_merge($event->getContactPersonEmails(), $settings['additionalNotificationEmails']),
			$event, $registration, $settings['replyToEmail'], $settings['returnPathEmail']);

		$event->lastNotification = $now;
		$this->newsRepository->update($event);
	}

	protected function sendMail($to, $cc, DinnerclubEvent $event, Registration $registration, $replyToEmail, $returnPathEmail) {
		$mail = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$mail->setFrom('dinnerclub@' . GeneralUtility::getHostname(false));
		$mail->setTo($to);
		$mail->setCC($cc);
		if ($replyToEmail) $mail->setReplyTo($replyToEmail);
		if ($returnPathEmail) $mail->setReturnPath($returnPathEmail);
		$mail->setSubject("Dinnerclub Anmeldungen");

		$emailView = $this->objectManager->get("TYPO3\\CMS\\Fluid\\View\\StandaloneView");
		$emailView->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:dinnerclub_ext/Resources/Private/Templates/Mail/RegistrationNotification.txt'));
		$emailView->assignMultiple(array(
			'event' => $event,
			'newRegistration' => $registration,
			'site' => array(
				'name' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
			),
		));
		$body = trim($emailView->render());
		$mail->setBody($body, "text/plain");

		if (!$mail->send() || !$mail->isSent()) {
			throw new \Exception("Mail could ont be sent");
		}
	}
}

