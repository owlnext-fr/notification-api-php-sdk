<?php

namespace Owlnext\NotificationAPI\bean\User;

use DateTime;

class UserListItem
{
    public ?int $id = null;
    public string $email;
    public string $name;
    public string $login;
    public array $roles;
    public DateTime $createdAt;
}