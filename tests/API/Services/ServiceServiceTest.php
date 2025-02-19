<?php

use Anteris\Autotask\API\Services\ServiceCollection;
use Anteris\Autotask\API\Services\ServiceService;
use Anteris\Autotask\API\Services\ServiceEntity;

use Anteris\Autotask\API\Services\ServiceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ServiceService.
 */
class ServiceServiceTest extends AbstractTest
{
    /**
     * @covers ServiceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ServiceService::class,
            $this->client->services()
        );
    }

    /**
     * @covers ServiceService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->services()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ServiceCollection::class,
            $result
        );
    }

    /**
     * @covers ServiceCollection
     */
    public function test_collection_contains_service_entities()
    {
        $result = $this->client->services()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ServiceEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ServiceService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ServiceQueryBuilder::class,
            $this->client->services()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ServiceEntity::class);

        $entity = new ServiceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
