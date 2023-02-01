<?php

namespace Owlnext\NotificationAPI\bean\Notification;

use DateTime;

class NotificationDetails
{
    public int $id;
    public string $user;
    public array $to;
    public array $cc;
    public array $bcc;
    public array $attachments;
    public string $type;
    public string $transport;
    public array $titleParameters;
    public array $parameters;
    public array $statusHistory;
    public NotificationStatusDetails $lastStatus;
    public ?NotificationAppointmentDetails $appointment = null;
    public ?array $cost = null;
    public ?string $signatureRequest = null;
    public ?string $letterOption = null;
    public ?array $rawData = null;
    public ?string $ttl = null;
    public DateTime $createdAt;

}