<?php

namespace Owlnext\NotificationAPI\bean\Notification;

use DateTime;

class NotificationListItem
{
    public int $id;
    public string $user;
    public array $to;
    public array $cc;
    public array $bcc;
    public ?array $attachments = null;
    public string $type;
    public string $transport;
    public array $parameters;
    public array $titleParameters;
    public NotificationStatusDetails $lastStatus;
    public ?NotificationAppointmentDetails $appointment = null;
    public ?string $signatureRequest = null;
    public ?string $letterOption = null;
    public ?array $rawData = null;
    public ?string $ttl = null;
    public DateTime $createdAt;

}