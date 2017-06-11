<?php

namespace InstaParserBundle\Operation\Statistics\Get\Top\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\TopBrand;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\TopSubscriber;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\SuccessfulResponse;

final class Service extends BaseEntityService
{
    const TOP_COUNT = 100;

    /**
     * {@inheritdoc}
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        $topSubscribers = [];

        foreach ($this->repositoryFactory->subscriber()->findTopWithLimit(self::TOP_COUNT) as $topSubscriber) {
            $topSubscribers[] = $this->createTopSubscriber($topSubscriber);
        }

        $topBrands = [];

        foreach ($this->repositoryFactory->brand()->findTopWithLimit(self::TOP_COUNT) as $topBrand) {
            $topBrands[] = $this->createTopBrand($topBrand);
        }

        return
            (new SuccessfulResponse())
                ->setTopSubscribers($topSubscribers)
                ->setTopBrands($topBrands)
            ;
    }

    /**
     * @param mixed[] $data
     * @return TopSubscriber
     */
    private function createTopSubscriber(array $data)
    {
        return
            (new TopSubscriber())
                ->setSubscriber($data[0])
                ->setBrandCount($data['brandCount'])
            ;
    }

    /**
     * @param mixed[] $data
     * @return TopBrand
     */
    private function createTopBrand(array $data)
    {
        return
            (new TopBrand())
                ->setBrand($data[0])
                ->setSubscriberCount($data['subscriberCount'])
            ;
    }
}