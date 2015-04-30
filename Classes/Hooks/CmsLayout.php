<?php

namespace GeorgRinger\EventNews\Hooks;

	/*
	 * This file is part of the TYPO3 CMS project.
	 *
	 * It is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License, either version 2
	 * of the License, or any later version.
	 *
	 * For the full copyright and license information, please read the
	 * LICENSE.txt file that was distributed with this source code.
	 *
	 * The TYPO3 project - inspiring people to share!
	 */

/**
 * Class CmsLayout
 *
 * @package GeorgRinger\EventNews\Hooks
 */
class CmsLayout {

	/**
	 * Provide an extension summary for the month selection
	 *
	 * @param array $params
	 * @param \GeorgRinger\News\Hooks\CmsLayout $cmsLayout
	 * @return void
	 */
	public function extensionSummary(array $params, \GeorgRinger\News\Hooks\CmsLayout $cmsLayout) {
		if ($params['action'] === 'news_month') {
			$cmsLayout->getStartingPoint();
			$cmsLayout->getTimeRestrictionSetting();
			$cmsLayout->getTopNewsRestrictionSetting();
			$cmsLayout->getOrderSettings();
			$cmsLayout->getCategorySettings();
			$cmsLayout->getArchiveSettings();
			$cmsLayout->getOffsetLimitSettings();
			$cmsLayout->getDetailPidSetting();
			$cmsLayout->getListPidSetting();
			$cmsLayout->getTagRestrictionSetting();
			$this->getEventRestrictionSetting($cmsLayout);
		}
	}

	/**
	 * Show the event restriction
	 *
	 * @param \GeorgRinger\News\Hooks\CmsLayout $cmsLayout
	 * @return void
	 */
	protected function getEventRestrictionSetting(\GeorgRinger\News\Hooks\CmsLayout $cmsLayout) {
		$eventRestriction = (int)$cmsLayout->getFieldFromFlexform('settings.eventRestriction');
		if ($eventRestriction > 0) {
			$cmsLayout->tableData[] = array(
				$cmsLayout->getLanguageService()->sL('LLL:EXT:eventnews/Resources/Private/Language/locallang.xlf:flexforms_general.eventRestriction'),
				$cmsLayout->getLanguageService()->sL('LLL:EXT:eventnews/Resources/Private/Language/locallang.xlf:flexforms_general.eventRestriction.' . $eventRestriction)
			);
		}
	}
}