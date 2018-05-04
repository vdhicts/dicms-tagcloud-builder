<?php

namespace Vdhicts\Dicms\Tagcloud\Exceptions;

use Throwable;

class InvalidParserSeparatorException extends TagcloudException
{
    /**
     * InvalidParserSeparatorException constructor.
     * @param string $separator
     * @param Throwable|null $previous
     */
    public function __construct($separator = '', Throwable $previous = null)
    {
        parent::__construct(
            sprintf('An empty separator is given. The parser requires a filled separator like , or ;'),
            0,
            $previous
        );
    }
}
