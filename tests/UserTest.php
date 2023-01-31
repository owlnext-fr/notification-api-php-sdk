<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\utils\ListIterator;

final class UserTest extends AbstractTestCase
{

    private static mixed $user = null;

//    public function testCanCreate(): void
//    {
//        $json = <<<JSON
//{
//  "name": "string",
//  "email": "user@example.com",
//  "login": "string",
//  "password": "string"
//}
//JSON;
//        self::$user = self::$api->users->create(json_decode($json, true));
//
//        $this->assertInstanceOf(UserDetails::class, self::$user);
//    }

    public function testCanList(): void
    {
        $users = self::$api->users->all(['page' => 1]);

        $users->valid();

        $this->assertInstanceOf(ListIterator::class, $users);
    }

//    public function testCanGetDetails(): void
//    {
//        $this->assertInstanceOf(UserDetails::class, self::$api->users->get(self::$user->id));
//    }
//
//    public function testCanDelete(): void
//    {
//        $result = self::$api->users->delete(self::$user->id);
//
//        $this->assertEquals(true, $result);
//    }
}