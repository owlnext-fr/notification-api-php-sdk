<?php

namespace Owlnext\NotificationAPI\bean\Transport;

use DateTime;

class TransportListItem
{
    public int $id;
    public string $user;
    public string $name;
    public string $senderLabel;
    public string $senderIdentifier;
    public string $type;
    public DateTime $createdAt;

}