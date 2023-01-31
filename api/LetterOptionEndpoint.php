<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\LetterOption\LetterOptionDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

class LetterOptionEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): LetterOptionDetails
    {
        return parent::get($id);
    }

    public function create(array $payload): LetterOptionDetails
    {
        return parent::create($payload);
    }

}