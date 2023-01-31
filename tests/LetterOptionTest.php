<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\LetterOption\LetterOptionDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class LetterOptionTest extends AbstractTestCase
{

    private static mixed $letterOption = null;

    public function testCanCreate(): void
    {
        $json = <<<JSON
{
    "color": "bw",
	"channel": "paper",
	"bothSide": true,
	"postageType": "lrar",
	"postageSpeed": "D",
	"manageDeliveryProof": true,
	"manageReturnedMail": false,
	"envelopeWindow": "double",
	"envelope": "c6",
	"printSenderAddress": true,
	"sheetCount": 1,
	"description": "C'est un test.",
	"staple": false,
	"addressPlacement": "first_page",
	"name": "Jean Test",
	"companyName": "Test company",
	"addressLine1": "11 Rue de la Chouette",
	"addressLine2": "11 bis rue de la Chouette",
	"postalCode": "21000",
	"city": "Dijon",
	"country": "France"
}
JSON;
        self::$letterOption = self::$api->letterOption->create(json_decode($json, true));

        $this->assertInstanceOf(LetterOptionDetails::class, self::$letterOption);
    }

    public function testCanList(): void
    {
        $letterOptions = self::$api->letterOption->all(['page' => 1]);

        $letterOptions->valid();

        $this->assertInstanceOf(ListIterator::class, $letterOptions);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(LetterOptionDetails::class, self::$api->letterOption->get(self::$letterOption->id));
    }

}