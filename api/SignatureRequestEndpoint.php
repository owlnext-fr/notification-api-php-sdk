<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\SignatureRequest\SignatureRequestDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class SignatureRequestEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): SignatureRequestDetails
    {
        return parent::get($id);
    }

    public function create(array $payload): SignatureRequestDetails
    {
        return parent::create($payload);
    }

}