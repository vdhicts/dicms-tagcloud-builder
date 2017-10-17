<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagcloudBuilder;

class BuilderTest extends TestCase
{
    private function getBaseTagCollection()
    {
        $phpTag = new TagcloudBuilder\Tag('PHP');
        $javascriptTag = new TagcloudBuilder\Tag('JavaScript', 'http://www.example.com/javascript', 2);
        $mysqlTag = new TagcloudBuilder\Tag('MySQL', 'http://www.example.com/mysql', 5);

        $itemCollection = new TagcloudBuilder\TagCollection();
        $itemCollection->addTag($phpTag)
            ->addTag($javascriptTag)
            ->addTag($mysqlTag);

        return $itemCollection;
    }

    public function testDefaultRenderWithEmptyCollection()
    {
        $emptyBuilder = new TagcloudBuilder\Builder(new TagcloudBuilder\TagCollection(), new TagcloudBuilder\Renderers\DefaultRenderer());
        $this->assertSame('', $emptyBuilder->generate());
    }

    public function testDefaultRenderer()
    {
        $builder = new TagcloudBuilder\Builder($this->getBaseTagCollection(), new TagcloudBuilder\Renderers\DefaultRenderer());

        $this->assertInstanceOf(TagcloudBuilder\Builder::class, $builder);
        $this->assertInstanceOf(TagcloudBuilder\TagCollection::class, $builder->getTagCollection());
        $this->assertInstanceOf(TagcloudBuilder\Renderers\DefaultRenderer::class, $builder->getRenderer());

        $expectedHtml = '<ul class="tagcloud"><li class="tag tag-size-1">PHP</li><li class="tag tag-size-2"><a href="http://www.example.com/javascript">JavaScript</a></li><li class="tag tag-size-6"><a href="http://www.example.com/mysql">MySQL</a></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }
}
