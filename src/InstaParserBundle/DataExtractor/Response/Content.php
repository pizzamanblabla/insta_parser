<?php

namespace InstaParserBundle\DataExtractor\Response;

use InstaParserBundle\DataExtractor\Exception\WrongInputFormatException;
use InstaParserBundle\DataExtractor\DataExtractorInterface;
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
    public function extract($extractable)
    {
        if (!($extractable instanceof ResponseInterface)) {
            throw new WrongInputFormatException();
        }
        /** @var ResponseInterface $extractable */

        return
            $this->decoratedDataExtractor->extract(
                $extractable->getBody()->getContents()
            );
    }
}