<?php

namespace Owlnext\NotificationAPI\utils;

use Iterator;
use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\client\Method;

class ListIterator implements Iterator
{

    private array $container;

    private string $path;

    private string $destObjectType;

    private array $parameters;

    private API $api;

    private Serializer $serializer;

    private mixed $serializingFunction = null;

    private int $currentCursor;

    private bool $flagLastRequestNotFull = false;

    private bool $flagFixedPage = false;

    private int $flagOrigPage = 0;

    public function __construct(
        API $api,
        Serializer $serializer,
        string $path,
        array $parameters,
        string $destObjectType,
        null|callable $serializingFunction = null
    ) {
        $this->container = [];
        $this->path = $path;
        $this->parameters = $parameters;
        $this->destObjectType = $destObjectType;
        $this->api = $api;
        $this->serializer = $serializer;
        $this->serializingFunction = $serializingFunction;
        $this->rewind();

        if (false === is_null($parameters['page'])) {
            $this->flagFixedPage = true;
            $this->flagOrigPage = $parameters['page'];
            $this->parameters['page'] = $parameters['page'] - 1;
        } else {
            $this->parameters['page'] = 0;
        }

        if (true === is_null($parameters['itemsPerPage'])) {
            $this->parameters['itemsPerPage'] = 25;
        }
    }

    public function current(): mixed
    {
        return $this->container[$this->currentCursor];
    }

    public function next(): void
    {
        $this->currentCursor += 1;
    }

    public function key(): int
    {
        return $this->currentCursor;
    }

    public function valid(): bool
    {
        $nextElemKey = $this->currentCursor;

        if ($nextElemKey >= sizeof($this->container) || $nextElemKey === 0) {
            if (true === $this->flagLastRequestNotFull) {
                return false;
            }

            $this->parameters['page'] += 1;
            if (true === $this->flagFixedPage && $this->parameters['page'] > $this->flagOrigPage) {
                return false;
            }

            $response = $this->api->request(Method::GET, $this->path, $this->parameters);

            $responseAsArray = json_decode($response, true);

            $arrayToLoop = $responseAsArray;
            if (true === $this->api->isHydraUsed()) {
                $arrayToLoop = $responseAsArray["hydra:member"];
            }

            if (sizeof($arrayToLoop) === 0) {
                return false;
            }

            if (sizeof($arrayToLoop) < $this->parameters['itemsPerPage']) {
                $this->flagLastRequestNotFull = true;
            }

            foreach ($arrayToLoop as $objectArray) {
                $this->container[] = true === is_null($this->serializingFunction) ?
                    $this->serialize($this->serializer, $objectArray, $this->destObjectType) :
                    ($this->serializingFunction)($this->serializer, $objectArray, $this->destObjectType);
            }

        }

        return true;
    }

    public function rewind(): void
    {
        $this->currentCursor = 0;
    }

    private function serialize(Serializer $serializer, array $arrayToDeserialize, string $destinationObjectType): mixed
    {
        return $serializer->deserialize(json_encode($arrayToDeserialize), $destinationObjectType);
    }

}