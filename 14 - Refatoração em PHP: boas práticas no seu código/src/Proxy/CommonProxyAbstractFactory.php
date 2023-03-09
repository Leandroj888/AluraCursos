<?php

namespace CViniciusSDias\GoogleCrawler\Proxy;

use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\CommonProxyHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\CommonProxyUrlParse;
use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\GoogleHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\GoogleUrlParser;

class CommonProxyAbstractFactory implements GoogleProxyAbstractFactory
{
    public function __construct(
        private string $endpoint
    ) {
    }
    
    public function createGoogleHttpClient(): GoogleHttpClient 
    {
        return new CommonProxyHttpClient($this->endpoint);
    }
    
    public function createGoogleUrlParser(): GoogleUrlParser
    {
        return new CommonProxyUrlParse();
    }
}
