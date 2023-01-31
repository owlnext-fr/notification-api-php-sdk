<?php

namespace Owlnext\NotificationAPI\api\Impl;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\client\Method;
use Owlnext\NotificationAPI\utils\Constants;
use Owlnext\NotificationAPI\utils\ListIterator;
use Owlnext\NotificationAPI\utils\Serializer;
use Symfony\Component\String\UnicodeString;

class AbstractEndpoint
{

    protected API $api;

    protected Serializer $serializer;

    public function __construct(API $api, Serializer $serializer)
    {
        $this->api = $api;
        $this->serializer = $serializer;
    }

    protected function all(array $params = []): ListIterator
    {
        return new ListIterator(
            $this->api,
            $this->serializer,
            $this->api->getRouter()->generateByName($this->deriveListRouteName()),
            $this->mergeListParams($params),
            $this->deriveListItemBeanName()
        );
    }

    protected function allWithSerializer(callable $serializerFunction, array $params = []): ListIterator
    {
        return new ListIterator(
            $this->api,
            $this->serializer,
            $this->api->getRouter()->generateByName($this->deriveListRouteName()),
            $this->mergeListParams($params),
            $this->deriveListItemBeanName(),
            $serializerFunction
        );
    }

    protected function get(string $id): mixed
    {
        $path = $this
            ->api
            ->getRouter()
            ->generateByName($this->deriveDetailsRouteName(), ['id' => $id]);

        $response = $this->api->request(Method::GET, $path);

        return $this->serializer->deserialize($response, $this->deriveDetailsBeanName());
    }

    protected function delete(string $id): bool
    {
        $path = $this
            ->api
            ->getRouter()
            ->generateByName($this->deriveDetailsRouteName(), ['id' => $id]);

        $response = $this->api->request(Method::DELETE, $path);

        return $response === "";
    }

    protected function create(array $payload): mixed
    {
        $path = $this->api->getRouter()->generateByName($this->deriveListRouteName());

        $response = $this->api->request(Method::POST, $path, [], $payload);

        return $this->serializer->deserialize($response, $this->deriveDetailsBeanName());
    }

    protected function update(string $id, array $payload): mixed
    {
        $path = $this->api->getRouter()->generateByName($this->deriveDetailsRouteName(), ['id' => $id]);

        $response = $this->api->request(Method::PUT, $path, [], $payload);

        return $this->serializer->deserialize($response, $this->deriveDetailsBeanName());
    }

    protected function mergeListParams(array $params): array
    {
        $queryParams = [
            'page' => array_key_exists('page', $params) ? $params['page'] : Constants::PARAM_PAGE,
            'itemsPerPage' => array_key_exists('itemsPerPage',
                $params) ? $params['itemsPerPage'] : Constants::PARAM_PER_PAGE,
        ];

        return array_merge($params, $queryParams);
    }

    protected function deriveListRouteName(): string
    {
        $routePart = (new UnicodeString($this->deriveCallingClassName()))->snake();

        return sprintf(
            "%s_list",
            strtolower($routePart)
        );
    }

    protected function deriveDetailsRouteName(): string
    {
        $routePart = (new UnicodeString($this->deriveCallingClassName()))->snake();

        return sprintf(
            "%s_details",
            strtolower($routePart)
        );
    }

    protected function deriveListItemBeanName(): string
    {
        $callingClass = $this->deriveCallingClassName();

        return sprintf("Owlnext\\NotificationAPI\\bean\\%s\\%sListItem", $callingClass, $callingClass);
    }

    protected function deriveDetailsBeanName(): string
    {
        $callingClass = $this->deriveCallingClassName();

        return sprintf("Owlnext\\NotificationAPI\\bean\\%s\\%sDetails", $callingClass, $callingClass);
    }

    protected function deriveCallingClassName(): string
    {
        $classPath = null;

        $trace = debug_backtrace();

        $class = $trace[1]['class'];

        $threshold = sizeof($trace);
        $i = 1;

        while ($i < $threshold && true === is_null($classPath)) {
            if (true === array_key_exists($i, $trace) && $class != $trace[$i]['class']) {
                $classPath = $trace[$i]['class'];
            }
            $i++;
        }

        $path = explode('\\', $classPath);
        $classRealName = array_pop($path);

        return str_replace("Endpoint", "", $classRealName);
    }

}