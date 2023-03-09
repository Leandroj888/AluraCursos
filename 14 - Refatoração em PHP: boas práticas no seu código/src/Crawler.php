<?php
namespace CViniciusSDias\GoogleCrawler;

use CViniciusSDias\GoogleCrawler\Exception\InvalidGoogleHtmlException;
use CViniciusSDias\GoogleCrawler\Exception\InvalidResultException;
use CViniciusSDias\GoogleCrawler\Proxy\{
    GoogleProxyAbstractFactory,
    GoogleProxyInterface, NoProxy,
    NoProxyAbstractFactory
};
use CViniciusSDias\GoogleCrawler\Proxy\HttpClient\GoogleHttpClient;
use CViniciusSDias\GoogleCrawler\Proxy\UrlParse\GoogleUrlParser;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use Symfony\Component\DomCrawler\Link;
use DOMElement;

/**
 * Google Crawler
 *
 * @package CViniciusSDias\GoogleCrawler
 * @author Vinicius Dias
 */
class Crawler
{
    /** @var GoogleProxyInterface $proxy */
    //protected $proxy;
    private GoogleUrlParser $parse;
    private GoogleHttpClient $httpclient;
    

    public function __construct(
        GoogleProxyAbstractFactory $factory = null
        //private GoogleUrlParser $parse,
        //private GoogleHttpClient $httpclient
        //GoogleProxyInterface $proxy = null
    ) {
        // ?? null coalesse - coalecencia nulla (se existir usa ele se não cria)
        //$this->proxy = $proxy ?? new NoProxy();
        
        if($factory === null){
            $factory = new NoProxyAbstractFactory();
        }
        $this->parse = $factory->createGoogleUrlParser();
        $this->httpclient = $factory->createGoogleHttpClient();
    }

    /**
     * Returns the 100 first found results for the specified search term
     *
     * @return ResultList
     * @throws \GuzzleHttp\Exception\ServerException If the proxy was overused
     * @throws \GuzzleHttp\Exception\ConnectException If the proxy is unavailable or $countrySpecificSuffix is invalid
     */
    public function getResults(
        SearchTermInterface $searchTerm,
        string $googleDomain = 'google.com',
        string $countryCode = ''
    ): ResultList
    {

        if (stripos($googleDomain, 'google.') === false || stripos($googleDomain, 'http') === 0) {
            throw new \InvalidArgumentException('Invalid google domain');
        }
        
        
        $googleUrl = "https://$googleDomain/search?q={$searchTerm}&num=100";
        if (!empty($countryCode)) {
            $googleUrl .= "&gl={$countryCode}";
        }
        //$googleUrl = $this->getGoogleUrl($searchTerm, $googleDomain, $countryCode);
        $response = $this->httpclient->getHttpResponse($googleUrl);
        $stringResponse = (string) $response->getBody();
        $domCrawler = new DomCrawler($stringResponse);
        $googleResultList = $this->createGoogleResultList($domCrawler);

        $resultList = new ResultList($googleResultList->count());

        $doomElementParse = new DoomElementParse($this->parse);
        foreach ($googleResultList as $googleResultElement) {
            $parsedResultMaybe = $doomElementParse->parse($googleResultElement);
            $parsedResultMaybe->select(fn(Result $parsedResult) => $resultList->addResult($parsedResult));
            //try {
            //    $parsedResult = $doomElementParse->parse($googleResultElement);
            //    $resultList->addResult($parsedResult);
            //} catch (InvalidResultException $exception) {
            //    error_log(
            //        'Error parsing the following result: ' . print_r($googleResultElement, true),
            //        3,
            //        __DIR__ . '/../var/log/crawler-errors.log'
            //    );
            //}
        }

        return $resultList;
    }
    
    private function createGoogleResultList(DomCrawler $domCrawler): DomCrawler
    {
        //$googleResultList = $domCrawler->filterXPath('//div[@class="ZINbbc xpd O9g5cc uUPGi"]');
        $googleResultList = $domCrawler->filterXPath('//div[@class="Gx5Zad fP1Qef xpd EtOod pkphOe"]');
        if ($googleResultList->count() === 0) {
            throw new InvalidGoogleHtmlException('No parsable element found');
        }
        return $googleResultList;     
    }

    /**
     * If $resultLink is a valid link, this method assembles the Result and adds it to $googleResults
     *
     * @param Link $resultLink
     * @param DOMElement $descriptionElement
     * @return Result
     * @throws InvalidResultException
     */
    /*
    private function createResult(Link $resultLink, DOMElement $descriptionElement): Result
    {
        $description = $descriptionElement->nodeValue
            ?? 'A description for this result isn\'t available due to the robots.txt file.';

        $googleResult = new Result();
        $googleResult
            ->setTitle($resultLink->getNode()->nodeValue)
            ->setUrl($this->parseUrl($resultLink->getUri()))
            ->setDescription($description);

        return $googleResult;
    }*/

    /**
     * Parses the URL using the parser provided by $proxy
     *
     * @param string $url
     * @return string
     * @throws InvalidResultException
     */
    /*
    private function parseUrl(string $url): string
    {
        return $this->proxy->parseUrl($url);
    }*/

    /**
     * Assembles the Google URL using the previously informed data
     */
    /*
    private function getGoogleUrl(SearchTermInterface $searchTerm, string $googleDomain, string $countryCode): string
    {
        //$domain = $googleDomain;
        //$url = "https://$domain/search?q={$searchTerm}&num=100";
        $url = "https://$googleDomain/search?q={$searchTerm}&num=100";
        if (!empty($countryCode)) {
            $url .= "&gl={$countryCode}";
        }

        return $url;
    }
/*
    private function isImageSuggestion(DomCrawler $resultCrawler)
    {
        $resultCount = $resultCrawler
            ->filterXpath('//img')
            ->count();

        return $resultCount > 0;
    }
*/
/*
    private function parseDomElement(DOMElement $result): Result
    {
        $resultCrawler = new DomCrawler($result);
        $linkElement = $resultCrawler->filterXPath('//a')->getNode(0);
        if (is_null($linkElement)) {
            throw new InvalidResultException('Link element not found');
        }

        $resultLink = new Link($linkElement, 'http://google.com/');
        $descriptionElement = $resultCrawler->filterXPath('//div[@class="BNeawe s3v9rd AP7Wnd"]//div[@class="BNeawe s3v9rd AP7Wnd"]')->getNode(0);

        if (is_null($descriptionElement)) {
            throw new InvalidResultException('Description element not found');
        }

        $isImageSuggestion = $resultCrawler->filterXpath('//img')->count() > 0;
        if ($isImageSuggestion) {
        //if ($this->isImageSuggestion($resultCrawler)) {
            throw new InvalidResultException('Result is an image suggestion');
        }

        if (strpos($resultLink->getUri(), 'http://google.com') === false) {
            throw new InvalidResultException('Result is a google suggestion');
        }

        return $this->createResult($resultLink, $descriptionElement);
        //$googleResult = $this->createResult($resultLink, $descriptionElement);
        //return $googleResult;
    }
    */
}
