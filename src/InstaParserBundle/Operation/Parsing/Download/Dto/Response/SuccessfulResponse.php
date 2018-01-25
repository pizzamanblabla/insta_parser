<?php

namespace InstaParserBundle\Operation\Parsing\Download\Dto\Response;

use InstaParserBundle\Interaction\Dto\Response\InternalResponseInterface;
use InstaParserBundle\Interaction\Dto\Response\Successful;

class SuccessfulResponse implements InternalResponseInterface
{
    use Successful;

    /**
     * @var string[]
     */
    private $emails;

    /**
     * @return string[]
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param string[] $emails
     * @return SuccessfulResponse
     */
    public function setEmails(array $emails)
    {
        $this->emails = $emails;
        return $this;
    }
}