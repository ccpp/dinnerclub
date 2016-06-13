<?php
namespace CP\DinnerclubExt\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class TypoScriptFrontendHook {
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

	public function checkCacheHook($params, $tsfe) {
		if ($_REQUEST['tx_news_pi1']['checksum']) {
			$this->objectManager = GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Object\\ObjectManager");
			$this->newsRepository = $this->objectManager->get("GeorgRinger\\News\\Domain\\Repository\\NewsRepository");
			$news = $this->newsRepository->findByUid($_REQUEST['tx_news_pi1']['news']);

			var_dump($news);
			if ($news) {
				// TODO GeneralUtility::authCode...
			}
		}

		if ($GLOBALS['TSFE']->fe_user->getKey('ses', 'authorizedEvent')) {
			$params['disableAcquireCacheData'] = true;
		}
	}
}
