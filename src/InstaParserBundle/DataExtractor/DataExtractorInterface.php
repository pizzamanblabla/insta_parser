<?php

namespace InstaParserBundle\DataExtractor;

interface DataExtractorInterface
{
    /**
     * @param mixed $extractable
     * @return mixed[]
     */
    public function extract($extractable);
}