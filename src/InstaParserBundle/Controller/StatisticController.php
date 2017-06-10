<?php

namespace InstaParserBundle\Controller;

use InstaParserBundle\Internal\Service\ServiceInterface;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use InstaParserBundle\Operation\Statistics\Get\Dto\Request\Request;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\SuccessfulResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

final class StatisticController extends Controller
{
    const STEP = 500;

    /**
     * @var ServiceInterface
     */
    private $service;

    /**
     * @param ContainerInterface $container
     * @param ServiceInterface $service
     */
    public function __construct(ContainerInterface $container, ServiceInterface $service)
    {
        $this->setContainer($container);

        $this->service = $service;
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

        $response = $this->service->behave($this->createRequest($page));
        /* @var SuccessfulResponse $response  */

        return
            $this->render(
                'InstaParserBundle:Statistic:mentions.html.twig',
                [
                    'statistics' => $response->getStatistic(),
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