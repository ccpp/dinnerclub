<?php
namespace CP\Dinnerclub\Utility;

use DateTime;
use DateInterval;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Log\LogManager;
use CP\Dinnerclub\Domain\Model\Registration;
use CP\Dinnerclub\Domain\Model\DinnerclubEvent;
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

		$this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger('dinnerclub');

		if (!$event->getDatetime()) {
			$this->logger->info('Event has no time');
			return;
		}
		$now = new DateTime;
		$lastNotificationDate = clone $event->getDatetime();
		$lastNotificationDate->modify("12:00");
		$firstNotification = clone $lastNotificationDate;
		$firstNotification->sub(new DateInterval("P2D"));

		if ($now < $firstNotification) {
			$this->logger->info('Notification sent recently');
			return;
		}
		if ($event->lastNotification && $settings['emailFrequencyHours']) {
			$diff = $event->lastNotification->diff($now);
			if ($diff->days*24 + $diff->h < $settings['emailFrequencyHours']) {
				return;
			}
		}

		$this->sendMail(
			array_merge($event->getNotificationEmails(), $event->getCookEmails()),
			array_merge($event->getContactPersonEmails(), GeneralUtility::trimExplode(",", $settings['additionalNotificationEmails'], true)),
			$settings['emailSubject'],
			$event, $registration, $settings['replyToEmail'], $settings['returnPathEmail']);

		$event->lastNotification = $now;
		$this->newsRepository->update($event);
	}

	/**
	 * @param array to
	 * @param array cc
	 * @param string subject
	 * @param CP\Dinnerclub\Domain\Model\DinnerclubEvent event
	 * @param CP\Dinnerclub\Domain\Model\Registration registration
	 * @param string replyToEmail
	 * @param string returnPathEmail
	 */
	protected function sendMail($to, $cc, $subject, DinnerclubEvent $event, Registration $registration, $replyToEmail, $returnPathEmail) {
		$this->logger->info('Rendering mail with subject "' . $subject . '" to: ' . join(',', $to) . ', cc: ' . join(', ', $cc));

		$mail = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$mail->setFrom('dinnerclub@' . GeneralUtility::getHostname(false));
		$mail->setTo($to);
		$mail->setCC($cc);
		if ($replyToEmail) $mail->setReplyTo($replyToEmail);
		if ($returnPathEmail) $mail->setReturnPath($returnPathEmail);
		$mail->setSubject($subject);

		$emailView = $this->objectManager->get("TYPO3\\CMS\\Fluid\\View\\StandaloneView");
		$emailView->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:dinnerclub/Resources/Private/Templates/Mail/RegistrationNotification.txt'));
		$emailView->assignMultiple(array(
			'event' => $event,
			'newRegistration' => $registration,
			'site' => array(
				'name' => $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'],
			),
		));
		$body = trim($emailView->render());
		$mail->setBody($body, "text/plain");

		if (!$mail->send()) {
			$this->logger->warning('Mail could not be sent');
		}
		elseif (!$mail->isSent()) {
			$this->logger->warning('Mail not marked as sent');
		}

		if ($mail->getFailedRecipients()) {
			$this->logger->warning('Failed sending to ' . join(', ', $mail->getFailedRecipients()));
		}
	}
}

