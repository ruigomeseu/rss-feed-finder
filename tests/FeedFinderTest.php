<?php

namespace RuiGomes\RssFeedFinder\Tests;

use Mockery;
use PHPHtmlParser\Dom;
use RuiGomes\RssFeedFinder\FeedFinder;

class FeedFinderTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorDom()
    {
        $feedFinder = new FeedFinder(null);

        $this->assertInstanceOf(Dom::class, $feedFinder->getDom());
    }

    public function testSetUrl()
    {
        $feedFinder = new FeedFinder(null);

        $url = 'http://www.nytimes.com';

        $feedFinder->setUrl($url);

        $this->assertEquals($url, $feedFinder->getUrl());
    }

    public function testFetchesRssFeeds()
    {
        $feedFinder = new FeedFinder('https://9to5mac.com');

        $domMock = Mockery::mock('PHPHtmlParser\Dom[loadFromUrl]');

        $domMock->shouldReceive('loadFromUrl')
            ->once()
            ->with($feedFinder->getUrl());

        $domMock->loadStr($this->loadHtmlFixture('valid'), []);

        $feedFinder->setDom($domMock);

        $feeds = $feedFinder->find();

        $this->assertCount(2, $feeds);
    }

    public function testFetchNoRssFeed()
    {
        $feedFinder = new FeedFinder('https://ruigomes.me');

        $domMock = Mockery::mock('PHPHtmlParser\Dom[loadFromUrl]');

        $domMock->shouldReceive('loadFromUrl')
            ->once()
            ->with($feedFinder->getUrl());

        $domMock->loadStr($this->loadHtmlFixture('empty'), []);

        $feedFinder->setDom($domMock);

        $feeds = $feedFinder->find();

        $this->assertCount(0, $feeds);
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    protected function loadHtmlFixture($name)
    {
        return file_get_contents(__DIR__."/_fixtures/{$name}.html");
    }
}
