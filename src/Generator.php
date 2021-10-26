<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as PassableContract;
use Authanram\Generators\Pipes\WriteToOutputPath;
use Exception;

final class Generator
{
    /** @var array<string> */
    private array $pipes = [
        Pipes\ReadFromInputPath::class,
        Pipes\ResolveTemplateVariables::class,
        Pipes\ReplaceTemplateVariables::class,
        Pipes\Postprocess::class,
    ];

    private Descriptor|string $descriptor;

    private PassableContract $passable;

    /** @param Descriptor|string $descriptor */
    public function __construct(mixed $descriptor)
    {
        Assert::descriptor($descriptor);

        $this->descriptor = $descriptor;

        $this->passable = (new Passable())
            ->withPattern($this->descriptor::pattern())
            ->withInputPath($this->descriptor::path());
    }

    /** @param Descriptor|string $descriptor */
    public static function make(mixed $descriptor): self
    {
        return new self($descriptor);
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $inputFilled = $this->descriptor::fill(new Input($input));

        $this->passable->withInputFilled($inputFilled);

        return $this;
    }

    public function withOutputPath(string $outputPath): self
    {
        Assert::outputPath($outputPath);

        $this->passable->withOutputPath($outputPath);

        $this->pipes[] = WriteToOutputPath::class;

        return $this;
    }

    /** @param array<string> $pipes */
    public function withPipes(array $pipes): self
    {
        Assert::pipes($pipes);

        $this->pipes = $pipes;

        return $this;
    }

    /**
     * @throws GeneratorException
     */
    public function generate(): Passable
    {
        try {
            return Pipeline::create()
                ->send($this->passable)
                ->through($this->pipes)
                ->thenReturn();
        } catch (Exception $e) {
            throw new GeneratorException($e->getMessage());
        }
    }
}
