<?php

namespace Owlnext\NotificationAPI\client;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Client
{
    private string $baseURL;
    private HttpClientInterface $httpClient;

    public function __construct(string $baseURL)
    {
        $this->baseURL = $baseURL;
        $this->httpClient = HttpClient::create();
    }

    public function executeRequest(
        string $method,
        string $path,
        array $queryParams = [],
        array $body = [],
        array $headers = [],
        bool $isJson = true
    ): ResponseInterface {
        $finalURL = sprintf("%s%s", $this->baseURL, $path);

        $options = [];

        if (0 !== sizeof($queryParams)) {
            $options['query'] = $queryParams;
        }

        if (0 !== sizeof($body)) {
            $options[($isJson ? 'json' : 'body')] = $body;
        }

        if (0 !== sizeof($headers)) {
            $options['headers'] = $headers;
        }

        return $this->httpClient->request($method, $finalURL, $options);
    }

}