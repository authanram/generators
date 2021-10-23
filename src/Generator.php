<?php

declare(strict_types=1);

namespace Authanram\Generators;

use Exception;

final class Generator
{
    /** @var array<string> */
    private array $data = [];

    private string $descriptor = '';

    private string $filename = '';

    public static function make(string $descriptor): self
    {
        return (new self())->withDescriptor($descriptor);
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $this->data = $input;

        return $this;
    }

    public function withDescriptor(string $descriptor): self
    {
        Assert::descriptor($descriptor);

        $this->descriptor = $descriptor;

        return $this;
    }

    public function withFilename(string $filename): self
    {
        Assert::filename($filename);

        $this->filename = $filename;

        return $this;
    }

    /**
     * @throws GeneratorException
     *
     * @noinspection PhpUndefinedMethodInspection
     */
    public function generate(): Passable
    {
        $passable = (new Passable())
            ->withFilename($this->filename)
            ->withFillCallback(function ($input): array {
                return $this->descriptor::fill($input);
            })->withInput($this->data)
            ->withPattern($this->descriptor::pattern())
            ->withStub($this->descriptor::stub());

        try {
            return Pipeline::create()
                ->send($passable)
                ->through($this->pipes())
                ->thenReturn();
        } catch (Exception $e) {
            throw new GeneratorException($e->getMessage());
        }
    }

    /** @return array<string> */
    private function pipes(): array
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $pipes = $this->descriptor::pipes();

        Assert::pipes($pipes);

        return $pipes;
    }
}
