<?php

namespace InstaParserBundle\Controller;

use InstaParserBundle\Interaction\Dto\Request\EmptyInternalRequest;
use InstaParserBundle\Internal\Service\ServiceInterface;
use InstaParserBundle\Operation\Statistics\Get\Dto\Response\SuccessfulResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

final class StatisticController extends Controller
{
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
     * @return Response
     */
    public function getMentionsAction()
    {
        $response = $this->service->behave(new EmptyInternalRequest());
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
}