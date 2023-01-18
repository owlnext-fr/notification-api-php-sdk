<?php

namespace Owlnext\NotificationAPI\api\Impl;

use Owlnext\NotificationAPI\API;
use Owlnext\NotificationAPI\client\Method;
use Owlnext\NotificationAPI\Router\Router;
use Owlnext\NotificationAPI\utils\Constants;
use Owlnext\NotificationAPI\utils\ListIterator;
use Owlnext\NotificationAPI\utils\Serializer;

class AbstractEndpoint
{
    protected string $ressourceListPath;
    protected string $ressourceDetailsPath;

    protected API $api;
    protected Serializer $serializer;

    public function __construct(API $api, Serializer $serializer)
    {
        $this->api = $api;
        $this->serializer = $serializer;
    }

    protected function all(array $params = []): ListIterator {
        $queryParams = [
            'page' => array_key_exists('page', $params) ? $params['page'] : Constants::PARAM_PAGE,
            'itemsPerPage' => array_key_exists('itemsPerPage', $params) ? $params['itemsPerPage'] : Constants::PARAM_PER_PAGE,
        ];

        $queryParams = array_merge($params, $queryParams);

        return new ListIterator(
            $this->api,
            $this->serializer,
            $this->ressourceListPath,
            $queryParams,
            $this->deriveListItemBeanName()
        );
    }

    public function get(string $id): mixed {
        $path = Router::generate($this->ressourceDetailsPath, ['id' => $id]);

        $response = $this->api->request(Method::GET, $path);

        return $this->serializer->deserialize($response, $this->deriveDetailsBeanName());
    }

    public function delete(string $id): bool {
        $path = Router::generate($this->ressourceDetailsPath, ['id' => $id]);

        $response = $this->api->request(Method::DELETE, $path);

        return $response === "";
    }

    protected function deriveListItemBeanName(): string {
        $callingClass = $this->deriveCallingClassName();
        return sprintf("Owlnext\\NotificationAPI\\bean\\%s\\%sListItem", $callingClass, $callingClass);
    }

    protected function deriveDetailsBeanName(): string {
        $callingClass = $this->deriveCallingClassName();
        return sprintf("Owlnext\\NotificationAPI\\bean\\%s\\%sDetails", $callingClass, $callingClass);
    }

    protected function deriveCallingClassName(): string {
        $classPath = null;

        $trace = debug_backtrace();

        $class = $trace[1]['class'];

        $threshold = sizeof($trace);
        $i = 1;

        while ($i < $threshold && true === is_null($classPath)) {
            if ( true === array_key_exists($i, $trace) && $class != $trace[$i]['class']) {
                $classPath = $trace[$i]['class'];
            }
            $i++;
        }

        $path = explode('\\', $classPath);
        $classRealName = array_pop($path);

        return str_replace("Endpoint", "", $classRealName);
    }
}