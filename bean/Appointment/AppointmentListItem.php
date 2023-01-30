<?php

namespace Owlnext\NotificationAPI\bean\Appointment;

class AppointmentListItem
{

    public int $id;

    public string $type;

    public string $title;

    public bool $rsvp;

    public string $alarmTiming;

    public string $timezone;

    public string $location;

    public array $dates;

}