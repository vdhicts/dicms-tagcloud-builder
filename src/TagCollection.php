<?php

namespace Vdhicts\TagCloudBuilder;

class TagCollection
{
    /**
     * Holds the items indexed by their id.
     * @var array
     */
    private $tags = [];

    /**
     * Adds the tag to the collection.
     * @param Tag $tag
     * @return TagCollection
     */
    public function addTag(Tag $tag): TagCollection
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Returns the amount of tags in the collection.
     * @return int
     */
    public function count()
    {
        return count($this->getTags());
    }

    /**
     * Returns the tags in the collection.
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Determines if the collection has any tags.
     * @return bool
     */
    public function hasTags(): bool
    {
        return $this->count() !== 0;
    }

    /**
     * Stores the collection tags.
     * @param array $tags
     * @return TagCollection
     */
    public function setTags(array $tags): TagCollection
    {
        $this->tags = $tags;

        return $this;
    }
}
