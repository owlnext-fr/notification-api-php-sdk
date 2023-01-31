<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\User\UserDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class UserEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): UserDetails
    {
        return parent::get($id);
    }

    public function create(array $payload): UserDetails
    {
        return parent::create($payload);
    }

    public function delete(string $id): bool
    {
        return parent::delete($id);
    }
}