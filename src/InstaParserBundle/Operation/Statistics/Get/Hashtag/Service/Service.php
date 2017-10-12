<?php

namespace InstaParserBundle\Operation\Statistics\Get\Hashtag\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Enum\TagType;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Statistics\Get\Hashtag\Dto\Response\SuccessfulResponse;

final class Service extends BaseEntityService
{
    const TOP_MIN_COUNT = 5;

    /**
     * {@inheritdoc}
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        return
            (new SuccessfulResponse())
                ->setTag($this->repositoryFactory->tag()->findOneByTypeAsArray(TagType::WORLD_CLASS));
    }
}