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
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Hooks/T3libBefunc.php']['updateFlexforms']['eventnews']
	= 'GeorgRinger\\Eventnews\\Hooks\\T3libBefunc->updateFlexforms';

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['GeorgRinger\\News\\Hooks\\CmsLayout']['extensionSummary']['eventnews']
	= 'GeorgRinger\\Eventnews\\Hooks\\CmsLayout->extensionSummary';

// Extend the query
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['Domain/Repository/AbstractDemandedRepository.php']['findDemanded']['eventnews']
	= 'EXT:eventnews/Classes/Hooks/AbstractDemandedRepository.php:GeorgRinger\\Eventnews\\Hooks\\AbstractDemandedRepository->modify';


/***********
 * Extend EXT:news
 */

$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'eventnews';
$GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Controller/NewsController'][] = 'eventnews';