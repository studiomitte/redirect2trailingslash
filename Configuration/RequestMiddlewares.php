<?php

$rearrangedMiddlewares = true;

return [
    'frontend' => [
        'typo3/redirect2trailingslash/redirect' => [
            'target' => \StudioMitte\Redirect2trailingslash\Http\TrailingSlashRedirect::class,
            'before' => [
                'typo3/cms-frontend/page-resolver',
            ],
            'after' => [
                'typo3/cms-frontend/static-route-resolver'
            ],
        ]
    ],
];
