<?php

use Anteris\Autotask\API\WebhookEventErrorLogs\WebhookEventErrorLogCollection;
use Anteris\Autotask\API\WebhookEventErrorLogs\WebhookEventErrorLogService;
use Anteris\Autotask\API\WebhookEventErrorLogs\WebhookEventErrorLogEntity;

use Anteris\Autotask\API\WebhookEventErrorLogs\WebhookEventErrorLogQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for WebhookEventErrorLogService.
 */
class WebhookEventErrorLogServiceTest extends AbstractTest
{
    /**
     * @covers WebhookEventErrorLogService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            WebhookEventErrorLogService::class,
            $this->client->webhookEventErrorLogs()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), WebhookEventErrorLogEntity::class);

        $entity = new WebhookEventErrorLogEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
