<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Exceptions\InvalidArgumentException;
use Authanram\Generators\Exceptions\MustImplementInterfaceException;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;

class Pipeline implements Contracts\Pipeline
{
    private Passable $passable;

    /** @var array<Pipe|string> */
    private array $pipes;

    /**
     * @param array<Pipe|string> $pipes
     * @throws InvalidArgumentException
     * @throws MustImplementInterfaceException
     */
    public static function handle(Passable $passable, array $pipes, Container $container): Passable
    {
        $pipeline = (new static())
            ->withPassable($passable)
            ->withPipes($pipes);

        return (new IlluminatePipeline($container))
            ->send($pipeline->passable())
            ->through($pipeline->pipes())
            ->thenReturn();
    }

    private function passable(): Passable
    {
        return $this->passable;
    }

    /** @return array<Pipe|string> */
    private function pipes(): array
    {
        return $this->pipes;
    }

    private function withPassable(Passable $passable): Pipeline
    {
        $this->passable = $passable;

        return $this;
    }

    /**
     * @param array<Pipe|string> $pipes
     * @throws InvalidArgumentException
     * @throws MustImplementInterfaceException
     */
    private function withPipes(array $pipes): Pipeline
    {
        if (count($pipes) === 0) {
            throw new InvalidArgumentException('$pipes');
        }

        foreach ($pipes as $pipe) {
            if (is_subclass_of($pipe, Pipe::class)) {
                continue;
            }

            throw new MustImplementInterfaceException($pipe, Pipe::class);
        }

        $this->pipes = $pipes;

        return $this;
    }
}
