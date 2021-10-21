<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;
use InvalidArgumentException;

class Pipeline implements Contracts\Pipeline
{
    public static string $messagePipes = 'Argument {$pipes} must not be empty.';
    public static string $messagePipe = 'Argument {$pipes[%s]} must implement "'.Contracts\Pipe::class.'".';

    private Passable $passable;

    /** @var array<Pipe|string> */
    private array $pipes;

    /** @param array<Pipe|string> $pipes */
    public static function handle(Passable $passable, array $pipes): Passable
    {
        $pipeline = (new static())
            ->setPassable($passable)
            ->setPipes($pipes);

        // @todo inject container
        return (new IlluminatePipeline(new Container()))
            ->send($pipeline->getPassable())
            ->through($pipeline->getPipes())
            ->thenReturn();
    }

    private function getPassable(): Passable
    {
        return $this->passable;
    }

    /** @return array<Pipe|string> */
    private function getPipes(): array
    {
        return $this->pipes;
    }

    private function setPassable(Passable $passable): Pipeline
    {
        $this->passable = $passable;

        return $this;
    }

    /** @param array<Pipe|string> $pipes */
    private function setPipes(array $pipes): Pipeline
    {
        if (count($pipes) === 0) {
            throw new InvalidArgumentException(static::$messagePipes);
        }

        foreach ($pipes as $pipe) {
            if (is_subclass_of($pipe, Contracts\Pipe::class)) {
                continue;
            }

            throw new InvalidArgumentException(
                sprintf(static::$messagePipe, $pipe),
            );
        }

        $this->pipes = $pipes;

        return $this;
    }
}
