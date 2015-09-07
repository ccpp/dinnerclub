<?php
namespace CP\DinnerClub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class RegistrationAllowedViewHelper extends AbstractViewHelper {
	/**
	 * @param GeorgRinger\News\Domain\Model\News item
	 */
	public function render(News $newsItem = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}
		return $GLOBALS['EXEC_TIME'] > $newsItem->getDatetime() - 60*60*12;
	}
}

