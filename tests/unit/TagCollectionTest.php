<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagcloudBuilder;
use Vdhicts\TagcloudBuilder\Tag;

class ItemCollectionTest extends TestCase
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

    public function testTagCollectionBuild()
    {
        $tagCollection = $this->getBaseTagCollection();

        $this->assertInstanceOf(TagcloudBuilder\TagCollection::class, $tagCollection);
    }

    public function testTagCollectionCheck()
    {
        $tagCollection = $this->getBaseTagCollection();
        $this->assertTrue($tagCollection->hasTags());

        $emptyTagCollection = new TagcloudBuilder\TagCollection();
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
        $phpTag = new TagcloudBuilder\Tag('PHP');
        $javascriptTag = new TagcloudBuilder\Tag('JavaScript', 'http://www.example.com/javascript', 2);
        $mysqlTag = new TagcloudBuilder\Tag('MySQL', 'http://www.example.com/mysql', 5);

        $tagCollection = new TagcloudBuilder\TagCollection();
        $tagCollection->setTags([$phpTag, $javascriptTag, $mysqlTag]);

        $this->assertSame(3, $tagCollection->count());
    }

    public function testTagCollectionSortingOnOccurrence()
    {
        $tagCollection = $this->getBaseTagCollection();
        $tagCollection->sort('occurrence');

        $tagNames = array_map(
            function (Tag $tag) {
                return $tag->getName();
            },
            $tagCollection->getTags()
        );

        $this->assertSame(['MySQL', 'JavaScript', 'PHP'], $tagNames);
    }

    public function testTagCollectionSortingOnName()
    {
        $tagCollection = $this->getBaseTagCollection();
        $tagCollection->sort('name');

        $tagNames = array_map(
            function (Tag $tag) {
                return $tag->getName();
            },
            $tagCollection->getTags()
        );

        $this->assertSame(['JavaScript', 'MySQL', 'PHP'], $tagNames);
    }

    public function testTagCollectionSortingShuffle()
    {
        $tagCollection = $this->getBaseTagCollection();
        $tagCollection->sort('shuffle');

        $tagNames = array_map(
            function (Tag $tag) {
                return $tag->getName();
            },
            $tagCollection->getTags()
        );

        $this->assertNotSame(['PHP', 'JavaScript', 'MySQL'], $tagNames);
    }

    public function testTagCollectionInvalidSortOrder()
    {
        $this->expectException(TagcloudBuilder\Exceptions\InvalidSortOrderException::class);

        $tagCollection = $this->getBaseTagCollection();
        $tagCollection->sort('something');
    }

    public function testTagCollectionFilter()
    {
        $tagCollection = $this->getBaseTagCollection();
        $tagCollection->removeTags(['PHP']);

        $tagNames = array_map(
            function (Tag $tag) {
                return $tag->getName();
            },
            $tagCollection->getTags()
        );

        $this->assertSame(2, count($tagNames));
        $this->assertNotSame(['JavaScript', 'MySQL'], $tagNames);
    }

    public function testTagCollectionLimit()
    {
        $tagCollection = $this->getBaseTagCollection();
        $tagCollection->sort('name');
        $tagCollection->limit(2);

        $tagNames = array_map(
            function (Tag $tag) {
                return $tag->getName();
            },
            $tagCollection->getTags()
        );

        $this->assertSame(2, count($tagNames));
        $this->assertNotSame(['JavaScript', 'MySQL'], $tagNames);
    }
}
