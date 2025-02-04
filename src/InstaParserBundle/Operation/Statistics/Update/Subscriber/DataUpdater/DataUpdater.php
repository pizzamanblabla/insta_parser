<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\DataUpdater;

use DateTime;
use InstaParserBundle\Entity\Brand;
use InstaParserBundle\Entity\Hashtag;
use InstaParserBundle\Entity\Mention;
use InstaParserBundle\Entity\Post;
use InstaParserBundle\Entity\Subscriber;
use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Request\SubscriberRequest;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\UpdateStatus;
use InstaParserBundle\Internal\DataUpdater\BaseDataUpdater;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Response\Publication;
use InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Response\SuccessfulResponse;

final class DataUpdater extends BaseDataUpdater
{
    /**
     * @param InternalRequestInterface|SubscriberRequest $request
     * @param InternalResponseInterface|SuccessfulResponse $response
     * @return void
     */
    public function update(InternalRequestInterface $request, InternalResponseInterface $response)
    {
        if (!$response->getType()->isSuccessful()) {
            $request->getSubscriber()->setStatus(UpdateStatus::FAILED);
        } else {
            $request->getSubscriber()
                ->setStatus(UpdateStatus::READY)
                ->setUpdatedAt(new DateTime())
            ;

            $this->updateMentions($response, $request->getSubscriber());
        }
    }

    /**
     * @param InternalResponseInterface|SuccessfulResponse $response
     * @param Subscriber $subscriber
     */
    private function updateMentions(InternalResponseInterface $response, Subscriber $subscriber)
    {
        $brandPool = [];

        foreach ($response->getPublications() as $publication) {
            if (!empty($publication->getCaption())) {
                $brands = $this->findBrands($publication->getCaption());
                $post = $this->updatePost($publication, $subscriber);

                foreach ($brands as $brandName) {
                    $brand = $this->getOrCreateBrand($brandName);

                    if (!in_array($brandName, $brandPool)) {
                        $brandPool[] = $brandName;

                        $this->updateMention(
                            (new DateTime())->modify('@' . $publication->getTimestamp()),
                            $brand,
                            $subscriber,
                            $post
                        );
                    }
                }
            }
        }
    }

    /**
     * @param string $caption
     * @return string[]
     */
    private function findBrands(string $caption): array
    {
        $result = preg_match_all('/@[^\s()!\'"\/\\\#\?\:\,\n\t]+/ui', $caption, $match);

        return $result ? $match[0] : [];
    }

    /**
     * @param string $caption
     * @return string[]
     */
    private function findHashtags(string $caption): array
    {
        $result = preg_match_all('/\B(\#[a-zA-Zа-яА-Я]+\b)(?!;)/ui', $caption, $match);

        return $result ? $match[0] : [];
    }

    /**
     * @param string $name
     * @return Brand
     */
    private function getOrCreateBrand(string $name): Brand
    {
        $name = trim($name, '.');
        $brand = $this->repositoryFactory->brand()->findOneByName($name);

        if (!$brand) {
            $brand = (new Brand())->setName($name);

            $this->entityManager->persist($brand);
            $this->entityManager->flush();
        }

        return $brand;
    }

    /**
     * @param string $name
     * @return Hashtag
     */
    private function getOrCreateHashtag(string $name): Hashtag
    {
        $name = trim($name, '.');
        $hashtag = $this->repositoryFactory->hashtag()->findOneByName($name);

        if (!$hashtag) {
            $hashtag = (new Hashtag())->setName($name);

            $this->entityManager->persist($hashtag);
            $this->entityManager->flush();
        }

        return $hashtag;
    }

    /**
     * @param Publication $publication
     * @param Subscriber $subscriber
     * @return Post
     */
    private function updatePost(Publication $publication, Subscriber $subscriber): Post
    {
        $post = $this->repositoryFactory->post()->findOneByCode($publication->getCode());

        if (!$post) {
            $post = (new Post())
                ->setCode($publication->getCode())
                ->setDate((new DateTime())->modify('@' . $publication->getTimestamp()))
                ->setSubscriber($subscriber)
            ;

            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }

        $hashtags = $this->findHashtags($publication->getCaption());

        $hashtagEntities = [];

        foreach ($hashtags as $hashtagName) {
            $hashtagEntities[] = $this->getOrCreateHashtag($hashtagName);
        }

        $post->setHashtags(
            array_merge(
                is_array($post->getHashtags()) && count($post->getHashtags())
                    ? $post->getHashtags()
                    : [],
                $hashtagEntities
            )
        );

        return $post;
    }

    /**
     * @param DateTime $date
     * @param Brand $brand
     * @param Subscriber $subscriber
     * @param Post $post
     * @return void
     */
    private function updateMention(DateTime $date, Brand $brand, Subscriber $subscriber, Post $post)
    {
        if (!$this->repositoryFactory->mention()->findOneByDateAndBrandAndSubscriber($date, $brand, $subscriber)) {
            $mention = (new Mention())
                ->setBrand($brand)
                ->setSubscriber($subscriber)
                ->setPost($post)
                ->setDate($date)
            ;

            $this->entityManager->persist($mention);
            $this->entityManager->flush();
        }
    }
}