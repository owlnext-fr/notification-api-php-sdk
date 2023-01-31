<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\NotificationType\NotificationTypeDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class NotificationTypeTest extends AbstractTestCase
{

    private static mixed $notificationType = null;

    public function testCanCreate(): void
    {
        $json = <<<JSON
{
  "name": "string",
  "title": "string",
  "titleParameters": {
      "apiKey":"qsdf"
  },
  "template": "string",
  "templateParameters": {
      "apiKey":"qsdf"
  }
}
JSON;
        self::$notificationType = self::$api->notificationTypes->create(json_decode($json, true));

        $this->assertInstanceOf(NotificationTypeDetails::class, self::$notificationType);
    }

    public function testCanList(): void
    {
        $notificationTypes = self::$api->notificationTypes->all(['page' => 1]);

        $notificationTypes->valid();

        $this->assertInstanceOf(ListIterator::class, $notificationTypes);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(NotificationTypeDetails::class, self::$api->notificationTypes->get(self::$notificationType->id));
    }

    public function testCanDelete(): void
    {
        $result = self::$api->notificationTypes->delete(self::$notificationType->id);

        $this->assertEquals(true, $result);
    }
}