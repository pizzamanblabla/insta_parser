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
        $tagsData = [];
        $tags = $this->repositoryFactory->tag()->findAll();

        foreach ($tags as $tag) {
            $tagsData[] = [
                'tag' => $tag->getId(),
                'type' => $tag->getType(),
                'count' => $this->repositoryFactory->subscriber()->findAllCountByTag($tag)[0]['quantity'],
                'worked' => $this->repositoryFactory->subscriber()->findAllCountWithWorkedByTag($tag)[0]['quantity'],
                'emails' => $this->repositoryFactory->subscriber()->findAllCountWithEmailByTag($tag)[0]['quantity'],
            ];
        }

        return $this->render('InstaParserBundle:Parsing:status.html.twig', ['tagsData' => $tagsData]);
    }
}