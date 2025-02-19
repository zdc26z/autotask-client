<?php

use Anteris\Autotask\API\DeletedTaskActivityLogs\DeletedTaskActivityLogCollection;
use Anteris\Autotask\API\DeletedTaskActivityLogs\DeletedTaskActivityLogService;
use Anteris\Autotask\API\DeletedTaskActivityLogs\DeletedTaskActivityLogEntity;

use Anteris\Autotask\API\DeletedTaskActivityLogs\DeletedTaskActivityLogQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for DeletedTaskActivityLogService.
 */
class DeletedTaskActivityLogServiceTest extends AbstractTest
{
    /**
     * @covers DeletedTaskActivityLogService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            DeletedTaskActivityLogService::class,
            $this->client->deletedTaskActivityLogs()
        );
    }

    /**
     * @covers DeletedTaskActivityLogService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->deletedTaskActivityLogs()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            DeletedTaskActivityLogCollection::class,
            $result
        );
    }

    /**
     * @covers DeletedTaskActivityLogCollection
     */
    public function test_collection_contains_deleted_task_activity_log_entities()
    {
        $result = $this->client->deletedTaskActivityLogs()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                DeletedTaskActivityLogEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers DeletedTaskActivityLogService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            DeletedTaskActivityLogQueryBuilder::class,
            $this->client->deletedTaskActivityLogs()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), DeletedTaskActivityLogEntity::class);

        $entity = new DeletedTaskActivityLogEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
