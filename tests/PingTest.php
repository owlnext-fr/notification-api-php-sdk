<?php var_dump($notificationStatus);

use Impl\AbstractTestCase;

final class PingTest extends AbstractTestCase
{

    public function testCanPing(): void
    {
        $this->assertEquals(true, self::$api->test->ping());
    }

    public function testCanPingSecured(): void
    {
        $this->assertEquals(true, self::$api->test->pingSecured());
    }

}