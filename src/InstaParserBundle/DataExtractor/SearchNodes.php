<?php

namespace InstaParserBundle\DataExtractor;

final class SearchNodes implements DataExtractorInterface
{
    /**
     * @var DataExtractorInterface
     */
    private $decoratedDataExtractor;

    /**
     * @var string[]
     */
    private $targetKeys;

    /**
     * @param DataExtractorInterface $decoratedDataExtractor
     * @param array $targetKeys
     */
    public function __construct(DataExtractorInterface $decoratedDataExtractor, array $targetKeys)
    {
        $this->decoratedDataExtractor = $decoratedDataExtractor;
        $this->targetKeys = $targetKeys;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($extractable)
    {
        $extracted = $this->decoratedDataExtractor->extract($extractable);

        return $this->search($extracted);
    }

    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    private function search(array $data): array
    {
        $found = [];

        foreach ($data as $key => $value) {
            if (is_string($key) && in_array($key, $this->targetKeys)) {
                $found[$key] = $value;
            } elseif (is_array($value)) {
                $found = array_merge($found, $this->search($value));
            }
        }

        return $found;
    }
}