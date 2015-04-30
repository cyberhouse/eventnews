<?php

namespace GeorgRinger\Eventnews\Tests\Unit\ViewHelper;

use GeorgRinger\Eventnews\Domain\Model\News;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class CalendarViewHelperTest extends UnitTestCase {

	/**
	 * @test
	 * @dataProvider newsOfADayProvider
	 * @param int $day
	 * @param string $list
	 */
	public function getCorrectNewsOfADay($day, $list) {
		$calendarViewHelper = $this->getAccessibleMock('GeorgRinger\\Eventnews\\ViewHelpers\\CalendarViewHelper', array('dummy'));

		$currentDay = new \DateTime($day);
		$newsOfGivenDay = $calendarViewHelper->_call('getNewsForDay', $this->generateNewsList(), $currentDay);

		$newsTitles = array();
		foreach($newsOfGivenDay as $news) {
			/** @var \GeorgRinger\Eventnews\Domain\Model\News $news */
			$newsTitles[] = $news->getTitle();
		}

		$this->assertEquals($list, implode(',', $newsTitles));
	}

	/**
	 * @return News
	 */
	protected function generateNewsList() {
		$newsList = array();
		$data = array(
			array('01', '2015-02-03 10:00', NULL),
			array('02', '2015-02-10 23:00', NULL),
			array('03', '2015-02-12 11:30', NULL),
			array('04', '2015-02-20 08:30', NULL),
			array('05', '2015-02-20 09:30', NULL),
			array('06', '2015-02-20 10:30', NULL),
			array('07', '2015-02-21 07:30', NULL),
			array('08', '2015-02-23 14:30', NULL),
			array('09', '2015-02-25 17:30', NULL),
			array('10', '2015-02-26 18:30', NULL),
			array('11', '2015-02-27 21:30', NULL),
			array('12', '2015-02-28 22:00', NULL),
			array('13', '2015-01-30 22:00', '2015-02-07 10:00'),
			array('14', '2015-01-28 22:00', '2015-03-02 11:00'),
			array('15', '2015-02-14 12:00', '2015-03-05 11:00'),
			array('16', '2015-02-19 15:00', '2015-02-22 11:00'),
			array('17', '2015-01-28 15:00', '2015-01-29 11:00'),
			array('18', '2015-03-01 15:00', '2015-03-02 11:00'),
		);

		foreach ($data as $item) {
			$news = new News();
			$news->setTitle($item[0]);

			$beginDate = new \DateTime($item[1]);
			$news->setDatetime($beginDate);

			if (!is_null($item[2])) {
				$endDate = new \DateTime($item[2]);
				$news->setEventEnd($endDate);
			}
			$newsList[] = $news;
		}

		return $newsList;
	}

	/**
	 * @return array
	 */
	public function newsOfADayProvider() {
		return array(
			array('2015-04-01', ''),
			array('2015-02-01', '13,14'),
			array('2015-02-20', '04,05,06,14,15,16'),
			array('2015-02-21', '07,14,15,16'),
		);
	}
}
