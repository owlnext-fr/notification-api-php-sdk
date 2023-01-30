<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\Contact\ContactDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class ContactEndpoint extends AbstractEndpoint
{

    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): ContactDetails
    {
        return parent::get($id);
    }

    public function delete(string $id): bool
    {
        return parent::delete($id);
    }

    public function create(array $payload): ContactDetails
    {
        return parent::create($payload);
    }

    public function update(string $id, array $payload): ContactDetails
    {
        return parent::update($id, $payload);
    }

}