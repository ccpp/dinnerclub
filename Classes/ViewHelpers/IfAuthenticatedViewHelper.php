<?php
namespace CP\DinnerclubExt\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use GeorgRinger\News\Domain\Model\News;

class IfAuthenticatedViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Security\IfAuthenticatedViewHelper {
	/**
	 * @param GeorgRinger\News\Domain\Model\News news item to check
	 * @return string the rendered string
	 */
	public function render(News $news) {
		$authorizedEventUid = $GLOBALS['TSFE']->fe_user->getKey('ses', 'authorizedEvent');

		if ($news->getUid() == $authorizedEventUid) {
			return $this->renderThenChild();
		} else {
			return parent::render();
		}
	}
}

