<?php

namespace Vdhicts\TagcloudBuilder\Renderers;

use Vdhicts\TagcloudBuilder\Contracts\Renderer;
use Vdhicts\TagcloudBuilder\Tag;
use Vdhicts\TagcloudBuilder\TagCollection;

class DefaultRenderer implements Renderer
{
    /**
     * Holds the total occurrence of all tags together.
     * @var int
     */
    private $totalTagOccurrence = 0;

    /**
     * Calculates the total occurrence of all tags together.
     * @param TagCollection $tagCollection
     * @return int
     */
    private function calculateTotalTagOccurrence(TagCollection $tagCollection): int
    {
        $totalTagOccurrence = 0;
        foreach ($tagCollection->getTags() as $tag) {
            /** @var Tag $tag */
            $totalTagOccurrence += $tag->getOccurrence();
        }
        return $totalTagOccurrence;
    }

    /**
     * Returns the css class for the tag which determines the size.
     * @param Tag $tag
     * @return string
     */
    private function getTagcloudItemClass(Tag $tag)
    {
        $percentage = ($tag->getOccurrence() / $this->totalTagOccurrence) * 100;

        return sprintf('tag-size-%d', floor($percentage) / 100);
    }

    /**
     * Generates the tag cloud item.
     * @param Tag $tag
     * @return HtmlElement
     */
    private function generateTagcloudItem(Tag $tag): HtmlElement
    {
        $tagcloudItemHtml = new HtmlElement('li');
        $tagcloudItemHtml->setAttribute('class', 'tag');
        $tagcloudItemHtml->addAttributeValue('class', $this->getTagcloudItemClass($tag));
        if (! $tag->hasLink()) {
            $tagcloudItemHtml->setText($tag->getName());
            return $tagcloudItemHtml;
        }

        $linkHtml = new HtmlElement('a', $tag->getName(), ['href' => $tag->getLink()]);
        $tagcloudItemHtml->inject($linkHtml);

        return $tagcloudItemHtml;
    }

    /**
     * Generates the tag cloud.
     * @param TagCollection $tagCollection
     * @return string
     */
    public function generate(TagCollection $tagCollection): string
    {
        if (! $tagCollection->hasTags()) {
            return '';
        }

        $this->totalTagOccurrence = $this->calculateTotalTagOccurrence($tagCollection);

        $tagcloudHtml = new HtmlElement('ul');
        $tagcloudHtml->setAttribute('class', 'tagcloud');
        foreach ($tagCollection->getTags() as $tag) {
            $tagcloudHtml->inject($this->generateTagcloudItem($tag));
        }
        return $tagcloudHtml->generate();
    }
}
