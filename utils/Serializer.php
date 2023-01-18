<?php

namespace Owlnext\NotificationAPI\utils;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class Serializer
{
    private \Symfony\Component\Serializer\Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new \Symfony\Component\Serializer\Serializer(
            [
                new ObjectNormalizer(null, null, null, new ReflectionExtractor()),
                new DateTimeNormalizer()
            ],
            [
                new JsonEncoder()
            ]
        );
    }

    public function deserialize(string $data, string $type): mixed {
        return $this->serializer->deserialize($data, $type, 'json');
    }

    public function serialize(mixed $data): string {
        return $this->serializer->serialize($data, 'json');
    }

}