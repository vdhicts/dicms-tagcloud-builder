<?php

use PHPUnit\Framework\TestCase;
use Vdhicts\TagCloudBuilder;

class TagTest extends TestCase
{
    public function testItemWithAllProperties()
    {
        $name = 'Google';
        $link = 'http://www.google.com';
        $amount = 5;

        $item = new TagCloudBuilder\Tag($name, $link, $amount);

        $this->assertInstanceOf(TagCloudBuilder\Tag::class, $item);
        $this->assertSame($name, $item->getName());
        $this->assertSame($link, $item->getLink());
        $this->assertTrue($item->hasLink());
        $this->assertSame($amount, $item->getAmount());
    }

    public function testItemWithDefaults()
    {
        $name = 'Google';

        $item = new TagCloudBuilder\Tag($name);

        $this->assertInstanceOf(TagCloudBuilder\Tag::class, $item);
        $this->assertSame($name, $item->getName());
        $this->assertNull($item->getLink());
        $this->assertFalse($item->hasLink());
        $this->assertSame(1, $item->getAmount());
    }

    public function testItemWithInvalidTarget()
    {
        $this->expectException(TagCloudBuilder\Exceptions\InvalidLinkException::class);

        new TagCloudBuilder\Tag('test', 'test');
    }
}
