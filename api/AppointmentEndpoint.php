<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\Appointment\AppointmentDateListItem;
use Owlnext\NotificationAPI\bean\Appointment\AppointmentDetails;
use Owlnext\NotificationAPI\utils\ListIterator;
use Owlnext\NotificationAPI\utils\Serializer;

class AppointmentEndpoint extends AbstractEndpoint
{

    public function all(array $params = []): ListIterator
    {
        return parent::allWithSerializer(function (Serializer $serializer, array $objectArray, string $destObjectType) {
            $serialized = $serializer->deserialize(json_encode($objectArray), $destObjectType);

            $dates = [];

            foreach ($serialized->dates as $dateArray) {
                $dates[] = $serializer->deserialize(json_encode($dateArray), AppointmentDateListItem::class);
            }

            $serialized->dates = $dates;

            return $serialized;
        }, $params);
    }

    public function get(string $id): AppointmentDetails
    {
        $serialized = parent::get($id);

        $dates = [];

        foreach ($serialized->dates as $dateArray) {
            $dates[] = $this->serializer->deserialize(json_encode($dateArray), AppointmentDateListItem::class);
        }

        $serialized->dates = $dates;

        return $serialized;
    }

    public function create(array $payload): AppointmentDetails
    {
        $serialized = parent::create($payload);

        $dates = [];

        foreach ($serialized->dates as $dateArray) {
            $dates[] = $this->serializer->deserialize(json_encode($dateArray), AppointmentDateListItem::class);
        }

        $serialized->dates = $dates;

        return $serialized;
    }

}