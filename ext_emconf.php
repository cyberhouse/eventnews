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
	'version' => '1.0.2',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-7.9.99',
			'news' => '3.2.0',
		),
		'conflicts' => array(),
		'suggests' => array(),
	),
);
