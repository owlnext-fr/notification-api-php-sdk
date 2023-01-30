<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\bean\Auth\JWT;
use Owlnext\NotificationAPI\client\Method;
use Owlnext\NotificationAPI\Router\Routes;
use Owlnext\NotificationAPI\utils\Serializer;

class AuthenticationEndpoint
{

    private API $api;

    private Serializer $serializer;

    public function __construct(API $api, Serializer $serializer)
    {
        $this->api = $api;
        $this->serializer = $serializer;
    }

    public function authenticate(): JWT
    {
        $result = $this->api->request(Method::POST, Routes::AUTHENTICATION_TOKEN, [], [
            'login'    => $this->api->getLogin(),
            'password' => $this->api->getPassword()
        ]);

        return $this->serializer->deserialize($result, JWT::class);
    }

    public function refresh(): JWT
    {
        $result = $this->api->request(Method::POST, Routes::AUTHENTICATION_REFRESH, [], [
            'refresh_token' => $this->api->getJWT()->refreshToken,
        ]);

        return $this->serializer->deserialize($result, JWT::class);
    }

}