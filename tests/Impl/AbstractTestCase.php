<?php

namespace Impl;

use bootstrap\Bootstrap;
use Owlnext\NotificationAPI\API;
use PHPUnit\Framework\TestCase;

class AbstractTestCase extends TestCase
{

    protected static null|API $api;

    public static function setUpBeforeClass(): void
    {
        self::$api = Bootstrap::getAPI();
    }

    public static function tearDownAfterClass(): void
    {
        self::$api = null;
    }

    public static function dump(mixed $value): void
    {
        var_dump($value);
        ob_flush();
    }

}