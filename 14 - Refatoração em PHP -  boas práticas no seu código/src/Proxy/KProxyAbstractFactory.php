<?php

namespace CViniciusSDias\GoogleCrawler\Proxy;

use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\KProxyHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\KProxyUrlParse;
use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\GoogleHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\GoogleUrlParser;

class KProxyAbstractFactory implements GoogleProxyAbstractFactory
{
    public function __construct(
        private int $serverNumber
    ) {
    }
    public function createGoogleHttpClient(): GoogleHttpClient 
    {
        return new KProxyHttpClient($this->serverNumber);
    }
    
    public function createGoogleUrlParser(): GoogleUrlParser
    {
        return new KProxyUrlParse();
    }
}
