<?php

namespace InstaParserBundle\Interaction\Dto\Response;

class EmptyInnerErroneousResponse implements InternalResponseInterface
{
    use Erroneous;
}