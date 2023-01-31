<?php

namespace Owlnext\NotificationAPI\bean\NotificationStatus;

use DateTime;

class NotificationStatusLastStatusDetails
{
    public int $id;
    public string $notification;
    public string $status;
    public ?string $comment = null;
    public DateTime $createdAt;
    public array $createdBy;
    public DateTime $deletedAt;
    public array $deletedBy;
    public bool $isDeleted;
    public array $statusList;
}