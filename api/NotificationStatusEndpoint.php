<?php

namespace Owlnext\NotificationAPI\api;

use Owlnext\NotificationAPI\api\Impl\AbstractEndpoint;
use Owlnext\NotificationAPI\bean\NotificationStatus\NotificationStatusDetails;
use Owlnext\NotificationAPI\bean\NotificationStatus\NotificationStatusLastStatusDetails;
use Owlnext\NotificationAPI\client\Method;
use Owlnext\NotificationAPI\utils\ListIterator;

class NotificationStatusEndpoint extends AbstractEndpoint
{
    public function all(array $params = []): ListIterator
    {
        return parent::all($params);
    }

    public function get(string $id): NotificationStatusDetails
    {
        return parent::get($id);
    }

    public function getLastStatus(string $id): NotificationStatusLastStatusDetails
    {
        $path = $this
            ->api
            ->getRouter()
            ->generateByName($this->deriveDetailsRouteName() . '_last_status', ['id' => $id]);

        $response = $this->api->request(Method::GET, $path);

        return $this->serializer->deserialize($response, NotificationStatusLastStatusDetails::class);
    }

    public function getStatusHistories(string $id, array $params = []): ListIterator
    {
        return new ListIterator(
            $this->api,
            $this->serializer,
            $this->api->getRouter()->generateByName($this->deriveListRouteName() . '_status_histories', ['id' => $id]),
            $this->mergeListParams($params),
            $this->deriveListItemBeanName()
        );
    }

}