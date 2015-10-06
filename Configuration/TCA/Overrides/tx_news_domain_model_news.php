<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$fields = array(
	'is_event' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_news.is_event',
		'config' => array(
			'type' => 'check',
			'default' => 0
		)
	),
	'full_day' => array(
		'exclude' => 1,
		'displayCond' => 'FIELD:is_event:>:0',
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_news.full_day',
		'config' => array(
			'type' => 'check',
			'default' => 0
		)
	),
	'event_end' => array(
		'exclude' => 1,
		'displayCond' => 'FIELD:is_event:>:0',
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_news.event_end',
		'config' => array(
			'type' => 'input',
			'size' => 12,
			'eval' => 'datetime',
			'checkbox' => 0,
		),
	),
	'organizer' => array(
		'exclude' => 1,
		'displayCond' => 'FIELD:is_event:>:0',
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_organizer',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('', 0),
			),
			'foreign_table' => 'tx_eventnews_domain_model_organizer',
			'foreign_table_where' => 'ORDER BY tx_eventnews_domain_model_organizer.title',
			'minitems' => 0,
			'maxitems' => 1
		),
	),
	'location' => array(
		'exclude' => 1,
		'displayCond' => 'FIELD:is_event:>:0',
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('', 0),
			),
			'foreign_table' => 'tx_eventnews_domain_model_location',
			'foreign_table_where' => 'ORDER BY tx_eventnews_domain_model_location.title',
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
	'organizer_simple' => array(
		'exclude' => 1,
		'displayCond' => 'FIELD:is_event:>:0',
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.organizer_simple',
		'config' => array(
			'type' => 'input',
			'size' => 15
		),
	),
	'location_simple' => array(
		'exclude' => 1,
		'displayCond' => 'FIELD:is_event:>:0',
		'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_news.location_simple',
		'config' => array(
			'type' => 'input',
			'size' => 15
		),
	)
);

$GLOBALS['TCA']['tx_news_domain_model_news']['palettes']['palette_event'] = array(
	'canNotCollapse' => TRUE,
	'showitem' => 'event_end,full_day,--linebreak--,organizer,organizer_simple, --linebreak--,location,location_simple'
);
$GLOBALS['TCA']['tx_news_domain_model_news']['ctrl']['requestUpdate'] .= ',is_event';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'is_event;;palette_event,', '', 'after:title');
