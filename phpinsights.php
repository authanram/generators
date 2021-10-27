<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenDefineFunctions;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff;
use SlevomatCodingStandard\Sniffs\Functions\StaticClosureSniff;

return [
    'preset' => 'default',

    // "textmate", "macvim", "emacs", "sublime", "phpstorm", | "atom", "vscode"
    'ide' => getenv('PHPINSIGHTS_IDE') ?? '',

    'remove' => getenv('PHPINSIGHTS_ENV') === 'testing'
        ? [
            ForbiddenDefineFunctions::class,
            StaticClosureSniff::class,
        ] : [
            SuperfluousExceptionNamingSniff::class,
        ],
];
