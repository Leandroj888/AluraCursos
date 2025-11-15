<?php

namespace CViniciusSDias\GoogleCrawler\Proxy\UrlParse;

use CViniciusSDias\GoogleCrawler\Exception\InvalidResultException;

class KProxyUrlParse implements GoogleUrlParser
{

    /** {@inheritdoc} */
    public function parseUrl(string $url): string
    {
        $parsedUrl = parse_url($url);
        parse_str($parsedUrl['query'], $link);

        if (!array_key_exists('q', $link)) {
            // Generally a book suggestion
            throw new InvalidResultException();
        }

        $url = filter_var($link['q'], FILTER_VALIDATE_URL);
        // If this is not a valid URL, so the result is (probably) an image, news or video suggestion
        if (!$url) {
            throw new InvalidResultException();
        }

        return $url;
    }

}
