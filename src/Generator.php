<?php /** @noinspection PhpDocSignatureIsNotCompleteInspection */

declare(strict_types=1);

namespace Authanram\Generators;

use Authanram\Generators\Contracts\Passable as PassableContract;
use Authanram\Generators\Pipes\WriteToOutputPath;
use Closure;
use Exception;

final class Generator
{
    public const PIPES = [
        Pipes\ResolveTemplateVariables::class,
        Pipes\ReplaceTemplateVariables::class,
        Pipes\Postprocess::class,
    ];

    private Closure|null $fillCallback = null;

    /** @var array<string> */
    private array $input = [];

    private string $pattern = Descriptor::PATTERN;

    /** @var array<string> */
    private array $pipes = self::PIPES;

    private PassableContract $passable;

    public function __construct(Descriptor|string|null $descriptor = null)
    {
        $this->passable = new Passable();

        $descriptor ? $this->withDescriptor($descriptor) : null;
    }

    public static function make(Descriptor|string|null $descriptor = null): self
    {
        return new self($descriptor);
    }

    public function withDescriptor(Descriptor|string|null $descriptor): self
    {
        Assert::descriptor($descriptor);

        $this->fillCallback = static function (Input $input) use ($descriptor) {
            return $descriptor::fill($input);
        };

        $this->passable
            ->withPattern($descriptor::pattern())
            ->withInputPath($descriptor::path());

        array_unshift($this->pipes, Pipes\ReadFromInputPath::class);

        return $this;
    }

    public function withFillCallback(callable $fillCallback): self
    {
        $this->fillCallback = $fillCallback;

        return $this;
    }

    /** @param array<string> $input */
    public function withInput(array $input): self
    {
        Assert::input($input);

        $this->input = $input;

        return $this;
    }

    public function withInputPath(string $inputPath): self
    {
        $this->passable->withInputPath($inputPath);

        array_unshift($this->pipes, Pipes\ReadFromInputPath::class);

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

    public function withTemplate(string $template): self
    {
        $this->passable->withPattern($this->pattern);

        Assert::template($template);

        Assert::templateVariables($template, $this->pattern);

        $this->passable->withTemplate($template);

        return $this;
    }

    /** @throws GeneratorException */
    public function generate(): Passable
    {
        $input = $this->fillCallback
            ? ($this->fillCallback)(new Input($this->input))
            : $this->input;

        $this->passable
            ->withInputFilled($input)
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

    /** @throws GeneratorException */
    public function get(): string
    {
        return $this->generate()->template();
    }
}
