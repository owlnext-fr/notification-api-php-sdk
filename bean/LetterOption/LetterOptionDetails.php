<?php

namespace Owlnext\NotificationAPI\bean\LetterOption;

class LetterOptionDetails
{
    public int $id;
    public string $user;
    public string $color;
    public string $channel;
    public bool $bothSide;
    public string $postageType;
    public string $postageSpeed;
    public bool $manageDeliveryProof;
    public bool $manageReturnedMail;
    public string $envelopeWindow;
    public string $envelope;
    public string $printSenderAddress;
    public int $sheetCount;
    public string $description;
    public bool $staple;
    public string $addressPlacement;
    public string $name;
    public string $companyName;
    public string $addressLine1;
    public string $addressLine2;
    public string $postalCode;
    public string $city;
    public string $country;
}