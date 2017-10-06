<?php

namespace InstaParserBundle\Operation\Post\Update\DataUpdater;

use InstaParserBundle\Entity\Location;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\DataUpdater\BaseDataUpdater;
use InstaParserBundle\Operation\Post\Update\Dto\Request\Request;
use InstaParserBundle\Operation\Post\Update\Dto\Response\Response;

final class DataUpdater extends BaseDataUpdater
{
    /**
     * @param InternalRequestInterface|Request $request
     * @param InternalResponseInterface|Response $response
     * @return void
     */
    public function update(InternalRequestInterface $request, InternalResponseInterface $response)
    {
        $request->getPost()->setType($response->getTypeName());

        if ($response->getLocation()) {
            $request->getPost()->setLocation($this->resolveLocation($response));
        }
    }

    /**
     * @param InternalResponseInterface|Response $response
     * @return Location
     */
    private function resolveLocation(InternalResponseInterface $response): Location
    {
        $location = $this->repositoryFactory->location()->findOneByCode($response->getLocation()->getId());

        if (!$location) {
            $location =
                (new Location())
                    ->setCode($response->getLocation()->getId())
                    ->setName($response->getLocation()->getName())
            ;

            $this->entityManager->persist($location);
            $this->entityManager->flush();
        }

        return $location;
    }
}