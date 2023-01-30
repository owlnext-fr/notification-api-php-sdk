<?php

namespace Owlnext\NotificationAPI\bean\Appointment;

use DateTime;

class AppointmentDateListItem
{

    public int $sequence;

    public DateTime $start;

    public DateTime $end;

    public string $type;

    public string $uid;

}