<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\bean\Attachment\AttachmentDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class AttachmentEndpoint extends Impl\AbstractEndpoint
{

    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): AttachmentDetails
    {
        return parent::get($id);
    }

    public function create(array $payload): AttachmentDetails
    {
        return parent::create($payload);
    }

    public function delete(string $id): bool
    {
        return parent::delete($id);
    }

}