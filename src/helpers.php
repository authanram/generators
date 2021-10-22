<?php

declare(strict_types=1);

use Authanram\Generators\Container;

if (function_exists('app') === false) {
    /**
     * @return Container
     *
     * @noinspection PhpInconsistentReturnPointsInspection
     */
    function app(): Container {}
}
