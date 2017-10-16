<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagCloudBuilder;

class ParserTest extends TestCase
{
    public function testParser()
    {
        $separator = ',';
        $tagNames = ['php', 'javascript', 'mysql'];
        $tagString = implode($separator, $tagNames);

        $parser = new TagCloudBuilder\Parser($tagString, $separator);
        $tagCollection = $parser->parse();

        $this->assertInstanceOf(TagCloudBuilder\TagCollection::class, $tagCollection);
        $this->assertSame(3, $tagCollection->count());

        $tags = $tagCollection->getTags();

        $this->assertInstanceOf(TagCloudBuilder\Tag::class, $tags[0]);
        $this->assertInstanceOf(TagCloudBuilder\Tag::class, $tags[1]);
        $this->assertInstanceOf(TagCloudBuilder\Tag::class, $tags[2]);
        $this->assertTrue(in_array($tags[0]->getName(), $tagNames));
        $this->assertTrue(in_array($tags[1]->getName(), $tagNames));
        $this->assertTrue(in_array($tags[2]->getName(), $tagNames));
    }
}
