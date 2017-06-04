<?php

namespace InstaParserBundle\Internal\Sanitizer;

final class Sanitizer implements SanitizerInterface
{
    /**
     * @var string[]
     */
    private $symbols;

    /**
     * @param string[] $symbols
     */
    public function __construct(array $symbols)
    {
        $this->symbols = $symbols;
    }

    /**
     * {@inheritdoc}
     */
    public function sanitize(string $data): string
    {
        return trim($data, implode('', $this->symbols));
    }
}