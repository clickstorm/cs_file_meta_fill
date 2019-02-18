<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[clickstorm] File Meta Fill',
    'description' => 'Automatically generate fluent sys_file_metadata like alternative or title fields',
    'category' => 'backend',
    'author' => 'Pascale Beier',
    'author_email' => 'beier@clickstorm.de',
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.2.1-dev',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
