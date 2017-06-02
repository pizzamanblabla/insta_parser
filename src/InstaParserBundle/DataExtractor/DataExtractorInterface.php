<?php

namespace InstaParserBundle\DataExtractor\String;

interface DataExtractorInterface
{
    /**
     * @param mixed $extractable
     * @return mixed[]
     */
    public function extract($extractable);
}