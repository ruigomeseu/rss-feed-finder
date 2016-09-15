# RSS Feed Finder

[![Latest Version](https://img.shields.io/github/release/ruigomeseu/rss-feed-finder.svg?style=flat-square)](https://github.com/ruigomeseu/rss-feed-finder/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/ruigomeseu/rss-feed-finder/master.svg?style=flat-square)](https://travis-ci.org/ruigomeseu/rss-feed-finder)
[![StyleCI](https://styleci.io/repos/68291007/shield)](https://styleci.io/repos/68291007)

This package provides an easy way to extract RSS/Atom feeds from any URL.

```php
use RuiGomes\RssFeedFinder\FeedFinder;

$feedFinder = new FeedFinder('https://9to5mac.com');

$feeds = $feedFinder->find();

//$feeds will contain ["https://9to5mac.com/feed/", "https://9to5mac.com/comments/feed/"]
```


## Install

You can pull in the package via composer:
```bash
composer require ruigomeseu/rss-feed-finder "~0.1"
```

## Usage

Create a new FeedFinder instance and pass in the URL you'd like to extract feeds from:

```php
$feedFinder = new FeedFinder('https://9to5mac.com');
```

You can now search that URL for feeds using:

```
$feeds = $feedFinder->find();
```

### Changing the initial URL

You can change the initial URL by using:

```php
$feedFinder->setUrl('http://www.nytimes.com');
```

The ```setUrl()``` function allows for method chaining so you can do something like this:

```php
$feeds = $feedFinder->setUrl('http://www.nytimes.com')->find();
```

## Author

Rui Gomes  
https://ruigomes.me  

## License

The MIT License (MIT). Please see [LICENSE file](https://github.com/ruigomeseu/rss-feed-finder/blob/master/LICENSE.md) for more information.
