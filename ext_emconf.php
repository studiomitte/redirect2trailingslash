<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Redirect to page with trailing slashes',
    'description' => 'Redirect urls with no trailing slashes to the one with',
    'category' => 'fe',
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.20-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
