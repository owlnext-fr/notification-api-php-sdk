<?php

namespace Owlnext\NotificationAPI\bean\NotificationType;

use DateTime;

class NotificationTypeDetails
{
    public int $id;
    public string $user;
    public string $name;
    public string $title;
    public array $titleParameters;
    public array $templateParameters;
    public string $format;
    public DateTime $createdAt;
}