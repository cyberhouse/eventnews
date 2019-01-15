<?php

namespace GeorgRinger\Eventnews\Controller;

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
 * Class GeorgRinger\Eventnews\Controller\NewsController
 */
class NewsController extends \GeorgRinger\News\Controller\NewsController {

    /**
     * Month view
     *
     * @param \GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search
     * @param array $overwriteDemand
     * @ignorevalidation $search
     * @dontverifyrequesthash
     * @return void
     */
    public function monthAction(
        \GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search = null,
        array $overwriteDemand = null
    ) {
        $demand = $this->getDemand($search, $overwriteDemand);
        $newsRecords = $this->newsRepository->findDemanded($demand);
        
        // get and merge events from last month
        $overwriteDemandLastMonth = $overwriteDemand;
        $overwriteDemandLastMonth["month"] = $overwriteDemand["month"] - 1;
        if ($overwriteDemandLastMonth["month"] == 0){
            $overwriteDemandLastMonth["month"] = 12;
            $overwriteDemandLastMonth["year"] = $overwriteDemandLastMonth["year"] - 1;
        }

        $demandLastMonth = $this->getDemand($search, $overwriteDemandLastMonth);
        $newsRecordsLastMonth = $this->newsRepository->findDemanded($demandLastMonth);

        $i = $newsRecords->count();
        foreach ($newsRecordsLastMonth as $value){
            $newsRecords[$i] = (object)$value;
            $i++;
        }
        
        $categories = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['categories'], true);

        /** @var \GeorgRinger\News\Domain\Repository\CategoryRepository $categoryRepository */
        $categoryRepository = $this->objectManager->get(\GeorgRinger\News\Domain\Repository\CategoryRepository::class);
        /** @var \GeorgRinger\Eventnews\Domain\Repository\LocationRepository $locationRepository */
        $locationRepository = $this->objectManager->get(\GeorgRinger\Eventnews\Domain\Repository\LocationRepository::class);
        /** @var \GeorgRinger\Eventnews\Domain\Repository\OrganizerRepository $organizerRepository */
        $organizerRepository = $this->objectManager->get(\GeorgRinger\Eventnews\Domain\Repository\OrganizerRepository::class);

        $organizerPidList = $this->settings['startingpointOrganizer'] ? $this->settings['startingpointOrganizer'] : $this->settings['startingpoint'];
        $locationPidList = $this->settings['startingpointLocation'] ? $this->settings['startingpointLocation'] : $this->settings['startingpoint'];

        $assignedValues = array(
            'search' => $search,
            'news' => $newsRecords,
            'overwriteDemand' => $overwriteDemand,
            'demand' => $demand,
            'currentPageId' => $GLOBALS['TSFE']->id,
            'allOrganizers' => $organizerRepository->findByStartingPoint($organizerPidList),
            'allLocations' => $locationRepository->findByStartingPoint($locationPidList),
            'allCategories' => empty($categories) ? array() : $categoryRepository->findByIdList($categories),
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
    protected function getDemand(
        \GeorgRinger\Eventnews\Domain\Model\Dto\SearchDemand $search = null,
        array $overwriteDemand = null
    ) {
        /** @var \GeorgRinger\Eventnews\Domain\Model\Dto\Demand $demand */
        $demand = $this->createDemandObjectFromSettings($this->settings,
            'GeorgRinger\\Eventnews\\Domain\\Model\\Dto\\Demand');
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
    protected function getDateConfig($demand, $timeString = '')
    {
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

}
