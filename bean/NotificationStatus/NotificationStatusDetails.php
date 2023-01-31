<?php

namespace Owlnext\NotificationAPI\bean\NotificationStatus;

use DateTime;

class NotificationStatusDetails
{
    public int $id;
    public string $notification;
    public string $status;
    public ?string $comment = null;
    public DateTime $createdAt;
}