<?php

namespace CViniciusSDias\GoogleCrawler;

use Symfony\Component\DomCrawler\Crawler;
use CViniciusSDias\GoogleCrawler\Exception\InvalidResultException;
use Symfony\Component\DomCrawler\Link;
use CViniciusSDias\GoogleCrawler\Proxy\{
    GoogleProxyInterface, NoProxy
};
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\GoogleUrlParser;
use CViniciusSDias\GoogleCrawler\Result;
use DOMElement;
use Yitznewton\Maybe\Maybe;

class DoomElementParse
{
    public function __construct(
        private GoogleUrlParser $proxy
    ) {
    }

    /**
     * If $resultLink is a valid link, this method assembles the Result and adds it to $googleResults
     *
     * @param Link $resultLink
     * @param DOMElement $descriptionElement
     * @return Result
     * @throws InvalidResultException
     */
    private function createResult(Link $resultLink, DOMElement $descriptionElement): Result
    {
        $description = $descriptionElement->nodeValue
            ?? 'A description for this result isn\'t available due to the robots.txt file.';

        $googleResult = new Result();
        $googleResult
            ->setTitle($resultLink->getNode()->nodeValue)
            ->setUrl($this->proxy->parseUrl($resultLink->getUri()))
            ->setDescription($description);

        return $googleResult;
    }

    
    public function parse(\DOMElement $result): Maybe //?Result
    {
        $resultCrawler = new Crawler($result);
        $linkElement = $resultCrawler->filterXPath('//a')->getNode(0);
        if (is_null($linkElement)) {
            return new Maybe(null);
        }

        $resultLink = new Link($linkElement, 'http://google.com/');
        $descriptionElement = $resultCrawler->filterXPath('//div[@class="BNeawe s3v9rd AP7Wnd"]//div[@class="BNeawe s3v9rd AP7Wnd"]')->getNode(0);

        if (is_null($descriptionElement)) {
            return new Maybe(null);
        }

        $isImageSuggestion = $resultCrawler->filterXpath('//img')->count() > 0;
        if ($isImageSuggestion) {
        //if ($this->isImageSuggestion($resultCrawler)) {
            return new Maybe(null);
        }

        if (strpos($resultLink->getUri(), 'http://google.com') === false) {
            return new Maybe(null);
        }

        return new Maybe($this->createResult($resultLink, $descriptionElement));
        //$googleResult = $this->createResult($resultLink, $descriptionElement);
        //return $googleResult;
        
    }

}
