<?php

namespace bootstrap;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\utils\Environment;
use Symfony\Component\Dotenv\Dotenv;

class Bootstrap
{

    public static final function getAPI(): API
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env.local');

        return new API($_ENV['API_LOGIN'], $_ENV['API_PASSWD'], Environment::INTEGRATION);
    }

}