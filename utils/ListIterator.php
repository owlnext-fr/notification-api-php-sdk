<?php

namespace Owlnext\NotificationAPI\utils;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\client\Method;

class ListIterator implements \Iterator
{
    private array $container;
    private string $path;
    private string $destObjectType;
    private array $parameters;
    private API $api;
    private Serializer $serializer;

    private int $currentCursor;

    private bool $flagLastRequestNotFull = false;
    private bool $flagFixedPage = false;
    private int $flagOrigPage = 0;

    public function __construct(
        API $api,
        Serializer $serializer,
        string $path,
        array $parameters,
        string $destObjectType
    )
    {
        $this->container = [];
        $this->path = $path;
        $this->parameters = $parameters;
        $this->destObjectType = $destObjectType;
        $this->api = $api;
        $this->serializer = $serializer;
        $this->rewind();

        if(false === is_null($parameters['page'])) {
            $this->flagFixedPage = true;
            $this->flagOrigPage = $parameters['page'];
            $this->parameters['page'] = $parameters['page'] - 1;
        } else {
            $this->parameters['page'] = 0;
        }

        if(true === is_null($parameters['itemsPerPage'])) {
            $this->parameters['itemsPerPage'] = 25;
        }
    }

    public function current(): mixed
    {
        var_dump(__METHOD__);
        return $this->container[$this->currentCursor];
    }

    public function next(): void
    {
        var_dump(__METHOD__);
        $this->currentCursor += 1;
    }

    public function key(): int
    {
        var_dump(__METHOD__);
        return $this->currentCursor;
    }

    public function valid(): bool
    {
        var_dump(__METHOD__);

        $nextElemKey = $this->currentCursor;

        if($nextElemKey >= sizeof($this->container) || $nextElemKey === 0) {
            if(true === $this->flagLastRequestNotFull) {
                return false;
            }

            $this->parameters['page'] += 1;
            if(true === $this->flagFixedPage && $this->parameters['page'] > $this->flagOrigPage) {
                return false;
            }

            $response = $this->api->request(Method::GET, $this->path, $this->parameters);

            $responseAsArray = json_decode($response, true);

            $arrayToLoop = $responseAsArray;
            if(true === $this->api->isHydraUsed()) {
                $arrayToLoop = $responseAsArray["hydra:member"];
            }

            if(sizeof($arrayToLoop) === 0) {
                return false;
            }

            if(sizeof($arrayToLoop) < $this->parameters['itemsPerPage']) {
                $this->flagLastRequestNotFull = true;
            }

            foreach ($arrayToLoop as $responseObjArray) {
                $objJsonString = json_encode($responseObjArray);

                $obj = $this->serializer->deserialize($objJsonString, $this->destObjectType);

                $this->container[] = $obj;
            }
        }

        return true;
    }

    public function rewind(): void
    {
        var_dump(__METHOD__);

        $this->currentCursor = 0;
    }

}