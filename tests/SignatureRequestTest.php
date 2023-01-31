<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\SignatureRequest\SignatureRequestDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class SignatureRequestTest extends AbstractTestCase
{

    private static mixed $signatureRequestDetails = null;

    public function testCanCreate(): void
    {
        $json = <<<JSON
{
       "fields": [
        {
            "type": "initialHere",
            "contact": "/api/contacts/361",
            "params": [
            {
                "anchor_string": "s1"
            }
          ]
        }
    ]
}
JSON;
        self::$signatureRequestDetails = self::$api->signatureRequest->create(json_decode($json, true));

        $this->assertInstanceOf(SignatureRequestDetails::class, self::$signatureRequestDetails);
    }

    public function testCanList(): void
    {
        $letterOptions = self::$api->signatureRequest->all(['page' => 1]);

        $letterOptions->valid();

        $this->assertInstanceOf(ListIterator::class, $letterOptions);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(SignatureRequestDetails::class, self::$api->signatureRequest->get(self::$signatureRequestDetails->id));
    }

}