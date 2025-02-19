<?php

use Anteris\Autotask\API\ContractRetainers\ContractRetainerCollection;
use Anteris\Autotask\API\ContractRetainers\ContractRetainerService;
use Anteris\Autotask\API\ContractRetainers\ContractRetainerEntity;

use Anteris\Autotask\API\ContractRetainers\ContractRetainerQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractRetainerService.
 */
class ContractRetainerServiceTest extends AbstractTest
{
    /**
     * @covers ContractRetainerService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractRetainerService::class,
            $this->client->contractRetainers()
        );
    }

    /**
     * @covers ContractRetainerService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractRetainers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractRetainerCollection::class,
            $result
        );
    }

    /**
     * @covers ContractRetainerCollection
     */
    public function test_collection_contains_contract_retainer_entities()
    {
        $result = $this->client->contractRetainers()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractRetainerEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractRetainerService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractRetainerQueryBuilder::class,
            $this->client->contractRetainers()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractRetainerEntity::class);

        $entity = new ContractRetainerEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
