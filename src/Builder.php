<?php

namespace Vdhicts\TagcloudBuilder;

class Builder
{
    /**
     * Holds the tag collection.
     * @var TagCollection
     */
    private $tagCollection;
    /**
     * Holds the renderer.
     * @var Contracts\Renderer
     */
    private $renderer;

    /**
     * Builder constructor.
     * @param TagCollection $tagCollection
     * @param Contracts\Renderer $renderer
     */
    public function __construct(TagCollection $tagCollection, Contracts\Renderer $renderer)
    {
        $this->setTagCollection($tagCollection);
        $this->setRenderer($renderer);
    }

    /**
     * Returns the tag collection.
     * @return TagCollection
     */
    public function getTagCollection(): TagCollection
    {
        return $this->tagCollection;
    }

    /**
     * Stores the tag collection.
     * @param TagCollection $tagCollection
     */
    public function setTagCollection(TagCollection $tagCollection)
    {
        $this->tagCollection = $tagCollection;
    }

    /**
     * Returns the renderer.
     * @return Contracts\Renderer
     */
    public function getRenderer(): Contracts\Renderer
    {
        return $this->renderer;
    }

    /**
     * Stores the renderer.
     * @param Contracts\Renderer $renderer
     */
    public function setRenderer(Contracts\Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Builds the tagcloud.
     * @return string
     */
    public function generate(): string
    {
        return $this->getRenderer()
            ->generate($this->getTagCollection());
    }
}
