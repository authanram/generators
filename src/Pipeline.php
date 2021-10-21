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

    /**
     * @param array<Pipe|string> $pipes
     * @throws InvalidArgumentException
     * @throws MustImplementInterfaceException
     */
    private function setPipes(array $pipes): Pipeline
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
