<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\Transport\TransportDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class TransportEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): TransportDetails
    {
        return parent::get($id);

    }

    public function create(array $payload): TransportDetails
    {
        return parent::create($payload);
    }

    public function delete(string $id): bool
    {
        return parent::delete($id);
    }
}