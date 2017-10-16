<?php

namespace Vdhicts\TagCloudBuilder;

use Vdhicts\TagCloudBuilder\Exceptions;

class Tag
{
    /**
     * Holds the name of the tag.
     * @var string
     */
    private $name;
    /**
     * Holds the link.
     * @var string|null
     */
    private $link = null;
    /**
     * Holds the amount the tag occurred.
     * @var int
     */
    private $amount = 1;

    /**
     * Tag constructor.
     * @param string $name
     * @param string|null $target
     * @param int $amount
     */
    public function __construct(string $name, string $target = null, int $amount = 1)
    {
        $this->setName($name);
        $this->setLink($target);
        $this->setAmount($amount);
    }

    /**
     * Returns the name of the tag.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Stores the name of the tag.
     * @param string $name
     */
    private function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the link.
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Determines if the tag has a link.
     * @return bool
     */
    public function hasLink(): bool
    {
        return ! is_null($this->link);
    }

    /**
     * Stores the link.
     * @param string|null $link
     * @throws Exceptions\InvalidLinkException
     */
    public function setLink(string $link = null)
    {
        if (! is_null($link) && ! filter_var($link, FILTER_VALIDATE_URL)) {
            throw new Exceptions\InvalidLinkException(sprintf(
                'Provided link "%s" should be a valid URL or null',
                $link
            ));
        }

        $this->link = $link;
    }

    /**
     * Returns the amount the tag occurred.
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Stores the amount the tag occurred.
     * @param int $amount
     */
    public function setAmount(int $amount = 1)
    {
        $this->amount = $amount;
    }
}
