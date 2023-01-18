<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\client\Method;
use Owlnext\NotificationAPI\utils\Serializer;

class TestEndpoint
{
    private static string $pingPath = "/api/docs.html";
    private static string $pingSecuredPath = "/api/users";

    private API $api;
    private Serializer $serializer;

    public function __construct(API $api, Serializer $serializer)
    {
        $this->api = $api;
        $this->serializer = $serializer;
    }

    public function ping(): bool {
        $this->api->request(Method::GET, self::$pingPath);

        return true;
    }

    public function pingSecured(): bool {
        $this->api->request(Method::GET, self::$pingSecuredPath);
        return true;
    }
}