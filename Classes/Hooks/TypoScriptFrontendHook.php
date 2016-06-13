<?php
namespace CP\DinnerclubExt\Hooks;

class TypoScriptFrontendHook {
	/**
	 * Disables cache for anonymously logged-in users
	 * @param array
	 * @return void
	 */
	public function checkCacheHook($params) {
		if ($GLOBALS['TSFE']->fe_user->getKey('ses', 'authorizedEvent')) {
			$params['disableAcquireCacheData'] = true;
		}
	}
}
