<?php
namespace CP\Dinnerclub\Command;

use \TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

class DinnerclubCommandController extends CommandController {
	/**
	 * send notificatin mails
	 */
	public function sendNotificationsCommad() {
		$mail = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$mail->setTo('ccpp@gmx.at');
		$mail->setSubject('Dinnerclub Test');
		$mail->setBody('Test body', 'text/plain');
		if (!$mail->send()) {
			echo "Error";
		}
	}
}
