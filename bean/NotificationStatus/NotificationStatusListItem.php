<?php

namespace Owlnext\NotificationAPI\bean\NotificationStatus;

use DateTime;

class NotificationStatusListItem
{
    public int $id;
    public string $notification;
    public string $status;
    public DateTime $createdAt;

}