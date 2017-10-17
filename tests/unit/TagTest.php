<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagcloudBuilder;

class TagTest extends TestCase
{
    public function testItemWithAllProperties()
    {
        $name = 'Google';
        $link = 'http://www.google.com';
        $amount = 5;

        $item = new TagcloudBuilder\Tag($name, $link, $amount);

        $this->assertInstanceOf(TagcloudBuilder\Tag::class, $item);
        $this->assertSame($name, $item->getName());
        $this->assertSame($link, $item->getLink());
        $this->assertTrue($item->hasLink());
        $this->assertSame($amount, $item->getOccurrence());
    }

    public function testItemWithDefaults()
    {
        $name = 'Google';

        $item = new TagcloudBuilder\Tag($name);

        $this->assertInstanceOf(TagcloudBuilder\Tag::class, $item);
        $this->assertSame($name, $item->getName());
        $this->assertNull($item->getLink());
        $this->assertFalse($item->hasLink());
        $this->assertSame(1, $item->getOccurrence());
    }

    public function testItemWithInvalidTarget()
    {
        $this->expectException(TagcloudBuilder\Exceptions\InvalidLinkException::class);

        new TagcloudBuilder\Tag('test', 'test');
    }
}
