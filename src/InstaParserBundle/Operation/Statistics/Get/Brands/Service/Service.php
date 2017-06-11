<?php

namespace InstaParserBundle\Operation\Statistics\Get\Brands\Service;

use DateTime;
use InstaParserBundle\Entity\Brand;
use InstaParserBundle\Entity\Mention;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Request\Request;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response\BloggersCount;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response\Pagination;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response\StatisticElement;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response\SuccessfulResponse;

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

        return
            (new SuccessfulResponse())
                ->setStatistic($statisticElements)
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