<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\Notification\NotificationDateDetails;
use Owlnext\NotificationAPI\bean\Notification\NotificationDetails;
use Owlnext\NotificationAPI\bean\NotificationStatus\NotificationStatusLastStatusDetails;
use Owlnext\NotificationAPI\utils\ListIterator;
use Owlnext\NotificationAPI\utils\Serializer;

class NotificationEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::allWithSerializer(function (Serializer $serializer, array $objectArray, string $destObjectType) {
            $serialized = $serializer->deserialize(json_encode($objectArray), $destObjectType);

            $dates = [];

            if (false === is_null($serialized->appointment)) {
                foreach ($serialized->appointment->dates as $dateArray) {
                    $dates[] = $this->serializer->deserialize(json_encode($dateArray), NotificationDateDetails::class);
                }

                $serialized->appointment->dates = $dates;
            }

            return $serialized;
        }, $params);
    }

    public function get(string $id): NotificationDetails
    {
        $serialized = parent::get($id);
        $dates = [];

        if (false === is_null($serialized->appointment)) {
            foreach ($serialized->appointment->dates as $dateArray) {
                $dates[] = $this->serializer->deserialize(json_encode($dateArray), NotificationDateDetails::class);
            }

            $serialized->appointment->dates = $dates;
        }

        return $serialized;
    }

    public function create(array $payload): NotificationDetails
    {
        $serialized = parent::create($payload);
        $dates = [];

        if (false === is_null($serialized->appointment)) {
            foreach ($serialized->appointment->dates as $dateArray) {
                $dates[] = $this->serializer->deserialize(json_encode($dateArray), NotificationDateDetails::class);
            }

            $serialized->appointment->dates = $dates;
        }

        return $serialized;
    }

    public function getLastStatus(string $id): NotificationStatusLastStatusDetails
    {
        $this->api->notificationStatus->getLastStatus($id);
    }

    public function getStatusHistories(string $id, array $params = []): ListIterator
    {
        $this->api->notificationStatus->getStatusHistories($id, $params);
    }

}