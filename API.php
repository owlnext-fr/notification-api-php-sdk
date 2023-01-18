<?php

namespace Owlnext\NotificationAPI;

use Owlnext\NotificationAPI\api\AuthenticationEndpoint;
use Owlnext\NotificationAPI\api\ContactEndpoint;
use Owlnext\NotificationAPI\api\TestEndpoint;
use Owlnext\NotificationAPI\client\Client;
use Owlnext\NotificationAPI\Exception\ConfigurationException;
use Owlnext\NotificationAPI\Router\Router;
use Owlnext\NotificationAPI\utils\JWTToken;
use Owlnext\NotificationAPI\utils\Environment;
use Owlnext\NotificationAPI\utils\Serializer;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class API
{
    private string $baseURL;
    private string $login;
    private string $password;

    private JWTToken $jwt;
    private Client $client;

    private AuthenticationEndpoint $auth;

    public TestEndpoint $test;
    public ContactEndpoint $contacts;

    public function __construct(
        string|null $login = null,
        string|null $password = null,
        string $environment = Environment::PRODUCTION
    )
    {
        $this->baseURL = $environment;

        $login = $login ?? $_ENV['OWLNEXT_NOTIFICATION_API_LOGIN'];

        if(true === is_null($login)) {
            throw new ConfigurationException("You must either provide a login in the constructor or with environment variable.");
        }

        $password = $password ?? $_ENV['OWLNEXT_NOTIFICATION_API_PASSWORD'];

        if(true === is_null($password)) {
            throw new ConfigurationException("You must either provide a login in the constructor or with environment variable.");
        }

        $this->login = $login;
        $this->password = $password;

        $this->jwt = JWTToken::default();

        $this->client = new Client($this->baseURL);

        $serializer = new Serializer();

        $this->auth = new AuthenticationEndpoint($this, $serializer);
        $this->test = new TestEndpoint($this, $serializer);
        $this->contacts = new ContactEndpoint($this, $serializer);
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getPassword(): string {
        return  $this->password;
    }

    public function getJWT(): JWTToken {
        return $this->jwt;
    }

    public function isHydraUsed(): bool {
        return true;
    }

    public function request(
        string $method,
        string $path,
        array $queryParams = [],
        array $body = []
    ): string {
        $headers = [];

        if(false === Router::isAuthRoute($path) && false === Router::isPublicRoute($path)) {
            if(true ===  $this->jwt->isExpired() && true ===$this->jwt->isRefreshable()) {
                $jwt = $this->auth->refresh();
                $this->jwt = JWTToken::newInstance($jwt->token, $jwt->refresh_token);
            } elseif(false === $this->jwt->isRefreshable()) {
                $jwt = $this->auth->authenticate();
                $this->jwt = JWTToken::newInstance($jwt->token, $jwt->refresh_token);
            }

            $headers['Authorization'] = sprintf("Bearer %s", $this->jwt->token);
        }

        $response = $this->client->executeRequest(
            $method,
            $path,
            $queryParams,
            $body,
            $headers
        );

        $isError = false;

        try {
            $response->getContent(true);
        }catch (ClientExceptionInterface $e) {
        }catch (RedirectionExceptionInterface $e) {
        }catch (ServerExceptionInterface $e) {
        }catch (TransportExceptionInterface $e) {
        }

        var_dump($response->getContent(false));

        return $response->getContent();
    }

}