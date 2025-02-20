<?php

use Anteris\Autotask\API\ContractServiceUnits\ContractServiceUnitCollection;
use Anteris\Autotask\API\ContractServiceUnits\ContractServiceUnitService;
use Anteris\Autotask\API\ContractServiceUnits\ContractServiceUnitEntity;

use Anteris\Autotask\API\ContractServiceUnits\ContractServiceUnitQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractServiceUnitService.
 */
class ContractServiceUnitServiceTest extends AbstractTest
{
    /**
     * @covers ContractServiceUnitService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractServiceUnitService::class,
            $this->client->contractServiceUnits()
        );
    }

    /**
     * @covers ContractServiceUnitService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contractServiceUnits()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractServiceUnitCollection::class,
            $result
        );
    }

    /**
     * @covers ContractServiceUnitCollection
     */
    public function test_collection_contains_contract_service_unit_entities()
    {
        $result = $this->client->contractServiceUnits()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractServiceUnitEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractServiceUnitService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractServiceUnitQueryBuilder::class,
            $this->client->contractServiceUnits()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractServiceUnitEntity::class);

        $entity = new ContractServiceUnitEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
