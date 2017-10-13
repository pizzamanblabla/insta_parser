<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Service;

use Doctrine\ORM\EntityManagerInterface;
use InstaParserBundle\Entity\Repository\FactoryInterface as RepositoryFactoryInterface;
use InstaParserBundle\Entity;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\TagType;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response\Location;
use InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response\Post;
use InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response\Subscriber;
use InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response\SuccessfulResponse;
use Psr\Log\LoggerInterface;

final class Service extends BaseEntityService
{
    /**
     * @var string[]
     */
    private $targetHashtags;

    /**
     * @var string[]
     */
    private $targetLocations;

    /**
     * @param EntityManagerInterface $entityManager
     * @param RepositoryFactoryInterface $repositoryFactory
     * @param array $targetHashtags
     * @param array $targetLocations
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RepositoryFactoryInterface $repositoryFactory,
        array $targetHashtags,
        array $targetLocations,
        LoggerInterface $logger
    ) {
        parent::__construct($entityManager, $repositoryFactory, $logger);

        $this->targetHashtags = $targetHashtags;
        $this->targetLocations = $targetLocations;
    }

    /**
     * {@inheritdoc}
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        return
            (new SuccessfulResponse())
                ->setSubscribers(
                    $this->getSubscribers($this->repositoryFactory->tag()->findOneByType(TagType::WORLD_CLASS)
                    )
                );
    }

    /**
     * @param Entity\Tag $tag
     * @return Subscriber[]
     */
    private function getSubscribers(Entity\Tag $tag): array
    {
        $subscribers = [];

        foreach ($tag->getSubscribers() as $subscriber) {
            $subscribers[] = $this->createSubscriber($subscriber);
        }

        return $subscribers;
    }

    /**
     * @param Entity\Subscriber $entitySubscriber
     * @return Subscriber
     */
    private function createSubscriber(Entity\Subscriber $entitySubscriber): Subscriber
    {
        $subscriber = (new Subscriber())
            ->setLink($entitySubscriber->getLink())
            ->setWork($entitySubscriber->getWork())
            ->setName($entitySubscriber->getRealName())
            ->setLocation($entitySubscriber->getLocation())
            ->setSubscribers($entitySubscriber->getSubscribers())
        ;

        if (count($entitySubscriber->getPosts())) {
            $subscriber
                ->setHashtagPosts($this->getPostsByHashtags($entitySubscriber))
                ->setLocationPosts($this->getPostsByLocation($entitySubscriber))
            ;
        }

        return $subscriber;
    }

    /**
     * @param Entity\Subscriber $entitySubscriber
     * @return array
     */
    private function getPostsByHashtags(Entity\Subscriber $entitySubscriber): array
    {
        $posts = [];

        foreach ($entitySubscriber->getPosts() as $entityPost) {
            foreach ($entityPost->getHashtags() as $hashtag) {
                if (in_array(mb_strtolower($hashtag->getName()), $this->targetHashtags)) {
                    $posts[] = $this->createPost($entityPost)->setHashtag($hashtag->getName());
                }
            }
        }

        return $posts;
    }

    /**
     * @param Entity\Subscriber $entitySubscriber
     * @return array
     */
    private function getPostsByLocation(Entity\Subscriber $entitySubscriber): array
    {
        $posts = [];

        foreach ($entitySubscriber->getPosts() as $entityPost) {
            if (!empty($entityPost->getLocation())) {
                foreach ($this->targetLocations as $location) {
                    if (
                        $location['lat'] == $entityPost->getLocation()->getLat() &&
                        $location['long'] == $entityPost->getLocation()->getLong()
                    ) {
                        $posts[] = $this->createPost($entityPost)
                            ->setLocation($this->createLocation($entityPost->getLocation()))
                        ;
                    }
                }
            }
        }

        return $posts;
    }

    /**
     * @param Entity\Post $entityPost
     * @return Post
     */
    private function createPost(Entity\Post $entityPost): Post
    {
        return (new Post())->setLink($entityPost->getCode());
    }

    /**
     * @param Entity\Location $entityLocation
     * @return Location
     */
    private function createLocation(Entity\Location $entityLocation): Location
    {
        return
            (new Location())
                ->setName($entityLocation->getName())
                ->setLong($entityLocation->getLong())
                ->setLat($entityLocation->getLat())
            ;
    }
}