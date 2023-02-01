<?php

namespace Owlnext\NotificationAPI\bean\Notification;

use DateTime;

class NotificationDateDetails
{

    public int $sequence;

    public DateTime $start;

    public DateTime $end;

    public string $type;

    public string $uid;

}