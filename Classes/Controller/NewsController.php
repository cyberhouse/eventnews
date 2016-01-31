<?php

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
 * Class Tx_Eventnews_Controller_NewsController
 */
class Tx_Eventnews_Controller_NewsController extends \GeorgRinger\News\Controller\NewsController {

	/**
	 * Month view
	 *
	 * @param \GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search
	 * @param array $overwriteDemand
	 * @ignorevalidation $search
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function monthAction(\GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search = NULL, array $overwriteDemand = NULL) {
		$demand = $this->getDemand($search, $overwriteDemand);
		$newsRecords = $this->newsRepository->findDemanded($demand);
		$categories = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['categories'], TRUE);

		$assignedValues = array(
			'search' => $search,
			'news' => $newsRecords,
			'overwriteDemand' => $overwriteDemand,
			'demand' => $demand,
			'currentPageId' => $GLOBALS['TSFE']->id,
			'allOrganizers' => $this->organizerRepository->findByStartingPoint($this->settings['startingpoint']),
			'allLocations' => $this->locationRepository->findByStartingPoint($this->settings['startingpoint']),
			'allCategories' => empty($categories) ? array() : $this->categoryRepository->findByIdList($categories),
			'previousMonthData' => $this->getDateConfig($demand, '-1 month'),
			'nextMonthData' => $this->getDateConfig($demand, '+1 month'),
			'currentMonthData' => $this->getDateConfig($demand),
		);

		$this->view->assignMultiple($assignedValues);
	}

	/**
	 * @param \GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search
	 * @param array $overwriteDemand
	 * @return \GeorgRinger\Eventnews\Domain\Model\Dto\Demand
	 */
	protected function getDemand(\GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search = NULL, array $overwriteDemand = NULL) {
		/** @var \GeorgRinger\Eventnews\Domain\Model\Dto\Demand $demand */
		$demand = $this->createDemandObjectFromSettings($this->settings, 'GeorgRinger\\Eventnews\\Domain\\Model\\Dto\\Demand');
		if (is_array($overwriteDemand) && !empty($overwriteDemand)) {
			$demand = $this->overwriteDemandObject($demand, $overwriteDemand);
		}
		if (!$demand->getMonth()) {
			$demand->setMonth(date('n'));
		}
		if (!$demand->getYear()) {
			$demand->setYear(date('Y'));
		}

		$demand->setDay($overwriteDemand['day']);

		if (!is_null($search)) {
			$demand->setLocations($search->getLocations());
			$demand->setOrganizers($search->getOrganizers());
			$demand->setCategories($search->getCategories());
		}
		return $demand;
	}


	/**
	 * Get a date configuration of the given time offset
	 *
	 * @param \GeorgRinger\Eventnews\Domain\Model\Dto\Demand $demand
	 * @param string $timeString
	 * @return array
	 */
	protected function getDateConfig($demand, $timeString = '') {
		$date = \DateTime::createFromFormat('d.m.Y', sprintf('1.%s.%s', $demand->getMonth(), $demand->getYear()));
		if (!empty($timeString)) {
			$date->modify($timeString);
		}
		return array(
			'date' => $date,
			'month' => $date->format('n'),
			'year' => $date->format('Y')
		);
	}

	/**
	 * @param \GeorgRinger\Eventnews\Domain\Repository\OrganizerRepository $organizerRepository
	 * @return void
	 */
	public function injectOrganizerRepository(\GeorgRinger\Eventnews\Domain\Repository\OrganizerRepository $organizerRepository) {
		$this->organizerRepository = $organizerRepository;
	}

	/**
	 * @param \GeorgRinger\Eventnews\Domain\Repository\LocationRepository $locationRepository
	 * @return void
	 */
	public function injectLocationRepository(\GeorgRinger\Eventnews\Domain\Repository\LocationRepository $locationRepository) {
		$this->locationRepository = $locationRepository;
	}

	/**
	 * @param \GeorgRinger\News\Domain\Repository\CategoryRepository $categoryRepository
	 * @return void
	 */
	public function injectCategoryRepository(\GeorgRinger\News\Domain\Repository\CategoryRepository $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

	/** @var \GeorgRinger\Eventnews\Domain\Repository\OrganizerRepository */
	protected $organizerRepository;

	/** @var \GeorgRinger\Eventnews\Domain\Repository\LocationRepository */
	protected $locationRepository;

	/** @var \Tx_News_Domain_Repository_CategoryRepository */
	protected $categoryRepository;

}
