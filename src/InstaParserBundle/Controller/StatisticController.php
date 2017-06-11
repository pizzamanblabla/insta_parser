<?php

namespace InstaParserBundle\Controller;

use InstaParserBundle\Interaction\Dto\Request\EmptyInternalRequest;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Request\Request;
use InstaParserBundle\Operation\Statistics\Get\Brands\Dto\Response\SuccessfulResponse;
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
     * @param ContainerInterface $container
     * @param ServiceInterface $brandService
     * @param ServiceInterface $topService
     */
    public function __construct(ContainerInterface $container, ServiceInterface $brandService, ServiceInterface $topService)
    {
        $this->setContainer($container);

        $this->brandService = $brandService;
        $this->topService = $topService;
    }

    /**
     * @param HttpRequest $request
     * @return Response
     */
    public function getMentionsAction(HttpRequest $request)
    {
        $page = $request->query->get('page');

        if (!$page) {
            $page = 1;
        }

        $response = $this->brandService->behave($this->createRequest($page));
        /* @var SuccessfulResponse $response  */

        return
            $this->render(
                'InstaParserBundle:Statistic:mentions.html.twig',
                [
                    'statistics' => $response->getStatistic(),
                    'pagination' => $response->getPagination(),
                ]
            );
    }

    /**
     * @return Response
     */
    public function getTopAction()
    {
        $response = $this->topService->behave(new EmptyInternalRequest());
        /* @var TopSuccessfulResponse $response  */

        return
            $this->render(
                'InstaParserBundle:Statistic:top.html.twig',
                [
                    'topBloggers' => $response->getTopSubscribers(),
                    'topBrands' => $response->getTopBrands(),
                ]
            );
    }

    /**
     * @param int $page
     * @return Request
     */
    private function createRequest(int $page)
    {
        return
            (new Request())
                ->setPage($page)
                ->setStep(self::STEP)
            ;
    }
}