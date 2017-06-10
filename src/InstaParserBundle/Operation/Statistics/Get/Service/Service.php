<?php

namespace InstaParserBundle\Operation\Statistics\Get\Service;

use DateTime;
use InstaParserBundle\Entity\Brand;
use InstaParserBundle\Entity\Mention;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Statistics\Get\Dto\Request\Request;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\BloggersCount;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\Pagination;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\StatisticElement;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\SuccessfulResponse;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\TopBrand;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\TopSubscriber;

final class Service extends BaseEntityService
{
    const TOP_COUNT = 20;

    /**
     * @param InternalRequestInterface|Request $request
     * @return InternalResponseInterface
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        $brands = $this->repositoryFactory->brand()->findAllWithOrder($request->getPage(), $request->getStep());
        $statisticElements = [];

        foreach ($brands as $brand) {
            $todaySubscribers = $this->getSubscribersFromMentions($this->getMentions($brand, (new DateTime())->modify('-1 day')));
            $weekSubscribers = $this->getSubscribersFromMentions($this->getMentions($brand, (new DateTime())->modify('-7 day')));
            $monthSubscribers = $this->getSubscribersFromMentions($this->getMentions($brand, (new DateTime())->modify('-1 month')));

            $statisticElements[] = $this->createStatisticElement(
                $brand,
                $todaySubscribers,
                $weekSubscribers,
                $monthSubscribers
            );
        }

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
                ->setStatistic($statisticElements)
                ->setTopSubscribers($topSubscribers)
                ->setTopBrands($topBrands)
                ->setPagination($this->createPagination($request))
            ;
    }

    /**
     * @param Mention[] $mentions
     * @return Subscriber[]
     */
    private function getSubscribersFromMentions(array $mentions): array
    {
        $subscribers = [];

        foreach ($mentions as $mention) {
            if (!in_array($mention->getSubscriber(), $subscribers)) {
                $subscribers[] = $mention->getSubscriber();
            }
        }

        return $subscribers;
    }

    /**
     * @param Brand $brand
     * @param Subscriber[] $todaySubscribers
     * @param Subscriber[] $weekSubscribers
     * @param Subscriber[] $monthSubscribers
     * @return StatisticElement
     */
    private function createStatisticElement(
        Brand $brand,
        array $todaySubscribers,
        array $weekSubscribers,
        array $monthSubscribers
    ) {
        return
            (new StatisticElement())
                ->setBrand($brand)
                ->setTodaySubscribers($todaySubscribers)
                ->setWeekSubscribers($weekSubscribers)
                ->setMonthSubscribers($monthSubscribers)
                ->setTodayBloggerCount($this->createBloggerCount($todaySubscribers))
                ->setWeekBloggerCount($this->createBloggerCount($weekSubscribers))
                ->setMonthBloggerCount($this->createBloggerCount($monthSubscribers))
            ;
    }

    /**
     * @param Subscriber[] $subscribers
     * @return BloggersCount
     */
    private function createBloggerCount(array $subscribers)
    {
        $onPlatform = 0;

        foreach ($subscribers as $subscriber) {
            if ($subscriber->isIsOnPlatform()) {
                $onPlatform++;
            }
        }

        return
            (new BloggersCount())
                ->setFromPlatform($onPlatform)
                ->setNotFromPlatform(count($subscribers) - $onPlatform)
            ;
    }

    /**
     * @param Brand $brand
     * @param DateTime $date
     * @return Mention[]
     */
    private function getMentions(Brand $brand, DateTime $date): array
    {
        return $this->repositoryFactory->mention()->findAllByBrandAndTimeSpan($brand, $date);
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
     * @param InternalRequestInterface|Request $request
     * @return Pagination
     */
    private function createPagination(InternalRequestInterface $request): Pagination
    {
        $last = ceil($this->repositoryFactory->brand()->getCount()[0]['brands'] / $request->getStep());

        return
            (new Pagination())
                ->setCurrent($request->getPage())
                ->setList($this->getPaginationList($request->getPage(),$last))
                ->setLast($last)
            ;
    }

    /**
     * @param int $current
     * @param int $last
     * @return array
     */
    private function getPaginationList(int $current, int $last): array
    {
        $list = [];

        for ($i = -2; $i < 3; $i++) {
            $element = $current + $i;

            if ($element > 0 && $element <= $last) {
                $list[] = $element;
            }
        }

        return $list;
    }
}