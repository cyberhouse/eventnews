<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,description,lat,lng,link,',
		'iconfile' => 'EXT:eventnews/Resources/Public/Icons/tx_eventnews_domain_model_location.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, lat, lng, link',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, lat, lng, link, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					],
				],
				'default' => 0,
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_eventnews_domain_model_location',
				'foreign_table_where' => 'AND tx_eventnews_domain_model_location.pid=###CURRENT_PID### AND tx_eventnews_domain_model_location.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location.description',
			'config' => array(
				'type' => 'text',
				'cols' => 30,
				'rows' => 4,
				'eval' => 'trim'
			)
		),
		'lat' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location.lat',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'lng' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location.lng',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			)
		),
		'link' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:eventnews/Resources/Private/Language/locallang_db.xlf:tx_eventnews_domain_model_location.link',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'max' => '255',
				'eval' => 'trim',
				'wizards' => array(
					'_PADDING' => 2,
					'link' => array(
						'type' => 'popup',
						'title' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
						'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
						'module' => array(
							'name' => 'wizard_link',
						),
						'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1'
					)
				),
				'softref' => 'typolink'
			)
		),
	),
);
