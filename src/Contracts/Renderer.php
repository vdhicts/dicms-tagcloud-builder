<?php

namespace Vdhicts\TagCloudBuilder\Contracts;

use Vdhicts\TagCloudBuilder\TagCollection;

interface Renderer
{
    /**
     * Renders the menu.
     * @param TagCollection $tagCollection
     * @return string
     */
    public function generate(TagCollection $tagCollection): string;
}
