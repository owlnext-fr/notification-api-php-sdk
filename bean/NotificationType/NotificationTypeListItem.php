<?php

namespace Owlnext\NotificationAPI\bean\NotificationType;

use DateTime;

class NotificationTypeListItem
{
    public int $id;
    public string $user;
    public string $name;
    public string $title;
    public string $format;
    public DateTime $createdAt;

}