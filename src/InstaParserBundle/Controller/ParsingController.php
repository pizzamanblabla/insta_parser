<?php

namespace InstaParserBundle\Controller;

use InstaParserBundle\Entity\Repository\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ParsingController extends Controller
{
    /**
     * @var FactoryInterface
     */
    private $repositoryFactory;

    /**
     * @param FactoryInterface $repositoryFactory
     */
    public function __construct(FactoryInterface $repositoryFactory) {
        $this->repositoryFactory = $repositoryFactory;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getUploadAction(Request $request)
    {
        return $this->render('InstaParserBundle:Parsing:upload.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getResultsAction(Request $request)
    {

        return
            $this->render(
                'InstaParserBundle:Parsing:status.html.twig',
                [
                    'pageType' => 'brand',
                ]
            );
    }
}