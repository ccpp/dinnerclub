<?php
namespace CP\DinnerclubExt\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class ChecksumViewHelper extends AbstractViewHelper {

	/**
	 * @return string
	 */
	public function render() {
		$record = $this->renderChildren();
		if ($record instanceof News) {
			return GeneralUtility::stdAuthCode($record->_getProperties(), 'uid, type, title');
		} else {
			throw new \Exception('Invalid object for checksum');
		}
	}
}
