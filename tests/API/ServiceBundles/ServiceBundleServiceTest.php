<?php

use Anteris\Autotask\API\ServiceBundles\ServiceBundleCollection;
use Anteris\Autotask\API\ServiceBundles\ServiceBundleService;
use Anteris\Autotask\API\ServiceBundles\ServiceBundleEntity;

use Anteris\Autotask\API\ServiceBundles\ServiceBundleQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ServiceBundleService.
 */
class ServiceBundleServiceTest extends AbstractTest
{
    /**
     * @covers ServiceBundleService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ServiceBundleService::class,
            $this->client->serviceBundles()
        );
    }

    /**
     * @covers ServiceBundleService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->serviceBundles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ServiceBundleCollection::class,
            $result
        );
    }

    /**
     * @covers ServiceBundleCollection
     */
    public function test_collection_contains_service_bundle_entities()
    {
        $result = $this->client->serviceBundles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ServiceBundleEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ServiceBundleService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ServiceBundleQueryBuilder::class,
            $this->client->serviceBundles()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ServiceBundleEntity::class);

        $entity = new ServiceBundleEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
