<?php

namespace InstaParserBundle\Operation\Parsing\Download\Service;

use InstaParserBundle\Interaction\Dto\Request\InternalRequestInterface;
use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Internal\Service\BaseEntityService;
use InstaParserBundle\Operation\Parsing\Download\Dto\Request\Request;
use InstaParserBundle\Operation\Parsing\Download\Dto\Response\SuccessfulResponse;

final class Service extends BaseEntityService
{
    /**
     * @param InternalRequestInterface|Request $request
     * @return InternalResponseInterface
     */
    public function behave(InternalRequestInterface $request): InternalResponseInterface
    {
        return (new SuccessfulResponse())->setEmails(
            array_map(function($array) {
                return $array['email'];
            },$this->repositoryFactory->subscriber()->findAllByTag($request->getTag()))
        );
    }
}