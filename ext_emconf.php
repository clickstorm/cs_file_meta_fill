<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '[clickstorm] File Meta Fill',
    'description' => 'Automatically generate fluent sys_file_metadata like alternative or title fields',
    'category' => 'backend',
    'author' => 'Pascale Beier',
    'author_email' => 'beier@clickstorm.de',
    'state' => 'stable',
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
