<?php

namespace Owlnext\NotificationAPI\bean\Attachment;

use DateTime;

class AttachmentDetails
{
    public int $id;
    public string $user;
    public string $fileName;
    public string $content;
    public int $sequenceNumber;
    public string $type;
    public DateTime $createdAt;
}