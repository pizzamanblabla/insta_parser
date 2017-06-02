<?php

namespace InstaParserBundle\DataExtractor\String;

use InstaParserBundle\DataExtractor\Exception\WrongInputFormatException;
use InstaParserBundle\PayloadModifier\PayloadModifierInterface;

final class RegExp implements DataExtractorInterface
{
    /**
     * @var PayloadModifierInterface
     */
    private $payloadModifier;

    /**
     * @var string
     */
    private $regExp;

    /**
     * @param PayloadModifierInterface $payloadModifier
     * @param string $regExp
     */
    public function __construct(PayloadModifierInterface $payloadModifier, string $regExp)
    {
        $this->payloadModifier = $payloadModifier;
        $this->regExp = $regExp;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($extractable)
    {
        if (!is_string($extractable)) {
            throw new WrongInputFormatException();
        }

        $matched = preg_match($this->regExp, $extractable, $match) ? $match[0] : '';

        return $this->payloadModifier->modify($matched);
    }
}