<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\Transport\TransportDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class TransportTest extends AbstractTestCase
{

    private static mixed $transport = null;

    public function testCanCreate(): void
    {
        $json = <<<JSON
{
  "name": "string",
  "senderLabel": "string",
  "senderIdentifier": "string",
  "type": "letter_mysendingbox",
  "configuration": {
      "apiKey":"qsdf"
  }
}
JSON;
        self::$transport = self::$api->transports->create(json_decode($json, true));

        $this->assertInstanceOf(TransportDetails::class, self::$transport);
    }

    public function testCanList(): void
    {
        $transports = self::$api->transports->all(['page' => 1]);

        $transports->valid();

        $this->assertInstanceOf(ListIterator::class, $transports);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(TransportDetails::class, self::$api->transports->get(self::$transport->id));
    }

    public function testCanDelete(): void
    {
        $result = self::$api->transports->delete(self::$transport->id);

        $this->assertEquals(true, $result);
    }
}