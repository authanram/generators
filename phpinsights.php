<?php

declare(strict_types=1);

return [
    'preset' => 'default',

    // "textmate", "macvim", "emacs", "sublime", "phpstorm", | "atom", "vscode"
    'ide' => getenv('PHPINSIGHTS_IDE') ?? '',

    'exclude' => [
        'GeneratorException.php',
    ],
];
