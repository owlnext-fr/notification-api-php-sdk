<?php

use Impl\AbstractTestCase;
use Owlnext\NotificationAPI\bean\NotificationStatus\NotificationStatusDetails;
use Owlnext\NotificationAPI\bean\NotificationStatus\NotificationStatusLastStatusDetails;
use Owlnext\NotificationAPI\utils\ListIterator;

final class NotificationStatusTest extends AbstractTestCase
{

    private static mixed $notificationStatus = null;
    private static mixed $notificationsId = null;


    public function testCanList(): void
    {
        $notificationStatus = self::$api->notificationStatus->all(['page' => 1]);

        $notificationStatus->valid();

        self::$notificationStatus = $notificationStatus->current();

        self::$notificationsId = intval(str_replace('/api/notifications/', '', self::$notificationStatus->notification));

        $this->assertInstanceOf(ListIterator::class, $notificationStatus);
    }

    public function testCanGetDetails(): void
    {
        $this->assertInstanceOf(NotificationStatusDetails::class, self::$api->notificationStatus->get(self::$notificationStatus->id));
    }

    public function testCanGetLastStatusDetails(): void
    {
        $this->assertInstanceOf(NotificationStatusLastStatusDetails::class, self::$api->notificationStatus->getLastStatus(self::$notificationsId));
    }

    public function testCanGetStatusHistoriesDetails(): void
    {
        $history = self::$api->notificationStatus->getStatusHistories(self::$notificationsId, ['page' => 1]);

        $history->valid();

        $this->assertInstanceOf(ListIterator::class, $history);
    }

}