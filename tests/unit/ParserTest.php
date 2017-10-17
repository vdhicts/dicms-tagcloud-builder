<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagcloudBuilder;

class ParserTest extends TestCase
{
    public function testParser()
    {
        $separator = ',';
        $tagNames = ['php', 'javascript', 'mysql'];
        $tagString = implode($separator, $tagNames);

        $parser = new TagcloudBuilder\Parser($tagString, $separator);
        $tagCollection = $parser->parse();

        $this->assertInstanceOf(TagcloudBuilder\TagCollection::class, $tagCollection);
        $this->assertSame(3, $tagCollection->count());

        $tags = $tagCollection->getTags();

        $this->assertInstanceOf(TagcloudBuilder\Tag::class, $tags[0]);
        $this->assertInstanceOf(TagcloudBuilder\Tag::class, $tags[1]);
        $this->assertInstanceOf(TagcloudBuilder\Tag::class, $tags[2]);
        $this->assertTrue(in_array($tags[0]->getName(), $tagNames));
        $this->assertTrue(in_array($tags[1]->getName(), $tagNames));
        $this->assertTrue(in_array($tags[2]->getName(), $tagNames));
    }
}
