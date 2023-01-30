<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\Appointment\AppointmentDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class AppointmentTest extends AbstractTestCase
{

    private static mixed $appointment = null;

    public function testCanCreate(): void
    {
        $json = <<<JSON
{
    "type": "create",
    "title": "Client meetup - owlnext X client",
    "description": "Hello ! Just little meetups each week to setup the releases.",
    "rsvp": true,
    "alarmTiming": "PT15M",
    "timezone": "Europe/Paris",
    "location": "12 Rue du Golf, 21800 Quetigny, France",
    "dates": [
        {
            "type": "onetime",
            "start": "2021-08-10 15:00:00",
            "end": "2021-08-10 15:30:00",
            "uid": "d978fe6b-6be8-4e08-b3fd-1157269b8ed3",
            "sequence":0
        },
        {
            "type": "onetime",
            "start": "2021-08-17 15:00:00",
            "end": "2021-08-17 15:30:00",
            "uid": "453f4cfc-37d4-4f3b-8b9f-ef84a11c59c6",
            "sequence":0
        }
    ]
}
JSON;

        self::$appointment = self::$api->appointments->create(json_decode($json, true));

        $this->assertInstanceOf(AppointmentDetails::class, self::$appointment);
    }


    public function testCanList(): void
    {
        $appointments = self::$api->appointments->all(['page' => 1]);

        $appointments->valid();

        $this->assertInstanceOf(ListIterator::class, $appointments);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(AppointmentDetails::class, self::$api->appointments->get(self::$appointment->id));
    }


}