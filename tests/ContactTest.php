<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\Contact\ContactDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class ContactTest extends AbstractTestCase
{

    private static mixed $contact = null;

    private const REPLACEMENT_EMAIL = "unittests_updated@owlnext.fr";

    public function testCanList(): void
    {
        $list = self::$api->contacts->all(['page' => 1]);

        $list->valid();
        
        $this->assertInstanceOf(ListIterator::class, $list);
    }

    public function testCanCreate(): void
    {
        self::$contact = self::$api->contacts->create([
            "firstName" => "unit",
            "lastName"  => "test",
            "email"     => "unittests@owlnext.fr",
        ]);

        $this->assertInstanceOf(ContactDetails::class, self::$contact);
    }

    public function testCanGetDetails(): void
    {
        self::$contact = self::$api->contacts->get(self::$contact->id);

        $this->assertInstanceOf(ContactDetails::class, self::$contact);
    }

    public function testCanUpdate(): void
    {
        self::$contact = self::$api->contacts->update(self::$contact->id, [
            "email" => self::REPLACEMENT_EMAIL,
        ]);

        self::assertEquals(self::REPLACEMENT_EMAIL, self::$contact->email);
    }

    public function testCanDelete(): void
    {
        $result = self::$api->contacts->delete(self::$contact->id);

        $this->assertEquals(true, $result);
    }

}