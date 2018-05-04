<?php

namespace Vdhicts\Dicms\Tagcloud\Exceptions;

use Throwable;

class InvalidSortOrderException extends TagcloudException
{
    /**
     * InvalidSortOrderException constructor.
     * @param string $providedSortOrder
     * @param array $availableSortOrders
     * @param Throwable|null $previous
     */
    public function __construct($providedSortOrder, array $availableSortOrders, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('The provided sort order "%s" is not available, available are %s', $providedSortOrder, implode(', ', $availableSortOrders)),
            0,
            $previous
        );
    }
}
