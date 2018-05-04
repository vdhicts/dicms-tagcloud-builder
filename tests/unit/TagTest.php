<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\Dicms\Tagcloud;

class TagTest extends TestCase
{
    public function testItemWithAllProperties()
    {
        $name = 'Google';
        $link = 'http://www.google.com';
        $amount = 5;

        $item = new Tagcloud\Tag($name, $link, $amount);

        $this->assertInstanceOf(Tagcloud\Tag::class, $item);
        $this->assertSame($name, $item->getName());
        $this->assertSame($link, $item->getLink());
        $this->assertTrue($item->hasLink());
        $this->assertSame($amount, $item->getOccurrence());
    }

    public function testItemWithDefaults()
    {
        $name = 'Google';

        $item = new Tagcloud\Tag($name);

        $this->assertInstanceOf(Tagcloud\Tag::class, $item);
        $this->assertSame($name, $item->getName());
        $this->assertNull($item->getLink());
        $this->assertFalse($item->hasLink());
        $this->assertSame(1, $item->getOccurrence());
    }

    public function testItemWithInvalidTarget()
    {
        $this->expectException(Tagcloud\Exceptions\InvalidLinkException::class);

        new Tagcloud\Tag('test', 'test');
    }
}
