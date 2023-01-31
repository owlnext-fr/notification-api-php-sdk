<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\NotificationType\NotificationTypeDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class NotificationTypeEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): NotificationTypeDetails
    {
        return parent::get($id);
    }

    public function create(array $payload): NotificationTypeDetails
    {
        return parent::create($payload);
    }

    public function delete(string $id): bool
    {
        return parent::delete($id);
    }
}