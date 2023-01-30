<?php

namespace Owlnext\NotificationAPI\bean\Transport;

use DateTime;

class TransportDetails
{
    public int $id;
    public string $user;
    public string $name;
    public string $senderLabel;
    public string $senderIdentifier;
    public string $type;
    public array $configuration;
    public DateTime $createdAt;
}