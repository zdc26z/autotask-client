<?php

use Anteris\Autotask\API\ContractServices\ContractServiceCollection;
use Anteris\Autotask\API\ContractServices\ContractServiceService;
use Anteris\Autotask\API\ContractServices\ContractServiceEntity;

use Anteris\Autotask\API\ContractServices\ContractServiceQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractServiceService.
 */
class ContractServiceServiceTest extends AbstractTest
{
    /**
     * @covers ContractServiceService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractServiceService::class,
            $this->client->contractServices()
        );
    }

    /**
     * @covers ContractServiceService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractServices()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractServiceCollection::class,
            $result
        );
    }

    /**
     * @covers ContractServiceCollection
     */
    public function test_collection_contains_contract_service_entities()
    {
        $result = $this->client->contractServices()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractServiceEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractServiceService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractServiceQueryBuilder::class,
            $this->client->contractServices()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractServiceEntity::class);

        $entity = new ContractServiceEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
