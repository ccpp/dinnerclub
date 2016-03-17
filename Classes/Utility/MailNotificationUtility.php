<?php
namespace CP\Dinnerclub\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use CP\Dinnerclub\Domain\Model\Registration;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyObjectStorage;

class MailNotificationUtility {
	/**
	 * @param \CP\Dinnerclub\Domain\Model\Registration $registration
	 */
	public function notifyRegistration($registration) {
		$event = $registration->event;

		$cook = $event->getCookEmails();
		$contactPerson = $event->getContactPersonEmails();

		$this->sendMail($cook, 'Cook');
		$this->sendMail($contactPerson, 'ContactPerson');
	}

	protected function sendMail($recipients, $template) {
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

