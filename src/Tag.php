<?php

namespace Vdhicts\TagcloudBuilder;

use Vdhicts\TagcloudBuilder\Exceptions;

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
    private $occurrence = 1;

    /**
     * Tag constructor.
     * @param string $name
     * @param string|null $target
     * @param int $occurrence
     */
    public function __construct(string $name, string $target = null, int $occurrence = 1)
    {
        $this->setName($name);
        $this->setLink($target);
        $this->setOccurrence($occurrence);
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
        $this->name = trim($name);
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
            throw new Exceptions\InvalidLinkException($link);
        }

        $this->link = $link;
    }

    /**
     * Returns the amount the tag occurred.
     * @return int
     */
    public function getOccurrence(): int
    {
        return $this->occurrence;
    }

    /**
     * Stores the amount the tag occurred.
     * @param int $occurrence
     */
    public function setOccurrence(int $occurrence = 1)
    {
        $this->occurrence = $occurrence;
    }
}
