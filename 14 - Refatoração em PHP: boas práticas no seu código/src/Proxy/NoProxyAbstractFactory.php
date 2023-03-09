<?php

namespace CViniciusSDias\GoogleCrawler\Proxy;

use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\NoProxyHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\NoProxyUrlParse;
use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\GoogleHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\GoogleUrlParser;

class NoProxyAbstractFactory implements GoogleProxyAbstractFactory
{
    public function createGoogleHttpClient(): GoogleHttpClient 
    {
        return new NoProxyHttpClient();
    }
    
    public function createGoogleUrlParser(): GoogleUrlParser
    {
        return new NoProxyUrlParse();
    }
}
