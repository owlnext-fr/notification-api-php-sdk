<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\bean\Auth\JWT;
use Owlnext\NotificationAPI\client\Method;
use Owlnext\NotificationAPI\utils\Serializer;

class AuthenticationEndpoint
{
    private static string $authenticationPath = "/api/authentication_token";
    private static string $refreshPath = "/api/token/refresh";


    private API $api;
    private Serializer $serializer;

    public function __construct(API $api, Serializer $serializer)
    {
        $this->api = $api;
        $this->serializer = $serializer;
    }

    public function authenticate(): JWT {
        $result = $this->api->request(Method::POST, self::$authenticationPath, [], [
            'login' => $this->api->getLogin(),
            'password' => $this->api->getPassword()
        ]);

        return $this->serializer->deserialize($result, JWT::class);
    }

    public function refresh(): JWT {
        $result = $this->api->request(Method::POST, self::$refreshPath, [], [
            'refresh_token' => $this->api->getJWT()->refreshToken,
        ]);

        return $this->serializer->deserialize($result, JWT::class);
    }
}