<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Tagcloud;

class BuilderTest extends TestCase
{
    private function getBaseTagCollection()
    {
        $phpTag = new Tagcloud\Tag('PHP');
        $javascriptTag = new Tagcloud\Tag('JavaScript', 'http://www.example.com/javascript', 2);
        $mysqlTag = new Tagcloud\Tag('MySQL', 'http://www.example.com/mysql', 5);

        $itemCollection = new Tagcloud\TagCollection();
        $itemCollection->addTag($phpTag)
            ->addTag($javascriptTag)
            ->addTag($mysqlTag);

        return $itemCollection;
    }

    public function testDefaultRenderWithEmptyCollection()
    {
        $emptyBuilder = new Tagcloud\Builder(new Tagcloud\TagCollection(), new Tagcloud\Renderers\DefaultRenderer());
        $this->assertSame('', $emptyBuilder->generate());
    }

    public function testDefaultRenderer()
    {
        $builder = new Tagcloud\Builder($this->getBaseTagCollection(), new Tagcloud\Renderers\DefaultRenderer());

        $this->assertInstanceOf(Tagcloud\Builder::class, $builder);
        $this->assertInstanceOf(Tagcloud\TagCollection::class, $builder->getTagCollection());
        $this->assertInstanceOf(Tagcloud\Renderers\DefaultRenderer::class, $builder->getRenderer());

        $expectedHtml = '<ul class="tagcloud"><li class="tag tag-size-1">PHP</li><li class="tag tag-size-2"><a href="http://www.example.com/javascript">JavaScript</a></li><li class="tag tag-size-6"><a href="http://www.example.com/mysql">MySQL</a></li></ul>';
        $generatedHtml = $builder->generate();

        $this->assertSame($expectedHtml, $generatedHtml);
    }
}
