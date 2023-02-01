<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\Notification\NotificationDetails;
use Owlnext\NotificationAPI\bean\NotificationStatus\NotificationStatusLastStatusDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class NotificationTest extends AbstractTestCase
{

    private static mixed $notification = null;

    public function testCanCreateWithSignatureRequest(): void
    {
        $json = <<<JSON
{
  "to": [
     "/api/contacts/469"
  ],
  "cc": [
     "/api/contacts/469"
  ],
  "bcc": [
  ],
  "attachments": [
    "/api/attachments/116"
  ],
  "appointment": null,
  "type": "/api/notification-types/275",
  "transport": "/api/transports/160",
  "parameters": {
    "apiKey" : "qsdf"
  },
  "titleParameters": {
    "apiKey" : "qsdf"
  },
  "signatureRequest": "/api/signature-requests/61",
  "letterOption":null,
  "rawData": null,
  "ttl": null
}
JSON;
        self::$notification = self::$api->notifications->create(json_decode($json, true));

        $this->assertInstanceOf(NotificationDetails::class, self::$notification);
    }

    public function testCanCreateWithLetterOption(): void
    {
        $json = <<<JSON
{
  "to": [
     "/api/contacts/557"
  ],
  "cc": [
  ],
  "bcc": [
  ],
  "attachments": [
    "/api/attachments/116"
  ],
  "appointment": null,
  "type": "/api/notification-types/275",
  "transport": "/api/transports/177",
  "parameters": {
    "apiKey" : "qsdf"
  },
  "titleParameters": {
    "apiKey" : "qsdf"
  },
  "signatureRequest": null,
  "letterOption": "/api/letter-option/6",
  "rawData": null,
  "ttl": null
}
JSON;
        self::$notification = self::$api->notifications->create(json_decode($json, true));

        $this->assertInstanceOf(NotificationDetails::class, self::$notification);
    }

    public function testCanCreateWithAppointment(): void
    {
        $json = <<<JSON
{
  "to": [
     "/api/contacts/557"
  ],
  "cc": [
     "/api/contacts/557"
  ],
  "bcc": [
      "/api/contacts/557"
  ],
  "attachments": [
    "/api/attachments/116"
  ],
  "appointment": [
    "/api/appointments/1"
  ],
  "type": "/api/notification-types/275",
  "transport": "/api/transports/189",
  "parameters": {
    "apiKey" : "qsdf"
  },
  "titleParameters": {
    "apiKey" : "qsdf"
  },
  "signatureRequest": null,
  "letterOption":null,
  "rawData": null,
  "ttl": null
}
JSON;

        self::$notification = self::$api->notifications->create(json_decode($json, true));

        $this->assertInstanceOf(NotificationDetails::class, self::$notification);
    }

    public function testCanList(): void
    {
        $notificationTypes = self::$api->notifications->all(['page' => 1]);

        $notificationTypes->valid();

        $this->assertInstanceOf(ListIterator::class, $notificationTypes);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(NotificationDetails::class, self::$api->notifications->get(self::$notification->id));
    }

    public function testCanGetLastStatusDetails(): void
    {
        $this->assertInstanceOf(NotificationStatusLastStatusDetails::class, self::$api->notificationStatus->getLastStatus(self::$notification->id));
    }

    public function testCanGetStatusHistoriesDetails(): void
    {
        $history = self::$api->notificationStatus->getStatusHistories(self::$notification->id, ['page' => 1]);

        $history->valid();

        $this->assertInstanceOf(ListIterator::class, $history);
    }
}