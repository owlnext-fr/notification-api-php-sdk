<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\client\Method;

class TestEndpoint extends AbstractEndpoint
{

    public function ping(): bool
    {
        $path = $this->api->getRouter()->generateByName('test_ping');

        $this->api->request(Method::GET, $path);

        return true;
    }

    public function pingSecured(): bool
    {
        $path = $this->api->getRouter()->generateByName('test_ping_connected');

        $this->api->request(Method::GET, $path);

        return true;
    }

}