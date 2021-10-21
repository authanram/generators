<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Pipe;
use Authanram\Generators\Contracts\Pipeline as Contract;
use Authanram\Generators\Exceptions\InvalidArgument;
use Authanram\Generators\Exceptions\MustImplementInterface;
use Illuminate\Container\Container;
use Illuminate\Pipeline\Pipeline as IlluminatePipeline;

final class Pipeline implements Contract
{
    private Passable $passable;

    /** @var array<Pipe|string> */
    private array $pipes;

    /**
     * @param array<Pipe|string> $pipes
     * @throws InvalidArgument
     * @throws MustImplementInterface
     */
    public static function handle(Passable $passable, array $pipes, Container $container): Passable
    {
        $pipeline = (new self())
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

    private function withPassable(Passable $passable): Contract
    {
        $this->passable = $passable;

        return $this;
    }

    /**
     * @param array<Pipe|string> $pipes
     * @throws InvalidArgument
     * @throws MustImplementInterface
     */
    private function withPipes(array $pipes): Contract
    {
        if (count($pipes) === 0) {
            throw new InvalidArgument('$pipes');
        }

        foreach ($pipes as $pipe) {
            if (is_subclass_of($pipe, Pipe::class)) {
                continue;
            }

            throw new MustImplementInterface($pipe, Pipe::class);
        }

        $this->pipes = $pipes;

        return $this;
    }
}
