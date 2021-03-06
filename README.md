# Tagcloud

This package allows you to easily build a tagcloud from PHP.

## Requirements

This package requires PHP 7 and the renderers make use of [vdhicts/dicms-html-element](https://github.com/vdhicts/dicms-html-element).

## Installation

This package can be used in any PHP project or with any framework.

You can install the package via composer:

``` bash
composer require vdhicts/tagcloud-builder
```

## Usage

```php
use Vdhicts\Dicms\Tagcloud;
    
$phpTag = new Tagcloud\Tag('PHP');
$javascriptTag = new Tagcloud\Tag('JavaScript', 'http://www.example.com/javascript', 2);
$mysqlTag = new Tagcloud\Tag('MySQL', 'http://www.example.com/mysql', 5);

$tagCollection = new Tagcloud\TagCollection();
$tagCollection->addTag($phpTag)
    ->addTag($javascriptTag)
    ->addTag($mysqlTag);
    
$renderer = new Tagcloud\Renderers\DefaultRenderer();
$tagcloudBuilder = new Tagcloud\Builder($tagCollection, $renderer);
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

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email info@vdhicts.nl instead 
of using the issue tracker.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## About vdhicts

[Van der Heiden ICT services](https://www.vdhicts.nl) is the name of my personal company for which I work as 
freelancer. Van der Heiden ICT services develops and implements IT solutions for businesses and educational 
institutions.
