<?php

namespace InstaParserBundle\Controller;

use InstaParserBundle\Interaction\Dto\Request\EmptyInternalRequest;
use InstaParserBundle\Interaction\Dto\Request\PaginationRequest;
use InstaParserBundle\Internal\Service\ServiceInterface;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response\SuccessfulResponse;
use InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response\SuccessfulResponse as HashtagSuccessfulResponse;
use InstaParserBundle\Operation\Statistics\Get\Top\Dto\Response\SuccessfulResponse as TopSuccessfulResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

final class StatisticController extends Controller
{
    const STEP = 100;

    /**
     * @var ServiceInterface
     */
    private $brandService;

    /**
     * @var ServiceInterface
     */
    private $topService;

    /**
     * @var ServiceInterface
     */
    private $hashtagService;

    /**
     * @param ContainerInterface $container
     * @param ServiceInterface $brandService
     * @param ServiceInterface $topService
     * @param ServiceInterface $hashtagService
     */
    public function __construct(
        ContainerInterface $container,
        ServiceInterface $brandService,
        ServiceInterface $topService,
        ServiceInterface $hashtagService
    ) {
        $this->setContainer($container);

        $this->brandService = $brandService;
        $this->topService = $topService;
        $this->hashtagService = $hashtagService;
    }

    /**
     * @param int $page
     * @return Response
     */
    public function getMentionsAction($page = 1)
    {
        $response = $this->brandService->behave($this->createRequest($page));
        /* @var SuccessfulResponse $response  */

        return
            $this->render(
                'InstaParserBundle:Statistic:mentions.html.twig',
                [
                    'statistics' => $response->getStatistic(),
                    'pagination' => $response->getPagination(),
                    'pageType' => 'brand',
                ]
            );
    }

    /**
     * @param int $page
     * @return Response
     */
    public function getTopAction($page = 1)
    {
        $response = $this->topService->behave($this->createRequest($page));
        /* @var TopSuccessfulResponse $response  */

        return
            $this->render(
                'InstaParserBundle:Statistic:top.html.twig',
                [
                    'topBloggers' => $response->getTopSubscribers(),
                    'topBrands' => $response->getTopBrands(),
                    'pagination' => $response->getPagination(),
                    'pageType' => 'top',
                ]
            );
    }

    /**
     * @return Response
     */
    public function getHashtagAction()
    {
        $response = $this->hashtagService->behave(new EmptyInternalRequest());
        /** @var HashtagSuccessfulResponse $response  */

        return
            $this->render(
                'InstaParserBundle:Statistic:hashtag.html.twig',
                [
                    'subscribers' => $response->getSubscribers(),
                    'facebookSubscribers' => json_decode(file_get_contents(__DIR__ . '/../../../facebook.json'), 1),
                ]
            );
    }

    /**
     * @param int $page
     * @return PaginationRequest
     */
    private function createRequest(int $page)
    {
        return
            (new PaginationRequest())
                ->setPage($page)
                ->setStep(self::STEP)
            ;
    }
}