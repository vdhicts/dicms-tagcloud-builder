<?php

namespace Vdhicts\TagcloudBuilder\Contracts;

use Vdhicts\TagcloudBuilder\TagCollection;

interface Renderer
{
    /**
     * Renders the menu.
     * @param TagCollection $tagCollection
     * @return string
     */
    public function generate(TagCollection $tagCollection): string;
}
