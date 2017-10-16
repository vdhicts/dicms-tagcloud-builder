<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagCloudBuilder;

class ItemCollectionTest extends TestCase
{
    private function getBaseTagCollection()
    {
        $phpTag = new TagCloudBuilder\Tag('PHP');
        $javascriptTag = new TagCloudBuilder\Tag('JavaScript', 'http://www.example.com/javascript', 2);
        $mysqlTag = new TagCloudBuilder\Tag('MySQL', 'http://www.example.com/mysql', 5);

        $itemCollection = new TagCloudBuilder\TagCollection();
        $itemCollection->addTag($phpTag)
            ->addTag($javascriptTag)
            ->addTag($mysqlTag);

        return $itemCollection;
    }

    public function testTagCollectionBuild()
    {
        $tagCollection = $this->getBaseTagCollection();

        $this->assertInstanceOf(TagCloudBuilder\TagCollection::class, $tagCollection);
    }

    public function testTagCollectionCheck()
    {
        $tagCollection = $this->getBaseTagCollection();
        $this->assertTrue($tagCollection->hasTags());

        $emptyTagCollection = new TagCloudBuilder\TagCollection();
        $this->assertFalse($emptyTagCollection->hasTags());
    }

    public function testTagCollectionRetrieval()
    {
        $tagCollection = $this->getBaseTagCollection();

        $this->assertSame(3, $tagCollection->count());
        $this->assertSame(3, count($tagCollection->getTags()));
    }

    public function testTagCollectionStoring()
    {
        $phpTag = new TagCloudBuilder\Tag('PHP');
        $javascriptTag = new TagCloudBuilder\Tag('JavaScript', 'http://www.example.com/javascript', 2);
        $mysqlTag = new TagCloudBuilder\Tag('MySQL', 'http://www.example.com/mysql', 5);

        $tagCollection = new TagCloudBuilder\TagCollection();
        $tagCollection->setTags([$phpTag, $javascriptTag, $mysqlTag]);

        $this->assertSame(3, $tagCollection->count());
    }
}
