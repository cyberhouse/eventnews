<?php

namespace GeorgRinger\EventNews\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class BackendUtility extends \GeorgRinger\News\Hooks\BackendUtility {

	protected $eventRestrictionField = '<settings.eventRestriction>
						<TCEforms>
							<label>LLL:EXT:eventnews/Resources/Private/Language/locallang.xlf:flexforms_general.eventRestriction</label>
							<config>
								<type>select</type>
								<items>
									<numIndex index="0" type="array">
										<numIndex index="0">LLL:EXT:news/Resources/Private/Language/locallang_be.xlf:flexforms_general.no-constraint</numIndex>
										<numIndex index="1"></numIndex>
									</numIndex>
									<numIndex index="1">
										<numIndex index="0">LLL:EXT:eventnews/Resources/Private/Language/locallang.xlf:flexforms_general.eventRestriction.1</numIndex>
										<numIndex index="1">1</numIndex>
									</numIndex>
									<numIndex index="2">
										<numIndex index="0">LLL:EXT:eventnews/Resources/Private/Language/locallang.xlf:flexforms_general.eventRestriction.2</numIndex>
										<numIndex index="1">2</numIndex>
									</numIndex>
								</items>
							</config>
						</TCEforms>
					</settings.eventRestriction>';

	/**
	 * @param array|string $params
	 * @param array $reference
	 */
	public function updateFlexforms(&$params, &$reference) {
		if ($params['selectedView'] === 'News->month') {
			$removedFields = $this->removedFieldsInListView;
			$removedFields['sDEF'] .= ',timeRestriction,timeRestrictionHigh';

			$this->deleteFromStructure($params['dataStructure'], $removedFields);
		}

		if ($params['selectedView'] === 'News->month' || $params['selectedView'] === 'News->list') {
			$eventRestrictionXml = GeneralUtility::xml2array($this->eventRestrictionField);
			if (is_array($params['dataStructure']['sheets']['sDEF']['ROOT']['el'])) {
				$params['dataStructure']['sheets']['sDEF']['ROOT']['el'] = $params['dataStructure']['sheets']['sDEF']['ROOT']['el'] + array(
					'settings.eventRestriction' => $eventRestrictionXml);
			}
		}
	}
}
