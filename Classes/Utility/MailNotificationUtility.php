<?php
namespace CP\DinnerclubExt\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use CP\Dinnerclub\Domain\Model\Registration;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyObjectStorage;

class MailNotificationUtility {
	/**
	 * @param \CP\Dinnerclub\Domain\Model\Registration $registration
	 */
	public function notifyRegistration($registration, $additionalRecipients = array()) {
		$event = $registration->event;

		$recipients = array_merge(
			array_flip($event->getNotificationEmails()),
			$event->getCookEmails(),
			$event->getContactPersonEmails(),
			array_flip((array)$additionalRecipients));

		$this->sendMail($recipients);
	}

	protected function sendMail($recipients) {
		var_dump('sending to:', $recipients);
		$mail = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$mail->setFrom('dinnerclub@' . GeneralUtility::getHostname(false));
		$mail->setTo($recipients);
		$mail->setSubject("Dinnerclub report");
		$mail->setBody("test");
		var_dump('sent: ', $mail->send());
		var_dump('is sent:', $mail->isSent());
		var_dump('failed: ' , $mail->getFailedRecipients());
		die();
	}
}

