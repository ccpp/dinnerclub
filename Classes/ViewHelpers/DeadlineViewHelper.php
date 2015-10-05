<?php
namespace CP\Dinnerclub\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class DeadlineViewHelper extends AbstractViewHelper {
	/**
	 * @param GeorgRinger\News\Domain\Model\News item
	 */
	public function render(News $newsItem = null) {
		if (!$newsItem) {
			$newsItem = $this->renderChildren();
		}

		$deadline = clone $newsItem->getDatetime();
		return $deadline->modify("12:00");
	}
}
