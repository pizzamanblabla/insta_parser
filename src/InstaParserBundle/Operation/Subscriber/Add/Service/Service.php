<?php

namespace InstaParserBundle\Operation\Subscriber\Add\Service;

use DateTime;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\EmptyInnerSuccessfulResponse;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Subscriber\Add\Dto\Request\Request;

final class Service extends BaseEntityService
{
    /**
     * {@inheritdoc}
     * @param InternalRequestInterface|Request $request
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        array_map(
            function(string $name) use ($request) {
                if (is_null($this->repositoryFactory->subscriber()->findOneByName($name))) {
                    $this->createSubscriber($name, $request->isOnPlatform());
                }
            },
            $request->getNames()
        );

        return new EmptyInnerSuccessfulResponse();
    }

    /**
     * @param string $name
     * @param bool $isOnPlatform
     * @return void
     */
    private function createSubscriber(string $name, bool $isOnPlatform)
    {
        $this->entityManager->persist(
            (new Subscriber())
                ->setName($name)
                ->setLink($this->buildLink($name))
                ->setIsOnPlatform($isOnPlatform)
                ->setUpdatedAt(new DateTime())
                ->setStatus(UpdateStatus::ready()->getValue())
        );
    }

    /**
     * @param string $name
     * @return string
     */
    private function buildLink(string $name): string
    {
        return sprintf('https://www.instagram.com/%s', $name);
    }
}