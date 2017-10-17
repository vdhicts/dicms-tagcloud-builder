<?php

namespace Vdhicts\TagcloudBuilder;

class TagCollection
{
    /**
     * Holds the items indexed by their id.
     * @var array
     */
    private $tags = [];
    /**
     * Holds the available sort orders.
     * @var array
     */
    private $availableSortOrders = ['shuffle', 'name', 'occurrence'];

    /**
     * TagCollection constructor.
     * @param array $tags
     */
    public function __construct(array $tags = [])
    {
        $this->setTags($tags);
    }

    /**
     * Returns the tag.
     * @param string $name
     * @return Tag|null
     */
    public function getTag(string $name)
    {
        if (! array_key_exists($name, $this->tags)) {
            return null;
        }

        return $this->tags[$name];
    }

    /**
     * Adds the tag to the collection.
     * @param Tag $tag
     * @return TagCollection
     */
    public function addTag(Tag $tag): TagCollection
    {
        // When the tag is already present in the collection, increase its occurence
        if (array_key_exists($tag->getName(), $this->tags)) {
            $currentTag = $this->tags[$tag->getName()];
            $this->tags[$tag->getName()]->setAmount($currentTag + $tag->getOccurrence());
            return $this;
        }

        $this->tags[$tag->getName()] = $tag;
        return $this;
    }

    /**
     * Removes a tag from the collection.
     * @param string $tagName
     * @return TagCollection
     */
    public function removeTag(string $tagName): TagCollection
    {
        unset($this->tags[$tagName]);

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
        return array_values($this->tags);
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
     * Stores the collection tags. This will overwrite the current tags.
     * @param array $tags
     * @return TagCollection
     */
    public function setTags(array $tags): TagCollection
    {
        // Clear the current tags.
        $this->tags = [];

        // Add per tag to prevent double tags
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }

    /**
     * Removes tags by their names from the collection.
     * @param array $tagNames
     * @return TagCollection
     */
    public function removeTags(array $tagNames = []): TagCollection
    {
        foreach ($tagNames as $tagName) {
            $this->removeTag($tagName);
        }

        return $this;
    }

    /**
     * Sorts the tags collection.
     * @param string $sortOrder
     * @return TagCollection
     * @throws Exceptions\InvalidSortOrderException
     */
    public function sort(string $sortOrder): TagCollection
    {
        if (! in_array($sortOrder, $this->availableSortOrders)) {
            throw new Exceptions\InvalidSortOrderException($sortOrder, $this->availableSortOrders);
        }

        $tags = $this->getTags();

        switch($sortOrder()) {
            case 'name' :
                usort($tags, function (Tag $tag, Tag $otherTag) {
                    return strcmp($tag->getName(), $otherTag->getName());
                });
                break;
            case 'occurrence' :
                usort($tags, function (Tag $tag, Tag $otherTag) {
                    return $tag->getOccurrence() >= $otherTag->getOccurrence();
                });
                break;
            case 'shuffle' :
                shuffle($tags);
                break;
        }

        $this->setTags($tags);

        return $this;
    }

    /**
     * Limits the tag collection.
     * @param int $limit
     * @return TagCollection
     */
    public function limit(int $limit = -1): TagCollection
    {
        if ($limit <= 0) {
            return $this;
        }

        $this->setTags(array_slice($this->getTags(), 0, $limit));

        return $this;
    }
}
