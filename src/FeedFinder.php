<?php

namespace RuiGomes\RssFeedFinder;

use Illuminate\Support\Collection;
use PHPHtmlParser\Dom;

class FeedFinder
{
    /**
     * @var \PHPHtmlParser\Dom
     */
    protected $dom;

    /**
     * @var string
     */
    protected $url;

    protected $feedTypes = [
        'application/rss+xml',
        'application/atom+xml',
    ];

    public function __construct($url)
    {
        $this->dom = new Dom();
        $this->url = $url;
    }

    public function find()
    {
        $this->dom->loadFromUrl($this->url);

        $feeds = new Collection($this->dom->find('link[rel=alternate]'));

        $feedUrls = $feeds->filter(function ($feed) {
            return in_array($feed->getAttribute('type'), $this->feedTypes);
        })->map(function ($feed) {
            return $feed->getAttribute('href');
        })->toArray();

        return $feedUrls;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setDom($dom)
    {
        $this->dom = $dom;
    }

    public function getDom()
    {
        return $this->dom;
    }
}
