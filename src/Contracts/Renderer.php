<?php

namespace Vdhicts\Dicms\Tagcloud\Contracts;

use Vdhicts\Dicms\Tagcloud\TagCollection;

interface Renderer
{
    /**
     * Renders the menu.
     * @param TagCollection $tagCollection
     * @return string
     */
    public function generate(TagCollection $tagCollection): string;
}
