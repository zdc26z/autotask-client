<?php

use Anteris\Autotask\API\NotificationHistory\NotificationHistoryCollection;
use Anteris\Autotask\API\NotificationHistory\NotificationHistoryService;
use Anteris\Autotask\API\NotificationHistory\NotificationHistoryEntity;

use Anteris\Autotask\API\NotificationHistory\NotificationHistoryQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for NotificationHistoryService.
 */
class NotificationHistoryServiceTest extends AbstractTest
{
    /**
     * @covers NotificationHistoryService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            NotificationHistoryService::class,
            $this->client->notificationHistory()
        );
    }

    /**
     * @covers NotificationHistoryService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->notificationHistory()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            NotificationHistoryCollection::class,
            $result
        );
    }

    /**
     * @covers NotificationHistoryCollection
     */
    public function test_collection_contains_notification_history_entities()
    {
        $result = $this->client->notificationHistory()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                NotificationHistoryEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers NotificationHistoryService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            NotificationHistoryQueryBuilder::class,
            $this->client->notificationHistory()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), NotificationHistoryEntity::class);

        $entity = new NotificationHistoryEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
