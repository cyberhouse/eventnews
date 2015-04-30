<?php

namespace GeorgRinger\Eventnews\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

class DayCompareViewHelper extends AbstractConditionViewHelper {

	/**
	 * @param \Tx_News_Domain_Model_News $newsItem
	 * @param \GeorgRinger\Eventnews\Domain\Model\Dto\Demand $demand
	 * @return mixed
	 */
	public function render($newsItem, $demand) {
		$currentDay = \DateTime::createFromFormat('d-m-Y H:i:s', sprintf(
			'%s-%s-%s 00:00:01', $demand->getDay(), $demand->getMonth(), $demand->getYear()));

		$found = FALSE;
		if ($demand->getDay() > 0) {
			$newsBeginDate = $newsItem->getDatetime()->format('Y-m-d');
			$day = date('Y-m-d', $currentDay->getTimestamp());

			if ($newsItem->getEventEnd() == 0) {
				if ($newsBeginDate === $day) {
					$found = TRUE;
				}
			} else {
				$newsEndDate = $newsItem->getEventEnd();
				$newsEndDate->setTime(23, 59, 59);
				$newsBeginDate = $newsItem->getDatetime();
				$newsBeginDate->setTime(0, 0);
				$currentDay->setTime(0, 0);

				if ($newsBeginDate <= $currentDay && $newsEndDate >= $currentDay) {
					$found = TRUE;
				}
			}
		}

		if ($found) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}


}