<?php

namespace CViniciusSDias\GoogleCrawler\Proxy\UrlParse;

interface GoogleUrlParser
{

    /**
     * Parses an URL based on how they are encoded in the proxy service
     *
     * @param string $googleUrl
     * @return string
     * @throws InvalidResultException
     */
    public function parseUrl(string $googleUrl): string;

}
