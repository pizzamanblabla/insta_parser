<?php

namespace InstaParserBundle\DataExtractor\Response;

use Pizzamanblabla\DataTransformerBundle\DataExtractor\DataExtractorInterface;
use Pizzamanblabla\DataTransformerBundle\DataExtractor\Exception\DataExtractionException;
use Psr\Http\Message\ResponseInterface;

final class Content implements DataExtractorInterface
{
    /**
     * @var DataExtractorInterface
     */
    private $decoratedDataExtractor;

    /**
     * @param DataExtractorInterface $decoratedDataExtractor
     */
    public function __construct(DataExtractorInterface $decoratedDataExtractor)
    {
        $this->decoratedDataExtractor = $decoratedDataExtractor;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($extractable): array
    {
        if (!($extractable instanceof ResponseInterface)) {
            throw new DataExtractionException();
        }
        /** @var ResponseInterface $extractable */

        return $this->decoratedDataExtractor->extract($extractable->getBody()->getContents());
    }
}