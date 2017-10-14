<?php

namespace InstaParserBundle\Operation\Statistics\Get\Top\Service;

use InstaParserBundle\Interaction\Dto\Pagination;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\PaginationRequest;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\TopBrand;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\TopSubscriber;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\SuccessfulResponse;

final class Service extends BaseEntityService
{
    const TOP_MIN_COUNT = 20;

    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|PaginationRequest $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        $topSubscribers = [];

        foreach ($this->repositoryFactory->subscriber()->findTopUntilLimit(self::TOP_MIN_COUNT, $request->getPage(), $request->getStep()) as $topSubscriber) {
            $topSubscribers[] = $this->createTopSubscriber($topSubscriber);
        }

        $topBrands = [];

        foreach ($this->repositoryFactory->brand()->findTopUntilLimit(self::TOP_MIN_COUNT, $request->getPage(), $request->getStep()) as $topBrand) {
            $topBrands[] = $this->createTopBrand($topBrand);
        }

        return
            (new SuccessfulResponse())
                ->setTopSubscribers($topSubscribers)
                ->setTopBrands($topBrands)
                ->setPagination($this->createPagination($request))
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

    /**
     * @param InternalRequestInterface|PaginationRequest $request
     * @return Pagination
     */
    private function createPagination(InternalRequestInterface $request): Pagination
    {
        //$last = ceil($this->repositoryFactory->brand()->getCountWithLimit(self::TOP_MIN_COUNT)[0]['brands'] / $request->getStep());
        //$lastSubscriber = ceil($this->repositoryFactory->subscriber()->getCountWithLimit(self::TOP_MIN_COUNT)[0]['subscribers'] / $request->getStep());

        $last = 200;

        return
            (new Pagination())
                ->setCurrent($request->getPage())
                ->setPaginationList($request->getPage(), $last)
                ->setLast($last)
            ;
    }
}