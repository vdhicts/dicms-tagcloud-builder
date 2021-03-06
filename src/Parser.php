<?php

namespace Vdhicts\Dicms\Tagcloud;

class Parser
{
    /**
     * Holds the string which contains tags.
     * @var string
     */
    private $tagString;
    /**
     * Holds the tag separator.
     * @var string
     */
    private $separator = ',';

    /**
     * Parser constructor.
     * @param string $tagString
     * @param string $separator
     * @throws Exceptions\InvalidParserSeparatorException
     */
    public function __construct(string $tagString, string $separator = ',')
    {
        $this->setTagString($tagString);
        $this->setSeparator($separator);
    }

    /**
     * Returns the tag string.
     * @return string
     */
    public function getTagString(): string
    {
        return $this->tagString;
    }

    /**
     * Stores the tag string.
     * @param string $tagString
     */
    public function setTagString(string $tagString)
    {
        $this->tagString = $tagString;
    }

    /**
     * Returns the separator.
     * @return string
     */
    public function getSeparator(): string
    {
        return $this->separator;
    }

    /**
     * Stores the separator.
     * @param string $separator
     * @throws Exceptions\InvalidParserSeparatorException
     */
    public function setSeparator(string $separator = ',')
    {
        if ($separator === '') {
            throw new Exceptions\InvalidParserSeparatorException($separator);
        }

        $this->separator = $separator;
    }

    /**
     * Parses the tag string and returns a TagCollection
     * @return TagCollection
     */
    public function parse(): TagCollection
    {
        $tags = array_map(
            function ($tagName) {
                return new Tag($tagName);
            },
            explode($this->getSeparator(), $this->getTagString())
        );

        return new TagCollection($tags);
    }
}
