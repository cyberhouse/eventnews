<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// Add new controller/action
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['switchableControllerActions']['newItems']['News->month']
	= 'Month view';


/***********
 * Hooks
 */

// Hide not needed fields in FormEngine
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getSingleFieldClass']['eventnews']
	= 'GeorgRinger\\Eventnews\\Hooks\\FormEngineHook';

// Update flexforms
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Hooks/BackendUtility.php']['updateFlexforms']['eventnews']
	= 'GeorgRinger\\Eventnews\\Hooks\\BackendUtility->update';

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['GeorgRinger\\News\\Hooks\\PageLayoutView']['extensionSummary']['eventnews']
	= 'GeorgRinger\\Eventnews\\Hooks\\PageLayoutView->extensionSummary';

// Extend the query
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Domain/Repository/AbstractDemandedRepository.php']['findDemanded']['eventnews']
	= 'EXT:eventnews/Classes/Hooks/AbstractDemandedRepository.php:GeorgRinger\\Eventnews\\Hooks\\AbstractDemandedRepository->modify';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\GeorgRinger\Eventnews\Backend\FormDataProvider\EventNewsRowInitializeNew::class] = [
    'depends' => [
        \TYPO3\CMS\Backend\Form\FormDataProvider\DatabaseRowInitializeNew::class,
    ]
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['eventnews'] =
    \GeorgRinger\Eventnews\Hooks\Backend\EventNewsDataHandlerHook::class;


/***********
 * Extend EXT:news
 */

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'eventnews';
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Controller/NewsController'][] = 'eventnews';

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher')->connect(
	'GeorgRinger\\News\\Domain\\Service\\NewsImportService',
	'postHydrate',
	'GeorgRinger\\Eventnews\\Aspect\\NewsImportAspect',
	'postHydrate'
);
