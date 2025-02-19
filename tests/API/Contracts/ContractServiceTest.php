<?php

use Anteris\Autotask\API\Contracts\ContractCollection;
use Anteris\Autotask\API\Contracts\ContractService;
use Anteris\Autotask\API\Contracts\ContractEntity;

use Anteris\Autotask\API\Contracts\ContractQueryBuilder;
 
use Tests\AbstractTest;
use Tests\Mocks\ClientMock;
use Faker\Factory as Faker;

/**
 * Runs tests for ContractService.
 */
class ContractServiceTest extends AbstractTest
{
    /**
     * @covers ContractService
     */
    public function test_service_creation()
    {
        $this->assertInstanceOf(
            ContractService::class,
            $this->client->contracts()
        );
    }

    /**
     * @covers ContractService
     */
    public function test_query_returns_collection()
    {
        $result = $this->client->contracts()->query()->where('id', 'exist')->records(1)->get();

        // Make sure its a collection
        $this->assertInstanceOf(
            ContractCollection::class,
            $result
        );
    }

    /**
     * @covers ContractCollection
     */
    public function test_collection_contains_contract_entities()
    {
        $result = $this->client->contracts()->query()->where('id', 'exist')->records(1)->get();

        // Make sure the collection has entities
        if (count($result) > 0) {
            $this->assertInstanceOf(
                ContractEntity::class,
                $result->offsetGet(0)
            );
        } else {
            $this->assertCount(0, $result);
        }
    }

    /**
     * @covers ContractService
     */
    public function test_query_method_returns_query_builder()
    {
        $this->assertInstanceOf(
            ContractQueryBuilder::class,
            $this->client->contracts()->query()
        );
    }

    public function test_entity_can_be_constructed_from_array()
    {
        $values = ClientMock::mockValues(Faker::create(), ContractEntity::class);

        $entity = new ContractEntity($values);
        foreach($values as $key => $value) {
            $actual = $entity->{$key};
            $this->assertEquals($value, $actual, "Value of {$key} does not equal expected.");
        }
    }
}
