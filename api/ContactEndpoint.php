<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\Contact\ContactDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class ContactEndpoint extends AbstractEndpoint
{
    protected string $ressourceListPath = '/api/contacts';
    protected string $ressourceDetailsPath = '/api/contacts/{id}';

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

}