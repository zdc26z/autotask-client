<?php

use Anteris\Autotask\API\ContractServiceBundles\ContractServiceBundleCollection;
use Anteris\Autotask\API\ContractServiceBundles\ContractServiceBundleService;
use Anteris\Autotask\API\ContractServiceBundles\ContractServiceBundleEntity;

use Anteris\Autotask\API\ContractServiceBundles\ContractServiceBundleQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractServiceBundleService.
 */
class ContractServiceBundleServiceTest extends AbstractTest
{
    /**
     * @covers ContractServiceBundleService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractServiceBundleService::class,
            $this->client->contractServiceBundles()
        );
    }

    /**
     * @covers ContractServiceBundleService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractServiceBundles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractServiceBundleCollection::class,
            $result
        );
    }

    /**
     * @covers ContractServiceBundleCollection
     */
    public function test_collection_contains_contract_service_bundle_entities()
    {
        $result = $this->client->contractServiceBundles()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractServiceBundleEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractServiceBundleService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractServiceBundleQueryBuilder::class,
            $this->client->contractServiceBundles()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractServiceBundleEntity::class);

        $entity = new ContractServiceBundleEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
