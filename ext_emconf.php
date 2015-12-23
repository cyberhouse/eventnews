<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'news events',
	'description' => 'Events for news',
	'category' => 'plugin',
	'author' => 'Georg Ringer',
	'author_email' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'version' => '1.0.3',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-7.9.99',
			'news' => '4.0.0-4.0.99',
		),
		'conflicts' => array(),
		'suggests' => array(),
	),
);
