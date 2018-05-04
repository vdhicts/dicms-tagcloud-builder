<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Tagcloud;

class ParserTest extends TestCase
{
    public function testParser()
    {
        $separator = ',';
        $tagNames = ['php', 'javascript', 'mysql'];
        $tagString = implode($separator, $tagNames);

        $parser = new Tagcloud\Parser($tagString, $separator);
        $tagCollection = $parser->parse();

        $this->assertInstanceOf(Tagcloud\TagCollection::class, $tagCollection);
        $this->assertSame(3, $tagCollection->count());

        $tags = $tagCollection->getTags();

        $this->assertInstanceOf(Tagcloud\Tag::class, $tags[0]);
        $this->assertInstanceOf(Tagcloud\Tag::class, $tags[1]);
        $this->assertInstanceOf(Tagcloud\Tag::class, $tags[2]);
        $this->assertTrue(in_array($tags[0]->getName(), $tagNames));
        $this->assertTrue(in_array($tags[1]->getName(), $tagNames));
        $this->assertTrue(in_array($tags[2]->getName(), $tagNames));
    }

    public function testParserWithInvalidSeparator()
    {
        $this->expectException(Tagcloud\Exceptions\InvalidParserSeparatorException::class);

        $parser = new Tagcloud\Parser('php, javascript, mysql', '');
    }
}
