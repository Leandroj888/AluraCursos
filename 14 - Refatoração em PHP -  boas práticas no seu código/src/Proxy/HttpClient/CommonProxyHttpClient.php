<?php

namespace CViniciusSDias\GoogleCrawler\Proxy\HttpClient;

use CViniciusSDias\GoogleCrawler\Exception\InvalidUrlException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class CommonProxyHttpClient implements GoogleHttpClient
{
    /** @var string $endpoint */
    protected $endpoint;

    /**
     * Constructor that initializes the specific proxy service
     *
     * @param string $endpoint Specific service URL
     * @throws InvalidUrlException
     */
    public function __construct(string $endpoint)
    {
        if (!filter_var($endpoint, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException("Invalid CommonProxy endpoint: $endpoint");
        }

        $this->endpoint = $endpoint;
    }

    /** {@inheritdoc} */
    public function getHttpResponse(string $url): ResponseInterface
    {
        $data = ['u' => $url, 'allowCookies' => 'on'];
        $httpClient = new Client(['cookies' => true, 'verify' => false]);
        $response = $httpClient->request('POST', $this->endpoint, ['form_params' => $data]);

        return $response;
    }

}
