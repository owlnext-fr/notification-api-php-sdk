<?php

namespace Owlnext\NotificationAPI\bean\Contact;

class ContactDetails
{
    public int $id;
    public null|string $user;
    public null|string $firstName;
    public null|string $lastName;
    public null|string $email;
    public null|string $phoneNumber;
    public null|string $deviceIdentifier;
    public null|string $addressLine1;
    public null|string $addressLine2;
    public null|string $postalCode;
    public null|string $city;
    public null|string $country;
    public null|string $companyName;
    public \DateTime $createdAt;
}