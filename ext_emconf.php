<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Redirect to page with trailing slashes',
    'description' => 'Redirect urls with no trailing slashes to the one with',
    'category' => 'fe',
    'author' => 'Georg Ringer',
    'author_email' => 'gr@studiomitte.com',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.30-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
