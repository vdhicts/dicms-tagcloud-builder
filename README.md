# Tagcloud

This package allows you to easily build a tagcloud from PHP.

## Requirements

This package requires PHP 7 and the renderers make use of [vdhicts/htmlelement](https://github.com/vdhicts/html-element).

## Installation

This package can be used in any PHP project or with any framework.

You can install the package via composer:

``` bash
composer require vdhicts/tagcloud-builder
```

## Usage

```php
use Vdhicts\TagcloudBuilder;
    
$phpTag = new TagcloudBuilder\Tag('PHP');
$javascriptTag = new TagcloudBuilder\Tag('JavaScript', 'http://www.example.com/javascript', 2);
$mysqlTag = new TagcloudBuilder\Tag('MySQL', 'http://www.example.com/mysql', 5);

$tagCollection = new TagcloudBuilder\TagCollection();
$tagCollection->addTag($phpTag)
    ->addTag($javascriptTag)
    ->addTag($mysqlTag);
    
$renderer = new TagcloudBuilder\Renderers\DefaultRenderer();
$tagcloudBuilder = new TagcloudBuilder\Builder($tagCollection, $renderer);
$tagcloudBuilder->generate();
```

### Renderers

There is 1 renderer available by default:

#### DefaultRenderer

Useful for a regular tagcloud. Your custom css is required though.

```html
<ul class="tagcloud">
    <li class="tag tag-size-1">PHP</li>
    <li class="tag tag-size-2">
        <a href="http://www.example.com/javascript">JavaScript</a>
    </li>
    <li class="tag tag-size-6">
        <a href="http://www.example.com/mysql">MySQL</a>
    </li>
</ul>
```

#### Custom renderer

You can use your own renderer as long as it implements the `Renderer` interface.

## Tests

Full code coverage unit tests are available in the `tests` folder. Run via phpunit:

`vendor\bin\phpunit`

By default a coverage report will be generated in the `build/coverage` folder.

## Contribution

Any contribution is welcome, but it should be fully tested, meet the PSR-2 standard and please create one pull request 
per feature. In exchange you will be credited as contributor on this page.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
