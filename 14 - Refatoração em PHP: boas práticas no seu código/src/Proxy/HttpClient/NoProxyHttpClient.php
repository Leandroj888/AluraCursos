<?php

namespace CViniciusSDias\GoogleCrawler\Proxy\HttpClient;

use Psr\Http\Message\ResponseInterface;
use CViniciusSDias\GoogleCrawler\Exception\InvalidUrlException;
use GuzzleHttp\Client;

class NoProxyHttpClient implements GoogleHttpClient
{
    /** {@inheritdoc} */
    public function getHttpResponse(string $url): ResponseInterface
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException("Invalid Google URL: $url");
        }

        return (new Client())->request('GET', $url);
    }

}
