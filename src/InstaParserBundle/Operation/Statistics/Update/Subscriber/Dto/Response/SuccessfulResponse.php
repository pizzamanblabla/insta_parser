<?php

namespace InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

    /**
     * @var Publication[]
     *
     * @Assert\NotBlank()
     * @Assert\Type("array")
     *
     * @Serializer\Type("array<InstaParserBundle\Operation\Statistics\Update\Subscriber\Dto\Response\Publication>")
     * @Serializer\SerializedName("nodes")
     */
    private $publications = [];

    /**
     * @return Publication[]
     */
    public function getPublications()
    {
        return $this->publications;
    }

    /**
     * @param Publication[] $publications
     * @return $this
     */
    public function setPublications(array $publications)
    {
        $this->publications = $publications;
        return $this;
    }
}