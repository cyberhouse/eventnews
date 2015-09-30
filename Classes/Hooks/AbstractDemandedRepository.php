<?php

namespace GeorgRinger\Eventnews\Hooks;

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

use GeorgRinger\Eventnews\Domain\Model\Dto\Demand;

class AbstractDemandedRepository {

	/**
	 * Modify the constraints used in the query
	 *
	 * @param array $params
	 * @return void
	 */
	public function modify(array $params) {
		if (get_class($params['demand']) !== 'GeorgRinger\\Eventnews\\Domain\\Model\\Dto\\Demand') {
			return;
		}

		$this->updateEventConstraints($params['demand'], $params['respectEnableFields'], $params['query'], $params['constraints']);
	}


	/**
	 * Update the main event constraints
	 *
	 * @param Demand $demand
	 * @param bool $respectEnableFields
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param array $constraints
	 * @return void
	 */
	protected function updateEventConstraints(Demand $demand, $respectEnableFields, \TYPO3\CMS\Extbase\Persistence\QueryInterface $query, array &$constraints) {
		// reset datetime constraint
		unset($constraints['datetime']);

		$eventRestriction = $demand->getEventRestriction();

		if ($eventRestriction === Demand::EVENT_RESTRICTION_NO_EVENTS) {
			$constraints[] = $query->equals('isEvent', 0);
		} elseif ($eventRestriction === Demand::EVENT_RESTRICTION_ONLY_EVENTS) {
			$constraints[] = $query->equals('isEvent', 1);

			$dateField = $demand->getDateField();
			$begin = mktime(0, 0, 0, $demand->getMonth(), 1, $demand->getYear());
			$end = mktime(23, 59, 59, ($demand->getMonth() + 1), 0, $demand->getYear());

			$eventsWithNoEndDate = array(
				$query->logicalAnd(
					$query->greaterThanOrEqual($demand->getDateField(), $begin),
					$query->lessThanOrEqual($demand->getDateField(), $end)
				)
			);

			$eventsWithEndDate = array(
				// event inside a month, e.g. 3.3 - 8.3
				$query->logicalAnd(
					$query->greaterThanOrEqual('datetime', $begin),
					$query->lessThanOrEqual('datetime', $end),
					$query->lessThanOrEqual('eventEnd', $end)
				),
				// event expanded from month before to month after
				$query->logicalAnd(
					$query->lessThanOrEqual($dateField, $begin),
					$query->greaterThanOrEqual('eventEnd', $end)
				),
				// event from month before to mid of month
				$query->logicalAnd(
					$query->lessThanOrEqual($dateField, $begin),
					$query->greaterThanOrEqual('eventEnd', $begin)
				),
				// event from mid month to next month
				$query->logicalAnd(
					$query->lessThanOrEqual($dateField, $end),
					$query->greaterThanOrEqual('eventEnd', $end)
				)
			);

			$dateConstraints1 = array(
				$query->logicalAnd($eventsWithNoEndDate),
				$query->logicalOr($eventsWithEndDate)
			);

			$constraints['datetime'] = $query->logicalOr($dateConstraints1);

			$organizers = $demand->getOrganizers();
			if (!empty($organizers)) {
				$constraints[] = $query->in('organizer', $organizers);
			}

			$locations = $demand->getLocations();
			if (!empty($locations)) {
				$constraints[] = $query->in('location', $locations);
			}
		}
	}
}