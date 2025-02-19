<?php

use Anteris\Autotask\API\ServiceCalls\ServiceCallCollection;
use Anteris\Autotask\API\ServiceCalls\ServiceCallService;
use Anteris\Autotask\API\ServiceCalls\ServiceCallEntity;

use Anteris\Autotask\API\ServiceCalls\ServiceCallQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ServiceCallService.
 */
class ServiceCallServiceTest extends AbstractTest
{
    /**
     * @covers ServiceCallService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ServiceCallService::class,
            $this->client->serviceCalls()
        );
    }

    /**
     * @covers ServiceCallService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->serviceCalls()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ServiceCallCollection::class,
            $result
        );
    }

    /**
     * @covers ServiceCallCollection
     */
    public function test_collection_contains_service_call_entities()
    {
        $result = $this->client->serviceCalls()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ServiceCallEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ServiceCallService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ServiceCallQueryBuilder::class,
            $this->client->serviceCalls()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ServiceCallEntity::class);

        $entity = new ServiceCallEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
