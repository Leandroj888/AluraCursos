<?php

namespace CViniciusSDias\GoogleCrawler\Proxy\UrlParse;
use CViniciusSDias\GoogleCrawler\Exception\InvalidResultException;

class NoProxyUrlParse implements GoogleUrlParser
{
    /** {@inheritdoc} */
    public function parseUrl(string $googleUrl): string
    {
        // Separates the url parts
        $urlParts = parse_url($googleUrl);
        // Parses the parameters of the url query
        parse_str($urlParts['query'], $queryStringParams);

        $resultUrl = filter_var($queryStringParams['q'], FILTER_VALIDATE_URL);
        // If this is not a valid URL, so the result is (probably) an image, news or video suggestion
        if (!$resultUrl) {
            throw new InvalidResultException();
        }

        return $resultUrl;
    }

}
