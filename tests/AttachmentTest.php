<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\Attachment\AttachmentDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class AttachmentTest extends AbstractTestCase
{

    private static mixed $attachment = null;

    public function testCanCreate(): void
    {
        $json = <<<JSON
{
  "fileName": "string",
  "content": "string",
  "sequenceNumber": 0,
  "type": "attachment"
}
JSON;

        self::$attachment = self::$api->attachments->create(json_decode($json, true));

        $this->assertInstanceOf(AttachmentDetails::class, self::$attachment);
    }


    public function testCanList(): void
    {
        $attachments = self::$api->attachments->all(['page' => 1]);

        $attachments->valid();

        $this->assertInstanceOf(ListIterator::class, $attachments);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(AttachmentDetails::class, self::$api->attachments->get(self::$attachment->id));
    }

    public function testCanDelete(): void
    {
        $result = self::$api->attachments->delete(self::$attachment->id);

        $this->assertEquals(true, $result);
    }


}