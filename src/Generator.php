<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as PassableContract;
use Authanram\Generators\Pipes\WriteToOutputPath;
use Closure;
use Exception;

final class Generator
{
    private Closure|null $fillCallback = null;

    /** @var array<string> */
    private array $input = [];

    private string $pattern = Descriptor::PATTERN;

    /** @var array<string> */
    private array $pipes = [
        Pipes\ReadFromInputPath::class,
        Pipes\ResolveTemplateVariables::class,
        Pipes\ReplaceTemplateVariables::class,
        Pipes\Postprocess::class,
    ];

    private PassableContract $passable;

    public static function make(Descriptor|string|null $descriptor = null): self
    {
        $generator = new self();

        $generator->passable = new Passable();

        return $descriptor
            ? $generator->withDescriptor($descriptor)
            : $generator;
    }

    public function withDescriptor(Descriptor|string|null $descriptor): self
    {
        Assert::descriptor($descriptor);

        $this->fillCallback = fn (Input $input) => $descriptor::fill($input);

        $this->passable
            ->withPattern($descriptor::pattern())
            ->withInputPath($descriptor::path());

        return $this;
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $this->input = $input;

        return $this;
    }

    public function withFillCallback(callable $fillCallback): self
    {
        Assert::isCallable($fillCallback);

        $this->fillCallback = $fillCallback;

        return $this;
    }

    public function withInputPath(string $inputPath): self
    {
        $this->passable->withInputPath($inputPath);

        return $this;
    }

    public function withOutputPath(string $outputPath): self
    {
        Assert::outputPath($outputPath);

        $this->passable->withOutputPath($outputPath);

        $this->pipes[] = WriteToOutputPath::class;

        return $this;
    }

    public function withPattern(string $pattern): self
    {
        Assert::pattern($pattern);

        $this->pattern = $pattern;

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
        $this->passable
            ->withInputFilled(($this->fillCallback)(new Input($this->input)))
            ->withPattern($this->pattern);

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
